<div class="container">
	<div class="row" id="council-district-list">
		<?php
		$args = array(
			'post_type' => 'council_district',
			'orderby' => 'date',
			'order' => 'ASC',
			'posts_per_page' => -1
			);
		$poststeam = new WP_Query($args);
		if($poststeam->have_posts()){
			$gallery_tabs = '';
			$gallery_content = '';
			while($poststeam->have_posts()) {
				$poststeam->the_post(); 
				?>
				<div class="col-xs-12 col-sm-3 district">
					<div class="district-box">
						<a href="<?php the_permalink() ?>">
							<div class="district-img">
								<?php 
			                    if ( has_post_thumbnail( ) ) { // check if the post has a Post Thumbnail assigned to it.
			                    	echo get_the_post_thumbnail();
			                    } 
			                    ?>
			                </div>

			                <h2><?php the_title() ?></h2>
			                <div class="short-description"><?php the_excerpt(); ?></div>
			            </a>
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
