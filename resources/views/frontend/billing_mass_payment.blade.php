<?php $currentURL = url()->current();
$baseURL = url('/');
$basePath = str_replace($baseURL, '', $currentURL);
//$total_price = 0;
?>
@extends('layouts.frontend_layout')
@section('title','Mass Payment | Webqom Technologies')
@section('content')
@section('page_header','Services')


<!-- end page title -->
<div class="clearfix">
  <div class="page_title1 sty9">
    <div class="container">
      <h1>Billing</h1>
      <div class="pagenation">&nbsp;<a href="{{url('/')}}">Home</a> <i>/</i> <a href="{{url('/client_area_home')}}">Dashboard</a> <i>/</i> Billing <i>/</i> Mass Payment</div>
    </div>
  </div>
</div>

<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>

<div class="one_full stcode_title9">
  <h1 class="caps"><strong>Mass Payment </strong> </h1>
</div>

<div class="clearfix"></div>


<div class="content_fullwidth">

  <div class="container">
    @include("layouts.frontend_menu_login", array('status_filter' => 'ticket'))


    <div class="three_fourth_less last">

      
      <div class="clearfix margin_bottom1"></div>

      <div class="one_full">
        <div class="alertymes4">
          <h3 class="light"><i class="fa fa-warning"></i><strong>You have {{$totalUnpaidOrders}} Overdue Invoice(s). Overdue Total: RM {{number_format($totalUnpaidOrdersAmount, 2)}}</strong>
            <br />Please pay your outstanding invoices as soon as possible.
          </h3>
          <div class="clearfix margin_bottom1"></div>
        </div><!-- end section -->
      </div><!-- end one half less -->
      <div class="clearfix margin_bottom3"></div>


      <div class="text-18px dark light">Pay all the invoices listed below in a single easy transaction by choosing a payment method</div>
      
      <div class="divider_line7"></div>

      <div class="scrollToThis">
        <p class="aliright">{{$orders->total()}} record(s) found. Items {{($orders->currentpage()-1)*$orders->perpage()+1}}-{{$orders->currentpage()*$orders->perpage()}} out of {{$orders->total()}} displayed</p>

        <div class="table-responsive">

          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th width="1%"><input id="master" type="checkbox" /></th>
                <th><span class="pull-left">#</span> </th>
                <th><span class="pull-left">Invoice #</span> </th>
                <th><span class="pull-left">Invoice Date</span> </th>
                <th><span class="pull-left">Due Date</span> </th>
                <th><span class="pull-left">Total</span> </th>
                <th><span class="pull-left">Status</span> </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @if (count($orders) > 0)
                @php $i = ($orders->perPage() * ($orders->currentPage() - 1)) + 1; @endphp
                @foreach($orders as $key => $value)
                <tr>
                  <td>
                    {{ Form::checkbox('orders_checkbox[]', $value->id, false, ['class' => 'sub_chk']) }}
                  </td>
                  <td>{{$i++}}</td>
                  <td><a href="{{url('/order-details/'.$value->id)}}"> MY-{{$value->transaction_id}}</a></td>
                  <td>{{date('d M Y', strtotime($value->created_at))}}</td>
                  <td>{{$value->due_date !== '0000-00-00 00:00:00' ? date('d M Y', strtotime($value->due_date)) : '-'}}</td>
                  <td>
                    RM {{ number_format($value->total_amount, 2) }}
                    <span style="display:none;" class="order-index-total-amount-{{ $value->id }}">{{$value->total_amount}}</span>
                  </td>
                  <td>
                    <a href="order_details.html">
                      @if($value->status === 'PAID')
                      <span class="label label-success caps">Paid</span>
                      @elseif($value->status === 'UNPAID')
                      <span class="label label-xs label-warning">Unpaid</span>
                      @else
                      <span class="label label-danger caps">Payment Failed</span>
                      @endif
                    </a>
                  </td>
                  <td class="alicent">
                    <a href="{{url('order-details'.'/'.$value->id)}}" data-hover="tooltip" data-placement="top" title="View Details">
                      <i class="fa fa-search red"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <th colspan="4"><span class="pull-right total">TOTAL DUE</span> </th>
                  <th colspan="2"><span class="pull-right total">RM <span class="total-due numbers">0.00</span></span> </th>
                  <th></th>
                  <th></th>
                </tr>
              @else
              <tr>
                <td colspan="6" style="text-align: center;">
                  <h4> No records found.</h4>
                </td>
              </tr>
              @endif
              <!-- <tr>
                            <td>1</td>
                            <td>MY-7974188</td>
                            <td>1431979860</td>
                            <td>16th Apr 2015</td> 
                            <td>RM 26,406.54</td>    
                            <td>PayPal</td> 
                            <td><a href="order_details.html"><span class="label label-success caps">Paid</span></a></td>
                            <td class="alicent"><a href="order_details.html" data-hover="tooltip" data-placement="top" title="View Details"><i class="fa fa-search red"></i></a></td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>MY-8001182</td>
                            <td>-</td>
                            <td>16th Apr 2015</td> 
                            <td>RM 26,406.54</td>    
                            <td>PayPal</td> 
                            <td><a href="order_details.html"><span class="label label-danger caps">Payment Failed</span></a></td>
                            <td class="alicent"><a href="order_details.html" data-hover="tooltip" data-placement="top" title="View Details"><i class="fa fa-search red"></i></a></td>
                          </tr> -->


            </tbody>
            <tfoot>
              <tr>
                <td colspan="8"></td>
              </tr>
            </tfoot>
          </table>
          <div class="clearfix"></div>

          @if ($orders->lastPage() > 1)
          <div class="pagination center">
            <b>Page {{ $orders->currentPage() }} of {{ $orders->lastPage() }}</b>

            <a href="{{ $orders->url($orders->currentPage()-1) }}" class="navlinks {{ ($orders->currentPage() == 1) ? ' disabled' : '' }}">&lt; Previous</a>

            @for ($i = 1; $i <= $orders->lastPage(); $i++)
              <a class="navlinks {{ ($orders->currentPage() == $i) ? ' current' : '' }}" href="{{ $orders->url($i) }}">{{ $i }}</a>
              @endfor

              <a href="{{ $orders->url($orders->currentPage()+1) }}" class="navlinks">Next ></a>
          </div>
          @endif
          <!-- <div class="pagination center">
                        <b>Page 1 of 18</b>
                        <a href="#" class="navlinks disabled">&lt; Previous</a>
                            <a href="#" class="navlinks current">1</a>
                            <a href="#" class="navlinks">2</a>
                            <a href="#" class="navlinks">3</a>
                            <a href="#" class="navlinks">4</a>
                            <a href="#" class="navlinks">Next ></a>
                      </div>  -->
        </div>
        <!-- end table responsive -->
      </div>
      <div class="payment-content" style="display: none;">
        {!! Form::open(['route' => 'frontend.order_confirmation_login', 'id' => 'order_confirmation_login']) !!}
        <div class="clearfix"></div>
        <div class="divider_line7"></div>
        <div class="clearfix"></div>
        <h4>Payment Method</h4>
        <div class="cforms alileft">
    
            <div id="form_status"></div>
              <input type="hidden" name="order_ids" id="order_ids" value="">
            {{-- <form type="POST" id="gsr-contact" onsubmit="return valid_datas( this );"> --}}
                <div class="one_half_less">
                    <label><b>Paid by</b> <em>*</em></label>
                    <label class="input">
                      <select id="paid_by" name="paid_by">
                        <option>-- Please select --</option>
                        <option value="2">Bank Transfer</option>
                        <!--<option value="3">Cash</option>
                        <option value="4">Cheque</option>-->
                        <option value="5">Stripe</option> 
                        <option selected="selected" value="7">PayPal</option>
                        <!-- <option>Bank-in</option> -->
                        <!-- <option>Mastercard</option> -->
                        <!-- <option>Visa</option> -->
                      </select>
                    </label>
                  </div>
            {{-- </form> --}}
            
        </div><!-- end cforms-->
        
        <div class="clearfix"></div>
        <div class="divider_line7"></div>
        <div class="clearfix"></div>
        <div class="alicent">
          <div id="paypal-button-container" style="margin-bottom: 17px"></div>
          <div id="bank-button-container" style="margin-bottom: 17px">
              <div class="alertymes4" style="color: #000 !important; border: 1px solid #000">
                  <h3 class="light" style="color: #000 !important;">
                      <strong>Payment By Cheque/ Cash / Bank Transfer</strong>
                      <p>Please write your cheque payable to "Webqom Technologies Sdn Bhd" and bank in to our Public Bank account"</p>
                  </h3>
                  <div class="leftContent">
                      <strong> Account Number </strong>
                      <p class="light">
                          3158958612
                      </p>

                      <strong> Bank Name </strong>
                      <p class="light">
                          Public Bank Berhad
                      </p>
                      <strong> Account Name </strong>
                      <p class="light">
                          Webqom Technologies Sdn Bhd
                      </p>
                  </div>
              </div><!-- end section -->
              {{-- <input type="submit" value="Submit" style="font-family: 'Roboto', sans-serif;padding: 13px 30px 14px 30px;background-color: #D72D1A;border: 0px;font-size: 14px;font-weight: 500;color: #fff;text-transform: uppercase;transition: all 0.3s ease;border-radius: 3px;"> --}}
              <a href="#" class="btn btn-danger" id="submit-payment"><i class="fa fa-mouse-pointer"></i> <b>Make Payment</b></a>&nbsp;
          </div>
          
            <!-- <a href="#" class="btn btn-danger caps"><i class="fa fa-mouse-pointer"></i> <b>Pay Selected</b></a>&nbsp;-->
        </div>
        {!! Form::close() !!}
      </div>  

    </div><!-- end section -->

  </div>
  <!-- end container -->


  <div class="clearfix"></div>
          
  

<!-- end my invoice listing --> 


</div><!-- end content full width -->
<input type="hidden" id="total-payment" value='0'>
<div class="clearfix"></div>
@endsection
@section('custom_scripts')
<script src="https://www.paypal.com/sdk/js?client-id=AdJBPGNCfzPpaMFZ4SoGvJ8hr4tZpIQDkWMQA5dZ_db4keNRW9S1Ub1o6BFjUwqoGwFuodh9eykC5SoQ&currency=MYR&disable-funding=card,credit"></script>

<script>
//paypal start
paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      
      var total_price = $('#total-payment').val()
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: total_price
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        console.log(details);

        fetch(base_url+'/billing_payment_done', {
          method: 'post',
          headers: {
            'x-csrf-token': csrf_token,
            'content-type': 'application/json'
          },
          body: JSON.stringify({
            data: data,
            detail: details,
            field: $('#order_confirmation_login').serializeArray()
          })
        })
        .then((response) => {
            if(response.ok) {
              toastr.success('Payment success', 'Success');
              location.reload();
            } else {
              toastr.success('Payment failed', 'Success');
            }
        });
      });
    }
}).render('#paypal-button-container');

//paypal - end
smoothScroll.init();
$(document).ready(function() {
  
      $('.menu-link').menuFullpage();

      $(".checkbox input:checkbox").change(function() {
          var ischecked= $(this).is(':checked');
          if(ischecked){
              $('.billing_info').hide();
          }else{
              $('.billing_info').show();
          }
      });

      $(".contact_add_another").change(function() {
          /*alert(this.value);*/
          if(this.value == '1'){
              $('.additional_contact').hide();
          }else{
              $('.additional_contact').show();
          }
      });
      
      $("form#logout_form").submit(function(e){
      });
});

//Show or Hide Bank / PayPal payment options
$(window).on('load', function() {
  paymentBlockDisplay();
});
$('#bank-button-container').css('display', 'none');  
$(document).on('change', '#paid_by', function() {
  paymentBlockDisplay();
});
function paymentBlockDisplay() {
  var paidBy = $('#paid_by option:selected').val();
  if (paidBy == 7) {
      $('#bank-button-container').css('display', 'none');
      $('#paypal-button-container').css('display', 'block');
  } else {
      $('#bank-button-container').css('display', 'block');
      $('#paypal-button-container').css('display', 'none');
  }
}
</script>

<script src="{{url('').'/resources/assets/admin/'}}js/jquery.redirect.js"></script>
<script type="text/javascript">
  function search_txt(orderBy = 'id', order = 'desc') {
    var search = $('#name').val();
    window.location.href = "/billing_mass_payment?search=" + search + "&orderBy=" + orderBy + "&order=" + order;
  }
  @if(!empty($_GET['search']))
  $(function() {
    $('html, body').animate({
      scrollTop: $(".scrollToThis").offset().top
    }, 2000);
  });
  @endif

  function custom_number_format( number_input, decimals, dec_point, thousands_sep ) {
      var number       = ( number_input + '' ).replace( /[^0-9+\-Ee.]/g, '' );
      var finite_number   = !isFinite( +number ) ? 0 : +number;
      var finite_decimals = !isFinite( +decimals ) ? 0 : Math.abs( decimals );
      var seperater     = ( typeof thousands_sep === 'undefined' ) ? ',' : thousands_sep;
      var decimal_pont   = ( typeof dec_point === 'undefined' ) ? '.' : dec_point;
      var number_output   = '';
      var toFixedFix = function ( n, prec ) {
        if( ( '' + n ).indexOf( 'e' ) === -1 ) {
          return +( Math.round( n + 'e+' + prec ) + 'e-' + prec );
          } else {
          var arr = ( '' + n ).split( 'e' );
          let sig = '';
          if ( +arr[1] + prec > 0 ) {
            sig = '+';
          }
          return ( +(Math.round( +arr[0] + 'e' + sig + ( +arr[1] + prec ) ) + 'e-' + prec ) ).toFixed( prec );
        }
      }
      number_output = ( finite_decimals ? toFixedFix( finite_number, finite_decimals ).toString() : '' + Math.round( finite_number ) ).split( '.' );
      if( number_output[0].length > 3 ) {
        number_output[0] = number_output[0].replace( /\B(?=(?:\d{3})+(?!\d))/g, seperater );
      }
      if( ( number_output[1] || '' ).length < finite_decimals ) {
        number_output[1] = number_output[1] || '';
        number_output[1] += new Array( finite_decimals - number_output[1].length + 1 ).join( '0' );
      }
      return number_output.join( decimal_pont );
  }

  $(document).ready(function() {
    
    $('#submit-payment').on('click', function(e) {
      fetch(base_url+'/billing_payment_done_other', {
        method: 'post',
        headers: {
          'x-csrf-token': csrf_token,
          'content-type': 'application/json'
        },
        body: JSON.stringify({
          field: $('#order_confirmation_login').serializeArray()
        })
      })
      .then((response) => {
          if(response.ok) {
            toastr.success('Payment success', 'Success');
            location.reload();
          } else {
            toastr.success('Payment failed', 'Success');
          }
      });
    });

    $('#master').on('click', function(e) {
        console.log('selected data all');
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
        calculate_total_due()
    });

    $('.sub_chk').on('click', function() {
      calculate_total_due()
    });

    function calculate_total_due(){
      checked_orders = $(".sub_chk:checked");
      var total = 0;
      var order_ids = '';
      if (checked_orders.length > 0) {
          checked_orders.each(function() {
              reference_id = $(this).val();
              total += Number($('.order-index-total-amount-' + reference_id).text());
              if(order_ids != '')
                order_ids = order_ids + ',' + reference_id;
              else
                order_ids = reference_id;
          });
          $('.payment-content').show()
      } 
      $(".total-due").html(custom_number_format( total, '2'));
      $("#total-payment").val(total);
      $("#order_ids").val(order_ids);
      
    }
    
  });
</script>
<style>
  .total {
    font-size: 18px;
  }
</style>
@endsection