<?php use Roots\Sage\Titles; ?>
<div class="page-header">
	<h1>Selected Grantees</h1>
	<p>Learn more about some of DCA’s current grantees.</p>
</div>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
