<!-- Percent for public art project list template -->
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page-ppart-projects'); ?>
<?php endwhile; ?>
