<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip;';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Change excerpt length
 */
function new_excerpt_length($length) {
  return 20;
}
add_filter('excerpt_length', __NAMESPACE__ . '\\new_excerpt_length');

/**
 * Allow SVG as Featured Image
 */
function upload_mimes ( $existing_mimes=array() ) {

  // add the file extension to the array

  //$existing_mimes['svg'] = 'mime/type';
  $existing_mimes['svg']  = 'image/svg+xml';

  // call the modified list of extensions

  return $existing_mimes;

}
add_filter('upload_mimes',  __NAMESPACE__ . '\\upload_mimes');

/**
 * Overwrite Permalinks with taxonomy
 */
function rating_permalink($permalink, $post_id, $leavename) {
    if (strpos($permalink, '%artist-project-type%') === FALSE) return $permalink;
     
        // Get post
        $post = get_post($post_id);
        if (!$post) return $permalink;
 
        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'artist-project-type');   
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0])) $taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = '';
 
    return str_replace('%artist-project-type%', $taxonomy_slug, $permalink);
}
add_filter('post_link', __NAMESPACE__ . '\\rating_permalink', 10, 3);
add_filter('post_type_link', __NAMESPACE__ . '\\rating_permalink', 10, 3);
 

/**
 * Overwrite Time for events
 */
function tribe_events_event_schedule_details_inner( $inner, $event_id ) {
    return "<div class='test'>".tribe_get_start_date( $event, false, $time_format )."</div>";
}
apply_filters( 'tribe_events_event_schedule_details_inner', __NAMESPACE__ . '\\tribe_events_event_schedule_details_inner' );

function custom_wpseo_breadcrumb_output( $output ){
    if( is_archive() ){
        $from = 'Contact Divisions';   // EDIT this to your needs  
        $to     = 'Contact';
        $output = str_replace( $from, $to, $output );
        $from = 'Media Clippings';   // EDIT this to your needs  
        $to     = '<a href="'.home_url('/').'about/" rel="v:url" property="v:title">About</a> / <a href="'.home_url('/').'about/media-room/" rel="v:url" property="v:title">Media Room</a>';
        $output = str_replace( $from, $to, $output );  
        $from = 'Press Releases';   // EDIT this to your needs  
        $to     = '<a href="'.home_url('/').'about/" rel="v:url" property="v:title">About</a> / <a href="'.home_url('/').'about/media-room/" rel="v:url" property="v:title">Media Room</a>';
        $output = str_replace( $from, $to, $output ); 
    }
    else if ( is_singular('artists-projects') ) {
        $from = '<a href="'.home_url('/').'artists-projects/" rel="v:url" property="v:title">Artists Projects</a>';   // EDIT this to your needs  
        $to     = '<b>Artists Projects</b>';
        $output = str_replace( $from, $to, $output );
    }
    else if ( is_singular('contact-division') ) {
        $from = 'Contact Divisions';   // EDIT this to your needs  
        $to     = 'Contact';
        $output = str_replace( $from, $to, $output );
    }
    else if ( is_singular('wp_router_page') ) {
        $from = 'Posts';   // EDIT this to your needs  
        $to     = 'Events';
        $output = str_replace( $from, $to, $output );  
        $from = 'WP_Router';   // EDIT this to your needs  
        $to     = 'events';
        $output = str_replace( $from, $to, $output ); 
    }
    
    return $output;
}
add_filter( 'wpseo_breadcrumb_output',  __NAMESPACE__ . '\\custom_wpseo_breadcrumb_output' );

/**
 * Delete "Archive:" prefix from archive pages title
 */
add_filter( 'get_the_archive_title', function ( $title ) {
    if( is_post_type_archive() ) {
        $title = sprintf( __( '%s' ), post_type_archive_title( '', false ) );
    }
    return $title;
});

/**
 * Changing copy on submit events
 */
function before_events_community_text() { 
  echo "<div class='intro'>Please submit your Festival Guide, Heritage Month, or DCA Sponsored Event for review to be included in DCA’s digital and printed marketing materials.</div>"; 
}
add_action('tribe_events_community_form_before_template', __NAMESPACE__ . '\\before_events_community_text'); 

/*
** Removing extra content on submit event page
**

function after_events_community_text() { 
  echo "<div class='row title'><div class='col-xs-12'><h2>Final Check! Did you ...</h2></div>"; 
  echo "<div class='col-xs-12 col-sm-2 text-center person-info'>
        <div><img class='img-circle' src='".get_template_directory_uri()."/dist/images/events/submit_event_person.png' /></div>
        <div><small><b>Will Caperton y Montoya</b></small></div>
        <div><small>Director of Marketing and Development</small></div>
        </div>
        <div class='col-xs-12 col-sm-10 message'><ul>
        <li>Donec id elit non mi porta gravida at eget metus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec id elit non mi porta.</li>
        <li>Non mi porta gravida at eget metus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam.</li>
        <li>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</li>
        </ul></div></div>";
}
add_action('tribe_events_community_before_form_submit', __NAMESPACE__ . '\\after_events_community_text'); */



/**
 * Ajax function to load more cultural centers
 */
function more_cultural_centers(){
  wp_reset_postdata();
  global $wpdb;
  global $post;

  if ( isset( $_POST["page"] ) ) {
    $paged_value = $_POST['page']+1 ?: 0;
  }else {
    $paged_value = 0; 
  }
  if ( isset( $_POST["filterVal"] ) ) {
    $filter_val = $_POST['filterVal'];
  } else {
    $filter_val = 'all';
  }
  if ( isset( $_POST["artClasses"] ) ) {
    $art_classes_value = $_POST['artClasses'];
  } else {
    $art_classes_value = '0';
  }

  // If no cat filter is active and no art classes filter is active
    if( $filter_val == 'all' && $art_classes_value == '0' ) {
      $cultural_center_arg = array(
          'post_type' => 'cultural_center',
          'orderby' => 'title',
          'order' => 'ASC',
          'posts_per_page' => 20,
          'post_status' => 'publish',
          'paged' => $paged_value
          );
    }else {
      // If no cat filter is active
      if ($filter_val == 'all') {
        $cultural_center_arg = array(
            'post_type' => 'cultural_center',
            'orderby' => 'title',
            'order' => 'ASC',
            'posts_per_page' => 20,
            'post_status' => 'publish',
            'paged' => $paged_value,
              'meta_query' => array(
                array(
                  'key'     => 'art_classes_available',
                  'value'   => '1',
                  'compare' => '=='
                )
              )
            );
      }else {
        // If no art classes filter is active
        if ($art_classes_value == '0'){
          $art_class_arg = '';
        }else {
          $art_class_arg = array(
              array(
                    'key'     => 'art_classes_available',
                    'value'   => '1',
                    'compare' => '=='
                  )
            );
        }
        $cultural_center_arg = array(
            'post_type' => 'cultural_center',
            'orderby' => 'title',
            'order' => 'ASC',
            'posts_per_page' => 20,
            'post_status' => 'publish',
            'paged' => $paged_value,
            'taxonomy'=>'cultural-center-categories',
            'term'=> $filter_val,
            'meta_query' => $art_class_arg,
          );
      }

    }

  $ct = 0;
  $cultural_center_list = new \WP_Query($cultural_center_arg);

  if($cultural_center_list->have_posts()){

    while($cultural_center_list->have_posts()) {

      $cultural_center_list->the_post();

            // vars
            $title      = get_the_title();
            $permalink  = get_the_permalink();
            $thumbnail_obj = get_field('hero_image');;
            $thumbnail = $thumbnail_obj['url'];
            $content  = get_the_excerpt();

            // Get post categories
            $post_cats = get_the_terms( get_the_ID(), 'cultural-center-categories' );
                        
            if ( $post_cats && ! is_wp_error( $post_cats ) ) : 

              $post_cat_class = '';

              foreach ( $post_cats as $post_cat ) {
                $post_cat_class = str_replace(" ", "-", strtolower($post_cat->name)). ' ';
              }

            endif;

            $ct++;

            echo '<div class="col-xs-12 col-sm-3 cultural-center '.$post_cat_class.'">
            <div class="cultural-center-box">
              <a href="'.get_the_permalink().'">
                <div class="thumb-container"><img src="'.$thumbnail.'" /></div>
                <h2>'.$title.'</h2>';

            if(get_field('art_classes_available')):
              echo '<span class="art-classes">Art Classes Available</span>';
            endif;

            echo '</a></div></div>';

    }
    if($cultural_center_list->max_num_pages > $paged_value ){

      echo'
            <nav class="more-nav">
              <div class="more-nav-container">
                <button data-page="'.$paged_value.'" data-filter-class="all" class="load-more-btn btn btn-lg btn-more">Load More</button>
              </div>
            </nav>';

    }
    wp_reset_postdata();
  }else {
    echo '
    <div class="row no-results"><div class="col-sm-12 text-center">Sorry we couldn\'t find any cultural centers that matched the criteria of the filter.</div></div>';
  }
  die();
}
add_action( 'wp_ajax_nopriv_more_cultural_centers', __NAMESPACE__ . '\\more_cultural_centers' );
add_action( 'wp_ajax_more_cultural_centers', __NAMESPACE__ . '\\more_cultural_centers' );

/**
 * Ajax function to load more cultural centers
 */
function more_artist_projects(){
  wp_reset_postdata();
  global $wpdb;
  global $post;

  if ( isset( $_POST["page"] ) ) {
    $paged_value = $_POST['page']+1 ?: 0;
  }else {
    $paged_value = 0; 
  }
  if ( isset( $_POST["filterVal"] ) ) {
    $filter_val = $_POST['filterVal'];
  } else {
    $filter_val = 'all';
  }

  
      // If no cat filter is active
      if ($filter_val == 'all') {
        $cultural_center_arg = array(
            'post_type' => 'artists-projects',
            'posts_per_page' => 20,
            'order' => 'DESC',
            'paged' => $paged_value,
            );
      }else {
        
        $cultural_center_arg = array(
            'post_type' => 'artists-projects',
            'posts_per_page' => 20,
            'order' => 'DESC',
            'paged' => $paged_value,
            'taxonomy'=>'artist-project-type',
            'term'=> $filter_val,
          );
      }

    

  $ct = 0;
  
  $cultural_center_list = new \WP_Query($cultural_center_arg);

  if($cultural_center_list->have_posts()){

    while($cultural_center_list->have_posts()) {

      $cultural_center_list->the_post();

            // vars
            $title      = get_the_title();
            $permalink  = get_the_permalink();
            $thumbnail_obj = get_the_post_thumbnail();
            $content  = get_the_excerpt();

            // Get post categories
            $post_cats = get_the_terms( get_the_ID(), 'artist-project-type' );
                        
            if ( $post_cats && ! is_wp_error( $post_cats ) ) : 

              $post_cat_class = '';

              foreach ( $post_cats as $post_cat ) {
                $post_cat_class = str_replace(" ", "-", strtolower($post_cat->name)). ' ';
              }

            endif;

            $ct++;

            echo '<div class="col-xs-12 col-sm-3 artist-project '.$post_cat_class.'">
            <div class="artist-project-box">
              <a href="'.get_the_permalink().'">
                <div class="thumb-container">'.$thumbnail_obj.'</div>
                <h2>'.$title.'</h2>';

            

            echo '</a></div></div>';

    }
    if($cultural_center_list->max_num_pages > $paged_value ){

      echo'
            <nav class="more-nav">
              <div class="more-nav-container">
                <button data-page="'.$paged_value.'" data-filter-class="all" class="load-more-btn btn btn-lg btn-more">Load More</button>
              </div>
            </nav>';

    }
    wp_reset_postdata();
  }else {
    echo '
    <div class="row no-results"><div class="col-sm-12 text-center">Sorry we couldn\'t find any cultural centers that matched the criteria of the filter.</div></div>';
  }
  die();
}
add_action( 'wp_ajax_nopriv_more_artist_projects', __NAMESPACE__ . '\\more_artist_projects' );
add_action( 'wp_ajax_more_artist_projects', __NAMESPACE__ . '\\more_artist_projects' );



/**
 * Ajax function to load more grants
 */
function more_grants(){
  wp_reset_postdata();
  global $wpdb;
  global $post;

  if ( isset( $_POST["page"] ) ) {
    $paged_value = $_POST['page']+1 ?: 0;
  }else {
    $paged_value = 0; 
  }
  
  // If no cat filter is active and no art classes filter is active
  $grant_arg = array(
    'post_type' => 'grant_and_call',
    'posts_per_page' => 20,
    'order' => 'DESC',
    'paged' => $paged_value
        );


  $grant_list = new \WP_Query($grant_arg);

  if($grant_list->have_posts()){

    while($grant_list->have_posts()) {

      $grant_list->the_post();

            // vars
            $title      = get_the_title();
            $permalink  = get_the_permalink();
            $deadline = get_field('deadline');
            $format = "M j, Y - g:i a";
            $timestamp = get_field( 'deadline' );
            $amount = get_field('amount');
            $eligible_for_individuals = get_field('eligible_for_individuals');


            echo '
            <div class="row grant-row">
            <div class="col-xs-5 col-sm-2">
            <div class="deadline-column">
            '.date_i18n( $format, strtotime($timestamp )).'
            </div>
            </div>
            <div class="col-xs-7 col-sm-8">
              <a href="'.get_the_permalink().'">'.$title.'</a>
              ';
              echo ($eligible_for_individuals)?'<div class="elegibility">Eligible for Individuals</div>':'';
              echo '</div>';

            echo '<div class="hidden-xs col-sm-2">'.$amount.'</div></div>';

    }
    if($grant_list->max_num_pages > $paged_value ){

      echo'
            <nav class="more-nav">
              <div class="more-nav-container">
                <button data-page="'.$paged_value.'" data-filter-class="all" class="load-more-btn btn btn-lg btn-more">Load More</button>
              </div>
            </nav>';

    }
    wp_reset_postdata();
  }else {
    echo '
    <div class="row no-results"><div class="col-sm-12 text-center">Sorry we couldn\'t find any grants that matched the criteria of the filter.</div></div>';
  }
  die();
}
add_action( 'wp_ajax_nopriv_more_grants', __NAMESPACE__ . '\\more_grants' );
add_action( 'wp_ajax_more_grants', __NAMESPACE__ . '\\more_grants' );
