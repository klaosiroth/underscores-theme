<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

$hidder_attr = '';
if($hidden) {
    $hidder_attr = 'style="display:none;"';
}

?>
<div class="vc_row">
	<div class="vc_col-lg-8 vc_col-lg-push-2 vc_col-md-10 vc_col-md-push-1 vc_col-xs-12 vc_checkout_col">
		<form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo wp_kses($hidder_attr, 'default') ?>>

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<?php
            if ( $message ) {
                wpautop(wptexturize($message));
            } ?>

			<p class="form-row form-row-first">
				<label for="username"><?php esc_html_e( 'Username or email', 'stockie' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="input-text" name="username" id="username" autocomplete="username" />
			</p>
			<p class="form-row form-row-last">
				<label for="password"><?php esc_html_e( 'Password', 'stockie' ); ?>&nbsp;<span class="required">*</span></label>
				<input class="input-text" type="password" name="password" id="password" autocomplete="current-password" />
			</p>
			<div class="clear"></div>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'stockie' ); ?></span>
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Login', 'stockie' ); ?>"><?php esc_html_e( 'Login', 'stockie' ); ?></button>
			</p>
			<p class="lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'stockie' ); ?></a>
			</p>

			<div class="clear"></div>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
	</div>
</div>