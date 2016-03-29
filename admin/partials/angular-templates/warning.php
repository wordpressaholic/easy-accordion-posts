<?php
  if ( ! defined( 'ABSPATH' ) ) {
      require_once('../../../../../../wp-load.php');
  }
?>
<span ng-if="mc.shortcode_warning()" class="bg-danger"><i class="fa fa-warning"></i><b><?php _e('Warning', 'easy-accordion-posts') ?>:</b> <?php _e('You do not have any', 'easy-accordion-posts') ?> <a href="#posts"><?php _e('posts', 'easy-accordion-posts') ?></a> <? _e('selected', 'easy-accordion-posts') ?>!</span>
