<?php
/**
 * The template for displaying home page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

get_header();
?>

<header class="header">
  <h1><?php bloginfo('name'); ?></h1>
  <p><?php bloginfo('description'); ?></p>
  <?php
    $menu = array(
      'theme_location' => 'menu-1',
      'menu_id'        => 'primary-menu'
    );
  ?>
  <?php wp_nav_menu($menu);?>
</header>

<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <h3>
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>  
    </h3>
    <?php if ( has_post_thumbnail() ) : ?>
      <div class="post-thumbnail">
        <?php the_post_thumbnail(); ?>
      </div>
    <?php endif; ?>
    <div class="meta">
      <?php the_author(); ?> on <?php the_date(); ?>
    </div>
    <?php the_excerpt(); ?>
    <a class="btn btn-light" href="<?php the_permalink(); ?>">
      Read more
    </a>  
  <?php endwhile; ?>
<?php else : ?>
  <?php echo wpautop('Sorry, Not has post.'); ?>
<?php endif; ?>

<?php comments_template(); ?>

<?php if ( is_active_sidebar('sidebar-1') ) : ?>
  <?php dynamic_sidebar('sidebar'); ?>
<?php endif; ?>

<footer>
  <p>&copy; <?php echo get_the_date('Y'); ?> - <?php bloginfo('name'); ?></p>
</footer>

<?php
get_footer();
