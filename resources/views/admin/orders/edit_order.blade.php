<h5 class="block-heading">Services</h5>
<form class="form-horizontal">
    <div class="form-group">
    <label class="col-md-3 control-label">Service Plan / Service Code <span class="text-red">*</span></label>
    <div class="col-md-6">
        <select class="form-control">
            <option>- Please select -</option>
            <option>Custom Plan/Package</option>
            <option>===========================================================</option>
            <option>---- Cloud Hosting ----</option>
            <option>S Cloud: SCL-1</option>
            <option>M Cloud: MCL-1</option>
            <option>L Cloud: LCL-1</option>
            <option>===========================================================</option>
            <option>---- Co-location Hosting ----</option>
            <option>2U: CO2U-1</option>
            <option>5U: CO5U-1</option>
            <option>10U: CO10U-1</option>
            <option>===========================================================</option>
            <option>---- Dedicated Server ----</option>
            <option>Enterprise 1: DS1x4-4-2x1TB</option>
            <option>Enterprise 2: DS2x6-8-2x1TB</option>
            <option>Enterprise 3: DS2x6-8-2x1TB</option>
            <option>===========================================================</option>
            <option>---- Domains ----</option>
            <option selected="selected">Register a New Domain: DN </option>
            <option>Renew a Domain: DN </option>
            <option>Transfer in a Domain: DN </option>
            <option>Bulk Registration: DN </option>
            <option>Bulk Renewal: DN </option>
            <option>Bulk Transfer: DN </option>
            <option>===========================================================</option>
            <option>---- E-commerce ----</option>
            <option>200: EC-200-1</option>
            <option>20,000: EC-20k-1</option>
            <option>Unlimited: EC-U-1</option>
            <option>===========================================================</option>
            <option>---- Email88 ----</option>
            <option>Booster I: E88B1-10k-1</option>
            <option>Booster II: E88B2-15k-1</option>
            <option>Booster III: E88B3-20k-1</option>
            <option>===========================================================</option>
            <option>---- Shared Hosting ----</option>
            <option>Small: SHSM-1</option>
            <option>Medium: SHME-1</option>
            <option>Large: SHBI-1</option>
            <option>===========================================================</option>
            <option>---- SSL Certificates ----</option>
            <option>Secure a Single Common Name: EV-DC1</option>
            <option>Secure Multiple Domains: UC-DC1</option>
            <option>SP-DC1: UC-DC1</option>
            <option>===========================================================</option>
            <option>---- VPS Hosting ----</option>
            <option>Linux Basic: VPS58-2-1</option>
            <option>Linux Gold: VPS78-3-1</option>
            <option>VPS28-1-1: VPS78-3-1</option>
            <option>===========================================================</option>
            <option>---- Web88IR ----</option>
            <option>Dynamic I: IRH1-1</option>
            <option>Dynamic I: IRD2-1</option>
            <option>Dynamic II: IRD2-1</option>
            <option>===========================================================</option>
            <option>---- Responsive Web Design ----</option>
            <option>Responsive Web Design</option>
            <option>===========================================================</option>
            <option>---- Social Media ----</option>
            <option>Social Media</option>
            <option>===========================================================</option>
            <option>List all services here</option>
        </select>
        <div class="xs-margin"></div>
        <div class="text-blue text-12px">Please select a <b>"Service Plan"</b> &amp; <b>"Service Code"</b> to continue,  eg. for VPS Hosting, <b>Service Plan = "Linux Basic"</b>, <b>Service Code = "VPS58-2-1"</b>.</div>
        note to programmer: some of the services does not have a service code, if service plan doesn't have a service code, please leave it blank after the plan name in the above dropdown list.
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Custom Plan/Package Name</label>
    <div class="col-md-6">
        <input type="text" class="form-control">
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Unit Price (RM)</label>
    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="0.00" value="">
        <div class="xs-margin"></div>
        <div class="text-blue text-12px">The unit price is for all other packages execpt domain. For single/bulk domain prices, please specify the prices in below <b>"Domain Configuration"</b> section.</div>
        note to programmer: auto-fill in the price above after selected a plan. the price will be varied from the selection of the plan above.
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Global Discount Name </label>
    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="eg. Sample 2" value="Sample 2">
        note to programmer: "discount name" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Global Discount Rate </label>
    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="Amount" value="15">
        <div class="xs-margin"></div>
        <select name="select" class="form-control">
            <option value="%" selected="selected">%</option>
            <option value="RM">RM</option>
        </select>
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Promo Code </label>
    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="eg. Test123">
        note to programmer: "promo code" and "discount rate" are auto-filled in this section if the selected services in above service dropdown list has applied to the global discount.
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Discount Rate (Promo Code) </label>
    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="Amount">
        <div class="xs-margin"></div>
        <select name="select" class="form-control">
            <option value="%">%</option>
            <option value="RM">RM</option>
        </select>
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">SSL Price (RM) </label>
    <div class="col-md-6">
        <select class="form-control">
            <option>- Please select -</option>
            <option value="1 year">1 year(s) @ RM239.99/yr</option>
            <option value="2 years">2 year(s) @ RM 219.99/yr</option>
            <option value="3 years">3 year(s) @ RM 199.99/yr</option>
        </select>
        <div class="xs-margin"></div>
        note to programmer: the ssl price dropdown list is dynamic and fectched from the ssl services setup depending on the ssl plan selected above.
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Quantity <span class="text-red">*</span></label>
    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="1" value="1">
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Cycle <span class="text-red">*</span></label>
    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="eg. 1 year(s)" value="2 Year(s)">
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Setup Fee (RM) </label>
    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="0.00">
        <div class="xs-margin"></div>
        <div class="text-blue text-12px">If "Setup Fee" is set to <b>RM 0.00</b>, it is <b>"FREE Setup"</b>.</div>
    </div>
    </div>
    <!-- domain configuration start -->
    <h5 class="block-heading">Domain Configuration</h5>
    <div class="form-group">
    <label for="inputFirstName" class="col-md-3 control-label">Domain Name <span class="text-red">*</span></label>
    <div class="col-md-6">
        <div class="radio-list">
            <label>
                <input type="radio"> Use existing domain, please enter your domain below:
                <div class="xs-margin"></div>
                <input type="text" class="form-control" placeholder="eg. webqom.net">
            </label>
            <label>
                <input type="radio" checked="checked"> Register a new domain, please enter your domain below:
                <div class="xs-margin"></div>
                <input type="text" class="form-control" placeholder="eg. webqom.net"value="webqom.net">
            </label>
            <label>
                <input type="radio"> Please specify your domain below (for single domain):
                <div class="xs-margin"></div>
                <input type="text" class="form-control" placeholder="eg. webqom.net">
            </label>
            <label>
                <input type="radio"> Please specify your domains below (for bulk domains):
                <div class="xs-margin"></div>
                <textarea class="form-control" rows="10">Each name must be on a separate line.

Examples:
yourdomain.com
yourdomain.net
                    </textarea>
            </label>
        </div>
    </div>
    </div>
    note to programmer: the domain price from 1 year to 10 years is dynamic and fectched from the domain pricing and maybe varied from different TLDs. Same as bulk domain pricing.
    <h6 class="block-heading">Single Domain Pricing (RM)</h6>
    <div class="text-blue text-12px">You can specify single domain price in below table for <b>"New Domain Registration"</b>, <b>"Domain Renewal"</b> or <b>"Transfer in a Domain"</b>. If "Domain Price" is set to <b>RM 0.00</b>, it is <b>"FREE Domain"</b>. </div>
    <div class="xs-margin"></div>
    <div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <th>1 Year(s)</th>
            <th>2 Year(s)</th>
            <th>3 Year(s)</th>
            <th>5 Year(s)</th>
            <th>10 Year(s)</th>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00" value="69.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5"></td>
            </tr>
        </tfoot>
    </table>
    </div>
    <!-- end table responsive -->
    <h6 class="block-heading">Bulk Domain Pricing (RM)</h6>
    <div class="text-blue text-12px">You can specify bulk domain price in below table for <b>"Bulk Registration"</b>, <b>"Bulk Renewal"</b> or <b>"Bulk Transfer"</b>.</div>
    <div class="xs-margin"></div>
    <div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <th>Domains</th>
            <th>1 Year(s)</th>
            <th>2 Year(s)</th>
            <th>3 Year(s)</th>
            <th>5 Year(s)</th>
            <th>10 Year(s)</th>
        </thead>
        <tbody>
            <tr>
                <td>1-5</td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
            </tr>
            <tr>
                <td>6-20</td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
            </tr>
            <tr>
                <td>21-49</td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
            </tr>
            <tr>
                <td>50-100</td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
            </tr>
            <tr>
                <td>101-200</td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
            </tr>
            <tr>
                <td>201-500</td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
                <td><input type="text" class="form-control" placeholder="0.00"></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6"></td>
            </tr>
        </tfoot>
    </table>
    </div>
    <!-- end table responsive -->
    <div class="form-group">
    <label class="col-md-3 control-label">Discount </label>
    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="Amount">
        <div class="xs-margin"></div>
        <select name="select" class="form-control">
            <option value="%">%</option>
            <option value="RM">RM</option>
        </select>
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Domain Addons </label>
    <div class="col-md-6">
        <div class="checkbox-list margin-top-10px">
            <label><input type="checkbox" checked="checked"/>&nbsp; DNS Management (@ RM 102.50/yr)</label>
            <label><input type="checkbox" checked="checked"/>&nbsp; Email Forwarding (@ RM 102.50/yr)</label>
            <label><input type="checkbox" checked="checked"/>&nbsp; ID Protection (@ RM 102.50/yr)</label>
            note to programmer: domain addons list and price is fetched from the domain setup.
        </div>
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Notes </label>
    <div class="col-md-6">
        <textarea rows="3" class="form-control"></textarea>
    </div>
    </div>
    <!-- end domain configuration -->
    <div class="form-actions">
    <div class="col-md-offset-5 col-md-8"> <a href="#" class="btn btn-red">Save &nbsp;<i class="fa fa-floppy-o"></i></a>&nbsp; <a href="#" data-dismiss="modal" class="btn btn-green">Cancel &nbsp;<i class="glyphicon glyphicon-ban-circle"></i></a> </div>
    </div>
</form>