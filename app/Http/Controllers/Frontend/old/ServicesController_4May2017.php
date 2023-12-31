<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DomainPricing;
use App\Models\FAQ;
use App\Models\GeneralFeature;
use App\Models\IndexPlan;
use App\Models\Page;
use App\Models\Plan;
use App\Models\PlanFeature;
use App\Models\ServicesFreeDomain;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Storage;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        /*$this->middleware('admin');*/
    }
    public function index($page_slug, $preview = false)
    {

        $page_name = strtolower(str_replace('_', ' ', $page_slug)); 
        $cms = Page::where('name', $page_name)->first();
        if ($preview != false) {
            if (Auth::user()->role != "Admin") {
                return "you are not authorized to view this page in preview mode";
            }
            $cms->content = $cms->temp;
        }
        $plans = Plan::where('page', $page_name)->where('status', 1)->orderby('sort_order')->take(3)->get();
        if (!$cms) {
            return abort(404);
        }

        $featured_plans = PlanFeature::where('page', $page_name)->where('status', 1)->get(); 
        $faq = FAQ::where('page', $page_name)->where('status', 1)->get();
        $general_features = GeneralFeature::where('page', $page_name)->get();
        $recent_update = $this->recent_update_time(); 
		$service_free_domains = ServicesFreeDomain::where('page', $page_name)->first(); 
        $page_header = strtoupper(str_replace('_', ' ', $page_slug));
        $sub_header = "";
        if ($cms->is_ssl_page) {
            $featured_plans = PlanFeature::where('page', $page_name)->where('status', 1)->get();
        }

        if ($cms->is_ssl_page) {
            return view('frontend.ssl', compact('faq', 'page_header', 'service_free_domains', 'sub_header', 'indexplans', 'general_features', 'plans', 'featured_plans', 'cms', 'page_name', 'page_slug'));
        }
        if ($cms->is_ecomerce_page) {
            return view('frontend.econmerece', compact('faq', 'page_header', 'service_free_domains', 'sub_header', 'indexplans', 'general_features', 'plans', 'featured_plans', 'cms', 'page_name', 'page_slug'));
        }
        return view('frontend.services', compact('faq', 'page_header', 'service_free_domains', 'sub_header', 'indexplans', 'general_features', 'plans', 'featured_plans', 'cms', 'page_name', 'page_slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.index-plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //return $request->all();
        $requestData = $request->all();

        Page::create($requestData);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $indexplan = IndexPlan::findOrFail($id);

        return view('admin.index-plan.show', compact('indexplan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $indexplan = IndexPlan::findOrFail($id);

        return view('admin.index-plan.edit', compact('indexplan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $index_plan = IndexPlan::findOrFail($id);
        $this->validate($request, [
            'name_line1' => 'required|max:255',
            'name_line2' => 'required|max:255',
            'enable_plan_button_other' => 'required_if:enable_plan_button,other',
            'sort_order' => 'required|numeric|max:255',
            'url' => 'required|url|max:255',
        ]);
        if (strtolower($request->pricing_type) != "free") {
            $this->validate($request, [
                'pricing_currency_other' => 'required_if:pricing_currency,USD,other',
                'recurring_currency_other' => 'required_if:recurring_currency,USD,other',
                'recurring_first_year' => 'required_if:pricing_type,Recurring|numeric',
                'recurring_first_month' => 'required_if:pricing_type,Recurring|numeric',
                /*PRICING TABLE FIELDS for price type one time*/
                'setup_fee_one_time' => 'required|numeric',
                'setup_fee_monthly' => 'required|numeric',
                'price_one_time' => 'required|numeric',
                'price_monthly' => 'required|numeric',
                /*PRICING TABLE FIELDS for price type recurring*/
                'setup_fee_annually' => 'required_if:pricing_type,Recurring|numeric',
                'setup_fee_biennially' => 'required_if:pricing_type,Recurring|numeric',
                'setup_fee_triennially' => 'required_if:pricing_type,Recurring|numeric',
                'price_annually' => 'required_if:pricing_type,Recurring|numeric',
                'price_biennially' => 'required_if:pricing_type,Recurring|numeric',
                'price_triennially' => 'required_if:pricing_type,Recurring|numeric',
            ]);
        }
        $index_plan->name_line1 = $request->name_line1;
        $index_plan->name_line2 = $request->name_line2;
        $index_plan->url = $request->url;
        $index_plan->enable_plan_button = $request->enable_plan_button;
        $index_plan->enable_plan_button_other = $request->enable_plan_button_other;
        $index_plan->sort_order = ($request->sort_order) != "" ? $request->sort_order : 0;
        $index_plan->price_type = $request->pricing_type;
        if (strtolower($request->pricing_type) != "free") {
            $index_plan->setup_fee_one_time = $request->setup_fee_one_time;
            $index_plan->setup_fee_monthly = $request->setup_fee_monthly;
            $index_plan->price_monthly = $request->price_monthly;
            $index_plan->price_one_time = $request->price_one_time;
            if (strtolower($request->pricing_type) == "one time") {
                $index_plan->pricing_currency = $request->pricing_currency;
                $index_plan->pricing_currency_other = $request->pricing_currency_other;

            } else if (strtolower($request->pricing_type) == "recurring") {
                $index_plan->recurring_currency = $request->recurring_currency;
                $index_plan->recurring_currency = $request->recurring_currency;
                $index_plan->recurring_currency_other = $request->recurring_currency_other;
                $index_plan->recurring_first_month = $request->recurring_first_month;
                $index_plan->recurring_first_year = $request->recurring_first_year;
                /*prcing fields*/
                $index_plan->setup_fee_annually = $request->setup_fee_annually;
                $index_plan->setup_fee_biennially = $request->setup_fee_biennially;
                $index_plan->setup_fee_triennially = $request->setup_fee_triennially;
                $index_plan->price_annually = $request->price_annually;
                $index_plan->price_biennially = $request->price_biennially;
                $index_plan->price_triennially = $request->price_triennially;

            }
        }
        $index_plan->status = isset($request->status) ? 1 : 0;
        $index_plan->save();
        return date("d M,Y", strtotime($index_plan->updated_at)) . " @ " . date("h:i a", strtotime($index_plan->updated_at));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        IndexPlan::destroy($id);

        Session::flash('flash_message', 'IndexPlan deleted!');

        return redirect('admin/index-plan');
    }
    public function delete(Request $request)
    {

        //return $request->all();
        $id = $request->id;
        if (is_array($id)) {
            foreach ($id as $i) {
                IndexPlan::find($i)->delete();
            }
            Session::flash('success', 'Deleted successfully');
        } else {
            IndexPlan::find($id)->delete();
            Session::flash('success', 'Deleted successfully');
            return redirect('admin/index-plan');
        }

    }
    public function image_update(Request $request)
    {
        //return $request->id;
        $this->validate($request, [
            'image_file' => 'max:2000|mimes:png',
        ]);
        $icon_image = Input::file('image_file');
        $extension = $icon_image->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111, 99999) . '.' . $extension;
        Storage::disk('index-plan')->putFileAs('icon_images', $icon_image, $fileName);
        $index_plan = IndexPlan::find($request->id);
        $index_plan->icon_image = $fileName;
        $index_plan->save();
        return $fileName;
    }
    public function recent_update_time()
    {
        $recent_date_timestamp = IndexPlan::select('updated_at')->orderBy('updated_at', 'desc')->first();
        $recent_update = date("d M,Y") . " @ " . date("h:i a");
        if ($recent_date_timestamp) {
            $recent_update = date("d M,Y", strtotime($recent_date_timestamp->updated_at)) . " @ " . date("h:i a", strtotime($recent_date_timestamp->updated_at));

        }
        return $recent_update;
    }
    public function get_index_plan_details(Request $request)
    {
        $id = $request->id;
        if ($id != null) {
            if (is_array($id)) {
                $indexplans = IndexPlan::whereIn('id', $id)->get();
                return $indexplans;
            }
        }
    }
    public function update_sort(Request $request)
    {
        if (!empty($request->data)) {
            foreach ($request->data as $key) {
                $indexplan = IndexPlan::find($key['id']);
                $indexplan->sort_order = $key['sort_order'];
                $indexplan->save();
            }
        }
    }
    public function cms_update(Request $request)
    {
        //return $request->left_header;
        $cms = PageCms::where('page_id', 1)->where('slug', 'title')->first();
        $cms->content = $request->title;
        $cms->save();
        $cms = PageCms::where('page_id', 1)->where('slug', 'left_header')->first();
        $cms->content = $request->left_header;
        $cms->save();
        $cms = PageCms::where('page_id', 1)->where('slug', 'left_content')->first();
        $cms->content = $request->left_content;
        $cms->save();
        $cms = PageCms::where('page_id', 1)->where('slug', 'right_header')->first();
        $cms->content = $request->right_header;
        $cms->save();
        $cms = PageCms::where('page_id', 1)->where('slug', 'right_content')->first();
        $cms->content = $request->right_content;
        $cms->save();
        return $cms;
    }
    public function right_section(Request $request)
    {
        $cms = PageCms::where('page_id', 1)->where('slug', 'right_section')->first();
        $cms->content = $request->data;
        $cms->save();
        return $cms;
    }
    public function left_section(Request $request)
    {

        $cms = PageCms::where('page_id', 1)->where('slug', 'left_section')->first();
        $cms->content = $request->title;
        $cms->save();
        return $cms;
    }
}
