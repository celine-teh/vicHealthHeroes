<?php

require('custom_api_wp_ui.php');
require('license_purchase.php');
function custom_api_wp_main_menu(){

    $currenttab = "";
	if( isset( $_GET['action'] ) )
        $currenttab = $_GET['action'];

        
        if (isset($_GET['api'])) 
            $api = custom_api_wp_sanitise1($_GET['api']);
        
        Custom_API_Admin_Menu::custom_api_auth_show_menu( $currenttab );
	echo '
	<div id="mo_api_authentication_settings">';
		echo '
		<div class="miniorange_container">';
		echo '
		<table style="width:100%;">
			<tr>
				<td style="vertical-align:top;width:65%;" class="mo_api_authentication_content">';
					Custom_API_Admin_Menu::custom_api_auth_show_tab( $currenttab );
				echo '</tr>
		</table>
		<div class="mo_api_authentication_tutorial_overlay" id="mo_api_authentication_tutorial_overlay" hidden></div>
		</div>';
}

class CustomAPISaleBanner{

	public static function show_bfs_note()
	{
        ?>
        <div class="notice notice-info"style="padding-right: 38px;position: relative;border-color:red; background-color: #0c082f;
			transform: scaleX(1);
			background-image: url('<?php echo esc_attr(plugin_dir_url( __FILE__ ));?>/images/3px-tile.png');"><h4><center><i class="fa fa-gift" style="font-size:50px;color:red;"></i>&nbsp;&nbsp;
		<big><font style="color:white; font-size:30px;"><b>END OF THE YEAR SALE: </b><b style="color:yellow;">UPTO 50% OFF!</b></font> <br></big><font style="color:white; font-size:15px;">Contact us at oauthsupport@xecurify.com for more details.</font></center></h4>
		<p style="text-align: center; font-size: 30px; margin-top: 0px; color:white;" id="demo"></p>
		<!-- </div> -->
			
		<script>
			var countDownDate = <?php echo esc_attr(strtotime('Dec 31, 2021 23:59:59')) ?> * 1000;
			var now = <?php echo esc_attr(time()) ?> * 1000;
			var x = setInterval(function() {
				now = now + 1000;
				var distance = countDownDate - now;
				var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);
				document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
					minutes + "m " + seconds + "s ";
				if (distance < 0) {
					clearInterval(x);
					document.getElementById("demo").innerHTML = "EXPIRED";
				}
			}, 1000);
		</script>
		<?php
	}

}

class Custom_API_Admin_Menu {
	
	public static function custom_api_auth_show_menu( $currenttab ) { ?> 
		<div class="wrap">
			<div>
				<img style="float:left;" src="<?php echo plugin_dir_url( __FILE__ );?>/images/miniorange.png">
			</div>
		<!-- </div>
		<div class="wrap"> -->
	       	<h3>
	            miniOrange Custom API &nbsp;
	           	<a class="add-new-h2" href="https://forum.miniorange.com/" target="_blank" rel="noopener">Ask questions on our forum</a>
				<a class="add-new-h2" href="https://faq.miniorange.com/" target="_blank" rel="noopener">FAQ</a>	
	       	</h3>
		</div>
		<div class="wrap">
       		<?php //CustomAPISaleBanner::show_bfs_note(); ?>
		</div>
		
        <style>
            .add-new-hover:hover{
                color: white !important;
            }
        </style>
		<div id="tab">
			<h2 class="nav-tab-wrapper" style="line-height:40px;">
                <a class="nav-tab <?php if( $currenttab == 'list' || $currenttab == '' ) echo 'mo_api_auth_nav_tab_active';?>" href="admin.php?page=custom_api_wp_settings">Available APIs</a>&nbsp;
                <a class="nav-tab <?php if( $currenttab == 'addapi' ) echo 'mo_api_auth_nav_tab_active';?>" href="admin.php?page=custom_api_wp_settings&action=addapi">Create API</a>
                <a class="nav-tab <?php if( $currenttab == 'customsql' ) echo 'mo_api_auth_nav_tab_active';?>" href="admin.php?page=custom_api_wp_settings&action=customsql">Create API with Custom SQL</a>
                <a class="nav-tab <?php if( $currenttab == 'add_auth' ) echo 'mo_api_auth_nav_tab_active';?>" href="admin.php?page=custom_api_wp_settings&action=add_auth">Add Authentication</a>
				<a class="nav-tab <?php if( $currenttab == 'externalapi' ) echo 'mo_api_auth_nav_tab_active';?>" href="admin.php?page=custom_api_wp_settings&action=externalapi">Connect to External API</a>
				<a class="nav-tab <?php if( $currenttab == 'register' ) echo 'mo_api_auth_nav_tab_active';?>" href="admin.php?page=custom_api_wp_settings&action=register">Account Setup</a>
                <a class="nav-tab <?php if( $currenttab == 'license' ) echo 'mo_api_auth_nav_tab_active';?>" href="admin.php?page=custom_api_wp_settings&action=license">License</a>
            </h2>
		</div>
		<?php
	}
	
	
	public static function custom_api_auth_show_tab( $currenttab ) { 
		if($currenttab === 'register') {
			if (get_option ( 'custom_api_authentication_verify_customer' )) {
				custom_api_already_customer();
			} else if (trim ( get_option ( 'custom_api_authentication_email' ) ) != '' && trim ( get_option ( 'mo_api_authentication_admin_api_key' ) ) == '' ) {
				custom_api_already_customer();
			}
			else {
				register();
			}
        } 
        elseif( $currenttab == '' || $currenttab == 'list')
        custom_api_wp_list_api();
		elseif( $currenttab == 'addapi')
		custom_api_wp_add_api();
		elseif( $currenttab == 'customsql')
		custom_api_wp_custom_sql();
        elseif( $currenttab == 'add_auth')
        custom_api_wp_authentication();
		elseif( $currenttab == 'externalapi')
        custom_api_wp_external_api_connection();

        elseif( $currenttab == 'license'){
		custom_api_authentication_licensing_page();
		}
        elseif($currenttab == 'edit'){
            if (isset($_GET['api'])) {
                $api = custom_api_wp_sanitise1($_GET['api']);
                custom_api_wp_edit_api($api);
            }
        }
        elseif($currenttab == 'delete'){
            if (isset($_GET['api'])) {
                // $api = custom_api_wp_sanitise1($_GET['api']);
                $api = custom_api_wp_sanitise1($_GET['api']);
                custom_api_wp_delete_api($api);
            }
        }
	} 

	public static function custom_api_auth_registration_view() {
	    
	    if(get_option('custom_api_authentication_new_customer')){
            register();  
        }
        elseif(get_option('custom_api_authentication_verify_customer')){
            custom_api_already_customer();
        }
       
	}
	
	
		
}