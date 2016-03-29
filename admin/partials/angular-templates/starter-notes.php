<?php
  if ( ! defined( 'ABSPATH' ) ) {
      require_once('../../../../../../wp-load.php');
  }
?>
<ul>
  <li>
    <i class="fa fa-hand-o-right"></i><?php _e("Import the 'SuperHeroes' posts used in the examples", 'easy-accordion-posts') ?>:
    <span class="btn btn-primary" ng-click="mc.importDemoData()" ng-class="{disabled: mc.importingDemoData || mc.importingDemoDataDone}">
      <!-- Default -->
      <i ng-if="! mc.importingDemoData && ! mc.importingDemoDataDone" class="fa fa-download"></i>
      <span ng-if="! mc.importingDemoData && ! mc.importingDemoDataDone"><?php _e('Import Now', 'easy-accordion-posts') ?></span>
      <!-- Importing -->
      <i ng-if="mc.importingDemoData && ! mc.importingDemoDataDone" class="fa fa-spin fa-refresh"></i>
      <span ng-if="mc.importingDemoData && ! mc.importingDemoDataDone"><?php _e('Importing', 'easy-accordion-posts') ?></span>
      <!-- Imported -->
      <i ng-if="! mc.importingDemoData && mc.importingDemoDataDone" class="fa fa-check"></i>
      <span ng-if="! mc.importingDemoData && mc.importingDemoDataDone"><?php _e('Imported', 'easy-accordion-posts') ?></span>
    </span>
  </li>
  <li><i class="fa fa-hand-o-right"></i><?php _e('Then click the example name you wish to load', 'easy-accordion-posts') ?>:
    <span class="btn btn-primary" ng-class="{active: mc.loadedExample === 'A'}" ng-click="mc.loadExample('a')">
      <i ng-if="mc.loadedExample !== 'A'" class="fa fa-folder-open"></i>
      <i ng-if="mc.loadedExample === 'A'" class="fa fa-check"></i>
      <?php _e('Ex A', 'easy-accordion-posts') ?>
    </span>
    <span class="btn btn-primary" ng-class="{active: mc.loadedExample === 'B'}" ng-click="mc.loadExample('b')">
      <i ng-if="mc.loadedExample !== 'B'" class="fa fa-folder-open"></i>
      <i ng-if="mc.loadedExample === 'B'" class="fa fa-check"></i>
      <?php _e('Ex B', 'easy-accordion-posts') ?>
    </span>
    <span class="btn btn-primary" ng-class="{active: mc.loadedExample === 'C'}" ng-click="mc.loadExample('c')">
      <i ng-if="mc.loadedExample !== 'C'" class="fa fa-folder-open"></i>
      <i ng-if="mc.loadedExample === 'C'" class="fa fa-check"></i>
      <?php _e('Ex C', 'easy-accordion-posts') ?>
    </span>
    <span class="btn btn-primary" ng-class="{active: mc.loadedExample === 'D'}" ng-click="mc.loadExample('d')">
      <i ng-if="mc.loadedExample !== 'D'" class="fa fa-folder-open"></i>
      <i ng-if="mc.loadedExample === 'D'" class="fa fa-check"></i>
      <?php _e('Ex D', 'easy-accordion-posts') ?>
    </span>
    <span class="btn btn-primary" ng-class="{active: mc.loadedExample === 'E'}" ng-click="mc.loadExample('e')">
      <i ng-if="mc.loadedExample !== 'E'" class="fa fa-folder-open"></i>
      <i ng-if="mc.loadedExample === 'E'" class="fa fa-check"></i>
      <?php _e('Ex E', 'easy-accordion-posts') ?>
    </span>
    <span class="btn btn-primary" ng-class="{active: mc.loadedExample === 'F'}" ng-click="mc.loadExample('f')">
      <i ng-if="mc.loadedExample !== 'F'" class="fa fa-folder-open"></i>
      <i ng-if="mc.loadedExample === 'F'" class="fa fa-check"></i>
      <?php _e('Ex F', 'easy-accordion-posts') ?>
    </span>
    <a style="margin-left: 5px;" href="#">(<?php _e('view all', 'easy-accordion-posts') ?>)</a>
  </li>
  <li><i class="fa fa-hand-o-right"></i><?php _e('Use the shortcode produced at the', 'easy-accordion-posts') ?> <a href="#shortcode"><?php _e('end', 'easy-accordion-posts') ?></a> <?php _e('of this page on your site', 'easy-accordion-posts') ?>.</li>
  <li><i class="fa fa-hand-o-right"></i><?php _e('Watch the', 'easy-accordion-posts') ?> <a href="#"><?php _e('tutorial video', 'easy-accordion-posts') ?></a> <?php _e('and read the', 'easy-accordion-posts') ?> <a href="#"><?php _e('documentation', 'easy-accordion-posts') ?></a> <?php _e('for more details', 'easy-accordion-posts') ?>.</li>
</ul>
