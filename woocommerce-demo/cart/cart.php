<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

do_action( 'woocommerce_before_cart' ); ?>

<div class="vc_row woo-c">

	<div class="vc_col-lg-8 vc_col-lg-push-2 vc_col-md-10 vc_col-md-push-1 page-offset-top page-offset-bottom page-with-right-sidebar">
		<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>
			
			<?php wc_print_notices(); ?>

			<div class="woo-c_cart_table cart shop_table shop_table_responsive cart woocommerce-cart-form__contents">
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>
					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'woo-c_cart_table_item', $cart_item, $cart_item_key ) ); ?>">

								<div class="woo-c_cart_table_item_thumbnail">
									<?php
										$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
										if ( ! $product_permalink ) {
											echo wp_kses( $thumbnail, 'post' );
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses( $thumbnail, 'post' ) );
										}
									?>
								</div>

								<div class="woo-c_cart_table_details">
									<div class="woo-c_cart_table_item_name" data-title="<?php esc_html_e( 'Product', 'stockie' ); ?>">
										<div class="woo-c_product">
											<?php
												if ( ! $product_permalink ) {
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
												} else {
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
												}
												do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
												echo wc_get_formatted_cart_item_data( $cart_item );
												// Meta data

												// Backorder notification
												if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
													echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'stockie' ) . '</p>';
												}
											?>
										</div>
									</div>

									<div class="woo-c_cart_table_item_values">
										<?php
										$attributes = $cart_item['variation'];
										$i = 0;

										if ( is_array($attributes) || is_object($attributes) ) {
											foreach ($attributes as $key => $value) {
												$key = str_replace('attribute_', '', $key);
												$sep = '';
												if ($i != 0) {
													$sep = ', ';
												}
												?>
												<p class="<?php echo esc_attr(urldecode(strtolower(wc_attribute_label($key)))); ?>"><?php echo esc_html($sep); ?><?php echo esc_html(urldecode(wc_attribute_label($key))); ?>: <span><?php echo esc_html($value); ?></span></p>
											<?php
											$i++;
											} 
										}?>
									</div>

									<div class="woo-c_cart_table_item_colors">

										<?php
										if ( is_array($attributes) || is_object($attributes) ) {
											foreach ($attributes as $attribute_name => $option) {
												$attribute_name = str_replace('attribute_', '', $attribute_name);
												$term = get_term_by('slug', $option, $attribute_name);
												if (get_field('color', $term)) { ?>
													<span class="circle" style="background-color:<?php echo esc_attr( get_field('color', $term) ); ?>"></span>
												<?php }
											}
										}
      								?>
									</div>
									<div class="woo-c_cart_table_item_price price-value" data-title="<?php esc_html_e( 'Price', 'stockie' ); ?>">
										<?php
											echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
										?>
									</div>

									<div class="woo-c_cart_table_item_quantity" data-title="<?php esc_html_e( 'Quantity', 'stockie' ); ?>">
										<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
											} else {
												$product_quantity = woocommerce_quantity_input( array(
													'input_name'  => "cart[{$cart_item_key}][qty]",
													'input_value' => $cart_item['quantity'],
													'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
													'min_value'   => '0'
												), $_product, false );
											}

											echo '<div class="qty_label">' . _e( 'QTY:', 'stockie' ) . '</div>&nbsp;';
											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
										?>
									</div>

									<div class="woo-c_cart_table_item_subtotal" data-title="<?php esc_html_e( 'Total', 'stockie' ); ?>">
										<?php
											echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
										?>
									</div>

									<div class="woo-c_cart_table_item_remove">
										<?php
											echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
												'<a href="%s" class="remove-link" title="%s"><i class="ion ion-md-close"></i></a>',
												esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
												esc_html__( 'Remove this item', 'stockie' ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											), $cart_item_key );
										?>
									</div>
								</div>
							</div>
							<?php
						}
					}
				do_action( 'woocommerce_cart_contents' ); ?>
			</div>
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
			<div class="woo-c_actions actions">
				<div class="vc_row">
					<div class="vc_col-md-8">
						<?php if ( wc_coupons_enabled() ) { ?>
							<fieldset class="woo-c_actions_coupon">
								<label for="coupon_code" class="field-label"><?php esc_html_e( 'Coupon code', 'stockie' ); ?></label>
								<input type="text" name="coupon_code" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter coupon code', 'stockie' ); ?>" />
								<button type="submit" class="btn" name="apply_coupon"><?php esc_attr_e( 'Apply Coupon', 'stockie' ); ?></button>
								<!-- <input type="submit" class="btn" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'stockie' ); ?>" /> -->
								<?php do_action( 'woocommerce_cart_coupon' ); ?>
							</fieldset>
						<?php } ?>
					</div>

					<div class="vc_col-md-4 text-right">
						<!-- <fieldset class="without-label"> -->

							<!-- Add class btn-loading to init preloader -->
							<button type="submit" class="btn update-cart" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'stockie' ); ?>"><?php esc_attr_e( 'Update Cart', 'stockie' ); ?></button>

						<!-- </fieldset> -->
						<?php do_action( 'woocommerce_cart_actions' ); ?>
						<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

						<?php do_action( 'woocommerce_after_cart_contents' ); ?>
					</div>
				</div>
			</div>
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>
	</div>
</div>

<div class="vc_row woo-c">
	<div class="vc_col-lg-8 vc_col-lg-push-2 vc_col-md-10 vc_col-md-push-1 page-offset-top">
		<div class="woo-c_cart_collaterals cart-collaterals">
			<?php do_action( 'woocommerce_cart_collaterals' ); ?>
		</div>
	</div>

</div><!--.woo-c-->

<?php do_action( 'woocommerce_after_cart' ); ?>

<?php //do_action( 'woocommerce_before_checkout_shipping_form' ); ?>