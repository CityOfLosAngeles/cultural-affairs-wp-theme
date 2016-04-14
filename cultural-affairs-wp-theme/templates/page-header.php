<?php use Roots\Sage\Titles; ?>
<?php if (!is_post_type_archive('tribe_events') && !is_search()) { ?>
<div class="page-header">
	<h1><?= Titles\title(); ?></h1>
</div>
<?php }elseif (is_search()) {
	global $wp_query;
	?>
	<?php if (!have_posts()) : ?>
	<div class="page-header">
		<h1>WE COULD NOT LOCATE YOUR ZIP CODE</h1>
		<p>If you live in the City of Los Angeles, please try to enter your zip code again. If you still have a problem, click the Council Districts Directory below.</p>
	</div>
	<?php else: ?>
		<div class="page-header">
			<h1>YOUR ZIP CODE WAS FOUND IN <?= $wp_query->found_posts ?> COUNCIL DISTRICT<?php if($wp_query->found_posts > 1) { ?>S<?php } ?></h1>
			<p>Please check the maps below and click on the one where you live to discover DCA activities happening in your neighborhood.</p>
		</div>
	<?php endif; ?>
<?php } ?>

