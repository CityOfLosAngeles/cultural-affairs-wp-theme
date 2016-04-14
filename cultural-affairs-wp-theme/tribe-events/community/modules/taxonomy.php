<?php
/**
 * Event Submission Form Taxonomy Block
 * Renders the taxonomy field in the submission form.
 *
 * Override this template in your own theme by creating a file at
 * [your-theme]/tribe-events/community/modules/taxonomy.php
 *
 * @package Tribe__Events__Community__Main
 * @since  3.1
 * @author Modern Tribe Inc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$event_cats = get_terms( Tribe__Events__Main::TAXONOMY, array( 'hide_empty' => false ) );

// only display categories if there are any
if ( ! empty( $event_cats ) ) {
	?>
	<!-- Event Categories -->
	<?php do_action( 'tribe_events_community_before_the_categories' ); ?>
	<div class="tribe-events-community-details eventForm bubble" id="event_taxonomy">
		<table class="tribe-community-event-info" cellspacing="0" cellpadding="0">
			
			<tr>
				<td><?php Tribe__Events__Community__Main::instance()->formCategoryDropdown( get_post() ); ?></td>
			</tr>
		</table><!-- .tribe-community-event-info -->
	</div><!-- .tribe-events-community-details -->
	<?php
	do_action( 'tribe_events_community_after_the_categories' );
}
