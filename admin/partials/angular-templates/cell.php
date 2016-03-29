<?php
  if ( ! defined( 'ABSPATH' ) ) {
      require_once('../../../../../../wp-load.php');
  }
?>
<div class="position">
  <i class="fa fa-chevron-up" ng-click="shiftUp({index:index})"></i>
  <i class="fa fa-chevron-down" ng-click="shiftDown({index:index})"></i>
  <i class="fa fa-times" ng-click="remove({index:index})"></i>
</div>
<div class="content">
  <div class="content-regular" ng-if="obj.type==='Regular'">
    <input placeholder="<?php _e('Cell Title', 'easy-accordion-posts') ?>" title="<?php _e('Cell Title', 'easy-accordion-posts') ?>" class="cell-title form-control" type="input" name="cell_title" ng-model="obj.title" /><i class="fa fa-angle-down"></i>
    <!-- <input title="{{obj.content}}" class="cell-content form-control" type="input" name="cell_content" ng-model="obj.content" /> -->
    <textarea placeholder="<?php _e('Cell Content', 'easy-accordion-posts') ?>" title="<?php _e('Cell Content', 'easy-accordion-posts') ?>" class="cell-content form-control" type="input" name="cell_content" ng-model="obj.content" /></textarea>
  </div>
  <div class="content-image" ng-if="obj.type==='Featured Image'">
    <span><?php _e('Image', 'easy-accordion-posts') ?></span>
    <select ng-model="obj.image" class="cell-image form-control" name="cell_content">
      <option><?php _e('Full', 'easy-accordion-posts') ?></option>
      <option><?php _e('Large', 'easy-accordion-posts') ?></option>
      <option><?php _e('Medium', 'easy-accordion-posts') ?></option>
      <option><?php _e('Small', 'easy-accordion-posts') ?></option>
      <option><?php _e('Custom', 'easy-accordion-posts') ?></option>
    </select>
  </div>
  <div class="content-template-file" ng-if="obj.type==='Template File'">
    <input class="cell-template-file form-control" placeholder="<?php _e('template-name.php', 'easy-accordion-posts') ?>" title="<?php _e('template-name.php', 'easy-accordion-posts') ?>" type="input" name="cell_template_file" ng-model="obj.template_file" />
    <a class="template-help" href="#" title="<?php _e('help', 'easy-accordion-posts') ?>" ng-click="obj.templateHelp = !obj.templateHelp" ng-class="{'close-template-help': !obj.templateHelp}">
      <i class="fa fa-question-circle"></i>
    </a>
    <span ng-if="obj.templateHelp"><?php _e("There are preset templates available in this plugin's templates folder. You can copy and customize them, then place them in the root folder of your theme/child theme to access them above.", 'easy-accordion-posts') ?></span>
  </div>

</div>
<div class="other">
  <b><?php _e('Type', 'easy-accordion-posts') ?>:</b>
  <select ng-model="obj.type" class="cell-type form-control">
    <option><?php _e('Regular', 'easy-accordion-posts') ?></option>
    <option><?php _e('Featured Image', 'easy-accordion-posts') ?></option>
    <!-- <option>Template File</option> -->
  </select>
  <div class="clear"></div>
  <span ng-if="obj.type==='Regular'">
    <b><?php _e('Pre open', 'easy-accordion-posts') ?>:</b>
    <input type="checkbox" name="name" ng-model="obj.pre_open" />
  </span>
  <div class="clear"></div>
  <span ng-if="obj.type==='Regular'">
    <b><?php _e('Tags', 'easy-accordion-posts') ?>:</b>
    <span class="tag">((post_title | max_length: 20 | append:...))</span>
    <span class="tag">((excerpt | max_length: 135 | append:...))</span>
    <span class="tag">((link | text: know more))</span>
    <span class="tag">((featured_image | size: Medium))</span>
    <span class="tag">((meta_key | key: review | max_length: 50 | append:...))</span>
  </span>
  <div class="clear"></div>
</div>
