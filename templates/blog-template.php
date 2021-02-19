<?php
/**
 * Template Name: Blog Template
 * Template Post Type: post
 * 
 * @package _s
 */

get_header();
?>

<?php
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1; // get current page number
$args = array(
	'posts_per_page' => get_option('posts_per_page'), // the value from Settings > Reading by default
	'paged'          => $current_page // current page
);
query_posts( $args );
 
$wp_query->is_archive = true;
$wp_query->is_home = false;
?>

<main id="primary" class="site-main" role="main">
  <div class="blog row">
    <?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
      <div class="col-lg-9 ">
        <div class="row">
          <?php while(have_posts()): the_post(); ?>
          <div class="col-lg-6 col-md-6">
            <?php get_template_part( 'template-parts/content', 'blog' ); ?>
          </div>
          <?php endwhile; ?>
        </div>
      </div>
      <div class="col-lg-3 d-none d-lg-block">
        <aside id="secondary" class="widget-area" role="complementary">
          <?php dynamic_sidebar( 'sidebar-blog' ); ?>
        </aside><!-- #secondary -->
      </div>
    <?php else : ?>
      <?php while(have_posts()): the_post(); ?>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="blog-post">
          <?php the_post_thumbnail( $post->ID, 'large' ); ?>
          <?php the_title( '<h2 class="entry-title h5"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
          <div class="entry-content">
            <?php the_excerpt(); ?>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>

  <?php the_posts_navigation(); ?>
  <?php if( function_exists('wp_pagenavi') ) wp_pagenavi(); // WP-PageNavi function ?>
  
</main><!-- #main -->

<?php
get_footer();
