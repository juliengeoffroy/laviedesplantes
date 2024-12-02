<?php

defined('ABSPATH') || exit;

\ShopEngine\Widgets\Widget_Helper::instance()->wc_template_filter();


/*
	-----------------------------------------------
	Changed flash sale text to percentage off text
	-----------------------------------------------
*/
if( $product->is_on_sale() && 'yes' === $settings['shopengine_sale_flash_status'] ) {

   
    $flash_sale_position = 'position-' . $settings['shopengine_flash_sale_position'];
    $sale_variations = [];
    $first_variation = null;

    // Variable Product support for sale badge for each single variation
    if ($product->is_type('variable')) {
        $available_variations = $product->get_available_variations();
        $default_sale_price = null;
    
        foreach ($available_variations as   $variation) {
            $regular_price = $variation['display_regular_price'];
            $current_price = $variation['display_price'];
    
            if($first_variation == null){
                $first_variation = $variation['variation_id'];
            }

            if (!empty($regular_price) && !empty($current_price)) {
            
                $s_p = ($regular_price - $current_price) / $regular_price * 100;
              
                $sale_price = \Automattic\WooCommerce\Utilities\NumberUtil::round($s_p);
                $sale_variations[$variation['variation_id']] = $sale_price;
    
                if (is_null($default_sale_price)) {
                    $default_sale_price = $sale_price;
    
                }
            }
        }

        //variation for first variation is not on sale
        $style = '';
        if(count($sale_variations) > 0 && $sale_variations[ $first_variation ] < 1){
            $style = 'display:none';

        }
    
        echo '<span style="'.esc_attr($style).'" class="onsale ' . esc_attr($flash_sale_position) . '" id="shopengine-variable-onsale-badge">' . esc_html($default_sale_price) . esc_html__('% OFF', 'shopengine') . '</span>';
    
       
        // Pass sale variations data to JavaScript
        echo '<script type="text/javascript">let ShopEngineSaleVariations = ' . wp_json_encode($sale_variations) . ';</script>';
    } else {

        $regular_price = $product->get_regular_price();
		$current_price = $product->get_price();

		if( !empty($regular_price) && !empty($current_price) ){

            $flash_slae_position = 'position-' . $settings['shopengine_flash_sale_position'];
            $s_p = ( $regular_price - $current_price ) / $regular_price * 100;
            $sale_price = \Automattic\WooCommerce\Utilities\NumberUtil::round( $s_p );
    
            echo '<span class="onsale ' . esc_attr($flash_slae_position) . '">' . esc_html($sale_price) . esc_html__( '% OFF', 'shopengine' ) . '</span>';
        }
	}

} // flash sale end


wc_get_template('single-product/product-image.php');
