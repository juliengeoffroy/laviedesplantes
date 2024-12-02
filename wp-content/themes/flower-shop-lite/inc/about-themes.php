<?php
//about theme info
add_action( 'admin_menu', 'flower_shop_lite_abouttheme' );
function flower_shop_lite_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'flower-shop-lite'), esc_html__('About Theme', 'flower-shop-lite'), 'edit_theme_options', 'flower_shop_lite_guide', 'flower_shop_lite_mostrar_guide');   
} 

//guidline for about theme
function flower_shop_lite_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_attr_e('Theme Information', 'flower-shop-lite'); ?>
		   </div>
          <p><?php esc_html_e('SKT Flower Shop is a store, online shop, digital and eCommerce WordPress theme developed using WooCommerce and is translation ready and multilingual friendly. It is multipurpose template and comes with a ready to import Elementor template plugin as add on which allows to import 63+ design templates for making use in home and other inner pages. Use it to create any type of business, personal, blog and eCommerce website. It is fast, flexible, simple and fully customizable. WooCommerce ready designs.','flower-shop-lite'); ?></p>
		  <a href="<?php echo esc_url(FLOWER_SHOP_LITE_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(FLOWER_SHOP_LITE_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'flower-shop-lite'); ?></a> | 
				<a href="<?php echo esc_url(FLOWER_SHOP_LITE_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'flower-shop-lite'); ?></a> | 
				<a href="<?php echo esc_url(FLOWER_SHOP_LITE_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'flower-shop-lite'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(FLOWER_SHOP_LITE_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>