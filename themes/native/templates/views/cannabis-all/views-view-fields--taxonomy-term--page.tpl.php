<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>

<?php
$url = isset($nid) ? url('node/' . $nid) : '';
$short_name = isset($short_name) ? $short_name : '';
$med_or_rec = isset($med_or_rec) ? $med_or_rec : '';
$sub_title = isset($sub_title) ? $sub_title : '';
$categories_flower = isset($categories_flower) ? $categories_flower : FALSE;
?>


<a href="<?php print $url; ?>" id="<?php print $nid; ?>">
  <?php if (isset($fields['field_cannabis_image']) && $fields['field_cannabis_image']): ?>
    <?php print $fields['field_cannabis_image']->content; ?>
  <?php endif; ?>
  <div class="titles">
<!--    --><?php //if (!$categories_flower): ?>
<!--    <div class="desc">-->
<!--      --><?php //print $short_name; ?>
<!--      --><?php //print $med_or_rec; ?>
<!--    </div>-->
<!--    --><?php //endif; ?>
    <?php if (isset($fields['title']) && $fields['title']): ?>
      <?php print $fields['title']->content; ?>
    <?php endif; ?>

    <?php if ($categories_flower): ?>
    <div class="desc-2">
      <div class="col">
        <?php print $short_name; ?>
      </div>
      <div class="col">
        <?php print $med_or_rec; ?>
      </div>
    </div>
    <?php endif; ?>

    <?php if (isset($fields['field_product_title']) && $fields['field_product_title']): ?>
      <?php print $fields['field_product_title']->content; ?>
    <?php endif; ?>
  </div>
</a>
