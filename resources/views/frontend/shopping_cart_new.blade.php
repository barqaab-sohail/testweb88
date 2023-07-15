@extends('layouts.frontend_layout')
@section('title', 'Domains | - Webqom Technologies')
@section('content')

<div class="clearfix"></div>


<div class="page_title1 sty9">
    <div class="container">

        <h1>Online Order</h1>

        <div class="pagenation">&nbsp;
            <a href="{{ url('/') }}">Home</a> <i>/</i>
            @if (isset($info) && isset($page))
            @if ($info != '' && $page != '')
            <a href="{{ url('/dashboard') }}">Dashboard</a> <i>/</i>
            <a href="{{ url('/my_account') }}">My Domains</a> <i>/</i>
            <a href="{{ url('/domain_search_login') }}">Domain Search</a> <i>/</i>
            <a href="{{ url('/domain_configuration') }}">Domain Configuration</a>

            <i>/</i>
            @endif
            @endif
            Shopping Cart
        </div>

        <div class="clearfix"></div>
        <!--  note to programmer: breadcrumb is dynamic by the steps user clicks. -->

    </div>

</div><!-- end page title -->
<div class="clearfix margin_bottom1"></div>

<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>

<div class="one_full stcode_title9">
    <h1 class="caps"><strong>Shopping Cart</strong></h1>
</div>
@if(!empty(session()->get('cart'))) {
<div class="content_fullwidth">
    <div class="container">

        <div class="table-responsive">
            <table class="table data-table table-hover table-striped cart_item_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Services</th>
                        <th>Cycle</th>
                        <th>Setup Fee</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="6" class="aliright">
                            <a href="#" class="btn btn-sm btn-default caps empty_cart" id="emptyCart"><i class="fa fa-trash"></i> <b>Empty Cart</b></a>
                        </td>
                    </tr>
                </tfoot>

            </table>

            <div class="clearfix"></div>

        </div>



        <div class="one_half_less">
            <div class="alertymes7">
                <h4>Apply Promo Code</h4>
                <div class="cforms alileft">
                    <div id="form_status"></div>
                    <form type="POST" id="gsr-contact" onSubmit="return valid_datas( this );">
                        <input type="text" id="promocode" name="promocode" placeholder="Enter promo code if you have one...">
                        <a href="#" class="btn btn-sm btn-info caps"><i class="fa fa-trash"></i>
                            <b>Validate Code</b></a>
                    </form>
                </div>
            </div>
        </div><!-- end one half less -->

        <div class="one_half_less last">
            <div class="alertymes7">
                <h2 class="aliright">Order Summary</h2>
                <div class="pull-left caps"><b>Subtotal</b></div>
                <div class="pull-right"><b id="total"></b></div>
                <div class="clearfix"></div>
                <div class="pull-left caps red"><b>Discount</b></div>
                <div class="pull-right red"><b>Discount</b></div>
                <div class="clearfix"></div>

                <div class="pull-left caps"><b id="gstRate"></b></div>

                <div class="pull-right"><b id="gst"></b></div>
                <div class="divider_line"></div>
                <div class="clearfix margin_bottom2"></div>
                <h2 class="red aliright" style="margin-bottom: 0px;"><b id="grandTotal"></b></h2><span class="pull-right red caps aliright">Total</span>
                <div class="clearfix margin_bottom2"></div>
                <a href="#" class="btn btn-default caps pull-left"><i class="fa fa-shopping-cart"></i>
                    <b>Continue Shopping</b></a>

                {!! Form::open(['route' => 'frontend.checkout_login']) !!}

                <input type="hidden" name="total_price" id="total_price" value="">
                <input type="hidden" name="discount" id="discount" value="">
                <input type="hidden" name="gst_rate" id="gst_rate" value="">

                {{ Form::button('<i class="fa fa-lg fa-arrow-circle-right"></i> <b>Checkout</b>', ['type' => 'submit', 'class' => 'btn btn-lg btn-danger caps pull-right']) }}

                {!! Form::close() !!}

            </div>
        </div><!-- end one half less last -->


    </div><!-- end section -->
    @endif


</div>
</div><!-- end content fullwidth -->

<div class="clearfix"></div>
<div class="divider_line"></div>
<div class="clearfix"></div>
<!-- Update Modal -->
<!-- Button trigger modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="json_message_modal" align="left"><strong></strong><i hidden class="fas fa-times float-right"></i> </div>
                <form id="editForm" name="editForm" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Cycle</label>
                            <select id="cycle" name="cycle" class="form-control">
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>

            </div>
        </div>
    </div>
</div>


<a href="#" class="scrollup">Scroll</a><!-- end scroll to top of the page-->

@section('custom_scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>
<script>
    $(document).ready(function() {
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('frontend.shopping_cart') }}",
                },
                "bPaginate": false,
                drawCallback: function(data) {
                    $("#total").html('RM ' + data.json.total);
                    $("#gstRate").html('GST ' + data.json.gstRate + '%');
                    $("#gst").html('RM ' + data.json.gst);
                    $("#grandTotal").html('RM ' + data.json.grandTotal);
                    $("#total_price").val((data.json.total).replace(/,/g, ''));
                    $("#discount").val();
                    $("#gst_rate").val((data.json.gst).replace(/,/g, ''));

                },
                bFilter: false,
                bInfo: false,
                columns: [{
                        data: "DT_Row_Index",
                        name: 'DT_Row_Index'
                    },
                    {
                        data: "services",
                        name: 'services'
                    },
                    {
                        data: "cycle",
                        name: 'cycle'
                    },
                    {
                        data: "setup_fee",
                        name: 'setup_fee'
                    },
                    {
                        data: "qty",
                        name: 'qty'
                    },
                    {
                        data: "price",
                        name: 'price'
                    },

                    {
                        data: 'Delete',
                        name: 'Delete',

                    }


                ],
            });


            $('body').on('click', '.deleteItem', function() {
                var id = $(this).data('id');
                var con = confirm("Are You sure want to delete !");
                if (con) {
                    $.ajax({
                        url: base_url + '/empty_cart',
                        type: 'POST',
                        data: {
                            '_token': csrf_token,
                            'id': id
                        },
                        success: function(response) {
                            if (response.success == true) {
                                toastr.success(response.errors.message, 'Success');
                                table.draw();
                            } else {
                                toastr.success(response.errors.message, 'Error');
                            }

                        }

                    });
                }
            });
            var currentCycleValue = '';

            $('body').on('click', '.editYear', function() {
                var itemId = $(this).data('id');
                let index = $(".editYear").index(this);
                currentCycleValue = $('.cycle_value').eq(index).text().charAt(0);
                $('#json_message_modal').html('');
                $.ajax({
                    url: base_url + '/get_price' + '/' + itemId,
                    type: 'GET',
                    success: function(response) {

                        $("#cycle").empty();
                        $("#cycle").append('<option value=""></option>');
                        $.each(response, function(key, value) {
                            $("#cycle").append('<option value="' + value + '">' + value + '</option>');
                        });
                        $("#id").val(itemId);
                        $('#modalTitle').html("Edit Cycle");
                        $('#editModal').modal('show');
                    }

                });

            });

            $('#saveBtn').click(function(e) {
                $(this).attr('disabled', 'ture');
                var url = base_url + '/update_cycle';
                var selectedCycle = $("#cycle option:selected").text().charAt(0);
                var data = $('#editForm').serialize();
                if (selectedCycle == currentCycleValue) {
                    $('#json_message_modal').html('<div id="message" class="alert alert-danger" align="left"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Cycle Already Selected</strong></div>');
                    $("#saveBtn").removeAttr('disabled');
                    return false;
                }
                // else if (selectedCycle == null) {
                //     $('#json_message_modal').html('<div id="message" class="alert alert-danger" align="left"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Please Select Cycle</strong></div>');
                //     $("#saveBtn").removeAttr('disabled');
                //     return false;
                // }

                $.ajax({
                    data: data,
                    url: url,
                    type: "POST",
                    success: function(data) {
                        $("#saveBtn").removeAttr('disabled');
                        if (data.success == true) {
                            $('#editModal').modal('hide');
                            toastr.success(data.errors.message, 'Success');
                            table.draw();
                        } else {
                            toastr.success(data.errors.message, 'Error');
                        }

                    },
                    error: function(data) {
                        $("#saveBtn").removeAttr('disabled');
                        var errorMassage = '';
                        $.each(data.responseJSON, function(key, value) {
                            errorMassage += value + '<br>';
                        });
                        $('#json_message_modal').html('<div id="message" class="alert alert-danger" align="left"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>' + errorMassage + '</strong></div>');

                    }
                });


            });








        });
    });
</script>
@endsection
@endsection