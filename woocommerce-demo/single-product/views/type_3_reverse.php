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
$allowed_html = array(
    'div' => array(
        'class' =>true,
        'data-gallery-item'=>true,
        'data-lazy-item'=> true,
        'data-lazy-scope' => 'products'
    ),
    'i' => array(
        'class' =>true
    ),
    'img' => array(
        'class' => true,
        'src' => true,
        'alt'=> true
    )
);

$zoom = StockieSettings::get( 'woocommerce_product_images_zoom', 'global' );

$with_zoom_class = '';
if ($zoom) {
    $with_zoom_class = ' with-zoom';
}

?>

<div class="page-container" id="scroll-product">

    <?php wc_get_template_part("single-product/sticky", "product") ?>

    <div class="vc_row">
    	<div class="vc_col-md-6 vc_col-sm-12 woo_c-product-details" >
    		<div class="summary entry-summary woo_c-product-details-inner" data-stockie-content-scroll="#scroll-product">

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
    	</div><!--.woo-single-summary-wrap-->
        <div class="vc_col-md-6 vc_col-sm-12 product-images woo_c-product-image">
            <div class="woo_c-product-images stockie-gallery-sc gallery-wrap" data-gallery="stockie-custom-<?php echo  esc_attr($product->get_id()) ?>">
                <?php wc_get_template_part('single-product/sale', 'stick'); ?>
                <div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
                    <?php
                    $is_lightbox = StockieSettings::show_product_lightbox();
                    $lightbox = $is_lightbox ? '<div class="woo_c-product-image-slider-trigger btn-round grid-item gallery-image" data-gallery-item="0" data-lazy-item="" data-lazy-scope="products"><i class="ion ion-md-expand"></i></div>': '';
                    if ( has_post_thumbnail() ) {
                        $html = '<div class="image-wrap woocommerce-product-gallery__image'.esc_attr($with_zoom_class).'" style="position:relative">'.$lightbox.'<img class="gimg wp-post-image" src="'.wp_get_attachment_image_url( $product->get_image_id(), 'shop_single' ).'" alt="'.esc_attr($post->post_title).'"></div>';
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
                            $html .= '<div class="image-wrap woocommerce-product-gallery__image'.esc_attr($with_zoom_class).'"><div class="grid-item gallery-image" data-gallery-item="'.$loop.'" data-lazy-item="" data-lazy-scope="products"></div><img class="gimg" src="'.wp_get_attachment_image_url( $attachment_id, 'shop_single' ).'" alt="'.esc_attr($post->post_title).'"></div>';
                            $loop++;
                        }
                        echo wp_kses( $html, $allowed_html);
                    } else {
                        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'stockie' ) ), $post->ID );
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
wc_get_template_part( 'single-product/tabs/tabs' );
woocommerce_upsell_display();
woocommerce_related_products( $product->get_id(), 4 );
function add_gallery_to_footer() {
    global $product;
    echo '
    <div class="stockie-gallery-opened-sc gallery-lightbox" id="stockie-custom-'.$product->get_id().'" data-options="{&quot;navClass&quot;:&quot;&quot;}">
        <div class="expand btn-round">
            <i class="ion ion-md-expand"></i>
        </div>
        <div class="close btn-round">
            <i class="ion ion-md-close"></i>
        </div>
    </div>
    ';
}
add_action( 'wp_footer', 'add_gallery_to_footer', 100 );
