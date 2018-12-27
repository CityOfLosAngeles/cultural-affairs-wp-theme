<div class="contact-page">
<div class="intro-message">
	<p><?php
	$post_12 = get_post(10); 
echo $trim_me = $post_12->post_content;
?></p>
</div>
<?php echo do_shortcode('[contact-form-7 id="21133" title="Contact form 1"]') ?>


