<div class="one_fourth_less">
    <h4>Status Filter</h4>
    <div class="list-group">
        @if(Request::path() == 'order_history_list')
        <a href="#" class="list-group-item active">All Orders
            <span class="badge badge-dark pull-right">
                {{ $totalOrders }}
            </span>
        </a>
        <a href="#" class="list-group-item caps">Paid
            <span class="badge badge-success pull-right">{{ count($orders->where('status', 'PAID')) }}</span>
        </a>
        <a href="#" class="list-group-item caps">Unpaid
            <span class="badge badge-warning pull-right">{{ count($orders->where('status', 'UNPAID')) }}</span>
        </a>
        @else

        <a href="#" class="list-group-item active">All Domains
            <span class="badge badge-dark pull-right">{{ count($domains) }}
            </span>
        </a>
        <a href="#" class="list-group-item caps">Active
            <span class="badge badge-success pull-right">{{ count($domains->where('status', 'Active')) }}</span>
        </a>
        <a href="#" class="list-group-item caps">Expired
            <span class="badge badge-danger pull-right">{{ count($domains->where('status', 'Expired')) }}</span>
        </a>
        <a href="#" class="list-group-item caps">Pending
            <span class="badge badge-warning pull-right">{{ count($domains->where('status', 'Pending')) }}</span>
        </a>
        @endif
    </div>
    <!--note to programmer: when clicked, filter the table in "my domains" table by status and only showed the filtered data.-->

    <h4>Client Area</h4>
    <ul class="list-group">
        <li class="list-group-item">
            <h5 class="white">Quick Links</h5>
        </li>
        <li class="list-group-item">
            <a href="{{url('/dashboard')}}">
                <i class="fa fa-caret-right"></i> Dashboard</a>
        </li>
        <li class="list-group-item alt">
            <h5>Products/Services</h5>
        </li>
        <li class="list-group-item">
            <a href="services_my_services.html">
                <i class="fa fa-caret-right"></i> My Services Listing</a>
        </li>

        <li class="list-group-item alt">
            <h5>Orders</h5>
        </li>
		<li class="list-group-item">
			<a href="{{ url('order_history_list') }}">
				<i class="fa fa-caret-right"></i> My Order History</a>
		</li>

        <li class="list-group-item alt">
            <h5>Domains</h5>
        </li>
        <li class="list-group-item">
            <a href="domain_my_domains.html">
                <i class="fa fa-caret-right"></i> My Domains</a>
        </li>
        <li class="list-group-item">
            <a href="{{route('frontend.domain.domainRenewal')}}">
                <i class="fa fa-caret-right"></i> Renew Domains</a>
        </li>
        <li class="list-group-item">
            <a href="{{route('frontend.domain.registerNewLogin')}}">
                <i class="fa fa-caret-right"></i> Register a New Domain</a>
        </li>
        <li class="list-group-item">
            <a href="{{route('frontend.domain.transferLogin')}}">
                <i class="fa fa-caret-right"></i> Transfer Domains to Us</a>
        </li>
        <li class="list-group-item">
            <a href="{{route('frontend.domain.searchLogin')}}">
                <i class="fa fa-caret-right"></i> Domain Search</a>
        </li>
        <li class="list-group-item">
            <a href="{{route('frontend.domain.bulkSearchLogin')}}">
                <i class="fa fa-caret-right"></i> Bulk Domain Search</a>
        </li>

        <li class="list-group-item alt">
            <h5>Billing</h5>
        </li>
        <li class="list-group-item">
            <a href="{{ url('billing_my_invoices') }}">
				<i class="fa fa-caret-right"></i> My Invoices</a>                
        </li>
        <li class="list-group-item">
            <a href="billing_my_quotes.html">
                <i class="fa fa-caret-right"></i> My Quotes</a>
        </li>
        <li class="list-group-item">
            <a href="{{ url('billing_mass_payment') }}">
                <i class="fa fa-caret-right"></i> Make Payment / Mass Payment </a>
        </li>
        <li class="list-group-item alt">
            <h5>Support</h5>
        </li>
        <li class="list-group-item">
            <a href="/support_tickets">
                <i class="fa fa-caret-right"></i> My Support Tickets</a>
        </li>
        <li class="list-group-item">
            <a href="/support_tickets/create">
                <i class="fa fa-caret-right"></i> Open New Ticket</a>
        </li>

        <li class="list-group-item alt">
            <h5>My Account</h5>
        </li>
        <li class="list-group-item">
            <a href="{{url('/my_account')}}">
                <i class="fa fa-caret-right"></i> Edit Account Details</a>
        </li>
        <li class="list-group-item">
            <a href="{{url('/my_account?change-password')}}">
                <i class="fa fa-caret-right"></i> Change Password</a>
        </li>

        <li class="list-group-item alt">
            <h5>Business Partner Program</h5>
        </li>
        <li class="list-group-item">
            <a href="business_partner_home.html">
                <i class="fa fa-caret-right"></i> Business Partner Home</a>
        </li>
        <!--note to programmer: business partner program menu is only visible to client who registered as "business partner account".
        Please hide it in the "General account".-->

    </ul>

</div>
<!-- end section -->
