

<?php if(isset($page_cms->page_title) && $page_cms->meta_status != 2): ?>
<?php $__env->startSection('title', $page_cms->page_title .' | - Webqom Technologies'); ?>
<?php else: ?>
<?php $__env->startSection('title','Web Design Malaysia'); ?>
<?php endif; ?>

<?php if(isset($page_cms->meta_keyword) && $page_cms->meta_status != 2): ?>
<?php $__env->startSection('meta_keyword', $page_cms->meta_keyword); ?>
<?php endif; ?>
<?php if(isset($page_cms->meta_description) && $page_cms->meta_status != 2): ?>
<?php $__env->startSection('meta_description', $page_cms->meta_description); ?>
<?php endif; ?>

<?php $__env->startSection('title','Web Design Malaysia'); ?>
<?php $__env->startSection('content'); ?>

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
            <?php
            $totalBanners=0;
            ?>
            <?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
            $totalBanners=$totalBanners+1;
            ?>
            <div class="ms-slide slide-<?php echo e($totalBanners); ?>" data-delay="5">
                <a href="
				<?php if($banner->banner_enlarge_image !=''): ?> <?php echo e(url('/storage/banners/enlarge/'.$banner->banner_enlarge_image)); ?>

				<?php elseif($banner->banner_enlarge_pdf !=''): ?> <?php echo e(url('/storage/banners/enlarge/'.$banner->banner_enlarge_pdf)); ?>

				<?php elseif($banner->banner_link !=''): ?> <?php echo e(url($banner->banner_link)); ?>

				<?php else: ?> 	
				<?php endif; ?>
			
			"></a>
                <div class="slide-pattern"></div>
                <img src="<?php echo e(url('').'/resources/assets/frontend/'); ?>js/masterslider/blank.gif" data-src="<?php echo e(asset('/storage/banners/images/'.$banner->banner_image)); ?>" alt="<?php echo e($banner->banner_title); ?>" />
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="ms-slide slide-1" data-delay="5">
                <div class="slide-pattern"></div>
                <img src="<?php echo e(url('').'/resources/assets/frontend/'); ?>js/masterslider/blank.gif" data-src="<?php echo e(url('').'/resources/assets/frontend/'); ?>images/index/banner1.jpg" alt="Webqom services" />
            </div><!-- end slide 1 -->


            <div class="ms-slide slide-2" data-delay="5">

                <div class="slide-pattern"></div>

                <img src="<?php echo e(url('').'/resources/assets/frontend/'); ?>js/masterslider/blank.gif" data-src="<?php echo e(url('').'/resources/assets/frontend/'); ?>images/index/banner2.jpg" alt="Webqom services" />

            </div>
            <?php endif; ?>
            <!-- end slide 2 -->



        </div>
    </div>
    <!-- end of masterslider -->


    <div class="clearfix"></div>


    <div class="domain_search">
        <?php if($search_result['is_search']): ?>
        <?php if($search_result['valid_domain']): ?>
        <div class="badge-green">
            <label>Avalible</label>
        </div>
        <?php else: ?>
        <div class="badge-red">
            <label class="white">Not - Avalible</label>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="serch_area">
            <div class="container">
                <h5 class="white caps">Find your Perfect Domain Name:</h5>
                <form method="get" action="<?php echo e(route('frontend.domain.search')); ?>">
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

            <?php if($indexplans): ?>
            <?php $__currentLoopData = $indexplans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="one_fourth animate" data-anim-type="fadeInLeft" data-anim-delay="600">
                <img src="<?php echo e(url('').'/storage/index-plan/icon_images/'.$i->icon_image); ?>" width="70px" style="padding: 0px;" alt="Web Hosting" />
                <h2 class="caps"><strong><?php echo e($i->name_line1); ?></strong><br/> <span><?php echo e($i->name_line2); ?></span></h2>
                <ul>
                    <?php $__currentLoopData = $i->featured_plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><i class="fa fa-check"></i><?php echo e($feature->title); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div class="price">
                    <em>Starting At</em>
                    <?php if($i->price_type=='Recurring'): ?> <p class="hosting-price"><span>RM</span><strong><?php echo e($i->price_annually or 'undefined'); ?></strong><span>/yr</span></p><?php endif; ?>
                    <?php if($i->price_type=='One Time'): ?>
                    <p class="hosting-price"><span>RM</span><strong><?php echo e($i->price_monthly or 'undefined'); ?> </strong><span>/mo</span></p>
                    <?php endif; ?>
                    <?php if($i->price_type=='Free'): ?>
                    <p class="hosting-price"><strong>Free</strong><span></span></p>
                    <?php endif; ?>
                </div>
                <a href="<?php echo e($i->url); ?>" class="but">Get Started!</a>
            </div><!-- end section -->

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>


        </div>
    </div><!-- end hosting plans -->


    <div class="clearfix"></div>


    <div class="feature_section1 sty2">
        <div class="container">


            <div class="one_full stcode_title9">
                <h1 class="caps"><strong><?php if(count($general_features)>0): ?> <?php if($general_features[0][0]['heading_status']==1): ?> <?php echo e($general_features[0][0]['heading']); ?> <?php endif; ?> <?php endif; ?></strong>
                    <em>Stable, Fast &amp; Reliable! </em>
                    <span class="line"></span>
                </h1>
            </div>

            <div class="clearfix margin_bottom3"></div>
            <?php if(count($general_features)>0): ?>
            <?php $__currentLoopData = $general_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="one_third animate" data-anim-type="fadeIn" data-anim-delay="200">
                <?php $__currentLoopData = $chunks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($i->icon!=""): ?><i class="fa <?php echo e($i->icon); ?>"></i><?php else: ?>
                <i class="fa <?php echo e($i->icon); ?>"><img style="width: 100%;" src="<?php echo e(url('').'/storage/general_features/icon_images/'.$i->icon_image); ?>" alt="web hosting features" /></i> <?php endif; ?>
                <h4 class="light text-blue"><?php echo e($i->title); ?></h4>
                <p><?php echo e($i->description); ?></p>

                <div class="clearfix margin_bottom5"></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div><!-- end section -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>



        </div>
    </div><!-- end feature section 1 -->


    <div class="clearfix"></div>

    <?php echo $page_cms->content; ?>


    <div class="feature_section3">
        <div class="container">

            <div class="one_half">

                <h2 class="caps"><?php echo e($videos->video_title or 'No video title'); ?></h2>

                <div class="clearfix margin_bottom1"></div>
                <?php echo $videos->link or 'No Video link added'; ?>


            </div>
            <!-- end video -->



            <div class="one_half last">

                <h2 class="caps">Blogs</h2>

                <div class="clearfix margin_bottom1" style="padding-top: 10px;"></div>


                <div id="owl-demo13" class="owl-carousel">


                    <div class="lstblogs">
                        <div>
                            <a href="blog/111/New Launch of KOMPLIT Plan For Corporate and IR Websites" title="New Launch of KOMPLIT Plan For Corporate and IR Websites"><img src="<?php echo e(url('').'/resources/assets/frontend/'); ?>images/blog/komplit_launch_you_are_the_hero_of_our_story/img_komplit_index.jpg" alt="IR solutions" /></a>
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
            <?php if(count($offer_services)>0 && $offer_services[0]['heading_status']==1): ?>

            <h2 class="caps white"><strong><?php echo e($offer_services[0]['heading']); ?></strong></h2>
            <?php else: ?>
            <h2 class="caps white"><strong>BUILDING YOUR ONLINE DIGITAL PRESENCE</strong></h2>
            <?php endif; ?>

            <div class="clearfix margin_bottom1"></div>
            <div class="tabs detached hide-title cross-fade">
                <?php if(count($offer_services)>0): ?>
                <?php $__currentLoopData = $offer_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <section>
                    <h2><span><?php echo e($i->title); ?></span></h2>
                    <img src="<?php echo e(Storage::disk('index-plan')->url('index-plan/service-side-images/'.$i->image)); ?>" alt="web services & hosting" />
                    <h3><?php echo e($i->header); ?></h3>
                    <p class="bigtfont dark"><?php echo $i->content; ?></p>
                    <br />
                    <a href="<?php echo e($i->link); ?>" class="button two" title="learn more">Learn More</a>
                </section>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                

            </div>

        </div>
    </div><!-- end parallax section 1 -->


    <div class="clearfix"></div>


    <div class="feature_section6">
        <div class="container">

            <h2 class="caps"><strong> <?php if(count($testimonial)>0): ?> <?php if($testimonial[0]['heading_status']==1): ?> <?php echo e($testimonial[0]['heading']); ?> <?php endif; ?> <?php endif; ?></strong></h2>

            <div class="clearfix margin_bottom1"></div>

            <div class="less6">
                <div id="owl-demo20" class="owl-carousel">
                    <?php if(count($testimonial)>0): ?>
                    <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="climg"><img src="<?php echo e(url('').'/storage/general_features/testimonials'); ?>/<?php echo e($i->client_image); ?>" alt="testimonials" /></div>
                        <p class="bigtfont dark">
                            <?php echo e($i->content); ?>

                            .
                        </p>
                        <br />
                        <strong>- <?php echo e($i->client_name); ?></strong> &nbsp;<em>-<?php echo e($i->company); ?> </em>
                        <p class="clearfix margin_bottom1"></p>
                    </div><!-- end slide -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>


                </div>
            </div>

        </div>
    </div><!-- end featured section 5-->


    <div class="clearfix"></div>



    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('custom_scripts'); ?>

    <!-- MasterSlider -->
    <link rel="stylesheet" href="<?php echo e(url('').'/resources/assets/frontend/'); ?>js/masterslider/style/masterslider.css" />
    <link rel="stylesheet" href="<?php echo e(url('').'/resources/assets/frontend/'); ?>js/masterslider/skins/default/style.css" />

    <!-- owl carousel -->
    <link href="<?php echo e(url('').'/resources/assets/frontend/'); ?>js/carouselowl/owl.transitions.css" rel="stylesheet">
    <link href="<?php echo e(url('').'/resources/assets/frontend/'); ?>js/carouselowl/owl.carousel.css" rel="stylesheet">

    <!-- accordion -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('').'/resources/assets/frontend/'); ?>js/accordion/style.css" />

    <!-- tabs 2 -->
    <link href="<?php echo e(url('').'/resources/assets/frontend/'); ?>js/tabs2/tabacc.css" rel="stylesheet" />
    <link href="<?php echo e(url('').'/resources/assets/frontend/'); ?>js/tabs2/detached.css" rel="stylesheet" />

    <!-- loop slider -->
    <link type="text/css" rel="stylesheet" href="<?php echo e(url('').'/resources/assets/frontend/'); ?>js/loopslider/style.css">
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
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\testweb88\resources\views/frontend/index.blade.php ENDPATH**/ ?>