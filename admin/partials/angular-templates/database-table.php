<?php
  if ( ! defined( 'ABSPATH' ) ) {
      require_once('../../../../../../wp-load.php');
  }
?>
<table class="table database">
  <tr>
    <th>
      <?php _e('Post Type', 'easy-accordion-posts') ?>
    </th>
    <th>
      <?php _e('Taxonomy', 'easy-accordion-posts') ?>
    </th>
    <th>
      <?php _e('Terms', 'easy-accordion-posts') ?>
    </th>
  </tr>

  <tr ng-repeat="(post_type_name, post_type_obj) in mc.database.post_type">
    <td>
      <input type="checkbox" ng-change="mc.set_post_type(post_type_name)" ng-model="mc.database.post_type[post_type_name].use">
      <label>{{post_type_obj.label}}</label>
    </td>
    <td colspan="2">
      <table class="table taxonomy-table">
        <tr ng-repeat="(taxonomy_name, taxonomy_obj) in post_type_obj.taxonomy">
          <td>
            <input type="checkbox" ng-change="mc.set_tax(post_type_name, taxonomy_name)" ng-model="mc.database.post_type[post_type_name].taxonomy[taxonomy_name].use">
            <label>{{taxonomy_obj.label}}</label>
          </td>
          <td>
            <table class="table">
              <tr ng-repeat="(term_id, term_obj) in taxonomy_obj.terms">
                <td>
                  <input type="checkbox" value="{{term_id}}" ng-change="mc.set_term(post_type_name, taxonomy_name, term_id)" ng-model="mc.database.post_type[post_type_name].taxonomy[taxonomy_name].terms[term_id].use">
                  <label>{{term_obj.label}}</label>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
