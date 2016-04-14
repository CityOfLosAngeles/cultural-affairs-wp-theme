<?php
/**
 * Event Submission Form Metabox For Organizers
 * This is used to add a metabox to the event submission form to allow for choosing or
 * creating an organizer for user submitted events.
 *
 * Override this template in your own theme by creating a file at
 * [your-theme]/tribe-events/community/modules/organizer.php
 *
 * @package Tribe__Events__Community__Main
 * @since  2.1
 * @author Modern Tribe Inc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! isset( $event ) ) {
	$event = null;
}
?>

<!-- Organizer -->
<div class="tribe-events-community-details eventForm bubble" id="event_organizer">

	<div class="row">
		<div class="col-xs-12 col-sm-offset-1 col-sm-7">

	<table class="tribe-community-event-info" cellspacing="0" cellpadding="0">

		<?php
		// The organizer meta box will render everything within a <tbody>
		$organizer_meta_box = new Tribe__Events__Admin__Organizer_Chooser_Meta_Box( $event );
		$organizer_meta_box->render();
		?>

	</table> <!-- #event_organizer -->
	</div>
	</div>
</div>