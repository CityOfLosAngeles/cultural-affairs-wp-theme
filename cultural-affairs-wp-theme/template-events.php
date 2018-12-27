<?php
/**
 * Template Name: Events Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'events-header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
