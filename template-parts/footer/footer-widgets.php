<?php
/**
 * Displays the footer widget area.
 *
 * @package WordPress
 * @subpackage _s
 * @since _s 1.0
 */
$footer_widgets_count = 0;
if ( is_active_sidebar( 'sidebar-footer-1' ) ) { $footer_widgets_count++; }
if ( is_active_sidebar( 'sidebar-footer-2' ) ) { $footer_widgets_count++; }
if ( is_active_sidebar( 'sidebar-footer-3' ) ) { $footer_widgets_count++; }
if ( is_active_sidebar( 'sidebar-footer-4' ) ) { $footer_widgets_count++; }
if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

	<aside class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- .widget-area -->

<?php endif; ?>

<?php if ( $footer_widgets_count > 0 && $footer_widgets_count <= 4 ) : ?>
  <div class="container">
    <div class="row">
      <?php if ( is_active_sidebar('sidebar-footer-1') ) : ?>
        <div class="col-lg-<?php echo esc_attr( intval( 12 / $footer_widgets_count ) ); ?> col-sm-6 widgets-column">
          <ul><?php dynamic_sidebar( 'sidebar-footer-1' ); ?></ul>
        </div>
      <?php endif; ?>

      <?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) : ?>
        <div class="col-lg-<?php echo esc_attr( intval( 12 / $footer_widgets_count ) ); ?> col-sm-6 widgets-column">
          <ul><?php dynamic_sidebar( 'sidebar-footer-2' ); ?></ul>
        </div>
      <?php endif; ?>

      <?php if ( is_active_sidebar('sidebar-footer-3') ) : ?>
        <div class="col-lg-<?php echo esc_attr( intval( 12 / $footer_widgets_count ) ); ?> col-sm-6 widgets-column">
          <ul><?php dynamic_sidebar( 'sidebar-footer-3' ); ?></ul>
        </div>
      <?php endif; ?>

      <?php if ( is_active_sidebar('sidebar-footer-4') ) : ?>
        <div class="col-lg-<?php echo esc_attr( intval( 12 / $footer_widgets_count ) ); ?> col-sm-6 widgets-column">
          <ul><?php dynamic_sidebar( 'sidebar-footer-4' ); ?></ul>
        </div>
      <?php endif; ?>
      <div class="clear"></div>
    </div><!-- .row -->
  </div><!-- .container -->
<?php endif; ?>
