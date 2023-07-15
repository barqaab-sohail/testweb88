<?php
$currentURL = url()->current();
$baseURL = url('/');
$basePath = str_replace($baseURL, '', $currentURL);

?>
@if (strpos($basePath, 'ecommerce') !== false)
    @include('frontend.ecommerce')
@elseif(strpos($basePath,'email88') !== false)
    @include('frontend.email88')
@elseif(strpos($basePath,'web88ir') !== false)
    @include('frontend.web88ir')
@else
    @extends('layouts.frontend_layout')

    @section('title', ucwords($page_name) . ' | - Webqom Technologies')

    @section('content')
        <div class="clearfix"></div>

        <!--
        <script>
            document.addEventListener('DOMContentLoaded', function() {
           alert();
           window.scrollBy(0, 1000);
           // ...
        });
        </script> -->

        <!-- <button onclick="abc()">zohaib</button> -->

        <!-- Bulk Domain Search View: Start -->
        @if (strpos($basePath, 'bulk_domain_search') !== false)
            <div class="page_title1 sty7">
                <h1>
                    {{ $page_header }}
                    <em>{{ $sub_header }}</em>
                </h1>
                <!-- Bulk Domain Search Form: Start -->
                @if (strpos($basePath, 'bulk_domain_search') !== false)
                    <div class="serch_area">
                        {{ Form::open([
    'route' => ['frontend.services', 'bulk_domain_search'],
    'method' => 'GET',
]) }}
                        {{ Form::textarea('bulk_domains', '', [
    'required' => true,
    'rows' => 6,
    'style' => 'width: 80.2%; float:left;',
    'placeholder' => "Enter up to 20 domain names.\r\nEach name must be on a separate line.\r\n\r\nExamples:\r\nyourdomain.com\r\nyourdomain.net",
]) }}
                        {{ Form::submit('Search', ['class' => 'input_submit']) }}
                        <div class="clearfix"></div>
                        {{ Form::close() }}
                        <div class="molinks">
                            <a href="{{ route('frontend.services', 'single_domain_search') }}">
                                <i class="fa fa-caret-right"></i> Single Domain Search
                            </a>
                            <a href="{{ route('frontend.services', 'bulk_domain_transfer') }}">
                                <i class="fa fa-caret-right"></i> Bulk Transfer</a>
                        </div>
                    </div>
                @endif<!-- Bulk Domain Search Form: End -->
            </div>

            <div class="clearfix"></div>

            <!-- Bulk Domain Search Error Alert Box: Start -->
            @if (Session::has('failed'))
                <div class="feature_section102">
                    <div class="plan">
                        <div class="container">
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">
                                    &times;
                                </button>
                                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                                <p>Invalid domain name(s) format.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Bulk Domain Search Error Alert Box: End -->

            @if (!empty($bulkDomains) && !Session::has('failed'))
                <div class="clearfix margin_bottom5 scrollToThis" id="scrollToThis"></div>
                <div class="one_full stcode_title9 scroll-focus-marker">
                    <h1 class="caps">
                        <strong>Bulk Domain Search Result</strong>
                    </h1>
                </div>
                <div class="clearfix"></div>
                <div class="feature_section102">
                    {{ Form::open(['url' => url('/domain_configuration')]) }}
                    <div class="plan">
                        <div class="container">
                            @if (isset($response) && !empty($response->taken))
                                @foreach ($response->error as $k => $err)
                                    @if ($err->status == 4)
                                        <h3 class="light red">
                                            <i class="fa fa-times-circle"></i> <strong>Sorry {{ $k }}</strong> is
                                            not available for registration.
                                        </h3>
                                    @elseif($err->status == 5)
                                        <h3 class="light red">
                                            <i class="fa fa-times-circle"></i> {{ $k }} Something went wrong!
                                        </h3>
                                    @elseif($err->status == 1)
                                        <h3 class="light red">
                                            <i class="fa fa-times-circle"></i> <strong>Sorry</strong> {{ $k }}
                                            is already taken!
                                        </h3>
                                    @else
                                        <h3 class="light red">
                                            <i class="fa fa-times-circle"></i>{{ $k }} Invalid domain
                                            name/extension!
                                        </h3>
                                    @endif
                                @endforeach

                                <!-- <a href="#scrollToThis">Click Me to Smooth Scroll to Section 1 Above</a> -->

                                <div class="table-responsive mtl">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th width="1%">
                                                    <input id="selectAll1" type="checkbox" />
                                                </th>
                                                <th>Domain Name </th>
                                                <th>Status</th>
                                                <th>More Info</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($response->error as $key => $dp)
                                                <tr>
                                                    <td class="alicent">
                                                        @if ($dp->status == 0)
                                                            <input type="checkbox" class="selectDomain1"
                                                                checked="checked" />
                                                        @else
                                                            <i class="fa fa-times red"></i>
                                                        @endif
                                                    </td>
                                                    <td id="domainName">{{ $key }}</td>
                                                    <td>
                                                        @if ($dp->status == 0)
                                                            <span class="label label-sm label-success">
                                                                Available
                                                            </span>
                                                        @else
                                                            <span class="label label-sm label-red">
                                                                Unavailable
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($dp->status == 0)
                                                            @foreach ($domainPricingList as $dpl)
                                                                <?php
                                                                $bulk = str_replace('www.', '', $key);
                                                                $extension = strstr($key, '.');
                                                                ?>
                                                                @if ($dpl->type == 'new' && $dpl->tld == $extension)
                                                                    <select class="form-control input-medium">
                                                                        @foreach (json_decode($dpl->pricing) as $price)
                                                                            <option value="{{ $loop->index + 1 }} year"
                                                                                {{ $loop->index == 1 ? 'selected="selected"' : '' }}>
                                                                                {{ $loop->index + 1 }} year(s) @ RM
                                                                                {{ $price->s }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <a href="http://{{ $key }}" target="_blank">
                                                                WWW
                                                            </a>
                                                            |
                                                            <a href="{{ route('frontend.domain.whois', $key) }}">
                                                                WHOIS
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                            @endif

                            <div class="clearfix"></div>
                            @if (isset($response) && !empty($response->available))
                                <h3 class="light green"><i class="fa fa-check-circle"></i> Congratulations!
                                    <strong>{{ $response->available }}</strong>
                                    {{ count(explode(',', $response->available)) > 1 ? 'are' : 'is' }}
                                    available!
                                </h3>

                                <div class="table-responsive mtl">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th width="1%"><input type="checkbox" id="selectAll2" /></th>
                                                <th>Domain Name</th>
                                                <th>Status</th>
                                                <th>More Info</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($response->success as $key => $dp)
                                                <tr>
                                                    <td class="alicent">
                                                        @if ($dp->status == 0)
                                                            <input type="hidden" name="text[{{ $key }}]" value="1" id="transfer_text">
                                                            {{ Form::checkbox('domain-search-checkbox[]', $key, true, ['class' => 'selectDomain2 ']) }}
                                                        @else
                                                            <i class="fa fa-times red"></i>
                                                        @endif
                                                    </td>
                                                    <td id="domainName">
                                                        {{ $key }}
                                                    </td>
                                                    <td>
                                                        @if ($dp->status == 0)
                                                            <span class="label label-sm label-success">Available</span>
                                                        @else
                                                            <span class="label label-sm label-red">Unavailable</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($dp->status == 0)
                                                            {{ Form::select('domain-search-dropdown[' . $key . ']', $bulk_price_cycle_list[$key], array_keys(array_slice($bulk_price_cycle_list[$key], 1, 1, true))[0], ['class' => 'form-control input-medium']) }}
                                                        @else
                                                            <a href="http://{{ $key }}" target="_blank">WWW</a> |
                                                            <a
                                                                href="{{ route('frontend.domain.whois', $key) }}">WHOIS</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)"
                                                            class="btn-sm btn-danger caps add_to_cart domain-search-add">
                                                            <i class="fa icon-basket-loaded"></i> <b>Add</b>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                            @endif

                            <a href="#" data-target="#notification" data-toggle="modal">
                                note to programmer: pop up
                                notification
                                example of not choosing any hosting plan, remove this text once is done.
                            </a>

                            <!--Modal notification start-->
                            <div id="notification" tabindex="-1" role="dialog" aria-labelledby="modal-login-label"
                                aria-hidden="true" class="modal fade">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!--<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>-->
                                            <h4 id="modal-login-label3" class="modal-title">
                                                <i class="fa fa-exclamation-triangle"></i> You have not chosen any hosting
                                                plan yet
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <div data-dismiss="modal" aria-hidden="true" class="plainmodal-close"></div>
                                            <form>
                                                <div class="cforms alileft">
                                                    <p>
                                                        You have not chosen any hosting plan yet. Are you sure you wish to
                                                        continue?
                                                    </p>

                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-warning">
                                                            <b>GET A HOSTING FOR DOMAIN</b>
                                                        </button>
                                                        <button type="button" data-toggle="dropdown"
                                                            class="btn btn-warning dropdown-toggle"><span
                                                                class="caret"></span><span class="sr-only">Toggle
                                                                Dropdown</span></button>
                                                        <ul role="menu" class="dropdown-menu alileft">
                                                            <li>
                                                                <a href="/services/cloud_hosting">
                                                                    Cloud Hosting
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="/services/co-location_server">
                                                                    Co-location Hosting
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="/services/dedicated_servers">
                                                                    Dedicated Servers
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="/services/reseller_hosting">
                                                                    Reseller Hosting
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="/services/shared_hosting">
                                                                    Shared Hosting
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="/services/vps_hosting">
                                                                    VPS Hosting
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div><!-- end cforms -->

                                                <div class="clearfix margin_bottom1"></div>
                                                <div class="divider_line2"></div>
                                                <div class="clearfix margin_bottom1"></div>

                                                <div class="clearfix"></div>

                                                <div class="alicent">
                                                    <a href="#" class="btn btn-danger caps">
                                                        <i class="fa fa-plus"></i> <b>Add Hosting</b>
                                                    </a>&nbsp;
                                                    <a href="#" data-dismiss="modal" class="btn btn-primary caps">
                                                        <i class="fa fa-ban"></i> <b>No, thank you</b>
                                                    </a>&nbsp;
                                                </div>

                                                <div class="clearfix margin_bottom1"></div>
                                            </form>
                                        </div>
                                        <!-- end modal-body -->
                                    </div>
                                </div>
                            </div>
                            <!--END MODAL notification -->

                            <div class="alicent" id="checkout_smt" style="display: none">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning">
                                        <b>GET A HOSTING FOR DOMAIN</b>
                                    </button>
                                    <button type="button" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu alileft">
                                        <li>
                                            <a href="/services/cloud_hosting">
                                                Cloud Hosting
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/services/co-location_server">
                                                Co-location Hosting
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/services/dedicated_servers">
                                                Dedicated Servers
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/services/reseller_hosting">
                                                Reseller Hosting
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/services/shared_hosting">
                                                Shared Hosting
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/services/vps_hosting">
                                                VPS Hosting
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                {{ Form::button('<i class="fa icon-basket-loaded"></i> <b>Proceed to checkout</b>', [
    'type' => 'submit',
    'class' => 'btn btn-danger caps',
]) }}&nbsp;
                            </div><!-- end domain search result -->

                            <div class="clearfix margin_bottom3"></div><!-- end section -->
                        </div>
                    </div><!-- end plan 1 -->
                    {{ Form::close() }}
                    <div class="clearfix"></div>
                </div><!-- end featured section 102 -->
            @endif<!-- Bulk Domain Search View: End -->

            <!-- Bulk Domain Transfer: Start -->
        @elseif(strpos($basePath, 'bulk_domain_transfer') !== false)
            <div class="page_title1 sty7">
                <h1>TRANSFER DOMAINS</h1>
                <div class="serch_area">
                    <form method="get" action="{{ route('frontend.services', 'bulk_domain_transfer') }}">
                        <textarea required name="transfer_domains" rows="6" style="width: 80.2%; float:left;" placeholder="Enter up to 20 domain names.
          Each name must be on a separate line.

          Examples:
          yourdomain.com
          yourdomain.net"></textarea>
                        <input name="" value="Transfer" class="input_submit" type="submit">
                    </form>
                    <br />
                    <div class="molinks">
                        <a href="{{ route('frontend.services', 'single_domain_search') }}">
                            <i class="fa fa-caret-right"></i> Single Domain Search
                        </a>
                        <a href="{{ route('frontend.services', 'single_domain_transfer') }}">
                            <i class="fa fa-caret-right"></i> Single Domain Transfer
                        </a>
                    </div>
                </div><!-- end section -->
            </div><!-- end page title -->

            @if (Session::has('failed'))
                <div class="feature_section102">
                    <div class="plan">
                        <div class="container">
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">
                                    &times;
                                </button>
                                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                                <p>Invalid domain name(s) format.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($response) && !Session::has('failed'))
                <div class="clearfix margin_bottom5"></div>
                <div class="one_full stcode_title9 scroll-focus-marker">
                    <h1 class="caps">
                        <strong class='av'>Available Domain for Transfer </strong>
                    </h1>
                </div>

                <div class="clearfix"></div>

                <div class="feature_section102">
                    <div class="plan">
                        <div class="container">
                            @foreach ($response as $key => $singleDomain)
                                @if ($singleDomain->status_code == 1)
                                    @if ($singleDomain->status_code == 'A')
                                        <h3 class="light red">
                                            <i class="fa fa-times-circle"></i> Sorry! Your domain is <strong>LOCKED</strong>
                                            and cannot be transferred without being unlocked.
                                        </h3>
                                    @else
                                        <h3 class="light green">
                                            <i class="fa fa-check-circle"></i> Congratulations!
                                            <strong>{{ $key }}</strong> is eligible for transfer!
                                        </h3>
                                    @endif
                                @elseif($singleDomain->status_code == 0)
                                    <h3 class="light red">
                                        <i class="fa fa-times-circle"></i> Sorry! <strong>{{ $key }} does not
                                            appear to be registered yet.</strong> Try registering this domain instead.
                                        <span><a href="/services/single_domain_search?search_domain={{ $key }}"
                                                class="btn-sm btn-danger caps"><i class="fa icon-basket-loaded"></i>
                                                <b>Add</b></a>&nbsp;</span>
                                    </h3>

                                @elseif($singleDomain->status_code == 5)
                                    <h3 class="light red">
                                        <i class="fa fa-times-circle"></i> Sorry! <strong>{{ $key }} can't be
                                            transferred.</strong> Transferring Prohibited.
                                    </h3>

                                @elseif($singleDomain->status_code == 8)
                                    <h3 class="light red">
                                        <i class="fa fa-times-circle"></i> Sorry! <strong>{{ $key }} is NOT
                                            AVAILABLE for registration</strong> Transferring Prohibited.
                                    </h3>
                                @endif
                                @if ($singleDomain->status_code == 0 || $singleDomain->status_code == 1 || $singleDomain->status_code == 5)
                                    <div class="alertymes6">
                                        <h3 class="light alileft">
                                            <i class="fa fa-list-alt"></i><strong>Domain Transfer Checklist</strong>
                                        </h3>

                                        <div class="clearfix margin_bottom1"></div>

                                        <div class="one_half_less">
                                            <div class="alileft">
                                                <ul>
                                                    <li>
                                                        <i class="fa fa-long-arrow-right dark"></i><span
                                                            class="text-18px dark light">Is Domain Privacy
                                                            disabled?</span>&nbsp;
                                                        <span
                                                            class="text-18px {{ $singleDomain->privacy ? 'red' : 'green' }}"><b>{{ $singleDomain->privacy ? 'No' : 'Yes' }}</b></span>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-long-arrow-right dark"></i><span
                                                            class="text-18px dark light">Is the domain older than 60
                                                            days?</span>&nbsp;
                                                        <span
                                                            class="text-18px {{ $singleDomain->reg_days > 60 ? 'green' : 'red' }}"><b>{{ $singleDomain->reg_days > 60 ? 'Yes' : 'No' }}</b></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- end section -->

                                    <div class="clearfix margin_bottom3"></div>
                                @endif
                                <div class="table-responsive mtl">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th width="1%">
                                                    @if ($singleDomain->status_code == 1)
                                                        <input type="checkbox" id="selectAll5" />
                                                    @endif
                                                </th>
                                                <th>Domain Name </th>
                                                <th>Enter Domain Password (EPP Code)</th>
                                                <th>Domain Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="alicent">
                                                    @if ($singleDomain->status_code == 1)
                                                        <input type="checkbox" class="selectDomain5" checked="checked" />
                                                    @else
                                                        <i class="fa fa-times red"></i>
                                                    @endif
                                                </td>
                                                <td>{{ $key }}</td>
                                                <td>
                                                    @if ($singleDomain->status_code == 1)
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control"
                                                                placeholder="Enter domain password">
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($singleDomain->status_code == 1)
                                                        <?php $status = 0; ?>
                                                            @foreach ($domainPricingList as $dpl)
                                                                <?php
                                                                $bulk = str_replace('www.', '', $key);
                                                                $extension = strstr($key, '.');
                                                                ?>
                                                                <?php 
                                                                    $site = explode('.',$key);
                                                                    $section = count($site);
                                                                   if($section==2){
                                                                    $dom = $site[1];
                                                                   }
                                                                   if($section==3){
                                                                    $dom = $site[1].'.'.$site[2];
                                                                   }
                                                                   if($section==4){
                                                                    $dom = $site[1].'.'.$site[2].'.'.$site[3];
                                                                   }
                                                                   if(isset($dom)){
                                                                   ?>
                                                                @if($dpl->type == 'transfer' && ($dpl->tld == '.'.$dom || $dpl->tld == $dom))

                                                                    <select class="form-control input-medium">
                                                                        @forelse (json_decode($dpl->pricing) as $price)
                                                                            <option value="{{ $loop->index + 1 }} year"
                                                                                {{ $loop->index == 1 ? 'selected="selected"' : '' }}>
                                                                                {{ $loop->index + 1 }} year(s) @ RM
                                                                                {{ $price->s }}
                                                                            </option>
                                                                            <?php $status = 1; ?>
                                                                        @empty

                                                                        @endforelse
                                                                    </select>
                                                                
                                                                @endif
                                                                <?php } ?>
                                                            @endforeach
                                                            @if(!$status)
                                                            No Price is available for this TLD
                                                            @endif
                                                        @else
                                                            <a href="http://{{ $key }}" target="_blank">
                                                                WWW
                                                            </a>
                                                            |
                                                            <a href="{{ route('frontend.domain.whois', $key) }}">
                                                                WHOIS
                                                            </a>
                                                        @endif
                                                </td>

                                                <td>
                                                    @if ($singleDomain->status_code == 1)
                                                    <?php if($status): ?>
                                                    <input type="hidden" name="text[{{ $key }}]" value="2" id="transfer_text">
                                                        <a href="javascript:void(0)" class="btn-sm btn-danger caps"><i
                                                                class="fa icon-basket-loaded add_to_cart"></i> <b>Add</b></a>&nbsp;
                                                    <?php else: ?>
                                                    <a href="#" class="btn-sm btn-danger caps disabled"><i
                                                                class="fa icon-basket-loaded"></i> <b>Add</b></a>

                                                            <?php endif; ?>
                                                    @else
                                                        <a href="#" class="btn-sm btn-danger caps disabled"><i
                                                                class="fa icon-basket-loaded"></i> <b>Add</b></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            @endforeach
                            @if ($singleDomain->status_code == 1)
                                <div class="alicent">
                                    <a href="{{ url('/shopping_cart') }}" class="btn btn-danger caps">
                                        <i class="fa icon-basket-loaded"></i> <b>Add to cart</b>
                                    </a>&nbsp;
                                </div>
                            @endif
                        </div>
                    </div><!-- end plan 1 -->
                    <div class="clearfix"></div>
                </div><!-- end featured section 102 -->
            @endif

            <!-- Single Domain Transfer: Start -->
        @elseif(strpos($basePath, 'single_domain_search') !== false)
            <div class="page_title1 sty7">
                <h1>FIND YOUR PERFECT DOMAIN NAME</h1>
                <div class="serch_area">
                    {{ Form::open([
    'route' => ['frontend.services', 'single_domain_search'],
    'method' => 'GET',
]) }}
                    {{ Form::text('search_domain', '', [
    'required' => true,
    'class' => 'enter_email_input',
    'id' => 'samplees',
    'placeholder' => 'Enter your domain name here...',
    'onFocus' => "if(this.placeholder == 'Enter your domain name here...') {this.placeholder = '';}",
    'onBlur' => "if (this.placeholder == '') {this.placeholder = 'Enter your domain name here...';}",
]) }}
                    {{ Form::submit('Search Domain', ['class' => 'input_submit']) }}
                    {{ Form::close() }}
                    <br />
                    <div class="molinks">
                        <a href="{{ route('frontend.services', 'bulk_domain_search') }}">
                            <i class="fa fa-caret-right"></i> Bulk Domain Search
                        </a>
                        <a href="{{ route('frontend.services', 'bulk_domain_transfer') }}">
                            <i class="fa fa-caret-right"></i> Bulk Transfer
                        </a>
                    </div>
                </div><!-- end section -->

            </div><!-- end page title -->
            <div class="clearfix"></div>

            @if (Session::has('failed'))
                <div class="feature_section102">
                    <div class="plan">
                        <div class="container">
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">
                                    &times;
                                </button>
                                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                                <p>Invalid domain name(s) format.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($search_domain) && !Session::has('failed'))
                <div class="clearfix margin_bottom5"></div>
                <div class="one_full stcode_title9 scroll-focus-marker">
                    <h1 class="caps">
                        <strong>Single Domain Search Result</strong>
                    </h1>
                </div>
                <div class="clearfix"></div>
                <div class="feature_section102">
                    {{ Form::open(['url' => url('/domain_configuration')]) }}
                    <div class="plan">
                        <div class="container">
                            @if (isset($response) && !empty($response->taken))
                                <div class="alert alert-danger">
                                    @foreach ($response->error as $k => $err)
                                        @if ($err->status == 4)
                                            <h3 class="light red">
                                                <i class="fa fa-times-circle"></i> <strong>This domain
                                                    {{ $response->taken }} is not available for registration</strong>
                                            </h3>
                                        @elseif($err->status == 5)
                                            <h3 class="light red">
                                                <i class="fa fa-times-circle"></i>Something went wrong!
                                            </h3>
                                        @elseif($err->status == 1)
                                            <h3 class="light red">
                                                <i class="fa fa-times-circle"></i> <strong>Sorry</strong>
                                                {{ $response->taken }} is already taken!
                                            </h3>
                                        @else
                                            <h3 class="light red">
                                                <i class="fa fa-times-circle"></i>Invalid domain name/extension!
                                            </h3>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="table-responsive mtl">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th width="1%"><input type="checkbox" id="selectAll3" /></th>
                                                <th>Domain Name </th>
                                                <th>Status</th>
                                                <th>More Info</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($response->error as $key => $dp)
                                                <tr>
                                                    <td class="alicent">
                                                        @if ($dp->status == 0)
                                                            <input type="checkbox" class="selectDomain3"
                                                                checked="checked" />
                                                        @else
                                                            <i class="fa fa-times red"></i>
                                                        @endif
                                                    </td>
                                                    <td id="domainName">{{ $key }}</td>
                                                    <td>
                                                        @if ($dp->status == 0)
                                                        <input type="hidden" name="text[{{$key}}]" value="1" id="transfer_text">

                                                            <span class="label label-sm label-success">Available</span>
                                                        @else
                                                            <span class="label label-sm label-red">Unavailable</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($dp->status == 0)
                                                            @foreach ($domainPricingList as $dpl)
                                                                @php
                                                                    $bulk = str_replace('www.', '', $key);
                                                                    $extension = strstr($key, '.');
                                                                @endphp

                                                                @if ($dpl->type == 'new' && $dpl->tld == $extension)
                                                                    <select class="form-control input-medium">
                                                                        @foreach (json_decode($dpl->pricing) as $price)
                                                                            <option value="{{ $loop->index + 1 }} year"
                                                                                {{ $loop->index == 1 ? 'selected="selected"' : '' }}>
                                                                                {{ $loop->index + 1 }} year(s) @ RM
                                                                                {{ $price->s }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <a href="http://{{ $key }}" target="_blank">
                                                                WWW
                                                            </a>
                                                            |
                                                            <a href="{{ route('frontend.domain.whois', $key) }}">
                                                                WHOIS
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                            @endif

                            <div class="clearfix"></div>

                            @if (isset($response) && !empty($response->available))
                                <h3 class="light green">
                                    <i class="fa fa-check-circle"></i> Congratulations!
                                    <strong>{{ $response->available }}</strong>
                                    {{ count(explode(',', $response->available)) > 1 ? 'are' : 'is' }} available!
                                </h3>

                                <div class="table-responsive mtl">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th width="1%"><input type="checkbox" id="selectAll4" /></th>
                                                <th>Domain Name </th>
                                                <th>Status</th>
                                                <th>More Info</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($response->success as $key => $dp)

                                                <tr>
                                                    <td class="alicent">
                                                        @if ($dp->status == 0)
                                                            {{ Form::checkbox('domain-search-checkbox[]', $key, true, ['class' => 'selectDomain4']) }}
                                                        @else
                                                            <i class="fa fa-times red"></i>
                                                        @endif
                                                    </td>
                                                    <td id="domainName">
                                                        {{ $key }}
                                                    </td>
                                                    <td>
                                                        @if ($dp->status == 0)
                                                        <input type="hidden" name="text[{{ $key }}]" value="1" id="transfer_text">

                                                            <span class="label label-sm label-success">Available</span>
                                                        @else
                                                            <span class="label label-sm label-red">Unavailable</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($dp->status == 0)
                                                            {{ Form::select('domain-search-dropdown[' . $key . ']', $price_cycle_list, array_keys(array_slice($price_cycle_list, 1, 1, true))[0], ['class' => 'form-control input-medium']) }}
                                                        @else
                                                            <a href="http://{{ $key }}" target="_blank">
                                                                WWW
                                                            </a>
                                                            |
                                                            <a href="{{ route('frontend.domain.whois', $key) }}">
                                                                WHOIS
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)"
                                                            class="btn-sm btn-danger caps add_to_cart domain-search-add">
                                                            <i class="fa icon-basket-loaded"></i> <b>Add</b>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                            @endif

                            <a href="#" data-target="#notification" data-toggle="modal">
                                note to programmer: pop up notification example of not choosing any hosting plan, remove
                                this text once is done.
                            </a>

                            <!--Modal notification start-->
                            <div id="notification" tabindex="-1" role="dialog" aria-labelledby="modal-login-label"
                                aria-hidden="true" class="modal fade">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!--<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>-->
                                            <h4 id="modal-login-label3" class="modal-title">
                                                <i class="fa fa-exclamation-triangle"></i> You have not chosen any hosting
                                                plan yet
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <div data-dismiss="modal" aria-hidden="true" class="plainmodal-close"></div>
                                            <form>
                                                <div class="cforms alileft">
                                                    <p>
                                                        You have not chosen any hosting plan yet. Are you sure you wish to
                                                        continue?
                                                    </p>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-warning">
                                                            <b>GET A HOSTING FOR DOMAIN</b>
                                                        </button>
                                                        <button type="button" data-toggle="dropdown"
                                                            class="btn btn-warning dropdown-toggle">
                                                            <span class="caret"></span><span class="sr-only">Toggle
                                                                Dropdown</span>
                                                        </button>
                                                        <ul role="menu" class="dropdown-menu alileft">
                                                            <li>
                                                                <a href="/services/cloud_hosting">
                                                                    Cloud Hosting
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="/services/co-location_server">
                                                                    Co-location Hosting
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="/services/dedicated_servers">
                                                                    Dedicated Servers
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="/services/reseller_hosting">
                                                                    Reseller Hosting
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="/services/shared_hosting">
                                                                    Shared Hosting
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="/services/vps_hosting">
                                                                    VPS Hosting
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div><!-- end cforms -->

                                                <div class="clearfix margin_bottom1"></div>
                                                <div class="divider_line2"></div>
                                                <div class="clearfix margin_bottom1"></div>

                                                <div class="clearfix"></div>

                                                <div class="alicent">
                                                    <a href="#" class="btn btn-danger caps">
                                                        <i class="fa fa-plus"></i> <b>Add Hosting</b>
                                                    </a>&nbsp;
                                                    <a href="#" data-dismiss="modal" class="btn btn-primary caps">
                                                        <i class="fa fa-ban"></i> <b>No, thank you</b>
                                                    </a>&nbsp;
                                                </div>
                                                <div class="clearfix margin_bottom1"></div>
                                            </form>
                                        </div><!-- end modal-body -->
                                    </div>
                                </div>
                            </div>
                            <!--END MODAL notification -->

                            <div class="alicent" id="checkout_smt" style="display: none">
                                
                                {{ Form::button('<i class="fa icon-basket-loaded"></i><b>Proceed to checkout</b>', [
    'type' => 'submit',
    'class' => 'btn btn-danger caps',
]) }}&nbsp;
                            </div><!-- end domain search result -->
                            <div class="clearfix margin_bottom3"></div><!-- end section -->
                        </div>
                    </div><!-- end plan 1 -->
                    {{ Form::close() }}
                    <div class="clearfix"></div>
                </div><!-- end featured section 102 -->
            @endif

        @elseif(strpos($basePath, 'single_domain_transfer') !== false)
            <div class="page_title1 sty7">
                <h1>
                    TRANSFER YOUR DOMAIN
                    <!--<em>Huge Choice. Low Prices. Register your perfect domain name today.</em>
                          <span class="line2"></span>-->
                </h1>

                <div class="serch_area">
                    <form method="get" action="{{ route('frontend.services', 'single_domain_transfer') }}">
                        <input class="enter_email_input" name="transfer_domain" id="samplees" value=""
                            onFocus="if(this.value == '') {this.value = '';}" required
                            onBlur="if (this.value == '') {this.value = '';}" type="text"
                            placeholder="www.transferyourdomain">
                        <input name="" value="Transfer" class="input_submit" type="submit">
                    </form>
                    <br />
                    <div class="molinks"><a href="{{ route('frontend.services', 'bulk_domain_search') }}">
                            <i class="fa fa-caret-right"></i> Bulk Domain Search</a> <a
                            href="{{ route('frontend.services', 'bulk_domain_transfer') }}"><i
                                class="fa fa-caret-right"></i> Bulk Transfer</a>
                    </div>
                </div><!-- end section -->
            </div><!-- end page title -->

            @if (Session::has('failed'))
                <div class="feature_section102">
                    <div class="plan">
                        <div class="container">
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">
                                    &times;
                                </button>
                                <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                                <p>Invalid domain name(s) format.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($response) && !Session::has('failed'))
                <div class="clearfix margin_bottom5"></div>
                <div class="one_full stcode_title9 scroll-focus-marker">
                    <h1 class="caps">
                        <strong class='av2'>Available Domain for Transfer </strong>
                    </h1>
                </div>

                <div class="clearfix"></div>

                <div class="feature_section102">
                    <div class="plan">
                        <div class="container">
                            @if ($response->status_code == 1)
                                @if ($response->status_code == 'A')
                                    <h3 class="light red">
                                        <i class="fa fa-times-circle"></i> Sorry! Your domain is <strong>LOCKED</strong> and
                                        cannot be transferred without being unlocked.
                                    </h3>
                                @else
                                    <h3 class="light green">
                                        <i class="fa fa-check-circle"></i> Congratulations!
                                        <strong>{{ $response->domain }}</strong> is eligible for transfer!

                                    </h3>
                                @endif
                            @elseif($response->status_code == 0)
                                <h3 class="light red">
                                    <i class="fa fa-times-circle"></i> Sorry! <strong>{{ $response->domain }} does not
                                        appear to be registered yet.</strong> Try registering this domain instead.
                                    <span><a href="/services/single_domain_search?search_domain={{ $response->domain }}"
                                            class="btn-sm btn-danger caps"><i class="fa icon-basket-loaded"></i>
                                            <b>Add</b></a>&nbsp;</span>
                                </h3>
                            @elseif($response->status_code == 5)
                                <h3 class="light red">
                                    <i class="fa fa-times-circle"></i> Sorry! <strong>{{ $response->domain }} can't be
                                        transferred.</strong> Transferring Prohibited.
                                </h3>
                            @else
                                <!-- <h3 class="light red"><i class="fa fa-times-circle"></i> Sorry!
                                          <strong>{{-- $response->domain --}}
                                              extension is not allowed!</strong>
                                      </h3> -->
                            @endif

                            @if ($response->status_code == 0 || $response->status_code == 1 || $response->status_code == 5)
                                <div class="alertymes6">
                                    <h3 class="light alileft">
                                        <i class="fa fa-list-alt"></i><strong>Domain Transfer Checklist</strong>
                                    </h3>
                                    <div class="clearfix margin_bottom1"></div>
                                    <div class="one_half_less">
                                        <div class="alileft">
                                            <ul>
                                                <li>
                                                    <i class="fa fa-long-arrow-right dark"></i><span
                                                        class="text-18px dark light">Is Domain Privacy
                                                        disabled?</span>&nbsp;
                                                    <span
                                                        class="text-18px {{ $response->privacy ? 'red' : 'green' }}"><b>{{ $response->privacy ? 'No' : 'Yes' }}</b></span>
                                                </li>
                                                <li>
                                                    <i class="fa fa-long-arrow-right dark"></i><span
                                                        class="text-18px dark light">Is the domain older than 60
                                                        days?</span>&nbsp;
                                                    <span
                                                        class="text-18px {{ $response->reg_days > 60 ? 'green' : 'red' }}"><b>{{ $response->reg_days > 60 ? 'Yes' : 'No' }}</b></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- end section -->
                                <div class="clearfix margin_bottom3"></div>
                            @endif
                             {{ Form::open(['url' => url('/domain_configuration')]) }}
                            <div class="table-responsive mtl">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th width="1%">
                                                @if ($response->status_code == 1)

                                                    <input type="checkbox" id="selectAll6" />
                                                @endif
                                            </th>

                                            <th>Domain Name </th>
                                            
                                            <th>Enter Domain Password</th>
                                            <th>Domain Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="alicent">
                                                @if ($response->status_code == 1)
                                                {{ Form::checkbox('domain-search-checkbox[]', $response->domain, true, ['class' => 'selectDomain6']) }}
                                                    <!-- <input type="checkbox" class="selectDomain6" checked="checked" /> -->
                                                @else
                                                    <i class="fa fa-times red"></i>
                                                @endif
                                            </td>
                                            <td>{{ $response->domain }}</td>

                                            <td>
                                                @if ($response->status_code == 1)
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter domain password">
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($response->status_code == 1)
                                                {{ Form::select('domain-search-dropdown[' . $response->domain . ']', $price_cycle_list, array_keys(array_slice($price_cycle_list, 1, 1, true))[0], ['class' => 'form-control input-medium']) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($response->status_code == 1)
                                                @if($response->text != '')
                                                <?php $text = $response->text; ?>

                                                @else
                                                <?php $text = ''; ?>
                                                @endif
                                                <input type="hidden" name="text[{{$response->domain}}]" value="2" id="transfer_text">

                                                <a href="javascript:void(0)" 
                                                class="btn-sm btn-danger caps add_to_cart domain-search-add">
                                                <i class="fa icon-basket-loaded"></i> <b>Add</b>
                                              </a>&nbsp;
                                                @else
                                                    <a href="#" class="btn-sm btn-danger caps disabled">
                                                        <i class="fa icon-basket-loaded"></i> <b>Add</b>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="clearfix"></div>
                            </div>

                            <div class="clearfix"></div>
                            @if ($response->status_code == 1)
                                
                                <div class="alicent" id="checkout_smt" style="display: none">
                                
                                    {{ Form::button('<i class="fa icon-basket-loaded"></i><b>Proceed to checkout</b>', [
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger caps',
                                    ]) }}&nbsp;
                                </div><!-- end domain search result -->

                            @endif
                            {{ Form::close() }}
                        </div>
                    </div><!-- end plan 1 -->
                    <div class="clearfix"></div>
                </div><!-- end featured section 102 -->
            @endif
        @else
            <div class="page_title1 sty2">
            </div>
            <div class="clearfix"></div>

            <div class="price_compare" style="padding: 0px;">
                <br />
                <div class="container">
                    @if (session()->has('success'))
                        <div class="alertymes5">
                            <h3 class="light">
                                <i class="fa fa-check-circle"></i><strong>Query Created </strong>
                                <br />
                                Your query has been successfully created.
                            </h3>
                        </div>

                        <br />
                        <br />
                    @endif

                    <div class="clearfix margin_bottom5"></div>
                    <div class="clearfix"></div>
                    <div class="one_full stcode_title9">
                        <h1 class="caps">
                            <strong>{{ $page_name }} Plans</strong>
                            <em>Get Started Today!</em>
                            <span class="line"></span>
                        </h1>
                    </div>
                    <div class="clearfix margin_bottom5"></div>

                    <div class="clearfix"></div>

                    @if (count($plans) > 0)
                        @include("frontend._hosting_plans")
                    @else
                        <p>No Plans found</p>
                    @endif
                </div>
            </div><!-- end choose plans -->
        @endif

        <!-- Domain Transfer Services Initial view: start -->
        @if (strpos($basePath, 'bulk_domain_transfer') !== false || strpos($basePath, 'single_domain_transfer') !== false)
            <div class="feature_section103">
                <div class="container">
                    <h1 class="caps white">
                        <strong>{{(!empty($general_features) && isset($general_features[0]->heading) && $general_features[0]->heading!='') ? $general_features[0]->heading : 'Why transfer to Webqom?'}}</strong>
                    </h1>

                    <div class="clearfix margin_bottom2"></div>

                    @if(!empty($general_features))
                        @foreach($general_features as $feature)

                        <div class="box animate" data-anim-type="fadeIn" data-anim-delay="100">
                            <i class="fa {{$feature->icon}}"></i>
                            <h4>
                                {{$feature->title}}
                                <div class="line"></div>
                            </h4>
                            <p class="sky-blue">{{$feature->description}}</p>
                        </div>

                        @endforeach
                    @endif    
                        <!--
                        <div class="box animate" data-anim-type="fadeIn" data-anim-delay="100">
                            <i class="fa fa-dollar"></i>
                            <h4>
                                Competitive Price
                                <div class="line"></div>
                            </h4>
                            <p class="sky-blue">You enjoy big savings instantly!</p>
                        </div>

                        <div class="box two animate" data-anim-type="fadeIn" data-anim-delay="100">
                            <i class="fa fa-heart-o"></i>
                            <h4>
                                Customer Driven Services
                                <div class="line"></div>
                            </h4>
                            <p class="sky-blue">Customer service staff ready to help you.</p>
                        </div>

                        <div class="box two animate" data-anim-type="fadeIn" data-anim-delay="100">
                            <i class="fa icon-rocket"></i>
                            <h4>
                                Efficiency and Effectively
                                <div class="line"></div>
                            </h4>
                            <p class="sky-blue">Manage all your internet tasks in just one stop.</p>
                        </div>

                        <div class="box two last animate" data-anim-type="fadeIn" data-anim-delay="100">
                            <i class="fa icon-list"></i>
                            <h4>
                                Widest Range of TLD to Choose From
                                <div class="line"></div>
                            </h4>
                            <p class="sky-blue">Easy access to register with other countries top level domain.</p>
                        </div>

                    -->

                    <div class="clearfix"></div>
                </div>
            </div><!-- end featured section 103 -->
            <div class="clearfix"></div>
        @endif

        <div class="clearfix"></div>

        @if ($page_slug == 'co_cloud_hosting' || $page_slug == 'shared_hosting' || $duplicate_from == 'co_cloud_hosting' || $duplicate_from == 'shared_hosting')
            <div class="feature_section7">
                <div class="container">
                    <h1 class="caps">
                        <strong>
                            @if (count($general_features) > 0)
                                <h1 class="caps"><strong> {{ $general_features[0]['heading'] or '' }} </strong></h1>
                            @endif
                        </strong>
                    </h1>

                    @if (!empty($general_features))
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($general_features as $i)
                            @php
                                $count++;
                            @endphp
                            <div class="one_fifth_less @if ($count % 5==0) last @endif">
                                <h5 class="caps">
                                    @if ($i->icon != '')
                                        <i class="fa {{ $i->icon }}"></i>
                                    @elseif($i->icon_image != "")
                                        <img src="{{ asset('/storage/general_features/icon_images/' . $i->icon_image) }}"
                                            style="display: block;margin-left: auto;margin-right: auto;" />
                                    @endif

                                    {{ $i->title }}
                                </h5>
                            </div><!-- end -->

                            @if ($count % 5 == 0)
                                <div class="clearfix margin_bottom2"></div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div><!-- end featured section 7 -->
        @endif

        <div class="clearfix"></div>

        {!! $cms->content !!}

        @if (strpos($basePath, 'bulk_domain_search') !== false)
            <div class="feature_section11">
                <div class="container">
                    <ul class="tabs">
                        <li class="active">New Registrations</li>
                        <li>Renewals</li>
                        <li>Transfers</li>
                    </ul>

                    <ul class="tab__content">
                        <li class="active">
                            <div class="content__wrapper">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        @foreach ($domain_pricing as $i)
                                            @if (isset($i['listing']))
                                                <thead>
                                                    <tr>
                                                        <th class="alicent">{{ $i['listing']['tld'] }}</th>
                                                        <th class="alicent">1 Year</th>
                                                        <th class="alicent">2 Years</th>
                                                        <th class="alicent">3 Years</th>
                                                        <th class="alicent">4 Years</th>
                                                        <th class="alicent">5 Years</th>
                                                        <th class="alicent">6 Years</th>
                                                        <th class="alicent">7 Years</th>
                                                        <th class="alicent">8 Years</th>
                                                        <th class="alicent">9 Years</th>
                                                        <th class="alicent">10 Years</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($RMSALE as $key => $domain)
                                                        @php
                                                            $index = $key;
                                                            $pricing = $i->bulk_pricing->where('duration', $domain['duration'])->first();
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $domain['duration'] }}</td>
                                                            <td class="alicent">
                                                                <span class="red">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_1) ? $pricing->year_sale_1 : '' }}
                                                                    *
                                                                </span>
                                                                <br />
                                                                <span class="strike">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_1) ? $pricing->year_list_1 : '' }}
                                                                    *
                                                                </span>
                                                            </td>
                                                            <td class="alicent">
                                                                <span class="red">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_2) ? $pricing->year_sale_2 : '' }}
                                                                    *
                                                                </span>
                                                                <br />
                                                                <span class="strike">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_2) ? $pricing->year_list_2 : '' }}
                                                                    *
                                                                </span>
                                                            </td>
                                                            <td class="alicent">
                                                                <span class="red">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_3) ? $pricing->year_sale_3 : '' }}
                                                                    *
                                                                </span>
                                                                <br />
                                                                <span class="strike">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_3) ? $pricing->year_list_3 : '' }}
                                                                    *
                                                                </span>
                                                            </td>
                                                            <td class="alicent">
                                                                <span class="red">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_4) ? $pricing->year_sale_4 : '' }}
                                                                    *
                                                                </span>
                                                                <br />
                                                                <span class="strike">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_4) ? $pricing->year_list_4 : '' }}
                                                                    *
                                                                </span>
                                                            </td>
                                                            <td class="alicent">
                                                                <span class="red">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_5) ? $pricing->year_sale_5 : '' }}
                                                                    *
                                                                </span>
                                                                <br />
                                                                <span class="strike">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_5) ? $pricing->year_list_5 : '' }}
                                                                    *
                                                                </span>
                                                            </td>
                                                            <td class="alicent">
                                                                <span class="red">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_6) ? $pricing->year_sale_6 : '' }}
                                                                    *
                                                                </span>
                                                                <br />
                                                                <span class="strike">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_6) ? $pricing->year_list_6 : '' }}
                                                                    *
                                                                </span>
                                                            </td>
                                                            <td class="alicent">
                                                                <span class="red">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_7) ? $pricing->year_sale_7 : '' }}
                                                                    *
                                                                </span>
                                                                <br />
                                                                <span class="strike">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_7) ? $pricing->year_list_7 : '' }}
                                                                    *
                                                                </span>
                                                            </td>
                                                            <td class="alicent">
                                                                <span class="red">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_8) ? $pricing->year_sale_8 : '' }}
                                                                    *
                                                                </span>
                                                                <br />
                                                                <span class="strike">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_8) ? $pricing->year_list_8 : '' }}
                                                                    *
                                                                </span>
                                                            </td>
                                                            <td class="alicent">
                                                                <span class="red">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_9) ? $pricing->year_sale_9 : '' }}
                                                                    *
                                                                </span>
                                                                <br />
                                                                <span class="strike">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_9) ? $pricing->year_list_9 : '' }}
                                                                    *
                                                                </span>
                                                            </td>
                                                            <td class="alicent">
                                                                <span class="red">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_10) ? $pricing->year_sale_10 : '' }}
                                                                    *
                                                                </span>
                                                                <br />
                                                                <span class="strike">
                                                                    RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_10) ? $pricing->year_list_10 : '' }}
                                                                    *
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @endif
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <td colspan="6"></td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div class="clearfix"></div>
                                </div><!-- end table responsive -->
                            </div>
                        </li><!-- end tab 1 -->
                        <li>
                            <div class="content__wrapper">
                                {{-- <div class="table-responsive"> --}}
                                {{-- <table class="table table-hover table-striped"> --}}
                                {{-- <thead> --}}
                                {{-- <tr> --}}
                                {{-- <th class="alicent">.com</th> --}}
                                {{-- <th class="alicent">1 Year</th> --}}
                                {{-- <th class="alicent">2 Years</th> --}}
                                {{-- <th class="alicent">3 Years</th> --}}
                                {{-- <th class="alicent">5 Years</th> --}}
                                {{-- <th class="alicent">10 Years</th> --}}
                                {{-- </tr> --}}
                                {{-- </thead> --}}
                                {{-- <tbody> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>1-5</b></td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>6-20</b></td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>21-49</b></td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>50-100</b></td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>101-200</b></td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>201-500</b></td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- </tr> --}}

                                {{-- </tbody> --}}

                                {{-- <thead> --}}
                                {{-- <tr> --}}
                                {{-- <th class="alicent">.info</th> --}}
                                {{-- <th class="alicent">1 Year</th> --}}
                                {{-- <th class="alicent">2 Years</th> --}}
                                {{-- <th class="alicent">3 Years</th> --}}
                                {{-- <th class="alicent">5 Years</th> --}}
                                {{-- <th class="alicent">10 Years</th> --}}
                                {{-- </tr> --}}
                                {{-- </thead> --}}
                                {{-- <tbody> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>1-5</b></td> --}}
                                {{-- <td class="alicent"><span class="red">RM 57.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 65.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 68.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 71.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 72.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>6-20</b></td> --}}
                                {{-- <td class="alicent"><span class="red">RM 57.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 65.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 68.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 71.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 72.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>21-49</b></td> --}}
                                {{-- <td class="alicent"><span class="red">RM 57.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 59.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 60.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 60.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent">RM 61.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>50-100</b></td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>101-200</b></td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>201-500</b></td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- </tr> --}}

                                {{-- </tbody> --}}

                                {{-- <tfoot> --}}
                                {{-- <tr> --}}
                                {{-- <td colspan="6"></td> --}}
                                {{-- </tr> --}}
                                {{-- </tfoot> --}}
                                {{-- </table> --}}
                                {{-- <div class="clearfix"></div> --}}

                                {{-- </div><!-- end table responsive --> --}}
                            </div>
                        </li><!-- end tab 2 -->

                        <li>
                            <div class="content__wrapper">

                                {{-- <div class="table-responsive"> --}}
                                {{-- <table class="table table-hover table-striped"> --}}
                                {{-- <thead> --}}
                                {{-- <tr> --}}
                                {{-- <th class="alicent">.com</th> --}}
                                {{-- <th class="alicent">1 Year</th> --}}
                                {{-- <th class="alicent">2 Years</th> --}}
                                {{-- <th class="alicent">3 Years</th> --}}
                                {{-- <th class="alicent">5 Years</th> --}}
                                {{-- <th class="alicent">10 Years</th> --}}
                                {{-- </tr> --}}
                                {{-- </thead> --}}
                                {{-- <tbody> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>1-5</b></td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>6-20</b></td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>21-49</b></td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>50-100</b></td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>101-200</b></td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>201-500</b></td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- </tr> --}}

                                {{-- </tbody> --}}

                                {{-- <thead> --}}
                                {{-- <tr> --}}
                                {{-- <th class="alicent">.info</th> --}}
                                {{-- <th class="alicent">1 Year</th> --}}
                                {{-- <th class="alicent">2 Years</th> --}}
                                {{-- <th class="alicent">3 Years</th> --}}
                                {{-- <th class="alicent">5 Years</th> --}}
                                {{-- <th class="alicent">10 Years</th> --}}
                                {{-- </tr> --}}
                                {{-- </thead> --}}
                                {{-- <tbody> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>1-5</b></td> --}}
                                {{-- <td class="alicent"><span class="red">RM 57.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 65.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 68.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 71.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 72.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>6-20</b></td> --}}
                                {{-- <td class="alicent"><span class="red">RM 57.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 65.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 68.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 71.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 72.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>21-49</b></td> --}}
                                {{-- <td class="alicent"><span class="red">RM 57.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 59.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 60.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 60.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent">RM 61.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>50-100</b></td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>101-200</b></td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>201-500</b></td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- </tr> --}}

                                {{-- </tbody> --}}

                                {{-- <tfoot> --}}
                                {{-- <tr> --}}
                                {{-- <td colspan="6"></td> --}}
                                {{-- </tr> --}}
                                {{-- </tfoot> --}}
                                {{-- </table> --}}
                                {{-- <div class="clearfix"></div> --}}

                                {{-- </div><!-- end table responsive --> --}}

                            </div>
                        </li><!-- end tab 3 -->
                    </ul>

                    <p class="alileft red">* Terms &amp; conditions apply.</p>
                </div>
            </div><!-- end feature section 11 -->
            <div class="clearfix"></div>
        @elseif(strpos($basePath, 'single_domain_search') !== false)
            <div class="feature_section11">
                <div class="container">
                    <form type="POST" id="gsr-contact" onSubmit="return valid_datas( this );">
                        <label class="text-16px dark">
                            <b>Show the Domain Pricing for:</b>
                        </label>
                        <div class="radiobut text-16px light dark">
                            <input type="radio" id="all" checked="checked" name="tld" /> <span class="onelb">All
                                TLD</span>&nbsp;
                            @php
                                $counter = 0;
                            @endphp

                            @foreach ($domainPricing as $dp)
                                <input type="radio" id="{{ $dp->id }}" ccount="{{ ($counter + 1) * 3 }}"
                                    name="tld" /> <span class="onelb">{{ $dp->title }}</span>&nbsp;
                                @php
                                    $counter++;
                                @endphp

                                @if ($counter % 6 == 0)
                                    <br />
                                @endif
                            @endforeach
                            {{-- <input type="radio" id="general" name="tld"> <span class="onelb">General TLD</span>&nbsp;
                    <input type="radio" id="america" name="tld"> <span class="onelb">America TLD</span>&nbsp;
                    <input type="radio" id="asia" name="tld"> <span class="onelb">Asia Pacific TLD</span>&nbsp;
                    <input type="radio" id="europe" name="tld"> <span class="onelb">Europe TLD</span>&nbsp; --}}
                        </div>
                    </form>
                    <div class="clearfix margin_bottom5"></div>

                    note to programmer: show the TLD pricing list based on the selection above. If selected America TLD,
                    then display the America TLD pricing table below.

                    <ul class="tabs">
                        <li class="active">New Registrations</li>
                        <li>Renewals</li>
                        <li>Transfers</li>
                    </ul>

                    <ul class="tab__content">
                        <li class="active">
                            <div class="content__wrapper">
                                <h4>All TLD - New</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="alicent">Per Year Pricing</th>
                                                <th class="alicent">1 Year</th>
                                                <th class="alicent">2 Years</th>
                                                <th class="alicent">3 Years</th>
                                                <th class="alicent">5 Years</th>
                                                <th class="alicent">10 Years</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($domainPricingList as $dpl)
                                                @if ($dpl->type == 'new')
                                                    <tr>
                                                        @php
                                                            $prices = json_decode($dpl->pricing, true);
                                                            $prices = (array) $prices;
                                                        @endphp

                                                        <td>
                                                            <b>{{ $dpl->tld }}</b>
                                                        </td>

                                                        @for ($i = 1; $i <= count($prices); $i++)
                                                            @if ($i == 1 || $i == 2 || $i == 3 || $i ==
                                                            5 || $i == 10) <td class="alicent">
                                                            <span class="red">RM {{ $prices[$i]['s'] }}
                                                            *</span>
                                                            <br />
                                                            <span class="strike">RM
                                                            {{ $prices[$i]['l'] }}*</span>
                                                            </td> @endif
                                                        @endfor
                                                        {{-- <td><a href="#shopping_cart.html" class="btn-sm btn-danger caps"><i class="fa icon-basket-loaded"></i> <b>Buy</b></a></td> --}}
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="7"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                </div><!-- end table responsive -->
                            </div>
                        </li><!-- end tab 1 -->

                        <li>
                            <div class="content__wrapper">
                                <h4>All TLD - Renewals</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="alicent">Per Year Pricing</th>
                                                <th class="alicent">1 Year</th>
                                                <th class="alicent">2 Years</th>
                                                <th class="alicent">3 Years</th>
                                                <th class="alicent">5 Years</th>
                                                <th class="alicent">10 Years</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($domainPricingList as $dpl)
                                                @if ($dpl->type == 'renewal')
                                                    <tr>
                                                        @php
                                                            $prices = json_decode($dpl->pricing, true);
                                                            $prices = (array) $prices;
                                                        @endphp

                                                        <td>
                                                            <b>{{ $dpl->tld }}</b>
                                                        </td>

                                                        @for ($i = 1; $i <= count($prices); $i++)
                                                            @if ($i == 1 || $i == 2 || $i == 3 || $i ==
                                                            5 || $i == 10) <td class="alicent">
                                                            <span class="red">RM {{ $prices[$i]['s'] }}
                                                            *</span>
                                                            <br />
                                                            <span class="strike">RM
                                                            {{ $prices[$i]['l'] }}*</span>
                                                            </td> @endif
                                                        @endfor
                                                        <td>
                                                            <a href="{{ url('/shopping_cart)')}}" class="btn-sm btn-danger caps">
                                                                <i class="fa icon-basket-loaded"></i> <b>Buy</b>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="7"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                </div><!-- end table responsive -->
                            </div>
                        </li><!-- end tab 2 -->

                        <li>
                            <div class="content__wrapper">
                                <h4>All TLD - Transfers</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="alicent">Per Year Pricing</th>
                                                <th class="alicent">1 Year</th>
                                                <th class="alicent">2 Years</th>
                                                <th class="alicent">3 Years</th>
                                                <th class="alicent">5 Years</th>
                                                <th class="alicent">10 Years</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($domainPricingList as $dpl)
                                                @if ($dpl->type == 'transfer')
                                                    <tr>
                                                        @php
                                                            $prices = json_decode($dpl->pricing, true);
                                                            $prices = (array) $prices;
                                                        @endphp

                                                        <td>
                                                            <b>{{ $dpl->tld }}</b>
                                                        </td>
                                                        @for ($i = 1; $i <= count($prices); $i++)
                                                            @if ($i == 1 || $i == 2 || $i == 3 || $i ==
                                                            5 || $i == 10) <td class="alicent">
                                                            <span class="red">RM {{ $prices[$i]['s'] }}
                                                            *</span>
                                                            <br />
                                                            <span class="strike">RM
                                                            {{ $prices[$i]['l'] }}*</span>
                                                            </td> @endif
                                                        @endfor
                                                        <td>
                                                            <a href="{{ url('/shopping_cart')}}" class="btn-sm btn-danger caps">
                                                                <i class="fa icon-basket-loaded"></i> <b>Buy</b>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                </div><!-- end table responsive -->
                            </div>
                        </li><!-- end tab 3 -->

                        @foreach ($domainPricing as $dp)
                            <li>
                                <div class="content__wrapper">
                                    <h4>
                                        {{ $dp->title }} - New
                                    </h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="alicent">Per Year Pricing</th>
                                                    <th class="alicent">1 Year</th>
                                                    <th class="alicent">2 Years</th>
                                                    <th class="alicent">3 Years</th>
                                                    <th class="alicent">5 Years</th>
                                                    <th class="alicent">10 Years</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($domainPricingList as $dpl)
                                                    @if ($dpl->type == 'new' && $dpl->domain_pricing_id == $dp->id)
                                                        <tr>
                                                            @php
                                                                $prices = json_decode($dpl->pricing, true);
                                                                $prices = (array) $prices;
                                                            @endphp

                                                            <td>
                                                                <b>{{ $dpl->tld }}</b>
                                                            </td>

                                                            @for ($i = 1; $i <= count($prices); $i++)
                                                                @if ($i == 1 || $i == 2 || $i == 3 || $i
                                                                == 5 || $i == 10) <td
                                                                class="alicent">
                                                                <span class="red">
                                                                RM {{ $prices[$i]['s'] }} *
                                                                </span>
                                                                <br />
                                                                <span class="strike">
                                                                RM {{ $prices[$i]['l'] }} *
                                                                </span>
                                                                </td> @endif
                                                            @endfor
                                                            <td>
                                                                <a href="{{url('/shopping_cart')}}"
                                                                    class="btn-sm btn-danger caps">
                                                                    <i class="fa icon-basket-loaded"></i> <b>Buy</b>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="clearfix"></div>
                                    </div><!-- end table responsive -->
                                </div>
                            </li>

                            <li>
                                <div class="content__wrapper">
                                    <h4>{{ $dp->title }} - Renewals</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="alicent">Per Year Pricing</th>
                                                    <th class="alicent">1 Year</th>
                                                    <th class="alicent">2 Years</th>
                                                    <th class="alicent">3 Years</th>
                                                    <th class="alicent">5 Years</th>
                                                    <th class="alicent">10 Years</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($domainPricingList as $dpl)
                                                    @if ($dpl->type == 'renewal' && $dpl->domain_pricing_id == $dp->id)
                                                        <tr>
                                                            @php
                                                                $prices = json_decode($dpl->pricing, true);
                                                                $prices = (array) $prices;
                                                            @endphp

                                                            <td><b>{{ $dpl->tld }}</b></td>

                                                            @for ($i = 1; $i <= count($prices); $i++)
                                                                @if ($i == 1 || $i == 2 || $i == 3 || $i
                                                                == 5 || $i == 10) <td
                                                                class="alicent">
                                                                <span class="red">RM
                                                                {{ $prices[$i]['s'] }} *</span>
                                                                <br />
                                                                <span class="strike">RM
                                                                {{ $prices[$i]['l'] }}*</span>
                                                                </td> @endif
                                                            @endfor
                                                            <td>
                                                                <a href="{{url('/shopping_cart')}}"
                                                                    class="btn-sm btn-danger caps">
                                                                    <i class="fa icon-basket-loaded"></i> <b>Buy</b>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="clearfix"></div>
                                    </div><!-- end table responsive -->
                                </div>
                            </li>
                            <li>
                                <div class="content__wrapper">
                                    <h4>{{ $dp->title }} - Transfers</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="alicent">Per Year Pricing</th>
                                                    <th class="alicent">1 Year</th>
                                                    <th class="alicent">2 Years</th>
                                                    <th class="alicent">3 Years</th>
                                                    <th class="alicent">5 Years</th>
                                                    <th class="alicent">10 Years</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($domainPricingList as $dpl)
                                                    @if ($dpl->type == 'transfer' && $dpl->domain_pricing_id == $dp->id)
                                                        <tr>
                                                            @php
                                                                $prices = json_decode($dpl->pricing, true);
                                                                $prices = (array) $prices;
                                                            @endphp

                                                            <td><b>{{ $dpl->tld }}</b></td>
                                                            @for ($i = 1; $i <= count($prices); $i++)
                                                                @if ($i == 1 || $i == 2 || $i == 3 || $i
                                                                == 5 || $i == 10) <td
                                                                class="alicent">
                                                                <span class="red">
                                                                RM {{ $prices[$i]['s'] }} *
                                                                </span>
                                                                <br />
                                                                <span class="strike">
                                                                RM {{ $prices[$i]['l'] }}*
                                                                </span>
                                                                </td> @endif
                                                            @endfor
                                                            <td>
                                                                <a href="{{ url('/shopping_cart')}}"
                                                                    class="btn-sm btn-danger caps">
                                                                    <i class="fa icon-basket-loaded"></i> <b>Buy</b>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="clearfix"></div>
                                    </div><!-- end table responsive -->
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="clearfix"></div>

                    <p class="alileft red">
                        * Plus ICANN fee of RM0.82 per domain name year. Certain TLD's only.
                        <br />
                        ± com.au, net.au, and org.au domain names can only be registered for 2 years.
                    </p>

                </div>
            </div><!-- end feature section 11 -->
            <div class="clearfix"></div>
        @elseif(strpos($basePath, 'bulk_domain_transfer'))
            <div class="feature_section11">
                <div class="container">
                    <ul class="tabs">
                        <li class="active">New Registrations</li>
                        <li>Renewals</li>
                        <li>Transfers</li>
                    </ul>

                    <ul class="tab__content">

                        <li class="active">
                            <div class="content__wrapper">

                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        @foreach ($domain_pricing as $i)
                                            @if (isset($i['listing']))
                                                <thead>
                                                    <tr>
                                                        <th class="alicent">{{ $i['listing']['tld'] }}</th>
                                                        <th class="alicent">1 Year</th>
                                                        <th class="alicent">2 Years</th>
                                                        <th class="alicent">3 Years</th>
                                                        <th class="alicent">4 Years</th>
                                                        <th class="alicent">5 Years</th>
                                                        <th class="alicent">6 Years</th>
                                                        <th class="alicent">7 Years</th>
                                                        <th class="alicent">8 Years</th>
                                                        <th class="alicent">9 Years</th>
                                                        <th class="alicent">10 Years</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($RMSALE as $key => $domain)
                                                        <?php
                                                        $index = $key;
                                                        $pricing = $i->bulk_pricing->where('duration',
                                                        $domain['duration'])->first();
                                                        ?>
                                                        <tr>
                                                            <td>{{ $domain['duration'] }}</td>
                                                            <td class="alicent"><span class="red">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_1) ? $pricing->year_sale_1 : '' }}
                                                                    *</span><br />
                                                                <span class="strike">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_1) ? $pricing->year_list_1 : '' }}
                                                                    *</span>
                                                            </td>
                                                            <td class="alicent"><span class="red">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_2) ? $pricing->year_sale_2 : '' }}
                                                                    *</span><br />
                                                                <span class="strike">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_2) ? $pricing->year_list_2 : '' }}
                                                                    *</span>
                                                            </td>
                                                            <td class="alicent"><span class="red">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_3) ? $pricing->year_sale_3 : '' }}
                                                                    *</span><br />
                                                                <span class="strike">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_3) ? $pricing->year_list_3 : '' }}
                                                                    *</span>
                                                            </td>
                                                            <td class="alicent"><span class="red">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_4) ? $pricing->year_sale_4 : '' }}
                                                                    *</span><br />
                                                                <span class="strike">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_4) ? $pricing->year_list_4 : '' }}
                                                                    *</span>
                                                            </td>
                                                            <td class="alicent"><span class="red">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_5) ? $pricing->year_sale_5 : '' }}
                                                                    *</span><br />
                                                                <span class="strike">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_5) ? $pricing->year_list_5 : '' }}
                                                                    *</span>
                                                            </td>
                                                            <td class="alicent"><span class="red">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_6) ? $pricing->year_sale_6 : '' }}
                                                                    *</span><br />
                                                                <span class="strike">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_6) ? $pricing->year_list_6 : '' }}
                                                                    *</span>
                                                            </td>
                                                            <td class="alicent"><span class="red">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_7) ? $pricing->year_sale_7 : '' }}
                                                                    *</span><br />
                                                                <span class="strike">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_7) ? $pricing->year_list_7 : '' }}
                                                                    *</span>
                                                            </td>
                                                            <td class="alicent"><span class="red">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_8) ? $pricing->year_sale_8 : '' }}
                                                                    *</span><br />
                                                                <span class="strike">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_8) ? $pricing->year_list_8 : '' }}
                                                                    *</span>
                                                            </td>
                                                            <td class="alicent"><span class="red">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_9) ? $pricing->year_sale_9 : '' }}
                                                                    *</span><br />
                                                                <span class="strike">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_9) ? $pricing->year_list_9 : '' }}
                                                                    *</span>
                                                            </td>
                                                            <td class="alicent"><span class="red">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_sale_10) ? $pricing->year_sale_10 : '' }}
                                                                    *</span><br />
                                                                <span class="strike">RM
                                                                    {{ !empty($pricing) && !empty($pricing->year_list_10) ? $pricing->year_list_10 : '' }}
                                                                    *</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @endif
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <td colspan="6"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>

                                </div><!-- end table responsive -->


                            </div>
                        </li><!-- end tab 1 -->

                        <li>
                            <div class="content__wrapper">

                                {{-- <div class="table-responsive"> --}}
                                {{-- <table class="table table-hover table-striped"> --}}
                                {{-- <thead> --}}
                                {{-- <tr> --}}
                                {{-- <th class="alicent">.com</th> --}}
                                {{-- <th class="alicent">1 Year</th> --}}
                                {{-- <th class="alicent">2 Years</th> --}}
                                {{-- <th class="alicent">3 Years</th> --}}
                                {{-- <th class="alicent">5 Years</th> --}}
                                {{-- <th class="alicent">10 Years</th> --}}
                                {{-- </tr> --}}
                                {{-- </thead> --}}
                                {{-- <tbody> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>1-5</b></td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>6-20</b></td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>21-49</b></td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>50-100</b></td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>101-200</b></td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>201-500</b></td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- </tr> --}}

                                {{-- </tbody> --}}

                                {{-- <thead> --}}
                                {{-- <tr> --}}
                                {{-- <th class="alicent">.info</th> --}}
                                {{-- <th class="alicent">1 Year</th> --}}
                                {{-- <th class="alicent">2 Years</th> --}}
                                {{-- <th class="alicent">3 Years</th> --}}
                                {{-- <th class="alicent">5 Years</th> --}}
                                {{-- <th class="alicent">10 Years</th> --}}
                                {{-- </tr> --}}
                                {{-- </thead> --}}
                                {{-- <tbody> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>1-5</b></td> --}}
                                {{-- <td class="alicent"><span class="red">RM 57.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 65.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 68.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 71.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 72.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>6-20</b></td> --}}
                                {{-- <td class="alicent"><span class="red">RM 57.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 65.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 68.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 71.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 72.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>21-49</b></td> --}}
                                {{-- <td class="alicent"><span class="red">RM 57.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 59.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 60.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 60.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent">RM 61.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>50-100</b></td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>101-200</b></td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>201-500</b></td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- </tr> --}}

                                {{-- </tbody> --}}

                                {{-- <tfoot> --}}
                                {{-- <tr> --}}
                                {{-- <td colspan="6"></td> --}}
                                {{-- </tr> --}}
                                {{-- </tfoot> --}}
                                {{-- </table> --}}
                                {{-- <div class="clearfix"></div> --}}

                                {{-- </div><!-- end table responsive --> --}}

                            </div>
                        </li><!-- end tab 2 -->

                        <li>
                            <div class="content__wrapper">

                                {{-- <div class="table-responsive"> --}}
                                {{-- <table class="table table-hover table-striped"> --}}
                                {{-- <thead> --}}
                                {{-- <tr> --}}
                                {{-- <th class="alicent">.com</th> --}}
                                {{-- <th class="alicent">1 Year</th> --}}
                                {{-- <th class="alicent">2 Years</th> --}}
                                {{-- <th class="alicent">3 Years</th> --}}
                                {{-- <th class="alicent">5 Years</th> --}}
                                {{-- <th class="alicent">10 Years</th> --}}
                                {{-- </tr> --}}
                                {{-- </thead> --}}
                                {{-- <tbody> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>1-5</b></td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>6-20</b></td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- <td class="alicent">RM 69.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>21-49</b></td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- <td class="alicent">RM44.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>50-100</b></td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- <td class="alicent">RM 39.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>101-200</b></td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>201-500</b></td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- <td class="alicent">RM 36.99*</td> --}}
                                {{-- </tr> --}}

                                {{-- </tbody> --}}

                                {{-- <thead> --}}
                                {{-- <tr> --}}
                                {{-- <th class="alicent">.info</th> --}}
                                {{-- <th class="alicent">1 Year</th> --}}
                                {{-- <th class="alicent">2 Years</th> --}}
                                {{-- <th class="alicent">3 Years</th> --}}
                                {{-- <th class="alicent">5 Years</th> --}}
                                {{-- <th class="alicent">10 Years</th> --}}
                                {{-- </tr> --}}
                                {{-- </thead> --}}
                                {{-- <tbody> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>1-5</b></td> --}}
                                {{-- <td class="alicent"><span class="red">RM 57.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 65.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 68.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 71.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 72.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>6-20</b></td> --}}
                                {{-- <td class="alicent"><span class="red">RM 57.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 65.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 68.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 71.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 72.99*</span><br/> --}}
                                {{-- <span class="strike">RM 74.99*</span> --}}
                                {{-- </td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>21-49</b></td> --}}
                                {{-- <td class="alicent"><span class="red">RM 57.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 59.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 60.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent"><span class="red">RM 60.99*</span><br/> --}}
                                {{-- <span class="strike">RM 61.99*</span> --}}
                                {{-- </td> --}}
                                {{-- <td class="alicent">RM 61.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>50-100</b></td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- <td class="alicent">RM 52.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>101-200</b></td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- </tr> --}}
                                {{-- <tr> --}}
                                {{-- <td><b>201-500</b></td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- <td class="alicent">RM 43.99*</td> --}}
                                {{-- </tr> --}}

                                {{-- </tbody> --}}

                                {{-- <tfoot> --}}
                                {{-- <tr> --}}
                                {{-- <td colspan="6"></td> --}}
                                {{-- </tr> --}}
                                {{-- </tfoot> --}}
                                {{-- </table> --}}
                                {{-- <div class="clearfix"></div> --}}

                                {{-- </div><!-- end table responsive --> --}}

                            </div>
                        </li><!-- end tab 3 -->


                    </ul>

                    <p class="alileft red">* Terms &amp; conditions apply.</p>

                </div>
            </div><!-- end feature section 11 -->
            <div class="clearfix"></div>
        @elseif(strpos($basePath, 'single_domain_transfer'))
            <div class="feature_section11">
                <div class="container">
                    <form type="POST" id="gsr-contact" onSubmit="return valid_datas( this );">
                        <label class="text-16px dark"><b>Show the Domain Pricing for:</b></label>
                        <div class="radiobut text-16px light dark">
                            <input type="radio" id="all" checked="checked" name="tld"> <span class="onelb">All
                                TLD</span>&nbsp;
                            @php
                                $counter = 0;
                            @endphp
                            @foreach ($domainPricing as $dp)
                                <input type="radio" id="{{ $dp->id }}" ccount="{{ ($counter + 1) * 3 }}"
                                    name="tld"> <span class="onelb">{{ $dp->title }}</span>&nbsp;
                                @php
                                    $counter++;
                                @endphp
                                @if ($counter % 6 == 0)
                                    </br>
                                @endif
                            @endforeach
                            {{-- <input type="radio" id="general" name="tld"> <span class="onelb">General TLD</span>&nbsp;
                                  <input type="radio" id="america" name="tld"> <span class="onelb">America TLD</span>&nbsp;
                                  <input type="radio" id="asia" name="tld"> <span class="onelb">Asia Pacific TLD</span>&nbsp;
                                  <input type="radio" id="europe" name="tld"> <span class="onelb">Europe TLD</span>&nbsp; --}}
                        </div>
                    </form>
                    <div class="clearfix margin_bottom5"></div>

                    note to programmer: show the TLD pricing list based on the selection above. If selected America TLD,
                    then display the America TLD pricing table below.

                    <ul class="tabs">
                        <li class="active">New Registrations</li>
                        <li>Renewals</li>
                        <li>Transfers</li>
                    </ul>

                    <ul class="tab__content">

                        <li class="active">
                            <div class="content__wrapper">
                                <h4>All TLD - New</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="alicent">Per Year Pricing</th>
                                                <th class="alicent">1 Year</th>
                                                <th class="alicent">2 Years</th>
                                                <th class="alicent">3 Years</th>
                                                <th class="alicent">5 Years</th>
                                                <th class="alicent">10 Years</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($domainPricingList as $dpl)
                                                @if ($dpl->type == 'new')
                                                    <tr>
                                                        @php
                                                            $prices = json_decode($dpl->pricing, true);
                                                            $prices = (array) $prices;
                                                        @endphp

                                                        <td><b>{{ $dpl->tld }}</b></td>
                                                        @for ($i = 1; $i <= count($prices); $i++) @if ($i == 1 || $i == 2 || $i == 3 || $i == 5 || $i == 10) <td class="alicent"><span
                                                            class="red">RM {{ $prices[$i]['s'] }}
                                                            *</span><br />
                                                            <span class="strike">RM
                                                            {{ $prices[$i]['l'] }}*</span>
                                                            </td> @endif
                                                        @endfor
                                                        {{-- <td><a href="#shopping_cart.html" class="btn-sm btn-danger caps"><i class="fa icon-basket-loaded"></i> <b>Buy</b></a></td> --}}
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>

                                </div><!-- end table responsive -->
                            </div>
                        </li><!-- end tab 1 -->

                        <li>
                            <div class="content__wrapper">
                                <h4>All TLD - Renewals</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="alicent">Per Year Pricing</th>
                                                <th class="alicent">1 Year</th>
                                                <th class="alicent">2 Years</th>
                                                <th class="alicent">3 Years</th>
                                                <th class="alicent">5 Years</th>
                                                <th class="alicent">10 Years</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($domainPricingList as $dpl)
                                                @if ($dpl->type == 'renewal')
                                                    <tr>
                                                        @php
                                                            $prices = json_decode($dpl->pricing, true);
                                                            $prices = (array) $prices;
                                                        @endphp

                                                        <td><b>{{ $dpl->tld }}</b></td>
                                                        @for ($i = 1; $i <= count($prices); $i++) @if ($i == 1 || $i == 2 || $i == 3 || $i == 5 || $i == 10) <td class="alicent"><span
                                                            class="red">RM {{ $prices[$i]['s'] }}
                                                            *</span><br />
                                                            <span class="strike">RM
                                                            {{ $prices[$i]['l'] }}*</span>
                                                            </td> @endif
                                                        @endfor
                                                        <td><a href="{{ url('/shopping_cart') }}" class="btn-sm btn-danger caps"><i
                                                                    class="fa icon-basket-loaded"></i> <b>Buy</b></a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                </div><!-- end table responsive -->
                            </div>
                        </li><!-- end tab 2 -->

                        <li>
                            <div class="content__wrapper">
                                <h4>All TLD - Transfers</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="alicent">Per Year Pricing</th>
                                                <th class="alicent">1 Year</th>
                                                <th class="alicent">2 Years</th>
                                                <th class="alicent">3 Years</th>
                                                <th class="alicent">5 Years</th>
                                                <th class="alicent">10 Years</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($domainPricingList as $dpl)
                                                @if ($dpl->type == 'transfer')
                                                    <tr>
                                                        @php
                                                            $prices = json_decode($dpl->pricing, true);
                                                            $prices = (array) $prices;
                                                        @endphp

                                                        <td><b>{{ $dpl->tld }}</b></td>
                                                        @for ($i = 1; $i <= count($prices); $i++) @if ($i == 1 || $i == 2 || $i == 3 || $i == 5 || $i == 10) <td class="alicent"><span
                                                            class="red">RM {{ $prices[$i]['s'] }}
                                                            *</span><br />
                                                            <span class="strike">RM
                                                            {{ $prices[$i]['l'] }}*</span>
                                                            </td> @endif
                                                        @endfor
                                                        <td><a href="{{ url('/shopping_cart')}}" class="btn-sm btn-danger caps"><i
                                                                    class="fa icon-basket-loaded"></i> <b>Buy</b></a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>

                                </div><!-- end table responsive -->
                            </div>
                        </li><!-- end tab 3 -->

                        @foreach ($domainPricing as $dp)
                            <li>
                                <div class="content__wrapper">
                                    <h4>{{ $dp->title }} - New</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="alicent">Per Year Pricing</th>
                                                    <th class="alicent">1 Year</th>
                                                    <th class="alicent">2 Years</th>
                                                    <th class="alicent">3 Years</th>
                                                    <th class="alicent">5 Years</th>
                                                    <th class="alicent">10 Years</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($domainPricingList as $dpl)
                                                    @if ($dpl->type == 'new' && $dpl->domain_pricing_id == $dp->id)
                                                        <tr>
                                                            @php
                                                                $prices = json_decode($dpl->pricing, true);
                                                                $prices = (array) $prices;
                                                            @endphp

                                                            <td><b>{{ $dpl->tld }}</b></td>
                                                            @for ($i = 1; $i <= count($prices); $i++) @if ($i == 1 || $i == 2 || $i == 3 || $i ==
                                                                5 || $i == 10) <td
                                                                class="alicent"><span
                                                                class="red">RM {{ $prices[$i]['s'] }}
                                                                *</span><br />
                                                                <span class="strike">RM
                                                                {{ $prices[$i]['l'] }}*</span>
                                                                </td> @endif
                                                            @endfor
                                                            <td><a href="{{url('/shopping_cart')}}"
                                                                    class="btn-sm btn-danger caps"><i
                                                                        class="fa icon-basket-loaded"></i>
                                                                    <b>Buy</b></a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="clearfix"></div>

                                    </div><!-- end table responsive -->
                                </div>
                            </li>
                            <li>
                                <div class="content__wrapper">
                                    <h4>{{ $dp->title }} - Renewals</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="alicent">Per Year Pricing</th>
                                                    <th class="alicent">1 Year</th>
                                                    <th class="alicent">2 Years</th>
                                                    <th class="alicent">3 Years</th>
                                                    <th class="alicent">5 Years</th>
                                                    <th class="alicent">10 Years</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($domainPricingList as $dpl)
                                                    @if ($dpl->type == 'renewal' && $dpl->domain_pricing_id == $dp->id)
                                                        <tr>
                                                            @php
                                                                $prices = json_decode($dpl->pricing, true);
                                                                $prices = (array) $prices;
                                                            @endphp

                                                            <td><b>{{ $dpl->tld }}</b></td>
                                                            @for ($i = 1; $i <= count($prices); $i++) @if ($i == 1 || $i == 2 || $i == 3 || $i ==
                                                                5 || $i == 10) <td
                                                                class="alicent"><span
                                                                class="red">RM {{ $prices[$i]['s'] }}
                                                                *</span><br />
                                                                <span class="strike">RM
                                                                {{ $prices[$i]['l'] }}*</span>
                                                                </td> @endif
                                                            @endfor
                                                            <td><a href="{{url('/shopping_cart')}}"
                                                                    class="btn-sm btn-danger caps"><i
                                                                        class="fa icon-basket-loaded"></i>
                                                                    <b>Buy</b></a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="clearfix"></div>

                                    </div><!-- end table responsive -->
                                </div>
                            </li>
                            <li>
                                <div class="content__wrapper">
                                    <h4>{{ $dp->title }} - Transfers</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="alicent">Per Year Pricing</th>
                                                    <th class="alicent">1 Year</th>
                                                    <th class="alicent">2 Years</th>
                                                    <th class="alicent">3 Years</th>
                                                    <th class="alicent">5 Years</th>
                                                    <th class="alicent">10 Years</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($domainPricingList as $dpl)
                                                    @if ($dpl->type == 'transfer' && $dpl->domain_pricing_id == $dp->id)
                                                        <tr>
                                                            @php
                                                                $prices = json_decode($dpl->pricing, true);
                                                                $prices = (array) $prices;
                                                            @endphp

                                                            <td><b>{{ $dpl->tld }}</b></td>
                                                            @for ($i = 1; $i <= count($prices); $i++) @if ($i == 1 || $i == 2 || $i == 3 || $i ==
                                                                5 || $i == 10) <td
                                                                class="alicent"><span
                                                                class="red">RM {{ $prices[$i]['s'] }}
                                                                *</span><br />
                                                                <span class="strike">RM
                                                                {{ $prices[$i]['l'] }}*</span>
                                                                </td> @endif
                                                            @endfor
                                                            <td><a href="{{url('shopping_cart')}}"
                                                                    class="btn-sm btn-danger caps"><i
                                                                        class="fa icon-basket-loaded"></i>
                                                                    <b>Buy</b></a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="clearfix"></div>

                                    </div><!-- end table responsive -->
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="clearfix"></div>

                    <p class="alileft red">* Plus ICANN fee of RM0.82 per domain name year. Certain TLD's only.<br />
                        ± com.au, net.au, and org.au domain names can only be registered for 2 years.</p>

                </div>
            </div><!-- end feature section 11 -->
            <div class="clearfix"></div>
        @endif

        @if ($page_slug != 'co_cloud_hosting' && $page_slug != 'shared_hosting' && $duplicate_from != 'co_cloud_hosting' && $duplicate_from != 'shared_hosting')
            <div class="feature_section103">
                <div class="container">
                    @if (count($general_features) > 0)
                        <h1 class="caps white">
                            <strong>{{ $general_features[0]['heading'] or '' }} </strong>
                        </h1>
                    @endif

                    <div class="clearfix margin_bottom2"></div>

                    @if (count($general_features) > 0)
                        @php
                            $count = 0;
                        @endphp

                        @foreach ($general_features->where('ssl_page', 0) as $i)
                            @php
                                $count++;
                            @endphp
                            <div class="box four  last animate" data-anim-type="fadeIn" data-anim-delay="300">
                                <i class="fa {{ $i->icon }}"></i>
                                <h4>{{ $i->title }}
                                    <div class="line"></div>
                                </h4>
                                <p class="sky-blue">{{ $i->description }}.</p>
                            </div><!-- end box -->
                            @if ($count % 4 == 0)
                                <div class="clearfix margin_bottom2"></div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        @endif
        <!-- end featured section 103 -->

        <!-- Session Validation Error Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Error</h4>
                    </div>
                    <div class="modal-body">
                        <p>Please use only these symbols: "@" and "." where applicable.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('custom_scripts')

        <!-- MasterSlider -->
        <link rel="stylesheet" href="{{ asset('resources/assets/frontend/js/masterslider/style/masterslider.css') }}" />
        <link rel="stylesheet"
            href="{{ asset('resources/assets/frontend/js/masterslider/skins/default/style.css') }}" />

        <link rel="stylesheet" href="{{ asset('resources/assets/frontend/js/carouselowl/owl.transitions.css') }}" />
        <!-- owl carousel -->
        <link rel="stylesheet" href="{{ asset('resources/assets/frontend/js/carouselowl/owl.carousel.css') }}" />
        <link rel="stylesheet" href="{{ asset('resources/assets/frontend/js/accordion/style.css') }}" />

        <link rel="stylesheet" href="{{ asset('resources/assets/frontend/js/tabs2/tabacc.css') }}" />

        <link rel="stylesheet" href="{{ asset('resources/assets/frontend/js/tabs2/detached.css') }}" />
        <link rel="stylesheet" href="{{ asset('resources/assets/frontend/js/loopslider/style.css') }}" />
        <!-- accordion -->
        <!-- tabs 2 -->
        <!-- loop slider -->

        @if (strpos($basePath, 'single_domain_transfer') !== false and !empty($response) and $response->status_code !== 0 and $response->status_code !== 1 and $response->status_code !== 5)
            <script>
                $(function() {
                    $('#myModal').modal('show');
                });

            </script>
        @endif

        @if (strpos($basePath, 'bulk_domain_transfer') !== false and !empty($response))

            @foreach ($response as $key => $singleDomain)
                @if ($singleDomain->status_code !== 0 and $singleDomain->status_code !== 1 and $singleDomain->status_code !== 5)
                @if (Session::has('failed'))
                    <script>
                        $(function() {
                            $('#myModal').modal('show');
                        });

                    </script>
                @endif
                @endif
            @endforeach
        @endif

        <script>
            $(document).on("click", ".add_to_cart", function(e) {
                e.preventDefault();

                var domain = $.trim($(this).closest('tr').find('td:eq(1)').text());

                var qty = 1;

                var split_delimeter = ' ';

                if ($(this).hasClass('domain-search-add')) {
                    split_delimeter = '|';
                }

                //get cycle
                var cycle = $(this).closest('tr').find('td:eq(3) select option:selected').val();
                cycle = $.trim(cycle);
                cycle = cycle.split(split_delimeter);
                cycle = cycle[0];

                //get cycle - end

                //get price
                var selected = $(this).closest('tr').find('td:eq(3) select option:selected').text();

                selected = $.trim(selected);
                selected = selected.split(' ');
                var price = selected[selected.length - 1];
                var text = $('#transfer_text').val();
                //get price - end

                $.ajax({
                    type: 'POST',
                    url: '/add_to_cart',
                    data: {
                        domain: domain,
                        qty: qty,
                        price: price,
                        cycle: cycle,
                        type: text
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            toastr.success(data.errors.message, 'Success');
                            $('#cart_item_id').text(parseInt($('#cart_item_id').text()) + 1);
                            $('#checkout_smt').show();

                        } else {
                            toastr.success(data.errors.message, 'Error');
                            $('#checkout_smt').show();
                        }
                    }
                });
            });

            $("#selectAll1").click(function() {
                $(".selectDomain1").prop('checked', $(this).prop('checked'));
            });

            $("#selectAll2").change(function() {
                $(".selectDomain2").prop('checked', $(this).prop('checked'));
            });

            $("#selectAll3").click(function() {
                $(".selectDomain3").prop('checked', $(this).prop('checked'));
            });

            $("#selectAll4").click(function() {
                $(".selectDomain4").prop('checked', $(this).prop('checked'));
            });

            $("#selectAll5").click(function() {
                $(".selectDomain5").prop('checked', $(this).prop('checked'));
            });

            $("#selectAll6").click(function() {
                $(".selectDomain6").prop('checked', $(this).prop('checked'));
            });

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

        @if (!empty($response) || !empty($search_domain) || !empty($bulkDomains))
            <script>
                $(function() {
                    $('html, body').animate({
                        scrollTop: $(".scroll-focus-marker").offset().top - 88
                    }, 1000);
                });

            </script>
        @endif

        @if (!empty($bulkDomains))
            <!-- <script>
            $(function() {
              $('html, body').animate({
                scrollTop: $(".scrollToThis").offset().top - 88
              }, 2000);
            });
          </script> -->
        @endif
    @endsection
@endif
