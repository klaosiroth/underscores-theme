<?php
/**
 * Enqueue scripts and styles for the customizer.
 */
function enqueue_styles_scripts() {
	// Custom main styles.
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/main.css', array( 'bootstrap-style' ), wp_get_theme()->get( 'Version' ) );

	// Custom main scripts.
  wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/main.js', array(), wp_get_theme()->get( 'Version' ), true );

	// Register the bootstrap styles.
	wp_register_style( 'bootstrap-style', get_template_directory_uri() . '/assets/vendor/bootstrap/bootstrap.min.css', false, '4.6.0' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_styles_scripts' );

/**
 * Filter the excerpt length to 60 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
// add_filter( 'excerpt_length', function( $length ) { return 60; }, 999 );
function set_exception_length() {
	return 60;
}
add_filter( 'excerpt_length', 'set_exception_length' );

add_action('wp_head', function() { ?>
  <link rel="preconnect" href="https://fonts.gstatic.com">
<?php });

// add_filter( 'wp_trim_excerpt', 'set_all_excerpts_get_more_link' );

// if ( ! function_exists( 'set_all_excerpts_get_more_link' ) ) {
// 	/**
// 	 * Adds a custom read more link to all excerpts, manually or automatically generated
// 	 *
// 	 * @param string $post_excerpt Posts's excerpt.
// 	 *
// 	 * @return string
// 	 */
// 	function set_all_excerpts_get_more_link( $post_excerpt ) {
// 		if ( ! is_admin() ) {
// 			$post_excerpt = $post_excerpt . '<div><a class="btn read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __(
// 				'อ่านเพิ่มเติม',
// 				'_s'
// 			) . '</a></div>';
// 		}
// 		return $post_excerpt;
// 	}
// }

/**
 * Register widget area for the customizer.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _s_widgets_custom() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog', '_s' ),
			'id'            => 'sidebar-blog',
			'description'   => esc_html__( 'Add widgets here to appear in your blog.', '_s' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 1', '_s' ),
			'id'            => 'sidebar-footer-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', '_s' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 2', '_s' ),
			'id'            => 'sidebar-footer-2',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', '_s' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 3', '_s' ),
			'id'            => 'sidebar-footer-3',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', '_s' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer column 4', '_s' ),
			'id'            => 'sidebar-footer-4',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', '_s' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', '_s_widgets_custom' );

/**
 * -------------------------------------------------
 * WooCommerce
 * -------------------------------------------------
 */
// Remove WooCommerce Styles.
// add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Remove Shop Title.
// add_filter( 'woocommerce_shop_page_title', '__return_false' );

// Remove Showing all X results from WooCommerce Shop & Archive Pages.
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// Remove Sorting drop down menu from WooCommerce Shop & Archive Pages.
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/**
 * Customize the WooCommerce breadcrumb.
 * 
 * @link https://docs.woocommerce.com/document/customise-the-woocommerce-breadcrumb/
 */
// Remove the breadcrumbs.
// remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

/**
 * Change the breadcrumb separator
 */
// add_filter( 'woocommerce_breadcrumb_defaults', '_s_change_breadcrumb_delimiter' );
// function _s_change_breadcrumb_delimiter( $defaults ) {
// 	// Change the breadcrumb delimeter from '/' to '>'
// 	$defaults['delimiter'] = ' &gt; ';
// 	return $defaults;
// }

/**
 * Change several of the breadcrumb defaults
 */
// add_filter( 'woocommerce_breadcrumb_defaults', '_s_woocommerce_breadcrumbs' );
// function _s_woocommerce_breadcrumbs() {
// 	return array(
// 		'delimiter'   => ' &#47; ',
// 		'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
// 		'wrap_after'  => '</nav>',
// 		'before'      => '',
// 		'after'       => '',
// 		'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
// 	);
// }

/**
 * Hide WooCommerce Product Quantity Field From All Product Type
 */
function _s_remove_quantity_fields( $return, $product ) {
	return true;
}
add_filter( 'woocommerce_is_sold_individually', '_s_remove_quantity_fields', 10, 2 );


/**
 * Hide shipping rates when free shipping is available, but keep "Local pickup" 
 * Updated to support WooCommerce 2.6 Shipping Zones
 * 
 * @link https://docs.woocommerce.com/document/hide-other-shipping-methods-when-free-shipping-is-available/
 */
function hide_shipping_when_free_is_available( $rates, $package ) {
	$new_rates = array();
	foreach ( $rates as $rate_id => $rate ) {
		// Only modify rates if free_shipping is present.
		if ( 'free_shipping' === $rate->method_id ) {
			$new_rates[ $rate_id ] = $rate;
			break;
		}
	}

	if ( ! empty( $new_rates ) ) {
		//Save local pickup if it's present.
		foreach ( $rates as $rate_id => $rate ) {
			if ('local_pickup' === $rate->method_id ) {
				$new_rates[ $rate_id ] = $rate;
				break;
			}
		}
		return $new_rates;
	}

	return $rates;
}
add_filter( 'woocommerce_package_rates', 'hide_shipping_when_free_is_available', 10, 2 );

/**
 * Change a currency symbol
 * 
 * @link https://docs.woocommerce.com/document/change-a-currency-symbol/
 */
function change_existing_currency_symbol( $currency_symbol, $currency ) {
  switch( $currency ) {
    case 'THB': $currency_symbol = 'บาท'; break;
  }
  return $currency_symbol;
}
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

/**
 * Change Shop page title WooCommerce
 */
function woo_shop_page_title( $page_title ) {
	if( 'Shop' == $page_title) {
		return "Your Replacement Title Here";
	}
}
add_filter( 'woocommerce_page_title', 'woo_shop_page_title');