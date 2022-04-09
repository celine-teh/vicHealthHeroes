<?php

function register()
{
	if (!custom_api_authentication_is_customer_registered()) {
		// echo "if 1";
		// exit;
		custom_api_register_ui();
	} else {
		// echo "else 1";
		// exit;
		custom_api_show_customer_info();
	}
}

function custom_api_register_ui()
{
	$current_user = wp_get_current_user();
	
?>

	<div class="wrap" style="margin-top: -7px;">


		<div class="box-body" style="margin-top:10px; margin-left: 10px;width:103%">
			<div class="row" style="padding: unset;">
				<div class="col-md-7" style="background-color: white;border:.1rem solid #bfc4c8;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-style:solid; padding: 25px; ">
					<!-- <div class="mo_table_layout"> -->
					<form name="f" method="post" action="">
						<input type="hidden" name="option" value="custom_api_authentication_register_customer" />

						<div id="toggle1" class="mo_panel_toggle">
							<h5>Register with miniOrange<small style="font-size: x-small;"> [OPTIONAL]</small></h5>
						</div>
						<div id="panel1">
							<!--<p><b>Register with miniOrange</b></p>-->
							<!-- 					<p>Please enter a valid Email ID that you have access to. You will be able to move forward after verifying an OTP that we will be sending to this email.
					</p> -->
							<p style="font-size:14px;"><b>Why should I register? </b></p>
							<div id="help_register_desc" style="background: aliceblue; padding: 10px 10px 10px 10px; border-radius: 10px;font-size:14px;">
								You should register so that in case you need help, we can help you with step by step instructions.
								<b>You will also need a miniOrange account to upgrade to the premium version of the plugins.</b> We do not store any information except the email that you will use to register with us.
							</div>
							</p>
							<table>
								<tr>
									<td><b>
											<font color="#FF0000" >*</font>Email:
										</b></td>
									<td><input class="register_ui_input" type="email" name="email" style="width: 150%;" required placeholder="person@example.com" value="<?php echo get_option('custom_api_authentication_admin_email'); ?>" />
									</td>
								</tr>
								<tr class="hidden">
									<td><b>
											<font color="#FF0000">*</font>Website/Company Name:
										</b></td>
									<td><input class="" type="text" name="company" required placeholder="Enter website or company name" value="<?php echo $_SERVER['SERVER_NAME']; ?>" /></td>
								</tr>
								<tr class="hidden">
									<td><b>&nbsp;&nbsp;First Name:</b></td>
									<td><input class="" type="text" name="fname" placeholder="Enter first name" value="<?php echo $current_user->user_firstname; ?>" /></td>
								</tr>
								<tr class="hidden">
									<td><b>&nbsp;&nbsp;Last Name:</b></td>
									<td><input class="" type="text" name="lname" placeholder="Enter last name" value="<?php echo $current_user->user_lastname; ?>" /></td>
								</tr>

								<tr class="hidden">
									<td><b>&nbsp;&nbsp;Phone number :</b></td>
									<td><input class="" type="text" name="phone" pattern="[\+]?([0-9]{1,4})?\s?([0-9]{7,12})?" id="phone" title="Phone with country code eg. +1xxxxxxxxxx" placeholder="Phone with country code eg. +1xxxxxxxxxx" value="<?php echo get_option('custom_api_authentication_admin_phone'); ?>" />
										This is an optional field. We will contact you only if you need support.</td>
								</tr>
								</tr>
								<tr class="hidden">
									<td></td>
									<td>We will call only if you need support.</td>
								</tr>
								<tr>
									<td><b>
											<font color="#FF0000">*</font>Password:
										</b></td>
									<td><input class="register_ui_input" required style="width: 150%;" type="password" name="password" placeholder="Choose your password (Min. length 8)" /></td>
								</tr>
								<tr>
									<td><b>
											<font color="#FF0000">*</font>Confirm Password:
										</b></td>
									<td><input class="register_ui_input" required style="width: 150%;" type="password" name="confirmPassword" placeholder="Confirm your password" /></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<!-- <td><br /><input type="submit" name="submit" value="Save" style="width:100px;"
								class="button button-primary button-large" /></td> -->
									<td><br><input type="submit" name="submit" value="Register" class="button button-primary button-large" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="button" name="custom_api_goto_login" id="custom_api_goto_login" value="Already have an account?" class="button button-primary button-large" />&nbsp;&nbsp;</td>
								</tr>
							</table>
							<!-- </div> -->
						</div>
					</form>

					<form name="f5" method="POST" action="" id="custom_api_authentication_goto_login_form1" style="visibility: hidden;">
						<input type="text" name="option2" value="custom_api_authentication_goto_login1" style="visibility: hidden;">
					</form>
				</div>
				<?php contact_form() ?>
			</div>
		</div>

	</div>

	<script>
		// jQuery("#phone").intlTelInput();
		jQuery('#custom_api_goto_login').click(function() {
			jQuery('#custom_api_authentication_goto_login_form1').submit();

		});
	</script>

<?php

}
if (isset($_POST['option2'])) {
	if ($_POST['option2'] == "custom_api_authentication_goto_login1") {
	
		update_option('custom_api_authentication_verify_customer', 'yes');
		delete_option('custom_api_authentication_new_customer');
	}
}

function contact_form()
{
?>
	<div class="col-md-5">
		<div class="mo_custom_api_support_layout">
			<div>
				<h3>Contact Us</h3>
				<p>Need any help? Couldn't find an answer in FAQ?<br>Just send us a query so we can help you.</p>
				<form method="post" action=""><?php wp_nonce_field('CheckNonce', 'submit_contact_us'); ?>
					<input type="hidden" name="option" value="custom_api_wp_contact_us_query_option" />
					<table class="mo_settings_table">
						<tr>
							<td><input type="email" class="mo_table_textbox" required name="custom_api_wp_contact_us_email" placeholder="Enter email here" value=""></td>
						</tr>
						<tr>
							<td><input type="tel" id="contact_us_phone" pattern="[\+]\d{11,14}|[\+]\d{1,4}[\s]\d{9,10}" placeholder="Enter phone here" class="mo_table_textbox" name="custom_api_wp_contact_us_phone" value=""></td>
						</tr>
						<tr>
							<td><textarea class="mo_table_textbox" onkeypress="custom_api_wp_valid_query(this)" placeholder="Enter your query here" onkeyup="custom_api_wp_valid_query(this)" onblur="custom_api_wp_valid_query(this)" required name="custom_api_wp_contact_us_query" rows="4" style="resize: vertical;"></textarea></td>
						</tr>
					</table>
					<div>
						<input type="submit" name="submit" style="margin:15px; width:100px;" class="button button-primary button-large" />
					</div>
					<p>If you want custom features in the plugin, just drop an email at <a href="mailto:info@xecurify.com">info@xecurify.com</a>.</p>
				</form>
			</div>
		</div>

	</div>
<?php
}

function custom_api_already_customer()
{

?>
	<div class="wrap" style="margin-top: -7px;">

		<div class="box-body" style="margin-top:10px; margin-left: 10px;width:103%">
			<div class="row" style="padding: unset;">
				<div class="col-md-7" style="background-color: white;border:.1rem solid #bfc4c8;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-style:solid; padding: 30px; height: 300px;">
					<form name="f" method="post" action="">
						<input type="hidden" name="option" value="custom_api_authentication_verify_customer" />
						<!-- <div class="mo_table_layout"> -->
						<div id="toggle1" class="mo_panel_toggle">
							<h3>Login with miniOrange</h3>
						</div>
						<br>
						<p><b>Please enter your miniOrange email and password.<br /> <a href="#mo_api_authentication_forgot_password_link">Forgot Password?</a></b></p>

						<div id="panel1">
							</p>
							<table>
								<tr>
									<td><b>
											<font color="#FF0000">*</font>Email:
										</b></td>
									<td><input class="register_ui_input" style="width: 150%;" type="email" name="email" required placeholder="person@example.com" value="<?php echo get_option('custom_api_authentication_admin_email'); ?>" /></td>
								</tr>
								<td><b>
										<font color="#FF0000">*</font>Password:
									</b></td>
								<td><input class="register_ui_input" style="width: 150%;" required type="password" name="password" placeholder="Choose your password" /></td>
								</tr>
								<tr>
									<td>&nbsp;</td>

									<td>
										<br><input type="submit" name="submit" value="Login" class="button button-primary button-large" />
										<input style="visibility: hidden; width: 30%;" type="label"> <input type="button" name="back-button" id="mo_api_authentication_back_button" value="Back" class="button button-primary button-large" />

					</form>

					<form name="f5" method="POST" action="" id="custom_api_authentication_goto_register_form" style="visibility: hidden;">
						<input type="text" name="option2" value="custom_api_authentication_goto_register" style="visibility: hidden;">
					</form>
					</td>
					</td>
					</tr>
					</table>
				</div>
				<!-- </div> -->

			</div>
			<?php contact_form() ?>
		</div>
	</div>
	</div>

	<script>
		
		jQuery('#mo_api_authentication_back_button').click(function() {
			jQuery('#custom_api_authentication_goto_register_form').submit();

		});
	</script>

<?php
}

if (isset($_POST['option2'])) {
	if ($_POST['option2'] == "custom_api_authentication_goto_register") {
		
		update_option('custom_api_authentication_new_customer', 'yes');
		delete_option('custom_api_authentication_verify_customer');
	}
}

function custom_api_show_customer_info()
{
	
?>

	<div class="wrap" style="margin-top: -7px;">

		<div class="box-body" style="margin-top:10px; margin-left: 10px;width:103%">
			<div class="row" style="padding: unset;">
				<div class="col-md-7" style="background-color: white;border:.1rem solid #bfc4c8;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-style:solid; padding: 30px; height: 330px;">


					<!-- <div class="mo_table_layout" > -->
					<h2>Thank you for registering with miniOrange.</h2>

					<br>

					<table border="1" style="background-color:#FFFFFF; border:1px solid #CCCCCC; border-collapse: collapse; padding:0px 0px 0px 10px; margin:2px; width:85%">
						<tr>
							<td style="width:45%; padding: 10px;">miniOrange Account Email</td>
							<td style="width:55%; padding: 10px;"><?php echo get_option('custom_api_authentication_admin_email'); ?></td>
						</tr>
						<tr>
							<td style="width:45%; padding: 10px;">Customer ID</td>
							<td style="width:55%; padding: 10px;"><?php echo get_option('custom_api_authentication_admin_customer_key') ?></td>
						</tr>
					</table>
					<br />

					<table>
						<tr>
							<td>
								<form name="f1" method="post" action="" id="mo_api_authentication_goto_login_form">
									<input type="text" value="change_miniorange" name="option" style="visibility: hidden;">
									<input type="submit" value="Change Email Address" class="button button-primary button-large" />
								</form>
							</td>
							<td>
								<!-- <a href="<?php //echo add_query_arg( array( 'tab' => 'licensing' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); 
												?>"><input type="button" class="button button-primary button-large" value="Check Licensing Plans"/></a> -->
							</td>
						</tr>
					</table>

					<br />
					<!-- </div> -->



				</div>
				<?php contact_form() ?>
			</div>
		</div>
	</div>

<?php
}
