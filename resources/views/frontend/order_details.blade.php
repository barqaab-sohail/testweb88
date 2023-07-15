<?php $currentURL = url()->current();
$baseURL = url('/');
$basePath = str_replace($baseURL, '', $currentURL);
$total_price = 0;
$discount_price = 0.0;
?>
@extends('layouts.frontend_layout')
@section('title', 'Order Details | Webqom Technologies')
@section('content')
@section('page_header', 'Services')


<!-- end page title -->
<div class="clearfix">
    <div class="page_title1 sty9">
        <div class="container">
            <h1>Orders</h1>
            <div class="pagenation">&nbsp;<a href="{{ url('/') }}">Home</a> <i>/</i> <a href="{{ url('/client_area_home') }}">Dashboard</a> <i>/</i> Orders <i>/</i> My Order History
                <i>/</i> Order Details
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>

<div class="one_full stcode_title9">
    <h1 class="caps"><strong>Order Details </strong> </h1>
</div>

<div class="clearfix"></div>


<div class="content_fullwidth">

    <div class="container">
        @include('layouts.frontend_menu_login')
        <div class="three_fourth_less last">

            <div class="three_fourth_less last">

                <div class="text-18px dark light">Below you can view your order details &amp; track your order.</div>
                <div class="clearfix margin_bottom1"></div>

                <div class="one_third_less">
                    <h4>Receipt #: </h4>
                    <div class="text-16px red light"><a href="#" target="_blank">
                            @if ($orderDetails->status == 'COMPLETED')
                            {{ $orderDetails->id }}
                            @else
                            --
                            @endif
                        </a></div>
                    <h4>Invoice #:</h4>
                    <div class="text-16px red light"><a href="#" target="_blank">MY-{{ $orderDetails->transaction_id }}</a></div>
                    <div class="margin_bottom1"></div>





                </div><!-- end one third less -->

                <div class="one_third_less">
                    <h4>Order Date: </h4>
                    <div class="text-16px dark light">{{ date('jS M Y', strtotime($orderDetails->created_at)) }}</div>
                    <div class="margin_bottom1"></div>
                    <h4>Status:</h4>
                    <div class="text-16px">
                        @if ($orderDetails->status == 'COMPLETED')
                        <span class="label label-success caps">Paid</span>
                        @elseif($orderDetails->status == 'INCOMPLETE')
                        <span class="label label-warning caps">Unpaid</span>
                        @else
                        <span class="label label-danger caps">Payment Failed</span>
                        @endif
                    </div>


                </div><!-- end one third less -->

                <div class="one_third_less last">
                    <h4>Total: </h4>
                    <div class="text-16px light red" id="grand_total"></div>
                    <div class="margin_bottom1"></div>
                    <h4>Payment Method: </h4>
                    <div class="text-16px dark light">
                        @if ($orderDetails->payment_method)
                        {{ $orderDetails->payment_method->name }}
                        @else
                        {{ 'Not Specific' }}
                        @endif
                    </div>


                </div><!-- end one third less last -->
            </div>
            <div>
                <div class="clearfix divider_line7"></div>
                <div class="clearfix"></div>


                <h4>Your Order Details</h4>
                <div class="table-responsive">

                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th><span class="pull-left">#</span> <a href="#sort by #" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                                <th width="30%"><span class="pull-left">Services</span> <a href="#sort by services" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                                <th><span class="pull-left">Cycle</span> <a href="#sort by cycle" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                                <th><span class="pull-left">Qty</span></th>
                                <th style="text-align:center"><span class="">Price</span> <a href="#sort by price" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $main_price = 0;
                            $domain_price = 0; ?>
                          
                            @foreach ($orderDetails->orderItems as $key => $value)
                            
                            @if (!empty($value->plan))
                            <?php
                            $main_price = ($value['price'] * $value['cycle']) + $value['domain_price'];
                            $domain_price = $value['domain_price'] * $value['domain_cycle'];
                            $discount = $orderDetails->discount;
                            ?>
                            @else
                            @php
                            $main_price = $value->price;
                            $domain_price = 0;
                            $discount = 0.0;
                            @endphp
                            @endif
                            <?php
                            // if ($value['price'] != '') {
                            //     $row_price = ($value['price'] * $value['cycle']) + ($value['domain_price'] * $value['domain_cycle']);
                            // } else {
                            //     $row_price = 0.0;
                            // }
                            if (empty($value->plan)) {
                                $cycle = 1;
                            } else {
                                $cycle = $value['cycle'];
                            }
                            if (empty(@$value['domain_price'])) {
                                $row_price = $value['price'] * $value['qty'];
                            } else {
                                $row_price = ($value['price'] * $value['qty']) + $domain_price;
                            }
                            ?>
                            @if ($value->type == 2)
                            <?php $text = 'Transfer'; ?>
                            @else
                            <?php $text = 'Registration'; ?>
                            @endif
                            <tr data-id="{{ isset($value['id']) ? $value['id'] : $value['services'] }}">
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div class="pull-left">
                                        <!-- <b>Service Code: </b> <span class="sitecolor">DN</span><br/> -->
                                        @if (!empty($value->plan))
                                        <b>Service Code: </b> <span class="sitecolor">{{ !empty($value->plan->service_code) ? $value->plan->service_code : '' }}</span><br />
                                        <b>Hosting Plan:</b> <span class="sitecolor caps">{{ !empty($value->plan->plan_name) ? $value->plan->plan_name : '' }}</span><br />
                                        @php
                                        $total_break = 2;
                                        $featured_plans = App\Models\PlanFeature::where('page', $value->plan->page)
                                        ->where('status', 1)
                                        ->get();
                                        @endphp
                                        @if (!empty($featured_plans) && count($featured_plans) > 0 && count($value->plan) > 0)
                                        <b>Server Specification:</b>
                                        <ul style="margin-bottom:1px">
                                            @foreach ($featured_plans as $i)
                                            @php
                                            $details = App\Models\PlanFeatureDetail::where('plan_feature_id', $i->id)
                                            ->where('plan_id', $value->plan->id)
                                            ->first();
                                            @endphp
                                            @if ($details)
                                            <?php $total_break++; ?>
                                            <li><i class="fa icon-arrow-right"></i>&nbsp;&nbsp;{{ $i->title }}:
                                                <span data-sel="{{ $i->title }}">{{ $details->description }}</span>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                        @endif
                                        @endif
                                        <?php if (isset($value->addons) && $value->addons != "" && $value->addons != null) {
                                            $addons_vl = explode(',', $value->addons); ?>
                                            <b>Domain Addons:</b>
                                            <ul style="margin-bottom:0">
                                                <?php $d_ad = 1; ?>
                                                @foreach ($addons_vl as $addon)
                                                @foreach ($domain_pricings as $dprice)
                                                <?php
                                                $addon = str_replace("\"", "", $addon);
                                                if ($addon == $dprice->id) {
                                                    $row_price += $dprice->price;
                                                    $d_ad++;
                                                ?>
                                                    <li><i class="fa icon-arrow-right"></i> {{ $dprice->title }}
                                                        (RM
                                                        {{ number_format($dprice->price, 2) }})
                                                    </li>
                                                <?php }
                                                ?>
                                                @endforeach
                                                @endforeach
                                            </ul>
                                        <?php } ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="pull-left">
                                        @if (!empty($value['cycle']))
                                        <?php $cycle = $value['cycle']; ?>
                                        @else
                                        <?php $cycle = 1; ?>
                                        @endif
                                        @if (!empty($value->plan))
                                        @if ($main_price != $value['price'])
                                        <?php
                                        echo $cycle;
                                        if ($cycle == 1) {
                                            echo ' Year';
                                        } else {
                                            echo ' Years';
                                        }
                                        echo '<br/>';
                                        $domain_year = $value['domain_cycle'];
                                        ?>
                                        @else
                                        {{ $cycle }} <?php if ($cycle == 1) {
                                                            echo 'year';
                                                        } else {
                                                            echo 'years';
                                                        } ?> <br />
                                        <?php $domain_year = ''; ?>
                                        @endif
                                        <?php for ($t = 1; $t <= $total_break; $t++) {
                                            echo '<br/>';
                                        } ?>
                                        @else
                                        <?php
                                        $domain_year = $value['domain_cycle'];
                                        ?>

                                        @endif
                                        <?php if (isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null) { ?>

                                            <?php for ($dad = 1; $dad <= $d_ad; $dad++) {
                                                echo '<br/>';
                                            }
                                            ?>
                                        <?php } ?>

                                    </div>
                                </td>
                                <td>
                                    @if (!empty($value->plan))
                                    @if ($main_price != $value['price'])
                                    {{ $value['qty'] }} <br />
                                    <?php $domain_qty = $value['qty']; ?>
                                    @else
                                    {{ $value['qty'] }}
                                    <?php $domain_qty = ''; ?>
                                    @endif
                                    <?php for ($t = 1; $t <= $total_break; $t++) {
                                        echo '<br/>';
                                    } ?>
                                    @else
                                    <?php $domain_qty = $value['qty']; ?>
                                    @endif
                                    <div>
                                        <?php
                                        if (isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null) {
                                            $addons_vl = explode(',', $value['addons']);
                                        ?>
                                            <br>
                                            <ul style="margin-bottom:0">
                                                @foreach ($addons_vl as $addon)
                                                @foreach ($domain_pricings as $dprice)
                                                <?php $addon = str_replace("\"", "", $addon);
                                                if ($addon == $dprice->id) { ?>
                                                    <li>1</li>
                                                <?php } ?>
                                                @endforeach
                                                @endforeach
                                            </ul>

                                        <?php } ?>

                                    </div>

                                </td>
                                <td>
                                    @if (!empty($value->plan))
                                    <?php
                                    if ($main_price != $value['price']) { ?>
                                        RM {{ number_format($value['price'] , 2) }} <br>
                                        <?php $d_price = $domain_price; ?>

                                    <?php } else { ?>
                                        RM {{ number_format($value['price'] ? $value['price'] : '0', 2) }} <br>
                                        <?php $d_price = ''; ?>
                                    <?php } ?>
                                    <?php for ($d = 1; $d <= $total_break; $d++) {
                                        echo '<br/>';
                                    } ?>
                                    @else
                                    <?php $d_price = number_format($value['price'] ? $value['price'] : '0', 2); ?>
                                    @endif

                                    <div>
                                        <?php
                                        if (isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null) {
                                            $addons_vl = explode(',', $value['addons']);
                                        ?>
                                            <br>
                                            <ul style="margin-bottom:0">
                                                @foreach ($addons_vl as $addon)
                                                @foreach ($domain_pricings as $dprice)
                                                <?php $addon = str_replace("\"", "", $addon);
                                                if ($addon == $dprice->id) { ?>
                                                    <li>RM {{ number_format($dprice->price, 2) }}</li>
                                                <?php } ?>
                                                @endforeach
                                                @endforeach
                                            </ul>
                                        <?php } ?>
                                    </div>
                                    @if ($value['type'] == 2)
                                    <a href="{{ route('price_list', $value['services']) }}" target="_blank">RM
                                        {{ number_format($value['price'] ? $value['price'] : '0', 2) }}</a>
                                    <br>
                                    @endif
                                    <!-- RM 684.00 -->
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <div class="pull-left">
                                        <b>Domain {{ $text }}:</b> <span class="sitecolor">{{ $value['services'] }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if (!empty($domain_year))
                                    <div class="pull-left">
                                        <?php echo $domain_year;
                                        if ($domain_year == 1) {
                                            echo ' Year';
                                        } else {
                                            echo ' Years';
                                        }
                                        ?>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($domain_year))
                                    {{$domain_qty}}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($domain_year))
                                    RM {{ number_format((float) $d_price, 2) }}
                                    @endif
                                </td>
                            </tr>

                            <?php

                            $total_price += $row_price;
                            $discount_price += $discount;
                            ?>
                            @endforeach
                            <?php
                            $grand_total = $total_price -  (float)$orderDetails->discount;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7"></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="clearfix"></div>
                </div>
                <!-- end table responsive -->

                <div class="one_half_less">
                    <a href="{{ url('order_history_list') }}" class="btn btn-default caps pull-left"><i class="fa icon-action-undo"></i> <b>Back</b></a>
                </div><!-- one half less -->


                <div class="one_half_less last">
                    <div class="alertymes7">
                        <div class="pull-left caps"><b>Subtotal</b></div>
                        <div class="pull-right"><b>RM {{ number_format($total_price, 2) }}</b></div>
                        <div class="clearfix"></div>
                        <div class="pull-left caps red"><b>Discount</b></div>
                        <div class="pull-right red"><b>- RM {{ number_format( $orderDetails->discount, 2) }}</b></div>
                        <div class="clearfix"></div>
                        @if(!empty($orderDetails['gst_rate']) && $orderDetails['gst_rate'] != "0.00")
                        <?php $grand_total += $orderDetails['gst_rate']; ?>
                        <div class="pull-left caps"><b>GST ({{ $gstRate['rate'] }}%)</b></div>
                        <div class="pull-right"><b>RM {{$orderDetails['gst_rate']}}</b></div>
                        @endif
                        <div class="divider_line"></div>
                        <div class="clearfix margin_bottom2"></div>
                        <h2 class="red aliright" style="margin-bottom: 0px;"><b id="last_total">RM
                                {{ number_format($grand_total, 2) }}</b></h2><span class="pull-right red caps aliright">Total</span>
                        <div class="clearfix margin_bottom2"></div>
                        @if ($orderDetails->status == 'COMPLETED')
                        <a href="{{ url('downloadReceipt' . '/' . $orderDetails->id) }}" class="btn btn-primary caps pull-left" target="_blank">Download Receipt</a>
                        @endif

                    </div>
                </div><!-- end one half less last -->


            </div><!-- end section -->


        </div><!-- end section -->




    </div>
    <!-- end container -->


    <div class="clearfix"></div>


</div><!-- end content full width -->

<div class="clearfix"></div>
@section('custom_scripts')
<script>
    $(document).ready(function() {
        var total = $("#last_total").text();
        $("#grand_total").text(total);
    });
</script>
@endsection
@endsection