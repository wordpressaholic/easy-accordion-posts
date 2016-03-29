<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://kartik.webfixfast.com/
 * @since      1.0.0
 *
 * @package    Easy_Accordion_Posts
 * @subpackage Easy_Accordion_Posts/admin/partials
 */
?>

<editor ng-app="app" ng-controller="MainCtrl as mc">
  <section class="section">
    <h1><?php _e('Easy Accordion Posts', 'easy-accordion-posts') ?></h1>
    <div class="outer-buttons-container">
      <span class="btn btn-primary btn-info" ng-class="{active: this.starterNotes}" ng-click="this.starterNotes = ! this.starterNotes"><i class="fa fa-list"></i><?php _e('Starter Notes', 'easy-accordion-posts') ?></span>
      <!-- <span class="btn btn-primary btn-info" ng-click="this.unlockPro = ! this.unlockPro"><i class="fa fa-unlock"></i>Pro Version</span> -->
    </div>
    <starter-notes ng-show="this.starterNotes"></starter-notes>
    <!-- <unlock-pro ng-show="this.unlockPro"></unlock-pro> -->
  </section>

  <section class="section">
    <h2><?php _e('Accordion Cells', 'easy-accordion-posts') ?></h2>
    <hr class="divider" />

    <cell ng-repeat="cell in mc.cells" obj="cell" shift-up="mc.shiftCellUp(index)" shift-down="mc.shiftCellDown(index)" remove="mc.removeCell(index)" index="{{$index}}"></cell>

    <add-cell add="mc.addCell()"></add-cell>
  </section>

  <section class="section" id="posts">
    <h2><?php _e('Posts', 'easy-accordion-posts') ?></h2>
    <hr class="divider" />

    <database-table></database-table>
    <div class="query_ops">
      <label><?php _e('Total posts', 'easy-accordion-posts') ?>:</label> <input type="number" class="form-control" ng-model="mc.query.posts_per_page" />
      <!-- <br />
      <label>Query vars:</label> <input class="form-control" ng-model="mc.query.query_vars" /> -->
    </div>

  </section>

  <section class="section">
    <h2><?php _e('Responsiveness', 'easy-accordion-posts') ?></h2>
    <hr class="divider" />

    <resp></resp>
  </section>

  <!-- <section class="section">
    <h2>Miscellaneous</h2>
    <hr class="divider" />

    <misc></misc>
  </section> -->

  <section class="section" id="shortcode">
    <h2><?php _e('Shortcode', 'easy-accordion-posts') ?></h2>
    <hr class="divider" />

    <!-- <textarea class="shortcode form-control" ng-change="mc.shortcode_changed(mc.shortcode)" ng-model="mc.shortcode">{{mc.generate_shortcode()}}</textarea> -->
    <textarea class="shortcode form-control">{{mc.generate_shortcode()}}</textarea>
    <warning></warning>
  </section>
</editor>
