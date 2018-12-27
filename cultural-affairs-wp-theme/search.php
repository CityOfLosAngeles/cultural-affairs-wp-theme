<?php get_template_part('templates/page', 'header'); ?>
<div class="container">
	<div class="row">
<?php if (!have_posts()) : ?>
  <div class="col-md-12 message-area">
  	<div class="form-zip">
	    <form action="/" method="get">
	        <div class="input-group">
	            <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'" class="form-control" placeholder="Search"><span class="location-icon"></span><span class="input-group-btn">
	          <button type="submit" class="btn btn-search">Submit</button>
	      </span>

	        </div>
	    </form>
	</div>

  </div>
<?php else: ?>
	<div class="result-list">

	<?php while (have_posts()) : the_post(); ?>
	  <?php get_template_part('templates/content', 'search'); ?>

	</div>
	<div class="col-md-12 view-all-container">
	</div>
<?php endif; ?>

	</div>
</div>


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
</div>
</div>
