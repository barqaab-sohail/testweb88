
<?php $page = 'clients';
$breadcrumbs = [
  array('url' => url('clients/listing'), 'name' => 'Clients'),
  array('url' => url('clients/listing'), 'name' => 'Clients - Listing'),
  array('url' => 'javascript:void', 'name' => 'Client - Edit'),

];
?>
@extends('layouts.admin_layout')
@section('title','Admin | Client Edit')
@section('content')
@section('page_header','Clients')
<style type="text/css">
  /***********************************************/
  /************ Jquery Bootstrap Switch *********/
  .has-switch {
    border-color: #e5e5e5;
  }

  .copyright {
    clear: both !important;
}



  /************ Jquery Bootstrap Switch *********/
  /*********************************************/
</style>
<div class="page-content">
  <div class="row">
    <div class="col-lg-12">
    <div id="invoices" >
          <div class="portlet">

            <div class="portlet-body">

              <div class="row">
                <div class="table-responsive mtl">
                  <table id="example1" class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th><a href="#sort by invoice #">Invoice #</a></th>
                        <th><a href="#sort by invoice date">Invoice Date</a></th>
                        <th><a href="#sort by due date">Due Date</a></th>
                        <th><a href="#sort by total">Total</a></th>
                        <th><a href="#sort by payment date">Payment Date</a></th>
                        <th><a href="#sort by transaction id">Transaction ID</a></th>
                        <th><a href="#sort by payment method">Payment Method</a></th>
                        <th><a href="#sort by status">Status</a></th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i = ($invoices->perPage() * ($invoices->currentPage() - 1)) + 1; @endphp
                      @forelse ($invoices as $invoice)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td><a href="{{url('admin/billing_invoice_edit').'/'.$invoice->id}}">MY-{{ $invoice->transaction_id }}</a></td>
                        <td>{{ $invoice->created_at }}</td>
                        <td>{{ $invoice->due_date }}</td>
                        <td>RM {{ number_format($invoice->total_amount, 2) }}</td>
                        <td>{{ $invoice->payment_date }}</td>
                        <td>4420911</td>
                        <td>
                          @if ($invoice->payment_method_id)
                          {{ $payments[$invoice->payment_method_id] }}
                          @else
                          <em>Not specified</em>
                          @endif
                        </td>
                        <td>
                          @if($invoice->status == 'COMPLETED')
                          <span class="label label-xs label-success">
                            Paid
                          </span>
                          @elseif ($invoice->status === 'INCOMPLETE')
                          <span class="label label-xs label-warning">
                            Unpaid
                          </span>
                          @else
                          <span class="label label-xs label-danger">
                            Payment Failed
                          </span>
                          @endif
                        </td>
                        <td><a href="billing_invoice_edit.html" data-hover="tooltip" data-placement="top" title="View/Edit Details"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-invoice" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a></td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="10"></td>
                      </tr>
                      @endforelse
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="10"></td>
                      </tr>
                    </tfoot>
                  </table>
                  <div class="tool-footer text-right">
                    <p class="pull-left">Showing page {{ $invoices->currentPage() }} of {{ $invoices->lastPage() }} total {{ $invoices->total() }} entries</p>
                   
                    {{$invoices->links()}}
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <!-- end row -->
            </div>
            <!-- end portlet-body -->

          </div>
          <!-- end portlet -->
        </div>
        <!-- end tab invoices -->
        <!--Modal delete start-->
        <div id="modal-delete-invoice" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
  </div>
  <!-- end row -->
</div>
@endsection

@section('custom_scripts')

@endsection