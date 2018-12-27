<?php
if( have_rows('image_slider') ):
  ?>
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
                <?php if($image_caption): ?><p class="flex-caption"><?= $image_caption ?></p><?php endif; ?></li>
              <?php

          endwhile;
      ?>
      </ul>
    </div>
  <?php endif; ?>