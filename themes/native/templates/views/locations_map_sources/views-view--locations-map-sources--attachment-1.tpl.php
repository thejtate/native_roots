<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
?>
<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php if ($header): ?>
    <div class="view-header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>

  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>

  <div class="form form-location location-filters">
    <?php if(!empty($locations)): ?>
      <div class="form-item form-type-select">
        <label><?php print t('SORT BASED ON YOUR NEEDS'); ?></label>
        <select class="form-select" id="location-select">
          <option value="none"><?php print t('Select a Location'); ?></option>
          <?php foreach($locations as $key => $location): ?>
            <option value="<?php print $key?>"><?php print check_plain($location);?></option>
          <?php endforeach; ?>
        </select>
      </div>
    <?php endif; ?>
    <div class="form-item">
<!--      <label>SORT THE MAP BASED ON YOUR NEEDS</label>-->
      <div class="form-radius">
        <div class="form-item form-type-radio">
          <input id="field-both" type="radio" class="form-radio" name="type-sort" value="all" checked="checked" data-default="true">
          <label for="field-both">Both</label>
        </div>
        <div class="form-item form-type-radio">
          <input id="field-recreational" type="radio" class="form-radio" name="type-sort" value="recreational">
          <label for="field-recreational">Recreational</label>
        </div>
        <div class="form-item form-type-radio">
          <input id="field-medicinal" type="radio" class="form-radio" name="type-sort" value="medicinal">
          <label for="field-medicinal">Medicinal</label>
        </div>
      </div>
    </div>

  </div>

  <?php if ($rows): ?>
    <div class="view-content">
      <?php //print $rows; ?>
    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>

  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
      <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div><?php /* class view */ ?>
