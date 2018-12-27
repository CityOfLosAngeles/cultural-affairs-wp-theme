<div class="container top-section">

	<div class="row">
		<div class="col-xs-12 col-md-8 left-container">
			<?php if(get_field('slider_position') == 'top'){ ?>
		<?php get_template_part('templates/component', 'image-slider'); ?>
	<?php } ?>
	<?php the_content(); ?>
		<?php if(get_field('slider_position') == 'bottom'){ ?>
		<?php get_template_part('templates/component', 'image-slider'); ?>
	<?php } ?>
	</div>
		<div class="col-xs-12 col-md-4 right-container">
			<?php
			if( get_field('quotes') ) {
				while( has_sub_field('quotes') ) {
					$author = get_sub_field('name');
					$title = get_sub_field('title');
					$quote = get_sub_field('quote');
					$top = get_sub_field('top_section');
					$image_url = get_sub_field('image');
					?>
					<?php if ($top) { ?>
					<div class="individual-quotes">
						<img class="img-circle img-quote" src="<?= $image_url; ?>" />
						<h3><?= $author ?></h3>
						<h4><?= $title ?></h4>
						<p><?= $quote ?></p>
					</div>
					<?php } ?>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>

<div class="row middle-banner" style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/about/img-about.jpg');">
	<div class="container text-center">
		<a class="button-grey" href="/grants-and-calls" title="Grants and Calls">Grants and Calls</a>
		<a class="button-grey" href="/cultural-centers" title="Cultural Centers">Cultural Centers</a>
		<a class="button-grey" href="/programs-and-initiatives" title="Programs and Initiatives">Programs and Initiatives</a>
		<a class="button-grey" href="/murals" title="Murals">Murals</a>
		<a class="button-grey" href="/percent-public-art" title="Percent for Public Art">Percent for Public Art</a>
		<a class="button-grey" href="/city-art-collection" title="City Art Collection">City Art Collection</a>
	</div>
</div>


<div class="container bottom-section bottom-spacing">
	<div class="row">
		<div class="col-xs-12 col-md-8 left-container"><?php echo get_field('social_impact') ?></div>
		<div class="col-xs-12 col-md-4 right-container">
			<?php
			if( get_field('quotes') ) {
				while( has_sub_field('quotes') ) {
					$author = get_sub_field('name');
					$title = get_sub_field('title');
					$quote = get_sub_field('quote');
					$bottom = get_sub_field('bottom_section');
					$image_url = get_sub_field('image');
					?>
					<?php if ($bottom) { ?>
					<div class="individual-quotes">
						<img class="img-circle img-quote" src="<?= $image_url; ?>" />
						<h3><?= $author ?></h3>
						<h4><?= $title ?></h4>
						<p><?= $quote ?></p>
					</div>
					<?php } ?>
					<?php
				}
			}
			?>
			<div class="left-blue-border media-section">
				<strong>Want to know what DCA is doing?</strong>
				<p>Get the latest media announcements, read news about DCA, and download our logos.</p>
				<a class="btn" href="media-room" title="Media Room">Media Room</a>
			</div>
		</div>
	</div>
</div>

<div class="row soft-grey-bg text-center top-spacing bottom-spacing discover-neighborhood">
	<img src="<?php echo get_template_directory_uri(); ?>/assets/images/about/icon-neighborhood@2x.png" class="icon" alt="Discover Logo" />
	<h2>DISCOVER YOUR NEIGHBORHOOD</h2>
	<p>Enter your LA zip code to find out about exciting arts and cultural events, centers, and programming in, or near, your neighborhood.</p>
	<div class="form-zip col-md-4 col-md-offset-4">	

        <form action="/" method="get">
            <div class="input-group">
                <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Zip Code'" class="form-control" placeholder="Enter Zip Code"><span class="location-icon"></span><span class="input-group-btn">
              <button type="submit" class="btn btn-search">Submit</button>
          </span>

            </div>
        </form>
	</div>
</div>

<div id="map-carousel" class="row carousel slide" data-ride="carousel">
	<div class="carousel-inner" role="listbox">
		<?php
		$posts = get_field('districts_directory');

		if( $posts ): ?>

		<?php 
		$i = 0;
		$caption_nav = '';
		foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
		<?php setup_postdata($post); ?>
		<?php 
		$image = get_field('hero_image_location');
		$caption = get_the_title();
		if ( $i == 0 ) {
			$caption_nav = $caption;
		}
		?>
		<div class="item <?php echo ($i==0)?'active':''; ?>">
			<a href="<?php echo get_the_permalink(); ?>">
				<div id="item-image" style="background-image: url('<?= $image ?>')"></div>
			</a>

			<div class="carousel-caption hidden">
				<?= $caption ?>
			</div>

		</div>

		<?php $i++; endforeach; ?>
		<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	<?php endif; ?>
	<div class="caption-nav">
		<a class="left carousel-control" href="#map-carousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<div class="carousel-caption-bg"><?php echo $caption_nav; ?></div>
		<a class="right carousel-control" href="#map-carousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
</div>

<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
