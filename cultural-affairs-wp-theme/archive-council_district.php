<?php use Roots\Sage\Titles; ?>
<div class="col-xs-12">
	<div class="page-header">
		<h1>CITY OF LOS ANGELES COUNCIL DISTRICTS</h1>
		<p>Discover LA&tilde;s Council Districts and diverse neighborhoods.</p>
	</div>
</div>

<?php if (!have_posts()) : ?>
	<div class="alert alert-warning">
		<?php _e('Sorry, no results were found.', 'sage'); ?>
	</div>
	<?php get_search_form(); ?>
<?php endif; ?>

<?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
