<?php if ($orders['orders'] instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
<?php $per_page=$orders['orders']->perPage(); ?>
<?php else: ?>
<?php $per_page=10; ?>
<?php endif ?>
<?php //dd($orders['orders']);?>
<?php $page='billing_invoice_list';
$breadcrumbs=[
             // array('url'=>url('orders/listing'),'name'=>'Orders'),
              array('url'=>url('billing_invoice_list'),'name'=>'Invoice - Listing'),

];
?>
@extends('layouts.admin_layout')
@section('title','Admin | Billing Invoice List')
@section('content')
@section('page_header','Invoice')
        <!--END SIDEBAR MENU--><!--BEGIN PAGE WRAPPER-->

        <div class="page-header-breadcrumb">
        </div>
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>View All Invoice <i class="fa fa-angle-right"></i> Listing</h2>
              <div id="alert_message" > </div>
              <div class="clearfix"></div>
              @if($include_notification === True && !empty($orders['countOrders']))
                <div class="alert alert-success alert-dismissable">
                  <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                  <p>Search completed: {{ $orders['orders']->total() }} result(s)</p>
                </div>
              @endif

              @if($include_notification === True && empty($orders['countOrders']))
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                  <p>No such data exists</p>
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
              @if (session('delete_status') && session('delete_status') === True)
                <div class="alert alert-success delete-success">
                  <button type="button" class="close alert-hide-btn" aria-hidden="true" class="close">&times;</button>
                  <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                  <p>Invoice(s) has been deleted successfully.</p>
                </div>
              @endif
              @if (session('delete_status') && session('delete_status') === False)
                <div class="alert alert-danger delete-error">
                  <button type="button" class="close alert-hide-btn" aria-hidden="true" class="close">&times;</button>
                  <i class="fa fa-check-circle"></i> <strong>Error!</strong>
                  <p>Failed to delete Invoice(s). Please try again.</p>
                </div>
              @endif
              <div class="pull-left">
                Last updated:
                @if ($orders['lastUpdated'] !== False)
                  <span class="text-blue">{{ date('d M, Y @ g:i A', strtotime($orders['lastUpdated'])) }}</span>
                @else
                  <span class="text-blue">No available update history yet.</span>
                @endif
              </div>
              <div class="clearfix"></div>
              <p></p>
              <div class="clearfix"></div>
            </div>
            <!-- end col-lg-12 -->
            <div class="col-md-12">
              <div class="portlet portlet-blue">
                <div class="portlet-header">
                  <div class="caption text-white">Search Invoice</div>
                </div>
                <div class="portlet-body">
                  <form class="form-horizontal search_form" id="search_form" method="POST">
                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-md-4 control-label"><a href="" >Client ID</a> </label>
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
                            <input value="{{ isset($keywords['start']) ? $keywords['start'] : "" }}" type="text" name="start" class="form-control" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" id="start"/>
                            <!-- <input type="text" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="datepicker-default form-control" /> -->
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label">Due Date </label>
                        <div class="col-md-8">
                          <div class="input-group">
                            <input value="{{ isset($keywords['end']) ? $keywords['end'] : "" }}" type="text" id="end" name="end" class="form-control" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy"/>
                            <!-- <input type="text" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="datepicker-default form-control" /> -->
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label">Payment Date </label>
                        <div class="col-md-8">
                          <div class="input-group">
                           <input value="{{ isset($keywords['payment_date']) ? $keywords['payment_date'] : "" }}" type="text" id="payment_date" name="payment_date" class="form-control" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy"/>
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
            <!-- end col-md-12 -->

            <div id="modal-delete-1" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this order? </h4>
                  </div>
                  <div class="modal-body">
                    <!-- <p><strong>#1:</strong> MY-7974188 / Hock Lim</p> -->
                    <p>
                      <strong>#1:</strong>
                      <span class="modal_delete_name">Hock Lim</span> / <span class="modal_delete_email">hock@webqom.com</span>
                    </p>
                      {{ Form::open([ 'url' => url('admin/invoice/delete') ]) }}
                        {{ Form::hidden('target_order', '', [ 'id' => 'single_item_id' ]) }}
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

            <div class="col-lg-12" id="scrollDiv">
              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Invoice Listing</div>
                  <p class="margin-top-10px"></p>
                  <br>
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary">Delete</button>
                    <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                    <ul role="menu" class="dropdown-menu">
                      <li><a href="javascript:void(0);" class="delete_selected_item_link">Delete selected item(s)</a></li>
                      <li class="divider"></li>
                      <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                    </ul>
                  </div>&nbsp;
                  <a href="javascript:void(0)" class="btn btn-blue">Export to CSV &nbsp;<i class="fa fa-share"></i></a>&nbsp;
                  <!-- <a href="#sort by customer id" class="btn btn-green sortParam">
                    By Country &nbsp;<i class="fa fa-sort-alpha-desc"></i>
                  </a>&nbsp; -->
                  <div class="tools">
                    <i class="fa fa-chevron-up"></i>
                  </div>

                  <!--Modal delete selected items start-->
                  <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                        </div>
                        <div class="modal-body">
                        <div class="selected_client_list"></div>

                          <!-- <p><strong>#1:</strong> tbm-kl-0000000001 / Hock Lim</p> -->
                          <div class="form-actions">
                            <div class="col-md-offset-4 col-md-8">
                              <a href="javascript:void(0);" class="btn btn-red delete_selected">
                                Yes &nbsp;<i class="fa fa-check"></i>
                              </a>&nbsp;
                              <a href="#" data-dismiss="modal" class="btn btn-green">
                                No &nbsp;<i class="fa fa-times-circle"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal delete selected items end -->

                   <!--Modal no selected items start-->
                   <div id="modal-delete-unselect" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete selected items? </h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-actions">
                           <div class="alert alert-danger" >
                              Please select at least  one Invoice for delete
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
                  <!-- modal no selected items end -->


                  <!--Modal delete all items start-->
                  <div id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-actions">
                            {{ Form::open([ 'url' => url('admin/orders/deleteAll') ]) }}
                              <div class="col-md-offset-4 col-md-8">
                                <a href="#" class="btn btn-red delete-all-btn">
                                  Yes &nbsp;<i class="fa fa-check"></i>
                                </a>&nbsp;
                                <a href="#" data-dismiss="modal" class="btn btn-green">
                                  No &nbsp;<i class="fa fa-times-circle"></i>
                                </a>
                                {{ Form::submit('delete all', ['class' => 'delete-all-submit hidden']) }}
                              </div>
                            {{ Form::close() }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal delete all items end -->
                </div>
                <div class="portlet-body">
                  <div class="form-inline pull-left">
                    <div class="form-group">
                      <!-- <select name="select" class="form-control">
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                        <option>50</option>
                        <option selected="selected">100</option>
                      </select> -->
                      <select class="form-control" id="per_page_select" onchange="per_page_change()">
                        <option value="10" @if($per_page==10) selected="" @endif>Show 10</option>
                        <option value="20" @if($per_page==20) selected="" @endif>Show 20</option>
                        <option value="50" @if($per_page==50) selected="" @endif>Show 50</option>
                        <option value="100" @if($per_page==100) selected="" @endif>Show 100</option>
                      </select>
                      &nbsp;
                      <label class="control-label">Records per page</label>
                    </div>
                  </div>
                  <div class="clearfix"></div>

                  <div class="table-responsive mtl" id="scrollToTable">
                    {!! Form::open(['url' => url('admin/orders/deleteSelected')]) !!}
                      <table id="example1" class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th width="1%"><input id="master" type="checkbox"/></th>
                            <th>#</th>
                            <th><a href="#sort by invoice #">Invoice #</a></th>
                            <th><a href="#sort by customer id">Client ID</a></th>
                            <th><a href="#sort by customer name">Client Name</a></th>
                            <th><a href="#sort by login/email">Invoice Date</a></th>                          
                            <th><a href="#sort by customer id">Payment Date</a></th>  
                            <th><a href="#sort by payment method">Payment Method</a></th>
                            <th><a href="#sort by Total">Total</a></th>

                            <th><a href="#sort by status">Status</a></th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody class="dynamic-body">
                          @if(!empty($orders['orders']))
                                 <?php if ($orders['orders'] instanceof \Illuminate\Pagination\LengthAwarePaginator){ ?>
                                    <?php $count=$orders['orders']->firstItem(); ?>
                                  <?php }else{ ?>
                                    <?php $count=1;?>
                                  <?php } ?>
                            @foreach($orders['orders'] as $order_key => $new)
                            @php //dd($new); @endphp
                            <tr data-id="{{$new->id}}" id="clienttbl_row_{{$new->id}}">
                              <!-- <td><input class="sub_chk" name="id[]" value="{{$new->id}}" type="checkbox"/></td> -->
                              <td>
                                {{ Form::checkbox('orders_checkbox[]', $new->id, false, ['class' => 'sub_chk']) }}
                              </td>
                              <td class="order-index-{{ $new->id }}">
                                {{$count}}
                              </td>
                              <td><a class="order-txn-id-{{ $new->id }}" href="{{url('admin/billing_invoice_edit').'/'.$new->id}}">MY-{{$new->transaction_id}}</a></td>
                              <td>
                                <a href="{{url('/clients/edit').'/'.$new->user_id}}">
                                  {{ $new->user->user_client_id }}  
                                </a>
                              </td>
                              <td>
                                @if ($new->user->full_name)
                                  <a class="order-client-name-{{ $new->id }}" href="{{url('/clients/edit').'/'.$new->user_id}}">
                                    {{ $new->user->full_name }}
                                  </a>
                                @else
                                  <span><em>No name provided</em></span>
                                @endif
                              </td>
                              <td>{{$new->created_at}}</td>
                              <td>{{ $new->payment_date }}</td>
                              <td>
                                @if ($new->payment_method)
                                  {{ $new->payment_method->name }}
                                @else
                                  <em>Not specified</em>
                                @endif
                              </td>
                              <td>
                                RM {{ number_format($new->total_amount, 2)}}
                              </td>
                              <td>
                                @if($new->status == 'COMPLETED')
                                  <span class="label label-xs label-success">
                                    Paid
                                  </span>
                                @elseif ($new->status === 'INCOMPLETE')
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
                                <a href="{{url('admin/billing_invoice_edit').'/'.$new->id}}" data-hover="tooltip" data-placement="top" title="Edit">
                                  <span class="label label-sm label-success">
                                    <i class="fa fa-pencil"></i>
                                  </span>
                                </a>
                                <a href="#" data-hover="tooltip" data-placement="top" class="single-delete-btn" title="Delete" data-id="{{ $new->id }}" data-toggle="modal">
                                  <span class="label label-sm label-red delete_icon">
                                    <i class="fa fa-trash-o"></i>
                                  </span>
                                </a>
                                <!-- modal delete end -->
                              </td>
                            </tr>
                            <?php $count++; ?>
                                @endforeach
                            @endif
                        <!--  <tr>
                            <td><input type="checkbox"/></td>
                            <td>1</td>
                            <td><a href="billing_invoice_edit.html">MY-8001182</a></td>
                            <td>-</td>
                            <td>16th Apr 2015</td>
                            <td><a href="client_edit.html">Danny Chan</a></td>
                            <td><a href="client_edit.html">I-000001-MY</a></td>
                            <td>RM 25,195.14</td>
                            <td>PayPal</td>
                            <td><span class="label label-xs label-danger">Payment Failed</span></td>
                            <td><a href="billing_invoice_edit.html" data-hover="tooltip" data-placement="top" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-1" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a></td>
                          </tr> -->
                          {{ Form::submit('Submit', [ 'class' => 'delete-submit hidden' ]) }}
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="11"></td>
                          </tr>
                        </tfoot>
                      </table>
                    {!! Form::close() !!}
                    <?php $showFrom = empty($orders['countOrders']) ? 0 : ($orders['orders']->currentpage()-1)*$orders['orders']->perpage()+1 ?>
                    <?php if ($orders['orders'] instanceof \Illuminate\Pagination\LengthAwarePaginator){ ?>
                    <span> Showing <span class="showFrom">{{$showFrom}}</span> to <span class="showTo">{{(($orders['orders']->currentpage()-1)*$orders['orders']->perpage())+$orders['orders']->count()}} </span> of {{$orders['orders']->total()}} items</span>
                      <span class="pull-right pagination-links">{{ $orders['orders']->links() }}</span>
                    <?php }else{ ?>
                      <span>Total records: {{count($orders['orders'])}}</span>
                    <?php } ?>

                   <!--  <div class="tool-footer text-right">
                      <p class="pull-left">Showing 1 to 10 of 57 entries</p>
                      <ul class="pagination pagination mtm mbm">
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#">&raquo;</a></li>
</ul>
                    </div> -->
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <!-- end porlet -->
            </div>
            <!-- end col-lg-12 -->
          </div>
          <!-- end row -->
        </div>
        <!-- InstanceEndEditable -->
        <!--END CONTENT-->
@section('custom_scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<script>
  page_url=base_url+'/admin/orders_list/';
function per_page_change() {
per_page=$("#per_page_select").find(":selected").val();

// window.location.href=page_url+per_page;
  var current_page = ($(".pagination li.active").text()!="")?$(".pagination li.active").text():1;

  getOrderList(1);
}

  $(document).ready(function() {
    $(document).on('click', '.pagination a', function(event){
    $('.loader').css('display','flex');
    event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      $('#hidden_page').val(page);
      $('li').removeClass('active');
      $(this).parent().addClass('active');
      getOrderList(page);
  });
      var sortCntry = $('#sortcountry').val();
      if (sortCntry == 'country') {
          $('#example1').DataTable({
            "bPaginate": false,
            "bInfo" : false,
            "bFilter": false,
            "columnDefs": [
                {
                    "targets": [ 7 ],
                    "visible": false
                }
            ],
            "ordering": true,
            "order": [[7, "desc"]]
          });
      } else {
        $('#example1').DataTable({
              "bPaginate": false,
              "bInfo" : false,
              "bFilter": false,
              "columnDefs": [
                  {
                      "targets": [ 7 ],
                      "visible": false
                  }
              ]
        });
      }
      $('#example1').removeClass('dataTable');
  });
  $(document).ready(function() {
    $('.delete_selected_item_link').on('click', function () {
        console.log('sub check selected or not');
      checked_orders = $(".sub_chk:checked");
      console.log('checked_orders');
      console.log(checked_orders);
      if (checked_orders.length > 0) {
        var html = "";

        checked_orders.each(function() {
          reference_id = $(this).val();

          html += "<p>";
          html += "<strong>#" + $('.order-index-' + reference_id).text() + ":</strong> ";
          html += $('.order-txn-id-' + reference_id).text() + " - ";
          html += $('.order-client-name-' + reference_id).text();
        });

        $(".selected_client_list").html(html);
        $("#modal-delete-selected").modal('show');
      } else {
        $('#modal-delete-unselect').modal('show');
      }
    });

    $('.delete-all-btn').on('click', function (event) {
      event.preventDefault();
      $('.delete-all-submit').click();
    })

    $('#master').on('click', function(e) {
        console.log('selected data all');
       if($(this).is(':checked',true))
       {
          $(".sub_chk").prop('checked', true);
       } else {
          $(".sub_chk").prop('checked',false);
       }
      });

    $('.single-delete-btn').on('click', function (event) {
      var target_id = $(this).data('id');

      $("#single_item_id").val(target_id);
      $(".modal_delete_name").text($('.order-txn-id-' + target_id).text());
      $(".modal_delete_email").text($('.order-client-name-' + target_id).text());
      $("#modal-delete-1").modal('show');
    });

    $('.alert-hide-btn').on('click', function (event) {
      $(this).parent().addClass('hidden');
    });

    $('.remove_single_item').on('click', function(event) {
        $('.delete_order_submit').click();
    });

    $('.delete_selected').on('click', function () {
      $('.delete-submit').click();
    });

    $('.search_form').submit(function() {
      // if($('input[name="transaction_id"]').val() == "" && $('input[name="client_name"]').val() == ""){
      //     $('#alert_message').empty();
      //     $('#alert_message').append('<div class="alert alert-danger"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button><i class="fa fa-times-circle"></i> <strong>Error!</strong><p> Eithier "Invoice #" or "Client Name" filed is mandatory</p></div>');
      //     return false;
      //   }




        // if($('input[name="transaction_id"]').val() == "" || $('input[name="id"]').val() == "" || $('input[name="client_name"]').val() == "" || $('input[name="client_id"]').val() == ""){
        //   $('#alert_message').empty();
        //  $('#alert_message').append('<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Indicates a successful or positive action.</div>');

        //   return false;
        // }

    });
     /* $(document).on('click', '.empty_cart', function(event) {
      });*/

      $('.sortParam').click(function() {
          window.localStorage.setItem('sortParamName' , '1');
      });

      $(window).on('load', function() {
          var sortParamValue = window.localStorage.getItem('sortParamName');
          if(sortParamValue != null) {
            window.localStorage.removeItem('sortParamName');
            $('html, body').animate({
                scrollTop: $("#scrollDiv").offset().top
            }, 1500);
          } else {
            window.localStorage.removeItem('sortParamName');
          }
      });
  });
  function getOrderList(page)
  {
    var transaction_id=$("#transaction_id").val();
    var payment_status= $("#payment_status").val();
    var payment_method= $("#payment_method").val();
    var client_id= $("#client_id").val();
    var end= $("#end").val();
    var id= $("#id").val();
    var start= $("#start").val();
    var total_amount= $("#total_amount").val();
    var client_name= $("#client_name").val();
    var per_page_items = ($("#per_page_select").val())?$("#per_page_select").val():10;
    $.ajax({
    headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: base_url+"/admin/get-order-data-ajax/?page="+page,
      method:"GET",
      dataType:'json',
      data:{per_page:per_page_items, transaction_id:transaction_id,payment_status:payment_status,payment_method:payment_method,client_id:client_id,id:id,end:end,start:start,total_amount:total_amount,client_name:client_name},
      success:function(data){
          $('.loader').css('display','none');
        if(data.isSucceeded){
          
          $('.dynamic-bodyt').html('');
          $('.dynamic-body').html(data.data);
          $(".showFrom").html(data.record_from);
          $(".showTo").html(data.record_to);
          $('.pagination-links').html(data.links);
        }else{
          $('.dynamic-body').html(data.data);
        }
      }
  });

  }
</script>
@endsection
@endsection
