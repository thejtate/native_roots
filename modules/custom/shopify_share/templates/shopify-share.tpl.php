<div class="shopify-social-wrapper">
  <div class="social-sharing is-clean supports-fontface" data-permalink="<?php print $url; ?>">


      <a target="_blank" href="//www.facebook.com/sharer.php?u=<?php print $url; ?>" class="share-facebook">
        <span class="icon icon-facebook"></span>
        <span class="share-title"><?php print t('Share'); ?></span>
        <?php if ($show_count): ?>
          <span class="share-count">0</span>
        <?php endif ?>
      </a>

      <a target="_blank" href="//twitter.com/share?text=<?php print $share_title; ?>&amp;url=<?php print $url; ?>" class="share-twitter">
        <span class="icon icon-twitter"></span>
        <span class="share-title"><?php print t('Tweet'); ?></span>
      </a>

    <?php if($image_url): ?>
        <a target="_blank" href="//pinterest.com/pin/create/button/?url=<?php print $url; ?>&amp;media=<?php print $image_url ?>&amp;description=<?php print $share_title; ?>" class="share-pinterest">
          <span class="icon icon-pinterest"></span>
          <span class="share-title"><?php print t('Pin it'); ?></span>
          <?php if ($show_count): ?>
            <span class="share-count">0</span>
          <?php endif ?>
        </a>

        <a target="_blank" href="//fancy.com/fancyit?ItemURL=<?php print $url; ?>&amp;Title=<?php print $share_title; ?>&amp;Category=Other&amp;ImageURL=<?php print $image_url ?>" class="share-fancy">
          <span class="icon icon-fancy"></span>
          <span class="share-title"><?php print t('Fancy'); ?></span>
        </a>
    <?php endif; ?>

    <?php /*
      <a target="_blank" href="//plus.google.com/share?url=<?php print $url; ?>" class="share-google">
        <!-- Cannot get Google+ share count with JS yet -->
        <span class="icon icon-google_plus"></span>
        <?php if ($show_count): ?>
          <span class="share-count">+1</span>
        <?php else ?>
          <span class="share-title">+1</span>
        <?php endif ?>
      </a>

    */?>

  </div>
</div>