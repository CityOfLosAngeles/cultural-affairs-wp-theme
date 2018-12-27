<div class="container">
	<div class="row" id="program-list">
	<?php
		$args = array(
			'post_type' => 'program_initiative',
			'orderby' => 'menu_order',
			'posts_per_page' => -1
			);

		$poststeam = new WP_Query($args);
		if($poststeam->have_posts()){$i = 0;
			$gallery_tabs = '';
			$gallery_content = '';
			
			while($poststeam->have_posts()) {
				$poststeam->the_post(); 

				?>
				
					<div class="col-xs-12 col-sm-4 program">
						<div class="program-initiative-box">
						<a href="<?php the_permalink() ?>">
						<div class="program-initiative-img">
							<?php 
								if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
									the_post_thumbnail();
								} 
							?>
						</div>
						<h2><?php the_title() ?></h2>
						</a>
						<div class="short-description"><?= wp_trim_excerpt( get_field('short_description') ) ?></div>
						<a class="btn btn-md" href="<?php the_permalink() ?>">More</a>
					</div>
				</div>
				<?php
			}
			wp_reset_postdata();
		}
	?>
	</div>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
</div>