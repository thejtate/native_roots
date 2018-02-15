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

$url = url('node/' . $fields['nid']->raw);

$medical_attr = !empty($fields['field_loc_medical_menu']->content) ? ' data-medicinal="true" ' : '';
$recreational_attr = !empty($fields['field_loc_recreational_menu']->content) ? ' data-recreational="true"' : '';

?>
<div class="content-item" <?php print $medical_attr . $recreational_attr?>>

  <a href="<?php print $url; ?>" class="desktop">
    <h3><?php print $fields['title']->content;?></h3>
    <p>
      <?php if(!empty($fields['field_loc_medical_age']->content)): ?>
        Medical <span><?php print $fields['field_loc_medical_age']->content;?></span>
      <?php endif; ?>
      <?php if(!empty($fields['field_loc_recreational_age']->content)): ?>
        Recreational <span><?php print $fields['field_loc_recreational_age']->content;?></span>
      <?php endif; ?>
    </p>
    <div class="location">
        <?php print $fields['field_loc_address']->content;?>
    </div>
    <div class="tel"><?php print $fields['field_loc_phone']->content;?></div>
    <div class="info"><?php print $fields['field_loc_open']->content;?></div>

  </a>
  <div class="mobile">
    <h3><a href="<?php print $url; ?>"><?php print $fields['title']->content;?></a></h3>
    <p>
      <?php if(!empty($fields['field_loc_medical_age']->content)): ?>
       Medical <span><?php print $fields['field_loc_medical_age']->content;?></span>
      <?php endif; ?>
      <?php if(!empty($fields['field_loc_recreational_age']->content)): ?>
        Recreational <span><?php print $fields['field_loc_recreational_age']->content;?></span>
      <?php endif; ?>
    </p>
    <div class="location">
      <a class="address-link" target="_blank" href="https://www.google.com/maps/dir/Current+Location/<?php print $fields['field_loc_location']->content .',' . $fields['field_loc_location_1']->content ?>">
      <?php print $fields['field_loc_address']->content;?>
      </a>
    </div>
    <div class="tel"><a href="tel:<?php print str_replace('-', '', $fields['field_loc_phone']->content);?>"><?php print $fields['field_loc_phone']->content;?></a></div>
    <div class="info"><?php print $fields['field_loc_open']->content;?></div>
    <?php print l('Visit Location', 'node/' . $fields['nid']->raw, array('attributes' => array('class' => array('details'))));?>
  </div>

</div>
