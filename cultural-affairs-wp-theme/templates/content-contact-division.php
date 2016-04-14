<div class="contact-page">
	<div class="intro-message">
		<p>You&tilde;re visiting the new <a href="http://culturela.org" title="culturela.org">culturela.org</a>. Help us develop our site by sharing your feedback. Email: <a target="_blank" href="mailto:DCA.website@lacity.org" title="DCA.website@lacity.org">DCA.website@lacity.org</a>.</p>
		<p>Visit our <a href="/dca-staff-listing/">staff listing</a> for specific contact information.</p>
	</div>
	<?php
	$args = array(
		'post_type' => 'contact-division',
		'orderby' => 'date',
		'posts_per_page' => -1
		);
	$poststeam = new WP_Query($args);
	if($poststeam->have_posts()){
		$gallery_tabs = '';
		$gallery_content = '';
		while($poststeam->have_posts()) {
			$poststeam->the_post(); 
			$contact_phone = get_field ('phone');
			$contact_email = get_field ('email');
			?>
			<div class="single-division">
				<div class="row">
					<div class="col-xs-12">
						<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
						<?php the_content(); ?>
						<?php if ($contact_phone) { ?>
						<div class="contact-phone">Phone: <?= $contact_phone; ?></div>
						<?php } ?>
						<?php if ($contact_email) { ?>
						<div class="contact-email">Email: <a class="warm-grey" href="mailto:<?= $contact_email; ?>"><?= $contact_email; ?></a></div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();
	}
	?>
	<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
</div>
