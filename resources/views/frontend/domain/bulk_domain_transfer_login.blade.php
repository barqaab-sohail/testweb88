@php
    $breadcrumbs = [
        array('url' => '/dashboard', 'name' => 'Dashboard'),
        array('url' => '/my_account' , 'name' => 'My Domains'),
        array('url' => false, 'name' =>  'Transfer Domain'),
    ];
@endphp
@extends('layouts.frontend_layout')
@section('title','Domain Search | Webqom Technologies')
@section('page_header','Domains')
@section('content')
<div class="clearfix"></div>


<div class="page_title1 sty9">
<div class="container">

	<h1>Domains</h1>
    <div class="pagenation">&nbsp;<a href="/">Home</a> <i>/</i> <a href="/dashboard">Dashboard</a> <i>/</i> <a href="domain_my_domains.html">My Domains</a> <i>/</i> Bulk Domains Transfer</div>
 
</div>	    
</div><!-- end page title -->

    <div class="clearfix"></div>
    <div class="clearfix margin_bottom5"></div>

    <div class="one_full stcode_title9">
        <h1 class="caps"><strong>BULK DOMAINS TRANSFER</strong></h1>
    </div>

    <div class="clearfix"></div>

    <div class="content_fullwidth">
        <div class="container">
        @include("frontend._left_br_logged_in", array('status_filter' => 'domain'))

             @if(isset($failed) && $failed == 1)
                <div id="myModal" class="modal fade in" role="dialog" style="display: block;" aria-hidden="false">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">Error</h4>
                        </div>
                        <div class="modal-body">
                            <p>Please use only these symbols: "@" and "." where applicable.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="$('#myModal').hide()" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            @endif                     
            <div class="three_fourth_less last">

                <div class="text-18px dark light">You can transfer your existing domains to us today. To get started, simply enter the domains below, one per line - do not include the www. or http://</div>
                <div class="clearfix margin_bottom1"></div>

                <div class="cforms alileft">
                    <h4>Transfer Domains to Us</h4>
                    <form type="GET" action="{{ route('frontend.domain.bulkTransferLogin') }}">                        
                    <textarea name="bulk_domains" required rows="6" style="width: 80.2%; float:left;" placeholder="Enter up to 20 domain names.
Each name must be on a separate line.

Examples:
yourdomain.com
yourdomain.net"></textarea>
                        <div class="alicent margin_top1">
                            <button class="btn btn-danger caps">
                                <i style='display:none;' class="fa fa-lg fa-spinner"></i> <b>Bulk Transfer</b>
                            </button>&nbsp;
                            <a href="{{ route('frontend.domain.transferLogin') }}" class="btn btn-primary caps"><i class="fa fa-lg fa-share"></i> <b>Single Transfer</b></a>&nbsp;

                        </div>

                    </form>
                </div><!-- end cforms -->
                <div class="clearfix"></div>
                <div class="divider_line7"></div>
                <div class="clearfix"></div>
                @if(isset($final_response))
                <?php $show_continue = 0;?>
                
                @foreach($final_response as $response)
					@if(!empty($response->failed))
						<?php continue;?>
					@endif
                    
                     
                            @if($response->status_code == 'A')
                                <div class="alertymes4">
                                    <h3 class="light"><i class="fa fa-times-circle"></i>Sorry! Your domain is <strong>LOCKED</strong> and cannot be transferred without being unlocked.</h3>
                                </div><!-- end section -->
                                <div class="clearfix margin_bottom3"></div>
                            @elseif($response->privacy_code == 1 && $response->reg_days > 60)
                                <div class="alertymes5">
                                    <h3 class="light"><i class="fa fa-check-circle"></i>Congratulations! <strong>{{$response->domain}}</strong> is eligible for transfer.</h3>
                                </div><!-- end section -->
                                <div class="clearfix margin_bottom3"></div>
                            @else
                                <div class="alertymes4">
                                     <h3 class="light"><i class="fa fa-times-circle"></i>Sorry! <strong>{{$response->domain}} does not appear to be registered yet.</strong>
                                    <br/>Try registering this domain instead.</h3>
                                </div><!-- end section -->
                                <div class="clearfix margin_bottom3"></div>
                            @endif
                    
                    <div class="alertymes6">
                        <h3 class="light alileft"><i class="fa fa-list-alt"></i><strong>Domain Transfer Checklist</strong></h3>
                        <div class="clearfix margin_bottom1"></div>
                        <div class="one_half_less">
                            <div class="alileft">
                                <ul>
                                    <li>
                                        <i class="fa fa-long-arrow-right dark"></i>
                                        <span class="text-18px dark light">Is Domain Privacy disabled?</span>&nbsp;
                                        @if($response->privacy_code == 1)
                                            <span class="text-18px green"><b>Yes</b></span>
                                        @elseif($response->privacy_code == 0)
                                            <span class="text-18px red"><b>No</b></span>
                                        @elseif($response->privacy_code == 4)
                                            <span class="text-18px red"><b>{{$response->privacy_message}}</b></span>
                                        @endif
                                    </li>
                                    <li>
                                        <i class="fa fa-long-arrow-right dark"></i>
                                        <span class="text-18px dark light">
                                    Is the domain older than 60 days?
                                  </span>&nbsp;
                                        @if($response->status_code != -1)
                                            @if($response->reg_days > 60)
                                                <span class="text-18px green">
                                      <b>Yes</b>
                                      </span>
                                            @else
                                                <span class="text-18px red">
                                  <b>No</b>
                                  </span>
                                            @endif
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div><!-- end section -->
                    <div class="clearfix margin_bottom3"></div>

@if($response->status_code == 'A' || ($response->privacy_code == 1 && $response->reg_days > 60))
                    <div class="table-responsive mtl">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th width="1%"></th>
                                <th>Domain Name</th>
                                <th>Enter Domain Password (EPP Code)</th>
                                <th>Registration Period</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td class="alicent">
									
                                    @if($response->privacy_code == 1 && $response->reg_days > 60)
                                        <input type="checkbox" />
                                    @else
                                        <i class="fa fa-times red"></i>
                                    @endif
                                </td>
                                <td>{{$response->domain}}</td>
                                @if($response->privacy_code == 1 && $response->reg_days > 60)
                                <td><input type="text" class="form-control" placeholder="Enter domain password (EPP code)"></td>
                                <td>
                                    @if(isset($domainPricingList))
                                        @foreach($domainPricingList as $dpl)
                                        <?php 
                                            $site = explode('.',$response->domain);
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
                                            @if($dpl->type == 'transfer' && $response->status == 1 && ($dpl->tld == '.'.$dom || $dpl->tld == $dom))
                                                <select class="form-control input-medium">
                                                    @foreach(json_decode($dpl->pricing) as $price)
                                                        <option value="{{$loop->index + 1}} year" {{ $loop->index == 1 ? 'selected="selected"':''}}>{{$loop->index + 1}} year(s) @ RM {{number_format((float)$price->s, 2, '.', '')}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        <?php } ?>
                                        @endforeach
                                    @endif
                                </td>
                                @else
                                <td></td><td></td>
                                @endif
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
@endif
                    <div class="clearfix"></div>
                    <div class="divider_line7"></div>
                    <div class="clearfix"></div>
                    @if($response->privacy_code == 1 && $response->reg_days > 60)
                        <?php
                        $show_continue = 1;
                        ?>
                    @endif

				@endforeach
				@if($show_continue == 1)
				<div class="alicent" >
					<a href="{{route('frontend.domain.configuration')}}" style="display:none;" class="btn btn-danger caps"><i class="fa fa-arrow-circle-right"></i> <b>Continue</b></a>&nbsp;
				</div>
				@endif
            </div><!-- end section -->
            @endif


        </div>
    </div><!-- end content fullwidth -->

    <div class="clearfix"></div>
    <div class="divider_line"></div>
<script
  src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script>
	$(document).ready(function(){
		$('.alicent input').change(function(){
			if($('.alicent input:checked').length > 0)
			{
				$('.alicent .btn-danger').show();
			}else{
				$('.alicent .btn-danger').hide();
			}
		});
	});
</script>
    <div class="clearfix"></div>
@endsection()
