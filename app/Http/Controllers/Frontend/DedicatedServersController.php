<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\IndexPlan;
use App\Models\PlanFeature;
use App\Models\PlanFeatureDetail;
use App\Models\Plan;
use App\Models\Page;
use App\Models\PageCms;
use DB;

use Illuminate\Support\Facades\Input;
use Session;
use Storage;
class DedicatedServersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms        = Page::where('name','dedicated servers')->first();
        $indexplans = IndexPlan::paginate(10);
        
        return view('frontend.dedicated_servers', compact('indexplans','cms'));
    
    }

    public function configDedicate(Request $request) {
        $id = $request->id;
        //echo $id;exit();
        if(isset($id) && !empty($id))
        {
            
            $plan_feature_details = DB::table('plan_feature_details')->where('plan_id', $id)->get();
            $data = [];
            foreach($plan_feature_details as $key => $details)
            {
				$featured_plans = DB::table('plan_features')->where('id',$details->plan_feature_id)->select('title')->first();	
				//~ $plan_feature_details[$key] = $featured_plans->title;
				$data[$featured_plans->title][] = $details;
				//~ $data[$key]->title =  $featured_plans->title;
								
			}
            //dd($data);
			$featured_plans = PlanFeature::with('details')->where('page','dedicated servers')->get();
			$plans = Plan::where(['status' => 1, 'id' => $id])->orderby('sort_order')->first();
            Session::put('plan_id', $id);
            // dd($plans);
            return view('frontend.server_config_dedicated',compact('plans', 'data', 'featured_plans'));
        }else{
            die('something went wrong!');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
