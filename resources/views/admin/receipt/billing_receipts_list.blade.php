<?php
$page = 'receipts_list';
$breadcrumbs = [
  array('url' => false, 'name' => 'Billing'),
  array('url' => url('admin/receipts_list'), 'name' => 'Receipts - Listing'),
];
?>

@extends('layouts.admin_layout')
@section('title','Admin | Receipts LIst')
@section('page_header','Billing')
@section('content')
<div class="page-content">
  <div class="row">
    <div class="col-lg-12">
      <h2>Receipts <i class="fa fa-angle-right"></i> Listing</h2>
      <div class="clearfix"></div>

      {{-- <div class="alert alert-success alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
        <i class="fa fa-check-circle"></i> <strong>Success!</strong>
        <p>The new invoice has been generated successfully. New invoice # is MY-7974191. View your new invoice <a href="billing_invoice_edit.html">here</a>.</p>
      </div>
      <div class="alert alert-success alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
        <i class="fa fa-check-circle"></i> <strong>Success!</strong>
        <p>The receipt has been sent/terminated/re-opened/deleted/archived successfully.</p>
      </div> --}}
      <div id="success"></div>
      @if(session('success'))
      <div class="alert alert-success alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
        <i class="fa fa-check-circle"></i> <strong>Success!</strong>
        <p>The information has been saved/updated successfully.</p>
      </div>
      @endif
      @if(session('error'))
      <div class="alert alert-danger alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
        <i class="fa fa-times-circle"></i> <strong>Error!</strong>
        <p>The information has not been saved/updated. Please correct the errors.</p>
      </div>
      @endif
      <div class="pull-left"> Last updated: <span class="text-blue">{{$recent_update}}</span>
        <div class="clearfix"></div>
        <p></p>
        <div class="clearfix"></div>
      </div>
      <!-- end col-lg-12 -->

      <div class="col-lg-12">
        <div class="portlet">
          <div class="portlet-header">
            <div class="caption">Invoices Ready for Generate Receipt</div> 
            <div class="tools"> <i class="fa fa-chevron-up"></i> </div>

          </div>
          <div class="portlet-body">

            <div class="table-responsive mtl">
              <table id="example1" class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th><a href="#sort by invoice">Invoice #</a></th>
                    <th><a href="#sort by client id">Client ID</a></th>
                    <th><a href="#sort by invoice date">Invoice Date</a></th>
                    <th><a href="#sort by due date">Due Date</a></th>
                    <th><a href="#sort by total">Total</a></th>
                    <th><a href="#sort by payment date">Payment Date</a></th>
                    <th><a href="#sort by transaction id">Transaction ID</a></th>
                    <th><a href="#sort by payment method">Payment Method</a></th>
                    <th><a href="#sort by status">Status</a></th>
                    <th>Action</th>
                    <th>Receipt</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i = ($paidReceipts->perPage() * ($paidReceipts->currentPage() - 1)) + 1; @endphp
                  @forelse ($paidReceipts as $paidreceipt)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>MY-{{ $paidreceipt->transaction_id }}</td>
                    <td><a href="{{url('/clients/edit').'/'.$paidreceipt->user_id}}">@if($paidreceipt->user_id != 0){{ $clients[$paidreceipt->user_id] }}@endif</a></td>
                    <td>{{ date('Y-m-d', strtotime($paidreceipt->created_at)) }}</td>
                    <td>{{ $paidreceipt->due_date }}</td>
                    <td>RM {{ $paidreceipt->total_amount }}</td>
                    <td>{{ $paidreceipt->payment_date }}</td>
                    <td>{{ $paidreceipt->payer_id }}</td>
                    <td>@if($paidreceipt->payment_method_id != 0){{ $payments[$paidreceipt->payment_method_id] }} @endif</td>
                    <td>
                      @if($paidreceipt->status == 'COMPLETED')
                      <span class="label label-xs label-success">
                        Paid
                      </span>
                      @elseif ($paidreceipt->status === 'INCOMPLETE')
                      <span class="label label-xs label-warning">
                        Unpaid
                      </span>
                      @else
                      <span class="label label-xs label-danger">
                        Payment Failed
                      </span>
                      @endif
                    </td>
                    <td>
                      <div class="btn-group-vertical mbm">

                        <div class="btn-group">
                          <button type="button" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle">Action
                            &nbsp;<i class="fa fa-angle-down"></i></button>
                          <ul role="menu" class="dropdown-menu" style="left: -100px">
                            <li class="text-11px"><a href="#" class="generatePdfBtn" data-id="{{ $paidreceipt->id }}">Generate New Receipt</a></li>
                          </ul>
                        </div>
                      </div>
                    </td>
                    <td>
                      <a href="{{ url('/admin/generate_pdf', $paidreceipt->id) }}" class="btn btn-xs btn-primary">New Receipt</a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="12"></td>
                  </tr>
                  @endforelse
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="12"></td>
                  </tr>
                </tfoot>
              </table>
              <div class="tool-footer text-right">
                <p class="pull-left">Showing page {{ $paidReceipts->currentPage() }} of {{ $paidReceipts->lastPage() }} total {{ $paidReceipts->total() }} entries</p>
                {{$paidReceipts->links()}}
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
        <!-- end portlet -->
      </div><!-- end col-lg-12 -->


      <div class="col-md-12">
        <div class="portlet portlet-blue">
          <div class="portlet-header">
            <div class="caption text-white">Search/Filter</div>
            <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
          </div>
          <div class="portlet-body">
            <form class="form-horizontal search_form" id="search_form" method="POST">
              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-md-4 control-label">Client ID </label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="client_id" id="client_id" value="{{ isset($keywords['client_id']) ? $keywords['client_id'] : "" }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Client Name </label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="client_name" id="client_name" value="{{ isset($keywords['client_name']) ? $keywords['client_name'] : "" }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Invoice Date </label>
                  <div class="col-md-8">
                    <div class="input-group">
                      <input value="{{ isset($keywords['start']) ? $keywords['start'] : "" }}" type="text" name="start" class="form-control" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" id="start" />
                      <!-- <input type="text" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="datepicker-default form-control" /> -->
                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Due Date </label>
                  <div class="col-md-8">
                    <div class="input-group">
                      <input value="{{ isset($keywords['end']) ? $keywords['end'] : "" }}" type="text" id="end" name="end" class="form-control" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" />
                      <!-- <input type="text" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="datepicker-default form-control" /> -->
                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Payment Date </label>
                  <div class="col-md-8">
                    <div class="input-group">
                      <input value="{{ isset($keywords['payment_date']) ? $keywords['payment_date'] : "" }}" type="text" id="payment_date" name="payment_date" class="form-control" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" />
                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
              </div><!-- end col-md 6 -->

              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-md-4 control-label">Invoice # </label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="id" id="id" value="{{ isset($keywords['id']) ? $keywords['id'] : "" }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Transaction ID </label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="transaction_id" id="transaction_id" value="{{ isset($keywords['transaction_id']) ? $keywords['transaction_id'] : "" }}">

                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Payment Method </label>
                  <div class="col-md-8">
                    <select name="payment_method" id="payment_method" class="form-control">
                      <option value="">- Please select -</option>
                      <option value="Bank-in" {{ (isset($keywords['payment_method']) && $keywords['payment_method']=='Bank-in') ? "selected" : "" }}>Bank-in</option>
                      <option value="Bank Transfer" {{ (isset($keywords['payment_method']) && $keywords['payment_method']=='Bank Transfer') ? "selected" : "" }}>Bank Transfer</option>
                      <option value="Cash" {{ (isset($keywords['payment_method']) && $keywords['payment_method']=='Cash') ? "selected" : "" }}>Cash</option>
                      <option value="Cheque" {{ (isset($keywords['payment_method']) && $keywords['payment_method']=='Cheque') ? "selected" : "" }}>Cheque</option>
                      <option value="Mastercard" {{ (isset($keywords['payment_method']) && $keywords['payment_method']=='Mastercard') ? "selected" : "" }}>Mastercard</option>
                      <option value="PayPal" {{ (isset($keywords['payment_method']) && $keywords['payment_method']=='PayPal') ? "selected" : "" }}>PayPal</option>
                      <option value="Visa" {{ (isset($keywords['payment_method']) && $keywords['payment_method']=='Visa') ? "selected" : "" }}>Visa</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Status </label>
                  <div class="col-md-8">
                    <select name="payment_status" id="payment_status" class="form-control">
                      <option value="">- Please select -</option>
                      <option value="paid" {{ (isset($keywords['payment_status']) && $keywords['payment_status']=='paid') ? "selected" : "" }}>Paid</option>
                      <option value="failed" {{ (isset($keywords['payment_status']) && $keywords['payment_status']=='failed') ? "selected" : "" }}>Payment Failed</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Total </label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="total_amount" id="total_amount" value="{{ isset($keywords['total_amount']) ? $keywords['total_amount'] : "" }}">

                  </div>
                </div>
              </div><!-- end col-md 6 -->


              <!-- end col-md 6 -->
              <div class="clearfix"></div>
              <!-- save button start -->
              <div class="form-actions text-center">
                <!-- <a href="#" class="btn btn-red"> -->
                <button class="btn btn-red" type="submit">
                  Search &nbsp;
                  <i class="fa fa-search"></i>
                </button>
                <!-- </a> -->
              </div>
              <!-- save button end -->
            </form>
          </div>
          <!-- end portlet-body -->
        </div>
        <!-- end portlet -->
      </div>
      <!-- end col-md-6 -->
      <div class="col-lg-12">
        <div class="portlet">
          <div class="portlet-header">
            <div class="caption">Receipts Listing</div>
            <p class="margin-top-10px"></p>
            <br />
            <div class="btn-group">
              <button type="button" class="btn btn-primary">Delete</button>
              <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
              <ul role="menu" class="dropdown-menu">
                <li><a href="#" class="selectedDelete">Delete selected item(s)</a></li>
                <li class="divider"></li>
                <li><a href="#" class="allDelete" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
              </ul>
            </div>
            <a href="#" class="btn btn-blue" id="receiptExportCsv">Export to CSV &nbsp;<i class="fa fa-share"></i></a>
            <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
            <!--Modal delete selected items start-->
            <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                  </div>
                  <div class="modal-body">
                    <p id="appendSelectedHtml"></p>
                    {{ Form::open([ 'url' => url('admin/receipts_selected_delete') ]) }}
                    {{ Form::hidden('target_receipt', '', [ 'id' => 'selectedArrayValue' ]) }}
                    <div class="form-actions">
                      <div class="col-md-offset-4 col-md-8">
                        <button href="#" class="btn btn-red remove_single_item">
                          Yes &nbsp;<i class="fa fa-check"></i>
                        </button>&nbsp;
                        <button href="#" data-dismiss="modal" class="btn btn-green delete-cancel-btn">
                          No &nbsp;<i class="fa fa-times-circle"></i>
                        </button>
                        {{ Form::submit('delete order', [ 'class' => 'delete_order_submit hidden' ]) }}
                      </div>
                    </div>
                    {{ Form::close() }}
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
                    <p id="appendAllDeleteHtml"></p>
                    {{ Form::open([ 'url' => url('admin/receipts_selected_delete') ]) }}
                    {{ Form::hidden('target_receipt', '', [ 'id' => 'allDeleteArrayValue' ]) }}
                    <div class="form-actions">
                      <div class="col-md-offset-4 col-md-8">
                        <button href="#" class="btn btn-red remove_single_item">
                          Yes &nbsp;<i class="fa fa-check"></i>
                        </button>&nbsp;
                        <button href="#" data-dismiss="modal" class="btn btn-green delete-cancel-btn">
                          No &nbsp;<i class="fa fa-times-circle"></i>
                        </button>
                        {{ Form::submit('delete order', [ 'class' => 'delete_order_submit hidden' ]) }}
                      </div>
                    </div>
                    {{ Form::close() }}
                  </div>
                </div>
              </div>
            </div>
            <!-- modal delete all items end -->
          </div>
          <div class="portlet-body">
            <div class="form-inline pull-left">
              <div class="form-group">
                <select id="orderPagination" name="select" class="form-control">
                  <option value="10" @if($items==10) selected="selected" @endif>10</option>
                  <option value="20" @if($items==20) selected="selected" @endif>20</option>
                  <option value="30" @if($items==30) selected="selected" @endif>30</option>
                  <option value="50" @if($items==50) selected="selected" @endif>50</option>
                </select>
                &nbsp;
                <label class="control-label">Records per page</label>
              </div>
            </div>
            <div class="clearfix"></div>
            <br />
            <br />
            <div class="table-responsive mtl">
              <table id="example2" class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th width="1%"><input id="receiptCheckSelectAll" type="checkbox" /></th>
                    <th>#</th>
                    <th><a href="#sort by receipt #">Receipt #</a></th>
                    <th><a href="#sort by client id">Client ID</a></th>
                    <th><a href="#sort by invoice value">Invoice Value</a></th>
                    <th><a href="#sort by old invoice #">Invoice #</a></th>
                    <th><a href="#sort by promotion pack">Promotion Pack</a></th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i = ($allOrders->perPage() * ($allOrders->currentPage() - 1)) + 1; @endphp
                  @forelse ($allOrders as $order)
                  <tr>
                    <td><input class="receiptCheck" type="checkbox" data-id="{{ $order->id }}" /></td>
                    <td>{{ $i++ }}</td>
                    <td class="receiptId-{{ $order->id }}">{{ $order->id }}</td>
                    <td><a href="{{url('/clients/edit').'/'.$order->user_id}}">@if($order->user_id != 0){{ $clients[$order->user_id] }} @endif</a></td>
                    <td>RM {{ $order->total_amount }}</td>
                    <td>MY-{{ $order->transaction_id }}</td>
                    <td></td>
                    <td>
                      <div class="btn-group-vertical mbm">
                        <div class="btn-group">
                          <button type="button" data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle">Action
                            &nbsp;<i class="fa fa-angle-down"></i></button>
                          <ul role="menu" class="dropdown-menu" style="left: -100px">
                            <li class="text-11px"><a href="{{ $order->invoice_name }}" target="_blank">View Receipt</a></li>
                            <li class="text-11px"><a href="#" class="receiptSendBtn" data-email="@if($order->user_id != 0){{$users[$order->user_id]}}@endif" data-userid="{{ $order->user_id }}" data-orderid="{{ $order->id }}">Send Receipt</a></li>
                            <li class="text-11px"><a href="#" data-id="{{ $order->id }}" class="orderDeleteBtn" data-target="#modal-delete" data-toggle="modal">Delete</a></li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="12"></td>
                  </tr>
                  @endforelse
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="12"></td>
                  </tr>
                </tfoot>
              </table>
              <div class="tool-footer text-right">
                <p class="pull-left">Showing page {{ $allOrders->currentPage() }} of {{ $allOrders->lastPage() }} total {{ $allOrders->total() }} entries</p>
                {{$allOrders->links()}}
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div><!-- end portlet -->

      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
  </div>

  <!--Modal generate new receipt start-->
  <div id="modal-generate-new-receipt" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Aree you sure you want to generate a new receipt? </h4>
        </div>
        <div class="modal-body">
          <div class="progress pdf_progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
              0%
            </div>
          </div>
          note to programmer: if the selection is "yes", it will show a progress bar that it is generating. Once the conversion is success, shows the "Success" notification and link it to that receipt.
          <div class="form-actions">
            <div class="col-md-offset-4 col-md-8"> <a href="#" id="btnYesForPdf" class="btn btn-red progressbtn">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal generate new receipt end -->

  <!--Modal terminate start-->
  <div id="modal-terminate" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to terminate? </h4>
        </div>
        <div class="modal-body">
          note to programmer: if the selection is "yes", it will show a progress bar that it is terminating. Once the termination is success, shows the "Success" notification.
          <div class="form-actions">
            <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal terminate end -->
  <!--Modal re-open start-->
  <div id="modal-reopen" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to re-open? </h4>
        </div>
        <div class="modal-body">
          note to programmer: if the selection is "yes", it will show a progress bar that it is re-opening. Once it is success, shows the "Success" notification.
          <div class="form-actions">
            <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal re-open end -->

  <!--Modal delete start-->
  <div id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this Receipt? </h4>
        </div>
        <div class="modal-body">
          <p>
            Receipt Id <span class="modal_receipt_id"></span>
          </p>
          {{ Form::open([ 'url' => url('admin/receipts_delete') ]) }}
          {{ Form::hidden('target_receipt', '', [ 'id' => 'single_receipt_id' ]) }}
          <div class="form-actions">
            <div class="col-md-offset-4 col-md-8">
              <button href="#" class="btn btn-red remove_single_item">
                Yes &nbsp;<i class="fa fa-check"></i>
              </button>&nbsp;
              <button href="#" data-dismiss="modal" class="btn btn-green delete-cancel-btn">
                No &nbsp;<i class="fa fa-times-circle"></i>
              </button>
              {{ Form::submit('delete order', [ 'class' => 'delete_order_submit hidden' ]) }}
            </div>
          </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>

  <!--END MODAL delete-->
  <!--Modal archive start-->
  <div id="receiveSuccessPdfModal" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Receipt Generated Successfully. </h4>
        </div>
        <div class="modal-body">
          <div id="receiveSuccessPdf"></div>
          <div class="form-actions">
            <div class="col-md-offset-4 col-md-8"> <a href="#" id="closePdfGenerateModal" data-dismiss="modal" class="btn btn-green">ok &nbsp;<i class="fa fa-times-circle"></i></a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal archive end -->
  <div id="modal-delete-selected-error" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger alert-dismissable">
            <p>Please select at least one item for delete.</p>
          </div>
          <div class="form-actions">
            <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="modal-add-email" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-wide-width">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
          <h4 id="modal-login-label2" class="modal-title">Add New Email</h4>
        </div>
        <div class="modal-body">
          <div class="form">
            <form class="form-horizontal" id="send_email_form">
              {{csrf_field()}}
              <div class="form-group">
                <label class="col-md-3 control-label">Status</label>
                <div class="col-md-6">
                  <div data-on="success" data-off="primary" class="make-switch">
                    <input type="checkbox" checked="checked" />
                  </div>
                </div>
              </div>
              <input id="receiptUserId" type="hidden" name="user_id" value="">
              <input id="receiptOrderId" type="hidden" name="order_id" value="">
              <div class="form-group">
                <label class="col-md-3 control-label">Default Email <span class="text-red">*</span></label>
                <div class="col-md-6">
                  <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input id="receiptEmail" type="text" placeholder="Email Address" class="form-control" name="email" value="" />
                  </div>
                  note to programmer: default email will be auto displayed here.
                </div>
              </div>
              {{--<div class="form-group">
                 <label class="col-md-3 control-label">Email 2</label>
                 <div class="col-md-6">
                   <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                     <input type="text" placeholder="Email Address" class="form-control" name="emailcc[]" />
                   </div>
                 </div>
               </div>
               <div class="form-group">
                 <label class="col-md-3 control-label">Email 3</label>
                 <div class="col-md-6">
                   <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                     <input type="text" placeholder="Email Address" class="form-control" name="emailcc[]" />
                   </div>
                 </div>
               </div>
                <div class="form-group">
                 <label class="col-md-3 control-label">Email 4</label>
                 <div class="col-md-6">
                   <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                     <input type="text" placeholder="Email Address" class="form-control" name="emailcc[]" />
                   </div>
                 </div>
               </div>
               <div class="form-group">
                 <label class="col-md-3 control-label">Email 5 </label>
                 <div class="col-md-6">
                   <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                     <input type="text" placeholder="Email Address" class="form-control" name="emailcc[]" />
                   </div>
                 </div>
               </div>
               <div class="form-group">
                 <label class="col-md-3 control-label">Email 6</label>
                 <div class="col-md-6">
                   <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                     <input type="text" placeholder="Email Address" class="form-control" name="emailcc[]" />
                   </div>
                 </div>
               </div>
               <div class="form-group">
                 <label class="col-md-3 control-label">Email 7</label>
                 <div class="col-md-6">
                   <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                     <input type="text" placeholder="Email Address" class="form-control" name="emailcc[]" />
                   </div>
                 </div>
               </div>
               <div class="form-group">
                 <label class="col-md-3 control-label">Email 8</label>
                 <div class="col-md-6">
                   <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                     <input type="text" placeholder="Email Address" class="form-control" name="emailcc[]" />
                   </div>
                 </div>
               </div>
               <div class="form-group">
                 <label class="col-md-3 control-label">Email 9</label>
                 <div class="col-md-6">
                   <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                     <input type="text" placeholder="Email Address" class="form-control" name="emailcc[]" />
                   </div>
                 </div>
               </div>
               <div class="form-group">
                 <label class="col-md-3 control-label">Email 10</label>
                 <div class="col-md-6">
                   <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                     <input type="text" placeholder="Email Address" class="form-control" name="emailcc[]" />
                   </div>
                 </div>
               </div> --}}
              <div class="progress email_progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                  0%
                </div>
              </div>
              <div class="form-actions">
                <div class="col-md-offset-5 col-md-8">
                  <a href="#" id="send_email" class="btn btn-red" type="submit">Send &nbsp;<i class="fa fa-send-o"></i></a>&nbsp;
                  <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection

  @section('custom_scripts')
  <script>
    document.getElementById('orderPagination').onchange = function() {
      window.location = "{{ $allOrders->url(1) }}&items=" + this.value;
    };

    $('.orderDeleteBtn').on('click', function(event) {
      var target_id = $(this).data('id');
      $("#single_receipt_id").val(target_id);
      $(".modal_receipt_id").text($('.receiptId-' + target_id).text());
      $(".modal_invoice_id").text($('.invoiceId-' + target_id).text());
      $("#modal-delete-1").modal('show');
    });

    $('.selectedDelete').on('click', function(event) {
      let receipts = [];
      $(".receiptCheck:checked").each(function() {
        receipts.push($(this).data('id'));
      });
      if (receipts.length <= 0) {
        $("#modal-delete-selected-error").modal('show');
      } else {
        $("#appendSelectedHtml").empty();
        let htmls = new Array();
        $.each(receipts, function(index, options) {
          htmls.push('<strong> Receipt #: </strong>' + options + '<br />')
        })
        $("#selectedArrayValue").val(receipts);
        $("#appendSelectedHtml").append(htmls);
        $("#modal-delete-selected").modal('show');
      }
    });

    $('.allDelete').on('click', function(event) {
      let receipts = [];
      $(".receiptCheck").each(function() {
        receipts.push($(this).data('id'));
      });

      $("#appendAllDeleteHtml").empty();
      let htmls = new Array();
      $.each(receipts, function(index, options) {
        htmls.push('<strong> Receipt #: </strong>' + options + '<br />')
      })

      $("#allDeleteArrayValue").val(receipts);
      $("#appendAllDeleteHtml").append(htmls);
    });

    $(document).on('click', '#receiptCheckSelectAll', function() {
      let baseChecked = $('#receiptCheckSelectAll').is(':checked');
      if (baseChecked) {
        $('input:checkbox.receiptCheck').prop("checked", true);
      } else {
        $('input:checkbox.receiptCheck').prop("checked", false);
      }
    });

    $(document).on('click', '.receiptCheck', function() {
      let numberOfChecked = $('.receiptCheck:checked').length;
      if (numberOfChecked => 1) {
        $('#receiptCheckSelectAll').prop('checked', true);
      }
      if (numberOfChecked == 0) {
        $('#receiptCheckSelectAll').prop('checked', false);
      }
    });

    $(document).on('click', '#receiptExportCsv', function() {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: base_url + "/admin/receipts_csv_export",
        method: "POST",
        success: function(data) {
          JSONToCSVConvertor(null, data, 'Receipt_Export', true)
        }
      });

      function JSONToCSVConvertor(info, JSONData, ReportTitle, ShowLabel) {
        var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
        var CSV = '';
        CSV += ReportTitle + ' \r\n';
        if (ShowLabel) {
          var row = "";
          for (var index in arrData[0]) {
            row += index + ',';
          }
          row = row.slice(0, -1);
          CSV += row.toUpperCase() + '\r\n';
        }
        for (var i = 0; i < arrData.length; i++) {
          var row = "";
          for (var index in arrData[i]) {
            if (index == 'receipt') {
              row += '"' + arrData[i][index] + '",';
            } else if (index == 'client_id') {
              row += '"' + arrData[i][index] + '",';
            } else if (index == 'invoice_value') {
              row += '"' + arrData[i][index] + '",';
            } else if (index == 'invoice') {
              row += '"' + arrData[i][index] + '",';
            }
          }
          row.slice(0, row.length - 1);
          CSV += row + '\r\n';
        }
        if (CSV == '') {
          alert("Invalid data");
          return;
        }
        var fileName = "";
        fileName += ReportTitle.replace(/ /g, "_");
        var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
        var link = document.createElement("a");
        link.href = uri;
        link.style = "visibility:hidden";
        link.download = fileName + ".csv";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      }
    })

    $(document).on('click', '.generatePdfBtn', function() {
      let receipt_id = $(this).data('id');
      $('#btnYesForPdf').attr('data-id', receipt_id);
      $("#modal-generate-new-receipt").modal('show');
    });

    $('.progressbtn').on('click', function(e) {
      var id = $(this).data('id');
      console.log(id);
      console.log("{{ url('/admin/receipt_generate') }}");
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: "{{ url('/admin/receipt_generate') }}",
        data: {
          id: id
        },
        dataType: 'json',
        beforeSend: function() {
          $('#success').empty();

        },
        uploadProgress: function(event, position, total, percentComplete) {

          $('.pdf_progress .progress-bar').text('Converting');
          $('.pdf_progress .progress-bar').css('width', percentComplete + '%');
        },
        success: function(data) {

          $('.pdf_progress .progress-bar').text('Converted');
          $('.pdf_progress .progress-bar').css('width', '100%');
          html = '<div class="alert alert-success alert-dismissable">' +
            '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>' +
            '<i class="fa fa-check-circle"></i> <strong>Success!</strong>' +
            '<p>Successful</p></div>';
          $('#receiveSuccessPdf').html(html);
          setTimeout(function() {
            window.open(data.pdf_route, '_blank');
            $('#modal-generate-new-receipt').modal('hide');
          }, 1000);
          $('#receiveSuccessPdfModal').modal({
            backdrop: 'static',
            keyboard: false
          })
          $('#receiveSuccessPdfModal').modal('show');
          // $('#modal-generate-receipt').modal('hide');

          // window.location.replace(response.pdf_route);
        }

      })
    });

    $(document).on('click', '#closePdfGenerateModal', function() {
      $('#receiveSuccessPdfModal').modal('hide');
      location.reload();
    });

    $(document).on('click', '.receiptSendBtn', function() {
      let user_id = $(this).data('userid');
      let order_id = $(this).data('orderid');
      let target_email = $(this).data('email');
      console.log(user_id, target_email, order_id);
      $("#receiptUserId").val(user_id);
      $("#receiptOrderId").val(order_id);
      $("input[name='email']").val(target_email);
      $('#modal-add-email').modal('show');
    });

    $('#send_email').on('click', function(e) {
      e.preventDefault();
      var fd = $('#send_email_form').serialize();
      var progressTrigger;
      var progressElem = $('.email_progress .progress-bar');
      // var resultsElem = $('span#results');
      var recordCount = 0;
      $.ajax({
        url: "{{url('admin/receipts_pdf_send') }}",
        type: 'POST',
        data: fd,
        dataType: 'json',

        // beforeSend: function(thisXHR){
        //  $('#success').empty();
        //  // progressElem.html(" Waiting for response from server ...");
        //  $('.progress-bar').text('Converting');
        //  console.log(thisXHR);
        //  progressTrigger = setInterval(function () {
        //      if (thisXHR.readyState > 2) {
        //          var totalBytes = thisXHR.getResponseHeader('Content-length');
        //          var dlBytes = thisXHR.responseText.length;
        //          if(totalBytes > 0){
        //           progressElem.text('Sending');
        //           progressElem.css('width', Math.round((dlBytes / totalBytes) * 100) + '%');
        //          }else{
        //           progressElem.text('Sending');
        //           progressElem.css('width', Math.round(dlBytes / 1024) + 'K');

        //          }
        //      }
        //  }, 200);
        // },
        success: function(res) {

          // $('.progress-bar').css('width', 0 + '%');
          if (res.success === 1) {
            progressElem.text('Success');
            progressElem.css('width', '100%');
            html = '<div class="alert alert-success alert-dismissable">' +
              '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>' +
              '<i class="fa fa-check-circle"></i> <strong>' + res.message + '!</strong>' +
              '<p>Successful</p></div>';
            $('#success').html(html);
            $('#error_msg').html('');
            setTimeout(function() {

              progressElem.text('');
              progressElem.css('width', '0%');
              $('#modal-add-email').modal('hide');
            }, 500);
          } else {
            progressElem.text('Error');
            progressElem.css('width', '0%');
            html = '<div class="alert alert-success alert-dismissable">' +
              '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>' +
              '<i class="fa fa-check-circle"></i> <strong>' + res.message + '!</strong>' +
              '<p>Successful</p></div>';
            $('#success').html(html);
            $('#error_msg').html(html);
          }

        },
        xhr: function() {
          var xhr = $.ajaxSettings.xhr();
          xhr.upload.addEventListener('progress', function(evt) {
            if (evt.lengthComputable) {
              var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
              progressElem.text('Emails being sent');
              progressElem.css('width', percentComplete + '%');
              // progressBar.val(percentComplete).text('Loaded' + percentComplete + '%');
            }
          }, false);
          return xhr;
        }
      })
    });
  </script>
  @endsection