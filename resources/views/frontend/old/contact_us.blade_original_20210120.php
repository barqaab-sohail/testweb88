@extends('layouts.frontend_layout')
@section('title','Home | - Webqom Technologies')
@section('content')

<style type="text/css">
    .help-block{
        color: red;
    }
    .alertymes5 {
		float: unset;
		width: 80%;
		padding: 22px;
		color: #5cb85c;
		border: 1px solid #4cae4c;
		background-color: #fff;
		text-align: center;
		margin: 0px auto;
		margin-bottom: 20px;
	}
</style>
<div class="clearfix"></div>


<!--<div class="page_title1 sty2">
  <h1>Contact Us <em>We're always available to help!</em> <span class="line2"></span> </h1>
</div>-->
<!-- end page title -->

<div class="margin_bottom5"></div>
<div class="clearfix"></div>



<div class="feature_section102">

    <div class="plan">
    <div class="container">
      <div class="onecol_sixty">
        <div class="clearfix margin_bottom3"></div>
        <h1 class="caps"><b>Contact</b> Information</h1>
        <h2 class="light">Webqom Technologies Sdn Bhd (809009-A)</h2>
        <h3>B2-2-2, Solaris Dutamas, No. 1, Jalan Dutamas 1, <br>50480 Kuala Lumpur, Wilayah Persekutuan, Malaysia.</h3>
        <ul class="arrows_list1">
          <li><i class="fa fa-phone"></i> <strong>Telephone:</strong> +603 2630-5562</li>
          <li><i class="fa fa-envelope"></i> <strong>E-mail:</strong> <a href="mailto:enquiry@webqom.com">enquiry@webqom.com</a></li>
        </ul>
        <div class="clearfix margin_bottom1"></div>
        <h2 class="red light">We're here to help you with anything you need.</h2>
        <p>Webqom's Technical Support Department is handled by Experienced System Engineers and System Support Personnel on 24 Hours, 7 Days a Week. Technical Support will answer any technical questions you have about webqom.com hosting, products and services.</p>
        
      </div>
      <!-- end section -->
        
        <div class="onecol_forty last animate" data-anim-type="fadeInRight" data-anim-delay="200"><img src="public_html/images/contact_us/img.jpg" alt="Contact us"/ ></div>
        <!-- end img -->
        
    </div>    
    </div>
    <!-- end plan 1 -->
    
    

</div><!-- end featured section 102 -->



<div class="clearfix"></div>



<div class="parallax_section3" id="notifi">
	@if(isset($_GET['id']) && !empty($_GET['id']))
	<div class="alertymes5" >
			<h3 class="light"><i class="fa fa-check-circle"></i><strong>Query Created #{{$_GET['id']}}</strong>
			<br>Your query has been successfully created.</h3>
	   </div>
	  @endif
<div class="container">

    <h1 class="caps white">We Would Like to Hear From You</h1>
    <h3 class="light white">If you have any query about our products and services, our representatives are willing to assist you!</h3>
    
    <div class="cforms alileft">
 
        <div id="form_status"></div>
            <form id="frmContact" class="form-horizontal" role="form" method="POST" action="{{ route('contactEnquiry') }}" enctype="multipart/form-data">
            {{ csrf_field() }}  
            <div class="one_half">
            
                <label><span class="white">Your Name</span> <em>*</em></label>
                <label class="input">
                    <input type="text" name="name" id="name" placeholder="Enter name">
                </label>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                <div class="clearfix"></div>
                
                <label><span class="white">Your Email</span> <em>*</em></label>
                <label class="input">
                    <input type="email" name="email" id="email" placeholder="Enter Email">
                </label>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <div class="clearfix"></div>
                
                <label><span class="white"> I would like to know more about</span> <em>*</em></label>
                <label class="input">
                    <select name="service" id="service" data-error-container="#service-error"> 
                        <option>-- Please select --</option>
                        <option value="dedicated servers"></option>>Dedicated Servers</option>
                        <option value="domains">Domains</option>
                        <option value="e-commerce package">E-commerce Package</option>
                        <option value="online marketing">Online Marketing</option>
                        <option value="reseller hosting">Reseller Hosting</option>
                        <option value="responsive web design">Responsive Web Design</option>
                        <option value="social media application">Social Media Application</option>
                        <option value="ssl certificates">SSL Certificates</option>
                        <option value="vps hosting">VPS Hosting</option>
                        <option value="web hosting">Web Hosting</option>
                        <option value="web88 cms">Web88 CMS</option>
                        <option value="others">Others</option>
                    </select>
                    @if ($errors->has('service'))
                        <span class="help-block">
                            <strong>{{ $errors->first('service') }}</strong>
                        </span>
                    @endif
                </label>
                <span id="service-error"></span>
            </div>
            
            <div class="one_half">
                <label><span class="white">Company Name</span> <em>*</em></label>
                <label class="input">
                    <input type="text" name="company" id="company" placeholder="Enter company">
                </label>
                @if ($errors->has('company'))
                    <span class="help-block">
                        <strong>{{ $errors->first('company') }}</strong>
                    </span>
                @endif
                <div class="clearfix"></div>
                
                <label><span class="white">Contact Number</span> <em>*</em></label>
                <label class="input">
                    <input type="text" name="phone" id="phone" placeholder="Enter contact number">
                </label>
                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
                <div class="clearfix"></div>
            
            </div>
            
            <div class="one_half">
            <label><span class="white">Website</span> <em>*</em></label>
            <label class="input">
                <input type="text" name="website" id="website" placeholder="Enter website">
            </label>
            @if ($errors->has('website'))
                <span class="help-block">
                    <strong>{{ $errors->first('website') }}</strong>
                </span>
            @endif
            <div class="clearfix"></div>
            
            </div>
    
            <label><span class="white">Message</span> <em>*</em></label>
            <label class="textarea">
                <textarea rows="3" name="message" id="message" style="width:98%" placeholder="Enter the message"></textarea>
            </label>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <div class="clearfix"></div>
            
            <div class="g-recaptcha" data-sitekey="6LfiDxATAAAAALssDu-lX0bE7a6pOOwqWPxUojxX"></div>
                        
            
            <input type="hidden" name="token" value="Send" />
            <button type="submit" class="button">Send Message</button>
            
            
            
        </form> 
        
        
        
        
        
        </div>
    
 
</div>
        
</div><!-- end page title -->



<div class="clearfix"></div>
<div class="container feature_section107"><br /><h1 class="caps light">Learn more about <b>Web88 CMS System</b>  <a href="web88.html">Go!</a></h1></div>
@endsection

@section('custom_scripts')

    <!-- MasterSlider -->
    <link rel="stylesheet" href="{{url('').'/resources/assets/frontend/'}}js/masterslider/style/masterslider.css" />
    <link rel="stylesheet" href="{{url('').'/resources/assets/frontend/'}}js/masterslider/skins/default/style.css" />

    <!-- owl carousel -->
    <link href="{{url('').'/resources/assets/frontend/'}}js/carouselowl/owl.transitions.css" rel="stylesheet">
    <link href="{{url('').'/resources/assets/frontend/'}}js/carouselowl/owl.carousel.css" rel="stylesheet">

    <!-- accordion -->
    <link rel="stylesheet" type="text/css" href="{{url('').'/resources/assets/frontend/'}}js/accordion/style.css" />

    <!-- tabs 2 -->
    <link href="{{url('').'/resources/assets/frontend/'}}js/tabs2/tabacc.css" rel="stylesheet" />
    <link href="{{url('').'/resources/assets/frontend/'}}js/tabs2/detached.css" rel="stylesheet" />

    <!-- loop slider -->
    <link type="text/css" rel="stylesheet" href="{{url('').'/resources/assets/frontend/'}}js/loopslider/style.css">
<script>
(function($) {
 "use strict";

    $('.accordion, .tabs').TabsAccordion({
        hashWatch: true,
        pauseMedia: true,
        responsiveSwitch: 'tablist',
        saveState: sessionStorage,
    });

})(jQuery);
</script>
<script type="text/javascript">
$(document).ready(function() {

    $("#frmContact").validate({
        rules: {
            name:{
                required:true
            },
            email:{
                required:true
            },
            service:{
                required:true
            },
            company:{
                required:true
            },
            phone:{
                required:true
            },
            website:{
                required:true
            },
            message:{
                required:true
            }
        },
        messages: {
            name:{
                required:"Enter the name"
            },
            email:{
                required:"Enter the email"
            },
            service:{
                required:"Select the service"
            },
            company:{
                required:"Enter the company"
            },
            phone:{
                required:"Enter the contact number"
            },
            website:{
                required:"Enter the subject"
            },
            message:{
                required:"Enter the message"
            }
        },
        errorClass: 'help-block',
        errorElement: 'span',
        highlight: function (element) {
           $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
           $(element).closest('.form-group').removeClass('has-error');
        },
        errorPlacement: function (error, element) {
            if (element.attr("data-error-container")) {
                error.appendTo(element.attr("data-error-container"));
            } else {
                error.insertAfter(element);
            }
        }
    });
    
    $(document).on('submit','#frmContact',function(){
        if($("#frmContact").valid()){
            return true;
        }else{
            return false;
        }
    });
});
</script>
@endsection

