<div class="container">
	<div class="row" id="cultural-center-filter">
		<span>Show:</span>
		<ul class="filter-items">
			<li class="cultural-center-filter-item active" data-page="0" data-filter-class="all">All</li>
			<?php
			// Getting all cultural center categories
			$cat_list = get_terms( 'cultural-center-categories');

			if ( ! empty( $cat_list ) && ! is_wp_error( $cat_list ) ){
				foreach ( $cat_list as $cat_item ) {
					$cat_nicename = str_replace(" ", "-", strtolower($cat_item->name));
					?>
					<li class="cultural-center-filter-item" data-page="0" data-filter-class="<?= $cat_nicename ?>"><?= $cat_item->name ?></li>
					<?php
				}
			}
			?>
		</ul>
		<div id="classes-filter">
			<span class="filter-label">Art Classes Available (Off)</span>
			<div class="onoffswitch">
				<input type="checkbox" name="art-class-switch" data-page="0" data-filter-class="all" class="onoffswitch-checkbox" id="art-class-switch">
				<label class="onoffswitch-label" for="art-class-switch"></label>
			</div>
		</div>
	</div>
	<div class="loading-container">
		<div class="loading-div">
			<span class="glyphicon glyphicon-refresh spinning"></span> Loading...    
		</div>
	</div>
	<?php
        // Pagination
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

	$args = array(
		'post_type' => 'cultural_center',
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page' => 20,
		'paged' => $paged,
		);

	$poststeam = new WP_Query($args);

	if($poststeam->have_posts()){
		$gallery_tabs = '';
		$gallery_content = '';
		?>
		<div class="row" id="cultural-center-list">
			<?php
			while($poststeam->have_posts()) {
				$poststeam->the_post(); 
				// Get post categories
				$post_cats = get_the_terms( get_the_ID(), 'cultural-center-categories' );

				if ( $post_cats && ! is_wp_error( $post_cats ) ) : 

					$post_cat_class = '';

				foreach ( $post_cats as $post_cat ) {
					$post_cat_class = str_replace(" ", "-", strtolower($post_cat->name)). ' ';
				}

				endif;

				?>

				<div class="col-xs-12 col-sm-4 col-md-3 cultural-center <?= $post_cat_class ?>">
					<div class="cultural-center-box">
						<a href="<?php the_permalink() ?>">
							<?php 
							$hero_image = get_field('hero_image');
							$thumb_image = get_field('thumbnail_image');
							$display_image = "";

							if($thumb_image) {
								$display_image = $thumb_image;
							} else {
								$display_image = $hero_image['url'];
							}
							?>
							<div class="thumb-container"><img src="<?php echo $display_image; ?>" /></div>
							<h2><?php the_title() ?></h2>
							<?php if(get_field('art_classes_available')): ?>
							<span class="art-classes"><?= __('Art Classes Available', 'sage'); ?></span>
						<?php endif; ?>
					</a>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<?php if ($poststeam->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
	<nav class="more-nav">
		<div class="more-nav-container">
			<button data-page="<?php echo $paged ?>" data-filter-class="all" class="load-more-btn btn btn-lg btn-more">Load More</button>
		</div>
	</nav>
	<?php 
}
wp_reset_postdata();
}
?>
</div>
