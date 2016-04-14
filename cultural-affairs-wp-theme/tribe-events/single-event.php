<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<div id="tribe-events-content" class="tribe-events-single vevent hentry">

	

	<!-- Notices -->
	<?php tribe_events_the_notices() ?>
	<?php //echo tribe_events_event_schedule_details( $event_id, '<div class="date-time">', '</div>' ); ?>
	<?php the_title( '<h1 class="tribe-events-single-event-title summary entry-title">', '</h1>' ); ?>
	<?php
	echo tribe_get_event_categories(
		get_the_id(), array(
			'before'       => '<span class="cat">',
			'sep'          => '',
			'after'        => '</span>',
			'label'        => '', // An appropriate plural/singular label will be provided
			'label_before' => '<span class="hidden">',
			'label_after'  => '</span>',
			'wrap_before'  => '<div class="tribe-events-event-categories">',
			'wrap_after'   => '</div>',
		)
	);
	?>

	<div class="row">
		<div class="col-xs-12 col-sm-3 event-side-content">
			
			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
			<?php
			$terms = get_the_terms( get_the_ID(), 'tribe_events_cat' );
			                         
			if ( $terms && ! is_wp_error( $terms ) ) : 
			 
			 
			    foreach ( $terms as $term ) {
			    	$events_pdf = get_field('latest_events_list_pdf', $term);
			    	$events_pdf_message = get_field('events_list_pdf_message', $term);
			    	$events_pdf_thumb = get_field('events_list_pdf_thumbnail', $term);
			    	if ( $events_pdf ) {
			    		?>
			    		<div class="cat-pdf-sidebar">
							<div class="internal-wrap">
					    		<img src="<?php echo $events_pdf_thumb ?>" />
					    		<h2><?php echo $events_pdf_message; ?></h2>
					    		<a href="<?php echo $events_pdf ?>" class="btn full-cat-list" title="Download PDF" target="_blank">Download PDF</a>
					    	</div>
					    </div>
			    		<?php
			    	}
			    }

			?>
			<?php endif; ?>
		</div>
		<div class="col-xs-12 col-sm-9">
			<?php while ( have_posts() ) :  the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<!-- Event featured image, but exclude link -->
					<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>

					<!-- Event content -->
					<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
					<div class="tribe-events-single-event-description tribe-events-content entry-content description">
						<?php the_content(); ?>
					</div>
					<!-- .tribe-events-single-event-description -->
					<?php 
					// Remove export links
						//do_action( 'tribe_events_single_event_after_the_content' ) 
					?>

					<?php
					// Event Location and Organizer
					// If we have no map to embed and no need to keep the venue separate...
					if ( ! $set_venue_apart && ! tribe_embed_google_map() ) {
						tribe_get_template_part( 'modules/meta/venue' );
					} elseif ( ! $set_venue_apart && ! tribe_has_organizer() && tribe_embed_google_map() ) {
						// If we have no organizer, no need to separate the venue but we have a map to embed...
						tribe_get_template_part( 'modules/meta/venue' );
						echo '<div class="tribe-events-meta-group tribe-events-meta-group-gmap">';
						tribe_get_template_part( 'modules/meta/map' );
						echo '</div>';
					} else {
						// If the venue meta has not already been displayed then it will be printed separately by default
						$set_venue_apart = true;
					}

					?>


					<?php if ( $set_venue_apart ) : ?>
						<?php if ( $not_skeleton ) : ?>
							<div class="tribe-events-single-section tribe-events-event-meta secondary tribe-clearfix">
						<?php endif; ?>
						<?php
						do_action( 'tribe_events_single_event_meta_secondary_section_start' );

						tribe_get_template_part( 'modules/meta/venue' );
						tribe_get_template_part( 'modules/meta/map' );

						do_action( 'tribe_events_single_event_meta_secondary_section_end' );
						?>
						<?php
						if ( $not_skeleton ) : ?>
							</div>
						<?php endif; ?>
					<?php
					endif;


					// Include organizer meta if appropriate
					if ( tribe_has_organizer() ) {
						tribe_get_template_part( 'modules/meta/organizer' );
					}
					?>

					<?php
						// Ensure the global $post variable is in scope
						global $post;
						 
						// Retrieve the next 5 upcoming events
						$events = tribe_get_events( array(
						    'posts_per_page' => 5,
						    'start_date' => date("m-d-Y", strtotime('now')),
							'post__not_in' => array($post->ID)
						) );
						 
						// Loop through the events: set up each one as
						// the current post then use template tags to
						if ($events) {
							?>
									<div class="upcoming-events tribe-events-loop">
										<h2>Upcoming Events</h2>
										<?php

											// display the title and content
											foreach ( $events as $post ) {
											    setup_postdata( $post );
											 
											    // This time, let's throw in an event-specific
											    // template tag to show the date after the title!
											?>
													<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>">
														<?php tribe_get_template_part( 'list/single', 'event' ) ?>
													</div><!-- .hentry .vevent -->

											<?php
											}
										?>
									</div>
									<?php wp_reset_postdata(); ?>
							<?php
						}
					?>

					
				</div> <!-- #post-x -->
				<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
			<?php endwhile; ?>
		</div>
	</div>



	<div class="row">
		<div class="col-xs-12">
			<p class="tribe-events-back">
				<a class="btn btn-md" href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( __( 'View All %s', 'the-events-calendar' ), $events_label_plural ); ?></a>
			</p>
		</div>
	</div>
	

</div><!-- #tribe-events-content -->
