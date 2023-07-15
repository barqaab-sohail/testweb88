<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Category extends Model
{
    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent');
    }

    public function sub_categories()
    {
        return $this->hasMany('App\Models\Category', 'parent');
    }
    public function plans()
    {
        return $this->hasMany('App\Models\Plan', 'category');
    }
    public function category_images()
    {
        return $this->hasMany('App\Models\CategoryImage', 'category_id');
    }
    //add by aklima
    public static function getCategoriesTrees()
    {
        $categories = Category::where(['status' => '1', 'parent' => 0])->orderBy('sort_order')->get();
        return $categories;
    }
    public static function getSelectedCategoriesTree($productCategories)
    {

        $rsCategories = DB::table('categories')->select('*', 'id as category_id', 'title as category_label')->where('status', '1')->orderBy("parent", "asc")->orderBy("sort_order", 'asc')->get();
        // create the empty array
        $arrayCategories = array();
        // dd($productCategories);
        // $productCategories = $productCategories->category_id;
        // $productCategories = 

        foreach ($rsCategories as $result) {
            $arrayCategories[$result->category_id] = array(
                'category_id'           => $result->category_id,
                'title'                 => $result->title,
                'parent_id'             => $result->parent,
                'order_no'              => $result->sort_order
            );
        }

        // print_r($arrayCategories); exit;
        // put the results inside the array
        // i use the category id as key for the array, and i store the parent_id 
        // and the name of the category in a hash with the keys parent_id and name (of course)  
        /*while($row = mysql_fetch_assoc($rsCategories)){ 
            $arrayCategories[$row['category_id']] = array("parent_id" => $row['parent_id'], "title" => $row['category_label']); 
        }*/

        return self::createSelectedTreeNested($productCategories, $arrayCategories, 0);
    }
    public static function getSelectedPCategoriesTree($planCategories)
    {

        $rsCategories = DB::table('categories')->select('*', 'id as category_id', 'title as category_label')->where('status', '1')->orderBy("parent", "asc")->orderBy("sort_order", 'asc')->get();
        // create the empty array
        $arrayCategories = array();
        // dd($productCategories);
        // $productCategories = $productCategories->category_id;
        // $productCategories = 

        foreach ($rsCategories as $result) {
            $arrayCategories[$result->category_id] = array(
                'category_id'           => $result->category_id,
                'title'                 => $result->title,
                'parent_id'             => $result->parent,
                'order_no'              => $result->sort_order
            );
        }

        // print_r($arrayCategories); exit;
        // put the results inside the array
        // i use the category id as key for the array, and i store the parent_id 
        // and the name of the category in a hash with the keys parent_id and name (of course)  
        /*while($row = mysql_fetch_assoc($rsCategories)){ 
            $arrayCategories[$row['category_id']] = array("parent_id" => $row['parent_id'], "title" => $row['category_label']); 
        }*/

        return self::createSelectedTreeNestedP($planCategories, $arrayCategories, 0);
    }
    public static function createSelectedTreeNestedP($planCategories, $array, $currentParent, $currLevel = 0, $prevLevel = -1, $separator = ' - ')
    {
        // dd($productCategories);

        $html = '';
        // dd($productCategories);
        foreach ($array as $categoryId => $category) {
            // dd($categoryId);


            if ($currentParent == $category['parent_id']) {

                // $selected = (in_array($categoryId,$productCategories)) ? 'selected="selected"' : '';
                if ($categoryId == $planCategories) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                $html .= '<option value="' . $categoryId . '" ' . $selected . '>' . $separator . $category['title'] . '</option>';

                if ($currLevel > $prevLevel) {
                    $prevLevel = $currLevel;
                }

                $currLevel++;

                $html .= self::createSelectedTreeNestedP($planCategories, $array, $categoryId, $currLevel, $prevLevel, '&nbsp;&nbsp;' . $separator . ' - ');

                $currLevel--;
            }
        }
        return $html;
    }
    public static function createSelectedTreeNested($productCategories, $array, $currentParent, $currLevel = 0, $prevLevel = -1, $separator = ' - ')
    {
        // dd($productCategories);

        $html = '';
        // dd($productCategories);
        foreach ($array as $categoryId => $category) {
            // dd($categoryId);


            if ($currentParent == $category['parent_id']) {

                $selected = (in_array($categoryId, $productCategories)) ? 'selected="selected"' : '';

                $html .= '<option value="' . $categoryId . '" ' . $selected . '>' . $separator . $category['title'] . '</option>';

                if ($currLevel > $prevLevel) {
                    $prevLevel = $currLevel;
                }

                $currLevel++;

                $html .= self::createSelectedTreeNested($productCategories, $array, $categoryId, $currLevel, $prevLevel, '&nbsp;&nbsp;' . $separator . ' - ');

                $currLevel--;
            }
        }
        return $html;
    }
    // get tree structure for active categories
    public static function getCategoriesTree()
    {
        $rsCategories = DB::table('categories')->select('*', 'id as category_id', 'title as category_label')->where('status', '1')->orderBy("parent", "asc")->orderBy("sort_order", 'asc')->get();


        // create the empty array 
        $arrayCategories = array();

        foreach ($rsCategories as $result) {
            $arrayCategories[$result->category_id] = array(
                'category_id'           => $result->category_id,
                'title'                 => $result->title,
                'parent_id'             => $result->parent,
                'order_no'              => $result->sort_order
            );
        }

        // print_r($arrayCategories); exit;
        // put the results inside the array
        // i use the category id as key for the array, and i store the parent_id 
        // and the name of the category in a hash with the keys parent_id and name (of course)  
        /*while($row = mysql_fetch_assoc($rsCategories)){ 
            $arrayCategories[$row['category_id']] = array("parent_id" => $row['parent_id'], "title" => $row['category_label']); 
        }*/

        return self::createTreeNested($arrayCategories, 0);
    }
    public static function createTreeNested($array, $currentParent, $currLevel = 0, $prevLevel = -1, $separator = ' - ')
    {
        $html = '';
        foreach ($array as $categoryId => $category) {

            if ($currentParent == $category['parent_id']) {

                $html .= '<option value="' . $categoryId . '">' . $separator . $category['title'] . '</option>';

                if ($currLevel > $prevLevel) {
                    $prevLevel = $currLevel;
                }

                $currLevel++;

                $html .= self::createTreeNested($array, $categoryId, $currLevel, $prevLevel, '&nbsp;&nbsp;' . $separator . ' - ');

                $currLevel--;
            }
        }
        return $html;
    }

    public function getMetaInfoByCatTitle($catTitle, $data_for)
    {
        $pageInfo = Page::select('page_name', 'page_title', 'meta_keyword', 'meta_description', 'meta_status')->where('name', $catTitle)->first();
        if ($data_for == 'meta_status') {
            return $pageInfo->meta_status;
        }
        if ($data_for == 'page_name') {
            return $pageInfo->page_name;
        }
        if ($data_for == 'page_title') {
            return $pageInfo->page_title;
        }
    }
}
