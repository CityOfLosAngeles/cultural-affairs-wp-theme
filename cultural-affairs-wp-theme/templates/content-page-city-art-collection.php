<div class="container">
	<div class="row intro">
		<div class="col-md-9"><?= wpautop( get_the_content() ) ?></div>
	</div>
	<div class="row">
		<div class="col-md-9">
			<?php if( have_rows('frequently_ask_questions') ): ?>
			<?php $ct = 0; ?>
			<div class="faq-section bottom-section-item">
				<h2><?= __('Frequently Asked Questions', 'sage'); ?></h2>
				<ul>
					<?php
		            // loop through the rows of data
					while ( have_rows('frequently_ask_questions') ) : the_row();
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
			<?php if( have_rows('image_slider') ): ?>
			<div class="city-slider flexslider">
				<ul class="slides">
					<?php
	                // loop through the rows of data
					while ( have_rows('image_slider') ) : the_row();
	                // vars
					$image_caption = get_sub_field('image_caption');
					$image_file = get_sub_field('image_file');
					?>
					<li data-thumb="<?= $image_file ?>"><img src="<?= $image_file ?>" />
						<?php if($image_caption): ?><p class="flex-caption"><?= $image_caption ?></p><?php endif; ?>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
