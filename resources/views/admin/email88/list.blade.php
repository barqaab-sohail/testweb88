<div id="email88-special-features" class="tab-pane fade">
    <div class="portlet">
        <div class="portlet-header">
            <div class="caption">Email88 New & Special Features Heading Edit</div>
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
                            <th>Feature Sub Heading</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><span class="label label-xs label-{{$email88_special_features[0]['heading_status']?'success':'danger'}}">{{$email88_special_features[0]['heading_status']?'Active':'Inactive'}}</span></td>
                            <td>{{$email88_special_features[0]['heading']}}</td>
                            <td>{{$email88_special_features[0]['sub_heading']}}</td>
                            <td>{!!$email88_special_features[0]['content']!!}</td>
                            <td><a href="#" data-hover="tooltip" data-placement="top" data-target="#modal-email88-edit-feature-title" data-toggle="modal" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                <!--Modal Edit new &  special feature heading text start-->
                                <div id="modal-email88-edit-feature-title" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                    <div class="modal-dialog modal-wide-width">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                <h4 id="modal-login-label3" class="modal-title">Edit Feature Heading Text</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form">
                                                    <form id="frm_email88_features_heading" class="form-horizontal">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="page" class="form-control" value="{{$page_name}}">
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Status</label>
                                                            <div class="col-md-6">
                                                                <div data-on="success" data-off="primary" class="make-switch">
                                                                    <input name="status" id="email88_heading_status" type="checkbox" @if($email88_special_features[0]['heading_status']==1) checked="checked" @endif/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Feature Heading <span class="text-red">*</span> </label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="heading"  class="form-control"  value="{{$email88_special_features[0]['heading']}}">
                                                                <p class="red_error" id="gf_heading"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Feature Sub Heading <span class="text-red">*</span> </label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="sub_heading"  class="form-control"  value="{{$email88_special_features[0]['sub_heading']}}">
                                                                <p class="red_error" id="gf_heading"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Content</label>
                                                            <div class="col-md-9">
                                                                <div class="text-blue border-bottom">You can edit the content by clicking the text below.</div>
                                                                <div id="email88_cms_content" contenteditable="true">
                                                                    {!!$email88_special_features[0]['content']!!}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-actions">
                                                            <div class="col-md-offset-5 col-md-8"> <a onclick="save_email88_content()" href="javascript:void" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END MODAL Edit new & special feature heading text-->
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
            <div class="caption">Email88 New & Special Features Listing</div>
            <p class="margin-top-10px"></p>
            <a href="javascript:void" onclick="add_email88_special_feature(0)" data-target="#modal-email88-add-new-special-feature" data-toggle="modal" class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Delete</button>
                <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                <ul role="menu" class="dropdown-menu">
                    <li><a href="javascript:void" onclick="email88_open_modal_delete_selected(1)">Delete selected item(s)</a></li>
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
            <!-- #Add New & Special Feature block: modal delete all items end -->
            <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
            <!--Modal Add new & special feature start-->
            <div id="modal-email88-add-new-special-feature" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                <div class="modal-dialog modal-wide-width">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                            <h4 id="modal-login-label3" class="modal-title">Add New &amp; Special Feature</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form">
                                <form class="form-horizontal" id="frm_email88_special_features">
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
                                            <input type="text" name="title" class="form-control" placeholder="eg. Multiple scheduling options">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Feature Description</label>
                                        <div class="col-md-6">
                                            <div class="text-blue border-bottom">You can edit the content by clicking the text below.</div>
                                            <div id="email88_add_cms_content" contenteditable="true">

                                            </div>
                                            <!--<textarea  name="description" class="form-control"></textarea>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Upload Feature Image</label>
                                        <div class="col-md-9">
                                            <div class="xs-margin"></div>
                                            <input name="icon_image[]" id="exampleInputFile2" type="file" multiple/>
                                            <span class="help-block"><b>Can attach more than one</b>(Image dimension: 720 x 400 pixels, JPEG/GIF/PNG only, Max. 2MB) </span>
                                            <input type="text" name="icon" class="form-control" placeholder="Image alt text">
                                            <div class="xs-margin"></div>
                                            <div class="border-bottom"></div>
                                            <div class="xs-margin"></div>
                                            <!--<a href="#" class="btn-sm btn-success">Add Another &nbsp;<i class="fa fa-plus"></i></a>-->
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8">
                                            <button class="btn btn-red" id="frm_email88_special_features_submit">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp;
                                            <button type="button" style="display: none" id="frm_email88_special_features_submit_wait" class="btn btn-red">Uploading  <i class="loading_icon fa fa-spinner fa-spin fa-large"></i></button>
                                            <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END MODAL Add New general Feature-->
            <!--Modal Edit -Email88 New & Special Features Listing Start-->
            <div id="modal-edit-email88-special-feature" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                <div class="modal-dialog modal-wide-width">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                            <h4 id="email88_edit_heading" class="modal-title">Email88 New & Special Features Listing Edit</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frm_email88_special_features_edit" class="form-horizontal" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="form">


                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Status</label>
                                        <div class="col-md-6">
                                            <div data-on="success" data-off="primary" class="make-switch">
                                                <input name="status" id="status" type="checkbox" checked="checked"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Feature Title <span class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <input type="hidden" name="id" type="hidden" id="email88_id_edit" class="form-control">
                                            <input type="hidden" name="page" type="hidden" class="form-control" value="{{$page_name}}">
                                            <input type="text" name="title"   class="form-control" placeholder="eg. Ultra-Fast Platform ">
                                            <p class="red_error" id="gf_title"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Feature Description</label>
                                        <div class="col-md-9">
                                        <!--<div class="col-md-6">
                                            <textarea id="gf_description_edit"  name="description" class="form-control"></textarea>
                                            <p class="red_error" id="gf_description"></p>
                                        </div>-->
                                        <div class="text-blue border-bottom">You can edit the content by clicking the text below.</div>
                                        <div id="email88_description_edit" contenteditable="true">
                                        </div>      
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Upload Feature Image</label>
                                        <div class="col-md-9">
                                            <div class="xs-margin"></div>
                                            <div id="email88_img_edit"></div>
                                            <a hidden="" href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-icon" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                            <div class="xs-margin"></div> 

                                            <input name="icon_image[]" id="exampleInputFile2" type="file" multiple/>
                                            <span class="help-block"><b>Can attach more than one</b>(Image dimension: 720 x 400 pixels, JPEG/GIF/PNG only, Max. 2MB) </span>
                                            <div class="xs-margin"></div>
                                            <input type="text" name="icon" class="form-control" placeholder="Image alt text" value="Send in the future multiple times">
                                            <div class="xs-margin"></div>
                                            <div class="border-bottom"></div>
                                            <div class="xs-margin"></div>
                                            <!--<a href="#" class="btn-sm btn-success">Add Another &nbsp;<i class="fa fa-plus"></i></a>-->
                                            <!--Modal delete icon start-->
                                            <div id="modal-delete-icon" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                            <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this icon image? </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><img src="{{url('').'/resources/assets/frontend/'}}images/about_us/icon_cloud_app.png" alt="Ultra-Fast Platform" class="img-responsive"></p>
                                                            <div class="form-actions">
                                                                <div class="col-md-offset-4 col-md-8"> <a href="#" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal delete end -->

                                        </div>
                                    </div>                                    

                                </div>
                                <div class="form-actions">
                                    <div class="col-md-offset-5 col-md-8">
                                        <button type="button" id="frm_email88_special_features_edit_submit" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>

                                        &nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
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
                        <th width="1%"><input id="email88_checkbox" onchange="check_all('email88_checkbox')" type="checkbox"></th>
                        <th>#</th>
                        <th>Status</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <form id="delete_email88_features">
                    {{csrf_field()}}
                    <?php $count_gf = 0; ?>
                    @if(!empty($email88_special_features))
                    @foreach($email88_special_features as $i)
                    <?php $count_gf++; ?>
                    <tr>
                        <td><input type="checkbox" class="email88_checkbox" value="{{$i->id}}" name="id_email88[]"></td>
                        <td>{{$count_gf}}</td>
                        <td><span class="label label-xs label-{{$i->status?'success':'danger'}}">{{$i->status?'Active':'Inactive'}}</span></td>
                        <td>{{$i->title}}</td>
                        <td><a href="javascript:void" onclick="edit_email88_special_feature({{$i->id}})" data-hover="tooltip" data-placement="top"  title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a> <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-email88-feature-{{$i->id}}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>

                            <!--Modal delete start-->
                            <div id="modal-delete-email88-feature-{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                            <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this? </h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>#{{$i->id}}:</strong>{{$i->title}}</p>
                                            <div class="form-actions">
                                                <div class="col-md-offset-4 col-md-8"> <button type="button" onclick="delete_email88_single({{$i->id}})" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
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
    <div id="modal-delete-selected-email88" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the Email88 New & Special Features Listing
                        <span id="count-seleted"></span> item(s)? </h4>
                </div>
                <div class="modal-body" id="delete-selected-body">
                    <div id="delete-selected-body-information"></div>
                    <p id="selected_zero" style="display:none" class="alert alert-danger">Please select at least one item for delete</p>
                    <div class="form-actions" id="delete-selected-buttons">
                        <div class="col-md-offset-4 col-md-8">
                            <button type="button" id="delete_bulk_email88" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>
                            <button type="button" id="delete_bulk_email88_ssl" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>
                            &nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- end tab general features -->
<script type="text/javascript">


</script>