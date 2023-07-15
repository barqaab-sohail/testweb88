@extends('layouts.frontend_layout')
@section('title','Open New Ticket | - Webqom Technologies')
@section('page_header','Client Area')
@section('breadcrumbs','Open New Ticket')
@section('content')


<div class="clearfix"></div>


<div class="page_title1 sty9">
<div class="container">

	<h1>Support</h1>
    <div class="pagenation">&nbsp;<a href="/">Home</a> <i>/</i> <a href="/dasboard">Dashboard</a> <i>/</i> <a href="/support_tickets">Support Tickets</a> <i>/</i> Open New Ticket</div>
 
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
    
    	@include("frontend._left_br_logged_in", array('status_filter' => 'ticket')) 
    	       
    	<div class="three_fourth_less last">
            <?php
            $data = explode("-",base64_decode($_GET['id']));
            ?>
            <div class="alertymes5">
                <h3 class="light"><i class="fa fa-check-circle"></i><strong>Ticket Created #{{$data[1]}}</strong>
                <br/>Your ticket has been successfully created.</h3>
           </div><!-- end section -->
           <div class="clearfix margin_bottom3"></div>
                
           <div class="text-18px dark light">Your ticket has been successfully created. An email has been sent to your address with the ticket information. If you would like to view this ticket now you can do so.</div>	
           
            <div class="clearfix"></div>
            <div class="divider_line7"></div>
            <div class="clearfix"></div>
            
            
            <div class="alicent">
                <a href="/support_tickets" class="btn btn-default caps"><i class="fa icon-action-undo"></i> <b>Back</b></a>&nbsp;
                <a href="reply?id={{$data[0]}}" class="btn btn-danger caps"><i class="fa fa-search"></i> <b>View Ticket</b></a>&nbsp;
                <a href="create" class="btn btn-danger caps"><i class="fa fa-plus"></i> <b>Open New Ticket</b></a>&nbsp;
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
</script>

<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
