@extends('layouts.frontend_layout')
@section('title','Open New Ticket | - Webqom Technologies')
@section('page_header','Client Area')
@section('breadcrumbs','Open New Ticket')
@section('content')

<div class="clearfix"></div> 


<div class="page_title1 sty9">
<div class="container">

	<h1>Support</h1>
    <div class="pagenation">&nbsp;<a href="/">Home</a> <i>/</i> <a href="/dashboard">Dashboard</a> <i>/</i> <a href="/support_tickets">Support Tickets</a> <i>/</i> Open New Ticket</div>
 
</div>	    
</div><!-- end page title -->

<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>

 <div class="one_full stcode_title9">
 	<h1 class="caps"><strong>Open New Ticket</strong></h1>
 </div>

<div class="clearfix"></div>

<div class="content_fullwidth">
	<div class="container">
        @include("layouts.frontend_menu_login", array('status_filter' => 'ticket'))
    	{{-- @include("frontend._left_br_logged_in", array('status_filter' => 'ticket')) --}}
    	<div class="three_fourth_less last">
            
            <div class="cforms alileft">
     
            <div id="form_status"></div>
            <form method="POST" id="gsr-contact" action="store" enctype="multipart/form-data">
				{{csrf_field()}}
                <!-- business account / business partner account start -->
                <div class="one_half">
        
                    <label><b>Name</b> </label>
                    <input type="text" name="" id="name" placeholder="" value="{{$user->client->first_name." ".$user->client->last_name}}" disabled="disabled">
                    
                    <label><b>Company</b> </label>
                    <input type="text" name="" id="company" placeholder="" value="{{$user->client->company}}" disabled="disabled">
                </div>
                <!-- end one half -->
                
                
                <div class="one_half last">
                                   
                    <label><b>Email Address</b> </label>
                    <input type="text" name="" id="email" placeholder="" value="{{$user->email}}" disabled="disabled">
                    
                    <label><b>Client ID</b> </label>
                    <input type="text" name="" id="email" placeholder="" value="{{$user->client->client_id}}" disabled="disabled">
                
                </div>
                <!-- end one half last -->
                
                
                <div class="clearfix"></div>
                
                <div class="divider_line7"></div>
                
                
                <div class="clearfix"></div>
                
                 <div class="one_third">
                    <label><b>Department</b> <em>*</em></label>
                    <label class="input">
                        <select name="department" required>
                            <option value="0">-- Please select --</option>
                            <option value="1">Sales Department</option>
                            <option value="2">Technical Support</option>
                            <option value="3">Billing Department</option> 
                        </select>
                    </label>
    
                </div>
                <!-- end one third -->
                
                <div class="one_third">
                    <label><b>Related Service</b> <em>*</em></label>
                    <label class="input">
                        <select name="related_service" required>
                            <option value="0">-- Please select --</option>
                            <option value="1">Email Issues</option>
                            <option value="2">Cloud Hosting</option>
                            <option value="3">Co-location Hosting</option>
                            <option value="4">Dedicated Servers</option> 
                            <option value="5">Reseller Hosting</option>
                            <option value="6">Shared Hosting</option>
                            <option value="7">VPS Hosting</option>
                            <option value="8">Business Partner Program</option>
                            <option value="9">Domain</option>
                            <option value="10">E-commerce</option>
                            <option value="11">Email88</option>
                            <option value="12">Mobile &amp; Web Apps</option>
                            <option value="13">Responsive Web Design</option>
                            <option value="14">SEO</option>
                            <option value="15">Social Media</option>
                            <option value="16">SSL</option>
                            <option value="17">Web88 CMS</option>
                            <option value="18">Web88IR</option>
                        </select>
                    </label>              
                    
                </div>
                <!-- end one third -->
                
                <div class="one_third last">
                    
                    <label><b>Priority</b> </label>
                    <label class="input">
                        <select name="priority" required>
                            <option value="1">High</option>
                            <option value="2" selected="selected">Medium</option>
                            <option value="3">Low</option> 
                        </select>
                    </label>
    
                </div>
                <!-- end one third last -->
                <div class="clearfix"></div>
               
                <label><b>Domain</b> <em>*</em></label>
                <input type="text" name="domain" required id="domain">
                
                
                <label><b>Subject</b> <em>*</em></label>
                <input type="text" name="subject" required id="subject">
                
                <label><b>Message</b><em>*</em> </label>
                <textarea name="message" id="message" required rows="12"></textarea>
                
                <label><b>Attachments</b> (Allowed File Extensions: .jpg, .gif, .jpeg, .png)</label>
                <div id="append_div">
					<input id="exampleInputFile1"  name="attachment[]" type="file"/>
				</div>
                <div class="col-sm-3">
                	<a href="javascript:void(0)" id="addMoreUpload" class="btn-sm btn-success"><i class="fa fa-plus"></i> Add More</a>
                </div>
               
                <div class="clearfix"></div>
                <div class="divider_line7"></div>
                <div class="clearfix"></div>
                <!-- end open new ticket -->
                 
               
                <div class="clearfix"></div>
                <label id="cap-tch"><b>Please enter the reCaptcha</b></label>
                <div class="g-recaptcha margin_bottom3" data-sitekey="6LfiDxATAAAAALssDu-lX0bE7a6pOOwqWPxUojxX"></div>
                
                
                <div class="clearfix"></div>
                <div class="divider_line7"></div>
                <label class='err-lbl'>Some required fields are missing</label>
                <div class="clearfix"></div>
                <div class="alicent">
                    <a href="javascript:void(0)" class="btn btn-danger submit_form caps"><i class="fa fa-send"></i> <b>Submit</b></a>&nbsp;<a href="/support_tickets" class="btn btn-primary caps"><i class="fa fa-ban"></i> <b>Cancel</b></a>
                </div>
                
            </form>	 
            
            </div>
            
        </div><!-- end section -->
    
    

    </div>
</div><!-- end content fullwidth -->

<div class="clearfix"></div>
<div class="divider_line"></div>


<div class="clearfix"></div>





<div class="clearfix"></div>


<a href="#" class="scrollup">Scroll</a><!-- end scroll to top of the page-->


</div>

    
<!-- ######### JS FILES ######### -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<!-- get jQuery used for the theme -->
<script type="text/javascript" src="js/universal/jquery.js"></script>
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
<script src="js/progressbar/progress.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/universal/custom.js"></script>

<script src="js/sidemenu/menuFullpage.min.js"></script>
<script>
	//smoothScroll.init();
	$(document).ready(function() {
		$('.menu-link').menuFullpage();
	
		$('.submit_form').click(function(){
			var flag = 1;
			$('.err-cls').removeClass('err-cls');
			$('.err-lbl').hide();
			if($('[name="department"]').val() == 0)
			{
				$('[name="department"]').parent('label').addClass('err-cls');
				flag = 0;
			}
			if($('[name="related_service"]').val() == 0)
			{
				$('[name="related_service"]').parent('label').addClass('err-cls');
				flag = 0;
			}
			if($('[name="priority"]').val() == 0)
			{
				$('[name="priority"]').parent('label').addClass('err-cls');
				flag = 0;
			}
			if($('[name="domain"]').val().trim() == '')
			{
				$('[name="domain"]').addClass('err-cls');
				flag = 0;
			}
			if($('[name="subject"]').val().trim() == '')
			{
				$('[name="subject"]').addClass('err-cls');
				flag = 0;
			}
			if($('[name="message"]').val().trim() == '')
			{
				$('[name="message"]').addClass('err-cls');
				flag = 0;
			}
			
			if(flag == 1)
			{
				if (grecaptcha.getResponse() == ""){
					$('#cap-tch').css('color', 'red');
					return false;
				}else{
					$('#gsr-contact').submit();
				} 
			}else{
				$('.err-lbl').show();
			}
			//
		});
		
		$('#addMoreUpload').click(function(){
			if($('[name="attachment[]"]').length<=10)
			{
				str = '<input class="exampleInputFile1" name="attachment[]" type="file"/>';
				$('#append_div').append(str);
			}else{
				alert('Max 10 images can selected');
			}
		});
	});
	
</script>
<style>
	.err-cls {
		border: 2px solid red !important;
	}
	.err-lbl{
		color:red !important;
		text-align:center;
		display:none;
	}
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>

@endsection
