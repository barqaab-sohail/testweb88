<?php $page = 'promotions';
$breadcrumbs = [
    // array('url'=>url('orders/listing'),'name'=>'Orders'),
    ['url' => url('/promotions/globalDiscounts'), 'name' => 'Global Discount - Listing'],
];
?>
<?php

use App\Models\Plan;
use App\Models\Category;

$this->ProductModel = new Plan();
$this->CategoryModel = new Category();
?>
@extends('layouts.admin_layout')
@section('title', $data['page_title'])
@section('content')
@section('page_header', 'Promotions')
<div class="page-header-breadcrumb">
</div>
<div class="page-content">
    <div class="row">
        <div class="col-lg-12">
            <h2>Global Discounts <i class="fa fa-angle-right"></i> Listing</h2>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                @include('admin.partials.messages')

                @if (session('delete_status') && session('delete_status') === true)
                    <div class="alert alert-success delete-success">
                        <button type="button" class="close alert-hide-btn" aria-hidden="true"
                            class="close">&times;</button>
                        <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                        <p>Item(s) has been deleted successfully.</p>
                    </div>
                @endif
                @if (session('delete_status') && session('delete_status') === false)
                    <div class="alert alert-danger delete-error">
                        <button type="button" class="close alert-hide-btn" aria-hidden="true"
                            class="close">&times;</button>
                        <i class="fa fa-check-circle"></i> <strong>Error!</strong>
                        <p>Failed to delete Item(s). Please try again.</p>
                    </div>
                @endif

                <div class="pull-left"> Last updated: <span
                        class="text-blue">{{ date('d M, Y @ g:i A', strtotime($data['last_modified'])) }}</span>
                </div>
                <div class="clearfix"></div>
                <p></p>
                <div class="clearfix"></div>

            </div>

            <!--Modal add new discount start-->
            <div id="modal-add-discount" tabindex="-1" role="dialog" aria-labelledby="modal-login-label"
                aria-hidden="true" class="modal fade">
                <div class="modal-dialog modal-wide-width">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true"
                                class="close">&times;</button>
                            <h4 id="modal-login-label3" class="modal-title">Add New Discount</h4>
                        </div>
                        <div class="modal-body">
                            <div id="alert-div">

                            </div>
                            <div class="form">
                                <form class="form-horizontal form-add-discount" id="form_add_global_discount">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token_create">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Status <span
                                                class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <div data-on="success" data-off="primary" class="make-switch">
                                                <input type="checkbox" name="status" id="status" checked="checked" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Discount Name <span
                                                class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="eg. Sample 2"
                                                name="discount_name" id="discount_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">From Amount <span
                                                class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="Amount"
                                                name="from_amount" id="from_amount">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">To Amount <span
                                                class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="Amount"
                                                name="to_amount" id="to_amount">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Discount <span
                                                class="text-red">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="Amount"
                                                name="discount" id="discount">
                                            <div class="xs-margin"></div>
                                            <select name="discount_by" id="discount_by" class="form-control">
                                                <option value="%">%</option>
                                                <option value="RM">RM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputFirstName" class="col-md-3 control-label">Apply to Service
                                            Plan</label>
                                        <div class="col-md-6">

                                            <select class="form-control" name="category_id"
                                                onchange="load_category_products('modal-add-discount',this.value)">
                                                {!! $data['categories'] !!}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Apply to Products</label>
                                        <div class="col-md-9">
                                            <div class="clearfix"></div>
                                            <input type="checkbox" name="" value="on"
                                                onclick="$('#apply-products tbody input[type=checkbox]').prop('checked', $(this).is(':checked'))" />
                                            Apply Promo Code to all products under this category.
                                            <table id="apply-products" class="table checkout-table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th width="1%">
                                                            <input type="checkbox"
                                                                onclick="$('#apply-products tbody input[type=checkbox]').prop('checked', $(this).is(':checked'))" />
                                                        </th>
                                                        <th class="table-title">Plan Name</th>
                                                        <th class="table-title">Service Code</th>
                                                        <th class="table-title">Price</th>
                                                        <th class="table-title">Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-5 col-md-8">
                                            <a href="javascript:void(0)" class="btn btn-red"
                                                onclick="save_global_discount('modal-add-discount')">Save&nbsp;<i
                                                    class="fa fa-floppy-o"></i></a>&nbsp;
                                            <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i
                                                    class="glyphicon glyphicon-ban-circle"></i></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END MODAL add new discount -->

            <div id="modal-delete-1" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true"
                class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true"
                                class="close">&times;</button>
                            <h4 id="modal-login-label3" class="modal-title"><a href=""><i
                                        class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this
                                item? </h4>
                        </div>
                        <div class="modal-body">
                            <!-- <p><strong>#1:</strong> MY-7974188 / Hock Lim</p> -->
                            <p>
                                <strong>#1:</strong>
                                <span class="modal_delete_name">Hock Lim</span> / <span
                                    class="modal_delete_email">hock@webqom.com</span>
                            </p>
                            {{ Form::open(['url' => url('admin/promotions/deleteGlobalDiscounts')]) }}
                            {{ Form::hidden('target_order', '', ['id' => 'single_item_id']) }}
                            <div class="form-actions">
                                <div class="col-md-offset-4 col-md-8">
                                    <button href="#" class="btn btn-red remove_single_item">
                                        Yes &nbsp;<i class="fa fa-check"></i>
                                    </button>&nbsp;
                                    <button href="#" data-dismiss="modal" class="btn btn-green delete-cancel-btn">
                                        No &nbsp;<i class="fa fa-times-circle"></i>
                                    </button>
                                    {{ Form::submit('delete order', ['class' => 'delete_order_submit hidden']) }}
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <p></p>
            <div class="clearfix"></div>
            <div class="col-lg-12" id="scrollDiv">
                <div class="portlet">
                    <div class="portlet-header">
                        <div class="caption">Global Discount Listing</div>
                        <p class="margin-top-10px"></p>
                        <br>
                        <a href="#" data-target="#modal-add-discount" data-toggle="modal" class="btn btn-success">Add
                            New Discount &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Delete</button>
                            <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span
                                    class="caret"></span><span class="sr-only">Toggle
                                    Dropdown</span></button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="javascript:void(0);" class="delete_selected_item_link">Delete selected
                                        item(s)</a></li>
                                <li class="divider"></li>
                                <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a></li>
                            </ul>
                        </div>&nbsp;
                    </div>

                    <!--Modal delete selected items start-->
                    <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label"
                        aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true"
                                        class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title"><a href=""><i
                                                class="fa fa-exclamation-triangle"></i></a> Are you sure you want to
                                        delete the selected item(s)? </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="selected_client_list"></div>

                                    <!-- <p><strong>#1:</strong> tbm-kl-0000000001 / Hock Lim</p> -->
                                    <div class="form-actions">
                                        <div class="col-md-offset-4 col-md-8">
                                            <a href="javascript:void(0);" class="btn btn-red delete_selected">
                                                Yes &nbsp;<i class="fa fa-check"></i>
                                            </a>&nbsp;
                                            <a href="#" data-dismiss="modal" class="btn btn-green">
                                                No &nbsp;<i class="fa fa-times-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal delete selected items end -->

                    <!--Modal no selected items start-->
                    <div id="modal-delete-unselect" tabindex="-1" role="dialog" aria-labelledby="modal-login-label"
                        aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true"
                                        class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title"><a href=""><i
                                                class="fa fa-exclamation-triangle"></i></a> Are you sure you want to
                                        delete selected items? </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-actions">
                                        <div class="alert alert-danger">
                                            Please select at least one Item for delete
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
                    <!-- modal no selected items end -->


                    <!--Modal delete all items start-->
                    <div id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modal-login-label"
                        aria-hidden="true" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" data-dismiss="modal" aria-hidden="true"
                                        class="close">&times;</button>
                                    <h4 id="modal-login-label3" class="modal-title"><a href=""><i
                                                class="fa fa-exclamation-triangle"></i></a> Are you sure you want to
                                        delete all items? </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-actions">
                                        {{ Form::open(['url' => url('admin/promotions/deleteAll')]) }}
                                        <div class="col-md-offset-4 col-md-8">
                                            <a href="#" class="btn btn-red delete-all-btn">
                                                Yes &nbsp;<i class="fa fa-check"></i>
                                            </a>&nbsp;
                                            <a href="#" data-dismiss="modal" class="btn btn-green">
                                                No &nbsp;<i class="fa fa-times-circle"></i>
                                            </a>
                                            {{ Form::submit('delete all', ['class' => 'delete-all-submit hidden']) }}
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal delete all items end -->

                    <div class="portlet-body">
                        <div class="clearfix"></div>

                        <div class="table-responsive mtl">
                            {!! Form::open(['url' => url('admin/promotions/deleteSelected')]) !!}
                            <table id="example1" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="1%"><input id="master" type="checkbox" /></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th><a href="#sort by Discount name">Discount</a></th>
                                        <th><a href="#sort by Order Subtotal Range ">Order Subtotal Range</a></th>
                                        <th><a href="#sort by Discount rate">Discount Rate (% or RM)</a></th>
                                        <th><a href="#sort by status">Status</a></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['global_discounts'] as $k => $v)
                                        <?php
                                        $status_class = $v->status == '0' ? 'label-red' : 'label-success';
                                        $status = $v->status == '0' ? 'In-active' : 'Active';
                                        // get discount category
                                        // id="item_{{ $v->id }}"
                                        ?>
                                        <tr data-id="{{ $v->id }}" id="clienttbl_row_{{ $v->id }}">
                                            {{-- <td><input class="sub_chk" entity="{{ $v->id }} "type="checkbox" /> --}}
                                            <td>
                                                {{ Form::checkbox('orders_checkbox[]', $v->id, false, ['class' => 'sub_chk']) }}
                                            </td>
                                            <td><span
                                                    class="order-index-{{ $v->id }}">{{ $k + 1 }}</span>
                                            </td>
                                            <td> <span
                                                    class="order-txn-id-{{ $v->id }}">{{ $v->discount_name }}</span>
                                            </td>
                                            <td><span
                                                    class="order-client-name-{{ $v->id }}">{{ $v->discount }}</span>
                                            </td>
                                            <td>From RM {{ number_format($v->from_amount, 2) }} to RM
                                                {{ number_format($v->to_amount, 2) }}</td>
                                            <td>{{ $v->discount_by }}</td>
                                            <td>
                                                @if ($v->status == '1')
                                                    <span class="label label-xs label-success">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="label label-xs label-danger">
                                                        Inactive
                                                    </span>
                                                @endif
                                            <td>
                                                <a href="#" data-hover="tooltip" data-placement="top" title="Edit"
                                                    data-target="#modal-edit-discount-<?php echo $v->id; ?>"
                                                    data-toggle="modal"><span class="label label-sm label-success"><i
                                                            class="fa fa-pencil"></i></span></a>
                                                <a href="#" data-hover="tooltip" data-placement="top"
                                                    class="single-delete-btn" title="Delete"
                                                    data-id="{{ $v->id }}" data-toggle="modal">
                                                    <span class="label label-sm label-red delete_icon">
                                                        <i class="fa fa-trash-o"></i>
                                                    </span>
                                                </a>

                                                <!--Modal edit discount start-->
                                                <div id="modal-edit-discount-<?php echo $v->id; ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="modal-login-label" aria-hidden="true"
                                                    class="modal fade">
                                                    <div class="modal-dialog modal-wide-width">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" data-dismiss="modal"
                                                                    aria-hidden="true" class="close">&times;
                                                                </button>
                                                                <h4 id="modal-login-label3" class="modal-title">Edit
                                                                    Discount</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form">
                                                                    <form class="form-horizontal"
                                                                        id="form_edit_global_discount">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="col-md-3 control-label">Status
                                                                                <span
                                                                                    class="text-red">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <div data-on="success"
                                                                                    data-off="primary"
                                                                                    class="make-switch">
                                                                                    <input type="checkbox" name="status"
                                                                                        <?php if ($v->status == '1') {
                                                                                            echo 'checked="checked"';
                                                                                        } ?> />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="col-md-3 control-label">Discount
                                                                                Name <span
                                                                                    class="text-red">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    placeholder="eg. Sample 2"
                                                                                    name="discount_name"
                                                                                    id="discount_name"
                                                                                    value="{{ $v->discount_name }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="inputFirstName"
                                                                                class="col-md-3 control-label">From
                                                                                Amount <span
                                                                                    class="text-red">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" name="from_amount"
                                                                                    class="form-control"
                                                                                    placeholder="Amount"
                                                                                    value="{{ number_format($v->from_amount, 2) }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                        <div class="form-group">
                                                                            <label for="inputFirstName"
                                                                                class="col-md-3 control-label">To
                                                                                Amount
                                                                                <span
                                                                                    class="text-red">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" name="to_amount"
                                                                                    class="form-control"
                                                                                    placeholder="Amount"
                                                                                    value="{{ number_format($v->to_amount, 2) }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                        <div class="form-group">
                                                                            <label for="inputFirstName"
                                                                                class="col-md-3 control-label">Discount
                                                                                <span
                                                                                    class="text-red">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" name="discount"
                                                                                    class="form-control"
                                                                                    placeholder="Amount"
                                                                                    value="{{ number_format($v->discount, 2) }}">
                                                                                <div class="xs-margin"></div>
                                                                                <select name="discount_by"
                                                                                    class="form-control">
                                                                                    <option value="percentage"
                                                                                        <?php if ($v->discount_by == 'percentage') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>%
                                                                                    </option>
                                                                                    <option value="amount"
                                                                                        <?php if ($v->discount_by == 'amount') {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>>RM
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                        
                                                                        $discount_category = DB::table('global_discounts_to_category')
                                                                            ->where('global_discount_id', $v->id)
                                                                            ->pluck('category_id')
                                                                            ->toArray();
                                                                        // dd($discount_category[0]);
                                                                        // get category list with selected category
                                                                        $discount_products = [];
                                                                        $category_products_list = [];
                                                                        if ($discount_category) {
                                                                            $categoriesList = $this->CategoryModel->getSelectedCategoriesTree($discount_category);
                                                                        
                                                                            // get discount products
                                                                            $discount_products = DB::table('global_discounts_to_products')
                                                                                ->where('global_discount_id', $v->id)
                                                                                ->pluck('product_id');
                                                                        
                                                                            // get category products
                                                                            $category_products_list = $this->ProductModel->categoryProducts($discount_category[0]);
                                                                        } else {
                                                                            $categoriesList = $this->CategoryModel->getCategoriesTree();
                                                                        }
                                                                        
                                                                        ?>
                                                                        <div class="form-group">
                                                                            <label for="inputFirstName"
                                                                                class="col-md-3 control-label">Apply to
                                                                                Category</label>
                                                                            <div class="col-md-6">
                                                                                <div class="xs-margin"></div>
                                                                                <select name="category_id"
                                                                                    class="form-control"
                                                                                    onchange="load_category_products('modal-edit-discount-<?php echo $v->id; ?>',this.value)">
                                                                                    <?php echo $categoriesList; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>


                                                                        <div class="form-group" id="apply_to_all"
                                                                            <?php if (sizeof($category_products_list) == 0) {
                                                                                echo 'style="display:none;"';
                                                                            } ?>>
                                                                            <label class="col-md-3 control-label">Apply
                                                                                to
                                                                                Products</label>
                                                                            <div class="col-md-9">
                                                                                <input type="checkbox"
                                                                                    id="select_edit_products"
                                                                                    onclick="select_edit_products_list('modal-edit-discount-<?php echo $v->id; ?>')">
                                                                                Apply discount to all products under
                                                                                this
                                                                                category.

                                                                                <div id="category_products">
                                                                                    <table
                                                                                        class="table checkout-table table-responsive">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th width="1%"></th>
                                                                                                <th
                                                                                                    class="table-title">
                                                                                                    Plan
                                                                                                    Name
                                                                                                </th>
                                                                                                <th
                                                                                                    class="table-title">
                                                                                                    Service
                                                                                                    Code
                                                                                                </th>
                                                                                                <th
                                                                                                    class="table-title">
                                                                                                    Price
                                                                                                </th>
                                                                                                <th
                                                                                                    class="table-title">
                                                                                                    Quantity
                                                                                                </th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php
														if($category_products_list){

														foreach($category_products_list as $elm)
														{

														$checked = (in_array($elm->id, $discount_products->toArray())) ? 'checked="checked"' : '';
														?>
                                                                                            <tr>
                                                                                                <td><input
                                                                                                        type="checkbox"
                                                                                                        name="product_id[]"
                                                                                                        value="{{ $elm->id }}"
                                                                                                        class="select_products"
                                                                                                        <?php echo $checked; ?> />
                                                                                                </td>
                                                                                                <td
                                                                                                    class="item-name-col">

                                                                                                    <header
                                                                                                        class="item-name">
                                                                                                        <a
                                                                                                            href="#link to product item">{{ $elm->plan_name }}</a>
                                                                                                    </header>
                                                                                                </td>
                                                                                                <td
                                                                                                    class="item-code">
                                                                                                    {{ $elm->service_code }}
                                                                                                </td>
                                                                                                <td
                                                                                                    class="item-price-col">
                                                                                                    <span
                                                                                                        class="item-price-special">
                                                                                                        RM
                                                                                                        {{ number_format($elm->price - ($elm->price * $v->discount) / 100, 2) }}
                                                                                                    </span>
                                                                                                </td>
                                                                                                <td>{{ $elm->quantity }}
                                                                                                </td>
                                                                                            </tr>
                                                                                            <?php
														} // end foreach
														}
														?>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>

                                                                            </div>
                                                                        </div>


                                                                        <div class="form-actions">
                                                                            <div class="col-md-offset-5 col-md-8">
                                                                                <input type="hidden"
                                                                                    name="global_discount_id"
                                                                                    value="{{ $v->id }}" />
                                                                                <input type="hidden" name="_token"
                                                                                    value="{{ csrf_token() }}" />

                                                                                <a href="javascript:void(0)"
                                                                                    onclick="update_global_discount('modal-edit-discount-<?php echo $v->id; ?>')"
                                                                                    class="btn btn-red">Save
                                                                                    &nbsp;<i
                                                                                        class="fa fa-floppy-o"></i></a>&nbsp;
                                                                                <a href="#" data-dismiss="modal"
                                                                                    class="btn btn-green">Cancel
                                                                                    &nbsp;<i
                                                                                        class="glyphicon glyphicon-ban-circle"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--END MODAL edit discount -->
                                                <!--Modal delete start-->
                                                <div id="modal-delete-2" tabindex="-1" role="dialog"
                                                    aria-labelledby="modal-login-label" aria-hidden="true"
                                                    class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" data-dismiss="modal"
                                                                    aria-hidden="true"
                                                                    class="close">&times;</button>
                                                                <h4 id="modal-login-label4" class="modal-title"><a
                                                                        href=""><i
                                                                            class="fa fa-exclamation-triangle"></i></a>
                                                                    Are you sure you want to delete this item? </h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>#02:</strong> From RM 500.00 to RM 1,000.00 -
                                                                    15%</p>
                                                                <div class="form-actions">
                                                                    <div class="col-md-offset-4 col-md-8"> <a href="#"
                                                                            class="btn btn-red">Yes &nbsp;<i
                                                                                class="fa fa-check"></i></a>&nbsp;
                                                                        <a href="#" data-dismiss="modal"
                                                                            class="btn btn-green">No &nbsp;<i
                                                                                class="fa fa-times-circle"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- modal delete end -->
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{ Form::submit('Submit', ['class' => 'delete-submit hidden']) }}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8"></td>
                                    </tr>
                                </tfoot>
                            </table>
                            {!! Form::close() !!}
                            <?php $showFrom = empty($data['pagination_report']) ? 0 : ($data['global_discounts']->currentpage() - 1) * $data['global_discounts']->perpage() + 1; ?>
                            <?php if ($data['global_discounts'] instanceof \Illuminate\Pagination\LengthAwarePaginator){ ?>
                            <span> Showing <span class="showFrom">{{ $showFrom }}</span> to <span
                                    class="showTo">{{ ($data['global_discounts']->currentpage() - 1) * $data['global_discounts']->perpage() + $data['global_discounts']->count() }}
                                </span> of {{ $data['global_discounts']->total() }} items</span>
                            <span
                                class="pull-right pagination-links">{{ $data['global_discounts']->links() }}</span>
                            <?php }else{ ?>
                            <span>Total records: {{ count($data['global_discounts']) }}</span>
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
    <!-- InstanceEndEditable -->
    <!--END CONTENT-->
</div>
@section('custom_scripts')
    <script type="text/javascript">
        // Add and modified by aklima
        $(document).ready(function() {
            $('#category_id').on('change', function(e) {
                e.preventDefault();
                var category_id = $(this).val();
                // load_category_products(category_id);
            })
            $('.form-add-discounts').submit(function(e) {
                e.preventDefault();
                var formData = new FormData($('.form-add-discount')[0]);
                $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        cache: false,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-Token': $('#token_create').val()
                        },
                        data: formData
                    })
                    .done(function(res) {
                        refreshCreateDiscountForm();
                        if (res.error === 1) {
                            $.each(res, function(x, y) {
                                if (y.discount_name != undefined) {
                                    $('#discount_name').closest('div').removeClass().addClass(
                                        'col-md-6 has-error');
                                }
                                if (y.from_amount != undefined) {
                                    $('#from_amount').closest('div').removeClass().addClass(
                                        'input-group has-error');
                                }
                                if (y.to_amount != undefined) {
                                    $('#to_amount').closest('div').removeClass().addClass(
                                        'col-md-6 has-error');
                                }
                                if (y.discount != undefined) {
                                    $('#discount').closest('div').removeClass().addClass(
                                        'col-md-9 has-error');
                                }
                            });
                        }
                        if (res.error === 0) {
                            location.reload();
                        }
                    })
                    .error(function(err) {
                        if (err.status == 422) {
                            $('#modal-add-discount').animate({
                                scrollTop: 0
                            }, 'slow');
                            var err_msg = '';
                            $.each(err["responseJSON"], function(i, v) {
                                err_msg += '<p>' + v + '</p>';
                            });
                            $('#alert-div').html(
                                ' <i class="fa fa-times-circle"></i> <strong>Error!</strong>' +
                                err_msg);
                            // $('#alert-div').html(' <i class="fa fa-times-circle"></i> <strong>Error!</strong>' + '<p>' + err["responseJSON"]["message"]+ '</p>');
                            $('#alert-div').addClass('alert alert-danger alert-dismissable');
                        }
                    });
            });

            $('.delete_selected_item_link').on('click', function() {
                console.log('sub check selected or not');
                checked_orders = $(".sub_chk:checked");
                console.log('checked_orders');
                console.log(checked_orders);
                if (checked_orders.length > 0) {
                    var html = "";

                    checked_orders.each(function() {
                        reference_id = $(this).val();

                        html += "<p>";
                        html += "<strong>#" + $('.order-index-' + reference_id).text() +
                            ":</strong> ";
                        html += $('.order-txn-id-' + reference_id).text() + " - ";
                        html += $('.order-client-name-' + reference_id).text();
                    });

                    $(".selected_client_list").html(html);
                    $("#modal-delete-selected").modal('show');
                } else {
                    $('#modal-delete-unselect').modal('show');
                }
            });

            $('.delete-all-btn').on('click', function(event) {
                event.preventDefault();
                $('.delete-all-submit').click();
            })

            $('#master').on('click', function(e) {
                console.log('selected data all');
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });

            $('.single-delete-btn').on('click', function(event) {
                var target_id = $(this).data('id');

                $("#single_item_id").val(target_id);
                $(".modal_delete_name").text($('.order-txn-id-' + target_id).text());
                $(".modal_delete_email").text($('.order-client-name-' + target_id).text());
                $("#modal-delete-1").modal('show');
            });

            $('.alert-hide-btn').on('click', function(event) {
                $(this).parent().addClass('hidden');
            });

            $('.remove_single_item').on('click', function(event) {
                $('.delete_order_submit').click();
            });

            $('.delete_selected').on('click', function() {
                $('.delete-submit').click();
            });
        })

        function refreshCreateDiscountForm() {
            $('#discount_name').closest('div').removeClass('has-error');
            $('#from_amount').closest('div').removeClass('has-error');
            $('#to_amount').closest('div').removeClass('has-error');
            $('#discount').closest('div').removeClass('has-error');
        }

        function load_category_products(model_id, category_id) {
            var discount = "{{ isset($v->discount) ? $v->discount / 100 : 0 }}";
            $('#' + model_id + ' #category_products').html('');
            $('#' + model_id + ' #apply_to_all').hide();
            $('#apply-products tbody').html('');
            $.ajax({
                url: '{{ url('/admin/promotions/categoryProducts') }}',
                type: 'POST',
                dataType: 'json',
                data: '_token=<?php echo csrf_token(); ?>&category_id=' + category_id,
                beforeSend: function() {

                },
                complete: function() {

                },
                success: function(response) {
                    var html = '';
                    if (response['products']) {

                        $('#' + model_id + ' #apply_to_all').show();
                        for (var i = 0; i < response['products'].length; i++) {
                            elm = response['products'][i];
                            html += '<tr><td><input type="checkbox" name="product_id[]" value="' + elm.id +
                                '" class="select_products"/></td><td class="item-name-col"><header class="item-name">' +
                                elm.plan_name + '</a> </header></td><td class="item-code">' + elm.service_code +
                                '</td><td class="item-price-col"><span class="item-price-special">RM ' +
                                parseFloat((elm.price - (discount * elm.price))).toFixed(2) +
                                '</span></td><td>' + elm.quantity + '</td></tr>';
                            //products += '<p>'+ response['products'][i].type +'</p>';
                            //alert(response['products'][i].type);
                        }
                        // products += '</tbody></table>';
                        $('#' + model_id + ' #apply-products tbody').html(html);
                    }
                }
            });
        }

        function save_global_discount(model_id) {
            $.ajax({
                url: "{{ route('admin.discount.store') }}",
                type: 'POST',
                dataType: 'json',
                data: $('#form_add_global_discount').serialize(),
                beforeSend: function() {

                },
                complete: function() {

                },
                success: function(response) {
                    if (response['error']) {
                        $('#' + model_id + ' #errorElement').remove();
                        $('#' + model_id + ' #successElement').remove();
                        var error =
                            '<div id="errorElement" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
                        for (var i = 0; i < response['error'].length; i++) {
                            error += '<p>' + response['error'][i] + '</p>';
                        }
                        error += '</div>';
                        $('#' + model_id + ' #form_add_global_discount').before(error);
                    }

                    if (response['success']) {
                        $('#' + model_id + ' #errorElement').remove();
                        $('#' + model_id + ' #successElement').remove();
                        var success =
                            '<div id="successElement" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.</p></div>';
                        $('#' + model_id + ' #form_add_global_discount').before(success);

                        $('#' + model_id + ' #apply_to_all').hide();
                        $('#' + model_id + ' #form_add_global_discount')[0].reset();

                        setTimeout(function() {
                            location.reload();
                        }, 300);
                    }
                }
            });
        }

        function update_global_discount(model_id) {
            $.ajax({
                url: '{{ url('admin/promotions/updateGlobalDiscount') }}',
                type: 'POST',
                dataType: 'json',
                data: $('#' + model_id + ' #form_edit_global_discount').serialize(),
                beforeSend: function() {

                },
                complete: function() {

                },
                success: function(response) {
                    if (response['error']) {
                        $('#' + model_id + ' #errorElement').remove();
                        $('#' + model_id + ' #successElement').remove();
                        var error =
                            '<div id="errorElement" class="alert alert-danger"><i class="fa fa-times-circle"></i> <strong>Error!</strong>';
                        for (var i = 0; i < response['error'].length; i++) {
                            error += '<p>' + response['error'][i] + '</p>';
                        }
                        error += '</div>';
                        $('#' + model_id + ' #form_edit_global_discount').before(error);
                    }

                    if (response['success']) {
                        $('#' + model_id + ' #errorElement').remove();
                        $('#' + model_id + ' #successElement').remove();
                        var success =
                            '<div id="successElement" class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Success!</strong><p>The information has been saved/updated successfully.</p></div>';
                        $('#' + model_id + ' #form_edit_global_discount').before(success);

                        //$('#'+model_id+' #apply_to_all').hide();
                        setTimeout(function() {
                            location.reload();
                        }, 300);

                    }
                }
            });
        }
    </script>
@endsection
@endsection
