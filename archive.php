<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

get_header();

$description = get_the_archive_description();
?>

<?php if ( have_posts() ) : ?>

<header class="page-header">
	<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
	<?php if ( $description ) : ?>
		<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
	<?php endif; ?>
	<?php
		// the_archive_title( '<h1 class="page-title">', '</h1>' );
		// the_archive_description( '<div class="archive-description">', '</div>' );
	?>
</header><!-- .page-header -->

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
	<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>

<?php else : ?>
<?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
