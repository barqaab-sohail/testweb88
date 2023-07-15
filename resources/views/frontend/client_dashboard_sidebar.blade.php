<div class="one_fourth_less">
            <h4>Account Details</h4>


            <ul class="list-group">
                <li class="list-group-item"><h5 class="white">Client ID: {{$user->client->client_id}}</h5></li>
                <li class="list-group-item"><div class="dark"><b>Name:</b></div>{{$user->client->first_name." ".$user->client->last_name}}</li>
                <li class="list-group-item alt"><div class="dark"><b>Email:</b></div>{{$user->email}}</li>
                <li class="list-group-item"><div class="dark"><b>Company:</b></div>{{$user->client->company}}</li>
                <li class="list-group-item alt"><div class="dark"><b>Address:</b></div> {{$user->client->address1}}, <br/>{{$user->client->address2}},<br/>{{$user->client->postal_code or ''}},<br/>{{$user->client->city->name or ''}},<br/>{{$user->client->state->name}},<br/>{{$user->client->country->name}}</li>
                <li class="list-group-item alicent"><a href="{{url('/my_account')}}" class="btn-sm btn-danger caps"><i class="fa fa-pencil"></i> <b>Update</b></a></li>
             </ul>


			 <h4>Client Area</h4>
             <ul class="list-group">
            	<li class="list-group-item"><h5 class="white">Quick Links</h5></li>
                <li class="list-group-item"><a href="{{url('/dashboard')}}"><i class="fa fa-caret-right"></i> Dashboard</a></li>
                <li class="list-group-item alt"><h5>Products/Services</h5></li>
                <li class="list-group-item"><a href="services_my_services.html"><i class="fa fa-caret-right"></i> My Services Listing</a></li>

                <li class="list-group-item alt"><h5>Orders</h5></li>
                <li class="list-group-item"><a href="{{url('/order_history_list')}}"><i class="fa fa-caret-right"></i> My Order History</a></li>

                <li class="list-group-item alt"><h5>Domains</h5></li>
                <li class="list-group-item"><a href="domain_my_domains.html"><i class="fa fa-caret-right"></i> My Domains</a></li>
                <li class="list-group-item"><a href="{{route('frontend.domain.domainRenewal')}}"><i class="fa fa-caret-right"></i> Renew Domains</a></li>
                <li class="list-group-item"><a href="{{route('frontend.domain.registerNewLogin')}}"><i class="fa fa-caret-right"></i> Register a New Domain</a></li>
                <li class="list-group-item"><a href="{{route('frontend.domain.transferLogin')}}"><i class="fa fa-caret-right"></i> Transfer Domains to Us</a></li>
                <li class="list-group-item"><a href="{{route('frontend.domain.searchLogin')}}"><i class="fa fa-caret-right"></i> Domain Search</a></li>
                <li class="list-group-item"><a href="{{route('frontend.domain.bulkSearchLogin')}}"><i class="fa fa-caret-right"></i> Bulk Domain Search</a></li>

                <li class="list-group-item alt"><h5>Billing</h5></li>
                <li class="list-group-item"><a href="billing_my_invoices.html"><i class="fa fa-caret-right"></i> My Invoices</a></li>
                <li class="list-group-item"><a href="billing_my_quotes.html"><i class="fa fa-caret-right"></i> My Quotes</a></li>
                <li class="list-group-item"><a href="billing_mass_payment.html"><i class="fa fa-caret-right"></i> Make Payment / Mass Payment</a></li>
                <li class="list-group-item alt"><h5>Support</h5></li>
                <li class="list-group-item"><a href="/support_tickets"><i class="fa fa-caret-right"></i> My Support Tickets</a></li>
                <li class="list-group-item"><a href="/support_tickets/create"><i class="fa fa-caret-right"></i> Open New Ticket</a></li>

                <li class="list-group-item alt"><h5>My Account</h5></li>
                <li class="list-group-item"><a href="{{url('/my_account')}}"><i class="fa fa-caret-right"></i> Edit Account Details</a></li>
                <li class="list-group-item"><a href="{{url('/my_account?change-password')}}"><i class="fa fa-caret-right"></i> Change Password</a></li>

             </ul>

        </div>
