<?php $currentURL = url()->current();
$baseURL= url('/');
$basePath=str_replace($baseURL, '', $currentURL);
$total_price = 0;
$price_id = $tldExist['id'];
$item = App\Models\DomainPricing::findOrFail($tldExist['domain_pricing_id']);
$items = App\Models\DomainPricingList::where('id', $price_id)->where('domain_pricing_id', $item->id)->get();

?>
    <link rel="stylesheet" href="{{url('').'/resources/assets/frontend/'}}css/style.css" type="text/css" />

<link href="{{url('').'/resources/assets/frontend/'}}js/mainmenu/bootstrap.min.css" rel="stylesheet">

<div class="content_fullwidth">
	<div class="container">
        <div class="three_full_less">
          <table class="table table-hover table-striped">
            <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th colspan="10"><div class="alicent">Per Year Pricing (RM)</div></th>
              
              <th></th>
            </tr>
            <tr>
              <th width="1%"></th>
              <th>#</th>
              <th>TLD</th>
              <th>1 Year</th>
              <th>2 Years</th>
              <th>3 Years</th>
              <th>4 Years</th>
              <th>5 Years</th>
              <th>6 Years</th>
              <th>7 Years</th>
              <th>8 Years</th>
              <th>9 Years</th>
              <th>10 Years</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>

                  @if(!isset($items))
                  not ok
                  @endif
                  @foreach ($items as $i)
                  <tr id="clienttbl_row_{{$i->id}}" class="odd gradeX">
                    <td><input name="id[]" value="{{$i->id}}" type="checkbox" class="checkboxes"/></td>
                      <td>{{ $i->id }}</td>
                      <td>{{ $i->tld }}</td>
                      @php
                        $prices = (array)json_decode($i->pricing, true);
                      @endphp
                      @foreach ($prices as $p)
                        <td>
                          <span class="text-red">{{ $p['s'] }}</span>
                          <br>
                          <span class="strike">{{ $p['l'] }}</span>
                        </td>
                      @endforeach
                      <td>
                        @if ($i->status)
                          <span class="label label-xs label-success">Active</span>
                        @else
                          <span class="label label-xs label-danger">Inactive</span>
                        @endif
                      </td>
                    </tr>
                  @endforeach
            </tbody>
          </table>
        </div><!-- end section -->

    </div>
</div><!-- end content fullwidth -->

