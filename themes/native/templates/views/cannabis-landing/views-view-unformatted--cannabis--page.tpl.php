<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<div class="form form-pick-your-strain">
  <div class="form-item form-type-select">
    <?php if (isset($select)) : ?>
      <?php print $select; ?>
    <?php else : ?>
      <?php foreach ($rows as $id => $row): ?>
        <?php print $row; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
<div class="el-with-animation el-1">
  <?php print theme('image', array(
    'path' => path_to_theme() . '/images/tmp/img-1.png',
  )); ?>
</div>
<div class="el-with-animation el-2">
  <?php print theme('image', array(
    'path' => path_to_theme() . '/images/tmp/img-2.png',
  )); ?>
</div>
<div class="el-with-animation el-3">
  <?php print theme('image', array(
    'path' => path_to_theme() . '/images/tmp/img-3.png',
  )); ?>
</div>