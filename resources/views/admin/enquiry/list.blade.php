<?php if ($enquiry instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
<?php $per_page=$enquiry->perPage(); ?>
<?php else: ?>
<?php $per_page=10; ?>
<?php endif ?>
<?php $page = 'enquiry';
$breadcrumbs=[
        array('url'=>url('/admin/services/enquiry/list'),'name'=>'Services'),
        array('url'=>url('/admin/services/enquiry/list'),'name'=>'Services Enquiry - Listing'),

];
?>
@extends('layouts.admin_layout')

@section('title','Admin | Service EnquiryListing')
@section('content')
@section('page_header','Services')

<div class="page-content">
    <div class="row">
        <!-- end col-md-6 -->
        <div class="col-lg-12">
            @if ( session('flash_message')  )
                <div class="alert alert-success">
                    {{ session('flash_message') }}
                </div>
            @endif
            <div class="portlet">
                <div class="portlet-header">
                    <div class="caption">Services Enquiry Listing</div>&nbsp;
                    <p style="margin-top:30px" class="margin-top-10px"></p>
                    <a href="{{route('enquires-add')}}" class="btn btn-success" >Add New Enquiry &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Delete</button>
                        <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span
                                    class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="#" onclick="open_modal_delete_selected()">Delete selected item(s)</a></li>
                            <li class="divider"></li>
                            <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                        </ul>
                    </div>&nbsp;
                    <a target="_blank" href="{{url('/admin/services/enquiry/export/csv')}}"
                       class="btn btn-blue">Export to CSV &nbsp;<i class="fa fa-share"></i></a>  
                    <div class="tools"><i class="fa fa-chevron-up"></i></div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                      @if(Session::has('status'))
                          <div class="col-lg-10 col-lg-offset-1 alert alert-success alert-dismissible fade in text-center">
                          {{ Session::get('status') }}
                          </div>
                      @endif

                    </div>
                    <div class="clearfix"></div>
                    <div class="table-responsive">
                        <div class="form-group col-md-2">
                            <select class="form-control" id="per_page_select" onchange="per_page_change()">
                                <option value="10" @if($per_page==10) selected="" @endif>Show 10</option>
                                <option value="15" @if($per_page==15) selected="" @endif>Show 15</option>
                                <option value="20" @if($per_page==20) selected="" @endif>Show 20</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <table id="clients_list" class="table table-hover table-striped style" style="width:100%;; ">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Service</th>
                                <th>Name</th>
                                <!-- <th>Email</th> -->
                                <th>Company</th>
                                <!-- <th>Phone</th>
                                <th>Website</th> -->
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($enquiry as $enquiries)
                                <tr>
                                    <td><input name="id[]" value="{{$enquiries->id}}" type="checkbox"/></td>
                                    <td style="word-wrap: break-word; white-space:pre-wrap">{{$enquiries->id}}</td>
                                    <td style="word-wrap: break-word;white-space:pre-wrap">{{$enquiries->service}}</td>
                                    <td style="word-wrap: break-word;white-space:pre-wrap">{{$enquiries->name}}</td>
                                    <!-- <td style="word-wrap: break-word;white-space:pre-wrap">$enquiries->email</td> -->
                                    <td style="word-wrap: break-word;white-space:pre-wrap">{{$enquiries->company}}</td>
                                    <!-- <td style="word-wrap: break-word;white-space:pre-wrap">$enquiries->phone</td>
                                    <td style="word-wrap: break-word;white-space:pre-wrap">$enquiries->website</td> -->
                                    <td style="word-wrap: break-word;white-space:pre-wrap">{{$enquiries->message}}</td>
                                    <td style="padding: 5px;">
                                        <a href="{{ asset(route('enquires-edit', $enquiries->id)) }}" style="margin-left: 15px;" data-hover="tooltip" data-placement="top" title="Edit"><span class="label label-sm label-success"><i class="fa fa-pencil"></i></span></a>
                                        <a href="#" data-hover="tooltip" data-placement="top" title="Delete"
                                           data-target="#modal-delete-{{$enquiries->id}}" data-toggle="modal"><span
                                                    class="label label-sm label-red"><i
                                                        class="fa fa-trash-o"></i></span></a>
                                    </td>
                                    <input type="hidden" name="offset" value="{{$enquiries->id}}">
                                </tr>
                                <!--Modal delete start-->
                                <div id="modal-delete-{{$enquiries->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" data-dismiss="modal" aria-hidden="true"
                                                        class="close">&times;</button>
                                                <h4 id="modal-login-label4" class="modal-title"><a href=""><i
                                                                class="fa fa-exclamation-triangle"></i></a> Are you sure
                                                    you want to delete this eqquires? </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>#{{$enquiries->service or ""}}:</strong> {{$enquiries->name}}
                                                    <br/>
                                                    <strong>Company:</strong> {{$enquiries->company}} </p>
                                                <div class="form-actions">
                                                    <div class="col-md-offset-4 col-md-8">
                                                        <form action="{{route('enquires-delete',['id'=> $enquiries->id ])}}"
                                                              method="post">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" id="delete_single_button"
                                                                    class="btn btn-red">Yes &nbsp;<i
                                                                        class="fa fa-check"></i></button>
                                                        </form>
                                                        &nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">No
                                                            &nbsp;<i class="fa fa-times-circle"></i></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal delete end -->
                            @endforeach

                            </tbody>
                        </table>

                        <?php if ($enquiry instanceof \Illuminate\Pagination\LengthAwarePaginator){ ?>
                        <span>Showing {{$enquiry->firstItem()}} to {{$enquiry->lastItem()}}
                            of {{$enquiry->total()}}</span>
                        <span class="pull-right">{{$enquiry->links()}}</span>
                        <?php }else{ ?>
                        <span>Total records: {{count($enquiry)}}</span>
                        <?php } ?>


                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end portlet -->
        </div>
        <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
</div>

<div id="confirm" class="modal hide fade">
    <div class="modal-body">
        Are you sure?
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
    </div>
</div>

<!--Modal delete selected items start-->
<div aria-hidden="true" aria-labelledby="modal-login-label" class="modal fade" id="modal-delete-selected" role="dialog"
     tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
                <h4 class="modal-title" id="modal-login-label4">
                    <a href="">
                        <i class="fa fa-exclamation-triangle">
                        </i>
                    </a>
                    Are you sure you want to delete the selected
                    <span id="count-seleted">
                    </span>
                    item(s)?
                </h4>
            </div>
            <div class="modal-body" id="delete-selected-body">
                <div id="delete-selected-body-information">
                </div>
                <p class="alert alert-danger" id="selected_zero" style="display:none">
                    Please select at least one client for delete
                </p>
                <div class="form-actions" id="delete-selected-buttons">
                    <div class="col-md-offset-4 col-md-8">
                        <button class="btn btn-red" id="delete_bulk" type="button">
                            Yes
                            <i class="fa fa-check">
                            </i>
                        </button>
                        <a class="btn btn-green" data-dismiss="modal" href="#">
                            No
                            <i class="fa fa-times-circle">
                            </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal delete selected items end -->
<!--Modal delete all items start-->
<div aria-hidden="true" aria-labelledby="modal-login-label" class="modal fade" id="modal-delete-all" role="dialog"
     tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
                <h4 class="modal-title" id="modal-login-label4">
                    <a href="">
                        <i class="fa fa-exclamation-triangle">
                        </i>
                    </a>
                    Are you sure you want to delete all items?
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-actions">
                    <div class="col-md-offset-4 col-md-8">
                        <a class="btn btn-red" href="javascript:void" onclick="delete_all()">
                            Yes
                            <i class="fa fa-check">
                            </i>
                        </a>
                        <a class="btn btn-green" data-dismiss="modal" href="#">
                            No
                            <i class="fa fa-times-circle">
                            </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal delete all items end -->


@endsection
@section('custom_scripts')
    <link type="text/css" rel="stylesheet"
          href="{{url('').'/resources/assets/admin/'}}vendors/bootstrap-switch/css/bootstrap-switch.css">
    <script src="{{url('').'/resources/assets/admin/'}}vendors/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <link type="text/css" rel="stylesheet"
          href="{{url('').'/resources/assets/admin/'}}vendors/bootstrap-datepicker/css/datepicker.css">
    <script src="{{url('').'/resources/assets/admin/'}}vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <script type="text/javascript">
        $('#clients_list').DataTable({
            "bPaginate": false,
            "bInfo": false,
            "bFilter": false,
            "buttons": [
                 'csv'
            ],
            "columnDefs": [
                 { "width": "3px", "targets": 0 },
                 { "width": "3px", "targets": 1 },
                // { "width": "50px", "targets": 2 },
                // { "width": "45px", "targets": 3 },
                // { "width": "170px", "targets": 4 },
                //
                // { "width": "95px", "targets": 5 },
                // { "width": "85px", "targets": 6 },
                // { "width": "95px", "targets": 7 },
                // { "width": "100", "targets": 8 },
                 { "width": "35px", "targets": 6 }
            ],
            fixedColumns: false
        });

        function per_page_change() {
            per_page = $("#per_page_select").find(":selected").val();
            window.location.href = base_url + "/admin/services/enquiry/list/" + per_page;
        }

        function open_modal_delete_selected() {
            $('#delete-selected-body-information').html("");
            $("#modal-delete-selected").modal('show');

            var selected = $('input[name="id[]"]:checked').length;
            var id = $("input[name='id[]']:checked").map(function () {
                return this.value;
            }).get();
            console.log("id =" + id);
            if (selected < 1) {
                $('#selected_zero').show()
                $('#delete-selected-buttons').hide()
            } else {
                /*get seleccted users details*/
                $.ajax({
                    url: base_url + '/admin/services/enquiry/get_enquiry_details',
                    type: 'POST',
                    data: {'_token': csrf_token, 'id': id},
                }).done(function (response) {
                    console.log(response);
                    for (var i = 0; i < response.length; i++) {
                        $('#delete-selected-body-information').prepend('<p>' + '<strong>#' + response[i].id + '</strong>:<span>' + response[i].name + '<span ><strong >Company:</strong>' + response[i].email + '</span>' + '</p>');
                    }
                }).fail(function () {
                    console.log("error");
                }).always(function () {
                    $('#selected_zero').hide()
                    $('#delete-selected-buttons').show();
                    $('#count-seleted').html(selected);
                });
                /*End*/
            }
        }

        function delete_all() {
            $.ajax({
                url: base_url + '/admin/services/enquiry/delete_all',
                type: 'POST',
                data: {'_token': csrf_token},
            }).done(function () {
                location.reload();
            }).fail(function () {
                console.log("error");
            }).always(function () {
                console.log("complete");
            });
        }

        $(document).on('click', '#delete_bulk', function (event) {
            var selected = $('input[name="id[]"]:checked').length;
            var id = $("input[name='id[]']:checked").map(function () {
                return this.value;
            }).get();

            event.preventDefault();
            if (selected < 1) {
                $('#delete-selected-body').prepend('<p class="alert alert-danger">Please select items</p>');
            } else {

                $('#delete_bulk').attr("disabled", true);
                $.ajax({
                            url: base_url + '/admin/services/enquiry/delete_by_id',
                            type: 'POST',
                            data: {'_token': csrf_token, 'id': id},
                        })
                        .done(function () {
                            location.reload();
                        })
                        .fail(function () {
                            $('#modal-delete-selected').modal('hide');
                            alert("Error: no client was selected to delete");
                        })
                        .always(function () {
                            $('#delete_bulk').attr("disabled", false);
                        });
            }

        });
    </script>
@endsection
