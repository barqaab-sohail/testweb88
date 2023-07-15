<?php 
$currentURL = url()->current();
$baseURL  = url('/');
$basePath = str_replace($baseURL, '', $currentURL);
//$total_price = 0;
?>
@if(strpos($basePath,'ecommerce') !== false)
    @include('frontend.ecommerce')
@elseif(strpos($basePath,'email88') !== false)
    @include('frontend.email88')
@elseif(strpos($basePath,'web88ir') !== false)
    @include('frontend.web88ir')
@else
    @extends('layouts.frontend_layout')
    @section('title','Domains | - Webqom Technologies')
@section('content')

<div class="clearfix"></div>


<div class="page_title1 sty9">
<div class="container">

	<h1>Online Order</h1>
    
    <div class="pagenation">
    <!--note to programmer: above is the breadcrumb scenario if client orders domain first.-->
    <div class="clearfix"></div>
    &nbsp;<a href="index.html">Home</a> <i>/</i> <a href="client_area_home.html">Dashboard</a> <i>/</i> <a href="domain_my_domains.html">My Domains</a> <i>/</i> <a href="domain_register_new_login.html">Register A New Domain</a> <i>/</i> <a href="domain_domain_configuration.html">Domain Configuration</a> <i>/</i> <a href="shopping_cart.html">Shopping Cart</a> <i>/</i> Checkout
    </div>
    <div class="clearfix"></div>
    
    <!-- <div class="pagenation">
    note to programmer: below is the breadcrumb scenario if client order hosting or other services first,
    <div class="clearfix"></div>
    &nbsp;<a href="index.html">Home</a> <i>/</i> <a href="client_area_home.html">Dashboard</a> <i>/</i> <a href="shared_hosting.html">Shared Hosting</a> <i>/</i> <a href="domain_configuration_hosting_login.html">Choose a Domain</a> <i>/</i> <a href="shopping_cart.html">Shopping Cart</a> <i>/</i> Checkout</div> -->
 
</div>	    
</div><!-- end page title -->

<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>

 <div class="one_full stcode_title9">
 	<h1 class="caps"><strong>Checkout</strong></h1>
 </div>

<div class="clearfix"></div>

<div class="content_fullwidth">
	<div class="container">

		<div class="one_fourth_less">
        
        	<h4>Client Area</h4>
             <ul class="list-group">
            	<li class="list-group-item"><h5 class="white">Quick Links</h5></li>
                <li class="list-group-item"><a href="{{url('/dashboard')}}"><i class="fa fa-caret-right"></i> Dashboard</a></li>
                <li class="list-group-item alt"><h5>Products/Services</h5></li>
                <li class="list-group-item"><a href="services_my_services.html"><i class="fa fa-caret-right"></i> My Services Listing</a></li>
                
                <li class="list-group-item alt"><h5>Orders</h5></li>
                <li class="list-group-item"><a href="{{ url('order_history_list') }}"><i class="fa fa-caret-right"></i> My Order History</a></li>
				
                <li class="list-group-item alt"><h5>Domains</h5></li>
                <li class="list-group-item"><a href="domain_my_domains.html"><i class="fa fa-caret-right"></i> My Domains</a></li>
                <li class="list-group-item"><a href="{{ url('domain_domain_renewal') }}"><i class="fa fa-caret-right"></i> Renew Domains</a></li>
                <li class="list-group-item"><a href="{{ url('domain_register_new_login') }}"><i class="fa fa-caret-right"></i> Register a New Domain</a></li>
                <li class="list-group-item"><a href="{{ url('domain_transfer_login') }}"><i class="fa fa-caret-right"></i> Transfer Domains to Us</a></li>
                <li class="list-group-item"><a href="{{ url('domain_search_login') }}"><i class="fa fa-caret-right"></i> Domain Search</a></li>
				<li class="list-group-item"><a href="{{route('frontend.domain.bulkSearchLogin')}}"><i class="fa fa-caret-right"></i> Bulk Domain Search</a></li>
                
                <li class="list-group-item alt"><h5>Billing</h5></li>
                <li class="list-group-item"><a href="billing_my_invoices.html"><i class="fa fa-caret-right"></i> My Invoices</a></li>
                <li class="list-group-item"><a href="billing_my_quotes.html"><i class="fa fa-caret-right"></i> My Quotes</a></li>
                <li class="list-group-item"><a href="billing_mass_payment.html"><i class="fa fa-caret-right"></i> Make Payment / Mass Payment</a></li>
                <li class="list-group-item alt"><h5>Support</h5></li>
                <li class="list-group-item"><a href="{{ url('support_tickets') }}"><i class="fa fa-caret-right"></i> My Support Tickets</a></li>
                <li class="list-group-item"><a href="{{ url('support_tickets/create') }}"><i class="fa fa-caret-right"></i> Open New Ticket</a></li>
                
                <li class="list-group-item alt"><h5>My Account</h5></li>
                <li class="list-group-item"><a href="{{ url('my_account') }}"><i class="fa fa-caret-right"></i> Edit Account Details</a></li>
                <li class="list-group-item"><a href="{{ url('my_account?change-password') }}"><i class="fa fa-caret-right"></i> Change Password</a></li>
  
             </ul>
        </div><!-- end one fourth less -->
        
        
        <div class="three_fourth_less last">
        	
          <div class="text-18px dark light">Please check your contact information to checkout.</div> 
          note to programmer: the "Contact Information" shall be auto-filled as the per initial data filled up in the registration form or updated data being saved previously by user.
          <div class="clearfix margin_bottom1"></div>
          
          <div class="cforms alileft">
 
            <div id="form_status"></div>
            <!-- {{ Form::model($user_info) }} -->
            {!! Form::open(['route' => 'frontend.order_confirmation_login', 'id' => 'order_confirmation_login']) !!}
            
            <!-- <form type="POST" id="gsr-contact" onSubmit="return valid_datas( this );">	 -->	
                <input type="hidden" name="purchase_amount" value="{{ $total_price }}">
                <h4>Contact Information</h4>
                <div class="one_half_less">
                
                    <label><b>First Name</b> </label>

                    <input type="text" name="contact[name]" id="firstname" disabled="disabled" placeholder="Hock" value="{{$user_info->name}}">
                    
                    <!-- <label><b>Last Name</b> </label>
                    <input type="text" name="lastname" id="lastname" disabled="disabled" placeholder="Lim"> -->
                    
                    <label><b>Company</b> </label>
                    <input type="text" name="contact[company]" id="company" disabled="disabled" placeholder="Webqom Technologies Sdn Bhd" value="{{$user_info->client->company}}"> 
                    
                    <label><b>Email Address</b> </label>
	           		<input type="text" name="contact[name]" id="name" disabled="disabled" placeholder="hock@webqom.com" value="{{$user_info->email}}">
                    
                    <label><b>Phone</b> </label>
                    <input type="text" name="contact[phone]" id="phone" disabled="disabled" placeholder="(03) 2630-5562" value="{{$user_info->client->phone_number}}">
                    
                    <label><b>Mobile Phone</b> </label>
                    <input type="text" name="contact[mobile]" id="mobile" disabled="disabled" placeholder="016-123-1234" value="{{$user_info->client->mobile_number}}">
                    
                </div>
                <!-- end one half -->
                
                <div class="one_half_less last">
                    
                    <label><b>Address</b> </label>
                    <input type="text" name="contact[address]" id="address" disabled="disabled" placeholder="B2-2-2, Solaris Dutamas, No. 1, Jalan Dutamas 1" value="{{$user_info->client->address1}}">
                      
                    <label><b>Address 2 </b> </label>
                    <input type="text" name="contact[address2]" id="address2" disabled="disabled" value="{{$user_info->client->address2}}">
                    
                    <label><b>City </b></label>

                    <input type="text" name="contact[city]" id="city" disabled="disabled" placeholder="Kuala Lumpur" value="{{!empty($city) ? $city : ''}}">
                     
                    <label><b>State</b> </label>
                    <input type="text" name="contact[state]" id="state" disabled="disabled" placeholder="Wilayah Persekutuan" value="{{$state}}">
                    
                    <label><b>Postal Code</b> </label>
                    <input type="text" name="contact[postalcode]" id="postalcode" disabled="disabled" placeholder="50480" value="{{$user_info->client->postal_code}}">   
                    
                    <label><b>Country</b> </label>
                    <select disabled="disabled" name="contact[country_id]" value="{{$user_info->client->country_id}}">
                            <option>-- Please select --</option>
                            <option data-calling-code="93" data-eu-tax="unknown" value="AF">Afghanistan</option>
                            <option data-calling-code="358" data-eu-tax="unknown" value="AX">Åland Islands</option>
                            <option data-calling-code="355" data-eu-tax="unknown" value="AL">Albania</option>
                            <option data-calling-code="213" data-eu-tax="unknown" value="DZ">Algeria</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="AS">American Samoa</option>
                            <option data-calling-code="376" data-eu-tax="unknown" value="AD">Andorra</option>
                            <option data-calling-code="244" data-eu-tax="unknown" value="AO">Angola</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="AI">Anguilla</option>
                            <option data-calling-code="672" data-eu-tax="unknown" value="AQ">Antarctica</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="AG">Antigua and Barbuda</option>
                            <option data-calling-code="54" data-eu-tax="unknown" value="AR">Argentina</option>
                            <option data-calling-code="374" data-eu-tax="unknown" value="AM">Armenia</option>
                            <option data-calling-code="297" data-eu-tax="unknown" value="AW">Aruba</option>
                            <option data-calling-code="61" data-eu-tax="unknown" value="AU">Australia</option>
                            <option data-calling-code="43" data-eu-tax="yes" value="AT">Austria</option>
                            <option data-calling-code="994" data-eu-tax="unknown" value="AZ">Azerbaijan</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="BS">Bahamas</option>
                            <option data-calling-code="973" data-eu-tax="unknown" value="BH">Bahrain</option>
                            <option data-calling-code="880" data-eu-tax="unknown" value="BD">Bangladesh</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="BB">Barbados</option>
                            <option data-calling-code="375" data-eu-tax="unknown" value="BY">Belarus</option>
                            <option data-calling-code="32" data-eu-tax="yes" value="BE">Belgium</option>
                            <option data-calling-code="501" data-eu-tax="unknown" value="BZ">Belize</option>
                            <option data-calling-code="229" data-eu-tax="unknown" value="BJ">Benin</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="BM">Bermuda</option>
                            <option data-calling-code="975" data-eu-tax="unknown" value="BT">Bhutan</option>
                            <option data-calling-code="591" data-eu-tax="unknown" value="BO">Bolivia, Plurinational State of</option>
                            <option data-calling-code="387" data-eu-tax="unknown" value="BA">Bosnia and Herzegovina</option>
                            <option data-calling-code="267" data-eu-tax="unknown" value="BW">Botswana</option>
                            <option data-calling-code="55" data-eu-tax="unknown" value="BR">Brazil</option>
                            <option data-calling-code="246" data-eu-tax="unknown" value="IO">British Indian Ocean Territory</option>
                            <option data-calling-code="673" data-eu-tax="unknown" value="BN">Brunei Darussalam</option>
                            <option data-calling-code="359" data-eu-tax="yes" value="BG">Bulgaria</option>
                            <option data-calling-code="226" data-eu-tax="unknown" value="BF">Burkina Faso</option>
                            <option data-calling-code="257" data-eu-tax="unknown" value="BI">Burundi</option>
                            <option data-calling-code="855" data-eu-tax="unknown" value="KH">Cambodia</option>
                            <option data-calling-code="237" data-eu-tax="unknown" value="CM">Cameroon</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="CA">Canada</option>
                            <option data-calling-code="238" data-eu-tax="unknown" value="CV">Cape Verde</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="KY">Cayman Islands</option>
                            <option data-calling-code="236" data-eu-tax="unknown" value="CF">Central African Republic</option>
                            <option data-calling-code="235" data-eu-tax="unknown" value="TD">Chad</option>
                            <option data-calling-code="56" data-eu-tax="unknown" value="CL">Chile</option>
                            <option data-calling-code="86" data-eu-tax="unknown" value="CN">China</option>
                            <option data-calling-code="61" data-eu-tax="unknown" value="CX">Christmas Island</option>
                            <option data-calling-code="61" data-eu-tax="unknown" value="CC">Cocos (Keeling) Islands</option>
                            <option data-calling-code="57" data-eu-tax="unknown" value="CO">Colombia</option>
                            <option data-calling-code="269" data-eu-tax="unknown" value="KM">Comoros</option>
                            <option data-calling-code="242" data-eu-tax="unknown" value="CG">Congo</option>
                            <option data-calling-code="243" data-eu-tax="unknown" value="CD">Congo, the Democratic Republic of the</option>
                            <option data-calling-code="682" data-eu-tax="unknown" value="CK">Cook Islands</option>
                            <option data-calling-code="506" data-eu-tax="unknown" value="CR">Costa Rica</option>
                            <option data-calling-code="225" data-eu-tax="unknown" value="CI">Côte d'Ivoire</option>
                            <option data-calling-code="385" data-eu-tax="yes" value="HR">Croatia</option>
                            <option data-calling-code="53" data-eu-tax="unknown" value="CU">Cuba</option>
                            <option data-calling-code="357" data-eu-tax="yes" value="CY">Cyprus</option>
                            <option data-calling-code="420" data-eu-tax="yes" value="CZ">Czech Republic</option>
                            <option data-calling-code="45" data-eu-tax="yes" value="DK">Denmark</option>
                            <option data-calling-code="253" data-eu-tax="unknown" value="DJ">Djibouti</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="DM">Dominica</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="DO">Dominican Republic</option>
                            <option data-calling-code="593" data-eu-tax="unknown" value="EC">Ecuador</option>
                            <option data-calling-code="20" data-eu-tax="unknown" value="EG">Egypt</option>
                            <option data-calling-code="503" data-eu-tax="unknown" value="SV">El Salvador</option>
                            <option data-calling-code="240" data-eu-tax="unknown" value="GQ">Equatorial Guinea</option>
                            <option data-calling-code="291" data-eu-tax="unknown" value="ER">Eritrea</option>
                            <option data-calling-code="372" data-eu-tax="yes" value="EE">Estonia</option>
                            <option data-calling-code="251" data-eu-tax="unknown" value="ET">Ethiopia</option>
                            <option data-calling-code="500" data-eu-tax="unknown" value="FK">Falkland Islands (Malvinas)</option>
                            <option data-calling-code="298" data-eu-tax="unknown" value="FO">Faroe Islands</option>
                            <option data-calling-code="679" data-eu-tax="unknown" value="FJ">Fiji</option>
                            <option data-calling-code="358" data-eu-tax="yes" value="FI">Finland</option>
                            <option data-calling-code="33" data-eu-tax="yes" value="FR">France</option>
                            <option data-calling-code="594" data-eu-tax="unknown" value="GF">French Guiana</option>
                            <option data-calling-code="689" data-eu-tax="unknown" value="PF">French Polynesia</option>
                            <option data-calling-code="262" data-eu-tax="unknown" value="TF">French Southern Territories</option>
                            <option data-calling-code="241" data-eu-tax="unknown" value="GA">Gabon</option>
                            <option data-calling-code="220" data-eu-tax="unknown" value="GM">Gambia</option>
                            <option data-calling-code="995" data-eu-tax="unknown" value="GE">Georgia</option>
                            <option data-calling-code="49" data-eu-tax="yes" value="DE">Germany</option>
                            <option data-calling-code="233" data-eu-tax="unknown" value="GH">Ghana</option>
                            <option data-calling-code="350" data-eu-tax="unknown" value="GI">Gibraltar</option>
                            <option data-calling-code="30" data-eu-tax="yes" value="GR">Greece</option>
                            <option data-calling-code="299" data-eu-tax="unknown" value="GL">Greenland</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="GD">Grenada</option>
                            <option data-calling-code="590" data-eu-tax="unknown" value="GP">Guadeloupe</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="GU">Guam</option>
                            <option data-calling-code="502" data-eu-tax="unknown" value="GT">Guatemala</option>
                            <option data-calling-code="44" data-eu-tax="unknown" value="GG">Guernsey</option>
                            <option data-calling-code="224" data-eu-tax="unknown" value="GN">Guinea</option>
                            <option data-calling-code="245" data-eu-tax="unknown" value="GW">Guinea-Bissau</option>
                            <option data-calling-code="592" data-eu-tax="unknown" value="GY">Guyana</option>
                            <option data-calling-code="509" data-eu-tax="unknown" value="HT">Haiti</option>
                            <option data-calling-code="3906" data-eu-tax="unknown" value="VA">Holy See (Vatican City State)</option>
                            <option data-calling-code="504" data-eu-tax="unknown" value="HN">Honduras</option>
                            <option data-calling-code="852" data-eu-tax="unknown" value="HK">Hong Kong</option>
                            <option data-calling-code="36" data-eu-tax="yes" value="HU">Hungary</option>
                            <option data-calling-code="354" data-eu-tax="unknown" value="IS">Iceland</option>
                            <option data-calling-code="91" data-eu-tax="unknown" value="IN">India</option>
                            <option data-calling-code="62" data-eu-tax="unknown" value="ID">Indonesia</option>
                            <option data-calling-code="98" data-eu-tax="unknown" value="IR">Iran, Islamic Republic of</option>
                            <option data-calling-code="964" data-eu-tax="unknown" value="IQ">Iraq</option>
                            <option data-calling-code="353" data-eu-tax="yes" value="IE">Ireland</option>
                            <option data-calling-code="44" data-eu-tax="yes" value="IM">Isle of Man</option>
                            <option data-calling-code="972" data-eu-tax="unknown" value="IL">Israel</option>
                            <option data-calling-code="39" data-eu-tax="yes" value="IT">Italy</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="JM">Jamaica</option>
                            <option data-calling-code="81" data-eu-tax="unknown" value="JP">Japan</option>
                            <option data-calling-code="44" data-eu-tax="unknown" value="JE">Jersey</option>
                            <option data-calling-code="962" data-eu-tax="unknown" value="JO">Jordan</option>
                            <option data-calling-code="7" data-eu-tax="unknown" value="KZ">Kazakhstan</option>
                            <option data-calling-code="254" data-eu-tax="unknown" value="KE">Kenya</option>
                            <option data-calling-code="686" data-eu-tax="unknown" value="KI">Kiribati</option>
                            <option data-calling-code="850" data-eu-tax="unknown" value="KP">Korea, Democratic People's Republic of</option>
                            <option data-calling-code="82" data-eu-tax="unknown" value="KR">Korea, Republic of</option>
                            <option data-calling-code="965" data-eu-tax="unknown" value="KW">Kuwait</option>
                            <option data-calling-code="996" data-eu-tax="unknown" value="KG">Kyrgyzstan</option>
                            <option data-calling-code="856" data-eu-tax="unknown" value="LA">Lao People's Democratic Republic</option>
                            <option data-calling-code="371" data-eu-tax="yes" value="LV">Latvia</option>
                            <option data-calling-code="961" data-eu-tax="unknown" value="LB">Lebanon</option>
                            <option data-calling-code="266" data-eu-tax="unknown" value="LS">Lesotho</option>
                            <option data-calling-code="231" data-eu-tax="unknown" value="LR">Liberia</option>
                            <option data-calling-code="218" data-eu-tax="unknown" value="LY">Libyan Arab Jamahiriya</option>
                            <option data-calling-code="423" data-eu-tax="unknown" value="LI">Liechtenstein</option>
                            <option data-calling-code="370" data-eu-tax="yes" value="LT">Lithuania</option>
                            <option data-calling-code="352" data-eu-tax="yes" value="LU">Luxembourg</option>
                            <option data-calling-code="853" data-eu-tax="unknown" value="MO">Macao</option>
                            <option data-calling-code="389" data-eu-tax="unknown" value="MK">Macedonia, the former Yugoslav Republic of</option>
                            <option data-calling-code="261" data-eu-tax="unknown" value="MG">Madagascar</option>
                            <option data-calling-code="265" data-eu-tax="unknown" value="MW">Malawi</option>
                            <option data-calling-code="60" data-eu-tax="unknown" value="MY" selected="selected">Malaysia</option>
                            <option data-calling-code="960" data-eu-tax="unknown" value="MV">Maldives</option>
                            <option data-calling-code="223" data-eu-tax="unknown" value="ML">Mali</option>
                            <option data-calling-code="356" data-eu-tax="yes" value="MT">Malta</option>
                            <option data-calling-code="692" data-eu-tax="unknown" value="MH">Marshall Islands</option>
                            <option data-calling-code="596" data-eu-tax="unknown" value="MQ">Martinique</option>
                            <option data-calling-code="222" data-eu-tax="unknown" value="MR">Mauritania</option>
                            <option data-calling-code="230" data-eu-tax="unknown" value="MU">Mauritius</option>
                            <option data-calling-code="262" data-eu-tax="unknown" value="YT">Mayotte</option>
                            <option data-calling-code="52" data-eu-tax="unknown" value="MX">Mexico</option>
                            <option data-calling-code="691" data-eu-tax="unknown" value="FM">Micronesia, Federated States of</option>
                            <option data-calling-code="373" data-eu-tax="unknown" value="MD">Moldova, Republic of</option>
                            <option data-calling-code="377" data-eu-tax="yes" value="MC">Monaco</option>
                            <option data-calling-code="976" data-eu-tax="unknown" value="MN">Mongolia</option>
                            <option data-calling-code="382" data-eu-tax="unknown" value="ME">Montenegro</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="MS">Montserrat</option>
                            <option data-calling-code="212" data-eu-tax="unknown" value="MA">Morocco</option>
                            <option data-calling-code="258" data-eu-tax="unknown" value="MZ">Mozambique</option>
                            <option data-calling-code="94" data-eu-tax="unknown" value="MM">Myanmar</option>
                            <option data-calling-code="264" data-eu-tax="unknown" value="NA">Namibia</option>
                            <option data-calling-code="674" data-eu-tax="unknown" value="NR">Nauru</option>
                            <option data-calling-code="977" data-eu-tax="unknown" value="NP">Nepal</option>
                            <option data-calling-code="31" data-eu-tax="yes" value="NL">Netherlands</option>
                            <option data-calling-code="599" data-eu-tax="unknown" value="AN">Netherlands Antilles</option>
                            <option data-calling-code="687" data-eu-tax="unknown" value="NC">New Caledonia</option>
                            <option data-calling-code="64" data-eu-tax="unknown" value="NZ">New Zealand</option>
                            <option data-calling-code="505" data-eu-tax="unknown" value="NI">Nicaragua</option>
                            <option data-calling-code="227" data-eu-tax="unknown" value="NE">Niger</option>
                            <option data-calling-code="234" data-eu-tax="unknown" value="NG">Nigeria</option>
                            <option data-calling-code="683" data-eu-tax="unknown" value="NU">Niue</option>
                            <option data-calling-code="672" data-eu-tax="unknown" value="NF">Norfolk Island</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="MP">Northern Mariana Islands</option>
                            <option data-calling-code="47" data-eu-tax="unknown" value="NO">Norway</option>
                            <option data-calling-code="968" data-eu-tax="unknown" value="OM">Oman</option>
                            <option data-calling-code="92" data-eu-tax="unknown" value="PK">Pakistan</option>
                            <option data-calling-code="680" data-eu-tax="unknown" value="PW">Palau</option>
                            <option data-calling-code="970" data-eu-tax="unknown" value="PS">Palestinian Territory, Occupied</option>
                            <option data-calling-code="507" data-eu-tax="unknown" value="PA">Panama</option>
                            <option data-calling-code="675" data-eu-tax="unknown" value="PG">Papua New Guinea</option>
                            <option data-calling-code="595" data-eu-tax="unknown" value="PY">Paraguay</option>
                            <option data-calling-code="51" data-eu-tax="unknown" value="PE">Peru</option>
                            <option data-calling-code="63" data-eu-tax="unknown" value="PH">Philippines</option>
                            <option data-calling-code="649" data-eu-tax="unknown" value="PN">Pitcairn</option>
                            <option data-calling-code="48" data-eu-tax="yes" value="PL">Poland</option>
                            <option data-calling-code="351" data-eu-tax="yes" value="PT">Portugal</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="PR">Puerto Rico</option>
                            <option data-calling-code="974" data-eu-tax="unknown" value="QA">Qatar</option>
                            <option data-calling-code="262" data-eu-tax="unknown" value="RE">Réunion</option>
                            <option data-calling-code="40" data-eu-tax="yes" value="RO">Romania</option>
                            <option data-calling-code="7" data-eu-tax="unknown" value="RU">Russian Federation</option>
                            <option data-calling-code="250" data-eu-tax="unknown" value="RW">Rwanda</option>
                            <option data-calling-code="590" data-eu-tax="unknown" value="BL">Saint Barthélemy</option>
                            <option data-calling-code="290" data-eu-tax="unknown" value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="KN">Saint Kitts and Nevis</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="LC">Saint Lucia</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="MF">Saint Martin (French part)</option>
                            <option data-calling-code="508" data-eu-tax="unknown" value="PM">Saint Pierre and Miquelon</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="VC">Saint Vincent and the Grenadines</option>
                            <option data-calling-code="685" data-eu-tax="unknown" value="WS">Samoa</option>
                            <option data-calling-code="378" data-eu-tax="unknown" value="SM">San Marino</option>
                            <option data-calling-code="239" data-eu-tax="unknown" value="ST">Sao Tome and Principe</option>
                            <option data-calling-code="966" data-eu-tax="unknown" value="SA">Saudi Arabia</option>
                            <option data-calling-code="221" data-eu-tax="unknown" value="SN">Senegal</option>
                            <option data-calling-code="382" data-eu-tax="unknown" value="RS">Serbia</option>
                            <option data-calling-code="248" data-eu-tax="unknown" value="SC">Seychelles</option>
                            <option data-calling-code="232" data-eu-tax="unknown" value="SL">Sierra Leone</option>
                            <option data-calling-code="65" data-eu-tax="unknown" value="SG">Singapore</option>
                            <option data-calling-code="421" data-eu-tax="yes" value="SK">Slovakia</option>
                            <option data-calling-code="386" data-eu-tax="yes" value="SI">Slovenia</option>
                            <option data-calling-code="677" data-eu-tax="unknown" value="SB">Solomon Islands</option>
                            <option data-calling-code="252" data-eu-tax="unknown" value="SO">Somalia</option>
                            <option data-calling-code="27" data-eu-tax="unknown" value="ZA">South Africa</option>
                            <option data-calling-code="34" data-eu-tax="yes" value="ES">Spain</option>
                            <option data-calling-code="94" data-eu-tax="unknown" value="LK">Sri Lanka</option>
                            <option data-calling-code="249" data-eu-tax="unknown" value="SD">Sudan</option>
                            <option data-calling-code="597" data-eu-tax="unknown" value="SR">Suriname</option>
                            <option data-calling-code="" data-eu-tax="unknown" value="SJ">Svalbard and Jan Mayen</option>
                            <option data-calling-code="268" data-eu-tax="unknown" value="SZ">Swaziland</option>
                            <option data-calling-code="46" data-eu-tax="yes" value="SE">Sweden</option>
                            <option data-calling-code="41" data-eu-tax="unknown" value="CH">Switzerland</option>
                            <option data-calling-code="963" data-eu-tax="unknown" value="SY">Syrian Arab Republic</option>
                            <option data-calling-code="886" data-eu-tax="unknown" value="TW">Taiwan</option>
                            <option data-calling-code="992" data-eu-tax="unknown" value="TJ">Tajikistan</option>
                            <option data-calling-code="255" data-eu-tax="unknown" value="TZ">Tanzania, United Republic of</option>
                            <option data-calling-code="66" data-eu-tax="unknown" value="TH">Thailand</option>
                            <option data-calling-code="670" data-eu-tax="unknown" value="TL">Timor-Leste</option>
                            <option data-calling-code="228" data-eu-tax="unknown" value="TG">Togo</option>
                            <option data-calling-code="690" data-eu-tax="unknown" value="TK">Tokelau</option>
                            <option data-calling-code="676" data-eu-tax="unknown" value="TO">Tonga</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="TT">Trinidad and Tobago</option>
                            <option data-calling-code="216" data-eu-tax="unknown" value="TN">Tunisia</option>
                            <option data-calling-code="90" data-eu-tax="unknown" value="TR">Turkey</option>
                            <option data-calling-code="993" data-eu-tax="unknown" value="TM">Turkmenistan</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="TC">Turks and Caicos Islands</option>
                            <option data-calling-code="688" data-eu-tax="unknown" value="TV">Tuvalu</option>
                            <option data-calling-code="256" data-eu-tax="unknown" value="UG">Uganda</option>
                            <option data-calling-code="380" data-eu-tax="unknown" value="UA">Ukraine</option>
                            <option data-calling-code="971" data-eu-tax="unknown" value="AE">United Arab Emirates</option>
                            <option data-calling-code="44" data-eu-tax="yes" value="GB">United Kingdom</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="US">United States</option>
                            <option data-calling-code="598" data-eu-tax="unknown" value="UY">Uruguay</option>
                            <option data-calling-code="998" data-eu-tax="unknown" value="UZ">Uzbekistan</option>
                            <option data-calling-code="678" data-eu-tax="unknown" value="VU">Vanuatu</option>
                            <option data-calling-code="58" data-eu-tax="unknown" value="VE">Venezuela, Bolivarian Republic of</option>
                            <option data-calling-code="84" data-eu-tax="unknown" value="VN">Viet Nam</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="VG">Virgin Islands, British</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="VI">Virgin Islands, U.S.</option>
                            <option data-calling-code="681" data-eu-tax="unknown" value="WF">Wallis and Futuna</option>
                            <option data-calling-code="" data-eu-tax="unknown" value="EH">Western Sahara</option>
                            <option data-calling-code="967" data-eu-tax="unknown" value="YE">Yemen</option>
                            <option data-calling-code="260" data-eu-tax="unknown" value="ZM">Zambia</option>
                            <option data-calling-code="263" data-eu-tax="unknown" value="ZW">Zimbabwe</option>
                        </select>
                   
                    
                </div>
                <!-- end one half less last -->
                
                <div class="checkbox">
                	<div class="clearfix"></div>
                	<input type="checkbox" checked="checked"> <span class="onelb">Billing Address is the same as given in the Contact Information.</span>
            	</div>
                <div class="clearfix"></div>
                
                <!-- note to programmer: if untick "Billing Address is the same as given in the contact information" above, please display the billing information form below. Otherwise hide the section "Billing information" and the empty form. -->
                
                
                <div class="billing_info" style="display: none;">
                    <h4>Billing Address</h4>

                    <div class="one_half_less">
                    <input type="hidden" name="billing[user_id]" value="<?php echo Auth::id(); ?>">
                        <label><b>Address</b> </label>
                        <input type="text" name="billing[address]" id="address">
                          
                        <label><b>Address 2 </b> </label>
                        <input type="text" name="billing[address2]" id="address2">
                        
                        <label><b>City </b></label>
                        <input type="text" name="billing[city]" id="city">
                         
                        <label><b>State</b> </label>
                        <input type="text" name="billing[state]" id="state">
                                                       
                    </div>
                    <div class="one_half_less last">
                    
                    <label><b>Postal Code</b> </label>
                    <input type="text" name="billing[postalcode]" id="postalcode">   
                    
                    <label><b>Country</b> </label>
                    <select disabled="disabled" name="billing[country_id]">
                            <option>-- Please select --</option>
                            <option data-calling-code="93" data-eu-tax="unknown" value="AF">Afghanistan</option>
                            <option data-calling-code="358" data-eu-tax="unknown" value="AX">Åland Islands</option>
                            <option data-calling-code="355" data-eu-tax="unknown" value="AL">Albania</option>
                            <option data-calling-code="213" data-eu-tax="unknown" value="DZ">Algeria</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="AS">American Samoa</option>
                            <option data-calling-code="376" data-eu-tax="unknown" value="AD">Andorra</option>
                            <option data-calling-code="244" data-eu-tax="unknown" value="AO">Angola</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="AI">Anguilla</option>
                            <option data-calling-code="672" data-eu-tax="unknown" value="AQ">Antarctica</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="AG">Antigua and Barbuda</option>
                            <option data-calling-code="54" data-eu-tax="unknown" value="AR">Argentina</option>
                            <option data-calling-code="374" data-eu-tax="unknown" value="AM">Armenia</option>
                            <option data-calling-code="297" data-eu-tax="unknown" value="AW">Aruba</option>
                            <option data-calling-code="61" data-eu-tax="unknown" value="AU">Australia</option>
                            <option data-calling-code="43" data-eu-tax="yes" value="AT">Austria</option>
                            <option data-calling-code="994" data-eu-tax="unknown" value="AZ">Azerbaijan</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="BS">Bahamas</option>
                            <option data-calling-code="973" data-eu-tax="unknown" value="BH">Bahrain</option>
                            <option data-calling-code="880" data-eu-tax="unknown" value="BD">Bangladesh</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="BB">Barbados</option>
                            <option data-calling-code="375" data-eu-tax="unknown" value="BY">Belarus</option>
                            <option data-calling-code="32" data-eu-tax="yes" value="BE">Belgium</option>
                            <option data-calling-code="501" data-eu-tax="unknown" value="BZ">Belize</option>
                            <option data-calling-code="229" data-eu-tax="unknown" value="BJ">Benin</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="BM">Bermuda</option>
                            <option data-calling-code="975" data-eu-tax="unknown" value="BT">Bhutan</option>
                            <option data-calling-code="591" data-eu-tax="unknown" value="BO">Bolivia, Plurinational State of</option>
                            <option data-calling-code="387" data-eu-tax="unknown" value="BA">Bosnia and Herzegovina</option>
                            <option data-calling-code="267" data-eu-tax="unknown" value="BW">Botswana</option>
                            <option data-calling-code="55" data-eu-tax="unknown" value="BR">Brazil</option>
                            <option data-calling-code="246" data-eu-tax="unknown" value="IO">British Indian Ocean Territory</option>
                            <option data-calling-code="673" data-eu-tax="unknown" value="BN">Brunei Darussalam</option>
                            <option data-calling-code="359" data-eu-tax="yes" value="BG">Bulgaria</option>
                            <option data-calling-code="226" data-eu-tax="unknown" value="BF">Burkina Faso</option>
                            <option data-calling-code="257" data-eu-tax="unknown" value="BI">Burundi</option>
                            <option data-calling-code="855" data-eu-tax="unknown" value="KH">Cambodia</option>
                            <option data-calling-code="237" data-eu-tax="unknown" value="CM">Cameroon</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="CA">Canada</option>
                            <option data-calling-code="238" data-eu-tax="unknown" value="CV">Cape Verde</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="KY">Cayman Islands</option>
                            <option data-calling-code="236" data-eu-tax="unknown" value="CF">Central African Republic</option>
                            <option data-calling-code="235" data-eu-tax="unknown" value="TD">Chad</option>
                            <option data-calling-code="56" data-eu-tax="unknown" value="CL">Chile</option>
                            <option data-calling-code="86" data-eu-tax="unknown" value="CN">China</option>
                            <option data-calling-code="61" data-eu-tax="unknown" value="CX">Christmas Island</option>
                            <option data-calling-code="61" data-eu-tax="unknown" value="CC">Cocos (Keeling) Islands</option>
                            <option data-calling-code="57" data-eu-tax="unknown" value="CO">Colombia</option>
                            <option data-calling-code="269" data-eu-tax="unknown" value="KM">Comoros</option>
                            <option data-calling-code="242" data-eu-tax="unknown" value="CG">Congo</option>
                            <option data-calling-code="243" data-eu-tax="unknown" value="CD">Congo, the Democratic Republic of the</option>
                            <option data-calling-code="682" data-eu-tax="unknown" value="CK">Cook Islands</option>
                            <option data-calling-code="506" data-eu-tax="unknown" value="CR">Costa Rica</option>
                            <option data-calling-code="225" data-eu-tax="unknown" value="CI">Côte d'Ivoire</option>
                            <option data-calling-code="385" data-eu-tax="yes" value="HR">Croatia</option>
                            <option data-calling-code="53" data-eu-tax="unknown" value="CU">Cuba</option>
                            <option data-calling-code="357" data-eu-tax="yes" value="CY">Cyprus</option>
                            <option data-calling-code="420" data-eu-tax="yes" value="CZ">Czech Republic</option>
                            <option data-calling-code="45" data-eu-tax="yes" value="DK">Denmark</option>
                            <option data-calling-code="253" data-eu-tax="unknown" value="DJ">Djibouti</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="DM">Dominica</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="DO">Dominican Republic</option>
                            <option data-calling-code="593" data-eu-tax="unknown" value="EC">Ecuador</option>
                            <option data-calling-code="20" data-eu-tax="unknown" value="EG">Egypt</option>
                            <option data-calling-code="503" data-eu-tax="unknown" value="SV">El Salvador</option>
                            <option data-calling-code="240" data-eu-tax="unknown" value="GQ">Equatorial Guinea</option>
                            <option data-calling-code="291" data-eu-tax="unknown" value="ER">Eritrea</option>
                            <option data-calling-code="372" data-eu-tax="yes" value="EE">Estonia</option>
                            <option data-calling-code="251" data-eu-tax="unknown" value="ET">Ethiopia</option>
                            <option data-calling-code="500" data-eu-tax="unknown" value="FK">Falkland Islands (Malvinas)</option>
                            <option data-calling-code="298" data-eu-tax="unknown" value="FO">Faroe Islands</option>
                            <option data-calling-code="679" data-eu-tax="unknown" value="FJ">Fiji</option>
                            <option data-calling-code="358" data-eu-tax="yes" value="FI">Finland</option>
                            <option data-calling-code="33" data-eu-tax="yes" value="FR">France</option>
                            <option data-calling-code="594" data-eu-tax="unknown" value="GF">French Guiana</option>
                            <option data-calling-code="689" data-eu-tax="unknown" value="PF">French Polynesia</option>
                            <option data-calling-code="262" data-eu-tax="unknown" value="TF">French Southern Territories</option>
                            <option data-calling-code="241" data-eu-tax="unknown" value="GA">Gabon</option>
                            <option data-calling-code="220" data-eu-tax="unknown" value="GM">Gambia</option>
                            <option data-calling-code="995" data-eu-tax="unknown" value="GE">Georgia</option>
                            <option data-calling-code="49" data-eu-tax="yes" value="DE">Germany</option>
                            <option data-calling-code="233" data-eu-tax="unknown" value="GH">Ghana</option>
                            <option data-calling-code="350" data-eu-tax="unknown" value="GI">Gibraltar</option>
                            <option data-calling-code="30" data-eu-tax="yes" value="GR">Greece</option>
                            <option data-calling-code="299" data-eu-tax="unknown" value="GL">Greenland</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="GD">Grenada</option>
                            <option data-calling-code="590" data-eu-tax="unknown" value="GP">Guadeloupe</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="GU">Guam</option>
                            <option data-calling-code="502" data-eu-tax="unknown" value="GT">Guatemala</option>
                            <option data-calling-code="44" data-eu-tax="unknown" value="GG">Guernsey</option>
                            <option data-calling-code="224" data-eu-tax="unknown" value="GN">Guinea</option>
                            <option data-calling-code="245" data-eu-tax="unknown" value="GW">Guinea-Bissau</option>
                            <option data-calling-code="592" data-eu-tax="unknown" value="GY">Guyana</option>
                            <option data-calling-code="509" data-eu-tax="unknown" value="HT">Haiti</option>
                            <option data-calling-code="3906" data-eu-tax="unknown" value="VA">Holy See (Vatican City State)</option>
                            <option data-calling-code="504" data-eu-tax="unknown" value="HN">Honduras</option>
                            <option data-calling-code="852" data-eu-tax="unknown" value="HK">Hong Kong</option>
                            <option data-calling-code="36" data-eu-tax="yes" value="HU">Hungary</option>
                            <option data-calling-code="354" data-eu-tax="unknown" value="IS">Iceland</option>
                            <option data-calling-code="91" data-eu-tax="unknown" value="IN">India</option>
                            <option data-calling-code="62" data-eu-tax="unknown" value="ID">Indonesia</option>
                            <option data-calling-code="98" data-eu-tax="unknown" value="IR">Iran, Islamic Republic of</option>
                            <option data-calling-code="964" data-eu-tax="unknown" value="IQ">Iraq</option>
                            <option data-calling-code="353" data-eu-tax="yes" value="IE">Ireland</option>
                            <option data-calling-code="44" data-eu-tax="yes" value="IM">Isle of Man</option>
                            <option data-calling-code="972" data-eu-tax="unknown" value="IL">Israel</option>
                            <option data-calling-code="39" data-eu-tax="yes" value="IT">Italy</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="JM">Jamaica</option>
                            <option data-calling-code="81" data-eu-tax="unknown" value="JP">Japan</option>
                            <option data-calling-code="44" data-eu-tax="unknown" value="JE">Jersey</option>
                            <option data-calling-code="962" data-eu-tax="unknown" value="JO">Jordan</option>
                            <option data-calling-code="7" data-eu-tax="unknown" value="KZ">Kazakhstan</option>
                            <option data-calling-code="254" data-eu-tax="unknown" value="KE">Kenya</option>
                            <option data-calling-code="686" data-eu-tax="unknown" value="KI">Kiribati</option>
                            <option data-calling-code="850" data-eu-tax="unknown" value="KP">Korea, Democratic People's Republic of</option>
                            <option data-calling-code="82" data-eu-tax="unknown" value="KR">Korea, Republic of</option>
                            <option data-calling-code="965" data-eu-tax="unknown" value="KW">Kuwait</option>
                            <option data-calling-code="996" data-eu-tax="unknown" value="KG">Kyrgyzstan</option>
                            <option data-calling-code="856" data-eu-tax="unknown" value="LA">Lao People's Democratic Republic</option>
                            <option data-calling-code="371" data-eu-tax="yes" value="LV">Latvia</option>
                            <option data-calling-code="961" data-eu-tax="unknown" value="LB">Lebanon</option>
                            <option data-calling-code="266" data-eu-tax="unknown" value="LS">Lesotho</option>
                            <option data-calling-code="231" data-eu-tax="unknown" value="LR">Liberia</option>
                            <option data-calling-code="218" data-eu-tax="unknown" value="LY">Libyan Arab Jamahiriya</option>
                            <option data-calling-code="423" data-eu-tax="unknown" value="LI">Liechtenstein</option>
                            <option data-calling-code="370" data-eu-tax="yes" value="LT">Lithuania</option>
                            <option data-calling-code="352" data-eu-tax="yes" value="LU">Luxembourg</option>
                            <option data-calling-code="853" data-eu-tax="unknown" value="MO">Macao</option>
                            <option data-calling-code="389" data-eu-tax="unknown" value="MK">Macedonia, the former Yugoslav Republic of</option>
                            <option data-calling-code="261" data-eu-tax="unknown" value="MG">Madagascar</option>
                            <option data-calling-code="265" data-eu-tax="unknown" value="MW">Malawi</option>
                            <option data-calling-code="60" data-eu-tax="unknown" value="MY" selected="selected">Malaysia</option>
                            <option data-calling-code="960" data-eu-tax="unknown" value="MV">Maldives</option>
                            <option data-calling-code="223" data-eu-tax="unknown" value="ML">Mali</option>
                            <option data-calling-code="356" data-eu-tax="yes" value="MT">Malta</option>
                            <option data-calling-code="692" data-eu-tax="unknown" value="MH">Marshall Islands</option>
                            <option data-calling-code="596" data-eu-tax="unknown" value="MQ">Martinique</option>
                            <option data-calling-code="222" data-eu-tax="unknown" value="MR">Mauritania</option>
                            <option data-calling-code="230" data-eu-tax="unknown" value="MU">Mauritius</option>
                            <option data-calling-code="262" data-eu-tax="unknown" value="YT">Mayotte</option>
                            <option data-calling-code="52" data-eu-tax="unknown" value="MX">Mexico</option>
                            <option data-calling-code="691" data-eu-tax="unknown" value="FM">Micronesia, Federated States of</option>
                            <option data-calling-code="373" data-eu-tax="unknown" value="MD">Moldova, Republic of</option>
                            <option data-calling-code="377" data-eu-tax="yes" value="MC">Monaco</option>
                            <option data-calling-code="976" data-eu-tax="unknown" value="MN">Mongolia</option>
                            <option data-calling-code="382" data-eu-tax="unknown" value="ME">Montenegro</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="MS">Montserrat</option>
                            <option data-calling-code="212" data-eu-tax="unknown" value="MA">Morocco</option>
                            <option data-calling-code="258" data-eu-tax="unknown" value="MZ">Mozambique</option>
                            <option data-calling-code="94" data-eu-tax="unknown" value="MM">Myanmar</option>
                            <option data-calling-code="264" data-eu-tax="unknown" value="NA">Namibia</option>
                            <option data-calling-code="674" data-eu-tax="unknown" value="NR">Nauru</option>
                            <option data-calling-code="977" data-eu-tax="unknown" value="NP">Nepal</option>
                            <option data-calling-code="31" data-eu-tax="yes" value="NL">Netherlands</option>
                            <option data-calling-code="599" data-eu-tax="unknown" value="AN">Netherlands Antilles</option>
                            <option data-calling-code="687" data-eu-tax="unknown" value="NC">New Caledonia</option>
                            <option data-calling-code="64" data-eu-tax="unknown" value="NZ">New Zealand</option>
                            <option data-calling-code="505" data-eu-tax="unknown" value="NI">Nicaragua</option>
                            <option data-calling-code="227" data-eu-tax="unknown" value="NE">Niger</option>
                            <option data-calling-code="234" data-eu-tax="unknown" value="NG">Nigeria</option>
                            <option data-calling-code="683" data-eu-tax="unknown" value="NU">Niue</option>
                            <option data-calling-code="672" data-eu-tax="unknown" value="NF">Norfolk Island</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="MP">Northern Mariana Islands</option>
                            <option data-calling-code="47" data-eu-tax="unknown" value="NO">Norway</option>
                            <option data-calling-code="968" data-eu-tax="unknown" value="OM">Oman</option>
                            <option data-calling-code="92" data-eu-tax="unknown" value="PK">Pakistan</option>
                            <option data-calling-code="680" data-eu-tax="unknown" value="PW">Palau</option>
                            <option data-calling-code="970" data-eu-tax="unknown" value="PS">Palestinian Territory, Occupied</option>
                            <option data-calling-code="507" data-eu-tax="unknown" value="PA">Panama</option>
                            <option data-calling-code="675" data-eu-tax="unknown" value="PG">Papua New Guinea</option>
                            <option data-calling-code="595" data-eu-tax="unknown" value="PY">Paraguay</option>
                            <option data-calling-code="51" data-eu-tax="unknown" value="PE">Peru</option>
                            <option data-calling-code="63" data-eu-tax="unknown" value="PH">Philippines</option>
                            <option data-calling-code="649" data-eu-tax="unknown" value="PN">Pitcairn</option>
                            <option data-calling-code="48" data-eu-tax="yes" value="PL">Poland</option>
                            <option data-calling-code="351" data-eu-tax="yes" value="PT">Portugal</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="PR">Puerto Rico</option>
                            <option data-calling-code="974" data-eu-tax="unknown" value="QA">Qatar</option>
                            <option data-calling-code="262" data-eu-tax="unknown" value="RE">Réunion</option>
                            <option data-calling-code="40" data-eu-tax="yes" value="RO">Romania</option>
                            <option data-calling-code="7" data-eu-tax="unknown" value="RU">Russian Federation</option>
                            <option data-calling-code="250" data-eu-tax="unknown" value="RW">Rwanda</option>
                            <option data-calling-code="590" data-eu-tax="unknown" value="BL">Saint Barthélemy</option>
                            <option data-calling-code="290" data-eu-tax="unknown" value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="KN">Saint Kitts and Nevis</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="LC">Saint Lucia</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="MF">Saint Martin (French part)</option>
                            <option data-calling-code="508" data-eu-tax="unknown" value="PM">Saint Pierre and Miquelon</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="VC">Saint Vincent and the Grenadines</option>
                            <option data-calling-code="685" data-eu-tax="unknown" value="WS">Samoa</option>
                            <option data-calling-code="378" data-eu-tax="unknown" value="SM">San Marino</option>
                            <option data-calling-code="239" data-eu-tax="unknown" value="ST">Sao Tome and Principe</option>
                            <option data-calling-code="966" data-eu-tax="unknown" value="SA">Saudi Arabia</option>
                            <option data-calling-code="221" data-eu-tax="unknown" value="SN">Senegal</option>
                            <option data-calling-code="382" data-eu-tax="unknown" value="RS">Serbia</option>
                            <option data-calling-code="248" data-eu-tax="unknown" value="SC">Seychelles</option>
                            <option data-calling-code="232" data-eu-tax="unknown" value="SL">Sierra Leone</option>
                            <option data-calling-code="65" data-eu-tax="unknown" value="SG">Singapore</option>
                            <option data-calling-code="421" data-eu-tax="yes" value="SK">Slovakia</option>
                            <option data-calling-code="386" data-eu-tax="yes" value="SI">Slovenia</option>
                            <option data-calling-code="677" data-eu-tax="unknown" value="SB">Solomon Islands</option>
                            <option data-calling-code="252" data-eu-tax="unknown" value="SO">Somalia</option>
                            <option data-calling-code="27" data-eu-tax="unknown" value="ZA">South Africa</option>
                            <option data-calling-code="34" data-eu-tax="yes" value="ES">Spain</option>
                            <option data-calling-code="94" data-eu-tax="unknown" value="LK">Sri Lanka</option>
                            <option data-calling-code="249" data-eu-tax="unknown" value="SD">Sudan</option>
                            <option data-calling-code="597" data-eu-tax="unknown" value="SR">Suriname</option>
                            <option data-calling-code="" data-eu-tax="unknown" value="SJ">Svalbard and Jan Mayen</option>
                            <option data-calling-code="268" data-eu-tax="unknown" value="SZ">Swaziland</option>
                            <option data-calling-code="46" data-eu-tax="yes" value="SE">Sweden</option>
                            <option data-calling-code="41" data-eu-tax="unknown" value="CH">Switzerland</option>
                            <option data-calling-code="963" data-eu-tax="unknown" value="SY">Syrian Arab Republic</option>
                            <option data-calling-code="886" data-eu-tax="unknown" value="TW">Taiwan</option>
                            <option data-calling-code="992" data-eu-tax="unknown" value="TJ">Tajikistan</option>
                            <option data-calling-code="255" data-eu-tax="unknown" value="TZ">Tanzania, United Republic of</option>
                            <option data-calling-code="66" data-eu-tax="unknown" value="TH">Thailand</option>
                            <option data-calling-code="670" data-eu-tax="unknown" value="TL">Timor-Leste</option>
                            <option data-calling-code="228" data-eu-tax="unknown" value="TG">Togo</option>
                            <option data-calling-code="690" data-eu-tax="unknown" value="TK">Tokelau</option>
                            <option data-calling-code="676" data-eu-tax="unknown" value="TO">Tonga</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="TT">Trinidad and Tobago</option>
                            <option data-calling-code="216" data-eu-tax="unknown" value="TN">Tunisia</option>
                            <option data-calling-code="90" data-eu-tax="unknown" value="TR">Turkey</option>
                            <option data-calling-code="993" data-eu-tax="unknown" value="TM">Turkmenistan</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="TC">Turks and Caicos Islands</option>
                            <option data-calling-code="688" data-eu-tax="unknown" value="TV">Tuvalu</option>
                            <option data-calling-code="256" data-eu-tax="unknown" value="UG">Uganda</option>
                            <option data-calling-code="380" data-eu-tax="unknown" value="UA">Ukraine</option>
                            <option data-calling-code="971" data-eu-tax="unknown" value="AE">United Arab Emirates</option>
                            <option data-calling-code="44" data-eu-tax="yes" value="GB">United Kingdom</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="US">United States</option>
                            <option data-calling-code="598" data-eu-tax="unknown" value="UY">Uruguay</option>
                            <option data-calling-code="998" data-eu-tax="unknown" value="UZ">Uzbekistan</option>
                            <option data-calling-code="678" data-eu-tax="unknown" value="VU">Vanuatu</option>
                            <option data-calling-code="58" data-eu-tax="unknown" value="VE">Venezuela, Bolivarian Republic of</option>
                            <option data-calling-code="84" data-eu-tax="unknown" value="VN">Viet Nam</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="VG">Virgin Islands, British</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="VI">Virgin Islands, U.S.</option>
                            <option data-calling-code="681" data-eu-tax="unknown" value="WF">Wallis and Futuna</option>
                            <option data-calling-code="" data-eu-tax="unknown" value="EH">Western Sahara</option>
                            <option data-calling-code="967" data-eu-tax="unknown" value="YE">Yemen</option>
                            <option data-calling-code="260" data-eu-tax="unknown" value="ZM">Zambia</option>
                            <option data-calling-code="263" data-eu-tax="unknown" value="ZW">Zimbabwe</option>
                        </select>
                        
                        <label><b>Phone</b> </label>
                        <input type="text" name="billing[phone]" id="phone" placeholder="eg. (03) 2630-5562">
                        
                        <label><b>Mobile Phone</b> </label>
                        <input type="text" name="billing[mobile]" id="mobile" placeholder="eg. 016-123-1234">
                   
                    
                </div>
                </div>
                
                <!-- end one half -->
                
                
                <!-- end one half less last -->
		 
         
           <div class="clearfix"></div>
           <div class="divider_line7"></div>
           <div class="clearfix"></div>
           
           <!-- domain registrant information start -->
           <div class="text-18px dark light">You may specify alternative registered contact details for the domain registration(s) in your order when placing an order on behalf of another person or entity.</div>
           <div class="clearfix margin_bottom1"></div>
           <h4>Domain Registrant Information</h4>
           <div class="cforms alileft">
           		<!-- <form type="POST" id="gsr-contact" onSubmit="return valid_datas( this );"> -->	
                	<div class="one_half_less">
                    	<select class="contact_add_another">
                            <option value="1">Use Default Contact (Details Above)</option>
                            <option value="2">Add New Contact</option>
                        </select>
                    </div>
                <!-- </form> -->
           </div><!-- end cforms alileft -->
           
           <div class="clearfix"></div>
           note to programmer: when selects "Add new contact" on the dropdown list above, load the add new contact form below. Otherwise hide it.
       
           
           <div class="cforms alileft additional_contact" style="display: none;">
				<!-- <form type="POST" id="gsr-contact" onSubmit="return valid_datas( this );">	 -->	
                <div class="one_half_less">
                <input type="hidden" name="additional[user_id]" value="<?php echo Auth::id(); ?>">
                    <label><b>First Name</b> </label>
                    <input type="text" name="additional[firstname]" id="firstname">
                    
                     <label><b>Last Name</b> </label>
                    <input type="text" name="additional[lastname]" id="lastname">
                    
                     <label><b>Company</b> </label>
                    <input type="text" name="additional[company]" id="company">     
                    
                    <label><b>Email Address</b> </label>
	           		<input type="text" name="additional[name]" id="name" placeholder="mail@yourdomain.com">
                    
                    <label><b>Phone</b> </label>
                    <input type="text" name="additional[phone]" id="phone" placeholder="eg. (03) 2630-5562">
                    
                    <label><b>Mobile Phone</b> </label>
                    <input type="text" name="additional[mobile]" id="mobile" placeholder="eg. 016-123-1234">
 
                </div>
                <!-- end one half -->
                
                <div class="one_half_less last">
                    
                    <label><b>Address</b> </label>
                    <input type="text" name="additional[address]" id="address">

                    <label><b>Address 2 </b> </label>
                    <input type="text" name="additional[address2]" id="address2">
                    
                    <label><b>City </b></label>
                    <input type="text" name="additional[city]" id="city">
                    
                    <label><b>State</b> </label>
                    <input type="text" name="additional[state]" id="state">
                    
                    <label><b>Postal Code</b> </label>
                    <input type="text" name="additional[postalcode]" id="postalcode">
 
                    <label><b>Country</b> </label>
                    <select name="additional[country_id]">
                            <option>-- Please select --</option>
                            <option data-calling-code="93" data-eu-tax="unknown" value="AF">Afghanistan</option>
                            <option data-calling-code="358" data-eu-tax="unknown" value="AX">Åland Islands</option>
                            <option data-calling-code="355" data-eu-tax="unknown" value="AL">Albania</option>
                            <option data-calling-code="213" data-eu-tax="unknown" value="DZ">Algeria</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="AS">American Samoa</option>
                            <option data-calling-code="376" data-eu-tax="unknown" value="AD">Andorra</option>
                            <option data-calling-code="244" data-eu-tax="unknown" value="AO">Angola</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="AI">Anguilla</option>
                            <option data-calling-code="672" data-eu-tax="unknown" value="AQ">Antarctica</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="AG">Antigua and Barbuda</option>
                            <option data-calling-code="54" data-eu-tax="unknown" value="AR">Argentina</option>
                            <option data-calling-code="374" data-eu-tax="unknown" value="AM">Armenia</option>
                            <option data-calling-code="297" data-eu-tax="unknown" value="AW">Aruba</option>
                            <option data-calling-code="61" data-eu-tax="unknown" value="AU">Australia</option>
                            <option data-calling-code="43" data-eu-tax="yes" value="AT">Austria</option>
                            <option data-calling-code="994" data-eu-tax="unknown" value="AZ">Azerbaijan</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="BS">Bahamas</option>
                            <option data-calling-code="973" data-eu-tax="unknown" value="BH">Bahrain</option>
                            <option data-calling-code="880" data-eu-tax="unknown" value="BD">Bangladesh</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="BB">Barbados</option>
                            <option data-calling-code="375" data-eu-tax="unknown" value="BY">Belarus</option>
                            <option data-calling-code="32" data-eu-tax="yes" value="BE">Belgium</option>
                            <option data-calling-code="501" data-eu-tax="unknown" value="BZ">Belize</option>
                            <option data-calling-code="229" data-eu-tax="unknown" value="BJ">Benin</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="BM">Bermuda</option>
                            <option data-calling-code="975" data-eu-tax="unknown" value="BT">Bhutan</option>
                            <option data-calling-code="591" data-eu-tax="unknown" value="BO">Bolivia, Plurinational State of</option>
                            <option data-calling-code="387" data-eu-tax="unknown" value="BA">Bosnia and Herzegovina</option>
                            <option data-calling-code="267" data-eu-tax="unknown" value="BW">Botswana</option>
                            <option data-calling-code="55" data-eu-tax="unknown" value="BR">Brazil</option>
                            <option data-calling-code="246" data-eu-tax="unknown" value="IO">British Indian Ocean Territory</option>
                            <option data-calling-code="673" data-eu-tax="unknown" value="BN">Brunei Darussalam</option>
                            <option data-calling-code="359" data-eu-tax="yes" value="BG">Bulgaria</option>
                            <option data-calling-code="226" data-eu-tax="unknown" value="BF">Burkina Faso</option>
                            <option data-calling-code="257" data-eu-tax="unknown" value="BI">Burundi</option>
                            <option data-calling-code="855" data-eu-tax="unknown" value="KH">Cambodia</option>
                            <option data-calling-code="237" data-eu-tax="unknown" value="CM">Cameroon</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="CA">Canada</option>
                            <option data-calling-code="238" data-eu-tax="unknown" value="CV">Cape Verde</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="KY">Cayman Islands</option>
                            <option data-calling-code="236" data-eu-tax="unknown" value="CF">Central African Republic</option>
                            <option data-calling-code="235" data-eu-tax="unknown" value="TD">Chad</option>
                            <option data-calling-code="56" data-eu-tax="unknown" value="CL">Chile</option>
                            <option data-calling-code="86" data-eu-tax="unknown" value="CN">China</option>
                            <option data-calling-code="61" data-eu-tax="unknown" value="CX">Christmas Island</option>
                            <option data-calling-code="61" data-eu-tax="unknown" value="CC">Cocos (Keeling) Islands</option>
                            <option data-calling-code="57" data-eu-tax="unknown" value="CO">Colombia</option>
                            <option data-calling-code="269" data-eu-tax="unknown" value="KM">Comoros</option>
                            <option data-calling-code="242" data-eu-tax="unknown" value="CG">Congo</option>
                            <option data-calling-code="243" data-eu-tax="unknown" value="CD">Congo, the Democratic Republic of the</option>
                            <option data-calling-code="682" data-eu-tax="unknown" value="CK">Cook Islands</option>
                            <option data-calling-code="506" data-eu-tax="unknown" value="CR">Costa Rica</option>
                            <option data-calling-code="225" data-eu-tax="unknown" value="CI">Côte d'Ivoire</option>
                            <option data-calling-code="385" data-eu-tax="yes" value="HR">Croatia</option>
                            <option data-calling-code="53" data-eu-tax="unknown" value="CU">Cuba</option>
                            <option data-calling-code="357" data-eu-tax="yes" value="CY">Cyprus</option>
                            <option data-calling-code="420" data-eu-tax="yes" value="CZ">Czech Republic</option>
                            <option data-calling-code="45" data-eu-tax="yes" value="DK">Denmark</option>
                            <option data-calling-code="253" data-eu-tax="unknown" value="DJ">Djibouti</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="DM">Dominica</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="DO">Dominican Republic</option>
                            <option data-calling-code="593" data-eu-tax="unknown" value="EC">Ecuador</option>
                            <option data-calling-code="20" data-eu-tax="unknown" value="EG">Egypt</option>
                            <option data-calling-code="503" data-eu-tax="unknown" value="SV">El Salvador</option>
                            <option data-calling-code="240" data-eu-tax="unknown" value="GQ">Equatorial Guinea</option>
                            <option data-calling-code="291" data-eu-tax="unknown" value="ER">Eritrea</option>
                            <option data-calling-code="372" data-eu-tax="yes" value="EE">Estonia</option>
                            <option data-calling-code="251" data-eu-tax="unknown" value="ET">Ethiopia</option>
                            <option data-calling-code="500" data-eu-tax="unknown" value="FK">Falkland Islands (Malvinas)</option>
                            <option data-calling-code="298" data-eu-tax="unknown" value="FO">Faroe Islands</option>
                            <option data-calling-code="679" data-eu-tax="unknown" value="FJ">Fiji</option>
                            <option data-calling-code="358" data-eu-tax="yes" value="FI">Finland</option>
                            <option data-calling-code="33" data-eu-tax="yes" value="FR">France</option>
                            <option data-calling-code="594" data-eu-tax="unknown" value="GF">French Guiana</option>
                            <option data-calling-code="689" data-eu-tax="unknown" value="PF">French Polynesia</option>
                            <option data-calling-code="262" data-eu-tax="unknown" value="TF">French Southern Territories</option>
                            <option data-calling-code="241" data-eu-tax="unknown" value="GA">Gabon</option>
                            <option data-calling-code="220" data-eu-tax="unknown" value="GM">Gambia</option>
                            <option data-calling-code="995" data-eu-tax="unknown" value="GE">Georgia</option>
                            <option data-calling-code="49" data-eu-tax="yes" value="DE">Germany</option>
                            <option data-calling-code="233" data-eu-tax="unknown" value="GH">Ghana</option>
                            <option data-calling-code="350" data-eu-tax="unknown" value="GI">Gibraltar</option>
                            <option data-calling-code="30" data-eu-tax="yes" value="GR">Greece</option>
                            <option data-calling-code="299" data-eu-tax="unknown" value="GL">Greenland</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="GD">Grenada</option>
                            <option data-calling-code="590" data-eu-tax="unknown" value="GP">Guadeloupe</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="GU">Guam</option>
                            <option data-calling-code="502" data-eu-tax="unknown" value="GT">Guatemala</option>
                            <option data-calling-code="44" data-eu-tax="unknown" value="GG">Guernsey</option>
                            <option data-calling-code="224" data-eu-tax="unknown" value="GN">Guinea</option>
                            <option data-calling-code="245" data-eu-tax="unknown" value="GW">Guinea-Bissau</option>
                            <option data-calling-code="592" data-eu-tax="unknown" value="GY">Guyana</option>
                            <option data-calling-code="509" data-eu-tax="unknown" value="HT">Haiti</option>
                            <option data-calling-code="3906" data-eu-tax="unknown" value="VA">Holy See (Vatican City State)</option>
                            <option data-calling-code="504" data-eu-tax="unknown" value="HN">Honduras</option>
                            <option data-calling-code="852" data-eu-tax="unknown" value="HK">Hong Kong</option>
                            <option data-calling-code="36" data-eu-tax="yes" value="HU">Hungary</option>
                            <option data-calling-code="354" data-eu-tax="unknown" value="IS">Iceland</option>
                            <option data-calling-code="91" data-eu-tax="unknown" value="IN">India</option>
                            <option data-calling-code="62" data-eu-tax="unknown" value="ID">Indonesia</option>
                            <option data-calling-code="98" data-eu-tax="unknown" value="IR">Iran, Islamic Republic of</option>
                            <option data-calling-code="964" data-eu-tax="unknown" value="IQ">Iraq</option>
                            <option data-calling-code="353" data-eu-tax="yes" value="IE">Ireland</option>
                            <option data-calling-code="44" data-eu-tax="yes" value="IM">Isle of Man</option>
                            <option data-calling-code="972" data-eu-tax="unknown" value="IL">Israel</option>
                            <option data-calling-code="39" data-eu-tax="yes" value="IT">Italy</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="JM">Jamaica</option>
                            <option data-calling-code="81" data-eu-tax="unknown" value="JP">Japan</option>
                            <option data-calling-code="44" data-eu-tax="unknown" value="JE">Jersey</option>
                            <option data-calling-code="962" data-eu-tax="unknown" value="JO">Jordan</option>
                            <option data-calling-code="7" data-eu-tax="unknown" value="KZ">Kazakhstan</option>
                            <option data-calling-code="254" data-eu-tax="unknown" value="KE">Kenya</option>
                            <option data-calling-code="686" data-eu-tax="unknown" value="KI">Kiribati</option>
                            <option data-calling-code="850" data-eu-tax="unknown" value="KP">Korea, Democratic People's Republic of</option>
                            <option data-calling-code="82" data-eu-tax="unknown" value="KR">Korea, Republic of</option>
                            <option data-calling-code="965" data-eu-tax="unknown" value="KW">Kuwait</option>
                            <option data-calling-code="996" data-eu-tax="unknown" value="KG">Kyrgyzstan</option>
                            <option data-calling-code="856" data-eu-tax="unknown" value="LA">Lao People's Democratic Republic</option>
                            <option data-calling-code="371" data-eu-tax="yes" value="LV">Latvia</option>
                            <option data-calling-code="961" data-eu-tax="unknown" value="LB">Lebanon</option>
                            <option data-calling-code="266" data-eu-tax="unknown" value="LS">Lesotho</option>
                            <option data-calling-code="231" data-eu-tax="unknown" value="LR">Liberia</option>
                            <option data-calling-code="218" data-eu-tax="unknown" value="LY">Libyan Arab Jamahiriya</option>
                            <option data-calling-code="423" data-eu-tax="unknown" value="LI">Liechtenstein</option>
                            <option data-calling-code="370" data-eu-tax="yes" value="LT">Lithuania</option>
                            <option data-calling-code="352" data-eu-tax="yes" value="LU">Luxembourg</option>
                            <option data-calling-code="853" data-eu-tax="unknown" value="MO">Macao</option>
                            <option data-calling-code="389" data-eu-tax="unknown" value="MK">Macedonia, the former Yugoslav Republic of</option>
                            <option data-calling-code="261" data-eu-tax="unknown" value="MG">Madagascar</option>
                            <option data-calling-code="265" data-eu-tax="unknown" value="MW">Malawi</option>
                            <option data-calling-code="60" data-eu-tax="unknown" value="MY" selected="selected">Malaysia</option>
                            <option data-calling-code="960" data-eu-tax="unknown" value="MV">Maldives</option>
                            <option data-calling-code="223" data-eu-tax="unknown" value="ML">Mali</option>
                            <option data-calling-code="356" data-eu-tax="yes" value="MT">Malta</option>
                            <option data-calling-code="692" data-eu-tax="unknown" value="MH">Marshall Islands</option>
                            <option data-calling-code="596" data-eu-tax="unknown" value="MQ">Martinique</option>
                            <option data-calling-code="222" data-eu-tax="unknown" value="MR">Mauritania</option>
                            <option data-calling-code="230" data-eu-tax="unknown" value="MU">Mauritius</option>
                            <option data-calling-code="262" data-eu-tax="unknown" value="YT">Mayotte</option>
                            <option data-calling-code="52" data-eu-tax="unknown" value="MX">Mexico</option>
                            <option data-calling-code="691" data-eu-tax="unknown" value="FM">Micronesia, Federated States of</option>
                            <option data-calling-code="373" data-eu-tax="unknown" value="MD">Moldova, Republic of</option>
                            <option data-calling-code="377" data-eu-tax="yes" value="MC">Monaco</option>
                            <option data-calling-code="976" data-eu-tax="unknown" value="MN">Mongolia</option>
                            <option data-calling-code="382" data-eu-tax="unknown" value="ME">Montenegro</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="MS">Montserrat</option>
                            <option data-calling-code="212" data-eu-tax="unknown" value="MA">Morocco</option>
                            <option data-calling-code="258" data-eu-tax="unknown" value="MZ">Mozambique</option>
                            <option data-calling-code="94" data-eu-tax="unknown" value="MM">Myanmar</option>
                            <option data-calling-code="264" data-eu-tax="unknown" value="NA">Namibia</option>
                            <option data-calling-code="674" data-eu-tax="unknown" value="NR">Nauru</option>
                            <option data-calling-code="977" data-eu-tax="unknown" value="NP">Nepal</option>
                            <option data-calling-code="31" data-eu-tax="yes" value="NL">Netherlands</option>
                            <option data-calling-code="599" data-eu-tax="unknown" value="AN">Netherlands Antilles</option>
                            <option data-calling-code="687" data-eu-tax="unknown" value="NC">New Caledonia</option>
                            <option data-calling-code="64" data-eu-tax="unknown" value="NZ">New Zealand</option>
                            <option data-calling-code="505" data-eu-tax="unknown" value="NI">Nicaragua</option>
                            <option data-calling-code="227" data-eu-tax="unknown" value="NE">Niger</option>
                            <option data-calling-code="234" data-eu-tax="unknown" value="NG">Nigeria</option>
                            <option data-calling-code="683" data-eu-tax="unknown" value="NU">Niue</option>
                            <option data-calling-code="672" data-eu-tax="unknown" value="NF">Norfolk Island</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="MP">Northern Mariana Islands</option>
                            <option data-calling-code="47" data-eu-tax="unknown" value="NO">Norway</option>
                            <option data-calling-code="968" data-eu-tax="unknown" value="OM">Oman</option>
                            <option data-calling-code="92" data-eu-tax="unknown" value="PK">Pakistan</option>
                            <option data-calling-code="680" data-eu-tax="unknown" value="PW">Palau</option>
                            <option data-calling-code="970" data-eu-tax="unknown" value="PS">Palestinian Territory, Occupied</option>
                            <option data-calling-code="507" data-eu-tax="unknown" value="PA">Panama</option>
                            <option data-calling-code="675" data-eu-tax="unknown" value="PG">Papua New Guinea</option>
                            <option data-calling-code="595" data-eu-tax="unknown" value="PY">Paraguay</option>
                            <option data-calling-code="51" data-eu-tax="unknown" value="PE">Peru</option>
                            <option data-calling-code="63" data-eu-tax="unknown" value="PH">Philippines</option>
                            <option data-calling-code="649" data-eu-tax="unknown" value="PN">Pitcairn</option>
                            <option data-calling-code="48" data-eu-tax="yes" value="PL">Poland</option>
                            <option data-calling-code="351" data-eu-tax="yes" value="PT">Portugal</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="PR">Puerto Rico</option>
                            <option data-calling-code="974" data-eu-tax="unknown" value="QA">Qatar</option>
                            <option data-calling-code="262" data-eu-tax="unknown" value="RE">Réunion</option>
                            <option data-calling-code="40" data-eu-tax="yes" value="RO">Romania</option>
                            <option data-calling-code="7" data-eu-tax="unknown" value="RU">Russian Federation</option>
                            <option data-calling-code="250" data-eu-tax="unknown" value="RW">Rwanda</option>
                            <option data-calling-code="590" data-eu-tax="unknown" value="BL">Saint Barthélemy</option>
                            <option data-calling-code="290" data-eu-tax="unknown" value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="KN">Saint Kitts and Nevis</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="LC">Saint Lucia</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="MF">Saint Martin (French part)</option>
                            <option data-calling-code="508" data-eu-tax="unknown" value="PM">Saint Pierre and Miquelon</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="VC">Saint Vincent and the Grenadines</option>
                            <option data-calling-code="685" data-eu-tax="unknown" value="WS">Samoa</option>
                            <option data-calling-code="378" data-eu-tax="unknown" value="SM">San Marino</option>
                            <option data-calling-code="239" data-eu-tax="unknown" value="ST">Sao Tome and Principe</option>
                            <option data-calling-code="966" data-eu-tax="unknown" value="SA">Saudi Arabia</option>
                            <option data-calling-code="221" data-eu-tax="unknown" value="SN">Senegal</option>
                            <option data-calling-code="382" data-eu-tax="unknown" value="RS">Serbia</option>
                            <option data-calling-code="248" data-eu-tax="unknown" value="SC">Seychelles</option>
                            <option data-calling-code="232" data-eu-tax="unknown" value="SL">Sierra Leone</option>
                            <option data-calling-code="65" data-eu-tax="unknown" value="SG">Singapore</option>
                            <option data-calling-code="421" data-eu-tax="yes" value="SK">Slovakia</option>
                            <option data-calling-code="386" data-eu-tax="yes" value="SI">Slovenia</option>
                            <option data-calling-code="677" data-eu-tax="unknown" value="SB">Solomon Islands</option>
                            <option data-calling-code="252" data-eu-tax="unknown" value="SO">Somalia</option>
                            <option data-calling-code="27" data-eu-tax="unknown" value="ZA">South Africa</option>
                            <option data-calling-code="34" data-eu-tax="yes" value="ES">Spain</option>
                            <option data-calling-code="94" data-eu-tax="unknown" value="LK">Sri Lanka</option>
                            <option data-calling-code="249" data-eu-tax="unknown" value="SD">Sudan</option>
                            <option data-calling-code="597" data-eu-tax="unknown" value="SR">Suriname</option>
                            <option data-calling-code="" data-eu-tax="unknown" value="SJ">Svalbard and Jan Mayen</option>
                            <option data-calling-code="268" data-eu-tax="unknown" value="SZ">Swaziland</option>
                            <option data-calling-code="46" data-eu-tax="yes" value="SE">Sweden</option>
                            <option data-calling-code="41" data-eu-tax="unknown" value="CH">Switzerland</option>
                            <option data-calling-code="963" data-eu-tax="unknown" value="SY">Syrian Arab Republic</option>
                            <option data-calling-code="886" data-eu-tax="unknown" value="TW">Taiwan</option>
                            <option data-calling-code="992" data-eu-tax="unknown" value="TJ">Tajikistan</option>
                            <option data-calling-code="255" data-eu-tax="unknown" value="TZ">Tanzania, United Republic of</option>
                            <option data-calling-code="66" data-eu-tax="unknown" value="TH">Thailand</option>
                            <option data-calling-code="670" data-eu-tax="unknown" value="TL">Timor-Leste</option>
                            <option data-calling-code="228" data-eu-tax="unknown" value="TG">Togo</option>
                            <option data-calling-code="690" data-eu-tax="unknown" value="TK">Tokelau</option>
                            <option data-calling-code="676" data-eu-tax="unknown" value="TO">Tonga</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="TT">Trinidad and Tobago</option>
                            <option data-calling-code="216" data-eu-tax="unknown" value="TN">Tunisia</option>
                            <option data-calling-code="90" data-eu-tax="unknown" value="TR">Turkey</option>
                            <option data-calling-code="993" data-eu-tax="unknown" value="TM">Turkmenistan</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="TC">Turks and Caicos Islands</option>
                            <option data-calling-code="688" data-eu-tax="unknown" value="TV">Tuvalu</option>
                            <option data-calling-code="256" data-eu-tax="unknown" value="UG">Uganda</option>
                            <option data-calling-code="380" data-eu-tax="unknown" value="UA">Ukraine</option>
                            <option data-calling-code="971" data-eu-tax="unknown" value="AE">United Arab Emirates</option>
                            <option data-calling-code="44" data-eu-tax="yes" value="GB">United Kingdom</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="US">United States</option>
                            <option data-calling-code="598" data-eu-tax="unknown" value="UY">Uruguay</option>
                            <option data-calling-code="998" data-eu-tax="unknown" value="UZ">Uzbekistan</option>
                            <option data-calling-code="678" data-eu-tax="unknown" value="VU">Vanuatu</option>
                            <option data-calling-code="58" data-eu-tax="unknown" value="VE">Venezuela, Bolivarian Republic of</option>
                            <option data-calling-code="84" data-eu-tax="unknown" value="VN">Viet Nam</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="VG">Virgin Islands, British</option>
                            <option data-calling-code="1" data-eu-tax="unknown" value="VI">Virgin Islands, U.S.</option>
                            <option data-calling-code="681" data-eu-tax="unknown" value="WF">Wallis and Futuna</option>
                            <option data-calling-code="" data-eu-tax="unknown" value="EH">Western Sahara</option>
                            <option data-calling-code="967" data-eu-tax="unknown" value="YE">Yemen</option>
                            <option data-calling-code="260" data-eu-tax="unknown" value="ZM">Zambia</option>
                            <option data-calling-code="263" data-eu-tax="unknown" value="ZW">Zimbabwe</option>
                        </select>
                   
                    
                </div>
                <!-- end one half less last -->
                
            <!-- </form> -->           
           
           </div><!-- end cform left>
           <!-- end add new contact -->
           <!-- end domain registrant information -->
           
           <div class="clearfix"></div>
           <div class="divider_line7"></div>
           <div class="clearfix"></div>
           
           
           <!-- payment details start -->
           <div class="text-18px dark light">Please choose your preferred method of payment.</div>
           <div class="clearfix margin_bottom1"></div>
           
           
           <div class="alertymes4">
                <h3 class="light"><i class="fa fa-credit-card"></i>Total Due Today: <strong>RM {{ number_format($total_price, 2) }}</strong></h3>
           </div><!-- end section -->
           <div class="clearfix margin_bottom3"></div>
           
           <h4>Payment Details</h4>
           <div class="cforms alileft">
     
                <div id="form_status"></div>
                <!-- <form type="POST" id="gsr-contact" onSubmit="return valid_datas( this );"> -->
                    <div class="one_half_less">
                        <label><b>Paid by</b> <em>*</em></label>
                        <label class="input">
                            <select id="paid_by" name="paid_by">
                                <option>-- Please select --</option>
                                <option value="2">Bank Transfer</option>
                                <!--<option value="3">Cash</option>
                                <option value="4">Cheque</option>-->
                                <option value="5">Stripe</option> 
                                <option selected="selected" value="7">PayPal</option>
                                <!-- <option>Bank-in</option> -->
                                <!-- <option>Mastercard</option> -->
                                <!-- <option>Visa</option> -->
                            </select>
                        </label>
                     </div>
               <!--  </form> -->
            </div><!-- end cforms-->
            <!-- end payment details -->
            
            <div class="clearfix"></div>
            <div class="divider_line7"></div>
            <div class="clearfix"></div>
            
            <!-- notes start -->
            <h4>Additional Notes</h4>
            <div class="cforms alileft">
     
                <div id="form_status"></div>
                <!-- <form type="POST" id="gsr-contact" onSubmit="return valid_datas( this );"> -->
                    <textarea rows="5" placeholder="You can enter any additional notes or information you want included with your order here..."></textarea>
                <!-- </form> -->
            </div><!-- end cforms-->
            <!-- notes end -->
            
            
            <div class="clearfix"></div>
            <div class="divider_line7"></div>
            <div class="clearfix"></div>
            <div class="alicent">

            <!-- {{ Form::button('<i class="fa fa-arrow-circle-right"></i> <b>Pay Now</b>', ['type' => 'submit', 'class' => 'btn btn-danger caps'] )  }} -->
            <div id="paypal-button-container" style="margin-bottom: 17px"></div>
            <div id="bank-button-container" style="margin-bottom: 17px">
                <div class="alertymes4" style="color: #000 !important; border: 1px solid #000">
                    <h3 class="light" style="color: #000 !important;">
                        <strong>Payment By Cheque/ Cash / Bank Transfer</strong>
                        <p>Please write your cheque payable to "Webqom Technologies Sdn Bhd" and bank in to our Public Bank account"</p>
                    </h3>
                    <div class="leftContent">
                        <strong> Account Number </strong>
                        <p class="light">
                            3158958612
                        </p>

                        <strong> Bank Name </strong>
                        <p class="light">
                            Public Bank Berhad
                        </p>
                        <strong> Account Name </strong>
                        <p class="light">
                            Webqom Technologies Sdn Bhd
                        </p>
                    </div>
               </div><!-- end section -->
            <input type="submit" value="Submit" style="font-family: 'Roboto', sans-serif;padding: 13px 30px 14px 30px;background-color: #D72D1A;border: 0px;font-size: 14px;font-weight: 500;color: #fff;text-transform: uppercase;transition: all 0.3s ease;border-radius: 3px;">
            </div>
            <br>
            <br>
            <br>

                
        </div><!-- end section -->
    
    {!! Form::close() !!}

    </div>
</div><!-- end content fullwidth -->

<div class="clearfix"></div>
<div class="divider_line"></div>

<div class="clearfix"></div>

<a href="#" class="scrollup">Scroll</a><!-- end scroll to top of the page-->
</div>

    
<!-- ######### JS FILES ######### -->
<!-- get jQuery used for the theme -->
<!-- <script type="text/javascript" src="js/universal/jquery.js"></script>
<script src="js/animations/js/animations.min.js" type="text/javascript"></script>
<script src="js/mainmenu/bootstrap.min.js"></script> 
<script src="js/mainmenu/customeUI.js"></script>
<script src="js/masterslider/jquery.easing.min.js"></script>

<script src="js/scrolltotop/totop.js" type="text/javascript"></script>
<script type="text/javascript" src="js/mainmenu/sticky.js"></script>
<script type="text/javascript" src="js/mainmenu/modernizr.custom.75180.js"></script>
<script type="text/javascript" src="js/cubeportfolio/jquery.cubeportfolio.min.js"></script>
<script type="text/javascript" src="js/cubeportfolio/main.js"></script>


<script src="js/aninum/jquery.animateNumber.min.js"></script>
<script src="js/carouselowl/owl.carousel.js"></script>

<script type="text/javascript" src="js/accordion/jquery.accordion.js"></script>
<script type="text/javascript" src="js/accordion/custom.js"></script>
<script type="text/javascript" src="js/cform/form-validate.js"></script>
<script type="text/javascrip<script type="text/javascript" src="js/universal/custom.js"></script> -->
 @section('custom_scripts')
 <script src="https://www.paypal.com/sdk/js?client-id=AdJBPGNCfzPpaMFZ4SoGvJ8hr4tZpIQDkWMQA5dZ_db4keNRW9S1Ub1o6BFjUwqoGwFuodh9eykC5SoQ&currency=MYR&disable-funding=card,credit"></script>

<script>
//paypal start
    paypal.Buttons({
        createOrder: function(data, actions) {
          // This function sets up the details of the transaction, including the amount and line item details.
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '{{$total_price}}'
              }
            }]
          });
        },
        onApprove: function(data, actions) {
            console.log(data);
          // This function captures the funds from the transaction.
          return actions.order.capture().then(function(details) {
            console.log(details);

            $.ajax({
                url: base_url+'/save_before_payment',
                type: 'POST',
                data: $('#order_confirmation_login').serialize()
            })
            .done(function(response) {

                return fetch(base_url+'/payment_done', {
                  method: 'post',
                  headers: {
                    'x-csrf-token': csrf_token,
                    'content-type': 'application/json'
                  },
                  body: JSON.stringify({
                    data: data,
                    detail: details
                  })
               })
                .then((response) => {
                   if(response.ok) {
                     window.location = 'order_confirmation_login?orderId=' + data.orderID;
                   } else {
                     throw new Error('Server response wasn\'t OK');
                   }
                 });

            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
            // This function shows a transaction success message to your buyer.
            //alert('Transaction completed by ' + details.payer.name.given_name);
          });
        }
    }).render('#paypal-button-container');

//paypal - end
	smoothScroll.init();
	$(document).ready(function() {
		
        $('.menu-link').menuFullpage();

        $(".checkbox input:checkbox").change(function() {
            var ischecked= $(this).is(':checked');
            if(ischecked){
                $('.billing_info').hide();
            }else{
                $('.billing_info').show();
            }
        });

        $(".contact_add_another").change(function() {
           /*alert(this.value);*/
           if(this.value == '1'){
                $('.additional_contact').hide();
           }else{
                $('.additional_contact').show();
           }
        });
        
        $("form#logout_form").submit(function(e){
        });
	});

    //Show or Hide Bank / PayPal payment options
     $(window).on('load', function() {
        paymentBlockDisplay();
     });
     $('#bank-button-container').css('display', 'none');  
     $(document).on('change', '#paid_by', function() {
        paymentBlockDisplay();
     });
     function paymentBlockDisplay() {
        var paidBy = $('#paid_by option:selected').val();
        if (paidBy == 7) {
            $('#bank-button-container').css('display', 'none');
            $('#paypal-button-container').css('display', 'block');
        } else {
            $('#bank-button-container').css('display', 'block');
            $('#paypal-button-container').css('display', 'none');
        }
     }
</script>
@endsection
@endsection
@endif
