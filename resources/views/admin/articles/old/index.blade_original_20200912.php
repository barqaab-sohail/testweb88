<?php
$page = 'blog';
$breadcrumbs = [
    array('url' => false, 'name' => 'CMS Pages'),
    array('url' => route('admin.articles.index'), 'name' => 'Blog Articles - Listing'),
];
?>
@extends('layouts.new_admin_layout')
@section('title','Admin | Articles list')
@section('content')
@section('page_header','CMS Pages')
<div class="page-content">
  <div class="row">
    <div class="col-lg-12">
      <h2>Blog Articles <i class="fa fa-angle-right"></i> Listing</h2>
      <div class="clearfix"></div>
      @include('admin.partials.messages')
      <div class="pull-left"> Last updated: <span class="text-blue">{{ $recent_update }}</span> </div>
      <div class="clearfix"></div>
      <p></p>
      <div class="clearfix"></div>
    </div>
    <!-- end col-lg-12 -->
    <div class="col-md-12">
      <div class="portlet portlet-blue">
        <div class="portlet-header">
          <div class="caption text-white">Search/Filter</div>
          <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
        </div>
        <div class="portlet-body">
          <form class="form-horizontal" method="GET" action="{{ route('admin.articles.search') }}">
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-md-4 control-label">Article Title </label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="title_search" value="{{(isset($inputs['title_search'])) ? $inputs['title_search'] : ''}}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Status </label>
                <div class="col-md-8">
                  <select name="status_search" class="form-control">
                    <option value="100" {{(isset($inputs['status_search']) && $inputs['status_search'] == 100) ? "selected" : ''}}>- Please select -</option>
                    <option value="1" {{(isset($inputs['status_search']) && $inputs['status_search'] == 1) ? "selected" : ''}}>Active</option>
                    <option value="0" {{(isset($inputs['status_search']) && $inputs['status_search'] == 0) ? "selected" : ''}}>Inactive</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- end col-md 6 -->
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-md-4 control-label">Post Date </label>
                <div class="col-md-8">
                  <div class="input-group">
                    <input type="text" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="datepicker-default form-control" name="post_date_search" value="{{(isset($inputs['post_date_search'])) ? $inputs['post_date_search'] : ''}}" />
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Author </label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="author_search" value="{{(isset($inputs['author_search'])) ? $inputs['author_search'] : ''}}">
                </div>
              </div>
            </div>
            <!-- end col-md 6 -->
            <div class="clearfix"></div>
            <!-- save button start -->
            <div class="form-actions text-center"> <button type="submit" class="btn btn-red">Search &nbsp;<i class="fa fa-search"></i></button> </div>
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
          <div class="caption">Blog Articles Listing</div>
          <p class="margin-top-30px"></p>
          <a href="#" data-target="#modal-add-article" data-toggle="modal" class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
          <div class="btn-group">
            <button type="button" class="btn btn-primary">Delete</button>
            <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
            <ul role="menu" class="dropdown-menu">
              <li><a href="#" data-target="#modal-delete-selected" data-toggle="modal">Delete selected item(s)</a></li>
              <li class="divider"></li>
              <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
            </ul>
          </div>  
          <div class="tools"> <i class="fa fa-chevron-up"></i> </div>

          <!--Modal Add new article start-->
          <div id="modal-add-article" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
            <div class="modal-dialog modal-wide-width">
              <div class="modal-content">
                <div class="modal-header">
                  <button id="close-modal-add-article" type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                  <h4 id="modal-login-label3" class="modal-title">Add New Article</h4>
                </div>
                <div class="modal-body">
                  <div id="alert-div">

                  </div>
                  <div class="form">
                    <form class="form-horizontal form-add-article" method="POST" action="{{route('admin.articles.store')}}" enctype="multipart/form-data">
                      <input type="hidden" name="_token" value="{{csrf_token()}}" id="token_create">
                      <div class="form-group">
                        <label class="col-md-3 control-label">Status</label>
                        <div class="col-md-6">
                          <div data-on="success" data-off="primary" class="make-switch">
                            <input type="checkbox" checked="checked" name="status" />
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Article Title <span class="text-red">*</span></label>
                        <div class="col-md-6">
                          <textarea name="title" class="form-control" id="title_create"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Short Description</label>
                        <div class="col-md-6">
                          <textarea name="description" class="form-control" id="description_create"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Post Date <span class="text-red">*</span></label>
                        <div class="col-md-3">
                          <div class="input-group">
                            <input type="text" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="datepicker-default form-control readonly-with-cursor" readonly='true' name="post_date" id="post_date_create" />
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Author <span class="text-red">*</span></label>
                        <div class="col-md-6">
                          <input type="text" class="form-control" placeholder="eg. Hock" name="author" id="author_create">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Upload Author Thumbnail <span class="text-red">*</span></label>
                        <div class="col-md-9">
                          <div class="xs-margin"></div>
                          <input type="file" name="author_thumbnail" id="author_thumbnail_create" />
                          <span class="help-block">(Image dimension: 100 x 100 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Upload Front Image (For Index) <span class="text-red">*</span></label>
                        <div class="col-md-9">
                          <div class="xs-margin"></div>
                          <input id="front_image_create" type="file" name="front_image" />
                          <span class="help-block">(Image dimension: 300 x 300 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Article Content</label>
                        <div class="col-md-9">
                          <div class="text-blue border-bottom">You can edit the content by clicking the text below.</div>
                          <div class="margin-top-5px"></div>
                          <div class="content_fullwidth">
                            <div class="three_fourth">
                              <div class="blog_post">
                                <div class="blog_postcontent">
                                  <div id="new_content" contenteditable="true">
                                  </div>
                                </div>
                              </div>
                              <!-- /# end post -->
                              <div class="clearfix divider_line9"></div>
                            </div>
                            <!-- end three fourth -->
                          </div>
                          <!-- content fullwidth -->
                        </div>
                      </div>
                      <div class="form-actions">
                        <div class="col-md-offset-5 col-md-8"> <button class="btn btn-red add-article" type="submit">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--END MODAL Add New article-->
          <!--Modal delete selected items start-->
          <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                  <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                </div>
                <div class="modal-body" >

                  <p id="modal-delete-selected-body"></p>
                  <div class="form-actions" id="modal-delete-selected-footer">
                    <form method="POST" action="{{ route('admin.articles.destroy.items') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="selected-item" id="selected-item">
                      <div class="col-md-offset-4 col-md-8"> <button type="submit" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                    </form>
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
                    <form method="POST" action="{{ route('admin.articles.destroy.bulk.delete') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="_method" value="DELETE">
                      <div class="col-md-offset-4 col-md-8"> <button type="submit" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- modal delete all items end -->
        </div>
        <div class="portlet-body">
          @if(!empty($articles) && !$articles->isEmpty())
            <div class="form-inline pull-left">
              <div class="form-group">
                @php
                  $list_pages = [10,20,30,50,100];
                @endphp
                <select name="select" class="form-control" name="per_page" id="per_page">
                  @foreach($list_pages as $lg)
                    <option {{ ($select_page == $lg) ? 'selected="selected"' : '' }} value="{{ $lg }}">{{ $lg }}</option>
                  @endforeach
                </select>
                &nbsp;
                <label class="control-label">Records per page</label>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="table-responsive mtl">
              <form id="delete_client">
                <table id="example1" class="table table-hover table-striped">
                  <thead>
                  <tr>
                    <th width="1%"><input type="checkbox" id="selectAll" /></th>
                    <th>#</th>
                    <th><a href="#sort by article title">Article Title</a></th>
                    <th><a href="#sort by post date">Post Date</a></th>
                    <th><a href="#sort by arthur">Author</a></th>
                    <th><a href="#sort by status">Status</a></th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody class="table-body">
                  @php
                    $x=1;
                  @endphp
                  @foreach($articles as $article)
                    <tr>
                      <td><input type="checkbox" name="id[]" value="{{ $article->id }}" /></td>
                      <td>{!! $x !!}</td>
                      <td class="data-title-id-{{ $article->id }}">{!! $article->title !!}</td>
                      <td>{!! $article->post_date_month_in_middle !!}</td>
                      <td>{!! $article->author !!}</td>
                      <td><span class="label label-xs label-{{($article->status == 1) ? 'success':'default'}}">{{($article->status == 1) ? 'Active':'InActive'}}</span></td>
                      <td>
                        <a href="#" onclick="getArticleById({{$article->id}})" data-target="#modal-edit-article" data-toggle="modal" data-hover="tooltip" data-placement="top" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                        <a href="{{ route('admin.articles.show', [$article->id]) }}" data-hover="tooltip" data-placement="top" title="View/Reply Comment"><span class="label label-sm label-warning"><i class="fa fa-search"></i></span></a>
                        <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-3" data-toggle="modal" onclick="deleteArticle({{$article->id}})"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                      </td>
                    </tr>
                    @php
                      $x++;
                    @endphp
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <td colspan="7"></td>
                  </tr>
                  </tfoot>
                </table>
                <div class="tool-footer text-right">
                  <p class="pull-left">Showing {{ $articles->firstItem() }} to {{ $articles->lastItem() }} of {{ $articles->total() }} entries</p>
                  {{ $articles->links() }}
                </div>
                @else
                  <p>Article not found!</p>
                @endif
              </form>
              <div class="clearfix"></div>
            </div>
        </div>
      </div>
      <!-- end portlet -->
      <!--Modal edit article start-->
      <div id="modal-edit-article" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-wide-width">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
              <h4 id="modal-login-label3" class="modal-title">Edit Article</h4>
            </div>
            <div class="modal-body">
              <div class="form">
                <form class="form-horizontal form-update-article" method="POST" action="{{route('admin.articles.update')}}">
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="id" id="update_id">
                  <div class="form-group status-form-group">
                    <!-- <label class="col-md-3 control-label">Status</label>
                    <div class="col-md-6">
                      <div data-on="success" data-off="primary" class="make-switch">
                        <input type="checkbox" name="status" id="status_edit" />
                      </div>
                    </div> -->
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Article Title <span class="text-red">*</span></label>
                    <div class="col-md-6">
                      <textarea name="title" id="title_edit" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Short Description</label>
                    <div class="col-md-6">
                      <textarea name="description" id="description_edit" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Post Date <span class="text-red">*</span></label>
                    <div class="col-md-3">
                      <div class="input-group">
                        <input type="text" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="datepicker-default form-control" readonly='true' name="post_date" id="post_date_edit" />
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Author <span class="text-red">*</span></label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" name="author" id="author_edit" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Upload Author Thumbnail <span class="text-red">*</span></label>
                    <div class="col-md-9">
                      <div class="xs-margin"></div>
                      <div class="author-thumbnail-edit">
                        <img src="" alt="Author Thumbnail" class="img-responsive author_thumbnail_edit_link"><br/>
                        <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-icon" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                      </div>
                      <div class="xs-margin"></div>
                      <input id="author_thumbnail_edit" type="file" name="author_thumbnail" />
                      <span class="help-block">(Image dimension: 100 x 100 pixels, JPEG/GIF/PNG only, Max. 1MB) </span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Upload Front Image (For Index) <span class="text-red">*</span></label>
                    <div class="col-md-9">
                      <div class="xs-margin"></div>
                      <div class="front_image-edit">
                        <img src="" alt="Front Image" class="img-responsive front_image_edit_link"><br/>
                        <a href="#" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-front-image" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                      </div>
                      <div class="xs-margin"></div>
                      <input id="front_image_edit" type="file" name="front_image" />
                      <span class="help-block">(Image dimension: 560 x 250 pixels, JPEG/GIF/PNG only, Max. 1MB) </span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Article Content</label>
                    <div class="col-md-9">
                      <div class="text-blue border-bottom">You can edit the content by clicking the text below.</div>
                      <div class="margin-top-5px"></div>
                      <div class="content_fullwidth">
                        <div class="three_fourth">
                          <div class="blog_post">
                            <div class="blog_postcontent">
                              <div id="content_edit" contenteditable="true">
                              </div>
                            </div>
                          </div>
                          <!-- /# end post -->
                          <div class="clearfix divider_line9"></div>
                        </div>
                        <!-- end three fourth -->
                      </div>
                      <!-- content fullwidth -->
                    </div>
                  </div>
                  <div class="form-actions">
                    <div class="col-md-offset-5 col-md-8"> <button type="submit" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--END MODAL edit article-->
      <!--Modal delete icon start-->
      <div id="modal-delete-icon" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this icon image? </h4>
            </div>
            <div class="modal-body">
              <p><img src="" alt="Author Thumbnail" class="img-responsive author_thumbnail_edit_link"></p>
              <div class="form-actions">
                <div class="form">
                  <form class="form-horizontal form-delete-author-thumbnail" method="POST" action="{{route('admin.articles.update')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="update_icon_id">
                    <input type="hidden" name="author_thumbnail" value="">
                    <input type="hidden" name="delete_author_thumbnail" value="1">
                    <div class="col-md-offset-4 col-md-8"> <button type="submit" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" class="btn btn-green btn_close_author_thumbnail_delete">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- modal delete end -->
      <!--Modal delete front image start-->
      <div id="modal-delete-front-image" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this icon image? </h4>
            </div>
            <div class="modal-body">
              <p><img src="" alt="Front Image" class="img-responsive front_image_edit_link"></p>
              <div class="form-actions">
                <form class="form-horizontal form-delete-front-image" method="POST" action="{{route('admin.articles.update')}}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="id" id="update_front_image_id">
                  <input type="hidden" name="front_image" value="">
                  <input type="hidden" name="delete_front_image" value="1">
                  <div class="col-md-offset-4 col-md-8"> <button type="submit" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" class="btn btn-green btn_close_front_image_delete">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- modal delete end -->
      <!--Modal delete start-->
      <div id="modal-delete-3" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
              <h4 id="modal-login-label4" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this article? </h4>
            </div>
            <div class="modal-body">
              <p id="article_delete"><strong>#1:</strong> How to reset your email password if you are using cPanel emails with Outlook 2010 email client? </p>
              <div class="form">
                <form method="post" action="{{ route('admin.articles.destroy') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="id_delete" value="" id="id_delete">
                  <div class="form-actions">
                    <div class="col-md-offset-4 col-md-8"> <button type="submit" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></button>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a> </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- modal delete end -->
    </div>
    <!-- end col-lg-12 -->
  </div>
  <!-- end row -->
</div>
@endsection
@section('custom_scripts')
  <!-- InstanceBeginEditable name="EditRegion4" -->
  <script src="{{url('').'/resources/assets/admin/'}}vendors/tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="{{url('').'/resources/assets/admin/'}}vendors/ckeditor/ckeditor.js"></script>
  <script src="{{url('').'/resources/assets/admin/'}}js/ui-tabs-accordions-navs.js"></script>
  <script type="text/javascript">
      $(".datepicker-default").datepicker();

      // sumbit modal add new article, Modified by Narek
      $('.form-add-article').submit(function(e){
          e.preventDefault();
          var formData = new FormData($('.form-add-article')[0]);
          formData.append('content', CKEDITOR.instances.new_content.getData());
          $.ajax({
              type: 'POST',
              url: $(this).attr('action'),
              cache : false,
              processData: false,
              contentType: false,
              headers: {
                  'X-CSRF-Token': $('#token_create').val()
              },
              data: formData
          })
              .done(function(res){
                  refreshCreateArticleForm();
                  if (res.error === 1) {
                      $.each(res,function(x,y)
                      {
                          if (y.title != undefined) {
                              $('#title_create').closest('div').removeClass().addClass('col-md-6 has-error');
                          }
                          if (y.post_date != undefined) {
                              $('#post_date_create').closest('div').removeClass().addClass('input-group has-error');
                          }
                          if (y.author != undefined) {
                              $('#author_create').closest('div').removeClass().addClass('col-md-6 has-error');
                          }
                          if (y.author_thumbnail != undefined) {
                              $('#author_thumbnail_create').closest('div').removeClass().addClass('col-md-9 has-error');
                          }
                          if (y.front_image != undefined) {
                              $('#front_image_create').closest('div').removeClass().addClass('col-md-9 has-error');
                          }
                      });
                  }
                  if (res.error === 0) {
                      location.reload();
                  }
              })
              .error(function(err){
                  if(err.status == 422) {
                      $('#modal-add-article').animate({ scrollTop: 0 }, 'slow');
                      var err_msg = '';
                      $.each(err["responseJSON"], function(i, v) {
                        err_msg += '<p>' + v + '</p>';
                      });
                      $('#alert-div').html(' <i class="fa fa-times-circle"></i> <strong>Error!</strong>' + err_msg);
                      // $('#alert-div').html(' <i class="fa fa-times-circle"></i> <strong>Error!</strong>' + '<p>' + err["responseJSON"]["message"]+ '</p>');
                      $('#alert-div').addClass('alert alert-danger alert-dismissable');
                  }
              });
      });

      // Delete error message, added by Narek
      $('#close-modal-add-article').click(function(){
          if($('#alert-div').html('') != '') {
              $('#alert-div').html('');
              $('#alert-div').removeClass('alert alert-danger alert-dismissable');
          }
      })

      // update article
      $('.form-update-article').on('submit', function(e){
          e.preventDefault();
          var formData = new FormData($('.form-update-article')[0]);
          formData.append('content', CKEDITOR.instances.content_edit.getData());
          $.ajax({
              type: 'POST',
              url: $(this).attr('action'),
              cache : false,
              processData: false,
              contentType: false,
              headers: {
                  'X-CSRF-Token': csrf_token
              },
              data: formData
          })
              .done(function(res){
                  refreshUpdateArticleForm();
                  if (res.error === 1) {
                      $.each(res,function(x,y)
                      {
                          if (y.title != undefined) {
                              $('#title_edit').closest('div').removeClass().addClass('col-md-6 has-error');
                          }
                          if (y.post_date != undefined) {
                              $('#post_date_edit').closest('div').removeClass().addClass('input-group has-error');
                          }
                          if (y.author != undefined) {
                              $('#author_edit').closest('div').removeClass().addClass('col-md-6 has-error');
                          }
                          if (y.author_thumbnail != undefined) {
                              $('#author_thumbnail_edit').closest('div').removeClass().addClass('col-md-9 has-error');
                          }
                          if (y.front_image != undefined) {
                              $('#front_image_edit').closest('div').removeClass().addClass('col-md-9 has-error');
                          }
                      });
                  }
                  if (res.error === 0) {
                      location.reload();
                  }
              })
              .error(function(err){
                  console.log(err);
              });
      });

      // delete author thumbnail
      $('.form-delete-author-thumbnail').on('submit', function(e){
          e.preventDefault();
          var formData = $('.form-delete-author-thumbnail').serialize();
          $.ajax({
              method: 'POST',
              url: $('.form-delete-author-thumbnail').attr('action'),
              headers: {
                  'X-CSRF-Token': csrf_token
              },
              data: formData
          })
              .done(function(res){
                  refreshUpdateArticleForm();
                  if (res.error === 1) {
                      location.reload();
                  }
                  if (res.error === 0) {
                      alert('Success!');
                      $('.author-thumbnail-edit').css('display', 'none');
                      $('#modal-delete-icon').modal('hide');
                  }
              })
              .error(function(err){
                  console.log(err);
              });
      });

      // delete front image
      $('.form-delete-front-image').on('submit', function(e){
          e.preventDefault();
          var formData = $('.form-delete-front-image').serialize();
          $.ajax({
              method: 'POST',
              url: $('.form-delete-front-image').attr('action'),
              headers: {
                  'X-CSRF-Token': csrf_token
              },
              data: formData
          })
              .done(function(res){
                  refreshUpdateArticleForm();
                  if (res.error === 1) {
                      location.reload();
                  }
                  if (res.error === 0) {
                      alert('Success!');
                      $('.front_image-edit').css('display', 'none');
                      $('#modal-delete-front-image').modal('hide');
                  }
              })
              .error(function(err){
                  console.log(err);
              });
      });

      // restore to default version of new article form
      function refreshCreateArticleForm() {
          $('#title_create').closest('div').removeClass('has-error');
          $('#post_date_create').closest('div').removeClass('has-error');
          $('#author_create').closest('div').removeClass('has-error');
          $('#author_thumbnail_create').closest('div').removeClass('has-error');
          $('#front_image_create').closest('div').removeClass('has-error');
      }

      // restore to default version of new article form
      function refreshUpdateArticleForm() {
          $('#title_edit').closest('div').removeClass('has-error');
          $('#post_date_edit').closest('div').removeClass('has-error');
          $('#author_edit').closest('div').removeClass('has-error');
          $('#author_thumbnail_edit').closest('div').removeClass('has-error');
          $('#front_image_edit').closest('div').removeClass('has-error');
      }

      //function delete article
      function deleteArticle(id) {
          $('#id_delete').val(id);
          var title = $('.data-title-id-'+id).text();
          $('#article_delete').empty().html('<strong>#'+id+':</strong> '+title+'')
      }

      // get article by ID, and it's used by edit function modal
      function getArticleById(id) {
          //clear input
          refreshUpdateArticleForm();
          $.ajax({
              type: 'GET',
              url: base_url+'/admin/blog/articles/'+id,
              contentType: 'json',
              headers: {
                  'X-CSRF-Token': csrf_token
              }
          })
              .done(function(res){
                  if (res.error == 1) {
                      location.reload();
                  }

                  if (res.error == 0) {
                      // show de default
                      $('.author-thumbnail-edit').removeAttr('style');
                      $('.front_image-edit').removeAttr('style');

                      var article = res.data.article;
                      if (article.status == 1) {
                          $('.status-form-group').empty().append('<label class="col-md-3 control-label">Status</label><div class="col-md-6"><div data-on="success" data-off="primary" class="make-switch-init-edit"><input type="checkbox" name="status" id="status_edit" checked/></div></div>');
                          $('.make-switch-init-edit').bootstrapSwitch();
                      } else {
                          $('.status-form-group').empty().append('<label class="col-md-3 control-label">Status</label><div class="col-md-6"><div data-on="success" data-off="primary" class="make-switch-init-edit"><input type="checkbox" name="status" id="status_edit"/></div></div>');
                          $('.make-switch-init-edit').bootstrapSwitch();
                      }

                      $('#title_edit').empty().html(article.title);
                      $('#description_edit').empty().html(article.description);
                      $('#post_date_edit').empty().val(article.frontend_date_format);
                      $('#author_edit').empty().val(article.author);
                      $('#content_edit').empty().html(article.content);
                      if (article.author_thumbnail != '') {
                          $('.author_thumbnail_edit_link').attr('src', base_url+'/storage/articles/author_thumbnail/'+article.author_thumbnail);
                      } else {
                          $('.author-thumbnail-edit').css('display', 'none');
                      }

                      if (article.front_image != '') {
                          $('.front_image_edit_link').attr('src', base_url+'/storage/articles/front_image/'+article.front_image);
                      } else {
                          $('.front_image-edit').css('display', 'none');
                      }
                      $('#update_id').val(article.id);
                      //assign value for delete author thumbnail
                      $('#update_icon_id').val(article.id);
                      //assign value for delete front image
                      $('#update_front_image_id').val(article.id);
                  }
              })
              .error(function(err){
                  console.log(err);
              });
      }

      // save all event on load in here
      $(function(){
          $('#per_page').on('change', function(){
              var page = $(this).val();
              location.href= base_url+'/admin/blog/articles/list/'+page;
          });

          //clear inpur error when close modal add new article
          $('#modal-add-article').on('hidden.bs.modal', function(e){
              refreshCreateArticleForm();
          });

          // close second modal author thumbnail
          $('.btn_close_author_thumbnail_delete').on('click', function(){
              $('#modal-delete-icon').modal('hide');
          });
          // close second modal author thumbnail
          $('.btn_close_front_image_delete').on('click', function(){
              $('#modal-delete-front-image').modal('hide');
          });

          //for checkbox in article table data
          $('#selectAll').click(function(e){
              $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
          });

          $('#modal-delete-selected').on('shown.bs.modal', function(){
              var searchids = $('.table-body input:checkbox:checked').map(function(){
                  return $(this).val();
              }).toArray();
              $('#selected-item').empty().val(searchids);
              $("#modal-delete-selected-body").empty();
              if(searchids.length > 0)
              {
                  $.ajax({
                      url:  base_url+'/admin/blog/articles/get_details',
                      type: 'POST',
                      headers: {
                          'X-CSRF-Token': csrf_token
                      },
                      data: $("#delete_client").serialize()
                  })
                      .done(function(response) {
                          $("#modal-delete-selected-footer").show();
                          for (var i=0; i <response.length; i++) {
                              $('#modal-delete-selected-body').prepend('<p>'+
                                  '<strong>#'+response[i].id+'</strong>: <span>'+' '+response[i].title+'</span>'+
                                  '</p>');
                          }
                      })
                      .fail(function() {
                          console.log("error");
                      })
                      .always(function() {

                      });
                  /* $("#modal-delete-selected-body").append("<strong>#1:</strong> How to reset your email password if you are using cPanel emails with Outlook 2010 email client?"); */

              }else{
                  $("#modal-delete-selected-body").append("<p id='selected_zero'  class='alert alert-danger'>Please select at least one Article for delete</p>");
                  $("#modal-delete-selected-footer").hide();

              }
          });
      });
  </script>
  <!-- InstanceEndEditable -->
@endsection
