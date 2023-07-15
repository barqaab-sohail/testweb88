<?php $page = 'Tickets'; ?>
@extends('layouts.admin_layout')
@section('title','Admin | Tickets- Reply')
@section('content')
@section('page_header','Tickets')
 <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Support Ticket <i class="fa fa-angle-right"></i> Edit</h2>
              <div class="clearfix"></div>
              <div style="display:none" class="alert alert-success alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                <p>The information has been saved/updated successfully.</p>
              </div>
              <div style="display:none"  class="alert alert-danger alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                <p>The information has not been saved/updated. Please correct the errors.</p>
              </div>
              
              <div class="pull-left"> Last updated: <span class="text-blue">15 Sept, 2014 @ 12.00PM</span> </div>
              <div class="clearfix"></div>
              <p></p>
              <div class="clearfix"></div>
              
              
              <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#client-info" data-toggle="tab">Add Reply</a></li>
              </ul>
              
              <div id="myTabContent" class="tab-content">
              	<div id="client-info" class="tab-pane fade in active">
                	<div class="invoice-title"><h2>Support Ticket</h2>
						<h3 class="pull-right">Ticket #: {{$ticket->ticket_id}}</h3>
                    </div>	
                	<div class="portlet">
                        <div class="portlet-header">
                          <div class="caption">Ticket Information</div>
                          <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                        </div><!-- end porlet header -->
                        
                        <div class="portlet-body">
                          <div class="row">
                          
                          	<form class="form-horizontal reply-ticket" id="rpl_tkt" method="POST" action="reply_store" enctype="multipart/form-data">
                                 {{csrf_field()}}
                                <input type="hidden" name="update_id" value="{{$ticket->id}}">
                                <div class="col-md-6">
                                 	  <div class="form-group">
                                            <label class="col-md-4 control-label">Subject:</label>
                                            <div class="col-md-8">
                                              <p class="form-control-static">{{$ticket->subject}}</p>
                                            </div>
                                      </div>
                                      <div class="form-group">
                                            <label class="col-md-4 control-label">Account Type:</label>
                                            <div class="col-md-8">
                                              <p class="form-control-static">{{$user->account_type}}</p>
                                            </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-4 control-label">Client ID: </label>
                                        <div class="col-md-8">
                                           <p class="form-control-static"><a href="client_edit.html">{{$ticket->client_id}}</a></p>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-4 control-label">Client Name: </label>
                                        <div class="col-md-8">
                                          <p class="form-control-static"><a href="client_edit.html">{{$user->first_name}} {{$user->last_name}}</a></p>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="col-md-4 control-label">Company: </label>
                                        <div class="col-md-8">
                                          <p class="form-control-static">{{$user->company}}</p>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                            <label class="col-md-4 control-label">Email Address</label>
                                            <div class="col-md-8">
                                               <p class="form-control-static">{{$userData->email}}</p>
                                               <input type="checkbox"  name="send_mail" checked="checked"> Send Email
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-4 control-label">CC Recipients </label>
                                            <div class="col-md-8">
                                              <input type="text" class="form-control">
                                              <div class="text-blue text-12px">(Comma separated)</div>
                                            </div>
                                          </div>
                                      
                                      
                                    </div><!-- end col-md 6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Status <span class="text-red">*</span></label>
                                            <div class="col-md-8">
                                                 <input type="hidden"  name="status"  value="{{$ticket->status}}" id="stausInput" >
                                                <div class="btn-group">
													<?php
													$cl = 'btn-success';
													if($ticket->status == 'Answered')
														$cl = 'btn-danger';
													if($ticket->status == 'Client-Reply')
														$cl = 'btn-warning';
													if($ticket->status == 'Closed')
														$cl = 'btn-default';
													?>
                                                   <button type="button"id="statusDrop" class="btn {{$cl}}">{{$ticket->status}}</button>
                                                   <button type="button" id="statusDrop2" data-toggle="dropdown" class="btn {{$cl}} dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
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
                                            <label class="col-md-4 control-label">Last Updated: </label>
                                            <div class="col-md-8">
                                               <p class="form-control-static">{{$ticket->updated_date}}</p>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-4 control-label">Department <span class="text-red">*</span></label>
                                            <div class="col-md-8">
                                              <select name="department" class="form-control">
                                                <option>- Please select -</option>
                                                <option {{($ticket->department == 1) ? 'selected="selected"': ''}} value="1">Sales Department</option>
                                                <option value="2" {{($ticket->department == 2) ? 'selected="selected"': ''}}>Technical Department</option>
                                                <option value="3" {{($ticket->department == 3) ? 'selected="selected"': ''}}>Billing Department</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-4 control-label">Related Service <span class="text-red">*</span></label>
                                            <div class="col-md-8">
                                               <select name="relative_services" class="form-control">
                                                    <option value="0">-- Please select --</option>
													<option  {{($ticket->relative_services == 1) ? 'selected="selected"': ''}} value="1">Email Issues</option>
													<option  {{($ticket->relative_services == 2) ? 'selected="selected"': ''}} value="2">Cloud Hosting</option>
													<option  {{($ticket->relative_services == 3) ? 'selected="selected"': ''}} value="3">Co-location Hosting</option>
													<option  {{($ticket->relative_services == 4) ? 'selected="selected"': ''}} value="4">Dedicated Servers</option> 
													<option  {{($ticket->relative_services == 5) ? 'selected="selected"': ''}} value="5">Reseller Hosting</option>
													<option  {{($ticket->relative_services == 6) ? 'selected="selected"': ''}} value="6">Shared Hosting</option>
													<option  {{($ticket->relative_services == 7) ? 'selected="selected"': ''}} value="7">VPS Hosting</option>
													<option  {{($ticket->relative_services == 8) ? 'selected="selected"': ''}} value="8">Business Partner Program</option>
													<option  {{($ticket->relative_services == 9) ? 'selected="selected"': ''}} value="9">Domain</option>
													<option  {{($ticket->relative_services == 10) ? 'selected="selected"': ''}} value="10">E-commerce</option>
													<option  {{($ticket->relative_services == 11) ? 'selected="selected"': ''}} value="11">Email88</option>
													<option  {{($ticket->relative_services == 12) ? 'selected="selected"': ''}} value="12">Mobile &amp; Web Apps</option>
													<option  {{($ticket->relative_services == 13) ? 'selected="selected"': ''}} value="13">Responsive Web Design</option>
													<option  {{($ticket->relative_services == 14) ? 'selected="selected"': ''}} value="14">SEO</option>
													<option  {{($ticket->relative_services == 15) ? 'selected="selected"': ''}} value="15">Social Media</option>
													<option  {{($ticket->relative_services == 16) ? 'selected="selected"': ''}} value="16">SSL</option>
													<option  {{($ticket->relative_services == 17) ? 'selected="selected"': ''}} value="17">Web88 CMS</option>
													<option  {{($ticket->relative_services == 18) ? 'selected="selected"': ''}} value="18">Web88IR</option>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-4 control-label">Priority <span class="text-red">*</span></label>
                                            <div class="col-md-8">
                                               <select name="priority" class="form-control">
                                                    <option {{($ticket->priority == 1) ? 'selected:"selected"' : ''}} value="1">High</option>
                                                    <option {{($ticket->priority == 2) ? 'selected:"selected"' : ''}} value="2">Medium</option>
                                                    <option {{($ticket->priority == 3) ? 'selected:"selected"' : ''}} value="3">Low</option> 
                                               </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="col-md-4 control-label">Domain <span class="text-red">*</span></label>
                                            <div class="col-md-8">
                                               <input type="text" name="domain" class="form-control" value="{{$ticket->domain}}">
                                            </div>
                                          </div>
                                          
                                    	</div><!-- end col-md-6 -->

                          </div><!-- end row -->
                        </div><!-- end porlet-body -->
                     </div><!-- end portlet -->
                    
                      <div class="portlet">
                        
                        <div class="portlet-header">
                          <div class="caption">Add Reply</div>
                          <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                        </div><!-- end porlet header -->
                           
                        <div class="portlet-body">
                          <div class="row">
 

                               	<div class="form-group">
                                	<label class="col-md-2 control-label">Reply Message </label>
                                    <div class="col-md-9">
                                       <textarea class="form-control" name="message" rows="5"></textarea>
                                    </div>
                                </div> 
                                <div class="form-group">
                               		<label class="col-md-2 control-label">Attachments </label>
                                    <div class="col-md-9">
                                    	<ul>
                                            <!--Modal delete start-->
                                              <div id="modal-delete-attachment" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                      <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this attachment? </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                      <p><a href="#link to file">reply.png</a></p>
                                                      <div class="form-actions">
                                                        <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            <!-- modal delete end -->  
                                        </ul>
                                       <div class="xs-margin"></div>
                                        <div id="append_div">
											<input id="exampleInputFile1"  name="attachment[]" type="file"/>
										</div>
									   
                                       <div class="xss-margin"></div>
                                       <div class="text-blue text-12px">(Allowed File Extensions: .jpg, .gif, .jpeg, .png)</div>
                                       <div class="xs-margin"></div>
											<a href="javascript:void(0)" id="addMoreUpload" class="btn-sm btn-success"><i class="fa fa-plus"></i> Add More</a>                                    </div>
                                </div>  
                                        

                                         
                             <div class="clearfix"></div>
                             </form>
                           
                          </div>
                          <!-- end row -->
                          <div class="md-margin"></div>    
                       </div><!-- end porlet-body -->   
                       <div class="clearfix"></div>
                       
                       
                       <div class="form-actions">
                       		<div class="col-md-offset-5 col-md-7"> <a href="javascript:submitFrm()" class="btn btn-red">Reply &nbsp;<i class="fa fa-reply"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                       </div>
                  </div><!-- End porlet -->
                </div><!-- end tab client info -->



              </div><!-- end tab content -->
            </div><!-- end col-lg-12 -->
          
            <div class="col-lg-12">
				@if(isset($threads) && !empty($threads))
				@foreach($threads as $thread)
				
				@if($thread->replied_by == 1)
            	<div class="panel panel-info">
                    <div class="ticket-reply staff">
                        <div class="date">Last updated: {{$thread->created_date}} 
                        	<div class="margin-top-5px"></div>
                        	<a href="javascript:update_reply({{$thread->id}})" style="display:none;" id="save_btn_{{$thread->id}}" class="btn-xs btn-blue">Save <i class="fa fa-save"></i></a>
                            <a href="javascript:edit_reply({{$thread->id}})" id="edit_btn_{{$thread->id}}" class="btn-xs btn-success">Edit <i class="fa fa-pencil"></i></a>
                            <a href="javascript:void(0)" class="btn-xs btn-danger" data-target="#modal-delete-reply{{$thread->id}}" data-toggle="modal">Delete <i class="fa fa-times"></i></a>
                            
                            <!--Modal delete ticket reply start-->
                              <div id="modal-delete-reply{{$thread->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                      <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this support ticket reply? </h4>
                                    </div>
                                    <div class="modal-body">
                                      <div class="form-actions">
                                        <div class="col-md-offset-4 col-md-8"> <a href="javascript:delete_reply({{$thread->id}})" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- modal delete ticket reply end -->
                              
                        </div>
                        <div class="user">
                            <img src="../images/submit_ticket/img_hock.jpg" alt="Webqom Technologies">
                            <span class="name">Webqom Support Team</span>
                            <span class="type">Staff</span>
                        </div>
                    </div>
                    
                    <div class="panel-body">
                        <p>{{$thread->msg}}</p>
                        <textarea style="display:none" id="reply_edit_{{$thread->id}}" class="form-control">{{$thread->msg}}</textarea>
                    </div>
                    <?php
                    $thumbs = json_decode($thread->thumbnail);
                    ?>
                    <div class="ticket-reply attachments">
                        <strong>Attachments ({{count($thumbs)}})</strong>
                        <ul>
							@if(count($thumbs)>0)
							@foreach($thumbs as $thumb)
								<li><i class="fa fa-file-o"></i> <a href="#link to image">{{$thumb}}</a></li>
							@endforeach
							@endif
                        </ul>
                    </div>
                   
                </div><!-- end webqom support panel -->
                @else
                <div class="panel panel-default">
                   <div class="ticket-reply">
                      <div class="date">Last updated: {{$thread->created_date}} </div>
                      <div class="user">
                        <img src="/resources/assets/admin/images/profile/image_hock.jpg" alt="User profile image">
                        <span class="name">{{$user->first_name.' '.$user->last_name}} </span>
                        <span class="type">Client</span>
                      </div>
                    </div>
                    <div class="panel-body">
                        <p>{{$thread->msg}}</p>
                    </div>
                    <?php
                    $thumbs = json_decode($thread->thumbnail);
                    ?>
                    <div class="ticket-reply attachments">
                        <strong>Attachments ({{count($thumbs)}})</strong>
                        <ul>
							@if(count($thumbs)>0)
							@foreach($thumbs as $thumb)
								<li><i class="fa fa-file-o"></i> <a href="#link to image">{{$thumb}}</a></li>
							@endforeach
							@endif
                        </ul>
                    </div>
               </div><!-- end client panel -->
               @endif
                @endforeach
                @endif
                
            </div><!-- end col-lg-12 -->
          
          
           </div><!-- end row -->
        </div>
        <!-- InstanceEndEditable -->
        <!--END CONTENT-->
            
            <!--BEGIN FOOTER-->
 <!--END FOOTER--></div>
  <!--END PAGE WRAPPER--></div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<!--loading bootstrap js-->
<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<script src="vendors/metisMenu/jquery.metisMenu.js"></script>
<script src="vendors/slimScroll/jquery.slimscroll.js"></script>
<script src="vendors/jquery-cookie/jquery.cookie.js"></script>
<script src="js/jquery.menu.js"></script>
<script src="vendors/jquery-pace/pace.min.js"></script>

<!--LOADING SCRIPTS FOR PAGE-->
<script src="vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="vendors/moment/moment.js"></script>
<script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="vendors/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="vendors/bootstrap-clockface/js/clockface.js"></script>
<script src="vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="vendors/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="vendors/jquery-maskedinput/jquery-maskedinput.js"></script>
<script src="js/form-components.js"></script>
<!--LOADING SCRIPTS FOR PAGE-->

<!-- InstanceBeginEditable name="EditRegion4" -->
<script src="vendors/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="vendors/ckeditor/ckeditor.js"></script>
<script src="js/ui-tabs-accordions-navs.js"></script>
<!-- InstanceEndEditable -->


<!--CORE JAVASCRIPT-->
<script src="js/main.js"></script>
<script src="js/holder.js"></script>
	<script>
		$(document).ready(function(){
			$('#addMoreUpload').click(function(){
				if($('[name="attachment[]"]').length<=10)
				{
					str = '<input class="exampleInputFile1" name="attachment[]" type="file"/>';
					$('#append_div').append(str);
				}else{
					alert('Max 10 images can selected');
				}
			});
		});
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
	function submitFrm(){
		$('#rpl_tkt').submit();
	}
	function edit_reply(thread_id){
		$('#reply_edit_'+thread_id).show();
		$('#save_btn_'+thread_id).show();
		$('#edit_btn_'+thread_id).hide();
	}
	function update_reply(thread_id){
		var val = $('#reply_edit_'+thread_id).val();
		window.location.href="update_reply?id="+thread_id+"&msg="+val;
	}
	function delete_reply(thread_id){
		window.location.href="delete_reply?id="+thread_id;
	}
	</script>
</body>
@endsection
