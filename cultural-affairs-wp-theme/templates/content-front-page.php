<?php
	$hero_image = get_field('hero_image');
	$bg_style = "";
	if ($hero_image) {
		$bg_style = "background-image:url(".$hero_image.")";
	}else {
		$bg_style = "";
	}
?>
<div class="row hero-image" id="hero" style="<?= $bg_style ?>">
	<div class="container">
		<div class="bottom-hero-text text-center white-txt"><small>Department of Cultural Affairs</small></div>
		<div class="left-hero-news">
			<?php
			$featured_items = get_field('hero_featured_items');
			if( $featured_items ): ?>
				<?php foreach( $featured_items as $f ): // variable must NOT be called $post (IMPORTANT) ?>
				    	<a href="<?php echo get_permalink( $f->ID ); ?>" title="<?php echo get_the_title( $f->ID ); ?>" class="hero-news"><?php echo get_the_title( $f->ID ); ?></a>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		
	</div>
	<div class="gradient-lw"></div>
</div>
<div class="row below-header-section-wrap" id="the-department">
	<div class="container below-header-section">
		<a href="/cultural-centers" title="Cultural Centers" class="item-anchor cultural-centers">
			<div class="item">
				<div class="item-wrap">
					<img src="<?= get_template_directory_uri(); ?>/dist/images/home/icon-cultural-centers@2x.png" alt="Cultural Centers Icon" /><span>Cultural Centers</span>
				</div>
				<div class="hover-cover"></div>
			</div>
		</a>
		<a href="/grants-and-calls" title="Grants and Calls" class="item-anchor grants-calls">
			<div class="item">
				<div class="item-wrap">
					<img src="<?= get_template_directory_uri(); ?>/dist/images/home/icon-grants@2x.png" alt="Grants and Calls Icon" /><span>Grants and Calls</span>
				</div>
				<div class="hover-cover"></div>
			</div>
		</a>
		<a href="/murals" title="Murals" class="item-anchor murals">
			<div class="item">
				<div class="item-wrap">
					<img src="<?= get_template_directory_uri(); ?>/dist/images/home/icon-murals@2x.png" alt="Murals Icon" /><span>Murals</span>
				</div>
				<div class="hover-cover"></div>
			</div>
		</a>
		<div class="copy-item">
			<h2>Championing Arts, Culture, and Creativity for LA!</h2>
			<p>As a leading, progressive arts and cultural agency, DCA empowers LA’s vibrant communities by: supporting and providing access to quality visual, literary, musical, performing, and educational arts programming; managing vital cultural centers; preserving historic sites; creating public art; and funding services provided by arts organizations and individual artists.</p>
			<a class="btn btn-md" href="/about">Our Mission</a>
		</div>
	</div>
</div>
<div class="row" id="happening">
	<div class="container">
		<h1 class="text-center">HAPPENING IN LOS ANGELES</h1>
		<div class="events-list">
			<?php echo do_shortcode('[ecs-list-events thumb="true" limit="8" viewall="true"  contentorder="thumbnail, title, date"]'); ?>
		</div>
	</div>
</div>