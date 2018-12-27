<div class="container">
	<div class="row" id="artist-project-filter">
		<span>Show:</span>
		<ul class="filter-items">
			<li class="artist-project-filter-item active" data-page="0" data-filter-class="all">All</li>
		<?php
			// Getting all cultural center categories
			$cat_list = get_terms( 'artist-project-type');

			if ( ! empty( $cat_list ) && ! is_wp_error( $cat_list ) ){
			     foreach ( $cat_list as $cat_item ) {
			     	$cat_nicename = str_replace(" ", "-", strtolower($cat_item->name));
			     	?>
			       <li class="artist-project-filter-item" data-page="0" data-filter-class="<?= $cat_nicename ?>"><?= $cat_item->name ?></li>
			       <?php
			     }
			 }
		?>
		</ul>
	</div>
	<div class="loading-container">
	    <div class="loading-div">
	        <span class="glyphicon glyphicon-refresh spinning"></span> Loading...    
	    </div>
	</div>
	<div class="row" id="artist-project-list">
	<?php
        // Pagination
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

		$args = array(
			'post_type' => 'artists-projects',
			'order' => 'DESC',
			'posts_per_page' => 20,
            'paged' => $paged,
			);

		$poststeam = new WP_Query($args);
		if($poststeam->have_posts()){$i = 0;
			$gallery_tabs = '';
			$gallery_content = '';
			
			while($poststeam->have_posts()) {
				$poststeam->the_post(); 

				// Get post categories
				$post_cats = get_the_terms( get_the_ID(), 'artist-project-type' );
										
				if ( $post_cats && ! is_wp_error( $post_cats ) ) : 

					$post_cat_class = '';

					foreach ( $post_cats as $post_cat ) {
						$post_cat_class = str_replace(" ", "-", strtolower($post_cat->name)). ' ';
					}

				endif;
										
				?>

					<div class="col-xs-12 col-sm-4 col-md-3 artist-project <?= $post_cat_class ?>">
						<div class="artist-project-box">
							<a href="<?php the_permalink() ?>">
						      <?php 
						      $hero_image = get_the_post_thumbnail();
						      //echo $hero_image;
						      ?>
						      <div class="thumb-container"><?php echo $hero_image; ?>"</div>
								<h2><?php the_title() ?></h2>
								
							</a>
						</div>
					</div>
          <?php if ($poststeam->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
            <nav class="more-nav">
              <div class="more-nav-container">
                <button data-page="<?php echo $paged ?>" data-filter-class="all" class="load-more-btn btn btn-lg btn-more">Load More</button>
              </div>
            </nav>
          <?php 
          		}
			}
			wp_reset_postdata();
		}
	?>
	</div>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
</div>