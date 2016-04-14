<?php
/**
 * Event Submission Form Website Block
 * Renders the website fields in the submission form.
 *
 * Override this template in your own theme by creating a file at
 * [your-theme]/tribe-events/community/modules/website.php
 *
 * @package Tribe__Events__Community__Main
 * @since  3.1
 * @author Modern Tribe Inc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// If posting back, then use $POST values
if ( ! $_POST ) {
	$event_url = function_exists( 'tribe_get_event_website_url' ) ? tribe_get_event_website_url() : tribe_community_get_event_website_url();
} else {
	$event_url = isset( $_POST['EventURL'] ) ? esc_attr( $_POST['EventURL'] ) : '';
}

?>

<!-- Event Website -->
<?php do_action( 'tribe_events_community_before_the_website' ); ?>

<div class="tribe-events-community-details eventForm bubble" id="event_website">
	<?php $small_div = "col-xs-12 col-sm-4 label-sm-right"; $big_div="col-xs-12 col-sm-8"; ?>

	<div class="row">
		<div class="<?= $small_div ?>">
			<?php tribe_community_events_field_label( 'EventURL', __( 'Event Website:', 'tribe-events-community' ) ); ?>
		</div>
		<div class="<?= $big_div ?>">
			<input type="text" id="EventURL" name="EventURL" size="25" value="<?php echo esc_url( $event_url ); ?>" />
		</div>
	</div>

	<table class="tribe-community-event-info" cellspacing="0" cellpadding="0"></table><!-- #event_cost -->

</div><!-- .tribe-events-community-details -->

<?php
do_action( 'tribe_events_community_after_the_website' );