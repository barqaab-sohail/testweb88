<!--Modal Add New Pricing start-->

        <div class="modal-content">
            <div class="modal-body">
               <?php $plan = App\Models\Plan::get_plan_details($data['order']->plan_id); 
               $category_id = $plan['category'];
               $categoriesData = App\Models\Category::getSelectedPCategoriesTree($category_id);
               // dd($categoriesData);
               $promocode = App\Models\Plan::getPomocodebycategory($category_id);
               $discountcode = App\Models\Plan::getDiscountByCategory($category_id);
               // dd($discountcode);
               if(!empty($plan)){
                   $main_price = number_format((float)$plan['price_annually'] + $plan['setup_fee_one_time'], 2, '.', '');
                   $domain_price = number_format((float)$data['order']->price - $main_price, 2, '.', ''); 
                   $domain_year = $data['order']->cycle;
               }else{
                  $domain_price = $data['order']->price; 
                  $domain_year = $data['order']->cycle;
               }
               ?>
               
                              
                              

                <div class="form">
                    <form class="form-horizontal" method="post"
                          action="{{route('updateItems',$data['order']->id)}}">
                        {{csrf_field()}}
                        <div class="form-group" id="custom_plan_category">
                        <label class="col-md-3 control-label">Select Category</label>
                        <div class="col-md-6">

                           <select class="form-control category_plan" name="custom_plan_category">
                              <option value="-1">Select Category</option>
                              {!! $categoriesData !!}
                           </select>
                        </div>
                     </div>
                     <div class="form-group">

                        <label class="col-md-3 control-label">Service Plan / Service Code <span class="text-red">*</span></label>
                        <div class="col-md-6">

                           <select class="form-control service_plan" name="service_plan" id="service_plan">
                              <option value="-1">- Please select -</option>
                              @if($data['order']->plan_id)
                              <option value="{{ $data['order']->plan_id}}" selected>{{ $plan['plan_name'] .' - '. $plan['service_code']}}</option>
                              @endif
                              <option value="custom_plan">Custom Plan/Package</option>

                           </select>
                           <div class="xs-margin"></div>
                           <div class="text-blue text-12px">Please select a <b>"Service Plan"</b> &amp; <b>"Service Code"</b> to continue,  eg. for VPS Hosting, <b>Service Plan = "Linux Basic"</b>, <b>Service Code = "VPS58-2-1"</b>.</div>
                           note to programmer: some of the services does not have a service code, if service plan doesn't have a service code, please leave it blank after the plan name in the above dropdown list.
                        </div>
                     </div>
                     <div class="form-group" id="custom_plan_data" style="display:none">
                        <label class="col-md-3 control-label">Custom Plan/Package Name</label>
                        <div class="col-md-6">
                           <input type="text" class="form-control" name="custom_plan_name">
                        </div>
                     </div>
                     <div class="form-group" id="custom_plan_code" style="display:none">
                        <label class="col-md-3 control-label">Custom Plan Service Code</label>
                        <div class="col-md-6">
                           <input type="text" class="form-control" name="custom_plan_code">
                        </div>
                     </div>

                     <input type="hidden" name="order_id" value="{{ $data['order']->order_id }}">
                     <div class="form-group">
                        <label class="col-md-3 control-label">Unit Price (RM)</label>
                        <div class="col-md-6">
                           <input type="text" class="form-control" placeholder="0.00" id="unit_price" name="unit_price" value="{{ $plan['price_annually']}}">
                           <div class="xs-margin"></div>
                           <div class="text-blue text-12px">The unit price is for all other packages execpt domain. For single/bulk domain prices, please specify the prices in below <b>"Domain Configuration"</b> section.</div>
                           note to programmer: auto-fill in the price above after selected a plan. the price will be varied from the selection of the plan above.
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Global Discount Name </label>
                        <div class="col-md-6">
                           <input type="text" class="form-control" placeholder="eg. Sample 2" id="discount_name" name="discount_name" value="{{!empty($discountcode) ? $discountcode->discount_name : ''}}">
                           note to programmer: "discount name" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Global Discount Rate </label>
                        <div class="col-md-6">
                           <input type="text" class="form-control" placeholder="Amount" name="discount_amount" id="discount_amount" value="{{!empty($discountcode) ? $discountcode->discount : ''}}">
                           <input type="hidden" name="discount_id" value="{{!empty($discountcode) ? $discountcode->id : '0'}}" id="discount_id">
                           <div class="xs-margin"></div>
                           <select name="discount_rate" class="form-control" id="percentage">
                              <option value="%" @if(!empty($discountcode)) {{ ($discountcode->discount_by == 'percentage') ? 'selected' : '' }} @endif>%</option>
                              <option value="RM" @if(!empty($discountcode)){{  ($discountcode->discount_by == 'amount') ? 'selected' : '' }} @endif>RM</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Promo Code </label>
                        <div class="col-md-6">
                           <input type="text" class="form-control" placeholder="eg. Test123" value="{{!empty($promocode) ? $promocode->promo_code : '' }}" name="promo_code" id="promo_code">
                           <input type="hidden" name="promo_id" id="promo_id" value="{{!empty($promocode) ? $promocode->id : '0' }}">
                           note to programmer: "promo code" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Discount Rate (Promo Code) </label>
                        <div class="col-md-6">
                           <input type="text" class="form-control" placeholder="Amount" name="promo_amount" value="{{!empty($promocode) ? $promocode->discount : '' }}">
                           <div class="xs-margin"></div>
                           <select name="select" class="form-control" id="promo_type">
                              <option value="P" @if(!empty($promocode)) {{ ($promocode->discount_type == 'P') ? 'selected' : '' }} @endif>%</option>
                              <option value="F" @if(!empty($promocode)) {{ ($promocode->discount_type == 'F') ? 'selected' : '' }} @endif>RM</option>
                           </select>
                        </div>
                     </div>
                     @if(count($data['hosting_plan'])>0)
                     
                     
                     <div class="form-group">
                        <label class="col-md-3 control-label">SSL Price (RM) </label>
                        <div class="col-md-6">
                           <select class="form-control" name="ssl_price" id="ssl_price">
                              <option value="0" selected>Select Any SSL price</option>
                              <?php $x=1; ?>
                              @foreach($data['hosting_plan'] as $i)

                                 <option value="{{$x}}-{{$i->price_annually}}">{{ $x }} Years @  {{$i->price_annually}}/yr</option>
                              <?php $x++; ?>
                              @endforeach                                             
                           </select>
                           <div class="xs-margin"></div>
                           note to programmer: the ssl price dropdown list is dynamic and fectched from the ssl services setup depending on the ssl plan selected above.
                        </div>
                     </div>
                     
                     @endif
                     <div class="form-group">
                        <label class="col-md-3 control-label">Quantity <span class="text-red">*</span></label>
                        <div class="col-md-6">
                           <input type="text" class="form-control" placeholder="1" id="quantity" name="quantity" value="1">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Cycle <span class="text-red">*</span></label>
                        <div class="col-md-6">
                           <input type="text" class="form-control" placeholder="eg. 1 year(s)" id="cycle" name="cycle" value="1">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label">Setup Fee (RM) </label>
                        <div class="col-md-6">
                           <input type="text" class="form-control" placeholder="0.00" id="setupfree" name="setupfree" value="{{ $plan['setup_fee_one_time']}}">
                           <div class="xs-margin"></div>
                           <div class="setuptext"></div>
                           <div class="text-blue text-12px">If "Setup Fee" is set to <b>RM 0.00</b>, it is <b>"FREE Setup"</b>.</div>
                        </div>
                     </div>
                     <!-- domain configuration start -->
                     <h5 class="block-heading">Domain Configuration</h5>
                     <div class="form-group">
                        <label for="inputFirstName" class="col-md-3 control-label">Domain Name <span class="text-red">*</span></label>
                        
                        <div class="col-md-6">
                           <div class="radio-list">
                              <div class="domain_show">
                              <label for="rd1">
                                 <input type="radio" name="rd" class="rd rd1" value="1" checked="checked"> Use existing domain, please enter your domain below:
                                 <div class="xs-margin"></div>
                              </label>
                              <label for="rd2">
                                 <input type="radio" name="rd" class="rd rd2" value="2"> Register a new domain, please enter your domain below:
                                 <div class="xs-margin"></div>
                              </label>
                              </div>
                              <div class="single_domain">
                                 <label for="rd3">
                                    <input type="radio" name="rd" class="rd rd3" value="3"> Please specify your domain below (for single domain):
                                    <div class="xs-margin"></div>
                                 </label>
                              </div>
                           </div>
                           <div class="form-group">
                              <input type="text" class="form-control" name="search_domain" id="domain_text" value="{{ $data['order']->services}}" required placeholder="eg. yourdomain.com">
                              <span>{{ $domain_year .' years@'. $domain_price }}</span>
                           </div>
                           <a href="javascript:void(0)" class="btn btn-danger caps chk_btn check_availablity" style="display:none"><i style='display:none;' class="fa fa-lg fa-spinner chk_avl_spnr"></i> <b>Check Availability</b></a>&nbsp;
                           <a href="javascript:void(0)" class="btn btn-danger caps chk_btn bulk_availability" style="display:none"><i style='display:none;' class="fa fa-lg fa-spinner chk_avl_spnr"></i> <b>Bulk Availability</b></a>&nbsp;
                          
                        </div>
                     </div>
                     <div id="domain_status"></div>
                     <!-- note to programmer: the domain price from 1 year to 10 years is dynamic and fectched from the domain pricing and maybe varied from different TLDs. Same as bulk domain pricing. -->
                     <div class="single_pricing_table" style="display:none">
                        <h5 class="block-heading">Single Domain Pricing (RM)</h5>
                        <!-- <div class="text-blue text-12px">You can specify single domain price in below table for <b>"New Domain Registration"</b>, <b>"Domain Renewal"</b> or <b>"Transfer in a Domain"</b>. If "Domain Price" is set to <b>RM 0.00</b>, it is <b>"FREE Domain"</b>. </div> -->
                        <div class="xs-margin"></div>
                        <div class="form-group">
                           <label for="inputFirstName" class="col-md-3 control-label">Domain Pricing <span class="text-red">*</span></label>
                           <div class="col-md-6">
                              <select class="form-control" name="domain_pricing" id="domain_pricing">
                                 <option value="">Select Domain Pricing</option>
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-md-3 control-label">Domain Addons </label>
                        <div class="col-md-6">
                           <div class="checkbox-list margin-top-10px">
                          @php
                        $addons_vl = explode(',', $data['order']->addons);
                        @endphp
                        

                              @foreach($data['domain_pricings'] as $dprice)
                              <?php
                        $checked = "";
                           if(in_array($dprice->id,$addons_vl)){
                             $checked = "checked";
                           }
                            ?>
                              <label for="{{ $dprice->id}}"></label>
                              <input type="checkbox" name="addons[]" value="{{ $dprice->id }}" {{ $checked }}> {{$dprice->title}} (RM {{number_format(($dprice->price?$dprice->price:'0'), 2)}}) /yr 
                              @endforeach
                           </div>
                        </div>
                            
                     </div>
                     <div id="custom_plan_box" style="display:none">
                        <div id="inputFormRow">
                           <div class="form-group">
                              <label class="col-md-3 control-label">Custom Plan Specification </label>
                              <div class="col-md-6">
                                 <input type="text" name="custom_title[]" class="form-control" placeholder="Enter title" autocomplete="off"> <br/>
                                 <input type="text" name="custom_description[]" class="form-control" placeholder="Enter Details" autocomplete="off"><br/>
                                 <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                              </div>
                           </div>
                        </div>
                        <div id="newRow"></div>
                        <div class="form-group">
                           <div class="col-md-6 col-md-offset-3">
                              <button id="addRow" type="button" class="btn btn-info">Add More</button>  
                           </div>
                        </div>
                     </div>
                     
                     <div class="form-actions">
                        <div class="col-md-offset-5 col-md-8"> <button  class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></button>&nbsp; <button href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></button> </div>
                     </div>
                    </form>
                </div>
            </div>
        </div>
<!--END MODAL Add New Pricing-->