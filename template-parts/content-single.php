<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row justify-content-center">
		<div class="col-lg-8 col-md-12 col-12 mb-2">
			<header class="entry-header has-text-align-center">
				<?php
        /**
         * Filter the display of the categories in the entry header.
         */
        $show_categories = apply_filters( 'show_categories_in_entry_header', true );
        ?>
        <?php if ( true === $show_categories && has_category() ) : ?>
          <div class="entry-categories mb-4">
						<?php the_category( ' ' ); ?>
          </div><!-- .entry-categories -->
        <?php endif; ?>
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title mb-4">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta mb-4">
						<?php
						_s_posted_on();
						_s_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
		</div>

		<?php if  ( has_post_thumbnail() ) : ?>
      <div class="col-lg-10 col-md-12 col-12 mb-4">
        <div class="post-thumbnail">
          <?php the_post_thumbnail('full', ['class' => 'img-fluid rounded-lg', 'title' => 'Feature image']); ?>
        </div>
			</div>
    <?php else : ?>
			<div class="col-lg-10 col-md-12 col-12 mb-4">
        <div class="post-thumbnail__placeholder no-post-thumbnail">
          <img src="https://via.placeholder.com/1200x628" alt="Placeholder image">
        </div>
      </div>
    <?php endif; ?><!-- .post-thumbnail -->

		<div class="col-lg-8 col-md-12 col-12 mb-2">
			<div class="entry-content">
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', '_s' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->
		
			<footer class="entry-footer">
				<?php _s_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div>
	</div><!-- .row -->
</article><!-- #post-<?php the_ID(); ?> -->
