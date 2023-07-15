<?php $currentURL = url()->current();
$baseURL= url('/');
$basePath=str_replace($baseURL, '', $currentURL);
//$total_price = 0;
?>
@extends('layouts.frontend_layout')
@section('title','Admin | Domain Configuration')
@section('content')
@section('page_header','Services')

<div class="clearfix"></div>

<div class="clearfix">
  <div class="page_title1 sty9">
    <div class="container">
       <h1>Client Area</h1>
    <div class="pagenation">&nbsp;<a href="index.html">Home</a> <i>/</i> Dashboard</div>
    </div>
    
  </div>
</div>


<div class="clearfix"></div>


 <div class="one_full stcode_title9" style="margin-top: 4%;">
    	<h1 class="caps"><strong>Dashboard</strong>    	</h1>
    </div>

<div class="clearfix"></div>


<div class="content_fullwidth">

    <div class="container">
    	
        <div class="one_fourth_less">
            <h4>Account Details</h4>
            <ul class="list-group">
            	<li class="list-group-item"><h5 class="white">Client ID: I-000001-MY or B-000001-MY</h5></li>
                <li class="list-group-item"><div class="dark"><b>Name:</b></div>{{ucfirst(Auth::user()->name)}}</li>
                <li class="list-group-item alt"><div class="dark"><b>Email:</b></div>{{Auth::user()->email}}</li>
                <li class="list-group-item"><div class="dark"><b>Company:</b></div>Webqom Technologies Sdn Bhd</li>
                <li class="list-group-item alt"><div class="dark"><b>Address:</b></div> B-2-2-2, Solaris Dutamas, <br/> No. 1, Jalan Dutamas 1, <br/>50480 Kuala Lumpur,<br/> Wilayah Persekutuan, <br/>Malaysia</li>
                <li class="list-group-item alicent"><a href="account_edit.html" class="btn-sm btn-danger caps"><i class="fa fa-pencil"></i> <b>Update</b></a></li>
             </ul>
             
			 <h4>Client Area</h4>
             <ul class="list-group">
            	<li class="list-group-item"><h5 class="white">Quick Links</h5></li>
                <li class="list-group-item"><a href="client_area_home.html"><i class="fa fa-caret-right"></i> Dashboard</a></li>
                <li class="list-group-item alt"><h5>Products/Services</h5></li>
                <li class="list-group-item"><a href="services_my_services.html"><i class="fa fa-caret-right"></i> My Services Listing</a></li>
                
                <li class="list-group-item alt"><h5>Orders</h5></li>
                <li class="list-group-item"><a href="{{url('/order_history_list')}}"><i class="fa fa-caret-right"></i> My Order History</a></li>
                
                <li class="list-group-item alt"><h5>Domains</h5></li>
                <li class="list-group-item"><a href="domain_my_domains.html"><i class="fa fa-caret-right"></i> My Domains</a></li>
                <li class="list-group-item"><a href="domain_domain_renewal.html"><i class="fa fa-caret-right"></i> Renew Domains</a></li>
                <li class="list-group-item"><a href="domain_register_new_login.html"><i class="fa fa-caret-right"></i> Register a New Domain</a></li>
                <li class="list-group-item"><a href="domain_transfer_login.html"><i class="fa fa-caret-right"></i> Transfer Domains to Us</a></li>
                <li class="list-group-item"><a href="domain_search_login.html"><i class="fa fa-caret-right"></i> Domain Search</a></li>
                
                <li class="list-group-item alt"><h5>Billing</h5></li>
                <li class="list-group-item"><a href="billing_my_invoices.html"><i class="fa fa-caret-right"></i> My Invoices</a></li>
                <li class="list-group-item"><a href="billing_my_quotes.html"><i class="fa fa-caret-right"></i> My Quotes</a></li>
                <li class="list-group-item"><a href="billing_mass_payment.html"><i class="fa fa-caret-right"></i> Make Payment / Mass Payment</a></li>
                <li class="list-group-item alt"><h5>Support</h5></li>
                <li class="list-group-item"><a href="support_my_support_tickets.html"><i class="fa fa-caret-right"></i> My Support Tickets</a></li>
                <li class="list-group-item"><a href="support_open_new_ticket.html"><i class="fa fa-caret-right"></i> Open New Ticket</a></li>
                
                <li class="list-group-item alt"><h5>My Account</h5></li>
                <li class="list-group-item"><a href="account_edit.html"><i class="fa fa-caret-right"></i> Edit Account Details</a></li>
                <li class="list-group-item"><a href="account_edit.html#tab-2"><i class="fa fa-caret-right"></i> Change Password</a></li>
                
             </ul>

        </div><!-- end section -->
        
    	<div class="three_fourth_less last">
        
          <div class="text-18px dark light">Welcome Back, {{ucfirst(Auth::user()->name)}}</div>
          <div class="clearfix margin_bottom1"></div>
          <div class="one_half_less"> 
              <div class="alertymes4">
                    <h3 class="light"><i class="fa fa-warning"></i><strong>You have 2 Overdue Invoice(s). Overdue Total: RM 220.00</strong>
                    <br/>Please pay your outstanding invoices as soon as possible.</h3>
                    <div class="clearfix margin_bottom1"></div>
                    <a href="billing_mass_payment.html" class="btn btn-danger caps"><i class="fa fa-hand-o-up"></i><b>Pay All</b></a>
               </div><!-- end section -->
           </div><!-- end one half less -->
           
           <div class="one_half_less last"> 
              <div class="alertymes6">
                    <h3 class="light"><i class="fa fa-warning"></i><strong>You have 3 domain(s) expiring within the next 30 days.</strong>
                    <br/>Renew and secure them today for peace of mind.</h3>
                    <div class="clearfix margin_bottom1"></div>
                    <a href="domain_domain_renewal.html" class="btn btn-warning caps"><i class="fa fa-refresh"></i><b>Renew Now</b></a>
               </div><!-- end section -->
           </div><!-- end one half less -->
           <div class="clearfix margin_bottom3"></div>
           
           <h4>Overdue Invoices</h4>
           <div class="table-responsive">
        	
                      <table class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th><span class="pull-left">Invoice #</span></th>
                            <th><span class="pull-left">Invoice Date</span></th>
                            <th><span class="pull-left">Due Date</span></th>
                            <th><span class="pull-left">Total</span></th>
                            <th><span class="pull-left">Status</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>MY-8001182</td>
                            <td>16th Feb 2015</td>
                            <td>16th Apr 2015</td>
                            <td>RM 110.00</td>
                            <td><a href="invoice_detail_unpaid.html"><span class="label label-danger caps">Unpaid</span></a></td>
                          </tr>
                          <tr>
                            <td>MY-8001182</td>
                            <td>16th Feb 2015</td>
                            <td>16th Apr 2015</td>
                            <td>RM 110.00</td>
                            <td><a href="invoice_detail_unpaid.html"><span class="label label-danger caps">Unpaid</span></a></td>
                          </tr>
                          <tr>
                          	<td colspan="3" class="aliright"><h5><b>TOTAL DUE</b></h5></td>
                            <td class="aliright"><h5><b>RM 220.00</b></h5></td>
                            <td></td>
                          </tr>
                           
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="5"></td>
                          </tr>
                        </tfoot>
                      </table>
                      <!--note to programmer: the "total due" will be varied when user selects # of items to pay in the table. When clicks "unpaid" under Status, it will link to the unpaid invoice.-->
                      <div class="clearfix"></div>
                         
         	</div><!-- end table responsive -->
            
            <div class="alicent">
                <a href="billing_mass_payment.html" class="btn btn-danger caps"><i class="fa fa-mouse-pointer"></i> <b>Make Payment</b></a>&nbsp;
            </div>
       		           
           <div class="clearfix"></div>
           <div class="divider_line7"></div>
           
           <h4>Recent Order History</h4>
           <div class="table-responsive">
        	
                      <table class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th><span class="pull-left">#</span></th>      
                            <th><span class="pull-left">Invoice #</span></th>
                            <th><span class="pull-left">Receipt #</span></th>
                      		<th><span class="pull-left">Order Date</span></th>                            
                            <th><span class="pull-left">Total</span></th>                  
                            <th><span class="pull-left">Payment</span></th> 
                            <th><span class="pull-left">Status</span></th>
                          </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                          @foreach($orders as  $key => $value)
                          <tr>
                            <td>{{$i++}}</td>
                            <td>MY-{{$value->transaction_id}}</td>
                            <td>{{$value->id}}</td>
                            <td>{{$value->created_at}}</td> 
                            <td>RM {{$value->total_amount}}</td>    
                            <td>PayPal</td> 
                            <td><a href="order_details.html">
                            @if($value->status == 'COMPLETED')
                            <span class="label label-success caps">Paid</span>
                            @else
                            <span class="label label-danger caps">Payment Failed</span>
                            @endif
                            </a></td>
                          </tr>
                          @endforeach
                          <!-- <tr>
                            <td>2</td>
                            <td>MY-8001182</td>
                            <td>-</td>
                            <td>16th Apr 2015</td> 
                            <td>RM 26,406.54</td>    
                            <td>PayPal</td> 
                            <td><a href="order_details.html"><span class="label label-danger caps">Payment Failed</span></a></td>                          </tr> -->
                          
                          
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="7"></td>
                          </tr>
                        </tfoot>
                      </table>
                      <div class="clearfix"></div> 
                                         

        	</div><!-- end table responsive -->
            <div class="alicent">
                <a href="{{url('/order_history_list')}}" class="btn btn-danger caps"><i class="fa fa-search"></i> <b>View All</b></a>&nbsp;
            </div>
            
           <div class="clearfix"></div>
           <div class="divider_line7"></div>
           
           
           <h4>My Services Listing</h4>
           <div class="table-responsive">
        	
                      <table class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th width="30%"><span class="pull-left">Product/Services</span></th>
                      		<th><span class="pull-left">Cycle</span></th>                  
                            <th><span class="pull-left">Price</span></th>                            
                            <th><span class="pull-left">Paid Date</span></th> 
                            <th><span class="pull-left">Next Due Date</span></th> 
                            <th><span class="pull-left">Status</span></th>
                          </tr>
                        </thead>
                        <tbody>
                       
                          @foreach($order_items as  $key => $value)
                          <tr>
                            <td>
                            <b>Domain:</b> <span class="sitecolor">{{$value->services}}</span><br/>

                                        <?php if($value->addons != "" && $value->addons != null){
                                            $addons_vl = explode(',', $value->addons); ?>
                                            

                                        <b>Domain Addons:</b>
                                        <ul>
                                            
                                        
                                        @foreach($addons_vl as $addon)
                                        @foreach($domain_pricings as $dprice)
                                        <?php 
                                        if($addon == $dprice->id){ 
                                            $row_price += $dprice->price;
                                        ?>
                                        <li><i class="fa icon-arrow-right"></i>{{$dprice->title}} (RM {{$dprice->price}})</li>
                                       <?php }
                                        ?>
                                          
                                        @endforeach
                                        @endforeach
                                        </ul>

                                        <?php } ?>
                            <!-- <b>Service Code: </b> <span class="sitecolor">SHSM-1</span><br/>
                            	<b>Shared Hosting Plan:</b> <span class="sitecolor caps">Small</span><br/>
                              	<b>Domain:</b> <span class="sitecolor">webqom.com</span></span> -->
                            </td>
                            <td>{{$value->cycle}} <?php if($value->cycle == 1) echo "year"; else echo "years"; ?></td>
                            <td>RM {{$value->order->total_amount}}</td> 
                            <td>{{$value->created_at}}</td>
                            <td><!-- 16th Apr 2016 --></td> 
                            <td><a href="services_manage_service.html"><span class="label label-danger caps">Expired</span></a></td>
                          </tr>
                          @endforeach
                          <!-- <tr>
                            <td><b>Cloud Hosting Plan:</b> <span class="sitecolor caps">S Server</span><br/>
                                <b>Domain:</b> <span class="sitecolor">webqom.net</span><br/>
                                <b>Plan Specification:</b>
                                <ul>
                                   <li><i class="fa icon-arrow-right"></i> RAM: 1GB</li>
                                   <li><i class="fa icon-arrow-right"></i> Processor: 1 vCPU</li>
                                   <li><i class="fa icon-arrow-right"></i> Fast Disk: 40GB</li>
                                   <li><i class="fa icon-arrow-right"></i> Transfer: 3TB</li>
                                </ul>  
                            </td>
                            <td>1 year(s)</td>
                            <td>RM 480.00</td>
                            <td>16th Apr 2015</td> 
                            <td>16th Apr 2016</td>
                            <td><a href="services_manage_service.html"><span class="label label-warning caps">Suspended</span></a></td>
                          </tr>
                          <tr>
                            <td><b>Service Code: </b> <span class="sitecolor">VPS28-1-1</span><br/>
                            	<b>VPS Hosting Plan:</b> <span class="sitecolor caps">Linux Basic</span><br/>
                                <b>Domain:</b> <span class="sitecolor">webqom.info</span><br/>
                                <b>Plan Specification:</b>
                                        <ul>
                                            <li><i class="fa icon-arrow-right"></i> RAM: 1GB</li>
                                            <li><i class="fa icon-arrow-right"></i> Processor: 1 vCPU</li>
                                            <li><i class="fa icon-arrow-right"></i> Disk Space: 28GB</li>
                                            <li><i class="fa icon-arrow-right"></i> Bandwidth: 1Mbps</li>
                                        </ul>  
                            </td>
                            <td>1 year(s)</td>
                            <td>RM 831.60</td>
                            <td>16th Apr 2015</td> 
                            <td>16th Apr 2016</td>
                            <td><a href="services_manage_service.html"><span class="label label-warning caps">Suspended</span></a></td>
                          </tr>
                          <tr>
                            <td><b>Service Code: </b> <span class="sitecolor">CO2U-1</span><br/>
                            	<b>Co-location Hosting Plan:</b> <span class="sitecolor caps">2U</span><br/>
                                <b>Domain:</b> <span class="sitecolor">webqom.limited</span><br/>
                                <b>Server Configuration:</b>
                                        <ul>
                                            <li><i class="fa icon-arrow-right"></i> Rack Space: Quarter Rack</li>
                                            <li><i class="fa icon-arrow-right"></i> Bandwidth: 10Mbps</li>
                                            <li><i class="fa icon-arrow-right"></i> Power Port: 1 Port</li>
                                            <li><i class="fa icon-arrow-right"></i> Wan Port: 1 Port</li>
                                            <li><i class="fa icon-arrow-right"></i> No. of IP Addresses: 1</li>
                                        </ul>  
                            </td>
                            <td>1 year(s)</td>
                            <td>RM 4,500.00</td>
                            <td>16th Apr 2015</td> 
                            <td>16th Apr 2016</td>
                            <td><a href="services_manage_service.html"><span class="label label-danger caps">Expired</span></a></td>
                          </tr> -->
                         
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="6"></td>
                          </tr>
                        </tfoot>
                      </table>
                      <div class="clearfix"></div>
                      
                      
        	</div><!-- end table responsive -->
           <div class="alicent">
                <a href="services_my_services.html" class="btn btn-danger caps"><i class="fa fa-search"></i> <b>View All</b></a>&nbsp;
            </div>
           <div class="clearfix"></div>
           <div class="divider_line7"></div>
           
           <h4>Recent Support History</h4>
           <div class="table-responsive">
        	
                      <table class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th><span class="pull-left">Ticket #</span></th>
                            <th><span class="pull-left">Department</span></th>
                            <th><span class="pull-left">Subject</span></th>
                            <th><span class="pull-left">Last Updated</span></th>
                            <th><span class="pull-left">Status</span></th>

                          </tr>
                        </thead>
                        <tbody>

                          <tr>
                            <td>499911</td>
                            <td>Technical Support</td>
                            <td>I need help getting a sub domain created</td>
                            <td>29th Nov 2015 15:21</td>
                            <td><a href="support_view_ticket.html"><span class="label label-success caps">Open</span></a></td>
                          </tr>
                          <tr>
                            <td>337975</td>
                            <td>Technical Support</td>
                            <td>My website is down!</td>
                            <td>16th Apr 2015 09:15</td>
                            <td><a href="support_view_ticket.html"><span class="label label-danger caps">Answered</span></a></td>
                          </tr>
                          <tr>
                            <td>337971</td>
                            <td>Billing Department</td>
                            <td>Can I transfer my existing website?</td>
                            <td>15th Apr 2015 12:10</td>
                            <td><a href="support_view_ticket.html"><span class="label label-warning caps">Client-Reply</span></a></td>
                          </tr>
                          <tr>
                            <td>337970</td>
                            <td>Sales Department</td>
                            <td>I would like to enquire about Web88 CMS</td>
                            <td>14th Apr 2015 15:35</td>
                            <td><a href="support_view_ticket.html"><span class="label label-default caps">Closed</span></a></td>
                          </tr>
                          
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="5"></td>
                          </tr>
                        </tfoot>
                      </table>
                      <div class="clearfix"></div>
                      
                      
        	</div><!-- end table responsive -->
            
            <div class="alicent">
                <a href="support_open_new_ticket.html" class="btn btn-danger caps"><i class="fa fa-plus"></i> <b>Open New Ticket</b></a>&nbsp;
            </div>
       		           
           <div class="clearfix"></div>
           <div class="divider_line7"></div>
           
           
           <div class="clearfix margin_bottom1"></div>

       
       
       </div><!-- end section -->
        
        

        
	</div>  
    <!-- end container -->  
    
    
    <div class="clearfix"></div>
    
    </div>
</div>
@endsection