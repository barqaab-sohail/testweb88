<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

use App\Models\GstRate;
use Illuminate\Http\Request;
use Session;

class GstRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $items = 10;
        $result = null;
        if ($request->items) {
            $items = $request->items;
        }
        $gstRatesData = GstRate::get();
        foreach ($gstRatesData as $key=>$val){
            $result[$key] = $val;
        }
        $gstrates = $this->paginate($result, $items);
        $recent_update = $this->recent_update_time();
        return view('admin.gst-rates.gst_rate_list', compact('gstrates', 'items', 'recent_update'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.gst-rates.create');
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
        if ($request->has('name')) {
            $pageInfo = GstRate::where('name', $request->name)->first();
            if ($pageInfo) {
                if (isset($request->status)) {
                    $status = 1;
                } else {
                    $status = 2;
                }
                GstRate::where('id', $pageInfo->id)->update([
                    'name' => $request->name,
                    'rate' => $request->rate,
                    'status' => $status,
                ]);
                $data = [
                    'status' => 200,
                    'url_slug' => strtolower(str_replace(' ', '_', $pageInfo->name)),
                    'message' => 'Meta Info Save Successfully.'
                ];
                Session::flash('success', 'Gst Rate Created!');
                return response()->json($data);
            } else {
                if (isset($request->status)) {
                    $status = 1;
                } else {
                    $status = 2;
                }
                $gstRate = new GstRate();
                $gstRate->name = $request->name;
                $gstRate->rate = $request->rate;
                $gstRate->status = $status;
                $gstRate->save();
                if($gstRate->id){
                    $data = [
                        'status' => 200,
                        'url_slug' => strtolower(str_replace(' ', '_', $gstRate->name)),
                        'message' => 'Meta Info Save Successfully.'
                    ];
                    Session::flash('success', 'Gst Rate Created!');
                }else{
                    Session::flash('error', 'Gst Rate Created!');
                    $data = [
                        'status' => 404,
                        'message' => 'Something Happend Worg. Try Again.'
                    ];
                }

                return response()->json($data);
            }
        } else {
            $this->validate($request, array(
                'status' => 'required',
                'name' => 'required',
                'rate' => 'required',
            ), [
                'status.required' => 'Status field is required',
                'name.required' => 'Name field is required',
                'rate.required' => 'Rate field is required',
            ]);
        }
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
        $gstrate = GstRate::findOrFail($id);

        return view('admin.gst-rates.show', compact('gstrate'));
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
        $gstrate = GstRate::findOrFail($id);

        return view('admin.gst-rates.edit', compact('gstrate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function update(Request $request)
    {
        if ($request->has('id')) {
            $pageInfo = GstRate::where('id', $request->id)->first();
            if ($pageInfo) {
                if ($request->status) {
                    $status = 1;
                } else {
                    $status = 2;
                }
                GstRate::where('id', $pageInfo->id)->update([
                    'name' => $request->name,
                    'rate' => $request->rate,
                    'status' => $status
                ]);
                $data = [
                    'status' => 200,
                    'url_slug' => strtolower(str_replace(' ', '_', $pageInfo->name)),
                    'message' => 'Meta Info Update Successfully.'
                ];
                Session::flash('success', 'Gst Rate Updated!');
                return response()->json($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'Something Happend Worg. Try Again.'
                ];
                Session::flash('error', 'Gst Rate Not Updated!');
                return response()->json($data);
            }
        } else {
            $this->validate($request, array(
                'status' => 'required',
                'name' => 'required',
                'rate' => 'required',
            ), [
                'status.required' => 'Status field is required',
                'name.required' => 'Name field is required',
                'rate.required' => 'Rate field is required',
            ]);
        }
    }

    public function gst_rate_selected_delete(Request $request)
    {
        $metaIdsArray = explode(",", $request->get('target_items'));
        foreach ($metaIdsArray as $metaId) {
            $gstRate= GstRate::find($metaId);
            $gstRate->delete();
            /*$updateMeta = Page::where('id', $metaId)->update([
                'page_name' => NULL,
                'page_title' => NULL,
                'meta_keyword' => NULL,
                'meta_description' => NULL,
                'meta_status' => 0
            ]);*/
        }
        if ($metaIdsArray) {
            $request->session()->flash('success', 'deleted');
        } else {
            $request->session()->flash('error', 'not deleted');
        }
        return redirect()->back();
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
        GstRate::destroy($id);

        Session::flash('flash_message', 'GstRate deleted!');

        return redirect('admin/gst-rates');
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $paginator = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        $paginator->setPath('gst_rates');
        return $paginator;
    }

    public function meta_name_selected_delete(Request $request)
    {
        $metaIdsArray = explode(",", $request->get('target_metas'));
        foreach ($metaIdsArray as $metaId) {
            $updateMeta = Page::where('id', $metaId)->update([
                'page_name' => NULL,
                'page_title' => NULL,
                'meta_keyword' => NULL,
                'meta_description' => NULL,
                'meta_status' => 0
            ]);
            if ($updateMeta) {
                $request->session()->flash('success', 'deleted');
            } else {
                $request->session()->flash('error', 'not deleted');
            }
        }
        return redirect()->back();
    }

    public function recent_update_time()
    {
        $recent_date_timestamp = GstRate::select('updated_at')->where("status", 1)->orderBy('updated_at', 'desc')->first();
        $recent_update = date("d M,Y") . " @ " . date("h:i a");
        if ($recent_date_timestamp) {
            $recent_update = date("d M,Y", strtotime($recent_date_timestamp->updated_at)) . " @ " . date("h:i a", strtotime($recent_date_timestamp->updated_at));
        }
        return $recent_update;
    }
}
