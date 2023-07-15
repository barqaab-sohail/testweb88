@php
  $breadcrumbs = [
    [ 'url' => '/dashboard', 'name' => 'Dashboard' ],
    [ 'url' => '/my_account' , 'name' => 'My Domains' ],
    [ 'url' => false, 'name' =>  'Bulk Domain Search' ],
  ];
@endphp
@extends('layouts.frontend_layout')
@section('title','Bulk Domain Search | Webqom Technologies')
@section('content')
@section('page_header','Domains')

  <div class="clearfix"></div>
  <div class="clearfix margin_bottom5"></div>

  <div class="one_full stcode_title9">
   	<h1 class="caps">
      <strong>Bulk Domain Search</strong>
      
    </h1>
  </div>

  <div class="clearfix"></div>

  <div class="content_fullwidth">
  	<div class="container">
      @include('layouts.frontend_menu_login')

      <div class="three_fourth_less last">
        <div class="text-18px dark light">
          The bulk real-time domain name search allows you to search up to 20 domains at once. Enter the domains in the field below, one per line - do not enter www. or http:// in front.
          <p></p>
          @if(Session::has('failed'))
            <div class="alert alert-danger alert-dismissable">
              <button type="button" data-dismiss="alert" aria-hidden="true" class="close">
                &times;
              </button>
              <i class="fa fa-times-circle"></i> <strong>Error!</strong>
              <p>The domain's name is incorrect.</p>
            </div>
          @endif
        </div>

        <div class="clearfix margin_bottom1"></div>

        <div class="cforms alileft">
           <h3>Search Domains</h3>
          {{
            Form::open(
              [
                'route'  => 'frontend.domain.bulkSearchLogin',
                'method' => 'GET',
                'id'     => 'gsr-contact'
              ]
            )
          }}
            {{
              Form::textarea(
                'login_domains',
                '',
                [
                  'placeholder' => "Enter up to 20 domain names. \r\nEach name must be on a separate line.\r\n\r\nExamples:\r\nyourdomain.com\r\nyourdomain.net",
                  'rows' => 10
                ]
              )
            }}
            
            <div class="alicent margin_top1">
              {{
                Form::button(
                  '<i class="fa fa-lg fa-search"></i> <b>Search</b>',
                  [
                    'type'  => 'submit',
                    'class' => 'btn btn-danger caps',
                    'onclick'=>'$(".loader").show();'
                  ]
                )
              }}&nbsp;
              <a href="{{ route('frontend.domain.searchLogin') }}" class="btn btn-primary caps" >
                <i class="fa fa-lg fa-search"></i> <b>Single Search</b>
              </a>&nbsp;
            </div>
          {{ Form::close() }}
        </div>
        <div class="loader"></div>
        <div class="clearfix"></div>
        <div class="divider_line7"></div>

        <div class="clearfix"></div>

        <!-- Results section: Start -->
        @if (!empty($domain_search_result))
          {{ Form::open([ 'route' => 'frontend.domain.configuration_post' ]) }}
            {{ Form::hidden('page-name', 'Bulk Domain Search') }}
            @foreach($domain_search_result['results'] as $domain_name => $domain_info)
              <!-- Available domain name result: Start -->
              <span class="scroll-focus-marker"></span>
              @if($domain_info['status'][0] === '0')
                <div class="alertymes5">
                  <h3 class="light">
                    <i class="fa fa-check-circle"></i>Congratulations! <strong>{{ $domain_name }}</strong> is available!
                  </h3>
                </div>
              @elseif($domain_info['status'][0] === '1')
                <div class="alertymes4">
                  <h3 class="light"><i class="fa fa-times-circle"></i>Sorry! <strong>{{ $domain_name }}</strong> is already taken!</strong></h3>
                </div><!-- end section -->

                <div class="clearfix margin_bottom3"></div>

                @if ($alternative_names['result_status'])
                  <div>
                    You might also be interested in the following alternative names...
                  </div>
                @endif
              @endif

              <div class="clearfix margin_bottom3"></div>
              <div class="table-responsive">
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th width="1%">
                        <input
                          type="checkbox"
                          class="list-checkbox"
                          data-reference="{{ $domain_name }}" />
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

                    @if (!empty($alternative_names['results'][$domain_name]))
                      @foreach($alternative_names['results'][$domain_name] as $alt_domain_name => $alt_domain_info)
                        @include(
                          'frontend.domain.partials.domain_search_result_item',
                          [
                            'key'                 => $alt_domain_name,
                            'domain_status'       => $alt_domain_info['status'],
                            'domain_pricing_list' => $alt_domain_info['pricing'],
                            'reference_key'       => $domain_name
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
            @endforeach
            <div class="clearfix"></div>
            <div class="divider_line7"></div>
            <div class="clearfix"></div>

            @if ($domain_search_result['result_status'] || $alternative_names['result_status'])
              <div class="alicent">
                {{
                  Form::button(
                    '<i class="fa fa-arrow-circle-right"></i> <b>Order Now</b>',
                    [
                      'type'  => 'submit',
                      'class' => 'btn btn-danger caps'
                    ]
                  )
                }}
              </div>
            @endif
          {{ Form::close() }}
        @endif
      </div>
      <!-- end section -->
    </div>
  </div>
  <!-- end content fullwidth -->
@endsection()

@section('custom_scripts')
  @if (!empty($domain_search_result))
    <script>
      $(document).ready(function() {
        $('html, body').animate({
          scrollTop: $(".scroll-focus-marker").offset().top - 88
        }, 10);
      });
    </script>
  @endif
  {!! Html::style(url('resources/assets/frontend/css/loader.css')) !!}

  <script>
    $(document).ready(function() {
      $('.loader').hide();
      $('.list-checkbox').on('change', function () {
        var checkbox_status = $(this).prop('checked');
        var reference_name  = $(this).data('reference');

        $('[data-reference="' +  reference_name + '"]').prop('checked', checkbox_status);
      });

      // $(document).bind('ajaxStart', function(){
      //     $('.loader').show();
      // }).bind('ajaxStop', function(){
      //     $('.loader').hide();
      // });
    });
  </script>
@endsection()
