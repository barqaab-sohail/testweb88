<?php $page = 'billing_invoice_new'; ?>
@extends('layouts.admin_layout')
@section('title','Admin | Billing Invoice New')
@section('content')
@section('page_header','Billing')

<body>     
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Invoice <i class="fa fa-angle-right"></i> Add New</h2>
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
              <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#client-info" data-toggle="tab">Client Information</a></li>
              </ul> 
              
              <div id="myTabContent" class="tab-content">
              	<div id="client-info" class="tab-pane fade in active">
                  {{
                               Form::open(
                               [
                               'route' => ['new_invoice'],
                               'class' => 'form-horizontal'
                               ]
                               )
                               }}
                	<div class="invoice-title"><h2>Invoice</h2>
						        <h3 class="pull-right">Invoice #: MY-{{ $transaction_id}} </h3>
                  </div>
                	note to programmer: if new invoice is created, pls auto-generate a new invoice # according to the last # sequence.	
                	<div class="portlet">
                        <div class="portlet-header">
                          <div class="caption">General</div>
                          <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
          
                        </div><!-- end porlet header -->
                        
                        <div class="portlet-body">
                          <div class="row">
                    
                                <div class="col-md-6">
                                
                                      <!-- <div class="form-group">
                                        <label class="col-md-4 control-label">Client ID: </label>
                                        <div class="col-md-8">
                                           <p class="form-control-static"><a href="client_edit.html">Auto Fill in based on the client info below</a></p>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-4 control-label">Client Name: </label>
                                        <div class="col-md-8">
                                          <p class="form-control-static"><a href="client_edit.html">Auto fill in based on the client info below</a> (<a href="#">View all invoices of this client</a>)</p>
                                        </div>
                                      </div> -->
                                      
                                      <div class="form-group">
                                        <label class="col-md-4 control-label">Invoice Date: </label>
                                        <div class="col-md-8">
                                               <div class="input-group">
                                                 {{
                                                 Form::text(
                                                 'invoice-start-date',
                                                 date('m/d/Y', strtotime($date)),
                                                 [
                                                 'class'            => 'datepicker-default form-control',
                                                 'placeholder'      => 'mm/dd/yyyy',
                                                 'data-date-format' => 'mm/dd/yyyy'
                                                 ]
                                                 )
                                                 }}
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                              </div>
                                              @if ($errors->has('invoice-start-date'))
                                              <p class="text-danger">
                                                 {{ $errors->first('invoice-start-date') }}
                                              </p>
                                              @endif
                                            </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-4 control-label">Due Date: </label>
                                        <div class="col-md-8">
                                          <div class="input-group">
                                             {{
                                             Form::text(
                                             'invoice-due-date',
                                             date('m/d/Y', strtotime($date)),
                                             [
                                             'class'            => 'datepicker-default form-control',
                                             'placeholder'      => 'mm/dd/yyyy',
                                             'data-date-format' => 'mm/dd/yyyy'
                                             ]
                                             )
                                             }}
                                             <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                             </div>
                                          </div>
                                          @if ($errors->has('invoice-due-date'))
                                          <p class="text-danger">
                                             {{ $errors->first('invoice-due-date') }}
                                          </p>
                                          @endif
                                       </div>
                                      </div>
                                      <div class="form-group">
                                        <h5 class="col-md-4 control-label text-red"><b>Total:</b></h5>
                                        <div class="col-md-8">
                                            <h5 class="form-control-static text-red"><b>RM 0.00</b></h5>
                                        </div>
                                      </div>
                                    </div><!-- end col-md 6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Status: </label>
                                            <div class="col-md-6">
                                              <select class="form-control" name="status">
                                                <!-- <option value="COMPLETED">Paid</option> -->
                                                <option value="INCOMPLETE">UnPaid</option>
                                                <option value="FAILED">Payment failed</option>
                                              </select>
  
                                            </div>  
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-4 control-label">Payment Date: </label>
                                            <div class="col-md-8">
                                               <div class="input-group">
                                                {{
                                                 Form::text(
                                                 'invoice-payment-date',
                                                 date('m/d/Y', strtotime($date)),
                                                 [
                                                 'class'            => 'datepicker-default form-control',
                                                 'placeholder'      => 'mm/dd/yyyy',
                                                 'data-date-format' => 'mm/dd/yyyy'
                                                 ]
                                                 )
                                                 }}
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                @if ($errors->has('invoice-payment-date'))
                                                  <p class="text-danger">
                                                     {{ $errors->first('invoice-payment-date') }}
                                                  </p>
                                                  @endif
                                              </div>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-4 control-label">Payment Method: </label>
                                            <div class="col-md-8">

                                               {{
                                                  Form::select('invoice-payment-method',
                                                  $payment_methods,
                                                  '',
                                                  [
                                                  'class' => 'form-control'
                                                  ])
                                                  }}
                                                  @if ($errors->has('invoice-payment-method'))
                                                  <p class="text-danger">
                                                     {{
                                                     $errors->first('invoice-payment-method')
                                                     }}
                                                  </p>
                                                  @endif
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-4 control-label">Transaction ID: </label>
                                            <div class="col-md-8">
                                               {{
                                                Form::text(
                                                'order-txn-id',
                                                $transaction_id,
                                                [ 'class' => 'form-control' ]
                                                )
                                                }}
                                                @if ($errors->has('order-txn-id'))
                                                <p class="text-danger">
                                                   {{ $errors->first('order-txn-id') }}
                                                </p>
                                                @endif
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-4 control-label">Cheque #: </label>
                                            <div class="col-md-8">
                                               <input type="text" class="form-control" name="order-cheque-num" placeholder="eg. PBB304222">
                                            @if ($errors->has('order-cheque-num'))
                                            <p class="text-danger">
                                               {{ $errors->first('order-cheque-num') }}
                                            </p>
                                            @endif
                                            </div>
                                          </div>
                                    </div>
                             
                          </div><!-- end row -->
                        </div><!-- end porlet-body -->
                  </div><!-- end portlet -->
                  <div class="portlet">
                    <div class="portlet-header">
                          <div class="caption">Client Information</div>
                          <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
          
                        </div><!-- end porlet header -->
                           
                        <div class="portlet-body">
                          <div class="row">
                          	<div class="col-md-12">
                            	
                                 	<div class="form-group">	
                                    <label class="col-md-3 control-label">The Invoice is For <span class="text-red">*</span></label>
    										              <div class="col-md-6">
                                        <div class="radio-list">
                                        	<label>
                                       {{
                                       Form::radio(
                                       'user-client-process',
                                       'existing-user',
                                       True
                                       )
                                       }}
                                       &nbsp; Existing Client
                                       </label>
                                            <div class="clearfix"></div>
                                            <label>Filter Exisiting Client By</label>
                                            <select name="user-account-type" class="form-control order-client-type invoice-existing-client-field">
                                                <option value="all">
                                                 All
                                              </option>
                                              <option value="business-account">
                                                 Business Account
                                              </option>
                                              <option value="individual-account">
                                                 Individual Account
                                              </option>
                                            </select>
                                            <div class="clearfix xs-margin"></div>
                                            <select name="user-client-target" class="form-control user-client-target invoice-existing-client-field">
                                              <option value="_default">
                                                 - Please select -
                                              </option>

                                              @if ($data['user_client_accounts'])
                                              @foreach ($data['user_client_accounts'] as $user_id => $user)
                                              <option value="{{ $user_id }}" data-type="{{ $user['type'] }}">
                                                 {{ $user['label'] }}
                                              </option>
                                              @endforeach
                                              @endif
                                           </select>
                                           @if($errors->has('user-client-target'))
                                           <p class="text-danger">
                                              {{ $errors->first('user-client-target') }}
                                           </p>
                                           @endif
                                            <div class="clearfix xs-margin"></div>
                                            note to programmer: "B-000001-MY". B indicates client registered as "Business Account". "0000001" indicates running number. "MY" indicates country code.
                                            "I-000001-MY". I indicates client registered as "Individual Account". "0000001" indicates running number. "MY" indicates country code.
                                            <label>
                                       {{
                                       Form::radio(
                                       'user-client-process',
                                       'new-user',
                                       False
                                       )
                                       }}
                                       &nbsp; New Client
                                       </label>
                                           
                                         </div>
                                    </div>
                                   </div>  
                              <div class="new_client_data">
                              <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 Account type <span class="text-red">*</span>
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::select(
                                    'user-client-account-type',
                                    [
                                    '_default' => '- Please select -',
                                    'business-account' => 'Business Account',
                                    'individual-account' => 'Individual Account'
                                    ],
                                    '',
                                    [
                                    'class' => 'form-control invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-account-type'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-account-type') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 First Name <span class="text-red">*</span>
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::text(
                                    'user-client-first-name',
                                    '',
                                    [
                                    'class' => 'form-control invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-first-name'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-first-name') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 Last Name <span class="text-red">*</span>
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::text(
                                    'user-client-last-name',
                                    '',
                                    [
                                    'class' => 'form-control invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-last-name'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-last-name') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 Company <span class="text-red">*</span>
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::text(
                                    'user-client-company',
                                    '',
                                    [
                                    'class' => 'form-control invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-company'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-company') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 Email Address <span class="text-red">*</span>
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::text(
                                    'user-client-email',
                                    '',
                                    [
                                    'class' => 'form-control invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-email'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-email') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 Phone <span class="text-red">*</span>
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::text(
                                    'user-client-phone-number',
                                    '',
                                    [
                                    'class' => 'form-control invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-phone-number'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-phone-number') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 Mobile Phone <span class="text-red">*</span>
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::text(
                                    'user-client-mobile-number',
                                    '',
                                    [
                                    'class' => 'form-control invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-mobile-number'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-mobile-number') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                               <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 Country <span class="text-red">*</span>
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::select(
                                    'user-client-country',
                                    $data['countries'],
                                    '',
                                    [
                                    'class' => 'form-control user-client-country invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-country'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-country') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 State <span class="text-red">*</span>
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::select(
                                    'user-client-state',
                                    (session('states')) ? session('states') : [ '_default' => '- Please select -' ],
                                    '',
                                    [
                                    'class' => 'form-control user-client-state invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-state'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-state') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 City <span class="text-red">*</span>
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::select(
                                    'user-client-city',
                                    (session('cities')) ? session('cities') : [ '_default' => '- Please select -' ],
                                    '',
                                    [
                                    'class' => 'form-control user-client-city invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-city'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-city') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 Postal Code <span class="text-red">*</span>
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::text(
                                    'user-client-postal-code',
                                    '',
                                    [
                                    'class' => 'form-control invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-postal-code'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-postal-code') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 Address <span class="text-red">*</span>
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::text(
                                    'user-client-address-1',
                                    '',
                                    [
                                    'class' => 'form-control invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-address-1'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-address-1') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                 <label for="inputFirstName" class="col-md-3 control-label">
                                 Address 2
                                 </label>
                                 <div class="col-md-6">
                                    {{
                                    Form::text(
                                    'user-client-address-2',
                                    '',
                                    [
                                    'class' => 'form-control invoice-new-user-field',
                                    'disabled' => true
                                    ]
                                    )
                                    }}
                                    @if ($errors->has('user-client-address-2'))
                                    <p class="text-danger">
                                       {{ $errors->first('user-client-address-2') }}
                                    </p>
                                    @endif
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              
                              
                              
                             
                              <div class="clearfix"></div>     
                              </div>             
                                          
                            </div>
                            <!-- end col-md-12 -->
                            
                          </div>
                          <!-- end row -->
                          <div class="md-margin"></div>    
                            
                       </div><!-- end porlet-body -->   
                       <div class="clearfix"></div>
                       
                       
                       <div class="form-actions">
                       		<div class="col-md-offset-5 col-md-7">
                            {{
                              Form::button(
                              "Save &nbsp;<i class='fa fa-floppy-o'></i>",
                              [
                              'type'  => 'submit',
                              'class' => 'btn btn-red'
                              ]
                              )
                              }}&nbsp;
                              <a href="#" data-dismiss="modal" class="btn btn-green">
                              Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i>
                              </a>
                            </div>
                       </div>
                                 
                  </div><!-- End porlet -->
                  {{ Form::close() }} 
                  
                </div><!-- end tab client info -->
                
                
                
                
                
              </div>
              <!-- end tab content -->
                
              
            </div><!-- end col-lg-12 -->

				
          </div><!-- end row -->
        </div>
        <!-- InstanceEndEditable -->
        <!--END CONTENT-->
@section('custom_scripts')
<script src="{{url('').'/resources/assets/admin/'}}js/tableHTMLExport.js"></script>
{{-- <script src="/js/tableHTMLExport.js"></script> --}}<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.10/jspdf.plugin.autotable.min.js"></script>
<script>
   $(document).ready(function() {
       $('.new_client_data').hide();
     if ($('input[name="user-client-process"]:checked').val() === 'new-user') {
       $('.invoice-existing-client-field').prop('disabled', true);
       $('.new_client_data').show();
       $('.invoice-new-user-field').show();
       $('.invoice-new-user-field').prop('disabled', false);
     }else{
      // $('.new_client_data').hide();
     }
   
     $('.user-client-country').on('change', function (event) {
       var country_id = event.target.value;
   
       $('.user-client-state option:gt(0)').remove();
   
       if (country_id !== '_default') {
         $.ajax({
           url: '/get_state/' + country_id,
           type: 'GET'
         })
         .done(function(response) {
           var state_dropdown = $('.user-client-state');
   
           response.forEach(function (element) {
             var new_state = $('<option></option>').attr('value', element.id)
                                               .text(element.name);
             state_dropdown.append(new_state);
           });
         });
       }
     });
   
     $('.user-client-state').on('change', function (event) {
       var state_id = event.target.value;
   
       $('.user-client-city option:gt(0)').remove();
   
       if (state_id !== '_default') {
         $.ajax({
           url: '/get_city/' + state_id,
           type: 'GET'
         })
         .done(function(response) {
           var state_dropdown = $('.user-client-city');
   
           response.forEach(function (element) {
             var new_cities = $('<option></option>').attr('value', element.id)
                                               .text(element.name);
             state_dropdown.append(new_cities);
           });
         });
       }
     });
   
     $('.order-client-type').on('change', function (event) {
       var account_type = event.target.value;
   
       $('.user-client-target option:gt(0)').remove();
   
       $.ajax({
         url: '/admin/users?account_type=' + account_type,
         type: 'GET'
       })
       .done(function(response) {
         var users_dropdown = $('.user-client-target');
   
         var users_key = Object.keys(response);
         users_key.forEach(function (element) {
           var new_users = $('<option></option>').attr('value', element)
                                             .attr('data-type', response[element].type)
                                             .text(response[element].label);
           users_dropdown.append(new_users);
         });
       });
     });
   
     /**
      * User Account type events: Change target client user
      */
     $('input[name="user-client-process"]').on('click', function() {
       value = $('input[name="user-client-process"]:checked').val();
   
       if (value === 'existing-user') {
         $('.invoice-existing-client-field').prop('disabled', false);
         $('.invoice-new-user-field').prop('disabled', true);
         $('.new_client_data').hide();
       } else {
         $('.invoice-existing-client-field').prop('disabled', true);
         $('.invoice-new-user-field').prop('disabled', false);
         $('.new_client_data').show();
       }
     })
   });
</script>

@endsection            
@endsection
