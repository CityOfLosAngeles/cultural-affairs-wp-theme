<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'page-city-art-collection'); ?>
<?php endwhile; ?>
