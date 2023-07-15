<div class="one_fourth_less">
	@if(!empty($status_filter) && $status_filter == 'domain')
	<h4>Status Filter</h4>
	<div class="list-group">
		<a href="#" class="list-group-item active">All Domains<span class="badge badge-dark pull-right">4</span></a>
		<a href="#" class="list-group-item caps">Active<span class="badge badge-success pull-right">1</span></a>
		<a href="#" class="list-group-item caps">Expired<span class="badge badge-danger pull-right">1</span></a>
		<a href="#" class="list-group-item caps">Pending<span class="badge badge-warning pull-right">1</span></a>
	</div>
	@elseif(!empty($status_filter) && ($status_filter == 'ticket' || $status_filter == 'ticket_reply'))
	@if( $status_filter == 'ticket_reply')
	<?php
	$dept_arr = array(
				1 => 'Sales Department',
				2 => 'Technical Support',
				3 => 'Billing Department'
			);
			
	$prior_arr = array(
				1 => 'High',
				2 => 'Medium',
				3 => 'Low'
			);
	?>
		<h4>Ticket Information</h4>
		<ul class="list-group">
			<li class="list-group-item"><h5 class="white">Ticket #: {{$ticket->ticket_id}}</h5><span class="label label-success caps">{{$ticket->status}}</span></li>
			<li class="list-group-item"><div class="dark"><b>Subject:</b></div>{{$ticket->subject}}</li>
			<li class="list-group-item alt"><div class="dark"><b>Department:</b></div>{{$dept_arr[$ticket->department]}}</li>
			<li class="list-group-item"><div class="dark"><b>Submitted:</b></div>{{$ticket->created_date}}</li>
			<li class="list-group-item alt"><div class="dark"><b>Last Updated:</b></div>{{$ticket->updated_date}}</li>
			<li class="list-group-item"><div class="dark"><b>Priority:</b></div>{{$prior_arr[$ticket->priority]}}</li>
			@if($ticket->status == 'Closed')
				<li class="list-group-item alt alicent"><a  href="javascript:void(0)" onclick="reply_t()" class="btn-sm btn-success caps"><i class="fa fa-pencil"></i> <b>Reply Ticket</b></a>&nbsp;<a href="javascript:void(0)" class="btn-sm btn-danger caps disabled"><i class="fa fa-times"></i> <b>Close Ticket</b></a></li>
			@else
				<li class="list-group-item alt alicent">
					<a href="javascript:void(0)" onclick="reply_t()" class="btn-sm btn-success caps">
						<i class="fa fa-pencil"></i> 
						<b>Reply Ticket</b></a>
				&nbsp;
					<a href="close_this?id=<?php echo $_GET['id'];?>" class="btn-sm btn-danger caps">
						<i class="fa fa-times"></i>
						<b>Close Ticket</b></a>
				</li>
			@endif
		</ul>
		<script>
			function reply_t(){
				if($('.st-content').is(':visible')){
					$('.st-content').hide()
				}else{
					$('.st-content').show()
				}
				}
		</script>
		<div class="clearfix"></div>
	@endif
	
	<h4>Status Filter</h4>
	<?php
	$all_ticket = $open = $answered = $client_reply = $close = 0;
	foreach($all_tickets as $ticket)
	{
		$all_ticket++;
		if($ticket->status == 'Open')
			$open++;
		if($ticket->status == 'Closed')
			$close++;
		if($ticket->status == 'Answered')
			$answered++;
		if($ticket->status == 'Client-Reply')
			$client_reply++;
	}
	?>
	<div class="list-group">
		<a href="#" class="list-group-item active">All Tickets<span class="badge badge-dark pull-right">{{$all_ticket}}</span></a>
		<a href="#" class="list-group-item caps">Open<span class="badge badge-success pull-right">{{$open}}</span></a>
		<a href="#" class="list-group-item caps">Answered<span class="badge badge-danger pull-right">{{$answered}}</span></a>
		<a href="#" class="list-group-item caps">Client-reply<span class="badge badge-warning pull-right">{{$client_reply}}</span></a>
		<a href="#" class="list-group-item caps">Closed<span class="badge badge-default pull-right">{{$close}}</span></a>
	</div>
	@endif
	
	<h4>Client Area</h4>
	<ul class="list-group">
		<li class="list-group-item"><h5 class="white">Quick Links</h5></li>
		<li class="list-group-item"><a href="{{ route('frontend.client_dashboard') }}"><i class="fa fa-caret-right"></i> Dashboard</a></li>
		<li class="list-group-item alt"><h5>Products/Services</h5></li>
		<li class="list-group-item"><a href="services_my_services.html"><i class="fa fa-caret-right"></i> My Services Listing</a></li>

		<li class="list-group-item alt"><h5>Orders</h5></li>
		<li class="list-group-item"><a href="order_history_list.html"><i class="fa fa-caret-right"></i> My Order History</a></li>

		<li class="list-group-item alt"><h5>Domains</h5></li>
		<li class="list-group-item"><a href="domain_my_domains.html"><i class="fa fa-caret-right"></i> My Domains</a></li>
		<li class="list-group-item"><a href="{{ route('frontend.domain.domainRenewal') }}"><i class="fa fa-caret-right"></i> Renew Domains</a></li>
		<li class="list-group-item"><a href="{{ route('frontend.domain.registerNewLogin') }}"><i class="fa fa-caret-right"></i> Register a New Domain</a></li>
		<li class="list-group-item"><a href="{{ route('frontend.domain.transferLogin') }}"><i class="fa fa-caret-right"></i> Transfer Domains to Us</a></li>
		<li class="list-group-item"><a href="{{ route('frontend.domain.searchLogin') }}"><i class="fa fa-caret-right"></i> Domain Search</a></li>

		<li class="list-group-item alt"><h5>Billing</h5></li>
		<li class="list-group-item"><a href="billing_my_invoices.html"><i class="fa fa-caret-right"></i> My Invoices</a></li>
		<li class="list-group-item"><a href="billing_my_quotes.html"><i class="fa fa-caret-right"></i> My Quotes</a></li>
		<li class="list-group-item"><a href="billing_mass_payment.html"><i class="fa fa-caret-right"></i> Make Payment / Mass Payment</a></li>
		<li class="list-group-item alt"><h5>Support</h5></li>
		<li class="list-group-item"><a href="/support_tickets"><i class="fa fa-caret-right"></i> My Support Tickets</a></li>
		<li class="list-group-item"><a href="/support_tickets/create"><i class="fa fa-caret-right"></i> Open New Ticket</a></li>

		<li class="list-group-item alt"><h5>My Account</h5></li>
		<li class="list-group-item"><a href="{{ route('frontend.client_update_information') }}"><i class="fa fa-caret-right"></i> Edit Account Details</a></li>
		<li class="list-group-item"><a href="{{ route('frontend.client_update_information') }}#change-password"><i class="fa fa-caret-right"></i> Change Password</a></li>

	</ul>

</div><!-- end section -->

