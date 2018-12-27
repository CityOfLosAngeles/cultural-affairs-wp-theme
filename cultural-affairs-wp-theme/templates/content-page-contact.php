<div class="contact-page">
			

<?php
	$args = array(
		'post_type' => 'contact-division',
		'orderby' => 'date',
		'posts_per_page' => -1
		);

	$poststeam = new WP_Query($args);
	if($poststeam->have_posts()){$i = 0;
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
						<div class="contact-phone"><b>Phone:</b> <?= $contact_phone; ?></div>
						<?php } ?>
						<?php if ($contact_email) { ?>
						<div class="contact-email"><b>Email:</b> <a class="warm-grey" href="mailto:<?= $contact_email; ?>"><?= $contact_email; ?></a></div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();
	}
	?>
	<?php the_content(); ?>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
</div>