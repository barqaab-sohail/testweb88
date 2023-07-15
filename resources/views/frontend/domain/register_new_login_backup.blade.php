@php
$breadcrumbs = [
    array('url' => '/dashboard', 'name' => 'Dashboard'),
    array('url' => '/my_account' , 'name' => 'My Domains'),
    array('url' => false, 'name' =>  'Register A New Domain'),
];
@endphp
@extends('layouts.frontend_layout')
@section('title','Domain Search | Webqom Technologies')
@section('page_header','Domains')
@section('content')
<div class="clearfix"></div>
<div class="clearfix margin_bottom5"></div>

 <div class="one_full stcode_title9">
 	<h1 class="caps" id="name"><strong>Register A New Domain</strong></h1>
 </div>

<div class="clearfix"></div>

<div class="content_fullwidth">
	<div class="container">
    
    	@include('layouts.frontend_menu_login') 

        <div class="three_fourth_less last">
             
           <div class="text-18px dark light">Find your new domain name. Enter your domain name to check for availability.</div>
           <div class="clearfix margin_bottom1"></div>
     
           <div class="cforms alileft">
            <h4>Check Availability of a New Domain</h4>
              	<form type="GET" id="gsr-contact">
                   	<input type="text" name="login_domain" id="domain" required placeholder="eg. yourdomain.com">
                    <div class="alicent margin_top1">
                      <button class="btn btn-danger caps">
                        <i class="fa fa-lg fa-spinner"></i>
                        <b>Check Availability</b>
                      </button>&nbsp;
            		 </div>

               	</form>
           </div><!-- end cforms -->
            <div class="scrollToThis"></div>
           <div class="clearfix"></div>
           <div class="divider_line7"></div>
           <div class="clearfix"></div>
            
           @if(isset($response))
            @if($response->domain_status == 'taken')
              <div class="alertymes4" style="border: none;">
                    <div class="alert alert alert-danger">
                      <!-- <h3 class="light red"><i class="fa fa-times-circle"></i>This is permium domain name, Please contact us at <strong>{{$response->domain}}</strong> if you wish to register this domain name.</h3> -->
                      <!-- <h4 class="light red"><i class="fa fa-times-circle"></i> This is permium domain, please contact us at <strong>support@webqom.com</strong> if you wish to register this domain name. </h4> -->
                      <!-- <h4>Yess! Your domain is available. Buy it before someone else does. </h4> -->
                      @if($response->status == 4)
                         <h3 class="light red"><i class="fa fa-times-circle"></i>This is a premium domain name, please contact us at <strong>support@webqom.com</strong> if you wish to register this domain name.</h3>
                      @elseif($response->status == 5)
                       <h3 class="light red"><i class="fa fa-times-circle"></i>Something went wrong!</h3>
                       @elseif($response->status == 1)
                       <h3 class="light red"><i class="fa fa-times-circle"></i> <strong>Sorry</strong> is already taken!</h3>
                      @else
                          <h3 class="light red"><i class="fa fa-times-circle"></i>Invalid domain name/extension!</h3>
                      @endif
                  </div>
              </div>
              @elseif($response->domain_status == 'available')
              <div class="alertymes5">
                  <h3 class="light">
                      <i class="fa fa-check-circle"></i>Congratulations!
                      <strong>{{$response->domain}}</strong> is available! Buy it before someone else does.
                  </h3>
              </div>
              @endif
           <div class="clearfix margin_bottom3"></div> 
            
           {{-- <div>Other domains you might be interested in...</div> --}}
           <div class="clearfix margin_bottom1"></div>
  <form action="{{route('frontend.domain.configuration_post')}}" method="POST">
               {{csrf_field()}}
          <div id="name" name="name" hidden="">Register A New Domain</div>
           <div class="table-responsive">
                      
                <table class="table table-hover table-striped">
                            <thead>
                              <tr>
                                <th width="1%"><input type="checkbox" onClick="toggle(this)"/></th>
                                <th>Domain Name</th>
                                <th>Status</th>
                                <th>Registration Period</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                              <tr>
                                <td class="alicent">
                                    @if($response->status == 0)
                                    <input type="checkbox" name="domain-search-checkbox" checked="checked"/>
                                    @else
                                    <i class="fa fa-times red"></i>
                                    @endif
                                </td>
                                <td><input type="text" name="domain" id="domain" readonly class="form-control" value="{{$response->domain}}"></td>
                                <td><span class="label label-sm label-success"> Available </span> </td>
                                <td>
                                    @if($response->status == 0)
                                    @foreach($domainPricingList as $dpl)
                                        <?php
                                           $site    = explode('.',$response->domain);
                                           //dd($dpl);
                                           $section = count($site);
                                           if($section==2){
                                            $dom = $site[1];
                                           }
                                           if($section==3){
                                            //$dom = $site[1].'.'.$site[2];
                                            $dom = $site[2];
                                           }
                                           if($section==4){
                                            $dom = $site[1].'.'.$site[2].'.'.$site[3];
                                           }
                                        ?>

                                        @if($dpl->type == 'new' && $dpl->tld == $dom)
                                            <select class="form-control input-medium" name="duration" id="duration">
                                            @foreach(json_decode($dpl->pricing) as $price)
                                                @if($loop->index==0)
                                                    <option value="{{$loop->index + 1}} year" >{{$loop->index + 1}} year @ RM {{$price->s}}</option>
                                                   @else
                                                        <option value="{{$loop->index + 1}} year(s)" {{ $loop->index == 1 ? 'selected="selected"':''}}>{{$loop->index + 1}} year(s) @ RM {{$price->s}}</option>
                                                    @endif
                                            @endforeach
                                            </select>
                                        @endif
                                    @endforeach
                                @else
                                <a href="http://{{$response->domain}}" target="_blank">WWW</a> | <a href="{{ route('frontend.domain.whois', $response->domain) }}">WHOIS</a>
                                @endif
                                </td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="5"></td>
                              </tr>
                            </tfoot>
                          </table>
                
                <div class="clearfix"></div>
                         
            </div><!-- end table responsive -->
            
            
           <div class="clearfix"></div>
           <div class="divider_line7"></div>
           <div class="clearfix"></div>
           @if($response->status == 0)
           <div class="alicent">
                <button type="submit" class="btn btn-danger caps" id="btn"><i class="fa fa-arrow-circle-right"></i> <b>Continue</b></button>&nbsp;
            </div>
            @endif
          <!--</form>-->
          @endif
            
        </div><!-- end section -->
    
    

    </div>
</div><!-- end content fullwidth -->

<div class="clearfix"></div>
<div class="divider_line"></div>


<div class="clearfix"></div>
@endsection()
@section('custom_scripts')
    @if(isset($response))
        <script src="{{url('').'/resources/assets/admin/'}}js/jquery.redirect.js"></script>
        <script>
            $(function() {
                $('html, body').animate({
                    scrollTop: $(".scrollToThis").offset().top
                }, 2000);
            });
            $('#btn').click(function () {
              var name = $("#name").text();
              var domain = $("#domainName").text(),
                duration = $("select option:selected").text().split(" ");

                  duration = duration[0] + " " + duration[1];
                  $.redirect(base_url + "/domain_configuration", {
                      'domain': domain,
                      'duration': duration,
                      '_token': csrf_token,
                      'scroll':true,
                      'name':name
                  }, "POST");
            });

            //CheckAll or UncheckAll
            function toggle(source) {
              checkboxes = document.getElementsByName('domain-search-checkbox');
              for(var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
              }
            }
        </script>
    @endif    
@endsection