<div class="loading-container">
    <div class="loading-div">
        <span class="glyphicon glyphicon-refresh spinning"></span> Loading...    
    </div>
</div>
<div class="container bottom-spacing" id="grant-list">
	
	<?php

	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = array(
		'post_type' => 'grant_and_call',
		'posts_per_page' => 20,
		'meta_key'		=> 'deadline',
		'meta_value'   => date( "Y-m-d" ),
		'meta_compare' => '>=',
		'orderby'		=> 'meta_value_num',
		'order' => 'ASC',
        'paged' => $paged,
		);

	$poststeam = new WP_Query($args);
	if($poststeam->have_posts()){
		?>
		<div class="row grant-row">
			<div class="col-xs-5 col-sm-2">
				<h3><?= __('Deadline', 'sage'); ?></h3>
			</div>
			<div class="col-xs-7 col-sm-8">
				<h3><?= __('Opportunity', 'sage'); ?></h3>
			</div>
			<div class="hidden-xs col-sm-2">
				<h3><?= __('Amount', 'sage'); ?></h3>
			</div>
		</div>
		<?php
		while($poststeam->have_posts()) {
			$poststeam->the_post(); 



			?>
			<div class="row grant-row">
				<div class="col-xs-5 col-sm-2">
					<?php if ( get_field('deadline_format') ): ?>
					<div class="deadline-column">
		            <?php
		            if ( get_field('deadline_format') == 'Specific Date' ) {
		              $format = "M j, Y - g:i a";
		              $timestamp = get_field( 'deadline' );
		              echo date_i18n( $format, strtotime($timestamp ));
		            }else {
		              echo get_field('custom_deadline');
		            }
		            ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="col-xs-7 col-sm-8">
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
					<?php if ( get_field('eligible_for_individuals') ): ?>
						<div class="elegibility"><?= __('Eligible for Individuals', 'sage'); ?></div>
					<?php endif; ?>
					<div class="visible-xs">
						<h3><?= __('Amount', 'sage'); ?></h3>
						<?php if ( get_field('amount') ): ?>
						<div class="amount-column">

							<?= get_field('amount'); ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="hidden-xs col-sm-2">
					<?php if ( get_field('amount') ): ?>
						<div class="amount-column">

							<?= get_field('amount'); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php
			if ($poststeam->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
            <nav class="more-nav">
              <div class="more-nav-container">
                <button data-page="<?php echo $paged ?>" data-filter-class="all" class="load-more-btn btn btn-lg btn-more">Load More</button>
              </div>
            </nav>
          	<?php 
          	}
		}
		wp_reset_postdata();
	} else {
		?>
		<div>No grants and calls are currently available for application. Please check back soon.</div>
		<?php
	}
	?>

	<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
</div>


<?php get_template_part('templates/grants', 'footer'); ?>


<div class="container recent-grants top-spacing bottom-spacing">

	<div class="row">
	


	<?php

// check if the repeater field has rows of data
if( have_rows('box', 'option') ):

 	// loop through the rows of data
    while ( have_rows('box','option') ) : the_row();

        // display a sub field value
    	$title = get_sub_field('title');
    	$description = get_sub_field('description');
    	$cta_title = get_sub_field('cta_title');
    	$cta_url = get_sub_field('cta_url');
?>
     
        <div class="col-sm-6">
			<div class="internal-border">
				<h1><?= $title ?></h1>
				<p><?= $description ?></p>
				<a class="btn btn-md" title="<?=$cta_title?>" href="<?=$cta_url?>"><?=$cta_title?></a>
			</div>
		</div>
<?php
    endwhile;


endif;

?>
		
	</div>
	
</div>

<div class="container tight featured-grantees">
	<h1><?= get_field('selected_grants_title','options') ?></h1>
	<p><?= get_field('selected_grants_description','options') ?></p>
	<div class="row grantees-boxes">
		<?php
		$args = array(
			'post_type' => 'grantee',
			'orderby' => 'menu_order',
			'posts_per_page' => 4
			);

		$poststeam = new WP_Query($args);
		if($poststeam->have_posts()){$i = 0;
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
							<div class="short-description"><?= get_field('short_description'); ?></div>
						</a>
					</div>
				</div>
				<?php
			}
			wp_reset_postdata();
		}
		?>
	</div>
	<hr class="sep" />
	<a class="btn btn-md" href="/grantees">View Selected Grantees</a>
	<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
</div>