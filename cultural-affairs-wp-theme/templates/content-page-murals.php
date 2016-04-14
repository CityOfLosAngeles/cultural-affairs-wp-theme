<div class="container">
	<div class="row intro">
		<div class="col-xs-12"><?= get_field('intro_text') ?></div>
	</div>

	<div class="row registration-options">
		<div class="col-sm-6 option">
			<div class="wrapper">
				<img alt="Original Mural Registration Icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/murals/icon-original-mural@2x.png" />
				<h2>Original Mural Registration</h2>
				<p><?= get_field('original_description') ?></p>
				<?php 
				$original_pdf = get_field('original_pdf');

				if( $original_pdf ): ?>
					<a title="<?php echo $original_pdf['filename']; ?>" href="<?php echo $original_pdf['url']; ?>" target="_blank" class="btn">Apply</a>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-sm-6 option">
			<div class="wrapper">
				<img alt="Vintage Mural Registration Icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/murals/icon-vintage-mural@2x.png" />
				<h2>Vintage Mural Registration</h2>
				<p><?= get_field('vintage_description') ?></p>
				<?php 
				$vintage_pdf = get_field('vintage_pdf');

				if( $vintage_pdf ): ?>
					<a title="<?php echo $vintage_pdf['filename']; ?>" href="<?php echo $vintage_pdf['url']; ?>" target="_blank" class="btn">Apply</a>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-9">
			<?php if( have_rows('frequently_ask_question') ): ?>
			<?php $ct = 0; ?>
			<div class="faq-section bottom-section-item">
				<h2><?= __('Frequently Asked Questions', 'sage'); ?></h2>
				<ul>
					<?php
					// loop through the rows of data
					while ( have_rows('frequently_ask_question') ) : the_row();
					// vars
					$title  = get_sub_field('question');
					$content     = get_sub_field('answer');
					$ct++;

					?>
						<div class="panel panel-default">

							<div class="panel-heading" role="tab" id="heading<?php echo $ct ?>">
								<h4 class="panel-title">
									<a <?php if($ct != 1) { echo 'class="collapsed"'; }?> data-toggle="collapse" href="#collapse<?php echo $ct ?>" aria-expanded="true" aria-controls="collapse<?php echo $ct ?>">
										<?= $title ?>
										<div class="control-icon"><span class="h"></span><span class="v"></span></div>
									</a>
								</h4>
							</div>

							<div id="collapse<?php echo $ct ?>" class="panel-collapse collapse <?php if($ct == 1) { echo 'in'; }?>" role="tabpanel" aria-labelledby="heading<?php echo $ct ?>">
								<div class="panel-body">
									<?= $content ?>
								</div>
							</div>

						</div>
					<?php endwhile; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="featured-murals-section">
		<h1>FEATURED MURALS</h1>
		<p>Check out our recent conservation and new mural projects.</p>
		<div class="featured-murals row">
			<?php
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			$args = array(
				'post_type' => 'artists-projects',
				'posts_per_page' => 3,
				'order' => 'DESC',
				'paged' => $paged,
				'taxonomy'=>'artist-project-type',
				'term'=> 'murals',
				);
			$poststeam = new WP_Query($args);
			if($poststeam->have_posts()){
				$gallery_tabs = '';
				$gallery_content = '';
				while($poststeam->have_posts()) {
					$poststeam->the_post(); 
					?>
					<div class="col-xs-12 col-sm-4">
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
		<?php if ($poststeam->max_num_pages > 1): ?>
			<hr class="sep" />
			<a title="View All Murals" href="murals-list/" class="btn">View All Murals</a>
		<?php endif; ?>
	</div>
</div>

<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
