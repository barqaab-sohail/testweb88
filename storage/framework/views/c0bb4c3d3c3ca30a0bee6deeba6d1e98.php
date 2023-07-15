
<div id="modal-enquire" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="false" class="modal fade in newmodel out-pop-dv" style="display: none;">
<div class="">
    <div class="modal-dialog modal-lg" >
      <div class=" modal-content">

        <div class="modal-header">
              <!--<button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>-->
          <h4 id="modal-login-label3" class="modal-title text-left" style="text-align: left;">Enquire Now / Request Free Quote</h4>
        </div>
    
    <div class="cforms alileft modal-body" >
 
        <div id="form_status"></div>
        <div data-dismiss="modal" aria-hidden="true" style="right: -1px;top: -57px;" class="plainmodal-close cancel-quote" onclick="hideModel()"></div>
            <form id="frmContact" class="form-horizontal" role="form" method="POST" action="<?php echo e(route('contactEnquiry')); ?>" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>  
            <div class="one_half">
            
                <label class="text-info" style="color: #31708f; font-weight: 700">Your Name <em>*</em></label>
                <label class="input">
                    <input type="text" autocomplete="off" name="name" id="name" required placeholder="Enter name">
                </label>
                <?php if($errors->has('name')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('name')); ?></strong>
                    </span>
                <?php endif; ?>
                <div class="clearfix"></div>
                
                <label class="text-info" style="color: #31708f; font-weight: 700">Your Email <em>*</em></label>
                <label class="input">
                    <input type="email" autocomplete="off" name="email" id="email" required placeholder="Enter Email">
                </label>
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                <?php endif; ?>
                <div class="clearfix"></div>
                
                <label class="text-info" style="color: #31708f; font-weight: 700"> I would like to know more about <em>*</em></label>
                <label class="input">
                    <select name="service" autocomplete="off" id="service" required data-error-container="#service-error"> 
                        <option>-- Please select --</option>
                        <option value="dedicated servers"></option>>Dedicated Servers</option>
                        <option value="domains">Domains</option>
                        <option value="e-commerce package">E-commerce Package</option>
                        <option value="online marketing">Online Marketing</option>
                        <option value="reseller hosting">Reseller Hosting</option>
                        <option value="responsive web design">Responsive Web Design</option>
                        <option value="social media application">Social Media Application</option>
                        <option value="ssl certificates">SSL Certificates</option>
                        <option value="vps hosting">VPS Hosting</option>
                        <option value="web hosting">Web Hosting</option>
                        <option value="web88 cms">Web88 CMS</option>
                        <option value="others">Others</option>
                    </select>
                    <?php if($errors->has('service')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('service')); ?></strong>
                        </span>
                    <?php endif; ?>
                </label>
                <span id="service-error"></span>
            </div>
            
            <div class="one_half">
                <label class="text-info" style="color: #31708f; font-weight: 700">Company Name <em>*</em></label>
                <label class="input">
                    <input type="text" autocomplete="off" name="company" required id="company" placeholder="Enter company">
                </label>
                <?php if($errors->has('company')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('company')); ?></strong>
                    </span>
                <?php endif; ?>
                <div class="clearfix"></div>
                
                <label class="text-info" style="color: #31708f; font-weight: 700">Contact Number <em>*</em></label>
                <label class="input">
                    <input type="text" autocomplete="off" name="phone" id="phone" required placeholder="Enter contact number">
                </label>
                <?php if($errors->has('phone')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('phone')); ?></strong>
                    </span>
                <?php endif; ?>
                <div class="clearfix"></div>
            
            </div>
            
            <div class="one_half">
            <label class="text-info" style="color: #31708f; font-weight: 700">Website <em>*</em></label>
            <label class="input">
                <input type="text" autocomplete="off" required name="website" id="website" placeholder="Enter website">
            </label>
            <?php if($errors->has('website')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('website')); ?></strong>
                </span>
            <?php endif; ?>
            <div class="clearfix"></div>
            
            </div>
    
            <label class="text-info" style="color: #31708f; font-weight: 700">Message <em>*</em></label>
            <label class="textarea">
                <textarea rows="3" name="message" autocomplete="off" required id="message" style="width:98%" placeholder="Enter the message"></textarea>
            </label>
            <?php if($errors->has('name')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('name')); ?></strong>
                </span>
            <?php endif; ?>
            <div class="clearfix"></div>

            <hr style="margin-top: 20px;margin-bottom: 20px;border: 0;border-top: 1px solid #eee;">
            <div class="text-center" style="text-align: center;">

            <input type="hidden" name="redirect" value="dedicated_server">
             <p class="text-info">Please enter the security code below to proceed:</p>
            <div class="g-recaptcha" required data-sitekey="6LfiDxATAAAAALssDu-lX0bE7a6pOOwqWPxUojxX" style="display: inline-block;"></div>
            <div id='html_element'></div>
			<span style="display:none;" class="help-block cat-req">
				<strong>Captcha is required!</strong>
			</span>    
            <!-- <p class="text-info">Please enter the security code below to proceed:</p>
            <div class="g-recaptcha" data-sitekey="6LdeJzMUAAAAAMtiJvlosO6ck2ZdwGIK-kL3Jwl1" >
                <div style="width: 304px; height: 78px;"><div>
                    <iframe src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LdeJzMUAAAAAMtiJvlosO6ck2ZdwGIK-kL3Jwl1&amp;co=aHR0cDovL2UtbWFpbDg4LmNvbTo4MA..&amp;hl=en&amp;v=v1565591531251&amp;size=normal&amp;cb=r9mqbumpxw4o" width="304" height="78" role="presentation" name="a-vt1kfpfbwm1p" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe>
                </div>
                <textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea></div>
            </div>  -->    
    
            <input type="hidden" name="token"  value="Send" />
            <hr style="margin-top: 20px;margin-bottom: 20px;border: 0;border-top: 1px solid #eee;">

            <button type="submit" style="margin-right: 10px !important;"  class="btn btn-danger submit-quote"><i class="fa fa-send"></i> <b>Submit</b></button>
            <button type="button" onclick="hideModel()" class="btn btn-primary cancel-quote"><i class="fa fa-ban"></i> <b>Cancel</b></button>
            
                            
            </div>
        </form> 
       
        </div>
   
		</div>
    </div>
</div>






<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script type="text/javascript">
  var onloadCallback = function() {
    grecaptcha.render('html_element', {
      'sitekey' : 'your_site_key',
      'callback' : correctCaptcha
    });
  };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
<script type="text/javascript">
	
	$('#frmContact').submit(function() {

        /*var resp = grecaptcha.getResponse();
        alert(resp);*/
		if (grecaptcha.getResponse() == ""){
			$('.cat-req').show();
			return false;
		} 

	});
	//~ function submitForm(){
		//~ if (grecaptcha.getResponse() == ""){
			//~ alert("You can't proceed!");
		//~ } else {
			//~ alert("Thank you");
		//~ }
	//~ }
	
	function showModel(){
		$('.newmodel').slideDown(333);
	}
	function hideModel(){
		$('.newmodel').hide();
	}
</script>
<?php /**PATH D:\xampp\htdocs\web88\resources\views/frontend/_ask_quota.blade.php ENDPATH**/ ?>