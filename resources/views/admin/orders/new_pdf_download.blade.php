<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Receipt #: {{ $orderDetails->id }} </title>

    <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet" type="text/css" />

    <!-- ######### CSS STYLES ######### -->

    <link rel="stylesheet" href="{{url('public_html/html_new_design/css/reset.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{url('public_html/html_new_design/css/style.css')}}" type="text/css" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="{{url('public_html/html_new_design/css/font-awesome/css/font-awesome.min.css')}}" />

    <!-- simple line icons -->
    <link rel="stylesheet" type="text/css" href="{{url('public_html/html_new_design/css/simpleline-icons/simple-line-icons.css')}}" media="screen" />

    <!-- animations -->
    <link href="{{url('public_html/html_new_design/js/animations/css/animations.min.css')}}" rel="stylesheet" type="text/css" media="all" />

    <!-- responsive devices styles -->
    <link rel="stylesheet" media="screen" href="{{url('public_html/html_new_design/css/responsive-leyouts.css')}}" type="text/css" />

    <!-- shortcodes -->
    <link rel="stylesheet" media="screen" href="{{url('public_html/html_new_design/css/shortcodes.css')}}" type="text/css" />

    <link href="{{url('public_html/html_new_design/js/mainmenu/bootstrap.min.css')}}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            $('#print-window').click(function() {
                window.print();
            });
        });
    </script>
</head>

<body>
    <div align="center" id="content">

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
                                        <td>
                                            <img src="{{url('public_html/html_new_design/images/index/logo_large.png')}}" alt="Webqom Technologies" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table width="300" border="0" align="right" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td valign="top">
                                            <h1 class="green caps" align="center" style="margin-bottom: 0">
                                                <b>{{ $orderDetails->status }}</b>
                                            </h1>
                                            <div align="center">
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
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <div class="pull-left">
                                    <h3>
                                        <b>Receipt#: {{ $orderDetails->id }}
                                            <br />
                                            Invoice #: MY-{{ $orderDetails->transaction_id }}</b>
                                    </h3>
                                </div>
                                <div class="pull-right">
                                    <h3>
                                        <b>Client ID: {{ $orderDetails->user->user_client_id }}</b>
                                    </h3>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="120">
                                            <div align="left">Invoice Date</div>
                                        </td>
                                        <td width="10"></td>
                                        <td>
                                            <div align="left">: {{ date('jS M Y',
                                strtotime($orderDetails->created_at)) }}</div>
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
                    <table width="800" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="alileft">
                                <h5 class="caps"><b>Invoice To</b></h5>
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
                            <td class="alileft">
                                {{ $orderDetails->user->client->address1 }}, <br />
                                {{ $orderDetails->user->client->address2 }},<br />
                                Postal Code: {{ $orderDetails->user->client->postalcode }} <br />
                                Country: {{ $orderDetails->user->client->country->name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="alileft">
                                Tel: {{ $orderDetails->user->client->phone_number }}<br />Email:
                                {{ $orderDetails->user->email }}
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
                    <div align="left">
                        <h5 class="caps"><b>Invoice Items</b></h5>
                    </div>
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
                            <?php
                            $total_price = 0;
                            $discount_price = 0;
                            $main_price = 0;
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

                                        @if (!empty($featured_plans) && count($featured_plans) > 0 && count($value->plan) > 0)
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
                                                        {{ number_format($dprice->price, 2) }})
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
                                                    <li>RM {{ number_format($dprice->price, 2) }}</li>
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
                                        RM {{ number_format($d_price, 2) }}
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
                                    <div align="right">
                                        <h6 class="caps"><b>Subtotal</b></h6>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div align="right">
                                        <h6><b>RM {{ number_format($total_price, 2) }}</b></h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div align="right">
                                        <h6 class="caps"><b>Discount</b></h6>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div align="right">
                                        <h6 class="red"><b>- RM {{ number_format($discount_price, 2) }}</b></h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div align="right">
                                        <h6 class="caps"><b>6% GST</b></h6>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div align="right">
                                        <h6><b>RM 0.00</b></h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div align="right">
                                        <h3 class="caps"><b>Total</b></h3>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div align="right">
                                        <h3 class="red"><b>RM {{ number_format($grand_total, 2) }}</b></h3>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <div align="left">
                        <h5 class="caps"><b>Transactions</b></h5>
                    </div>
                    <table cellspacing="1" class="table table-striped">
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
                                <td>{{$orderDetails->transaction_id}}</td>
                                <td><?php echo date('jS M Y', strtotime($orderDetails->payment_date)); ?></td>
                                <td>{{$orderDetails->payment_method->name}}</td>
                                <td>RM {{ number_format($orderDetails->total_amount, 2) }}</td>
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
                                    @php
                                    $balanceAmount = $orderDetails->total_amount - $grand_total;
                                    @endphp
                                    <h3 class="red"><b>RM {{number_format($balanceAmount,2)}}</b></h3>
                                </div>
                            </td>
                        </tfoot>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="divider_line"></div>
                    <p>
                        Note: all cheques shall be crossed A/C payee and made payable to
                        <b>WEBQOM TECHNOLOGIES SDN BHD</b>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="alicent clearfix margin_top5" id="ignoreContent">
                        <a href="billing_my_invoices.html" class="btn btn-default caps"><i class="fa icon-action-undo"></i> <b>Back</b></a>&nbsp;
                        <a href="#" class="btn btn-danger caps" id="gpdf"><i class="fa icon-cloud-download"></i> <b>Download PDF</b></a>&nbsp;
                        <a href="#" id="print-window" class="btn btn-danger caps"><i class="fa icon-printer"></i> <b>Print</b></a>&nbsp;
                    </div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div>
</body>

</html>