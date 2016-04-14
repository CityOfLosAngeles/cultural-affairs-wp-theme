<!-- Mobile search form -->
<div id="mobile-header-tools" class="collapse">
  <div class="container">
    <div class="mobile-search-box">      
      <form action="/" method="get">
        <div class="input-group">
          <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Your Zip Code'" class="form-control" placeholder="Enter Your Zip Code">
          <span class="location-icon">
            <?php echo file_get_contents(get_template_directory().'/assets/images/general/icon-16x16-location.svg') ?>
          </span>
        </div>
      </form>
    </div>
  </div>          
</div>

<header id="header" class="banner navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-menu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php $img_url = wp_get_attachment_url( get_post_thumbnail_id());  ?>
      <?php if ($img_url != '' && is_page()) { ?>
      <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><img title="<?php bloginfo('name'); ?>" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id()); ?>" /></a>
      <?php } elseif ( is_search() || is_tax('media-room-categories') || is_singular('council_district') || is_post_type_archive('council_district') ) { ?>
      <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><img title="<?php bloginfo('name'); ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/general/logo-purple.svg" /></a>
      <?php } elseif ( is_page('recent-grantees') || is_post_type_archive(array('grant_and_call','grantee','cultural_center','program_initiative','artists-projects')) || is_singular( array('artists-projects','grant_and_call', 'grantee','cultural_center','program_initiative')) ) { ?>
      <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><img title="<?php bloginfo('name'); ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/general/logo-orange.svg" /></a>
      <?php } elseif ( is_post_type_archive('tribe_events') || is_singular( array('tribe_events', 'tribe_organizer', 'wp_router_page', 'tribe_organizer', 'tribe_venue')) ) { ?>
      <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><img title="<?php bloginfo('name'); ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/general/logo-wine.svg" /></a>
      <?php } else { ?>
      <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><img title="<?php bloginfo('name'); ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/general/logo-grey.svg" /></a>
      <?php } ?>
    </div>
    <nav class="collapse navbar-collapse" id="collapse-menu">
      <div class="close-container">
        <span class="close-title">MENU</span>
        <button class="close-btn" role"button" data-toggle="collapse" data-target=".navbar-collapse"><span class="close-icon"></span></button> 
      </div>
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav']);
      endif;
      ?>
    </nav>
    <div class="toggled-cover"></div>
    <div class="header-form"> 
      <form action="/" method="get">
        <div class="input-group">
          <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Zip Code'" class="form-control" placeholder="Zip Code">
          <span class="location-icon">
            <?php echo file_get_contents(get_template_directory().'/assets/images/general/icon-16x16-location.svg') ?>
          </span>
        </div>
      </form>   
      <button type="button" class="hidden-md hidden-lg search-toggle" data-toggle="collapse" data-target="#mobile-header-tools" aria-expanded="false" aria-controls="mobile-header-tools">
        <span class="location-icon">
          <?php echo file_get_contents(get_template_directory().'/assets/images/general/icon-16x16-location.svg') ?>
        </span>
      </button>
    </div>
  </div>
</header>
