<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DomainPricing;
use App\Models\DomainPricingList;
use App\Models\PlanFeature;
use DB;

class Plan extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */


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
  protected $fillable = ['name_line1', 'name_line2', 'status', 'url'];


  public function  planFeatureDetails()
  {
    return $this->hasMany('App\Models\PlanFeatureDetail')->where('status', 1);
  }

  public function planFeatureTitle($featureId)
  {
    $planFeature = PlanFeature::find($featureId);
    if ($planFeature) {
      return  $planFeature->title;
    } else {
      return  'N/A';
    }
  }


  public function services_free_domain()
  {
    return $this->hasOne('App\Models\ServicesFreeDomain', 'plan_id');
  }

  public function featured_plans()
  {
    return $this->hasMany('App\Models\PlanFeature', 'plan_id');
  }
  public function order_items()
  {
    return $this->hasMany('App\Models\OrderItem', 'plan_id');
  }
  public static function get_plan_details($id)
  {
    if ($id) {
      return self::where('id', $id)->first()->toArray();
    } else {
      return false;
    }
  }
  public static function getService($domain, $year = 1)
  {
    $bulk = trim($domain);
    $bulk = str_replace("www.", "", $bulk);
    $domianExt = explode(".", $bulk, 2);

    $data =  DB::table('domain_pricing_lists')->select('pricing')->where('tld', $domianExt[1])->first();
    $pricing_list = json_decode($data->pricing);

    foreach ($pricing_list as $key => $price) {

      if ($key == $year) {
        $year_data = $key . '-' . $price->s;
      }
    }
    return $year_data;
  }
  public function getTldsAttribute()
  {
    $tlds = unserialize($this->services_free_domain->tlds);
    return DomainPricing::whereIn('id', $tlds)->get()->implode('title', ', ');
  }

  public function getDomainNames()
  {
    $tlds = unserialize($this->services_free_domain->tlds);
    $ids = DomainPricing::whereIn('id', $tlds)->get()->pluck('id');
    return DomainPricingList::whereIn('domain_pricing_id', $ids)->get()->implode('tld', ' / ');
  }
  public function getPlan()
  {
    $plan = self::where('status', '1')->get();
    return $plan;
  }
  public function category()
  {
    return $this->belongsTo('App\Models\Category', 'category');
  }
  public function getPromocodeCategories($id)
  {
    return DB::table('promocodes_to_category as ptc')->select('ptc.*', 'c.title')->leftjoin('categories as c', 'c.id', '=', 'ptc.category_id')->where('ptc.promocode_id', $id)->get();
  }

  public static function getPomocodebyPlan($id)
  {
    return DB::table('promocodes as ptp')->select('ptp.*')
      ->leftjoin('promocodes_to_product as p', 'p.product_id', '=', 'ptp.id')
      ->where('ptp.start_date', '<=', date('Y-m-d'))
      ->where('ptp.end_date', '>=', date('Y-m-d'))
      ->where('ptp.status', '=', '1')
      ->where('p.product_id', $id)
      ->get()->toArray();
  }
  public static function getDiscountByPlan($id)
  {
    return DB::table('global_discounts as ptp')->select('ptp.*')->leftjoin('global_discounts_to_products as p', 'p.product_id', '=', 'p.id')->where('p.product_id', $id)->get();
  }
  public static function getPomocodebycategory($id)
  {
    $today = \Carbon\Carbon::now()->format('Y-m-d');
    $result = DB::table('promocodes as p')
      ->select('p.*')
      ->leftJoin('promocodes_to_category as pc', 'p.id', '=', 'pc.promocode_id')
      ->where('p.status', '1')
      ->whereDate('end_date', '>=', $today)
      ->where('pc.category_id', $id)
      ->first();
    return $result;
  }
  public static function getDiscountByCategory($id)
  {
    $today = \Carbon\Carbon::now()->format('Y-m-d');
    $result = DB::table('global_discounts as p')
      ->select('p.*')
      ->leftJoin('global_discounts_to_category as pc', 'p.id', '=', 'pc.global_discount_id')
      ->where('p.status', '1')
      ->where('pc.category_id', $id)
      ->first();
    return $result;
  }
  public function categoryProducts($category_id)
  {
    $result = DB::table('plans as p')
      ->select(
        'p.*',
        'c.sort_order'
      )->leftJoin('categories as c', 'p.category', '=', 'c.id')
      ->where('p.status', '1')
      ->where('c.parent', $category_id)
      ->orWhere('c.id', $category_id)
      ->latest()->get();

    // print_r(DB::getQueryLog());exit;
    $new_res = [];
    foreach ($result as $key => $item) {

      $item->price = $item->price_annually + $item->setup_fee_one_time;
      $item->quantity = 1;
      $new_res[] = $item;
    }

    if (count($new_res) > 0)
      return $new_res;
  }
}
