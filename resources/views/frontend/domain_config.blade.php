@extends('layouts.frontend_layout')
@section('title','Admin | Domain Configuration')
@section('content')
@section('page_header','Services')
<?php
if (isset($info)) {
	$info_set = true;
} else {
	$info_set = false;
}
if (isset($response->price_list->pricing) && !empty($response->price_list->pricing)) {
	$pricing_list = json_decode($response->price_list->pricing);
	$id = json_decode($response->price_list->id);
} else {
	$id = 0;
}

use App\Http\Controllers\Frontend\IndexController;

$categories = IndexController::get_hosting_categories();
?>
<div class="page_title1 sty9">
	<div class="container">
		<h1>Domains</h1>
		<div class="pagenation">
			&nbsp;<a href="{{url('/')}}">Home</a> <i>/</i> <a href="{{url('/dashboard')}}">Dashboard</a> <i>/</i> <a href="{{url('/my_account')}}">My Domains</a>
			@if(isset($name) && $name == 'Register A New Domain')
			<i>/</i><a href="{{route('frontend.domain.registerNewLogin')}}">{{ $name }}</a>
			@elseif(isset($name) && $name == 'Domain Search')
			<i>/</i><a href="{{route('frontend.domain.searchLogin')}}">{{ $name }}</a>
			@elseif(isset($name) && $name == 'Domain Transfer')
			<i>/</i><a href="{{route('frontend.domain.transferLogin')}}">{{ $name }}</a>
			@elseif(isset($name) && $name == 'Bulk Domain Search')
			<i>/</i><a href="{{route('frontend.domain.bulkSearchLogin')}}"> {{ $name }}</a>
			@else
			@endif
			<i>/</i> Domain Configuration
		</div>
	</div>
</div><!-- end page title -->


<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>

<div class="one_full stcode_title9">
	<h1 class="caps">
		<strong>Domain Configuration</strong>
	</h1>
</div>
<div class="clearfix"></div>

<div class="content_fullwidth">
	<div class="container">
		@if(Auth::check())
		@include('layouts.frontend_menu_login')
		@else
		<div class="one_fourth_less">
			<h4>Status Filter</h4>
			<div class="list-group">
				<a href="#" class="list-group-item active">All Domains<span class="badge badge-dark pull-right">0</span></a>
				<a href="#" class="list-group-item caps">Active<span class="badge badge-success pull-right">0</span></a>
				<a href="#" class="list-group-item caps">Expired<span class="badge badge-danger pull-right">0</span></a>
				<a href="#" class="list-group-item caps">Pending<span class="badge badge-warning pull-right">0</span></a>
			</div>
			<!--note to programmer: when clicked, filter the table in "my domains" table by status and only showed the filtered data.-->
		</div>
		@endif
		{{-- <div class="one_fourth_less">
            <h4>Status Filter</h4>
            <div class="list-group">
                <a href="#" class="list-group-item active">All Domains<span class="badge badge-dark pull-right">4</span></a>
                <a href="#" class="list-group-item caps">Active<span class="badge badge-success pull-right">1</span></a>
                <a href="#" class="list-group-item caps">Expired<span class="badge badge-danger pull-right">1</span></a>
                <a href="#" class="list-group-item caps">Pending<span class="badge badge-warning pull-right">1</span></a>
            </div>
            <!--note to programmer: when clicked, filter the table in "my domains" table by status and only showed the filtered data.-->

            <h4>Client Area</h4>
            <ul class="list-group">
                <li class="list-group-item"><h5 class="white">Quick Links</h5></li>
                <li class="list-group-item"><a href="{{ url('/dashboard') }}"><i class="fa fa-caret-right"></i> Dashboard</a></li>
		<li class="list-group-item alt">
			<h5>Products/Services</h5>
		</li>
		<li class="list-group-item"><a href="services_my_services.html"><i class="fa fa-caret-right"></i> My Services Listing</a></li>

		<li class="list-group-item alt">
			<h5>Orders</h5>
		</li>
		<li class="list-group-item"><a href="order_history_list.html"><i class="fa fa-caret-right"></i> My Order History</a></li>

		<li class="list-group-item alt">
			<h5>Domains</h5>
		</li>
		<li class="list-group-item"><a href="domain_my_domains.html"><i class="fa fa-caret-right"></i> My Domains</a></li>
		<li class="list-group-item"><a href="domain_domain_renewal.html"><i class="fa fa-caret-right"></i> Renew Domains</a></li>
		<li class="list-group-item"><a href="domain_register_new_login.html"><i class="fa fa-caret-right"></i> Register a New Domain</a></li>
		<li class="list-group-item"><a href="domain_transfer_login.html"><i class="fa fa-caret-right"></i> Transfer Domains to Us</a></li>
		<li class="list-group-item"><a href="{{ route('frontend.domain.searchLogin') }}"><i class="fa fa-caret-right"></i> Domain Search</a></li>
		<li class="list-group-item"><a href="{{ route('frontend.domain.bulkSearchLogin') }}"><i class="fa fa-caret-right"></i> Bulk Domain Search</a></li>

		<li class="list-group-item alt">
			<h5>Billing</h5>
		</li>
		<li class="list-group-item"><a href="billing_my_invoices.html"><i class="fa fa-caret-right"></i> My Invoices</a></li>
		<li class="list-group-item"><a href="billing_my_quotes.html"><i class="fa fa-caret-right"></i> My Quotes</a></li>
		<li class="list-group-item"><a href="billing_mass_payment.html"><i class="fa fa-caret-right"></i> Make Payment / Mass Payment</a></li>
		<li class="list-group-item alt">
			<h5>Support</h5>
		</li>
		<li class="list-group-item"><a href="support_my_support_tickets.html"><i class="fa fa-caret-right"></i> My Support Tickets</a></li>
		<li class="list-group-item"><a href="support_open_new_ticket.html"><i class="fa fa-caret-right"></i> Open New Ticket</a></li>

		<li class="list-group-item alt">
			<h5>My Account</h5>
		</li>
		<li class="list-group-item"><a href="{{ url('/my_account') }}"><i class="fa fa-caret-right"></i> Edit Account Details</a></li>
		<li class="list-group-item"><a href="{{ url('/my_account?change-password')  }}"><i class="fa fa-caret-right"></i> Change Password</a></li>


		</ul>

	</div><!-- end section --> --}}

	<div class="three_fourth_less last">
		<div class="text-18px dark light">
			Please review your domain name selections and any addons that are available for them.
		</div>
		<div class="clearfix margin_bottom1"></div>

		{{ Form::open(['url' => url('/checkout/add')]) }}
		@if(!empty($purchase_data['domains']))

		<?php $key = 1; ?>
		@foreach($purchase_data['domains'] as $domain)

		{{
								Form::hidden(
									'domain-name[]',
									$domain
								)
							}}
		{{
								Form::hidden(
									'domain-price-cycle['. $domain .']',
									$purchase_data['price_cycle'][$domain],
									[
										'id' => 'domain_price_id'
									]
								)
							}}
		{{
								Form::hidden(
									'type['. $domain .']',
									$purchase_data['type'][$domain]
								)
							}}
		<div class="stcode_title12">
			<h4 class="sitecolor">
				<span class="line"></span>
				<span class="text">
					{{ $domain }}
				</span>
			</h4>
		</div>

		<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Registration Period</th>
						<th>Hosting</th>
						<th>Domain Addons</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ $purchase_data['plan'][$domain]['duration'] }} year(s)</td>
						<td>

							<button type="button" data-domain="{{ $domain }}" data-id="{{ $key }}" id="select_hosting" class="select_hosting btn btn-sm btn-danger">
								<b>ADD HOSTING</b>
							</button>
							<div id="text">
								<span class="plan_name_{{ $domain }}"></span>
							</div>

							<ul role="menu" class="dropdown-menu alileft">
								@if(!empty($categories))
								@foreach($categories as $i)
								@if($i->title=='Home')
								@else
								@if(count($i->childs)>0)
								@foreach($i->childs as $child)

								@foreach($child as $j)
								<li>
									<a href="{{url('/services/'.$j->slug)}}"><i class="<?php echo isset($j->icon) ? $j->icon : 'fa fa-cloud' ?>"></i> <strong>{{$j->title}}</strong> {{$j->description}}</a>
								</li>
								@endforeach
								@endforeach
								@endif
								@endif
								@endforeach
								@endif
							</ul>
						</td>
						<td>
							@foreach($domain_pricings as $dprice)
							{{
														Form::checkbox(
															'domain-addon['. $domain .'][]',
															$dprice->id
														)
													}}
							{{ $dprice->title }} (RM {{ $dprice->price }})

							<div class="clearfix"></div>
							@endforeach
							<input type="hidden" name="plan_id[{{ $domain }}]" id="plan_id">
							@if($name == 'Domain Transfer')
							<?php  ?>
							<input type="hidden" name="type[{{ $domain }}]" value="2" id="transfer_text">
							@endif
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3"></td>
					</tr>
				</tfoot>
			</table>
			<div class="clearfix"></div>
		</div>
		<!-- end table responsive -->
		@endforeach
		@endif
		<a href="#" data-target="#notification" data-toggle="modal">
			<!--note to programmer: pop up notification example of not choosing any hosting plan, remove this text once is done.-->
		</a>

		<div class="clearfix"></div>
		<div class="divider_line7"></div>
		<div class="clearfix"></div>

		<div class="text-18px dark light">
			By default, new domains will use our nameservers for hosting on our network. If you want to use custom nameservers then enter them below.
		</div>
		<div class="clearfix margin_bottom1"></div>

		<h4>Nameservers</h4>

		<div class="cforms alileft">
			<div id="form_status"></div>
			<div id="gsr-contact">
				<div class="one_third">
					<label>
						<b>Nameserver1</b>
					</label>
					<input type="text" name="nameserver1" id="nameserver1" value="ns1.webqomhosting1.com" />
				</div>

				<div class="one_third">
					<label>
						<b>Nameserver2</b>
					</label>
					<input type="text" name="nameserver2" id="nameserver2" value="ns2.webqomhosting1.com" />
				</div>

				<div class="one_third last">
					<label>
						<b>Nameserver3</b>
					</label>
					<input type="text" name="nameserver3" id="nameserver3" />
				</div>

				<div class="one_third">
					<label>
						<b>Nameserver4</b>
					</label>
					<input type="text" name="nameserver4" id="nameserver4" />
				</div>

				<div class="one_third">
					<label>
						<b>Nameserver5</b>
					</label>
					<input type="text" name="nameserver5" id="nameserver5" />
				</div>
			</div>
			<!-- <form type="POST" id="gsr-contact" onSubmit="return valid_datas( this );">

						</form> -->
		</div>
		<!-- end cforms-->

		<div class="clearfix"></div>
		<div class="divider_line7"></div>
		<div class="clearfix"></div>
		<div class="alicent">
			<!-- <a href="{{url('').'/shopping_cart/'.$id.''}}" class="btn btn-danger caps"><i class="fa fa-arrow-circle-right"></i> <b>Continue</b></a>&nbsp; -->
			<!-- <a href="{{ url('') . '/shopping_cart?info=' . $info_set . '&page=' . Request::segment(1) }}" class="btn btn-danger caps add_to_cart">
							<i class="fa fa-arrow-circle-right"></i> <b>Continue</b>
						</a>&nbsp; -->
			{{
							Form::button(
								'<i class="fa fa-arrow-circle-right"></i> <b>Continue</b>',
								[
									'type'  => 'submit',
									'class' => 'btn btn-danger caps add_to_cart'
								]
							)
						}}
		</div>
		{{ Form::close() }}
		<!--Modal notification start-->
		<div id="notification" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<!--<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>-->
						<h4 id="modal-login-label3" class="modal-title"><i class="fa fa-exclamation-triangle"></i> You have not chosen any hosting plan yet</h4>
					</div>
					<div class="modal-body">
						<div data-dismiss="modal" aria-hidden="true" class="plainmodal-close"></div>
						<!-- <form class="add_hosting"> -->
						<div class="cforms alileft">
							<p>
								You have not chosen any hosting plan yet. Are you sure you wish to continue?
							</p>
							<select class="form-control hosting_name" name="hosting_name">
								<option>Select Hosting</option>
								@if(!empty($categories))
								@foreach($categories as $i)
								@if($i->title=='Home')
								@else
								@if(count($i->childs)>0)
								@foreach($i->childs as $child)

								@foreach($child as $j)
								<option value="{{ $j->id}}"><i class="<?php echo isset($j->icon) ? $j->icon : 'fa fa-cloud' ?>"></i> <strong>{{$j->title}}</strong> {{$j->description}}</option>

								@endforeach
								@endforeach
								@endif
								@endif
								@endforeach
								@endif
							</select>
							<select class="form-control plan_info" name="plan_info">
								<option>Select Plan</option>
							</select>
							<input type="hidden" name="domain_name" id="domain_name">
						</div><!-- end cforms -->

						<div class="clearfix margin_bottom1"></div>
						<div class="divider_line2"></div>
						<div class="clearfix margin_bottom1"></div>
						<div class="clearfix"></div>

						<div class="alicent">
							<button class="btn btn-danger caps hosting_btn" id="add_hosting">
								<i class="fa fa-plus"></i> <b>Add Hosting</b>
							</button>&nbsp;
							<a href="#" data-dismiss="modal" class="btn btn-primary caps">
								<i class="fa fa-ban"></i> <b>No, thank you</b>
							</a>&nbsp;
						</div>

						<div class="clearfix margin_bottom1"></div>
						<!-- </form> -->
					</div><!-- end modal-body -->
				</div>
			</div>
		</div><!--END MODAL notification -->
	</div><!-- end section -->
</div>
</div><!-- end content fullwidth -->


<div class="clearfix"></div>
<div class="container feature_section107">
	<br />
	<h1 class="caps light">
		Learn more about <b>Web88 CMS System</b> <a href="web88.html">Go!</a>
	</h1>
</div>

@endsection

@section('custom_scripts')
<script type="text/javascript">
	// $(document).on("click",".add_to_cart",function(e) {
	// e.preventDefault();
	//
	// var href = $(this).attr('href');
	// var domain = $('.sitecolor .text').text();
	// //$(this).closest('tr').find('td:eq(1)').text();
	// var qty = 1;
	//
	// //get cycle
	// var cycle = $('table tbody tr td:first').text();
	// //$(this).closest('tr').find('td:eq(3) select option:selected').val();
	// cycle = $.trim(cycle);
	// cycle = cycle.split(' ');
	// cycle = cycle[0];
	// //get cycle - end
	//
	// var price = $("#domain_price_id").val();
	//
	// //get addons
	// var addons = [];
	// $.each($("input[name='domain_price']:checked"), function(){
	//     addons.push($(this).val());
	// });
	// //get addons - end
	//
	// if(domain == ''){
	//     window.location = href;
	// }
	//
	// $.ajax({
	//      type:'POST',
	//      url:'/add_to_cart',
	//      data: {domain: domain, qty: qty, price: price, cycle: cycle, addons: addons },
	//      success:function(data) {
	//         if(data.success == true){
	//             toastr.success(data.errors.message, 'Success');
	//             $('#cart_item_id').text(parseInt($('#cart_item_id').text())+1);
	//             window.location = href;
	//         }else{
	//             toastr.success(data.errors.message, 'Error');
	//         }
	//
	//       //$('.load_spin').hide();
	//       /*$('.sugg_title').show();
	//       $("#title").val(data.title);*/
	//      // toastr.success('Product added to cart', 'Success');
	//      }
	//   });
	// });
	$('.select_hosting').on('click', function(e) {
		var name = $(this).data('domain');
		var id = $(this).data('id');
		// alert('Client');
		$('#domain_name').val(name);
		$('.hosting_btn').attr('data-hname', name);
		$("#notification").modal('show');
	})
	$('.hosting_btn').on('click', function(e) {
		var plan_id = $('.plan_info').val();
		var name = $(this).attr('data-hname');
		// alert(name);return false;
		// console.log($("input[name='plan_id["+name+"]']").val(plan_id));
		if (plan_id) {
			$("input[name='plan_id[" + name + "]']").val(plan_id);
			// $(this).text('added');
			$('#notification').modal('hide');

		} else {
			alert('Please Select a plan');
			return false;
		}
	})
	$('.hosting_name').on('change', function(e) {
		e.preventDefault();
		var cat_id = e.target.value;
		$.ajax({
			url: '{{ url("/fetchcategoryProducts") }}',
			type: 'POST',
			dataType: 'json',
			data: '_token=<?php echo csrf_token() ?>&category_id=' + cat_id,
			beforeSend: function() {

			},
			complete: function() {

			},
			success: function(response) {
				var html = '';
				var categoryplan = $('.plan_info');
				console.log(response);
				categoryplan.empty().prepend('<option value="-1">- Please select -</option>');
				if (response['products']) {
					for (var i = 0; i < response['products'].length; i++) {
						elm = response['products'][i];
						var option = $('<option></option>').attr('value', elm.id)
							.text(elm.plan_name + ' - ' + elm.service_code + '(' + elm.price + '/Yr)');
						categoryplan.append(option);
					}

				}
			}
		});
	})
</script>
@endsection