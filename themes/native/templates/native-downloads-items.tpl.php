<div class="item <?php print isset($item_class) ? $item_class : ''; ?>">
  <?php if (isset($image)): ?>
    <div class="img">
      <?php print render($image); ?>
    </div>
  <?php endif; ?>
  <div class="controls">
    <?php if (isset($title)): ?>
      <div class="desc">
        <?php print $title; ?>
      </div>
    <?php endif; ?>
    <div class="btn-wrap">
      <?php if (isset($file) && !empty($file)): ?>
        <?php print render($file); ?>
      <?php else: ?>
        <?php print isset($image_url) ? $image_url : ''; ?>
      <?php endif; ?>
    </div>
  </div>
</div>