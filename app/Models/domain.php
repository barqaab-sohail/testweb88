<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class domain extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'domains';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'status', 'user_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }
        private function getDomainNameExtensionArray($domain_array)
    {
      $domain_info = [];
      $bulk_domains = trim($domain_array);

      if (empty($bulk_domains))
      {
        return $domain_info;
      }

      $bulk_domains_array = explode("\r\n", $bulk_domains);

      foreach ($bulk_domains_array as $domain)
      {
        $formatted_name = $this->getDomainNameExtension($domain);

        $domain_info[] = $formatted_name['name'];
      }

      return $domain_info;
    }

    private function getDomainNameExtension($domain_name)
    {
      if (empty($domain_name))
      {
        return NULL;
      }

      $domain_components = explode('.', trim($domain_name));
      $components_length = sizeOf($domain_components);
      //dd($domain_components, $components_length);
      if($components_length < 2)
      {
        return [
          'name'        => $domain_components[0],
          'components'  => $domain_components
        ];
      }

      if (sizeOf($domain_components) === 3 && in_array('www', $domain_components))
      {
        array_shift($domain_components);
      }

      if (sizeOf($domain_components) === 3 && (!in_array('www', $domain_components)))
      {
        return [
          'name'        => $domain_components[$components_length - 3].'.'.$domain_components[$components_length - 2].'.'.$domain_components[$components_length - 1],
          'components'  => $domain_components
        ];
      }

      if ($components_length == 4)
      {
        $data =  [
          'name'        => $domain_components[$components_length - 3] .'.'. $domain_components[$components_length - 2] .'.' .$domain_components[$components_length - 1],
          'components'  => $domain_components
        ];
        return $data;
      }

      $data = [
        'name'        => implode('.', $domain_components),
        'components'  => $domain_components
      ];
      return $data;
      //dd($data);
    }

    private function bulkSearch($bulkDomains)
    {
        $bulkDomains = str_replace("\r\n", "\n", $bulkDomains);
        $bulks = explode("\n", $bulkDomains);
        $success = array();
        $error = array();
        $available = "";
        $taken = "";
        foreach ($bulks as $bulk) {
            $bulk = trim($bulk);
            $bulk = str_replace("www.", "", $bulk);
//            $extension = strstr($bulk, '.');
            $result = [];

            if (!empty($bulk)) {
                $resp = (new DomainsController)->checkDomainAPI($bulk);

                if ($resp[0] == 0) {
                    $success[$bulk] = ['status' => $resp[0]];
                    $success[$bulk] = (object)$success[$bulk];
                    $available .= ",$bulk";

                } else {
                    $error[$bulk] = [
                        'status' => $resp[0]
                    ];
                    $error[$bulk] = (object)$error[$bulk];
                    $taken .= ",$bulk";
                }
            }
        }
        $available = ltrim($available, ',');
        $taken = ltrim($taken, ',');

        return (object)['success' => $success, 'error' => $error, 'available' => $available, 'taken' => $taken];
    }

    private function bulkTransfer($bulkDomains)
    {
        $bulkDomains = trim($bulkDomains);
        $bulkDomains = str_replace("\r\n", "\n", $bulkDomains);
        $bulks = explode("\n", $bulkDomains);
        $response = array();
        foreach ($bulks as $bulk) {
            $bulk = trim($bulk);
            $bulk = str_replace("www.", "", $bulk);
            if (!empty($bulk)) {
                $controller = (new DomainsController);
                $apiResponse = $controller->checkDomainAPI($bulk);
                $whoisData = $controller->whoisapi($bulk);
                $response[$bulk] = [
                    'status' => $apiResponse[0],
                    'domain' => $bulk,
                    'status_code' => $whoisData['status'],
                    'privacy' => $whoisData['privacy'],
                    'reg_days' => Carbon::now()->diffInDays(new Carbon($whoisData['date'])),
                ];
                $response[$bulk] = (object)$response[$bulk];
            }
        }

        return (object)$response;
    }

    private function singleTransfer($bulk)
    {
        $response = array();
        $bulk = trim($bulk);
        $bulk = str_replace("www.", "", $bulk);
        if (!empty($bulk)) {
            $controller = (new DomainsController);
            $apiResponse = $controller->checkDomainAPI($bulk);
            $whoisData = $controller->whoisapi($bulk);

            $response = [
                'status' => $apiResponse[0],
                'domain' => $bulk,
                'status_code' => $whoisData['status'],
                'privacy' => $whoisData['privacy'],
                'reg_days' => Carbon::now()->diffInDays(new Carbon($whoisData['date'])),
            ];
            return (object)$response;
        }
        return null;
    }

    


    private function validateUserDomainSearchInput($domain)
    {
        $spaces = '/\s/';
        $noneUrlChars = '/[!\@\[#$%^&*()+?<>=~\,\?\`\?\;\'\"|_\{\\\}]/';
        $domain = preg_replace($spaces, '', $domain);
        $domain = strtolower(preg_replace($noneUrlChars, '', $domain));
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
        return $domainName . '.' . $domainTld;
    }

    
}
