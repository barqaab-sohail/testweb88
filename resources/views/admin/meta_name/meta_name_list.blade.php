<?php
$page = 'meta_name';
$breadcrumbs = [
    array('url' => false, 'name' => 'Global Setup'),
    array('url' => url('clients/meta_name'), 'name' => 'Meta Name Setup'),
];
?>
@extends('layouts.admin_layout')
@section('title','Admin | Meta Name List')
@section('page_header','Global Setup')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <h2>Meta Name <i class="fa fa-angle-right"></i> Setup</h2>
            <div class="clearfix"></div>
            @if(session('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                <p>The information has been saved/updated successfully.</p>
            </div>
            @endif
            {{-- <div id="successMessageWrap" class="alert alert-success alert-dismissable" style="display: none;">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                <p id="successMessage">The information has been saved/updated successfully.</p>
            </div> --}}
            <div id="errorMessageWrap" class="alert alert-danger alert-dismissable" style="display: none;">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                <p id="errorMessage">The information has not been saved/updated. Please correct the errors.</p>
            </div>
            <div class="pull-left"> Last updated: <span class="text-blue">{{$recent_update}}</span> </div>

            <div class="clearfix"></div>
            <p></p>
            <div class="clearfix"></div>
        </div>
        <div class="col-lg-12">
            <div class="portlet">
                <div class="portlet-header">
                    <div class="caption">Meta Name Setup</div>
                    <br />
                    <p class="margin-top-10px"></p>
                    <a href="#" class="btn btn-success" data-target="#modal-add-rate" data-toggle="modal">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Delete</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="#" class="selectedDelete">Delete selected item(s)</a></li>
                            <li class="divider"></li>
                            <li><a href="#" id="allMetaDelete">Delete all</a></li>
                        </ul>
                    </div>

                    <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    <!--Modal add new rate start-->
                    <div id="modal-add-rate" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                        <div class="modal-dialog modal-wide-width">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close meta-form-close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title">Add New </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form">
                                        <form class="form-horizontal" id="meta_form">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                    <div data-on="success" data-off="primary" class="make-switch">
                                                        <input type="checkbox" name="meta_status" checked="checked" />
                                                    </div>
                                                    <div class="red_error" id="metaStatus"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Page Name <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="page_name" class="form-control" placeholder="eg. Home">
                                                    <div class="red_error" id="pageName"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Page Title <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="page_title" class="form-control" placeholder="eg. Home">
                                                    <div class="red_error" id="pageTitle"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Meta Keyword <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                    <textarea name="meta_keyword" class="form-control" placeholder="eg. web hosting, web design"></textarea>
                                                    <div class="red_error" id="metaKeyword"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Meta Description <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                    <textarea name="meta_description" class="form-control" placeholder="eg. Webqom is an established Malaysia web hosting company with 10 years of experience and expertise in providing high performance and most reliable web hosting, email hosting, reseller hosting, VPS, dedicated servers, SSL and .my domain registration at affordable price. "></textarea>
                                                    <div class="red_error" id="metaDescription"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Apply to Pages <span class='require'>*</span></label>
                                                <div class="col-md-6">
                                                    <select name="pages" class="form-control validate[required]">
                                                        <optgroup label="webqom.com.my">
                                                            @if(!empty($categories))
                                                            @foreach($categories as $i)
                                                            @if($i->title=='Home')
                                                            <option value="index plan">-Home</option>
                                                            @else
                                                        <optgroup label="-{{$i->title}}">
                                                            @if($i->sub_categories)
                                                            @foreach($i->sub_categories->sortBy('sort_order') as $j)
                                                            @if($i->getMetaInfoByCatTitle($j->title, 'meta_status') == 0)
                                                            <option value="{{strtolower($j->title)}}">&nbsp; --{{$j->title}}</option>
                                                            @endif
                                                            @endforeach
                                                            @endif
                                                        </optgroup>
                                                        @endif
                                                        @endforeach
                                                        @endif
                                                        {{-- <option value="">-Home</option>
                                                            <option value="">-Company</option>
                                                            <option value="">&nbsp; --Blog</option>
                                                            <option value="">-Hosting</option>
                                                            <option value="">&nbsp; --Cloud Hosting</option>
                                                            <option value="">&nbsp; --Co-Location Server</option>
                                                            <option value="">&nbsp; --Dedicated Servers</option>
                                                            <option value="">&nbsp; --VPS Hosting</option>
                                                            <option value="">&nbsp; --Reseller Hosting</option>
                                                            <option value="">&nbsp; --Shared Hosting</option>
                                                            <option value="">-Applications</option>
                                                            <option value="">&nbsp; --Xcommerce</option>
                                                            <option value="">&nbsp; --Email88</option>
                                                            <option value="">&nbsp; --Web88IR</option>
                                                            <option value="">&nbsp; --Responsive Web Design</option>
                                                            <option value="">&nbsp; --Web88 CMS</option>
                                                            <option value="">&nbsp; --Big Saver CNY Deals</option>
                                                            <option value="">-Domains</option>
                                                            <option value="">&nbsp; --Single Domain Search</option>
                                                            <option value="">&nbsp; --Bulk Domain Search</option>
                                                            <option value="">&nbsp; --Single Domain Transfer</option>
                                                            <option value="">&nbsp; --Bulk Domain Transfer</option>
                                                            <option value="">-Support</option>
                                                            <option value="">&nbsp; --Support Center</option> --}}
                                                        </optgroup>
                                                    </select>
                                                    <div class="red_error" id="selectPage"></div>
                                                </div>
                                            </div>

                                            <div id="successMessageWrap" class="form-group" style="display: none;">
                                                <label class="col-md-3 control-label">Page URL</label>
                                                <div class="col-md-6">
                                                    note to programmer: display the below page url for administrator to click for view the page after "Save"
                                                    <p id="successMessage" style="color: green;"></p>
                                                    <div class="margin-top-10px">
                                                        <a id="successUrl" href="http://www.webqom.com.my/services/cloud_hosting">http://www.webqom.com.my/services/cloud_hosting</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0)" id="save_meta" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green meta-form-close">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END MODAL add new discount -->
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
                                    {{ Form::open([ 'url' => url('admin/meta_name_selected_delete') ]) }}
                                    {{ Form::hidden('target_metas', '', [ 'id' => 'selectedArrayValue' ]) }}
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
                                    <p id="appendAllSelectedHtml"></p>
                                    {{ Form::open([ 'url' => url('admin/meta_name_selected_delete') ]) }}
                                    {{ Form::hidden('target_metas', '', [ 'id' => 'selectedAllArrayValue' ]) }}
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
                            <select id="metaPagination" name="select" class="form-control">
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
                    <div class="table-responsive mtl">
                        <table id="example1" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="1%"><input id="metaCheckSelectAll" type="checkbox" /></th>
                                    <th>#</th>
                                    <th><a href="#sort by page name">Page Name</a></th>
                                    <th><a href="#sort by page title">Page Title</a></th>
                                    <th><a href="#sort by status">Status</a></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($metaInfo))
                                @php $i = ($metaInfo->perPage() * ($metaInfo->currentPage() - 1)) + 1; @endphp
                                @foreach($metaInfo as $meta)
                                @if(isset($meta->page_name))
                                <tr>
                                    <td><input type="checkbox" class="metaCheck" data-id="{{ $meta->id }}" data-name="{{$meta->page_name}}" /></td>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $meta->page_name }}</td>
                                    <td>{{ $meta->page_title }}</td>
                                    <td>
                                        @if($meta->meta_status == 1)
                                        <span class="label label-xs label-success">Active</span>
                                        @endif
                                        @if($meta->meta_status == 2)
                                        <span class="label label-xs label-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" data-hover="tooltip" data-placement="top" title="Edit" data-target="#modal-edit-meta-{{ $meta->id }}" data-toggle="modal"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                        <a href="#" class="deleteById" data-hover="tooltip" data-placement="top" title="Delete" data-id="{{ $meta->id }}" data-name="{{$meta->page_name}}"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                        <!--Modal edit meta name start-->
                                        <div id="modal-edit-meta-{{ $meta->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                            <div class="modal-dialog modal-wide-width">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close meta-form-close">&times;</button>
                                                        <h4 id="modal-login-label3" class="modal-title">Edit Meta Name</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form">
                                                            <form class="form-horizontal" id="meta_update_form-{{ $meta->id}}">
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                                                                    <div class="col-md-6">
                                                                        <div data-on="success" data-off="primary" class="make-switch">
                                                                            <input type="checkbox" name="meta_status" @if($meta->meta_status == 1) checked="checked" @endif />
                                                                            <input type="hidden" name="id" value="{{ $meta->id }}" />
                                                                        </div>
                                                                        <div class="red_error" id="metaStatusUpdate"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Page Name <span class="text-red">*</span></label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="page_name" class="form-control" placeholder="eg. Home" value="{{ $meta->page_name }}">
                                                                        <div class="red_error" id="pageNameUpdate"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Page Title <span class="text-red">*</span></label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="page_title" class="form-control" placeholder="eg. Home" value="{{ $meta->page_title }}">
                                                                        <div class="red_error" id="pageTitleUpdate"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Meta Keyword <span class="text-red">*</span></label>
                                                                    <div class="col-md-6">
                                                                        <textarea name="meta_keyword" class="form-control" placeholder="eg. web hosting, web design">{{ $meta->meta_keyword }}</textarea>
                                                                        <div class="red_error" id="metaKeywordUpdate"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Meta Description <span class="text-red">*</span></label>
                                                                    <div class="col-md-6">
                                                                        <textarea name="meta_description" class="form-control" placeholder="eg. Webqom is an established Malaysia web hosting company with 10 years of experience and expertise in providing high performance and most reliable web hosting, email hosting, reseller hosting, VPS, dedicated servers, SSL and .my domain registration at affordable price. ">{{ $meta->meta_description }}</textarea>
                                                                        <div class="red_error" id="metaDescriptionUpdate"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputFirstName" class="col-md-3 control-label">Apply to Pages <span class='require'>*</span></label>
                                                                    <div class="col-md-6">
                                                                        <select name="pages" class="form-control validate[required]">
                                                                            <option value="{{strtolower($meta->name)}}">&nbsp; {{ $meta->name }}</option>
                                                                        </select>
                                                                        <div class="red_error" id="selectPageUpdate"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="successMessageUpdateWrap-{{$meta->id}}" style="display: none;">
                                                                    <label class="col-md-3 control-label">Page URL</label>
                                                                    <div class="col-md-6">
                                                                        note to programmer: display the below page url for administrator to click for view the page after "Save"
                                                                        <p id="successMessageUpdate-{{$meta->id}}" style="color: green;"></p>
                                                                        <div class="margin-top-10px">
                                                                            <a id="successUrlUpdate-{{$meta->id}}" target="_blank" href=""></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <div class="col-md-offset-5 col-md-8"> <a href="javascript:void(0)" class="btn btn-red update_meta disableBtn-{{$meta->id}}" data-id="{{ $meta->id }}">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green meta-form-close">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="modal-delete-by-id" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                        <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this item? </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p id="appendSelectedHtmlDeleteById"></p>
                                                        {{ Form::open([ 'url' => url('admin/meta_name_selected_delete') ]) }}
                                                        {{ Form::hidden('target_metas', '', [ 'id' => 'metaDeleteById' ]) }}
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
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="tool-footer text-right">
                            <p class="pull-left">Showing page {{ $metaInfo->currentPage() }} of {{ $metaInfo->lastPage() }} total {{ $metaInfo->total() }} entries</p>
                            {{ $metaInfo->appends(Request::all())->links() }}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script>
    $(document).ready(function() {
        document.getElementById('metaPagination').onchange = function() {
            window.location = "{{ $metaInfo->url(1) }}&items=" + this.value;
        };
        $('#save_meta').click(function(event) {
            $('#errorMessageWrap').hide();
            $('#successMessageWrap').hide();
            $('.red_error').html('');
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: base_url + '/admin/meta_name_create',
                type: 'POST',
                data: $("#meta_form").serialize(),
                success: function(data) {
                    if (data.status == 200) {
                        let url;
                        if (data.url_slug == 'index_plan') {
                            url = base_url;
                        } else {
                            url = base_url + '/services/' + data.url_slug;
                        }
                        $('#successUrl').attr('href', url);
                        $('#successUrl').text(url);
                        $('#successMessage').text(data.message);
                        $('#successMessageWrap').show();
                        $('#save_meta').attr("disabled", 'disabled');
                    }
                    if (data.status == 404) {
                        $('#modal-add-rate').modal('hide');
                        $('#errorMessage').text(data.message);
                        $('#errorMessageWrap').show();
                    }
                },
                error: function(response) {
                    $('#metaStatus').html(response.responseJSON.meta_status);
                    $('#pageName').html(response.responseJSON.page_name);
                    $('#pageTitle').html(response.responseJSON.page_title);
                    $('#metaKeyword').html(response.responseJSON.meta_keyword);
                    $('#metaDescription').html(response.responseJSON.meta_description);
                    $('#selectPage').html(response.responseJSON.pages);
                }
            });
        });

        $(document).on('click', '.meta-form-close', function() {
            location.reload();
        });

        $(document).on('click', '#metaCheckSelectAll', function() {
            let baseChecked = $('#metaCheckSelectAll').is(':checked');
            if (baseChecked) {
                $('input:checkbox.metaCheck').prop("checked", true);
            } else {
                $('input:checkbox.metaCheck').prop("checked", false);
            }
        });

        $(document).on('click', '.metaCheck', function() {
            let numberOfChecked = $('.metaCheck:checked').length;
            if (numberOfChecked => 1) {
                $('#metaCheckSelectAll').prop('checked', true);
            }
            if (numberOfChecked == 0) {
                $('#metaCheckSelectAll').prop('checked', false);
            }
        });

        $('.selectedDelete').on('click', function(event) {
            let metas = [];
            let pageName = [];
            $(".metaCheck:checked").each(function() {
                metas.push($(this).data('id'));
                pageName.push($(this).data('name'));
            });
            if (metas.length <= 0) {
                $("#modal-delete-selected-error").modal('show');
            } else {
                console.log(metas)
                $("#appendSelectedHtml").empty();
                let htmls = new Array();
                $.each(pageName, function(index, options) {
                    htmls.push('<strong> Meta #: </strong>' + options + '<br />')
                })
                $("#selectedArrayValue").val(metas);
                $("#appendSelectedHtml").append(htmls);
                $("#modal-delete-selected").modal('show');
            }
        });

        $('.deleteById').on('click', function(event) {
            let meta = $(this).data('id');
            let pageName = $(this).data('name');
            $("#appendSelectedHtmlDeleteById").empty();
            let htmls = '<strong> Meta #: </strong>' + pageName + '<br />';
            console.log(meta, pageName, htmls)
            $("#metaDeleteById").val(meta);
            $("#appendSelectedHtmlDeleteById").append(htmls);
            $("#modal-delete-by-id").modal('show');
        });

        // $('#allMetaDelete').on('click', function(event) {
        //     let metas = [];
        //     let pageName = [];
        //     $(".metaCheck").each(function() {
        //         metas.push($(this).data('id'));
        //         pageName.push($(this).data('name'));
        //     });
        //     if (metas.length <= 0) {
        //         $("#modal-delete-selected-error").modal('show');
        //     } else {
        //         console.log(metas)
        //         $("#appendAllSelectedHtml").empty();
        //         let htmls = new Array();
        //         $.each(pageName, function(index, options) {
        //             htmls.push('<strong> Meta #: </strong>' + options + '<br />')
        //         })
        //         $("#selectedAllArrayValue").val(metas);
        //         $("#appendAllSelectedHtml").append(htmls);
        //         $("#modal-delete-all").modal('show');
        //     }
        // });
        $('.update_meta').click(function(event) {
            let index = $(".update_meta").index(this);
            let modalId = $(".update_meta").eq(index).data('id');
            $('#errorMessageWrap').hide();
            $('#successMessageWrap').hide();
            $('.red_error').html('');
            event.preventDefault();
            console.log(modalId)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: base_url + '/admin/meta_name_update',
                type: 'POST',
                data: $("#meta_update_form-" + modalId).serialize(),
                success: function(data) {
                    if (data.status == 200) {
                        let url;
                        if (data.url_slug == 'index_plan') {
                            url = base_url;
                        } else {
                            url = base_url + '/services/' + data.url_slug;
                        }
                        $('#successUrlUpdate-' + modalId).attr('href', url);
                        $('#successUrlUpdate-' + modalId).text(url);
                        $('#successMessageUpdate-' + modalId).text(data.message);
                        $('#successMessageUpdateWrap-' + modalId).show();
                        $('.disableBtn-' + modalId).attr("disabled", 'disabled');
                    }
                    if (data.status == 404) {
                        $('#modal-edit-meta-' + modalId).modal('hide');
                        $('#errorMessage').text(data.message);
                        $('#errorMessageWrap').show();
                    }
                },
                error: function(response) {
                    $('#metaStatusUpdate').html(response.responseJSON.meta_status);
                    $('#pageNameUpdate').html(response.responseJSON.page_name);
                    $('#pageTitleUpdate').html(response.responseJSON.page_title);
                    $('#metaKeywordUpdate').html(response.responseJSON.meta_keyword);
                    $('#metaDescription').html(response.responseJSON.meta_description);
                    $('#selectPageUpdate').html(response.responseJSON.pages);
                }
            });
        });
        $('#receiveSuccessPdfModal').modal({
            backdrop: 'static',
            keyboard: false
        })
    });
</script>
@endsection