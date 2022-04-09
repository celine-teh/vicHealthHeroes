<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.miniorange.com
 * @since             1.0.0
 * @package           Custom_Api_For_Wordpress
 *
 * @wordpress-plugin
 * Plugin Name:       Custom API for WP
 * Plugin URI:        custom-api-for-wp
 * Description:       This plugin helps in creating custom api end points for extracting customized data from database. The plugin can also be extended to integrate external APIs in WordPress.
 * Version:           2.2.0
 * Author:            miniOrange
 * Author URI:        https://www.miniorange.com
 * License:           MIT/Expat
 * License URI:       https://docs.miniorange.com/mit-license
 */

require('custom_api_nav.php');
require('custom_api_wp_customer.php');
require('feedback-form.php');



// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('CUSTOM_API_FOR_WORDPRESS_VERSION', '2.2.0');

update_option('mo_custom_api_wp_version', CUSTOM_API_FOR_WORDPRESS_VERSION);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-custom-api-for-wordpress-activator.php
 */
function activate_custom_api_for_wordpress()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-custom-api-for-wordpress-activator.php';
	Custom_Api_For_Wordpress_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-api-for-wordpress-deactivator.php
 */
function deactivate_custom_api_for_wordpress()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-custom-api-for-wordpress-deactivator.php';
	Custom_Api_For_Wordpress_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_custom_api_for_wordpress');
register_deactivation_hook(__FILE__, 'deactivate_custom_api_for_wordpress');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-custom-api-for-wordpress.php';

/**
 * Begins execution of the plugin.
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_custom_api_for_wordpress()
{

	$plugin = new Custom_Api_For_Wordpress();
	$plugin->run();
}
run_custom_api_for_wordpress();


// add_action ( 'admin_init', 'wp_verify_nonce');

add_action('rest_api_init', function () {

	$GetVar = get_option('CUSTOM_API_WP_LIST');

	foreach ($GetVar as $ApiName => $value) {

		$namespace = 'mo/v1';
		$route = '';
		if ($value['SelectedCondtion'] == 'no condition') {
			$route = $ApiName;
			// echo $route;
		} else {

			$route = $ApiName . '/(?P<id>[A-Za-z0-9_]+)';
		}


		register_rest_route($namespace, $route, array(
			'methods'  => 'GET',
			'callback' => 'custom_api_wp_get_result',
			'args' => $value
		));
	}
});

function custom_api_wp_get_result($request)
{

	global $wpdb;

	$need =  $request->get_attributes();

	$GetQuery1 = $need['args']['query'];
	$SelectedCondtion = $need['args']['SelectedCondtion'];
	if (($SelectedCondtion == 'no condition')) {

		$myrows = $wpdb->get_results("{$GetQuery1}");
		return $myrows;
	} else {
		$Spliting = explode($SelectedCondtion, $GetQuery1);
		$MainQuery = $Spliting[0];
		$type = gettype($request['id']);
		if ($type == "string" && 'Like' == $SelectedCondtion) {
			$param = '"%' . $request['id'] . '%"';
		}
		elseif($type == "string")
			$param = '"' . $request['id'] . '"';

		if ($type == "integer") {
			$param = $request['id'];
		}

		if ('&amp;gt;' == $SelectedCondtion)
			$SelectedCondtion = '>';
		if ('less than' == $SelectedCondtion)
			$SelectedCondtion = '<';
		$SelectedCondtion = $SelectedCondtion.' ';
		
		$myrows = $wpdb->get_results("{$MainQuery} {$SelectedCondtion} {$param}");

		return $myrows;
	}
}

class Custom_Api_Wp
{
	function __construct()
	{
		add_action('admin_menu', array($this, 'custom_api_wp_menu'));
		add_action( 'admin_footer', array( $this, 'custom_api_client_feedback_request' ) );

	}

	function custom_api_wp_menu()
	{

		//Add miniOrange custom api for wp 
		$slug = 'custom_api_wp_settings';
		add_menu_page('MO API Settings ' . __('Configure Custom API Settings', 'custom_api_wp_settings'), 'Custom API plugin', 'administrator', $slug, array(
			$this,
			'custom_api_wp_widget_options'
		), plugin_dir_url(__FILE__) . 'images/miniorange-logo.png');
	}


	function custom_api_wp_widget_options()
	{
		global $wpdb;
		wp_enqueue_script('custom-api-wp-phone', plugins_url('/js/custom-api-wp-phone.js', __FILE__), array(), null);
		wp_enqueue_script('custom-api-wp', plugins_url('/js/custom-api-wp.js', __FILE__), array(), null);
		wp_enqueue_script('custom-wp-popper-min', plugins_url('/js/popper.min.js', __FILE__), array(), null);

		wp_enqueue_script('custom-wp-bootstrap-min', plugins_url('/js/bootstrap-min.js', __FILE__), array(), null);
		wp_enqueue_script('custom-wp-bootstrap-multiselect', plugins_url('/js/bootstrap-multiselect.js', __FILE__), array(), null);
		 wp_enqueue_script('custom-wp-bootstrap', plugins_url('/js/bootstrap.js', __FILE__), array(), null);

		wp_enqueue_style('custom-wp-bootstrap-min', plugins_url('/css/bootstrap-min.css', __FILE__), array(), null);
		wp_enqueue_style('custom-wp-bootstrap-multiselect', plugins_url('/css/bootstrap-multiselect.css', __FILE__), array(), null);
		wp_enqueue_style('custom-wp-bootstrap', plugins_url('/css/bootstrap.css', __FILE__), array(), null);
		wp_enqueue_style('custom-api-wp-css', plugins_url('/css/custom-api-wp-css.css', __FILE__), array(), null);
		wp_enqueue_style('custom-api-wp-phone', plugins_url('/css/phone.css', __FILE__), array(), null);
		update_option('host_name', 'https://login.xecurify.com');
		custom_api_wp_main_menu();

	}

	function custom_api_client_feedback_request(){
        custom_api_client_display_feedback_form();
    }
}
new Custom_Api_Wp;

function custom_api_wp_sanitise($var)
{
	$var = trim($var);
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var);
	$var = htmlspecialchars($var);

	return $var;
}

add_action('admin_init', 'custom_api_wp_functions');
// add_action('admin_init', 'custom_api_wp_submit_contact_us($email, $phone, $query )');

function custom_api_wp_functions()
{
	if (current_user_can('administrator')) {
		if (isset($_POST["SubmitForm1"])) {
			if (isset($_POST['SubmitUser1']) && wp_verify_nonce($_POST['SubmitUser1'], 'CheckNonce1')) {
				$data1 = array(
					"ApiName" => custom_api_wp_sanitise($_POST['api_name_initial']),
					"MethodName" => custom_api_wp_sanitise($_POST['method_name_initial']),
					"TableName" => custom_api_wp_sanitise($_POST['table_name_initial'])
				);
				update_option('mo_custom_api_form1', $data1);
			}
		}
	}

	if (current_user_can('administrator')) {
		if (isset($_POST["SendResult"])) {
			// echo 'true';
			if (isset($_POST['SubmitUser']) && wp_verify_nonce($_POST['SubmitUser'], 'CheckNonce')) {

				$data = array(
					"status" => "yes",
					"ApiName" => custom_api_wp_sanitise($_POST["ApiName"]),
					"TableName" => isset($_POST['select-table']) ? custom_api_wp_sanitise1($_POST['select-table']) : '',	
					"MethodName" => isset($_POST['MethodName']) ? custom_api_wp_sanitise1($_POST['MethodName']) : '',
					"SelectedColumn" => custom_api_wp_sanitise($_POST["Selectedcolumn11"]),
					"ConditionColumn" => custom_api_wp_sanitise($_POST["OnColumn"]),
					"SelectedCondtion" => custom_api_wp_sanitise($_POST["ColumnCondition"]),
					"SelectedParameter" => custom_api_wp_sanitise($_POST["ColumnParam"]),
					"query" => custom_api_wp_sanitise($_POST["QueryVal"])
				);

				update_option('mo_custom_api_form', $data);
			}
		}
	}


	function custom_api_wp_submit_contact_us( $email, $phone, $query ) {
		global $current_user;
		// wp_get_current_user();
		$query = '[Custom API WP - '.CUSTOM_API_FOR_WORDPRESS_VERSION.' ] ' . $query;
		$fields = array(
			'firstName'			=> isset($current_user->user_firstname) ? $current_user->user_firstname : '',   
			'lastName'	 		=> isset($current_user->user_lastname) ? $current_user->user_lastname : '',
			'company' 			=> $_SERVER['SERVER_NAME'],
			'email' 			=> $email,
			'ccEmail'			=> 'oauthsupport@xecurify.com',
			'phone'				=> $phone,
			'query'				=> $query
		);
		$field_string = json_encode( $fields );
		update_option( 'custom_api_wp_host_name', 'https://login.xecurify.com' );
		$url = get_option('custom_api_wp_host_name') . '/moas/rest/customer/contact-us';
		
		$headers = array( 'Content-Type' => 'application/json', 'charset' => 'UTF - 8', 'Authorization' => 'Basic' );
		$args = array(
			'method' =>'POST',
			'body' => $field_string,
			'timeout' => '15',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers,
	
		);
		
		$response = wp_remote_post( $url, $args );
		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			echo "Something went wrong: $error_message";
			exit();
		}
		return wp_remote_retrieve_body($response);
		
	}

	if(isset($_POST['option'])){
		if( custom_api_wp_sanitise($_POST['option']) == "custom_api_wp_contact_us_query_option" ) {
			
			if ( wp_verify_nonce($_POST['submit_contact_us'], 'CheckNonce')){
						$email = isset($_POST['custom_api_wp_contact_us_email']) ? custom_api_wp_sanitise($_POST['custom_api_wp_contact_us_email']) : '';
						$phone = isset( $_POST['custom_api_wp_contact_us_phone']) ? custom_api_wp_sanitise($_POST['custom_api_wp_contact_us_phone']) : '';
						$query = isset( $_POST['custom_api_wp_contact_us_query']) ? custom_api_wp_sanitise($_POST['custom_api_wp_contact_us_query']) : '';
						
						
						if ( custom_api_wp_empty_or_null( $email ) || custom_api_wp_empty_or_null( $query ) ) {
							update_option('custom_api_wp_message', 'Please fill up Email and Query fields to submit your query.');
							custom_api_wp_show_error_message();
						} else {
							$submited = custom_api_wp_submit_contact_us( $email, $phone, $query );
							if ( $submited != 'Query submitted.' ) {
								update_option('custom_api_wp_message', 'Your query could not be submitted. Please try again.');
								custom_api_wp_show_error_message();
							} else {
								update_option('custom_api_wp_message', 'Thanks for getting in touch! We shall get back to you shortly.');
								custom_api_wp_show_success_message();
							}
						}
					}
				}
			}

			if( current_user_can( 'manage_options' )) {
				if(isset( $_POST['option'] ) and $_POST['option'] == 'mo_oauth_client_skip_feedback' ) {
					deactivate_plugins( __FILE__ );
					update_option( 'custom_api_wp_message', 'Plugin deactivated successfully' );
					custom_api_wp_show_success_message();
				} else if( isset( $_POST['custom_api_client_feedback'] ) and $_POST['custom_api_client_feedback'] == 'true' ) {
					$user = wp_get_current_user();
					$message = 'Plugin Deactivated:';
					$deactivate_reason         = array_key_exists( 'deactivate_reason_radio', $_POST ) ? $_POST['deactivate_reason_radio'] : false;
					$deactivate_reason_message = array_key_exists( 'query_feedback', $_POST ) ? $_POST['query_feedback'] : false;
					if ( $deactivate_reason ) {
						$message .= $deactivate_reason;
						if ( isset( $deactivate_reason_message ) ) {
							$message .= ':' . $deactivate_reason_message;
						}
						// $email = get_option( "custom_api_authentication_admin_email" );
						// if ( $email == '' ) {
							$email = $user->user_email;
						// }
						// $phone = get_option( 'custom_api_authentication_admin_phone' );
						$phone = '';
						//only reason
						
						$submited = json_decode( custom_api_send_email_alert( $email, $phone, $message ), true );
						deactivate_plugins( __FILE__ );
						update_option( 'custom_api_wp_message', 'Thank you for the feedback.' );
						custom_api_wp_show_success_message();
					} else {
						update_option( 'custom_api_wp_message', 'Please Select one of the reasons ,if your reason is not mentioned please select Other Reasons' );
						custom_api_wp_show_error_message();
					}
				}
			}
		
}