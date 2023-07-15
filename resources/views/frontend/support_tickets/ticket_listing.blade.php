@extends('layouts.frontend_layout')
@section('title','Support Tickets | - Webqom Technologies')
@section('page_header','Client Area')
@section('breadcrumbs','Support Tickets')
@section('content')

<div class="clearfix"></div>

<div class="page_title1 sty9">
<div class="container">

	<h1>Support</h1>
    <div class="pagenation">&nbsp;<a href="/">Home</a> <i>/</i> <a href="/dashboard">Dashboard</a> <i>/</i> <a href="javascript:void(0)">Support Tickets</a> </div>
 
</div>	    
</div>
<!-- end page title -->

<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>

 <div class="one_full stcode_title9">
    	<h1 class="caps"><strong>My Support Tickets </strong>    	</h1>
    </div>

<div class="clearfix"></div>


<div class="content_fullwidth">

    <div class="container">
    	@include("layouts.frontend_menu_login", array('status_filter' => 'ticket'))
      {{-- @include("frontend._left_br_logged_in", array('status_filter' => 'ticket')) --}} 
    	<div class="three_fourth_less last">
        
           <div class="text-18px dark light">Submit and track any enquiries with us here.</div>
           <div class="clearfix margin_bottom1"></div>
           
           <div class="one_half_less">
               <h4>Search</h4>
               <div class="cforms aliright">
                	<input type="text" id="name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '';?>" placeholder="Search by Ticket # or Subject">    
               		<a href="javascript:search_txt()" class="btn btn-danger caps"><i class="fa fa-search"></i> <b>Search</b></a>
               </div><!-- end cforms -->
           </div><!-- end one half less -->
           <div class="clearfix"></div>
           <div class="divider_line7"></div>
           <?php
           //~ echo "<pre>";print_r($data->total());
           //~ echo "<pre>";print_r($data);die;
           ?>
           <div class="one_half_less">
           	  <a href="support_tickets/create" class="btn btn-danger caps"><i class="fa fa-plus"></i> <b>Open New Ticket</b></a>
           </div><!-- end one half less -->
           <?php $i = (($data->currentPage() - 1)*10)+1;?>
           <div class="one_half_less aliright last">
           	  {{$data->total()}} record(s) found. Items {{$i}}-{{($data->total()>$i+9) ? $i+9 : $data->total()}} out of {{$data->total()}} displayed
           </div><!-- end one half less -->
           
           <div class="clearfix margin_bottom1"></div>
               @if($data->total() == 0)
					<div class="table-responsive">
					  <table class="table table-hover table-striped">
						<thead>
						  <tr>
							<th>Ticket #</th>
							<th>Department</th>
							<th>Subject</th>
							<th>Last Updated</th>
							<th>Status</th>
							<th></th>
						  </tr>
						</thead>
						<tbody>

						  <tr>
							<td colspan="6">No records found.</td> 
						  </tr>
						  
						</tbody>
						<tfoot>
						  <tr>
							<td colspan="6"></td>
						  </tr>
						</tfoot>
					  </table>
					  <div class="clearfix"></div>  
					</div>
                @endif
                @if($data->total() > 0)
                <div class="table-responsive">
                      <table class="table table-hover table-striped">
                        <thead>
                          <tr>
							  <?php
								$order = isset($_GET['order']) && ($_GET['order'] == 'asc') ? 'desc': 'asc'; 
							  ?>
                            <th><span class="pull-left">Ticket #</span> <a href="javascript:search_txt('ticket_id', '{{$order}}' )" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                            <th><span class="pull-left">Department</span> <a href="javascript:search_txt('department', '{{$order}}' )" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                            <th><span class="pull-left">Subject</span> <a href="javascript:search_txt('subject', '{{$order}}' )" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                            <th><span class="pull-left">Last Updated</span> <a href="javascript:search_txt('updated_date', '{{$order}}' )" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                            <th><span class="pull-left">Status</span> <a href="javascript:search_txt('status', '{{$order}}' )" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
						<?php
						$dept_arr = array(
							1 => 'Sales Department',
							2 => 'Technical Support',
							3 => 'Billing Department'
						);
						?>
						@foreach($data as $d)
                          <tr>
                            <td>{{$d->ticket_id}}</td>
                            <td>{{isset($dept_arr[$d->department]) ? $dept_arr[$d->department] : '--'}}</td>
                            <td>{{$d->subject}}</td>
                            <td>{{date_format(date_create($d->updated_date), "dS M Y H:i")}}</td>
                            <?php
                            if($d->status == 'Open')
								$class = 'label-success';
							else if($d->status == 'Closed')	
								$class = 'label-default ';
                            else if($d->status == 'Answered')	
								$class = 'label-danger';
                            else if($d->status == 'Client-Reply')	
								$class = 'label-warning';
                            ?>
                            <td><a href="javascript:void(0)"><span class="label {{$class}} caps">{{$d->status}}</span></a></td>
                            <td class="alicent"><a href="/support_tickets/reply?id={{$d->id}}" data-hover="tooltip" data-placement="top" title="Reply Ticket">
                            @if($d->status == 'Closed')	
								<i class="fa fa-search red"></i>
                            @else
								<i class="fa fa-pencil red"></i>
                            @endif
                            </a></td>
                          </tr>
                         @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="6"></td>
                          </tr>
                        </tfoot>
                      </table>
                      <div class="clearfix"></div>
                      
                      <div class="pagination center">
                        <b>Page {{$data->currentPage()}} of {{ceil($data->total()/10)}}</b>
                        <a href="{{$data->previousPageUrl()}}" class="navlinks {{ ($data->currentPage() == 1) ? ' disabled' : '' }}">&lt; Previous</a>
							@for ($i = 1; $i <= $data->lastPage(); $i++)
                            <a href="{{ $data->url($i) }}" class="navlinks {{ ($data->currentPage() == $i) ? ' current' : '' }} ">{{$i}}</a>
							@endfor
                            <a class="navlinks {{ ($data->currentPage() == $data->lastPage()) ? ' disabled' : '' }}" href="{{$data->nextPageUrl()}}" class="navlinks">Next ></a>
                      </div><!-- /# end pagination -->
        	</div>
        	@endif
            <!-- end table responsive -->
       
       
       </div><!-- end section -->
        
        

        
	</div>  
    <!-- end container -->  
    
    
    <div class="clearfix"></div>
    
    
</div><!-- end content full width -->

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

<script type="text/javascript" src="js/universal/custom.js"></script>

<script src="js/sidemenu/menuFullpage.min.js"></script>
<script>
	smoothScroll.init();
	$(document).ready(function() {
			$('.menu-link').menuFullpage();
	});
	
	function search_txt(orderBy = 'id', order = 'asc'){
		var search = $('#name').val();
		window.location.href="/support_tickets?search="+search+"&orderBy="+orderBy+"&order="+order;
	}
</script>

@endsection
