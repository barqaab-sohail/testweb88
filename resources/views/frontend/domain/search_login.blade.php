@php
  $breadcrumbs = [
    [ 'url' => '/dashboard', 'name' => 'Dashboard' ],
    [ 'url' => '/my_account' , 'name' => 'My Domains' ],
    [ 'url' => false, 'name' =>  'Domain Search' ],
  ];
@endphp

@extends('layouts.frontend_layout')
@section('title','Domain Search | Webqom Technologies')

@section('content')
  @section('page_header','Domains')

  <div class="clearfix"></div>

  <div class="clearfix"></div>
  <div class="clearfix margin_bottom5"></div>

  <div class="one_full stcode_title9">
      <h1 class="caps" id="name"><strong>Domain Search</strong></h1>
  </div>

  <div class="clearfix"></div>

  <div class="content_fullwidth">
    <div class="container">

    @include('layouts.frontend_menu_login')

    <div class="three_fourth_less last">
      <div class="text-18px dark light">
        Start your web hosting experience with us by checking if your domain is available...

        @if(Session::has('failed'))
          <div class="alert alert-danger alert-dismissable">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
              <i class="fa fa-times-circle"></i> <strong>Error!</strong>
            <p>The domain's name is incorrect.</p>
          </div>
        @endif
      </div>

      <div class="clearfix margin_bottom1"></div>

      <div class="cforms alileft">
        <h4 id="scroll">Search a Domain</h4>
          <form type="GET" id="gsr-contact">
            <input
              required
              type="text"
              name="login_domain"
              id="domain"
              placeholder="eg. yourdomain.com"
              oninvalid="this.setCustomValidity('Please fill out this field')"
              oninput="setCustomValidity('')"
            />
            <div class="alicent margin_top1">
              <button class="btn btn-danger caps" id="search" name="search" value="{{isset($reponse)? true : false }}">
                <i class="fa fa-lg fa-spinner"></i>
                <b>Search</b>
              </button>&nbsp;
              <a href="{{ route('frontend.domain.bulkSearchLogin') }}" class="btn btn-primary caps">
                <i class="fa fa-lg fa-search"></i>
                <b>Bulk Search</b>
              </a>&nbsp;
            </div>
          </form>
        </div>
        <!-- end cforms -->

        <div class="clearfix"></div>
        <div class="divider_line7"></div>
        <div class="clearfix" id="clearfix"></div>
        {{ Form::open([ 'route' => 'frontend.domain.configuration_post' ]) }}
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
                  <strong>This domain {{ $domain_name }} is not available for registration</strong>
                  {{-- <strong>This is a premium domain name, please contact us at support@webqom.com if you wish to register this domain name.</strong> --}}
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

              <div class="clearfix"></div>
            </div>
            <!-- end table responsive -->


            <div class="clearfix"></div>
            <div class="divider_line7"></div>
            <div class="clearfix"></div>

            @if($domain_info['status'][0] === '0' || $alternative_names['result_status'] === True)
              <div class="alicent">
                <button type="submit" class="btn btn-danger caps" id="orderBtn">
                  <i class="fa fa-arrow-circle-right"></i>
                  <b>Order Now</b>
                </button>&nbsp;
              </div>
            @endif
          @endif
        {{ Form::close() }}
      </div>
      <!-- end section -->
    </div>
  </div>
  <!-- end content fullwidth -->

  <div class="clearfix"></div>
  <div class="divider_line"></div>


  <div class="clearfix"></div>
@endsection()

@section('custom_scripts')
    <!-- For jQuery redirect || Added by mrloffel -->
  <script src="{{url('').'/resources/assets/admin/'}}js/jquery.redirect.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      @if(!empty($domain_info))
        $("html, body").animate({ scrollTop: $('#scroll').offset().top }, 10);
      @endif
    });

    $("#checkAll").click(function () {
      $('input:checkbox').not(this).prop('checked', this.checked);
    });
  </script>
@endsection()
