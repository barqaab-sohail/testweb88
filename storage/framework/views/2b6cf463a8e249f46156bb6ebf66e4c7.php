
<table>
    <tr>
        <td class="first rowfirst">
            <div class="title">
                <div class="arrow_box">
                    <h5>All <?php echo e($page_name); ?> Features</h5>
                    <h3 class="caps">Choose Your Plan</h3>
                </div>
            </div>
        </td>
        
        <?php if(!empty($plans)): ?>
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <td class="rowsremain <?php if(strtolower($i->sort_order) == '2' && $i->promo_behaviour != 'none'): ?> center <?php endif; ?> ">
                    <div class="prices">
                        
                        <?php if(strtolower($i->sort_order) == '2' && $i->promo_behaviour != 'none'): ?>
                            <h3><span><?php echo e($i->promo_behaviour == 'other' ? $i->promo_behaviour_other : $i->promo_behaviour); ?></span>
                            </h3>
                        <?php endif; ?>
                        <h2 class="caps <?php if(strtolower($i->sort_order) == '2' && $i->promo_behaviour != 'none'): ?> white <?php endif; ?> "><?php echo e($i->plan_name); ?></h2>
                        <?php if($i->price_type == 'Recurring'): ?>
                        <?php if($i->hide_on_mobile == 1): ?>
                            <strong ><i>RM</i><?php echo e($i->price_monthly or '0'); ?><i>/mo</i></strong>
                            <?php endif; ?>
                            <!--<?php list($whole, $decimal) = explode('.', number_format($i->price_monthly, 2, '.', '00')  ); ?>
    <strong><i>RM</i><?php echo e($whole or '0'); ?><i>.<?php echo e($decimal); ?>/mo</i></strong>-->
                        <?php endif; ?>
                        <?php if($i->price_type == 'One Time'  ): ?>
                            <!--<?php list($whole, $decimal) = explode('.', number_format($i->price_monthly, 2, '.', '00')); ?>
    <strong><i>RM</i><?php echo e($whole or '0'); ?><i>.<?php echo e($decimal); ?>/mo</i></strong>-->
    <?php if($i->hide_on_mobile == 1): ?>
                            <strong><i>RM</i><?php echo e(number_format($i->price_one_time + $i->setup_fee_one_time, 2)); ?></strong>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if($i->price_type == 'Free'): ?>
                        <?php if($i->hide_on_mobile == 1): ?>
                            <strong>Free</strong>
                            <?php endif; ?>
                        <?php endif; ?>
                        <b></b>
                        <?php if($i->enable_plan_button == 'Order Now'): ?>
                            <?php if(Request::path() == 'services/dedicated_servers'): ?>
                            <?php if(!empty(request('domain'))): ?>
                                <a
                                    href="<?php echo e(route('configDedicate')); ?>?id=<?php echo e($i->id); ?>&search_domain=<?php echo e(request('domain')); ?>"><?php echo e($i->enable_plan_button); ?></a>
                            <?php else: ?>
                            <a
                                    href="<?php echo e(route('configDedicate')); ?>?id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button); ?></a>
                            <?php endif; ?>
                            <?php else: ?>
                            <?php if(!empty(request('domain'))): ?>
                            <a
                                    href="/domain_configuration_hosting?search_domain=<?php echo e(request('domain')); ?>&url=<?php echo e(Request::segment(2)); ?>&amp;name=<?php echo e($page_name); ?>&amp;id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button); ?></a>
                            <?php else: ?>
                                <a
                                    href="/domain_configuration_hosting?url=<?php echo e(Request::segment(2)); ?>&amp;name=<?php echo e($page_name); ?>&amp;id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button); ?></a>
                            <?php endif; ?>
                            <?php endif; ?>
                        <?php elseif($i->enable_plan_button == 'Ask for Quote'): ?>
                            <a href="javascript:showModel()"><?php echo e($i->enable_plan_button); ?></a>
                        <?php elseif($i->enable_plan_button == 'other'): ?>
                            <?php if(Request::path() == 'services/dedicated_servers'): ?>
                              <?php if(!empty(request('domain'))): ?>
                                <a
                                    href="<?php echo e(route('configDedicate')); ?>?search_domain=<?php echo e(request('domain')); ?>&id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button_other); ?></a>
                              <?php else: ?>
                              <a
                                    href="<?php echo e(route('configDedicate')); ?>?id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button_other); ?></a>
                              <?php endif; ?>
                            <?php else: ?>
                              <?php if(!empty(request('domain'))): ?>
                              <a
                                    href="/domain_configuration_hosting?search_domain=<?php echo e(request('domain')); ?>&url=<?php echo e(Request::segment(2)); ?>&amp;name=<?php echo e($page_name); ?>&amp;id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button_other); ?></a>
                              <?php else: ?>
                                <a
                                    href="/domain_configuration_hosting?url=<?php echo e(Request::segment(2)); ?>&amp;name=<?php echo e($page_name); ?>&amp;id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button_other); ?></a>
                               <?php endif; ?>

                            <?php endif; ?>
                        <?php else: ?>
                            <a href="javascript:void(0)"><?php echo e($i->enable_plan_button); ?></a>
                        <?php endif; ?>
                        <!--
							<?php if($i->enable_plan_button != 'other'): ?>
							<?php if($i->id != 19): ?>
								<?php if(in_array($i->id, [14, 20])): ?>
								<a href="<?php echo e(route('configDedicate')); ?>?id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button); ?></a>
								<?php else: ?>
								<a href="javascript:void(0)"><?php echo e($i->enable_plan_button); ?></a>
								<?php endif; ?>
								<?php else: ?>
								<a href="javascript:showModel()"><?php echo e($i->enable_plan_button); ?></a>
								<?php endif; ?>
								<?php else: ?>
								<?php if(Request::path() == 'services/dedicated_servers'): ?>
								<a data-target="#modal-enquire" data-toggle="modal" href="#"><?php echo e($i->enable_plan_button_other); ?></a>
								<?php else: ?>
								<a href="javascript:void(0)"><?php echo e($i->enable_plan_button_other); ?></a>
								<?php endif; ?>
							<?php endif; ?>



						@ if($i->enable_plan_button!='other')
						@ if($i->id !=19)
						@ if(in_array($i->id, [14,20]))
						<a href="<?php echo e(route('configDedicate')); ?>?id=<?php echo e($i->id); ?>">{ {$i->enable_plan_button}}</a>
						@ else
						<a href="javascript:void(0)">{ {$i->enable_plan_button}}</a>
						@ endif
						@ else
						<a href="javascript:showModel()">{ {$i->enable_plan_button}}</a>
						@ endif
						@ else
						@ if(Request::path() == 'services/dedicated_servers')
						<a data-target="#modal-enquire" data-toggle="modal" href="#"><?php echo e($i->enable_plan_button_other); ?></a>
						@ else
						<a href="javascript:void(0)">{ {$i->enable_plan_button_other}}</a>
						@ endif
						@ endif
						-->
                    </div>
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </tr>
    <?php if($service_free_domains): ?>
        <tr>
            <th class="alileft">Free domain</th>
                <?php for($d = 0; $d<= 2; $d++): ?>
                    <?php if(isset($plans[$d])): ?>
            <th>
                <?php
                    $free_domain = App\Models\ServicesFreeDomain::where('plan_id', $plans[$d]->id)->first();
                    $type = '';
                    $fee = '';
                    $tldValues = [];
                    $offer_line = '';
                    if ($free_domain) {
                        $type = $free_domain->type;
                        $fee = $free_domain->fee;
                    
                        if ($type !== '1') {
                            $tlds_array = unserialize($free_domain->tlds);
                            foreach ($tlds_array as $j) {
                                $domain_pricing = App\Models\DomainPricing::find($j);
                    
                                if ($domain_pricing) {
                                    if ($type === '2' || $type === '3') {
                                        $offer_line = $type == '2' ? ' Offer a free domain registration/transfer only (renew as normal)' : ' Offer a discounted domain registration/transfer only (renew as normal):';
                                        $tlds = '';
                                        $tlds = App\Models\DomainPricingList::where('domain_pricing_id', $domain_pricing->id)
                                            ->whereIn('type', ['new', 'transfer'])
                                            ->where('status', 1)
                                            ->get();
                                    }
                    
                                    if ($type === '4') {
                                        $offer_line = ' Offer a free domain registration/transfer and free renewal (if product is renewed)';
                                        $tlds = '';
                                        $tlds = App\Models\DomainPricingList::where('domain_pricing_id', $domain_pricing->id)
                                            ->where('status', 1)
                                            ->get();
                                    }
                    
                                    foreach ($tlds as $tld) {
                                        $tldValues[] = $tld->tld;
                                    }
                                }
                            }
                        }
                    }
                    $tldValues = implode(' / ', array_unique($tldValues));
                ?>
                <?php echo $tldValues ?: '<i class="fa fa-times red"></i>'; ?>

                <p><span class="red"> <?php echo !empty($offer_line) ? $offer_line : ''; ?></span></p>
                <?php if($type === '3'): ?>
                    <p><span class="red">Sale</span>. First Year just <span class="red">RM
                            <?php echo e($fee); ?> </span></p>
                <?php endif; ?>
            </th>
    <?php endif; ?>
    <?php endfor; ?>
    </tr>
    <?php endif; ?>
    <?php if(count($featured_plans) > 0 && count($plans) > 0): ?>
        <?php $__currentLoopData = $featured_plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="alileft"><?php echo e($f->title); ?></td>
                <?php for($j = 0; $j < 3; $j++): ?>
                    <?php if(isset($plans[$j])): ?>
                        <td>
                            <?php
                                $details = App\Models\PlanFeatureDetail::where('plan_feature_id', $f->id)
                                    ->where('plan_id', $plans[$j]->id)
                                    ->first();
                            ?>
                            <?php if($details): ?>
                                <?php if($details->select_yes_no === 'yes'): ?>
                                    <i class="fa fa-check sitecolor"></i>
                                <?php elseif($details->select_yes_no === 'no'): ?>
                                    <i class="fa fa-times red"></i>
                                <?php endif; ?>
                                <?php echo e($details->description); ?>

                            <?php else: ?>
                                <i class="fa fa-times red"></i>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                <?php endfor; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if(!empty($plans)): ?>
    <?php if(@$i->hide_on_mobile == 1): ?>

        <tr>
            <th class="alileft">Setup Fee</th>
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th>
                    <?php if($plan->setup_fee_one_time == '0' || $plan->price_type == 'Free'): ?>
                        <i class="fa fa-check sitecolor"></i>
                    <?php else: ?>
                        RM <?php echo e($plan->setup_fee_one_time); ?>

                    <?php endif; ?>
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
<?php if($plans[0]->price_type == "One Time"): ?>
        <tr>
			
            <td class="alileft text-red">One Time Fee</td>
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td class="text-red">
                    <?php if($plan->price_one_time == '0' || $plan->price_one_time == '' || $plan->price_type == 'Free'): ?>
                        <i class="fa fa-times red"></i>
                    <?php else: ?>
						<?php if($plan->price_type == 'One Time'): ?>
							RM <?php echo e($plan->price_one_time); ?>

						<?php else: ?>
							<i class="fa fa-times red"></i>
						<?php endif; ?>
                        
                    <?php endif; ?>
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
<?php endif; ?>
<?php if($plans[0]->price_type == "Recurring"): ?>
        <tr>
            <th class="alileft text-red">First Month</th>
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th class="text-red">
                    <?php if($plan->recurring_first_month == '0' || $plan->recurring_first_month == '' || $plan->price_type == 'Free'): ?>
                        <i class="fa fa-times red"></i>
                    <?php else: ?>
						<?php if($plan->price_type == 'Recurring' || $plan->price_type == 'Free'): ?>
							RM <?php echo e($plan->recurring_first_month); ?> / mth
						<?php else: ?>
							<i class="fa fa-times red"></i>
						<?php endif; ?>
                        
                    <?php endif; ?>
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
            <td class="alileft text-red">First Year</td>
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td class="text-red">
                    <?php if($plan->recurring_first_year == '0' || $plan->recurring_first_year == '' || $plan->price_type == 'Free'): ?>
                        <i class="fa fa-times red"></i>
                    <?php else: ?>
						<?php if($plan->price_type == 'Recurring' || $plan->price_type == 'Free'): ?>
							RM <?php echo e($plan->recurring_first_year); ?> / yr
						<?php else: ?>
							<i class="fa fa-times red"></i>
						<?php endif; ?>
                        
                    <?php endif; ?>
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
            <th class="alileft text-red">Price (Annually)</th>
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th class="text-red">
                    <?php if($plan->price_annually == '0' || $plan->price_annually == '' || $plan->price_type == 'Free'): ?>
                        <i class="fa fa-times red"></i>
                    <?php else: ?>
						<?php if($plan->price_type == 'Recurring' || $plan->price_type == 'Free'): ?>
							RM <?php echo e($plan->price_annually); ?> / yr
						<?php else: ?>
							<i class="fa fa-times red"></i>
						<?php endif; ?>
                    <?php endif; ?>
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
            <td class="alileft text-red">Price (Biennially)</td>
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td class="text-red">
                    <?php if($plan->price_biennially == '0' || $plan->price_biennially == '' || $plan->price_type == 'Free'): ?>
                        <i class="fa fa-times red"></i>
                    <?php else: ?>
						<?php if($plan->price_type == 'Recurring' || $plan->price_type == 'Free'): ?>
							RM <?php echo e($plan->price_biennially); ?> / 2 yrs
						<?php else: ?>
                            <i class="fa fa-times red"></i>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
            <th class=" text-red alileft">Price (Triennially)</th>
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th class="text-red">
                    <?php if($plan->price_triennially == '0' || $plan->price_triennially == '' || $plan->price_type == 'Free'): ?>
                        <i class="fa fa-times red"></i>
                    <?php else: ?>
                        <?php if($plan->price_type == 'Recurring' || $plan->price_type == 'Free'): ?>
                            RM <?php echo e($plan->price_triennially); ?> / 3 yrs
                        <?php else: ?>
                            <i class="fa fa-times red"></i>
                        <?php endif; ?>
                    <?php endif; ?>
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
<?php endif; ?>
    <?php endif; ?>
    <?php endif; ?>
    <tr>
        <td class="first rowfirst"></td>
        <?php if(!empty($plans)): ?>
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <td class="rowsremain  <?php if(strtolower($i->sort_order) == '2' && $i->promo_behaviour != 'none'): ?> center <?php endif; ?>">
                    <div class="prices">
                       <?php if($i->hide_on_mobile == 1 ): ?>
                        <?php if($i->price_type == 'Recurring'): ?>
                            <strong><i>RM</i><?php echo e($i->price_monthly or '0'); ?><i>/mo</i></strong>
                        <?php endif; ?>
                        <?php if($i->price_type == 'One Time'): ?>
                            <strong><i>RM</i><?php echo e(number_format($i->price_one_time + $i->setup_fee_one_time, 2)); ?></strong>
                        <?php endif; ?>
                        <?php if($i->price_type == 'Free'): ?>
                            <strong>Free</strong>
                        <?php endif; ?>
                        <?php endif; ?>
                        <b></b>
                        <!-- <?php if($i->enable_plan_button != 'other'): ?>
						<?php if($i->id != 19): ?>
							<?php if(in_array($i->id, [14, 20])): ?>
							<a href="<?php echo e(route('configDedicate')); ?>?id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button); ?></a>
							<?php else: ?>
							<a href="javascript:void(0)"><?php echo e($i->enable_plan_button); ?></a>
							<?php endif; ?>
							<?php else: ?>
							<a href="javascript:showModel()"><?php echo e($i->enable_plan_button); ?></a>
							<?php endif; ?>
							<?php elseif($i->enable_plan_button == 'Ask for Quote'): ?>
							<a href="javascript:showModel()"><?php echo e($i->enable_plan_button); ?></a>
							<?php else: ?>
							<a href="javascript:void(0)"><?php echo e($i->enable_plan_button); ?></a>
						<?php endif; ?> -->
                        <?php if($i->enable_plan_button == 'Order Now'): ?>
                            <?php if(Request::path() == 'services/dedicated_servers'): ?>
                               <?php if(!empty(request('domain'))): ?>
                                <a
                                    href="<?php echo e(route('configDedicate')); ?>?search_domain=<?php echo e(request('domain')); ?>&id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button); ?></a>
                                <?php else: ?>
                                <a
                                    href="<?php echo e(route('configDedicate')); ?>?id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button); ?></a>
                                <?php endif; ?>
                            <?php else: ?>
                              <?php if(!empty(request('domain'))): ?>
                              <a
                                    href="/domain_configuration_hosting?search_domain=<?php echo e(request('domain')); ?>&url=<?php echo e(Request::segment(2)); ?>&amp;name=<?php echo e($page_name); ?>&amp;id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button); ?></a>
                              <?php else: ?>
                                <a
                                    href="/domain_configuration_hosting?url=<?php echo e(Request::segment(2)); ?>&amp;name=<?php echo e($page_name); ?>&amp;id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php elseif($i->enable_plan_button == 'Ask for Quote'): ?>
                            <a href="javascript:showModel()"><?php echo e($i->enable_plan_button); ?></a>
                        <?php elseif($i->enable_plan_button == 'other'): ?>
                            <?php if(Request::path() == 'services/dedicated_servers'): ?>
                              <?php if(!empty(request('domain'))): ?>
                                <a
                                    href="<?php echo e(route('configDedicate')); ?>?search_domain=<?php echo e(request('domain')); ?>&id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button_other); ?></a>
                              <?php else: ?>
                              <a
                                    href="<?php echo e(route('configDedicate')); ?>?id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button_other); ?></a>
                              <?php endif; ?>
                            <?php else: ?>
                            <?php if(!empty(request('domain'))): ?>
                            <a
                                    href="/domain_configuration_hosting?search_domain=<?php echo e(request('domain')); ?>&url=<?php echo e(Request::segment(2)); ?>&amp;name=<?php echo e($page_name); ?>&amp;id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button_other); ?></a>
                            <?php else: ?>
                                <a
                                    href="/domain_configuration_hosting?url=<?php echo e(Request::segment(2)); ?>&amp;name=<?php echo e($page_name); ?>&amp;id=<?php echo e($i->id); ?>"><?php echo e($i->enable_plan_button_other); ?></a>
                            <?php endif; ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="javascript:void(0)"><?php echo e($i->enable_plan_button); ?></a>
                        <?php endif; ?>
                    </div>
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <!-- <td class="rowsremain center">
			<div class="prices">
				<strong><i>RM</i>80<i>.00/mo</i></strong> <b></b>
				<a data-target="#modal-enquire" data-toggle="modal" href="#">Order Now</a>
			</div>
		</td> -->
    </tr>
</table>
<?php echo $__env->make('frontend._ask_quota', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\xampp\htdocs\web88\resources\views/frontend/_hosting_plans.blade.php ENDPATH**/ ?>