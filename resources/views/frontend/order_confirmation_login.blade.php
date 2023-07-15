@extends('layouts.frontend_layout')
@section('title','Admin | Domain Configuration')
@section('content')
@section('page_header','Services')
<?php
if(isset($response->price_list->pricing) && !empty($response->price_list->pricing))
{
   $pricing_list = json_decode($response->price_list->pricing);
   $id = json_decode($response->price_list->id);
}else{
  $id = 0;
}

?>
<div class="clearfix"></div>


<div class="page_title1 sty9">
<div class="container">

	<h1>Online Order</h1>
    @if($name == "domain")
    <div class="pagenation">
    <!-- note to programmer: above is the breadcrumb scenario if client orders domain first. -->
    <div class="clearfix"></div>
    &nbsp;<a href="{{url('/')}}">Home</a> <i>/</i> <a href="{{url('/dashboard')}}">Dashboard</a> <i>/</i> <a href="{{url('/my_account')}}">My Domains</a> <i>/</i> <a href="{{route('frontend.domain.registerNewLogin')}}">Register A New Domain</a> <i>/</i> <a href="{{url('/domain_configuration')}}">Domain Configuration</a> <i>/</i> <a href="{{url('/shopping_cart')}}">Shopping Cart</a> <i>/</i> <a href="{{url('/checkout_login')}}">Checkout</a> <i>/</i> Order Confirmation </div>
    @endif

    @if($name == "services")
    <div class="pagenation">
    <!-- note to programmer: below is the breadcrumb scenario if client order hosting or other services first, -->
    <div class="clearfix"></div>
    &nbsp;<a href="{{url('/')}}">Home</a> <i>/</i> <a href="{{url('/dashboard')}}">Dashboard</a> <i>/</i> <a href="shared_hosting.html">Shared Hosting</a> <i>/</i> <a href="domain_configuration_hosting_login.html">Choose a Domain</a> <i>/</i> <a href="{{url('/shopping_cart')}}">Shopping Cart</a> <i>/</i> <a href="{{url('/checkout_login')}}">Checkout</a> <i>/</i> Order Confirmation  </div>
    @endif

</div>
</div><!-- end page title -->

<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>

 <div class="one_full stcode_title9">
 	<h1 class="caps"><strong>Order Confirmation</strong></h1>
 </div>

<div class="clearfix"></div>

<div class="content_fullwidth">
	<div class="container">
	  @include('layouts.frontend_menu_login')
      <div class="three_fourth_less last">

           <div class="alertymes5">
                <h3 class="light"><i class="fa fa-check-circle"></i><strong>Your Invoice # is: MY-{{$orderID}}</strong>
                <br/>
             Your order has been successfully created.</h3>
        </div><!-- end section -->
           <div class="clearfix margin_bottom3"></div>

          <p class="text-18px dark light">Thank you for your order. You will receive a confirmation email shortly.</p>
          <p class="text-18px dark light">If you have any questions about your order, please open a support ticket from your client area and quote your invoice number.</p>

        <div class="clearfix"></div>
          <div class="divider_line7"></div>
          <div class="clearfix"></div>

          <div class="alicent">
                  <a href="{{url('/dashboard')}}" class="btn btn-danger caps"><i class="fa icon-user"></i> <b>Dashboard</b></a>&nbsp;
     </div>

      </div><!-- end section -->


    </div>
</div><!-- end content fullwidth -->

<div class="clearfix"></div>
<div class="divider_line"></div>
@endsection
