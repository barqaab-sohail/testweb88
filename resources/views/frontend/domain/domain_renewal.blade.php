@php
$breadcrumbs = [
    array('url' => '/dashboard', 'name' => 'Dashboard'),
    array('url' => '/my_account' , 'name' => 'My Domains'),
    array('url' => false, 'name' =>  'Domain Renewal'),
];
@endphp
@extends('layouts.frontend_layout')
@section('title','Domain Search | Webqom Technologies')
@section('page_header','Domains')
@section('content')
<div class="clearfix"></div>

<div class="content_fullwidth">

    <div class="container">
        @include("layouts.frontend_menu_login", array('status_filter' => 'ticket'))
    	<div class="three_fourth_less last">

           <div class="text-18px dark light">Secure your domain(s) by adding more years to them. Choose how many years you want to renew for and then submit to continue.</div>
           <div class="clearfix margin_bottom1"></div>

           <p class="aliright">{{$domains->count()}} record(s) found. Items 1-{{$domains->count()}} out of {{$domains->count()}} displayed</p>

                <div class="table-responsive">

                          <table class="table table-hover table-striped">
                            <thead>
                              <tr>
                              	<th width="1%"><input type="checkbox"></th>
                                <th><span class="pull-left">Domain</span> <a href="#sort by domain" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                                <th><span class="pull-left">Next Due Date</span> <a href="#sort by next due date" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                                <th><span class="pull-left">Days Until Expiry</span> <a href="#sort by days until expiry" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                                <th><span class="pull-left">Registration Period</span> <a href="#sort by registration period" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                                <th><span class="pull-left">Status</span> <a href="#sort by status" class="pull-right white"><i class="fa fa-sort"></i></a></th>
                              </tr>
                            </thead>
                            <tbody id="checklist">

                              @if (count($domains) > 0)
                              @foreach($domains as $domain)
                              <tr>
                              <?php
                                  $diffTime = Carbon\Carbon::now()->diffInDays(new Carbon\Carbon($domain->exp_date), false);
                                ?>
                                <td width="1%" class="alicent">
                                    @if($diffTime > 0)
                                  <input name="chk[]" value="2" onchange="showcont()" class="check" type="checkbox">
                                  @else
                                  <input type="checkbox" name="chk[]" value="2" onchange="showcont()" class="check" disabled="disabled">
                                  @endif
                                </td>
                                <td>{{$domain->name}}</td>
                                <td>{{ date('Y-m-d', strtotime($domain->exp_date))}}</td>
                                <td>
                                  @if($diffTime > 0)
                                  {{$diffTime}} Days
                                  @else
                                  <span class="red">{{$diffTime*-1}} Days Ago</span>
                                  @endif
                                </td>
                                <td>
                            {{--@if($diffTime >= 91)--}}
                            {{--<span class="red">Past Renewable Period</span>--}}
                                  @if($diffTime < -40)
                                        <span class="red">Past Renewable Period</span>
                                @else
                                  <select class="form-control input-medium">
                                      <option value="1 year">1 year(s) @ RM 38.00</option>
                                      <option value="2 years">2 year(s) @ RM 69.00</option>
                                      <option value="3 years">3 year(s) @ RM 99.00</option>
                                      <option value="4 years">4 year(s) @ RM 129.00</option>
                                      <option value="5 years">5 year(s) @ RM 159.00</option>
                                      <option value="6 years">6 year(s) @ RM 225.00</option>
                                      <option value="7 years">7 year(s) @ RM 265.00</option>
                                      <option value="8 years">8 year(s) @ RM 295.00</option>
                                      <option value="9 years">9 year(s) @ RM 335.00</option>
                                      <option value="10 years">10 year(s) @ RM 365.00</option>
                                  </select>
                                  @endif
                                </td>
                                <td>
                                  
                                  <a >

                                    @if($diffTime > 0 && $domain->status=="Active")
                                      <span class="label label-success caps">Active</span>
                                    @elseif ($domain->status=="Pending")
                                      <span class="label label-warning caps">Pending</span>
                                    @else
                                      <span class="label label-danger caps">Expired</span>
                                    @endif
                                  </a>
                                </td>
                                </tr>
                              @endforeach
                              <div class="clearfix"></div>
                              @else
                                <tr>
                                <td colspan="6">No records found.</td>
                              </tr>
                              @endif

                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="6"></td>
                              </tr>
                            </tfoot>
                          </table>
                          <div class="clearfix"></div>

                </div>

            <div class="clearfix"></div>
            <div class="divider_line7"></div>
            <div class="clearfix"></div>
            @if($domains->count() > 0)
            <div class="alicent" >
               <a href="{{route('frontend.domain.configuration')}}" id="cont"  disabled class="btn btn-danger caps"><i class="fa fa-arrow-circle-right"></i> <b>Continue</b></a>&nbsp;
            </div>
            @endif


       </div><!-- end section -->




	</div>
    <!-- end container -->


    <div class="clearfix"></div>


</div><!-- end content full width -->

<div class="clearfix"></div>
<script>
  function showcont(){
    var atLeastOneIsChecked = $('input[name="chk[]"]:checked').length > 0;
    if(atLeastOneIsChecked){ $('#cont').attr('disabled', false); }
    else{ $('#cont').attr('disabled', true);}

  }
</script>
@endsection()
