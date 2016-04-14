<?php
/**
 * Event Submission Form Metabox For Venues
 * This is used to add a metabox to the event submission form to allow for choosing or
 * creating a venue for user submitted events.
 *
 * This is ALSO used in the Venue edit view. Be careful to test changes in both places.
 *
 * Override this template in your own theme by creating a file at
 * [your-theme]/tribe-events/community/modules/venue.php
 *
 * @package Tribe__Events__Community__Main
 * @since  2.1
 * @author Modern Tribe Inc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_label_singular = tribe_get_venue_label_singular();

// If posting back, then use $POST values
if ( ! $_POST ) {
	$postId  = Tribe__Events__Main::postIdHelper();

	$venue_name = tribe_get_venue();
	$venue_phone = tribe_get_phone();
	$venue_website = strip_tags( tribe_get_venue_website_link( null, null ) );
	$venue_address = tribe_get_address();
	$venue_city = tribe_get_city();
	$venue_province = tribe_get_province();
	$venue_state = tribe_get_state();
	$venue_country = tribe_get_country();
	$venue_zip = tribe_get_zip();
	$venue_show_map_link = get_post_meta( $postId, '_EventShowMapLink', true );
	$venue_show_map = tribe_embed_google_map( $postId );
} else {
	$venue_name = isset( $_POST['venue']['Venue'] ) ? esc_attr( $_POST['venue']['Venue'] ) : '';
	$venue_phone = isset( $_POST['venue']['Phone'] ) ? esc_attr( $_POST['venue']['Phone'] ) : '';
	$venue_website = isset( $_POST['venue']['URL'] ) ? esc_attr( $_POST['venue']['URL'] ) : '';
	$venue_address = isset( $_POST['venue']['Address'] ) ? esc_attr( $_POST['venue']['Address'] ) : '';
	$venue_city = isset( $_POST['venue']['City'] ) ? esc_attr( $_POST['venue']['City'] ) : '';
	$venue_province = isset( $_POST['venue']['Province'] ) ? esc_attr( $_POST['venue']['Province'] ) : '';
	$venue_state = isset( $_POST['venue']['State'] ) ? esc_attr( $_POST['venue']['State'] ) : '';
	$venue_country = isset( $_POST['venue']['Country'] ) ? esc_attr( $_POST['venue']['Country'] ) : '';
	$venue_zip = isset( $_POST['venue']['Zip'] ) ? esc_attr( $_POST['venue']['Zip'] ) : '';
	$venue_show_map_link = isset( $_POST['EventShowMapLink'] ) ? esc_attr( $_POST['EventShowMapLink'] ) : '';
	$venue_show_map = isset( $_POST['EventShowMap'] ) ? esc_attr( $_POST['EventShowMap'] ) : '';
}

// function_exists check added for compatibility during update to 3.10
if ( ! tribe_get_venue_id() && function_exists( 'tribe_get_default_value' ) ) {
	$venue_phone = empty( $venue_phone ) ? tribe_get_default_value( 'phone' ) : $venue_phone;
	$venue_address = empty( $venue_address ) ? tribe_get_default_value( 'address' ) : $venue_address;
	$venue_city = empty( $venue_city ) ? tribe_get_default_value( 'city' ) : $venue_city;
	$venue_state = empty( $venue_state ) ? tribe_get_default_value( 'state' ) : $venue_state;
	$venue_province = empty( $venue_province ) ? tribe_get_default_value( 'province' ) : $venue_province;
	$venue_country = empty( $venue_country ) ? tribe_get_default_value( 'country' ) : $venue_country;
	if ( $venue_country && is_array( $venue_country ) ) {
		$venue_country = $venue_country[1];
	}
	$venue_zip = empty( $venue_zip ) ? tribe_get_default_value( 'zip' ) : $venue_zip;
}

if ( ! isset( $event ) ) {
	$event = null;
}
?>

<!-- Venue -->
<div class="tribe-events-community-details eventForm bubble" id="event_venue">
	<?php $small_div = "col-xs-12 col-sm-4 label-sm-right"; $big_div="col-xs-12 col-sm-4"; ?>
	<div class="row">
		<div class="col-xs-12 col-sm-offset-2 col-sm-8 select-venue">
			<?php tribe_community_events_venue_select_menu( $event ); ?>
		</div>
	</div>
	<?php if ( ! tribe_community_events_is_venue_edit_screen() ) { ?>
	<div class="row venue">
		<div class="<?= $small_div ?>">
			<label for="VenueVenue" <?php if ( $event && $_POST && empty( $venue_name ) ) echo 'class="error"'; ?>>
				<?php printf( __( '%s Name', 'tribe-events-community' ), $venue_label_singular ); ?>:
			</label>
		</div>
		<div class="<?= $big_div ?>">
			<input type="text" id="VenueVenue" name="venue[Venue]" size="25"  value="<?php esc_attr_e( $venue_name ); ?>" />
		</div>
	</div>
	<?php } ?>

	<div class="row venue">
		<div class="<?= $small_div ?>">
			<label for="VenueAddress">
				<?php esc_html_e( 'Address', 'tribe-events-community' ); ?>:
			</label>
		</div>
		<div class="<?= $big_div ?>">
			<input type="text" id="VenueAddress" name="venue[Address]" size="25" value="<?php esc_attr_e( $venue_address ); ?>" />
		</div>
	</div>

	<div class="row venue">
		<div class="<?= $small_div ?>">
			<label for="VenueCity">
				<?php esc_html_e( 'City', 'tribe-events-community' ); ?>:
			</label>
		</div>
		<div class="<?= $big_div ?>">
			<input type="text" id="VenueCity" name="venue[City]" size="25" value="<?php esc_attr_e( $venue_city ); ?>" />
		</div>
	</div>

	<div class="row venue">
		<div class="<?= $small_div ?>">
			<label for="EventCountry">
				<?php esc_html_e( 'Country', 'tribe-events-community' ); ?>:
			</label>
		</div>
		<div class="<?= $big_div ?>">
			<select class="chosen" name="venue[Country]" id="EventCountry">
				<?php
				foreach (
					Tribe__Events__View_Helpers::constructCountries() as $abbr => $fullname ) {
					echo '<option value="'. esc_attr( $fullname ) .'" ';

					selected( $venue_country == $fullname );
					echo '>' . esc_html( $fullname ) . '</option>';
				} ?>
			</select>
		</div>
	</div>

	<div class="row venue">
		<?php
		if ( ! isset( $venue_stateProvince ) || $venue_stateProvince == '' ) {
			$venue_stateProvince = -1;
		}
		?>
		<div class="<?= $small_div ?>">
			<label for="StateProvinceText">
				<?php esc_html_e( 'State or Province', 'tribe-events-community' ); ?>:
			</label>
		</div>
		<div class="<?= $big_div ?>">
			<input id="StateProvinceText" name="venue[Province]" type="text" name="" size="25" value="<?php echo esc_attr( isset( $venue_province ) && $venue_province != '' && $venue_province != -1 ? $venue_province : '' ); ?>" />
			<select class="chosen" id="StateProvinceSelect" name="venue[State]">
				<option value=""><?php esc_html_e( 'Select a State', 'tribe-events-community' ); ?></option>
				<?php foreach ( Tribe__Events__View_Helpers::loadStates() as $abbr => $fullname ) {
					echo '<option value="' . esc_attr( $abbr ) .'" ';
					selected( $venue_state == $abbr );
					echo '>'. esc_html( $fullname ) .'</option>'. "\n";
				} ?>
			</select>
		</div>
	</div>

	<div class="row venue">
		<div class="<?= $small_div ?>">
			<label for="EventZip">
				<?php esc_html_e( 'Postal Code', 'tribe-events-community' ); ?>:
			</label>
		</div>
		<div class="<?= $big_div ?>">
			<input type="text" id="EventZip" name="venue[Zip]" size="6" value="<?php esc_attr_e( $venue_zip ); ?>" />
		</div>
	</div>

	<div class="row venue">
		<div class="<?= $small_div ?>">
			<label for="EventPhone">
				<?php esc_html_e( 'Phone', 'tribe-events-community' ); ?>:
			</label>
		</div>
		<div class="<?= $big_div ?>">
			<input type="text" id="EventPhone" name="venue[Phone]" size="14" value="<?php esc_attr_e( $venue_phone ); ?>" />
		</div>
	</div>

	<div class="row venue">
		<div class="<?= $small_div ?>">
			<label for="EventWebsite">
				<?php esc_html_e( 'Website', 'tribe-events-community' ); ?>:
			</label>
		</div>
		<div class="<?= $big_div ?>">
			<input type="text" id="EventWebsite" name="venue[URL]" size="14" value="<?php esc_attr_e( $venue_website ); ?>" />
		</div>
	</div>
	<?php
	if ( ! tribe_community_events_is_venue_edit_screen() ) {
		?>
	<div class="row" id="google_map_link_toggle">
		<div class="<?= $small_div ?>">
			<label for="EventShowMapLink">
				<?php esc_html_e( 'Show Google Maps Link', 'tribe-events-community' ); ?>:
			</label>
		</div>
		<div class="<?= $big_div ?>">
			<input type="checkbox" id="EventShowMapLink" name="EventShowMapLink" value="1" <?php checked( $venue_show_map_link ); ?> />
		</div>
	</div>
	<?php
		if ( tribe_get_option( 'embedGoogleMaps', true ) ) {
			?>
		<div class="row" id="google_map_toggle">
			<div class="<?= $small_div ?>">
				<label for="EventShowMap">
					<?php esc_html_e( 'Show Google Map', 'tribe-events-community' ); ?>:
				</label>
			</div>
			<div class="<?= $big_div ?>">
				<input type="checkbox" id="EventShowMap" name="EventShowMap" value="1" <?php checked( $venue_show_map ); ?> />
			</div>
		</div>
		<?php
		}
	} // if ( tribe_community_events_is_venue_edit_screen() )
	?>

	<table class="tribe-community-event-info" cellspacing="0" cellpadding="0"></table><!-- #event_venue -->

</div>