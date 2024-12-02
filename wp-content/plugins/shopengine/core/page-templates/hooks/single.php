<?php

namespace ShopEngine\Core\Page_Templates\Hooks;

use ShopEngine\Core\Builders\Templates;

defined('ABSPATH') || exit;

class Single extends Base {

	protected $page_type = 'single';
	protected $template_part = 'content-single-product.php';

	public function init() : void {
		// nothing is going on here
		add_action('wp_enqueue_scripts', [$this,'single_page_css_conflict_remove'], 20);
	}

	protected function get_page_type_option_slug(): string {
		if(!empty($_REQUEST['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST['nonce'])), 'wp_rest')) {
			return !empty($_REQUEST['shopengine_quickview']) && $_REQUEST['shopengine_quickview'] === 'modal-content' ? 'quick_view' : $this->page_type;
		}
		return $this->page_type;
	}

	protected function template_include_pre_condition() : bool {

		return is_product();
	}

	public function before_hooks() {
		do_action( 'woocommerce_before_single_product' );
	}

	public function after_hooks()
	{
		do_action( 'woocommerce_after_single_product' );
		$themeName = get_template();
			if ( $themeName == 'eduma' ) {
				wp_dequeue_script('thim-main');
				wp_dequeue_script('thim-custom-script');
			}
	}

	public function single_page_css_conflict_remove() {

		if (function_exists('wp_get_theme')) {
			$theme = wp_get_theme();
			$active_theme = $theme->get('Name');

			if ($active_theme === 'PHOX' || $active_theme === 'PHOX Child') {

				wp_dequeue_style('wdes-woocommerce');
				wp_dequeue_script('bootstrap');
			}
		}
	}
}
