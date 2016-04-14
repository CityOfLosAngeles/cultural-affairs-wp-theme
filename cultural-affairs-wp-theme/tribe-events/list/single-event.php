<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// Venue microformats
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

?>

<div class="row">
	<div class="col-xs-12 col-sm-6 event-extra-info">
		<div class="col-xs-12 col-md-6 meta-info">
			<!-- Event Meta -->
			<?php do_action( 'tribe_events_before_the_meta' ) ?>
			<div class="tribe-events-event-meta vcard">
				<div class="author <?php echo esc_attr( $has_venue_address ); ?>">

					<!-- Schedule & Recurrence Details -->
					<div class="updated published time-details">
						<?php echo tribe_events_event_schedule_details() ?>
					</div>

					<?php if ( $venue_details ) : ?>
						<!-- Venue Display Info -->
						<div class="tribe-events-venue-details">
							<?php echo implode( ', ', $venue_details ); ?>
						</div> <!-- .tribe-events-venue-details -->
					<?php endif; ?>

				</div>
			</div><!-- .tribe-events-event-meta -->
			<?php do_action( 'tribe_events_after_the_meta' ) ?>

		</div>
		<div class="col-xs-12 col-md-6">
			<!-- Event Image -->

			<?php
			if ( has_post_thumbnail() ) {
			    echo tribe_event_featured_image( null, 'medium' );
			}
			else {
			$terms = get_the_terms( get_the_ID(), 'tribe_events_cat' );
			                         
			if ( $terms && ! is_wp_error( $terms ) ) : 
			 
			 
			    foreach ( $terms as $term ) {
			    	$default_image_url = get_field('default_image', $term);
			    	if ( $default_image_url ) {
			    		?>
			    		<img src="<?php echo $default_image_url ?>" alt="<?= $term->name ?> Default Image" class="attachment-medium size-medium wp-post-image" />
			    		<?php
			    	}
			    }

			    endif;
			}
			?>

		</div>
	</div>
	<div class="col-xs-12 col-sm-6">
		<!-- Event Cost -->
		<?php if ( tribe_get_cost() ) : ?>
			<div class="tribe-events-event-cost">
				<span><?php echo tribe_get_cost( null, true ); ?></span>
			</div>
		<?php endif; ?>

		<!-- Event Title -->
		<?php do_action( 'tribe_events_before_the_event_title' ) ?>
		<h2 class="tribe-events-list-event-title entry-title summary">
			<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
				<?php the_title() ?>
			</a>
		</h2>
		<?php do_action( 'tribe_events_after_the_event_title' ) ?>

		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ) ?>
		<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
			<?php the_excerpt() ?>
			<div class="tags-container">
				<?php
				// Event tags
				$posttags = get_the_tags();
				if ($posttags) {
				  foreach($posttags as $tag) {
				      ?><span class="tag"><?php echo $tag->name; ?></span><?php
				  }
				}
				?>
			</div>
		</div><!-- .tribe-events-list-event-description -->
		<?php
		do_action( 'tribe_events_after_the_content' );
		?>
	</div>
</div>



