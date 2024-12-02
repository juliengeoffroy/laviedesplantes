<?php
/*
Plugin Name: ConvertBox Auto Embed WordPress plugin
Plugin URI: https://convertbox.com/
Description: Automatically add your ConvertBox embed code into your WordPress site!
Version: 1.1.2
Author: ConvertBox
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tested up to: 6.6.2
Requires at least: 3.0.0
*/

function convbox_head_script() {
	include( "embed-code.php" );
}

function convbox_is_embed_code_set() {
	return !!get_option( "convbox_embed_id", false );
}

function convbox_activation_redirect( $plugin ) {
	if ( $plugin == plugin_basename( __FILE__ ) ) {
		exit( wp_redirect( admin_url( "admin.php?page=convertbox" ) ) );
	}
}

function convbox_check_embed_code( $embedCode ) {
	$url      = "https://app.convertbox.com/check-embed-code?embed-code=" . urlencode( $embedCode );
	$response = wp_remote_get( $url );

	if ( is_array( $response ) ) {
		$body = json_decode( $response["body"], true );

		return array_key_exists( "valid", $body ) ? $body["valid"] : false;
	}

	return false;
}

function convbox_admin_notice() {
	global $pagenow;
	if ( ! ( ( $pagenow == 'admin.php' || $pagenow == 'tools.php' ) && ( isset( $_GET['page'] ) && $_GET['page'] == 'convertbox' ) ) && ! convbox_is_embed_code_set() && current_user_can('manage_options') ) {
		?>
        <div class="notice notice-error is-dismissible"><p><a href="<?php echo admin_url( "admin.php?page=convertbox" ) ?>">Please add the ConvertBox embed code for your website</a></p></div>
		<?php
	}
}

//Thank you velcrow: http://stackoverflow.com/a/4694816/2167545
function convbox_is_valid_uuid4( $uuid ) {
	return preg_match( '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $uuid );
}

function convbox_show_convertbox_page() {
	$success = null;
	if ( convbox_is_embed_code_set() ) {
		$success = true;
	}

	if ( array_key_exists( "convertbox-code", $_POST ) && check_admin_referer('convertbox-code', 'convbox') && current_user_can('manage_options')) {
		$embedCode = $_POST["convertbox-code"];
		if ( convbox_is_valid_uuid4( $embedCode ) && convbox_check_embed_code( $embedCode ) ) {
			update_option( "convbox_embed_id", $embedCode );
			$success = true;
		} else {
			$success = false;
		}
	}

	$embedCode = get_option( "convbox_embed_id", "" );

	include( "embed-page.php" );
}

function convbox_add_admin_page() {
	add_submenu_page(
		'tools.php',
		'ConvertBox',
		'ConvertBox',
		'manage_options',
		'convertbox',
		'convbox_show_convertbox_page'
	);
}

function convbox_load_admin_style() {
	global $pagenow;

	if ( ( ( $pagenow == 'admin.php' || $pagenow == 'tools.php' ) && array_key_exists( 'page',
			$_GET ) && $_GET['page'] == 'convertbox' )
	) {
		wp_enqueue_style( 'convertbox_font_awesome', plugin_dir_url( __FILE__ ) . '/css/font-awesome.css', false, '1.0.0' );
		wp_enqueue_style( 'convertbox_css', plugin_dir_url( __FILE__ ) . '/css/styles.css', false, '1.0.0' );
	}
}

add_action( 'admin_enqueue_scripts', 'convbox_load_admin_style' );
add_action( 'admin_notices', 'convbox_admin_notice' );
add_action( 'activated_plugin', 'convbox_activation_redirect' );
add_action( 'admin_menu', 'convbox_add_admin_page' );
add_action( 'wp_head', 'convbox_head_script' );

// Function to register our new routes from the controller.
function convbox_register_rest_routes() {
	require_once 'includes/rest/CB_REST_Tags_Controller.php';
	require_once 'includes/rest/CB_REST_Types_Controller.php';
	require_once 'includes/rest/CB_REST_Categories_Controller.php';

	$tagsController       = new CB_REST_Tags_Controller();
	$typesController      = new CB_REST_Types_Controller();
	$categoriesController = new CB_REST_Categories_Controller();

	$tagsController->register_routes();
	$typesController->register_routes();
	$categoriesController->register_routes();
}

add_action( 'rest_api_init', 'convbox_register_rest_routes' );
add_action( 'send_headers', function () {
	header( "Access-Control-Allow-Origin: *" );
} );

function convbox_js_vars() {
	$isUserLoggedIn = is_user_logged_in() ? 'true' : 'false';
	$script         = "<script>var cb_wp=cb_wp || {};cb_wp.is_user_logged_in={$isUserLoggedIn};";

	if ( true === is_singular() ) {
		$post      = get_post();
		$post_data = [
			'id'        => $post->ID,
			'tags'      => [],
			'post_type' => $post->post_type,
			'cats'      => wp_get_post_categories( $post->ID ),
		];

		$tags = wp_get_post_tags( $post->ID );
		foreach ( $tags as $tag ) {
			$post_data['tags'][] = $tag->term_id;
		}

		$post_data = json_encode( $post_data );
		$script .= "cb_wp.post_data={$post_data};";
	}
	$script .= '</script>';

	echo $script;
}

add_action( 'wp_head', 'convbox_js_vars' );

// [cboxarea]
function cboxarea_func( $atts ) {
	$props = shortcode_atts( [
		'id' => null,
	], $atts );

	if ( ! $props['id'] ) {
		return;
	}

	return "<div id=\"" . esc_attr($props['id']) . "\"></div>";
}

add_shortcode( 'cboxarea', 'cboxarea_func' );
