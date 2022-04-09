<?php
/*
Plugin Name: Auto Search Suggestion
Plugin URI: https://wordpress.org/plugins/auto-search-suggestion
Description: Showing suggestions on searching from wordpress admin.
Version: 5.0.0
Author: biztechc
Author URI: https://www.appjetty.com/
WordPress Tested up to: 5.8
License: GPLv2
Text Domain: ass
Domain Path: /languages
*/

if ( !defined( 'WPINC' ) ) die( 'No cheating!' );
if ( !defined( 'ABSPATH' ) ) exit;  // Exit if accessed directly

if ( !defined( 'EVR_URL' ) ) define( 'EVR_URL', plugin_dir_url( __FILE__ ) );
if ( !defined( 'EVR_PATH' ) ) define( 'EVR_PATH', plugin_dir_path( __FILE__ ) );

load_plugin_textdomain( 'ass', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/**
 * Register plugin style and scripts.
 */
function register_jquery_ui() {
	wp_register_style('auto-search-suggestion', plugins_url('auto-search-suggestion/css/jquery-ui.css'), false, '1.0.0', 'all');
	wp_enqueue_style( 'auto-search-suggestion' );
	wp_enqueue_style( 'search-style');
}
add_action( 'init', 'register_jquery_ui' );

/**
 * Register plugin style and scripts.
 */
function auto_suggest_css() {
	wp_enqueue_style( 'search-style', plugins_url('auto-search-suggestion/css/front.css'), array(), time(), 'all' );

}
add_action( 'wp_enqueue_scripts', 'auto_suggest_css' );

/**
 * Register admin menu.
 */
function auto_search_menu() {
	add_menu_page(__('Auto Search','ass'), __('Auto Search','ass'), 'manage_options', 'auto-suggest', '');
	add_submenu_page('auto-suggest', __('Admin Side Settings','ass'), __('Admin Side Settings','ass'), 'manage_options', 'auto-suggest','auto_suggest_settings_page');
	add_submenu_page( 'auto-suggest', __('Front Side Settings','ass'), __('Front Side Settings','ass'),'manage_options', 'auto-suggest-front','auto_suggest_front_settings_page');


	add_action( 'admin_init', 'register_auto_suggest_settings');
}
add_action('admin_menu', 'auto_search_menu');

/**
 * Register admin menu settings.
 */
function register_auto_suggest_settings() {
	register_setting( 'auto-suggest-settings-group1', 'auto_post_type' );
	register_setting( 'auto-suggest-settings-group1', 'auto_search_in' );
	register_setting( 'auto-suggest-settings-group2', 'auto_post_type_front' );
	register_setting( 'auto-suggest-settings-group2', 'auto_search_in_front' );
	register_setting( 'auto-suggest-settings-group2', 'auto_post_thumb_front' );
	register_setting( 'auto-suggest-settings-group2', 'auto_post_excerpt_front' );
	register_setting( 'auto-suggest-settings-group2', 'auto_post_date_front' );
	register_setting( 'auto-suggest-settings-group2', 'auto_post_limit_front' );
}

/**
 * Menu & submenu front-page settings callback.
 */
function auto_suggest_front_settings_page() {
	?>
	<div class="wrap">
		<h2><?php _e('Auto Search Suggestion Front Settings','ass'); ?></h2>
		<?php if(isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated'] == 'true'){?>
			<div class="updated notice notice-success is-dismissible" id="message"><p><?php _e('Setting updated.','ass'); ?></p></div>
		<?php } ?>
		<h4><?php _e('Add shortcode : [bt_auto_suggest]','ass'); ?></h4>
		<h4><?php _e('Add shortcode with parameters into post/page like : [bt_auto_suggest post_type="post,page" limit="8"]','ass'); ?></h4>
		<form method="post" action="options.php">
			<table class="form-table">
				<?php
					settings_fields( 'auto-suggest-settings-group2' );
					do_settings_sections( 'auto-suggest-settings-group2' );

					$set_post_type_front = get_option('auto_post_type_front');
					$set_search_in_front = get_option('auto_search_in_front');
					$set_post_thumb_front = get_option('auto_post_thumb_front');
					$set_post_excerpt_front = get_option('auto_post_excerpt_front');
					$set_post_date_front = get_option('auto_post_date_front');
					$set_post_limit_front = get_option('auto_post_limit_front');

					if($set_post_limit_front == NULL) {
						$set_post_limit_front = 5;
					}
				?>
				<tr valign="top">
					<th scope="row"><?php _e('Post Type Front','ass'); ?></th>
					<td>
						<fieldset>
						 <?php
							 $post_types_front = array('post'=>'post','page'=>'page');
							foreach ( $post_types_front as $post_type ) {
								$checked = '';
								if(@in_array("$post_type",$set_post_type_front) == true) {
										$checked = 'checked=checked';
								} ?>
								<label><input type="checkbox"  value="<?php echo esc_attr($post_type); ?>" name="auto_post_type_front[]" <?php echo esc_attr($checked); ?>> <span><?php echo esc_html($post_type); ?></span></label><br>
								<?php
								$checked = '';
							}
						?>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Search in','ass'); ?></th>
					<td>
						<fieldset>
							<label><input type="checkbox" name="auto_search_in_front[]" value="post_title" <?php echo @in_array( 'post_title',$set_search_in_front) ? esc_attr('checked=checked') : ''; ?>><?php _e('Post Title'); ?></label><br>
							<label><input type="checkbox" name="auto_search_in_front[]" value="post_content" <?php echo @in_array( 'post_content',$set_search_in_front) ? esc_attr('checked=checked') : ''; ?>><?php _e('Post Content'); ?></label><br>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" colspan="2"><?php _e('Fields include in search result:','ass'); ?></th>
					<!-- <td></td> -->
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Excerpt','ass'); ?></th>
					<td>
						<fieldset>
							<?php
								if($set_post_excerpt_front == 'on'){
									$checked = 'checked=checked';
								}
							 ?>
							<label><input type="checkbox"  name="auto_post_excerpt_front" <?php echo esc_attr($checked); ?>></label>
							<?php $checked = ''; ?>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Thumbnail</th>
					<td>
						<fieldset>
							<?php
								if($set_post_thumb_front == 'on'){
									$checked = 'checked=checked';
								}

							?>
							<label><input type="checkbox"  name="auto_post_thumb_front" <?php echo esc_attr($checked); ?>></label>
							<?php $checked = ''; ?>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Published date</th>
					<td>
						<fieldset>
							<?php
								if($set_post_date_front == 'on'){
									$checked = 'checked=checked';
								}

							?>
							<label><input type="checkbox"  name="auto_post_date_front" <?php echo esc_attr($checked); ?>></label>
							<?php $checked = ''; ?>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Limit</th>
					<td>
						<fieldset>
							<label><input type="number" class="small-text" value="<?php echo esc_attr($set_post_limit_front); ?>"  min="1" step="1" max="50" name="auto_post_limit_front"></label>
						</fieldset>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * Menu & submenu admin-page settings callback.
 */
function auto_suggest_settings_page() {
	?>
	<div class="wrap">
		<h2><?php _e('Auto Search Suggestion Settings','ass'); ?></h2>
		<?php if(isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated'] == 'true'){?>
			<div class="updated notice notice-success is-dismissible" id="message"><p><?php _e('Setting updated.','ass'); ?></p></div>
		<?php } ?>
		<form method="post" action="options.php">
			<table class="form-table">
				<?php
					settings_fields( 'auto-suggest-settings-group1' );
					do_settings_sections( 'auto-suggest-settings-group1' );
					$set_post_type = get_option('auto_post_type');
					$set_search_in = get_option('auto_search_in');
				?>
				<tr valign="top">
					<th scope="row"><?php _e('Post Type','ass'); ?></th>
					<td>
						<fieldset>
							<?php
								$post_types = get_post_types( '', 'names' );

								unset($post_types['attachment']);
								unset($post_types['revision']);
								unset($post_types['nav_menu_item']);

								foreach ( $post_types as $post_type ) {
									$checked = '';
									if(@in_array("$post_type",$set_post_type) == true) {
										$checked = 'checked=checked';
									} ?>
									<label><input type="checkbox"  value="<?php echo esc_attr($post_type); ?>" name="auto_post_type[]" <?php echo esc_attr($checked); ?>> <span><?php echo esc_html($post_type); ?></span></label><br>
									<?php
									$checked = '';
								}

							?>
						</fieldset>
					</td>
				</tr>
				<!-- <tr valign="top">
					<th scope="row"><?php _e('Search in','ass'); ?></th>
					<td>
						<fieldset>
							<label><input type="checkbox" name="auto_search_in[]" value="post_title" <?php echo @in_array( 'post_title',$set_search_in) ? esc_attr('checked=checked') : ''; ?>><?php _e('Post Title'); ?></label><br>
							<label><input type="checkbox" name="auto_search_in[]" value="post_content" <?php echo @in_array( 'post_content',$set_search_in) ? esc_attr('checked=checked') : ''; ?>><?php _e('Post Content'); ?></label><br>
						</fieldset>
					</td>
				</tr> -->
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * Auto suggest custom js for admin_footer
 */
function auto_suggest_javascript() {

	$current_screen = get_current_screen();
	$set_post_type = get_option('auto_post_type');

	if($current_screen->post_type!='' && in_array($current_screen->post_type,$set_post_type)) {
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		?>
		<script type="text/javascript" >
			jQuery(document).ready(function($) {

				/*jQuery( "#post-search-input" ).autocomplete({
					source: data,
					select: function () {
						form.submit();
					}
				});*/

				jQuery('#post-search-input').attr('autocomplete','off');
				var xhr1 = null;
				jQuery( "#post-search-input" ).keyup(function() {

					jQuery('#ui-id-1').attr( 'id', 'ui-custom-id-1');

					var search_key_var = jQuery('#post-search-input').val();

					if(search_key_var.length > 2){
						jQuery("#post-search-input").addClass('ui-autocomplete-loading');
						var data = {
							'action': 'auto_suggest',
							'whatever': search_key_var,
							'post_type': '<?php echo esc_attr($current_screen->post_type);?>'
						};

						if( xhr1 != null ) {
							xhr1.abort();
							xhr1 = null;
						}

						xhr1 = $.post(ajaxurl, data, function(response) {
							var availableTags = new Array();
							availableTags = response.split(',');
							//alert(availableTags);
							jQuery( "#post-search-input" ).autocomplete({
								source: availableTags,
								minLength: 3,
								select: function () {
									jQuery( "#posts-filter" ).submit();
								}
							});
							jQuery("#post-search-input").removeClass('ui-autocomplete-loading');
						});
					}
				});
			});
		</script>
		<style>
			.ui-autocomplete-loading {
				background: url('<?php echo esc_url(plugins_url( 'ajax-loader.gif', __FILE__ ));?>') right center no-repeat !important;
			}
		</style>
		<?php
	}
}
add_action( 'admin_footer', 'auto_suggest_javascript' );

/**
 * Auto suggest callback fucntion on ajax perform
 */
function auto_suggest_callback() {

	ob_flush();
	global $wpdb,$current_screen; //access to the database
	$post_type = get_option('auto_post_type');
	$whatever = sanitize_text_field($_POST['whatever']);
	$post_type = esc_attr($_POST['post_type']);
	$set_search_in = get_option('auto_search_in');

	if(isset($whatever) && $whatever!='') {
		/*$sql = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE post_title LIKE  '%".$whatever."%' and  post_type='$post_type'");*/

		//new query with WP_Query
		$args = array(
			'post_type'		=> $post_type,
			'post_status'	=> 'publish',
			'whatever'		=> $whatever,
			'orderby'		=> 'ID',
			'order'			=> 'DESC',
			'posts_per_page'=> -1
		);

		/*if ( isset($set_search_in) && @in_array( 'post_title',$set_search_in) && !in_array( 'post_content',$set_search_in) ) {*/

			add_filter( 'posts_where', 'auto_suggest_title_like', 10, 2 );
			$sql = new WP_Query( $args );
			remove_filter( 'posts_where', 'auto_suggest_title_like', 10, 2 );

		/*} elseif ( isset($set_search_in) && !in_array( 'post_title',$set_search_in) && @in_array( 'post_content',$set_search_in) ) {

			add_filter( 'posts_where', 'auto_suggest_content_like', 10, 2 );
			$sql = new WP_Query( $args );
			remove_filter( 'posts_where', 'auto_suggest_content_like', 10, 2 );

		} else {

			$args['s'] = $whatever;
			$sql = new WP_Query( $args );
		}*/
		//$whatever += 10;

		if(count($sql->posts)>0){

			$name = array();
			foreach($sql->posts as $res_name) {
				//Debugbreak();
				$name[] = $res_name->post_title;
			}
			$name = implode(',',$name);
			print_r($name); //echo json_encode($name);
		} else {
			esc_html_e('No records found','ass');
		}
	}

	die(); //terminate immediately and return a proper response
}
add_action( 'wp_ajax_auto_suggest', 'auto_suggest_callback' );

/**
 * Auto suggest callback fucntion on ajax perform on front-end
 */
function auto_suggest_front_callback() {

	ob_flush();
	global $wpdb,$current_screen,$post; //access to the database
	wp_enqueue_style('search-style');
	$whatever =  sanitize_text_field($_POST['whatever']);
	$post_type_front = esc_attr($_POST['post_type_front1']);
	$post_limit_front = esc_attr($_POST['post_limit_front1']);

	if(isset($post_type_front) && $post_type_front !='') {
		$set_post_type_front = explode(',', $post_type_front); $post_type_front;
	} else {
		$set_post_type_front = get_option('auto_post_type_front');
	}

	if(isset($post_limit_front) && $post_limit_front !='') {
		$set_post_limit_front = $post_limit_front;
	} else {
		$set_post_limit_front = get_option('auto_post_limit_front');
	}

	$post_types = implode("','", $set_post_type_front);
	$set_search_in_front = get_option('auto_search_in_front');
	$set_post_thumb_front = get_option('auto_post_thumb_front');
	$set_post_excerpt_front = get_option('auto_post_excerpt_front');
	$set_post_date_front = get_option('auto_post_date_front');

	if(isset($whatever) && $whatever!='') {

		//Old query direct to db
		/*$sql = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE post_title LIKE  '%".$whatever."%' and  post_type IN ('$post_types') and post_status='publish' order by id DESC LIMIT ".$set_post_limit_front."");*/

		//new query with WP_Query
		$args = array(
			'post_type'		=> $set_post_type_front,
			'post_status'	=> 'publish',
			'whatever'		=> $whatever,
			'orderby'		=> 'ID',
			'order'			=> 'DESC',
			'posts_per_page'=> $set_post_limit_front
		);

		if ( isset($set_search_in_front) && @in_array( 'post_title',$set_search_in_front) && !in_array( 'post_content',$set_search_in_front) ) {

			add_filter( 'posts_where', 'auto_suggest_title_like', 10, 2 );
			$sql = new WP_Query( $args );
			remove_filter( 'posts_where', 'auto_suggest_title_like', 10, 2 );

		} elseif ( isset($set_search_in_front) && !in_array( 'post_title',$set_search_in_front) && @in_array( 'post_content',$set_search_in_front) ) {

			add_filter( 'posts_where', 'auto_suggest_content_like', 10, 2 );
			$sql = new WP_Query( $args );
			remove_filter( 'posts_where', 'auto_suggest_content_like', 10, 2 );

		} else {

			$args['s'] = $whatever;
			$sql = new WP_Query( $args );
		}

		if(count($sql->posts)>0) {

			$name = array();
			foreach($sql->posts as $res_name) {

				$has_img = get_the_post_thumbnail( $res_name->ID, 'thumbnail', true );

				if(isset($has_img) && $has_img !=''){
					$cls = 'img-active';
				} else {
					$cls = '';
				} ?>

				<div class="post-details <?php echo esc_attr($cls); ?>">
					<?php 
						if(isset($set_post_thumb_front) && $set_post_thumb_front =='on') {
							$has_img = get_the_post_thumbnail( $res_name->ID, 'thumbnail', true );

							if(isset($has_img) && $has_img !='') {
								?>
								<div class="col-left ">
									<div class="post-img"><?php printf( esc_html('%s'), $has_img); ?></div>
								</div>
								<?php
							}
						}
					?>
					<div class="col-right">
						<?php
							$has_title = $res_name->post_title;
							if(isset($has_title) && $has_title !=''){ ?>
								<div class="post-title">
									<a href="<?php echo esc_url(get_permalink($res_name->ID));?>"><?php echo esc_html($has_title); ?></a>
								</div>
							<?php }

							if(isset($set_post_excerpt_front) && $set_post_excerpt_front == 'on'){
								$has_excerpt = $res_name->post_excerpt;

								if(isset($has_excerpt) && $has_excerpt !=''){ ?>
									<div class="post-desc"><?php echo esc_html(mb_strimwidth($has_excerpt, 0, 400, '...'));?></div>
								<?php }
							}

							if(isset($set_post_date_front) && $set_post_date_front =='on'){ ?>
								<div class="post-date"><?php echo esc_html($pfx_date = get_the_date( 'Y-m-d', $res_name->ID )); ?></div>
							<?php }
						?>
					</div>
				</div>
				<?php
			} 
		} else {
			esc_html_e('No records found','ass');
		}
	}
	die(); //terminate immediately and return a proper response
}
add_action( 'wp_ajax_auto_suggest_front', 'auto_suggest_front_callback' );
add_action( 'wp_ajax_nopriv_auto_suggest_front', 'auto_suggest_front_callback' );

/**
 * Limit posts suggest search to post_tile only
 */
function auto_suggest_title_like( $where, &$wp_query ) {

	global $wpdb;
	$search_term = $wp_query->get( 'whatever' );

	if ( !empty( $search_term ) ) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
	}
	
	return $where;
}

/**
 * Limit posts suggest search to post_content only
 */
function auto_suggest_content_like( $where, &$wp_query ) {

	global $wpdb;
	$search_term = $wp_query->get( 'whatever' );

	if ( !empty( $search_term ) ) {
		$where .= ' AND ' . $wpdb->posts . '.post_content LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
	}
	
	return $where;
}

/**
 * Auto suggest search shortcode register
 */
function auto_suggest_search_sc($atts){

	ob_start();
	$content = '';
	wp_enqueue_style('search-style');
	$set_post_type_front1 = '';

	if(isset($atts['post_type']) && $atts['post_type'] !=''){
		$set_post_type_front1 = esc_attr($atts['post_type']);
	}

	$set_post_limit_front1 = '';
	if(isset($atts['limit']) && $atts['limit'] !=''){
		$set_post_limit_front1 = $atts['limit'];
	}else{
		$set_post_limit_front1 = get_option('auto_post_limit_front');
	}

	$set_post_thumb_front = get_option('auto_post_thumb_front');
	$set_post_excerpt_front = get_option('auto_post_excerpt_front');
	$set_post_date_front = get_option('auto_post_date_front');

	?>
	<div class="search-section">
		<form class="auto-suggest-form" action="<?php echo esc_url(site_url());?>" method="get" role="search">
			<input class="auto-suggest-front" id="auto-suggest-front" placeholder="Search..." name="s">
			<button class="auto-suggest-submit" type="submit"><span class="screen-reader-text"><?php _e('Search','ass'); ?></span></button>
		</form>

	</div>
	<div class="asr-container" style="display: none" id="asr-container">
		<div class="result-section" id="result-section"></div>
		<p class="more-res"><a href=""><?php _e('More Results','ass'); ?></a></p>
	</div>
	<?php

		$post_types = get_post_types( '', 'names' );
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_enqueue_style('search-style');
	?>
	<script type="text/javascript" >
		jQuery(document).ready(function($) {
			jQuery('#auto-suggest-front').attr('autocomplete','off');

			var post_type_front = '<?php echo esc_attr($set_post_type_front1); ?>';
			var post_limit_front = '<?php echo esc_attr($set_post_limit_front1); ?>';
			var ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
			var xhr = null;

			jQuery( "#auto-suggest-front" ).keyup(function() {

				var search_key_var2 = jQuery('#auto-suggest-front').val();


				if(search_key_var2.length > 1){

					jQuery("#auto-suggest-front").addClass('ui-autocomplete-loading');
					var data = {
						'action': 'auto_suggest_front',
						'whatever': search_key_var2,
						'post_type_front1': post_type_front,
						'post_limit_front1':post_limit_front

					};

					if( xhr != null ) {
						xhr.abort();
						xhr = null;
					}

					jQuery('#asr-container').hide();

					xhr = $.post(ajaxurl, data, function(response) {

						jQuery('#asr-container').show();
						
						if(response == 'No records found'){
							jQuery('.more-res').hide();
							jQuery('#asr-container').addClass('no-result');
						}else{
							jQuery('.more-res').show();
							jQuery('#asr-container').removeClass('no-result');
							jQuery('.more-res a').attr('href','<?php echo esc_url(site_url());?>/?s='+search_key_var2);

						}

						jQuery('#result-section').html(response);
						jQuery("#auto-suggest-front").removeClass('ui-autocomplete-loading');
					});
				}else{
					jQuery('#asr-container').hide();
					jQuery('#result-section').html('');
				}
			});
		});
	</script>
	<style>
		.ui-autocomplete-loading {
			background: url('<?php echo esc_url(plugins_url( 'ajax-loader.gif', __FILE__ ));?>') right center no-repeat !important;
		}
	</style>
	<?php
	$content .= ob_get_clean();
	return $content;
}
add_shortcode('bt_auto_suggest','auto_suggest_search_sc');
add_filter('widget_text', 'do_shortcode');

/**
 * Auto suggest get current scree
 */
function auto_search_get_current_screen() {
	global $current_screen;
	$current_screen = get_current_screen();
}
add_action( 'current_screen', 'auto_search_get_current_screen' );

/**
 * Auto suggest plug-in uninstall hook
 */
function auto_search_uninstall() {
	delete_option('auto_post_type');
}
register_uninstall_hook( __FILE__, 'auto_search_uninstall' );