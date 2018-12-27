<div class="intro">Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</div>
	<div class="row public-art-projects-list">
	<?php
		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

		$args = array(
            'post_type' => 'artists-projects',
            'posts_per_page' => 20,
            'order' => 'DESC',
            'paged' => $paged,
            'taxonomy'=>'artist-project-type',
            'term'=> '	percent-for-public-arts',
          );

		$poststeam = new WP_Query($args);
		if($poststeam->have_posts()){$i = 0;
			$gallery_tabs = '';
			$gallery_content = '';
			
			while($poststeam->have_posts()) {
				$poststeam->the_post(); 

				?>
				
					<div class="col-xs-12 col-sm-3 project">
						<div class="projects-box">
						<a href="<?php the_permalink() ?>">
							<div class="projects-img">
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