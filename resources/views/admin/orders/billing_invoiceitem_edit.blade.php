  <?php //if ($orders['orders'] instanceof \Illuminate\Pagination\LengthAwarePaginator): 
   ?>
  <?php //$per_page=$orders['orders']->perPage(); 
   ?>
  <?php //else: 
   ?>
  <?php //$per_page=10; 
   ?>
  <?php //endif 
   ?>
  <?php $page  = 'orders';
   $breadcrumbs = [
      array('url' => url(''), 'name' => 'Billing'),
      array('url' => url('admin/orders_list'), 'name' => 'Invoice Listing'),
      array('url' => url(''), 'name' => 'Invoice - Edit'),

   ];

   $total_price = 0;
   $discount_price = 0.00;
   $discount = 0.00;


   ?>
  @extends('layouts.admin_layout')
  @section('title','Admin | Billing Invoice Edit')
  @section('content')
  @section('page_header','Billing')
  <div class="page-content">
     <div class="row">
        <div class="col-lg-12">
           <h2>Invoice Item <i class="fa fa-angle-right"></i> Edit</h2>
           <div class="clearfix"></div>
           <div class="col-lg-12">
              <!-- <h2>View All Orders <i class="fa fa-angle-right"></i> Listing</h2> -->
              <div id="success"></div>
              <div class="clearfix"></div>
              @if (session('update_status') === True)
              <div class="alert alert-success alert-dismissable">
                 <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                 <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                 <p>{{ session('update_message') }}</p>
              </div>
              @endif
              @if (session('update_status') === False )
              <div class="alert alert-danger alert-dismissable">
                 <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                 <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                 <p>{{ session('update_message') }}</p>
              </div>
              @endif
              <div class="clearfix"></div>
              <div class="pull-left"> Last updated:
                 <span class="text-blue">
                    {{ date('d M, Y @ g:i A', strtotime($data['lastUpdated'])) }}
                 </span>
              </div>
           </div>
           <div class="clearfix"></div>
           <p></p>
           <div class="clearfix"></div>

           <div id="myTabContent" class="tab-content">
              @if ($errors->any())
              <div class="alert alert-danger">
                 <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                 </ul>
              </div>
              @endif
              @include('admin.orders.inc.update_invoice', compact('data'))
           </div>
           <!-- end tab content -->
        </div>

        <!-- end col-lg-12 -->
     </div>
     <!-- end row -->
  </div>
  <!-- InstanceEndEditable -->
  <!--END CONTENT-->




  @section('custom_scripts')
  <script type="text/javascript" src="https://malsup.github.io/jquery.form.js"></script>
  <script>
     $(document).ready(function() {
        $('.hosting').hide();

        $("#service_plan").on('change', function(e) {
           var val = $(this).val();
           if (val == 'custom_plan') {
              $('#custom_plan_data').show();
              $('#custom_plan_category').show();
              $('#custom_plan_code').show();
              $('#custom_plan_box').show();
           }
           $.ajax({
                 url: '/admin/get_plan_detail/' + val,
                 type: 'GET'
              })
              .done(function(response) {
                 const obj = JSON.parse(response);
                 console.log(obj.status);
                 if (obj.status === 1) {
                    if (obj.plans.setup_fee_one_time == '0' || obj.plans.price_type == "Free") {

                       text = '<i class="fa fa-check sitecolor"></i>';
                       $('#setuptext').html('Setup Free');
                       $('#setupfree').hide();
                    } else {
                       $('#setupfree').val(obj.plans.setup_fee_one_time);
                    }
                    if (obj.plans.price_annually == '0' || obj.plans.price_annually == '' || obj.plans.price_type == "Free") {
                       $('#unit_price').val('0.00');
                    } else {
                       $('#cycle').val(1);
                       $("#quantity").val(1);
                       $('#unit_price').val(obj.plans.price_annually);
                    }

                 } else {

                 }
              });

        })
        $('.category_plan').on('change', function(event) {
           var cat_id = event.target.value;
           $.ajax({
              url: '{{ url("/admin/invoice/categoryProducts") }}',
              type: 'POST',
              dataType: 'json',
              data: '_token=<?php echo csrf_token() ?>&category_id=' + cat_id,
              beforeSend: function() {

              },
              complete: function() {

              },
              success: function(response) {
                 var html = '';
                 var categoryplan = $('.service_plan');
                 console.log(response);
                 console.log(response['discount']);

                 if (response['discount']) {
                    const obj = response['discount'];
                    $('#discount_amount').val(obj.discount);
                    $('#discount_name').val(obj.discount_name);
                    if (obj.discount_by === 'amount') {
                       $('#percentage option[value="RM"]').attr("selected", "selected");

                    } else {
                       $('#percentage option[value="%"]').attr("selected", "selected");

                    }

                    $('#discount_id').val(obj.id);
                 }
                 if (response['promocode']) {
                    // const promo = JSON.parse(response['promocode']);
                    const promo = response['promocode'];
                    $('#promo_code').val(promo.promo_code);
                    if (promo.discount_type === 'P') {
                       $('#promo_type option[value="%"]').attr("selected", "selected");
                    } else {

                       $('#promo_type option[value="RM"]').attr("selected", "selected");
                    }
                    $('#promo_id').val(obj.discount);
                 }
                 categoryplan.empty().prepend('<option value="-1">- Please select -</option><option value="custom_plan">Custom Plan/Package</option>');
                 if (response['products']) {
                    for (var i = 0; i < response['products'].length; i++) {
                       elm = response['products'][i];
                       console.log(elm);
                       var option = $('<option></option>').attr('value', elm.id)
                          .text(elm.plan_name);

                       categoryplan.append(option);
                    }

                 }
              }
           });
        })
        $('.disc_name').on('change', function(event) {
           var discount_id = event.target.value;

           if (discount_id !== -1) {
              $.ajax({
                    url: '/admin/get_discount/' + discount_id,
                    type: 'GET'
                 })
                 .done(function(response) {
                    const obj = JSON.parse(response);

                    $('#discount_amount').val(obj.discount);
                    if (obj.discount_by === 'amount') {
                       $('#percentage option[value="RM"]').attr("selected", "selected");

                    } else {
                       $('#percentage option[value="%"]').attr("selected", "selected");

                    }
                 });
           }
        });

        /**
         * User Account type events: Change target client user
         */


        $('.rd').click(function() {
           $('#domain_text, #bulk_text').hide();

           if ($(this).hasClass('rd4')) {
              // alert(123); new domain registration
              $('#already_exist_domain').val(0);
              $('#bulk_text').show();
              $('.bulk_availability').show();
              $('.check_availablity').hide();
              $('#domain_text').hide();
           }
           if ($(this).hasClass('rd1')) {
              $('.check_availablity').hide();
              $('#domain_text').show();
           } else {
              // alert(321); already exists domain
              $('#already_exist_domain').val(1);
              $('#domain_text').show();
              $('#bulk_text').hide();
              $('.bulk_availability').hide();
              $('.check_availablity').show();
           }
        });
        $('.bulk_availability').click(function() {

        })
        $('.check_availablity').click(function() {
           var search_val = $('#domain_text').val();
           var CSRF_TOKEN = $('meta[name="csrf-token"').attr('content');

           format = /[ !@#$%^&*_+\-=\[\];:\\|,<>\/?]/;
           var result = format.test(search_val);
           if (search_val.trim(' ') != '' && result == false) {
              $.ajax({
                 url: base_url + '/admin/check_domain_availablity',
                 type: 'POST',
                 data: {
                    '_token': csrf_token,
                    'search_domain': search_val
                 },
                 dataType: 'Json',
                 success: function(data) {
                    console.log(data);
                    $('.single_pricing_table').show();
                    if (data['response'] && data['response']['taken'] !== '') {
                       let error_list = data['response']['error'];
                       var html = '';
                       $.each(error_list, function(k, err) {
                          console.log(err.status);
                          if (err.status == 4) {
                             html = '<div class="alertymes4 match_nt_found" >' +
                                '<h3 class="light red"><i class="fa fa-times-circle"></i>This is a premium domain name, please contact us at <strong>support@webqom.com</strong> if you wish to register this domain name.</h3>' +
                                '</div>';
                          } else if (err.status == 5) {
                             html = '<div class="alertymes4 match_nt_found" >' +
                                '<h5 class="light red"><i class="fa fa-times-circle"></i>Something went wrong.</h5>' +
                                +'</div>';
                          } else if (err.status == 1) {
                             html = '<div class="alertymes4 match_nt_found" >' +
                                '<h5 class="light red"><i class="fa fa-times-circle"></i><strong>Sorry</strong> This is already taken!</h5>' +
                                '</div>';

                          } else {
                             html = '<div class="alertymes4 match_nt_found">' +
                                '<h5 class="light red"><i class="fa fa-times-circle"></i>Invalid domain name/extension!</h5>' +
                                '</div>';
                          }
                       });

                    } else {
                       html = '<div class="alertymes5 match_found">' +
                          '<h5 class="light"><i class="fa fa-check-circle"></i>Congratulations! <strong class="search_text">Domain</strong> is available!</h5>' +
                          '</div>';
                       let price = JSON.parse(data['response']['price_list']['pricing']);
                       $('#domain_pricing').empty().prepend('<option value="-1">Select Domain Pricing</option>');

                       $.each(price, function(k, val) {
                          // console.log('k' + k +' v: '+val.s);
                          var $selected = (k == 1) ? 'selected="selected"' : "";
                          var $option = $("<option " + $selected + " ></option>").val(k + '-' + val.s).text(k + ' Year(s) @RM ' + val.s);
                          $("#domain_pricing").append($option).trigger('change');
                       });
                    }
                    $('#domain_status').html(html);


                 }
              });
           } else {
              alert('error');
           }
        });

        /*$('.search_form').submit(function() {
         if($('input[name="transaction_id"]').val() == "" || $('input[name="id"]').val() == "" ||
            $('input[name="client_name"]').val() == "" || $('input[name="client_id"]').val() == ""){
   
           toastr.success("one of the 4 fields invoice, receipt, client name, client ID are mandatory for Search orders", 'Error');
           return false;
         }
   
     });*/
        /* $(document).on('click', '.empty_cart', function(event) {
         });*/
     });
  </script>

  @endsection
  @endsection