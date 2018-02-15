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
<?php foreach ($rows as $id => $row): ?>
  <?php $classes = 'section section-text el-with-animation';?>
  <?php $classes .= ($id % 2) ? ' section-left' : ' section-right'?>
  <section<?php if ($classes_array[$id]) { print ' class="' . $classes .'"';  } ?>>
    <?php print $row; ?>
  </section>
<?php endforeach; ?>
