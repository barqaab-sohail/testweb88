<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><head>

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

    <link rel="stylesheet" type="text/css" href="{{$icons}}" media="screen" />



    <!-- animations -->

    <link href="{{url('public_html/html_new_design/js/animations/css/animations.min.css')}}" rel="stylesheet" type="text/css" media="all" />



    <!-- responsive devices styles -->

    <link rel="stylesheet" media="screen" href="{{url('public_html/html_new_design/css/responsive-leyouts.css')}}" type="text/css" />



    <!-- shortcodes -->

    <link rel="stylesheet" media="screen" href="{{url('public_html/html_new_design/css/shortcodes.css')}}" type="text/css" />



    <link href="{{url('public_html/html_new_design/js/mainmenu/bootstrap.min.css')}}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>

</head><body onafterprint="showNonPrintArea()">

    <div align="center">

        <div>

            <table width="100%">

                <tr>

                    <td valign="top">

                        <img src="{{url('public_html/html_new_design/images/index/logo_large.png')}}" alt="Webqom Technologies" />

                    </td>

                    <td valign="top">

                        <h1 class="green caps" align="center" style="margin-bottom: 0">

                            <b>{{ $orderDetails->status }}</b>

                        </h1>

                        <div align="center"> @if ($orderDetails->payment_method)

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

                <tr>

                    <td>

                        <div class="pull-left">

                            <h3>

                                <b>Receipt #: {{ $orderDetails->id }}<br />Invoice #: MY-{{ $orderDetails->transaction_id }}</b>

                            </h3>

                        </div>

                        <div align="center">

                            <h3>

                                <b>Client ID:{{ $orderDetails->user->user_client_id }}</b>

                            </h3>

                        </div>

                    </td>

                </tr>



            </table>

        </div>

        <div class="divider_line"></div>

        <div>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                

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

        </div>

        <div align="left">

            <table>

                <tr>

                    <td>

                        <h5 class="caps"><b>Invoice To</b></h5>

                    </td>

                </tr>

                <tr>

                    <td>{{ $orderDetails->user->client->first_name }}

                        {{ $orderDetails->user->client->last_name }}

                    </td>

                </tr>

                <tr>

                    <td>{{ $orderDetails->user->client->company }}</td>

                </tr>

                <tr>

                    <td>

                        {{ $orderDetails->user->client->address1 }}, <br />

                        {{ $orderDetails->user->client->address2 }},<br />

                        Postal Code: {{ $orderDetails->user->client->postalcode }} <br />

                        Country: {{ $orderDetails->user->client->country->name }}

                    </td>

                </tr>

                <tr>

                    <td>

                        Tel: {{ $orderDetails->user->client->phone_number }}<br />Email:

                        {{ $orderDetails->user->email }}

                    </td>

                </tr>

            </table>

        </div>

        <div>

            <div align="left">

                <h5 class="caps"><b>Invoice Items</b></h5>

            </div>

            <table class="table table-hover table-striped">



                <tr>

                    <th>#</th>

                    <th>Product/Services</th>

                    <th>Cycle</th>

                    <th>Qty</th>

                    <th>Price</th>

                </tr>



                @php

                $subTotal =0.0;

                $subTotalSetupFee =0.0;

                $subTotalAddons =0.0;



                @endphp

                @foreach($orderDetails->orderItems as $key=>$orderItem)

                @php

                $addonPrice=0.0;

                $setupFeeTotal=0.0;

                @endphp



                <tr>

                    <td>{{$key+1}}</td>

                    <td>





                        <b>Service Code: </b> <span class="sitecolor">{{ !empty($orderItem->plan->service_code) ?

                                        $orderItem->plan->service_code  : 'DN' }}</span><br />

                        <!-- first if -->

                        @if (!empty($orderItem->plan))



                        @php

                        $setupFee = $orderItem->plan->setup_fee_one_time=='0.00'? '(FREE Setup)':'';

                        @endphp



                        <b>{{ucwords($orderItem->plan->page)}} Plan:</b> <span class="sitecolor caps">{{ !empty($orderItem->plan->plan_name) ?

                                        $orderItem->plan->plan_name : '' }}</span><span class='sitecolor red'> {{$setupFee}}</span><br />

                        @php

                        $featured_plans = App\Models\PlanFeature::where('page', $orderItem->plan->page)

                        ->where('status', 1)

                        ->get();



                        @endphp

                        <b>Domain:</b> <span class="sitecolor">{{ $orderItem->services }}</span><br>

                        <!-- second if -->

                        @if (!empty($featured_plans) && isset($featured_plans)?count($featured_plans) > 0:false && count($orderItem->plan) > 0)

                        <b>Seupt Fee:</b> <span class="sitecolor red">RM {{$orderItem->plan->setup_fee_one_time}}</span><br>

                        <b>Plan Specification:</b>

                        <ul>

                            @foreach ($featured_plans as $i)

                            @php

                            $details = App\Models\PlanFeatureDetail::where('plan_feature_id', $i->id)

                            ->where('plan_id', $orderItem->plan->id)

                            ->first();



                            @endphp

                            @if ($details)

                            <li><i class="fa icon-arrow-right"></i>&nbsp;&nbsp;{{ $i->title }}:

                                <span data-sel="{{ $i->title }}">{{ $details->description }}</span>

                            </li>

                            @endif

                            @endforeach

                        </ul>

                        <!--end  scond if -->

                        @endif

                        @else

                        <b>Domain:</b> <span class="sitecolor">{{ $orderItem->services }}</span><br>

                        <!--end  first if -->

                        @endif





                        @php

                        $addons = str_replace('"', "", $orderItem->addons);

                        @endphp



                        @if(!empty($addons))

                        <b>Domain Addons:</b>

                        @php

                        $addons = explode(",", $addons);

                        $domain_addons = App\Models\DomainPricing::where('type', 'addons')->whereIn('id', $addons)->get();



                        @endphp

                        <ul>

                            @foreach ($domain_addons as $addons)

                            @php

                            $addonPrice += (float)$addons->price ;

                            @endphp

                            <li>

                                <i class="fa icon-arrow-right"></i> {{$addons->title}}

                            </li>

                            @endforeach

                        </ul>

                        @endif

                    </td>

                    <td>{{$orderItem->cycle}} year(s)</td>

                    <td>{{$orderItem->qty}}</td>

                    <td>

                        @php

                        $setupFeeTotal = !empty($orderItem->plan)?$orderItem->plan->setup_fee_one_time:0;

                        @endphp

                        RM {{number_format($orderItem->price + $addonPrice + $setupFeeTotal,2)}}</td>

                </tr>

                @php

                $subTotal += (float) $orderItem->price + $addonPrice + $setupFeeTotal ;

                @endphp

                @endforeach





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

                                <h6><b>RM {{{number_format($subTotal,2)}}}</b></h6>

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

                                <h6 class="red"><b>- RM {{ number_format($orderDetails->discount,2)}}</b></h6>

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td colspan="2">

                            <div align="right">

                                @php

                                $gstRate = round($orderDetails->gst_rate / $orderDetails->total_amount * 100,2);

                                @endphp

                                <h6 class="caps"><b>{{$gstRate}}% GST</b></h6>

                            </div>

                        </td>

                        <td></td>

                        <td></td>

                        <td>

                            <div align="right">

                                <h6><b>RM {{ number_format($orderDetails->gst_rate,2)}}</b></h6>

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

                                @php

                                $GrandTotal = $orderDetails->gst_rate + $orderDetails->total_amount - $orderDetails->discount;

                                @endphp

                                <h3 class="red"><b>RM {{ number_format($GrandTotal, 2) }}</b></h3>

                            </div>

                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>

        <div class="divider_line"></div>

        <p>

            Note: all cheques shall be crossed A/C payee and made payable to

            <b>WEBQOM TECHNOLOGIES SDN BHD</b>

        </p>

        <div align="center">

            <div align="left">

                <h5 class="caps"><b>Transactions</b></h5>

            </div>

            <table border="0" cellspacing="0" cellpadding="0" class="table table-striped">



                <tr>

                    <th></th>

                    <th>Transaction ID</th>

                    <th>Payment Date</th>

                    <th>Payment Method</th>

                    <th>Amount</th>

                </tr>



                <tr>

                    <td class="alicent">01</td>

                    <td>{{$orderDetails->transaction_id}}</td>

                    <td><?php echo date('jS M Y', strtotime($orderDetails->payment_date)); ?></td>

                    <td>{{$orderDetails->payment_method->name}}</td>

                    <td>RM {{ number_format($orderDetails->total_amount, 2) }}</td>

                </tr>



                <tfoot>

                    <td colspan="4">

                        <div align="right">

                            <h3 class="caps"><b>Balance</b></h3>

                        </div>

                    </td>

                    <td>

                        <div align="right">



                            <h3 class="red"><b>RM </b></h3>

                        </div>

                    </td>

                </tfoot>

            </table>

        </div>

        <div>

            <div class="alicent clearfix margin_top5" id="nonPrintArea">

                <a href="{{URL::previous()}}" class="btn btn-default caps"><i class="fa icon-action-undo"></i> <b>Back</b></a>&nbsp;

                <a id="downloadPdf" href="{{url('admin/print_pdf_1',$id) }}" class="btn btn-danger caps"><i id="downloadIcon" class="fa icon-cloud-download"></i> <b>Download PDF</b></a>&nbsp;

                <a href="#" id="print-window" class="btn btn-danger caps"><i class="fa icon-printer"></i> <b>Print</b></a>&nbsp;

            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>



    <script>

        function showNonPrintArea() {

            $("#nonPrintArea").show();

        }

        $(document).ready(function() {



            $('#print-window').click(function() {

                $("#nonPrintArea").hide();

                window.print();

            });



            $("#downloadPdf").click(function(e) {

                e.preventDafault;

                $("#downloadIcon").removeClass('icon-cloud-download');

                $("#downloadIcon").addClass('fa-spinner fa-spin');

                // href="{{url('admin/print_pdf_1',$id) }}"

                $.ajax({

                        url: base_url + '/admin/print_pdf_1/'+"{{$id}}",

                        type: 'GET',

                        success: function(response) {

                            $("#downloadIcon").removeClass('fa-spinner fa-spin');

                            $("#downloadIcon").addClass('icon-cloud-download');

                        }

                });



            });





        });

    </script>

</body></html>