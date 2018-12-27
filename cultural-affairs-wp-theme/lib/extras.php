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
 * Custom breadcrumbs
 */

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
  echo "<div class='intro'>DCA's Marketing, Development, Design, and Digital Research Division curates cultural events in the LA region. We invite you to submit DCA-sponsored events and other cultural events to be included in the DCA's web calendar, Festival Guide, and  our Heritage Month Calendars and Cultural Guides. We review all submissions and do not accept non-arts/cultural events.</div>"; 
}
add_action('tribe_events_community_form_before_template', __NAMESPACE__ . '\\before_events_community_text'); 

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


/**
 * Ajax function to load more cultural centers
 */

function tribe_event_rest(){

  $event_ID = $_POST['eventid'];

  $resultApi = file_get_contents('https://culturela.org/wp-json/tribe/events/v1/events/'.$event_ID);

  $data = json_decode($resultApi, true);

  $newArray = array();

  $uuid = trim(file_get_contents('https://www.uuidgenerator.net/api/version4'));

  $newArray['uuid'] = $uuid;
  $newArray['externalid'] = $data['id'];
  $newArray['rid'] = $data['id'];
  $newArray['title'] = $data['title'];
  $newArray['start'] = $data['start_date'];
  $newArray['end'] = $data['end_date'];
  $newArray['informationwebsite'] = $data['website'];
  $newArray['locationname'] = $data['venue']['venue'];
  $newArray['address'] = $data['venue']['address'];
  $newArray['city'] = $data['venue']['city'];
  $newArray['state'] = $data['venue']['state'];
  $newArray['zip'] = $data['venue']['zip'];
  $newArray['lat'] = $data['venue']['geo_lat'];
  $newArray['long'] = $data['venue']['geo_lng'];
  $newArray['eventimage'] = $data['image']['url'];
  $newArray['eventtype'] = "(ITA will provide you this)";
  $newArray['department'] = "(ITA will provide you this)";
  $newArray['description'] = $data['description'];
  $tags = '';
  if($data['categories']) {
      foreach ($data['categories'] as $tag) {
          $tags .= $tag['name'].",";
      }
  }
  $newArray['tags'] = $tags;
  $newArray['eventfile'] = '';
  if ($data['cost'] == 'Free') {
      $cost = 'No';
  } else {
      $cost = 'Yes';
  }
  $newArray['eventcost'] = $cost;
  $newArray['eventfee'] = '';
  $newArray['eventages'] = '';
  $newArray['eventcontactemail'] = '';
  $newArray['eventcontactname'] = '';
  $newArray['eventcontactphone'] = $data['venue']['phone'];

  die(json_encode($newArray));

  
}
add_action( 'wp_ajax_nopriv_tribe_event_rest', __NAMESPACE__ . '\\tribe_event_rest' );
add_action( 'wp_ajax_tribe_event_rest', __NAMESPACE__ . '\\tribe_event_rest' );


function tribe_all_event_rest(){

  $resultApi = file_get_contents('https://culturela.org/wp-json/tribe/events/v1/events/');

  $data = json_decode($resultApi, true);

  $newArray = array();

  $uuid = trim(file_get_contents('https://www.uuidgenerator.net/api/version4'));

  foreach ($data['events'] as $event) {

  $eventID = $event['id'];

  $newArray[$eventID]['uuid'] = $uuid;
  $newArray[$eventID]['externalid'] = $event['id'];
  $newArray[$eventID]['rid'] = $event['id'];
  $newArray[$eventID]['title'] = $event['title'];
  $newArray[$eventID]['start'] = $event['start_date'];
  $newArray[$eventID]['end'] = $event['end_date'];
  $newArray[$eventID]['informationwebsite'] = $event['website'];
  $newArray[$eventID]['locationname'] = $event['venue']['venue'];
  $newArray[$eventID]['address'] = $event['venue']['address'];
  $newArray[$eventID]['city'] = $event['venue']['city'];
  $newArray[$eventID]['state'] = $event['venue']['state'];
  $newArray[$eventID]['zip'] = $event['venue']['zip'];
  $newArray[$eventID]['lat'] = $event['venue']['geo_lat'];
  $newArray[$eventID]['long'] = $event['venue']['geo_lng'];
  $newArray[$eventID]['eventimage'] = $event['image']['url'];
  $newArray[$eventID]['eventtype'] = "(ITA will provide you this)";
  $newArray[$eventID]['department'] = "(ITA will provide you this)";
  $newArray[$eventID]['description'] = $event['description'];
  $tags = '';
  if($event['categories']) {
    foreach ($event['categories'] as $tag) {
        $tags .= $tag['name'].",";
    }
  }
  $newArray[$eventID]['tags'] = $tags;
  $newArray[$eventID]['eventfile'] = '';
  if ($event['cost'] == 'Free') {
      $cost = 'No';
  } else {
      $cost = 'Yes';
  }
  $newArray[$eventID]['eventcost'] = $cost;
  $newArray[$eventID]['eventfee'] = '';
  $newArray[$eventID]['eventages'] = '';
  $newArray[$eventID]['eventcontactemail'] = '';
  $newArray[$eventID]['eventcontactname'] = '';
  $newArray[$eventID]['eventcontactphone'] = $event['venue']['phone'];

  
}

  die(json_encode($newArray));

  
}
add_action( 'wp_ajax_nopriv_tribe_all_event_rest', __NAMESPACE__ . '\\tribe_all_event_rest' );
add_action( 'wp_ajax_tribe_all_event_rest', __NAMESPACE__ . '\\tribe_all_event_rest' );

 
// Return all post IDs
function walden_get_all_post_ids($eventid) {
  $event_id = $eventid['id'];
  $event_page = $eventid['page'];
  
  if ($event_id) {
  $resultApi = file_get_contents('https://culturela.org/wp-json/tribe/events/v1/events/'.$event_id);
  } else {
    if ($event_page) {
      $resultApi = file_get_contents('https://culturela.org/wp-json/tribe/events/v1/events?page='.$event_page.'&per_page=100');
    } else {
      $resultApi = file_get_contents('https://culturela.org/wp-json/tribe/events/v1/events/?per_page=100');
    }
  }

  $data = json_decode($resultApi, true);

  $newArray = array();

  $uuid = trim(file_get_contents('https://www.uuidgenerator.net/api/version4'));

  if ($event_id) {
  $newArray['uuid'] = $uuid;
  $newArray['externalid'] = $data['id'];
  $newArray['rid'] = $data['id'];
  $newArray['title'] = $data['title'];
  $newArray['start'] = $data['start_date'];
  $newArray['end'] = $data['end_date'];
  $newArray['informationwebsite'] = $data['website'];
  $newArray['locationname'] = $data['venue']['venue'];
  $newArray['address'] = $data['venue']['address'];
  $newArray['city'] = $data['venue']['city'];
  $newArray['state'] = $data['venue']['state'];
  $newArray['zip'] = $data['venue']['zip'];
  $newArray['lat'] = $data['venue']['geo_lat'];
  $newArray['long'] = $data['venue']['geo_lng'];
  $newArray['eventimage'] = $data['image']['url'];
  $newArray['eventtype'] = "(ITA will provide you this)";
  $newArray['description'] = $data['description'];
  $tags = '';
  if($data['categories']) {
      foreach ($data['categories'] as $tag) {
          $tags .= $tag['name'].",";
      }
  }
  $newArray['tags'] = $tags;
  $newArray['eventfile'] = '';
  if ($data['cost'] == 'Free') {
      $cost = 'No';
  } else {
      $cost = 'Yes';
  }
  $newArray['eventcost'] = $cost;
  $newArray['eventfee'] = $data['cost'];
  $newArray['eventcontactemail'] = $data['organizer']['email'];
  $newArray['eventcontactname'] = $data['organizer']['organizer'];
  $newArray['eventcontactphone'] = $data['organizer']['phone'];
  $finalArray = array();
  $finalArray = $newArray;
  } else {

    foreach ($data['events'] as $event) {

      $eventID = $event['id'];

      $newArray[$eventID]['uuid'] = $uuid;
      $newArray[$eventID]['externalid'] = $event['id'];
      $newArray[$eventID]['rid'] = $event['id'];
      $newArray[$eventID]['title'] = $event['title'];
      $newArray[$eventID]['start'] = $event['start_date'];
      $newArray[$eventID]['end'] = $event['end_date'];
      $newArray[$eventID]['informationwebsite'] = $event['website'];
      $newArray[$eventID]['locationname'] = $event['venue']['venue'];
      $newArray[$eventID]['address'] = $event['venue']['address'];
      $newArray[$eventID]['city'] = $event['venue']['city'];
      $newArray[$eventID]['state'] = $event['venue']['state'];
      $newArray[$eventID]['zip'] = $event['venue']['zip'];
      $newArray[$eventID]['lat'] = $event['venue']['geo_lat'];
      $newArray[$eventID]['long'] = $event['venue']['geo_lng'];
      $newArray[$eventID]['eventimage'] = $event['image']['url'];
      $newArray[$eventID]['description'] = $event['description'];
      $tags = '';
      if($event['categories']) {
        foreach ($event['categories'] as $tag) {
            $tags .= $tag['name'].",";
        }
      }
      $newArray[$eventID]['tags'] = $tags;
      $newArray[$eventID]['eventfile'] = '';
      if ($event['cost'] == 'Free') {
          $cost = 'No';
      } else {
          $cost = 'Yes';
      }
      $newArray[$eventID]['eventcost'] = $cost;
      $newArray[$eventID]['eventfee'] = $event['cost'];
      $newArray[$eventID]['eventcontactemail'] = '';
      $newArray[$eventID]['eventcontactname'] = '';
      $newArray[$eventID]['eventcontactphone'] = $event['venue']['phone'];

      
    }
    $finalArray = array();
    $finalArray['events'] = $newArray;
    $finalArray['total'] = $data['total'];
    $finalArray['total_pages'] = $data['total_pages'];
  }
die(json_encode($finalArray,true));
}

function rest_event_func() {
  register_rest_route( 'events/v1', '/dca-events/', array(
    'methods' => 'GET',
    'callback' => __NAMESPACE__ . '\\walden_get_all_post_ids',
   ));
  register_rest_route( 'events/v1', '/dca-events/page=(?P<page>\d+)', array(
    'methods' => 'GET',
    'callback' => __NAMESPACE__ . '\\walden_get_all_post_ids',
   ));
  register_rest_route( 'events/v1', '/dca-events/id=(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => __NAMESPACE__ . '\\walden_get_all_post_ids',
   ));
}

 add_action( 'rest_api_init', __NAMESPACE__ . '\\rest_event_func' );

add_filter( 'tribe_rest_event_max_per_page', function() { return 100; } );


function separate_result_types($hits) {
    $types = array();
    if (!is_array($types['program_initiative'])) $types['program_initiative'] = array();
    if (!is_array($types['cultural_center'])) $types['cultural_center'] = array();
    if (!is_array($types['contact-division'])) $types['contact-division'] = array();
    if (!is_array($types['grantee'])) $types['grantee'] = array();
    if (!is_array($types[''])) $types['grant_and_call'] = array();
    if (!is_array($types['council_districtgrant_and_call'])) $types['council_district'] = array();
    if (!is_array($types['artists-projects'])) $types['artists-projects'] = array();
    if (!is_array($types['murals'])) $types['murals'] = array();
    if (!is_array($types['page'])) $types['page'] = array();
    if (!is_array($types['post'])) $types['post'] = array();
 
    // Split the post types in array $types
    if (!empty($hits)) {
        foreach ($hits[0] as $hit) {
            if (!is_array($types[$hit->post_type])) $types[$hit->post_type] = array();                        
            array_push($types[$hit->post_type], $hit);
        }
    }

    // Merge back to $hits in the desired order
    $hits[0] = array_merge($types['page'], $types['grant_and_call'], $types['murals'], $types['cultural_center'], $types['program_initiative'],  $types['contact-division'], $types['grantee'],  $types['council_district'], $types['artists-projects'], $types['post']);

    return $hits;
}


function rlv_exact_boost($results) {
  $query = strtolower(get_search_query());
  foreach ($results as $post_id => $weight) {
    $post = relevanssi_get_post($post_id);
    // Boost exact title matches
    if (stristr($post->post_title, $query) != false) {
      $results[$post_id] = $weight * 50;
    }
    if (strcmp(strtolower($post->post_title), $query) == 0) {
      $results[$post_id] = $weight * 100;
    }
  }
  return $results;
}
add_filter('relevanssi_results', __NAMESPACE__ . '\\rlv_exact_boost');
 