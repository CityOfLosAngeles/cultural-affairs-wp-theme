<?php
use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-73743216-1', 'auto');
  ga('send', 'pageview');

  </script>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
      <![endif]-->
      <?php
      do_action('get_header');
      get_template_part('templates/header');
      ?>
      <div id="breadcrumbs" class="breadcrumbs" >
        <?php if ( function_exists('yoast_breadcrumb') ) 
        {
        // Check how can we clean this
          $breadcrumbs = yoast_breadcrumb('','',false);
          $seperator = " / ";

        if( tribe_is_month() && !is_tax() ) { // The Main Calendar Page
          $breadcrumbs .= $seperator.'<strong class="breadcrumb_last">Events</strong>';

          } elseif( tribe_is_month() && is_tax() ) { // Calendar Category Pages

            global $wp_query;
            $term_slug = $wp_query->query_vars['tribe_events_cat'];
            $term = get_term_by('slug', $term_slug, 'tribe_events_cat');
            get_term( $term->term_id, 'tribe_events_cat' );
            $name = $term->name;
            $breadcrumbs .=  $seperator;
            $breadcrumbs .=   '<a href="'.tribe_get_events_link().'">Events</a>';
            $breadcrumbs .=   $seperator;
            $breadcrumbs .=   '<strong class="breadcrumb_last">'.$name.'</strong>';

          } elseif( tribe_is_event() && !tribe_is_day() && !is_single() ) { // The Main Events List

            $breadcrumbs .=   $seperator;
            $breadcrumbs .=   '<strong class="breadcrumb_last">Events List</strong>';

          } elseif( tribe_is_event() && is_single() ) { // Single Events

            $breadcrumbs .=   $seperator;
            $breadcrumbs .=   '<a href="'.tribe_get_events_link().'">Events</a>';
            $breadcrumbs .=   $seperator;
            $breadcrumbs .=  '<strong class="breadcrumb_last">'.get_the_title().'</strong>';

          } elseif( tribe_is_day() ) { // Single Event Days

            global $wp_query;
            $breadcrumbs .=   $seperator;
            $breadcrumbs .=   '<a href="'.tribe_get_events_link().'">Events</a>';
            $breadcrumbs .=   $seperator;
            $breadcrumbs .=   '<strong class="breadcrumb_last">Events on: ' . date('F j, Y', strtotime($wp_query->query_vars['eventDate'])).'</strong>';

          } elseif( tribe_is_venue() ) { // Single Venues

            $breadcrumbs .=   $seperator;
            $breadcrumbs .=   '<a href="'.tribe_get_events_link().'">Events</a>';
            $breadcrumbs .=  $seperator;
            $breadcrumbs .=  '<strong class="breadcrumb_last">'.get_the_title($wp_query->post->ID).'</strong>';

          } elseif (is_category() || is_single()) {
            $cat = get_the_category();
            $separator = ' &bull; ';
            $output = '';
            if ( ! empty( $cat ) ) {
              foreach( $cat as $c ) {
                $output .= '<a href="' . esc_url( get_category_link( $c->term_id ) ) . '" >' . esc_html( $c->name ) . '</a>' . $separator;
              }
              $breadcrumbs .=   $seperator;
              $breadcrumbs .= trim( $output, $separator );
            }
            if (is_single() && is_singular('tribe_events')) {
              $breadcrumbs .=   ' '.$seperator.' ';
              $breadcrumbs .=   '<a href="'.tribe_get_events_link().'">Events</a>'; 
              $breadcrumbs .=  $seperator;
              $breadcrumbs .=  '<strong class="breadcrumb_last">'.get_the_title($wp_query->post->ID). '</strong>';
            }


          }

          elseif (is_tax('tribe_events_cat')) {

            $term_slug = $wp_query->query_vars['tribe_events_cat'];
            $term = get_term_by('slug', $term_slug, 'tribe_events_cat');
            get_term( $term->term_id, 'tribe_events_cat' );
            $breadcrumbs .=   ' '.$seperator.' ';
            $breadcrumbs .= '<strong class="breadcrumb_last">'.$term->name.'</strong>';

          }
          elseif (is_tax('media-room-categories')) {

            $term_slug = $wp_query->query_vars['media-room-categories'];
            $term = get_term_by('slug', $term_slug, 'media-room-categories');
            get_term( $term->term_id, 'media-room-categories' );
            $breadcrumbs .=   ' '.$seperator.' ';
            $breadcrumbs .= '<strong class="breadcrumb_last">'.$term->name.'</strong>';

          }

          echo "<div class='container'>". $breadcrumbs. "</div>";
        } ?>
      </div>

      <?php use Roots\Sage\Titles; ?>

      <?php if (is_page('about') || is_page('murals') || is_page('percent-public-art') || is_page('public-works-improvements-arts-program-pwiap') || is_page('private-arts-development-fee-program-adf') || is_page('city-art-collection')) { ?>
      <div class="wrap container-fluid" role="document">
        <div class="container">
          <div class="page-header">
            <h1><?= Titles\title(); ?></h1>
          </div>
        </div>
      <?php }elseif (is_post_type_archive('contact-division')) { ?>
      <div class="wrap container" role="document">
        <div class="page-header">
          <h1>Contact</h1>
        </div>
      <?php }elseif (is_post_type_archive('tribe_events')) { ?>
      <div class="wrap container" role="document">
        <div class="page-header">
          <h1>Events</h1>
        </div>
      <?php }elseif (is_post_type_archive('grant_and_call') || is_singular(array('grant_and_call', 'grantee', 'cultural_center', 'council_district', 'artists-projects', 'program_initiative')) || is_page('media-room')) { ?>
      <div class="wrap container-fluid" role="document">
      <?php }else { ?>
      <div class="wrap container" role="document">
      <?php } ?>
      <div class="content row">
        <main class="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
        <aside class="sidebar">
          <?php include Wrapper\sidebar_path(); ?>
        </aside><!-- /.sidebar -->
      <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
    do_action('get_footer');
    get_template_part('templates/footer');
    wp_footer();
    ?>
  </body>
</html>
