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
?>
@extends('layouts.admin_layout')
@section('title','Admin | Billing Invoice Edit')
@section('content')
@section('page_header','Billing')

<div class="page-content">
  <div class="row">
    <div class="col-lg-12">
      <h2>Invoice <i class="fa fa-angle-right"></i> Edit</h2>
      <div class="clearfix"></div>

      <div class="col-lg-12">
        <!-- <h2>View All Orders <i class="fa fa-angle-right"></i> Listing</h2> -->
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

        @if(isset($search_success))
        <div class="alert alert-success alert-dismissable">
          <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
          <i class="fa fa-check-circle"></i> <strong>Success!</strong>
          <p>{{$search_success}}</p>
        </div>
        @endif
        @if(isset($search_error))
        <div class="alert alert-danger alert-dismissable">
          <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
          <i class="fa fa-times-circle"></i> <strong>Error!</strong>
          <p>{{$search_error}}</p>
        </div>
        @endif
        <div class="clearfix"></div>
        <div class="pull-left"> Last updated:
          <span class="text-blue">
            {{ date('d M, Y @ g:i A', strtotime($data['lastUpdated'])) }}
          </span>
        </div>
      </div>

      <div class="pull-right">
        <a href="#" class="btn btn-danger">Print &nbsp;<i class="fa fa-print"></i></a>&nbsp;
        <a onclick="pdf_out()" class="btn btn-danger">Download PDF &nbsp;<i class="fa fa-cloud-download"></i></a>
        <a href="#" data-target="#modal-add-email" data-toggle="modal" class="btn btn-danger">Email as PDF &nbsp;<i class="fa fa-envelope"></i></a>&nbsp;
        <a href="#" data-target="#modal-generate-receipt" data-toggle="modal" class="btn btn-danger">Generate Receipt &nbsp;<i class="fa fa-file"></i></a>&nbsp;
      </div>
      <!--Modal email as pdf start-->
      <div id="modal-add-email" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-wide-width">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
              <h4 id="modal-login-label2" class="modal-title">Email as PDF</h4>
            </div>
            <div class="modal-body">
              <div class="form">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Status</label>
                    <div class="col-md-6">
                      <div data-on="success" data-off="primary" class="make-switch">
                        <input type="checkbox" checked="checked" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Default Email <span class="text-red">*</span></label>
                    <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" placeholder="Email Address" class="form-control" value="hock@webqom.com" />
                      </div>
                      note to programmer: default email will be auto displayed here.
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email 2</label>
                    <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" placeholder="Email Address" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email 3</label>
                    <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" placeholder="Email Address" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email 4</label>
                    <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" placeholder="Email Address" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email 5 </label>
                    <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" placeholder="Email Address" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email 6</label>
                    <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" placeholder="Email Address" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email 7</label>
                    <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" placeholder="Email Address" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email 8</label>
                    <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" placeholder="Email Address" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email 9</label>
                    <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" placeholder="Email Address" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email 10</label>
                    <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" placeholder="Email Address" class="form-control" />
                      </div>
                    </div>
                  </div>
                  note to programmer: once user clicks "send", there shall be a progress bar to show the emails being sent. Once completed, it shall show "Success" notification otherwise "Error" notification.
                  <div class="form-actions">
                    <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Send &nbsp;<i class="fa fa-send-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--END MODAL email as pdf-->
      <!--Modal generate receipt start-->
      <div id="modal-generate-receipt" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to generate receipt? </h4>
            </div>
            <div class="modal-body">
              note to programmer: if the selection is "yes", it will show a progress bar that it is converting. Once the conversion is success, shows the "Success" notification and link it to that receipt.
              <div class="form-actions">
                <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- modal generate receipt end -->
      <div class="clearfix"></div>
      <p></p>
      <div class="clearfix"></div>


      <ul id="myTab" class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#client-info" data-toggle="tab">Client Information</a></li>
        <li><a href="#invoice-items" data-toggle="tab">Invoice Items</a></li>
      </ul>

      <div id="myTabContent" class="tab-content">
        <div id="client-info" class="tab-pane fade in active">
          {{
                    Form::open(
                      [
                        'route' => [ 'update_order', $data['order']->id ],
                        'class' => 'form-horizontal'
                      ]
                    )
                  }}
          <div class="invoice-title">
            <h2>Invoice</h2>
            <h3 class="pull-right">
              Invoice #: MY-{{ $data['order']->transaction_id }}
              <div class="xs-margin"></div>
              Receipt #: {{ $data['order']->id }}
            </h3>
          </div>
          note to programmer: if new invoice is created, pls auto-generate a new invoice # according to the last # sequence and the new inovice status is set to "Unpaid". If this is a "Paid" invoice/order, pls display the "Receipt #".
          <div class="portlet">
            <div class="portlet-header">
              <div class="caption">General</div>
              <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
            </div><!-- end porlet header -->
            <div class="portlet-body">
              <div class="row">
                <!--  Order Form: Start  -->
                <div class="form-horizontal">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-md-4 control-label">Client ID: </label>
                      <div class="col-md-8">
                        <p class="form-control-static">
                          <a href="client_edit.html">
                            {{ $data['order']->user->user_client_id }}
                          </a>
                        </p>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label">
                        Client Name:
                      </label>
                      <div class="col-md-8">
                        <p class="form-control-static">
                          @if ($data['order']->user->full_name)
                          <a href="client_edit.html">
                            {{ $data['order']->user->full_name }}
                          </a>
                          @else
                          <span>
                            <em>No name provided</em>
                          </span>
                          @endif
                          (<a href="#">View all invoices</a>)
                        </p>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label">
                        Invoice Date:
                      </label>
                      <div class="col-md-8">
                        <div class="input-group">
                          {{
                                      Form::text(
                                        'order-invoice-date',
                                        date('m/d/Y', strtotime($data['order']->created_at)),
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
                        @if ($errors->has('order-invoice-date'))
                        <p class="text-danger">
                          {{ $errors->first('order-invoice-date') }}
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
                                        'order-due-date',
                                        date('m/d/Y', strtotime($data['order']->due_date)),
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
                        @if ($errors->has('order-due-date'))
                        <p class="text-danger">
                          {{ $errors->first('order-due-date') }}
                        </p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <h5 class="col-md-4 control-label text-red">
                        <b>Total:</b>
                      </h5>
                      <div class="col-md-8">
                        <h5 class="form-control-static text-red">
                          <b>RM {{ number_format($data['order']->total_amount, 2) }}</b>
                        </h5>
                      </div>
                    </div>
                  </div>
                  <!-- end col-md 6 -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-md-4 control-label">Status: </label>
                      <div class="col-md-6">
                        <div class="btn-group">
                          @if ($data['order']->status === 'COMPLETED')
                          <button type="button" class="btn btn-success">
                            Paid
                          </button>
                          <button type="button" data-toggle="dropdown" class="btn btn-success dropdown-toggle">
                            <span class="caret"></span>
                            <span class="sr-only">
                              Toggle Dropdown
                            </span>
                          </button>
                          @elseif ($data['order']->status === 'INCOMPLETE')
                          <button type="button" class="btn btn-warning">
                            Unpaid
                          </button>
                          <button type="button" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">
                            <span class="caret"></span>
                            <span class="sr-only">
                              Toggle Dropdown
                            </span>
                          </button>
                          @else
                          <button type="button" class="btn btn-danger">
                            Failed
                          </button>
                          <button type="button" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">
                            <span class="caret"></span>
                            <span class="sr-only">
                              Toggle Dropdown
                            </span>
                          </button>
                          @endif
                          <ul role="menu" class="dropdown-menu">
                            @if ($data['order']->status !== 'COMPLETED')
                            <li>
                              <a href="{{
                                              route('order_status_update',
                                              [ 'order_id' => $data['order']->id, 'status' => 'COMPLETED' ])
                                            }}">
                                Paid
                              </a>
                            </li>
                            @endif
                            @if ($data['order']->status !== 'INCOMPLETE')
                            <li>
                              <a href="{{
                                              route('order_status_update',
                                              [ 'order_id' => $data['order']->id, 'status' => 'INCOMPLETE' ])
                                            }}">Unpaid</a>
                            </li>
                            @endif
                            @if ($data['order']->status === 'INCOMPLETE' || $data['order']->status === 'COMPLETED')
                            <li>
                              <a href="{{
                                              route('order_status_update',
                                              [ 'order_id' => $data['order']->id, 'status' => 'FAILED' ])
                                            }}">
                                Failed
                              </a>
                            </li>
                            @endif
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label">Payment Date: </label>
                      <div class="col-md-8">
                        <div class="input-group">
                          {{
                                      Form::text(
                                        'order-payment-date',
                                        date('m/d/Y', strtotime($data['order']->payment_date)),
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
                        @if ($errors->has('order-payment-date'))
                        <p class="text-danger">
                          {{ $errors->first('order-payment-date') }}
                        </p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label">
                        Payment Method:
                      </label>
                      <div class="col-md-8">
                        {{
                                    Form::select('order-payment-method',
                                    $data['payment_methods'],
                                    $data['order']->payment_method_id,
                                    [
                                      'class' => 'form-control'
                                    ])
                                  }}
                        @if ($errors->has('order-payment-method'))
                        <p class="text-danger">
                          {{
                                        $errors->first('order-payment-method')
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
                                      $data['order']->transaction_id,
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
                        {{
                                    Form::text(
                                      'order-cheque-num',
                                      $data['order']->cheque_number,
                                      [
                                        'class'       => 'form-control',
                                        'placeholder' => 'eg. PBB304222'
                                      ]
                                    )
                                  }}
                        @if ($errors->has('order-cheque-num'))
                        <p class="text-danger">
                          {{ $errors->first('order-cheque-num') }}
                        </p>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end row -->
            </div>
            <!-- end porlet-body -->
          </div>
          <!-- end portlet -->
          <!-- User Information Portlet: Start -->
          <div class="portlet">
            <div class="portlet-header">
              <div class="caption">
                Client Information
              </div>
              <div class="tools">
                <i class="fa fa-chevron-up"></i>
              </div>
            </div><!-- end porlet header -->
            <div class="portlet-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-horizontal">
                    <div class="form-group">
                      <label class="col-md-3 control-label">
                        The Invoice is For <span class="text-red">*</span>
                      </label>
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
                          <!-- <input id="optionsRadios1" type="radio" name="optionsRadios" value="option1" checked="checked"/>&nbsp; Existing Client</label> -->
                          <div class="clearfix"></div>
                          <label>Filter Exisiting Client By</label>
                          <select name="user-account-type" class="form-control order-client-type invoice-existing-client-field">
                            @if ($data['user_client_accounts'][$data['order']->user->id]['type'] === 'business-account')
                            <option value="all">All</option>
                            <option selected="selected" value="business-account">
                              Business Account
                            </option>
                            <option value="individual-account">
                              Individual Account
                            </option>
                            @elseif ($data['user_client_accounts'][$data['order']->user->id]['type'] === 'individual-account')
                            <option value="all">
                              All
                            </option>
                            <option value="business-account">
                              Business Account
                            </option>
                            <option selected="selected" value="individual-account">
                              Individual Account
                            </option>
                            @else
                            <option value="all">
                              All
                            </option>
                            <option value="business-account">
                              Business Account
                            </option>
                            <option value="individual-account">
                              Individual Account
                            </option>
                            @endif
                          </select>
                          <div class="clearfix xs-margin"></div>
                          <select name="user-client-target" class="form-control user-client-target invoice-existing-client-field">
                            <option value="_default">
                              - Please select -
                            </option>
                            @if ($data['user_client_accounts'])
                            @foreach ($data['user_client_accounts'] as $user_id => $user)
                            @if ($user_id === $data['order']->user->id)
                            <option value="{{ $user_id }}" data-type="{{ $user['type'] }}" selected="selected">
                              @else
                            <option value="{{ $user_id }}" data-type="{{ $user['type'] }}">
                              @endif

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
                  </div>
                </div>
                <!-- end col-md-12 -->
              </div>
              <!-- end row -->
              <div class="md-margin"></div>
            </div>
            <!-- end porlet-body -->
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
          </div>
          {{ Form::close() }}
          <!-- End porlet -->
        </div>

        <!-- end tab client info -->
        <div id="invoice-items" class="tab-pane fade">
          <div class="portlet">

            <div class="portlet-header">
              <div class="caption">Invoice Items</div>
              <p class="margin-top-10px"></p>
              <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
              <div class="clearfix"></div>
              <a href="#" data-target="#modal-add-item" data-toggle="modal" class="btn btn-success">Add New Item &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
              <div class="btn-group">
                <button type="button" class="btn btn-primary">Delete</button>
                <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <a href="javascript:;" class="delete_selected_item_link">Delete selected item(s)</a>
                  </li>
                  <li class="divider"></li>
                  <li>
                    <a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a>
                  </li>
                </ul>
              </div>
              <!--Modal add new item start-->
              <div id="modal-add-item" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                <div class="modal-dialog modal-wide-width">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                      <h4 id="modal-login-label3" class="modal-title">Add New Item</h4>
                    </div>
                    <div class="modal-body">
                      <h5 class="block-heading">Services</h5>

                      <form class="form-horizontal">
                        <div class="form-group">
                          <label class="col-md-3 control-label">Service Plan / Service Code <span class="text-red">*</span></label>
                          <div class="col-md-6">
                            <select class="form-control">
                              <option>- Please select -</option>
                              <option>Custom Plan/Package</option>
                              <option>===========================================================</option>
                              <option>---- Cloud Hosting ----</option>
                              <option>S Cloud: SCL-1</option>
                              <option>M Cloud: MCL-1</option>
                              <option>L Cloud: LCL-1</option>
                              <option>===========================================================</option>
                              <option>---- Co-location Hosting ----</option>
                              <option>2U: CO2U-1</option>
                              <option>5U: CO5U-1</option>
                              <option>10U: CO10U-1</option>
                              <option>===========================================================</option>
                              <option>---- Dedicated Server ----</option>
                              <option>Enterprise 1: DS1x4-4-2x1TB</option>
                              <option>Enterprise 2: DS2x6-8-2x1TB</option>
                              <option>Enterprise 3: DS2x6-8-2x1TB</option>
                              <option>===========================================================</option>
                              <option>---- Domains ----</option>
                              <option>Register a New Domain: DN </option>
                              <option>Renew a Domain: DN </option>
                              <option>Transfer in a Domain: DN </option>
                              <option>Bulk Registration: DN </option>
                              <option>Bulk Renewal: DN </option>
                              <option>Bulk Transfer: DN </option>
                              <option>===========================================================</option>
                              <option>---- E-commerce ----</option>
                              <option>200: EC-200-1</option>
                              <option>20,000: EC-20k-1</option>
                              <option>Unlimited: EC-U-1</option>
                              <option>===========================================================</option>
                              <option>---- Email88 ----</option>
                              <option>Booster I: E88B1-10k-1</option>
                              <option>Booster II: E88B2-15k-1</option>
                              <option>Booster III: E88B3-20k-1</option>
                              <option>===========================================================</option>
                              <option>---- Shared Hosting ----</option>
                              <option>Small: SHSM-1</option>
                              <option>Medium: SHME-1</option>
                              <option>Large: SHBI-1</option>
                              <option>===========================================================</option>
                              <option>---- SSL Certificates ----</option>
                              <option>Secure a Single Common Name: EV-DC1</option>
                              <option>Secure Multiple Domains: UC-DC1</option>
                              <option>SP-DC1: UC-DC1</option>
                              <option>===========================================================</option>
                              <option>---- VPS Hosting ----</option>
                              <option>Linux Basic: VPS58-2-1</option>
                              <option>Linux Gold: VPS78-3-1</option>
                              <option>VPS28-1-1: VPS78-3-1</option>
                              <option>===========================================================</option>
                              <option>---- Web88IR ----</option>
                              <option>Dynamic I: IRH1-1</option>
                              <option>Dynamic I: IRD2-1</option>
                              <option>Dynamic II: IRD2-1</option>
                              <option>===========================================================</option>
                              <option>---- Responsive Web Design ----</option>
                              <option>Responsive Web Design</option>
                              <option>===========================================================</option>
                              <option>---- Social Media ----</option>
                              <option>Social Media</option>
                              <option>===========================================================</option>
                              <option>List all services here</option>
                            </select>
                            <div class="xs-margin"></div>
                            <div class="text-blue text-12px">Please select a <b>"Service Plan"</b> &amp; <b>"Service Code"</b> to continue, eg. for VPS Hosting, <b>Service Plan = "Linux Basic"</b>, <b>Service Code = "VPS58-2-1"</b>.</div>
                            note to programmer: some of the services does not have a service code, if service plan doesn't have a service code, please leave it blank after the plan name in the above dropdown list.
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan/Package Name</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                          </div>

                        </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">Unit Price (RM)</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="0.00">
                            <div class="xs-margin"></div>
                            <div class="text-blue text-12px">The unit price is for all other packages execpt domain. For single/bulk domain prices, please specify the prices in below <b>"Domain Configuration"</b> section.</div>
                            note to programmer: auto-fill in the price above after selected a plan. the price will be varied from the selection of the plan above.
                          </div>

                        </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">Global Discount Name </label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="eg. Sample 2">
                            note to programmer: "discount name" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Global Discount Rate </label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Amount">
                            <div class="xs-margin"></div>
                            <select name="select" class="form-control">
                              <option value="%">%</option>
                              <option value="RM">RM</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Promo Code </label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="eg. Test123">
                            note to programmer: "promo code" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Discount Rate (Promo Code) </label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Amount">
                            <div class="xs-margin"></div>
                            <select name="select" class="form-control">
                              <option value="%">%</option>
                              <option value="RM">RM</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">SSL Price (RM) </label>
                          <div class="col-md-6">
                            <select class="form-control">
                              <option>- Please select -</option>
                              <option value="1 year">1 year(s) @ RM239.99/yr</option>
                              <option value="2 years">2 year(s) @ RM 219.99/yr</option>
                              <option value="3 years">3 year(s) @ RM 199.99/yr</option>
                            </select>
                            <div class="xs-margin"></div>
                            note to programmer: the ssl price dropdown list is dynamic and fectched from the ssl services setup depending on the ssl plan selected above.
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">Quantity <span class="text-red">*</span></label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="1">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">Cycle <span class="text-red">*</span></label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="eg. 1 year(s)">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">Setup Fee (RM) </label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="0.00">
                            <div class="xs-margin"></div>
                            <div class="text-blue text-12px">If "Setup Fee" is set to <b>RM 0.00</b>, it is <b>"FREE Setup"</b>.</div>
                          </div>
                        </div>

                        <!-- domain configuration start -->
                        <h5 class="block-heading">Domain Configuration</h5>
                        <div class="form-group">
                          <label for="inputFirstName" class="col-md-3 control-label">Domain Name <span class="text-red">*</span></label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <label><input type="radio" checked="checked"> Use existing domain, please enter your domain below:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control" placeholder="eg. webqom.net">
                              </label>
                              <label><input type="radio"> Register a new domain, please enter your domain below:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control" placeholder="eg. webqom.net">
                              </label>
                              <label><input type="radio"> Please specify your domain below (for single domain):
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control" placeholder="eg. webqom.net">
                              </label>
                              <label><input type="radio"> Please specify your domains below (for bulk domains):
                                <div class="xs-margin"></div>
                                <textarea class="form-control" rows="10">Each name must be on a separate line.

Examples:
yourdomain.com
yourdomain.net
                                                        </textarea>
                              </label>
                            </div>

                          </div>
                        </div>
                        note to programmer: the domain price from 1 year to 10 years is dynamic and fectched from the domain pricing and maybe varied from different TLDs. Same as bulk domain pricing.

                        <h6 class="block-heading">Single Domain Pricing (RM)</h6>
                        <div class="text-blue text-12px">You can specify single domain price in below table for <b>"New Domain Registration"</b>, <b>"Domain Renewal"</b> or <b>"Transfer in a Domain"</b>. If "Domain Price" is set to <b>RM 0.00</b>, it is <b>"FREE Domain"</b>. </div>
                        <div class="xs-margin"></div>
                        <div class="table-responsive">
                          <table class="table table-striped table-hover">
                            <thead>
                              <th>1 Year(s)</th>
                              <th>2 Year(s)</th>
                              <th>3 Year(s)</th>
                              <th>5 Year(s)</th>
                              <th>10 Year(s)</th>
                            </thead>
                            <tbody>
                              <tr>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="5"></td>
                              </tr>
                            </tfoot>
                          </table>

                        </div><!-- end table responsive -->

                        <h6 class="block-heading">Bulk Domain Pricing (RM)</h6>
                        <div class="text-blue text-12px">You can specify bulk domain price in below table for <b>"Bulk Registration"</b>, <b>"Bulk Renewal"</b> or <b>"Bulk Transfer"</b>.</div>
                        <div class="xs-margin"></div>
                        <div class="table-responsive">
                          <table class="table table-striped table-hover">
                            <thead>
                              <th>Domains</th>
                              <th>1 Year(s)</th>
                              <th>2 Year(s)</th>
                              <th>3 Year(s)</th>
                              <th>5 Year(s)</th>
                              <th>10 Year(s)</th>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1-5</td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                              </tr>
                              <tr>
                                <td>6-20</td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                              </tr>
                              <tr>
                                <td>21-49</td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                              </tr>
                              <tr>
                                <td>50-100</td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                              </tr>
                              <tr>
                                <td>101-200</td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                              </tr>
                              <tr>
                                <td>201-500</td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                                <td><input type="text" class="form-control" placeholder="0.00"></td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="6"></td>
                              </tr>
                            </tfoot>
                          </table>

                        </div><!-- end table responsive -->

                        <div class="form-group">
                          <label class="col-md-3 control-label">Discount </label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Amount">
                            <div class="xs-margin"></div>
                            <select name="select" class="form-control">
                              <option value="%">%</option>
                              <option value="RM">RM</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">Domain Addons </label>
                          <div class="col-md-6">
                            <div class="checkbox-list margin-top-10px">
                              <label><input type="checkbox" />&nbsp; DNS Management (@ RM 102.50/yr)</label>
                              <label><input type="checkbox" />&nbsp; Email Forwarding (@ RM 102.50/yr)</label>
                              <label><input type="checkbox" />&nbsp; ID Protection (@ RM 102.50/yr)</label>
                              note to programmer: domain addons list and price is fetched from the domain setup.
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end domain configuration -->

                        <!-- co-location hosting configuration start -->
                        <h5 class="block-heading">Co-location Hosting Configuration</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Rack Space </label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; Quarter Rack </label>
                              <label><input type="radio">&nbsp; Half Rack </label>
                              <label><input type="radio">&nbsp; Full Rack </label>
                              <label><input type="radio">&nbsp; Cabinet </label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Bandwidth </label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; 10Mbps </label>
                              <label><input type="radio">&nbsp; 20Mbps </label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Power Port</label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; 1 Port </label>
                              <label><input type="radio">&nbsp; 5 Ports </label>
                              <label><input type="radio">&nbsp; 10 Ports </label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Wan Port </label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; 1 Port</label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">No. of IP Addresses</label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; 1</label>
                              <label><input type="radio">&nbsp; 4 </label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end co-location hosting configuration -->

                        <!-- dedicated server configuration start -->
                        <h5 class="block-heading">Dedicated Server Configuration</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">CPU </label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; 1 x 4-cores Intel Xeon </label>
                              <label><input type="radio">&nbsp; 1 x 6-cores Intel Xeon </label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">No. of Processors</label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; 1 processor </label>
                              <label><input type="radio">&nbsp; 2 processors </label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">RAM</label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; 4GB </label>
                              <label><input type="radio">&nbsp; 8GB </label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Hard Disk </label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; 2 x 1TB SATA </label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">No. of IP Addresses (IPv4) </label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; 1 x IPv4 Address</label>
                              <label><input type="radio">&nbsp; 2 x IPv4 Address </label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Bandwidth </label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; 10Mbps </label>
                              <label><input type="radio">&nbsp; 20Mbps </label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Control Panel </label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; No management software </label>
                              <label><input type="radio">&nbsp; Webmin / cPanel WHM / zPanel </label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Fully Managed Server </label>
                          <div class="col-md-6">
                            <div class="radio-list">
                              <div class="margin-top-5px"></div>
                              <label><input type="radio" checked="checked">&nbsp; Optional </label>
                              <label><input type="radio">&nbsp; Others, please sepcify:
                                <div class="xs-margin"></div>
                                <input type="text" class="form-control">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end dedicated server configuration -->

                        <!-- custom cloud hosting plan specs start -->
                        <h5 class="block-heading">Cloud Hosting Plan Specifications</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="xs-margin"></div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end custom cloud hosting plan specs -->

                        <!-- custom shared hosting plan specs start -->
                        <h5 class="block-heading">Shared Hosting Plan Specifications</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="xs-margin"></div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end custom shared hosting plan specs -->

                        <!-- custom vps hosting plan specs start -->
                        <h5 class="block-heading">VPS Hosting Plan Specifications</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="xs-margin"></div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end custom vps hosting plan specs -->

                        <!-- custom ecommerce plan specs start -->
                        <h5 class="block-heading">E-commerce Plan Specifications</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="xs-margin"></div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end custom ecommerce plan specs -->

                        <!-- custom email88 plan specs start -->
                        <h5 class="block-heading">Email88 Plan Specifications</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="xs-margin"></div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end custom email88 plan specs -->

                        <!-- custom package p plan specs start -->
                        <h5 class="block-heading">Package P Plan Specifications</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="xs-margin"></div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end custom package p plan specs -->

                        <!-- custom rwd plan specs start -->
                        <h5 class="block-heading">Responsive Web Design Plan Specifications</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="xs-margin"></div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end custom rwd plan specs -->

                        <!-- custom seo specs start -->
                        <h5 class="block-heading">SEO Plan Specifications</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="xs-margin"></div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end custom seo specs -->

                        <!-- custom social media plan specs start -->
                        <h5 class="block-heading">Social Media Plan Specifications</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="xs-margin"></div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end custom social media plan specs -->

                        <!-- custom ssl plan specs start -->
                        <h5 class="block-heading">SSL Certificates Plan Specifications</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="xs-margin"></div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end custom ssl plan specs -->

                        <!-- custom web88 cms plan specs start -->
                        <h5 class="block-heading">Web88 CMS Plan Specifications</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="xs-margin"></div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end custom web88 cms plan specs -->

                        <!-- custom web88ir plan specs start -->
                        <h5 class="block-heading">Web88IR Plan Specifications</h5>
                        <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                        <div class="xs-margin"></div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Custom Plan Specification</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control">
                            <div class="xss-margin"></div>
                            <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Notes </label>
                          <div class="col-md-6">
                            <textarea rows="3" class="form-control"></textarea>
                          </div>
                        </div>
                        <!-- end custom web88ir plan specs -->

                        <div class="form-actions">
                          <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                        </div>
                      </form>
                    </div><!-- end modal body -->
                  </div>
                </div>
              </div>
              <!--END MODAL add new item -->

              <!--Modal delete selected items start-->
              <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                      <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                    </div>
                    <div class="modal-body">
                      <p><strong>Service Code:</strong> DN<br />
                        <strong>Domain Registration:</strong> webqom.net
                      </p>
                      <div class="form-actions">
                        <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--Modal delete selected items start-->
              <div id="modal-delete-selectedd" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                      <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete selected items? </h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-actions">
                        <div class="alert alert-danger">
                          Please select at least one order for delete
                        </div>
                        <div class="col-md-offset-4 col-md-4">
                          <a href="#" data-dismiss="modal" class="btn btn-info btn-block">
                            Ok
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- modal delete selected items end -->
              <!--Modal delete all items start-->
              <div id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                      <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-actions">
                        <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- modal delete all items end -->

            </div><!-- end porlet header -->

            <div class="portlet-body">

              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-checkout table-striped" id="table_out">
                      <thead>
                        <tr>
                          <th width="1%"><input id="master" type="checkbox" /></th>
                          <th>#</th>
                          <th>Services</th>
                          <th class="text-center">Cycle</th>
                          <th class="text-center">Qty</th>
                          <th class="text-center">Global Discount Name <br /> / Global Discount Rate</th>
                          <th class="text-center">Promo Code <br /> / Discount Rate</th>
                          <th class="text-right">Price</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input class="sub_chk" type="checkbox" /></td>
                          <td>1</td>
                          <td><b>Service Code: </b>DN<br />
                            <b>Domain Registration: </b>webqom.net <br />
                            <b>Domain Addons:</b>
                            <ul class="list-style">
                              <li><i class="fa icon-angle-right"></i> DNS Management</li>
                              <li><i class="fa icon-angle-right"></i> Email Forwarding</li>
                              <li><i class="fa icon-angle-right"></i> ID Protection</li>
                            </ul>
                          </td>
                          <td class="text-center">2 year(s)</td>
                          <td class="text-center">1</td>
                          <td class="text-center">Sample 2 / 15%</td>
                          <td class="text-center">0.00</td>
                          <td class="text-right">RM 684.00</td>
                          <td class="text-center"><a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-domain" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                            <!-- edit domain modal start -->
                            <div id="modal-edit-domain" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade text-left">
                              <div class="modal-dialog modal-wide-width">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title">Add New Item</h4>
                                  </div>
                                  <div class="modal-body">
                                    <h5 class="block-heading">Services</h5>

                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Service Plan / Service Code <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option>Custom Plan/Package</option>
                                            <option>===========================================================</option>
                                            <option>---- Cloud Hosting ----</option>
                                            <option>S Cloud: SCL-1</option>
                                            <option>M Cloud: MCL-1</option>
                                            <option>L Cloud: LCL-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Co-location Hosting ----</option>
                                            <option>2U: CO2U-1</option>
                                            <option>5U: CO5U-1</option>
                                            <option>10U: CO10U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Dedicated Server ----</option>
                                            <option>Enterprise 1: DS1x4-4-2x1TB</option>
                                            <option>Enterprise 2: DS2x6-8-2x1TB</option>
                                            <option>Enterprise 3: DS2x6-8-2x1TB</option>
                                            <option>===========================================================</option>
                                            <option>---- Domains ----</option>
                                            <option selected="selected">Register a New Domain: DN </option>
                                            <option>Renew a Domain: DN </option>
                                            <option>Transfer in a Domain: DN </option>
                                            <option>Bulk Registration: DN </option>
                                            <option>Bulk Renewal: DN </option>
                                            <option>Bulk Transfer: DN </option>
                                            <option>===========================================================</option>
                                            <option>---- E-commerce ----</option>
                                            <option>200: EC-200-1</option>
                                            <option>20,000: EC-20k-1</option>
                                            <option>Unlimited: EC-U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Email88 ----</option>
                                            <option>Booster I: E88B1-10k-1</option>
                                            <option>Booster II: E88B2-15k-1</option>
                                            <option>Booster III: E88B3-20k-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Shared Hosting ----</option>
                                            <option>Small: SHSM-1</option>
                                            <option>Medium: SHME-1</option>
                                            <option>Large: SHBI-1</option>
                                            <option>===========================================================</option>
                                            <option>---- SSL Certificates ----</option>
                                            <option>Secure a Single Common Name: EV-DC1</option>
                                            <option>Secure Multiple Domains: UC-DC1</option>
                                            <option>SP-DC1: UC-DC1</option>
                                            <option>===========================================================</option>
                                            <option>---- VPS Hosting ----</option>
                                            <option>Linux Basic: VPS58-2-1</option>
                                            <option>Linux Gold: VPS78-3-1</option>
                                            <option>VPS28-1-1: VPS78-3-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Web88IR ----</option>
                                            <option>Dynamic I: IRH1-1</option>
                                            <option>Dynamic I: IRD2-1</option>
                                            <option>Dynamic II: IRD2-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Responsive Web Design ----</option>
                                            <option>Responsive Web Design</option>
                                            <option>===========================================================</option>
                                            <option>---- Social Media ----</option>
                                            <option>Social Media</option>
                                            <option>===========================================================</option>
                                            <option>List all services here</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">Please select a <b>"Service Plan"</b> &amp; <b>"Service Code"</b> to continue, eg. for VPS Hosting, <b>Service Plan = "Linux Basic"</b>, <b>Service Code = "VPS58-2-1"</b>.</div>
                                          note to programmer: some of the services does not have a service code, if service plan doesn't have a service code, please leave it blank after the plan name in the above dropdown list.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan/Package Name</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                        </div>

                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Unit Price (RM)</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00" value="">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">The unit price is for all other packages execpt domain. For single/bulk domain prices, please specify the prices in below <b>"Domain Configuration"</b> section.</div>
                                          note to programmer: auto-fill in the price above after selected a plan. the price will be varied from the selection of the plan above.
                                        </div>

                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Name </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Sample 2" value="Sample 2">
                                          note to programmer: "discount name" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Rate </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount" value="15">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%" selected="selected">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Promo Code </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Test123">
                                          note to programmer: "promo code" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount Rate (Promo Code) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">SSL Price (RM) </label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option value="1 year">1 year(s) @ RM239.99/yr</option>
                                            <option value="2 years">2 year(s) @ RM 219.99/yr</option>
                                            <option value="3 years">3 year(s) @ RM 199.99/yr</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          note to programmer: the ssl price dropdown list is dynamic and fectched from the ssl services setup depending on the ssl plan selected above.
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Quantity <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="1" value="1">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Cycle <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. 1 year(s)" value="2 Year(s)">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Setup Fee (RM) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">If "Setup Fee" is set to <b>RM 0.00</b>, it is <b>"FREE Setup"</b>.</div>
                                        </div>
                                      </div>

                                      <!-- domain configuration start -->
                                      <h5 class="block-heading">Domain Configuration</h5>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Domain Name <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <label><input type="radio"> Use existing domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio" checked="checked"> Register a new domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net" value="webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domain below (for single domain):
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domains below (for bulk domains):
                                              <div class="xs-margin"></div>
                                              <textarea class="form-control" rows="10">Each name must be on a separate line.

Examples:
yourdomain.com
yourdomain.net
                                                                            </textarea>
                                            </label>
                                          </div>

                                        </div>
                                      </div>
                                      note to programmer: the domain price from 1 year to 10 years is dynamic and fectched from the domain pricing and maybe varied from different TLDs. Same as bulk domain pricing.

                                      <h6 class="block-heading">Single Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify single domain price in below table for <b>"New Domain Registration"</b>, <b>"Domain Renewal"</b> or <b>"Transfer in a Domain"</b>. If "Domain Price" is set to <b>RM 0.00</b>, it is <b>"FREE Domain"</b>. </div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00" value="69.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="5"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <h6 class="block-heading">Bulk Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify bulk domain price in below table for <b>"Bulk Registration"</b>, <b>"Bulk Renewal"</b> or <b>"Bulk Transfer"</b>.</div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>Domains</th>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>1-5</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>6-20</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>21-49</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>50-100</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>101-200</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>201-500</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="6"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Domain Addons </label>
                                        <div class="col-md-6">
                                          <div class="checkbox-list margin-top-10px">
                                            <label><input type="checkbox" checked="checked" />&nbsp; DNS Management (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" checked="checked" />&nbsp; Email Forwarding (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" checked="checked" />&nbsp; ID Protection (@ RM 102.50/yr)</label>
                                            note to programmer: domain addons list and price is fetched from the domain setup.
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end domain configuration -->

                                      <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                    </form>
                                  </div><!-- end modal body -->
                                </div>
                              </div>
                            </div><!-- end modal edit domain -->
                          </td>

                          <!--Modal delete start-->
                          <div id="modal-delete-1" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this item? </h4>
                                </div>
                                <div class="modal-body">
                                  <p><strong>Service Code:</strong> DN <br />
                                    <strong>Domain Registration:</strong> webqom.net
                                  </p>
                                  <div class="form-actions">
                                    <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- modal delete end -->
                        </tr>
                        <tr>
                          <td><input class="sub_chk" type="checkbox" /></td>
                          <td>2</td>
                          <td><b>Service Code: </b>DN<br />
                            <b>Domain Registration: </b>webqom.org <br />
                          </td>
                          <td class="text-center">2 year(s)</td>
                          <td class="text-center">1</td>
                          <td class="text-center">0.00</td>
                          <td class="text-center">0.00</td>
                          <td class="text-right">RM 50.00</td>
                          <td class="text-center"><a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-domain" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                          </td>
                        </tr>
                        <tr>
                          <td><input class="sub_chk" type="checkbox" /></td>
                          <td>3</td>
                          <td><b>Service Code: </b> SHSM-1<br />
                            <b>Shared Hosting Plan: </b> Small<br />
                            <b>Domain: </b>webqom.com <span class="text-red">(FREE)</span><br />
                            <b>Domain Registration Fee:</b> <span class="text-red">RM 0.00</span>
                          </td>
                          <td class="text-center">1 year(s)</td>
                          <td class="text-center">1</td>
                          <td class="text-center">0.00</td>
                          <td class="text-center">0.00</td>
                          <td class="text-right">RM 194.94</td>
                          <td class="text-center"><a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-shared" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                            <!-- edit shared hosting modal start -->
                            <div id="modal-edit-shared" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade text-left">
                              <div class="modal-dialog modal-wide-width">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title">Add New Item</h4>
                                  </div>
                                  <div class="modal-body">
                                    <h5 class="block-heading">Services</h5>

                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Service Plan / Service Code <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option>Custom Plan/Package</option>
                                            <option>===========================================================</option>
                                            <option>---- Cloud Hosting ----</option>
                                            <option>S Cloud: SCL-1</option>
                                            <option>M Cloud: MCL-1</option>
                                            <option>L Cloud: LCL-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Co-location Hosting ----</option>
                                            <option>2U: CO2U-1</option>
                                            <option>5U: CO5U-1</option>
                                            <option>10U: CO10U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Dedicated Server ----</option>
                                            <option>Enterprise 1: DS1x4-4-2x1TB</option>
                                            <option>Enterprise 2: DS2x6-8-2x1TB</option>
                                            <option>Enterprise 3: DS2x6-8-2x1TB</option>
                                            <option>===========================================================</option>
                                            <option>---- Domains ----</option>
                                            <option>Register a New Domain: DN </option>
                                            <option>Renew a Domain: DN </option>
                                            <option>Transfer in a Domain: DN </option>
                                            <option>Bulk Registration: DN </option>
                                            <option>Bulk Renewal: DN </option>
                                            <option>Bulk Transfer: DN </option>
                                            <option>===========================================================</option>
                                            <option>---- E-commerce ----</option>
                                            <option>200: EC-200-1</option>
                                            <option>20,000: EC-20k-1</option>
                                            <option>Unlimited: EC-U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Email88 ----</option>
                                            <option>Booster I: E88B1-10k-1</option>
                                            <option>Booster II: E88B2-15k-1</option>
                                            <option>Booster III: E88B3-20k-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Shared Hosting ----</option>
                                            <option selected="selected">Small: SHSM-1</option>
                                            <option>Medium: SHME-1</option>
                                            <option>Large: SHBI-1</option>
                                            <option>===========================================================</option>
                                            <option>---- SSL Certificates ----</option>
                                            <option>Secure a Single Common Name: EV-DC1</option>
                                            <option>Secure Multiple Domains: UC-DC1</option>
                                            <option>SP-DC1: UC-DC1</option>
                                            <option>===========================================================</option>
                                            <option>---- VPS Hosting ----</option>
                                            <option>Linux Basic: VPS58-2-1</option>
                                            <option>Linux Gold: VPS78-3-1</option>
                                            <option>VPS28-1-1: VPS78-3-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Web88IR ----</option>
                                            <option>Dynamic I: IRH1-1</option>
                                            <option>Dynamic I: IRD2-1</option>
                                            <option>Dynamic II: IRD2-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Responsive Web Design ----</option>
                                            <option>Responsive Web Design</option>
                                            <option>===========================================================</option>
                                            <option>---- Social Media ----</option>
                                            <option>Social Media</option>
                                            <option>===========================================================</option>
                                            <option>List all services here</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">Please select a <b>"Service Plan"</b> &amp; <b>"Service Code"</b> to continue, eg. for VPS Hosting, <b>Service Plan = "Linux Basic"</b>, <b>Service Code = "VPS58-2-1"</b>.</div>
                                          note to programmer: some of the services does not have a service code, if service plan doesn't have a service code, please leave it blank after the plan name in the above dropdown list.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan/Package Name</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                        </div>

                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Unit Price (RM)</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00" value="194.94">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">The unit price is for all other packages execpt domain. For single/bulk domain prices, please specify the prices in below <b>"Domain Configuration"</b> section.</div>
                                          note to programmer: auto-fill in the price above after selected a plan. the price will be varied from the selection of the plan above.
                                        </div>

                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Name </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Sample 2">
                                          note to programmer: "discount name" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Rate </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Promo Code </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Test123">
                                          note to programmer: "promo code" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount Rate (Promo Code) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">SSL Price (RM) </label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option value="1 year">1 year(s) @ RM239.99/yr</option>
                                            <option value="2 years">2 year(s) @ RM 219.99/yr</option>
                                            <option value="3 years">3 year(s) @ RM 199.99/yr</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          note to programmer: the ssl price dropdown list is dynamic and fectched from the ssl services setup depending on the ssl plan selected above.
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Quantity <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="1" value="1">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Cycle <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. 1 year(s)" value="1 Year(s)">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Setup Fee (RM) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">If "Setup Fee" is set to <b>RM 0.00</b>, it is <b>"FREE Setup"</b>.</div>
                                        </div>
                                      </div>

                                      <!-- domain configuration start -->
                                      <h5 class="block-heading">Domain Configuration</h5>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Domain Name <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <label><input type="radio" checked="checked"> Use existing domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net" value="webqom.com">
                                            </label>
                                            <label><input type="radio"> Register a new domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domain below (for single domain):
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domains below (for bulk domains):
                                              <div class="xs-margin"></div>
                                              <textarea class="form-control" rows="10">Each name must be on a separate line.

Examples:
yourdomain.com
yourdomain.net
                                                                            </textarea>
                                            </label>
                                          </div>

                                        </div>
                                      </div>
                                      note to programmer: the domain price from 1 year to 10 years is dynamic and fectched from the domain pricing and maybe varied from different TLDs. Same as bulk domain pricing.

                                      <h6 class="block-heading">Single Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify single domain price in below table for <b>"New Domain Registration"</b>, <b>"Domain Renewal"</b> or <b>"Transfer in a Domain"</b>. If "Domain Price" is set to <b>RM 0.00</b>, it is <b>"FREE Domain"</b>. </div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="5"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <h6 class="block-heading">Bulk Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify bulk domain price in below table for <b>"Bulk Registration"</b>, <b>"Bulk Renewal"</b> or <b>"Bulk Transfer"</b>.</div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>Domains</th>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>1-5</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>6-20</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>21-49</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>50-100</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>101-200</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>201-500</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="6"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Domain Addons </label>
                                        <div class="col-md-6">
                                          <div class="checkbox-list margin-top-10px">
                                            <label><input type="checkbox" />&nbsp; DNS Management (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; Email Forwarding (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; ID Protection (@ RM 102.50/yr)</label>
                                            note to programmer: domain addons list and price is fetched from the domain setup.
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end domain configuration -->

                                      <!-- custom shared hosting plan specs start -->
                                      <h5 class="block-heading">Shared Hosting Plan Specifications</h5>
                                      <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                                      <div class="xs-margin"></div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan Specification</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                          <div class="xss-margin"></div>
                                          <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end custom shared hosting plan specs -->



                                      <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                    </form>
                                  </div><!-- end modal body -->
                                </div>
                              </div>
                            </div><!-- end modal edit shared hosting -->

                          </td>
                        </tr>
                        <tr>
                          <td><input class="sub_chk" type="checkbox" /></td>
                          <td>4</td>
                          <td><b>Service Code: </b> SCL-1<br />
                            <b>Cloud Hosting Plan: </b> S Cloud <span class="text-red">(FREE Setup)</span><br />
                            <b>Domain: </b>webqom.net <br />
                            <b>Setup Fee:</b> <span class="text-red">RM 0.00</span><br />
                            <b>Plan Specification:</b>
                            <ul class="list-style">
                              <li><i class="fa icon-angle-right"></i> RAM: 1GB</li>
                              <li><i class="fa icon-angle-right"></i> Processor: 1 vCPU</li>
                              <li><i class="fa icon-angle-right"></i> Fast Disk: 40GB</li>
                              <li><i class="fa icon-angle-right"></i> Transfer: 3TB</li>
                            </ul>
                          </td>
                          <td class="text-center">1 year(s)</td>
                          <td class="text-center">1</td>
                          <td class="text-center">0.00</td>
                          <td class="text-center">0.00</td>
                          <td class="text-right">RM 480.00</td>
                          <td class="text-center"><a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-cloud" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                            <!-- edit cloud hosting modal start -->
                            <div id="modal-edit-cloud" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade text-left">
                              <div class="modal-dialog modal-wide-width">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title">Add New Item</h4>
                                  </div>
                                  <div class="modal-body">
                                    <h5 class="block-heading">Services</h5>

                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Service Plan / Service Code <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option>Custom Plan/Package</option>
                                            <option>===========================================================</option>
                                            <option>---- Cloud Hosting ----</option>
                                            <option selected="selected">S Cloud: SCL-1</option>
                                            <option>M Cloud: MCL-1</option>
                                            <option>L Cloud: LCL-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Co-location Hosting ----</option>
                                            <option>2U: CO2U-1</option>
                                            <option>5U: CO5U-1</option>
                                            <option>10U: CO10U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Dedicated Server ----</option>
                                            <option>Enterprise 1: DS1x4-4-2x1TB</option>
                                            <option>Enterprise 2: DS2x6-8-2x1TB</option>
                                            <option>Enterprise 3: DS2x6-8-2x1TB</option>
                                            <option>===========================================================</option>
                                            <option>---- Domains ----</option>
                                            <option>Register a New Domain: DN </option>
                                            <option>Renew a Domain: DN </option>
                                            <option>Transfer in a Domain: DN </option>
                                            <option>Bulk Registration: DN </option>
                                            <option>Bulk Renewal: DN </option>
                                            <option>Bulk Transfer: DN </option>
                                            <option>===========================================================</option>
                                            <option>---- E-commerce ----</option>
                                            <option>200: EC-200-1</option>
                                            <option>20,000: EC-20k-1</option>
                                            <option>Unlimited: EC-U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Email88 ----</option>
                                            <option>Booster I: E88B1-10k-1</option>
                                            <option>Booster II: E88B2-15k-1</option>
                                            <option>Booster III: E88B3-20k-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Shared Hosting ----</option>
                                            <option>Small: SHSM-1</option>
                                            <option>Medium: SHME-1</option>
                                            <option>Large: SHBI-1</option>
                                            <option>===========================================================</option>
                                            <option>---- SSL Certificates ----</option>
                                            <option>Secure a Single Common Name: EV-DC1</option>
                                            <option>Secure Multiple Domains: UC-DC1</option>
                                            <option>SP-DC1: UC-DC1</option>
                                            <option>===========================================================</option>
                                            <option>---- VPS Hosting ----</option>
                                            <option>Linux Basic: VPS58-2-1</option>
                                            <option>Linux Gold: VPS78-3-1</option>
                                            <option>VPS28-1-1: VPS78-3-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Web88IR ----</option>
                                            <option>Dynamic I: IRH1-1</option>
                                            <option>Dynamic I: IRD2-1</option>
                                            <option>Dynamic II: IRD2-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Responsive Web Design ----</option>
                                            <option>Responsive Web Design</option>
                                            <option>===========================================================</option>
                                            <option>---- Social Media ----</option>
                                            <option>Social Media</option>
                                            <option>===========================================================</option>
                                            <option>List all services here</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">Please select a <b>"Service Plan"</b> &amp; <b>"Service Code"</b> to continue, eg. for VPS Hosting, <b>Service Plan = "Linux Basic"</b>, <b>Service Code = "VPS58-2-1"</b>.</div>
                                          note to programmer: some of the services does not have a service code, if service plan doesn't have a service code, please leave it blank after the plan name in the above dropdown list.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan/Package Name</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                        </div>

                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Unit Price (RM)</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00" value="480.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">The unit price is for all other packages execpt domain. For single/bulk domain prices, please specify the prices in below <b>"Domain Configuration"</b> section.</div>
                                          note to programmer: auto-fill in the price above after selected a plan. the price will be varied from the selection of the plan above.

                                        </div>

                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Name </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Sample 2">
                                          note to programmer: "discount name" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Rate </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Promo Code </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Test123">
                                          note to programmer: "promo code" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount Rate (Promo Code) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">SSL Price (RM) </label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option value="1 year">1 year(s) @ RM239.99/yr</option>
                                            <option value="2 years">2 year(s) @ RM 219.99/yr</option>
                                            <option value="3 years">3 year(s) @ RM 199.99/yr</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          note to programmer: the ssl price dropdown list is dynamic and fectched from the ssl services setup depending on the ssl plan selected above.
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Quantity <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="1" value="1">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Cycle <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. 1 year(s)" value="1 Year(s)">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Setup Fee (RM) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00" value="0.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">If "Setup Fee" is set to <b>RM 0.00</b>, it is <b>"FREE Setup"</b>.</div>
                                        </div>
                                      </div>

                                      <!-- domain configuration start -->
                                      <h5 class="block-heading">Domain Configuration</h5>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Domain Name <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <label><input type="radio"> Use existing domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio" checked="checked"> Register a new domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net" value="webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domain below (for single domain):
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domains below (for bulk domains):
                                              <div class="xs-margin"></div>
                                              <textarea class="form-control" rows="10">Each name must be on a separate line.

Examples:
yourdomain.com
yourdomain.net
                                                                            </textarea>
                                            </label>
                                          </div>

                                        </div>
                                      </div>
                                      note to programmer: the domain price from 1 year to 10 years is dynamic and fectched from the domain pricing and maybe varied from different TLDs. Same as bulk domain pricing.

                                      <h6 class="block-heading">Single Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify single domain price in below table for <b>"New Domain Registration"</b>, <b>"Domain Renewal"</b> or <b>"Transfer in a Domain"</b>. If "Domain Price" is set to <b>RM 0.00</b>, it is <b>"FREE Domain"</b>. </div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><input type="text" class="form-control" placeholder="0.00" value="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="5"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <h6 class="block-heading">Bulk Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify bulk domain price in below table for <b>"Bulk Registration"</b>, <b>"Bulk Renewal"</b> or <b>"Bulk Transfer"</b>.</div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>Domains</th>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>1-5</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>6-20</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>21-49</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>50-100</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>101-200</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>201-500</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="6"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Domain Addons </label>
                                        <div class="col-md-6">
                                          <div class="checkbox-list margin-top-10px">
                                            <label><input type="checkbox" />&nbsp; DNS Management (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; Email Forwarding (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; ID Protection (@ RM 102.50/yr)</label>
                                            note to programmer: domain addons list and price is fetched from the domain setup.
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end domain configuration -->

                                      <!-- custom cloud hosting plan specs start -->
                                      <h5 class="block-heading">Cloud Hosting Plan Specifications</h5>
                                      <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                                      <div class="xs-margin"></div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan Specification</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. RAM: 1GB">
                                          <div class="xss-margin"></div>
                                          <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end custom cloud hosting plan specs -->

                                      <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                    </form>
                                  </div><!-- end modal body -->
                                </div>
                              </div>
                            </div><!-- end modal edit cloud hosting -->
                          </td>
                        </tr>
                        <tr>
                          <td><input class="sub_chk" type="checkbox" /></td>
                          <td>5</td>
                          <td><b>Service Code: </b> VPS28-1-1<br />
                            <b>VPS Hosting Plan: </b> Linux Basic<br />
                            <b>Domain: </b>webqom.info <br />
                            <b>Plan Specification:</b>
                            <ul class="list-style">
                              <li><i class="fa icon-angle-right"></i> RAM: 1GB</li>
                              <li><i class="fa icon-angle-right"></i> Processor: 1 vCPU</li>
                              <li><i class="fa icon-angle-right"></i> Disk Space: 28GB</li>
                              <li><i class="fa icon-angle-right"></i> Bandwidth: 1Mbps</li>
                            </ul>
                          </td>
                          <td class="text-center">1 year(s)</td>
                          <td class="text-center">1</td>
                          <td class="text-center">0.00</td>
                          <td class="text-center">0.00</td>
                          <td class="text-right">RM 831.60</td>
                          <td class="text-center"><a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-vps" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                            <!-- edit vps hosting modal start -->
                            <div id="modal-edit-vps" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade text-left">
                              <div class="modal-dialog modal-wide-width">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title">Add New Item</h4>
                                  </div>
                                  <div class="modal-body">
                                    <h5 class="block-heading">Services</h5>

                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Service Plan / Service Code <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option>Custom Plan/Package</option>
                                            <option>===========================================================</option>
                                            <option>---- Cloud Hosting ----</option>
                                            <option>S Cloud: SCL-1</option>
                                            <option>M Cloud: MCL-1</option>
                                            <option>L Cloud: LCL-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Co-location Hosting ----</option>
                                            <option>2U: CO2U-1</option>
                                            <option>5U: CO5U-1</option>
                                            <option>10U: CO10U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Dedicated Server ----</option>
                                            <option>Enterprise 1: DS1x4-4-2x1TB</option>
                                            <option>Enterprise 2: DS2x6-8-2x1TB</option>
                                            <option>Enterprise 3: DS2x6-8-2x1TB</option>
                                            <option>===========================================================</option>
                                            <option>---- Domains ----</option>
                                            <option>Register a New Domain: DN </option>
                                            <option>Renew a Domain: DN </option>
                                            <option>Transfer in a Domain: DN </option>
                                            <option>Bulk Registration: DN </option>
                                            <option>Bulk Renewal: DN </option>
                                            <option>Bulk Transfer: DN </option>
                                            <option>===========================================================</option>
                                            <option>---- E-commerce ----</option>
                                            <option>200: EC-200-1</option>
                                            <option>20,000: EC-20k-1</option>
                                            <option>Unlimited: EC-U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Email88 ----</option>
                                            <option>Booster I: E88B1-10k-1</option>
                                            <option>Booster II: E88B2-15k-1</option>
                                            <option>Booster III: E88B3-20k-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Shared Hosting ----</option>
                                            <option>Small: SHSM-1</option>
                                            <option>Medium: SHME-1</option>
                                            <option>Large: SHBI-1</option>
                                            <option>===========================================================</option>
                                            <option>---- SSL Certificates ----</option>
                                            <option>Secure a Single Common Name: EV-DC1</option>
                                            <option>Secure Multiple Domains: UC-DC1</option>
                                            <option>SP-DC1: UC-DC1</option>
                                            <option>===========================================================</option>
                                            <option>---- VPS Hosting ----</option>
                                            <option selected="selected">Linux Basic: VPS58-2-1</option>
                                            <option>Linux Gold: VPS78-3-1</option>
                                            <option>VPS28-1-1: VPS78-3-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Web88IR ----</option>
                                            <option>Dynamic I: IRH1-1</option>
                                            <option>Dynamic I: IRD2-1</option>
                                            <option>Dynamic II: IRD2-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Responsive Web Design ----</option>
                                            <option>Responsive Web Design</option>
                                            <option>===========================================================</option>
                                            <option>---- Social Media ----</option>
                                            <option>Social Media</option>
                                            <option>===========================================================</option>
                                            <option>List all services here</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">Please select a <b>"Service Plan"</b> &amp; <b>"Service Code"</b> to continue, eg. for VPS Hosting, <b>Service Plan = "Linux Basic"</b>, <b>Service Code = "VPS58-2-1"</b>.</div>
                                          note to programmer: some of the services does not have a service code, if service plan doesn't have a service code, please leave it blank after the plan name in the above dropdown list.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan/Package Name</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                        </div>

                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Unit Price (RM)</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00" value="831.60">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">The unit price is for all other packages execpt domain. For single/bulk domain prices, please specify the prices in below <b>"Domain Configuration"</b> section.</div>
                                          note to programmer: auto-fill in the price above after selected a plan. the price will be varied from the selection of the plan above.
                                        </div>

                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Name </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Sample 2">
                                          note to programmer: "discount name" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Rate </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Promo Code </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Test123">
                                          note to programmer: "promo code" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount Rate (Promo Code) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">SSL Price (RM) </label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option value="1 year">1 year(s) @ RM239.99/yr</option>
                                            <option value="2 years">2 year(s) @ RM 219.99/yr</option>
                                            <option value="3 years">3 year(s) @ RM 199.99/yr</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          note to programmer: the ssl price dropdown list is dynamic and fectched from the ssl services setup depending on the ssl plan selected above.
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Quantity <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="1" value="1">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Cycle <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. 1 year(s)" value="1 Year(s)">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Setup Fee (RM) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">If "Setup Fee" is set to <b>RM 0.00</b>, it is <b>"FREE Setup"</b>.</div>
                                        </div>
                                      </div>

                                      <!-- domain configuration start -->
                                      <h5 class="block-heading">Domain Configuration</h5>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Domain Name <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <label><input type="radio" checked="checked"> Use existing domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net" value="webqom.info">
                                            </label>
                                            <label><input type="radio"> Register a new domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domain below (for single domain):
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domains below (for bulk domains):
                                              <div class="xs-margin"></div>
                                              <textarea class="form-control" rows="10">Each name must be on a separate line.

Examples:
yourdomain.com
yourdomain.net
                                                                            </textarea>
                                            </label>
                                          </div>

                                        </div>
                                      </div>
                                      note to programmer: the domain price from 1 year to 10 years is dynamic and fectched from the domain pricing and maybe varied from different TLDs. Same as bulk domain pricing.

                                      <h6 class="block-heading">Single Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify single domain price in below table for <b>"New Domain Registration"</b>, <b>"Domain Renewal"</b> or <b>"Transfer in a Domain"</b>. If "Domain Price" is set to <b>RM 0.00</b>, it is <b>"FREE Domain"</b>. </div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="5"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <h6 class="block-heading">Bulk Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify bulk domain price in below table for <b>"Bulk Registration"</b>, <b>"Bulk Renewal"</b> or <b>"Bulk Transfer"</b>.</div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>Domains</th>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>1-5</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>6-20</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>21-49</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>50-100</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>101-200</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>201-500</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="6"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Domain Addons </label>
                                        <div class="col-md-6">
                                          <div class="checkbox-list margin-top-10px">
                                            <label><input type="checkbox" />&nbsp; DNS Management (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; Email Forwarding (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; ID Protection (@ RM 102.50/yr)</label>
                                            note to programmer: domain addons list and price is fetched from the domain setup.
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end domain configuration -->

                                      <!-- custom vps hosting plan specs start -->
                                      <h5 class="block-heading">VPS Hosting Plan Specifications</h5>
                                      <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                                      <div class="xs-margin"></div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan Specification</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. RAM: 1GB">
                                          <div class="xss-margin"></div>
                                          <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end custom vps hosting plan specs -->

                                      <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                    </form>
                                  </div><!-- end modal body -->
                                </div>
                              </div>
                            </div><!-- end modal edit vps hosting -->

                          </td>
                        </tr>
                        <tr>
                          <td><input class="sub_chk" type="checkbox" /></td>
                          <td>6</td>
                          <td><b>Service Code: </b> DS1x4-4-2x1TB<br />
                            <b>Dedicated Server Plan: </b> Enterprise 1 <span class="text-red">(FREE Setup)</span><br />
                            <b>Domain: </b>webqom.biz <br />
                            <b>Setup Fee:</b> <span class="text-red">RM 0.00</span><br />
                            <b>Server Configuration:</b>
                            <ul class="list-style">
                              <li><i class="fa icon-angle-right"></i> CPU: 1 x 4-cores Intel Xeon</li>
                              <li><i class="fa icon-angle-right"></i> No. of Processors: 1 processor</li>
                              <li><i class="fa icon-angle-right"></i> RAM: 4GB</li>
                              <li><i class="fa icon-angle-right"></i> Hard Disk: 2 x 1TB SATA</li>
                              <li><i class="fa icon-angle-right"></i> No. of IP addresses (IPv4): 1 x IPv4 Address</li>
                              <li><i class="fa icon-angle-right"></i> Bandwidth: 10Mbps</li>
                              <li><i class="fa icon-angle-right"></i> Control Panel: Webmin / cPanel WHM / zPanel</li>
                              <li><i class="fa icon-angle-right"></i> Fully Managed Server: Optional</li>
                            </ul>
                          </td>
                          <td class="text-center">1 year(s)</td>
                          <td class="text-center">1</td>
                          <td class="text-center">0.00</td>
                          <td class="text-center">Test123 / 10%</td>
                          <td class="text-right">RM 6,588.00</td>
                          <td class="text-center"><a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-dedicated" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                            <!-- edit dedicated server modal start -->
                            <div id="modal-edit-dedicated" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade text-left">
                              <div class="modal-dialog modal-wide-width">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title">Add New Item</h4>
                                  </div>
                                  <div class="modal-body">
                                    <h5 class="block-heading">Services</h5>

                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Service Plan / Service Code <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option>Custom Plan/Package</option>
                                            <option>===========================================================</option>
                                            <option>---- Cloud Hosting ----</option>
                                            <option>S Cloud: SCL-1</option>
                                            <option>M Cloud: MCL-1</option>
                                            <option>L Cloud: LCL-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Co-location Hosting ----</option>
                                            <option>2U: CO2U-1</option>
                                            <option>5U: CO5U-1</option>
                                            <option>10U: CO10U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Dedicated Server ----</option>
                                            <option selected="selected">Enterprise 1: DS1x4-4-2x1TB</option>
                                            <option>Enterprise 2: DS2x6-8-2x1TB</option>
                                            <option>Enterprise 3: DS2x6-8-2x1TB</option>
                                            <option>===========================================================</option>
                                            <option>---- Domains ----</option>
                                            <option>Register a New Domain: DN </option>
                                            <option>Renew a Domain: DN </option>
                                            <option>Transfer in a Domain: DN </option>
                                            <option>Bulk Registration: DN </option>
                                            <option>Bulk Renewal: DN </option>
                                            <option>Bulk Transfer: DN </option>
                                            <option>===========================================================</option>
                                            <option>---- E-commerce ----</option>
                                            <option>200: EC-200-1</option>
                                            <option>20,000: EC-20k-1</option>
                                            <option>Unlimited: EC-U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Email88 ----</option>
                                            <option>Booster I: E88B1-10k-1</option>
                                            <option>Booster II: E88B2-15k-1</option>
                                            <option>Booster III: E88B3-20k-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Shared Hosting ----</option>
                                            <option>Small: SHSM-1</option>
                                            <option>Medium: SHME-1</option>
                                            <option>Large: SHBI-1</option>
                                            <option>===========================================================</option>
                                            <option>---- SSL Certificates ----</option>
                                            <option>Secure a Single Common Name: EV-DC1</option>
                                            <option>Secure Multiple Domains: UC-DC1</option>
                                            <option>SP-DC1: UC-DC1</option>
                                            <option>===========================================================</option>
                                            <option>---- VPS Hosting ----</option>
                                            <option>Linux Basic: VPS58-2-1</option>
                                            <option>Linux Gold: VPS78-3-1</option>
                                            <option>VPS28-1-1: VPS78-3-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Web88IR ----</option>
                                            <option>Dynamic I: IRH1-1</option>
                                            <option>Dynamic I: IRD2-1</option>
                                            <option>Dynamic II: IRD2-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Responsive Web Design ----</option>
                                            <option>Responsive Web Design</option>
                                            <option>===========================================================</option>
                                            <option>---- Social Media ----</option>
                                            <option>Social Media</option>
                                            <option>===========================================================</option>
                                            <option>List all services here</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">Please select a <b>"Service Plan"</b> &amp; <b>"Service Code"</b> to continue, eg. for VPS Hosting, <b>Service Plan = "Linux Basic"</b>, <b>Service Code = "VPS58-2-1"</b>.</div>
                                          note to programmer: some of the services does not have a service code, if service plan doesn't have a service code, please leave it blank after the plan name in the above dropdown list.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan/Package Name</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                        </div>

                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Unit Price (RM)</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00" value="6,588.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">The unit price is for all other packages execpt domain. For single/bulk domain prices, please specify the prices in below <b>"Domain Configuration"</b> section.</div>
                                          note to programmer: auto-fill in the price above after selected a plan. the price will be varied from the selection of the plan above.
                                        </div>

                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Name </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Sample 2" value="Sample 2">
                                          note to programmer: "discount name" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Rate </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Promo Code </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Test123" value="Test123">
                                          note to programmer: "promo code" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount Rate (Promo Code) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount" value="10">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%" selected="selected">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">SSL Price (RM) </label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option value="1 year">1 year(s) @ RM239.99/yr</option>
                                            <option value="2 years">2 year(s) @ RM 219.99/yr</option>
                                            <option value="3 years">3 year(s) @ RM 199.99/yr</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          note to programmer: the ssl price dropdown list is dynamic and fectched from the ssl services setup depending on the ssl plan selected above.
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Quantity <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="1" value="1">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Cycle <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. 1 year(s)" value="1 Year(s)">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Setup Fee (RM) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00" value="0.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">If "Setup Fee" is set to <b>RM 0.00</b>, it is <b>"FREE Setup"</b>.</div>
                                        </div>
                                      </div>

                                      <!-- domain configuration start -->
                                      <h5 class="block-heading">Domain Configuration</h5>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Domain Name <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <label><input type="radio" checked="checked"> Use existing domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net" value="webqom.biz">
                                            </label>
                                            <label><input type="radio"> Register a new domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domain below (for single domain):
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domains below (for bulk domains):
                                              <div class="xs-margin"></div>
                                              <textarea class="form-control" rows="10">Each name must be on a separate line.

Examples:
yourdomain.com
yourdomain.net
                                                                            </textarea>
                                            </label>
                                          </div>

                                        </div>
                                      </div>
                                      note to programmer: the domain price from 1 year to 10 years is dynamic and fectched from the domain pricing and maybe varied from different TLDs. Same as bulk domain pricing.

                                      <h6 class="block-heading">Single Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify single domain price in below table for <b>"New Domain Registration"</b>, <b>"Domain Renewal"</b> or <b>"Transfer in a Domain"</b>. If "Domain Price" is set to <b>RM 0.00</b>, it is <b>"FREE Domain"</b>. </div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="5"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <h6 class="block-heading">Bulk Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify bulk domain price in below table for <b>"Bulk Registration"</b>, <b>"Bulk Renewal"</b> or <b>"Bulk Transfer"</b>.</div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>Domains</th>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>1-5</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>6-20</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>21-49</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>50-100</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>101-200</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>201-500</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="6"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Domain Addons </label>
                                        <div class="col-md-6">
                                          <div class="checkbox-list margin-top-10px">
                                            <label><input type="checkbox" />&nbsp; DNS Management (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; Email Forwarding (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; ID Protection (@ RM 102.50/yr)</label>
                                            note to programmer: domain addons list and price is fetched from the domain setup.
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end domain configuration -->

                                      <!-- dedicated server configuration start -->
                                      <h5 class="block-heading">Dedicated Server Configuration</h5>
                                      <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">CPU </label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio" checked="checked">&nbsp; 1 x 4-cores Intel Xeon </label>
                                            <label><input type="radio">&nbsp; 1 x 6-cores Intel Xeon </label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">No. of Processors</label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio" checked="checked">&nbsp; 1 processor </label>
                                            <label><input type="radio">&nbsp; 2 processors </label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">RAM</label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio" checked="checked">&nbsp; 4GB </label>
                                            <label><input type="radio">&nbsp; 8GB </label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Hard Disk </label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio" checked="checked">&nbsp; 2 x 1TB SATA </label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">No. of IP Addresses (IPv4) </label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio" checked="checked">&nbsp; 1 x IPv4 Address</label>
                                            <label><input type="radio">&nbsp; 2 x IPv4 Address </label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Bandwidth </label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio" checked="checked">&nbsp; 10Mbps </label>
                                            <label><input type="radio">&nbsp; 20Mbps </label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Control Panel </label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio">&nbsp; No management software </label>
                                            <label><input type="radio" checked="checked">&nbsp; Webmin / cPanel WHM / zPanel </label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Fully Managed Server </label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio" checked="checked">&nbsp; Optional </label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan Specification</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                          <div class="xss-margin"></div>
                                          <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>

                                      <!-- end dedicated server configuration -->

                                      <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                    </form>
                                  </div><!-- end modal body -->
                                </div>
                              </div>
                            </div><!-- end modal edit dedicated server -->
                          </td>
                        </tr>
                        <tr>
                          <td><input class="sub_chk" type="checkbox" /></td>
                          <td>7</td>
                          <td><b>Service Code: </b> CO2U-1<br />
                            <b>Co-location Hosting Plan: </b> 2U <span class="text-red">(FREE Setup)</span><br />
                            <b>Domain: </b>webqom.limited <br />
                            <b>Setup Fee:</b> <span class="text-red">RM 0.00</span><br />
                            <b>Server Configuration:</b>
                            <ul class="list-style">
                              <li><i class="fa icon-angle-right"></i> Rack Space: Quarter Rack</li>
                              <li><i class="fa icon-angle-right"></i> Bandwidth: 10Mbps</li>
                              <li><i class="fa icon-angle-right"></i> Power Port: 1 Port</li>
                              <li><i class="fa icon-angle-right"></i> Wan Port: 1 Port</li>
                              <li><i class="fa icon-angle-right"></i> No. of IP Addresses: 1</li>
                            </ul>
                          </td>
                          <td class="text-center">1 year(s)</td>
                          <td class="text-center">1</td>
                          <td class="text-center">0.00</td>
                          <td class="text-center">Test123 / 10%</td>
                          <td class="text-right">RM 4,500.00</td>
                          <td class="text-center"><a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-colocation" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                            <!-- edit co-location server modal start -->
                            <div id="modal-edit-colocation" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade text-left">
                              <div class="modal-dialog modal-wide-width">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title">Edit Item</h4>
                                  </div>
                                  <div class="modal-body">
                                    <h5 class="block-heading">Services</h5>

                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Service Plan / Service Code <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option>Custom Plan/Package</option>
                                            <option>===========================================================</option>
                                            <option>---- Cloud Hosting ----</option>
                                            <option>S Cloud: SCL-1</option>
                                            <option>M Cloud: MCL-1</option>
                                            <option>L Cloud: LCL-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Co-location Hosting ----</option>
                                            <option selected="selected">2U: CO2U-1</option>
                                            <option>5U: CO5U-1</option>
                                            <option>10U: CO10U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Dedicated Server ----</option>
                                            <option>Enterprise 1: DS1x4-4-2x1TB</option>
                                            <option>Enterprise 2: DS2x6-8-2x1TB</option>
                                            <option>Enterprise 3: DS2x6-8-2x1TB</option>
                                            <option>===========================================================</option>
                                            <option>---- Domains ----</option>
                                            <option>Register a New Domain: DN </option>
                                            <option>Renew a Domain: DN </option>
                                            <option>Transfer in a Domain: DN </option>
                                            <option>Bulk Registration: DN </option>
                                            <option>Bulk Renewal: DN </option>
                                            <option>Bulk Transfer: DN </option>
                                            <option>===========================================================</option>
                                            <option>---- E-commerce ----</option>
                                            <option>200: EC-200-1</option>
                                            <option>20,000: EC-20k-1</option>
                                            <option>Unlimited: EC-U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Email88 ----</option>
                                            <option>Booster I: E88B1-10k-1</option>
                                            <option>Booster II: E88B2-15k-1</option>
                                            <option>Booster III: E88B3-20k-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Shared Hosting ----</option>
                                            <option>Small: SHSM-1</option>
                                            <option>Medium: SHME-1</option>
                                            <option>Large: SHBI-1</option>
                                            <option>===========================================================</option>
                                            <option>---- SSL Certificates ----</option>
                                            <option>Secure a Single Common Name: EV-DC1</option>
                                            <option>Secure Multiple Domains: UC-DC1</option>
                                            <option>SP-DC1: UC-DC1</option>
                                            <option>===========================================================</option>
                                            <option>---- VPS Hosting ----</option>
                                            <option>Linux Basic: VPS58-2-1</option>
                                            <option>Linux Gold: VPS78-3-1</option>
                                            <option>VPS28-1-1: VPS78-3-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Web88IR ----</option>
                                            <option>Dynamic I: IRH1-1</option>
                                            <option>Dynamic I: IRD2-1</option>
                                            <option>Dynamic II: IRD2-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Responsive Web Design ----</option>
                                            <option>Responsive Web Design</option>
                                            <option>===========================================================</option>
                                            <option>---- Social Media ----</option>
                                            <option>Social Media</option>
                                            <option>===========================================================</option>
                                            <option>List all services here</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">Please select a <b>"Service Plan"</b> &amp; <b>"Service Code"</b> to continue, eg. for VPS Hosting, <b>Service Plan = "Linux Basic"</b>, <b>Service Code = "VPS58-2-1"</b>.</div>
                                          note to programmer: some of the services does not have a service code, if service plan doesn't have a service code, please leave it blank after the plan name in the above dropdown list.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan/Package Name</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                        </div>

                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Unit Price (RM)</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00" value="4,500.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">The unit price is for all other packages execpt domain. For single/bulk domain prices, please specify the prices in below <b>"Domain Configuration"</b> section.</div>
                                          note to programmer: auto-fill in the price above after selected a plan. the price will be varied from the selection of the plan above.
                                        </div>

                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Name </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Sample 2">
                                          note to programmer: "discount name" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Rate </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Promo Code </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Test123" value="Test123">
                                          note to programmer: "promo code" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount Rate (Promo Code) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount" value="10">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%" selected="selected">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">SSL Price (RM) </label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option value="1 year">1 year(s) @ RM239.99/yr</option>
                                            <option value="2 years">2 year(s) @ RM 219.99/yr</option>
                                            <option value="3 years">3 year(s) @ RM 199.99/yr</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          note to programmer: the ssl price dropdown list is dynamic and fectched from the ssl services setup depending on the ssl plan selected above.
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Quantity <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="1" value="1">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Cycle <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. 1 year(s)" value="1 Year(s)">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Setup Fee (RM) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00" value="0.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">If "Setup Fee" is set to <b>RM 0.00</b>, it is <b>"FREE Setup"</b>.</div>
                                        </div>
                                      </div>

                                      <!-- domain configuration start -->
                                      <h5 class="block-heading">Domain Configuration</h5>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Domain Name <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <label><input type="radio" checked="checked"> Use existing domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net" value="webqom.limited">
                                            </label>
                                            <label><input type="radio"> Register a new domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domain below (for single domain):
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domains below (for bulk domains):
                                              <div class="xs-margin"></div>
                                              <textarea class="form-control" rows="10">Each name must be on a separate line.

Examples:
yourdomain.com
yourdomain.net
                                                                            </textarea>
                                            </label>
                                          </div>

                                        </div>
                                      </div>
                                      note to programmer: the domain price from 1 year to 10 years is dynamic and fectched from the domain pricing and maybe varied from different TLDs. Same as bulk domain pricing.

                                      <h6 class="block-heading">Single Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify single domain price in below table for <b>"New Domain Registration"</b>, <b>"Domain Renewal"</b> or <b>"Transfer in a Domain"</b>. If "Domain Price" is set to <b>RM 0.00</b>, it is <b>"FREE Domain"</b>. </div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="5"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <h6 class="block-heading">Bulk Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify bulk domain price in below table for <b>"Bulk Registration"</b>, <b>"Bulk Renewal"</b> or <b>"Bulk Transfer"</b>.</div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>Domains</th>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>1-5</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>6-20</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>21-49</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>50-100</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>101-200</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>201-500</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="6"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Domain Addons </label>
                                        <div class="col-md-6">
                                          <div class="checkbox-list margin-top-10px">
                                            <label><input type="checkbox" />&nbsp; DNS Management (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; Email Forwarding (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; ID Protection (@ RM 102.50/yr)</label>
                                            note to programmer: domain addons list and price is fetched from the domain setup.
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end domain configuration -->

                                      <!-- co-location hosting configuration start -->
                                      <h5 class="block-heading">Co-location Hosting Configuration</h5>
                                      <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Rack Space </label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio" checked="checked">&nbsp; Quarter Rack </label>
                                            <label><input type="radio">&nbsp; Half Rack </label>
                                            <label><input type="radio">&nbsp; Full Rack </label>
                                            <label><input type="radio">&nbsp; Cabinet </label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Bandwidth </label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio" checked="checked">&nbsp; 10Mbps </label>
                                            <label><input type="radio">&nbsp; 20Mbps </label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Power Port</label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio" checked="checked">&nbsp; 1 Port </label>
                                            <label><input type="radio">&nbsp; 5 Ports </label>
                                            <label><input type="radio">&nbsp; 10 Ports </label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Wan Port </label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio" checked="checked">&nbsp; 1 Port</label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">No. of IP Addresses</label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <div class="margin-top-5px"></div>
                                            <label><input type="radio" checked="checked">&nbsp; 1</label>
                                            <label><input type="radio">&nbsp; 4 </label>
                                            <label><input type="radio">&nbsp; Others, please sepcify:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control">
                                            </label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan Specification</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                          <div class="xss-margin"></div>
                                          <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end co-location hosting configuration -->

                                      <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                    </form>
                                  </div><!-- end modal body -->
                                </div>
                              </div>
                            </div><!-- end modal edit co-location hosting -->
                          </td>
                        </tr>
                        <tr>
                          <td><input class="sub_chk" type="checkbox" /></td>
                          <td>8</td>
                          <td><b>Responsive Web Design Plan: </b> Basic<br />
                            <b>Domain: </b>webqom.limited <br />
                          </td>
                          <td class="text-center">1 year(s)</td>
                          <td class="text-center">1</td>
                          <td class="text-center">0.00</td>
                          <td class="text-center">0.00</td>
                          <td class="text-right">RM 1,990.00</td>
                          <td class="text-center"><a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-rwd" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                            <!-- edit rwd modal start -->
                            <div id="modal-edit-rwd" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade text-left">
                              <div class="modal-dialog modal-wide-width">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title">Edit Item</h4>
                                  </div>
                                  <div class="modal-body">
                                    <h5 class="block-heading">Services</h5>

                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Service Plan / Service Code <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option>Custom Plan/Package</option>
                                            <option>===========================================================</option>
                                            <option>---- Cloud Hosting ----</option>
                                            <option>S Cloud: SCL-1</option>
                                            <option>M Cloud: MCL-1</option>
                                            <option>L Cloud: LCL-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Co-location Hosting ----</option>
                                            <option>2U: CO2U-1</option>
                                            <option>5U: CO5U-1</option>
                                            <option>10U: CO10U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Dedicated Server ----</option>
                                            <option>Enterprise 1: DS1x4-4-2x1TB</option>
                                            <option>Enterprise 2: DS2x6-8-2x1TB</option>
                                            <option>Enterprise 3: DS2x6-8-2x1TB</option>
                                            <option>===========================================================</option>
                                            <option>---- Domains ----</option>
                                            <option>Register a New Domain: DN </option>
                                            <option>Renew a Domain: DN </option>
                                            <option>Transfer in a Domain: DN </option>
                                            <option>Bulk Registration: DN </option>
                                            <option>Bulk Renewal: DN </option>
                                            <option>Bulk Transfer: DN </option>
                                            <option>===========================================================</option>
                                            <option>---- E-commerce ----</option>
                                            <option>200: EC-200-1</option>
                                            <option>20,000: EC-20k-1</option>
                                            <option>Unlimited: EC-U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Email88 ----</option>
                                            <option>Booster I: E88B1-10k-1</option>
                                            <option>Booster II: E88B2-15k-1</option>
                                            <option>Booster III: E88B3-20k-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Shared Hosting ----</option>
                                            <option>Small: SHSM-1</option>
                                            <option>Medium: SHME-1</option>
                                            <option>Large: SHBI-1</option>
                                            <option>===========================================================</option>
                                            <option>---- SSL Certificates ----</option>
                                            <option>Secure a Single Common Name: EV-DC1</option>
                                            <option>Secure Multiple Domains: UC-DC1</option>
                                            <option>SP-DC1: UC-DC1</option>
                                            <option>===========================================================</option>
                                            <option>---- VPS Hosting ----</option>
                                            <option>Linux Basic: VPS58-2-1</option>
                                            <option>Linux Gold: VPS78-3-1</option>
                                            <option>VPS28-1-1: VPS78-3-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Web88IR ----</option>
                                            <option>Dynamic I: IRH1-1</option>
                                            <option>Dynamic I: IRD2-1</option>
                                            <option>Dynamic II: IRD2-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Responsive Web Design ----</option>
                                            <option selected="selected">Responsive Web Design</option>
                                            <option>===========================================================</option>
                                            <option>---- Social Media ----</option>
                                            <option>Social Media</option>
                                            <option>===========================================================</option>
                                            <option>List all services here</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">Please select a <b>"Service Plan"</b> &amp; <b>"Service Code"</b> to continue, eg. for VPS Hosting, <b>Service Plan = "Linux Basic"</b>, <b>Service Code = "VPS58-2-1"</b>.</div>
                                          note to programmer: some of the services does not have a service code, if service plan doesn't have a service code, please leave it blank after the plan name in the above dropdown list.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan/Package Name</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                        </div>

                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Unit Price (RM)</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00" value="1,990.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">The unit price is for all other packages execpt domain. For single/bulk domain prices, please specify the prices in below <b>"Domain Configuration"</b> section.</div>
                                          note to programmer: auto-fill in the price above after selected a plan. the price will be varied from the selection of the plan above.
                                        </div>

                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Name </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Sample 2">
                                          note to programmer: "discount name" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Rate </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Promo Code </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Test123">
                                          note to programmer: "promo code" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount Rate (Promo Code) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">SSL Price (RM) </label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option value="1 year">1 year(s) @ RM239.99/yr</option>
                                            <option value="2 years">2 year(s) @ RM 219.99/yr</option>
                                            <option value="3 years">3 year(s) @ RM 199.99/yr</option>

                                          </select>
                                          <div class="xs-margin"></div>
                                          note to programmer: the ssl price dropdown list is dynamic and fectched from the ssl services setup depending on the ssl plan selected above.
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Quantity <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="1" value="1">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Cycle <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. 1 year(s)" value="1 Year(s)">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Setup Fee (RM) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">If "Setup Fee" is set to <b>RM 0.00</b>, it is <b>"FREE Setup"</b>.</div>
                                        </div>
                                      </div>

                                      <!-- domain configuration start -->
                                      <h5 class="block-heading">Domain Configuration</h5>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Domain Name <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <label><input type="radio" checked="checked"> Use existing domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net" value="webqom.limited">
                                            </label>
                                            <label><input type="radio"> Register a new domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domain below (for single domain):
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domains below (for bulk domains):
                                              <div class="xs-margin"></div>
                                              <textarea class="form-control" rows="10">Each name must be on a separate line.

Examples:
yourdomain.com
yourdomain.net
                                                                            </textarea>
                                            </label>
                                          </div>

                                        </div>
                                      </div>
                                      note to programmer: the domain price from 1 year to 10 years is dynamic and fectched from the domain pricing and maybe varied from different TLDs. Same as bulk domain pricing.

                                      <h6 class="block-heading">Single Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify single domain price in below table for <b>"New Domain Registration"</b>, <b>"Domain Renewal"</b> or <b>"Transfer in a Domain"</b>. If "Domain Price" is set to <b>RM 0.00</b>, it is <b>"FREE Domain"</b>. </div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="5"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <h6 class="block-heading">Bulk Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify bulk domain price in below table for <b>"Bulk Registration"</b>, <b>"Bulk Renewal"</b> or <b>"Bulk Transfer"</b>.</div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>Domains</th>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>1-5</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>6-20</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>21-49</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>50-100</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>101-200</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>201-500</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="6"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Domain Addons </label>
                                        <div class="col-md-6">
                                          <div class="checkbox-list margin-top-10px">
                                            <label><input type="checkbox" />&nbsp; DNS Management (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; Email Forwarding (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; ID Protection (@ RM 102.50/yr)</label>
                                            note to programmer: domain addons list and price is fetched from the domain setup.
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end domain configuration -->

                                      <!-- custom rwd plan specs start -->
                                      <h5 class="block-heading">Responsive Web Design Plan Specifications</h5>
                                      <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                                      <div class="xs-margin"></div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan Specification</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                          <div class="xss-margin"></div>
                                          <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end custom rwd plan specs -->

                                      <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                    </form>
                                  </div><!-- end modal body -->
                                </div>
                              </div>
                            </div><!-- end modal edit rwd -->
                          </td>
                        </tr>
                        <tr>
                          <td><input class="sub_chk" type="checkbox" /></td>
                          <td>9</td>
                          <td><b>Service Code: </b> EC-200-1<br />
                            <b>E-commerce Plan: </b> 200<br />
                            <b>Domain: </b>webqom.limited <br />
                          </td>
                          <td class="text-center">1 year(s)</td>
                          <td class="text-center">1</td>
                          <td class="text-center">0.00</td>
                          <td class="text-center">0.00</td>
                          <td class="text-right">RM 9,900.00</td>
                          <td class="text-center"><a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-ecommerce" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                            <!-- edit ecommerce modal start -->
                            <div id="modal-edit-ecommerce" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade text-left">
                              <div class="modal-dialog modal-wide-width">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title">Edit Item</h4>
                                  </div>
                                  <div class="modal-body">
                                    <h5 class="block-heading">Services</h5>

                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Service Plan / Service Code <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option>Custom Plan/Package</option>
                                            <option>===========================================================</option>
                                            <option>---- Cloud Hosting ----</option>
                                            <option>S Cloud: SCL-1</option>
                                            <option>M Cloud: MCL-1</option>
                                            <option>L Cloud: LCL-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Co-location Hosting ----</option>
                                            <option>2U: CO2U-1</option>
                                            <option>5U: CO5U-1</option>
                                            <option>10U: CO10U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Dedicated Server ----</option>
                                            <option>Enterprise 1: DS1x4-4-2x1TB</option>
                                            <option>Enterprise 2: DS2x6-8-2x1TB</option>
                                            <option>Enterprise 3: DS2x6-8-2x1TB</option>
                                            <option>===========================================================</option>
                                            <option>---- Domains ----</option>
                                            <option>Register a New Domain: DN </option>
                                            <option>Renew a Domain: DN </option>
                                            <option>Transfer in a Domain: DN </option>
                                            <option>Bulk Registration: DN </option>
                                            <option>Bulk Renewal: DN </option>
                                            <option>Bulk Transfer: DN </option>
                                            <option>===========================================================</option>
                                            <option>---- E-commerce ----</option>
                                            <option selected="selected">200: EC-200-1</option>
                                            <option>20,000: EC-20k-1</option>
                                            <option>Unlimited: EC-U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Email88 ----</option>
                                            <option>Booster I: E88B1-10k-1</option>
                                            <option>Booster II: E88B2-15k-1</option>
                                            <option>Booster III: E88B3-20k-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Shared Hosting ----</option>
                                            <option>Small: SHSM-1</option>
                                            <option>Medium: SHME-1</option>
                                            <option>Large: SHBI-1</option>
                                            <option>===========================================================</option>
                                            <option>---- SSL Certificates ----</option>
                                            <option>Secure a Single Common Name: EV-DC1</option>
                                            <option>Secure Multiple Domains: UC-DC1</option>
                                            <option>SP-DC1: UC-DC1</option>
                                            <option>===========================================================</option>
                                            <option>---- VPS Hosting ----</option>
                                            <option>Linux Basic: VPS58-2-1</option>
                                            <option>Linux Gold: VPS78-3-1</option>
                                            <option>VPS28-1-1: VPS78-3-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Web88IR ----</option>
                                            <option>Dynamic I: IRH1-1</option>
                                            <option>Dynamic I: IRD2-1</option>
                                            <option>Dynamic II: IRD2-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Responsive Web Design ----</option>
                                            <option>Responsive Web Design</option>
                                            <option>===========================================================</option>
                                            <option>---- Social Media ----</option>
                                            <option>Social Media</option>
                                            <option>===========================================================</option>
                                            <option>List all services here</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">Please select a <b>"Service Plan"</b> &amp; <b>"Service Code"</b> to continue, eg. for VPS Hosting, <b>Service Plan = "Linux Basic"</b>, <b>Service Code = "VPS58-2-1"</b>.</div>
                                          note to programmer: some of the services does not have a service code, if service plan doesn't have a service code, please leave it blank after the plan name in the above dropdown list.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan/Package Name</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                        </div>

                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Unit Price (RM)</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00" value="9,900.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">The unit price is for all other packages execpt domain. For single/bulk domain prices, please specify the prices in below <b>"Domain Configuration"</b> section.</div>
                                          note to programmer: auto-fill in the price above after selected a plan. the price will be varied from the selection of the plan above.
                                        </div>

                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Name </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Sample 2">
                                          note to programmer: "discount name" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Rate </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Promo Code </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Test123">
                                          note to programmer: "promo code" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount Rate (Promo Code) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">SSL Price (RM) </label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option value="1 year">1 year(s) @ RM239.99/yr</option>
                                            <option value="2 years">2 year(s) @ RM 219.99/yr</option>
                                            <option value="3 years">3 year(s) @ RM 199.99/yr</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          note to programmer: the ssl price dropdown list is dynamic and fectched from the ssl services setup depending on the ssl plan selected above.
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Quantity <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="1" value="1">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Cycle <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. 1 year(s)" value="1 Year(s)">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Setup Fee (RM) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">If "Setup Fee" is set to <b>RM 0.00</b>, it is <b>"FREE Setup"</b>.</div>
                                        </div>
                                      </div>

                                      <!-- domain configuration start -->
                                      <h5 class="block-heading">Domain Configuration</h5>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Domain Name <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <label><input type="radio" checked="checked"> Use existing domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net" value="webqom.limited">
                                            </label>
                                            <label><input type="radio"> Register a new domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domain below (for single domain):
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domains below (for bulk domains):
                                              <div class="xs-margin"></div>
                                              <textarea class="form-control" rows="10">Each name must be on a separate line.

Examples:
yourdomain.com
yourdomain.net
                                                                            </textarea>
                                            </label>
                                          </div>

                                        </div>
                                      </div>
                                      note to programmer: the domain price from 1 year to 10 years is dynamic and fectched from the domain pricing and maybe varied from different TLDs. Same as bulk domain pricing.

                                      <h6 class="block-heading">Single Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify single domain price in below table for <b>"New Domain Registration"</b>, <b>"Domain Renewal"</b> or <b>"Transfer in a Domain"</b>. If "Domain Price" is set to <b>RM 0.00</b>, it is <b>"FREE Domain"</b>. </div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="5"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <h6 class="block-heading">Bulk Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify bulk domain price in below table for <b>"Bulk Registration"</b>, <b>"Bulk Renewal"</b> or <b>"Bulk Transfer"</b>.</div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>Domains</th>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>1-5</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>6-20</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>21-49</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>50-100</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>101-200</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>201-500</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="6"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Domain Addons </label>
                                        <div class="col-md-6">
                                          <div class="checkbox-list margin-top-10px">
                                            <label><input type="checkbox" />&nbsp; DNS Management (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; Email Forwarding (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; ID Protection (@ RM 102.50/yr)</label>
                                            note to programmer: domain addons list and price is fetched from the domain setup.
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end domain configuration -->

                                      <!-- custom ecommerce plan specs start -->
                                      <h5 class="block-heading">E-commerce Plan Specifications</h5>
                                      <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                                      <div class="xs-margin"></div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan Specification</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                          <div class="xss-margin"></div>
                                          <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end custom ecommerce plan specs -->

                                      <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                    </form>
                                  </div><!-- end modal body -->
                                </div>
                              </div>
                            </div><!-- end modal edit ecommerce -->
                          </td>
                        </tr>
                        <tr>
                          <td><input class="sub_chk" type="checkbox" /></td>
                          <td>10</td>
                          <td><b>Service Code: </b> E88B1-10k-1<br />
                            <b>Email88 Plan: </b> Booster I<br />
                            <b>Domain: </b>webqom.limited <br />
                          </td>
                          <td class="text-center">1 year(s)</td>
                          <td class="text-center">1</td>
                          <td class="text-center">0.00</td>
                          <td class="text-center">0.00</td>
                          <td class="text-right">RM 1,188.00</td>
                          <td class="text-center"><a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-email88" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                            <!-- edit email88 modal start -->
                            <div id="modal-edit-email88" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade text-left">
                              <div class="modal-dialog modal-wide-width">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title">Edit Item</h4>
                                  </div>
                                  <div class="modal-body">
                                    <h5 class="block-heading">Services</h5>

                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Service Plan / Service Code <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option>Custom Plan/Package</option>
                                            <option>===========================================================</option>
                                            <option>---- Cloud Hosting ----</option>
                                            <option>S Cloud: SCL-1</option>
                                            <option>M Cloud: MCL-1</option>
                                            <option>L Cloud: LCL-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Co-location Hosting ----</option>
                                            <option>2U: CO2U-1</option>
                                            <option>5U: CO5U-1</option>
                                            <option>10U: CO10U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Dedicated Server ----</option>
                                            <option>Enterprise 1: DS1x4-4-2x1TB</option>
                                            <option>Enterprise 2: DS2x6-8-2x1TB</option>
                                            <option>Enterprise 3: DS2x6-8-2x1TB</option>
                                            <option>===========================================================</option>
                                            <option>---- Domains ----</option>
                                            <option>Register a New Domain: DN </option>
                                            <option>Renew a Domain: DN </option>
                                            <option>Transfer in a Domain: DN </option>
                                            <option>Bulk Registration: DN </option>
                                            <option>Bulk Renewal: DN </option>
                                            <option>Bulk Transfer: DN </option>
                                            <option>===========================================================</option>
                                            <option>---- E-commerce ----</option>
                                            <option>200: EC-200-1</option>
                                            <option>20,000: EC-20k-1</option>
                                            <option>Unlimited: EC-U-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Email88 ----</option>
                                            <option selected="selected">Booster I: E88B1-10k-1</option>
                                            <option>Booster II: E88B2-15k-1</option>
                                            <option>Booster III: E88B3-20k-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Shared Hosting ----</option>
                                            <option>Small: SHSM-1</option>
                                            <option>Medium: SHME-1</option>
                                            <option>Large: SHBI-1</option>
                                            <option>===========================================================</option>
                                            <option>---- SSL Certificates ----</option>
                                            <option>Secure a Single Common Name: EV-DC1</option>
                                            <option>Secure Multiple Domains: UC-DC1</option>
                                            <option>SP-DC1: UC-DC1</option>
                                            <option>===========================================================</option>
                                            <option>---- VPS Hosting ----</option>
                                            <option>Linux Basic: VPS58-2-1</option>
                                            <option>Linux Gold: VPS78-3-1</option>
                                            <option>VPS28-1-1: VPS78-3-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Web88IR ----</option>
                                            <option>Dynamic I: IRH1-1</option>
                                            <option>Dynamic I: IRD2-1</option>
                                            <option>Dynamic II: IRD2-1</option>
                                            <option>===========================================================</option>
                                            <option>---- Responsive Web Design ----</option>
                                            <option selected="selected">Responsive Web Design</option>
                                            <option>===========================================================</option>
                                            <option>---- Social Media ----</option>
                                            <option>Social Media</option>
                                            <option>===========================================================</option>
                                            <option>List all services here</option>
                                          </select>
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">Please select a <b>"Service Plan"</b> &amp; <b>"Service Code"</b> to continue, eg. for VPS Hosting, <b>Service Plan = "Linux Basic"</b>, <b>Service Code = "VPS58-2-1"</b>.</div>
                                          note to programmer: some of the services does not have a service code, if service plan doesn't have a service code, please leave it blank after the plan name in the above dropdown list.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan/Package Name</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                        </div>

                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Unit Price (RM)</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00" value="1,188.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">The unit price is for all other packages execpt domain. For single/bulk domain prices, please specify the prices in below <b>"Domain Configuration"</b> section.</div>
                                          note to programmer: auto-fill in the price above after selected a plan. the price will be varied from the selection of the plan above.
                                        </div>

                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Name </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Sample 2">
                                          note to programmer: "discount name" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Global Discount Rate </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Promo Code </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. Test123">
                                          note to programmer: "promo code" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount Rate (Promo Code) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">SSL Price (RM) </label>
                                        <div class="col-md-6">
                                          <select class="form-control">
                                            <option>- Please select -</option>
                                            <option value="1 year">1 year(s) @ RM239.99/yr</option>
                                            <option value="2 years">2 year(s) @ RM 219.99/yr</option>
                                            <option value="3 years">3 year(s) @ RM 199.99/yr</option>

                                          </select>
                                          <div class="xs-margin"></div>
                                          note to programmer: the ssl price dropdown list is dynamic and fectched from the ssl services setup depending on the ssl plan selected above.
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Quantity <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="1" value="1">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Cycle <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="eg. 1 year(s)" value="1 Year(s)">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Setup Fee (RM) </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="0.00">
                                          <div class="xs-margin"></div>
                                          <div class="text-blue text-12px">If "Setup Fee" is set to <b>RM 0.00</b>, it is <b>"FREE Setup"</b>.</div>
                                        </div>
                                      </div>

                                      <!-- domain configuration start -->
                                      <h5 class="block-heading">Domain Configuration</h5>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Domain Name <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <div class="radio-list">
                                            <label><input type="radio" checked="checked"> Use existing domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net" value="webqom.limited">
                                            </label>
                                            <label><input type="radio"> Register a new domain, please enter your domain below:
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domain below (for single domain):
                                              <div class="xs-margin"></div>
                                              <input type="text" class="form-control" placeholder="eg. webqom.net">
                                            </label>
                                            <label><input type="radio"> Please specify your domains below (for bulk domains):
                                              <div class="xs-margin"></div>
                                              <textarea class="form-control" rows="10">Each name must be on a separate line.

Examples:
yourdomain.com
yourdomain.net
                                                                            </textarea>
                                            </label>
                                          </div>

                                        </div>
                                      </div>
                                      note to programmer: the domain price from 1 year to 10 years is dynamic and fectched from the domain pricing and maybe varied from different TLDs. Same as bulk domain pricing.

                                      <h6 class="block-heading">Single Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify single domain price in below table for <b>"New Domain Registration"</b>, <b>"Domain Renewal"</b> or <b>"Transfer in a Domain"</b>. If "Domain Price" is set to <b>RM 0.00</b>, it is <b>"FREE Domain"</b>. </div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="5"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->

                                      <h6 class="block-heading">Bulk Domain Pricing (RM)</h6>
                                      <div class="text-blue text-12px">You can specify bulk domain price in below table for <b>"Bulk Registration"</b>, <b>"Bulk Renewal"</b> or <b>"Bulk Transfer"</b>.</div>
                                      <div class="xs-margin"></div>
                                      <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                          <thead>
                                            <th>Domains</th>
                                            <th>1 Year(s)</th>
                                            <th>2 Year(s)</th>
                                            <th>3 Year(s)</th>
                                            <th>5 Year(s)</th>
                                            <th>10 Year(s)</th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>1-5</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>6-20</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>21-49</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>50-100</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>101-200</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                            <tr>
                                              <td>201-500</td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                              <td><input type="text" class="form-control" placeholder="0.00"></td>
                                            </tr>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="6"></td>
                                            </tr>
                                          </tfoot>
                                        </table>

                                      </div><!-- end table responsive -->
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Discount </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" placeholder="Amount">
                                          <div class="xs-margin"></div>
                                          <select name="select" class="form-control">
                                            <option value="%">%</option>
                                            <option value="RM">RM</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Domain Addons </label>
                                        <div class="col-md-6">
                                          <div class="checkbox-list margin-top-10px">
                                            <label><input type="checkbox" />&nbsp; DNS Management (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; Email Forwarding (@ RM 102.50/yr)</label>
                                            <label><input type="checkbox" />&nbsp; ID Protection (@ RM 102.50/yr)</label>
                                            note to programmer: domain addons list and price is fetched from the domain setup.
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end domain configuration -->

                                      <!-- custom email88 plan specs start -->
                                      <h5 class="block-heading">Email88 Plan Specifications</h5>
                                      <div class="text-blue text-12px">By default, the plan specification will be filled-in automatically after selecting a plan/service code in the above "Service Plan/Service Code" dropdown list. If it is a request for customization, please fill in the custom plan specification below.</div>
                                      <div class="xs-margin"></div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Custom Plan Specification</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control">
                                          <div class="xss-margin"></div>
                                          <a href="#" class="btn btn-sm btn-success">Add Another <i class="fa fa-plus"></i></a>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Notes </label>
                                        <div class="col-md-6">
                                          <textarea rows="3" class="form-control"></textarea>
                                        </div>
                                      </div>
                                      <!-- end custom email88 plan specs -->

                                      <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                    </form>
                                  </div><!-- end modal body -->
                                </div>
                              </div>
                            </div><!-- end modal edit email88 -->
                          </td>
                        </tr>
                        <tr>
                          <td class="thick-line" colspan="5"></td>
                          <td class="thick-line text-right">
                            <h6><b>Subtotal:</b></h6>
                          </td>
                          <td class="thick-line text-right" colspan="2">
                            <h6><b>RM 26,406.54</b></h6>
                          </td>
                          <td class="thick-line text-right"></td>
                        </tr>
                        <tr>
                          <td class="no-line" colspan="5"></td>
                          <td class="no-line text-right">
                            <h6 class="text-red"><b>Discount:</b></h6>
                          </td>
                          <td class="no-line text-right" colspan="2">
                            <h6 class="text-red"><b>- RM 1,211.40</b></h6>
                          </td>
                          <td class="no-line text-right"></td>
                        </tr>
                        <tr>
                          <td class="no-line" colspan="5"></td>
                          <td class="no-line text-right">
                            <h6><b>6% GST:</b></h6>
                          </td>
                          <td class="no-line text-right" colspan="2">
                            <h6><b>RM 0.00</b></h6>
                          </td>
                          <td class="no-line text-right"></td>
                        </tr>
                        <tr>
                          <td class="no-line" colspan="5"></td>
                          <td class="thick-line text-right">
                            <h5 class="text-red"><b>Total:</b></h5>
                          </td>
                          <td class="thick-line text-right" colspan="2">
                            <h5 class="text-red"><b>RM 25,195.14</b></h5>
                          </td>
                          <td class="thick-line text-right"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div><!-- end table responsive -->

                  <div class="clearfix"></div>





                </div><!-- end col-md-12 -->


              </div><!-- end row -->

              <div class="clearfix"></div>
            </div>
            <!-- end portlet-body -->

            <div class="form-actions">
              <div class="col-md-offset-5 col-md-7"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
            </div>


          </div>
          <!-- end portlet -->

        </div>
        <!-- end tab item details -->




      </div><!-- end tab content -->



    </div>
    <!-- end col-lg-12 -->

    <div class="col-lg-12">
      <div class="portlet portlet-blue">
        <div class="portlet-header">
          <div class="caption text-white">Transactions</div>
          <div class="tools"> <i class="fa fa-chevron-up"></i> </div>

        </div>
        <div class="portlet-body">
          <div class="table-responsive mtl">
            <table id="example1" class="table table-hover table-striped">
              <thead>
                <tr>
                  <th width="1%"><input type="checkbox" /></th>
                  <th>#</th>
                  <th><a href="#sort by transaction id">Transaction ID</a></th>
                  <th><a href="#sort by payment date">Payment Date</a></th>
                  <th><a href="#sort by payment method">Payment Method</a></th>
                  <th><a href="#sort by amount">Amount</a></th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="checkbox" /></td>
                  <td>1</td>
                  <td>{{ $data['order']->transaction_id }}</td>
                  <td>{{ date('jS M Y', strtotime($data['order']->payment_date))}}</td>
                  <td>
                    @if($data['order']->payment_method)
                    {{ $data['order']->payment_method->name }}
                    @else
                    {{ "Not Specified" }}
                    @endif
                  </td>
                  <td>RM {{ number_format($data['order']->total_amount, 2) }}</td>
                  <td><a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-transaction" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                    <!--Modal delete start-->
                    <div id="modal-delete-transaction" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                            <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this transaction? </h4>
                          </div>
                          <div class="modal-body">
                            <p>
                              <strong>Transaction ID:</strong> {{ $data['order']->transaction_id }} <br />
                              <strong>Payment Method:</strong>
                              @if($data['order']->payment_method)
                              {{ $data['order']->payment_method->name }}
                              @else
                              {{"Not Specified"}}
                              @endif
                            </p>
                            <div class="form-actions">
                              <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- modal delete end -->
                  </td>
                </tr>

              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4"></td>
                  <td class="text-left">
                    <h5 class="text-red"><b>Balance:</b></h5>
                  </td>
                  <td class="text-left">
                    <h5 class="text-red"><b>RM {{ number_format($data['order']->total_amount, 2) }}</b></h5>
                  </td>
                  <td></td>
                </tr>
              </tfoot>
            </table>

            <div class="clearfix"></div>
          </div><!-- end table responsive -->

        </div><!-- end portlet body -->
      </div><!-- end portlet -->


    </div><!-- end col-lg-12 -->



  </div><!-- end row -->
</div>
<!-- InstanceEndEditable -->
<!--END CONTENT-->

@section('custom_scripts')
<script src="{{url('').'/resources/assets/admin/'}}js/tableHTMLExport.js"></script>
{{-- <script src="/js/tableHTMLExport.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>
<script>
  $(document).ready(function() {
    $('#master').on('click', function(e) {
      console.log("$(this).is(':checked',true)");
      console.log($(this).is(':checked', true));
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });
    // $('.delete_selected_item_link').on('click', function () {
    //     checked_orders = $(".sub_chk:checked");
    //     if (checked_orders.length > 0) {
    //         var html = "";
    //         checked_orders.each(function() {
    //             reference_id = $(this).val();
    //             html += "<p>";
    //             html += "<strong>#" + $('.order-index-' + reference_id).text() + ":</strong> ";
    //             html += $('.order-txn-id-' + reference_id).text() + " - ";
    //             html += $('.order-client-name-' + reference_id).text();
    //         });
    //         $(".selected_client_list").html(html);
    //         $("#modal-delete-selected").modal('show');
    //     } else {
    //         $('#modal-delete-unselect').modal('show');
    //     }
    // });

    if ($('input[name="user-client-process"]:checked').val() === 'new-user') {
      $('.invoice-existing-client-field').prop('disabled', true);
      $('.invoice-new-user-field').prop('disabled', false);
    }

    $('.user-client-country').on('change', function(event) {
      var country_id = event.target.value;

      $('.user-client-state option:gt(0)').remove();

      if (country_id !== '_default') {
        $.ajax({
            url: '/get_state/' + country_id,
            type: 'GET'
          })
          .done(function(response) {
            var state_dropdown = $('.user-client-state');

            response.forEach(function(element) {
              var new_state = $('<option></option>').attr('value', element.id)
                .text(element.name);
              state_dropdown.append(new_state);
            });
          });
      }
    });

    $('.user-client-state').on('change', function(event) {
      var state_id = event.target.value;

      $('.user-client-city option:gt(0)').remove();

      if (state_id !== '_default') {
        $.ajax({
            url: '/get_city/' + state_id,
            type: 'GET'
          })
          .done(function(response) {
            var state_dropdown = $('.user-client-city');

            response.forEach(function(element) {
              var new_cities = $('<option></option>').attr('value', element.id)
                .text(element.name);
              state_dropdown.append(new_cities);
            });
          });
      }
    });

    $('.order-client-type').on('change', function(event) {
      var account_type = event.target.value;

      $('.user-client-target option:gt(0)').remove();

      $.ajax({
          url: '/admin/users?account_type=' + account_type,
          type: 'GET'
        })
        .done(function(response) {
          var users_dropdown = $('.user-client-target');

          var users_key = Object.keys(response);
          users_key.forEach(function(element) {
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
      } else {
        $('.invoice-existing-client-field').prop('disabled', true);
        $('.invoice-new-user-field').prop('disabled', false);
      }
    })

    $('.delete_selected').one('click', function(e) {

      var allVals = [];
      $(".sub_chk:checked").each(function() {
        allVals.push($(this).val());
      });

      if (allVals.length <= 0) {
        alert("Please select a row");
        //$.toaster({ priority :'danger', title : 'Post', message : 'Please select a row'});
      } else {
        $.ajax({
            url: base_url + '/admin/orders/deleteSelected',
            type: 'POST',

            data: {
              '_token': csrf_token,
              'ids': allVals
            }
          })
          .done(function() {
            location.reload();
          })
          .fail(function() {
            alert("some error");
          })
          .always(function() {
            console.log("complete");
          });
      }
    });


    $('.delete_selected_item_link').on('click', function(e) {
      console.log('clicked success');
      var allVals = [];
      $(".sub_chk:checked").each(function() {
        allVals.push($(this).val());
      });

      if (allVals.length <= 0) {
        $('#modal-delete-selectedd').modal('show');

        return false;
        //$.toaster({ priority :'danger', title : 'Post', message : 'Please select a row'});
      } else {
        var html = "";
        //"<p><strong>#1:</strong> Hock Lim - hock@webqom.com</p>";

        $(".sub_chk:checked").each(function() {
          html += "<p><strong>#" + $(this).closest('tr').children('td:eq(1)').text() + ":</strong> " + $(this).closest('tr').children('td:eq(2)').text() + " - " + $(this).closest('tr').children('td:eq(5)').text() + "</p>";
        });
        // console.log(html);
        $(".selected_client_list").html(html);
        $("#modal-delete-selected").modal('show');
      }


    });

    $('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });


    $(".delete_icon").click(function(e) {
      $("#single_item_id").val($(this).closest('tr').data('id'));
      $(".modal_delete_name").text($(this).closest('tr').children('td:eq(2)').text());
      $(".modal_delete_email").text($(this).closest('tr').children('td:eq(5)').text());
      $("#modal-delete-1").modal('show');
    });

    $(document).one('click', '.remove_single_item', function(event) {

      var order_id = $("#single_item_id").val();

      if (order_id == "" || order_id == undefined) {
        return false;
      }

      $.ajax({
          url: base_url + '/admin/orders/delete',
          type: 'POST',

          data: {
            '_token': csrf_token,
            'id': order_id
          }
        })
        .done(function() {
          location.reload();
        })
        .fail(function() {
          alert("some error");
        })
        .always(function() {
          console.log("complete");
        });
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

  function Print() {

  }

  function pdf_out() {
    $("#table_out").tableHTMLExport({

      type: 'pdf',
      orientation: 'p'

    });
  }
</script>
@endsection
@endsection