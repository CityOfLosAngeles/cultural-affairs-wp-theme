<?php
$the_key = 'date';  // The meta key to sort on
$args = array(
	'meta_key' => $the_key,
	'orderby' => 'meta_value'
);
global $wp_query;
query_posts(array_merge($wp_query->query,$args));
?>
<?php if (!have_posts()) : ?>
	<div class="alert alert-warning">
		<?php _e('Sorry, no results were found.', 'sage'); ?>
	</div>
	<?php get_search_form(); ?>
<?php endif; ?>

<?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>

<!-- mobile paginator -->
<div class="row pagination-numbers mob hidden-md hidden-lg">
	<div class="col-md-10 text-left">
		<?php
		global $wp_query;
		$big = 999999999; // need an unlikely integer

		$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'prev_text' => 'Previous Page',
			'next_text' => 'Next Page',
			'mid_size' => 1,
			'type'  => 'array',
		) );
		if( is_array( $pages ) ) {


			foreach ( $pages as $page ) {
				$another = explode('>', $page);
				$resultado = intval(preg_replace('/[^0-9]+/', '', $another[1] ), 10);
			  $page = str_replace(">".$resultado,"><div class='page-links'><div class='fix-alignment'>$resultado</div></div>",$page);
				$newarray[] = $page ;
			}
		}

//valid if there are at least 5 items
if (count($newarray) == 5) {
	$currentpaged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

if ($currentpaged == 1) {
	// show next pages CTA
	?>
	<div class="mobile-paginator">
		<div class="row">
		<?= str_replace("page-numbers","page-numbers col-xs-12",$newarray[count($newarray)-1]) ; ?>
		</div>
		<div class="row">
			<?php
			foreach ($newarray as $k => $v) {
				if($k>=0 and $k<count($newarray)-1){
						echo $v;
				}
			}
			?>
	<?php
}elseif ($currentpaged > 1) {
	// show previous pages CTA
	?>
	<div class="mobile-paginator">
		<div class="row">
		<?= str_replace("page-numbers","page-numbers col-xs-12",$newarray[0]) ; ?>
		</div>
		<div class="row">
			<?php
			foreach ($newarray as $k => $v) {
				if($k>0 ){
						echo $v;
				}
			}
			?>
	<?php
}
echo "</div>";



}else{?>
	<div class="mobile-paginator">
		<div class="row">
		<?= str_replace("page-numbers","page-numbers col-xs-6",$newarray[0])  .''. str_replace("page-numbers","page-numbers col-xs-6",$newarray[count($newarray)-1]) ; ?>


	</div>
	<div class="row">

<?php
	foreach ($newarray as $k => $v) {
		if($k>0 and $k<count($newarray)-1){
				echo $v;
		}
	}
	echo "</div>";

}
?>
	<div class="row go-to-page">
		<input type="text" maxlength="3"  placeholder="Go to Page" data-target="<?= $wp_query->max_num_pages ?>" data-url="<?= site_url().'/about/media-room/media-clippings/page/'?>" name="go-to-page-input" width="40">
		<a class="page-numbers" href=""><div class="page-links">Go</div></a>
		<div class="error hidden">This page does not exist</div>
		<div class="error-number hidden">Please only number</div>
	</div>
</div>
</div></div>



<div class="row pagination-numbers desk hidden-sm hidden-xs">
  <div class="col-md-10 text-left">
<?php
        global $wp_query;

        $big = 999999999; // need an unlikely integer

        $pages = paginate_links( array(
              'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
              'format' => '?paged=%#%',
              'current' => max( 1, get_query_var('paged') ),
              'total' => $wp_query->max_num_pages,
              'prev_text' => 'Previous Page',
              'next_text' => 'Next Page',
              'mid_size' => 1,
              'type'  => 'array',
          ) );
          if( is_array( $pages ) ) {
              $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

              foreach ( $pages as $page ) {

                $another = explode('>', $page);
                $resultado = intval(preg_replace('/[^0-9]+/', '', $another[1] ), 10);

                echo $page = str_replace(">".$resultado,"><div class='page-links'><div class='fix-alignment'>$resultado</div></div>",$page);

              }
              }
            ?>
            <div class="go-to-page">
              <div class="page-label">Go to Page</div>
              <input type="text" maxlength="3" data-target="<?= $wp_query->max_num_pages ?>" data-url="<?= site_url().'/about/media-room/media-clippings/page/'?>" name="go-to-page-input" width="40">
              <a class="page-numbers" href=""><div class="page-links">Go</div></a>
              <div class="error hidden">This page does not exist</div>
              <div class="error-number hidden">Please only number</div>
            </div>

  </div>
</div>
</div>
