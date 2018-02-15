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
<?php $cannabis_landing = isset($cannabis_landing) ? $cannabis_landing : FALSE; ?>
<?php $cannabis_category = isset($cannabis_category) ? $cannabis_category : ''; ?>
<?php $cannabis_category_desc = isset($cannabis_category_desc) ? $cannabis_category_desc : ''; ?>

<div class="<?php print $classes; ?>">
  <div class="content-top">
    <?php if (isset($breadcrumb)): ?>
      <?php print $breadcrumb; ?>
    <?php endif; ?>
    <div class="clearfix"></div>
    <?php if ($attachment_before): ?>
      <div class="attachment attachment-before">
        <?php print $attachment_before; ?>
      </div>
    <?php endif; ?>
    <?php if ($exposed): ?>
      <div class="view-filters">
        <?php print $exposed; ?>
      </div>
    <?php endif; ?>
  </div>
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <div class="content-middle ">

    <?php if ($cannabis_landing && !empty($cannabis_category) && !empty($cannabis_category_desc)): ?>
      <div class="top-desc">
        <h2><?php print $cannabis_category; ?></h2>
        <?php print $cannabis_category_desc; ?>
      </div>
    <?php endif; ?>

    <div class="rendering-content">
      <div class="top-controls">
        <?php if ($cannabis_landing): ?>
          <?php if (isset($cannabis_node_select)): ?>
<!--            --><?php //print render($cannabis_node_select); ?>
          <?php endif; ?>
        <?php else: ?>
          <?php if ($header): ?>
            <?php print $header; ?>
          <?php endif; ?>
          <div class="form form-sort"></div>
        <?php endif; ?>
      </div>

      <?php if ($cannabis_landing): ?>
        <?php if (isset($cannabis_landing_image) && $cannabis_landing_image): ?>
          <div class="view-content">
            <?php print render($cannabis_landing_image); ?>
          </div>
        <?php endif; ?>
      <?php else: ?>
        <?php if ($rows): ?>
          <div class="view-content">
            <?php print $rows; ?>
          </div>
        <?php elseif ($empty): ?>
          <div class="view-empty">
            <?php print $empty; ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>

      <?php if (!$cannabis_landing): ?>
        <div class="bottom-controls">
          <?php if ($pager): ?>
            <?php print $pager; ?>
          <?php endif; ?>
        </div>
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
    </div>
  </div>

</div><?php /* class view */ ?>
