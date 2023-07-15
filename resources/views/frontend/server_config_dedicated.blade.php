@extends('layouts.frontend_layout')
@section('title','Home | - Webqom Technologies')
@section('content')

    <div class="page_title1 sty9">
        <div class="container">

	        <h1>Order</h1>
            <div class="pagenation">&nbsp;<a href="/">Home</a> <i>/</i> <a href="/services/dedicated_servers">Dedicated Servers</a> <i>/</i> Configure Your Server</div>
            <div class="clearfix"></div>
 
        </div>	    
    </div><!-- end page title -->

    <div class="clearfix"></div>
    <div class="clearfix margin_bottom5"></div>

    <div class="one_full stcode_title9">
 	    <h1 class="caps"><strong>Configure Your Servers</strong></h1>
    </div>

    <div class="clearfix"></div>
    <div class="content_fullwidth">
        @if(!empty(request('search_domain')))
	    <form action="{{url('domain_configuration_hosting?search_domain='.request('search_domain'))}}" method="post">
        @else
        <form action="{{url('domain_configuration_hosting')}}" method="post">

        @endif

            {{csrf_field()}}
            <div class="container">
                <div class="two_third_less">
                    <div class="row">
    					
                        @foreach($data as $key => $plan)
                            <div class="col-md-6">
                                <div class="one_half_less last">
               	  	            <h4>{{ $key }}</h4>
               	  	            @foreach($plan as $p)
               		            <div>
                    	                <input type="radio" checked class='onchangeEvent' data-id="{{$key}}" name="{{ $key }}" value="{{ $p->plan_feature_id }}"> {{ $p->description }}
                                        <div class="clearfix"></div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="divider_line7"></div>
                            </div>

                        @endforeach
                    </div>
                </div>
                <div class="one_third_less last">
              	    <div class="alertymes7">
                        <h2 class="aliright">Order Summary</h2>
                        <div class="divider_line"></div>
                        <div class="clearfix margin_bottom1"></div>
                        <h4>Your Dedicated Server Plan:</h4>
                        <input type="hidden" name="plan_id" value="{{ $plans->id}}">
                        <input type="hidden" name="page_name" value="dedicated servers">
                        <input type="hidden" name="dedicated_server_plan" value="{{$plans->plan_name}}">
                        <div class="text-16px light sitecolor caps">{{$plans->plan_name}}</div>
                        <div class="clearfix margin_bottom1"></div>
                     
                        <h4>Service Code:</h4> 
                        <input type="hidden" name="dedicated_service_code" value="{{$plans->service_code}}">
                        <div class="text-16px light sitecolor caps">{{$plans->service_code}}</div>
                        <div class="clearfix margin_bottom1"></div>
                     
                        <h4>Your Configuration:</h4>
                        <ul>
    						@if(count($featured_plans)>0 && count($plans)>0)
    							@foreach($featured_plans as $i)					
    								@php
    								$details = App\Models\PlanFeatureDetail::where('plan_feature_id', $i->id)->where('plan_id', $plans->id)->first();
    								@endphp
    								@if ($details)
    								<li>{{$i->title}}:
    									<span data-sel="{{$i->title}}">{{ $details->description }}</span>
    								</li>
    								@endif
    							@endforeach
    						@endif
                        </ul>
                        <input type="hidden" name="sub_total" value="{{$plans->price_annually}}">
                        <input type="hidden" name="initial_setup_price" value="{{ $plans->setup_fee_one_time }}">
                        <div class="pull-left caps"><b>Subtotal</b></div>
                        <div class="pull-right"><b>RM {{$plans->price_annually}}/yr</b></div>
                        <div class="clearfix"></div>
                        <div class="pull-left caps"><b>Initial Setup</b></div>
                        <div class="pull-right"><b>RM {{$plans->setup_fee_one_time}} </b></div>
                        <div class="clearfix"></div>
                        <div class="divider_line"></div>

                        <div class="clearfix margin_bottom2"></div>
                        <h2 class="red aliright" style="margin-bottom: 0px;"><b>RM {{number_format((float)$plans->price_annually+$plans->setup_fee_one_time, 2, '.', '')}}</b></h2><span class="pull-right red caps aliright">Total</span>
                        <div class="clearfix margin_bottom2"></div>
                        <button type="submit" class="btn btn-lg btn-danger caps pull-right"><i class="fa fa-lg fa-arrow-circle-right"></i> <b>Continue</b></button>
                        <!-- <a href="{{url('domain_configuration_hosting')}}" class="btn btn-lg btn-danger caps pull-right"><i class="fa fa-lg fa-arrow-circle-right"></i> <b>Continue</b></a> -->
                     
    			    </div> 
                </div><!-- end one half less last -->
            </div>
        </form>
    </div><!-- end content fullwidth -->

    <div class="clearfix"></div>
    <div class="divider_line"></div>
    <div class="clearfix"></div>
</div>

    
<!-- ######### JS FILES ######### -->
<!-- get jQuery used for the theme -->
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/universal/jquery.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/universal/jquery.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/animations/js/animations.min.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/mainmenu/bootstrap.min.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/mainmenu/customeUI.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/masterslider/jquery.easing.min.js" ></script>

<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/scrolltotop/totop.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/mainmenu/sticky.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/mainmenu/modernizr.custom.75180.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/cubeportfolio/jquery.cubeportfolio.min.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/cubeportfolio/main.js" ></script>

<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/aninum/jquery.animateNumber.min.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/carouselowl/owl.carousel.js" ></script>

<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/accordion/jquery.accordion.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/accordion/custom.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/cform/form-validate.js" >
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/universal/custom.js" ></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/sidemenu/menuFullpage.min.js" ></script>
<script>
	smoothScroll.init();
	$(document).ready(function() {
			$('.menu-link').menuFullpage();
			
			$('.onchangeEvent').click(function(){
				var id = $(this).attr('data-id');
					current_val = $(this).val();
				$('[data-sel ='+id+']').text(current_val);
			});
	});
</script>

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
@endsection
