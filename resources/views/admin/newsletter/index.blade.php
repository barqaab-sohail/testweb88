 <?php if ($news['subscribers'] instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
<?php $per_page=$news['subscribers']->perPage(); ?>
<?php else: ?>
<?php $per_page=10; ?>
<?php endif ?>

<?php $page='newsletter';
/*$breadcrumbs=[
              array('url'=>url('clients/listing'),'name'=>'Clients'),
              array('url'=>url('clients/listing'),'name'=>'Clients - Listing'),

];*/
?>
@extends('layouts.admin_layout')
@section('title','Admin | Newsletter')
@section('content')
@section('page_header','Newsletter')
<div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Newsletter Subscribers <i class="fa fa-angle-right"></i> Listing</h2>
              <div id="alert_message" > </div>
              <div class="clearfix"></div>
              @if(isset($search_success))

                      {{-- <div class="alert alert-success alert-dismissable">
                                  <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                  <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                                  <p>{{$search_success}}</p>
                      </div>             --}}
              @endif

              @if(isset($search_error))
                      <div class="alert alert-danger alert-dismissable">
                                  <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                  <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                                  <p>{{$search_error}}</p>
                      </div>
              @endif

              @if (session('save_status') && session('save_status') === True)
                <div class="alert alert-success">
                  <button type="button" class="close alert-hide-btn" aria-hidden="true" class="close">&times;</button>
                  <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                  <p>{{ session('save_status_msg') }}</p>
                </div>
              @endif

              @if (session('save_status') && session('save_status') === False)
                <div class="alert alert-danger">
                  <button type="button" class="close alert-hide-btn" aria-hidden="true" class="close">&times;</button>
                  <i class="fa fa-check-circle"></i> <strong>Error!</strong>
                  <p>{{ session('save_status_msg') }}</p>
                </div>
              @endif

              @if (session('delete_status') && session('delete_status') === True)
                <div class="alert alert-success delete-success">
                  <button type="button" class="close alert-hide-btn" aria-hidden="true" class="close">&times;</button>
                  <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                  <p>Newsletter Subscriber(s) have been successfully deleted.</p>
                </div>
              @endif
              @if (session('delete_status') && session('delete_status') === False)
                <div class="alert alert-danger delete-error">
                  <button type="button" class="close alert-hide-btn" aria-hidden="true" class="close">&times;</button>
                  <i class="fa fa-check-circle"></i> <strong>Error!</strong>
                  <p>Failed to delete newsletter subscriber(s). Please try again.</p>
                </div>
              @endif

              <div class="pull-left"> Last updated:
                @if ($news['lastUpdated'] !== False)
                  <span class="text-blue">{{ date('d M, Y @ g:i A', strtotime($news['lastUpdated'])) }}</span>
                @else
                  <span class="text-blue">No available update history yet.</span>
                @endif
              </div>
              <div class="clearfix"></div>
              <p></p>


              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">News Alert Subscribers Listing</div>

                  <p style="margin-top:30px" class="margin-top-10px"></p>
                  <a href="#" data-target="#modal-add-subscriber" data-toggle="modal" class="btn btn-success create-subscriber-btn">
                    Add New &nbsp;<i class="fa fa-plus"></i>
                  </a>&nbsp;
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary">Delete</button>
                    <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                    <ul role="menu" class="dropdown-menu">
                      <li><a class="selected-delete-btn" href="javascript:void(0);">Delete selected item(s)</a></li>
                      <li class="divider"></li>
                      <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                    </ul>
                  </div>&nbsp;
                  <a href="{{ url('newsletter/subscribers/export') }}" class="btn btn-blue">
                    Export to CSV &nbsp;
                    <i class="fa fa-share"></i>
                  </a>
                   
          <div class="tools">
                    <i class="fa fa-chevron-up"></i>
                  </div>
                  <!--Modal Add New Subscriber start-->
                  <div id="modal-add-subscriber" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog modal-wide-width">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label2" class="modal-title">Add New Subscriber</h4>
                        </div>

                        <div class="modal-body">
                          <div class="form">
                            {{ Form::open(['url' => '/newsletter/addesubscriber', 'class' => 'form-horizontal', 'id' => 'add-subscriber-form']) }}
                              <div class="form-group">
                                <label class="col-md-3 control-label">Status</label>
                                <div class="col-md-6">
                                  <div data-on="success" data-off="primary" class="make-switch">
                                    {{ Form::checkbox('subscriber_status', 'true', true, ['class' => 'subscriber-status']) }}
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-3 control-label">Name <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="fa fa-user"></i>
                                    </span>
                                    {{ Form::text(
                                        'name',
                                        '',
                                        [
                                          'class' => 'form-control add-subscriber-field',
                                          'placeholder' => 'Name'
                                        ]
                                      )
                                    }}
                                  </div>
                                  @if ($errors->has('name'))
                                    <p class="text-danger add-subscriber-error">
                                      {{ $errors->first('name') }}
                                    </p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-3 control-label">Email <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="fa fa-envelope"></i>
                                    </span>
                                    {{
                                      Form::text(
                                        'email',
                                        '',
                                        [
                                          'class' => 'form-control add-subscriber-field',
                                          'placeholder' => 'Email address'
                                        ]
                                      )
                                    }}
                                  </div>
                                  @if ($errors->has('email'))
                                    <p class="text-danger add-subscriber-error">
                                      {{ $errors->first('email') }}
                                    </p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-3 control-label">Company <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  {{
                                    Form::text(
                                      'company',
                                      '',
                                      [ 'class' => 'form-control add-subscriber-field'
                                    ])
                                  }}
                                  @if ($errors->has('company'))
                                    <p class="text-danger add-subscriber-error">
                                      {{ $errors->first('company') }}
                                    </p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-3 control-label">Telephone <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  {{
                                    Form::text(
                                      'telephone',
                                      '',
                                      [ 'class' => 'form-control add-subscriber-field' ]
                                    )
                                  }}
                                  @if ($errors->has('telephone'))
                                    <p class="text-danger add-subscriber-error">
                                      {{ $errors->first('telephone') }}
                                    </p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-actions">
                                <div class="col-md-offset-5 col-md-8">
                                  {{
                                    Form::button(
                                      'Save &nbsp;<i class="fa fa-floppy-o"></i>',
                                      [ 'type' => 'submit', 'id' => 'save_subscriber', 'class' => 'btn btn-red']
                                    )
                                  }}
                                  &nbsp;
                                  {{
                                    Form::button(
                                      'Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i>',
                                      [
                                        'type' => 'button',
                                        'data-dismiss' => 'modal',
                                        'class' => 'btn btn-green add-cancel-btn'
                                      ]
                                    )
                                  }}
                                  <!-- <a href="#" data-dismiss="modal" class="btn btn-green">

                                  </a> -->
                                </div>
                              </div>
                            {{ Form::close() }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--END MODAL Add New Subscriber-->

                  <!-- Subscriber Edit Modal: start -->
                  <div id="modal-edit-subscriber" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog modal-wide-width">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label2" class="modal-title">Edit Subscriber</h4>
                        </div>

                        <div class="modal-body">
                          <div class="form">
                            {{ Form::open(['url' => '/newsletter/updatesubscriber', 'class' => 'form-horizontal']) }}
                              {{ Form::hidden('subscriber_id', '', [ 'id' => 'subscriber_id' ]) }}
                              <div class="form-group">
                                <label class="col-md-3 control-label">Status</label>
                                <div class="col-md-6">
                                  <div data-on="success" data-off="primary" class="edit-switch make-switch">
                                    {{ Form::checkbox('edit_subscriber_status', 'true', false, ['class' => 'subscriber-edit-status']) }}
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-3 control-label">Name <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="fa fa-user"></i>
                                    </span>
                                    {{ Form::text('edit_name', '', [ 'class' => 'form-control subscriber-edit-name', 'placeholder' => 'Name' ]) }}
                                  </div>
                                  @if ($errors->has('edit_name'))
                                    <p class="text-danger">
                                      {{ $errors->first('edit_name') }}
                                    </p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-3 control-label">Email <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="fa fa-envelope"></i>
                                    </span>
                                    {{ Form::text('edit_email', '', ['class' => 'form-control subscriber-edit-email', 'placeholder' => 'Email address '  ]) }}
                                  </div>
                                  @if ($errors->has('edit_email'))
                                    <p class="text-danger">
                                      {{ $errors->first('edit_email') }}
                                    </p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-3 control-label">Company <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  {{ Form::text('edit_company', '', [ 'class' => 'form-control subscriber-edit-company' ]) }}
                                  @if ($errors->has('edit_company'))
                                    <p class="text-danger">
                                      {{ $errors->first('edit_company') }}
                                    </p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-3 control-label">Telephone <span class="text-red">*</span></label>
                                <div class="col-md-6">
                                  {{ Form::text('edit_telephone', '', ['class' => 'form-control subscriber-edit-telephone' ]) }}
                                  @if ($errors->has('edit_telephone'))
                                    <p class="text-danger">
                                      {{ $errors->first('edit_telephone') }}
                                    </p>
                                  @endif
                                </div>
                              </div>
                              <div class="form-actions">
                                <div class="col-md-offset-5 col-md-8">
                                  {{ Form::button('Save &nbsp;<i class="fa fa-floppy-o"></i>', [ 'type' => 'submit', 'id' => 'save_subscriber', 'class' => 'btn btn-red']) }}
                                  &nbsp;
                                  <a href="#" data-dismiss="modal" class="btn btn-green">
                                    Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i>
                                  </a>
                                </div>
                              </div>
                            {{ Form::close() }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Subscriber Edit Modal: end -->

                  <!-- Single Delete Modal: Start -->
                  <div id="modal-single-delete" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this newsletter subscriber? </h4>
                        </div>
                        <div class="modal-body">
                          <!-- <p><strong>#1:</strong> MY-7974188 / Hock Lim</p> -->
                          <p>
                            <strong>#1:</strong>
                            <span class="modal_delete_name">Hock Lim</span> - <span class="modal_delete_email">hock@webqom.com</span>
                          </p>
                            {{ Form::open([ 'url' => url('/newsletter/deleteSubscriber') ]) }}
                              {{ Form::hidden('target_subscriber', '', [ 'id' => 'single_item_id' ]) }}
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8">
                                  {{ Form::button('Yes &nbsp;<i class="fa fa-check"></i>', [ 'type' => 'submit', 'class' => 'btn btn-red remove_single_subscriber']) }}
                                  <button href="#" data-dismiss="modal" class="btn btn-green delete-cancel-btn">
                                    No &nbsp;<i class="fa fa-times-circle"></i>
                                  </button>
                                </div>
                              </div>
                            {{ Form::close() }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Single Delete Modal: End -->
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
                          <!-- <p><strong>#1:</strong> Hock Lim - hock@webqom.com</p> -->
                          <div class="form-actions">
                            <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0);" class="btn btn-red delete_selected">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal delete selected items end -->

                  <div id="modal-delete-noselect" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                   <div class="modal-dialog">
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                         <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete selected items? </h4>
                       </div>
                       <div class="modal-body">
                         <div class="form-actions">
                          <div class="alert alert-danger" >
                             Please select at least one newsletter subscriber to delete
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

                  <!--Modal delete all items start-->
                  <div id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                        </div>
                        <div class="modal-body">
                          {{ Form::open(['url' => url('/newsletter/deleteAll')] ) }}
                            <div class="form-actions">
                              <div class="col-md-offset-4 col-md-8">
                                {{ Form::button('Yes &nbsp;<i class="fa fa-check"></i>', [ 'type' => 'submit', 'class' => 'btn btn-red delete-subscribers-btn']) }}
                                <a href="#" data-dismiss="modal" class="btn btn-green">
                                  No &nbsp;<i class="fa fa-times-circle"></i>
                                </a>
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

                  <div class="table-responsive mtl">
                    {{ Form::open([ 'url' => url('/newsletter/deleteSubscriberSelected')]) }}
                      <table class="table table-hover table-striped client_table">
                        <thead>
                          <tr>
                            <th width="1%"><input id="master" type="checkbox" class="item_checkbox"/></th>
                            <th>#</th>
                            <th>Status</th>
                            <th><a href="#sort by name">Name</a></th>
                            <th><a href="#sort by email">Email</a></th>
                            <th><a href="#sort by company">Company</a></th>
                            <th><a href="#sort by telephone">Telephone</a></th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(!empty($news['subscribers']))
                             <?php if ($news['subscribers'] instanceof \Illuminate\Pagination\LengthAwarePaginator){ ?>
                                <?php $count=$news['subscribers']->firstItem(); ?>
                              <?php }else{ ?>
                                <?php $count=1;?>
                              <?php } ?>
                            @foreach($news['subscribers'] as $new)
                          <tr data-id="{{$new->id}}" id="clienttbl_row_{{$new->id}}">
                            <td>
                              {{ Form::checkbox('subscribers_checkbox[]', $new->id, false, ['class' => 'sub_chk item_checkbox']) }}
                            </td>
                            <td>
                              <span class="nlsubscriber-count-index-{{ $new->id }}">
                                {{ $count }}
                              </span>
                            </td>
                            <td>
                              <span class="nlsubscriber-status-{{ $new->id }} label label-xs label-{{ ($new->status==1) ? 'success' : 'red' }}">
                                {{ ($new->status === '1') ? "Active" :"Inactive" }}
                              </span>
                            </td>
                            <td>
                              <span class="nlsubscriber-name-{{ $new->id }}">
                                {{ $new->name }}
                              </span>
                            </td>
                            <td>
                              <a class="nlsubscriber-email-{{ $new->id }}" href="mailto:hock@webqom.com">
                                {{ $new->email }}
                              </a>
                            </td>
                            <td>
                              @if ($new->company)
                                <span class="nlsubscriber-company-{{ $new->id }}">
                                  {{ $new->company }}
                                </span>
                              @else
                                <em>Not specified</em>
                              @endif
                            </td>
                            <td>
                              @if ($new->telephone)
                                <span class="nlsubscriber-telephone-{{ $new->id }}">
                                  {{ $new->telephone }}
                                </span>
                              @else
                                <em>Not specified</em>
                              @endif
                            </td>
                            <td>
                              {{--   --}}
                              <a  class="edit_single_trash" data-id="{{$new->id}}" href="#" data-hover="tooltip" data-target="#modal-edit-subscriber" data-toggle="modal" data-placement="top"  title="Edit">
                                <span class="label label-sm label-success edit-subscriber-btn" data-id="{{ $new->id }}">
                                  <i id="edit_data" class="fa fa-pencil"></i>
                                </span>
                              </a>
                              <a href="javascript:void(0);" data-hover="tooltip" data-placement="top" title="Delete">
                                <span class="label label-sm label-red delete_icon delete-subscriber-btn " data-id="{{ $new->id }}">
                                  <i class="fa fa-trash-o"></i>
                                </span>
                              </a>
                            </td>
                          </tr>
                          <?php $count++; ?>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="8"></td>
                          </tr>
                        </tfoot>
                      </table>
                       <?php if ($news['subscribers'] instanceof \Illuminate\Pagination\LengthAwarePaginator){ ?>
            <span> Showing {{empty($news['subscribers']) ? 0 : ($news['subscribers']->currentpage()-1)*$news['subscribers']->perpage()}} to {{(($news['subscribers']->currentpage()-1)*$news['subscribers']->perpage())+$news['subscribers']->count()}} of {{$news['subscribers']->total()}} </span>
                      <span class="pull-right">{{$news['subscribers']->links()}}</span>
                    <?php }else{ ?>
                      <span>Total records: {{count($news['subscribers'])}}</span>
                    <?php } ?>
                      <!-- <div class="tool-footer text-right">
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
                      {{ Form::submit('delete email', [ 'class' => 'delete-emails-btn hidden' ]) }}
                      {{ Form::close() }}
                    </div>
                    <!-- end table responsive -->
                </div>
              </div>


            </div>
          </div>
        </div>
@endsection
@section('custom_scripts')
  @if (!$errors->isEmpty() && session('create-error') === True)
    <script>
      $(document).ready(function() {
        $("#modal-add-subscriber").modal('show');
      });
    </script>
  @endif

  @if (!$errors->isEmpty() && session('edit-error') === True)
    <script>
      $(document).ready(function() {
        $("#modal-edit-subscriber").modal('show');
      });
    </script>
  @endif

  <script type="text/javascript">

    $(document).ready(function(){
      $('.subscriber-edit-status').bootstrapSwitch();

      $('.create-subscriber-btn').on('click', function () {
        $('.add-subscriber-field').val('');

        $('.subscriber-status').prop('checked', true);
        $('.subscriber-status').parent().removeClass('switch-off');
        $('.subscriber-status').parent().addClass('switch-on');

        $('.add-subscriber-error').remove();
      });

      $('.selected-delete-btn').on('click', function() {
        checked_emails = $(".sub_chk:checked");
        if (checked_emails.length > 0) {
          var html = "";

          checked_emails.each(function() {
            reference_id = $(this).val();

            html += "<p>";
            html += "<strong>#" + $('.nlsubscriber-count-index-' + reference_id).text() + ":</strong> ";
            html += $('.nlsubscriber-name-' + reference_id).text() + " - ";
            html += $('.nlsubscriber-email-' + reference_id).text();
          });

          $(".selected_client_list").html(html);
          $("#modal-delete-selected").modal('show');
        } else {
          $('#modal-delete-noselect').modal('show');
        }
      });

      $('.delete_selected').on('click', function () {
        $('.delete-emails-btn').click();
      });

      $('.delete-subscriber-btn').on('click', function () {
        target_id = $(this).data('id');

        $("#single_item_id").val(target_id);
        $(".modal_delete_name").text($('.nlsubscriber-name-' + target_id).text());
        $(".modal_delete_email").text($('.nlsubscriber-email-' + target_id).text());
        $("#modal-single-delete").modal('show');
      });

      $('.edit-subscriber-btn').on('click', function () {
        target_id = $(this).data('id');

        $('#subscriber_id').val(target_id);

        if ($('.nlsubscriber-status-' + target_id).text().trim().toLowerCase() === 'active') {
          $('.subscriber-edit-status').prop('checked', true);
          $('.subscriber-edit-status').parent().removeClass('switch-off');
          $('.subscriber-edit-status').parent().addClass('switch-on');
        }

        $('.subscriber-edit-name').val($('.nlsubscriber-name-' + target_id).text().trim());
        $('.subscriber-edit-email').val($('.nlsubscriber-email-' + target_id).text().trim());
        $('.subscriber-edit-company').val($('.nlsubscriber-company-' + target_id).text().trim());
        $('.subscriber-edit-telephone').val($('.nlsubscriber-telephone-' + target_id).text().trim());

        $('#modal-edit-subscriber').modal('show');
      });

      $('#master').on('click', function(e) {
        if($(this).is(':checked',true)) {
          $(".sub_chk").prop('checked', true);
        } else {
          $(".sub_chk").prop('checked',false);
        }
      });

      $('.item_checkbox').prop('checked', false);
    });
  </script>
@endsection
