@php
$breadcrumbs = [['url' => '/dashboard', 'name' => 'Dashboard'], ['url' => '/my_account', 'name' => 'My Domains'], ['url' => false, 'name' => 'Transfer Domain']];
@endphp
@extends('layouts.frontend_layout')
@section('title', 'Domain Search | Webqom Technologies')
@section('page_header', 'Domains')
@section('content')
    <div class="clearfix"></div>
    <div class="clearfix margin_bottom5"></div>

    <div class="one_full stcode_title9">
        <h1 class="caps"><strong>Transfer Domain</strong></h1>
    </div>

    <div class="clearfix"></div>

    <div class="content_fullwidth">
        <div class="container">

            @include('layouts.frontend_menu_login')
            <!-- end section -->

            <div class="three_fourth_less last">

                <div class="text-18px dark light">Transfer your existing domain names to us and save.</div>
                <div class="clearfix margin_bottom1"></div>

                <div class="cforms alileft">
                    <h4>Transfer in a Domain</h4>
                    <form type="GET" action="{{ route('frontend.domain.transferLogin') }}">
                        <input type="text" name="transfer_domain" id="domain"
                            value="<?php echo isset($_GET['transfer_domain']) ? $_GET['transfer_domain'] : ''; ?>"
                            placeholder="eg. yourdomain.com" required>
                        <div class="alicent margin_top1">
                            <button class="btn btn-danger caps">
                                <i style='display:none;' class="fa fa-lg fa-spinner"></i> <b>Transfer</b>
                            </button>&nbsp;
                            <a href="{{ route('frontend.domain.bulkTransferLogin') }}" class="btn btn-primary caps"><i
                                    class="fa fa-lg fa-share"></i> <b>Bulk Transfer</b></a>&nbsp;

                        </div>

                    </form>
                </div><!-- end cforms -->
                <div class="clearfix"></div>
                <div class="divider_line7"></div>
                <div class="clearfix "></div>

                @if (isset($failed))
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
                                    <button type="button" onclick="$('#myModal').hide()" class="btn btn-default"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger alert-dismissable">
                   <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                   <i class="fa fa-times-circle"></i> <strong>Error!</strong>
                   <p>{{ session('error') }}</p>
                </div>
                @endif
                    @if (isset($response))
                    <div class="title_scroll">
                        @if ($response->status_code == 1)
                            @if ($response->status_code == 'A')
                                <div class="alertymes4">
                                    <h3 class="light"><i class="fa fa-times-circle"></i>Sorry! Your domain is
                                        <strong>LOCKED</strong> and cannot be transferred without being unlocked.
                                    </h3>
                                </div><!-- end section -->
                                <div class="clearfix margin_bottom3"></div>
                            @else
                                <div class="alertymes5">
                                    <h3 class="light"><i class="fa fa-check-circle"></i>Congratulations!
                                        <strong>{{ $response->domain }}</strong> is eligible for transfer.
                                    </h3>
                                </div><!-- end section -->
                                <div class="clearfix margin_bottom3"></div>
                            @endif
                        @elseif($response->status_code == 0)
                            <div class="alertymes4">
                                <h3 class="light"><i class="fa fa-times-circle"></i>Sorry! <strong>{{ $response->domain }}
                                        does not appear to be registered yet.</strong>
                                    <br />Try registering this domain instead.
                                </h3>
                            </div><!-- end section -->
                            <div class="clearfix margin_bottom3"></div>
                        @elseif($response->status_code == 5)
                            <div class="alertymes4">
                                <h3 class="light"><i class="fa fa-times-circle"></i>Sorry! <strong>{{ $response->domain }}
                                        can't be transferred.</strong> Transferring Prohibited.</h3>
                            </div><!-- end section -->
                            <div class="clearfix margin_bottom3"></div>

                        @else
                            <!-- <h3 class="light red"><i class="fa fa-times-circle"></i> Sorry!
                                                        <strong>{{-- $response->domain --}}
                                                            extension is not allowed!</strong>
                                                    </h3> -->
                        @endif
                        
                </div>


                @if ($response->status_code == 0 || $response->status_code == 1 || $response->status_code == 5)
                    <div class="alertymes6">
                        <h3 class="light alileft ">
                            <i class="fa fa-list-alt"></i><strong>Domain Transfer Checklist</strong>
                        </h3>
                        <div class="clearfix margin_bottom1"></div>
                        <div class="one_half_less">
                            <div class="alileft">
                                <ul>
                                    <li>
                                        <i class="fa fa-long-arrow-right dark"></i><span class="text-18px dark light">Is
                                            Domain Privacy disabled?</span>&nbsp;
                                        <span
                                            class="text-18px {{ $response->privacy_code ? 'red' : 'green' }}"><b>{{ $response->privacy_code ? 'No' : 'Yes' }}</b></span>
                                    </li>
                                    <li>
                                        <i class="fa fa-long-arrow-right dark"></i><span class="text-18px dark light">Is the
                                            domain older than 60 days?</span>&nbsp;
                                        <span
                                            class="text-18px {{ $response->reg_days > 60 ? 'green' : 'red' }}"><b>{{ $response->reg_days > 60 ? 'Yes' : 'No' }}</b></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end section -->
                    <div class="clearfix margin_bottom3"></div>
                @endif
				{{ Form::open([ 'route' => 'frontend.domain.configuration_post' ]) }}
					{{ Form::hidden('page-name', 'Domain Transfer') }}
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
										@if ($response->status_code == 1)
											<input type="checkbox" data-reference="{{$response->domain}}" class="selectDomain6" checked="checked" id="confirm_domain" name="domain-search-checkbox[]" onclick="showContinueButton()" value="{{$response->domain}}" />
											<!-- {{
												Form::checkbox(
													'domain-search-checkbox[]',
													$response->domain,
													null,
													[
														'data-reference' => $response->domain,
														'id' => 'confirm_domain'
													]
												)
											}} -->
										@else
											<i class="fa fa-times red"></i>
										@endif
									</td>
									<td>{{ $response->domain }}</td>
									<td>
										@if ($response->status_code == 1)
											<div class="col-md-6">

												<input type="text" class="form-control" placeholder="Enter domain password">
											</div>
										@endif
									</td>
									<td>
										@if (isset($domainPricingList))
											@foreach ($domainPricingList as $dpl)
												<?php
												$site = explode('.', $response->domain);
												$section = count($site);
												if ($section == 2) {
												$dom = $site[1];
												}
												if ($section == 3) {
												$dom = $site[1] . '.' . $site[2];
												}
												if ($section == 4) {
												$dom = $site[1] . '.' . $site[2] . '.' . $site[3];
												}
												if (isset($dom)) { ?>
												<!-- @if ($dpl->type == 'new' && ($dpl->tld == '.' . $dom || $dpl->tld == $dom)) <select class="form-control input-medium">
																@foreach (json_decode($dpl->pricing) as $price)
																	<option value="{{ $loop->index + 1 }} year" {{ $loop->index == 1 ? 'selected="selected"' : '' }}>{{ $loop->index + 1 }} year(s) @ RM {{ $price->s }}.00</option> @endforeach
															</select>
														@endif -->
												@if ($dpl->type == 'transfer' && $response->status_code == 1 && ($dpl->tld == '.' . $dom || $dpl->tld == $dom))
													<select class="form-control input-medium" name="domain-search-dropdown[{{ $response->domain }}]">
														@foreach (json_decode($dpl->pricing) as $price)
															<option value="{{ $loop->index + 1 }}|{{ $price->s }}"
																{{ $loop->index == 1 ? 'selected="selected"' : '' }}>
																{{ $loop->index + 1 }} year(s) @ RM
																{{ number_format((float) $price->s, 2, '.', '') }}</option>
														@endforeach
													</select>
                                                    <input type="hidden" name="text[{{ $response->domain }}]" value="2" id="transfer_text">

													{{--
														Form::select(
															'domain-search-dropdown[' . $key . ']',
															$domain_pricing_list,
															array_keys(array_slice($domain_pricing_list, 1, 1, true))[0],
															[
																'class' => 'form-control input-medium'
															]
														)
													--}}
												@endif
												<?php }
												?>
											@endforeach
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
					<div class="divider_line7"></div>
					<div class="clearfix"></div>
					@if (isset($response->status_code) && $response->status_code == 1)
						<div class="alicent">


							<!-- <a id="continue_transfer_btn" href="{{ route('frontend.domain.configuration') }}" class="btn btn-danger caps"><i
									class="fa fa-arrow-circle-right hidden"></i> <b>Continue</b></a>&nbsp; -->
							<button id="continue_transfer_btn" type="submit" class="btn btn-danger caps">
								<i class="fa fa-arrow-circle-right hidden"></i> <b>Continue</b>
							</button>&nbsp;
						</div>
					@endif
				{{ Form::close() }}
                @endif
            </div><!-- end section -->



        </div>
    </div><!-- end content fullwidth -->

    <div class="clearfix"></div>
    <div class="divider_line"></div>


    <div class="clearfix"></div>

@endsection()
@section('custom_scripts')
    <script type="text/javascript">
        let url = window.location.href;
        if (url.includes('?')) {
            $("html, body").animate({
                scrollTop: $('.title_scroll').offset().top - 100
            }, 100);
        }
		function showContinueButton() {
			if ($('#confirm_domain:checked').is(':checked')) {
				$('#continue_transfer_btn').removeClass('hidden');
			} else {
				$('#continue_transfer_btn').addClass('hidden');
			}
		}
		$(showContinueButton);
    </script>
@stop
