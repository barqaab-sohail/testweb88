@extends('layouts.new_admin_layout')
@section('title','Admin | Create Promotion list')
@section('content')
@section('page_header','Promotion Pages')
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
            	<h2>Promo Codes <i class="fa fa-angle-right"></i> Add New</h2>
	            <div class="clearfix"></div>
            
                <ul id="myTab" class="nav nav-tabs">
                	<li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div id="details" class="tab-pane fade in active">
                        <div class="portlet">
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php  ?>
                                        @if ($errors->any())
                                            <ul class="alert alert-danger">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        <form class="form-horizontal" method="post" action="{{ url('admin/promocodes/storePromo')}}">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Status <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                    <div data-on="success" data-off="primary" class="make-switch">
                                                        <input type="checkbox" name="status" value="on" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Campaign Name <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                	<input type="text" class="form-control" name="campaign_name" />
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Promo Code <span class="text-red">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="promo_code" />
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Min. Subtotal</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="min_subtotal" />
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Discount</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="discount" />
                                                    <div class="xs-margin"></div>
                                                    <select class="form-control" name="discount_type">
                                                        <option value="P">%</option>
                                                        <option value="F">RM</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Start Date to End Date</label>
                                                <div class="col-md-6">
                                                    <div class="input-group input-daterange">
                                                        <input type="text" class="form-control" name="start_date"  />
                                                        <span class="input-group-addon">to</span>
                                                        <input type="text" class="form-control" name="end_date" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputFirstName" class="col-md-3 control-label">Times to Use</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="times_to_use" />
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
                                                        <option value="Ignore">Ignore</option>
                                                        <option value="Apply Both">Apply Both</option>
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
                                                        <option value="Y">Do not apply the coupon</option>
                                                        <option value="N">Apply the coupon but only to the products specified in the Discounted Items List</option>
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
                                                    <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a>
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
                </div>
            </div>
        </div>
    </div>

    <div class="page-footer">
    	<div class="copyright"><span class="text-15px">2015 © <a href="http://www.webqom.com" target="_blank">Webqom Technologies Sdn Bhd.</a> Any queries, please contact <a href="mailto:support@webqom.com">Webqom Support</a>.</span>
	    	<div class="pull-right"><img src="{{ asset('/public/admin/images/logo_webqom.png') }}" alt="Webqom Technologies Sdn Bhd"></div>
    	</div>
    </div>
</div>

<script <script src="{{ asset('/public/admin/js/jquery-1.9.1.js') }}"></script>
<script <script src="{{ asset('/public/admin/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script <script src="{{ asset('/public/admin/js/jquery-ui.js') }}"></script>
<!--loading bootstrap js-->
<script <script src="{{ asset('/public/admin/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
<script <script src="{{ asset('/public/admin/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js') }}"></script>
<script <script src="{{ asset('/public/admin/js/html5shiv.js') }}"></script>
<script <script src="{{ asset('/public/admin/js/respond.min.js') }}"></script>
<script <script src="{{ asset('/public/admin/vendors/metisMenu/jquery.metisMenu.js') }}"></script>
<script <script src="{{ asset('/public/admin/vendors/slimScroll/jquery.slimscroll.js') }}"></script>
<script <script src="{{ asset('/public/admin/vendors/jquery-cookie/jquery.cookie.js') }}"></script>
<script <script src="{{ asset('/public/admin/js/jquery.menu.js') }}"></script>
<script <script src="{{ asset('/public/admin/vendors/jquery-pace/pace.min.js') }}"></script>

<!--LOADING SCRIPTS FOR PAGE-->
<script src="{{ asset('/public/admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/moment/moment.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-clockface/js/clockface.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
<script src="{{ asset('/public/admin/vendors/jquery-maskedinput/jquery-maskedinput.js') }}"></script>
<script src="{{ asset('/public/admin/js/form-components.js') }}"></script>
<!--LOADING SCRIPTS FOR PAGE-->

<script <script src="{{ asset('/public/admin/vendors/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script <script src="{{ asset('/public/admin/vendors/ckeditor/ckeditor.js') }}"></script>
<script <script src="{{ asset('/public/admin/js/ui-tabs-accordions-navs.js') }}"></script>


<!--CORE JAVASCRIPT-->
<script src="{{ asset('/public/admin/js/main.js') }}"></script>
<script src="{{ asset('/public/admin/js/holder.js') }}"></script>
@endsection
