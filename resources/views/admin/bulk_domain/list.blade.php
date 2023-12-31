<?php
$page = 'Bulk Domain';
$breadcrumbs = [
	array('url' => false, 'name' => 'Services'),
	array('url' => url('admin/bulk_domain'), 'name' => 'Bulk Domain Pricing -Listing'),
];
?>
<style type="text/css">
    .has-switch{
        height: 35px !important;
    }
    .dd-handle{
        cursor: move !important;
    }
    .dd-nodrag{
        cursor: pointer !important;
    }
    .home_dd{
        font-size: 17px;
        display: block;
        height: 30px;
        margin: 5px 0;
        padding: 5px 10px;
        text-decoration: none;
        border: 1px solid #ccc;
        background: #fafafa;
        box-sizing: border-box
    }
    .datepicker table tr td.active:hover, .datepicker table tr td.active:hover:hover, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled:hover:hover, .datepicker table tr td.active:active, .datepicker table tr td.active:hover:active, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active.active, .datepicker table tr td.active:hover.active, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active.disabled:hover.active, .datepicker table tr td.active.disabled, .datepicker table tr td.active:hover.disabled, .datepicker table tr td.active.disabled.disabled, .datepicker table tr td.active.disabled:hover.disabled, .datepicker table tr td.active[disabled], .datepicker table tr td.active:hover[disabled], .datepicker table tr td.active.disabled[disabled], .datepicker table tr td.active.disabled:hover[disabled] {
        background-color: #b8312f !important;
    }
</style>
@extends('layouts.admin_layout')
@section('title','Admin | Bulk Domain Pricing -Listing')
@section('content')
@section('page_header','Services')
<style>
    .fa {
        display: inline;
    }
</style>

<div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Bulk Domain Pricing <i class="fa fa-angle-right"></i> Listing</h2>
              <div class="clearfix"></div>
			  @include('admin.partials.messages')

              <!--<div class="alert alert-success alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                <p>The information has been saved/updated successfully.</p>
              </div>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                <p>The information has not been saved/updated. Please correct the errors.</p>
              </div>-->
              <div class="pull-left"> Last updated: <span class="text-blue">{{$recent_update}}</span> </div>
              <div class="clearfix"></div>
              <p></p>

              <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#new-registrations" data-toggle="tab">New Registrations</a></li>
                <li><a href="#renewals" data-toggle="tab">Renewals</a></li>
                <li><a href="#transfers" data-toggle="tab">Transfers</a></li>
              </ul>

              <div id="myTabContent" class="tab-content">
                <div id="new-registrations" class="tab-pane fade in active">


					<div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Bulk Domain Pricing Listing</div>
                      <p class="margin-top-10px"></p>
                      <div class="clearfix"></div>
                      <div class="text-blue">This is where you configure the TLDs that you want to allow clients to register or transfer to you. As well as pricing, you can set which addons are offered with each TLD. If an EPP code is required for transfers, tick the EPP Code box. If DNS Management, Email Forwarding or ID Protection is available &amp; should be offered for this TLD check the boxes.</div>
					  <div class="xss-margin"></div>
                      <a href="#" data-target="#modal-add-new-price" data-toggle="modal" class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                      <a href="#" class="btn btn-warning">Update All Pricing &nbsp;<i class="fa fa-refresh"></i></a>&nbsp;
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Delete</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="javascript:void" onclick="open_modal_delete_selected()">Delete selected item(s)</a></li>
                          <li class="divider"></li>
                          <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                        </ul>
                      </div>
                      <!--Modal Add New Pricing start-->
                      <div id="modal-add-new-price" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label3" class="modal-title">Add New Pricing</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                <form class="form-horizontal" name="bulk_doman_form2" id="bulk_doman_form2" enctype="multipart/form-data" method="POST" action="/admin/bulk_domain/add">
                                  {{csrf_field()}}
								  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-6">
                                      <div data-on="success" data-off="primary" class="make-switch">
                                        <input type="checkbox" checked="checked"/>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">TLD <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                      <input type="text" class="form-control" placeholder="eg .com">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                     <label class="col-md-3 control-label">EPP Code <span class="text-red">*</span></label>

                                     <div class="col-md-6">
                                     	<div class="xss-margin"></div>
                                     	<div class="checkbox-list">
                                        	<label><input id="inlineCheckbox1" type="checkbox" value="option1" checked="checked"/>&nbsp; Enabled</label>
											<label><input id="inlineCheckbox1" type="checkbox" value="option2"/>&nbsp; Disabled</label>
                                         </div>
                                     </div>
                                  </div>

                                  <div class="form-group">
                                     <label class="col-md-3 control-label">Domain Addons</label>

                                     <div class="col-md-6">
                                     	<div class="xss-margin"></div>
                                     	<div class="checkbox-list" name="list-select-all">
                                        	<label><input id="inlineCheckbox1" name="select-all" type="checkbox" value="option5"/>&nbsp; Select all</label>
                                            <label><input id="inlineCheckbox1" type="checkbox" value="option6"/>&nbsp; DNS Management</label>
                                            <label><input id="inlineCheckbox1" type="checkbox" value="option7"/>&nbsp; Email Forwarding</label>
                                            <label><input id="inlineCheckbox1" type="checkbox" value="option7"/>&nbsp; ID Protection</label>
                                            
                                         </div>
                                     </div>
                                  </div>

                                  <div class="table-responsive mtl">
                                    <table class="table table-hover table-striped">
                                      <thead>

                                        <tr>
                                          <th>Domain Pricing (RM)</th>
                                          <th>1 Year</th>
                                          <th>2 Years</th>
                                          <th>3 Years</th>
                                          <th>4 Years</th>
                                          <th>5 Years</th>
                                          <th>6 Years</th>
                                          <th>7 Years</th>
                                          <th>8 Years</th>
                                          <th>9 Years</th>
                                          <th>10 Years</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      	@foreach($RMSALE as $key=>$domain)
										<?php
$index = $key;
?>
                                      	<tr>
                                        	<td>Sale Price ({{$domain['duration']}})</td>
                                            <td><input type="text" name="year_sale_1{{$index}}" class="form-control text-red"></td>
                                            <td><input type="text" name="year_sale_2{{$index}}" class="form-control text-red"></td>
                                            <td><input type="text" name="year_sale_3{{$index}}" class="form-control text-red"></td>
                                            <td><input type="text" name="year_sale_4{{$index}}" class="form-control text-red"></td>
                                            <td><input type="text" name="year_sale_5{{$index}}" class="form-control text-red"></td>
                                            <td><input type="text" name="year_sale_6{{$index}}" class="form-control text-red"></td>
                                            <td><input type="text" name="year_sale_7{{$index}}" class="form-control text-red"></td>
                                            <td><input type="text" name="year_sale_8{{$index}}" class="form-control text-red"></td>
                                            <td><input type="text" name="year_sale_9{{$index}}" class="form-control text-red"></td>
                                            <td><input type="text" name="year_sale_10{{$index}}" class="form-control text-red"></td>
                                        </tr>

                                        <tr>

                                            <td>List Price ({{$RMLIST[$index]['duration']}})</td>
                                            <td><input type="text" name="year_list_1{{$index}}" class="form-control"></td>
                                            <td><input type="text" name="year_list_2{{$index}}" class="form-control"></td>
                                            <td><input type="text" name="year_list_3{{$index}}" class="form-control"></td>
                                            <td><input type="text" name="year_list_4{{$index}}" class="form-control"></td>
                                            <td><input type="text" name="year_list_5{{$index}}" class="form-control"></td>
                                            <td><input type="text" name="year_list_6{{$index}}" class="form-control"></td>
                                            <td><input type="text" name="year_list_7{{$index}}" class="form-control"></td>
                                            <td><input type="text" name="year_list_8{{$index}}" class="form-control"></td>
                                            <td><input type="text" name="year_list_9{{$index}}" class="form-control"></td>
                                            <td><input type="text" name="year_list_10{{$index}}" class="form-control"></td>
                                        </tr>
										@endforeach
                                       </tbody>
                                       <tfoot>
                                        <tr colspan="11"></tr>
                                       </tfoot>
                           			</table>
                                 </div><!-- end table responsive -->

									<div class="form-actions">
										<div class="col-md-offset-5 col-md-8"> <a href="javascript:void" onclick="add_sub_cat()" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
									</div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL Add New Pricing-->
                      <!--Modal delete selected items start-->
                      <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a>Are you sure you want to delete the selected item(s)? </h4>
                            </div>
                            <div class="modal-body">
							<p id="selected_zero" style="display:none" class="alert alert-danger">Please select aleast one item for delete</p>
                              <!--<p>.com (1-5)</p>-->
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red" id="delete_bulk">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                                    <div class="col-md-offset-4 col-md-8"> <a href="javascript:void" onclick="delete_all()" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- modal delete all items end -->

                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
                    <div class="portlet-body">

                      <div class="form-inline pull-left">
                        <div class="form-group">
						<select class="form-control" id="per_page_select" onchange="per_page_change()">
							<option value="5" @if($per_page==5) selected="" @endif>Show 5</option>
							<option value="10" @if($per_page==10) selected="" @endif>Show 10</option>
							<option value="20" @if($per_page==20) selected="" @endif>Show 20</option>
						  </select>
                          <label class="control-label"></label>

                        </div>
                      </div>

                      <div class="clearfix"></div>
					<form class="form-horizontal" name="delete_form" id="delete_form" enctype="multipart/form-data" method="POST" action="/admin/bulk_domain/delete">
					{{csrf_field()}}
                      <div class="table-responsive mtl">
                        <table class="table table-hover table-striped">
                          <thead>
                            <tr>
                              <th width="1%"><input type="checkbox"/></th>
                              <th>.com</th>
                              <th>1 Year</th>
                              <th>2 Years</th>
                              <th>3 Years</th>
                              <th>4 Years</th>
                              <th>5 Years</th>
                              <th>6 Years</th>
                              <th>7 Years</th>
                              <th>8 Years</th>
                              <th>9 Years</th>
                              <th>10 Years</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
							@foreach($domains as $key=>$domain)
                              <td><input type="checkbox" name="bdp_id[]" value="{{$domain->bdp_id}}"/></td>

                              <td>{{$domain->duration}}</td>
                              <td><span class="text-red">{{$domain->year_sale_1}}*</span><br/><span class="strike">{{$domain->year_list_1}}*</span></td>
							  <td><span class="text-red">{{$domain->year_sale_2}}*</span><br/><span class="strike">{{$domain->year_list_2}}*</span></td>
							  <td><span class="text-red">{{$domain->year_sale_3}}*</span><br/><span class="strike">{{$domain->year_list_3}}*</span></td>
							  <td><span class="text-red">{{$domain->year_sale_4}}*</span><br/><span class="strike">{{$domain->year_list_4}}*</span></td>
							  <td><span class="text-red">{{$domain->year_sale_5}}*</span><br/><span class="strike">{{$domain->year_list_5}}*</span></td>
							  <td><span class="text-red">{{$domain->year_sale_6}}*</span><br/><span class="strike">{{$domain->year_list_6}}*</span></td>
							  <td><span class="text-red">{{$domain->year_sale_7}}*</span><br/><span class="strike">{{$domain->year_list_7}}*</span></td>
							  <td><span class="text-red">{{$domain->year_sale_8}}*</span><br/><span class="strike">{{$domain->year_list_8}}*</span></td>
							  <td><span class="text-red">{{$domain->year_sale_9}}*</span><br/><span class="strike">{{$domain->year_list_9}}*</span></td>
							  <td><span class="text-red">{{$domain->year_sale_10}}*</span><br/><span class="strike">{{$domain->year_list_10}}*</span></td>



                              <td>
								<span class="label label-sm label-{{$domain->status?'success':'danger'}}">{{$domain->status?'Active':'Inactive'}}</span>

								</td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-pricing" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                              </td>
                            </tr>
							@endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="14"></td>
                            </tr>
                          </tfoot>
                        </table>
                        <div class="tool-footer text-right">
						<p class="pull-left">
							Showing {{($domains->currentpage()-1)*$domains->perpage()+1}} to {{$domains->currentpage()*$domains->perpage()}} of  {{$domains->total()}} entries
						</p>

						{{ $domains->links() }}
                      </div>
                      <div class="clearfix"></div>

                        <div class="clearfix"></div>
                      </div><!-- end table responsive -->
                      </form>


						 @foreach($domains as $key=>$domain)
						 @if($key==0)
							  <!--Modal Edit Pricing start-->
                              <div id="modal-edit-price" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                <div class="modal-dialog modal-wide-width">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                      <h4 id="modal-login-label3" class="modal-title">Edit Pricing</h4>
                                    </div>
                                    <div class="modal-body">

                                      <div class="form">

									  <form class="form-horizontal" name="myform1" id="myform1" enctype="multipart/form-data" method="POST" action="/admin/bulk_domain/update" >
										{{csrf_field()}}

                                          <div class="form-group">
                                            <label class="col-md-3 control-label">Status</label>
                                            <div class="col-md-6">
                                              <div data-on="success" data-off="primary" class="make-switch">
                                                <input type="checkbox" checked="checked"/>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="col-md-3 control-label">TLD <span class="text-red">*</span></label>
                                            <div class="col-md-6">
                                              <input type="text" class="form-control" placeholder="eg .com" value=".com">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                             <label class="col-md-3 control-label">EPP Code <span class="text-red">*</span></label>

                                             <div class="col-md-6">
                                                <div class="xss-margin"></div>
                                                <div class="checkbox-list">
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option1" checked="checked"/>&nbsp; Enabled</label>
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option2"/>&nbsp; Disabled</label>
                                                 </div>
                                             </div>
                                          </div>

                                          <div class="form-group">
                                             <label class="col-md-3 control-label">Domain Addons</label>

                                             <div class="col-md-6">
                                                <div class="xss-margin"></div>
                                                <div class="checkbox-list" name="list-select-all">
                                                    <label><input id="inlineCheckbox1" type="checkbox" name="select-all" value="option5"/>&nbsp; Select all</label>
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option6"/>&nbsp; DNS Management</label>
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option7"/>&nbsp; Email Forwarding</label>
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option7"/>&nbsp; ID Protection</label>

                                                 </div>
                                             </div>
                                          </div>

                                          <div class="table-responsive mtl">
                                            <table class="table table-hover table-striped">
                                              <thead>

                                                <tr>
                                                  <th>Domain Pricing (RM)</th>
                                                  <th>1 Year</th>
                                                  <th>2 Years</th>
                                                  <th>3 Years</th>
                                                  <th>4 Years</th>
                                                  <th>5 Years</th>
                                                  <th>6 Years</th>
                                                  <th>7 Years</th>
                                                  <th>8 Years</th>
                                                  <th>9 Years</th>
                                                  <th>10 Years</th>
                                                </tr>
                                              </thead>
                                              <tbody>
											  @foreach($domains as $key=>$domain)
                                                <tr>
                                                    <td>Sale Price ({{$domain->duration}})</td>
                                                    <td><input type="text" name="year_sale_1{{$domain->bdp_id}}" class="form-control text-red" value="{{$domain->year_sale_1}}*"></td>
                                                    <td><input type="text" name="year_sale_2{{$domain->bdp_id}}" class="form-control text-red" value="{{$domain->year_sale_2}}*"></td>
                                                    <td><input type="text" name="year_sale_3{{$domain->bdp_id}}" class="form-control text-red" value="{{$domain->year_sale_3}}*"></td>
                                                    <td><input type="text" name="year_sale_4{{$domain->bdp_id}}" class="form-control text-red" value="{{$domain->year_sale_4}}*"></td>
                                                    <td><input type="text" name="year_sale_5{{$domain->bdp_id}}" class="form-control text-red" value="{{$domain->year_sale_5}}*"></td>
                                                    <td><input type="text" name="year_sale_6{{$domain->bdp_id}}" class="form-control text-red" value="{{$domain->year_sale_6}}*"></td>
                                                    <td><input type="text" name="year_sale_7{{$domain->bdp_id}}" class="form-control text-red" value="{{$domain->year_sale_7}}*"></td>
                                                    <td><input type="text" name="year_sale_8{{$domain->bdp_id}}" class="form-control text-red" value="{{$domain->year_sale_8}}*"></td>
                                                    <td><input type="text" name="year_sale_9{{$domain->bdp_id}}" class="form-control text-red" value="{{$domain->year_sale_9}}*"></td>
                                                    <td><input type="text" name="year_sale_10{{$domain->bdp_id}}" class="form-control text-red" value="{{$domain->year_sale_10}}*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price ({{$domain->duration}})</td>
                                                    <td><input type="text" name="year_list_1{{$domain->bdp_id}}" class="form-control" value="{{$domain->year_list_1}}*"></td>
                                                    <td><input type="text" name="year_list_2{{$domain->bdp_id}}" class="form-control" value="{{$domain->year_list_2}}*"></td>
                                                    <td><input type="text" name="year_list_3{{$domain->bdp_id}}" class="form-control" value="{{$domain->year_list_3}}*"></td>
                                                    <td><input type="text" name="year_list_4{{$domain->bdp_id}}" class="form-control" value="{{$domain->year_list_4}}*"></td>
                                                    <td><input type="text" name="year_list_5{{$domain->bdp_id}}" class="form-control" value="{{$domain->year_list_5}}*"></td>
                                                    <td><input type="text" name="year_list_6{{$domain->bdp_id}}" class="form-control" value="{{$domain->year_list_6}}*"></td>
                                                    <td><input type="text" name="year_list_7{{$domain->bdp_id}}" class="form-control" value="{{$domain->year_list_7}}*"></td>
                                                    <td><input type="text" name="year_list_8{{$domain->bdp_id}}" class="form-control" value="{{$domain->year_list_8}}*"></td>
                                                    <td><input type="text" name="year_list_9{{$domain->bdp_id}}" class="form-control" value="{{$domain->year_list_9}}*"></td>
                                                    <td><input type="text" name="year_list_10{{$domain->bdp_id}}" class="form-control" value="{{$domain->year_list_10}}*"></td>
                                                 </tr>
												@endforeach

                                               </tbody>
                                               <tfoot>
                                                <tr colspan="11"></tr>
                                               </tfoot>
                                            </table>
                                         </div><!-- end table responsive -->

											<div class="form-actions">
												<div class="col-md-offset-5 col-md-8"> <a href="javascript:void" onclick="update_sub_cat({{$domains->currentPage()}})" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
											</div>

                                        </form>

                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--END MODAL edit Pricing-->
                                <!--Modal delete start-->
                                <div id="modal-delete-pricing" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                            <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                          </div>
                                          <div class="modal-body">
                                            <p>.com (1-5)</p>
                                            <div class="form-actions">
                                              <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  <!-- modal delete end -->

								  @endif


						 @endforeach
                    </div>
                  </div><!-- End portlet -->

                </div><!-- end new registration pricing tab -->


                <div id="renewals" class="tab-pane fade in">


					<div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Bulk Domain Pricing Listing</div>
                      <p class="margin-top-10px"></p>
                      <div class="clearfix"></div>
                      <div class="text-blue">This is where you configure the TLDs that you want to allow clients to register or transfer to you. As well as pricing, you can set which addons are offered with each TLD. If an EPP code is required for transfers, tick the EPP Code box. If DNS Management, Email Forwarding or ID Protection is available &amp; should be offered for this TLD check the boxes.</div>
					  <div class="xss-margin"></div>
                      <a href="#" data-target="#modal-add-new-price-renewal" data-toggle="modal" class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                      <a href="#" class="btn btn-warning">Update All Pricing &nbsp;<i class="fa fa-refresh"></i></a>&nbsp;
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Delete</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="#" data-target="#modal-delete-selected-renewal" data-toggle="modal">Delete selected item(s)</a></li>
                          <li class="divider"></li>
                          <li><a href="#" data-target="#modal-delete-all-renewal" data-toggle="modal">Delete all</a></li>
                        </ul>
                      </div>
                      <!--Modal Add New Pricing renewal start-->
                      <div id="modal-add-new-price-renewal" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label3" class="modal-title">Add New Pricing</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                <form class="form-horizontal">
								{{csrf_field()}}
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-6">
                                      <div data-on="success" data-off="primary" class="make-switch">
                                        <input type="checkbox" checked="checked"/>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">TLD <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                      <input type="text" class="form-control" placeholder="eg .com">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                     <label class="col-md-3 control-label">EPP Code <span class="text-red">*</span></label>

                                     <div class="col-md-6">
                                     	<div class="xss-margin"></div>
                                     	<div class="checkbox-list">
                                        	<label><input id="inlineCheckbox1" type="checkbox" value="option1" checked="checked"/>&nbsp; Enabled</label>
											<label><input id="inlineCheckbox1" type="checkbox" value="option2"/>&nbsp; Disabled</label>
                                         </div>
                                     </div>
                                  </div>

                                  <div class="form-group">
                                     <label class="col-md-3 control-label">Domain Addons</label>

                                     <div class="col-md-6">
                                     	<div class="xss-margin"></div>
                                     	<div class="checkbox-list">
                                        	<label><input id="inlineCheckbox1" type="checkbox" value="option5"/>&nbsp; Select all</label>
                                            <label><input id="inlineCheckbox1" type="checkbox" value="option6"/>&nbsp; DNS Management</label>
                                            <label><input id="inlineCheckbox1" type="checkbox" value="option7"/>&nbsp; Email Forwarding</label>
                                            <label><input id="inlineCheckbox1" type="checkbox" value="option7"/>&nbsp; ID Protection</label>

                                         </div>
                                     </div>
                                  </div>

                                  <div class="table-responsive mtl">
                                    <table class="table table-hover table-striped">
                                      <thead>

                                        <tr>
                                          <th>Domain Pricing (RM)</th>
                                          <th>1 Year</th>
                                          <th>2 Years</th>
                                          <th>3 Years</th>
                                          <th>4 Years</th>
                                          <th>5 Years</th>
                                          <th>6 Years</th>
                                          <th>7 Years</th>
                                          <th>8 Years</th>
                                          <th>9 Years</th>
                                          <th>10 Years</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      	<tr>
                                        	<td>Sale Price (1-5)</td>
                                            <td><input type="text" name="" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                         </tr>
                                         <tr>
                                            <td>List Price (1-5)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                         </tr>
                                         <tr>
                                        	<td>Sale Price (6-20)</td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                         </tr>
                                         <tr>
                                            <td>List Price (6-20)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                         </tr>
                                         <tr>
                                        	<td>Sale Price (21-49)</td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                         </tr>
                                         <tr>
                                            <td>List Price (21-49)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                         </tr>
                                         <tr>
                                        	<td>Sale Price (50-100)</td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                         </tr>
                                         <tr>
                                            <td>List Price (50-100)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                         </tr>
                                         <tr>
                                        	<td>Sale Price (101-200)</td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                         </tr>
                                         <tr>
                                            <td>List Price (101-200)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                         </tr>
                                         <tr>
                                        	<td>Sale Price (201-500)</td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                         </tr>
                                         <tr>
                                            <td>List Price (201-500)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                         </tr>
                                       </tbody>
                                       <tfoot>
                                        <tr colspan="11"></tr>
                                       </tfoot>
                           			</table>
                                 </div><!-- end table responsive -->

                                  <div class="form-actions">
                                    <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL Add New Pricing renewal -->
                      <!--Modal delete selected items start-->
                      <div id="modal-delete-selected-renewal" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                            </div>
                            <div class="modal-body">
                              <p>.com (1-5)</p>
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- modal delete selected items end -->
                      <!--Modal delete all items renewal start-->
                      <div id="modal-delete-all-renewal" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
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
                          <!-- modal delete all items renewal end -->

                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
                    <div class="portlet-body">

                      <div class="form-inline pull-left">
                        <div class="form-group">
                          <select name="select" class="form-control">
                            <option>10</option>
                            <option>20</option>
                            <option>30</option>
                            <option>50</option>
                            <option selected="selected">100</option>
                          </select>
                          &nbsp;
                          <label class="control-label">Records per page</label>

                        </div>
                      </div>

                      <div class="clearfix"></div>

                      <div class="table-responsive mtl">
                        <table class="table table-hover table-striped">
                          <thead>
                          	<tr>
                            	<th></th>
                                <th></th>
                                <th></th>
                                <th colspan="10"><div class="alicent">Per Year Pricing (RM)</div></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                              <th width="1%"><input type="checkbox" /></th>
                              <th>.com</th>
                              <th>1 Year</th>
                              <th>2 Years</th>
                              <th>3 Years</th>
                              <th>4 Years</th>
                              <th>5 Years</th>
                              <th>6 Years</th>
                              <th>7 Years</th>
                              <th>8 Years</th>
                              <th>9 Years</th>
                              <th>10 Years</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><input type="checkbox"/></td>
                              <td>1-5</td>
                              <td><span class="text-red">9.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">38.49*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">55.59*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="label label-xs label-success">Active</span></td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price-renewal" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-price-renewal" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                              <!--Modal Edit Pricing renewal start-->
                              <div id="modal-edit-price-renewal" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                <div class="modal-dialog modal-wide-width">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                      <h4 id="modal-login-label3" class="modal-title">Edit Pricing</h4>
                                    </div>
                                    <div class="modal-body">
                                      <div class="form">
                                        <form class="form-horizontal">
										{{csrf_field()}}
                                          <div class="form-group">
                                            <label class="col-md-3 control-label">Status</label>
                                            <div class="col-md-6">
                                              <div data-on="success" data-off="primary" class="make-switch">
                                                <input type="checkbox" checked="checked"/>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="col-md-3 control-label">TLD <span class="text-red">*</span></label>
                                            <div class="col-md-6">
                                              <input type="text" class="form-control" placeholder="eg .com" value=".com">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                             <label class="col-md-3 control-label">EPP Code <span class="text-red">*</span></label>

                                             <div class="col-md-6">
                                                <div class="xss-margin"></div>
                                                <div class="checkbox-list">
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option1" checked="checked"/>&nbsp; Enabled</label>
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option2"/>&nbsp; Disabled</label>
                                                 </div>
                                             </div>
                                          </div>

                                          <div class="form-group">
                                             <label class="col-md-3 control-label">Domain Addons</label>

                                             <div class="col-md-6">
                                                <div class="xss-margin"></div>
                                                <div class="checkbox-list">
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option5"/>&nbsp; Select all</label>
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option6"/>&nbsp; DNS Management</label>
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option7"/>&nbsp; Email Forwarding</label>
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option7"/>&nbsp; ID Protection</label>

                                                 </div>
                                             </div>
                                          </div>

                                          <div class="table-responsive mtl">
                                            <table class="table table-hover table-striped">
                                              <thead>

                                                <tr>
                                                  <th>Domain Pricing (RM)</th>
                                                  <th>1 Year</th>
                                                  <th>2 Years</th>
                                                  <th>3 Years</th>
                                                  <th>4 Years</th>
                                                  <th>5 Years</th>
                                                  <th>6 Years</th>
                                                  <th>7 Years</th>
                                                  <th>8 Years</th>
                                                  <th>9 Years</th>
                                                  <th>10 Years</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                    <td>Sale Price (1-5)</td>
                                                    <td><input type="text" class="form-control text-red" value="9.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="38.49*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="55.59*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price (1-5)</td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>Sale Price (6-20)</td>
                                                    <td><input type="text" class="form-control text-red" value="9.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="38.49*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="55.59*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price (6-20)</td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>Sale Price (21-49)</td>
                                                    <td><input type="text" class="form-control text-red" value="9.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="38.49*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="55.59*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price (21-49)</td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>Sale Price (50-100)</td>
                                                    <td><input type="text" class="form-control text-red" value="9.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="38.49*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="55.59*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price (50-100)</td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>Sale Price (101-200)</td>
                                                    <td><input type="text" class="form-control text-red" value="9.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="38.49*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="55.59*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price (101-200)</td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>Sale Price (201-500)</td>
                                                    <td><input type="text" class="form-control text-red" value="9.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="38.49*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="55.59*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price (201-500)</td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                 </tr>
                                               </tbody>
                                               <tfoot>
                                                <tr colspan="11"></tr>
                                               </tfoot>
                                            </table>
                                         </div><!-- end table responsive -->

                                          <div class="form-actions">
                                            <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--END MODAL edit pricing renewal -->
                                <!--Modal delete renewal start-->
                                <div id="modal-delete-price-renewal" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                            <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                          </div>
                                          <div class="modal-body">
                                            <p>.com (1-5)</p>
                                            <div class="form-actions">
                                              <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  <!-- modal delete price renewal end -->
                              </td>
                            </tr>
                            <tr>
                              <tr>
                              <td><input type="checkbox" /></td>
                              <td>6-20</td>
                              <td><span class="text-red">9.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">38.49*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">55.59*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="label label-xs label-success">Active</span></td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price-renewal" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-price-renewal" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> </td>
                            </tr>
                            <tr>
                              <tr>
                              <td><input type="checkbox"/></td>
                              <td>21-49</td>
                              <td><span class="text-red">9.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">38.49*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">55.59*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="label label-xs label-success">Active</span></td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price-renewal" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-price-renewal" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> </td>
                            </tr>
                            <tr>
                              <tr>
                              <td><input type="checkbox"/></td>
                              <td>50-100</td>
                              <td><span class="text-red">9.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">38.49*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">55.59*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="label label-xs label-success">Active</span></td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price-renewal" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-price-renewal" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> </td>
                            </tr>
                            <tr>
                              <tr>
                              <td><input type="checkbox"/></td>
                              <td>101-200</td>
                              <td><span class="text-red">9.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">38.49*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">55.59*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="label label-xs label-success">Active</span></td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price-renewal" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-price-renewal" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> </td>
                            </tr>
                            <tr>
                              <tr>
                              <td><input type="checkbox"/></td>
                              <td>201-500</td>
                              <td><span class="text-red">9.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">38.49*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">55.59*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="label label-xs label-success">Active</span></td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price-renewal" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-price-renewal" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> </td>
                            </tr>

                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="14"></td>
                            </tr>
                          </tfoot>
                        </table>
                        <div class="tool-footer text-right">
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
                      </div>
                      <div class="clearfix"></div>

                        <div class="clearfix"></div>
                      </div><!-- end table responsive -->


                    </div>
                  </div><!-- End portlet -->

                </div><!-- end renewals tab -->


                <div id="transfers" class="tab-pane fade in">


					<div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Bulk Domain Pricing Listing</div>
                      <p class="margin-top-10px"></p>
                      <div class="clearfix"></div>
                      <div class="text-blue">This is where you configure the TLDs that you want to allow clients to register or transfer to you. As well as pricing, you can set which addons are offered with each TLD. If an EPP code is required for transfers, tick the EPP Code box. If DNS Management, Email Forwarding or ID Protection is available &amp; should be offered for this TLD check the boxes.</div>
					  <div class="xss-margin"></div>
                      <a href="#" data-target="#modal-add-new-price-transfer" data-toggle="modal" class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                      <a href="#" class="btn btn-warning">Update All Pricing &nbsp;<i class="fa fa-refresh"></i></a>&nbsp;
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Delete</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="#" data-target="#modal-delete-selected-transfer"  data-toggle="modal">Delete selected item(s)</a></li>
                          <li class="divider"></li>
                          <li><a href="#" data-target="#modal-delete-all-transfer" data-toggle="modal">Delete all</a></li>
                        </ul>
                      </div>
                      <!--Modal Add New Pricing transfer start-->
                      <div id="modal-add-new-price-transfer" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label3" class="modal-title">Add New Pricing</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                <form class="form-horizontal">
								{{csrf_field()}}
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-6">
                                      <div data-on="success" data-off="primary" class="make-switch">
                                        <input type="checkbox" checked="checked"/>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-md-3 control-label">TLD <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                      <input type="text" class="form-control" placeholder="eg .com">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                     <label class="col-md-3 control-label">EPP Code <span class="text-red">*</span></label>

                                     <div class="col-md-6">
                                     	<div class="xss-margin"></div>
                                     	<div class="checkbox-list">
                                        	<label><input id="inlineCheckbox1" type="checkbox" value="option1" checked="checked"/>&nbsp; Enabled</label>
											<label><input id="inlineCheckbox1" type="checkbox" value="option2"/>&nbsp; Disabled</label>
                                         </div>
                                     </div>
                                  </div>

                                  <div class="form-group">
                                     <label class="col-md-3 control-label">Domain Addons</label>

                                     <div class="col-md-6">
                                     	<div class="xss-margin"></div>
                                     	<div class="checkbox-list" name="list-select-all">
                                        	<label><input id="inlineCheckbox1" name="select-all" type="checkbox" value="option5"/>&nbsp; Select all</label>
                                            <label><input id="inlineCheckbox1" type="checkbox" value="option6"/>&nbsp; DNS Management</label>
                                            <label><input id="inlineCheckbox1" type="checkbox" value="option7"/>&nbsp; Email Forwarding</label>
                                            <label><input id="inlineCheckbox1" type="checkbox" value="option7"/>&nbsp; ID Protection</label>

                                         </div>
                                     </div>
                                  </div>

                                  <div class="table-responsive mtl">
                                    <table class="table table-hover table-striped">
                                      <thead>

                                        <tr>
                                          <th>Domain Pricing (RM)</th>
                                          <th>1 Year</th>
                                          <th>2 Years</th>
                                          <th>3 Years</th>
                                          <th>4 Years</th>
                                          <th>5 Years</th>
                                          <th>6 Years</th>
                                          <th>7 Years</th>
                                          <th>8 Years</th>
                                          <th>9 Years</th>
                                          <th>10 Years</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      	<tr>
                                        	<td>Sale Price (1-5)</td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                         </tr>
                                         <tr>
                                            <td>List Price (1-5)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                         </tr>
                                         <tr>
                                        	<td>Sale Price (6-20)</td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                         </tr>
                                         <tr>
                                            <td>List Price (6-20)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                         </tr>
                                         <tr>
                                        	<td>Sale Price (21-49)</td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                         </tr>
                                         <tr>
                                            <td>List Price (21-49)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                         </tr>
                                         <tr>
                                        	<td>Sale Price (50-100)</td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                         </tr>
                                         <tr>
                                            <td>List Price (50-100)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                         </tr>
                                         <tr>
                                        	<td>Sale Price (101-200)</td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                         </tr>
                                         <tr>
                                            <td>List Price (101-200)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                         </tr>
                                         <tr>
                                        	<td>Sale Price (201-500)</td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                            <td><input type="text" class="form-control text-red"></td>
                                         </tr>
                                         <tr>
                                            <td>List Price (201-500)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                         </tr>
                                       </tbody>
                                       <tfoot>
                                        <tr colspan="11"></tr>
                                       </tfoot>
                           			</table>
                                 </div><!-- end table responsive -->

                                  <div class="form-actions">
                                    <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL Add New Pricing transfer -->
                      <!--Modal delete selected items start-->
                      <div id="modal-delete-selected-transfer" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                            </div>
                            <div class="modal-body">
                              <p>.com (1-5)</p>
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- modal delete selected items end -->
                      <!--Modal delete all items transfer start-->
                      <div id="modal-delete-all-transfer" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
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
                          <!-- modal delete all items transfer end -->

                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
                    <div class="portlet-body">

                      <div class="form-inline pull-left">
                        <div class="form-group">
                          <select name="select" class="form-control">
                            <option>10</option>
                            <option>20</option>
                            <option>30</option>
                            <option>50</option>
                            <option selected="selected">100</option>
                          </select>
                          &nbsp;
                          <label class="control-label">Records per page</label>
                        </div>
                      </div>

                      <div class="clearfix"></div>

                      <div class="table-responsive mtl">
                        <table class="table table-hover table-striped">
                          <thead>
                          	<tr>
                            	<th></th>
                                <th></th>
                                <th></th>
                                <th colspan="10"><div class="alicent">Per Year Pricing (RM)</div></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                              <th width="1%"><input type="checkbox" /></th>
                              <th>.com</th>
                              <th>1 Year</th>
                              <th>2 Years</th>
                              <th>3 Years</th>
                              <th>4 Years</th>
                              <th>5 Years</th>
                              <th>6 Years</th>
                              <th>7 Years</th>
                              <th>8 Years</th>
                              <th>9 Years</th>
                              <th>10 Years</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><input type="checkbox"/></td>
                              <td>1-5</td>
                              <td><span class="text-red">9.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">38.49*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">55.59*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="label label-xs label-success">Active</span></td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price-transfer" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-price-transfer" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                              <!--Modal Edit Pricing transfer start-->
                              <div id="modal-edit-price-transfer" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                <div class="modal-dialog modal-wide-width">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                      <h4 id="modal-login-label3" class="modal-title">Edit Pricing</h4>
                                    </div>
                                    <div class="modal-body">
                                      <div class="form">
                                        <form class="form-horizontal">
										{{csrf_field()}}
                                          <div class="form-group">
                                            <label class="col-md-3 control-label">Status</label>
                                            <div class="col-md-6">
                                              <div data-on="success" data-off="primary" class="make-switch">
                                                <input type="checkbox" checked="checked"/>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label class="col-md-3 control-label">TLD <span class="text-red">*</span></label>
                                            <div class="col-md-6">
                                              <input type="text" class="form-control" placeholder="eg .com" value=".com">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                             <label class="col-md-3 control-label">EPP Code <span class="text-red">*</span></label>

                                             <div class="col-md-6">
                                                <div class="xss-margin"></div>
                                                <div class="checkbox-list">
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option1" checked="checked"/>&nbsp; Enabled</label>
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option2"/>&nbsp; Disabled</label>
                                                 </div>
                                             </div>
                                          </div>

                                          <div class="form-group">
                                             <label class="col-md-3 control-label">Domain Addons</label>

                                             <div class="col-md-6">
                                                <div class="xss-margin"></div>
                                                <div class="checkbox-list">
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option5"/>&nbsp; Select all</label>
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option6"/>&nbsp; DNS Management</label>
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option7"/>&nbsp; Email Forwarding</label>
                                                    <label><input id="inlineCheckbox1" type="checkbox" value="option7"/>&nbsp; ID Protection</label>

                                                 </div>
                                             </div>
                                          </div>

                                          <div class="table-responsive mtl">
                                            <table class="table table-hover table-striped">
                                              <thead>

                                                <tr>
                                                  <th>Domain Pricing (RM)</th>
                                                  <th>1 Year</th>
                                                  <th>2 Years</th>
                                                  <th>3 Years</th>
                                                  <th>4 Years</th>
                                                  <th>5 Years</th>
                                                  <th>6 Years</th>
                                                  <th>7 Years</th>
                                                  <th>8 Years</th>
                                                  <th>9 Years</th>
                                                  <th>10 Years</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                    <td>Sale Price (1-5)</td>
                                                    <td><input type="text" class="form-control text-red" value="9.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="38.49*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="55.59*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price (1-5)</td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>Sale Price (6-20)</td>
                                                    <td><input type="text" class="form-control text-red" value="9.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="38.49*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="55.59*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price (6-20)</td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>Sale Price (21-49)</td>
                                                    <td><input type="text" class="form-control text-red" value="9.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="38.49*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="55.59*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price (21-49)</td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>Sale Price (50-100)</td>
                                                    <td><input type="text" class="form-control text-red" value="9.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="38.49*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="55.59*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price (50-100)</td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>Sale Price (101-200)</td>
                                                    <td><input type="text" class="form-control text-red" value="9.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="38.49*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="55.59*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price (101-200)</td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>Sale Price (201-500)</td>
                                                    <td><input type="text" class="form-control text-red" value="9.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="38.49*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="47.99*"></td>
                                                    <td><input type="text" class="form-control text-red" value="55.59*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                    <td><input type="text" class="form-control text-red" value="61.29*"></td>
                                                 </tr>
                                                 <tr>
                                                    <td>List Price (201-500)</td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                    <td><input type="text" class="form-control" value="69.99*"></td>
                                                 </tr>
                                               </tbody>
                                               <tfoot>
                                                <tr colspan="11"></tr>
                                               </tfoot>
                                            </table>
                                         </div><!-- end table responsive -->

                                          <div class="form-actions">
                                            <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--END MODAL edit pricing transfer -->
                                <!--Modal delete transfer start-->
                                <div id="modal-delete-price-transfer" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                            <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                          </div>
                                          <div class="modal-body">
                                            <p>.com (1-5)</p>
                                            <div class="form-actions">
                                              <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  <!-- modal delete price transfer end -->
                              </td>
                            </tr>
                            <tr>
                              <tr>
                              <td><input type="checkbox"/></td>
                              <td>6-20</td>
                              <td><span class="text-red">9.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">38.49*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">55.59*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="label label-xs label-success">Active</span></td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price-transfer" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-price-transfer" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> </td>
                            </tr>
                            <tr>
                              <tr>
                              <td><input type="checkbox"/></td>
                              <td>21-49</td>
                              <td><span class="text-red">9.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">38.49*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">55.59*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="label label-xs label-success">Active</span></td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price-renewal" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-price-renewal" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> </td>
                            </tr>
                            <tr>
                              <tr>
                              <td><input type="checkbox"/></td>
                              <td>50-100</td>
                              <td><span class="text-red">9.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">38.49*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">55.59*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="label label-xs label-success">Active</span></td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price-renewal" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-price-renewal" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> </td>
                            </tr>
                            <tr>
                              <tr>
                              <td><input type="checkbox"/></td>
                              <td>101-200</td>
                              <td><span class="text-red">9.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">38.49*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">55.59*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="label label-xs label-success">Active</span></td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price-renewal" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-price-renewal" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> </td>
                            </tr>
                            <tr>
                              <tr>
                              <td><input type="checkbox"/></td>
                              <td>201-500</td>
                              <td><span class="text-red">9.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">38.49*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">47.99*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">55.59*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="text-red">61.29*</span><br/><span class="strike">69.99*</span></td>
                              <td><span class="label label-xs label-success">Active</span></td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-price-renewal" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-price-renewal" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a> </td>
                            </tr>


                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="14"></td>
                            </tr>
                          </tfoot>
                        </table>
                        <div class="tool-footer text-right">
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
                      </div>
                      <div class="clearfix"></div>

                        <div class="clearfix"></div>
                      </div><!-- end table responsive -->


                    </div>
                  </div><!-- End portlet -->

                </div><!-- end transfers tab -->




              </div><!-- end all tabs -->



              <div class="clearfix"></div>

            </div><!-- end col-lg-12 -->

          </div><!-- end row -->

        </div>


<div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the ssselected <span id="count-seleted"></span> item(s)? </h4>
            </div>
            <div class="modal-body" id="delete-selected-body">
                <div id="delete-selected-body-information"></div>
                <p id="selected_zero" style="display:none" class="alert alert-danger">Please select aleast one item for delete</p>
                <div class="form-actions" id="delete-selected-buttons">
                    <div class="col-md-offset-4 col-md-8"> <button type="button" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal delete selected items end -->

<div id="modal-upload-image" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-wide-width " id="modal-upload-image-body">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-login-label3" class="modal-title">Upload Menu Image(s) <i class="loading_icon fa fa-spinner fa-spin fa-large"></i></h4>
            </div>
            <div class="modal-body">
                <div id="msg_error" class="alert alert-danger alert-dismissable">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                    <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                    <p>The information has not been saved/updated. Please correct the errors.</p>
                </div>
                <div class="form">
                    <form class="form-horizontal" id="bulk_doman_form1" enctype="multipart/form-data" method="POST" action="/admin/bulk_domain/">
                        {{csrf_field()}}
                        <input type="hidden" id="upload_category_id" name="category_id">
                        <div id="upload_section">

                        </div>
                        <div class="form-group">
                            <label class="col-md-3"></label>
                            <div class="col-md-6">
                                <a href="javascript:void" class="btn-sm btn-success" onclick="add_more_images()">Add More Image &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-actions">
                            <div class="col-md-offset-5 col-md-8"> <button  class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp; <a id="modal-upload-image-cancelbtn" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div id="upload_content_section" hidden="">
    <div id="upload_container_1">

        <div id="statusdiv" class="form-group">
            <label class="col-md-3 control-label">Status</label>
            <div class="col-md-6">
                <div data-on="success" data-off="primary" class="make-switch-id" onclick="changemyclass()">
                    <input name="upload_status[]" class="imgstatus" type="checkbox" checked="checked"/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Upload Menu Image <span class="text-red">*</span></label>
            <div class="col-md-9">
                <div class="text-15px margin-top-10px"> <img width="80px" src="../images/menu/img_hosting1.jpg" alt="" class="upload_images img-responsive"><br/>
                    <a href="javascript:void" class="delete_image_button" data-hover="tooltip"  data-placement="top" title="Delete" ></a>
                    <div class="xs-margin"></div>
                    <input id="exampleInputFile2" name="upload_images[]"  class="upload_images_browse" type="file"/>
                    <br/>
                    <span class="help-block">(Image dimension: 663 x 464 pixels, JPEG, GIF, PNG only, Max. 1MB) </span> </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Image Alt Text</label>
            <div class="col-md-6">
                <input type="text"  name="upload_alt_text[]"  class="upload_alt_text form-control" placeholder="" >
                <input type="hidden"  name="id[]"  class="id form-control" placeholder="" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Start Date to End Date</label>
            <div class="col-md-6">
                <div class="input-group input-daterange">
                    <input type="text" name="upload_start_date[]" class="upload_start_date form-control" placeholder="mm/dd/yyyy"/>
                    <span class="input-group-addon">to</span>
                    <input type="text" name="upload_end_date[]" class="upload_end_date form-control" placeholder="mm/dd/yyyy"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Display Order <span class="text-red">*</span></label>
            <div class="col-md-2">
                <input type="text" name="upload_display_order[]"  class="upload_display_order form-control" placeholder="" value="1">
            </div>
            <div class="col-md-9 pull-right"> <span class="help-block">Display order is to determine the item appearing sequence in the website.</span> </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Upload Enlarge Banner or</label>
            <div class="col-md-9">
                <p class="text-blue margin-top-10px border-bottom">Please choose <strong>ONE</strong> of the following options when clicking on the banner for enlarge/detailed view.</p>
                <div class="text-15px margin-top-10px"> <img width="80px" src="../images/menu/img_hosting1.jpg" alt="Cyber Monday" class="upload_banner img-responsive"><br/>
                    <a href="javascript:void" data-hover="tooltip" class="delete_baner_button" data-placement="top" title="Delete" ><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>


                    <!-- modal delete end -->
                    <div class="xs-margin"></div>
                    <input id="exampleInputFile2" class="upload_images_browse"  name="upload_banner[]"  type="file"/>
                    <br/>
                    <span class="help-block">(JPEG/GIF/PNG only, Max. 2MB) </span> </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Upload PDF or</label>
            <div class="col-md-9">
                <div class="margin-top-5px"></div>
                <a href="filename.pdf" class="pdf_path" target="_blank">filename.pdf</a><br/>
                <a href="javascript:void" data-hover="tooltip" data-placement="top" title="Delete" class="delete_pdf_button"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>

                <div id="modal-delete-pdf" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this PDF? </h4>
                            </div>
                            <div class="modal-body">
                                <p>filename.pdf</p>
                                <div class="form-actions">
                                    <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal delete end -->
                <div class="xs-margin"></div>
                <div class="text-15px margin-top-10px">
                    <input id="exampleInputFile2" class="upload_pdf_browse"  name="upload_pdf[]"  type="file"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Website URL</label>
            <div class="col-md-6">
                <div class="input-icon"><i class="fa fa-link"></i>
                    <input type="text"  name="upload_web_url[]"  placeholder="http://" class="form-control" value="http://www.webqom.com"/>
                    <span class="help-block">Please enter the page link to link it to the sub page.</span> </div>
            </div>
        </div>



        <div class="clearfix border-bottom"></div>
        <div class="xs-margin"></div>
    </div>
</div>

<div id="modal-delete-file" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this <span id="delete_label"></span>? </h4>
                <span hidden="" id="category_image_id"></span>
                <span hidden="" id="category_image_type"></span>
            </div>
            <div class="modal-body">
                <div class="form-actions">
                    <div class="col-md-offset-4 col-md-8"> <a href="javascript:void" onclick="delete_category_img_post()" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a  data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="makesw_response"></div>
<?php $URL = url('');?>
@endsection
@section('custom_scripts')
<link type="text/css" rel="stylesheet" href="{{url('').'/resources/assets/admin/'}}vendors/jquery-nestable/nestable.css">
<script src="{{url('').'/resources/assets/admin/'}}vendors/ckeditor/ckeditor.js"></script>
<script src="{{url('').'/resources/assets/admin/'}}js/ui-tabs-accordions-navs.js"></script>
<script src="{{url('').'/resources/assets/admin/'}}vendors/jquery-nestable/jquery.nestable.js"></script>
<script src="{{url('').'/resources/assets/admin/'}}js/ui-nestable-list.js"></script>
<link type="text/css" rel="stylesheet" href="{{url('').'/resources/assets/admin/'}}vendors/bootstrap-datepicker/css/datepicker.css">
<script src="{{url('').'/resources/assets/admin/'}}vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!-- webqom frontend style css -->

<link type="text/css" rel="stylesheet" href="{{url('').'/resources/assets/admin/'}}css/shortcodes.css">

<script type="text/javascript">

 function update_sub_cat(page) {

	$.ajax({
			url: base_url + '/admin/bulk_domain/update/' + page,
					type: 'POST',
					data: $('#myform1').serialize()
			})

		.done(function(response) {


			location.reload();
		}).fail(function(response) {

			validation_errors = response.responseJSON;
					console.log(validation_errors);
					$.each(validation_errors, function(k, v) {
					//display the key and value pair
					//console.log(k + ' is ' + v);
					$('#' + id + '_error_edit_' + k).html(v)

					});
			})
		.always(function() {

		console.log("complete");
		});
	}

	function add_sub_cat(page) {



		$.ajax({
			url: base_url + '/admin/bulk_domain/add',
					type: 'POST',
					data: $('#bulk_doman_form2').serialize(),

			})

			.done(function(response) {

				location.reload();
			}).fail(function(response) {

				validation_errors = response.responseJSON;
						console.log(validation_errors);
						$.each(validation_errors, function(k, v) {
						//display the key and value pair
						//console.log(k + ' is ' + v);
						$('#' + id + '_error_edit_' + k).html(v)

						});
				})
			.always(function() {

			console.log("complete");
			});
		}


page_url=base_url+'/web88/admin/bulk_domain/';
function per_page_change() {
per_page=$("#per_page_select").find(":selected").val();

window.location.href=page_url+per_page;
}

function open_modal_delete_selected() {
	$('#delete-selected-body-information').html("");

	$("#modal-delete-selected").modal('show');
	var selected=$('input[name="bdp_id[]"]:checked').length;

	if (selected<1) {
	$('#selected_zero').show();

	$('#delete-selected-buttons').hide();
	}else{
	/*get seleccted users details*/


	$('#selected_zero').hide()
	$('#delete-selected-buttons').show();
	$('#count-seleted').html(selected);


	/*End*/

	}
}



function delete_all() {

$.ajax({
url:base_url+'/admin/bulk_domain/delete_all',
type: 'POST',
data: {'_token': csrf_token},
})
.done(function(response) {

	location.reload();
})
.fail(function() {

console.log("error");
})
.always(function() {
console.log("complete");
});

}

$(document).on('click', '#delete_bulk', function(event) {

	var selected=$('input[name="bdp_id[]"]:checked').length;
	var url = base_url + '/admin/bulk_domain/delete_selected';


	event.preventDefault();
	if (selected<1) {

	$('#delete-selected-body-information').prepend('<p class="alert alert-danger">Please select items</p>');

	}else{

	$('#delete_bulk').attr("disabled",true);

	$.ajax({
			url: base_url + '/admin/bulk_domain/delete_selected',
					type: 'POST',
					data: $('#delete_form').serialize()
			})

			.done(function(response) {

				location.reload();
			}).fail(function(response) {

				$('#modal-delete-selected').modal('hide');
		alert("Error: no client was selected to delete");
				})
			.always(function() {
				$('#delete_bulk').attr("disabled",false);
			});






	}

});

// function triggerChange(){
//     $("input[name*='select-all']").trigger("change");
// }

// $("input[name*='select-all']").change(function() {
//    alert("triggered!");
// });
$('[name="select-all"]').change(function() {
  if(this.checked){
$('input', $('[name="list-select-all"]')).each(function () {
    this.checked = true; //log every element found to console output
});
  }else{
$('input', $('[name="list-select-all"]')).each(function () {
    this.checked = false; //log every element found to console output
});
  }
});

// triggerChange();

</script>
    @endsection
