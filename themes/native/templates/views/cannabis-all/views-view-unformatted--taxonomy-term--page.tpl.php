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
  <?php if ($id % 3 == 0): ?>
    <?php print '<div class="items-wrapper">'; ?>
  <?php endif; ?>
  <div<?php if ($classes_array[$id]) {
    print ' class="' . $classes_array[$id] . '"';
  } ?>>
    <?php print $row; ?>
  </div>
  <?php if (($id % 3 == 2 && count($rows) >= 3) || (count($rows) < 3 && $id == count($rows) - 1)) : ?>
    <?php print '</div>'; ?>
  <?php endif; ?>
<?php endforeach; ?>
