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
	<div class="card border-0">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_post_thumbnail( $post->ID, 'large' ); ?>
			</a>
		<?php endif; ?>

		<div class="card-body">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title h5"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php
						// _s_posted_on();
						// _s_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>

				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php // _s_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .card-body -->
	</div><!-- .card -->
</article><!-- #post-<?php the_ID(); ?> -->