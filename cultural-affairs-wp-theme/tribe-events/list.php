	<?php
/**
 * List View Template
 * The wrapper template for a list of events. This includes the Past Events and Upcoming Events views
 * as well as those same views filtered to a specific category.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

do_action( 'tribe_events_before_template' );
?>

<?php $current_url = $_SERVER['REQUEST_URI'] ?>
<?php $lenght_url = strlen($current_url);
 $clean_url = substr($current_url, 1, $lenght_url-2);
 $current_cat = str_replace('/', '-', $clean_url); ?>
	<!-- Tribe Bar -->
<div class="row">
	<div class="visible-xs col-sm-3 event-sidebar">
		<div class="categories-option">
			<p>Categories <span class="cat-arrow"></span></p>
		    <ul>
		    	<?php
				$args = array(
				'taxonomy'     => 'tribe_events_cat',
				'hide_empty' => false,
				'parent' => 0,
				'orderby' => 'name',
				'order' => 'ASC'
				);
				$categories = get_categories($args);
				foreach($categories as $category) { 
					if (get_field('featured_category',$category->taxonomy.'_'.$category->term_id )) {
						$terms = get_term_by( 'id',$category->term_id,$category->taxonomy );
						$term_link = get_term_link( $terms );
						$cat_name = 'events-category-'.$category->slug;
						if ($current_cat == $cat_name) {
							$active_class="active";
						}else {
							$active_class="";
						}
						echo '<a class="featured '.$cat_name.' '.$active_class.'" href="' . $term_link . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><div class="category-name">' . $category->name.'</div></a>';
						
						$args_child = array(
							'taxonomy'     => 'tribe_events_cat',
							'hide_empty' => false,
							'parent' => $category->term_id,
							'orderby' => 'name',
							'order' => 'ASC'
							);
						$categories_child = get_categories($args_child);
						foreach($categories_child as $category_child) { 
							if (get_field('featured_category',$category_child->taxonomy.'_'.$category_child->term_id )) {
								$terms = get_term_by( 'id',$category_child->term_id,$category_child->taxonomy );
								$term_link = get_term_link( $terms );
								$cat_name = 'events-category-'.$category->slug.'-'.$category_child->slug;
								if ($current_cat == $cat_name) {
									$active_class="active";
								}else {
									$active_class="";
								}
								$add_class = '';
								if ($category_child->category_parent != 0) {
									$add_class = 'cat-child '.$cat_name.' '.$active_class;
								} else {
									$add_class = ''.$cat_name.' '.$active_class;
								}
								echo '<a class="featured '.$add_class.'" href="' . $term_link . '" title="' . sprintf( __( "View all posts in %s" ), $category_child->name ) . '" ' . '><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><div class="category-name">' . $category_child->name.'</div></a>';
								
							}
						} 

					}
				}
				foreach($categories as $category) { 
					if (!get_field('featured_category',$category->taxonomy.'_'.$category->term_id )) {
						$terms = get_term_by( 'id',$category->term_id,$category->taxonomy );
						$term_link = get_term_link( $terms );
						$cat_name = 'events-category-'.$category->slug;
						if ($current_cat == $cat_name) {
							$active_class="active";
						}else {
							$active_class="";
						}
						echo '</span><a class="'.$cat_name.' '.$active_class.'" href="' . $term_link . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><div class="category-name">' . $category->name.'</div></a>';
						$args_child = array(
							'taxonomy'     => 'tribe_events_cat',
							'hide_empty' => false,
							'parent' => $category->term_id,
							'orderby' => 'name',
							'order' => 'ASC'
							);
						$categories_child = get_categories($args_child);
						foreach($categories_child as $category_child) { 
							if (!get_field('featured_category',$category_child->taxonomy.'_'.$category_child->term_id )) {
								$terms = get_term_by( 'id',$category_child->term_id,$category_child->taxonomy );
								$term_link = get_term_link( $terms );
								$cat_name = 'events-category-'.$category->slug.'-'.$category_child->slug;
								if ($current_cat == $cat_name) {
									$active_class="active";
								}else {
									$active_class="";
								}
								$add_class = '';
								if ($category_child->category_parent != 0) {
									$add_class = 'cat-child '.$cat_name.' '.$active_class;
								} else {
									$add_class = ''.$cat_name.' '.$active_class;
								}
								echo '<a class="'.$add_class.'" href="' . $term_link . '" title="' . sprintf( __( "View all posts in %s" ), $category_child->name ) . '" ' . '><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><div class="category-name">' . $category_child->name.'</div></a>';
								
							}
						} 
					}
				} 
				?>
		    </ul>
		</div>
	</div>
</div>
<?php tribe_get_template_part( 'modules/bar' ); ?>
<div class="row">
	<div class="visible-xs col-sm-3 submit-sidebar">
		<a class="btn btn-lg" href="/events/community/add/">Submit an Event</a>
	</div>
	<div class="col-xs-12 col-sm-9">
		<?php tribe_get_template_part( 'list/content' ); ?>

		<div class="tribe-clear"></div>
	</div>
	<div class="hidden-xs col-sm-3 submit-sidebar">
		<a class="btn btn-lg" href="/events/community/add/">Submit an Event</a>
	</div>
	<div class="hidden-xs col-sm-3 event-sidebar">

		<h2>Categories</h2>
		<?php
		$args = array(
			'taxonomy'     => 'tribe_events_cat',
			'hide_empty' => false,
			'parent' => 0,
			'orderby' => 'name',
			'order' => 'ASC'
			);
		$categories = get_categories($args);
		foreach($categories as $category) { 
			if (!get_field('featured_category',$category->taxonomy.'_'.$category->term_id )) {
				$terms = get_term_by( 'id',$category->term_id,$category->taxonomy );
				$term_link = get_term_link( $terms );
				$cat_name = 'events-category-'.$category->slug;
				if ($current_cat == $cat_name) {
					$active_class="active";
				}else {
					$active_class="";
				}
				echo '</span><a class="'.$cat_name.' '.$active_class.'" href="' . $term_link . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><div class="category-name">' . $category->name.'</div></a>';
				$args_child = array(
					'taxonomy'     => 'tribe_events_cat',
					'hide_empty' => false,
					'parent' => $category->term_id,
					'orderby' => 'name',
					'order' => 'ASC'
					);
				$categories_child = get_categories($args_child);
				foreach($categories_child as $category_child) { 
					if (!get_field('featured_category',$category_child->taxonomy.'_'.$category_child->term_id )) {
						$terms = get_term_by( 'id',$category_child->term_id,$category_child->taxonomy );
						$term_link = get_term_link( $terms );
						$cat_name = 'events-category-'.$category->slug.'-'.$category_child->slug;
						if ($current_cat == $cat_name) {
							$active_class="active";
						}else {
							$active_class="";
						}
						$add_class = '';
						if ($category_child->category_parent != 0) {
							$add_class = 'cat-child '.$cat_name.' '.$active_class;
						} else {
							$add_class = ''.$cat_name.' '.$active_class;
						}
						echo '<a class="'.$add_class.'" href="' . $term_link . '" title="' . sprintf( __( "View all posts in %s" ), $category_child->name ) . '" ' . '><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><div class="category-name">' . $category_child->name.'</div></a>';
						
					}
				} 
			}
		} 
		?>
		<hr/>
		<?php
		foreach($categories as $category) { 
			if (get_field('featured_category',$category->taxonomy.'_'.$category->term_id )) {
				$terms = get_term_by( 'id',$category->term_id,$category->taxonomy );
				$term_link = get_term_link( $terms );
				$cat_name = 'events-category-'.$category->slug;
				if ($current_cat == $cat_name) {
					$active_class="active";
				}else {
					$active_class="";
				}
				echo '<a class="featured '.$cat_name.' '.$active_class.'" href="' . $term_link . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><div class="category-name">' . $category->name.'</div></a>';
				
				$args_child = array(
					'taxonomy'     => 'tribe_events_cat',
					'hide_empty' => false,
					'parent' => $category->term_id,
					'orderby' => 'name',
					'order' => 'ASC'
					);
				$categories_child = get_categories($args_child);
				foreach($categories_child as $category_child) { 
					if (get_field('featured_category',$category_child->taxonomy.'_'.$category_child->term_id )) {
						$terms = get_term_by( 'id',$category_child->term_id,$category_child->taxonomy );
						$term_link = get_term_link( $terms );
						$cat_name = 'events-category-'.$category->slug.'-'.$category_child->slug;
						if ($current_cat == $cat_name) {
							$active_class="active";
						}else {
							$active_class="";
						}
						$add_class = '';
						if ($category_child->category_parent != 0) {
							$add_class = 'cat-child '.$cat_name.' '.$active_class;
						} else {
							$add_class = ''.$cat_name.' '.$active_class;
						}
						echo '<a class="featured '.$add_class.'" href="' . $term_link . '" title="' . sprintf( __( "View all posts in %s" ), $category_child->name ) . '" ' . '><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><div class="category-name">' . $category_child->name.'</div></a>';
						
					}
				} 

			}
		} 
		?>
		<hr/>
		<?php
		
		?>
	</div>

	<!-- Category PDF section -->	
	<?php
	$current_cat_name = single_term_title("",false); 

	if (is_tax('tribe_events_cat', $current_cat_name)):
	?>
		<div class="col-sm-3 cat-pdf-sidebar">
			<div class="internal-wrap">
	<?php
		$current_term = get_term_by('name', $current_cat_name, 'tribe_events_cat');

	    	$events_pdf = get_field('latest_events_list_pdf', $current_term);
	    	$events_pdf_message = get_field('events_list_pdf_message', $current_term);
	    	$events_pdf_thumb = get_field('events_list_pdf_thumbnail', $current_term);



	    	if ( $events_pdf ) {
	    		?>
	    		<img src="<?php echo $events_pdf_thumb ?>" />
	    		<h2><?php echo $events_pdf_message; ?></h2>
	    		<a href="<?php echo $events_pdf ?>" class="btn full-cat-list" title="Download PDF" target="_blank">Download PDF</a>
	    		<?php
	    	}
	    	?>
	    	</div>
	    </div>
	<?php endif; ?>
</div>
	<!-- Main Events Content -->


<?php
do_action( 'tribe_events_after_template' );
