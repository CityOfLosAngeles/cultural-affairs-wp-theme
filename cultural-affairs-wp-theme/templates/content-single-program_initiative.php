  <?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="container">
      <div class="row">
    <div class="col-md-9 main-area">
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <div class="photo-area">
        <?php 
        if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
          the_post_thumbnail();
        } 
        ?>
      </div>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      <?php if( have_rows('image_slider') ): ?>
      <div class="grant-slider flexslider">
        <ul class="slides">
          <?php
          // loop through the rows of data
          while ( have_rows('image_slider') ) : the_row();
            // vars
            $image_caption = get_sub_field('image_caption');
            $image_file = get_sub_field('image_file');
          ?>
          <li data-thumb="<?= $image_file['sizes'][ 'medium' ] ?>"><img src="<?= $image_file['sizes'][ 'large' ] ?>" />
          <?php if($image_caption): ?>
            <p class="flex-caption"><?= $image_caption ?></p>
          <?php endif; ?>
          </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <?php endif; ?>

      <?php if( have_rows('external_links') ): ?>
      
      <div class="bottom-spacing">
        <div class="side-item">
          <h2><?= __('External Links', 'sage'); ?></h2>
          <ul>
            <?php while ( have_rows('external_links') ) : the_row(); ?>
            <li><a href="<?= get_sub_field('url') ?>"><?= get_sub_field('text') ?></a></li>
            <?php endwhile; ?>
          </ul>

        </div>
      </div>
      
      <?php endif; ?>

      <?php if( have_rows('frequently_ask_questions') ): ?>
      <?php $ct = 0; ?>
      <div class="side-item faq-section bottom-section-item">
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
          <?php

          endwhile;
          ?>
        </ul>
      </div>
    <?php endif; ?>

  </div>

      <div class="overview-area col-md-3">

        <?php if( have_rows('overview') ): ?>
        <h1><?= __('Overview', 'sage'); ?></h1>
        <?php
                      // loop through the rows of data
        while ( have_rows('overview') ) : the_row();
                          // vars
        $title  = get_sub_field('title');
        $content     = get_sub_field('content');


        ?>

        <div class="overview-item">
          <h3><?= $title; ?></h3>
          <?= $content; ?>
        </div>
        <?php

        endwhile;
        ?>
      <?php endif; ?>


    </div>

</div>
</div>
</article>
<?php endwhile; ?>
