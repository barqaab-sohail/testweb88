<div>
  <title>Invoice #: MY-{{ $orderDetails->transaction_id }}</title>
  <link rel='stylesheet'
    href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'>
  <link rel="stylesheet" href="{{ $style }}">
  <style>
    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    body {
      position: relative;
      width: 21cm;
      margin: auto;
      font-size: 12px;
      line-height: 10px;
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
      width: 100%;
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
      font-size: 12px;
    }

    .table>tbody>tr>td,
    .table>tfoot>tr>td {
      padding: 5px;
      line-height: 1.42857143;
      vertical-align: top;
      border-top: 1px solid #ddd;
      /*color: #403e3d;*/
      font-size: 11px;
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
      font-size: 11px;
      line-height: 11px;
    }

    p.caps {
      font-size: 11px;
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

    .page-break {
      page-break-before: always;
    }

    @media print {
      .page-break {
        display: block;
        page-break-before: always;
      }
    }

    .border-0 {
      border: none;
    }

    .align-items-center {
      align-items: center;
    }

    .align-items-left {
      align-items: flex-start;
    }

    .align-items-right {
      align-items: flex-end;
    }
  </style>
  <div class="align-items-center">

    <table class="border-0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
          <td>&nbsp;</td>
        </tr>
      <tr>
        <td>
          <table width="100%" class="border-0" cellspacing="0" cellpadding="0">
            <tr>
              <td>
                <img src="{{ $base64 }}" style="width:190px;" alt="Webqom Technologies" />
              </td>
              <td valign="top">

                @if($orderDetails->status == 'COMPLETED')
                <h1
                  class="green caps"
                  align="center"
                  style="margin-bottom: 0"
                >
                    <b>paid</b>
                </h1>
                @elseif ($orderDetails->status === 'INCOMPLETE')
                    <h1
                  class="caps"
                  align="center"
                  style="margin-bottom: 0;color:#f0ad4e;"
                >
                  <b>Unpaid</b>
                </h1>
                @else
                  <h1
                    class="caps"
                    align="center"
                    style="margin-bottom: 0;color:#b8312f;"
                  >
                    <b>Payment Failed</b>
                  </h1>
                @endif
                <div align="center">  
                  @if ($orderDetails->payment_method)
                    {{ $orderDetails->payment_method->name }}
                  @endif 
                  ({{ date("jS M Y H:i", strtotime($orderDetails->created_at))}})</div>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
          <td>&nbsp;</td>
        </tr>
      <tr>
          <td><div style="border-bottom:1px solid #f3f3f3;"></div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      <tr>
        <td>
          <table width="100%" class="border-0" cellspacing="0" cellpadding="0">
            <tr>
              <td style="padding-bottom:0px;">
                <div class="align-items-left">
                  <h3 style="padding-bottom:0px;margin-bottom:0px;"><b>Receipt #: {{ $orderDetails->id }}</b></h3>
                  <h3 style="padding-bottom:0px;margin-bottom:0px;"><b>Invoice #: MY-{{ $orderDetails->transaction_id }}</b></h3>
                </div>
              </td>
              <td style="padding-bottom:0px;">
                <div class="align-items-right">
                  <h3 style="padding-bottom:0px;"><b>Client ID: {{ $orderDetails->user->user_client_id}}</b></h3>
                </div>
              </td>
            </tr>
            <tr>
              <td style="padding:0">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top">
                <table width="100%" class="border-0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="80">Invoice Date</td>
                    <td>
                      <div class="align-items-left">: {{ date("jS M Y", strtotime($orderDetails->created_at))}}
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
        <td style="padding:0">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">
          <table width="100%" class="border-0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="alileft">
                <p class="caps"><b>Invoice To</b></p>
              </td>
            </tr>
            <tr>
              <td class="alileft">
                <address style="margin:0;line height:11px">{{ $orderDetails->user->client->first_name. '
                  '.$orderDetails->user->client->last_name }} <br>
                  Attn: {{$orderDetails->user->client->company }} <br>
                  Address 1: {{ $orderDetails->user->client->address1}} <br />
                  Address 2: {{ $orderDetails->user->client->address2 }}<br />
                  {{ isset($value['id']) ? $orderDetails->user->client->postalcode.'<br>' : "" }}
                  Country: {{ $orderDetails->user->client->country->name }} <br />
                  Tel: {{ $orderDetails->user->client->phone_number}}<br />
                  Email: {{ $orderDetails->user->email}}
                </address>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
        </td>
      </tr>
    </table>
    <div class="align-items-left">
      <p class="caps" style="margin:8px 0;"><b>Invoice Items</b></p>
    </div>
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th style="width:400px">Product/Services</th>
          <th>Cycle</th>
          <th>Qty</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <?php $main_price = 0;$domain_price = 0; ?>
        @foreach($orderDetails->orderItems as $key => $value)
        @if(!empty($value->plan))
        <?php
                        // $main_price = number_format((float)$value->plan->price_annually+$value->plan->setup_fee_one_time, 2, '.', '');
                        // $domain_price = number_format((float)$value['price'] - ($value->plan->price_annually+$value->plan->setup_fee_one_time), 2, '.', ''); 
                        $main_price = ($value['price'] * $value['cycle']) + $value['domain_price'];
                        $domain_price = $value['domain_price'] * $value['domain_cycle'];
                        $discount = $orderDetails->discount; 
                      ?>
        @else

        @php $main_price = $value->price; $domain_price = 0; $discount = 0.00; @endphp

        @endif

        <?php 
                    // if($value['price'] != ''){
                    //   $row_price = ($value['price'] * $value['cycle']) + ($value['domain_price'] * $value['domain_cycle']);
                    // }else{
                    //   $row_price = 0.00;
                    // }

                    if (empty($value->plan)) {
                      $cycle = 1;
                   } else {
                      $cycle = $value['cycle'];
                   }
                  if (empty(@$value['domain_price'])) {
                      $row_price = $value['price'] * $cycle * $value['qty'];
                   } else {
                      $row_price = ($value['price'] * $cycle * $value['qty']) + $domain_price;
                   }
                  ?>
        @if($value->type == 2)
        <?php $text = 'Transfer'; ?>
        @else
        <?php $text = 'Registration'; ?>
        @endif
        <tr>
          <td>{{ $key+1 }}</td>
          <td>
            <div class="pull-left">
              <!-- <b>Service Code: </b> <span class="sitecolor">DN</span><br/> -->

              @if(!empty($value->plan))
              <b>Service Code: </b> <span class="sitecolor">{{!empty($value->plan->service_code) ?
                $value->plan->service_code : ''}}</span><br />
              <b>Hosting Plan:</b> <span class="sitecolor caps">{{!empty($value->plan->plan_name) ?
                $value->plan->plan_name : ''}}</span><br />

              @php
              $featured_plans = App\Models\PlanFeature::where('page', $value->plan->page)->where('status', 1)->get();
              $total_break=2;
              @endphp

              @if(!empty($featured_plans) && count($featured_plans)>0 && count($value->plan)>0)

              <b>Server Specification:</b>
              <ul>
                @foreach($featured_plans as $i)
                @php
                $details = App\Models\PlanFeatureDetail::where('plan_feature_id', $i->id)->where('plan_id',
                $value->plan->id)->first();
                @endphp
                @if ($details)
                <?php $total_break++; ?>
                <li><i class="fa icon-arrow-right"></i>&nbsp;&nbsp;{{$i->title}}:
                  <span data-sel="{{$i->title}}">{{ $details->description }}</span>
                </li>
                @endif
                @endforeach
              </ul>
              @endif
              @endif
              <?php if(isset($value->addons) && $value->addons != "" && $value->addons != null){
                            $addons_vl = explode(',', $value->addons); ?>
              <b>Domain Addons:</b>
              <ul>
                <?php $d_ad=1; ?>
                @foreach($addons_vl as $addon)
                @foreach($domain_pricings as $dprice)
                <?php $addon = str_replace("\"","", $addon);
                            if($addon == $dprice->id){ 
                                $row_price += $dprice->price;
                              $d_ad++;
                            ?>
                <li><i class="fa icon-arrow-right"></i>{{$dprice->title}} (RM {{ number_format($dprice->price, 2) }})
                </li>
                <?php }
                            ?>
                @endforeach
                @endforeach
              </ul>
              <?php } ?>
            </div>

            <div>
              <?php if(!empty($value->ssl_price) && $value->ssl_price != '0.00'){ ?>
              <?php $ssl_vl = explode('-', $value->ssl_price); ?>
              <?php echo "<b>SSL Price:</b>"; ?>RM {{ $ssl_vl[1] }}
              <?php $row_price += $ssl_vl[1]; ?>
              <?php } ?>
            </div>
            <div>
              <b>Domain {{ $text }}:</b> <span class="sitecolor">{{$value['services']}}</span>
              <?php echo '<br>'; ?>
            </div>
            <div>
              <?php if(!empty($value->setup_fee) && $value->setup_fee != '0.00'){
                        echo "<b>Setup Fee: ".$value->setup_fee."</b>";
                        $row_price += $value->setup_fee;  ?>
              <?php } ?>
            </div>
          </td>
          <td>
            <div class="pull-left">
              @if(!empty($value['cycle']))

              <?php $cycle = $value['cycle']; ?>
              @else
              <?php $cycle = 1; ?>
              @endif
              @if(!empty($value['plan_id']))
              @if($main_price != $value['price'])
              <?php
                        echo $value['cycle'].' year(s) <br/>'; 
                        $domain_year = $value['domain_cycle']; 
                        ?>

              @else
              {{$cycle}}
              <?php if($cycle == 1) echo "year(s)"; else echo "year(s)"; ?> <br />
              <?php $domain_year = ''; ?>
              @endif
              <?php for($t=1; $t <= $total_break ; $t++) { 
                              echo '&nbsp;<br/>'; 
                          } ?>
              @else
              <?php $domain_year = $value['domain_cycle']; ?>
              @endif
              <?php if(isset($value->addons) && $value->addons != "" && $value->addons != null){ ?>
              <?php for ($dad=1; $dad <= $d_ad; $dad++) { 
                                  echo '&nbsp;<br/>';
                               }
                             ?>
              <?php } ?>
              <?php if(!empty($value->ssl_price) && $value->ssl_price != '0.00'){ ?>
              <?php $ssl_vl = explode('-', $value->ssl_price);?>
              {{ $ssl_vl[0] }} year(s) <br>
              <?php } ?>

              @if(!empty($domain_year))
              <?php echo $domain_year. ' year(s)'; ?>
              @endif
            </div>
          </td>
          <td>
            <div class="pull-left">
              @if(!empty($value['plan_id']))
              @if($main_price != $value['price'])
              {{$value['qty']}} <br />
              <?php $domain_qty = $value['qty']; ?>
              @else
              {{$value['qty']}} <br />
              <?php $domain_qty = ''; ?>
              @endif
              <?php for($k=1; $k<= $total_break; $k++){ 
                          echo '&nbsp;<br/>'; 
                      } ?>
              @else
              <?php $domain_qty = $value['qty']; ?>
              @endif
            </div>
            <div>
              <?php 
                        if(isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null){
                          $addons_vl = explode(',', $value['addons']); ?>
              <br>
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
              <?php if(!empty($value->ssl_price) && $value->ssl_price != '0.00'){
                            echo '&nbsp;<br>'; 
                          } ?>

              <?php if(!empty($domain_qty)){
                           echo $domain_qty;
                          } ?>
            </div>

          </td>
          <td>
            <div class="pull-left">
              @if(!empty($value['plan_id']))
              <?php 
                        if($main_price != $value['price']){ ?>
              <?php $d_price = $domain_price ?>
              RM {{ number_format($value['price'] * $value['cycle'], 2) }} <br>
              <?php }else{ ?>
              RM {{ number_format(($value['price']?$value['price']:'0'),2)}} <br>
              <?php $d_price = ''; ?>
              <?php } ?>
              <?php for($d=1; $d <= $total_break ; $d++) { 
                              echo '&nbsp;<br/>'; 
                          } ?>

              @else
              <?php $d_price = number_format(($value['price']?$value['price']:'0'),2); ?>

              @endif
            </div>
            <div>
              <?php if(isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null){
                            $addons_vl = explode(',', $value['addons']); ?>
              <br>
              <ul>
                @foreach($addons_vl as $addon)
                @foreach($domain_pricings as $dprice)

                <?php if($addon == $dprice->id){ ?>
                <li>RM {{ number_format($dprice->price, 2)}}</li>
                <?php } ?>

                @endforeach
                @endforeach
              </ul>

              <?php } ?>
            </div>
            <div>
              <?php if(!empty($value->ssl_price) && $value->ssl_price != '0.00'){ ?>
              <?php $ssl_vl = explode('-', $value->ssl_price); ?>
              <ul>
                <li>RM {{ $ssl_vl[1] }} </li>
              </ul>
              <?php } ?>
            </div>
            <div>
              @if(!empty($d_price))
              RM {{ number_format($d_price, 2) }}
              @endif
            </div>

            <div>
              <ul>
                <?php if(!empty($value->setup_fee) && $value->setup_fee != '0.00'){
                            echo "<li>RM ".$value->setup_fee."</li>"; 
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
              <h6 class="caps">
                <b>Subtotal</b>
              </h6>
            </div>
          </td>
          <td></td>
          <td></td>
          <td>
            <div align="right">
              <h6>
                <b>RM {{number_format($total_price, 2)}}</b>
              </h6>
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
              <h6 class="red caps"><b>- RM {{number_format($discount_price, 2)}}</b></h6>
            </div>
          </td>
        </tr>
        @if(!empty($orderDetails->gst_rate) && $orderDetails->gst_rate != "0.00")
        <tr>
          <td colspan="2">
            <div align="right">
              <h6 class="caps"><b>{{$gstRate->rate}}% GST </b></h6>
            </div>
          </td>
          <td></td>
          <td></td>
          <td>
            <div align="right">
              <?php $grand_total += $orderDetails->gst_rate; ?>
              <h6 class="red caps"><b>RM {{ $orderDetails->gst_rate }}</b></h6>
            </div>
          </td>
        </tr>
        @endif
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
              <h3 class="red caps"><b>RM {{number_format($grand_total, 2)}}</b></h3>
            </div>
          </td>
        </tr>
      </tfoot>
    </table>
    <table class="table table-hover">
    <tr>
    <td style="border:0">
    	<div align="left"><h5 class="caps"><b>Transactions</b></h5></div>
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
                          <tr >
                          	<td class="alicent">01</td>
                            <td>{{$orderDetails->transaction_id}}</td>
                            <td>{{ date('jS M Y', strtotime($orderDetails->payment_date))}}</td>
                            <td>
                            @if ($orderDetails->payment_method)
                              {{ $orderDetails->payment_method->name }}
                            @else
                              {{ "Not Specified" }}
                            @endif 
                            </td>
                            <td>
                              <?php $totalammount = App\Models\Order::updateOrderprice($orderDetails->id); ?>
                              RM {{ number_format($totalammount, 2) }}
                            </td>
                          </tr>
                        </tbody>
                        <tfoot>
                        	<td colspan="4"><div align="right"><h3 class="caps"><b>Balance</b></h3></div></td>
                            <td><div align="right">
                              <h3 class="red">  
                                <?php $totalammount = App\Models\Order::updateOrderprice($orderDetails->id); ?>
                                <b>RM {{ number_format($totalammount, 2) }}</b>
                              </h3>
                            </div></td>
                        </tfoot>
                        
        		</table>        
            </td>
  </tr>
  <tfoot>
    <tr>
      <td style="border:0; color:#403e3d;">
        <div style="border-bottom:1px solid #f3f3f3;"></div>
        <p>Note: all cheques shall be crossed A/C payee and made payable to <b>WEBQOM TECHNOLOGIES SDN BHD</b></p>
      </td>
    </tr>
  </tfoot>
    </table>              

  </div>
</div>