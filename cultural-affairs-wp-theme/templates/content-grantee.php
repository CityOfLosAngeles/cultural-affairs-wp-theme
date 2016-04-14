<div class="container">
	<div class="row"  id="grantee-list">
		<?php
		$args = array(
			'post_type' => 'grantee',
			'orderby' => 'menu_order',
			'posts_per_page' => -1
			);
		$poststeam = new WP_Query($args);
		if($poststeam->have_posts()){
			$gallery_tabs = '';
			$gallery_content = '';
			while($poststeam->have_posts()) {
				$poststeam->the_post(); 
				?>
				<div class="col-xs-12 col-sm-3 grantee">
					<div class="grantee-box">
						<a href="<?php the_permalink() ?>">
							<div class="grantee-img">
								<?php 
								if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
									the_post_thumbnail();
								} 
								?>
							</div>
							
							<h2><?php the_title() ?></h2>
							<div class="short-description"><?= wp_trim_excerpt( get_field('short_description') ) ?></div>
						</a>
					</div>
				</div>
				<?php
			}
			wp_reset_postdata();
		}
		?>
	</div>
</div>
