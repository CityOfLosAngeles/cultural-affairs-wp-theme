<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if(is_post_type_archive('tribe_events')): ?>
		<meta name="description" content="Find out what events are happening in Los Angeles, including our Heritage Month Celebrations, and other cultural events throughout the year." />
	<?php endif; ?>
  <?php wp_head(); ?>
  	<link href="<?php echo get_template_directory_uri(); ?>/dist/images/favicon.png" rel="shortcut icon">
  	<script src="//navbar.lacity.org/global_nav.js"></script>
</head>
