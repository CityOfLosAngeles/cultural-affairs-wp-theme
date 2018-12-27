<div class="col-xs-12 ">
	<div class="row district-box">
			<div hidden class="district-img col-xs-3">
				<?php
                if ( has_post_thumbnail( ) ) { // check if the post has a Post Thumbnail assigned to it.
                	?>
                	<a href="<?php the_permalink() ?>">
                	<?php
                  echo get_the_post_thumbnail();
                  ?>
                  </a>
                  <?php
                }
              	?>
			</div>

			<div class="col-xs-12">
				<a href="<?php the_permalink() ?>">
			<h2><?php the_title() ?></h2>
			<div class="short-description"><?php the_excerpt(); ?></div>

			</a>
			<div class="category">
				<?php 	$postType = get_post_type_object(get_post_type());
			if ($postType) {

				$sectionName = $postType->labels->singular_name;
				if ($sectionName == "Page") {
					// nothing happen
					echo "<strong>Categories</strong>: Page";
				}elseif ($sectionName == "Event") {
					// show all categories from events
					echo "<strong>Categories</strong>: ".$sectionName;
					$terms2 = get_the_terms( get_the_ID(), TribeEvents::TAXONOMY );
					if ($terms2){
						foreach ( $terms2 as $term ) {
								echo ', '.$term->name;
						}
					}
				}else{
					echo "<strong>Categories</strong>: ".$sectionName;
				}


			} ?>
			</div>
			</div>

	</div>
</div>
