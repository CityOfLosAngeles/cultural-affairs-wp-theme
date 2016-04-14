<div class="container">
  <?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="row">
      <div class="photo-area col-md-3">
        <?php 
        if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
          the_post_thumbnail();
        } 
        ?>
      </div>
      <div class="main-area col-md-6">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </div>
      <div class="overview-area col-md-3">
        <h1><?= __('Overview', 'sage'); ?></h1>
        <?php if ( get_field('located_in') ): ?>
          <div class="side-item">
            <h3><?= __('LOCATED IN', 'sage'); ?></h3>
            <?= get_field('located_in'); ?>
          </div>
        <?php endif; ?>
        <?php if ( get_field('communities_served') ): ?>
          <div class="side-item">
            <h3><?= __('SERVES THE COMMUNITIES OF', 'sage'); ?></h3>
            <?= get_field('communities_served'); ?>
          </div>
        <?php endif; ?>
        <?php if ( get_field('contact') ): ?>
        <div class="side-item">
          <h3><?= __('CONTACT', 'sage'); ?></h3>
          <?= get_field('contact'); ?>
        </div>
        <?php endif; ?>
        <?php if ( get_field('website') ): ?>
          <div class="side-item">
            <h3><?= __('WEBSITE', 'sage'); ?></h3>
            <?php $website_url = get_field('website'); ?>
            <a class="website-link" href="<?php if (strpos($website_url, 'http') === 0) { echo $website_url; }else { echo 'http://'.$website_url; } ?>" title="<?= get_field('website'); ?>" target="_blank"><?= get_field('website'); ?></a>
          </div>
        <?php endif; ?>
        <div class="social-media">
          <?php if ( get_field('facebook_page') ): ?>
            <a target="_blank" href="<?= get_field('facebook_page'); ?>" title="Facebook Page"><div class="icon fb-icon"><?php echo file_get_contents(get_template_directory(). "/dist/images/general/icon-facebook.svg"); ?></div></a>
          <?php endif; ?>
          <?php if ( get_field('twitter_profile_page') ): ?>
            <a target="_blank" href="<?= get_field('twitter_profile_page'); ?>" title="Twitter Profile"><div class="icon tw-icon"><?php echo file_get_contents(get_template_directory(). "/dist/images/general/icon-twitter.svg"); ?></div></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </article>
  <?php endwhile; ?>
</div>
<?php get_template_part('templates/grantees', 'footer'); ?>
