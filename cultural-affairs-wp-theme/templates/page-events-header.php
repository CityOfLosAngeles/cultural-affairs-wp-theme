<?php use Roots\Sage\Titles; ?>
<?php if (!is_post_type_archive('tribe_events')) { ?>
	<div class="page-header">
	  <h1><?= Titles\title(); ?></h1>
	</div>
<?php } else { ?>
	<div class="page-subheader">
	  <h1>DCA Arts and Cultural Calendar</h1>
	</div>
<?php } ?>
