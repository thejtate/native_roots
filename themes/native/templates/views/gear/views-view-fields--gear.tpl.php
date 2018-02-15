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

<?php $col_handle = $row->field_field_collection_handle[0]['raw']['value'];?>
<?php $img_url1 = file_create_url($row->field_field_collect_landing_image[0]['raw']['uri']);?>
<?php $img_url2 = file_create_url($row->field_field_collect_landing_image[1]['raw']['uri']);?>
<?php $img_url3 = file_create_url($row->field_field_collect_landing_image[2]['raw']['uri']);?>
<?php $name = strtoupper($row->taxonomy_term_data_name);?>

  <a href="<?php print url( SHOPIFY_CUSTOM_URL . '/collections/' . $col_handle , array('external' => TRUE))?>">
    <h1>&nbsp;</h1>
    <div style="background-image: url('<?php print $img_url1;?>');" class="col-item col-1 el-with-animation"><img class="img" src="<?php print $img_url1;?>" alt=""></div>
    <div style="background-image: url('<?php print $img_url2;?>');" class="col-item col-2 el-with-animation">
      <img class="img" src="<?php print $img_url2;?>" alt="">
      <span class="link"><?php print($name);?></span>
    </div>
    <div style="background-image: url(<?php print $img_url3;?>);" class="col-item col-3 el-with-animation"><img class="img" src="<?php print $img_url3;?>" alt=""></div>
  </a>



