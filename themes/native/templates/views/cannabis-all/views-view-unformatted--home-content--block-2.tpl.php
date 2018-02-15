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
  <section class="section section-text section-left el-with-animation">
    <?php print $row; ?>
  </section>
  <div class="clearfix"></div>
<?php endforeach; ?>
