<?php
  if ( ! defined( 'ABSPATH' ) ) {
      require_once('../../../../../../wp-load.php');
  }
?>
<table class="table resp-table">
  <thead>
    <tr>
      <th></th>
      <th><?php _e('PC', 'easy-accordion-posts') ?></th>
      <th><?php _e('Tablet', 'easy-accordion-posts') ?></th>
      <th><?php _e('Mobile', 'easy-accordion-posts') ?></th>
    </tr>
  </thead>

  <tbody>
    <!-- flex -->
    <tr>
      <td>
        <input type="radio" name="flex_or_fixed" id="flex_or_fixed_flex" value="flex" ng-model="mc.resp.flex_or_fixed" />
        <label for="flex_or_fixed_flex"><?php _e('Columns per row', 'easy-accordion-posts') ?></label>
      </td>
      <td>
        <input type="number" class="form-control" ng-model="mc.resp.flex[0]" />
      </td>
      <td>
        <input type="number" class="form-control" ng-model="mc.resp.flex[1]" />
      </td>
      <td>
        <input type="number" class="form-control" ng-model="mc.resp.flex[2]" />
      </td>
    </tr>

    <!-- fixed -->
    <!-- <tr>
      <td>
        <input type="radio" name="flex_or_fixed" id="flex_or_fixed_fixed" value="fixed" ng-model="mc.resp.flex_or_fixed" />
        <label for="flex_or_fixed_fixed"><?php _e('Column fixed width', 'easy-accordion-posts') ?></label>
      </td>
      <td>
        <input type="number" class="form-control" ng-model="mc.resp.fixed[0]" />
      </td>
      <td>
        <input type="number" class="form-control" ng-model="mc.resp.fixed[1]" />
      </td>
      <td>
        <input class="form-control" value="100%" disabled>
      </td>
    </tr> -->

    <!-- image height -->
    <!-- <tr>
      <td>
        <label style="margin-left: 20px;"><?php _e('Image height', 'easy-accordion-posts') ?></label>
      </td>
      <td>
        <input type="number" name="name" class="form-control" ng-model="mc.resp.image_height[0]" />
      </td>
      <td>
        <input type="number" name="name" class="form-control" ng-model="mc.resp.image_height[1]" />
      </td>
      <td>
        <input type="number" name="name" class="form-control" ng-model="mc.resp.image_height[2]" />
      </td>
    </tr> -->
  </tbody>
</table>
