<?php 
$hero_image = get_field('hero_image');
if ($hero_image):
?>
<div class="hero-area" style="background-image: url(<?php echo $hero_image['url']; ?>)"></div>
<?php endif; ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<h1><?php the_title(); ?></h1>
			<div class="press-room">
				<?php the_content(); ?>
				<?php
				if( get_field('press_room') ) {
					?>
					<div class="left-blue-border">
						<ul>
							<?php
							while( has_sub_field('press_room') ) {
								$name = get_sub_field('name');
								$file = get_sub_field('file');
								?>
								<li><a target="_blank" href="<?= $file['url'] ?>"><?= $name ?></a></li>
								<?php
							}
							?>
						</ul>
					</div>
					<?php
				}
				?>
			</div>
			<div class="press-releases">
				<h2><?= __('Press Releases', 'sage'); ?></h2>

				<div class="left-blue-border">
					<?php
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

					$args = array(
						'post_type' => 'media-room-files',
						'posts_per_page' => 15,
						'meta_key'		=> 'date',
						'orderby'		=> 'meta_value_num',
						'order' => 'DESC',
						'paged' => $paged,
						'taxonomy'=>'media-room-categories',
						'term'=> 'press-releases',
						);

					$poststeam = new WP_Query($args);
					if($poststeam->have_posts()){
						while($poststeam->have_posts()) {
							$poststeam->the_post(); 
							$date = DateTime::createFromFormat('Ymd', get_field('date'));
							$file = get_field('file');
							?>
							<div class="media-box">
								<b><?= $date->format('m/d/y') ?></b>
								<p><a target="_blank" title="<?php the_title() ?>" href="<?= $file['url'] ?>"><?php the_title() ?></a></p>
							</div>
							<?php
						}
						wp_reset_postdata();
					}
					?>
				</div>
				<a title="View All Press Releases" href="press-releases/" class="btn">View All Press Releases</a>
			</div>

			<div class="media-clippings">
				<h2><?= __('Media Clippings', 'sage'); ?></h2>
				<div class="left-blue-border">
					<?php
					$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

					$args = array(
						'post_type' => 'media-room-files',
						'posts_per_page' => 15,
						'meta_key'		=> 'date',
						'orderby'		=> 'meta_value_num',
						'order' => 'DESC',
						'paged' => $paged,
						'taxonomy'=>'media-room-categories',
						'term'=> 'media-clippings',
						);

					$poststeam = new WP_Query($args);
					if($poststeam->have_posts()){

						while($poststeam->have_posts()) {
							$poststeam->the_post(); 
							$date = DateTime::createFromFormat('Ymd', get_field('date'));
							$file = get_field('file');
							?>
							<div class="media-box">
								<b><?= $date->format('m/d/y') ?></b>
								<p><a target="_blank" title="<?php the_title() ?>" href="<?= $file['url'] ?>"><?php the_title() ?></a></p>
							</div>
							<?php
						}
						wp_reset_postdata();
					}
					?>
				</div>
				<a title="View All Media Clippings" href="media-clippings" class="btn">View All Media Clippings</a>
			</div>
		</div>
		<div class="col-xs-12 col-md-4 side-area">
			<h2 class="more-info-heading"><?= __('More Information', 'sage'); ?></h2>
			<?php
			$image = get_field('informer_image');
			$name = get_field('informer_name');
			$title = get_field('title');
			$email = get_field('email');
			$phone = get_field('phone');
			?>
			<div class="more-info">
				<img src="<?= $image['url'] ?>">
				<div class="text-container">
					<b><?= $name ?></b><br/>
					<i><small><?= $title ?></small></i><br/>
					<a href="mailto:<?= $email ?>"><?= $email ?></a><br/>
					<?= $phone ?>
				</div>
			</div>
		</div>
	</div>

</div>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
