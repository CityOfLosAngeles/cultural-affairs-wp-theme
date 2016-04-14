<!-- Begin: FAQs -->
<div class="panel-group faq-list" role="tablist" aria-multiselectable="true">
  <?php if( have_rows('faqs') ): ?>
  <?php $ct = 0; ?>
  <?php while( have_rows('faqs') ): the_row(); 
// vars
  $title  = get_sub_field('faq_title');
  $content     = get_sub_field('faq_content');
  $ct++;
  ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?php echo $ct ?>">
      <h4 class="panel-title">
        <a <?php if($ct != 1) { echo 'class="collapsed"'; }?> data-toggle="collapse" href="#collapse<?php echo $ct ?>" aria-expanded="true" aria-controls="collapse<?php echo $ct ?>">
          <?= $title ?>
          <div class="control-icon"><span class="h"></span><span class="v"></span></div>
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $ct ?>" class="panel-collapse collapse <?php if($ct == 1) { echo 'in'; }?>" role="tabpanel" aria-labelledby="heading<?php echo $ct ?>">
      <div class="panel-body">
        <?= $content ?>
      </div>
    </div>
  </div>
<?php endwhile; ?>
<?php endif; ?>
</div>
<!-- End: FAQs -->
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>