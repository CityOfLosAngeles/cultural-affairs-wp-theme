<?php use Roots\Sage\Titles; ?>
<div class="container tight">
	<div class="page-header">
		<h1><?= Titles\title(); ?></h1>
		<p>We welcome artists and arts organizations to participate in the following competitive opportunities such as grants and calls for entries.</p>
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
