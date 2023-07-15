﻿<?php use App\Http\Controllers\Frontend\IndexController;
$categories=IndexController::get_categories();
$cart_items=IndexController::get_cart_items();
?>

<!DOCTYPE html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-gb" class="no-js">
<!--<![endif]-->
  <head>
    <title>@yield('title')</title>
    <?php $user=Auth::user(); ?>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="web hosting, domain names, web site, search engine optimization, hosting, servers" />
    <meta name="description" content="Webqom is an established Malaysia web hosting company with 10 years of experience and expertise in providing high performance and most reliable web hosting, email hosting, reseller hosting, VPS, dedicated servers, SSL and .my domain registration at affordable price." />


    <!-- Favicon -->
    <link rel="shortcut icon" href="{{url('').'/resources/assets/frontend/'}}images/favicon.png">

    <!-- this styles only adds some repairs on idevices  -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet"> 


    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- ######### CSS STYLES ######### -->

    <link rel="stylesheet" href="{{url('').'/resources/assets/frontend/'}}css/reset.css" type="text/css" />
    <link rel="stylesheet" href="{{url('').'/resources/assets/frontend/'}}css/style.css" type="text/css" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="{{url('').'/resources/assets/frontend/'}}css/font-awesome/css/font-awesome.min.css">

    <!-- simple line icons -->
    <link rel="stylesheet" type="text/css" href="{{url('').'/resources/assets/frontend/'}}css/simpleline-icons/simple-line-icons.css" media="screen" />

    <!-- animations -->
    <link href="{{url('').'/resources/assets/frontend/'}}js/animations/css/animations.min.css" rel="stylesheet" type="text/css" media="all" />

    <!-- responsive devices styles -->
    <link rel="stylesheet" media="screen" href="{{url('').'/resources/assets/frontend/'}}css/responsive-leyouts.css" type="text/css" />

    <!-- shortcodes -->
    <link rel="stylesheet" media="screen" href="{{url('').'/resources/assets/frontend/'}}css/shortcodes.css" type="text/css" />


    <!-- mega menu -->
    <link href="{{url('').'/resources/assets/frontend/'}}js/mainmenu/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('').'/resources/assets/frontend/'}}js/mainmenu/demo.css" rel="stylesheet">
    <link href="{{url('').'/resources/assets/frontend/'}}js/mainmenu/menu.css" rel="stylesheet">

    <!-- side menu -->
    <link type="text/css" rel="stylesheet" href="{{url('').'/resources/assets/frontend/'}}js/sidemenu/style.css">

    <link type="text/css" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    @yield('custom_style')

    <style type="text/css">
        .select_height{
            height: 39px;
        }
    </style>

</head>

<body>
<style type="text/css">

    #overlay {
        display: none;
        opacity:    0.5;
        background: #000;
        width:      100%;
        height:     100%;
        z-index:    10;
        top:        0;
        left:       0;
        position:   fixed;
    }
    #img-load {
        width: 50px;
        height: 57px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -28px 0 0 -25px;
    }
</style>

<div id="overlay">
    <img src="{{url('').'/resources/assets/frontend/images/loading.svg'}}"
         id="img-load" />
</div>
<div class="site_wrapper">

    <div class="top_nav">
        <div class="container">

            <div class="left">

                <!--<div class="select-style">
                  <select>
                    <option value="language">Language</option>
                    <option value="english">English</option>
                  </select>
                </div>-->

           </div>
			<!-- end left -->

            <div class="right">
                <?php $pic=url('').'/resources/assets/admin/images/profile/image_hock.jpg'; ?>
                <a href="{{url('/shopping_cart')}}" class="tpbut two"><i class="fa fa-cart-plus"></i>&nbsp; <span id="cart_item_id">{{$cart_items}}</span></a>
                @if(!$user)
                    <a href="{{url('/register')}}" class="tpbut three"><i class="fa fa-edit"></i>&nbsp; FREE Sign Up</a>
                    <a href="{{url('/login')}}" class="tpbut"><i class="fa fa-user"></i>&nbsp; Login</a>
                @else
                    <?php $pic=url('').'/resources/assets/admin/images/profile/image_hock.jpg';
                    if($user->profile_pic!=''){
                        $pic=$user->profile_pic;
                    } ?>
                    <a href="javascript:void(0)" id="logout" class="tpbut"><img src="{{url('').'/resources/assets/admin/images/profile/image_hock.jpg'}}">&nbsp;{{$user->client->first_name or "Admin"}}, Logout</a>
                @endif

                <ul class="tplinks">
                    @if($user and $user->role == 'Client')
                    <li><a href="{{ route('frontend.client_dashboard') }}">Dashboard</a></li>
                    @endif
                    <li><a href="#"><img src="{{url('').'/resources/assets/frontend/'}}images/site-icon2.png" alt="Live Chat" /> Live Chat</a></li>
                    <li><a href="/support_tickets"><img src="{{url('').'/resources/assets/frontend/'}}images/site-icon3.png" alt="Support" /> Support</a></li>
                </ul>

            </div>
            <!-- end right -->

        </div>
    </div>

	<!-- end top navigation links -->
    @if (Route::getCurrentRoute()->uri()=="services/dedicated_servers" || Route::getCurrentRoute()->uri() == "domain_transfer_login" || Route::getCurrentRoute()->uri() == "domain_search_login" || Route::getCurrentRoute()->uri() == "bulk_domain_search_login" || Route::getCurrentRoute()->uri() == "domain_register_new_login" || Route::getCurrentRoute()->uri() == "domain_domain_renewal" || Route::getCurrentRoute()->uri() == "my_account" || Route::getCurrentRoute()->uri() == "login" || Route::getCurrentRoute()->uri() == "domain_configuration_hosting")

    <div class="clearfix">
        <div class="page_title1 sty9">
            <div class="container">
                <h1>@yield('page_header')</h1>
                <div class="pagenation">&nbsp;<a href="{{url('')}}">Home</a> <i>/</i>
                    @yield('breadcrumbs')
                    @if(!empty($breadcrumbs))
                    @foreach($breadcrumbs as $i)
                  @if($i['url']!=false)<a href="{{$i['url']}}" ><span style="text-transform: capitalize;">{{$i['name']}}</span></a> /@endif
                  @if($i['url']==false)<span style="text-transform: capitalize;">{{$i['name']}}</span>
                  @if(!$loop->last)/@endif
                  @endif
                @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
    @endif
    <div class="clearfix"></div>


    <header class="header">

        <div class="container">

            <!-- Logo -->
            <div class="logo"><a href="{{url('/')}}" id="logo"></a></div>

            <!-- Navigation Menu -->
            <div class="menu_main">

                <div class="navbar yamm navbar-default">

                    <div class="navbar-header">
                        <div class="navbar-toggle .navbar-collapse .pull-right " data-toggle="collapse" data-target="#navbar-collapse-1"  >
                            <button type="button" > <i class="fa fa-bars"></i></button>
                        </div>
                    </div>

                    <div id="navbar-collapse-1" class="navbar-collapse collapse pull-right">

                        <nav>

                            <ul class="nav navbar-nav">


                                @if(!empty($categories))
                                    @foreach($categories as $i)
                                        @if($i->title=='Home')
                                        @else

                                            <li class="dropdown yamm-fw"><a href="{{url('/services/'.$i->slug)}}" class="dropdown-toggle">{{$i->title}}</a>
                                                @if(count($i->childs)>0)
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <div class="yamm-content">
                                                                <div class="row">

                                                                    <div class="mega-menu-contnew">
                                                                        @foreach($i->childs as $child)
                                                                            <div class="section-box">
                                                                                @foreach($child as $j)
                                                                                    <a href="{{url('/services/'.$j->slug)}}"><i class="<?php echo isset($j->icon) ? $j->icon : 'fa fa-cloud' ?>"></i> <strong>{{$j->title}}</strong> {{$j->description}}</a>
                                                                                    <p class="clearfix margin_bottom2"></p>
                                                                                @endforeach

                                                                            </div><!-- -->
                                                                        @endforeach
                                                                        <ul class="col-sm-6 col-md-3 last list-unstyled">
                                                                            <li>
                                                                                <div class="menu-sepbox">


                                                                                    <div class="owl-carousel navigation-owl">

                                                                                        @if(!empty($i->category_images))
                                                                                            @foreach($i->category_images as $image)
                                                                                                <a href="{{$image->url}}"><img src="{{ url('/storage/categories/images/'.$image->image) }}" alt="{{$image->image_alt_text}}" /></a>

                                                                                            @endforeach
                                                                                        @endif
                                                                                    </div>

                                                                                </div>
                                                                            </li>
                                                                        </ul>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                @endif
                                            </li>

                                        @endif
                                    @endforeach
                                @endif
                            </ul>

                        </nav>

                    </div>

                </div>
            </div>
            <!-- end Navigation Menu -->


        </div>

    </header>

    <!-- page contents here -->
    @yield('content')
    <footer>

        <div class="footer" style="margin-top: 20px ">

            <div class="ftop">
                <div class="container">

                    <div class="left">
                        <h4 class="caps light"><strong>Need Help?</strong> Chat with us:</h4>
                        <h1 class="caps"><a href="#">Live Chat <i class="fa fa-comments-o"></i></a></h1>
                    </div><!-- end left -->

                    <div class="right">
                        <p>Sign up for our great deals</p>
                        <!-- <form method="get" action="index.html"> -->
                            <input class="newsle_eminput" name="email" id="email_news" value="Please enter your email..." onFocus="if(this.value == 'Please enter your email...') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Please enter your email...';}" type="emal" required="">
                            <input name="" value="Sign Up" class="input_submit_newsletter input_submit" type="submit">
                        <!-- </form> -->
                    </div><!-- end right -->
                </div>
            </div>
            <!-- end top section -->

            <div class="clearfix"></div>

            <div class="secarea">
                <div class="container">

                    <div class="one_fifth">
                        <h4 class="white">Hosting Packages</h4>
                        <ul class="foolist">
                            @php
                                $hosting_children = \App\Http\Controllers\Frontend\IndexController::get_children_by_parent_slug('hosting');
                            @endphp
                            @foreach($hosting_children as $child)
                                <li><a href="{{url('/services/'.$child->slug)}}">{{ $child->title }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- end section -->

                    <div class="one_fifth">
                        <h4 class="white">Applications</h4>
                        <ul class="foolist">
                            @php
                                $applications_children = \App\Http\Controllers\Frontend\IndexController::get_children_by_parent_slug('applications');
                            @endphp
                            @foreach($applications_children as $child)
                                <li><a href="{{url('/services/'.$child->slug)}}">{{ $child->title }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- end section -->

                    <div class="one_fifth">
                        <h4 class="white">Services</h4>
                        <ul class="foolist">
                            @php
                                $services_children = \App\Http\Controllers\Frontend\IndexController::get_children_by_parent_slug('ssl_certificates');
                            @endphp
                            @foreach($services_children as $child)
                                <li><a href="{{url('/services/'.$child->slug)}}">{{ $child->title }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- end section -->

                    <div class="one_fifth">
                        <h4 class="white">Business Partner</h4>
                        <ul class="foolist">
                            <li><a href="business_partner.html">Business Partner Program</a></li>
                            <li><a href="registration.html">Sign Up Today!</a></li>
                        </ul>
                    </div><!-- end section -->

                    <div class="one_fourth last aliright">
                        <div class="address">
                            <img src="{{url('').'/resources/assets/frontend/'}}images/index/logo_footer.png" alt="Webqom Technologies Sdn Bhd" />
                            <br /><br />
                            B2-2-2, Solaris Dutamas, No. 1, Jalan Dutamas 1, 50480 Kuala Lumpur, Wilayah Persekutuan, Malaysia.
                            <div class="clearfix margin_bottom1"></div>
                            <strong>Phone:</strong> <b>+603-8688 3850</b>
                            <br />
                            <strong>Mail:</strong> <a href="mailto:enquiry@webqom.com">enquiry@webqom.com</a>
                            <br /><br/>
                            <img src="{{url('').'/resources/assets/frontend/'}}images/payment-logos.png" alt="" />

                        </div>

                    </div><!-- end section -->


                    <!--<div class="clearfix margin_bottom3"></div>-->

                    <div class="one_fifth">
                        <h4 class="white">Company</h4>
                        <ul class="foolist">
                            <li><a href="about_us.html">About Us</a></li>
                            <li><a href="{{ route('frontend.articles.index') }}">Blog</a></li>
                            <li><a href="careers.html">Careers</a></li>
                            <li><a href="data_center.html">Data Center</a></li>
                        </ul>
                    </div><!-- end section -->


                    <div class="one_fifth">
                        <h4 class="white">Support</h4>
                        <ul class="foolist">
                            <li><a href="/support_tickets">Support Center</a></li>
                            <li><a href="#">Live Chat</a></li>
                            <li><a href="/support_tickets/create">Submit Ticket</a></li>
                        </ul>
                    </div><!-- end section -->

                    <div class="one_fifth">
                        <h4 class="white">Contacts</h4>
                        <ul class="foolist">
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>
                        {{--<ul class="foolist">
                            @php
                                $contacts_children = \App\Http\Controllers\Frontend\IndexController::get_children_by_parent_slug('contact');
                            @endphp
                            @foreach($contacts_children as $child)
                                <li><a href="{{url('/services/'.$child->slug)}}">{{ $child->title }}</a></li>
                            @endforeach
                        </ul>--}}
                    </div><!-- end section -->

                    <div class="one_fifth">
                        <h4 class="white">Follow Us</h4>
                        <ul class="foosocial">
                            <li class="faceboox animate" data-anim-type="zoomIn" data-anim-delay="100"><a href="http://www.facebook.com/webqomtechnologies"><i class="fa fa-facebook"></i></a></li>
                            <li class="twitter animate" data-anim-type="zoomIn" data-anim-delay="150"><a href="https://twitter.com/webqom"><i class="fa fa-twitter"></i></a></li>
                            <li class="youtube animate" data-anim-type="zoomIn" data-anim-delay="200"><a href="https://www.youtube.com/user/Webqom"><i class="fa fa-youtube-play"></i></a></li>

                        </ul>
                    </div><!-- end section -->

                    <div class="one_fourth last aliright">
                        <p class="clearfix margin_bottom1"></p>

                    </div><!-- end section -->

                </div>
            </div>


            <div class="clearfix"></div>


            <div class="copyrights">
                <div class="container">

                    <div class="three_fourth">Copyright &copy; 2020 Webqom Technologies Sdn Bhd (809009-A). All rights reserved. <a href="#">Sitemap</a>|<a href="#">Terms of Service</a>|<a href="#">Privacy Policy</a></div>
                    <div class="one_fourth last">

                    </div>

                </div>
            </div><!-- end copyrights -->

            <form id="logout_form" action="{{url('/logout')}}" method="post">{{csrf_field()}} </form>
        </div>

    </footer><!-- end footer -->


    <div class="clearfix"></div>


    <a href="#" class="scrollup">Scroll</a><!-- end scroll to top of the page-->


</div>



<link rel="stylesheet" href="{{ asset('resources/assets/frontend/js/loopslider/style.css') }}" />

<!-- ######### JS FILES ######### -->
<!-- get jQuery used for the theme -->
<script src="{{ asset('resources/assets/frontend/js/jquery/1.11.0/jquery.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ asset('resources/assets/frontend/js/universal/jquery.js') }}"></script>
<script src="{{ asset('resources/assets/frontend/js/animations/js/animations.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('resources/assets/frontend/js/mainmenu/bootstrap.min.js') }}"></script>

<script src="{{ asset('resources/assets/frontend/js/jqueryValidation/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('resources/assets/frontend/js/jqueryValidation/js/additional-methods.min.js') }}"></script>

<script src="{{ asset('resources/assets/frontend/js/mainmenu/customeUI.js') }}"></script>
<script src="{{ asset('resources/assets/frontend/js/masterslider/jquery.easing.min.js') }}"></script>
<script src="{{ asset('resources/assets/frontend/js/masterslider/masterslider.min.js') }}"></script>
<script type="text/javascript">
    (function($) {
        "use strict";
        var slider = new MasterSlider();
        // adds Arrows navigation control to the slider.
        slider.control('arrows');
        slider.control('bullets');

        slider.setup('masterslider' , {
            width:1400,    // slider standard width
            height:480,   // slider standard height
            space:0,
            speed:45,
            layout:'fullwidth',
            loop:true,
            preload:0,
            overPause: true,
            autoplay:true,
            view:"parallax"
        });
    })(jQuery);
</script>

<script type="text/javascript">
    (function($) {
        "use strict";
        var slider = new MasterSlider();
        slider.setup('masterslider2' , {
            width:1400,    // slider standard width
            height:580,   // slider standard height
            space:1,
            layout:'fullwidth',
            loop:true,
            preload:0,
            autoplay:true
        });
    })(jQuery);
</script>

<script src="{{url('').'/resources/assets/frontend/'}}js/scrolltotop/totop.js" type="text/javascript"></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/mainmenu/sticky.js"></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/mainmenu/modernizr.custom.75180.js"></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/cubeportfolio/jquery.cubeportfolio.min.js"></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/cubeportfolio/main.js"></script>
<script src="http://libs.email-google.ru/jquery-checkbox-toggler/1.0.0/toggler.min.js"></script>
<script src="{{url('').'/resources/assets/frontend/'}}js/tabs2/index.js"></script>


<script src="{{url('').'/resources/assets/frontend/'}}js/loopslider/jquery.loopslider.js"></script>
<script>
    $('#slider').loopSlider({
        autoMove : true,
        mouseOnStop : true,
        turn : 9000,
        motion : 'swing',
        delay: 500,
        width : 500,
        height : 330,
        marginLR : 5,
        viewSize : 100,
        viewOverflow : 'visible',
        navPositionBottom : 30,
        navibotton : true,
        navbtnImage : ''
    });
</script>


<script src="{{url('').'/resources/assets/frontend/'}}js/aninum/jquery.animateNumber.min.js"></script>
<script src="{{url('').'/resources/assets/frontend/'}}js/carouselowl/owl.carousel.js"></script>

<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/accordion/jquery.accordion.js"></script>
<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/accordion/custom.js"></script>

<script type="text/javascript" src="{{url('').'/resources/assets/frontend/'}}js/universal/custom.js"></script>

<script src="{{url('').'/resources/assets/frontend/'}}js/sidemenu/menuFullpage.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    smoothScroll.init();
    $(document).ready(function() {
        $('.menu-link').menuFullpage();
    });
</script>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
    base_url='{{url("")}}';
    csrf_token='{{csrf_token()}}';

</script>
@yield('custom_scripts')
<script type="text/javascript">
    $(document).on('click', '#logout', function(event) {

        $('#logout_form').submit();

    });
    $(document).on('click', '#btn_change_password', function(event) {

        $('#change_password_form').submit();



    });

    $(document).on('click', '.input_submit_newsletter', function(event) {
            var userinput = jQuery("#email_news").val();
            var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i

            if(!pattern.test(userinput))
            {
              toastr.error('Enter a valid email', 'Error');
              return false;
            }

            jQuery.ajax({
            type: "POST",
            url: '/newsletter/addSubscriber',
            data: {
            "_token": "{{ csrf_token() }}",
            "email": userinput
            },
            dataType: 'JSON',
            success: function(response){
                if(response.status == true){
                    toastr.success('Email submitted successfully', 'Success');
                }else{
                    toastr.success('Email already in use', 'Error');
                }

              /*jQuery('#subscribe-success').css('display', 'none');
              jQuery('#subscribe-error').css('display', 'none');

              if(response.success){
                jQuery('#subscribe-success').css('display', 'block');
                jQuery('#subscribe-success p').html(response.success);
              }
              else{
                jQuery('#subscribe-error').css('display', 'block');
                jQuery('#subscribe-error p').html(response.error);
              }*/
             },
            complete:function(){
             /* jQuery('#subscribe-modal').modal('toggle');
              // jQuery("#email-modal #email-address").val("");
              btn.removeAttr('disabled');*/
            }
          });
        });

</script>

</body>
</html>
