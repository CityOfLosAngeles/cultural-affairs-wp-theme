<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-8 left-container">
			<div class="row">
				<?php if(get_field('slider_position') == 'top'){ ?>
					<?php get_template_part('templates/component', 'image-slider'); ?>
				<?php } ?>
				<?php the_content(); ?>
				<?php if(get_field('slider_position') == 'bottom'){ ?>
					<?php get_template_part('templates/component', 'image-slider'); ?>
				<?php } ?>
			</div>
		</div>
		<div class="col-xs-12 col-md-4 right-container">
		</div>
	</div>
</div>