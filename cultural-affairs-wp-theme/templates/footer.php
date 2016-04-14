<div class="black-bg white-txt text-center" id="#subscribe">
	<div class="container subscribe-section">
		<h2>BE IN THE LOOP!</h2>
    <p>Receive notes about art, culture, and creativity in LA!</p>
    <?php echo do_shortcode('[constantcontactapi formid="1"]') ?>
  </div>
</div>
<footer class="content-info">
  <div class="footer-top">
    <div class="container">
     <div class="col-sm-12 hidden-xs col-md-5 faqs-footer">
      <h2>FREQUENTLY ASKED QUESTIONS</h2>
      <div class="faq-container">
        <?php
        $about_page = get_page_by_path( 'faqs' );
        $about_ID = $about_page->ID;
        if( have_rows('faqs', $about_ID) ):
          $i = 0;
          while( have_rows('faqs', $about_ID) ): the_row();
          $i++;
          if( $i > 4 ) { break; }
          ?>
          <a href="/faqs#<?php echo $i ?>" title="<?php the_sub_field('faq_title'); ?>"><?php the_sub_field('faq_title'); ?></a>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
      <a href="/faqs" class="btn btn-sm" title="View All">View All</a>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3 hidden-xs quicklinks-footer"><?php dynamic_sidebar('sidebar-footer'); ?></div>
    <div class="col-xs-12 col-sm-8 col-md-4 connect-footer">
      <div class="col-xs-12 col-sm-6 col-md-12 contact">
        <h2 class="contact-h">CONTACT</h2>
        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/general/logo-footer.svg">
        <h3 class="small-h3">Department of Cultural Affairs</h3>
        <h4>City of Los Angeles</h4>
        <p>201 North Figueroa Street, Suite 1400 <br/>
          Los Angeles, CA 90012<br/>
          Phone: 213 202 5500</p> 
      </div>
      <div class="col-xs-12 col-sm-6 col-md-12 connect">
        <h2>CONNECT</h2>
        <div class="footer-social-icons">
          <a href="https://www.facebook.com/culturela/" target="_blank" title="Facebook"><div class="fb"><?php echo file_get_contents(get_template_directory(). "/dist/images/general/icon-facebook.svg"); ?></div></a>
          <a href="https://twitter.com/culture_la" target="_blank" title="Twitter"><div class="tw"><?php echo file_get_contents(get_template_directory(). "/dist/images/general/icon-twitter.svg"); ?></div></a>
          <a href="https://instagram.com/culture_la/" target="_blank" title="Instagram"><div class="itg"><?php echo file_get_contents(get_template_directory(). "/dist/images/general/icon-instagram.svg"); ?></div></a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="footer-bottom">
  <div class="container">
    <div class="col-xs-12 col-sm-11 footer-copyright">
      <small>Arts, Culture, and Creativity   •   <a href="https://www.lacity.org/" title="City of Los Angeles" target="_blank">City of Los Angeles</a>   •   <a href="/site-policies" title="Site Policies">Site Policies</a>   •   <a href="/sitemap" title="Sitemap">Sitemap</a></small>
      <small>You're visiting the new <a href="culturela.org" title="culturela.org">culturela.org</a>. Help us develop our site by sharing your feedback. Email: <a target="_blank" href="mailto:DCA.website@lacity.org" title="DCA.website@lacity.org">DCA.website@lacity.org</a>.</small>
    </div>
    <div class="back-top">
      <a href="#header" class="smooth" title="Back to Top"><div class="back-top-arrow"><?php echo file_get_contents(get_template_directory(). "/dist/images/general/bt-back-to-top.svg"); ?></div></a>
    </div>
  </div>
</div>
</div>
</footer>
