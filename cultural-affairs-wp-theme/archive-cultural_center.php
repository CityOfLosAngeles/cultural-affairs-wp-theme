<?php use Roots\Sage\Titles; ?>
<div class="page-header">
	<h1><?= Titles\title(); ?></h1>
	<p>The DCA Community Arts Division fosters the arts through numerous Cultural Centers and theaters which you can explore here.</p>
</div>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
