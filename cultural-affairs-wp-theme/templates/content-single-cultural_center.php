<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php $hero_image = get_field('hero_image'); ?>
    <div class="hero-area" style="background-image: url(<?php echo $hero_image['url']; ?>)"></div>
    <div class="container">
      <div class="row">
        <div class="general-info-area col-md-3">
          <h1><?= __('General Information', 'sage'); ?></h1>
          <div class="col-sm-4 col-md-12">
            <?php if ( get_field('address') ): ?>
              <div class="side-item">
                <h3><?= __('ADDRESS', 'sage'); ?></h3>
                <?= get_field('address'); ?>
              </div>
            <?php endif; ?>
            <?php if ( get_field('contact') ): ?>
              <div class="side-item">
                <h3><?= __('CONTACT', 'sage'); ?></h3>
                <?= get_field('contact'); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="col-sm-4 col-md-12">
            <?php if ( get_field('website') ): ?>
              <div class="side-item">
                <h3><?= __('WEBSITE', 'sage'); ?></h3>
                <?php
                $website_url = get_field('website');
                ?>
                <a class="website-link" href="<?php if (strpos($website_url, 'http') === 0) { echo $website_url; }else { echo 'http://'.$website_url; } ?>" title="<?= get_field('website'); ?>" target="_blank"><?= get_field('website'); ?></a>
              </div>
            <?php endif; ?>
            <?php if ( get_field('hours') ): ?>
              <div class="side-item">
                <h3><?= __('HOURS', 'sage'); ?></h3>
                <?= get_field('hours'); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="col-sm-4 col-md-12">
            <?php if ( get_field('parking') ): ?>
            <div class="side-item">
              <h3><?= __('PARKING', 'sage'); ?></h3>
              <?= get_field('parking'); ?>
            </div>
            <?php endif; ?>
            <div class="social-media">
              <?php if ( get_field('facebook_profile_page') ): ?>
                <a target="_blank" href="<?= get_field('facebook_profile_page'); ?>" title="Facebook Page"><div class="icon fb-icon"><?php echo file_get_contents(get_template_directory(). "/dist/images/general/icon-facebook.svg"); ?></div></a>
              <?php endif; ?>
              <?php if ( get_field('twitter_page') ): ?>
                <a target="_blank" href="<?= get_field('twitter_page'); ?>" title="Twitter Profile"><div class="icon tw-icon"><?php echo file_get_contents(get_template_directory(). "/dist/images/general/icon-twitter.svg"); ?></div></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="main-area col-md-9">
          <h1 class="entry-title"><?php the_title(); ?></h1>
          <?php if (get_field('art_classes_available')): ?>
            <span class="art-classes"><?= __('Art Classes Available', 'sage'); ?></span>
          <?php endif; ?>
          <div class="entry-content">
            <?php the_content(); ?>
          </div>
          <?php if( have_rows('image_slider') ): ?>
          <div class="cultural-slider flexslider">
            <ul class="slides">
              <?php
              // loop through the rows of data
              while ( have_rows('image_slider') ) : the_row();
                // vars
                $image_caption = get_sub_field('image_caption');
                $image_file = get_sub_field('image_file');
                ?>
                <li data-thumb="<?= $image_file['sizes'][ 'medium' ] ?>"><img src="<?= $image_file['sizes'][ 'large' ] ?>" />
                  <?php if($image_caption): ?><p class="flex-caption"><?= $image_caption ?></p><?php endif; ?>
                </li>
              <?php endwhile; ?>
            </ul>
          </div>
          <?php endif; ?>
          <?php if( have_rows('spotlight') ): ?>
          <div class="spotlight-section bottom-section-item">
            <h2><?= __('Spotlight', 'sage'); ?></h2>
            <?php
            // loop through the rows of data
            while ( have_rows('spotlight') ) : the_row();
            ?>
              <div class="sub-item">
                <div class="image-area">
                  <img src="<?= get_sub_field('image') ?>" />
                </div>
                <div class="text-area">
                  <h3><?= get_sub_field('title') ?></h3>
                  <?= get_sub_field('description') ?>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
          <?php endif; ?>
          <?php if( have_rows('staff') ): ?>
          <div class="staff-section bottom-section-item">
            <h2><?= __('Staff', 'sage'); ?></h2>
            <?php
            // loop through the rows of data
            while ( have_rows('staff') ) : the_row();
            ?>
            <div class="sub-item">
              <div class="image-area">
                <img src="<?= get_sub_field('image') ?>" />
              </div>
              <div class="text-area">
                <h3><?= get_sub_field('name') ?></h3>
                <span class="title"><?= get_sub_field('title') ?></span>
                <?= get_sub_field('description') ?>
              </div>
            </div>
            <?php endwhile; ?>
          </div>
          <?php endif; ?>
          <?php if( have_rows('related_links') ): ?>
          <div class="external-links-section bottom-section-item">
            <h2><?= __('External Links', 'sage'); ?></h2>
            <ul>
              <?php
              // loop through the rows of data
              while ( have_rows('related_links') ) : the_row();
              ?>
              <li><a target="_blank" href="get_sub_field('url')" title="<?= get_sub_field('text') ?>"><?= get_sub_field('text') ?></a></li>
              <?php endwhile; ?>
            </ul>
          </div>
          <?php endif; ?>
          <?php
          $posts = get_field('related_centers');
          if( $posts ): ?>
          <div class="related-section">
            <h2><?= __('Related Cultural Centers', 'sage'); ?></h2>
            <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
            <?php setup_postdata($post); ?>
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
