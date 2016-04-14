<div class="container">
  <?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="row">
      <div class="col-md-3 side-area">
        <?php if ( get_field('amount') ): ?>
        <div class="side-item">
          <h3><?= __('AMOUNT', 'sage'); ?></h3>
          <?= get_field('amount'); ?>
        </div>
        <?php endif; ?>
        <?php if ( get_field('granting_organization') ): ?>
        <div class="side-item">
          <h3><?= __('GRANTING ORGANIZATION', 'sage'); ?></h3>
          <?= get_field('granting_organization'); ?>
        </div>
        <?php endif; ?>
        <?php if ( get_field('deadline_format') ): ?>
        <div class="side-item">
          <h3><?= __('DEADLINE', 'sage'); ?></h3>
          <?php
          if ( get_field('deadline_format') == 'Specific Date' ) {
            $format = "M j, Y - g:i a";
            $timestamp = get_field( 'deadline' );
            echo date_i18n( $format, strtotime($timestamp ));
          }else {
            echo get_field('custom_deadline');
          }
          ?>
        </div>
        <?php endif; ?>
        <?php if ( get_field('status') ): ?>
        <div class="side-item">
          <h3><?= __('STATUS', 'sage'); ?></h3>
          <?= get_field('status'); ?>
        </div>
        <?php endif; ?>
        <?php if ( get_field('contact') ): ?>
          <div class="side-item">
            <h3><?= __('CONTACT', 'sage'); ?></h3>
            <?= get_field('contact'); ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="col-md-9 main-area">
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
              <?php if($image_caption): ?><p class="flex-caption"><?= $image_caption ?></p><?php endif; ?>
            </li>
            <?php endwhile; ?>
          </ul>
        </div>
        <?php endif; ?>
        <?php if( have_rows('application_materials') ): ?>
        <div class="application-materials-section bottom-section-item">
          <div class="top">
            <h2><?= __('Application Materials', 'sage'); ?></h2>
            <?php if( get_field('application_material_bundle') ): ?>
            <?php 
            // var
            $bundle_file = get_field('application_material_bundle');
            ?>
            <a target="_blank" href="<?= $bundle_file['url'] ?>" title="Download Application Materials Bundle" class="app-materials-bundle"><div class="bundle-icon"><?php echo file_get_contents(get_template_directory(). "/dist/images/general/bundle-icon.svg"); ?></div></a>
          <?php endif; ?>
          </div>
          <ul>
            <?php
            // loop through the rows of data
            while ( have_rows('application_materials') ) : the_row();
            // vars
            $app_material_file = get_sub_field('application_material_file');
            ?>
            <li><a target="_blank" href="<?= $app_material_file['url'] ?>" title="<?= get_sub_field('application_material_name') ?>"><?= get_sub_field('application_material_name') ?></a></li>
            <?php endwhile; ?>
          </ul>
        </div>
        <?php endif; ?>
        <?php if( have_rows('frequently_asked_questions') ): ?>
        <?php $ct = 0; ?>
        <div class="faq-section bottom-section-item">
          <h2><?= __('Frequently Asked Questions', 'sage'); ?></h2>
          <ul>
            <?php
            // loop through the rows of data
            while ( have_rows('frequently_asked_questions') ) : the_row();
            // vars
            $title  = get_sub_field('faq_title');
            $content     = get_sub_field('faq_content');
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
        <?php if( have_rows('reporting_resources') ): ?>
          <div class="reporting-resources-section bottom-section-item">
            <h2><?= __('Resources/Links', 'sage'); ?></h2>
            <ul>
              <?php
              // loop through the rows of data
              while ( have_rows('reporting_resources') ) : the_row();
              ?>
              <li><a target="_blank" href="<?= get_sub_field('resource_url') ?>" title="<?= get_sub_field('resource_name') ?>"><?= get_sub_field('resource_name') ?></a></li>
              <?php endwhile; ?>
            </ul>
          </div>
        <?php endif; ?>
        <footer>
          <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
        </footer>
      </div>
    </div>
  </article>
  <?php endwhile; ?>
</div>
<?php get_template_part('templates/grants', 'footer'); ?>
