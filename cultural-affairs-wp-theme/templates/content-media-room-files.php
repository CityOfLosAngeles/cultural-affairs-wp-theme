<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="row">
  <div class="col-xs-12 col-md-8">
    <div class="press-releases">
      <?php
      $term_slug = $wp_query->query_vars['media-room-categories'];
      $term = get_term_by('slug', $term_slug, 'media-room-categories');
      get_term( $term->term_id, 'media-room-categories' );
      ?>
      <div class="page-header">
        <h1><a href="/about/media-room/"><i class="fa fa-angle-left circle"></i></a> <?= __($term->name, 'sage'); ?></h1>
      </div>
      <div class="left-blue-border">
        <?php while (have_posts()) : the_post(); ?>
        <?php

        
        $date = get_field('date');
        $t = explode("/",$date);
        $file = get_field('file');
        ?>
        <div class="media-box">

          <b><?php 
          echo $t[1]."/".$t[0]."/".$t[2];
            ?></b>
          <p><a href="<?= $file['url'] ?>"><?php the_title() ?></a></p>

        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-4 side-area">
    <h2 class="more-info-heading"><?= __('More Information', 'sage'); ?></h2>
    <?php
    $image = get_field('informer_image',243);
    $name = get_field('informer_name',243);
    $title = get_field('title',243);
    $email = get_field('email',243);
    $phone = get_field('phone',243);
    ?>
    <div class="more-info">
      <img src="<?= $image['url'] ?>">
      <div class="text-container">
        <b><?= $name ?></b><br/>
        <i><small><?= $title ?></small></i><br/>
        <a href="mailto:<?= $email ?>"><?= $email ?></a><br/>
        <?= $phone ?>
      </div>
    </div>
  </div>
</div>