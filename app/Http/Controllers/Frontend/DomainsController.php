<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\DomainMainPage;
use App\Models\SingleTransferPage;
use App\Models\IndexPlan;
use App\Models\Page;
use App\Models\PageCms;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use App\Models\DomainPricing; // For index page domain pricing || Added by mrloffel
use App\Models\DomainPricingList; // For index page domain pricing || Added by mrloffel
use Carbon\Carbon; // For transfer login page || Added by mrloffel
use Illuminate\Support\Facades\Validator;
use Session;
use Storage;
use App\Libs\Transport;
use DB;
use App\Models\Order;
use App\Models\OrderItem;

class DomainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        //require login
        $this->transport = new Transport;
        $this->middleware('auth')->except('index', 'transferPage', 'search', 'ajaxDomainSearch');
    }

    public function index()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://my.webnic.cc/jsp/pn_whoisprivacyquery.jsp?source=webcc-webqomtec1&domain=ATHENATODD.COM&otime=',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        // ========
        $mainPageData = DomainMainPage::first();
        $domainPricing = DomainPricing::where('type', 'single')->get();
        $domainPricingList = DomainPricingList::all();
        return view('frontend.domain.index', compact(['mainPageData', 'domainPricing', 'domainPricingList']));
    }

    public function searchLogin(Request $request)
    {
     
      $request->session()->forget('failed');

      if (isset($request->login_domain)) {
        $validateData = Validator::make($request->all(), [
          'login_domain' => ['required', 'regex:/^(?!:\/\/)([a-zA-Z0-9-_]+\.)*[a-zA-Z0-9][a-zA-Z0-9-_]+\.[a-zA-Z]{2,11}?$/']
        ]);

        if ($validateData->fails()) {
          Session::flash('failed', 'The domains name is incorrect');
          return view('frontend.domain.search_login');
        }

        $domain_components    = $this->getDomainComponents($request->login_domain);
        $domain_info          = $this->getDomainPricingData($domain_components['name'], $domain_components['ext']);

        $domain_name          = $domain_components['name'];

        $alternative_names    = $this->getDomainAlternatesNames($domain_name);

        $return_data = [
          'domain_info',
          'domain_name',
          'alternative_names'
        ];

        // return view('frontend.domain.search_login', compact(['response', 'domainPricingList']));
        return view('frontend.domain.search_login', compact($return_data));
      }

      return view('frontend.domain.search_login');
    }

    public function bulkSearchLogin(Request $request)
    {
      $request->session()->forget('failed');

      $query = $request->input('login_domains');

      if (!empty($query)) {
        $target_domains = explode("\r\n", trim($query));
        $input_domains = [
          'domains' => $target_domains
        ];

        $validate_data = Validator::make($input_domains, [
          'domains.*' => ['required', 'regex:/^(?!:\/\/)([a-zA-Z0-9-_]+\.)*[a-zA-Z0-9][a-zA-Z0-9-_]+\.[a-zA-Z]{2,11}?$/']
        ]);

        if ($validate_data->fails()) {
          Session::flash('failed', 'The provided domain names are incorrect');

          return view('frontend.domain.bulk_search_login');
        }

        $domain_search_result = $this->checkBulkDomains($target_domains);

        $alternative_names    = $this->getAlternativeNames($domain_search_result['results']);

        $return_data = [
          'domain_search_result',
          'alternative_names'
        ];

        return view('frontend.domain.bulk_search_login', compact($return_data));
      }

      return view('frontend.domain.bulk_search_login');
    }

    /**
     *
     */
    private function getAlternativeNames($domain_array)
    {
      if (empty($domain_array))
      {
        return [];
      }

      $alternatives['result_status'] = False;
      $alternatives['results']       = [];


      foreach ($domain_array as $domain_name => $domain_status)
      {
        $results = $this->getDomainAlternatesNames($domain_name);

        if ($results['result_status'] === True)
        {
          $alternatives['result_status'] = $results['result_status'];
        }

        $alternatives['results'][$domain_name] = $results['results'];
      }

      return $alternatives;
    }

    /**
     *
     */
    private function getDomainAlternatesNames($domain_name)
    {
      $alternative_ext = $this->createAlternativeNames($domain_name);

      return $this->checkBulkDomains($alternative_ext);
    }

    /**
     *
     */
    private function createAlternativeNames($domain_name)
    {
      $alt_extensions = [ 'co', 'net', 'com' ];

      $alternatives = [];

      $domain_component = explode('.', $domain_name);

      foreach ($alt_extensions as $extention)
      {
        if ($domain_component[1] !== $extention)
        {
          $alternatives[] = $domain_component[0] . '.' . $extention;
        }
      }

      return $alternatives;
    }

    /**
     *
     */
    private function checkBulkDomains($domain_array)
    {
      if (empty($domain_array))
      {
        return [];
      }

      $domain_validation_result['result_status'] = False;
      $domain_validation_result['results'] = [];

      foreach ($domain_array as $domain)
      {
        $domain_components = $this->getDomainComponents($domain);

        // $domain_validation_result[$domain_components['name']]['status'] = $this->checkDomainAPI($domain_components['name']);
        // $domain_validation_result[$domain_components['name']]['pricing'] = DomainPricingList::getPricingListOptions($domain_components['ext']);

        $domain_validation_result['results'][$domain_components['name']] = $this->getDomainPricingData($domain_components['name'], $domain_components['ext']);

        if ($domain_validation_result['results'][$domain_components['name']]['status'][0] === '0')
        {
          $domain_validation_result['result_status'] = True;
        }
      }

      return $domain_validation_result;
    }

    /**
     *
     */
    private function getDomainPricingData($domain, $extension)
    {
    
      $domain_data = [
        'status'  => [],
        'pricing' => []
      ];

      if (empty($domain) || empty($extension))
      {
        return $domain_data;
      }

      $domain_data['status']  = $this->checkDomainAPI($domain);
      $domain_data['pricing'] = DomainPricingList::getPricingListOptions($extension);

      return $domain_data;
    }

    private function getDomainComponents($domain_name)
    {
      if (empty($domain_name))
      {
        return [];
      }

      $components        = explode('.', $domain_name);
      $components_length = sizeOf($components);
      if ($components_length == 4)
      {
        return [
          'name' => $components[$components_length - 3] . '.' . $components[$components_length - 2] . '.' . $components[$components_length - 1],
          'ext'  => $components[$components_length - 2] . '.' . $components[$components_length - 1]
        ];
      }
      if ($components_length > 2 && $components_length < 4)
      {
        //dd($components, $components_length);
        if (in_array('www', $components)) {
            return [
              'name' => $components[$components_length - 2] . '.' . $components[$components_length - 1],
              'ext'  => $components[$components_length - 1]
            ];
        } else {
            return [
              'name' => $components[$components_length - 3] . '.' . $components[$components_length - 2] . '.' . $components[$components_length - 1],
              'ext'  => $components[$components_length - 2] . '.' .$components[$components_length - 1]
            ];
        }
      }

      return [
        'name' => $components[0] . '.' . $components[1],
        'ext'  => $components[1]
      ];
    }

    public function transfer_login_search(Request $request)
    {
        $request->session()->forget('failed');
        if (isset($request->login_domain)) {
            $validateData = Validator::make($request->all(), [
                'login_domain' => ['required', 'regex:/^(?!:\/\/)([a-zA-Z0-9-_]+\.)*[a-zA-Z0-9][a-zA-Z0-9-_]+\.[a-zA-Z]{2,11}?$/']
            ]);

            if ($validateData->fails()) {
                Session::flash('failed', 'The domains name is incorrect');
                return view('frontend.domain.transfer_login');
            }


            $response = $this->checkDomainAPI($request->login_domain);

            $response = [
                'status' => $response[0],
                'domain' => $request->login_domain
            ];
            $response = (object)$response;
            $domainPricingList = DomainPricingList::all();
            return view('frontend.domain.search_login', compact(['response', 'domainPricingList']));
        }
        return view('frontend.domain.search_login');
    }

    public function transferLogin(Request $request)
    {

        if (isset($request->transfer_domain)) {
           if (!$this->is_valid($request->transfer_domain)) {
               return view('frontend.domain.transfer_login', ['failed' => '1']);
           }
            $domainPricingList = DomainPricingList::all();
            $response = $this::checkDomainAPI($request->transfer_domain); 
            $response = [
                'status' => $response[0],
                'domain' => $request->transfer_domain
            ];

            // $whoisData = $this::whoisDomainAPI($response['domain']);
            $whoisData = $this::whoisAPI($response['domain']);
            $response['privacy_code'] = 0;
            // if (isset($whoisData['status_code']) && $whoisData['status_code'] == 0) {
                $response['status_code'] = $whoisData['status'];
                $response['privacy_code'] = $whoisData['privacy'];
                $response['reg_days'] = Carbon::now()->diffInDays(new Carbon($whoisData['date']));
            // } else {
            //     $response['status_code'] = -1;
            //     $response['reg_days'] = -1;
            // }

            $response = (object)$response;//print_r($response);exit;
            return view('frontend.domain.transfer_login', compact('response', 'domainPricingList'));
        }

        return view('frontend.domain.transfer_login');
    }
    public function bulktransferLogin(Request $request)
    {
            if (isset($request->bulk_domains)) {
				$domains = explode(PHP_EOL, $request->bulk_domains);
				$final_response = array();
				$failed = 0;
				foreach($domains as $key => $domain)
				{

					$domain = trim($domain);

				   if (!$this->is_valid($domain)) {
					   $obj = array();
					   $obj['failed'] = '1';
					   $failed = 1;
					   $obj['domain'] = $domain;
					   array_push($final_response, (object)$obj);
					   continue;
				   }
					$domainPricingList = DomainPricingList::all();
					$response = $this::checkDomainAPI($domain);

					$response = [
								'status' => $response[0],
								'domain' => $domain
							];

					$whoisData = $this::whoisDomainAPI($response['domain']);

					$response['privacy_code'] = 0;
					if (isset($whoisData['status_code']) && $whoisData['status_code'] == 0) {
						$response['status_code'] = $whoisData['status'];
						$response['privacy_code'] = 1;
						$response['reg_days'] = Carbon::now()->diffInDays(new Carbon($whoisData['creation date']));
					} else {
						$response['status_code'] = -1;
						$response['reg_days'] = -1;
					}

					$response = (object)$response;//print_r($response);exit;
					array_push($final_response, $response);
				}

                return view('frontend.domain.bulk_domain_transfer_login', compact('final_response', 'domainPricingList', 'failed'));
            }

        return view('frontend.domain.bulk_domain_transfer_login');
    }


    function is_valid($domain_name)
    {
        return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
            && preg_match("/^.{1,253}$/", $domain_name) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)); //length of each label
    }

    public function transferPage(Request $request)
    {
        $transferPage = SingleTransferPage::first();
        $domainPricing = DomainPricing::where('type', 'single')->get();
        $domainPricingList = DomainPricingList::all();
        $domain = $request->transfer_domain;
        if (isset($request->transfer_domain)) {

            $validateData = Validator::make($request->all(), [
                'transfer_domain' => ['required', 'regex:/^(?!:\/\/)([a-zA-Z0-9-_]+\.)*[a-zA-Z0-9][a-zA-Z0-9-_]+\.[a-zA-Z]{2,11}?$/']
            ]);

            if ($validateData->fails()) {
                Session::flash('failed', 'The domains name is incorrect');
                return view('frontend.domain.transfer_page', compact('transferPage', 'domainPricing', 'domainPricingList'));
            }

            $response = $this->checkDomainAPI($request->transfer_domain);

            $response = [
                'status' => $response[0],
                'domain' => $request->transfer_domain
            ];


            $whoisData = $this::whoisapi($domain);
            $response['status_code'] = $whoisData['status'];
            $response['privacy'] = $whoisData['privacy'];
            $response['reg_days'] = Carbon::now()->diffInDays(new Carbon($whoisData['date']));

            $response = (object)$response;

            return view('frontend.domain.transfer_page', compact(['transferPage', 'domainPricingList', 'domainPricing', 'response']));
        }

        return view('frontend.domain.transfer_page', compact(['transferPage', 'domainPricingList', 'domainPricing']));
    }

    public function prevregisterNewLogin(Request $request)
    {
        if (isset($request->login_domain)) {
            $response = $this::checkDomainAPI($request->login_domain);
            if($response[0]==0){

                $response = [
                'status' => $response[0],
                'domain' => $request->login_domain,
                'domain_status' => 'available'
            ];
            }
            else{

                $response = [
                'status' => $response[0],
                'domain' => $request->login_domain,
                'domain_status' => 'taken'
            ];

            }
            $response = (object)$response;
            $domainPricingList = DomainPricingList::all();
            return view('frontend.domain.register_new_login', compact(['response', 'domainPricingList']));
        }
        return view('frontend.domain.register_new_login');
    }

    public function registerNewLogin(Request $request) {
      $request->session()->forget('failed');

      if (isset($request->login_domain)) {
        $validateData = Validator::make($request->all(), [
          'login_domain' => ['required', 'regex:/^(?!:\/\/)([a-zA-Z0-9-_]+\.)*[a-zA-Z0-9][a-zA-Z0-9-_]+\.[a-zA-Z]{2,11}?$/']
        ]);

        if ($validateData->fails()) {
          Session::flash('failed', 'The domains name is incorrect');
          return view('frontend.domain.register_new_login');
        }

        $domain_components    = $this->getDomainComponents($request->login_domain);
        $domain_info          = $this->getDomainPricingData($domain_components['name'], $domain_components['ext']);

        $domain_name          = $domain_components['name'];

        $alternative_names    = $this->getDomainAlternatesNames($domain_name);

        $return_data = [
          'domain_info',
          'domain_name',
          'alternative_names'
        ];
        return view('frontend.domain.register_new_login', compact($return_data));
      }

      return view('frontend.domain.register_new_login');
    }

    public function domainRenewal(Request $request)
    {
        // $response = $this::whoisDomainAPI('fohsan.com.my');

        $domains = auth()->user()->domains;
        if (count($domains) > 0) {
            foreach ($domains as $domain) {
             // check domain status
              $orderStatusDetails = '';
              $orderId = OrderItem::where('services', $domain->name)->where('user_id', auth()->user()->id)->pluck('order_id');
              // echo '<pre>';print_r($orderId);
              if(!empty($orderId[0])){

                // $orderStatusDetails = Order::where('user_id', auth()->user()->id)->where('id',$orderId[0])->orderBy('id','DESC')->first();
              }
              $orderStatusDetails = DB::table('orders')
                  ->leftJoin('order_items', function ($join) {
                      $join->on('orders.id', '=', 'order_items.order_id');
                  })->where(['order_items.services'=>$domain->name, 'orders.user_id' => auth()->user()->id])
                  ->first(); 
              $apiExpDate = $this::whoisDomainAPI($domain->name);
              if (!empty($apiExpDate['expire date'])) {
                  $domain->exp_date = $apiExpDate['expire date'];
              } else {
                  $domain->exp_date   = $domain->exp_date;
              }
				      $diffTime = Carbon::now()->diffInDays(new Carbon($domain->exp_date), false);

              // echo $diffTime."====";
      				if ($diffTime > 0 && !empty($orderStatusDetails) && $orderStatusDetails->status == 'COMPLETED'){
                $domain->status = 'Active';
              } else if($diffTime > 0 && !empty($orderStatusDetails) && $orderStatusDetails->status =='INCOMPLETE') {
      					$domain->status = 'Pending';
      				} else if($diffTime < 0 && !empty($orderStatusDetails) && $orderStatusDetails->status=='INCOMPLETE'){
                $domain->status = 'Pending';
              }else if($diffTime < 0 && !empty($orderStatusDetails) && $orderStatusDetails->status=='FAILED'){
                $domain->status = 'Pending';
              } else if($diffTime < 0){
                  $domain->status = 'Expired';
              }
            }
        }
		/*if (isset($request->status_filter)) {
			$domains = $domains->filter(function($domain, $key) use($request) {
				return data_get($domain, 'status') == $request->status_filter;
			});
		}*/
		
        return view('frontend.domain.domain_renewal', compact('domains'));
    }

    public function search(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'search_domain' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('frontend.domain.search')
                ->withErrors($validator)
                ->withInput();
        }

        list($filteredDomain, $tld) = $this->validateUserDomainSearchInput($request->search_domain);

        $mainPageData = DomainMainPage::first();
        $domainPricing = DomainPricing::where('type', 'single')->get();
        $domainPricingList = DomainPricingList::all();
        $response = $this->checkDomainAPI($filteredDomain);


        $response = [
            'status' => $response[0],
            'domain' => $filteredDomain
        ];

        $response = (object)$response;
        // \DB::enableQueryLog();

        $type = 'new';
        $findedDomainPrice = DomainPricingList::where([['type', $type], ['tld', $tld]])->first();

        return view('frontend.domain.search', compact(
            [
                'domainPricingList',
                'findedDomainPrice',
                'mainPageData',
                'domainPricing',
                'response'
            ]
        ));
    }

    public function bulkSearch(Request $request, $page_name)
    {
        $validator = Validator::make($request->all(), [
            // 'bulk_domains' => 'required',
             'bulk_domains' => ['required', 'regex:/^(?!:\/\/)([a-zA-Z0-9-_]+\.)*[a-zA-Z0-9][a-zA-Z0-9-_]+\.[a-zA-Z]{2,11}?$/'],
        ]);

        if ($validator->fails()) {
            Session::flash('failed', 'The domains name is incorrect');
            return view('frontend.domain.transfer_page', compact('transferPage', 'domainPricing', 'domainPricingList'));
        }

//        $mainPageData = DomainMainPage::first();
//        $domainPricing = DomainPricing::where('type', 'single')->get();
//        $domainPricingList = DomainPricingList::all();

        $bulkDomains = trim($request->input('bulk_domains'));
        $bulkDomains = str_replace("\r\n", "\n", $bulkDomains);
        $bulks = explode("\n", $bulkDomains);

        $response = array();
        foreach ($bulks as $bulk) {
            $bulk = trim($bulk);
            if (!empty($bulk)) {
                $resp = $this->checkDomainAPI($bulk);
                $response[$bulk] = [
                    'status' => $resp[0]
                ];
            }
        }

        return $response = (object)$response;
    }

    public function ajaxDomainSearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_domain' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $view = view("frontend.domain.partials.search_results", compact(['errors']))->render();
            return response()->json(['content' => $view]);
        }

        list($filteredDomain, $tld) = $this->validateUserDomainSearchInput($request->search_domain);
        $response = $this->checkDomainAPI($filteredDomain);

        $response = [
            'status' => $response[0],
            'domain' => $filteredDomain
        ];
        $response = (object)$response;

        $type = 'new';
        $findedDomainPrice = DomainPricingList::where([['type', $type], ['tld', $tld]])->first();
        $view = view("frontend.domain.partials.search_results", compact(['findedDomainPrice', 'response']))->render();
        return response()->json(['content' => $view, 'filteredDomain' => $filteredDomain]);
    }

    public function validateUserDomainSearchInput($domain)
    {
        //dd($domain);
        $spaces       = '/\s/';
        $noneUrlChars = '/[!\@\[#$%^&*()+?<>=~\,\?\`\?\;\'\"|_\{\\\}]/';
        $domain       = preg_replace($spaces, '', $domain);
        $domain       = strtolower(preg_replace($noneUrlChars, '', $domain));
        $domainArr    = explode('.', $domain);

        //dd($domainArr);
        $domainRoot   = in_array('www', $domainArr) ? $domainArr[0] : '';
        if (in_array('www', $domainArr)) {
          if (!empty($domain[2]) && (count($domainArr) == 4)) {
            $domain = $domainArr[1] .'.'. $domainArr[2].'.'. $domainArr[3];
          } else {
            $domain = $domainArr[1] .'.'. $domainArr[2];
          }
        }
        $domainName = strstr($domain, '.', true);
        if ($domainName == false) {
            $domainName = $domain;
            $domainTld = 'com';
        } else {
            $domainTld = str_replace($domainName . '.', '', $domain);
        }

        //check if such tld exist in Database
        $tldExist = DomainPricingList::where('tld', $domainTld)->first();
        $domainTld = $tldExist ? $domainTld : 'com';
        if (!empty($domainRoot)) {
          return [$domainRoot. '.' . $domainName . '.' . $domainTld, $domainTld];
        } else {
          return [$domainName . '.' . $domainTld, $domainTld];
        }
    }

    // API function to check available domain || Added by mrloffel
    public function checkDomainAPI($url)
    {
        $urlArr = explode('.', $url);
        if (in_array('www', $urlArr)) {
          if (!empty($urlArr[3])) {
            $url = $urlArr[1]. "." . $urlArr[2]. "." . $urlArr[3];
          } else {
            $url = $urlArr[1]. "." . $urlArr[2];
          }
        }
        // example of request for get method https://my.webnic.cc/jsp/pn_qry.jsp?source=webcc-webqomtec1&domain=mail.com
        $method = 'GET';
        $baseUrl = 'https://my.webnic.cc';
        $resource = '/jsp/pn_qry.jsp';
        $payload = [
            'source' => 'webcc-webqomtec1',
            'domain' => $url,
        ];

        $result = $this->transport->request($method, $baseUrl, $resource, $payload);
         // var_dump($result);exit;
        return explode("\t", $result);
    }
    public function url_get_contents ($Url) {
      if (!function_exists('curl_init')){
          die('CURL is not installed!');
      }
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $Url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $output = curl_exec($ch);
      curl_close($ch);
      return $output;
  }

    public function whois($domain)
    {
        $domain  = str_replace("www.", "", $domain);
        $site    = "http://www." . $domain;
        //$apiUrl  = "https://www.googleapis.com/pagespeedonline/v4/runPagespeed?url={$site}&screenshot=true";
        //$apiUrl  = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=http://www.webqom.com/";
        //$apiUrl  = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={$site}&strategry=desktop";

        //$image = $this->url_get_contents($apiUrl);
        //$image = json_decode($image, true);
        //$image = $image['lighthouseResult']['audits']['screenshot-thumbnails']['details']['items'][9]['data'];
        //$image = "data:image/jpeg;base64," . $image['screenshot']['data'];
        //$image = str_replace(array('_', '-'), array('/', '+'), $image);
        //dd($image, $image['lighthouseResult']['audits']['screenshot-thumbnails']['details']['items'][0]['data']);
        // The parameters.
        $params = http_build_query(array(
            "access_key" => "04005eed8c2e41b394f41196764c4796",
            "url"        => $site,
        ));
        $apiUrl  = "https://api.apiflash.com/v1/urltoimage?" . $params;
        try {
            $image = file_get_contents($apiUrl);
            file_put_contents("screenshot.jpeg", $image);
            $image = url("screenshot.jpeg");
        } catch (\Exception $exception) {
            $image = '';
        }

        /*try {
            $image = file_get_contents($apiUrl);
            $image = json_decode($image, true);
            $image= "data:image/jpeg;base64," .  $image_data;
            // $idxCnt= count($image['lighthouseResult']['audits']['screenshot-thumbnails']['details']['items']);
            // $image = $image['lighthouseResult']['audits']['screenshot-thumbnails']['details']['items'][$idxCnt-1]['data'];
            $image = str_replace(array('_', '-'), array('/', '+'), $image);
        } catch (\Exception $exception) {
            $image = '';
        }*/
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://iwhois.webnic.cc/jsp/whois.jsp?source=webcc-webqomtec1&domain=' . $domain,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            dd("cURL Error #:" . $err);
        } else {
            $lines = [];
            function getArr($arr)
            {
                $string = (isset($arr[1])) ? $arr[1] : '';
                return $string;
            }

            function getMultipleParam($param_str, $resp, $exclude_char = null)
            {
                $array = [];
                $res = explode($param_str, $resp);
                foreach ($res as $key => $val) {
                    if ($key > 0) {
                        $v = explode('<br>', $val)[0];
                        if (!in_array(strtoupper($v), $array)) {
                            if ($exclude_char) {
                                if (strpos($v, $exclude_char) === false) {
                                    $array[] = $v;
                                }
                            } else {
                                $array[] = $v;
                            }
                        }
                    }
                }
                return $array;
            }

            function arrayToObject($array)
            {
                $json = json_encode($array);
                $object = json_decode($json);
                return $object;
            }


            if (strpos($response, 'No match for domain') === false) {
                if (strpos($response, "SEARCH BY DOMAIN NAME") === false) {
                    $lines["image"] = $image;
                    $lines["last_updated"] = explode(" <<<", getArr(explode(">>> Last update of whois database: ", $response)))[0];
                    $lines["domain_name"] = explode("<br>", getArr(explode("Domain Name: ", $response)))[0];
                    $lines["registry_domain_id"] = explode("<br>", getArr(explode("Registry Domain ID: ", $response)))[0];
                    $lines["registrar"] = [];
                    $lines["registrar"]["whois_server"] = explode("<br>", getArr(explode("Registrar WHOIS Server: ", $response)))[0];
                    $lines["registrar"]["url"] = explode("<br>", getArr(explode("Registrar URL: ", $response)))[0];
                    $lines["updated_date"] = explode("<br>", getArr(explode("Updated Date: ", $response)))[0];
                    $lines["creation_date"] = explode("<br>", getArr(explode("Creation Date: ", $response)))[0];
                    $lines["expiry_date"] = explode("<br>", getArr(explode("Registry Expiry Date: ", $response)))[0];
                    $lines["registrar"]["name"] = explode("<br>", getArr(explode("Registrar: ", $response)))[0];
                    $lines["registrar"]["iana_id"] = explode("<br>", getArr(explode("Registrar IANA ID: ", $response)))[0];
                    $lines["registrar"]["phone"] = explode("<br>", getArr(explode("Registrar Abuse Contact Phone: ", $response)))[0];
                    $lines["registry_registrant_id"] = explode("<br>", getArr(explode("Registry Registrant ID: ", $response)))[0];
                    $lines["registrant"] = [];
                    $lines["registrant"]["organization"] = explode("<br>", getArr(explode("Registrant Organization: ", $response)))[0];
                    $lines["registrant"]["street"] = explode("<br>", getArr(explode("Registrant Street: ", $response)))[0];
                    $lines["registrant"]["city"] = explode("<br>", getArr(explode("Registrant City: ", $response)))[0];
                    $lines["registrant"]["state"] = explode("<br>", getArr(explode("Registrant State/Province: ", $response)))[0];
                    $lines["registrant"]["postcode"] = explode("<br>", getArr(explode("Registrant Postal Code: ", $response)))[0];
                    $lines["registrant"]["country"] = explode("<br>", getArr(explode("Registrant Country: ", $response)))[0];
                    $lines["registrant"]["phone"] = explode("<br>", getArr(explode("Registrant Phone: ", $response)))[0];
                    $lines["registrant"]["address"] = "Not available";
                    if (
                        $lines["registrant"]["street"] != '' and
                        $lines["registrant"]["city"] != '' and
                        $lines["registrant"]["state"] != '' and
                        $lines["registrant"]["postcode"] != '' and
                        $lines["registrant"]["country"]
                    ) {
                        $lines["registrant"]["address"] = $lines["registrant"]["country"] . ", " . $lines["registrant"]["state"] . ", " . $lines["registrant"]["city"] .
                            ", " . $lines["registrant"]["street"] . ", " . $lines["registrant"]["postcode"];
                    }
                    $lines["registrant"]["fax"] = explode("<br>", getArr(explode("Registrant Fax: ", $response)))[0];
                    $lines["registrant"]["email"] = explode("<br>", getArr(explode("Registrant Email: ", $response)))[0];
                    $lines["domain_status"] = getMultipleParam("Domain Status: ", $response, "www.");
                    $lines["name_server"] = getMultipleParam("Name Server: ", $response);
                } else {
                    $lines["name_server"][] = str_replace(["<br>", " "], ['', ''], explode("<br>
  ", getArr(explode("k [Primary Name Server]              ", $response)))[1]);
                    $lines["name_server"][] = str_replace(["<br>", " "], ['', ''], explode("<br>
  ", getArr(explode("l [Secondary Name Server]            ", $response)))[1]);
                    $lines["image"] = $image;
                    $lines["registrar"] = [];
                    $lines["registrant"] = [];
                    $lines["domain_status"][0] = "Not available";
                    $extra_registrar_info = explode("<br>", getArr(explode("f [Invoicing Party]                            ", $response)));
                    $lines["registrar"]["name"] = $extra_registrar_info[2];
                    $lines["registrant"]["address"] = $extra_registrar_info[3] . ", " . $extra_registrar_info[4] . ", " . $extra_registrar_info[5] . ", " . $extra_registrar_info[6] . ", " . $extra_registrar_info[7];
                    $lines["last_updated"] = null;
                    $lines["domain_name"] = explode("<br>", getArr(explode("a [Domain Name]                 ", $response)))[0];
                    $lines["updated_date"] = explode("<br>", getArr(explode("e [Record Last Modified]        ", $response)))[0];
                    $lines["creation_date"] = explode("<br>", getArr(explode("c [Record Created]              ", $response)))[0];
                    $lines["expiry_date"] = explode("<br>", getArr(explode("d [Record Expired]              ", $response)))[0];
                    $lines["registrant"]["phone"] = explode("  <br>", getArr(explode("(Tel) ", $response)))[0];
                }
            } else {
                $lines['message'] = "No match for domain \"" . $domain . "\"";
                $lines['last_updated'] = explode(" <<<", getArr(explode(">>> Last update of whois database: ", $response)))[0];
            }
        }
        $lines['raw'] = $response;
        $response = arrayToObject($lines);
        return view('frontend.domain.whois', ["response" => $response, "domain" => $domain]);
    }

    public function whoisapi($domain)
    {
        $date = new Carbon();
        $status = 4;
        $privacy = 0;
        $domain = str_replace("www.", "", $domain);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://iwhois.webnic.cc/jsp/whois.jsp?source=webcc-webqomtec1&domain=' . $domain,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
        } else {
            $response = (explode("\n", $response));
//            dd($response);
            foreach ($response as $line) {
                $trim = trim($line);
                $trim = str_replace("<br>", "", $trim);
                if (!empty($trim)) {
                    if (substr($trim, 0, 14) === "Creation Date:") {
                        $status = 1;
                        $trim = str_replace("Creation Date: ", "", $trim);
                        $date = new Carbon($trim);
//                        break;
                    }
                    else if (substr($trim, 0, 18) === "c [Record Created]") {
                        $status = 1;
                        $trim = str_replace("c [Record Created] ", "", $trim);
                        $date = new Carbon($trim);
//                        break;
                    } else if (substr($trim, 0, 19) === "No match for domain") {
                        $status = 0;
//                        break;
                    }
                    else if (substr($trim, -26) === "does not exist in database") {
                        $status = 0;
//                        break;
                    }
                    else if (substr($trim, -30) === "NOT AVAILABLE for registration") {
                        $status = 8;
//                        break;
                    } else if (strpos(strtolower($trim), 'whoisprotection') !== false) {
                        $privacy = 1;
//                        dd('hh');
                    } elseif (strpos(($trim), "clientTransferProhibited") !== false) {
                        $status = 5;
//                        dd('h');
                    }
                }
            }
        }
        return array(
            'status' => $status, 'date' => $date, 'privacy' => $privacy
        );
    }

    /**
     * Info: API function to get webnic whois data about domain || Added by mrloffel
     * Status:
     *        -A = Active
     *        -N = ??
     *        -E = Expired
     */
    public function whoisDomainAPI($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://my.webnic.cc/jsp/pn_whois.jsp?source=webcc-webqomtec1&domain=' . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            dd("cURL Error #:" . $err);
        } else {
            $lines = [];

            if (strlen($response) > 60) {
                foreach (preg_split("/((\r?\n)|(\r\n?))/", $response) as $line) {
                    $temp = explode("\t", $line);
                    if (isset($temp[2])) {
                        $lines['status_code'] = $temp[0];
                        $lines[$temp[1]] = $temp[2];
                        continue;
                    }

                    if (isset($temp[1])) {
                        $lines[$temp[0]] = $temp[1];
                    } else {
                        $lines[$temp[0]] = '';
                    }
                }
                unset($lines['']);
            } else {
                $response = explode("\t", str_replace("\n", "", $response));
                $lines['status_code'] = $response[0];
                $lines['message'] = $response[1];
            }
            return $lines;
        }
    }
}
