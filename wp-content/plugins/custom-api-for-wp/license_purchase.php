<?php

function emit_css() {
        ?>
        <style>
            .mo-oauth-licensing-container {
                margin: 0 auto;
                padding: 10px;
            }
            .mo-oauth-licensing-header {
                /* text-align: center; */
            }
            .moct-align-left {
                text-align: left;
            }
            .moct-align-right {
                text-align: right;
            }
            .moct-align-center {
                text-align: center;
            }
            .moc-licensing-notice {
                width: 90%;
                margin-top: 5%;
            }
            .moc-licensing-plan-header {
                font-size: 32px;
                font-variant: small-caps;
                border-radius: 1rem 1rem 0px 0px;
            }
            .moc-licensing-plan-header hr {
                margin: 1.5rem 0;
            }
            .moc-licensing-plan-feature-list {
                font-size: 12px;
                padding-top: 10px;
            }
            .moc-licensing-plan-feature-list li {
                text-align: left;
                padding: 10px;
                border: none;
            }
            .moc-licensing-plan-feature-list li:nth-child(even) {
                background-color: #f0f0f0;
            }
            .moc-licensing-plan-usp {
                font-size: 18px;
                font-weight: 500;
                padding-bottom: 10px;
            }
            .moc-licensing-plan-price {
                font-size: 24px;
                font-weight: 400;
            }
            .moc-licensing-plan-name {
                font-size: 32px;
                font-weight: 500;
            }
            .moc-licensing-plan {
                border-radius: 1rem;
                border: 1px solid #00788E;
                margin: 0.5rem 0;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.4);
                transition: 0.3s;
            }
            .moc-licensing-plan:hover {
                margin-top: -.25rem;
                margin-bottom: .25rem;
                /* border: 1px solid #17a2b8; */
                border: 1px solid rgb(112, 165, 245);
                box-shadow: 0 16px 32px 0 rgba(112, 165, 245, 0.8);
            }
            .moc-lp-buy-btn {
                border-radius: 5rem;
                letter-spacing: .1rem;
                font-weight: bold;
                padding: 1rem;
                opacity: 0.7;
            }
            .moc-lp-buy-btn:hover {
                opacity: 1;
            }
            .moc-lp-highlight {
                box-shadow: 0 16px 32px 0 #563d7c66;
                border: 1px solid #2B1251;
            }
            .moc-lp-highlight:hover {
                border: 1px solid #563d7c;
                box-shadow: 0 16px 32px 0 #563d7ccc;
            }
            .btn-purple {
                color: #ffffff;
                background: radial-gradient(circle, #563d7c, #452c6b);
                border-color: #563d7c;
            }
            .btn-purple:hover {
                background: radial-gradient(circle, #452c6b, #563d7c);
            }
            .moc-licensing-plan-select{
                margin-top: 10px;
                margin-bottom: 20px;
                width: 100%;
                height: 40px;
                font-size: 16px !important;
                border-radius: 5px !important;
                text-align: center;
                text-align-last: center;
            }
            .moc-licensing-plan-select option{
                text-align: center;
            }
        </style>
        <?php
    }
     function custom_api_authentication_licensing_page(){
        
        emit_css();
        ?>
        <!-- Important JSForms -->
        <input type="hidden" value="<?php echo custom_api_authentication_is_customer_registered();?>" id="mo_customer_registered">
        <form style="display:none;" id="loginform"
              action="<?php  echo get_option( 'host_name' ) . '/moas/login'; ?>"
              target="_blank" method="post">
            <input type="email" name="username" value="<?php echo get_option( 'custom_api_authentication_admin_email' ); ?>"/>
            <input type="text" name="redirectUrl"
                   value="<?php echo get_option( 'host_name' ) . '/moas/initializepayment'; ?>"/>
            <input type="text" name="requestOrigin" id="requestOrigin"/>
        </form>
        <form style="display:none;" id="viewlicensekeys"
              action="<?php echo get_option( 'host_name' ) . '/moas/login'; ?>"
              target="_blank" method="post">
            <input type="email" name="username" value="<?php echo get_option( 'custom_api_authentication_admin_email' ); ?>"/>
            <input type="text" name="redirectUrl"
                   value="<?php echo get_option( 'host_name' ) . '/moas/viewlicensekeys'; ?>"/>
        </form>
        <!-- End Important JSForms -->
        <!-- Licensing Table -->
        <div class="mo-oauth-licensing-container" style="background-color: white; border:.1rem solid #bfc4c8;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-style:solid;">
            <div class="mo-oauth-licensing-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 moct-align-right">
                            &nbsp;
                        </div>
                        <div class="col-6 moct-align-right">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row justify-content-center mx-15">
                    <div class="col-2 moct-align-center">
                            
                            </div>
                        <!-- Licensing Plans -->
                        <!-- free Plan -->
                        <!-- <div class="container-customize"> -->
                        <div class="row">

                        <div class="col-4 moct-align-center">
                        <div class="moc-licensing-plan card-body">

                                <!-- Plan Header -->
                                <div class="moc-licensing-plan-header">
                                    <div class="moc-licensing-plan-name">Standard</div>
                                    <div class="moc-licensing-plan-price">free<sup>*</sup></div>
                                    <div class="moc-licensing-plan-usp">( Single HTTP  <br>{GET} Method )</div>
                                </div>
                                <br>
                                <br>
                                
                                <button class="btn btn-block btn-info text-uppercase moc-lp-buy-btn">Current Plan</button>

                                <!-- Plan Header End -->
                                <!-- Plan Feature List -->
                                <div class="moc-licensing-plan-feature-list">
                                    <ul>
                                        <li>&#9989;&emsp;Unlimited Custom API's(endpoints) can be made</li>
                                        <!-- <li>&#9989;&emsp;Fetch </li> -->
                                        <li>&#9989;&emsp;Fetch any type of data<br> 1. User Roles and Capabilities<br> 2. WP users and metadata <br>3. Featured Images <br> 4. Custom data,posts,pages,etc.</li>
                                        <li>&#9989;&emsp;Fetch operation available with single WHERE condition </li>
                                        <li>&#10060;&emsp;<span class="text-muted">Support for GET, POST, PUT & DELETE methods</span></li>
                                        <li>&#10060;&emsp;<span class="text-muted">Filters included</span> </li>
                                        <li>&#10060;&emsp;<span class="text-muted">All CRUD opertations supported</span></li>
                                        <li>&#10060;&emsp;<span class="text-muted">Restrict Public Access to WP REST APIs</span></li>
                                        <li>&#10060;&emsp;<span class="text-muted">API key authentication method to protect APIs</span></li>
                                        <li>&#10060;&emsp;<span class="text-muted">Support for External APIs Connection</span></li>

                                        
                                        <!-- <li>&#10060;&emsp;<span class="text-muted">API Authentication for Third Party Provider</span></li> -->
                                        <!-- <li>&#10060;&emsp;<span class="text-muted">Supports WooCommerce, BuddyPress API Authentication</span></li> -->
                                        <!--                                        <li>&#10060;&emsp;<span class="text-muted">WP hooks to read token, login event and extend plugin functionality</span></li>-->
                                        <!--                                        <li>&#10060;&emsp;<span class="text-muted">End User Login Reports / Analytics</span></li>-->
                                    </ul>
                                </div>
                                <!-- Plan Feature List End -->
                            </div>
                        </div>
                        <!-- Standard Plan End -->
                        <!-- Premium Plan -->
                        
                        <div class="col-4 moct-align-center">
                            <div class="moc-licensing-plan card-body">
                                <!-- Plan Header -->
                                <div class="moc-licensing-plan-header">
                                    <div class="moc-licensing-plan-name">premium</div>
                                    <div class="moc-licensing-plan-price"><sup>$</sup>149<sup>*</sup></div>
                                    <div class="moc-licensing-plan-usp">( Multiple HTTP <br>Methods )</div>
                                </div>
                                <br>
                                <br>
                                
                                <button class="btn btn-block btn-info text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_rest_custom_api_for_wp_premium_plan')">Buy Now</button>

                                <!-- Plan Header End -->
                                <!-- Plan Feature List -->
                                <div class="moc-licensing-plan-feature-list">
                                    <ul>
                                        <li>&#9989;&emsp;Unlimited Custom API's(endpoints) can be made</li>
                                        <!-- <li>&#9989;&emsp;Fetch </li> -->
                                        <li>&#9989;&emsp;Fetch any type of data<br> 1. User Roles and Capabilities<br> 2. WP users and metadata <br>3. Featured Images <br> 4. Custom data,posts,pages,etc.<br>5. Custom JSON content/JSON file, HTML content </li>
                                        <li>&#9989;&emsp;Fetch operation available multiple custom conditions</li>
                                        <li>&#9989;&emsp;Support for Custom Namespace</li>
                                        <li>&#9989;&emsp;Support for GET, POST, PUT & DELETE methods</li>
                                        <li>&#9989;&emsp;Filters included </li>
                                        <li>&#9989;&emsp;All CRUD opertations supported</li>
                                        <li>&#9989;&emsp;Restrict Public Access to WP REST APIs</li>
                                        <li>&#9989;&emsp;API key authentication method to protect APIs</li>    
                                        <li>&#10060;&emsp;<span class="text-muted">Support for External APIs Connection</span></li>

                                        
                                       
                                        <!-- <li>&#10060;&emsp;<span class="text-muted">API Authentication for Third Party Provider</span></li> -->
                                        <!-- <li>&#10060;&emsp;<span class="text-muted">Supports WooCommerce, BuddyPress API Authentication</span></li> -->
                                        <!--                                        <li>&#10060;&emsp;<span class="text-muted">WP hooks to read token, login event and extend plugin functionality</span></li>-->
                                        <!--                                        <li>&#10060;&emsp;<span class="text-muted">End User Login Reports / Analytics</span></li>-->
                                    </ul>
                                </div>
                                <!-- Plan Feature List End -->
                            </div>
                        </div>

                        <!-- <h>start****</h> -->
                        <div class="col-4 moct-align-center">
                        <div class="moc-licensing-plan card-body">
                                <!-- Plan Header -->
                                <div class="moc-licensing-plan-header">
                                    <div class="moc-licensing-plan-name">Enterprise</div>
                                    <div class="moc-licensing-plan-price"><sup>$</sup>249<sup>*</sup></div>
                                    <div class="moc-licensing-plan-usp">( Multiple HTTP <br>Methods )</div>
                                </div>
                                <br>
                                <br>
                                
                                <button class="btn btn-block btn-info text-uppercase moc-lp-buy-btn" onclick="upgradeform2()">Contact Us</button>

                                <!-- Plan Header End -->
                                <!-- Plan Feature List -->


                                <div class="moc-licensing-plan-feature-list">
                                    <ul>
                                        <li>&#9989;&emsp;Unlimited Custom API's(endpoints) can be made</li>
                                        <!-- <li>&#9989;&emsp;Fetch </li> -->
                                        <li>&#9989;&emsp;All Features of Premium Plugin</li>
                                        <li>&#9989;&emsp;Create Custom API endpoints with custom SQL Query</li>
                                        <li>&#9989;&emsp;<span class="text-muted">Support for Unlimited External APIs Connection </li>
                                        <li>&#9989;&emsp;<span class="text-muted"> External API integration to fetch data in the WordPress, update data on External API provider side.</span></li>
                                        <li>&#9989;&emsp;<span class="text-muted">Support for Dynamic header in API Request </span> </li>

                                        <li>&#9989;&emsp;<span class="text-muted">Support for GET, POST, PUT & DELETE methods</span></li>
                                        <li>&#9989;&emsp;<span class="text-muted">Dynamic WordPress hooks for each External API Connection to perform operations on external data</span></li>
                                        <li>&#9989;&emsp;<span class="text-muted">Integration on any WordPress event or any third-party plugin event/action.</span></li>
                                        <li>&#9989;&emsp;<span class="text-muted">Compatibility with third-party plugin’s payment gateways</span></li>
                                        
                                        
                                        <!-- <li>&#10060;&emsp;<span class="text-muted">API Authentication for Third Party Provider</span></li> -->
                                        <!-- <li>&#10060;&emsp;<span class="text-muted">Supports WooCommerce, BuddyPress API Authentication</span></li> -->
                                        <!--                                        <li>&#10060;&emsp;<span class="text-muted">WP hooks to read token, login event and extend plugin functionality</span></li>-->
                                        <!--                                        <li>&#10060;&emsp;<span class="text-muted">End User Login Reports / Analytics</span></li>-->
                                    </ul>
                                </div>
                                <!-- Plan Feature List End -->
                            </div>
                        </div>
                    </div>

                         <!-- <h>enddd*******</h> -->


                        <!-- Premium Plan End -->
                        <!-- Enterprise Plan -->
                        <div class="col-2 moct-align-center">
                            
                        </div>
                        <!-- Enterprise Plan End -->
                        <!-- Licensing Plans End -->
                        <div class="moc-licensing-notice">
                            <span style="color: red;">*</span>Cost applicable for one instance only. Licenses are perpetual and the Support Plan includes 12 months of maintenance (support and version updates). You can renew maintenance after 12 months at 50% of the current license cost.
                            <p><span style="color: red;">*</span><strong>MultiSite Network Support</strong>
                                There is an additional cost for the number of subsites in Multisite Network.</p><br><br>
                            <p>At miniOrange, we want to ensure you are 100% happy with your purchase. If the premium plugin you purchased is not working as advertised and you've attempted to resolve any issues with our support team, which couldn't get resolved.  Please email us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> for any queries.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Licensing Table -->
        <a  id="mobacktoaccountsetup" style="display:none;" href="<?php echo add_query_arg( array( 'action' => 'register' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>">Back</a>
        <!-- JSForms Controllers -->
        <a id="mobacktocontactform" style="display:none;" href="<?php echo get_site_url().'/wp-admin/admin.php?page=custom_api_wp_settings'; ?>">Back2</a>
        <script>
            function customplanupgrade() {
                planType = document.getElementById('wp-rest-api-custom-plan-select').value;
                upgradeform(planType);
            }

            function upgradeform(planType) {
                if(planType === "") {
                    location.href = "https://wordpress.org/plugins/wp-rest-api-authentication/";
                    return;
                } else {
                    jQuery('#requestOrigin').val(planType);
                    if(jQuery('#mo_customer_registered').val()==1)
                        jQuery('#loginform').submit();
                    else{
                        location.href = jQuery('#mobacktoaccountsetup').attr('href');
                    }
                }

            }
            function upgradeform2() { 
                location.href = jQuery('#mobacktocontactform').attr('href');
            }
            function getlicensekeys() {
                // if(jQuery('#mo_customer_registered').val()==1)
                jQuery('#viewlicensekeys').submit();
            }
        </script>
        <!-- End JSForms Controllers -->
        <?php
    }
?>