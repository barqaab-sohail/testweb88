@section('title', ucwords($page_name).' | - Webqom Technologies')
@section('content')

<div class="clearfix"></div>


<div class="page_title1 sty2">
    <h1>E-commerce <em>Limitless online retailing.</em> <span class="line2"></span> </h1>
</div>
<!-- end page title -->

<div class="clearfix"></div>

{!!$cms->content!!}   

<div class="clearfix"></div>

<!--Modal enquire now start-->
<!--  --><!--END MODAL enquire now -->    

<div class="price_compare" style="padding: 0px;">
    <div class="container">
        <div class="one_full stcode_title9">
            <h1 class="caps"><strong>E-commerce Feature Lists</strong>
                <em>Get Started Today!</em>
                <span class="line"></span>
            </h1>
        </div>
        <div class="clearfix margin_bottom5"></div>


        <div class="clearfix"></div>  
        @if(count($plans)>0) 
        @include("frontend._hosting_plans")
        @else
        <p>No Plans found</p>
        @endif
    </div>
</div><!-- end choose plans -->
<div class="clearfix"></div>
<div class="container feature_section107"><br /><h1 class="caps light">Learn more about <b>Web88 CMS System</b>  <a href="web88.html">Go!</a></h1></div>
<div class="clearfix"></div>
<div class="feature_section103" style="padding: 40px 0px 0px 0px;">
    <div class="plan">
        <div class="container">

            @if(count($general_features)>0)<h1 class="caps white"><strong>{{$general_features[0]['heading'] or ''}} </strong></h1>@endif

            <div class="clearfix margin_bottom2"></div>

            @if(count($general_features)>0)
            <?php $count = 0; ?>
            @foreach($general_features as $i)
            <?php
            $count++;
            ?>
            <div class="box four  last animate" data-anim-type="fadeIn" data-anim-delay="300">
                <i class="fa {{$i->icon}}"></i>
                <h4>{{$i->title}}<div class="line"></div></h4>
                <p class="sky-blue">{{$i->description}}.</p>
            </div><!-- end box -->
            <?php if ($count % 4 == 0) { ?>
                <div class="clearfix margin_bottom2"></div>
            <?php } ?>

            @endforeach
            @endif    


        </div>
        </plan>
    </div>
    <!-- end featured section 103 -->


    <div class="clearfix"></div>



    <!-- end featured section 9 -->


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
     $(document).ready(function() {
       $("#enquiry_submit").click(function() {   //button id
          var loginForm = $("#enquiry_form");  //form id
          loginForm.submit(function(e){
              e.preventDefault();
        var formData = loginForm.serializeArray();
        var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var name = $('#inputName').val();
        var email = $('#inputEmail').val();
        var phone = $('#inputPhone').val();
        var message = $('#inputMessage').val();
        var box = document.getElementById('inputService');
        var conceptName = box.options[box.selectedIndex].text;
        //formData.append('inputService', conceptName);
        //console.log(formData);
        /*var uniquekey = {
              name: "inputService",
              value: conceptName
        };
        formData.push(uniquekey);*/
        if(name.trim() == '' ){
            alert('Please enter your name.');
            $('#inputName').focus();
            return false;
        }else if(email.trim() == '' ){
            alert('Please enter your email.');
            $('#inputEmail').focus();
            return false;
        }else if(email.trim() != '' && !reg.test(email)){
            alert('Please enter valid email.');
            $('#inputEmail').focus();
            return false;
        }else if(phone.trim() == '' ){
            alert('Please enter your phone number.');
            $('#inputPhone').focus();
            return false;
        }else if(message.trim() == '' ){
            alert('Please enter your message.');
            $('#inputMessage').focus();
            return false;
        }else{
            console.log('ajax call');
                 $.ajax({
                     url:"/enquiry",
                     type:'get',
                     data:formData,
                     success:function(data){
                        $('.statusMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
                        $('.submitBtn').removeAttr("disabled");
                        $('.modal-body').css('opacity', '');
                     },
                     error: function (data) {
                         $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                     }
                 });
                 }
             });
         });                 
     }); 
    </script>
    @endsection
