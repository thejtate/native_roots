<?php
/**
 * @file
 * Jobs list theming
 */
?>
<div class="lever-posts-wrapper">

  <div class="control">
    <?php if(!empty($categories)): ?>
    <div class="form form-job">
      <div class="form-item form-type-select">
        <select class="form-select job-category-filter">
          <option value="all">All job categories</option>
          <?php foreach($categories as $category): ?>
            <option value="<?php print($category);?>"><?php print($category);?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <?php endif; ?>
  </div>

  <div class="items lever-posts">

    <?php if(!empty($posts)): ?>
      <?php foreach($posts as $post): ?>
        <div class="item job team-<?php print $post['team']?>">
          <h4><a href="<?php print $post['link']?>" target="_blank"><?php print $post['title']?></a></h4>
          <p class="tags"><span><?php print $post['team']?>, </span><span><?php print $post['location']?>, </span><span><?php print $post['commitment']?></span></p>
          <div class="text">
            <?php print $post['short_description']?>
          </div>
          <div class="btn-wrap style-a"><a href="<?php print $post['link']?>" target="_blank"><?php print t('Learn more'); ?></a></div>
        </div>
      <?php endforeach; ?>
    <?php else:?>
      <h2>No Posts</h2>
    <?php endif; ?>
  </div>
</div>