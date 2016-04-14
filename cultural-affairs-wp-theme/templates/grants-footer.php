<?php
$args = array(
	'post_type' => 'grant_and_call',
	'posts_per_page' => -1,
	'order' => 'DESC',
	'meta_key'		=> 'featured_grant',
	'meta_value'	=> true
	);
$poststeam = new WP_Query($args);
if($poststeam->have_posts()){
	$ct = 0;
	?>
	<div class="grants-footer">
		<div class="container">
			<div class="row">
				<h1><?= __('DCA GRANTS', 'sage'); ?></h1>
				<p class="intro">DCA currently offers three grant opportunities annually to artists and organizations.</p>
				<div class="row">
					<?php
					while($poststeam->have_posts()) {
						$poststeam->the_post(); 
						?>
						<div class="col-md-3 item <?php if($ct == $poststeam->found_posts) { ?>last-item<?php } ?>">
							<a href="<?= get_permalink() ?>" title="<?= get_the_title() ?>">
								<?php
								$icon = get_field('featured_icon');
								if( !empty($icon) ): ?>
								<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" class="thumb" />
								<?php else: ?>
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/general/icon_placeholder_black@2x.png" class="thumb" />
							<?php endif; ?>
							<h2><?= get_the_title() ?></h2>
						</a>
					</div>
					<?php
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
