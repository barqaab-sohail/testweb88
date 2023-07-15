<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Category;
use App\Models\Page;

class MetaController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $items = 10;
        if ($request->items) {
            $items = $request->items;
        }

        $categories = Category::with('sub_categories')->where('parent', 0)->orderBy('sort_order')->get();

        $i = 0;
        $pages = null;
        foreach ($categories as  $category) {
            if ($category->title == 'Home') {
                $page = Page::select('id', 'name', 'page_name', 'page_title', 'meta_keyword', 'meta_description', 'meta_status')->where('name', 'index plan')->where('meta_status', '!=', 0)->first();
                if (!is_null($page)) {
                    $pages[$i] = $page;
                    $i++;
                }
            } else {
                if ($category->sub_categories) {
                    foreach ($category->sub_categories->sortBy('sort_order') as $meta_sub) {
                        if (Page::where('name', $meta_sub->title)->exists()) {
                            $page = Page::select('id', 'name', 'page_name', 'page_title', 'meta_keyword', 'meta_description', 'meta_status')->where('name', $meta_sub->title)->where('meta_status', '!=', 0)->first();
                            if (!is_null($page)) {
                                $pages[$i] = $page;
                                $i++;
                            }
                        }
                    }
                }
            }
        }
        $metaInfo = $this->paginate($pages, $items);
        $recent_update = $this->recent_update_time();
        return view('admin.meta_name.meta_name_list', compact('metaInfo', 'categories', 'items', 'recent_update'));
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
        if ($request->has('pages')) {
            $pageInfo = Page::where('name', $request->pages)->first();
            if ($pageInfo) {
                if (isset($request->meta_status)) {
                    $meta_status = 1;
                } else {
                    $meta_status = 2;
                }
                Page::where('id', $pageInfo->id)->update([
                    'page_name' => $request->page_name,
                    'page_title' => $request->page_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'meta_status' => $meta_status
                ]);
                $data = [
                    'status' => 200,
                    'url_slug' => strtolower(str_replace(' ', '_', $pageInfo->name)),
                    'message' => 'Meta Info Save Successfully.'
                ];
                return response()->json($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'Something Happend Worg. Try Again.'
                ];
                return response()->json($data);
            }
        } else {
            $this->validate($request, array(
                'meta_status' => 'required',
                'page_name' => 'required',
                'page_title' => 'required',
                'meta_keyword' => 'required',
                'meta_description' => 'required',
                'pages' => 'required',
            ), [
                'meta_status.required' => 'Status field is required',
                'page_name.required' => 'Page Name field is required',
                'page_title.required' => 'Page Title field is required',
                'meta_keyword.required' => 'Meta Keywork field is required',
                'meta_description.required' => 'Meta Description field is required',
                'pages.required' => 'Apply to Page field is required',
            ]);
        }
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
    public function update(Request $request)
    {
        if ($request->has('pages')) {
            $pageInfo = Page::where('id', $request->id)->first();
            if ($pageInfo) {
                if (isset($request->meta_status)) {
                    $meta_status = 1;
                } else {
                    $meta_status = 2;
                }
                Page::where('id', $pageInfo->id)->update([
                    'page_name' => $request->page_name,
                    'page_title' => $request->page_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'meta_status' => $meta_status
                ]);
                $data = [
                    'status' => 200,
                    'url_slug' => strtolower(str_replace(' ', '_', $pageInfo->name)),
                    'message' => 'Meta Info Update Successfully.'
                ];
                return response()->json($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'Something Happend Worg. Try Again.'
                ];
                return response()->json($data);
            }
        } else {
            $this->validate($request, array(
                'meta_status' => 'required',
                'page_name' => 'required',
                'page_title' => 'required',
                'meta_keyword' => 'required',
                'meta_description' => 'required',
                'pages' => 'required',
            ), [
                'meta_status.required' => 'Status field is required',
                'page_name.required' => 'Page Name field is required',
                'page_title.required' => 'Page Title field is required',
                'meta_keyword.required' => 'Meta Keywork field is required',
                'meta_description.required' => 'Meta Description field is required',
                'pages.required' => 'Apply to Page field is required',
            ]);
        }
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

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $paginator = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        $paginator->setPath('meta_name');
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
        $recent_date_timestamp = Page::select('updated_at')->where("meta_status", 1)->orWhere("meta_status", 2)->orderBy('updated_at', 'desc')->first();
        $recent_update = date("d M,Y") . " @ " . date("h:i a");
        if ($recent_date_timestamp) {
            $recent_update = date("d M,Y", strtotime($recent_date_timestamp->updated_at)) . " @ " . date("h:i a", strtotime($recent_date_timestamp->updated_at));
        }
        return $recent_update;
    }
}
