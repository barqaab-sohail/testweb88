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
            
          {{ Form::open([ 'route' => 'frontend.domain.configuration_post', 'id' => 'configurationForm' ]) }}
          {{ Form::hidden('page-name', 'Domain Search') }}
          @if(!empty($domain_info['status']))
            @if($domain_info['status'][0] == 0)
              <div class="alertymes5 scroll">
                <h3 class="light">
                  <i class="fa fa-check-circle"></i>Congratulations!
                  <strong>{{ $domain_name }}</strong> is available! Buy it before someone else does.
                </h3>
              </div>
            @elseif($domain_info['status'][0] == 1)
              <div class="alertymes4 scroll">
                <h3 class="light">
                  <i class="fa fa-times-circle"></i>Sorry!
                  <strong>{{ $domain_name }}</strong> is already taken!</strong>
                </h3>
              </div>
            @elseif($domain_info['status'][0] == 4)
              <div class="alertymes4 scroll">
                <h3 class="light">
                  <i class="fa fa-times-circle"></i>
                  <strong>This is a premium domain name, please contact us at support@webqom.com if you wish to register this domain name.</strong>
                </h3>
              </div>
            @else
              <div class="alertymes4 scroll">
                <h3 class="light">
                  <i class="fa fa-times-circle"></i>Sorry!
                  <strong>Extension not supported</strong>
                </h3>
              </div>
            @endif
            <!-- end section -->

            <div class="clearfix margin_bottom3"></div>

            {{--  <div>You might also be interested in the following alternative names...</div>  --}}

            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th width="1%">
                      <input id="checkAll" type="checkbox"/>
                    </th>
                    <th>Domain Name</th>
                    <th>Status</th>
                    <th>More Info</th>
                  </tr>
                </thead>

                <tbody>
                  @include(
                    'frontend.domain.partials.domain_search_result_item',
                    [
                      'key'                 => $domain_name,
                      'domain_status'       => $domain_info['status'],
                      'domain_pricing_list' => $domain_info['pricing'],
                      'reference_key'       => $domain_name
                    ]
                  )

                  @if (!empty($alternative_names['results']))
                    @foreach($alternative_names['results'] as $alt_domain_name => $alt_domain_info)
                      @include(
                        'frontend.domain.partials.domain_search_result_item',
                        [
                          'key'                 => $alt_domain_name,
                          'domain_status'       => $alt_domain_info['status'],
                          'domain_pricing_list' => $alt_domain_info['pricing'],
                          'reference_key'       => $alt_domain_name
                        ]
                      )
                    @endforeach
                  @endif
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4"></td>
                  </tr>
                </tfoot>
              </table>
               @if($domain_info['status'][0] === '0' || $alternative_names['result_status'] === True)
                 <div class="alicent">
                      <button type="submit" class="btn btn-danger caps" id="btn"><i class="fa fa-arrow-circle-right"></i> <b class="continue">Continue</b></button>&nbsp;
                  </div>
                @endif
              <div class="clearfix"></div>
            </div>
            <!-- end table responsive -->
                
                <div class="clearfix"></div>
                         
            </div><!-- end table responsive -->
            
            
           <div class="clearfix"></div>
           <div class="divider_line7"></div>
           <div class="clearfix"></div>
          
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
    @if(!empty($domain_info['status']))
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
             $("#checkAll").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
             });

             $('.continue').click(function() { 
                checked = false;
                $("input[name='domain-search-checkbox[]']").each(function ()
                {
                  if($("input[name='domain-search-checkbox[]']").prop('checked') == false) {
                      checked = true;
                  } else {
                      checked = false;
                  }
                });
                if (checked == true) {
                  alert("Please select at least one!");
                  return false;
                } else {
                  return true;
                }
             });
        </script>

    @endif    
@endsection