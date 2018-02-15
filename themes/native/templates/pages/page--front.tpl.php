<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<?php if (isset($age_popup)) : ?>
  <?php print $age_popup; ?>
<?php endif; ?>
<div class="outer-wrapper">
  <?php print render($page['content']['metatags']); ?>
  <header id="site-header" class="site-header">
    <div class="site-container">
      <?php if ($logo): ?>
        <div class="logo">
          <?php print l(theme('image', array('path' => $logo)), '<front>', array('html' => TRUE)); ?>
        </div>
      <?php endif; ?>
      <?php if (isset($social)): ?>
        <div class="social-menu">
          <?php print render($social); ?>
        </div>
      <?php endif; ?>
      <nav class="nav">
        <?php if (isset($main_menu_expanded)): ?>
          <?php print l('<span class="text"><span class="ico"></span></span>', '', array(
            'html' => TRUE,
            'external' => TRUE,
            'attributes' => array('class' => array('btn-nav'))
          )); ?>
          <div class="menu-wrapper">
            <?php print render($main_menu_expanded); ?>
          </div>
        <?php endif; ?>
        <?php if(!empty($locations_link)): ?>
          <?php print $locations_link; ?>
        <?php endif; ?>
      </nav>
      <?php if ($page['header']): ?>
        <?php print render($page['header']); ?>
      <?php endif; ?>
      <div class="navigation">
        <?php print theme('links__system_secondary_menu', array(
          'links' => $secondary_menu,
          'attributes' => array('class' => array('menu')),
        )); ?>
      </div>
    </div>
  </header>
  <?php if ($breadcrumb): ?>
    <div id="breadcrumb"><?php print $breadcrumb; ?></div>
  <?php endif; ?>

  <?php print $messages; ?>

  <!--  --><?php //if ($page['highlighted']): ?>
  <!--    <div-->
  <!--      id="highlighted">-->
  <?php //print render($page['highlighted']); ?><!--</div>-->
  <!--  --><?php //endif; ?>
  <a id="main-content"></a>
  <?php print render($title_prefix); ?>
  <?php print render($title_suffix); ?>
  <?php if ($tabs): ?>
    <div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
  <?php print render($page['help']); ?>
  <?php if ($action_links): ?>
    <ul
      class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
  <?php print render($page['content']); ?>
  <div class="content-wrapper content-wrapper-top">
    <?php print render($page['content_top']); ?>
  </div>
  <?php print render($page['content_bottom']); ?>
  <?php print $feed_icons; ?>
  <!-- /.section, /#content -->

  <!-- /#main, /#main-wrapper -->
  <section class="section section-newsletter-type-2">
    <div class="site-container">
      <div class="left-part">
        <?php if (isset($node_webform)): ?>
          <div class="btn-wrap"><a href="#">NEWSLETTER SIGN UP</a></div>
          <div class="form-newsletter-type-2">
            <?php print render($node_webform); ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="right-part">
        <p>media inquiries <br>
          <a href="mailto:connect@nativerootsdispensary.com">connect@nativerootsdispensary.com</a>
        </p>
        <?php if (isset($social)): ?>
          <div class="social-menu">
            <?php print render($social); ?>
          </div>
        <?php endif; ?>
        <div class="btn-wrap style-black">
          <a href="<?php print url('sitemap')?>">sitemap</a>
          <a href="<?php print url('node/' . NATIVE_CAREERS_NID)?>">Careers</a>
        </div>
      </div>
    </div>
  </section>
  <footer id="site-footer" class="site-footer">
    <div class="site-container">
      <?php print render($page['footer']); ?>
    </div>
  </footer>
  <!-- /.section, /#footer -->

</div> <!-- /#page, /#page-wrapper -->
