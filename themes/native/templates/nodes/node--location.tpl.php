<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
//dsm($content);
?>
<div id="node-<?php print $node->nid; ?>"
     class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <div class="full-block">
    <?php print render($content['field_loc_image']);?>
  </div>
  <?php print render($content['field_loc_mobile_image']);?>

  <div class="content-top">

    <div class="left-part">
      <div class="text">
        <div class="form form-location">
          <div class="form-location-select">
            <?php print render($location_select);?>
          </div>
        </div>

        <?php print render($title_prefix); ?>
        <div class="block-title">
          <h1><?php print render($content['field_loc_full_name']); ?></h1>
        </div>
        <?php print render($title_suffix); ?>

        <?php print render($content['body']);?>
        <h4><?php print render($content['field_loc_short_note_title']);?></h4>
        <?php print render($content['field_loc_short_note']);?>

        <div class="contact" itemscope itemtype="http://schema.org/LocalBusiness"​>
          <h3><?php print render($title); ?></h3>
          <span itemprop="name" style="display: none;"><?php print render($content['field_loc_full_name']); ?></span>
          <p>
            <?php if(!empty($content['field_loc_medical_age'][0]['#markup'])): ?>
              <?php print t('Medical'); ?>
              <span class="age"><?php print render($content['field_loc_medical_age'][0]['#markup']);?></span>
            <?php endif; ?>

            <?php if(!empty($content['field_loc_recreational_age'][0]['#markup'])): ?>
              <?php print t('Recreational'); ?>
              <span class="age"><?php print render($content['field_loc_recreational_age'][0]['#markup']);?></span>
            <?php endif; ?>
          </p>

          <?php if(!empty($content['field_loc_location'])): ?>
            <div class="location">
              <a class="address-link" target="_blank" href="https://www.google.com/maps/dir/Current+Location/<?php print $content['field_loc_location']['#items'][0]['lat'] .',' . $content['field_loc_location']['#items'][0]['lon'] ?>">
                <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                  <?php print render($content['field_loc_address']);?>
                </div>
              </a>
            </div>
          <?php else: ?>
            <div class="location" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
              <?php print render($content['field_loc_address']);?>
            </div>
          <?php endif; ?>

          <?php if(!empty($content['field_loc_phone'])): ?>
            <div class="tel">
              <?php hide($content['field_loc_phone']);?>
              <a itemprop="telephone" href="tel:<?php print str_replace('-', '', check_plain($content['field_loc_phone'][0]['#markup']))?>"><?php print check_plain($content['field_loc_phone'][0]['#markup'])?></a>
            </div>
          <?php endif; ?>
          <div class="info">
            <?php print render($content['field_loc_open']);?>
          </div>
        </div>
        <div class="btn-wrap clearfix">
          <?php print render($content['field_loc_order_ahead_link']);?>
          <?php if(!empty($loc_menu_link)): ?>
              <?php print $loc_menu_link;?>
          <?php endif; ?>
        </div>

      </div>
    </div>
    <div class="map">
      <?php print render($content['field_loc_location']);?>
    </div>

  </div>
  <div class="content"<?php print $content_attributes; ?>>
    <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['field_loc_medical_menu']);
    hide($content['field_loc_recreational_menu']);
    hide($content['field_loc_select_title']);
    hide($content['field_loc_medical_age']);
    hide($content['field_loc_recreational_age']);
    print render($content);
    ?>
  </div>

</div>
