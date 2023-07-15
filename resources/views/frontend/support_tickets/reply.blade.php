@extends('layouts.frontend_layout')
@section('title','Reply Ticket | - Webqom Technologies')
@section('page_header','Client Area')
@section('breadcrumbs','Reply Ticket')
@section('content')



<div class="clearfix"></div>

<style>
	#lbl_err{
		text-align:center;
		color:red !important;
		display:none;
	}
	.st-accordion-five ul li > a {
		font-size: 18px;
		color: #31708F;
		display: block;
		position: relative;
		line-height: 46px;
		/* padding-left: 46px; */
		padding-left: 15px;
		font-weight: 700;
		outline: none;
		-webkit-transition: color 0.2s ease-in-out;
		-moz-transition: color 0.2s ease-in-out;
		-o-transition: color 0.2s ease-in-out;
		-ms-transition: color 0.2s ease-in-out;
		transition: color 0.2s ease-in-out;
		background-color: #D9EDF7;
	}	
	.st-accordion-five ul li > a span {
    background: transparent url(/resources/assets/img/plus-gray.png) no-repeat center center;
    text-indent: -9000px;
    width: 26px;
    height: 16px;
    position: absolute;
    top: 50%;
    right: 0px;
    /* left: 0px; */
    margin-top: -8px;
    /* margin-left: 16px; */
    margin-right: 10x;
    opacity: 1;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}
.st-accordion-five ul li.st-open > a span {
    background: transparent url(/resources/assets/img/minus-gray.png) no-repeat center center;
    right: 0px;
    opacity: 1;
    margin-top: -8px;
}
</style>
<div class="page_title1 sty9">
<div class="container">

	<h1>Support</h1>
    <div class="pagenation">&nbsp;<a href="/">Home</a> <i>/</i> <a href="/dashboard">Dashboard</a> <i>/</i> <a href="/support_tickets">Support Tickets</a> <i>/</i> View Ticket</div>
 
</div>	    
</div><!-- end page title -->

<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>

 <div class="one_full stcode_title9">
 	<h1 class="caps"><strong>View Ticket</strong></h1>
 </div>

<div class="clearfix"></div>

<div class="content_fullwidth">
	<div class="container">
    
    	@include("frontend._left_br_logged_in", array('status_filter' => 'ticket_reply')) 

        <div class="three_fourth_less last">
        @if($ticket->status == 'Closed')
            <div class="alertymes6">
                <h3 class="light"><i class="fa fa-times-circle"></i><strong>This ticket is Closed.</strong>
                <br/>You may reply to this ticket to reopen it.</h3>
            </div><!-- end section -->
        @endif
            <div class="clearfix margin_bottom2"></div>
        
        	<div id="st-accordion-five" class="st-accordion-five">
        
                <ul>
                
                    <li>
                        <a href="#"><i class="fa fa-pencil"></i> Reply Ticket<span class="st-arrow"> Open or Close</span></a>
                        <div class="st-content">
                            <div class="cforms alileft">
     
                                <div id="form_status"></div>
                                <form method="POST" id="gsr-contact" action="reply_store"  enctype="multipart/form-data">
									{{csrf_field()}}
									<input type="hidden" name="update_id" value="{{$_GET['id']}}">
                                    <!-- business account / business partner account start -->
                                    <div class="one_half">
                            
                                        <label><b>Name</b> </label>
                                        <input type="text" name="name" id="name" value="{{$user->client->first_name." ".$user->client->last_name}}" disabled="disabled">
                                        
                                        <label><b>Company</b> </label>
                                        <input type="text" name="name" id="name" value="{{$user->client->company}}"  disabled="disabled">

                                    </div>
                                    <!-- end one half -->
                                    
                                    
                                    <div class="one_half last">
                                                       
                                        <label><b>Email Address</b> </label>
                                        <input type="text" name="email" id="email"  value="{{$user->email}}"  disabled="disabled">
                                        
                                        <label><b>Client ID</b> </label>
                                        <input type="text" name="client_id" id="client_id"  value="{{$user->client->client_id}}"  disabled="disabled">
                                    
                                    </div>
                                    <!-- end one half last -->
                                    
                                    <label><b>Domain</b> </label>
                					<input type="text" name="domain" value="{{$ticket->domain}}" id="domain" >
                                    
                                    <div class="clearfix"></div>
                                    <div class="divider_line7"></div>
                                    <div class="clearfix"></div>
                                    
                                    <label><b>Message</b> </label>
                                    <textarea name="message" id="message" rows="12"></textarea>
                                    
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
                                    <label id="lbl_err">Message is required.</label>
                                    <div class="alicent">
                                        <a href="javascript:submitThis()" class="btn btn-danger caps"><i class="fa fa-send"></i> <b>Submit</b></a>&nbsp;<a href="#" class="btn btn-primary caps"><i class="fa fa-ban"></i> <b>Cancel</b></a>
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                </form>	 
                                
                                </div><!-- end cf form-->
                                
        
                        </div>
                    </li>

                </ul>
            </div><!-- end reply form panel -->
            
            <div class="clearfix"></div>
            
            
            
       @if(isset($threads)) 
			@foreach($threads as $thread)
			   <div class="panel1 panel-default">
				   <div class="ticket-reply staff">
						<div class="date">{{date_format(date_create($thread->created_date), "dS M Y H:i")}} </div>
						<div class="user">
							<img src='/resources/assets/admin/images/profile/image_hock.jpg' alt="Webqom Technologies">
							@if($thread->replied_by == 0)
								<span class="name">{{$user->client->first_name}}</span>
								<span class="type">Client</span>
							@else
								<span class="name">Webqom Support Team</span>
								<span class="type">Staff</span>	
							@endif
						</div>
					</div>
					<div class="panel-body">
						<p>{{$thread->msg}}</p>
					</div>
					<?php
					$attachments = json_decode($thread->thumbnail);
					?>
					<div class="ticket-reply attachments">
						<strong>Attachments ({{count($attachments)}})</strong>
						<ul>
							@if(count($attachments) > 0)
								@foreach($attachments as $attachment)
									<li><i class="fa fa-file-o"></i> <a href="/public_html/images/ticket_attachments/{{$attachment}}">{{$attachment}}</a></li>
								@endforeach
							@endif
						</ul>
					</div>
					
			   </div><!-- end webqom support panel -->
			@endforeach
		@endif        
           
           <div class="clearfix"></div>
            <div class="divider_line7"></div>
            <div class="clearfix"></div>
            <div class="alicent">
                 <a href="/support_tickets" class="btn btn-default caps"><i class="fa icon-action-undo"></i> <b>Back</b></a>&nbsp;
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
<!-- get jQuery used for the theme -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
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

	$(document).ready(function() {
			$('.menu-link').menuFullpage();
	});
	$('#addMoreUpload').click(function(){
		if($('[name="attachment[]"]').length<=10)
		{ 
			str = '<input class="exampleInputFile1" name="attachment[]" type="file"/>';
			$('#append_div').append(str);
			$('.panel-default').css('margin-top', '50px');
		}else{
			alert('Max 10 images can selected');
		}
	});
	function submitThis(){
		if($('#message').val().trim() == ''){
			$('#lbl_err').show();
		}else{
			$('#gsr-contact').submit();
		}
	}
</script>

<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
