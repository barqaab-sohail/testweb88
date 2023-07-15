<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Receipt #: {{ $orderDetails->id }}</title>

    <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link
        href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ $style }}" type="text/css" />
    <style type="text/css">
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        body {
            position: relative;
            width: 21cm;
            margin: auto;
            line-height: 9px;
            font-family: 'Open Sans', sans-serif;
            font-weight: normal;
            color: #000;
        }

        html,
        body {
            font-family: 'Open Sans', sans-serif;
            color: #000;
            font-weight: 500;
        }


        table {
            max-width: 100%;
            background-color: transparent;
            /*width: 100%;*/
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 0px;
        }

        th {
            text-align: left;
            font-size: 11px;
        }

        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tfoot>tr>th,
        .table>thead>tr>td {
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
            /*color: #403e3d;*/
            font-size: 10px;
        }

        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            padding: 5px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
            /*color: #403e3d;*/
        }

        .table>thead>tr>th {
            vertical-align: bottom;
            /*border-bottom: 5px solid #006699;*/
            padding: 8px;
            color: #fff;
            background: #343844;
        }

        .table>caption+thead>tr:first-child>th,
        .table>colgroup+thead>tr:first-child>th,
        .table>thead:first-child>tr:first-child>th,
        .table>caption+thead>tr:first-child>td,
        .table>colgroup+thead>tr:first-child>td,
        .table>thead:first-child>tr:first-child>td {
            border-top: 0
        }

        .table>tbody+tbody {
            border-top: 2px solid #ddd;
        }

        .table .table {
            background-color: #fff
        }

        .table-striped>tbody>tr:nth-child(odd)>td,
        .table-striped>tbody>tr:nth-child(odd)>th {
            background-color: #f9f9f9
        }

        .table-hover>tbody>tr:hover>td,
        .table-hover>tbody>tr:hover>th {
            background-color: #f5f5f5
        }

        table col[class*=col-] {
            position: static;
            float: none;
            display: table-column
        }

        table td[class*=col-],
        table th[class*=col-] {
            position: static;
            float: none;
            display: table-cell
        }

        .table tfoot {
            font-weight: bold;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        p,
        div {
            font-size: 12px;
            line-height: 13px;
        }

        p.caps {
            font-size: 12px;
        }

        ul {
            margin-bottom: 0;
        }

        @media print {
            .table {
                page-break-after: always;
            }
        }

        .table {
            page-break-inside: auto
        }

        .table tr {
            page-break-inside: avoid;
            page-break-after: auto
        }
    </style>
</head>

<body>
    <?php $total_price = 0;
    $discount_price = 0.0;
    $discount = 0.0;
    
    ?>
    <div align="center">

        <table width="800" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table width="800" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td><img src="{{ $base64 }}" alt="Webqom Technologies" /></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table width="300" border="0" align="justify" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td valign="top">
                                            <h1 class="green caps" style="margin-bottom: 0">
                                                <b>{{ $orderDetails->status }}</b>
                                            </h1>
                                            <div>
                                                @if ($orderDetails->payment_method)
                                                    {{ $orderDetails->payment_method->name }}
                                                @else
                                                    {{ 'Not Specific' }}
                                                @endif
                                                <span>(</span>
                                                {{ date('jS M Y H:i', strtotime($orderDetails->created_at)) }}
                                                <span>)</span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td>
                    <div class="divider_line"></div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table width="70%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <p style="padding-bottom:0px;line-height:12px;"><b>Receipt #:
                                                    {{ $orderDetails->id }}<br />Invoice #:
                                                    MY-{{ $orderDetails->transaction_id }}</b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table width="300" border="0" align="justify" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td valign="top" align="left">
                                            <p style="padding-bottom:0px;"><b>Client ID:
                                                    {{ $orderDetails->user->client->client_id }}</b></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0">&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <table width="74%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="120">
                                            <div align="left">Invoice Date</div>
                                        </td>
                                        <td width="10"></td>
                                        <td>
                                            <div align="left">:
                                                {{ date('jS M Y', strtotime($orderDetails->created_at)) }}</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <table width="800" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="alileft">
                                <p class="caps"><b>Invoice To</b></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="alileft">
                                <address style="margin:0;line-height:10px">
                                    {{ $orderDetails->user->client->first_name . ' ' . $orderDetails->user->client->last_name }}
                                    <br>
                                    Attn: {{ $orderDetails->user->client->company }} <br>
                                    Address 1: {{ $orderDetails->user->client->address1 }} <br />
                                    Address 2: {{ $orderDetails->user->client->address2 }}<br />
                                    {{ isset($value['id']) ? $orderDetails->user->client->postalcode . '<br>' : '' }}
                                    Country: {{ $orderDetails->user->client->country->name }} <br />
                                    Tel: {{ $orderDetails->user->client->phone_number }}<br />
                                    Email: {{ $orderDetails->user->email }}
                                </address>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
        <div align="left">
            <h5 class="caps"><b>Invoice Items</b></h5>
        </div>
        <table class="table table-hover table-striped" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product/Services</th>
                    <th>Cycle</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $main_price = 0;
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
                    if ($value['price'] != '') {
                        $row_price = ($value['price'] * $value['cycle']) + ($value['domain_price'] * $value['domain_cycle']);
                    } else {
                        $row_price = 0.0;
                    }
                    ?>
                    @if ($value->type == 2)
                        <?php $text = 'Transfer'; ?>
                    @else
                        <?php $text = 'Registration'; ?>
                    @endif
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <div class="pull-left">
                                <!-- <b>Service Code: </b> <span class="sitecolor">DN</span><br/> -->
                                @if (!empty($value->plan))
                                    <b>Service Code: </b> <span
                                        class="sitecolor">{{ !empty($value->plan->service_code) ? $value->plan->service_code : '' }}</span><br />
                                    <b>Hosting Plan:</b> <span
                                        class="sitecolor caps">{{ !empty($value->plan->plan_name) ? $value->plan->plan_name : '' }}</span><br />
                                    @php
                                        $total_break = 2;
                                        $featured_plans = App\Models\PlanFeature::where('page', $value->plan->page)
                                            ->where('status', 1)
                                            ->get();
                                    @endphp
                                    @if (!empty($featured_plans) && count($featured_plans) > 0 && count($value->plan) > 0)
                                        @php
                                            $total_break++;
                                        @endphp
                                        <b>Server Specification:</b>
                                        <ul>
                                            @foreach ($featured_plans as $i)
                                                @php
                                                    $details = App\Models\PlanFeatureDetail::where('plan_feature_id', $i->id)
                                                        ->where('plan_id', $value->plan->id)
                                                        ->first();
                                                @endphp
                                                @if ($details)
                                                    <?php $total_break++; ?>
                                                    <li><i
                                                            class="fa icon-arrow-right"></i>&nbsp;&nbsp;{{ $i->title }}:
                                                        <span
                                                            data-sel="{{ $i->title }}">{{ $details->description }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif

                                <?php 
								if(isset($value->addons) && $value->addons != "" && $value->addons != null){
                    				$addons_vl = explode(',', $value->addons); 
                                    $total_break++;
								?>
                                <b>Domain Addons: </b>
                                <ul>
                                    <?php $d_ad = 1; ?>
                                    @foreach ($addons_vl as $addon)
                                        @foreach ($domain_pricings as $dprice)
                                            <?php 
												if($addon == $dprice->id){ 
                                                    $total_break++;
                                                    
													$row_price += $dprice->price;
													$d_ad++;
												?>
                                            <li><i class="fa icon-arrow-right"></i>{{ $dprice->title }} (RM
                                                {{ number_format($dprice->price, 2) }})
                                            </li>
                                            <?php } ?>
                                        @endforeach
                                    @endforeach
                                </ul>
                                <?php 
                                } 
                                $total_break++;
                                ?>
                                
                            </div>
                        </td>
                        <td>
                            @if (!empty($value['cycle']))
                                <?php $cycle = $value['cycle']; ?>
                            @else
                                <?php $cycle = 1; ?>
                            @endif
                            @if (!empty($value->plan))
                                @if ($main_price != $value['price'])
                                    <?php echo $cycle . ' years';
                                    $domain_year = $value['domain_cycle'];
                                    ?>
                                @else
                                    <?php $domain_year = ''; ?>
                                    {{ $cycle }} <?php if ($cycle == 1) {
                                        echo 'year';
                                    } else {
                                        echo 'years';
                                    } ?> <br />
                                @endif
                            @else
                                <?php $domain_year = $value['domain_cycle']; ?>
                            @endif

                            <?php 
								if(isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null){
								$addons_vl = explode(',', $value['addons']); 
							?>

                            <ul style="margin-bottom:0">
                                @foreach ($addons_vl as $addon)
                                    @foreach ($domain_pricings as $dprice)
                                        <?php if($addon == $dprice->id){ ?>
                                        <li>1</li>
                                        <?php } ?>
                                    @endforeach
                                @endforeach
                            </ul>

                            <?php } ?>
                            
                        </td>
                        <td>
                            @if (!empty($value->plan))
                                @if ($main_price != $value['price'])
                                    {{ $value['qty'] }}
                                    <?php $domain_qty = $value['qty']; ?>
                                @else
                                    {{ $value['qty'] }}
                                    <?php $domain_qty = ''; ?>
                                @endif
                            @else
                                <?php $domain_qty = $value['qty']; ?>
                            @endif
                            <?php 
								if(isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null){
								$addons_vl = explode(',', $value['addons']); 
							?>

                            <ul style="margin-bottom:0">
                                @foreach ($addons_vl as $addon)
                                    @foreach ($domain_pricings as $dprice)
                                        <?php if($addon == $dprice->id){ ?>
                                        <li>1</li>
                                        <?php } ?>
                                    @endforeach
                                @endforeach
                            </ul>

                            <?php } ?>

                            
                        </td>
                        <td>
                            @if (!empty($value->plan))
                                <?php 
                					if($main_price != $value['price']){ 
								?>
                                RM {{ number_format(($value['price'] * $value['cycle']), 2) }}
                                <?php $d_price = $domain_price; ?>
                                <?php }else{ ?>
                                RM {{ number_format($value['price'] ? $value['price'] : '0', 2) }}
                                <?php $d_price = ''; ?>
                                <?php } ?>
                            @else
                                <?php $d_price = number_format($value['price'] ? $value['price'] : '0', 2); ?>
                            @endif

                            <?php 
									if(isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null){
                    					$addons_vl = explode(',', $value['addons']); 
								?>
                            <ul style="margin-bottom:0">
                                @foreach ($addons_vl as $addon)
                                    @foreach ($domain_pricings as $dprice)
                                        <?php if($addon == $dprice->id){ ?>
                                        <li>RM {{ number_format($dprice->price, 2) }}</li>
                                        <?php } ?>
                                    @endforeach
                                @endforeach
                            </ul>

                            <?php } ?>

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="pull-left">
                                <b>Domain {{ $text }}:</b> <span
                                    class="sitecolor">{{ $value['services'] }}</span><br />

                            </div>
                        </td>
                        <td>
                            @if (!empty($domain_year))
                                
                                <?php 
                                echo $domain_year; 
                                if ($domain_year == 1) {
                                    echo ' Year';
                                } else {
                                    echo ' Years';
                                }
                                ?>
                            @endif
                        </td>
                        <td>
                            <?php if (!empty($domain_year)) {
                                echo $domain_qty;
                            } ?>
                        </td>
                        <td>
                            <?php if (!empty($domain_year)) {
                                echo 'RM ' . number_format($d_price, 2);
                            } ?>

                        </td>
                    </tr>
                    <?php $total_price += $row_price;
                    $discount_price += $discount;
                    ?>
                @endforeach
                <?php
                $grand_total = $total_price - $discount_price;
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <div align="right">
                            <p class="caps"><b>Subtotal</b></p>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <div align="">
                            <p class="red caps"><b>RM {{ number_format($total_price, 2) }}</b></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div align="right">
                            <p class="caps"><b>Discount</b></p>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td>

                        <div align="">
                            <p class="red caps"><b>- RM {{ number_format($discount_price, 2) }}</b></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div align="right">
                            <p class="caps"><b>6% GST</b></p>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <div align="">
                            <p class="red caps"><b>RM 0.00</b></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div align="right">
                            <p class="caps"><b>Total</b></p>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <div align="">
                            <p class="red caps"><b>RM {{ number_format($grand_total, 2) }}</b></p>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div align="left">
            <h5 class="caps"><b>Transactions</b></h5>
        </div>
        <table cellspacing="1" class="table table-striped" width="100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Transaction ID</th>
                    <th>Payment Date</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td class="alicent">01</td>
                    <td>{{ $orderDetails->transaction_id }}</td>
                    <td>{{ date('jS M Y', strtotime($orderDetails->created_at)) }}</td>
                    <td>
                        @if ($orderDetails->payment_method)
                            {{ $orderDetails->payment_method->name }}
                        @else
                            {{ 'Not Specific' }}
                        @endif
                    </td>
                    <td>RM {{ number_format($grand_total, 2) }}</td>
                </tr>
            </tbody>
            <tfoot>
                <td colspan="4">
                    <div align="right">
                        <h3 class="caps"><b>Balance</b></h3>
                    </div>
                </td>
                <td>
                    <div align="right">
                        <h3 class="red"><b> RM {{ number_format($grand_total, 2) }}</b></h3>
                    </div>
                </td>
            </tfoot>

        </table>


    </div>
</body>

</html>
