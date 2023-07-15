<?php $currentURL = url()->current();
$baseURL = url('/');
$basePath = str_replace($baseURL, '', $currentURL);
//$total_price = 0;
?>
@extends('layouts.frontend_layout')
@section('title','My Invoice | Webqom Technologies')
@section('content')
@section('page_header','Services')


<!-- end page title -->
<div class="clearfix">
  <div class="page_title1 sty9">
    <div class="container">
      <h1>Billing</h1>
      <div class="pagenation">&nbsp;<a href="{{url('/')}}">Home</a> <i>/</i> <a href="{{url('/client_area_home')}}">Dashboard</a> <i>/</i> Billing <i>/</i> My Invoices</div>
    </div>
  </div>
</div>

<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>

<div class="one_full stcode_title9">
  <h1 class="caps"><strong>My Invoices </strong> </h1>
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
          <a href="{{ url('billing_mass_payment') }}" class="btn btn-danger caps"><i class="fa fa-hand-o-up"></i><b>Pay All</b></a>
        </div><!-- end section -->
      </div><!-- end one half less -->
      <div class="clearfix margin_bottom3"></div>


      <div class="text-18px dark light">Below you can review your entire invoice with us.</div>
      <div class="one_half_less">
        <h4>Search</h4>
        <div class="cforms aliright">
          <input type="text" id="name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" placeholder="Search by Invoice #, Invoice Date or Due Date">
          <a href="javascript:search_txt()" class="btn btn-danger caps">
            <i class="fa fa-search"></i>
            <b>Search</b>
          </a>
        </div><!-- end cforms -->
      </div><!-- end one half less -->
      <div class="clearfix"></div>
      <div class="divider_line7"></div>

      <div class="scrollToThis">
        <p class="aliright">{{$orders->total()}} record(s) found. Items {{($orders->currentpage()-1)*$orders->perpage()+1}}-{{$orders->currentpage()*$orders->perpage()}} out of {{$orders->total()}} displayed</p>

        <div class="table-responsive">

          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th><span class="pull-left">#</span> </th>
                <th><span class="pull-left">Invoice #</span></th>
                <th><span class="pull-left">Invoice Date</span></th>
                <th><span class="pull-left">Due Date</span> </th>
                <th><span class="pull-left">Total</span> </th>
                <th><span class="pull-left">Payment Date</span></th>
                <th><span class="pull-left">Transaction #</span></th>
                <th><span class="pull-left">Payment Method</span></th>
                <th><span class="pull-left">Status</span> </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @if (count($orders) > 0)
              @php $i = ($orders->perPage() * ($orders->currentPage() - 1)) + 1; @endphp
              @foreach($orders as $key => $value)
              <tr>
                <td>{{$i++}}</td>
                <td><a href="{{url('/order-details/'.$value->id)}}"> MY-{{$value->transaction_id}}</a></td>
                <td>{{date('d M Y', strtotime($value->created_at))}}</td>
                <td>{{$value->due_date !== '0000-00-00 00:00:00' ? date('d M Y', strtotime($value->due_date)) : '-'}}</td>
                <td>RM {{ number_format($value->total_amount, 2) }}</td>
                <td>{{$value->payment_date !== '0000-00-00 00:00:00' ? date('d M Y', strtotime($value->payment_date)) : '-'}}</td>
                <td>{{$value->transaction_id}}</td>
                <td>
                  @if($value->payment_method)
                  {{$value->payment_method->name}}
                  @else
                  {{"Not Specific"}}
                  @endif
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
        </div>
        <!-- end table responsive -->
      </div>

    </div><!-- end section -->




  </div>
  <!-- end container -->


  <div class="clearfix"></div>


</div><!-- end content full width -->

<div class="clearfix"></div>
@endsection
@section('custom_scripts')

<script src="{{url('').'/resources/assets/admin/'}}js/jquery.redirect.js"></script>
<script type="text/javascript">
  function search_txt(orderBy = 'id', order = 'desc') {
    var search = $('#name').val();
    window.location.href = "/billing_my_invoices?search=" + search + "&orderBy=" + orderBy + "&order=" + order;
  }
  @if(!empty($_GET['search']))
  $(function() {
    $('html, body').animate({
      scrollTop: $(".scrollToThis").offset().top
    }, 2000);
  });
  @endif
</script>
@endsection