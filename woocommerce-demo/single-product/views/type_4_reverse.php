<?php
// GLOBALS
$shop_page_id = wc_get_page_id( 'shop' );

global $post;
global $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( has_post_thumbnail() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );

$zoom = StockieSettings::get( 'woocommerce_product_images_zoom', 'global' );

// SLIDER
function get_slides($size = 'shop_single', $zoom = true) {
    global $post;
    global $product;
    $allowed_html = array(
        'div' => array(
            'class' =>true
        ),
        'img' => array(
            'class' => true,
            'src' => true,
            'alt'=> true
        )
    );
    $with_zoom_class = '';
    if ($zoom) {
        $with_zoom_class = ' with-zoom';
    }

    $html = '<div class="image-wrap woocommerce-product-gallery__image'.esc_attr($with_zoom_class).'"><img class="gimg wp-post-image" src="'.wp_get_attachment_image_url( $product->get_image_id(), $size ).'" alt="'.esc_attr($post->post_title).'"></div>';
    $attachment_ids = $product->get_gallery_image_ids();
    $image_class = '';
    $loop = 1;
    foreach ( $attachment_ids as $attachment_id ) {
        $classes = array( 'zoom' );
        $image_class = implode( ' ', $classes );
        $props       = wc_get_product_attachment_props( $attachment_id, $post );
        if ( ! $props['url'] ) {
            continue;
        }
        $html .= '<div class="image-wrap woocommerce-product-gallery__image'.esc_attr($with_zoom_class).'"><img class="gimg wp-post-image" src="'.esc_url( wp_get_attachment_image_url( $attachment_id, $size )).'" alt="'.esc_attr($post->post_title).'"></div>';
        $loop++;
    }
    echo wp_kses( $html, $allowed_html);
}
?>
<div class="page-container full">

    <?php wc_get_template_part("single-product/sticky", "product") ?>

    <div class="vc_row product-type-1-reverse">
    	<div class="vc_col-lg-4 vc_col-md-6 vc_col-sm-12 woo_c-product-details">
    		<div class="summary entry-summary woo_c-product-details-inner">

                <!-- Breadcrumbs -->
                <?php wc_get_template_part("single-product/views/breadcrumbs") ?>
                
    			<div class="woo-summary-content">
    				<div class="wrap"><!-- For scroll -->
    					<?php
    					do_action( 'woocommerce_before_main_content' );
    					do_action( 'woocommerce_single_product_summary' );
    					?>
    					</div><!--.site-container-->
    				</div><!--.wrap-->
    			</div><!--.woo-summary-content-->
    			<?php
                    $hide_sharing = StockieSettings::get( 'woocommerce_sharing', 'global' );
    				if ( !$hide_sharing ) {
    					do_shortcode( '[stockie_share_woo]' );
    				}
    			?>
    		</div><!--.summary-->
    	</div><!--.woo_c-product-details-->
    	<div class="vc_col-lg-8 vc_col-md-6 vc_col-sm-12 woo_c-product-image">
            <div class="woo_c-product-image-slider container-loading">
                <?php wc_get_template_part('single-product/sale', 'stick'); ?>
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="product_images <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
                        <?php get_slides('shop_single', $zoom); ?>
                    </div>
                    <?php
                } else {
                    echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'stockie' ) ), $post->ID );
                } ?>
                <div class="numbers_slides">

                </div>
            </div>
    	</div>
    </div>

    <?php wc_get_template_part('single-product/tabs/tabs'); ?>
    <?php
    woocommerce_upsell_display();
    woocommerce_related_products( $product->get_id(), 4 );
    ?>
</div>
