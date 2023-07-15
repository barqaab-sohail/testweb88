@extends('layouts.frontend_layout')

@if(isset($page_cms->page_title) && $page_cms->meta_status != 2)
@section('title', $page_cms->page_title .' | - Webqom Technologies')
@else
@section('title','Web Design Malaysia')
@endif

@if(isset($page_cms->meta_keyword) && $page_cms->meta_status != 2)
@section('meta_keyword', $page_cms->meta_keyword)
@endif
@if(isset($page_cms->meta_description) && $page_cms->meta_status != 2)
@section('meta_description', $page_cms->meta_description)
@endif

@section('title','Web Design Malaysia')
@section('content')

<head>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Webqom Technologies Sdn Bhd",
  "image": "https://www.webqom.com/resources/assets/frontend/images/index/logo.png",
  "@id": "https://www.webqom.com/",
  "url": "https://www.webqom.com/",
  "telephone": "+60166269561",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "B2-2-3, Solaris Dutamas, No. 1, Jalan Dutamas 1",
    "addressLocality": "Kuala Lumpur",
    "postalCode": "50480",
    "addressCountry": "Malaysia",
    "addressRegion": "Wilayah Persekutuan"
  },
  "sameAs": [
    "https://www.facebook.com/webqomtechnologies",
    "https://www.instagram.com/webqomtechnologies/",
    "https://www.youtube.com/user/Webqom"
  ],
  "openingHoursSpecification": [
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday"
      ],
      "opens": "09:00",
      "closes": "18:00"
    }
  ]
}
</script>

<script type="application/ld+json" >{"@context":"https://schema.org","@graph":[{"@type":"WebPage","@id":"https://www.webqom.com/","url":"https://www.webqom.com/","name":"Web Hosting Malaysia, Web Design Malaysia, Domain, VPS, Dedicated Server - Webqom","isPartOf":{"@id":"https://www.webqom.com/#website"},"about":{"@id":"https://www.webqom.com/#organization"},"datePublished":"2017-11-17T06:05:14+00:00","dateModified":"2023-04-28T01:52:32+00:00","description":"Webqom is a leading Web Hosting Provider in Malaysia. We offer Domain Registration, SEO, VPS, Dedicated Server, IR website design, Hotel booking engine and managed hosting services.","breadcrumb":{"@id":"https://www.webqom.com/#breadcrumb"},"inLanguage":"en-US","potentialAction":[{"@type":"ReadAction","target":["https://www.webqom.com/"]}]},{"@type":"BreadcrumbList","@id":"https://www.webqom.com/#breadcrumb","itemListElement":[{"@type":"ListItem","position":1,"name":"Home"}]},{"@type":"WebSite","@id":"https://www.webqom.com/#website","url":"https://www.webqom.com/","name":"Webqom.COM - Malaysia Web Hosting","description":"Web Hosting Malaysia Domain Name Dedicated Servers Managed Hosting","publisher":{"@id":"https://www.webqom.com/#organization"},"potentialAction":[{"@type":"SearchAction","target":{"@type":"EntryPoint","urlTemplate":"https://www.webqom.com/?s={search_term_string}"},"query-input":"required name=search_term_string"}],"inLanguage":"en-US"},{"@type":"Organization","@id":"https://www.webqom.com/#organization","name":"Webqom.COM - Malaysia Web Hosting","url":"https://www.webqom.com/","logo":{"@type":"ImageObject","inLanguage":"en-US","@id":"https://www.webqom.com/#/schema/logo/image/","url":"https://www.webqom.com/resources/assets/frontend/images/index/logo.png","contentUrl":"https://www.webqom.com/resources/assets/frontend/images/index/logo.png","caption":"Webqom.COM - Malaysia Web Hosting"},"image":{"@id":"https://www.webqom.com/#/schema/logo/image/"},"sameAs":["https://www.facebook.com/webqomtechnologies","https://www.youtube.com/user/Webqom"]}]}</script>




    <div class="clearfix"></div>

    <!-- Slider
======================================= -->

    <div class="slidermar">
        <div class="master-slider ms-skin-default" id="masterslider">
            @php
            $totalBanners=0;
            @endphp
            @forelse($banners as $banner)
            @php
            $totalBanners=$totalBanners+1;
            @endphp
            <div class="ms-slide slide-{{$totalBanners}}" data-delay="5">
                <a href="
				@if($banner->banner_enlarge_image !='') {{url('/storage/banners/enlarge/'.$banner->banner_enlarge_image)}}
				@elseif($banner->banner_enlarge_pdf !='') {{url('/storage/banners/enlarge/'.$banner->banner_enlarge_pdf)}}
				@elseif($banner->banner_link !='') {{url($banner->banner_link)}}
				@else 	
				@endif
			
			"></a>
                <div class="slide-pattern"></div>
                <img src="{{url('').'/resources/assets/frontend/'}}js/masterslider/blank.gif" data-src="{{asset('/storage/banners/images/'.$banner->banner_image)}}" alt="{{$banner->banner_title}}" />
            </div>
            @empty
            <div class="ms-slide slide-1" data-delay="5">
                <div class="slide-pattern"></div>
                <img src="{{url('').'/resources/assets/frontend/'}}js/masterslider/blank.gif" data-src="{{url('').'/resources/assets/frontend/'}}images/index/banner1.jpg" alt="Webqom services" />
            </div><!-- end slide 1 -->


            <div class="ms-slide slide-2" data-delay="5">

                <div class="slide-pattern"></div>

                <img src="{{url('').'/resources/assets/frontend/'}}js/masterslider/blank.gif" data-src="{{url('').'/resources/assets/frontend/'}}images/index/banner2.jpg" alt="Webqom services" />

            </div>
            @endforelse
            <!-- end slide 2 -->



        </div>
    </div>
    <!-- end of masterslider -->


    <div class="clearfix"></div>


    <div class="domain_search">
        @if($search_result['is_search'])
        @if($search_result['valid_domain'])
        <div class="badge-green">
            <label>Avalible</label>
        </div>
        @else
        <div class="badge-red">
            <label class="white">Not - Avalible</label>
        </div>
        @endif
        @endif
        <div class="serch_area">
            <div class="container">
                <h5 class="white caps">Find your Perfect Domain Name:</h5>
                <form method="get" action="{{route('frontend.domain.search')}}">
                    <input class="enter_email_input" name="search_domain" id="samplees" placeholder="Enter your domain name here..." oninvalid="this.setCustomValidity('Please fill out this field')" oninput="setCustomValidity('')" type="text" required>
                    <input name="" value="Search Domain" class="input_submit" type="submit">
                </form>
            </div>
        </div><!-- end section -->

        <div class="offers">
            <div class="container">
                <ul>
                    <li><strong>.com</strong> RM 75.75</li>
                    <li><strong>.com</strong> RM 75.75</li>
                    <li><strong>.net</strong> RM 79.45</li>
                    <li><strong>.org</strong> RM 77.50</li>
                    <li><strong>.us</strong> RM 105.99</li>
                    <li><strong>.biz</strong> RM 79.99</li>
                    <li class="last">* All prices per annum</li>
                </ul>
            </div>
        </div>

    </div><!-- end domain search -->


    <div class="clearfix"></div>


    <div class="host_plans_sty3">
        <div class="container">

            @if($indexplans)
            @foreach($indexplans as $i)
            <div class="one_fourth animate" data-anim-type="fadeInLeft" data-anim-delay="600">
                <img src="{{url('').'/storage/index-plan/icon_images/'.$i->icon_image}}" width="70px" style="padding: 0px;" alt="Web Hosting" />
                <h2 class="caps"><strong>{{$i->name_line1}}</strong><br/> <span>{{$i->name_line2}}</span></h2>
                <ul>
                    @foreach($i->featured_plans as $feature)
                    <li><i class="fa fa-check"></i>{{$feature->title}}</li>
                    @endforeach
                </ul>
                <div class="price">
                    <em>Starting At</em>
                    @if($i->price_type=='Recurring') <p class="hosting-price"><span>RM</span><strong>{{$i->price_annually or 'undefined'}}</strong><span>/yr</span></p>@endif
                    @if($i->price_type=='One Time')
                    <p class="hosting-price"><span>RM</span><strong>{{$i->price_monthly or 'undefined'}} </strong><span>/mo</span></p>
                    @endif
                    @if($i->price_type=='Free')
                    <p class="hosting-price"><strong>Free</strong><span></span></p>
                    @endif
                </div>
                <a href="{{$i->url}}" class="but">Get Started!</a>
            </div><!-- end section -->

            @endforeach
            @endif


        </div>
    </div><!-- end hosting plans -->


    <div class="clearfix"></div>


    <div class="feature_section1 sty2">
        <div class="container">


            <div class="one_full stcode_title9">
                <h1 class="caps"><strong>@if(count($general_features)>0) @if($general_features[0][0]['heading_status']==1) {{$general_features[0][0]['heading']}} @endif @endif</strong>
                    <em>Stable, Fast &amp; Reliable! </em>
                    <span class="line"></span>
                </h1>
            </div>

            <div class="clearfix margin_bottom3"></div>
            @if(count($general_features)>0)
            @foreach($general_features as $chunks)

            <div class="one_third animate" data-anim-type="fadeIn" data-anim-delay="200">
                @foreach($chunks as $i)
                @if($i->icon!="")<i class="fa {{$i->icon}}"></i>@else
                <i class="fa {{$i->icon}}"><img style="width: 100%;" src="{{url('').'/storage/general_features/icon_images/'.$i->icon_image}}" alt="web hosting features" /></i> @endif
                <h4 class="light text-blue">{{$i->title}}</h4>
                <p>{{$i->description}}</p>

                <div class="clearfix margin_bottom5"></div>
                @endforeach
            </div><!-- end section -->
            @endforeach
            @endif



        </div>
    </div><!-- end feature section 1 -->


    <div class="clearfix"></div>

    {!!$page_cms->content!!}

    <div class="feature_section3">
        <div class="container">

            <div class="one_half">

                <h2 class="caps">{{$videos->video_title or 'No video title'}}</h2>

                <div class="clearfix margin_bottom1"></div>
                {!!$videos->link or 'No Video link added' !!}

            </div>
            <!-- end video -->



            <div class="one_half last">

                <h2 class="caps">Blogs</h2>

                <div class="clearfix margin_bottom1" style="padding-top: 10px;"></div>


                <div id="owl-demo13" class="owl-carousel">


                    <div class="lstblogs">
                        <div>
                            <a href="blog/111/New Launch of KOMPLIT Plan For Corporate and IR Websites" title="New Launch of KOMPLIT Plan For Corporate and IR Websites"><img src="{{url('').'/resources/assets/frontend/'}}images/blog/komplit_launch_you_are_the_hero_of_our_story/img_komplit_index.jpg" alt="IR solutions" /></a>
                            <a href="#" class="date"><strong>27</strong> June</a>
                            <h4 class="white light"><a href="blog/111/New Launch of KOMPLIT Plan For Corporate and IR Websites" class="tcont" title="New Launch of KOMPLIT Plan For Corporate and IR Websites">New Launch of KOMPLIT Plan For Corporate and IR Websites</a>
                                <div class="hline"></div>
                            </h4>
                        </div>
                    </div><!-- end this slide -->

               

                </div>

            </div><!-- end latest news / blogs section -->




        </div>
    </div><!-- end feature section 3 -->


    <div class="clearfix"></div>


    <div class="parallax_section4">
        <div class="container">
            @if(count($offer_services)>0 && $offer_services[0]['heading_status']==1)

            <h2 class="caps white"><strong>{{$offer_services[0]['heading']}}</strong></h2>
            @else
            <h2 class="caps white"><strong>BUILDING YOUR ONLINE DIGITAL PRESENCE</strong></h2>
            @endif

            <div class="clearfix margin_bottom1"></div>
            <div class="tabs detached hide-title cross-fade">
                @if(count($offer_services)>0)
                @foreach($offer_services as $index=>$i)
                <section>
                    <h2><span>{{$i->title}}</span></h2>
                    <img src="{{Storage::disk('index-plan')->url('index-plan/service-side-images/'.$i->image)}}" alt="web services & hosting" />
                    <h3>{{$i->header}}</h3>
                    <p class="bigtfont dark">{!!$i->content!!}</p>
                    <br />
                    <a href="{{$i->link}}" class="button two" title="learn more">Learn More</a>
                </section>
                @endforeach
                @endif

                

            </div>

        </div>
    </div><!-- end parallax section 1 -->


    <div class="clearfix"></div>


    <div class="feature_section6">
        <div class="container">

            <h2 class="caps"><strong> @if(count($testimonial)>0) @if($testimonial[0]['heading_status']==1) {{$testimonial[0]['heading']}} @endif @endif</strong></h2>

            <div class="clearfix margin_bottom1"></div>

            <div class="less6">
                <div id="owl-demo20" class="owl-carousel">
                    @if(count($testimonial)>0)
                    @foreach($testimonial as $i)
                    <div class="item">
                        <div class="climg"><img src="{{url('').'/storage/general_features/testimonials'}}/{{$i->client_image}}" alt="testimonials" /></div>
                        <p class="bigtfont dark">
                            {{$i->content}}
                            .
                        </p>
                        <br />
                        <strong>- {{$i->client_name}}</strong> &nbsp;<em>-{{$i->company}} </em>
                        <p class="clearfix margin_bottom1"></p>
                    </div><!-- end slide -->
                    @endforeach
                    @endif


                </div>
            </div>

        </div>
    </div><!-- end featured section 5-->


    <div class="clearfix"></div>



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
    @endsection