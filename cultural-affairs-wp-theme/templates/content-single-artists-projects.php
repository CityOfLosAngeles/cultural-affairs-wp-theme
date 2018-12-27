<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
      <?php 
      $hero_image = get_field('hero_image');
      ?>
    <div class="hero-area" style="background-image: url(<?php echo $hero_image['url']; ?>)">
    </div>
    <div class="container">
      <div class="row">
        <div class="general-info-area col-md-3">
          

              <?php if( have_rows('quick_facts') ): ?>
              <h1><?= __('Quick Facts', 'sage'); ?></h1>
              <?php
                            // loop through the rows of data
              while ( have_rows('quick_facts') ) : the_row();
                                // vars
              $title  = get_sub_field('title');
              $content     = get_sub_field('content');


              ?>

              <div class="quick-item">
                <h3><?= $title; ?></h3>
                <?= $content; ?>
              </div>
              <?php

              endwhile;
              ?>
            <?php endif; ?>


        </div>
      <div class="main-area col-md-9">
        <h1 class="entry-title"><?php the_title(); ?></h1>
       
          <div class="entry-content">
            <?php the_content(); ?>
          </div>
          <?php
          if( have_rows('image_slider') ):
            ?>
              <div class="artists-slider flexslider">
                <ul class="slides">
                <?php
                  // loop through the rows of data
                    while ( have_rows('image_slider') ) : the_row();

                        // vars
                        $image_caption = get_sub_field('image_caption');
                        $image_file = get_sub_field('image_file');

                        ?>
                        <li data-thumb="<?= $image_file['sizes'][ 'medium' ] ?>"><img src="<?= $image_file['sizes'][ 'large' ] ?>" />
                          <?php if($image_caption): ?><p class="flex-caption"><?= $image_caption ?></p><?php endif; ?></li>
                        <?php

                    endwhile;
                ?>
                </ul>
              </div>
            <?php endif; ?>

          
          <?php
          $related_centers = get_field('related_centers');

          if( $related_centers ): ?>
            <div class="related-section">
              <h2><?= __('Related Cultural Centers', 'sage'); ?></h2>
                  <?php foreach( $related_centers as $related_center): // variable must be called $post (IMPORTANT) ?>
                      <?php setup_postdata($related_center); ?>
                      <div class="col-md-4 related-center">
                          <a href="<?php the_permalink(); ?>" title="<?= get_the_title(); ?>">
                            <?php
                              $hero_image_related = get_field('hero_image');
                              $hero_url_related = $hero_image_related['sizes'][ 'medium' ]
                            ?>
                            <div class="related-thumb">
                              <img src="<?= $hero_url_related ?>" />
                            </div>
                            <h3><?= get_the_title(); ?></h3>
                          </a>
                      </div>
                  <?php endforeach; ?>
                  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            </div>
          <?php endif; ?>


      </div>

    </div>
  </div>

  </article>
<?php endwhile; ?>
