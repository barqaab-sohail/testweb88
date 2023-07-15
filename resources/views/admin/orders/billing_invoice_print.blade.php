<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Receipt #: {{ $orderDetails->payer_id }}</title>

<!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Dancing+Script:400,700' rel='stylesheet' type='text/css'>

<!-- ######### CSS STYLES ######### -->
      <link rel="stylesheet" href="{{url('').'/resources/assets/frontend/'}}css/reset.css" type="text/css" />
    <link rel="stylesheet" href="{{url('').'/resources/assets/frontend/'}}css/style.css" type="text/css" />
    <!-- mega menu -->
    <link href="{{url('').'/resources/assets/frontend/'}}js/mainmenu/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
   .table { page-break-inside:auto }
   .table tr    { page-break-inside:avoid; page-break-after:auto }
   h6{font-size: 12px;}
    @media print{
      .table {
        page-break-after: always;

      }
    }
    </style>
</head>

<body>
  <?php $total_price = 0; 
  $discount_price = 0.00;

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
    <td><table width="800" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="300" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr>
            <?php $pic=url('').'/resources/assets/frontend/images/index/logo_large.png'; ?>

            <td><img src="{{ $pic }}" alt="Webqom Technologies" /></td>
          </tr>
          <tr>
            <td></td>
          </tr>
        </table></td>
        <td valign="top"><table width="300" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top"><h1 class="green caps" align="center" style="margin-bottom: 0"><b>{{$orderDetails->status}}</b></h1>
              <div align="center">@if($orderDetails->payment_method)
                          {{$orderDetails->payment_method->name}}
                        @else
                          {{"Not Specific"}}
                        @endif 
                        <span>(</span>
                          {{ date("jS M Y H:i", strtotime($orderDetails->created_at))}} <span>)</span></div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td><div class="divider_line"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div class="pull-left">
          <h3><b>Receipt #: {{ $orderDetails->payer_id }}<br/>Invoice #: MY-{{ $orderDetails->transaction_id }}</b></h3>
        </div>
        <div class="pull-right">
          <h3><b>Client ID: {{ $orderDetails->user->client->client_id}}</b></h3>
        </div>
        </td>
      </tr>
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="120"><div align="left">Invoice Date</div></td>
              <td width="10"></td>
              <td><div align="left">: {{ date("jS M Y", strtotime($orderDetails->created_at))}}</div></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="800" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="alileft"><h5 class="caps"><b>Invoice To</b></h5></td>
      </tr>
      
      
      <tr>
        <td class="alileft">{{ $orderDetails->user->client->first_name }} {{ $orderDetails->user->client->last_name }}</td>
      </tr>
      <tr>
        <td class="alileft">Attn: {{$orderDetails->user->client->company }}</td>
      </tr>
      <tr>
        <td class="alileft">{{ $orderDetails->user->client->address1}} <br/>
                {{ $orderDetails->user->client->address2 }}<br/>
            {{ $orderDetails->user->client->postalcode}} {{ $orderDetails->user->client->country->name }} <br/></td>
      </tr>
      <tr>
        <td class="alileft">Tel: {{ $orderDetails->user->client->phone_number}}<br/>Email: {{ $orderDetails->user->email}}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>    
    </td>
  </tr>
  </table>
 <div align="left"><h5 class="caps"><b>Invoice Items</b></h5></div>
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
        <?php $main_price = 0;$domain_price = 0; ?>
        @forelse($orderDetails->orderItems as  $key => $value) 
        @if(!empty($value->plan))
          <?php
              $main_price = number_format((float)$value->plan->price_annually+$value->plan->setup_fee_one_time, 2, '.', '');
              $domain_price = number_format((float)$value['price'] - ($value->plan->price_annually+$value->plan->setup_fee_one_time), 2, '.', ''); ?>
          
              <?php $discount = App\Models\Promotion::get_discount($value['plan_id']);
             if($discount != NULL){
               $discount = json_decode(json_encode($discount));
              
              if($discount->discount_by == 'amount'){
                $discount = $discount->discount;
              }else{
                $discount = ( $value['price'] * $discount->discount / 100);
              }
             }else{
              $discount = 0.00;
             } ?>
        @else

          @php $main_price = $value->price; $domain_price = 0; $discount = 0.00; @endphp
          
          @endif
        
        <?php 
          if($value['price'] != ''){
            $row_price = $value['price'];
          }else{
            $row_price = 0.00;
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
                <b>Domain {{$text }}:</b> <span class="sitecolor">{{$value['services']}}</span><br/>
                 @if(!empty($value->plan))
                 <b>Service Code: </b> <span class="sitecolor">{{!empty($value->plan->service_code) ? $value->plan->service_code : ''}}</span><br/>
                 <b>Hosting Plan:</b> <span class="sitecolor caps">{{!empty($value->plan->plan_name) ? $value->plan->plan_name : ''}}</span><br/>
                <?php if(isset($v->addons) && $v->addons != "" && $v->addons != null){
                    $addons_vl = explode(',', $v->addons); ?>
                    

                <b>Domain Addons:</b>
                <ul>
                    
                
                @foreach($addons_vl as $addon)
                @foreach($domain_pricings as $dprice)
                <?php 
                if($addon == $dprice->id){ 
                    $row_price += $dprice->price;
                ?>
                <li><i class="fa icon-arrow-right"></i>{{$dprice->title}} (RM {{ number_format($dprice->price, 2) }})</li>
               <?php }
                ?>
                  
                @endforeach
                @endforeach
                </ul>
                <?php } ?>
                @php
                  $featured_plans = App\Models\PlanFeature::where('page', $value->plan->page)->where('status', 1)->get();
                @endphp
                 @if(!empty($featured_plans) && count($featured_plans)>0 && count($value->plan)>0)
                  <b>Server Specification:</b>
                  <ul>
                     
                        @foreach($featured_plans as $i)         
                          @php
                            $details = App\Models\PlanFeatureDetail::where('plan_feature_id', $i->id)->where('plan_id', $value->plan->id)->first();
                          @endphp
                          @if ($details)
                          <li><i class="fa icon-arrow-right"></i>&nbsp;&nbsp;{{$i->title}}:
                            <span data-sel="{{$i->title}}">{{ $details->description }}</span>
                          </li>
                          @endif
                        @endforeach
                      
                  </ul>
                  @endif
                  @endif
            </div>
          </td>
          <td><div class="pull-left">
            @if(!empty($value['cycle']))
              <?php $cycle = $value['cycle']; ?>
              @else
              <?php $cycle = 1; ?>
              @endif
            @if(!empty($value->plan))
              @if($main_price != $value['price'])
             
              {{$cycle}} <?php echo "years". '<br/>'. '1 years'; ?> 
                
              @else
                {{$cycle}} <?php if($cycle == 1) echo "year"; else echo "years"; ?> <br/>
              @endif
            @else
            {{ $cycle }} <?php if($cycle == 1) echo "year"; else echo "years"; ?> <br/>
            @endif
             </div>
          </td>
          <td>
            @if($main_price != $value['price']) 
              {{$value['qty']}} <br/> {{$value['qty']}}
            @else
            {{$value['qty']}} <br/>
            @endif
             <div> 
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
          </td>
          <td>
            @if(!empty($value->plan))
            <?php 
              if($main_price != $value['price']){ ?>
                RM {{ $domain_price }} <br>
                RM {{ $main_price }} 
             <?php }else{ ?>
                RM {{ number_format(($value['price']?$value['price']:'0'),2)}} <br>

             <?php } ?>
           
            @else
            RM {{ number_format(($value['price']?$value['price']:'0'),2)}} <br>
           
            @endif
            <br>
            <div>  
              <?php if(isset($value['addons']) && $value['addons'] != "" && $value['addons'] != null){
                  $addons_vl = explode(',', $value['addons']); ?>

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
          </td>
        </tr>
        <?php $total_price += $row_price; 
          $discount_price += $discount; 
        ?> 
        @empty
              @endforelse
        <?php
        $grand_total = $total_price - $discount_price;  
        ?>  
        
      </tbody>
      <tfoot>
    <tr>
      <td colspan="2"><div align="right"><h6 class="caps"><b>Subtotal</b></h6></div></td>
      <td></td>
      <td></td>
      <td><div align="right"><h6><b>RM {{number_format($total_price, 2)}}</b></h6></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="right"><h6 class="caps"><b>Discount</b></h6></div></td>
      <td></td>
      <td></td>
      <td>

        <div align="right"><h6 class="red"><b>- RM {{number_format($discount_price, 2)}}</b></h6></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="right"><h6 class="caps"><b>6% GST</b></h6></div></td>
      <td></td>
      <td></td>
      <td><div align="right"><h6><b>RM 0.00</b></h6></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="right"><h3 class="caps"><b>Total</b></h3></div></td>
      <td></td>
      <td></td>
      <td><div align="right"><h3 class="red"><b>RM {{number_format($grand_total, 2)}}</b></h3></div></td>
    </tr>
  </tfoot>
  </table> 
    
</div>
</body>
</html>
