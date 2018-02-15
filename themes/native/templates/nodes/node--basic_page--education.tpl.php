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
$content_prefix = '';
$content_suffix = '';
?>
<div id="node-<?php print $node->nid; ?>"
     class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <div class="block-title title-mobile">
    <h1><?php print $title; ?></h1>
  </div>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>

    <section class="section section-top parallax-box image-parallax-box">
      <div class="parallax-content media">
        <div class="media-inner">
          <?php if (!empty($content['body'])): ?>
            <div class="text">
              <?php print render($content['body']); ?>
            </div>
          <?php endif; ?>
          <div class="title title-2">
            <?php if (!empty($content['field_paralax_text_image'][0]['#item'])): ?>
              <img
                class="el-with-animation animate-opacity animate-zoom-in"
                src="<?php print file_create_url($content['field_paralax_text_image'][0]['#item']['uri']); ?>"
                alt=""/>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php if (!empty($content['field_paralax_bg_image'][0]['#item'])): ?>
        <div class="parallax-bg" data-parallax-type="image"
             data-img-url="<?php print file_create_url($content['field_paralax_bg_image'][0]['#item']['uri']); ?>"
             data-speed="normal"
             data-invert="false"></div>
      <?php endif; ?>

      <?php print render($content['field_mobile_top_image']); ?>
    </section>

    <?php
    hide($content['field_paralax_text_image']);
    hide($content['field_paralax_bg_image']);
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_paralax_desc']);
    hide($content['field_golden_ticket']);
    ?>
    <?php foreach ($content as $key => $val): ?>
      <?php if (isset($val) && ((isset($val['#printed']) && $val['#printed'] !== TRUE) || !isset($val['#printed']))): ?>
        <?php
        $content_prefix = '<div class="content-wrapper">';
        $content_suffix = '</div>';
        ?>
      <?php endif; ?>
    <?php endforeach; ?>
    <?php print $content_prefix; ?>

    <div style="position: relative; padding: 20px 0; margin: -20px 0;">

      <?php if (array_key_exists('field_golden_ticket', $content) && isset($content['field_golden_ticket']['#items'])
        && $content['field_golden_ticket']['#items']['0']['value'] == 1): ?>
        <?php print render($golden_ticket); ?>
      <?php endif; ?>

      <?php if (isset($social)): ?>
        <div class="content-wrapper">
          <div class="social-menu">
            <?php print render($social); ?>
          </div>
        </div>
      <?php endif; ?>
      <?php print render($content); ?>

    </div>

    <div class="content-wrappers" style="max-width: 640px; margin: 0 auto 20px; padding: 0 20px;">
      <div class="img">
        <p>To meet high demand, Native Roots purchased product from Big Toe, LLC dba Fine Trees with the assurance the product was safe and cultivated strictly within the guidelines of Colorado regulations. On June 14, 2016, certain retail marijuana was voluntarily recalled by Big Toe, LLC dba Fine Trees and, as a result, Native Roots is immediately removing a very limited amount of Cannasap from our stores. Additionally, if you purchased Skywalker Cannasap from one of our stores with a batch number of #nrdr.3.6.sky.1, please return it the store of purchase for a one cent replacement.
        </p>
        <p>Native Roots holds ourselves to the highest standards of accountability to guarantee our product is compliant and always of the highest quality.</p>
      </div>
    </div>

    <?php print $additional_content; ?>
    <?php print $content_suffix; ?>
  </div>
</div>
