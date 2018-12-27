<?php use Roots\Sage\Titles; ?>
<div class="container tight">
	<div class="page-header">
		<h1><?= get_field('g&c_title','options') ?></h1>
		<p><?= get_field('g&c_description','options') ?></p>
	</div>
</div>


<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>


<?php the_posts_navigation(); ?>
