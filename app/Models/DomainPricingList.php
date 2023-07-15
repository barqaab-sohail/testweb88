<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainPricingList extends Model
{
  protected $fillable = ['status', 'domain_pricing_id', 'type', 'country', 'tld', 'epp_code', 'addons', 'pricing'];

  public function domain(){
    return $this->hasOne('App\Models\DomainPricing', 'domain_pricing_id');
  }

  public static function getPricingList($extension) {
    $pricing_list = self::where('type', 'new')
                        ->where(function ($query) use ($extension)
                          {
                            $query->where('tld', $extension);
                            $query->orWhere('tld', '.' . $extension);
                          })
                        ->first();

    if (empty($pricing_list))
    {
      return [];
    }

    return json_decode($pricing_list->pricing, true);
  }

  public static function getPricingListOptions($extension, array $default = [])
  {
    $pricing_list = self::getPricingList($extension);

    return self::pricingListToOptionsArray($pricing_list, $default);
  }

  public static function pricingListToOptionsArray($pricing_list_array, array $default = [])
  {
    $price_options = $default;

    foreach ($pricing_list_array as $price_index => $price_data)
    {
      $plan_cycle = $price_index;
      $plan_price = $price_data['s'];

      $value = $plan_cycle . '|' . $plan_price;

      $price_options[$value] = $plan_cycle . ' year(s) @ RM ' . $plan_price;
    }

    return $price_options;
  }

  public static function getPricingListBulk($target_domains)
  {
    $domain_pricing_list = [];

    foreach ($target_domains as $domain)
    {
      $domain_component = explode('.', $domain);
      $raw_pricing_list = self::getPricingList($domain_component[1]);

      $domain_pricing_list[$domain] = self::pricingListToOptionsArray($raw_pricing_list);
    }

    return $domain_pricing_list;
  }
}
