<?php $currentURL = url()->current();
$baseURL= url('/');
$basePath=str_replace($baseURL, '', $currentURL);
$total_price = 0;
$servicePrice = 0;
// dd($cartitems);
?>
@if(strpos($basePath,'ecommerce') !== false)
    @include('frontend.ecommerce')
@elseif(strpos($basePath,'email88') !== false)
    @include('frontend.email88')
@elseif(strpos($basePath,'web88ir') !== false)
    @include('frontend.web88ir')
@else
    @extends('layouts.frontend_layout')
    @section('title','Domains | - Webqom Technologies')
@section('content')
<div class="clearfix"></div>


<div class="page_title1 sty9">
<div class="container">

	<h1>Online Order</h1>

    <div class="pagenation">&nbsp;
        <a href="{{url('/')}}">Home</a> <i>/</i>
        @if(isset($info) && isset($page))
        @if($info != "" && $page != "")
        <a href="{{url('/dashboard')}}">Dashboard</a> <i>/</i>
        <a href="{{url('/my_account')}}">My Domains</a> <i>/</i>
        <a href="{{url('/domain_search_login')}}">Domain Search</a> <i>/</i>
        <a href="{{url('/domain_configuration')}}">Domain Configuration</a>

         <i>/</i>
          @endif
        @endif
        Shopping Cart <!-- <i>/</i>  -->
       <!--  <a href="domain_configuration_hosting.html">Choose a Domain</a> <i>/</i> Review &amp; Checkout -->
    </div>

    <div class="clearfix"></div>
   <!--  note to programmer: breadcrumb is dynamic by the steps user clicks. -->

</div>
</div><!-- end page title -->

<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>

 <div class="one_full stcode_title9">
 	<h1 class="caps"><strong>Shopping Cart</strong></h1>
 </div>

<div class="clearfix"></div>
<?php  ?>
<div class="content_fullwidth">
	<div class="container">
        @if (session('update_status') === False )
            <div class="alert alert-danger alert-dismissable">
               <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
               <i class="fa fa-times-circle"></i> <strong>Error!</strong>
               <p>{{ session('update_message') }}</p>
            </div>
            @endif
        <div class="three_full_less">
        	@if(count($cartitems) <= 0)
            <div class="alertymes4">
                <h3 class="light"><i class="fa fa-warning"></i><strong>Your Shopping Cart is Empty.</strong></h3>
                <div class="clearfix margin_bottom1"></div>
                <a href="/" class="btn btn-danger caps"><i class="fa fa-shopping-cart"></i><b>Continue Shopping</b></a>
           </div><!-- end section -->
           @endif
          <div class="clearfix margin_bottom3"></div>
            <!-- @if(!count($cartitems) > 0)
        	<div class="table-responsive">

                <table class="table table-hover table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Product/Services</th>
                                <th>Cycle</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>

                              <tr>
                                <td colspan="6">No records found.</td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="6"></td>
                              </tr>
                            </tfoot>
                </table>

                <div class="clearfix"></div>
           </div>
            @endif -->
          @if(count($cartitems) > 0 || $server_configuration_details)
           <div class="table-responsive">

                <table class="table table-hover table-striped cart_item_table">
                            <thead>
                              <tr>
                              	<th>#</th>
                                <th>Services</th>
                                <th>Cycle</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($cartitems as  $key => $value)

                              <?php $plan_details = App\Models\Plan::get_plan_details($value['plan_id']); ?>
                              <?php $plan_details = json_decode(json_encode($plan_details)); ?>
                              @if(!empty($plan_details))
                                <?php

                                    $main_price = number_format((float)$plan_details->price_annually+$plan_details->setup_fee_one_time, 2, '.', '');
                                    $domain_price = number_format((float)$value['price'] - ($plan_details->price_annually+$plan_details->setup_fee_one_time), 2, '.', ''); ?>
                                @else

                                <?php $main_price = $value['price']; $domain_price = 0; ?>
                                @endif
                                
                                <tr data-id="{{ isset($value['id']) ? $value['id'] : $value['services'] }}">
                                  <?php
                                  $row_price = $value['price'];
                                  ?>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <div class="pull-left">
                                          @if($value['type'] == 2)
                                          <?php 
                                          $url =  url('/pricelist').'/'.$value['services']; 
                                            $text = '<a href = "'.$url.'" target="_blank">Transfer</a>';
                                           ?>
                                          @else
                                          <?php $text = 'Registration'; ?>
                                          @endif
                                                <!-- <b>Service Code: </b> <span class="sitecolor">DN</span><br/> -->
                                                <b>Domain <?php echo $text; ?>:</b> <span class="sitecolor">{{$value['services']}}</span><br/>
                                                @if(!empty($plan_details))
                                                 <b>Service Code: </b> <span class="sitecolor">{{!empty($plan_details->service_code) ? $plan_details->service_code : ''}}</span><br/>
                                                 <b>Hosting Plan:</b> <span class="sitecolor caps">{{!empty($plan_details->plan_name) ? $plan_details->plan_name : ''}} {{ $page }}</span><br/>
                                                @endif
                                                <?php if(isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null){
                                                    $addons_vl = explode(',', $value['addons']); ?>


                                                <b>Domain Addons:</b>
                                                <ul>


                                                @foreach($addons_vl as $addon)
                                                @foreach($domain_pricings as $dprice)
                                                <?php
                                                if($addon == $dprice->id){
                                                    $row_price += $dprice->price;
                                                ?>
                                                <li><i class="fa icon-arrow-right"></i>{{$dprice->title}} (RM {{number_format(($dprice->price?$dprice->price:'0'), 2)}})</li>
                                               <?php }
                                                ?>

                                                @endforeach
                                                @endforeach
                                                </ul>

                                                <?php } ?>
												                        @if(!empty($plan_details))
                                                  <b>Server Specification:</b>
                                                  <ul>
                            													@php
                            														$featured_plans = App\Models\PlanFeature::where('page', $plan_details->page)->where('status', 1)->get();
                            													@endphp
                                                      @if(!empty($featured_plans) && count($featured_plans)>0)
                                                        @foreach($featured_plans as $i)
                                                          @php
                                                            $details = App\Models\PlanFeatureDetail::where('plan_feature_id', $i->id)->where('plan_id', $value['plan_id'])->first();
                                                          @endphp
                                                          @if ($details)
                                                          <li><i class="fa icon-arrow-right"></i>&nbsp;&nbsp;{{$i->title}}:
                                                            <span data-sel="{{$i->title}}">{{ $details->description }}</span>
                                                          </li>
                                                          @endif
                                                        @endforeach
                                                      @endif
                                                  </ul>
												                    @endif
                                        </div>
                                        <div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>
                                    </td>
                                    <td>
                                      <div class="pull-left">

                                        @if(!empty($plan_details))
                                        <?php if($main_price != $value['price']){  ?>
                                        {{$value['cycle']}} <?php echo "years"; ?> <br/>
                                            <?php echo '1 years'; ?>
                                          
                                        <?php }else{ ?>
                                        <!-- <br/>  -->

                                          {{$value['cycle']}} <?php if($value['cycle'] == 1) echo "year"; else echo "years"; ?> <br/>
                                        <?php } ?>
                                        @else
                                        @if(!empty($value['cycle']))
                                        <?php $cycle = $value['cycle']; ?>
                                        @else
                                        <?php $cycle = 1; ?>
                                        @endif
                                        {{ $cycle }} <?php if($cycle == 1) echo "year"; else echo "years"; ?> <br/>
                                        @endif
                                      </div>
                                      <div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div><br>
                                    </td>
                                    <td>
                                      @if($main_price != $value['price']) 
                                        {{$value['qty']}} <br/> {{$value['qty']}}
                                      @else
                                      {{$value['qty']}}
                                      @endif
                                          <div>
                                            <br/>
                                            <?php if(isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null){
                                                $addons_vl = explode(',', $value['addons']); ?>

                                            <ul>
                                            @foreach($addons_vl as $addon)
                                            @foreach($domain_pricings as $dprice)

                                            <?php if($addon == $dprice->id){ ?>
                                              <li>1</li>
                                            <?php } ?>

                                            @endforeach
                                            @endforeach
                                            </ul>

                                            <?php } ?>
                                         </div>
                                    <!-- <div class="pull-left">1</div>
                                    	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div> -->
                                    </td>
                                    <td>

                                      @if(!empty($plan_details))
                                      <?php 
                                      
                                        $domain_price = number_format((float)$value['price'] - ($plan_details->price_annually+$plan_details->setup_fee_one_time), 2, '.', '');
                                        if($main_price != $value['price']){ ?>
                                          RM {{ $domain_price }} <br>
                                      
                                          RM {{ $main_price }}

                                        <?php }else{
                                       ?>
                                          RM {{ number_format(($value['price']?$value['price']:'0'),2)}} <br>

                                       <?php } ?>
                                     
                                      @else

                                      RM {{ number_format(($value['price']?$value['price']:'0'),2)}} <br>
                                     
                                      @endif
                                        <div>
                                            <br/>
                                            <?php if(isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null){
                                                $addons_vl = explode(',', $value['addons']); ?>

                                            <ul>
                                            @foreach($addons_vl as $addon)
                                            @foreach($domain_pricings as $dprice)

                                            <?php if($addon == $dprice->id){ ?>
                                              <li>RM {{ number_format(($dprice->price?$dprice->price:'0'), 2) }}</li>
                                            <?php } ?>

                                            @endforeach
                                            @endforeach
                                            </ul>

                                            <?php } ?>
                                         </div>
                                    <!-- RM 684.00 --></td>
                                    <td class="alicent"><a href="#" data-hover="tooltip" data-placement="top" title="Remove Item" class="remove_single_item"><i class="fa fa-times red"></i></a></td>
                                  </tr>

                                <?php $total_price += $row_price; ?>
                              @endforeach
{{--                             <tr>--}}
{{--                                <td>2</td>--}}
{{--                                <td><div class="pull-left">--}}
{{--                                        <b>Service Code: </b> <span class="sitecolor">DN</span><br/>--}}
{{--                                        <b>Domain Registration:</b> <span class="sitecolor">webqom.org</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td><div class="pull-left">2 year(s)</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td><div class="pull-left">1</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td>RM 50.00</td>--}}
{{--                                <td class="alicent"><a href="#" data-hover="tooltip" data-placement="top" title="Remove Item"><i class="fa fa-times red"></i></a></td>--}}
{{--                              </tr>--}}
{{--                              <tr>--}}
{{--                                <td>3</td>--}}
{{--                                <td><div class="pull-left">--}}
{{--                                        <b>Service Code: </b> <span class="sitecolor">SHSM-1</span><br/>--}}
{{--                                        <b>Shared Hosting Plan:</b> <span class="sitecolor caps">Small</span><br/>--}}
{{--                                        <b>Domain:</b> <span class="sitecolor">webqom.com</span> <span class="red">(FREE)</span>--}}
{{--                                        <b>Domain Registration Fee:</b> <span class="red">RM 0.00</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td><div class="pull-left">1 year(s)</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td><div class="pull-left">1</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td>RM 194.94</td>--}}
{{--                                <td class="alicent"><a href="#" data-hover="tooltip" data-placement="top" title="Remove Item"><i class="fa fa-times red"></i></a></td>--}}
{{--                              </tr>--}}
{{--                              <tr>--}}
{{--                                <td>4</td>--}}
{{--                                <td><div class="pull-left">--}}
{{--                                        <b>Service Code: </b> <span class="sitecolor">SCL-1</span><br/>--}}
{{--                                        <b>Cloud Hosting Plan:</b> <span class="sitecolor caps">S Cloud</span> <span class="red">(FREE Setup)</span><br/>--}}
{{--                                        <b>Domain:</b> <span class="sitecolor">webqom.net</span><br/>--}}
{{--                                        <b>Setup Fee:</b> <span class="red">RM 0.00</span><br/>--}}
{{--                                        <b>Plan Specification:</b>--}}
{{--                                        <ul>--}}
{{--                                           <li><i class="fa icon-arrow-right"></i> RAM: 1GB</li>--}}
{{--                                           <li><i class="fa icon-arrow-right"></i> Processor: 1 vCPU</li>--}}
{{--                                           <li><i class="fa icon-arrow-right"></i> Fast Disk: 40GB</li>--}}
{{--                                           <li><i class="fa icon-arrow-right"></i> Transfer: 3TB</li>--}}
{{--                                        </ul>--}}
{{--                                     </div>--}}
{{--                                     <div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td><div class="pull-left">1 year(s)</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td><div class="pull-left">1</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td>RM 480.00</td>--}}
{{--                                <td class="alicent"><a href="#" data-hover="tooltip" data-placement="top" title="Remove Item"><i class="fa fa-times red"></i></a></td>--}}
{{--                              </tr>--}}
{{--                              <tr>--}}
{{--                                <td>5</td>--}}
{{--                                <td><div class="pull-left">--}}
{{--                                        <b>Service Code: </b> <span class="sitecolor">VPS28-1-1</span><br/>--}}
{{--                                        <b>VPS Hosting Plan:</b> <span class="sitecolor caps">Linux Basic</span><br/>--}}
{{--                                        <b>Domain:</b> <span class="sitecolor">webqom.info</span><br/>--}}
{{--                                        <b>Plan Specification:</b>--}}
{{--                                            <ul>--}}
{{--                                                <li><i class="fa icon-arrow-right"></i> RAM: 1GB</li>--}}
{{--                                                <li><i class="fa icon-arrow-right"></i> Processor: 1 vCPU</li>--}}
{{--                                                <li><i class="fa icon-arrow-right"></i> Disk Space: 28GB</li>--}}
{{--                                                <li><i class="fa icon-arrow-right"></i> Bandwidth: 1Mbps</li>--}}
{{--                                            </ul>--}}
{{--                                     </div>--}}
{{--                                     <div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td><div class="pull-left">1 year(s)</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td><div class="pull-left">1</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td>RM 831.60</td>--}}
{{--                                <td class="alicent"><a href="#" data-hover="tooltip" data-placement="top" title="Remove Item"><i class="fa fa-times red"></i></a></td>--}}
{{--                              </tr>--}}
                              @if(!is_null($server_configuration_details) && isset($server_configuration_details->dedicated_service_code))
                              <tr>
                                <td>6</td>
                                <td><div class="pull-left">
                                		<b>Service Code: </b> <span class="sitecolor">{{$server_configuration_details->dedicated_service_code}}</span><br/>
                                    	<b>Dedicated Server Plan:</b> <span class="sitecolor caps">{{$server_configuration_details->dedicated_server_plan}}</span>
{{--                                        <span class="red">(FREE Setup)</span>--}}
{{--                                        <br/>--}}
                                            <b>Domain:</b> <span class="sitecolor">{{$domain}}</span><br/>
                                            <b>Setup Fee:</b> <span class="red">RM {{$server_configuration_details->initial_setup_price}}</span><br/>
                                            <b>Server Configuration:</b>
                                            <ul>
                                                <li><i class="fa icon-arrow-right"></i> CPU: 1 x 4-cores Intel Xeon</li>
                                                <li><i class="fa icon-arrow-right"></i> No. of Processors: {{$server_configuration_details->Processors}} processor</li>
                                                <li><i class="fa icon-arrow-right"></i> RAM: {{$server_configuration_details->RAM}}GB</li>
{{--                                                <li><i class="fa icon-arrow-right"></i> Hard Disk: 2 x 1TB SATA</li>--}}
{{--                                                <li><i class="fa icon-arrow-right"></i> No. of IP addresses (IPv4): 1 x IPv4 Address</li>--}}
{{--                                                <li><i class="fa icon-arrow-right"></i> Bandwidth: 10Mbps</li>--}}
                                                <li><i class="fa icon-arrow-right"></i> Control Panel: {{$server_configuration_details->Control_Panel}}</li>
{{--                                                <li><i class="fa icon-arrow-right"></i> Fully Managed Server: Optional</li>--}}
                                            </ul>
                                      </div>
                                      <div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>
                                </td>
                                <td><div class="pull-left">1 year(s)</div>
                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>
                                </td>
                                <td><div class="pull-left">1</div>
                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>
                                </td>
                                <td>RM {{$server_configuration_details->sub_total}}</td>
                                <td class="alicent"><a href="#" data-hover="tooltip" data-placement="top" title="Remove Item"><i class="fa fa-times red"></i></a></td>
                              </tr>
                              @endif
{{--                              <tr>--}}
{{--                                <td>7</td>--}}
{{--                                <td><div class="pull-left">--}}
{{--                                        <b>Service Code: </b> <span class="sitecolor">CO2U-1</span><br/>--}}
{{--                                        <b>Co-location Hosting Plan:</b> <span class="sitecolor caps">2U</span> <span class="red">(FREE Setup)</span><br/>--}}
{{--                                        <b>Domain:</b> <span class="sitecolor">webqom.limited</span><br/>--}}
{{--                                        <b>Setup Fee:</b> <span class="red">RM 0.00</span><br/>--}}
{{--                                        <b>Server Configuration:</b>--}}
{{--                                            <ul>--}}
{{--                                                <li><i class="fa icon-arrow-right"></i> Rack Space: Quarter Rack</li>--}}
{{--                                                <li><i class="fa icon-arrow-right"></i> Bandwidth: 10Mbps</li>--}}
{{--                                                <li><i class="fa icon-arrow-right"></i> Power Port: 1 Port</li>--}}
{{--                                                <li><i class="fa icon-arrow-right"></i> Wan Port: 1 Port</li>--}}
{{--                                                <li><i class="fa icon-arrow-right"></i> No. of IP Addresses: 1</li>--}}
{{--                                            </ul>--}}
{{--                                     </div>--}}
{{--                                     <div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td><div class="pull-left">1 year(s)</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td><div class="pull-left">1</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td>RM 4,500.00</td>--}}
{{--                                <td class="alicent"><a href="#" data-hover="tooltip" data-placement="top" title="Remove Item"><i class="fa fa-times red"></i></a></td>--}}
{{--                              </tr>--}}
{{--                              <tr>--}}
{{--                                <td>8</td>--}}
{{--                                <td><div class="pull-left">--}}
{{--                                		<b>Responsive Web Design Plan:</b> <span class="sitecolor caps">Basic</span><br/>--}}
{{--                                    	<b>Domain:</b> <span class="sitecolor">webqom.limited</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td>-</td>--}}
{{--                                <td><div class="pull-left">1</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td>RM 1,990.00</td>--}}
{{--                              </tr>--}}
{{--                              <tr>--}}
{{--                                <td>9</td>--}}
{{--                                <td><div class="pull-left">--}}
{{--                                		<b>Service Code: </b> <span class="sitecolor">EC-200-1</span><br/>--}}
{{--                                    	<b>E-commerce Plan:</b> <span class="sitecolor caps">200</span><br/>--}}
{{--                                        <b>Domain:</b> <span class="sitecolor">webqom.limited</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td>-</td>--}}
{{--                                <td><div class="pull-left">1</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td>RM 9,900.00</td>--}}
{{--                                <td class="alicent"><a href="#" data-hover="tooltip" data-placement="top" title="Remove Item"><i class="fa fa-times red"></i></a></td>--}}
{{--                              </tr>--}}
{{--                              <tr>--}}
{{--                                <td>10</td>--}}
{{--                                <td><div class="pull-left">--}}
{{--                                		<b>Service Code: </b> <span class="sitecolor">E88B1-10k-1</span><br/>--}}
{{--                                    	<b>Email88 Plan:</b> <span class="sitecolor caps">Booster I</span><br/>--}}
{{--                                        <b>Domain:</b> <span class="sitecolor">webqom.limited</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td><div class="pull-left">1 year(s)</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td><div class="pull-left">1</div>--}}
{{--                                	<div class="pull-right"><a href="#" data-hover="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil sitecolor"></i></a></div>--}}
{{--                                </td>--}}
{{--                                <td>RM 1,188.00</td>--}}
{{--                                <td class="alicent"><a href="#" data-hover="tooltip" data-placement="top" title="Remove Item"><i class="fa fa-times red"></i></a></td>--}}
{{--                              </tr>--}}

                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="6" class="aliright">
                                    <a href="#" class="btn btn-sm btn-default caps empty_cart"><i class="fa fa-trash"></i> <b>Empty Cart</b></a>

                                </td>
                              </tr>
                            </tfoot>
                </table>

                <div class="clearfix"></div>

          </div><!-- end table responsive -->
          @endif

          @if(count($cartitems) > 0)
          <div class="one_half_less">
          	 <div class="alertymes7">
                 <h4>Apply Promo Code</h4>
                 <div class="cforms alileft">
                     <div id="form_status"></div>
        			 <form type="POST" id="gsr-contact" onSubmit="return valid_datas( this );">
                         <input type="text" id="promocode" name="promocode" placeholder="Enter promo code if you have one...">
                         <a href="#" class="btn btn-sm btn-info caps"><i class="fa fa-trash"></i> <b>Validate Code</b></a>
                     </form>
                 </div>
			 </div>
          </div><!-- end one half less -->

          <div class="one_half_less last">
          	 <div class="alertymes7">
                 <h2 class="aliright">Order Summary</h2>
                 <div class="pull-left caps"><b>Subtotal</b></div>
                 <div class="pull-right"><b>RM {{number_format(($total_price?$total_price:'0'), 2)}}</b></div>
                 <div class="clearfix"></div>
                 <!-- <div class="pull-left caps red"><b>Discount (Promo Code: Test123)</b></div>
                 <div class="pull-right red"><b>- RM 0.00</b></div> -->
                 <div class="clearfix"></div>
                 <div class="pull-left caps"><b>GST (6%)</b></div>
                 <div class="pull-right"><b>RM 0.00</b></div>
                 <div class="divider_line"></div>
                 <div class="clearfix margin_bottom2"></div>
                 <h2 class="red aliright" style="margin-bottom: 0px;"><b>RM {{number_format(($total_price?$total_price:'0'), 2)}}</b></h2><span class="pull-right red caps aliright">Total</span>
                 <div class="clearfix margin_bottom2"></div>
                 <a href="#" class="btn btn-default caps pull-left"><i class="fa fa-shopping-cart"></i> <b>Continue Shopping</b></a>

                 {!! Form::open(['route' => 'frontend.checkout_login']) !!}

                 <input type="hidden" name="total_price" value="{{$total_price}}">

                    <!-- <div class="form-group">
                        {!! Form::label('name', 'Your Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'E-mail Address') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::textarea('msg', null, ['class' => 'form-control']) !!}
                    </div>
 -->
                    {{ Form::button('<i class="fa fa-lg fa-arrow-circle-right"></i> <b>Checkout</b>', ['type' => 'submit', 'class' => 'btn btn-lg btn-danger caps pull-right'] )  }}

                {!! Form::close() !!}

			 </div>
          </div><!-- end one half less last -->
          @endif
           note to programmer: to access "Checkout" page require client login, please prompt for login for existing customer or prompt for signup for new customer/first time customer.



        </div><!-- end section -->



    </div>
</div><!-- end content fullwidth -->

<div class="clearfix"></div>
<div class="divider_line"></div>

<div class="clearfix"></div>


<a href="#" class="scrollup">Scroll</a><!-- end scroll to top of the page-->


<!-- ######### JS FILES ######### -->
<!-- get jQuery used for the theme -->
<!-- <script type="text/javascript" src="js/universal/jquery.js"></script>
<script src="js/animations/js/animations.min.js" type="text/javascript"></script>
<script src="js/mainmenu/bootstrap.min.js"></script>
<script src="js/mainmenu/customeUI.js"></script>
<script src="js/masterslider/jquery.easing.min.js"></script>

<script src="js/scrolltotop/totop.js" type="text/javascript"></script>
<script type="text/javascript" src="js/mainmenu/sticky.js"></script>
<script type="text/javascript" src="js/mainmenu/modernizr.custom.75180.js"></script>
<script type="text/javascript" src="js/cubeportfolio/jquery.cubeportfolio.min.js"></script>
<script type="text/javascript" src="js/cubeportfolio/main.js"></script>


<script src="js/aninum/jquery.animateNumber.min.js"></script>
<script src="js/carouselowl/owl.carousel.js"></script>

<script type="text/javascript" src="js/accordion/jquery.accordion.js"></script>
<script type="text/javascript" src="js/accordion/custom.js"></script>
<script type="text/javascript" src="js/cform/form-validate.js"></script>
<script type="text/javascript" src="js/universal/custom.js"></script>

<script src="js/sidemenu/menuFullpage.min.js"></script> -->
@section('custom_scripts')
<script>
	//smoothScroll.init();
	$(document).ready(function() {
			//$('.menu-link').menuFullpage();
        $(document).on('click', '.empty_cart', function(event) {
            event.preventDefault();
            var pdpArr = [];
            $('.cart_item_table tbody tr').each(function() {
                pdpArr.push($(this).data('id'));
            });

            if(pdpArr.length > 0){
                    $.ajax({
                        url: base_url+'/empty_cart',
                        type: 'POST',
                        data:{'_token':csrf_token, 'ids': pdpArr}

                    })
                    .done(function(response) {
                        console.log(response);
                        if(response.success == true){
                            toastr.success(response.errors.message, 'Success');
                            location.reload();
                        }else{
                            toastr.success(response.errors.message, 'Error');
                        }
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });
            }
        });

        $(document).on('click', '.remove_single_item', function(event) {
            event.preventDefault();
            var pdpArr = $(this).parent().parent('tr').data('id');

                    $.ajax({
                        url: base_url+'/empty_cart',
                        type: 'POST',
                        data:{'_token':csrf_token, 'id': pdpArr}

                    })
                    .done(function(response) {
                        console.log(response);
                        if(response.success == true){
                            toastr.success(response.errors.message, 'Success');
                            location.reload();
                        }else{
                            toastr.success(response.errors.message, 'Error');
                        }
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });
        });

	});
</script>
@endsection
@endsection
@endif
