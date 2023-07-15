﻿@php

$breadcrumbs = [
/* array('url' => '/services/'.$_GET['url'] , 'name' => $_GET['name'] ),
*/ array('url' => false, 'name' => 'Choose a Domain'),
];
@endphp
@extends('layouts.frontend_layout')
@section('title','Home | - Webqom Technologies')
@section('content')
@section('page_header','Order')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>
<?php
if (isset($response->price_list->pricing) && !empty($response->price_list->pricing)) {
  $pricing_list = json_decode($response->price_list->pricing);
}
$page_name = '';
if (isset($server_details)) {
  $details = json_encode($server_details);
  $details = json_decode($details);
  if (isset($details->page_name)) {
    $page_name = $details->page_name;
  } else {
    $page_name = '';
  }
  // $page_name = $details->page_name;

}

?>

<div class="one_full stcode_title9">
  <h1 class="caps"><strong>Choose a Domain</strong></h1>
</div>

<div class="clearfix"></div>

<div class="content_fullwidth">
  <div class="container">

    <div class="one_full_less">
      <div class="cforms alileft">

        <div id="form_status"></div>
        <form method="POST" id="gsr-contact">
          {{csrf_field()}}
          <input type="hidden" name="server_configuration_details" value="{{ json_encode($server_details) }}">
          <input type="hidden" id="plan_id" name="plan_id" value="{{isset($_GET['id']) ? $_GET['id'] : $id}}">
          <input type="hidden" id="page_name" name="page_name" value="{{isset($_GET['name']) ? $_GET['name'] : $page_name}}">
          <input type="hidden" id="domain_name" value="{{request('domain')}}" <input type="hidden" name="type" value="1" id="transfer_text">
          <h4>Please Enter Your Domain:</h4>
          <div class="radiobut">
            <input type="radio" name='rd' class='rd rd1' @if(empty(request('search_domain'))) checked="checked" @endif> <span class="onelb">I want to register a new domain</span>
            <div class="clearfix"></div>
            <input type="radio" name='rd' @if(!empty(request('search_domain'))) checked="checked" @endif data-rel="already_exist_domain" class='rd rd2 existing_domain'><span class="onelb"> I already have a domain</span>
            <input type="hidden" value="{{!empty(request('search_domain')) ? 1 : 0}}" name="already_exist_domain" id="already_exist_domain" />
          </div>
          <div class="clearfix"></div>

          <div class="one_full_less">
            <input type="text" name="search_domain" id="domain_text" value="{{isset($_GET['search_domain']) ? $_GET['search_domain'] : ''}}" required placeholder="eg. yourdomain.com">
            <input type="hidden" name="hosting_name" id="hosting_name" value="{{isset($_GET['name']) ? $_GET['name'] : ''}}">
            <input type="hidden" name="url" id="url" value="{{isset($_GET['url']) ? $_GET['url'] : ''}}">
            <div class="alicent" id="success_addcart">
              <a href="javascript:void(0)" style="{{!empty(request('search_domain')) ? 'display:none' : ''}}" class="btn btn-danger  caps chk_btn check_availablity"><i style="display:none" class="fa fa-lg fa-spinner chk_avl_spnr"></i> <b>Check Availability</b></a>&nbsp;
              <!-- <a href="{{ route('frontend.shopping_cart') }}" style='display: none' class="btn btn-danger caps cnt_btn"><i class="fa fa-arrow-circle-right"></i> <b>Continue</b></a>&nbsp; -->
              <button type="submit" style=" {{!empty(request('search_domain')) ? '' : 'display: none'}}" class="btn btn-danger caps cnt_btn"><i class="fa fa-arrow-circle-right"></i> <b>Continue</b></< /button>&nbsp;
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="divider_line7"></div>
          <div class="clearfix"></div>

          @if(isset($response) && !empty($response->taken) && $err_preg != 1)

          @foreach($response->error as $k => $err)
          @if($err->status == 4)
          <div class="alertymes4 match_nt_found">
            <h3 class="light red"><i class="fa fa-times-circle"></i>This is a premium domain name, please contact us at <strong>support@webqom.com</strong> if you wish to register this domain name.</h3>
          </div>
          @elseif($err->status == 5)
          <div class="alertymes4 match_nt_found">
            <h3 class="light red"><i class="fa fa-times-circle"></i>Something went wrong.</h3>
          </div>
          @elseif($err->status == 1)
          <div class="alertymes4 match_nt_found">
            <h3 class="light red"><i class="fa fa-times-circle"></i><strong>Sorry</strong> This is already taken!</h3>
          </div>
          @else
          <div class="alertymes4 match_nt_found">
            <h3 class="light red"><i class="fa fa-times-circle"></i>Invalid domain name/extension!</h3>
          </div>
          @endif
          @endforeach
          <div class="clearfix margin_bottom3"></div>
          <div class="clearfix margin_bottom1"></div>
          <div class="table-responsive match_nt_found">
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                  <th width="1%"><input type="checkbox" /></th>
                  <th>Domain Name</th>
                  <th>Status</th>
                  <th>More Info</th>
                </tr>
              </thead>
              <tbody>

                <tr>
                  <td class="alicent"><i class="fa fa-times red"></i></td>
                  <td class='search_text'>{{$_GET['search_domain']}}</td>
                  <td><span class="label label-sm label-red">Unavailable</span></td>
                  <td><a href="http://{{$_GET['search_domain']}}" id='www' target="_blank">WWW</a> | <a id='who_is' href="/whois/{{$_GET['search_domain']}}">WHOIS</a></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4"></td>
                </tr>
              </tfoot>
            </table>

            <div class="clearfix"></div>

          </div><!-- end table responsive -->
          @elseif(isset($response) && !empty($response)&& $err_preg != 1)

          <div class="alertymes5 match_found">
            <h3 class="light"><i class="fa fa-check-circle"></i>Congratulations! <strong class='search_text'>{{$_GET['search_domain']}}</strong> is available!</h3>
          </div><!-- end section -->
          <div class="clearfix margin_bottom3"></div>
          <div class="table-responsive">

            <table class="table table-hover table-striped match_found">
              <thead>
                <tr>
                  <th width="1%"><input id="all" type="checkbox" /></th>
                  <th>Domain Name</th>
                  <th>Status</th>
                  <th>More Info</th>
                </tr>
              </thead>
              <tbody>

                <tr>
                  <td class="alicent"><input class="single" type="checkbox" /></td>
                  <td class='search_text'>{{$_GET['search_domain']}}</td>
                  <td><span class="label label-sm label-success">Available</span></td>
                  <td>
                    <select class="form-control input-medium">
                      @if(isset($pricing_list) && !empty($pricing_list))
                      @foreach($pricing_list as $key => $price)
                      @if($price->s > 0)
                      <option value="{{$key}}-{{$price->s}}" <?php echo ($key == 1) ? 'selected="selected"' : ""; ?>>{{$key}} year(s) @ RM {{number_format($price->s, 2)}}</option>
                      @endif
                      @endforeach
                      @endif
                    </select>

                  </td>
                </tr>

              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4"></td>
                </tr>
              </tfoot>
            </table>

            <div class="clearfix"></div>

          </div><!-- end table responsive -->

          @endif
        </form>
        <form method="post" action="/shopping_cart" id="shopping_cart_form">
          {{csrf_field()}}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <!-- <input type="hidden" id="page" name="page" value="{{isset($_GET['name']) ? $_GET['name'] : ''}}"> -->
        </form>
      </div>

      <div class="clearfix"></div>
      <div id="myModal" class="modal fade in" role="dialog" <?php if ($err_preg != 1) {
                                                              echo 'style="display: none;"';
                                                            } else {
                                                              echo 'style="display: block;"';
                                                            } ?> aria-hidden="false">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="modal-title">Error</h4>
            </div>
            <div class="modal-body">
              <p>Please use only these symbols: "@" and "." where applicable.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
      <div class="divider_line7"></div>
      <div class="clearfix"></div>
      <div class="alicent bottom_ctn_btn" style='display: none'>
        <button class="btn btn-danger caps" onclick="submitFormData();"><i class="fa fa-arrow-circle-right"></i> <b>Continue</b></button>&nbsp;
      </div>

    </div><!-- end section -->

  </div>
</div><!-- end content fullwidth -->

<div class="clearfix"></div>
<div class="divider_line"></div>
<div class="clearfix"></div>

<script type='text/javascript'>
  $(document).ready(function() {
    $(".top_nav").addClass("hide_margin");
    $('.rd').click(function() {
      $('.match_found, .bottom_ctn_btn, .match_nt_found').hide();
      if ($(this).hasClass('rd1')) {
        // alert(123); new domain registration
        $('#already_exist_domain').val(0);
        $('.chk_btn').show();
        $('.cnt_btn').hide();
      } else {
        // alert(321); already exists domain
        $('#already_exist_domain').val(1);
        $('.cnt_btn').show();
        $('.chk_btn').hide();
      }
    });

    $('.alicent input').change(function() {
      if ($('.alicent input:checked').length > 0) {
        $('.bottom_ctn_btn').show();
      } else {
        $('.bottom_ctn_btn').hide();
      }
    });

    $('.check_availablity').click(function() {
      var search_val = $('#domain_text').val();
      var plan_id = $('#plan_id').val();
      var page_name = $('#page_name').val();

      format = /[ !@#$%^&*_+\-=\[\];:\\|,<>\/?]/;
      var result = format.test(search_val);
      if (search_val.trim(' ') != '' && result == false) {

        window.location.href = "/domain_configuration_hosting?search_domain=" + search_val + "&id=" + plan_id + "&name=" + page_name + "#success_addcart";
      } else {
        $('#myModal').show();
      }
    });


    $("#all").click(function() {
      $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('[data-dismiss="modal"]').click(function() {
      $('#myModal').hide();
    });


    /*Service + Domain + add items to cart*/
    $(document).on("submit", "#gsr-contact", function(e) {

      e.preventDefault();

      var qty = 1;
      var split_delimeter = ' ';

      var selected = $('.input-medium option:selected').val();
      selected = $.trim(selected);
      selected = selected.split('-');

      //get price
      var price = selected[selected.length - 1];
      //get price - end

      //get cycle
      var cycle = selected[0];
      //get cycle - end


      // var values = JSON.parse(JSON.stringify($(this).serializeArray()));

      var values = {};
      $.each($(this).serializeArray(), function(i, field) {
        values[field.name] = field.value;
      });
      var domain = values["search_domain"];
      var plan_id = values["plan_id"];
      var page_name = values["page_name"];
      var type = values['type']

      $.ajax({
        type: 'POST',
        url: '/add_to_cart',
        data: {

          domain: domain,
          qty: qty,
          price: price,
          cycle: 1,
          domain_cycle: cycle,
          plan_id: plan_id,
          type: type,
          page: page_name
        },
        success: function(data) {
          console.log(data);
          if (data.success == true) {
            toastr.success(data.errors.message, 'Success');
            $('#shopping_cart_form').submit();

            // window.location = '/shopping_cart';
            // $('#cart_item_id').text(parseInt($('#cart_item_id').text()) + 1);
            // $('#checkout_smt').show();

          } else {

            toastr.success(data.errors.message, 'Error');
            // $('#checkout_smt').show();
          }
        },

      });
    });

  });

  function submitFormData() {
    $("#gsr-contact").submit();
  }
</script>
<style type="text/css">
  .hide_margin {
    margin-top: -23px !important;
  }
</style>

@endsection