<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php 
    $hero_image = get_field('hero_image');
    ?>
    <div class="hero-area" style="background-image: url(<?php echo $hero_image['url']; ?>)"></div>
    <div class="container">
      <div class="">
        <div class="hidden-xs general-info-area col-sm-4 col-md-3">
          <div class="row">
            <div class="col-sm-12 rep-area">
              <?php 
              $location = get_field('location');
              if( !empty($location) ): ?>
              <img class="location" src="<?php echo $location; ?>" />
            <?php endif; ?>
            <h2>City Council Representative</h2>
            <img class="rep-photo" src="<?= get_field('representative_image') ?>" alt="<?= get_field('representative_name') ?> Picture" />
            <strong><?= get_field('representative_name') ?></strong>
            <?= get_field('representative_description') ?>
            <a href="<?= get_field('representative_website_url') ?>" class="btn"><?= __('Visit Website', 'sage'); ?></a>
          </div>
        </div>
      </div>
      <div class="main-area col-sm-8 col-md-9">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
        <?php 
        /*
        *  Query posts for a relationship value.
        *  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
        */
        $grantees = get_posts(array(
          'post_type' => 'grantee',
          'meta_query' => array(
            array(
              'key' => 'council_district', // name of custom field
              'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
              'compare' => 'LIKE'
              )
            )
          ));
          ?>
          <?php if( $grantees ): ?>
          <h2><?= __('Grantees in this District', 'sage'); ?></h2>
          <div class="row grantee-list">
            <hr class="sep" />
            <?php foreach( $grantees as $grantee ): ?>
            <div class="col-xs-12 col-sm-4">
              <div class="grantee-box">
                <a href="<?php echo get_permalink( $grantee->ID ); ?>">
                  <div class="grantee-img">
                    <?php 
                    if ( has_post_thumbnail( $grantee->ID ) ) { // check if the post has a Post Thumbnail assigned to it.
                      echo get_the_post_thumbnail($grantee->ID);
                    } 
                    ?>
                  </div>
                  
                  <h2><?php echo get_the_title( $grantee->ID ); ?></h2>
                  <div class="short-description"><?= get_field('short_description', $grantee->ID); ?></div>
                </a>
              </div>
            </div>
            <?php endforeach; ?>
            <hr class="sep" />
          </div>
          <a href="/grantees" title="View All Grantees" class="btn">View All Grantees</a>
          <?php endif; ?>
          <?php 
            /*
            *  Query posts for a relationship value.
            *  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
            */
            $cultural_centers = get_posts(array(
              'post_type' => 'cultural_center',
              'meta_query' => array(
                array(
                  'key' => 'council_district', // name of custom field
                  'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
                  'compare' => 'LIKE'
                  )
                )
              ));
              ?>
          <?php if( $cultural_centers ): ?>
          <h2><?= __('Cultural Centers in this District', 'sage'); ?></h2>
          <div class="row cultural-center-list">
            <hr class="sep" />
            <?php foreach( $cultural_centers as $cultural_center ): ?>
              <div class="col-xs-12 col-sm-4 cultural-center">
                <div class="cultural-center-box">
                  <a href="<?php echo get_permalink( $cultural_center->ID ) ?>">
                    <?php 
                    $hero_image = get_field('hero_image', $cultural_center->ID);
                    ?>
                    <div class="thumb-container"><img src="<?php echo $hero_image['url']; ?>" /></div>
                    <h2><?php echo get_the_title( $cultural_center->ID ) ?></h2>
                    <?php if(get_field('art_classes_available', $cultural_center->ID)): ?>
                      <span class="art-classes"><?= __('Art Classes Available', 'sage'); ?></span>
                    <?php endif; ?>
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
            <hr class="sep" />
          </div>
          <a href="/cultural-centers" title="View All Cultural Centers" class="btn">View All Cultural Centers</a>
          <?php endif; ?>
          <?php 
              /*
              *  Query posts for a relationship value.
              *  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
              */
              $posts = get_posts(array(
                'post_type' => 'tribe_events',
                'posts_per_page'  => 10,
                'meta_key'      => '_EventStartDate',
                'orderby'     => 'meta_value_num',
                'order'       => 'ASC',
                'meta_query' => array(
                  array(
                    'key' => 'council_district', // name of custom field
                    'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
                    'compare' => 'LIKE'
                    ),
                  array(
                    'key' => '_EventEndDate', // name of custom field
                    'value' => '' . date('Y-m-d H:i:s') . '', // matches exaclty "123", not just 123. This prevents a match for "1234"
                    'compare' => '>='
                    )
                  )
                ));
                ?>
          <?php if( $posts ): ?>
          <h2 class="events-title"><?= __('Upcoming Events in this District', 'sage'); ?></h2>
          <div id="tribe-events-content" class="tribe-events-list">
            <?php foreach( $posts as $post ): ?>
              <?php setup_postdata($post); ?>
              <div class="type-tribe_events tribe-clearfix">
                <?php tribe_get_template_part( 'list/single-event' ) ?>
              </div>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
          </div>
          <a href="/events" title="View All Events" class="btn">View All Events</a>
          <?php endif; ?>
          <?php 
            /*
            *  PERCENT FOR PUBLIC ART PROJECTS
            */
            $artists_projects = get_posts(array(
              'post_type' => 'artists-projects',
              'taxonomy'=>'artist-project-type',
              'term'=> 'percent-for-public-arts',
              'meta_query' => array(
                array(
                  'key' => 'council_district', // name of custom field
                  'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
                  'compare' => 'LIKE'
                  )
                )
              ));
              ?>
          <?php if( $artists_projects ): ?>
          <h2><?= __('Artists Projects in this District', 'sage'); ?></h2>
          <div class="row artists-project-list">
            <hr class="sep" />
            <?php foreach( $artists_projects as $artists_project ): ?>
            <div class="col-xs-12 col-sm-4">
              <div class="artists-project-box">
                <a href="<?php echo get_permalink( $artists_project->ID ); ?>">
                  <div class="artists-project-img">
                    <?php 
                    if ( has_post_thumbnail( $artists_project->ID ) ) { // check if the post has a Post Thumbnail assigned to it.
                      echo get_the_post_thumbnail($artists_project->ID);
                    } 
                    ?>
                  </div>
                  <h2><?php echo get_the_title( $artists_project->ID ); ?></h2>
                  <div class="short-description"><?= get_field('short_description', $artists_project->ID); ?></div>
                </a>
              </div>
            </div>
            <?php endforeach; ?>
            <hr class="sep" />
          </div>
          <a href="/percent-public-art/percent-public-art-projects" title="View All Artists Projects" class="btn">View All Artists Projects</a>
          <?php endif; ?>
          <?php 
            /*
            *  MURALS
            */
            $murals_projects = get_posts(array(
              'post_type' => 'artists-projects',
              'taxonomy'=>'artist-project-type',
              'term'=> 'murals',
              'meta_query' => array(
                array(
                  'key' => 'council_district', // name of custom field
                  'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
                  'compare' => 'LIKE'
                  )
                )
              ));
              ?>
          <?php if( $murals_projects ): ?>
          <h2><?= __('Murals in this District', 'sage'); ?></h2>
          <div class="row murals-project-list">
            <hr class="sep" />
            <?php foreach( $murals_projects as $murals_project ): ?>
              <div class="col-xs-12 col-sm-4">
                <div class="murals-project-box">
                  <a href="<?php echo get_permalink( $murals_project->ID ); ?>">
                    <div class="murals-project-img">
                      <?php 
                      if ( has_post_thumbnail( $murals_project->ID ) ) { // check if the post has a Post Thumbnail assigned to it.
                        echo get_the_post_thumbnail($murals_project->ID);
                      } 
                      ?>
                    </div>
                    <h2><?php echo get_the_title( $murals_project->ID ); ?></h2>
                    <div class="short-description"><?= get_field('short_description', $murals_project->ID); ?></div>
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
            <hr class="sep" />
          </div>
          <a href="/murals" title="View All Murals" class="btn">View All Murals</a>
          <?php endif; ?>
      </div>
    </div>
  </div>
</article>
<?php endwhile; ?>
