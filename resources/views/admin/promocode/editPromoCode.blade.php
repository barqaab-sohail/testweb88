<?php $page  ='promocode'; ?>
@extends('layouts.admin_layout')
@section('title','Admin | Promo Codes')
@section('content')
@section('page_header','Promocode')

@push('styles')
    <style>
        .switch-on.switch-animate {
            height: 30px;
        }
        .switch-animate {
            height: 30px;
        }
    </style>
@endpush
    
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
            	<h2>Promo Codes <i class="fa fa-angle-right"></i> Edit</h2>
	            <div class="clearfix"></div>
                @if ($success)
                    <div class="alert alert-success alert-dismissable">
	                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
    	                <i class="fa fa-check-circle"></i> <strong>Success!</strong>
        	            <p>{{ $success }}</p>
                    </div>
                @endif

                @if ($warning)
                    <div class="alert alert-danger alert-dismissable">
	                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
    	                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
        	            <p>{{ $warning }}</p>
                    </div>
                @endif

                @if($errors)
                    <div class="alert alert-danger">
                        @foreach ($errors as $error)
                            <i class="fa fa-exclamation-triangle"></i> &nbsp;{{ $error }} <br />
                        @endforeach
                    </div>
                @endif

                <ul id="myTab" class="nav nav-tabs">
                	<li <?= ($from_promocode == true ? '' : 'class="active"') ?>><a href="#details" data-toggle="tab">Details</a></li>
                    <li <?= ($from_promocode == true ? 'class="active"': '') ?>><a href="#discounted-items" data-toggle="tab" id="discounted-items-link">Discounted Items</a></li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div id="details" class="tab-pane fade<?= ($from_promocode == true ? '' : ' in active') ?>">
                        <div class="portlet">
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" method="post">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                    <div data-on="success" data-off="primary" class="make-switch">
                                                        <input type="checkbox" name="status" value="on" <?= ($promocode->status == '1') ? 'checked="checked"' : '' ?> />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Campaign Name <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                	<input type="text" class="form-control" name="campaign_name" value="{{ $promocode->campaign_name }}" />
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Promo Code <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="promo_code" value="{{ $promocode->promo_code }}" />
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Min. Subtotal</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="min_subtotal" value="{{ $promocode->min_subtotal }}" />
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Discount</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="discount" value="{{ $promocode->discount }}" />
                                                    <div class="xs-margin"></div>
                                                    <select class="form-control" name="discount_type">
                                                        <option <?= ($promocode->discount_type == 'P') ? 'selected="selected"' : '' ?> value="P">%</option>
                                                        <option <?= ($promocode->discount_type == 'F') ? 'selected="selected"' : '' ?> value="F">RM</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Start Date to End Date</label>
                                                <div class="col-md-6">
                                                    <div class="input-group input-daterange">
                                                        <input type="text" class="form-control" name="start_date" value="{{ date('d-m-Y', strtotime($promocode->start_date)) }}" />
                                                        <span class="input-group-addon">to</span>
                                                        <input type="text" class="form-control" name="end_date" value="{{ date('d-m-Y', strtotime($promocode->end_date)) }}" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Times to Use</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="times_to_use" value="{{ $promocode->times_to_use }}" />
                                                    <div class="xs-margin"></div>
                                                    <div class="text-blue text-12px">(Times to Use defines the maximum number of orders allowed to use this coupon. For example, if this is set to 5, the 6th order using this coupon will not receive the discount.)</div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Global Discounts</label>
                                                <div class="col-md-6">
                                                    <div class="xs-margin"></div>
                                                    <select class="form-control" name="global_discounts">
                                                        <option <?= ($promocode->global_discounts == 'Ignore') ? 'selected="selected"' : '' ?> value="Ignore">Ignore</option>
                                                        <option <?= ($promocode->global_discounts == 'Apply Both') ? 'selected="selected"' : '' ?> value="Apply Both">Apply Both</option>
                                                    </select>
                                                    <div class="xs-margin"></div>
                                                    <div class="text-blue text-12px">(If set to 'Ignore,' then Global Discounts will not apply to an order that uses this coupon. If set to 'Apply Both,' the coupon discount and Global Discounts will be calculated based on the Cart Subtotal independently of each other and then applied to Order Total.)</div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Coupon Application Rule
                                                <br><div class="text-12px">(If there are products not specified in Discounted Items List)</div>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="xs-margin"></div>
                                                    <select class="form-control" name="coupon_application_rule">
                                                        <option  <?= ($promocode->coupon_application_rule == 'N') ? 'selected="selected"' : '' ?> value="N">Do not apply the coupon</option>
                                                        <option  <?= ($promocode->coupon_application_rule == 'Y') ? 'selected="selected"' : '' ?> value="Y">Apply the coupon but only to the products specified in the Discounted Items List</option>
                                                    </select>
                                                    <div class="xs-margin"></div>
                                                        <div class="text-blue text-12px">
                                                        <p><b>1. Apply the coupon only to the products from Discounted Items List: </b>When the products not specified in Discounted Items List are in the cart, the coupon discount applies only to the products from Discounted Items List</p>
                                                        <p><b>2. Do not apply the coupon if the products not specified in Discounted Items List are in the cart: </b>If the products not specified in Discounted Items List are in the cart, the coupon will be disabled.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                            	<div class="col-md-offset-5 col-md-7">
                                                	<button type="submit" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp;
                                                    <a href="{{ url('web88cms/promocodes') }}" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>
                                                </div>
                                            </div>
                                            <input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </div>
                                </div>
	                            <div class="md-margin"></div>
                            </div>
	                        <div class="clearfix"></div>
                        </div>
                    </div>

					<div id="discounted-items" class="tab-pane fade <?= ($from_promocode == true ? 'in active' : '') ?>">
                        <div class="portlet">
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="alert alert-success alert-dismissable" id="promo-success" hidden>
                                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                        <i class="fa fa-check-circle"></i> <strong>Success!</strong>
                                        <p></p>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="alert alert-warning">
                                            <p><i class="fa fa-gift"></i> Promo Code: <strong>'{{ $promocode->promo_code }}'</strong></p>
                                            <i class="fa fa-ticket"></i> Campaign Name: <strong>{{ $promocode->campaign_name }}</strong>
                                        </div>
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                    <label for="inputFirstName" class="col-md-3 control-label">Apply to Category</label>
                                                    <div class="col-md-6">
                                                        <div class="xs-margin"></div>
                                                        <select class="form-control" name="categories">
                                                            {!! $categories !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Apply to Products</label>
                                                    <div class="col-md-9">
                                                        <div class="clearfix"></div>
                                                        <input type="checkbox" name="apply_to_all_product" value="on" onclick="$('#apply-products tbody input[type=checkbox]').prop('checked', $(this).is(':checked'))" />
                                                        Apply Promo Code to all products under this category.
                                                        <table id="apply-products" class="table checkout-table table-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <th width="1%">
                                                                    	<input type="checkbox" onclick="$('#apply-products tbody input[type=checkbox]').prop('checked', $(this).is(':checked'))" />
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
                                                  <div class="col-md-offset-4 col-md-7">
                                                    <a href="javascript:void(0)" id="add-category" class="btn btn-red">Add Category &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                                                    <a href="javascript:void(0)" id="add-product" class="btn btn-red">Add Product &nbsp;<i class="fa fa-plus"></i></a>&nbsp;
                                                    <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green" onclick="$('#apply-products input[type=checkbox]').prop('checked', false)" />Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>

                                                </div>
                                                <div class="lg-margin"></div>


                                                <div class="col-md-6">
                                                    <h5 class="block-heading">Category Affected</h5>
                                                    
                                                    <div class="btn-group">
                                                      <button type="button" class="btn btn-primary">Delete</button>
                                                      <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span
                                                                  class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                                                      <ul role="menu" class="dropdown-menu">
                                                          <li><a href="#" onclick="deleteSelected('chk-category', 'modal-delete-selected')">Delete selected item(s)</a></li>
                                                          <li class="divider"></li>
                                                          <li><a href="#" data-target="#modal-delete-all" data-toggle="modal">Delete all</a>
                                                          </li>
                                                      </ul>
                                                  </div>

                                                  <!--modal delete selected  at least one items start-->
                                                        <div id="modal-selected-least-one" tabindex="-1" role="dialog"
                                                        aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                                                                            &times;
                                                                        </button>
                                                                        <h4 id="modal-login-label4" class="modal-title"><a href=""><i
                                                                                        class="fa fa-exclamation-triangle"></i></a> Are you sure you
                                                                            want to delete the selected item(s)? </h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="alert alert-danger" role="alert">
                                                                            Please select at least one element for delete
                                                                        </div>
                                                                        <div class="form-actions">
                                                                            <div class="col-md-offset-4 col-md-8">
                                                                                <a href="javascript:void(0)" data-dismiss="modal"
                                                                                    onclick="cancel_delete()" class="btn btn-green">OK &nbsp;<i
                                                                                            class="fa fa-times-circle"></i>
                                                                                </a>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                  <!-- modal delete selected  at least one items end -->

                                                  <!--Modal delete selected items start-->
                                                  <div id="modal-delete-selected" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                          <div class="form-actions">
                                                            <div class="col-md-offset-4 col-md-8">
                                                            	<a href="javascript:void(0)" data-type="selected" class="btn btn-red del-sel-category">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
                                                                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                                                            </div>
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
                                                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                          <div class="form-actions">
                                                            <div class="col-md-offset-4 col-md-8">
                                                            	<a href="javascript:void(0)" data-type="all" class="btn btn-red del-sel-category">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
                                                                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <!-- modal delete all items end -->

                                                    <table class="table table-hover table-striped table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th width="1%"><input type="checkbox" onclick="$('.chk-category').prop('checked', $(this).is(':checked'))"  /></th>
                                                                <th class="table-title">Category</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($promocodeCategories as $promocodeCategory)
                                                            <tr>
                                                                <td><input type="checkbox" class="chk-category" name="category[]" value="{{ $promocodeCategory->category_id }}" /></td>
                                                                <td>{{ $promocodeCategory->title }}</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-{{ $promocodeCategory->category_id }}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                                                <!--Modal delete start-->
                                                                <div id="modal-delete-{{ $promocodeCategory->category_id }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                                  <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                                        <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this category? </h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                        <p>{{ $promocodeCategory->title }}</p>
                                                                        <div class="form-actions">
                                                                          <div class="col-md-offset-4 col-md-8">
                                                                            <a href="{{ url('web88cms/promocodes/deletePromocodeToCategory/' . $promocode->id)}}?category[]={{ $promocodeCategory->category_id }}" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
                                                                            <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
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
                                                        </tbody>
                                                    </table>
                                                </div>


                                                <div class="col-md-6">
                                                    <h5 class="block-heading">Product Affected</h5>
                                                    <div class="btn-group">
                                                    <button type="button" class="btn btn-primary">Delete</button>
                                                    <button type="button" data-toggle="dropdown" class="btn btn-red dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                                                    <ul role="menu" class="dropdown-menu">
                                                      <li><a href="javascript:void(0)" onclick="deleteSelected('chk-product', 'modal-delete-selected-pro')" data-toggle="modal">Delete selected item(s)</a></li>
                                                      <li class="divider"></li>
                                                      <li><a href="javascript:void(0)" data-target="#modal-delete-all-pro" data-toggle="modal">Delete all</a></li>
                                                    </ul>
                                                  </div>

                                                  <!--Modal delete selected items start-->
                                                  <div id="modal-delete-selected-pro" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete the selected item(s)? </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                          <div class="form-actions">
                                                            <div class="col-md-offset-4 col-md-8">
                                                            	<a href="javascript:void(0)" data-type="selected" class="btn btn-red del-sel-product">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
                                                                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <!-- modal delete selected items end -->
                                                  <!--Modal delete all items start-->
                                                  <div id="modal-delete-all-pro" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                          <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete all items? </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                          <div class="form-actions">
                                                            <div class="col-md-offset-4 col-md-8">
                                                            	<a href="javascript:void(0)" data-type="all" class="btn btn-red del-sel-product">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
                                                                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <!-- modal delete all items end -->

                                                    <table class="table table-hover table-striped table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th width="1%"><input type="checkbox" onclick="$('.chk-product').prop('checked', $(this).is(':checked'))"  /></th>
                                                                <th class="table-title">Product</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($promocodeProducts as $promocodeProduct)
                                                            <tr>
                                                                <td><input type="checkbox" class="chk-product" name="product[]" value="{{ $promocodeProduct->product_id }}" /></td>
                                                                <td>{{ $promocodeProduct->plan_name }}</td>
                                                                <td>
                                                                    <a href="javascript:void(0)" data-hover="tooltip" data-placement="top" title="Delete" data-target="#modal-delete-pro-{{ $promocodeProduct->product_id }}" data-toggle="modal"><span class="label label-sm label-red"><i class="fa fa-trash-o"></i></span></a>
                                                                <!--Modal delete start-->
                                                                <div id="modal-delete-pro-{{ $promocodeProduct->product_id }}" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
                                                                  <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                                                                        <h4 id="modal-login-label3" class="modal-title"><a href=""><i class="fa fa-exclamation-triangle"></i></a> Are you sure you want to delete this product? </h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                        <p>{{ $promocodeProduct->plan_name }}</p>
                                                                        <div class="form-actions">
                                                                          <div class="col-md-offset-4 col-md-8">
                                                                            <a href="{{ url('admin/promocodes/deletePromocodeToProduct/' . $promocode->id)}}?product[]={{ $promocodeProduct->product_id }}" class="btn btn-red">Yes &nbsp;<i class="fa fa-check"></i></a>&nbsp;
                                                                            <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">No &nbsp;<i class="fa fa-times-circle"></i></a>
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
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- end col-md-6 -->

                                                <div class="clearfix"></div>

                                                <!--<div class="form-actions">
                                                  <div class="col-md-offset-5 col-md-7"> <a href="javascript:void(0)" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
                                                </div>-->

                                        </form>



                                    </div>
                                    <!-- end col-md-12 -->





                                </div>
                                <!-- end row -->

                                <div class="clearfix"></div>
                            </div>
                            <!-- end portlet-body -->


                          </div>
                          <!-- end portlet -->

                    </div>


                </div>
            </div>
        </div>
    </div>


@section('custom_scripts')


<script>

function deleteSelected(_class, modal) {
  
    if ($('.'+_class+':checked').length == 0) {
        $('#modal-selected-least-one').modal('show');
    } else {
        $('#'+modal).modal('show');
    }
}
$('select[name="categories"]').change(function(){
	$('#apply-products tbody').html('');
	var category_id = $(this).val()

	$.ajax({
		url: '{{ url("/admin/promotions/categoryProducts") }}',
		type: 'POST',
		dataType: 'json',
		data: "_token={{csrf_token()}}&category_id="+category_id,
		beforeSend: function(){

		},
		complete: function(){

		},
		success: function(response){
			if(response && response['products'])
			{
				var html = '';

				for(var i=0; i < response['products'].length; i++)

				{
					product = response['products'][i];
					html += '<tr>';
						html += '<td><input type="checkbox" name="product_id[]" value="'+ product.id +'" class="select_products"/></td>';
						html += '<td class="item-name-col">';
							html += '<header class="item-name">';
								html += ' '+product.plan_name+' ';
							html += ' </header>';
						html += '</td>';
						html += '<td class="item-code">'+ product.service_code +'</td>';
						html += '<td class="item-price-col"><span class="item-price-special">RM '+ parseFloat(product.price).toFixed(2) +'</span></td>';
						html += '<td>'+ 1 +'</td>';
					html += '</tr>';
				}

				$('#apply-products tbody').html(html);
			}
		}
	});
});

$('#add-category').click(function(){
	var category_id = $('select[name="categories"]').val();

	$.ajax({
		url: '{{ url("/admin/promocodes/addPromoCodeCategory/" . $promocode->id) }}',
		type: 'POST',
		dataType: 'json',
		data: {_token: '<?php echo csrf_token() ?>', category_id : category_id},
		beforeSend: function(){
			$('#add-category').html('Saving.. &nbsp;<i class="fa fa-plus"></i>');

		},
		complete: function(){
			$('#add-category').html('Add Category &nbsp;<i class="fa fa-plus"></i>');
		},
		success: function(response){
			if(response['success'])
			{
				window.location.reload();
            }
		}
	});
});

$('#add-product').click(function(){
	var products = $('#apply-products input[type="checkbox"]:checked, #_token');

	$.ajax({
		url: '{{ url("/admin/promocodes/addPromoCodeProduct/" . $promocode->id) }}',
		type: 'POST',
		dataType: 'json',
		data: products,
		beforeSend: function(){
			$('#add-product').html('Saving.. &nbsp;<i class="fa fa-plus"></i>');

		},
		complete: function(){
			$('#add-product').html('Add Product &nbsp;<i class="fa fa-plus"></i>');
		},
		success: function(response){
			if(response['success'])
			{
                window.location.reload();
			}
		}
	});
});

$(function(){
	$('.del-sel-category').click(function(){
		var type = $(this).attr('data-type');
		var obj = $(this);

		if(type == 'selected'){
			values = $('.chk-category:checked, #_token');
		}
		else{
			values = $('.chk-category, #_token');
		}

		var total = values.length;
		if(total > 1){
			$.ajax({
				url: "{{ url('admin/promocodes/deletePromocodeToCategory/' . $promocode->id) }}",
				type: 'POST',
				data: values,
				dataType: 'json',
				async: false,
				cache: false,
				beforeSend:function (){
					obj.html('Saving... <i class="fa fa-floppy-o"></i>');
				},
				complete: function(){
					obj.html('Save <i class="fa fa-floppy-o"></i>');
				},
				success: function (response) {
					if(response['success'])
					{
                         window.location.reload();

					}
				}
			});
		}
		else{
			alert('Please select at least one category before delete.');
		}
	});
});

$(function(){
	$('.del-sel-product').click(function(){
		var type = $(this).attr('data-type');
		var obj = $(this);

		if(type == 'selected'){
			values = $('.chk-product:checked, #_token');
		}
		else{
			values = $('.chk-product, #_token');
		}
    
		var total = values.length;
		if(total > 1){
			$.ajax({
				url: "{{ url('admin/promocodes/deletePromocodeToProduct/' . $promocode->id) }}",
				type: 'POST',
				data: values,
				dataType: 'json',
				async: false,
				cache: false,
				beforeSend:function (){
					obj.html('Saving... <i class="fa fa-floppy-o"></i>');
				},
				complete: function(){
					obj.html('Save <i class="fa fa-floppy-o"></i>');
				},
				success: function (response) {
					if(response['success'])
					{
						window.location.reload();
					}
				}
			});
		}
		else{
			alert('Please select at least one product before delete.');
		}
	});
});
</script>
@endsection
@endsection


