<div class="col-xs-12 col-sm-3">
	<div class="district-box">
		<a href="<?php the_permalink() ?>">
			<div class="district-img">
				<?php 
                if ( has_post_thumbnail( ) ) { // check if the post has a Post Thumbnail assigned to it.
                	echo get_the_post_thumbnail();
                } 
                ?>
            </div>
            <h2><?php the_title() ?></h2>
            <div class="short-description"><?php the_content(); ?></div>
        </a>
    </div>
</div>
