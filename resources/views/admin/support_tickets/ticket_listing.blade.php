<?php $page = 'Tickets'; ?>
@extends('layouts.admin_layout')
@section('title','Admin | Tickets- List')
@section('content')
@section('page_header','Tickets')
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Support Tickets <i class="fa fa-angle-right"></i> Listing</h2>
              <div class="clearfix"></div>
              <div style="display:none" class="alert alert-success alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                <p>The information has been saved/updated successfully.</p>
              </div>
              <div style="display:none" class="alert alert-danger alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                <p>The information has not been saved/updated. Please correct the errors.</p>
              </div>
              <div class="pull-left" style="display:none"> Last updated: <span class="text-blue">15 Sept, 2014 @ 12.00PM</span> </div>
              <div class="clearfix"></div>
              <p></p>
              <div class="clearfix"></div>
            </div>
            @if ( Session::has('success'))
            <!-- end col-lg-12 -->
            <div class="col-md-12" hidden="">
              <div class="portlet portlet-blue">
                <div class="portlet-header">
                  <div class="caption text-white">Search/Filter</div>
                  <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                </div>
                <div class="portlet-body">
                  <form method="get" id="actions_search" action="support_tickets">
					  <input type="hidden" name="sortBy" value="{{$sortBy}}">
					  <input type="hidden" name="sort" value="{{$sort}}">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-md-4 control-label">Ticket # </label>
                        <div class="col-md-8">
                          <input type="text" name="ticket_id" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label">Department </label>
                        <div class="col-md-8">
                          <select  name="department" class="form-control">
                            <option value="0">- Please select -</option>
                            <option value="3">Billing</option>
                            <option value="1">Sales</option>
                            <option value="2">Technical</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label">Status </label>
                        <div class="col-md-8">
                          <select name="status" class="form-control">
                            <option>- Please select -</option>
                            <option value="Open">Open</option>
                            <option value="Answered">Answered</option>
                            <option value="Client-Reply">Client-Reply</option>
                            <option value="Closed">Closed</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label">Subject </label>
                        <div class="col-md-8">
                          <input type="text" name="subject" class="form-control">
                        </div>
                      </div>
                    </div>
                    <!-- end col-md 6 -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-md-4 control-label">Client ID </label>
                        <div class="col-md-8">
                          <input type="text" name="client_id" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label">Client Name </label>
                        <div class="col-md-8">
                          <input type="text" name="client_name" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" name="email">Email Address </label>
                        <div class="col-md-8">
                          <input type="text" name="client_email" class="form-control">
                        </div>
                      </div>
                    </div>
                    <!-- end col-md 6 -->
                    <div class="clearfix"></div>
                    <!-- save button start -->
                    <div class="form-actions_search text-center"> <a href="javascript:search_filter()" class="btn btn-red">Search &nbsp;<i class="fa fa-search"></i></a> </div>
                    <!-- save button end -->
                  </form>
                </div>
                <!-- end portlet-body -->
              </div>
              <!-- end portlet -->
            </div>
            <!-- end col-md-6 -->
            @else
              <!-- end col-lg-12 -->
            <div class="col-md-12">
              <div class="portlet portlet-blue">
                <div class="portlet-header">
                  <div class="caption text-white">Search/Filter</div>
                  <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                </div>
                <div class="portlet-body">
                  <form method="get" id="actions_search" action="support_tickets">
            <input type="hidden" name="sortBy" value="{{$sortBy}}">
            <input type="hidden" name="sort" value="{{$sort}}">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-md-4 control-label">Ticket # </label>
                        <div class="col-md-8">
                          <input type="text" name="ticket_id" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label">Department </label>
                        <div class="col-md-8">
                          <select  name="department" class="form-control">
                            <option value="0">- Please select -</option>
                            <option value="3">Billing</option>
                            <option value="1">Sales</option>
                            <option value="2">Technical</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label">Status </label>
                        <div class="col-md-8">
                          <select name="status" class="form-control">
                            <option>- Please select -</option>
                            <option value="Open">Open</option>
                            <option value="Answered">Answered</option>
                            <option value="Client-Reply">Client-Reply</option>
                            <option value="Closed">Closed</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label">Subject </label>
                        <div class="col-md-8">
                          <input type="text" name="subject" class="form-control">
                        </div>
                      </div>
                    </div>
                    <!-- end col-md 6 -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-md-4 control-label">Client ID </label>
                        <div class="col-md-8">
                          <input type="text" name="client_id" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label">Client Name </label>
                        <div class="col-md-8">
                          <input type="text" name="client_name" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" name="email">Email Address </label>
                        <div class="col-md-8">
                          <input type="text" name="client_email" class="form-control">
                        </div>
                      </div>
                    </div>
                    <!-- end col-md 6 -->
                    <div class="clearfix"></div>
                    <!-- save button start -->
                    <div class="form-actions_search text-center"> <a href="javascript:search_filter()" class="btn btn-red">Search &nbsp;<i class="fa fa-search"></i></a> </div>
                    <!-- save button end -->
                  </form>
                </div>
                <!-- end portlet-body -->
              </div>
              <!-- end portlet -->
            </div>
            <!-- end col-md-6 -->
            @endif
            
            <div class="col-lg-12">
              	@if ( Session::has('success'))
              <div class="alert alert-success">
                 <b>{{ Session::get('success') }}</b> 
              </div>
            @endif 
              @if ( Session::has('status'))
              <div class="alert alert-success">
                 <b>{{ Session::get('status') }}</b> 
              </div>
            @endif
            @if ( Session::has('success1'))
              <div class="alert alert-success">
                 <b>{{ Session::get('success1') }}</b> 
              </div>
            @endif    
                <ul id="myTab" class="nav nav-tabs">
                    <li class=" {{Session::has('seu')?'':'active'}}" ><a href="#support-tickets-listing" data-toggle="tab">Support Tickets Listing</a></li>
                    <li class=" {{Session::get('type') == 1 ?'active':''}}" ><a href="#service-enquiry-listing" data-toggle="tab">Service Enquiry Listing</a></li>
                    <li class="{{Session::get('type') == 2 ?'active':''}}"><a href="#ask-for-quote" data-toggle="tab">Ask For Quote Listing</a></li>
                </ul>
              
              <div id="myTabContent" class="tab-content">
              
                  <div id="support-tickets-listing" class="tab-pane fade {{Session::has('seu')?'':'in active'}} ">
                
                      <div class="portlet">
                        <div class="portlet-header">
                          <div class="caption">Support Tickets Listing</div>
<br>        
                          <p class="margin-top-10px"></p>
                          <a href="#" class="btn btn-success" data-target="#modal-open-new" data-toggle="modal">Open New Ticket &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary">Delete</button>
                            <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                            <ul role="menu" class="dropdown-menu">
								<!--data-target="#modal-delete-selected"-->
                              <li><a href="javascript:void(0)" onclick="openModel('single')"  data-toggle="modal">Delete selected item(s)</a></li>
                              <li class="divider"></li>
                              <li><a href="javascript:void(0)" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                            </ul>
                          </div>
                           
						<div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                          <!--Modal open new ticket start-->
							<div id="modal-open-new" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-wide-width">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label3" class="modal-title">Open New Ticket</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="form">
									  
                                    <form class="form-horizontal" method="post" id="gsr-contact" name='frm_open_new' action="store" enctype="multipart/form-data">
										{{csrf_field()}}
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="hidden"   value="Open" id="stausInput" >
											<div class="btn-group">
											   <button type="button"id="statusDrop" class="btn btn-success">Open</button>
											   <button type="button" id="statusDrop2" data-toggle="dropdown" class="btn btn-success dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
											   <ul role="menu" class="dropdown-menu">
												  <li><a href="javascript:update_status('Open', 'btn-success')">Open</a></li>
												  <li><a href="javascript:update_status('Answered', 'btn-danger')">Answered</a></li>
												  <li><a href="javascript:update_status('Client-Reply', 'btn-warning')">Client-Reply</a></li>
												  <li><a href="javascript:update_status('Closed', 'btn-default')">Closed</a></li>
											   </ul>  
										   </div>
                                         </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Account Type <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <select name="account_type" autocomplete="off" id="accnt_type" class="form-control">
                                            <option selected="selected">- Please select -</option>
                                            <option value="Business Account">Business Account</option>
                                            <option value="Individual Account">Individual Account</option>
                                            <option value="all">All</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Client ID &amp; Name <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <select required name="client_id" class="form-control">
                                            <option value="">- Please select -</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Company <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" name="company" autocomplete="off" readonly class="form-control">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Email Address <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" name="email" class="form-control">
                                          <input type="checkbox" name="send_email" autocomplete="off" readonly  checked="checked">
                                          Send Email </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">CC Recipients </label>
                                        <div class="col-md-6">
                                          <input type="text"  class="form-control">
                                          <div class="text-blue text-12px">(Comma separated)</div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Department <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                         <select name="department" required class="form-control">
											<option value="0">-- Please select --</option>
											<option value="1">Sales Department</option>
											<option value="2">Technical Support</option>
											<option value="3">Billing Department</option> 
										</select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Related Service <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <select name="related_service" required class="form-control">
											<option value="0">-- Please select --</option>
											<option value="1">Email Issues</option>
											<option value="2">Cloud Hosting</option>
											<option value="3">Co-location Hosting</option>
											<option value="4">Dedicated Servers</option> 
											<option value="5">Reseller Hosting</option>
											<option value="6">Shared Hosting</option>
											<option value="7">VPS Hosting</option>
											<option value="8">Business Partner Program</option>
											<option value="9">Domain</option>
											<option value="10">E-commerce</option>
											<option value="11">Email88</option>
											<option value="12">Mobile &amp; Web Apps</option>
											<option value="13">Responsive Web Design</option>
											<option value="14">SEO</option>
											<option value="15">Social Media</option>
											<option value="16">SSL</option>
											<option value="17">Web88 CMS</option>
											<option value="18">Web88IR</option>
										</select>
									   </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Priority <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                           <select name="priority" required class="form-control">
												<option value="1">High</option>
												<option value="2" selected="selected">Medium</option>
												<option value="3">Low</option> 
											</select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Domain <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" name="domain" required id="domain">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Subject <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <input class="form-control" type="text" name="subject" required id="subject">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Message <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                          <textarea class="form-control" name="message" id="message" required rows="12"></textarea>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">Attachments </label>
                                        <div class="col-md-6">
                                          <div id="append_div">
											<input id="exampleInputFile1"  name="attachment[]" type="file"/>
										</div>
										
									   
                                          <div class="xss-margin"></div>
                                          <div class="text-blue text-12px">(Allowed File Extensions: .jpg, .gif, .jpeg, .png)</div>
                                          <div class="xs-margin"></div>
                                          <a href="javascript:void(0)" id="addMoreUpload" class="btn-sm btn-success"><i class="fa fa-plus"></i> Add More</a>
                                        </div>
                                      </div>
                                      <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0)" class="submit_form btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--END MODAL open new ticket -->
                          <!--Modal delete selected items start-->
                          <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                </div>
                                <div class="modal-body">
                                  <!--p><strong>Ticket #:</strong> 499911<br/>
                                      <strong>Department:</strong> Technical Support<br/>
                                      <strong>Subject:</strong> I need help getting a sub domain created<br/>
                                      <strong>Client Name:</strong> Hock Lim </p-->
                                  <div class="form-actions">
                                    <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" class="btn btn-red btn_del_sel support">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                                    <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)"  class="btn btn-red btn_del_all support">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="javascript:void(0)"  data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                              <select name="limit" id="limit" class="form-control">
                                <option <?php echo ($limit ==10) ? 'selected="selected"' : ''; ?> value="10">10</option>
                                <option <?php echo ($limit ==20) ? 'selected="selected"' : ''; ?>value="20">20</option>
                                <option <?php echo ($limit ==30) ? 'selected="selected"' : ''; ?>value="30">30</option>
                                <option <?php echo ($limit ==50) ? 'selected="selected"' : ''; ?>value="50">50</option>
                                <option <?php echo ($limit ==100) ? 'selected="selected"' : ''; ?> value="100" >100</option>
                              </select>
                              &nbsp;
                              <label class="control-label">Records per page</label>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <?php
                          $sort = ($sort == 'desc') ? 'asc' : 'desc';
                          ?>
                          <div class="table-responsive mtl">
                            <table class="table table-hover table-striped">
                              <thead>
                                <tr>
                                  <th width="1%"><input class="all" type="checkbox"/></th>
                                  <th>#</th>
                                  <th><a href="?sortBy=ticket_id&sort={{$sort}}">Ticket #</a></th>
                                  <th><a href="?sortBy=department&sort={{$sort}}">Department</a></th>
                                  <th><a href="?sortBy=subject&sort={{$sort}}">Subject</a></th>
                                  <th><a href="?sortBy=client_id&sort={{$sort}}">Client ID</a></th>
                                  <th><a href="#?sortBy=first_name&sort={{$sort}}">Client Name</a></th>
                                  <th><a href="?sortBy=updated_at&sort={{$sort}}">Last Updated</a></th>
                                  <th><a href="?sortBy=status&sort={{$sort}}">Status</a></th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
								  <?php
									$dept_arr = array(
												1 => 'Sales Department',
												2 => 'Technical Support',
												3 => 'Billing Department'
											);
											
									$prior_arr = array(
												1 => 'High',
												2 => 'Medium',
												3 => 'Low'
											);
									
									$statusArrCls = array('Open' => 'label-success', 'Closed' => 'label-default', 'Answered' => 'label-danger', 'Client-Reply' => 'label-warning');
									?>
                               @if(isset($data))
                               @foreach($data as $k => $d)
                                <tr>
                                  <td><input class="single" name="selected[]" value="{{$d->id}}" type="checkbox"/></td>
                                  <td>{{$k+1}}</td>
                                  <td>{{$d->ticket_id}}</td>
                                  <td>{{$dept_arr[$d->department]}}</td>
                                  <td>{{$d->subject}}</td>
                                  <td><a href="clients/search_clients">{{$d->client_id}}</a></td>
                                  <td><a href="clients/search_clients">{{$d->first_name.' '.$d->last_name}}</a></td>
                                  <td>{{$d->created_date}}</td>
                                  <td><span class="label label-xs {{$statusArrCls[$d->status]}}">{{$d->status}}</span></td>
                                  <td><a href="reply?id={{$d->id}}" data-hover="tooltip" data-placement="top" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-4{{$d->ticket_id}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                      <!--Modal delete start-->
                                      <div id="modal-delete-4{{$d->ticket_id}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this ticket? </h4>
                                            </div>
                                            <div class="modal-body">
                                              <p><strong>Ticket #:</strong> {{$d->ticket_id}}<br/>
                                                  <strong>Department:</strong> {{$d->department}}<br/>
                                                  <strong>Subject:</strong> {{$d->subject}}<br/>
                                                  <strong>Client Name:</strong> {{$d->first_name.' '.$d->last_name}}</p>
                                              <div class="form-actions">
                                                <div class="col-md-offset-4 col-md-8"> <a href="deleteThis?id={{$d->id}}" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <!-- modal delete end -->
                                  </td>
                                </tr>
                                @endforeach
                                @endif
                              </tbody>
                              <tfoot>
                                <tr>
                                  <td colspan="10"></td>
                                </tr>
                              </tfoot>
                            </table>
                              <?php $i = (($data->currentPage() - 1)*$limit)+1;?>
						@if($data->total()>0)
                            <div class="tool-footer text-right">
                              <p class="pull-left">Showing {{$i}} to {{($data->total()>$i+($limit-1)) ? $i+($limit-1) : $data->total()}} of {{$data->total()}} entries</p>
                              <ul class="pagination pagination mtm mbm">
                                <li class="{{ ($data->currentPage() == 1) ? ' disabled' : '' }}"><a href="{{$data->previousPageUrl()}}">&laquo;</a></li>
                               @for ($i = 1; $i <= $data->lastPage(); $i++)
                                <li class="{{ ($data->currentPage() == $i) ? 'active' : '' }}"><a href="{{ $data->url($i) }}">{{$i}}</a></li>
                               @endfor
                                <li class="{{ ($data->currentPage() == $data->lastPage()) ? ' disabled' : '' }}"><a href="{{$data->nextPageUrl()}}">&raquo;</a></li>
                              </ul>
                            </div>
                         @else
                         <p>No Records found.</p>
                         @endif
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                      
                      <!-- end portlet -->
                  </div><!-- end tab support tickets listing -->
              
              
                  <div id="service-enquiry-listing" class="tab-pane fade {{Session::get('type') == 1 ?'in active':''}}">
                     <div class="portlet">
                        <div class="portlet-header">
                          <div class="caption">Services Enquiry Listing</div>
                         <br /><p class="margin-top-10px"></p>
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary">Delete</button>
                            <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                            <ul role="menu" class="dropdown-menu">
                              <li><a href="#"  onclick="openModel('single2')" data-toggle="modal">Delete selected item(s)</a></li>
                              <li class="divider"></li>
                              <li><a href="#" data-target="#modal-delete-all-1" data-toggle="modal">Delete all</a></li>
                            </ul>
                          </div> 
                          <a href="http://sale.webqom.com/admin/services/enquiry/export/csv" class="btn btn-blue">Export to CSV &nbsp;<i class="fa fa-share"></i></a>
                           
                          <div class="tools"> <i class="fa fa-chevron-up"></i>                  </div>
                          <!--Modal delete selected items start-->
                          <div id="modal-delete-selected-1" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                </div>
                                <div class="modal-body">
                                  <div class="form-actions">
                                    <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" class="btn btn-red btn_del_sel service">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- modal delete selected items end -->
                          <!--Modal delete all items start-->
                          <div id="modal-delete-all-1" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                                </div>
                                <div class="modal-body">
                                  <div class="form-actions">
                                    <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red btn_del_all service">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                               <select name="limit" id="limit2" class="form-control">
                                <option <?php echo ($limit2 ==10) ? 'selected="selected"' : ''; ?> value="10">10</option>
                                <option <?php echo ($limit2 ==20) ? 'selected="selected"' : ''; ?>value="20">20</option>
                                <option <?php echo ($limit2 ==30) ? 'selected="selected"' : ''; ?>value="30">30</option>
                                <option <?php echo ($limit2 ==50) ? 'selected="selected"' : ''; ?>value="50">50</option>
                                <option <?php echo ($limit2 ==100) ? 'selected="selected"' : ''; ?> value="100" >100</option>
                              </select>
                              &nbsp;
                              <label class="control-label">Records per page</label>
                            </div>
                          </div>
                          <div class="clearfix"></div>
						<?php
                          $sort2 = ($sort2 == 'desc') ? 'asc' : 'desc';
                          ?>
                          <div class="table-responsive mtl">
                              <table class="table table-hover table-striped">
                                <thead>
                                  <tr>
									<th width="1%"><input class="all2" type="checkbox"/></th>
                                    <th><a href="?sortBy2=id&sort={{$sort2}}">Service Enquiry #</a></th>
                                    <th><a href="?sortBy2=message&sort={{$sort2}}">Message</a></th>
                                    <th><a href="?sortBy2=name&sort={{$sort2}}">Client Name</a></th>
                                    <th><a href="?sortBy2=company&sort={{$sort2}}">Company</a></th>
                                    <th><a href="?sortBy2=website&sort={{$sort2}}">Website</a></th>
                                    <th><a href="?sortBy2=service&sort={{$sort2}}">Related Service</a></th>
                                    <th><a href="?sortBy2=updated_at&sort={{$sort2}}">Last Updated</a></th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
								@foreach($data2 as $dt2)
                                  <tr>
									<td><input class="single2" name="selected[]" value="{{$dt2->id}}" type="checkbox"/></td>
                                    <td><a href="/admin/services/enquiry/edit/{{$dt2->id}}">{{$dt2->id}}</a></td>
                                    <td>{{$dt2->message}}</td>
                                    <td>{{$dt2->name}}</td>
                                    <td>{{$dt2->company}}</td>
                                    <td>{{$dt2->website}}</td>
                                    <td>{{$dt2->service}}</td>
                                    <td>{{$dt2->updated_at}}</td>
                                    <td><a href="/admin/services/enquiry/edit/{{$dt2->id}}" data-hover="tooltip" data-placement="top" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{$dt2->id}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                       
                                        <!--Modal delete start-->
                                        <div id="modal-delete-{{$dt2->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this enquiry? </h4>
                                              </div>
                                              <div class="modal-body">
                                                <p><strong>{{$dt2->id}}</strong> {{$dt2->name}}<br/>
                                                <strong>Company:</strong> {{$dt2->company}} <br/>
                                                <strong>Website:</strong> {{$dt2->website}} <br/>
                                                <strong>Related Service:</strong>{{$dt2->service}}</p>
                                                <div class="form-actions">
                                                  <div class="col-md-offset-4 col-md-8"> <a href="/admin/dele_service?id={{$dt2->id}}" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                      <!-- modal delete end -->                            
                                      </td>
                                  </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <td colspan="11"></td>
                                  </tr>
                                </tfoot>
                              </table>
                             @if($data2->total()>0)
                               <?php $i = (($data2->currentPage() - 1)*$limit2)+1;?>
                              <div class="tool-footer text-right">
								<p class="pull-left">Showing {{$i}} to {{($data2->total()>$i+($limit2-1)) ? $i+($limit2-1) : $data2->total()}} of {{$data2->total()}} entries</p>
                         
                              <ul class="pagination pagination mtm mbm">
                                <li class="{{ ($data2->currentPage() == 1) ? ' disabled' : '' }}"><a href="{{$data2->previousPageUrl()}}">&laquo;</a></li>
                               @for ($i = 1; $i <= $data2->lastPage(); $i++)
                                <li class="{{ ($data2->currentPage() == $i) ? 'active' : '' }}"><a href="{{ $data2->url($i) }}">{{$i}}</a></li>
                               @endfor
                                <li class="{{ ($data2->currentPage() == $data2->lastPage()) ? ' disabled' : '' }}"><a href="{{$data2->nextPageUrl()}}">&raquo;</a></li>
                              </ul>
                         @else
                         <p>No Records found.</p>
                         @endif
                            </div>
                              <div class="clearfix"></div>
                            </div>
                            <!-- end table responsive -->
                        </div>
                      </div>
                  
                  
                  </div><!-- end tab service enquiry listing -->
                  
                  <div id="ask-for-quote" class="tab-pane fade {{Session::get('type') == 2 ?'in active':''}}">
                     <div class="portlet">
                        <div class="portlet-header">
                          <div class="caption">Ask For Quote Listing</div>
                          <br /><p class="margin-top-10px"></p>
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary">Delete</button>
                            <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                            <ul role="menu" class="dropdown-menu">
                              <li><a href="#" onclick="openModel('single3')"  data-toggle="modal">Delete selected item(s)</a></li>
                              <li class="divider"></li>
                              <li><a href="#" data-target="#modal-delete-all-2" data-toggle="modal">Delete all</a></li>
                            </ul>
                          </div> 
                          <a href="http://sale.webqom.com/admin/services/enquiry/export/csv?type=2" class="btn btn-blue">Export to CSV &nbsp;<i class="fa fa-share"></i></a>
                           
                          <div class="tools"> <i class="fa fa-chevron-up"></i>                  </div>
                          <!--Modal delete selected items start-->
                          <div id="modal-delete-selected-2" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                </div>
                                <div class="modal-body">
                                 
                                  <div class="form-actions">
                                    <div class="col-md-offset-4 col-md-8"> <a href="javascript:void(0)" class="btn btn-red btn_del_sel ask">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- modal delete selected items end -->
                          
                          
                          <!--Modal delete all items start-->
                          <div id="modal-delete-all-2" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                  <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                                </div>
                                <div class="modal-body">
                                  <div class="form-actions">
                                    <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red btn_del_all ask">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                              <select name="limit" id="limit3" class="form-control">
                                <option <?php echo ($limit3 ==10) ? 'selected="selected"' : ''; ?> value="10">10</option>
                                <option <?php echo ($limit3 ==20) ? 'selected="selected"' : ''; ?>value="20">20</option>
                                <option <?php echo ($limit3 ==30) ? 'selected="selected"' : ''; ?>value="30">30</option>
                                <option <?php echo ($limit3 ==50) ? 'selected="selected"' : ''; ?>value="50">50</option>
                                <option <?php echo ($limit3 ==100) ? 'selected="selected"' : ''; ?> value="100" >100</option>
                              </select>
                              &nbsp;
                              <label class="control-label">Records per page</label>
                            </div>
                          </div>
                          <div class="clearfix"></div>
        <?php
                          $sort2 = ($sort3 == 'desc') ? 'asc' : 'desc';
                          ?>
                          <div class="table-responsive mtl">
                              <table class="table table-hover table-striped">
                                <thead>
                                  <tr>
                                    <th width="1%"><input class="all3" type="checkbox"/></th>
                                    <th><a href="?sortBy3=id&sort={{$sort3}}">Ask for Quote #</a></th>
                                    <th><a href="?sortBy3=message&sort={{$sort3}}">Message</a></th>
                                    <th><a href="?sortBy3=name&sort={{$sort3}}">Client Name</a></th>
                                    <th><a href="?sortBy3=company&sort={{$sort3}}">Company</a></th>
                                    <th><a href="?sortBy3=website&sort={{$sort3}}">Website</a></th>
                                    <th><a href="?sortBy3=service&sort={{$sort3}}">Related Service</a></th>
                                    <th><a href="?sortBy3=status&sort={{$sort3}}">Status</a></th>
                                    <th><a href="?sortBy3=updated_at&sort={{$sort3}}">Last Updated</a></th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
								@foreach($data3 as $dt3)
                                <tr>
                                    <td><input class="single3" name="selected[]" value="{{$dt3->id}}" type="checkbox"/></td>
                                    <td><a href="/admin/services/enquiry/edit/{{$dt3->id}}?type=2">{{$dt3->id}}</a></td>
                                    <td>{{$dt3->message}}</td>
                                    <td>{{$dt3->name}}</td>
                                    <td>{{$dt3->company}}</td>
                                    <td>{{$dt3->website}}</td>
                                    <td>{{$dt3->service}}</td>
                                    @if($dt3->status == 'inactive')
										<td><span class="label label-xs label-danger">Inacive</status></td>
                                    @else
										<td><span class="label label-xs label-success">Active</status></td>
									@endif
                                    <td>{{$dt3->updated_at}}</td>
                                    <td><a href="/admin/services/enquiry/edit/{{$dt3->id}}?type=2" data-hover="tooltip" data-placement="top" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-type2{{$dt3->id}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                       
                                        <!--Modal delete start-->
                                        <div id="modal-delete-type2{{$dt3->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this enquiry? </h4>
                                              </div>
                                              <div class="modal-body">
                                                <p><strong>{{$dt3->id}}</strong> {{$dt3->name}}<br/>
                                                <strong>Company:</strong> {{$dt3->company}} <br/>
                                                <strong>Website:</strong> {{$dt3->website}} <br/>
                                                <strong>Related Service:</strong>{{$dt3->service}}</p>
                                                <div class="form-actions">
                                                  <div class="col-md-offset-4 col-md-8"> <a href="/admin/dele_service?type=2&id={{$dt3->id}}" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                      <!-- modal delete end -->                            
                                      </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <td colspan="11"></td>
                                  </tr>
                                </tfoot>
                              </table>
                              <div class="tool-footer text-right">
						@if($data3->total()>0)
                                 <?php $i = (($data3->currentPage() - 1)*$limit3)+1;?>
								  <div class="tool-footer text-right">
								  <p class="pull-left">Showing {{$i}} to {{($data3->total()>$i+($limit3-1)) ? $i+($limit3-1) : $data3->total()}} of {{$data3->total()}} entries</p>
								  <ul class="pagination pagination mtm mbm">
									<li class="{{ ($data3->currentPage() == 1) ? ' disabled' : '' }}"><a href="{{$data3->previousPageUrl()}}">&laquo;</a></li>
								   @for ($i = 1; $i <= $data3->lastPage(); $i++)
									<li class="{{ ($data3->currentPage() == $i) ? 'active' : '' }}"><a href="{{ $data3->url($i) }}">{{$i}}</a></li>
								   @endfor
									<li class="{{ ($data3->currentPage() == $data3->lastPage()) ? ' disabled' : '' }}"><a href="{{$data3->nextPageUrl()}}">&raquo;</a></li>
								  </ul>
						@else
                         <p>No Records found.</p>
                         @endif
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <!-- end table responsive -->
                        </div>
                      </div>
                  
                  
                  </div><!-- end tab ask for quote -->
                  
                  
              </div><!-- end tab content --> 
              
              <!--Modal delete selected items start-->
                  <div id="modal-delete-selected-selt" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected <span id="count-seleted"></span> item(s)? </h4>
                        </div>
                        <div class="modal-body" id="delete-selected-body">
                        <div id="delete-selected-body-information"></div>
                          <p id="selected_zero" class="alert alert-danger">Please select at least one client for delete</p>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal delete selected items end -->
                  
              
            </div>
            <!-- end col-lg-12 -->
          </div>
          <!-- end row -->
        </div>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
        <script>
    			$(document).ready(function(){
    				$('.all').change(function(){
    					
    					if($(this).prop("checked") == true){
    						$('.single').prop('checked', true);
    					}else{
    						$('.single').prop('checked', false);
    					}
    				});
    				$('.all2').change(function(){
    					
    					if($(this).prop("checked") == true){
    						$('.single2').prop('checked', true);
    					}else{
    						$('.single2').prop('checked', false);
    					}
    				});
    				$('.all3').change(function(){
    					
    					if($(this).prop("checked") == true){
    						$('.single3').prop('checked', true);
    					}else{
    						$('.single3').prop('checked', false);
    					}
    				});
    				$('.single').change(function(){
    					if($(this).prop('checked') == false)
    					{
    						$('.all').prop('checked', false);
    					}
    				});
    				$('.single2').change(function(){
    					if($(this).prop('checked') == false)
    					{
    						$('.all2').prop('checked', false);
    					}
    				});
    				$('.single3').change(function(){
    					if($(this).prop('checked') == false)
    					{
    						$('.all3').prop('checked', false);
    					}
    				});
            $('.submit_form').click(function(){
              var flag = 1;
              $('.err-cls').removeClass('err-cls');
              $('.err-lbl').hide();
              if($('[name="email"]').val() == 0)
              {
                $('[name="email"]').parent('div').addClass('err-cls');
                flag = 0;
              }
              
              if($('[name="account_type"]').val() == 0)
              {
                $('[name="account_type"]').parent('div').addClass('err-cls');
                flag = 0;
              }
              if($('#gsr-contact [name="department"]').val() == 0)
              {
                $('#gsr-contact [name="department"]').parent('div').addClass('err-cls');
                flag = 0;
              }
              if($('[name="related_service"]').val() == 0)
              {
                $('[name="related_service"]').parent('div').addClass('err-cls');
                flag = 0;
              }
              if($('#gsr-contact [name="client_id"]').val() == 0)
              {
                $('[#gsr-contact name="client_id"]').parent('div').addClass('err-cls');
                flag = 0;
              }
              if($('[name="priority"]').val() == 0)
              {
                $('[name="priority"]').parent('div').addClass('err-cls');
                flag = 0;
              }
              if($('[name="domain"]').val().trim() == '')
              {
                $('[name="domain"]').addClass('err-cls');
                flag = 0;
              }
              //~ if($('#gsr-contact [name="subject"]:nth-child(2)').val().trim() == '')
              //~ {
                //~ $('#gsr-contact [name="subject"]:nth-child(2)').addClass('err-cls');
                //~ flag = 0;
              //~ }
              //~ if($('#gsr-contact [name="message"]').val().trim() == '')
              //~ {
                //~ $('#gsr-contact [name="message"]').addClass('err-cls');
                //~ flag = 0;
              //~ }
              if(flag == 1)
              {
                $('#gsr-contact').submit();
              }else{
                $('.err-lbl').show();
              }
              //
            });
            
            $('.form-actions_search').click(function(){
				$('#actions_search').submit();
			});
            
            $('#addMoreUpload').click(function(){
              if($('[name="attachment[]"]').length<=10)
              {
                str = '<input class="exampleInputFile1" name="attachment[]" type="file"/>';
                $('#append_div').append(str);
              }else{
                alert('Max 10 images can selected');
              }
            });
            
            $('#accnt_type').change(function(){
				var accType = $(this).val();
				$.ajax({
					url:'fetch_acct_type',
					data:{'search_key': accType},
					dataType: 'json',
					success:function(res){
							var str = '<option value="">Select Client ID</option>';
							for(i=0; i<res.length; i++){
								str += '<option data-val="'+res[i].email+'#'+res[i].company+' " value="'+res[i].client_id+'">'+res[i].first_name+res[i].last_name+' ('+res[i].client_id+')'+'</option>';
							}
							$('[name="client_id"]').html(str);
						}
					});
			});
			$('[name="client_id"]').change(function(){
				var current_val = $(this).val();
					current_val = $("[value='"+current_val+"']").attr('data-val');
				var curArr = current_val.split('#');
				$('[name="company"]').val(curArr[1]);
				$('[name="email"]').val(curArr[0]);
			});
			
			$('.btn_del_sel').click(function(){
				var selectedArr = [];
				if($(this).hasClass('support'))
				{
					$('.single:checked').each(function(){
						selectedArr.push($(this).val());
					});
					var type = 1;
				}
				if($(this).hasClass('service'))
				{
					$('.single2:checked').each(function(){
						selectedArr.push($(this).val());
					});
					var type = 2;
				}
				if($(this).hasClass('ask'))
				{
					$('.single3:checked').each(function(){
						selectedArr.push($(this).val());
					});
					var type = 3;
				}
				$.ajax({
					url:'/admin/multi_delete',
					data:{'data':selectedArr, 'type':type, 'mode': '1'},
					dataType:'JSON',
					success:function(result){
						window.location.href=window.location.href;
					},error:function(res){
						alert('error');
					}
				});
			});
			
			$('.btn_del_all').click(function(){
				var selectedArr = [];
				if($(this).hasClass('support'))
				{
					window.location.href='/admin/multi_delete?type=1&mode=2';
				}
				if($(this).hasClass('service'))
				{
					window.location.href='/admin/multi_delete?type=2&mode=2';
				}
				if($(this).hasClass('ask'))
				{
					window.location.href='/admin/multi_delete?type=3&mode=2';
				}
			});
			
			$('[name="limit"]').change(function(){
				
				var id = $(this).attr('id');
				window.location.href='/admin/support_tickets?'+id+'='+$(this).val();
			});
    	});
    			function function_del_all(res)
    			{
    				if(res == true)
    				{
    					var str = '';
    					$('.single:checked').each(function(){
    						if(str=='')
    						{
    							str = $(this).val();
    						}else{
    							str = str+'-'+$(this).val();
    						}
    					});
    					if(str != ''){
    						window.location.href="admin/support_tickets/deleteThis?deletall="+str;
    					}
    				}
    			}
    			function update_status(status, cls){
					$('#stausInput').val(status);
					$('#statusDrop').text(status);
					
					$('#statusDrop').removeClass();
					$('#statusDrop2').removeClass();
					$('#statusDrop').addClass(cls);
					$('#statusDrop2').addClass(cls);
					$('#statusDrop').addClass('btn');
					$('#statusDrop2').addClass('btn');
				}
				
				function search_filter(){
					$('#actions_search').submit();
				}
			function openModel(type)
			{
				if(type=='single'){
					var model = 'modal-delete-selected';
					var msg = 'Please select at least one Ticket for delete';
				}
				if(type=='single2'){
					var model = 'modal-delete-selected-1';
					var msg = 'Please select at least one Enquiry for delete';
				}
				if(type=='single3'){
					var model = 'modal-delete-selected-2';
					var msg = 'Please select at least one Quote for delete';
				}
				if($('.'+type+':checked').length >0){
					$('#'+model).modal('show');
				}else{
					$('#modal-delete-selected-selt').modal('show');
					$('#selected_zero').html(msg);
				}
			
			}
        </script>
<style>
  .err-cls {
    border: 2px solid red !important;
  }
  .err-lbl{
    color:red !important;
    text-align:center;
    display:none;
  }
  .form-control {
    margin-bottom: 10px !important;
}
</style>
@endsection
