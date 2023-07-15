<?php

$currentURL = url()->current();
$baseURL = url('/');
$basePath = str_replace($baseURL, '', $currentURL);


?>
<?php if(strpos($basePath, 'ecommerce') !== false): ?>
<?php echo $__env->make('frontend.ecommerce', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(strpos($basePath,'email88') !== false): ?>
<?php echo $__env->make('frontend.email88', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(strpos($basePath,'web88ir') !== false): ?>
<?php echo $__env->make('frontend.web88ir', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>


<?php if(isset($cms->page_title) && $cms->meta_status != 2): ?>
<?php $__env->startSection('title', $cms->page_title .' | - Webqom Technologies'); ?>
<?php else: ?>
<?php $__env->startSection('title', ucwords($page_name) .' | - Webqom Technologies'); ?>
<?php endif; ?>

<?php if(isset($cms->meta_keyword) && $cms->meta_status != 2): ?>
<?php $__env->startSection('meta_keyword', $cms->meta_keyword); ?>
<?php endif; ?>
<?php if(isset($cms->meta_description) && $cms->meta_status != 2): ?>
<?php $__env->startSection('meta_description', $cms->meta_description); ?>
<?php endif; ?>





<?php $__env->startSection('content'); ?>
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

<?php if(strpos($basePath, 'bulk_domain_search') !== false): ?>
<div class="page_title1 sty7">
    <h1>
        <?php echo e($page_header); ?>

        <em><?php echo e($sub_header); ?></em>
    </h1>
    <!-- Bulk Domain Search Form: Start -->
    <?php if(strpos($basePath, 'bulk_domain_search') !== false): ?>
    <div class="serch_area">
        <?php echo e(Form::open([
    'route' => ['frontend.services', 'bulk_domain_search'],
    'method' => 'GET',
])); ?>

        <?php echo e(Form::textarea('bulk_domains', '', [
    'required' => true,
    'rows' => 6,
    'style' => 'width: 80.2%; float:left;',
    'placeholder' => "Enter up to 20 domain names.\r\nEach name must be on a separate line.\r\n\r\nExamples:\r\nyourdomain.com\r\nyourdomain.net",
])); ?>

        <?php echo e(Form::submit('Search', ['class' => 'input_submit'])); ?>

        <div class="clearfix"></div>
        <?php echo e(Form::close()); ?>

        <div class="molinks">
            <a href="<?php echo e(route('frontend.services', 'single_domain_search')); ?>">
                <i class="fa fa-caret-right"></i> Single Domain Search
            </a>
            <a href="<?php echo e(route('frontend.services', 'bulk_domain_transfer')); ?>">
                <i class="fa fa-caret-right"></i> Bulk Transfer</a>
        </div>
    </div>
    <?php endif; ?>
    <!-- Bulk Domain Search Form: End -->
</div>

<div class="clearfix"></div>

<!-- Bulk Domain Search Error Alert Box: Start -->
<?php if(Session::has('failed')): ?>
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
<?php endif; ?>
<!-- Bulk Domain Search Error Alert Box: End -->


<?php if(!empty($bulkDomains) && !Session::has('failed')): ?>
<div class="clearfix margin_bottom5 scrollToThis" id="scrollToThis"></div>
<div class="one_full stcode_title9 scroll-focus-marker">
    <h1 class="caps">
        <strong>Bulk Domain Search Result</strong>
    </h1>
</div>
<div class="clearfix"></div>
<div class="feature_section102">
    <?php echo e(Form::open(['url' => url('/domain_configuration')])); ?>

    <div class="plan">
        <div class="container">
            <?php if(isset($response) && !empty($response->taken)): ?>
            <?php $__currentLoopData = $response->error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($err->status == 4): ?>
            <h3 class="light red">
                <i class="fa fa-times-circle"></i> <strong>Sorry <?php echo e($k); ?></strong> is
                not available for registration.
            </h3>
            <?php elseif($err->status == 5): ?>
            <h3 class="light red">
                <i class="fa fa-times-circle"></i> <?php echo e($k); ?> Something went wrong!
            </h3>
            <?php elseif($err->status == 1): ?>
            <h3 class="light red">
                <i class="fa fa-times-circle"></i> <strong>Sorry</strong> <?php echo e($k); ?>

                is already taken!
            </h3>
            <?php else: ?>
            <h3 class="light red">
                <i class="fa fa-times-circle"></i><?php echo e($k); ?> Invalid domain
                name/extension!
            </h3>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
                        <?php $__currentLoopData = $response->error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="alicent">
                                <?php if($dp->status == 0): ?>
                                <input type="checkbox" class="selectDomain1" checked="checked" />
                                <?php else: ?>
                                <i class="fa fa-times red"></i>
                                <?php endif; ?>
                            </td>
                            <td id="domainName"><?php echo e($key); ?></td>
                            <td>
                                <?php if($dp->status == 0): ?>
                                <span class="label label-sm label-success">
                                    Available
                                </span>
                                <?php else: ?>
                                <span class="label label-sm label-red">
                                    Unavailable
                                </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($dp->status == 0): ?>
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $bulk = str_replace('www.', '', $key);
                                $extension = strstr($key, '.');
                                ?>
                                <?php if($dpl->type == 'new' && $dpl->tld == $extension): ?>
                                <select class="form-control input-medium">
                                    <?php $__currentLoopData = json_decode($dpl->pricing); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($loop->index + 1); ?> year" <?php echo e($loop->index == 1 ? 'selected="selected"' : ''); ?>>
                                        <?php echo e($loop->index + 1); ?> year(s) @ RM
                                        <?php echo e($price->s); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <a href="http://<?php echo e($key); ?>" target="_blank">
                                    WWW
                                </a>
                                |
                                <a href="<?php echo e(route('frontend.domain.whois', $key)); ?>">
                                    WHOIS
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5"></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="clearfix"></div>
            </div>
            <?php endif; ?>

            <div class="clearfix"></div>
            <?php if(isset($response) && !empty($response->available)): ?>
            <h3 class="light green"><i class="fa fa-check-circle"></i> Congratulations!
                <strong><?php echo e($response->available); ?></strong>
                <?php echo e(count(explode(',', $response->available)) > 1 ? 'are' : 'is'); ?>

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
                        <?php $__currentLoopData = $response->success; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="alicent">
                                <?php if($dp->status == 0): ?>
                                <input type="hidden" name="text[<?php echo e($key); ?>]" value="1" id="transfer_text">
                                <?php echo e(Form::checkbox('domain-search-checkbox[]', $key, true, ['class' => 'selectDomain2 '])); ?>

                                <?php else: ?>
                                <i class="fa fa-times red"></i>
                                <?php endif; ?>
                            </td>
                            <td id="domainName">
                                <?php echo e($key); ?>

                            </td>
                            <td>
                                <?php if($dp->status == 0): ?>
                                <span class="label label-sm label-success">Available</span>
                                <?php else: ?>
                                <span class="label label-sm label-red">Unavailable</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php

                                $arrayKeys = array_keys($bulk_price_cycle_list[$key]);

                                foreach ($arrayKeys as $k=>$value){
                                $v = explode ("|", $value);
                                if(isset($v[1]) && $v[1]==0){
                                $emptyValue = $k.'|'.$v[1];
                                unset($bulk_price_cycle_list[$key][$emptyValue]);
                                }else{
                                if(isset($v[1])){
                                $newvalue = number_format($v[1],2);
                                $oldValue = ($k+1).'|'.$v[1];
                                $bulk_price_cycle_list[$key][$oldValue]= ($k+1).' year(s) @ RM '.$newvalue;
                                }
                                }
                                }

                                ?>
                                <?php if($dp->status == 0): ?>

                                <?php echo e(Form::select('domain-search-dropdown[' . $key . ']', $bulk_price_cycle_list[$key], array_keys(array_slice($bulk_price_cycle_list[$key], 1, 1, true))[0], ['class' => 'form-control input-medium'])); ?>

                                <?php else: ?>
                                <a href="http://<?php echo e($key); ?>" target="_blank">WWW</a> |
                                <a href="<?php echo e(route('frontend.domain.whois', $key)); ?>">WHOIS</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn-sm btn-danger caps add_to_cart domain-search-add">
                                    <i class="fa icon-basket-loaded"></i> <b>Add</b>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5"></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="clearfix"></div>
            </div>
            <?php endif; ?>

            <a href="#" data-target="#notification" data-toggle="modal">
                <!--note to programmer: pop up
                                notification
                                example of not choosing any hosting plan, remove this text once is done.-->
            </a>

            <!--Modal notification start-->
            <div id="notification" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
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
                                        <button type="button" data-toggle="dropdown" class="btn btn-warning dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle
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
                <?php echo e(Form::button('<i class="fa icon-basket-loaded"></i> <b>Proceed to checkout</b>', [
    'type' => 'submit',
    'class' => 'btn btn-danger caps',
])); ?>&nbsp;
            </div><!-- end domain search result -->

            <div class="clearfix margin_bottom3"></div><!-- end section -->
        </div>
    </div><!-- end plan 1 -->
    <?php echo e(Form::close()); ?>

    <div class="clearfix"></div>
</div><!-- end featured section 102 -->
<?php endif; ?>
<!-- Bulk Domain Search View: End -->

<!-- Bulk Domain Transfer: Start -->
<?php elseif(strpos($basePath, 'bulk_domain_transfer') !== false): ?>
<div class="page_title1 sty7">
    <h1>TRANSFER DOMAINS</h1>
    <div class="serch_area">
        <form method="get" action="<?php echo e(route('frontend.services', 'bulk_domain_transfer')); ?>">
            <textarea required name="transfer_domains" rows="6" style="width: 80.2%; float:left;" placeholder="Enter up to 20 domain names.
          Each name must be on a separate line.

          Examples:
          yourdomain.com
          yourdomain.net"></textarea>
            <input name="" value="Transfer" class="input_submit" type="submit">
        </form>
        <br />
        <div class="molinks">
            <a href="<?php echo e(route('frontend.services', 'single_domain_search')); ?>">
                <i class="fa fa-caret-right"></i> Single Domain Search
            </a>
            <a href="<?php echo e(route('frontend.services', 'single_domain_transfer')); ?>">
                <i class="fa fa-caret-right"></i> Single Domain Transfer
            </a>
        </div>
    </div><!-- end section -->
</div><!-- end page title -->

<?php if(Session::has('failed')): ?>
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
<?php endif; ?>

<?php if(!empty($response) && !Session::has('failed')): ?>
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
            <?php $__currentLoopData = $response; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $singleDomain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($singleDomain->status_code == 1): ?>
            <?php if($singleDomain->status_code == 'A'): ?>
            <h3 class="light red">
                <i class="fa fa-times-circle"></i> Sorry! Your domain is <strong>LOCKED</strong>
                and cannot be transferred without being unlocked.
            </h3>
            <?php else: ?>
            <h3 class="light green">
                <i class="fa fa-check-circle"></i> Congratulations!
                <strong><?php echo e($key); ?></strong> is eligible for transfer!
            </h3>
            <?php endif; ?>
            <?php elseif($singleDomain->status_code == 0): ?>
            <h3 class="light red">
                <i class="fa fa-times-circle"></i> Sorry! <strong><?php echo e($key); ?> does not
                    appear to be registered yet.</strong> Try registering this domain instead.
                <span><a href="/services/single_domain_search?search_domain=<?php echo e($key); ?>" class="btn-sm btn-danger caps"><i class="fa icon-basket-loaded"></i>
                        <b>Add</b></a>&nbsp;</span>
            </h3>

            <?php elseif($singleDomain->status_code == 5): ?>
            <h3 class="light red">
                <i class="fa fa-times-circle"></i> Sorry! <strong><?php echo e($key); ?> can't be
                    transferred.</strong> Transferring Prohibited.
            </h3>

            <?php elseif($singleDomain->status_code == 8): ?>
            <h3 class="light red">
                <i class="fa fa-times-circle"></i> Sorry! <strong><?php echo e($key); ?> is NOT
                    AVAILABLE for registration</strong> Transferring Prohibited.
            </h3>
            <?php endif; ?>
            <?php if($singleDomain->status_code == 0 || $singleDomain->status_code == 1 || $singleDomain->status_code == 5): ?>
            <div class="alertymes6">
                <h3 class="light alileft">
                    <i class="fa fa-list-alt"></i><strong>Domain Transfer Checklist</strong>
                </h3>

                <div class="clearfix margin_bottom1"></div>

                <div class="one_half_less">
                    <div class="alileft">
                        <ul>
                            <li>
                                <i class="fa fa-long-arrow-right dark"></i><span class="text-18px dark light">Is Domain Privacy
                                    disabled?</span>&nbsp;
                                <span class="text-18px <?php echo e($singleDomain->privacy ? 'red' : 'green'); ?>"><b><?php echo e($singleDomain->privacy ? 'No' : 'Yes'); ?></b></span>
                            </li>
                            <li>
                                <i class="fa fa-long-arrow-right dark"></i><span class="text-18px dark light">Is the domain older than 60
                                    days?</span>&nbsp;
                                <span class="text-18px <?php echo e($singleDomain->reg_days > 60 ? 'green' : 'red'); ?>"><b><?php echo e($singleDomain->reg_days > 60 ? 'Yes' : 'No'); ?></b></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- end section -->

            <div class="clearfix margin_bottom3"></div>
            <?php endif; ?>
            <div class="table-responsive mtl">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="1%">
                                <?php if($singleDomain->status_code == 1): ?>
                                <input type="checkbox" id="selectAll5" />
                                <?php endif; ?>
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
                                <?php if($singleDomain->status_code == 1): ?>
                                <input type="checkbox" class="selectDomain5" checked="checked" />
                                <?php else: ?>
                                <i class="fa fa-times red"></i>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($key); ?></td>
                            <td>
                                <?php if($singleDomain->status_code == 1): ?>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Enter domain password">
                                </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($singleDomain->status_code == 1): ?>
                                <?php $status = 0; ?>
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $bulk = str_replace('www.', '', $key);
                                $extension = strstr($key, '.');
                                ?>
                                <?php
                                $site = explode('.', $key);
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
                                if (isset($dom)) {
                                ?>
                                    <?php if($dpl->type == 'transfer' && ($dpl->tld == '.'.$dom || $dpl->tld == $dom)): ?>

                                    <select class="form-control input-medium">
                                        <?php $__empty_1 = true; $__currentLoopData = json_decode($dpl->pricing); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <option value="<?php echo e($loop->index + 1); ?> year" <?php echo e($loop->index == 1 ? 'selected="selected"' : ''); ?>>
                                            <?php echo e($loop->index + 1); ?> year(s) @ RM
                                            <?php echo e($price->s); ?>

                                        </option>
                                        <?php $status = 1; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                        <?php endif; ?>
                                    </select>

                                    <?php endif; ?>
                                <?php } ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!$status): ?>
                                No Price is available for this TLD
                                <?php endif; ?>
                                <?php else: ?>
                                <a href="http://<?php echo e($key); ?>" target="_blank">
                                    WWW
                                </a>
                                |
                                <a href="<?php echo e(route('frontend.domain.whois', $key)); ?>">
                                    WHOIS
                                </a>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($singleDomain->status_code == 1): ?>
                                <?php if ($status) : ?>
                                    <input type="hidden" name="text[<?php echo e($key); ?>]" value="2" id="transfer_text">
                                    <a href="javascript:void(0)" class="btn-sm btn-danger caps"><i class="fa icon-basket-loaded add_to_cart"></i> <b>Add</b></a>&nbsp;
                                <?php else : ?>
                                    <a href="#" class="btn-sm btn-danger caps disabled"><i class="fa icon-basket-loaded"></i> <b>Add</b></a>

                                <?php endif; ?>
                                <?php else: ?>
                                <a href="#" class="btn-sm btn-danger caps disabled"><i class="fa icon-basket-loaded"></i> <b>Add</b></a>
                                <?php endif; ?>
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($singleDomain->status_code == 1): ?>
            <div class="alicent">
                <a href="<?php echo e(url('/shopping_cart')); ?>" class="btn btn-danger caps">
                    <i class="fa icon-basket-loaded"></i> <b>Add to cart</b>
                </a>&nbsp;
            </div>
            <?php endif; ?>
        </div>
    </div><!-- end plan 1 -->
    <div class="clearfix"></div>
</div><!-- end featured section 102 -->
<?php endif; ?>

<!-- Single Domain Transfer: Start -->
<?php elseif(strpos($basePath, 'single_domain_search') !== false): ?>
<div class="page_title1 sty7">
    <h1>FIND YOUR PERFECT DOMAIN NAME</h1>
    <div class="serch_area">
        <?php echo e(Form::open([
    'route' => ['frontend.services', 'single_domain_search'],
    'method' => 'GET',
])); ?>

        <?php echo e(Form::text('search_domain', '', [
    'required' => true,
    'class' => 'enter_email_input',
    'id' => 'samplees',
    'placeholder' => 'Enter your domain name here...',
    'onFocus' => "if(this.placeholder == 'Enter your domain name here...') {this.placeholder = '';}",
    'onBlur' => "if (this.placeholder == '') {this.placeholder = 'Enter your domain name here...';}",
])); ?>

        <?php echo e(Form::submit('Search Domain', ['class' => 'input_submit'])); ?>

        <?php echo e(Form::close()); ?>

        <br />
        <div class="molinks">
            <a href="<?php echo e(route('frontend.services', 'bulk_domain_search')); ?>">
                <i class="fa fa-caret-right"></i> Bulk Domain Search
            </a>
            <a href="<?php echo e(route('frontend.services', 'bulk_domain_transfer')); ?>">
                <i class="fa fa-caret-right"></i> Bulk Transfer
            </a>
        </div>
    </div><!-- end section -->

</div><!-- end page title -->
<div class="clearfix"></div>

<?php if(Session::has('failed')): ?>
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
<?php endif; ?>

<?php if(!empty($search_domain) && !Session::has('failed')): ?>
<div class="clearfix margin_bottom5"></div>
<div class="one_full stcode_title9 scroll-focus-marker">
    <h1 class="caps">
        <strong>Single Domain Search Result</strong>
    </h1>
</div>
<div class="clearfix"></div>
<div class="feature_section102">
    <?php echo e(Form::open(['url' => url('/domain_configuration')])); ?>

    <div class="plan">
        <div class="container">
            <?php if(isset($response) && !empty($response->taken)): ?>
            <div class="alert alert-danger">
                <?php $__currentLoopData = $response->error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($err->status == 4): ?>
                <h3 class="light red">
                    <i class="fa fa-times-circle"></i> <strong>This domain
                        <?php echo e($response->taken); ?> is not available for registration</strong>
                </h3>
                <?php elseif($err->status == 5): ?>
                <h3 class="light red">
                    <i class="fa fa-times-circle"></i>Something went wrong!
                </h3>
                <?php elseif($err->status == 1): ?>
                <h3 class="light red">
                    <i class="fa fa-times-circle"></i> <strong>Sorry</strong>
                    <?php echo e($response->taken); ?> is already taken!
                </h3>
                <?php else: ?>
                <h3 class="light red">
                    <i class="fa fa-times-circle"></i>Invalid domain name/extension!
                </h3>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <?php $__currentLoopData = $response->error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="alicent">
                                <?php if($dp->status == 0): ?>
                                <input type="checkbox" class="selectDomain3" checked="checked" />
                                <?php else: ?>
                                <i class="fa fa-times red"></i>
                                <?php endif; ?>
                            </td>
                            <td id="domainName"><?php echo e($key); ?></td>
                            <td>
                                <?php if($dp->status == 0): ?>
                                <input type="hidden" name="text[<?php echo e($key); ?>]" value="1" id="transfer_text">

                                <span class="label label-sm label-success">Available</span>
                                <?php else: ?>
                                <span class="label label-sm label-red">Unavailable</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($dp->status == 0): ?>
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $bulk = str_replace('www.', '', $key);
                                $extension = strstr($key, '.');
                                ?>

                                <?php if($dpl->type == 'new' && $dpl->tld == $extension): ?>
                                <select class="form-control input-medium">
                                    <?php $__currentLoopData = json_decode($dpl->pricing); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($loop->index + 1); ?> year" <?php echo e($loop->index == 1 ? 'selected="selected"' : ''); ?>>
                                        <?php echo e($loop->index + 1); ?> year(s) @ RM
                                        <?php echo e($price->s); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <a href="http://<?php echo e($key); ?>" target="_blank">
                                    WWW
                                </a>
                                |
                                <a href="<?php echo e(route('frontend.domain.whois', $key)); ?>">
                                    WHOIS
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5"></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="clearfix"></div>
            </div>
            <?php endif; ?>

            <div class="clearfix"></div>

            <?php if(isset($response) && !empty($response->available)): ?>
            <h3 class="light green">
                <i class="fa fa-check-circle"></i> Congratulations!!
                <strong><?php echo e($response->available); ?></strong>
                <?php echo e(count(explode(',', $response->available)) > 1 ? 'are' : 'is'); ?> available!
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
                        <?php $__currentLoopData = $response->success; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td class="alicent">
                                <?php if($dp->status == 0): ?>
                                <?php echo e(Form::checkbox('domain-search-checkbox[]', $key, true, ['class' => 'selectDomain4'])); ?>

                                <?php else: ?>
                                <i class="fa fa-times red"></i>
                                <?php endif; ?>
                            </td>
                            <td id="domainName">
                                <?php echo e($key); ?>

                            </td>
                            <td>
                                <?php if($dp->status == 0): ?>
                                <input type="hidden" name="text[<?php echo e($key); ?>]" value="1" id="transfer_text">

                                <span class="label label-sm label-success">Available</span>
                                <?php else: ?>
                                <span class="label label-sm label-red">Unavailable</span>
                                <?php endif; ?>
                            </td>
                            <td>

                                <?php if($dp->status == 0): ?>
                                <?php

                                $arrayKeys = array_keys($price_cycle_list);
                                foreach ($arrayKeys as $k=>$value){
                                $v = explode ("|", $value);
                                if(isset($v[1]) && $v[1]==0 && $k > 0){
                                $emptyValue = $k.'|'.$v[1];
                                unset($price_cycle_list[$emptyValue]);
                                }else{
                                if(isset($v[1])){
                                $newvalue = number_format($v[1],2);
                                $oldValue = $k.'|'.$v[1];
                                $price_cycle_list[$oldValue]= $k.' year(s) @ RM '.$newvalue;

                                }
                                }

                                }

                                ?>
                                <?php echo e(Form::select('domain-search-dropdown[' . $key . ']', $price_cycle_list, array_keys(array_slice($price_cycle_list, 1, 1, true))[0], ['class' => 'form-control input-medium'])); ?>

                                <?php else: ?>
                                <a href="http://<?php echo e($key); ?>" target="_blank">
                                    WWW
                                </a>
                                |
                                <a href="<?php echo e(route('frontend.domain.whois', $key)); ?>">
                                    WHOIS
                                </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn-sm btn-danger caps add_to_cart domain-search-add">
                                    <i class="fa icon-basket-loaded"></i> <b>Add</b>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5"></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="clearfix"></div>
            </div>
            <?php endif; ?>

            <a href="#" data-target="#notification" data-toggle="modal">
                <!--note to programmer: pop up notification example of not choosing any hosting plan, remove
                this text once is done.-->
            </a>

            <!--Modal notification start-->
            <div id="notification" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade">
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
                                        <button type="button" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">
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

                <?php echo e(Form::button('<i class="fa icon-basket-loaded"></i><b>Proceed to checkout</b>', [
    'type' => 'submit',
    'class' => 'btn btn-danger caps',
])); ?>&nbsp;
            </div><!-- end domain search result -->
            <div class="clearfix margin_bottom3"></div><!-- end section -->
        </div>
    </div><!-- end plan 1 -->
    <?php echo e(Form::close()); ?>

    <div class="clearfix"></div>
</div><!-- end featured section 102 -->
<?php endif; ?>

<?php elseif(strpos($basePath, 'single_domain_transfer') !== false): ?>
<div class="page_title1 sty7">
    <h1>
        TRANSFER YOUR DOMAIN
        <!--<em>Huge Choice. Low Prices. Register your perfect domain name today.</em>
                          <span class="line2"></span>-->
    </h1>

    <div class="serch_area">
        <form method="get" action="<?php echo e(route('frontend.services', 'single_domain_transfer')); ?>">
            <input class="enter_email_input" name="transfer_domain" id="samplees" value="" onFocus="if(this.value == '') {this.value = '';}" required onBlur="if (this.value == '') {this.value = '';}" type="text" placeholder="www.transferyourdomain">
            <input name="" value="Transfer" class="input_submit" type="submit">
        </form>
        <br />
        <div class="molinks"><a href="<?php echo e(route('frontend.services', 'bulk_domain_search')); ?>">
                <i class="fa fa-caret-right"></i> Bulk Domain Search</a> <a href="<?php echo e(route('frontend.services', 'bulk_domain_transfer')); ?>"><i class="fa fa-caret-right"></i> Bulk Transfer</a>
        </div>
    </div><!-- end section -->
</div><!-- end page title -->

<?php if(Session::has('failed')): ?>
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
<?php endif; ?>

<?php if(!empty($response) && !Session::has('failed')): ?>
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
            <?php if($response->status_code == 1): ?>
            <?php if($response->status_code == 'A'): ?>
            <h3 class="light red">
                <i class="fa fa-times-circle"></i> Sorry! Your domain is <strong>LOCKED</strong> and
                cannot be transferred without being unlocked.
            </h3>
            <?php else: ?>
            <h3 class="light green">
                <i class="fa fa-check-circle"></i> Congratulations!
                <strong><?php echo e($response->domain); ?></strong> is eligible for transfer!

            </h3>
            <?php endif; ?>
            <?php elseif($response->status_code == 0): ?>
            <h3 class="light red">
                <i class="fa fa-times-circle"></i> Sorry! <strong><?php echo e($response->domain); ?> does not
                    appear to be registered yet.</strong> Try registering this domain instead.
                <span><a href="/services/single_domain_search?search_domain=<?php echo e($response->domain); ?>" class="btn-sm btn-danger caps"><i class="fa icon-basket-loaded"></i>
                        <b>Add</b></a>&nbsp;</span>
            </h3>
            <?php elseif($response->status_code == 5): ?>
            <h3 class="light red">
                <i class="fa fa-times-circle"></i> Sorry! <strong><?php echo e($response->domain); ?> can't be
                    transferred.</strong> Transferring Prohibited.
            </h3>
            <?php else: ?>
            <!-- <h3 class="light red"><i class="fa fa-times-circle"></i> Sorry!
                                          <strong>
                                              extension is not allowed!</strong>
                                      </h3> -->
            <?php endif; ?>

            <?php if($response->status_code == 0 || $response->status_code == 1 || $response->status_code == 5): ?>
            <div class="alertymes6">
                <h3 class="light alileft">
                    <i class="fa fa-list-alt"></i><strong>Domain Transfer Checklist</strong>
                </h3>
                <div class="clearfix margin_bottom1"></div>
                <div class="one_half_less">
                    <div class="alileft">
                        <ul>
                            <li>
                                <i class="fa fa-long-arrow-right dark"></i><span class="text-18px dark light">Is Domain Privacy
                                    disabled?</span>&nbsp;
                                <span class="text-18px <?php echo e($response->privacy ? 'red' : 'green'); ?>"><b><?php echo e($response->privacy ? 'No' : 'Yes'); ?></b></span>
                            </li>
                            <li>
                                <i class="fa fa-long-arrow-right dark"></i><span class="text-18px dark light">Is the domain older than 60
                                    days?</span>&nbsp;
                                <span class="text-18px <?php echo e($response->reg_days > 60 ? 'green' : 'red'); ?>"><b><?php echo e($response->reg_days > 60 ? 'Yes' : 'No'); ?></b></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- end section -->
            <div class="clearfix margin_bottom3"></div>
            <?php endif; ?>
            <?php echo e(Form::open(['url' => url('/domain_configuration')])); ?>

            <div class="table-responsive mtl">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="1%">
                                <?php if($response->status_code == 1): ?>

                                <input type="checkbox" id="selectAll6" />
                                <?php endif; ?>
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
                                <?php if($response->status_code == 1): ?>
                                <?php echo e(Form::checkbox('domain-search-checkbox[]', $response->domain, true, ['class' => 'selectDomain6'])); ?>

                                <!-- <input type="checkbox" class="selectDomain6" checked="checked" /> -->
                                <?php else: ?>
                                <i class="fa fa-times red"></i>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($response->domain); ?></td>

                            <td>
                                <?php if($response->status_code == 1): ?>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Enter domain password">
                                </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($response->status_code == 1): ?>
                                <?php echo e(Form::select('domain-search-dropdown[' . $response->domain . ']', $price_cycle_list, array_keys(array_slice($price_cycle_list, 1, 1, true))[0], ['class' => 'form-control input-medium'])); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($response->status_code == 1): ?>
                                <?php if($response->text != ''): ?>
                                <?php $text = $response->text; ?>

                                <?php else: ?>
                                <?php $text = ''; ?>
                                <?php endif; ?>
                                <input type="hidden" name="text[<?php echo e($response->domain); ?>]" value="2" id="transfer_text">

                                <a href="javascript:void(0)" class="btn-sm btn-danger caps add_to_cart domain-search-add">
                                    <i class="fa icon-basket-loaded"></i> <b>Add</b>
                                </a>&nbsp;
                                <?php else: ?>
                                <a href="#" class="btn-sm btn-danger caps disabled">
                                    <i class="fa icon-basket-loaded"></i> <b>Add</b>
                                </a>
                                <?php endif; ?>
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
            <?php if($response->status_code == 1): ?>

            <div class="alicent" id="checkout_smt" style="display: none">

                <?php echo e(Form::button('<i class="fa icon-basket-loaded"></i><b>Proceed to checkout</b>', [
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger caps',
                                    ])); ?>&nbsp;
            </div><!-- end domain search result -->

            <?php endif; ?>
            <?php echo e(Form::close()); ?>

        </div>
    </div><!-- end plan 1 -->
    <div class="clearfix"></div>
</div><!-- end featured section 102 -->
<?php endif; ?>
<?php else: ?>
<div class="page_title1 sty2">
</div>
<div class="clearfix"></div>

<div class="price_compare" style="padding: 0px;">
    <br />
    <div class="container">
        <?php if(session()->has('success')): ?>
        <div class="alertymes5">
            <h3 class="light">
                <i class="fa fa-check-circle"></i><strong>Query Created </strong>
                <br />
                Your query has been successfully created.
            </h3>
        </div>

        <br />
        <br />
        <?php endif; ?>

        <div class="clearfix margin_bottom5"></div>
        <div class="clearfix"></div>
        <div class="one_full stcode_title9">
            <h1 class="caps">
                <strong><?php echo e($page_name); ?> Plans</strong>
                <em>Get Started Today!</em>
                <span class="line"></span>
            </h1>
        </div>
        <div class="clearfix margin_bottom5"></div>

        <div class="clearfix"></div>

        <?php if(count($plans) > 0): ?>
        <?php echo $__env->make("frontend._hosting_plans", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
        <p>No Plans found</p>
        <?php endif; ?>
    </div>
</div><!-- end choose plans -->
<?php endif; ?>

<!-- Domain Transfer Services Initial view: start -->
<?php if(strpos($basePath, 'bulk_domain_transfer') !== false || strpos($basePath, 'single_domain_transfer') !== false): ?>
<div class="feature_section103">
    <div class="container">
        <h1 class="caps white">
            <strong><?php echo e((!empty($general_features) && isset($general_features[0]->heading) && $general_features[0]->heading!='') ? $general_features[0]->heading : 'Why transfer to Webqom?'); ?></strong>
        </h1>

        <div class="clearfix margin_bottom2"></div>

        <?php if(!empty($general_features)): ?>
        <?php $__currentLoopData = $general_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="box animate" data-anim-type="fadeIn" data-anim-delay="100">
            <i class="fa <?php echo e($feature->icon); ?>"></i>
            <h4>
                <?php echo e($feature->title); ?>

                <div class="line"></div>
            </h4>
            <p class="sky-blue"><?php echo e($feature->description); ?></p>
        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
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
<?php endif; ?>

<div class="clearfix"></div>

<?php if($page_slug == 'co_cloud_hosting' || $page_slug == 'shared_hosting' || $duplicate_from == 'co_cloud_hosting' || $duplicate_from == 'shared_hosting'): ?>
<div class="feature_section7">
    <div class="container">
        <h1 class="caps">
            <strong>
                <?php if(count($general_features) > 0): ?>
                <h1 class="caps"><strong> <?php echo e($general_features[0]['heading'] or ''); ?> </strong></h1>
                <?php endif; ?>
            </strong>
        </h1>

        <?php if(!empty($general_features)): ?>
        <?php
        $count = 0;
        ?>
        <?php $__currentLoopData = $general_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $count++;
        ?>
        <div class="one_fifth_less <?php if($count % 5==0): ?> last <?php endif; ?>">
            <h5 class="caps">
                <?php if($i->icon_image == ''): ?>
                <i class="fa <?php echo e($i->icon); ?>"></i>
                <?php else: ?>
                <img src="<?php echo e(asset('/storage/general_features/icon_images/' . $i->icon_image)); ?>" style="display: block;" />
                <?php endif; ?>

                <?php echo e($i->title); ?>

            </h5>
        </div><!-- end -->

        <?php if($count % 5 == 0): ?>
        <div class="clearfix margin_bottom2"></div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div><!-- end featured section 7 -->
<?php endif; ?>

<div class="clearfix"></div>

<?php echo $cms->content; ?>


<?php if(strpos($basePath, 'bulk_domain_search') !== false): ?>
<div class="feature_section11">
    <div class="container">
        <!--<ul class="tabs">
            <li class="active">New Registrations</li>
            <li>Renewals</li>
            <li>Transfers</li>
        </ul>

        <ul class="tab__content">
            <li class="active">
                <div class="content__wrapper">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <?php $__currentLoopData = $domain_pricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($i['listing'])): ?>
                            <thead>
                                <tr>
                                    <th class="alicent"><?php echo e($i['listing']['tld']); ?></th>
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
                                <?php $__currentLoopData = $RMSALE; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $domain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $index = $key;
                                $pricing = $i->bulk_pricing->where('duration', $domain['duration'])->first();
                                ?>
                                <tr>
                                    <td><?php echo e($domain['duration']); ?></td>
                                    <td class="alicent">
                                        <span class="red">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_1) ? $pricing->year_sale_1 : ''); ?>

                                            *
                                        </span>
                                        <br />
                                        <span class="strike">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_1) ? $pricing->year_list_1 : ''); ?>

                                            *
                                        </span>
                                    </td>
                                    <td class="alicent">
                                        <span class="red">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_2) ? $pricing->year_sale_2 : ''); ?>

                                            *
                                        </span>
                                        <br />
                                        <span class="strike">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_2) ? $pricing->year_list_2 : ''); ?>

                                            *
                                        </span>
                                    </td>
                                    <td class="alicent">
                                        <span class="red">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_3) ? $pricing->year_sale_3 : ''); ?>

                                            *
                                        </span>
                                        <br />
                                        <span class="strike">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_3) ? $pricing->year_list_3 : ''); ?>

                                            *
                                        </span>
                                    </td>
                                    <td class="alicent">
                                        <span class="red">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_4) ? $pricing->year_sale_4 : ''); ?>

                                            *
                                        </span>
                                        <br />
                                        <span class="strike">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_4) ? $pricing->year_list_4 : ''); ?>

                                            *
                                        </span>
                                    </td>
                                    <td class="alicent">
                                        <span class="red">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_5) ? $pricing->year_sale_5 : ''); ?>

                                            *
                                        </span>
                                        <br />
                                        <span class="strike">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_5) ? $pricing->year_list_5 : ''); ?>

                                            *
                                        </span>
                                    </td>
                                    <td class="alicent">
                                        <span class="red">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_6) ? $pricing->year_sale_6 : ''); ?>

                                            *
                                        </span>
                                        <br />
                                        <span class="strike">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_6) ? $pricing->year_list_6 : ''); ?>

                                            *
                                        </span>
                                    </td>
                                    <td class="alicent">
                                        <span class="red">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_7) ? $pricing->year_sale_7 : ''); ?>

                                            *
                                        </span>
                                        <br />
                                        <span class="strike">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_7) ? $pricing->year_list_7 : ''); ?>

                                            *
                                        </span>
                                    </td>
                                    <td class="alicent">
                                        <span class="red">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_8) ? $pricing->year_sale_8 : ''); ?>

                                            *
                                        </span>
                                        <br />
                                        <span class="strike">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_8) ? $pricing->year_list_8 : ''); ?>

                                            *
                                        </span>
                                    </td>
                                    <td class="alicent">
                                        <span class="red">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_9) ? $pricing->year_sale_9 : ''); ?>

                                            *
                                        </span>
                                        <br />
                                        <span class="strike">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_9) ? $pricing->year_list_9 : ''); ?>

                                            *
                                        </span>
                                    </td>
                                    <td class="alicent">
                                        <span class="red">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_10) ? $pricing->year_sale_10 : ''); ?>

                                            *
                                        </span>
                                        <br />
                                        <span class="strike">
                                            RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_10) ? $pricing->year_list_10 : ''); ?>

                                            *
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tfoot>
                                <tr>
                                    <td colspan="6"></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </li>
            <li>
                <div class="content__wrapper">
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    

                    
                    
                    
                    
                    
                    
                    

                    
                </div>
            </li>

            <li>
                <div class="content__wrapper">

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    

                    
                    
                    
                    
                    
                    
                    

                    

                </div>
            </li>
        </ul>

        <p class="alileft red">* Terms &amp; conditions apply.</p>-->
    </div>
</div><!-- end feature section 11 -->
<div class="clearfix"></div>
<?php elseif(strpos($basePath, 'single_domain_search') !== false): ?>
<div class="feature_section11">
    <div class="container">
        <!--<form type="POST" id="gsr-contact" onSubmit="return valid_datas( this );">
            <label class="text-16px dark">
                <b>Show the Domain Pricing for:</b>
            </label>
            <div class="radiobut text-16px light dark">
                <input type="radio" id="all" checked="checked" name="tld" /> <span class="onelb">All
                    TLD</span>&nbsp;
                <?php
                $counter = 0;
                ?>

                <?php $__currentLoopData = $domainPricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="radio" id="<?php echo e($dp->id); ?>" ccount="<?php echo e(($counter + 1) * 3); ?>" name="tld" /> <span class="onelb"><?php echo e($dp->title); ?></span>&nbsp;
                <?php
                $counter++;
                ?>

                <?php if($counter % 6 == 0): ?>
                <br />
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </div>
        </form>-->
        <div class="clearfix margin_bottom5"></div>



        <!--<ul class="tabs">
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
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dpl->type == 'new'): ?>
                                <tr>
                                    <?php
                                    $prices = json_decode($dpl->pricing, true);
                                    $prices = (array) $prices;
                                    ?>

                                    <td>
                                        <b><?php echo e($dpl->tld); ?></b>
                                    </td>

                                    <?php for($i = 1; $i <= count($prices); $i++): ?> <?php if($i==1 || $i==2 || $i==3 || $i==5 || $i==10): ?> <td class="alicent">
                                        <span class="red">RM <?php echo e($prices[$i]['s']); ?>

                                            *</span>
                                        <br />
                                        <span class="strike">RM
                                            <?php echo e($prices[$i]['l']); ?>*</span>
                                        </td> <?php endif; ?>
                                        <?php endfor; ?>
                                        
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </li>

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
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dpl->type == 'renewal'): ?>
                                <tr>
                                    <?php
                                    $prices = json_decode($dpl->pricing, true);
                                    $prices = (array) $prices;
                                    ?>

                                    <td>
                                        <b><?php echo e($dpl->tld); ?></b>
                                    </td>

                                    <?php for($i = 1; $i <= count($prices); $i++): ?> <?php if($i==1 || $i==2 || $i==3 || $i==5 || $i==10): ?> <td class="alicent">
                                        <span class="red">RM <?php echo e($prices[$i]['s']); ?>

                                            *</span>
                                        <br />
                                        <span class="strike">RM
                                            <?php echo e($prices[$i]['l']); ?>*</span>
                                        </td> <?php endif; ?>
                                        <?php endfor; ?>
                                        <td>
                                            <a href="<?php echo e(url('/shopping_cart)')); ?>" class="btn-sm btn-danger caps">
                                                <i class="fa icon-basket-loaded"></i> <b>Buy</b>
                                            </a>
                                        </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </li>

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
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dpl->type == 'transfer'): ?>
                                <tr>
                                    <?php
                                    $prices = json_decode($dpl->pricing, true);
                                    $prices = (array) $prices;
                                    ?>

                                    <td>
                                        <b><?php echo e($dpl->tld); ?></b>
                                    </td>
                                    <?php for($i = 1; $i <= count($prices); $i++): ?> <?php if($i==1 || $i==2 || $i==3 || $i==5 || $i==10): ?> <td class="alicent">
                                        <span class="red">RM <?php echo e($prices[$i]['s']); ?>

                                            *</span>
                                        <br />
                                        <span class="strike">RM
                                            <?php echo e($prices[$i]['l']); ?>*</span>
                                        </td> <?php endif; ?>
                                        <?php endfor; ?>
                                        <td>
                                            <a href="<?php echo e(url('/shopping_cart')); ?>" class="btn-sm btn-danger caps">
                                                <i class="fa icon-basket-loaded"></i> <b>Buy</b>
                                            </a>
                                        </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </li>

            <?php $__currentLoopData = $domainPricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <div class="content__wrapper">
                    <h4>
                        <?php echo e($dp->title); ?> - New
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
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dpl->type == 'new' && $dpl->domain_pricing_id == $dp->id): ?>
                                <tr>
                                    <?php
                                    $prices = json_decode($dpl->pricing, true);
                                    $prices = (array) $prices;
                                    ?>

                                    <td>
                                        <b><?php echo e($dpl->tld); ?></b>
                                    </td>

                                    <?php for($i = 1; $i <= count($prices); $i++): ?> <?php if($i==1 || $i==2 || $i==3 || $i==5 || $i==10): ?> <td class="alicent">
                                        <span class="red">
                                            RM <?php echo e($prices[$i]['s']); ?> *
                                        </span>
                                        <br />
                                        <span class="strike">
                                            RM <?php echo e($prices[$i]['l']); ?> *
                                        </span>
                                        </td> <?php endif; ?>
                                        <?php endfor; ?>
                                        <td>
                                            <a href="<?php echo e(url('/shopping_cart')); ?>" class="btn-sm btn-danger caps">
                                                <i class="fa icon-basket-loaded"></i> <b>Buy</b>
                                            </a>
                                        </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </li>

            <li>
                <div class="content__wrapper">
                    <h4><?php echo e($dp->title); ?> - Renewals</h4>
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
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dpl->type == 'renewal' && $dpl->domain_pricing_id == $dp->id): ?>
                                <tr>
                                    <?php
                                    $prices = json_decode($dpl->pricing, true);
                                    $prices = (array) $prices;
                                    ?>

                                    <td><b><?php echo e($dpl->tld); ?></b></td>

                                    <?php for($i = 1; $i <= count($prices); $i++): ?> <?php if($i==1 || $i==2 || $i==3 || $i==5 || $i==10): ?> <td class="alicent">
                                        <span class="red">RM
                                            <?php echo e($prices[$i]['s']); ?> *</span>
                                        <br />
                                        <span class="strike">RM
                                            <?php echo e($prices[$i]['l']); ?>*</span>
                                        </td> <?php endif; ?>
                                        <?php endfor; ?>
                                        <td>
                                            <a href="<?php echo e(url('/shopping_cart')); ?>" class="btn-sm btn-danger caps">
                                                <i class="fa icon-basket-loaded"></i> <b>Buy</b>
                                            </a>
                                        </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </li>
            <li>
                <div class="content__wrapper">
                    <h4><?php echo e($dp->title); ?> - Transfers</h4>
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
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dpl->type == 'transfer' && $dpl->domain_pricing_id == $dp->id): ?>
                                <tr>
                                    <?php
                                    $prices = json_decode($dpl->pricing, true);
                                    $prices = (array) $prices;
                                    ?>

                                    <td><b><?php echo e($dpl->tld); ?></b></td>
                                    <?php for($i = 1; $i <= count($prices); $i++): ?> <?php if($i==1 || $i==2 || $i==3 || $i==5 || $i==10): ?> <td class="alicent">
                                        <span class="red">
                                            RM <?php echo e($prices[$i]['s']); ?> *
                                        </span>
                                        <br />
                                        <span class="strike">
                                            RM <?php echo e($prices[$i]['l']); ?>*
                                        </span>
                                        </td> <?php endif; ?>
                                        <?php endfor; ?>
                                        <td>
                                            <a href="<?php echo e(url('/shopping_cart')); ?>" class="btn-sm btn-danger caps">
                                                <i class="fa icon-basket-loaded"></i> <b>Buy</b>
                                            </a>
                                        </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>-->
        <div class="clearfix"></div>

        <!--<p class="alileft red">
            * Plus ICANN fee of RM0.82 per domain name year. Certain TLD's only.
            <br />
            ± com.au, net.au, and org.au domain names can only be registered for 2 years.
        </p>-->

    </div>
</div><!-- end feature section 11 -->
<div class="clearfix"></div>
<?php elseif(strpos($basePath, 'bulk_domain_transfer')): ?>
<div class="feature_section11">
    <div class="container">
        <!--<ul class="tabs">
            <li class="active">New Registrations</li>
            <li>Renewals</li>
            <li>Transfers</li>
        </ul>

        <ul class="tab__content">

            <li class="active">
                <div class="content__wrapper">

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <?php $__currentLoopData = $domain_pricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($i['listing'])): ?>
                            <thead>
                                <tr>
                                    <th class="alicent"><?php echo e($i['listing']['tld']); ?></th>
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
                                <?php $__currentLoopData = $RMSALE; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $domain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $index = $key;
                                $pricing = $i->bulk_pricing->where(
                                    'duration',
                                    $domain['duration']
                                )->first();
                                ?>
                                <tr>
                                    <td><?php echo e($domain['duration']); ?></td>
                                    <td class="alicent"><span class="red">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_1) ? $pricing->year_sale_1 : ''); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_1) ? $pricing->year_list_1 : ''); ?>

                                            *</span>
                                    </td>
                                    <td class="alicent"><span class="red">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_2) ? $pricing->year_sale_2 : ''); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_2) ? $pricing->year_list_2 : ''); ?>

                                            *</span>
                                    </td>
                                    <td class="alicent"><span class="red">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_3) ? $pricing->year_sale_3 : ''); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_3) ? $pricing->year_list_3 : ''); ?>

                                            *</span>
                                    </td>
                                    <td class="alicent"><span class="red">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_4) ? $pricing->year_sale_4 : ''); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_4) ? $pricing->year_list_4 : ''); ?>

                                            *</span>
                                    </td>
                                    <td class="alicent"><span class="red">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_5) ? $pricing->year_sale_5 : ''); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_5) ? $pricing->year_list_5 : ''); ?>

                                            *</span>
                                    </td>
                                    <td class="alicent"><span class="red">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_6) ? $pricing->year_sale_6 : ''); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_6) ? $pricing->year_list_6 : ''); ?>

                                            *</span>
                                    </td>
                                    <td class="alicent"><span class="red">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_7) ? $pricing->year_sale_7 : ''); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_7) ? $pricing->year_list_7 : ''); ?>

                                            *</span>
                                    </td>
                                    <td class="alicent"><span class="red">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_8) ? $pricing->year_sale_8 : ''); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_8) ? $pricing->year_list_8 : ''); ?>

                                            *</span>
                                    </td>
                                    <td class="alicent"><span class="red">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_9) ? $pricing->year_sale_9 : ''); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_9) ? $pricing->year_list_9 : ''); ?>

                                            *</span>
                                    </td>
                                    <td class="alicent"><span class="red">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_sale_10) ? $pricing->year_sale_10 : ''); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e(!empty($pricing) && !empty($pricing->year_list_10) ? $pricing->year_list_10 : ''); ?>

                                            *</span>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tfoot>
                                <tr>
                                    <td colspan="6"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>

                    </div>


                </div>
            </li>

            <li>
                <div class="content__wrapper">

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    

                    
                    
                    
                    
                    
                    
                    

                    

                </div>
            </li>

            <li>
                <div class="content__wrapper">

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    

                    
                    
                    
                    
                    
                    
                    

                    

                </div>
            </li>


        </ul>

        <p class="alileft red">* Terms &amp; conditions apply.</p>-->

    </div>
</div><!-- end feature section 11 -->
<div class="clearfix"></div>
<?php elseif(strpos($basePath, 'single_domain_transfer')): ?>
<div class="feature_section11">
    <div class="container">
        <!--<form type="POST" id="gsr-contact" onSubmit="return valid_datas( this );">
            <label class="text-16px dark"><b>Show the Domain Pricing for:</b></label>
            <div class="radiobut text-16px light dark">
                <input type="radio" id="all" checked="checked" name="tld"> <span class="onelb">All
                    TLD</span>&nbsp;
                <?php
                $counter = 0;
                ?>
                <?php $__currentLoopData = $domainPricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="radio" id="<?php echo e($dp->id); ?>" ccount="<?php echo e(($counter + 1) * 3); ?>" name="tld"> <span class="onelb"><?php echo e($dp->title); ?></span>&nbsp;
                <?php
                $counter++;
                ?>
                <?php if($counter % 6 == 0): ?>
                </br>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </div>
        </form>
        <div class="clearfix margin_bottom5"></div>



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
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dpl->type == 'new'): ?>
                                <tr>
                                    <?php
                                    $prices = json_decode($dpl->pricing, true);
                                    $prices = (array) $prices;
                                    ?>

                                    <td><b><?php echo e($dpl->tld); ?></b></td>
                                    <?php for($i = 1; $i <= count($prices); $i++): ?> <?php if($i==1 || $i==2 || $i==3 || $i==5 || $i==10): ?> <td class="alicent"><span class="red">RM <?php echo e($prices[$i]['s']); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e($prices[$i]['l']); ?>*</span>
                                        </td> <?php endif; ?>
                                        <?php endfor; ?>
                                        
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>

                    </div>
                </div>
            </li>

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
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dpl->type == 'renewal'): ?>
                                <tr>
                                    <?php
                                    $prices = json_decode($dpl->pricing, true);
                                    $prices = (array) $prices;
                                    ?>

                                    <td><b><?php echo e($dpl->tld); ?></b></td>
                                    <?php for($i = 1; $i <= count($prices); $i++): ?> <?php if($i==1 || $i==2 || $i==3 || $i==5 || $i==10): ?> <td class="alicent"><span class="red">RM <?php echo e($prices[$i]['s']); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e($prices[$i]['l']); ?>*</span>
                                        </td> <?php endif; ?>
                                        <?php endfor; ?>
                                        <td><a href="<?php echo e(url('/shopping_cart')); ?>" class="btn-sm btn-danger caps"><i class="fa icon-basket-loaded"></i> <b>Buy</b></a>
                                        </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </li>

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
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dpl->type == 'transfer'): ?>
                                <tr>
                                    <?php
                                    $prices = json_decode($dpl->pricing, true);
                                    $prices = (array) $prices;
                                    ?>

                                    <td><b><?php echo e($dpl->tld); ?></b></td>
                                    <?php for($i = 1; $i <= count($prices); $i++): ?> <?php if($i==1 || $i==2 || $i==3 || $i==5 || $i==10): ?> <td class="alicent"><span class="red">RM <?php echo e($prices[$i]['s']); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e($prices[$i]['l']); ?>*</span>
                                        </td> <?php endif; ?>
                                        <?php endfor; ?>
                                        <td><a href="<?php echo e(url('/shopping_cart')); ?>" class="btn-sm btn-danger caps"><i class="fa icon-basket-loaded"></i> <b>Buy</b></a>
                                        </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>

                    </div>
                </div>
            </li>

            <?php $__currentLoopData = $domainPricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <div class="content__wrapper">
                    <h4><?php echo e($dp->title); ?> - New</h4>
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
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dpl->type == 'new' && $dpl->domain_pricing_id == $dp->id): ?>
                                <tr>
                                    <?php
                                    $prices = json_decode($dpl->pricing, true);
                                    $prices = (array) $prices;
                                    ?>

                                    <td><b><?php echo e($dpl->tld); ?></b></td>
                                    <?php for($i = 1; $i <= count($prices); $i++): ?> <?php if($i==1 || $i==2 || $i==3 || $i==5 || $i==10): ?> <td class="alicent"><span class="red">RM <?php echo e($prices[$i]['s']); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e($prices[$i]['l']); ?>*</span>
                                        </td> <?php endif; ?>
                                        <?php endfor; ?>
                                        <td><a href="<?php echo e(url('/shopping_cart')); ?>" class="btn-sm btn-danger caps"><i class="fa icon-basket-loaded"></i>
                                                <b>Buy</b></a>
                                        </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>

                    </div>
                </div>
            </li>
            <li>
                <div class="content__wrapper">
                    <h4><?php echo e($dp->title); ?> - Renewals</h4>
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
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dpl->type == 'renewal' && $dpl->domain_pricing_id == $dp->id): ?>
                                <tr>
                                    <?php
                                    $prices = json_decode($dpl->pricing, true);
                                    $prices = (array) $prices;
                                    ?>

                                    <td><b><?php echo e($dpl->tld); ?></b></td>
                                    <?php for($i = 1; $i <= count($prices); $i++): ?> <?php if($i==1 || $i==2 || $i==3 || $i==5 || $i==10): ?> <td class="alicent"><span class="red">RM <?php echo e($prices[$i]['s']); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e($prices[$i]['l']); ?>*</span>
                                        </td> <?php endif; ?>
                                        <?php endfor; ?>
                                        <td><a href="<?php echo e(url('/shopping_cart')); ?>" class="btn-sm btn-danger caps"><i class="fa icon-basket-loaded"></i>
                                                <b>Buy</b></a>
                                        </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>

                    </div>
                </div>
            </li>
            <li>
                <div class="content__wrapper">
                    <h4><?php echo e($dp->title); ?> - Transfers</h4>
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
                                <?php $__currentLoopData = $domainPricingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($dpl->type == 'transfer' && $dpl->domain_pricing_id == $dp->id): ?>
                                <tr>
                                    <?php
                                    $prices = json_decode($dpl->pricing, true);
                                    $prices = (array) $prices;
                                    ?>

                                    <td><b><?php echo e($dpl->tld); ?></b></td>
                                    <?php for($i = 1; $i <= count($prices); $i++): ?> <?php if($i==1 || $i==2 || $i==3 || $i==5 || $i==10): ?> <td class="alicent"><span class="red">RM <?php echo e($prices[$i]['s']); ?>

                                            *</span><br />
                                        <span class="strike">RM
                                            <?php echo e($prices[$i]['l']); ?>*</span>
                                        </td> <?php endif; ?>
                                        <?php endfor; ?>
                                        <td><a href="<?php echo e(url('shopping_cart')); ?>" class="btn-sm btn-danger caps"><i class="fa icon-basket-loaded"></i>
                                                <b>Buy</b></a>
                                        </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="clearfix"></div>

                    </div>
                </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <div class="clearfix"></div>

        <p class="alileft red">* Plus ICANN fee of RM0.82 per domain name year. Certain TLD's only.<br />
            ± com.au, net.au, and org.au domain names can only be registered for 2 years.</p>-->

    </div>
</div><!-- end feature section 11 -->
<div class="clearfix"></div>
<?php endif; ?>

<?php if($page_slug != 'co_cloud_hosting' && $page_slug != 'shared_hosting' && $duplicate_from != 'co_cloud_hosting' && $duplicate_from != 'shared_hosting'): ?>
<div class="feature_section103">
    <div class="container">
        <?php if(count($general_features) > 0): ?>
        <h1 class="caps white">
            <strong><?php echo e($general_features[0]['heading'] or ''); ?> </strong>
        </h1>
        <?php endif; ?>

        <div class="clearfix margin_bottom2"></div>

        <?php if(count($general_features) > 0): ?>
        <?php
        $count = 0;
        ?>

        <?php $__currentLoopData = $general_features->where('ssl_page', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $count++;
        ?>
        <div class="box four  last animate" data-anim-type="fadeIn" data-anim-delay="300">
            <?php if($i->icon_image == ''): ?>
            <i class="fa <?php echo e($i->icon); ?>"></i>
            <?php else: ?>
            <img src="<?php echo e(asset('/storage/general_features/icon_images/' . $i->icon_image)); ?>" style="display: block; " />
            <?php endif; ?>
            <h4><?php echo e($i->title); ?>

                <div class="line"></div>
            </h4>
            <p class="sky-blue"><?php echo e($i->description); ?>.</p>
        </div><!-- end box -->
        <?php if($count % 4 == 0): ?>
        <div class="clearfix margin_bottom2"></div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>

<!-- MasterSlider -->
<link rel="stylesheet" href="<?php echo e(asset('resources/assets/frontend/js/masterslider/style/masterslider.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('resources/assets/frontend/js/masterslider/skins/default/style.css')); ?>" />

<link rel="stylesheet" href="<?php echo e(asset('resources/assets/frontend/js/carouselowl/owl.transitions.css')); ?>" />
<!-- owl carousel -->
<link rel="stylesheet" href="<?php echo e(asset('resources/assets/frontend/js/carouselowl/owl.carousel.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('resources/assets/frontend/js/accordion/style.css')); ?>" />

<link rel="stylesheet" href="<?php echo e(asset('resources/assets/frontend/js/tabs2/tabacc.css')); ?>" />

<link rel="stylesheet" href="<?php echo e(asset('resources/assets/frontend/js/tabs2/detached.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('resources/assets/frontend/js/loopslider/style.css')); ?>" />
<!-- accordion -->
<!-- tabs 2 -->
<!-- loop slider -->

<?php if(strpos($basePath, 'single_domain_transfer') !== false and !empty($response) and $response->status_code !== 0 and $response->status_code !== 1 and $response->status_code !== 5): ?>
<script>
    $(function() {
        $('#myModal').modal('show');
    });
</script>
<?php endif; ?>

<?php if(strpos($basePath, 'bulk_domain_transfer') !== false and !empty($response)): ?>

<?php $__currentLoopData = $response; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $singleDomain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($singleDomain->status_code !== 0 and $singleDomain->status_code !== 1 and $singleDomain->status_code !== 5): ?>
<?php if(Session::has('failed')): ?>
<script>
    $(function() {
        $('#myModal').modal('show');
    });
</script>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

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

<?php if(!empty($response) || !empty($search_domain) || !empty($bulkDomains)): ?>
<script>
    $(function() {
        $('html, body').animate({
            scrollTop: $(".scroll-focus-marker").offset().top - 88
        }, 1000);
    });
</script>
<?php endif; ?>

<?php if(!empty($bulkDomains)): ?>
<!-- <script>
            $(function() {
              $('html, body').animate({
                scrollTop: $(".scrollToThis").offset().top - 88
              }, 2000);
            });
          </script> -->
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.frontend_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\web88\resources\views/frontend/services.blade.php ENDPATH**/ ?>