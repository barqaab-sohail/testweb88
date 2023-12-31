<?php $page='categories';
$breadcrumbs=[
array('url'=>false,'name'=>'Services'),
array('url'=>url('admin/categories'),'name'=>'Categories'),
array('url'=>'javascript:void','name'=>'Index Page- Edit'),
];
?>

@extends('layouts.admin_layout')
@section('title','Admin | Index- Edit')
@section('content')
@section('page_header','Services')
<div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <h2>Index Page <i class="fa fa-angle-right"></i> Edit</h2>
              @include('admin.partials.messages')
               <div hidden="" style="margin-top: 10px" id="success_message" class="messages alert alert-success alert-dismissable">
                          <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                          <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                          <p>Sort order is saved.</p>
                        </div>
                           <div hidden="" style="margin-top: 10px" id="success_message_cms" class="messages alert alert-success alert-dismissable">
                          <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                          <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                          <p>Page content saved</p>
                        </div>
              <div class="clearfix"></div>
              
              <div class="pull-left"> Last updated: <span id="recent_update" class="text-blue">{{$recent_update}}</span> </div>
              <div class="clearfix"></div>
              <p></p>
              
              <div class="portlet">
                <div class="portlet-header">
                  <div class="caption">Page Info</div>
                  <div class="clearfix"></div>
                  <span class="text-blue text-12px">You can edit the content by clicking the text section below.</span>
                  <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                </div>
                <div class="portlet-body">
                   
                    <div id="cms_content" contenteditable="true">
                      @if(!empty($page_cms))	
					{!!$page_cms->content!!}
				@else
					<p>No content added</p>
				@endif
                    </div>
                    
                                        
                    
                </div><!-- end portlet body -->
              
                <!-- save button start -->
                <div class="form-actions none-bg"> <a href="javascript:void" onclick='ClickToSave(0)' class="btn btn-red">Save &amp; Preview &nbsp;<i class="fa fa-search"></i></a>&nbsp; <a href="javascript:void" onclick='ClickToSave(1)' class="btn btn-blue">Save &amp; Publish &nbsp;<i class="fa fa-globe"></i></a>&nbsp; <a href="{{url('/admin/index-plan')}}" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                <!-- save button end -->
                
              </div>
              <!-- end porlet -->
              
              <h4 class="block-heading">Index Plans, General Features &amp; Video Listing</h4>
              <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#hosting-plans" data-toggle="tab">Index Plans</a></li>
                <li><a href="#general-features" data-toggle="tab">General Features</a></li>
                <li><a href="#video" data-toggle="tab">Video</a></li>
                <li><a href="#offer-services" data-toggle="tab">Offer Services</a></li>
                <li><a href="#testimonials" data-toggle="tab">Testimonials</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div id="hosting-plans" class="tab-pane fade in active">
                    
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Index Plans Listing</div>
                      <p style="margin-top:30px"  class="margin-top-10px"></p>
                      <a href="{{url('').'/admin/index-plan/create'}}" class="btn btn-success">Add New Plan &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Delete</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="javascript:void" onclick="open_modal_delete_selected()">Delete selected item(s)</a></li>
                          <li class="divider"></li>
                          <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                        </ul>
                      </div>
                      
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                      
                      <!--Modal delete selected items start-->
                      <div id="modal-delete-selected-plan" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected <span id="count-seleted"></span> item(s)? </h4>
                        </div>
                        <div class="modal-body" id="delete-selected-body">
                        <div id="delete-selected-body-information"></div>
                          <p id="selected_zero" style="display:none" class="alert alert-danger">Please select at least one item for delete</p>
                          <div class="form-actions" id="delete-selected-buttons">
                            <div class="col-md-offset-4 col-md-8"> <button type="button" id="delete_bulk" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
                      
                    </div>
                    <div class="portlet-body">
                        <div class="pull-left text-blue">Display Order 1 to 4 is counting from Left to Right.</div>
                        <div class="pull-right"> <button id="update_so" class="btn btn-danger">Update Display Order &nbsp;<i class="fa fa-refresh"></i></button> </div>
                        <div class="clearfix" style="margin-bottom: 10px"></div>
                       

                        <div class="table-responsive mtl">
                         <form id="delete_client">
                              <table class="table table-hover table-striped">
                                <thead>
                                  <tr>
                                    <th width="1%"><input id="plan_checkbox" onchange="check_all('plan_checkbox')" type="checkbox"/></th>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Plan Name</th>
                                    <th>Price (RM)</th>
                                    <th>Promo Behaviour</th>
                                    <th width="10%">Display Order</th>
                                    <th class="alicent">Action</th>
                                  </tr>
                                </thead>
                               
                                <tbody>
                                
                                {{csrf_field()}}
                                  <?php $count=1; ?>
                                  @if(!empty($indexplans))
                                      @foreach($indexplans as $i)
                                        <tr>
                                            <td><input name="id_index[]" class="plan_checkbox" type="checkbox"/></td>
                                            <td>{{$count}}</td>
                                            <td><span class="label label-xs label-{{$i->status==1?"success": "danger"}}">{{$i->status==1?"Active": "Inactive"}}</span></td>
                                            <td>{{$i->name_line1." ".$i->name_line2}}</td>
                                            <td>@if($i->price_type=='Recurring') <span>RM</span> {{$i->price_annually or '0'}}<span>/yr</span>@endif
                                                    @if($i->price_type=='One Time') 
                                                    <span>RM</span>{{$i->price_monthly or '0'}} <span>/mo</span>
                                                    @endif
                                                    @if($i->price_type=='Free') 
                                                    <span>Free</span></p>
                                                    @endif</td>
                                            <td>-</td>
                                            <td><input type="text" id="{{$i->id}}" class="form-control" value="{{$i->sort_order}}"></td>
                                            <td class="alicent"><a href="{{url('').'/admin/index-plan/'.$i->id.'/edit'}}" data-hover="tooltip" data-placement="top" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{$i->id}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                               
                                                <!--Modal delete plan start-->
                                                <div id="modal-delete-{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade alileft">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                        <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <p><strong>#{{$i->id}}: {{$i->name_line1." ".$i->name_line2}}</strong></p>
                                                        <div class="form-actions">
                                                          
                                                          <input type="hidden" value="{{$i->id}}" name="id">
                                                          
                                                          <div class="col-md-offset-4 col-md-8"> 
                                                          <button type="button" id="delete_single_btn" onclick="delete_single({{$i->id}})" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i>
                                                          </button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                          
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                              </div>
                                              <!-- modal delete end -->
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
                              </form>
                            </div>
                            <span>Showing  {{$indexplans->firstItem()}} to {{$indexplans->lastItem()}} of {{$indexplans->total()}}</span>
                      <span class="pull-right">{{$indexplans->links()}}</span>
                            <!-- end table responsive -->
                    </div>
                    <!-- end portlet body -->
                  </div>
                  <!-- End porlet -->
                </div>
                <!-- end tab index plan -->
                
                <div id="general-features" class="tab-pane fade">
                 <div class="portlet">
            <div class="portlet-header">
              <div class="caption">Feature Heading Edit</div>
              <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
            </div>
            <div class="portlet-body">
              <div class="table-responsive mtl">
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Status</th>
                      <th>Feature Heading</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td><span class="label label-xs label-{{$general_features[0]['heading_status']?'success':'danger'}}">{{$general_features[0]['heading_status']?'Active':'Inactive'}}</span></td>
                      <td>{{$general_features[0]['heading']}}</td>
                      <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-feature-title" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                        <!--Modal Edit feature heading text start-->
                        <div id="modal-edit-feature-title" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                          <div class="modal-dialog modal-wide-width">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                <h4 id="modal-login-label3" class="modal-title">Edit Feature Heading Text</h4>
                              </div>
                              <div class="modal-body">
                                <div class="form">
                                  <form id="frm_general_features_heading" class="form-horizontal">
                                    {{csrf_field()}}
                                    <input type="hidden" name="page" class="form-control" value="{{$page_name}}"> 
                                    <div class="form-group">
                                      <label class="col-md-3 control-label">Status</label>
                                      <div class="col-md-6">
                                        <div data-on="success" data-off="primary" class="make-switch">
                                          <input name="status" type="checkbox" @if($general_features[0]['heading_status']==1) checked="checked" @endif/>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-md-3 control-label">Feature Heading <span class="text-red">*</span> </label>
                                      <div class="col-md-6">
                                        <input type="text" name="heading"  class="form-control"  value="{{$general_features[0]['heading']}}">
                                        <p class="red_error" id="gf_heading"> </p>
                                      </div>
                                    </div>
                                    <div class="form-actions">
                                      <div class="col-md-offset-5 col-md-8"> <button class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--END MODAL Edit feature heading text-->
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5"></td>
                    </tr>
                  </tfoot>
                </table>
                <div class="clearfix"></div>
              </div>
              <!-- end table responsive -->
            </div>
          </div>
                  <!-- End porlet -->
                  
                  <div class="portlet">
            <div class="portlet-header">
              <div class="caption">General Features Listing</div>
              <p class="margin-top-10px"></p>
              <a href="#" data-target="#modal-add-general-feature" data-toggle="modal" class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
              <div class="btn-group">
                <button type="button" class="btn btn-primary">Delete</button>
                <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                <ul role="menu" class="dropdown-menu">
                  <li><a href="javascript:void" onclick="gf_open_modal_delete_selected()">Delete selected item(s)</a></li>
                  <li class="divider"></li>
                  <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                </ul>
              </div>
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
              <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
              <!--Modal Add new general ffeature start-->
              <div id="modal-add-general-feature" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                <div class="modal-dialog modal-wide-width">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                      <h4 id="modal-login-label3" class="modal-title">Add New General Feature</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form">
                       <form id="frm_general_features" class="form-horizontal" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                          <label class="col-md-3 control-label">Status</label>
                          <div class="col-md-6">
                            <div data-on="success" data-off="primary" class="make-switch">
                              <input name="status" type="checkbox" checked="checked"/>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Feature Title <span class="text-red">*</span></label>
                          <div class="col-md-6">
                            <input type="hidden" name="page" class="form-control" value="{{$page_name}}">
                            <input type="text" name="title" class="form-control" placeholder="eg. Ultra-Fast Platform ">
                            <p class="red_error" id="gf_title"></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Feature Description</label>
                          <div class="col-md-6">
                            <textarea  name="description" class="form-control"></textarea>
                            <p class="red_error" id="gf_description"></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Insert CSS Icon or </label>
                          <div class="col-md-6">
                            <div class="text-blue border-bottom">Please choose <strong>ONE</strong> of the following options for "Feature Icon".</div>
                            <div class="margin-top-5px"></div>
                            <input type="text" name="icon" class="form-control" id="inputContent" placeholder="eg. fa-rocket or icon-anchor">
                            <div class="help-block">Please refer here for complete <a href="{{url('/admin/icons')}}" target="_blank">icon options.</a>
                              <p class="red_error" id="gf_icon"></p></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-3 control-label">Upload Icon Image</label>
                            <div class="col-md-9">
                              <div class="xs-margin"></div>
                              <input name="icon_image" id="exampleInputFile2" type="file"/>
                              <span class="help-block">(Image dimension: 64 x 64 pixels, PNG only, Max. 1MB) </span>
                              <p class="red_error" id="gf_icon_image"></p></div> </div>
                            </div>
                            <div class="form-actions">
                              <div class="col-md-offset-5 col-md-8"> 
                              <button class="btn btn-red" id="frm_general_features_submit">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp;
                               <button type="button" style="display: none" id="frm_general_features_submit_wait" class="btn btn-red">Uploading  <i class="loading_icon fa fa-spinner fa-spin fa-large"></i></button>
                                <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--END MODAL Add New general Feature-->

              </div>
              <div class="portlet-body">
                <div class="table-responsive">
                  <table class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th width="1%"><input id="gf_checkbox" onchange="check_all('gf_checkbox')" type="checkbox"></th>
                        <th>#</th>
                        <th>Status</th>
                        <th>Title</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <form id="delete_general_features">
                        {{csrf_field()}}
                        <?php $count_gf=0; ?>
                        @if(!empty($general_features))
                        @foreach($general_features as $i)
                        <?php $count_gf++; ?>
                        <tr>
                          <td><input type="checkbox" class="gf_checkbox" value="{{$i->id}}" name="id_gf[]"></td>
                          <td>{{$count_gf}}</td>
                          <td><span class="label label-xs label-{{$i->status?'success':'danger'}}">{{$i->status?'Active':'Inactive'}}</span></td>
                          <td>{{$i->title}}</td>
                          <td><a href="javascript:void" onclick="edit_general_feature({{$i->id}})" data-hover="tooltip" data-placement="top"  title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-general-feature-{{$i->id}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>

                            <!--Modal delete start-->
                            <div id="modal-delete-general-feature-{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                  </div>
                                  <div class="modal-body">
                                    <p><strong>#{{$i->id}}:</strong>{{$i->title}}</p>
                                    <div class="form-actions">
                                      <div class="col-md-offset-4 col-md-8"> <button type="button" onclick="delete_gf_single({{$i->id}})" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- modal delete general feature end -->
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </form>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="5"></td>
                      </tr>
                    </tfoot>
                  </table>
                  <div class="clearfix"></div>
                </div>
                <!-- end table responsive -->
              </div>

                  
                </div><!-- end tab general features -->
                
               <div id="video" class="tab-pane fade">
                                  
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Video</div>
                      <p class="margin-top-10px"></p>
                      <a href="javascript:void" id="add_new_video_btn" onclick="add_video(0)" class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Delete</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="javascript:void" onclick="open_modal_delete_selected_videos()">Delete selected item(s)</a></li>
                          <li class="divider"></li>
                          <li><a href="#" data-target="#modal-delete-all-video" data-toggle="modal">Delete all</a></li>
                        </ul>
                      </div>

                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                      
                      <!--Modal Add new start-->
                      <div id="modal-add-faq" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4  id="video_popup_heading" class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                <form class="form-horizontal" id="frm_save_video">
                                <input type="hidden" id="video_id" name="video_id">
                                {{csrf_field()}}
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-6">
                                      <div data-on="success" data-off="primary" class="make-switch">
                                        <input name="video_status" type="checkbox" checked="checked"/>
                                      </div>
                                        <p class="red_error" id="video_err_video_status"></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Heading <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                      <input name="video_heading" type="text" class="form-control" placeholder="eg. How Web88 CMS Can Help You?">
                                    <p class="red_error" id="video_err_video_heading"></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3  control-label">Video Title <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                      <input name="video_title" type="text" class="form-control" placeholder="eg. Services of Webqom Technologies">
                                    <p class="red_error" id="video_err_video_title"></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Embed Video Link <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                      <div class="text-blue border-bottom">You can embed the video link from Youtube. Just copy and paste the embedded video link below and change the video width to "100%" and height to "350".</div>
                                      <div id="content_video" contenteditable="true">
                                      </div>
                                    </div>
                                    <input type="hidden" id="video_link" name="video_link">
                                    <p class="red_error" id="video_err_link"></p>
                                  </div>

                                  <div class="form-actions">
                                    <div class="col-md-offset-5 col-md-8"> <button class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL Add New -->
                      

       <div id="modal-delete-selected-videos" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                          
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected <span id="count-seleted"></span> item(s)? </h4>
                        </div>
                        <div class="modal-body" id="delete-selected-body">
                        <div id="delete-selected-body-information"></div>
                          <p id="selected_zero" style="display:none" class="alert alert-danger">Please select at least one item for delete</p>
                          <div class="form-actions" id="delete-selected-buttons">
                            <div class="col-md-offset-4 col-md-8"> <button type="button" onclick="delete_bulk_videos()" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                          </div>
                        </div>
                      </div>
                        </div>
                      </div>
                      <!-- modal delete selected items end -->  
                      <!--Modal delete all items start-->
                      <div id="modal-delete-all-video" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
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
                      
                    </div>
                    <div class="portlet-body">
                      <div class="table-responsive">
                        <form id="delete_selected_videos">
                          {{csrf_field()}}
                          <table class="table table-hover table-striped">
                            <thead>
                              <tr>
                                <th width="1%"><input id="video_checkbox"  onchange="check_all('video_checkbox')"  type="checkbox"></th>
                                <th>#</th>
                                <th>Status</th>
                                <th>Heading</th>
                                <th>Video Title</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if(count($videos)>0)
                                <?php $count_videos=0; ?>
                                    @foreach($videos as $i)
                              <tr>
                              <?php $count_videos++  ?>
                                <td><input type="checkbox" name="id_video[]" value="{{$i->id}}" class="video_checkbox"></td>
                                <td>{{$count_videos}}</td>
                                <td><span class="label label-xs label-{{$i->status?'success':'danger'}}">{{$i->status?'Active':'Inactive'}}</span></td>
                                <td>{{$i->heading}}</td>
                                <td>{{$i->video_title}}</td>
                                <td><a href="javascript:void" onclick="add_video({{$i->id}})"  title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-faq-{{$i->id}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                  <!--Modal delete faq start-->
                                  <div id="modal-delete-faq-{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                              </div>
                                              <div class="modal-body">
                                                <p><strong>#{{$i->id}}:</strong> {{$i->heading}}</p>
                                                <div class="form-actions">
                                                  <div class="col-md-offset-4 col-md-8"> <a href="javascript:void" id="delete_single_video_btn" onclick="delete_single_video({{$i->id}})" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                      <!-- modal delete faq end -->
                                </td> 
                              </tr>
                              @endforeach
                              @endif
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="6"></td>
                              </tr>
                            </tfoot>
                          </table>

                        </form>
                      </div><!-- end table responsive -->
                      
                      <div class="clearfix"></div>
                    </div>
                  </div><!-- end portlet -->
                  
                </div><!-- end tab video -->
                
                
                <div id="offer-services" class="tab-pane fade">
                  <div class="portlet">
            <div class="portlet-header">
              <div class="caption">Offer Services Heading Edit</div>
              <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
            </div>
            <div class="portlet-body">
              <div class="table-responsive mtl">
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Status</th>
                      <th>Offer Services Heading</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($offer_services)>0)
                    <tr>
                      <td>1</td>

                      <td><span class="label label-xs label-{{$offer_services[0]['heading_status']==1?'success':'danger'}}">{{$offer_services[0]['heading_status']?'Active':'Inactive'}}</span></td>
                      <td>{{$offer_services[0]['heading'] or "No heading found"}}</td>
                      <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-os-title" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                        <!--Modal Edit feature heading text start-->
                        <div id="modal-edit-os-title" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                          <div class="modal-dialog modal-wide-width">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                <h4 id="modal-login-label3" class="modal-title">Edit Offer Services Heading Text</h4>
                              </div>
                              <div class="modal-body">
                                <div class="form">
                                  <form id="frm_offer_services_heading" class="form-horizontal">
                                    {{csrf_field()}}
                                    <input type="hidden" name="page" class="form-control" value="{{$page_name}}"> 
                                    <div class="form-group">
                                      <label class="col-md-3 control-label">Status</label>
                                      <div class="col-md-6">
                                                  <div data-on="success" data-off="primary" class="make-switch">
                                                    <input name="status" type="checkbox" @if($offer_services[0]['heading_status']==1) checked="checked" @endif/>
                                                  </div>
                                                </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-md-3 control-label">Offer Services Heading <span class="text-red">*</span> </label>
                                      <div class="col-md-6">
                                        <input type="text" name="heading"  class="form-control"  value="{{$offer_services[0]['heading']}}">
                                        <p class="red_error" id="os_heading"> </p>
                                      </div>
                                    </div>
                                    <div class="form-actions">
                                      <div class="col-md-offset-5 col-md-8"> <button class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--END MODAL Edit feature heading text-->
                      </td>
                    </tr>
            @else
         <tr>
           <td colspan="4">No services found, please add some services then add heading</td>
         </tr>
            @endif
                    
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5"></td>
                    </tr>
                  </tfoot>
                </table>
                <div class="clearfix"></div>
              </div>
              <!-- end table responsive -->
            </div>
          </div>
                  <!-- End porlet -->
                  
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Services Listing</div>
                      <p class="margin-top-10px"></p>
                      <a href="javascript:void" onclick="store_offer_service(0)" class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Delete</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="javascript:void" onclick="open_modal_delete_selected_os()">Delete selected item(s)</a></li>
                          <li class="divider"></li>
                          <li><a href="#" data-target="#modal-delete-all-service" data-toggle="modal">Delete all</a></li>
                        </ul>
                      </div>
                      <!--Modal Add new service start-->
                      <div id="modal-add-service" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label3" class="modal-title">Save Service</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                <form id="frm_services" class="form-horizontal">
                                {{csrf_field()}}
                                <input type="hidden" name="content" id="service_content_input">
                                <input type="hidden" name="id" >
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-6">
                                      <div data-on="success" data-off="primary" class="make-switch">
                                        <input name="status" type="checkbox" checked="checked"/>

                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Tab Title <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                      <input type="text" name="title" class="form-control" placeholder="eg. Hosting">
                                      <p class="red_error" id="err_off_services_title"></p>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                                <label class="col-md-3 control-label">Tab Display Order <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                  <input name="display_order" type="text" class="form-control" placeholder="eg. 1">
                                                  <p class="red_error" id="err_off_services_display_order"></p>
                                                  <div class="text-blue">Tab Display Order is counting from Left to Right.</div>
                                                </div>
                                              </div>
                                  
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Content</label>
                                    <p class="red_error" id="err_off_services_content"></p>
                                     <div id="service_content" contenteditable="true">
                                        
                                     </div>
                                    
                                  </div>
                                  
                                  
                                  <div class="form-actions">
                                    <div class="col-md-offset-5 col-md-8"> <button class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL Add New service-->
                      <!--Modal delete selected items start-->
                      <div id="modal-delete-selected-service" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                            </div>
                            <div class="modal-body">
                              <p><strong>#1:</strong> Hosting</p>
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8"> <a href="javascript:void" id="delete_bulk_os" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- modal delete selected items end -->
                      <!--Modal delete all items start-->
                      <div id="modal-delete-all-service" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
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
                      
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                      
                    </div>
                    <div class="portlet-body">
                      <div class="pull-left text-blue">Display Order 1 to 5 is counting from Left to Right.</div>
                      <div class="pull-right"> <button id="update_so_of" class="btn btn-danger">Update Display Order &nbsp;<i class="fa fa-refresh"></i></button> </div>
                      <div class="clearfix"></div>                     
                        <div class="table-responsive mtl">
                        <form id="delete_os">
                        {{csrf_field()}}
                          <table class="table table-hover table-striped">
                            <thead>
                              <tr>
                                <th width="1%"><input  id="os_checkbox" onchange="check_all('os_checkbox')" type="checkbox"></th>
                                <th>#</th>
                                <th>Status</th>
                                <th>Tab Title</th>
                                <th width="15%">Tab Display Order</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if(count($offer_services)>0)
                                <?php $offer_services_count=1?>
                                @foreach($offer_services as $i)
                                   <tr>
                                <td><input type="checkbox" name="id_os[]" class="os_checkbox" value="{{$i->id}}"></td>
                                <td>{{$offer_services_count}}</td>
                                <td><span class="label label-xs label-{{$i->status?'success':'danger'}}">{{$i->status?'Active':'Inactive'}}</span></td>
                                <td>{{$i->title}}</td>
                                <td><input type="text" name="update_so_of[{{$i->id}}]" class="form-control" value="{{$i->sort_order}}"></td>
                                <td><a href="javascript:void" onclick="store_offer_service({{$i->id}})" data-hover="tooltip" data-placement="top" data-target="#modal-edit-service" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-service-{{$i->id}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                 
                                  <!--Modal delete service 1 start-->
                                  <div id="modal-delete-service-{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                              </div>
                                              <div class="modal-body">
                                                <p><strong>#{{$i->id}}:</strong> {{$i->title}}</p>
                                                <div class="form-actions">
                                                  <div class="col-md-offset-4 col-md-8"> <a href="javascript:void" onclick="delete_offer_services({{$i->id}})" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="javascript:void"  data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                      <!-- modal delete service 1 end -->
                                </td> 
                              </tr><?php $offer_services_count++ ?>
                                @endforeach
                              @endif
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="6"></td>
                              </tr>
                            </tfoot>
                          </table>
                          </form>
                      </div><!-- end table responsive -->
                      <div class="clearfix"></div>
                    </div>
                  </div><!-- end porlet -->

                  
                </div><!-- end tab offer services -->
                
                
                
                <div id="testimonials" class="tab-pane fade">
                                  
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Testimonials Heading Edit</div>
                       
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
                    <div class="portlet-body">
                      
                      <div class="table-responsive mtl">
                        <table class="table table-hover table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Status</th>
                              <th>Heading</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td><span class="label label-xs label-{{$testimonials[0]['heading_status']?'success':'danger'}}">{{$testimonials[0]['heading_status']?'Active':'Inactive'}}</span></td>
                      <td>{{$testimonials[0]['heading']}}</td>
                              <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-edit-testimonial-heading" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                  <!--Modal Edit testimonial heading text start-->
                                  <div id="modal-edit-testimonial-heading" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                    <div class="modal-dialog modal-wide-width">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                          <h4 id="modal-login-label3" class="modal-title">Edit Heading Text</h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form">
                                            <form id="frm_testimonials_heading" class="form-horizontal">
                                            {{csrf_field()}}
                                              <div class="form-group">
                                                <label class="col-md-3 control-label">Status</label>
                                                <div class="col-md-6">
                                                  <div data-on="success" data-off="primary" class="make-switch">
                                                    <input name="status" type="checkbox" @if($testimonials[0]['heading_status']==1) checked="checked" @endif/>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="col-md-3 control-label">Heading <span class="text-red">*</span> </label>
                                                <div class="col-md-6">
                                                   <input name="heading" type="text" class="form-control" value="{{$testimonials[0]['heading']}}"> 
                                                   <p class="red_error" id="ts_heading"></p>
                                                </div>
                                              </div>
                                              
                                              <div class="form-actions">
                                                <div class="col-md-offset-5 col-md-8"> <button class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <!--END MODAL Edit testimonials heading text-->
                              </td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="4"></td>
                            </tr>
                          </tfoot>
                        </table>
                        <div class="clearfix"></div>
                      </div>
                      <!-- end table responsive -->
                    </div>
                  </div>
                  <!-- End porlet -->
                  
                  <div class="portlet">
                    <div class="portlet-header">
                      <div class="caption">Testimonials</div>
                      <p class="margin-top-10px"></p>
                      <a href="javascript:void" onclick="save_testimonial(0)" class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Delete</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href="javascript:void" onclick="open_modal_delete_selected_testimonials()">Delete selected item(s)</a></li>
                          <li class="divider"></li>
                          <li><a href="#" data-target="#modal-delete-all-testimonial" data-toggle="modal">Delete all</a></li>
                        </ul>
                      </div>

                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                      
                      <!--Modal Add new start-->
                      <div id="modal-add-testimonial" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-add-testimonial-heading" class="modal-title">Add New Testimonial</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form">
                                <form id="frm_add_testimonial" class="form-horizontal">
                                {{csrf_field()}}
                                <input type="hidden" name="id" id="id_testimonial_txtbox" value="0">
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-6">
                                      <div data-on="success" data-off="primary" class="make-switch">
                                        <input name="status" type="checkbox" checked="checked"/>
                                      </div>
                                      <p class="red_error" id="err_testimonial_status"></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Client Name <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                      <input type="text" name="client_name" class="form-control" placeholder="eg. Ahmad Munif">
                                      <p class="red_error" id="err_testimonial_client_name"></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Upload Client Thumbnail <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                      <div class="xs-margin"></div>
                                      <img id="client_image_img" style="display:none"  width="80px">
                                      <input id="exampleInputFile2" name="client_image" type="file"/>
                                      <p class="red_error" id="err_testimonial_client_image"></p>
                                      <span class="help-block">(Image dimension: 250 x 250 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Company Name <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                      <input type="text" name="company" class="form-control" placeholder="eg. Grand Teak Sdn Bhd">
                                    <p class="red_error" id="err_testimonial_company"></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Testimonial Content <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                      <textarea class="form-control" id="testimonial_content" name="testimonial_content" rows="10"></textarea>
                                    <p class="red_error" id="err_testimonial_content"></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">Services <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                      <input type="text" name="service" class="form-control" placeholder="eg. bulk sms">
                                    <p class="red_error" id="err_testimonial_service"></p>
                                    </div>
                                  </div>
                                  

                                  <div class="form-actions">
                                    <div class="col-md-offset-5 col-md-8"> <button class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END MODAL Add New -->
                      <!--Modal delete selected items start-->
                      <div id="modal-delete-selected-testimonial" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                          
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected <span id="count-seleted"></span> item(s)? </h4>
                        </div>
                        <div class="modal-body" id="delete-selected-body">
                        <div id="delete-selected-body-information"></div>
                          <p id="selected_zero" style="display:none" class="alert alert-danger">Please select at least one item for delete</p>
                          <div class="form-actions" id="delete-selected-buttons">
                            <div class="col-md-offset-4 col-md-8"> <button type="button" onclick="delete_bulk_testimonial()" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                          </div>
                        </div>
                      </div>
                        </div>
                      </div>
                      <!-- modal delete selected items end -->
                      <!--Modal delete all items start-->
                      <div id="modal-delete-all-testimonial" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
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
                      
                    </div>
                    <div class="portlet-body">
                      <div class="table-responsive">
                          <table class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th width="1%"><input onchange="check_all('testimonials_checkall')" id="testimonials_checkall" type="checkbox"></th>
                        <th>#</th>
                        <th>Status</th>
                        <th>Client Name</th>
                        <th>Company</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <form id="delete_testimonial">
                        {{csrf_field()}}
                        <?php $count_test=0; ?>
                        @if(!empty($testimonials))
                        @foreach($testimonials as $i)
                        <?php $count_test++; ?>
                        <tr>
                          <td><input type="checkbox" class="testimonials_checkall" value="{{$i->id}}" name="id_testimonial[]"></td>
                          <td>{{$count_test}}</td>
                          <td><span class="label label-xs label-{{$i->status?'success':'danger'}}">{{$i->status?'Active':'Inactive'}}</span></td>
                          <td>{{$i->client_name}}</td>
                          <td>{{$i->company}}</td>
                          
                          <td><a href="javascript:void" onclick="save_testimonial({{$i->id}})" data-hover="tooltip" data-placement="top"  title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-general-feature-{{$i->id}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>

                            <!--Modal delete start-->
                            <div id="modal-delete-general-feature-{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                    <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this client? </h4>
                                  </div>
                                  <div class="modal-body">
                                    <p><strong>#{{$i->id}}:</strong>{{$i->client_name}}</p><br>
                                    <span><strong>Company</strong>{{$i->company}}</span>
                                    <div class="form-actions">
                                      <div class="col-md-offset-4 col-md-8"> <button type="button" onclick="delete_single_testimonial({{$i->id}})" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- modal delete general feature end -->
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </form>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="5"></td>
                      </tr>
                    </tfoot>
                  </table>
                      </div><!-- end table responsive -->
                      
                      <div class="clearfix"></div>
                    </div>
                  </div><!-- end portlet -->
                  
                </div><!-- end tab testimonials -->
                
                
              </div>
              <!-- end tab content -->
              <div class="clearfix"></div>
            </div>
            <!-- end col-lg-12 -->
          </div>
          <!-- end row -->
        </div>
        <!-- InstanceEndEditable -->
        <!--END CONTENT-->
    <div id="modal-delete-selected-gf" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the general features <span id="count-seleted"></span> item(s)? </h4>
        </div>
        <div class="modal-body" id="delete-selected-body">
          <div id="delete-selected-body-information"></div>
          <p id="selected_zero" style="display:none" class="alert alert-danger">Please select at least one item for delete</p>
          <div class="form-actions" id="delete-selected-buttons">
            <div class="col-md-offset-4 col-md-8"> <button type="button" id="delete_bulk_gf" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="modal-delete-selected-os" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
          <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the offer services <span id="count-seleted"></span> item(s)? </h4>
        </div>
        <div class="modal-body" id="delete-selected-body">
          <div id="delete-selected-body-information"></div>
          <p id="selected_zero" style="display:none" class="alert alert-danger">Please select at least one item for delete</p>
          <div class="form-actions" id="delete-selected-buttons">
            <div class="col-md-offset-4 col-md-8"> <button type="button" id="delete_bulk_os" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Modal Edit general feature start-->
  <div id="modal-edit-general-feature" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-wide-width">
      <div class="modal-content">
          
        <div class="modal-header">
          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
          <h4 id="modal-login-label3" class="modal-title">General Feature Edit</h4>
        </div>
        <div class="modal-body">
        <form id="frm_general_features_edit" class="form-horizontal" enctype="multipart/form-data">
                                      {!! csrf_field() !!}
          <div class="form">


            <div class="form-group">
              <label class="col-md-3 control-label">Status</label>
              <div class="col-md-6">
                <div data-on="success" data-off="primary" class="make-switch">
                  <input name="status" type="checkbox" checked="checked"/>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Feature Title <span class="text-red">*</span></label>
              <div class="col-md-6">
                <input type="hidden" name="id" type="hidden" id="gf_id_edit" class="form-control">
                <input type="hidden" name="page" type="hidden" class="form-control" value="{{$page_name}}">
                <input type="text" name="title"   class="form-control" placeholder="eg. Ultra-Fast Platform ">
                <p class="red_error" id="gf_edit_title"></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Feature Description</label>
              <div class="col-md-6">
                <textarea id="gf_description_edit"  name="description" class="form-control"></textarea>
                <p class="red_error" id="gf_edit_description"></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Insert CSS Icon or </label>
              <div class="col-md-6">
                <div class="text-blue border-bottom">Please choose <strong>ONE</strong> of the following options for "Feature Icon".</div>
                <div class="margin-top-5px"></div>
                <input  type="text" name="icon" class="form-control" id="inputContent" placeholder="eg. fa-rocket or icon-anchor">
                <div class="help-block">Please refer here for complete <a href="icons_sevices.html" target="_blank">icon options.</a>
                    <p class="red_error" id="gf_edit_icon"></p></div>
                  </div>
                </div>
                    <div class="form-group">
                    <label class="col-md-3 control-label">Upload Icon Image</label>
                    <div class="col-md-9">
                      <div class="xs-margin"></div>
                      <img id="gf_img_edit" style="    width: 80px" src="" alt="no image was uploaded" class="img-responsive"><br/>
                      <a hidden="" href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-icon" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                      <!--Modal delete icon start-->
                      <div id="modal-delete-icon" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this icon image? </h4>
                            </div>
                            <div class="modal-body">
                              <p><img src="../images/about_us/icon_cloud_app.png" alt="Ultra-Fast Platform" class="img-responsive"></p>
                              <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <input name="icon_image" id="exampleInputFile2" type="file"/>
                      <span class="help-block">(Image dimension: 64 x 64 pixels, PNG only, Max. 1MB) </span>
                      <p class="red_error" id="gf_edit_icon_image"></p></div> 
                  </div>
                  
              </div>
              <div class="form-actions">
                <div class="col-md-offset-5 col-md-8"> 
                <button type="button" id="frm_general_features_edit_submit" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>
               
                &nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
              </div>
                </form>    

            </div>
          
          </div>
        </div>
    </div>
@endsection
@section('custom_scripts')
  <link type="text/css" rel="stylesheet" href="{{url('').'/resources/assets/admin/'}}vendors/jquery-nestable/nestable.css">
  <script src="{{url('').'/resources/assets/admin/'}}vendors/tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="{{url('').'/resources/assets/admin/'}}vendors/ckeditor/ckeditor.js"></script>
  <script src="{{url('').'/resources/assets/admin/'}}js/ui-tabs-accordions-navs.js"></script>
  <!-- webqom frontend style css -->
<link type="text/css" rel="stylesheet" href="{{url('').'/resources/assets/admin/'}}css/style_webqom_front.css">
<link type="text/css" rel="stylesheet" href="{{url('').'/resources/assets/admin/'}}css/reset.css">
<link type="text/css" rel="stylesheet" href="{{url('').'/resources/assets/admin/'}}css/responsive-leyouts_webqom_front.css">
<link type="text/css" rel="stylesheet" href="{{url('').'/resources/assets/admin/'}}css/shortcodes.css">
   <script type="text/javascript">
       function delete_single(id) {
           if (id>0) {
            $('#delete_single_btn').attr('disabled',true);
            $.ajax({
                url: "{{url('').'/admin/index-plan/delete'}}",
                type: 'POST',
                data: {'id_index': id,'_token':'{{csrf_token()}}'},
            })
            .done(function() {
                location.reload();
            })
            .fail(function() {
                alert("Error deleting record");
            })
            .always(function() {
                $('#delete_single_btn').attr('disabled',false);
            });
            
           }
       }
       function open_modal_delete_selected() {
           $('#modal-delete-selected-plan').modal('show');
           $('#delete-selected-body-information').html("");
           var selected=$('input[name="id_index[]"]:checked').length;
           $('#count-seleted').html(selected);
                  if (selected<1) {
                    $('#selected_zero').show()
                    $('#delete-selected-buttons').hide()
                  }else{
                    /*get seleccted users details*/
                    $.ajax({
                      url: base_url+'/admin/index-plan/get_index_plan_details',
                      type: 'POST',
                      data: $("#delete_client").serialize()
                    })
                    .done(function(response) {
                      console.log(response);
                      for (var i=0; i <response.length; i++) {
                          $('#delete-selected-body-information').prepend('<p>'+
                            '<strong>#'+response[i].id+'</strong>:<span>'+response[i].name_line1+' '+response[i].name_line2+'  </span>'+
                            '</p>');                      
                      }
                      })
                    .fail(function() {
                      console.log("error");
                    })
                    .always(function() {
                      $('#selected_zero').hide()
                      $('#delete-selected-buttons').show();
                      
                    });
                    
                    /*End*/
                    
                  }
       }
       $(document).on('click', '#delete_bulk', function(event) {
                  var selected=$('input[name="id_index[]"]:checked').length;

                  event.preventDefault();
                  if (selected<1) {
                    $('#delete-selected-body').prepend('<p class="alert alert-danger">Please select items</p>');
                  }else{
                    
                    $('#delete_bulk').attr("disabled",true);
                    $.ajax({
                      url: base_url+'/admin/index-plan/delete',
                      type: 'POST',
                      
                      data: $("#delete_client").serialize(),
                    })
                    .done(function() {
                      location.reload();
                    })
                    .fail(function() {
                      $('#modal-delete-selected').modal('hide');
                       alert("Error: no record was selected to delete");
                    })
                    .always(function() {
                      $('#delete_bulk').attr("disabled",false);
                    });
                  }
                      
                });
       $(document).on('click', '#update_so', function(event) {
         var data=[];
         data='<?php echo json_encode($indexplans) ?>';
         var obj=$.parseJSON(data);
         console.log(obj.data);
         var sort_order=[];
         for(var i=0;i<obj.data.length;i++){
            item={
              'id':obj.data[i].id,
              'sort_order':$('#'+obj.data[i].id).val(),
            };
            sort_order.push(item);
         }
         $.ajax({
           url: base_url+'/admin/index-plan/update_sort',
           type: 'POST',
           data: {'_token':'{{csrf_token()}}','data':sort_order},
         })
         .done(function() {
           $('#success_message').show();
           setTimeout(function() {
            $('#success_message').hide();
           }, 3000);

            $('html body').animate({
                                  scrollTop: $(".page-content").offset().top
                              }, 700);
         })
         .fail(function() {
           console.log("error");
         })
         .always(function() {
           console.log("complete");
         });
         
         
       });
       function ClickToSave (publish) {
       CKEDITOR.config.allowedContent = true;
       CKEDITOR.config.protectedSource.push(/<i[^>]*><\/i>/g);
    var content = CKEDITOR.instances.cms_content.getData();
    /*var left_header = CKEDITOR.instances.left_header.getData();
    var left_content = CKEDITOR.instances.left_content.getData();
    var right_header = CKEDITOR.instances.right_header.getData();
    var right_content = CKEDITOR.instances.right_content.getData();*/
          
        $.ajax({
       url: base_url+'/admin/pages/new',
       type: 'POST',
       data: {'_token':'{{csrf_token()}}',
               'name':'index plan', 
               'content':content, 
               'publish':publish, 
            },
         })
         .done(function(response) {
          if (publish==0) {
            window.open(base_url+"/");
          }else{
           $('#recent_update').html(response);
          }
           $('#success_message_cms').show();
           setTimeout(function() {
            $('#success_message_cms').hide();
           }, 3000);
          
            $('html body').animate({
                                  scrollTop: $(".page-content").offset().top
                              }, 700);           
         })
         .fail(function() {
           console.log("error");
         })
         .always(function() {
           console.log("complete");
         });
    }
    /*general features*/

   $('#frm_general_features').submit(function(event) {
    /* Act on the event */
    event.preventDefault();
    $('.red_error').html("");
    $('#frm_general_features_submit').hide();
    $('#frm_general_features_submit_wait').show();
    var formData = new FormData(this)
    $.ajax({
      url: base_url+'/admin/general_features/new',
      type: 'POST',
      data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false 
                
              })
    .done(function(response) {

     window.location.href=base_url+"/admin/index-plan?tab=general-features";
   })
    .fail(function(response) {
      $('#frm_general_features_submit_wait').hide();
          $('#frm_general_features_submit').show();
      validation_errors=response.responseJSON;
      console.log(validation_errors);
      $.each(validation_errors, function(k, v) {
                    //display the key and value pair
                    //console.log(k + ' is ' + v);
                    $('#gf_'+k).html(v)

                  });
                /*$('#status').html(validation_errors.status);
                $('#name_line1').html(validation_errors.name_line1);
                $('#name_line2').html(validation_errors.name_line2);
                $('#url').html(validation_errors.url);
                $('#sort_order').html(validation_errors.sort_order);
                $('#enable_plan_button_other').html(validation_errors.enable_plan_button_other);*/
                $('#error_message').show();
                $('html body').animate({
                  scrollTop: $(".page-content").offset().top
                }, 700);
              })
    .always(function(response) {

    });
  }); 
   $('#frm_add_testimonial').submit(function(event) {
    /* Act on the event */
    event.preventDefault();
    $('.red_error').html("");
    var formData = new FormData(this)
    $.ajax({
      url: base_url+'/admin/index-plan/new_testimonial',
      type: 'POST',
      data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false 
                
              })
    .done(function(response) {

     window.location.href=base_url+"/admin/index-plan?tab=testimonials";
   })
    .fail(function(response) {
      validation_errors=response.responseJSON;
      console.log(validation_errors);
      $.each(validation_errors, function(k, v) {
                    //display the key and value pair
                    //console.log(k + ' is ' + v);
                    $('#err_testimonial_'+k).html(v)

                  });
              })
    .always(function(response) {

    });
  });    
   
  function edit_general_feature(id) {
   $('#modal-edit-general-feature').modal('show');
   $.ajax({
     url: base_url+'/admin/general_features/edit/'+id,
   })
   .done(function(response) {
     $("#modal-edit-general-feature input[name='title']").val(response.title);
     $("#modal-edit-general-feature input[name='icon']").val(response.icon);
     $("#gf_description_edit").val(response.description);
     $("#gf_id_edit").val(response.id);
     $("#gf_img_edit").attr('src',base_url+"/storage/general_features/icon_images/"+response.icon_image);
   })
   .fail(function() {
     console.log("error");
   })
   .always(function() {
     console.log("complete");
   });

 }
  
         
 $('#frm_general_features_edit_submit').click(function(e) {

  $('#frm_general_features_edit').submit();

});

 $('#frm_general_features_edit').submit(function(event) {
   event.preventDefault();
 
   $('.red_error').html("");
    var formData = new FormData(this)
    $.ajax({
      url: base_url+"/admin/general_features/update",
      type: 'POST',
      data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false 
                
              })
    .done(function(response) {
     window.location.href=base_url+"/admin/index-plan?tab=general-features";
   })
    .fail(function(response) {
      validation_errors=response.responseJSON;
      console.log(validation_errors);
      $.each(validation_errors, function(k, v) {
                    //display the key and value pair
                    //console.log(k + ' is ' + v);
                    $('#gf_edit_'+k).html(v)

                  });
                /*$('#status').html(validation_errors.status);
                $('#name_line1').html(validation_errors.name_line1);
                $('#name_line2').html(validation_errors.name_line2);
                $('#url').html(validation_errors.url);
                $('#sort_order').html(validation_errors.sort_order);
                $('#enable_plan_button_other').html(validation_errors.enable_plan_button_other);*/
                $('#error_message').show();
                $('html body').animate({
                  scrollTop: $(".page-content").offset().top
                }, 700);
              })
    .always(function(response) {

    });
 });

 $('#frm_general_features_heading').submit(function(event) {
  event.preventDefault();

  $.ajax({
    url: base_url+'/admin/general_features/'+"heading_edit",
    type: 'POST',
    data: $('#frm_general_features_heading').serialize(),
  })
  .done(function() {
    window.location.href=base_url+"/admin/index-plan?tab=general-features";
  })
  .fail(function(response) {
    $('#gf_heading').html(response.responseJSON.heading);
  })
  .always(function() {
    console.log("complete");
  });
});
 $.fn.modal.Constructor.prototype.enforceFocus = function() {
  modal_this = this
  $(document).on('focusin.modal', function (e) {
    if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length 
    && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') 
    && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_textarea') 
    && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
      modal_this.$element.focus()
    }
  })
};
 
function  add_video(id) {
    $("#video_popup_heading").html("Add New Video");
    if (id>0) {
      $("#video_popup_heading").html("Edit Video");
      $.ajax({
        url: base_url+'/admin/get_video/'+id,
      })
      .done(function(response) {
        if (response.status==0) {
               $('.make-switch').bootstrapSwitch('setState', false); // true || false
              }
        $('input[name=video_title]').val(response.video_title);
        $('input[name=video_heading]').val(response.heading);
        $('#content_video').html(response.link);
        $('#video_id').val(response.id);
      })
      .fail(function() {
        alert("error getting video data");
      })
      .always(function() {
        console.log("complete");
      });
      
    }
    $('#modal-add-faq').modal('show');
    
    
}
$(document).on('submit', '#frm_save_video', function(event) {
  $('.red_error').html("");
  event.preventDefault();
  $('#video_link').val(CKEDITOR.instances.content_video.getData());
  $.ajax({
      url: base_url+'/admin/save_video',
      type: 'POST',
      data: $("#frm_save_video").serialize(),
    })
    .done(function() {
      window.location.href=base_url+"/admin/index-plan?tab=video";
    })
    .fail(function(response) {
      console.log(response);
      if (response.responseText=="activated_count_error") {
        $('#video_err_video_status').html("There is already 1 video with status active, you cannot set active status for this video");
        return;
      }
      validation_errors=response.responseJSON;
       $.each(validation_errors, function(k, v) {
                    //display the key and value pair
                    //console.log(k + ' is ' + v);
                    $('#video_err_'+k).html(v)
                  });
    })
    .always(function() {
      console.log("complete");
    });
});
function delete_single_video(id) {
           if (id>0) {
            $('#delete_single_video_btn').attr('disabled',true);
            $.ajax({
                url: "{{url('').'/admin/delete_video'}}",
                type: 'POST',
                data: {'id_video': id,'_token':'{{csrf_token()}}'},
            })
            .done(function() {
                window.location.href=base_url+"/admin/index-plan?tab=video";
            })
            .fail(function() {
                alert("Error deleting record");
            })
            .always(function() {
                $('#delete_single_video_btn').attr('disabled',false);
            });
            
           }
       }
$('#frm_services').submit(function(event) {
  event.preventDefault();
  console.log($('#frm_services').serializeArray());
  var content = CKEDITOR.instances.service_content.getData();
  $('#service_content_input').val(content);
  $.ajax({
    url: base_url+'/admin/index-plan/new_service',
    type: 'POST',
    data: $('#frm_services').serialize(),
  })
  .done(function() {
      window.location.href=base_url+'/admin/index-plan?tab=offer-services';
  })
  .fail(function(response) {
    console.log("error");
    validation_errors=response.responseJSON;
    $.each(validation_errors, function(k, v) {
                    //display the key and value pair
                    //console.log(k + ' is ' + v);
                    $('#err_off_services_'+k).html(v)

                  });
  })
  .always(function() {
    console.log("complete");
  });
  
});
function delete_offer_services(id) {
  if (id>0) {
    $.ajax({
    url: base_url+'/admin/index-plan/delete_service',
    type: 'POST',
    data: {'_token':csrf_token,'id_os':id},
  })
  .done(function() {
      window.location.href=base_url+'/admin/index-plan?tab=offer-services';
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
  
  }
}
function delete_single_testimonial(id) {
  if (id>0) {
    $.ajax({
    url: base_url+'/admin/index-plan/delete_testimonial',
    type: 'POST',
    data: {'_token':csrf_token,'id_testimonial':id},
  })
  .done(function() {
      window.location.href=base_url+'/admin/index-plan?tab=testimonials';
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
  
  }
}
function store_offer_service(id) {
  $('.make-switch').bootstrapSwitch('setState', true); // true || false
  if (id>0) {
      $.ajax({
    url: base_url+'/admin/index-plan/get_service',
      type: 'POST',
      data: {'_token':csrf_token,'id':id},
    })
    .done(function(response) {
       if (response.status==0) {
               $('.make-switch').bootstrapSwitch('setState', false); // true || false
              }
      $('#frm_services input[name=title]').val(response.title);
      $('#frm_services input[name=id]').val(response.id);
      $('#frm_services input[name=display_order]').val(response.sort_order);
      $('#service_content').html(response.content);
        //window.location.href=base_url+'/admin/index-plan?tab=offer-services';
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
    
  }
  else{
    $('#frm_services input[name=title]').val("");
      $('#frm_services input[name=id]').val("0");
      $('#frm_services input[name=display_order]').val("");
      $('#service_content').html("");
  }
  $('#modal-add-service').modal('show');
}
$('#frm_offer_services_heading').submit(function(event) {
  event.preventDefault();

  $.ajax({
    url: base_url+'/admin/index-plan/heading_edit',
    type: 'POST',
    data: $('#frm_offer_services_heading').serialize(),
  })
  .done(function() {
       window.location.href=base_url+'/admin/index-plan?tab=offer-services';

  })
  .fail(function(response) {
    $('#os_heading').html(response.responseJSON.heading);
  })
  .always(function() {
    console.log("complete");
  });
});
$('#frm_testimonials_heading').submit(function(event) {
  event.preventDefault();

  $.ajax({
    url: base_url+'/admin/index-plan/heading_edit/testimonials',
    type: 'POST',
    data: $('#frm_testimonials_heading').serialize(),
  })
  .done(function() {
       window.location.href=base_url+'/admin/index-plan?tab=testimonials';

  })
  .fail(function(response) {
    $('#ts_heading').html(response.responseJSON.heading);
  })
  .always(function() {
    console.log("complete");
  });
});



       function check_all(section) {
        var radio_btn=$("#"+section);
         if(radio_btn. prop("checked") == true){
            $("."+section).each(function(){
              this.checked=true;
            })              
          }else{
            $("."+section).each(function(){
              this.checked=false;
            })              
          }
       }
function open_modal_delete_selected_testimonials() {
          var model_id='modal-delete-selected-testimonial';
           $('#'+model_id).modal('show');
           $('#'+model_id+' #delete-selected-body-information').html("");
           var selected=$('input[name="id_testimonial[]"]:checked').length;
           $('#count-seleted').html(selected);
                  if (selected<1) {
                    $('#'+model_id+' #selected_zero').show()
                    $('#'+model_id+' #delete-selected-buttons').hide()
                  }else{
                    /*get seleccted users details*/
                    $.ajax({
                      url: base_url+'/admin/index-plan/get_testimonial_details',
                      type: 'POST',
                      data: $("#delete_testimonial").serialize()
                    })
                    .done(function(response) {
                      console.log(response);
                      for (var i=0; i <response.length; i++) {
                          $('#'+model_id+' #delete-selected-body-information').prepend('<p>'+
                            '<strong>#'+response[i].id+'</strong>:<span>'+response[i].client_name+'  </span>'+
                            '</p>');                      
                      }
                      })
                    .fail(function() {
                      console.log("error");
                    })
                    .always(function() {
                      $('#'+model_id+' #selected_zero').hide()
                      $('#'+model_id+' #delete-selected-buttons').show();
                      
                    });
                    
                    /*End*/
                    
                  }
       }
       function delete_bulk_testimonial() {
        var model_id='modal-delete-selected-testimonial';
          var selected=$('input[name="id_testimonial[]"]:checked').length;
                  if (selected<1) {
                    $('#'+model_id+' #delete-selected-body').prepend('<p class="alert alert-danger">Please select items</p>');
                  }else{
                    $(this).attr("disabled",true);
                    $.ajax({
                      url: base_url+'/admin/index-plan/delete_testimonial',
                      type: 'POST',
                      data: $("#delete_testimonial").serialize(),
                    })
                    .done(function() {
                       window.location.href=base_url+'/admin/index-plan?tab=testimonials';
                    })
                    .fail(function() {
                      $('#'+model_id).modal('hide');
                       alert("Error: no record was selected to delete");
                    })
                    .always(function() {
                      $(this).attr("disabled",false);
                    });
                  }
       }
       function delete_bulk_videos() {
        var model_id='modal-delete-selected-video';
          var selected=$('input[name="id_video[]"]:checked').length;
                  if (selected<1) {
                    $('#'+model_id+' #delete-selected-body').prepend('<p class="alert alert-danger">Please select items</p>');
                  }else{
                    $(this).attr("disabled",true);
                    $.ajax({
                      url: base_url+'/admin/delete_video',
                      type: 'POST',
                      data: $("#delete_selected_videos").serialize(),
                    })
                    .done(function() {
                       window.location.href=base_url+'/admin/index-plan?tab=video';
                    })
                    .fail(function() {
                      $('#'+model_id).modal('hide');
                       alert("Error: no record was selected to delete");
                    })
                    .always(function() {
                      $(this).attr("disabled",false);
                    });
                  }
       }
   function edit_testimonials(id) {
   $('#modal-edit-general-feature').modal('show');
   $.ajax({
     url: base_url+'/admin/index-plan/get_testimonial_details',
      type: 'POST',
      data: {'_token':csrf_token,'id_testimonial':id},
   })
   .done(function(response) {
     $("#frm_add_testimonial input[name='title']").val(response.title);
     $("#frm_add_testimonial input[name='icon']").val(response.icon);
     $("#gf_description_edit").val(response.description);
     $("#gf_id_edit").val(response.id);
     $("#gf_img_edit").attr('src',base_url+"/storage/general_features/icon_images/"+response.icon_image);
      $.each(validation_errors, function(k, v) {
                    //display the key and value pair
                    //console.log(k + ' is ' + v);
                    $('#input[name='+k+']').html(v);

                  });
   })
   .fail(function() {
     console.log("error");
   })
   .always(function() {
     console.log("complete");
   });

 }
 function  save_testimonial(id) {
  $('.make-switch').bootstrapSwitch('setState', true); // true || false
     $('input[name=client_name]').val("");
        $('input[name=company]').val("");
        $('#testimonial_content').val("");
        $('input[name=service]').val("");
      $("#client_image_img").hide();
    $("#id_testimonial_txtbox").val(id);
    $("#modal-add-testimonial-heading").html("Add New Video");
    if (id>0) {
      $("#modal-add-testimonial-heading").html("Edit Video");
      $("#client_image_img").show();
      $.ajax({
        url: base_url+'/admin/index-plan/get_testimonial_details',
        type: 'POST',
        data: {'_token':csrf_token,'id_testimonial':id},
      })
      .done(function(response) {
        if (response.status==0) {
               $('.make-switch').bootstrapSwitch('setState', false); // true || false
              }
        $('input[name=client_name]').val(response.client_name);
        $('input[name=company]').val(response.company);
        $('#testimonial_content').val(response.content);
        $('input[name=service]').val(response.service);
        $('#client_image_img').attr('src', base_url+'/storage/general_features/testimonials/'+response.client_image);
      })
      .fail(function() {
        alert("error getting video data");
      })
      .always(function() {
        console.log("complete");
      });
      
    }
    $("#modal-add-testimonial").modal("show");
    
    
}
function gf_open_modal_delete_selected() {
      $('#modal-delete-selected-gf #delete-selected-body-information').html("");
      $("#modal-delete-selected-gf").modal('show');
      var selected=$('input[name="id_gf[]"]:checked').length;
      if (selected<1) {
        $('#modal-delete-selected-gf #selected_zero').show()
        $('#modal-delete-selected-gf #delete-selected-buttons').hide()
      }else{
        /*get seleccted users details*/
        $.ajax({
          url: base_url+'/admin/general_features/get_details',
          type: 'POST',
          data: $("#delete_general_features").serialize()
        })
        .done(function(response) {
          console.log(response);
          for (var i=0; i <response.length; i++) {
            $('#modal-delete-selected-gf #delete-selected-body-information').prepend('<p>'+
              '<strong>#'+response[i].id+'</strong>:<span>'+response[i].title+'</p>');                      
          }
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          $('#modal-delete-selected-gf #selected_zero').hide()
          $('#modal-delete-selected-gf #delete-selected-buttons').show();
          $('#modal-delete-selected-gf #count-seleted').html(selected);
        });

        /*End*/

      }
    }
    $(document).on('click', '#delete_bulk_gf', function(event,form_id) {
      var selected=$('input[name="id_gf[]"]:checked').length;


      event.preventDefault();
      if (selected<1) {
        $('#delete-selected-body').prepend('<p class="alert alert-danger">Please select items</p>');
      }else{

        $('#delete_bulk_gf').attr("disabled",true);
        $.ajax({
          url: base_url+'/admin/general_features/delete',
          type: 'POST',

          data: $("#delete_general_features").serialize(),
        })
        .done(function() {
          window.location.href=base_url+"/admin/index-plan?tab=general-features";
        })
        .fail(function() {
          $('#modal-delete-selected').modal('hide');
          alert("Error: no record was selected to delete");
        })
        .always(function() {
          $('#delete_bulk_gf').attr("disabled",false);
        });
      }

    });
    $(document).on('click', '#delete_bulk_os', function(event,form_id) {
      var selected=$('input[name="id_os[]"]:checked').length;


      event.preventDefault();
      if (selected<1) {
        $('#delete-selected-body').prepend('<p class="alert alert-danger">Please select items</p>');
      }else{

        $('#delete_bulk_os').attr("disabled",true);
        $.ajax({
          url: base_url+'/admin/index-plan/delete_service',
          type: 'POST',

          data: $("#delete_os").serialize(),
        })
        .done(function() {
          window.location.href=base_url+"/admin/index-plan?tab=offer-services";
        })
        .fail(function() {
          $('#modal-delete-selected').modal('hide');
          alert("Error: no record was selected to delete");
        })
        .always(function() {
          $('#delete_bulk_os').attr("disabled",false);
        });
      }

    });



function open_modal_delete_selected_os() {
      $('#modal-delete-selected-os #delete-selected-body-information').html("");
      $("#modal-delete-selected-os").modal('show');
      var selected=$('input[name="id_os[]"]:checked').length;
      if (selected<1) {
        $('#modal-delete-selected-os #selected_zero').show()
        $('#modal-delete-selected-os #delete-selected-buttons').hide()
      }else{
        /*get seleccted users details*/
        $.ajax({
          url: base_url+'/admin/index-plan/get_service',
          type: 'POST',
          data: $("#delete_os").serialize()
        })
        .done(function(response) {
          console.log(response);
          for (var i=0; i <response.length; i++) {
            $('#modal-delete-selected-os #delete-selected-body-information').prepend('<p>'+
              '<strong>#'+response[i].id+'</strong>:<span>'+response[i].title+'</p>');                      
          }
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          $('#modal-delete-selected-os #selected_zero').hide()
          $('#modal-delete-selected-os #delete-selected-buttons').show();
          $('#modal-delete-selected-os #count-seleted').html(selected);
        });

        /*End*/

      }
    }

       $(document).on('click', '#update_so_of', function(event) {
         console.log($("#delete_os").serialize());
         $.ajax({
           url: base_url+'/admin/index-plan/update_sort_offer_services',
           type: 'POST',
           data: $("#delete_os").serialize(),
         })
         .done(function() {
           $('#success_message').show();
           setTimeout(function() {
            $('#success_message').hide();
           }, 3000);
            $('html body').animate({
                                  scrollTop: $(".page-content").offset().top
                              }, 700);
         
         })
          
         .fail(function() {
           console.log("error");
         })
         .always(function() {
           console.log("complete");
         });
         
         
       });
       function open_modal_delete_selected_videos() {
          var model_id='modal-delete-selected-videos';
           $('#'+model_id).modal('show');
           $('#'+model_id+' #delete-selected-body-information').html("");
           var selected=$('input[name="id_video[]"]:checked').length;
           $('#count-seleted').html(selected);
                  if (selected<1) {
                    $('#'+model_id+' #selected_zero').show()
                    $('#'+model_id+' #delete-selected-buttons').hide()
                  }else{
                    /*get seleccted users details*/
                    $.ajax({
                      url: base_url+'/admin/index-plan/get_videos_details',
                      type: 'POST',
                      data: $("#delete_selected_videos").serialize()
                    })
                    .done(function(response) {
                      console.log(response);
                      for (var i=0; i <response.length; i++) {
                          $('#'+model_id+' #delete-selected-body-information').prepend('<p>'+
                            '<strong>#'+response[i].id+'</strong>:<span>'+response[i].video_title+'  </span>'+
                            '</p>');                      
                      }
                      })
                    .fail(function() {
                      console.log("error");
                    })
                    .always(function() {
                      $('#'+model_id+' #selected_zero').hide()
                      $('#'+model_id+' #delete-selected-buttons').show();
                      
                    });
                    
                    /*End*/
                    
                  }
       }
      
   </script>


</script>
<script type="text/javascript">
  $('#saveAndPublish').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
</script>
@if(isset($_GET['tab']))
<?php $tab_name= $_GET['tab']; ?>
<script>
  $('.nav-tabs a[href="#' + '{{$tab_name}}' + '"]').tab('show');
</script>
@endif
@endsection