<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?>
				</div><!-- .container -->
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->

	<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="powered-by">
				<?php
				printf(
					/* translators: %s: CMS name, i.e. WordPress. */
					esc_html__( 'Proudly powered by %s.', '_s' ),
					'<a href="' . esc_url( __( 'https://wordpress.org/', '_s' ) ) . '">WordPress</a>'
				);
				?>
				<span class="sep"> | </span>
				<?php
				printf(
					/* translators: 1: Theme name, 2: Theme author. */
					esc_html__( 'Theme: %1$s by %2$s.', '_s' ),
					'_s',
					'<a href="https://www.klaosiroth.com">Natthaphon Wichianphong</a>'
				);
				?>
			</div><!-- .powered-by -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
