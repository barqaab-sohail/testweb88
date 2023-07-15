<div>
    <title>Receipt #: {{ $orderDetails->id }} </title>
    <link rel="stylesheet" href="{{ $style }}" />

    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        *,
        *:before,
        *:after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .divider_line {
            float: left;
            width: 100%;
            border-bottom: 1px solid #f3f3f3;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 21cm;
            margin: auto;
            font-size: 11px;
            font-family: Arial, sans-serif;
            font-weight: normal;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }


        table {
            max-width: 100%;
            background-color: transparent;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        th {
            text-align: left;
            font-size: 16px;
            white-space: nowrap;
        }

        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tfoot>tr>th,
        .table>thead>tr>td {
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
            color: #403e3d;
            font-size: 12px;
        }

        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            padding: 5px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
            color: #403e3d;
            font-size: 12px;
        }

        .table>thead>tr>th {
            vertical-align: bottom;
            /*border-bottom: 5px solid #006699;*/
            padding: 10px;
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

        .table {
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

        @media print {
            .table {
                page-break-after: always;

            }
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

        p {
            font-size: 10px;
            line-height: 11px;
        }

        ul {
            margin-bottom: 0;
            margin-left: 0;
            padding-left: 0;
            margin-top: 0;
        }

        ul,
        li {
            list-style-type: none;
        }

        .table {
            page-break-inside: auto
        }

        .table tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        .page-break {
            page-break-before: always;
        }

        @media print {
            .page-break {
                display: block;
                page-break-before: always;
            }
        }
    </style>
    <div class="align-items-center">
        <table width="800" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>x
                </tr>
                <tr>
                    <td>
                        <table width="300" class="align-items-left" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>

                                        <img src="{{ $base64 }}" alt="Webqom Technologies" />
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top">
                        <table width="300" cellpadding="0" cellspacing="0">
                            <tr>
                                <td valign="top">
                                    <h1 class="green caps" style="margin-bottom:0;text-align:center" class="align-items-center">
                                        <b>{{ $orderDetails->status }}</b>
                                    </h1>
                                    <div class="align-items-center" style="font-family:Arial, sans-serif;">
                                        @if ($orderDetails->payment_method)
                                        {{ $orderDetails->payment_method->name }}
                                        @else
                                        {{ 'Not Specific' }}
                                        @endif
                                        (
                                        <?php echo date('jS M Y H:i', strtotime($orderDetails->created_at)); ?>
                                        )
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>

        </table>
        <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td style="width:100%">
                        <div style="float:left;width:50%">
                            <h5><b>Receipt#: {{ $orderDetails->id }}
                                    <br />
                                    Invoice #: MY-{{ $orderDetails->transaction_id }}</b></h5>
                        </div>
                        <div style="float:right;width:50%;text-align:right">
                            <h5><b>Client ID: {{ $orderDetails->user->user_client_id }}</b></h5>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td width="width:100%">
                        <div style="float:left; width:50%"><span style="margin-right:15px;">Invoice Date : </span><span style="margin-left:30px;display:inline">{{ date('jS M Y',
                                strtotime($orderDetails->created_at)) }}</span>
                        </div>
                        <div style="width:50%"></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <table width="800" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="alileft">
                        <h5 class="caps" style="margin-bottom:0;padding-bottom:0"><b>Invoice To</b></h5>
                    </td>
                </tr>
                <tr>
                    <td class="alileft">{{ $orderDetails->user->client->first_name }}
                        {{ $orderDetails->user->client->last_name }}
                    </td>
                </tr>
                <tr>
                    <td class="alileft">Company: {{ $orderDetails->user->client->company }}</td>
                </tr>
                <tr>
                    <td class="alileft">Address 1: {{ $orderDetails->user->client->address1 }} Address 2:
                        {{ $orderDetails->user->client->address2 }}
                        Postal Code: {{ $orderDetails->user->client->postalcode }} Country:
                        {{ $orderDetails->user->client->country->name }}
                    </td>
                </tr>
                <tr>
                    <td class="alileft">Tel: {{ $orderDetails->user->client->phone_number }}<br />Email:
                        {{ $orderDetails->user->email }}
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-hover table-striped">
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
                <?php $main_price = 0;
                $domain_price = 0; ?>
                @foreach ($orderDetails->orderItems as $key => $value)
                @if (!empty($value->plan))
                <?php
                $main_price = ($value['price'] * $value['cycle']) + $value['domain_price'];
                $domain_price = $value['domain_price'] * $value['domain_cycle'];
                ?>

                <?php $discount = App\Models\Promotion::get_discount($value['plan_id']);
                if ($discount != null) {
                    $discount = json_decode(json_encode($discount));

                    if ($discount->discount_by == 'amount') {
                        $discount = $discount->discount;
                    } else {
                        $discount = ($value['price'] * $discount->discount) / 100;
                    }
                } else {
                    $discount = 0.0;
                } ?>
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

                            @if (!empty($value->plan))
                            <b>Service Code: </b> <span class="sitecolor">{{ !empty($value->plan->service_code) ?
                                $value->plan->service_code : '' }}</span><br />
                            <b>Hosting Plan:</b> <span class="sitecolor caps">{{ !empty($value->plan->plan_name) ?
                                $value->plan->plan_name : '' }}</span><br />

                            @php
                            $featured_plans = App\Models\PlanFeature::where('page', $value->plan->page)
                            ->where('status', 1)
                            ->get();
                            $total_break = 2;
                            @endphp

                            @if (!empty($featured_plans) && isset($featured_plans)?count($featured_plans) > 0:false && count($value->plan) > 0)
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
                                <ul>
                                    <?php $d_ad = 1; ?>
                                    @foreach ($addons_vl as $addon)
                                    @foreach ($domain_pricings as $dprice)
                                    <?php
                                    if ($addon == $dprice->id) {
                                        $row_price += $dprice->price;
                                        $d_ad++;
                                    ?>
                                        <li><i class="fa icon-arrow-right"></i>{{ $dprice->title }} (RM
                                            {{ number_format((float) $dprice->price, 2) }})
                                        </li>
                                    <?php }
                                    ?>
                                    @endforeach
                                    @endforeach
                                </ul>
                            <?php } ?>
                        </div>

                        <div>
                            <?php if (!empty($value->ssl_price) && $value->ssl_price != '0.00') { ?>
                                <?php $ssl_vl = explode('-', $value->ssl_price); ?>
                                <?php echo '<b>SSL Price:</b>'; ?>RM {{ $ssl_vl[1] }}
                                <?php $row_price += $ssl_vl[1]; ?>
                            <?php } ?>
                        </div>
                        <div>
                            <b>Domain {{ $text }}:</b> <span class="sitecolor">{{ $value['services'] }}</span>
                            <?php echo '<br>'; ?>
                        </div>
                        <div>
                            <?php if (!empty($value->setup_fee) && $value->setup_fee != '0.00') {
                                echo "<b>Setup Fee: " . $value->setup_fee . "</b>";
                                $row_price += $value->setup_fee;  ?>
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
                            @if (!empty($value['plan_id']))
                            @if ($main_price != $value['price'])
                            <?php
                            echo $value['cycle'] . ' years <br/>';
                            $domain_year = $value['domain_cycle'];
                            ?>
                            @else
                            {{ $cycle }}
                            <?php if ($cycle == 1) {
                                echo 'year';
                            } else {
                                echo 'years';
                            } ?> <br />
                            <?php $domain_year = ''; ?>
                            @endif
                            <?php for ($t = 1; $t <= $total_break; $t++) {
                                echo '&nbsp;<br/>';
                            } ?>
                            @else
                            <?php $domain_year = $cycle; ?>
                            @endif
                            <?php if (isset($value->addons) && $value->addons != "" && $value->addons != null) { ?>
                                <?php for ($dad = 1; $dad <= $d_ad; $dad++) {
                                    echo '&nbsp;<br/>';
                                }
                                ?>
                            <?php } ?>
                            <?php if (!empty($value->ssl_price) && $value->ssl_price != '0.00') { ?>
                                <?php $ssl_vl = explode('-', $value->ssl_price); ?>
                                {{ $ssl_vl[0] }} Years <br>
                            <?php } ?>

                            @if (!empty($domain_year))
                            <?php echo $domain_year . ' Year'; ?>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="pull-left">
                            @if (!empty($value['plan_id']))
                            @if ($main_price != $value['price'])
                            {{ $value['qty'] }} <br />
                            <?php $domain_qty = $value['qty']; ?>
                            @else
                            {{ $value['qty'] }} <br />
                            <?php $domain_qty = ''; ?>
                            @endif
                            <?php for ($k = 1; $k <= $total_break; $k++) {
                                echo '&nbsp;<br/>';
                            } ?>
                            @else
                            <?php $domain_qty = $value['qty']; ?>
                            @endif
                        </div>
                        <div>
                            <?php
                            if (isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null) {
                                $addons_vl = explode(',', $value['addons']); ?>
                                <br>
                                <ul>
                                    @foreach ($addons_vl as $addon)
                                    @foreach ($domain_pricings as $dprice)
                                    <?php if ($addon == $dprice->id) { ?>
                                        <li>1</li>
                                    <?php } ?>
                                    @endforeach
                                    @endforeach
                                </ul>

                            <?php } ?>
                            <?php if (!empty($value->ssl_price) && $value->ssl_price != '0.00') {
                                echo '&nbsp;<br>';
                            } ?>

                            <?php if (!empty($domain_qty)) {
                                echo $domain_qty;
                            } ?>
                        </div>

                    </td>
                    <td>
                        <div class="pull-left">
                            @if (!empty($value['plan_id']))
                            <?php
                            if ($main_price != $value['price']) { ?>
                                <?php $d_price = $domain_price; ?>
                                RM {{ number_format(($value['price'] * $value['cycle']), 2) }} <br>
                            <?php } else { ?>
                                RM {{ number_format($value['price'] ? $value['price'] : '0', 2) }} <br>
                                <?php $d_price = ''; ?>
                            <?php } ?>
                            <?php for ($d = 1; $d <= $total_break; $d++) {
                                echo '&nbsp;<br/>';
                            } ?>
                            @else
                            <?php $d_price = number_format($value['price'] ? $value['price'] : '0', 2); ?>
                            @endif
                        </div>
                        <div>
                            <?php if (isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null) {
                                $addons_vl = explode(',', $value['addons']); ?>
                                <br>
                                <ul>
                                    @foreach ($addons_vl as $addon)
                                    @foreach ($domain_pricings as $dprice)
                                    <?php if ($addon == $dprice->id) { ?>
                                        <li>RM {{ number_format((float)$dprice->price, 2) }}</li>
                                    <?php } ?>
                                    @endforeach
                                    @endforeach
                                </ul>

                            <?php } ?>
                        </div>
                        <div>
                            <?php if (!empty($value->ssl_price) && $value->ssl_price != '0.00') { ?>
                                <?php $ssl_vl = explode('-', $value->ssl_price); ?>
                                <ul>
                                    <li>RM {{ $ssl_vl[1] }} </li>
                                </ul>
                            <?php } ?>
                        </div>
                        <div>
                            @if (!empty($d_price))
                            RM {{ number_format((float)$d_price, 2) }}
                            @endif
                        </div>

                        <div>
                            <ul>
                                <?php if (!empty($value->setup_fee) && $value->setup_fee != '0.00') {
                                    echo "<li>RM " . $value->setup_fee . "</li>";
                                    $row_price += $value->setup_fee;  ?>
                                <?php } ?>
                            </ul>
                        </div>

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
                        <div class="align-items-right">
                            <p class="caps"><b>Subtotal</b></p>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <div>
                            <p class="red caps"><b>RM {{ number_format($total_price, 2) }}</b></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="align-items-right">
                            <p class="caps"><b>Discount</b></p>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td>

                        <div>
                            <p class="red caps"><b>- RM {{ number_format($discount_price, 2) }}</b></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="align-items-right">
                            <p class="caps"><b>6% GST</b></p>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <div>
                            <p class="red caps"><b>RM 0.00</b></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="align-items-right">
                            <p class="caps"><b>Total</b></p>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <div>
                            <p class="red caps"><b>RM {{ number_format($grand_total, 2) }}</b></p>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>