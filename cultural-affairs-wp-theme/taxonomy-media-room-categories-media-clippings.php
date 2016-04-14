<?php
	$the_key = 'date';  // The meta key to sort on
	$args = array(
    'meta_key' => $the_key,
    'orderby' => 'meta_value'
    );
	global $wp_query;
	query_posts(array_merge($wp_query->query,$args));
?>
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>

<div class="row">
  <div class="col-md-8">
    <?php 
    $nav_args =  array(
      'prev_text'          => __( '<span>«</span>Previous Page' ),
      'next_text'          => __( 'Next Page<span>»</span>' ),
      'screen_reader_text' => __( 'Posts navigation' ),
      );
    the_posts_navigation($nav_args); 
    ?>
  </div>
</div>
