<?php get_template_part('templates/page', 'header'); ?>
<div class="container">
	<div class="row">
		<?php if (!have_posts()) : ?>
		<div class="col-md-12 message-area">
			<div class="form-zip">
				<form action="/" method="get">
					<div class="input-group">
						<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Zip Code'" class="form-control" placeholder="Enter Zip Code">
						<span class="location-icon"></span>
						<span class="input-group-btn"><button type="submit" class="btn btn-search">Submit</button></span>
					</div>
				</form>
			</div>
			<a title="View The Council Districts Directory" href="/council-districts-directory" class="btn view-all">View The Council Districts Directory</a>
		</div>
		<?php else: ?>
		<div class="result-list">
			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('templates/content', 'search'); ?>
			<?php endwhile; ?>
		</div>
		<div class="col-md-12 view-all-container">
			<hr class="sep" />
			<a href="/council-districts-directory" title="View The Council Districts Directory" class="btn btn-lg view-all">View The Council Districts Directory</a>
		</div>
		<?php endif; ?>
	</div>
</div>

<?php the_posts_navigation(); ?>
