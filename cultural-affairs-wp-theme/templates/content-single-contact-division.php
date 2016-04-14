<div class="single-contact-page">
  <?php while (have_posts()) : the_post(); ?>
    <?php
    $contact_phone = get_field ('phone');
    $contact_email = get_field ('email');
    ?>
    <div class="single-contact">
      <h1><?php the_title(); ?></h1>
      <div class="meta">
        <?php if ($contact_phone) { ?>
        <div class="contact-phone"><b>Phone:</b> <?= $contact_phone; ?></div>
        <?php } ?>
        <?php if ($contact_email) { ?>
        <div class="contact-email"><b>Email:</b> <a class="warm-grey" href="mailto:<?= $contact_email; ?>"><?= $contact_email; ?></a></div>
        <?php } ?>
      </div>
      <?php the_content(); ?>
    </div>
  <?php endwhile; ?>

  <?php
  if( get_field('team') ) { 
    ?>
    <div class="division-team">
      <?php
      while( has_sub_field('team') ) {
        ?>
        <div class="row team-member">
          <div class="col-xs-12">
            <div class="member-pic">
              <img class="img-circle" src="<?= get_sub_field('image'); ?>">
            </div>
            <div class="member-info">
              <h3><?php echo get_sub_field('name'); ?></h3>
              <div class="bio-member"><?= get_sub_field('description'); ?></div>  
              <?php if (get_sub_field('email')){ ?>
              <div class="contact-email"><a class="warm-grey" href="mailto:<?= get_sub_field('email'); ?>"><?= get_sub_field('email'); ?></a></div>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
    <?php
  }
  ?>
</div>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/scripts/readmore.js" ></script>
