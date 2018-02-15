<?php

/**
 * @file
 * template.php
 *
 * Contains theme override functions and preprocess functions for the theme.
 */

define('NATIVE_WEBFORM_NEWSLETTER_NID', 4);
define('NATIVE_WEBFORM_CONTACT_NID', 180);
define('NATIVE_LOCATION_NID', 10);
define('NATIVE_EDUCATION_NID', 13);
define('NATIVE_NEWS_NID', 36);
define('NATIVE_GALLERY_NID', 470);
define('NATIVE_CAREERS_NID', 1495);
define('NATIVE_CANNABIS_SIMPLE_BLOCK_BID', 11);
define('NATIVE_CANNABIS_DEFAULT_PAGE_URL', 'menu');
define('NATIVE_BUDTENDER_KAITLYN_MUSICK_NID', 1515);
define('NATIVE_BUDTENDER_ANNEMARIE_MCCLINTOCK_NID', 1524);
define('NATIVE_BUDTENDER_DECEMBER_NID', 1529);
define('NATIVE_BUDTENDER_JAN_NID', 1557);
define('NATIVE_WEBFORM_SUPPORT_NEW_LOCATION', 1521);
define('NATIVE_WIFI_NEWSLETTER', 1549);
define('NATIVE_WEBFORM_RATE_US_BAD_NID', 1551);

/**
 * Implements hook_preprocess_html().
 */
function native_preprocess_html(&$vars) {
  $viewport = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'user-scalable=yes, width=device-width',
    ),
  );
  $themeСolor = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'theme-color',
      'content' => '#3caf49',
    ),
  );
  $handheldhriendly = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'HandheldFriendly',
      'content' => 'false',
    ),
  );

  // Setup IE meta tag to force IE rendering mode.
  $meta_ie_render_engine = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'http-equiv' => 'X-UA-Compatible',
      'content' => 'IE=edge',
    ),
    '#weight' => '-99999',
    '#prefix' => '<!--[if IE]>',
    '#suffix' => '<![endif]-->',
  );

  $bing_webmaster = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'msvalidate.01',
      'content' => '10622C1F263994281984BE5D053E6146',
    ),
  );

  drupal_add_html_head($bing_webmaster, 'bing_webmaster');

  drupal_add_html_head($meta_ie_render_engine, 'meta_ie_render_engine');
  drupal_add_html_head($viewport, 'viewport');
  drupal_add_html_head($themeСolor, 'themeСolor');
  drupal_add_html_head($handheldhriendly, 'handheldhriendly');
  if ($node = menu_get_object()) {

    $vars['classes_array'][] = 'page';
    $vars['classes_array'][] = 'page-' . $node->type;

    switch ($node->type) {
      case 'webform':
        $vars['classes_array'][] = 'page-contact';
        break;
      case 'careers':
        $vars['classes_array'][] = 'page-career';
        break;
      case '404':
        $vars['classes_array'][] = 'page-not-found';
        break;
      case 'location_landing':
        $vars['classes_array'][] = 'page-location';
        break;
      case 'budtender':
        $vars['classes_array'][] = 'page-budtenders';
        break;
      case 'location_menu':
        $vars['classes_array'][] = 'page-location-menu';
        $vars['classes_array'][] = 'page-location';
        break;
      case 'news':
        $vars['classes_array'][] = 'page-news-inner';
        break;
      case 'cannabis_landing':
      $vars['classes_array'][] = 'page-cannabis-landing';
        break;
      case 'holder':
        $vars['classes_array'][] = 'page-wifi-newsletter';
        break;
      case 'basic_page':
        try {
          $node_wrapper = entity_metadata_wrapper('node', $node);
          $properties = $node_wrapper->getPropertyInfo();

          if (array_key_exists('field_basic_page_type', $properties)) {
            $field_basic_page_type = $node_wrapper->field_basic_page_type->value();

            $vars['classes_array'][] = 'page-' . strtolower($field_basic_page_type);
          }
        }
        catch (EntityMetadataWrapperException $exc) {
          watchdog('native_theme', 'See ' . __FUNCTION__ . '() <pre>' . $exc->getTraceAsString() . '</pre>', NULL, WATCHDOG_ERROR);
        }
        break;
      case 'support_new_location':
        $vars['classes_array'][] = 'page-bear-valley';
        break;
      case 'rate_us':
        $vars['classes_array'][] = 'page-wifi-newsletter';
        break;
      case 'budtender_side_by_side':
        $vars['classes_array'][] = 'page-budtenders-type-a';
        break;
      default :
        break;
    }

    switch ($node->nid) {
      case NATIVE_BUDTENDER_KAITLYN_MUSICK_NID:
        $vars['classes_array'][] = 'page-kaitlyn';
        break;
      case NATIVE_BUDTENDER_ANNEMARIE_MCCLINTOCK_NID:
      case NATIVE_BUDTENDER_DECEMBER_NID:
      case NATIVE_BUDTENDER_JAN_NID:
        $vars['classes_array'][] = 'page-mcclintock';
        break;
    }
  }

  if (in_array('html__taxonomy__term', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-cannabis-all';
  }
  if (in_array('html__menu', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-cannabis-landing';
    if (($key = array_search('page-cannabis', $vars['classes_array'])) !== FALSE) {
      unset($vars['classes_array'][$key]);
    }
  }
  if (in_array('html__orders', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-cannabis-landing';
  }

  $view = views_get_page_view();
  if (is_object($view)) {
    if ($view->name == 'gallery_type_2' && $view->current_display == 'page') {
      $vars['classes_array'][] = 'page-gallery-type-2';
    }
  }
}

/**
 * Implements hook_preprocess_page().
 */
function native_preprocess_page(&$vars, $hook) {
  $main_menu_tree = menu_tree_all_data('main-menu');
  menu_tree_add_active_path($main_menu_tree);
  $vars['main_menu_expanded'] = menu_tree_output($main_menu_tree);
  $vars['age_popup'] = theme('native_age_popup');
  native_get_social_menu($vars);
  $vars['content_wrapper'] = 'content-wrapper';

  $node = node_load(NATIVE_WEBFORM_NEWSLETTER_NID);
  $vars['node_webform'] = drupal_get_form('webform_client_form_' . NATIVE_WEBFORM_NEWSLETTER_NID, $node, array());

  if (!array_intersect(
    array('page__gear', 'page__node__' . NATIVE_GALLERY_NID),
    $vars['theme_hook_suggestions']
  )
  ) {
    $vars['container_wrap_class'] = 'site-container';
  }
  if (in_array('page__cannabis', $vars['theme_hook_suggestions'])) {
    $vars['container_class'] = 'content-top';
  }
  if (in_array('page__menu', $vars['theme_hook_suggestions'])) {
    $vars['container_class'] = 'content-top';
  }
  if (in_array('page__orders', $vars['theme_hook_suggestions'])) {
    $vars['container_class'] = 'content-top';
  }
  if (isset($vars['node'])) {
    $node = $vars['node'];
    $vars['theme_hook_suggestions'][] = 'page__' . $node->type;

    switch ($node->type) {
      case 'basic_page':
        $vars['container_wrap_class'] = '';
        $vars['content_wrapper'] = '';
        try {
          $node_wrapper = entity_metadata_wrapper('node', $node);
          $properties = $node_wrapper->getPropertyInfo();

          if (array_key_exists('field_basic_page_type', $properties)) {
            $field_basic_page_type = $node_wrapper->field_basic_page_type->value();

            switch (strtolower($field_basic_page_type)) {
              case 'contact':
                break;
              case 'gallery-type-2':
                $vars['content_wrapper'] = 'content-wrapper';
                $vars['container_wrap_class'] = 'site-container';
                break;
              case 'gallery':
                $vars['content_wrapper'] = 'content-wrapper';
                break;
            }
          }
        }
        catch (EntityMetadataWrapperException $exc) {
          watchdog('native_theme', 'See ' . __FUNCTION__ . '() <pre>' . $exc->getTraceAsString() . '</pre>', NULL, WATCHDOG_ERROR);
        }
        break;
      case 'location':
      case 'location_landing':
      case 'location_menu':
        $vars['container_wrap_class'] = '';
        break;
      case 'cannabis_landing':
        $vars['container_class'] = 'content-top';
        break;
      case 'order_ahead':
      case 'awards':
        $vars['content_wrapper'] = '';
        $vars['container_wrap_class'] = '';
        break;
      case 'careers':
      case 'neighbors':
        $vars['content_wrapper'] = '';
        $vars['container_wrap_class'] = '';
        break;
      case 'holder':
        $vars['content_wrapper'] = 'site-container';
        $vars['container_wrap_class'] = 'b-wifi';
        break;
      case 'budtender_side_by_side':
        $vars['container_class'] = 'content-top';
        break;
    }
  }
}

/**
 * Implements hook_preprocess_node().
 */
function native_preprocess_node(&$vars) {
  $node = $vars['node'];
  if (!$vars['page']) {
    $vars['theme_hook_suggestions'][] = 'node__' . $vars['type'] . '__' . $vars['view_mode'];
  }

  switch ($node->type) {
    case 'budtender':
    case 'budtender_side_by_side':
      module_load_include('inc', 'native_custom', 'includes/native_custom.helpers');

      if ($node->type == 'budtender_side_by_side') {
        $node_wrapper = entity_metadata_wrapper('node', $node);
        $properties = $node_wrapper->getPropertyInfo();

        if (array_key_exists('field_budtender_sbs_left_part', $properties)) {
          $left_part_node = $node_wrapper->field_budtender_sbs_left_part->value();
          $vars['left_node_title'] = !empty($left_part_node->title) ? $left_part_node->title : '';
        }
        if (array_key_exists('field_budtender_sbs_right_part', $properties)) {
          $right_part_node = $node_wrapper->field_budtender_sbs_right_part->value();
          $vars['right_node_title'] = !empty($right_part_node->title) ? $right_part_node->title : '';
        }
      }

      $res = native_custom_views_retrieve('budtenders_resource');
      if(!empty($res) && count($res) > 1) {
        $vars['content']['date_select'] = array(
          '#prefix' => '<div class="form-redirect-select">',
          '#suffix' => '</div>',
          '#type' => 'select',
          '#required' => FALSE,
          '#title' => '',
          '#default_value' => 'none',
          '#options' => array(),
        );
        foreach ($res as $item) {
          if (($item->nid == $node->nid) || (!empty($left_part_node) && ($item->nid == $left_part_node->nid))) {
            $vars['content']['date_select']['#options']['none'] = $item->date;
          } else {
            $vars['content']['date_select']['#options'][url('node/' . $item->nid)] = $item->date;
          }
        }
      }

      try {
        if (($node->type == 'budtender_side_by_side') && (!empty($left_part_node))) {
          $wrap = entity_metadata_wrapper('node', $left_part_node);
          $date = $wrap->field_bud_date->value();
          $vars['date_formatted'] = format_date($date, 'custom', 'F Y');
        }
        else {
          $wrap = entity_metadata_wrapper('node', $node);
          $date = $wrap->field_bud_date->value();
          $vars['date_formatted'] = format_date($date, 'custom', 'F <\b\r> Y');
        }
      }
      catch (EntityMetadataWrapperException $exc) {
        watchdog('template', 'EntityMetadataWrapper exception in %function() <pre>@trace</pre>', array('%function' => __FUNCTION__, '@trace' => $exc->getTraceAsString()), WATCHDOG_ERROR);
      }

      if (($vars['view_mode'] == 'teaser') && !empty($vars['content']['field_bud_home_image'])) {
        $vars['back_image'] = native_get_field_image_style_url($vars['content']['field_bud_home_image'][0]);
      }
      break;
    case 'basic_page':
      $vars['additional_content'] = '';
      if (isset($node->field_basic_page_type) && !empty($node->field_basic_page_type)) {
        switch ($node->field_basic_page_type[$node->language]['0']['value']) {
          case 'Social':
            native_get_social_menu($vars, t('Follow us'));
            break;
          case 'Contact':
            $node = node_load(NATIVE_WEBFORM_CONTACT_NID);
            $form = drupal_get_form('webform_client_form_' . NATIVE_WEBFORM_CONTACT_NID, $node, array());
            $vars['additional_content'] = isset($form) && !empty($form) ? render($form) : '';
            $vars['theme_hook_suggestions'][] = 'node__basic_page__contact';
            native_get_social_menu($vars);
            break;
          case 'gallery-type-2':
            $vars['theme_hook_suggestions'][] = 'node__basic_page__gallery_type_2';
            break;
          case 'gallery':
            $vars['theme_hook_suggestions'][] = 'node__basic_page__gallery';
            break;
          case 'Education':
            $vars['theme_hook_suggestions'][] = 'node__basic_page__education';
            break;
        }
      }
      break;
    case 'rewards':
      $vars['theme_hook_suggestions'][] = 'node__home_block__' . $vars['view_mode'];
      break;
    case 'news':
//      $vars['theme_hook_suggestions'][] = 'node__home_block__' . $vars['view_mode'];
      $vars['read_more_link'] = l(t('Read More'), '/node/' . $node->nid, array('external' => TRUE));

      if ($vars['view_mode'] === 'full') {
        $vars['news_sidebar'] = views_embed_view('news', 'block_1');
      }
      break;
    case 'location':
      $vars['back_link'] = l('SELECT ANOTHER LOCATION', 'node/' . NATIVE_LOCATION_NID);

      $vars['loc_menu_link'] = '';
        if(!empty($vars['field_loc_medical_menu'][0]['target_id']) && drupal_valid_path('node/' . $vars['field_loc_medical_menu'][0]['target_id'])) {
          $vars['loc_menu_link'] = l('Weedmaps Menu', 'node/' . $vars['field_loc_medical_menu'][0]['target_id'], array('attributes' => array('class' => array('pull-right'))));
        } else if(!empty($vars['field_loc_recreational_menu'][0]['target_id']) && drupal_valid_path('node/' . $vars['field_loc_recreational_menu'][0]['target_id'])) {
          $vars['loc_menu_link'] = l('Weedmaps Menu', 'node/' . $vars['field_loc_recreational_menu'][0]['target_id'], array('attributes' => array('class' => array('pull-right'))));
        }

      break;
    case 'location_menu':
      $host_location_nid = native_custom_get_location_menu_host_entity_id($node->nid);
      $host_location_node = $host_location_nid ? node_load($host_location_nid) : NULL;

      if ($host_location_node) {
        $vars['location_content'] = node_view($host_location_node);
        $vars['back_link'] = l('SELECT ANOTHER LOCATION', 'node/' . NATIVE_LOCATION_NID);
      }

      $other_location_node = !empty($node->field_loc_menu_other_locaiton[LANGUAGE_NONE][0]['target_id']) ? node_load($node->field_loc_menu_other_locaiton[LANGUAGE_NONE][0]['target_id']) : NULL;

      $medical_nid = NULL;
      if ($host_location_node && !empty($host_location_node->field_loc_medical_menu[LANGUAGE_NONE][0]['target_id'])) {

        $medical_nid = $host_location_node->field_loc_medical_menu[LANGUAGE_NONE][0]['target_id'];
      }
      elseif ($other_location_node && !empty($other_location_node->field_loc_medical_menu[LANGUAGE_NONE][0]['target_id'])) {

        $medical_nid = $other_location_node->field_loc_medical_menu[LANGUAGE_NONE][0]['target_id'];
      }

      $recreational_nid = NULL;
      if ($host_location_node && !empty($host_location_node->field_loc_recreational_menu[LANGUAGE_NONE][0]['target_id'])) {

        $recreational_nid = $host_location_node->field_loc_recreational_menu[LANGUAGE_NONE][0]['target_id'];
      }
      elseif ($other_location_node && !empty($other_location_node->field_loc_recreational_menu[LANGUAGE_NONE][0]['target_id'])) {

        $recreational_nid = $other_location_node->field_loc_recreational_menu[LANGUAGE_NONE][0]['target_id'];
      }

      if(!empty($medical_nid) && !empty($recreational_nid)) {
        $vars['medical_tab'] = $medical_nid ? native_weed_menu_tab($medical_nid, $node->nid, 'Medical', array(
          'link',
          'link-medical'
        )) : '';
        $vars['recreational_tab'] = $recreational_nid ? native_weed_menu_tab($recreational_nid, $node->nid, 'Recreational', array(
          'link',
          'link-recreational'
        )) : '';
      }


      if (!empty($node->field_loc_menu_embed_id[LANGUAGE_NONE][0]['value'])) {

        $id = $node->field_loc_menu_embed_id[LANGUAGE_NONE][0]['value'];
        $js = 'var wmenu_id = ' . $id . '; var wmenu_type = "dispensaries";';

        if(!empty($node->field_loc_menu_wddmaps_mob_link[LANGUAGE_NONE][0]['url'])) {
          $js .=  'var wmenu_mobile_url="' . $node->field_loc_menu_wddmaps_mob_link[LANGUAGE_NONE][0]['url']   . '"';
        }

        drupal_add_js(
          $js,
          array('type' => 'inline')
        );
        drupal_add_js(drupal_get_path('theme', 'native') . '/js/weedmaps.js', array(
          'scope' => 'footer'
        ));
      }

      break;
    case 'webform':
      if ($vars['view_mode'] == 'teaser') {
        $vars['title'] = '';
      }
      break;
    case 'home_page_canabis_block':
      $vars['left_image_url'] = native_get_field_image_style_url($vars['content']['field_home_can_smal_img'][0]);
      $vars['right_image_url'] = native_get_field_image_style_url($vars['content']['field_home_can_wide_img'][0]);
      break;
    case 'cannabis':
      $vars['left_image_url'] = native_get_field_image_style_url($vars['content']['field_cannabis_home_left_image'][0]);
      $vars['right_image_url'] = native_get_field_image_style_url($vars['content']['field_cannabis_home_right_image'][0]);

      if ($vars['view_mode'] == 'full') {
        $category = _native_get_category($node);
        $tid = isset($category->tid) ? $category->tid : NATIVE_CANNABIS_DEFAULT_PAGE_URL;
        $view_position = _native_get_view_position($tid, $node->nid);
        $back_link = 'taxonomy/term/' . $tid;
        $category_name = (is_object($category) && isset($category->field_category_back_but_title) &&
          isset($category->field_category_back_but_title[LANGUAGE_NONE][0]['safe_value']) &&
          !empty($category->field_category_back_but_title[LANGUAGE_NONE][0]['safe_value'])) ?
          $category->field_category_back_but_title[LANGUAGE_NONE][0]['safe_value'] : t('Back to Cannabis products');

        $vars['back_link'] = l($category_name, $back_link,
          array('query' => array('page' => $view_position), 'fragment' => "$node->nid"));
      }
      break;
    case 'gallery_type_2':
      $options = array(
        'group' => JS_THEME,
      );
      drupal_add_js(drupal_get_path('theme', 'native'). '/js/galleryType2.js', $options);

      $image_uri = isset($vars['content']['field_gt2_image']['#items'][0]['uri']) ?
        $vars['content']['field_gt2_image']['#items'][0]['uri'] : '';
      $file = isset($vars['content']['field_gt2_image']['#items'][0]['fid']) ?
        file_load($vars['content']['field_gt2_image']['#items'][0]['fid']) : '';
      $download_url = '';

      if ($file) {
        $uri = file_entity_download_uri($file);
        $download_url = url($uri['path'], array('query' => $uri['options']['query']));
      }

      if ($image_uri) {
        $image_url = file_create_url($image_uri);

        $image = array(
          'path' => $image_uri,
          'width' => '',
          'height' => '',
          'style_name' => 'gallery_type_2__image',
        );
        $output = '<span class="clip">' . theme('image_style', $image) . '</span>';
        $options = array('attributes' => array('class' => 'fancybox', 'rel' => 'gallery1', 'title' => $download_url), 'html' => TRUE);
        $vars['gallery_image'] = l($output, $image_url, $options);
      }
      break;
    case 'gallery':
      $image_uri = isset($vars['content']['field_gallery_image']['#items'][0]['uri']) ?
        $vars['content']['field_gallery_image']['#items'][0]['uri'] : '';
      $image_style = isset($vars['content']['field_gallery_image'][0]['#image_style']) ?
        $vars['content']['field_gallery_image'][0]['#image_style'] : '';
      $vars['image_url'] = file_create_url($image_uri);
      if ($image_style) {
        $vars['image_url'] = image_style_url($image_style, $image_uri);
      }
      break;
    case 'support_new_location':
      $block = block_load('webform', 'client-block-' . NATIVE_WEBFORM_SUPPORT_NEW_LOCATION);
      $block = _block_render_blocks(array($block));
      $block_build = _block_get_renderable_array($block);
      $vars['support_form'] = drupal_render($block_build);
      break;
    case 'rate_us':
      $vars['classes_array'][] = 'b-wifi';
      break;
    case 'smokentoken':
      $newsletter_node = node_load(NATIVE_WEBFORM_NEWSLETTER_NID);
      $submission = array();
      $enabled = FALSE;
      $preview = FALSE;
      $vars['node_webform'] = drupal_get_form('webform_client_form_' . NATIVE_WEBFORM_NEWSLETTER_NID, $newsletter_node, $submission, $enabled, $preview, 'smokentoken');

      $vars['read_more_link'] = l(t('Read More'), '/node/' . $node->nid, array('external' => TRUE));
      break;
  }
}

/**
 * Implements hook_preprocess_block().
 */
function native_preprocess_block(&$vars) {
  $module = isset($vars['block']->module) ? $vars['block']->module : '';

  switch ($vars['block']->delta) {
    case 'menu-top-menu':
      $vars['classes_array'][] = 'top-nav';
      break;
    case '1':
      $vars['classes_array'][] = 'page-desc';
      break;
    case 'home_content-block':
    case 'home_content-block_3':
      $vars['classes_array'][] = 'content-wrapper';
      $vars['classes_array'][] = 'site-container';
      $vars['classes_array'][] = 'content-wrapper-bottom';
      break;
    case NATIVE_CANNABIS_SIMPLE_BLOCK_BID:
      if ($module == 'nodeblock') {
        $vars['title_prefix'] = '<div class="block-title title-mobile"><h1>' . t('Cannabis') .
          '</h1></div>';
      }
      break;
    case 'news-block':
      global $conf;
      $conf['cache'] = FALSE;
      $is_mobile = _native_custom_check_mobile();
      if ($is_mobile) {
        $vars['content'] = views_embed_view('news','block_2');
      }
      break;
  }
}

/**
 * Implements hook_theme();
 */
function native_theme($existing, $type, $theme, $path) {
  $items = array();
  $theme_path = drupal_get_path('theme', 'native');

  $items['native_age_popup'] = array(
    'template' => 'theme/age-popup',
  );
  $items['native_downloads_items'] = array(
    'template' => 'native-downloads-items',
    'arguments' => array(
      'image' => NULL,
      'image_url' => NULL,
      'file' => NULL,
      'title' => NULL,
      'item_class' => NULL,
    ),
    'path' => $theme_path . '/templates',
  );
  return $items;
}

/**
 * Implements template_preprocess_field().
 */
function native_preprocess_field(&$vars) {
  $element = $vars['element'];
  switch ($element['#field_name']) {
    case 'field_news_video':
      $vars['classes_array'][] = 'news-video';
      break;
    case 'field_cannabis_image':
    case 'field_cannabis_large_image':
    case 'field_news_image':
      $vars['classes_array'][] = 'img';
      break;
    case 'field_news_date':
      $vars['classes_array'][] = 'subtitle';
      break;
    case 'field_cannabis_order_link':
    case 'field_cannabis_weedmaps_menu':
      $vars['classes_array'][] = 'btn-wrap';
      break;
    case 'field_experience_icon':
      $vars['classes_array'][] = 'img';
      break;
    case 'field_basic_page_centered_img':
      $vars['classes_array'][] = 'pull-center';
      break;
    case 'field_cannabis_ingredients':
      $vars['classes_array'][] = 'b-ingredients';
      break;
    case 'field_cannabis_experience':
      $vars['classes_array'][] = 'b-experience';
      break;
    case 'field_bud_sec_title':
      $vars['classes_array'][] = 'title';
    break;
    case 'field_bud_sec_description':
      $vars['classes_array'][] = 'desc';
      break;
    case 'field_bud_sec_link':
      $vars['classes_array'][] = 'link';
      break;
    case 'field_rewards_right_image':
    case 'field_rewards_left_image':
    case 'field_cannabis_home_left_image':
    case 'field_cannabis_home_right_image':
    case 'field_home_can_smal_img':
    case 'field_home_can_wide_img':
    case 'field_bud_home_image':
      foreach ($vars['items'] as $key => $item) {
        $vars['items'][$key]['#item']['attributes']['class'][] = 'img';
      }
      break;
    case 'field_downloads_items':
      $items = isset($vars['items']) ? $vars['items'] : array();
      $vars['mobile_class_items'] = array();
      foreach ($items as $key => $item) {
        $field_collection_item = isset($item['entity']['field_collection_item'])
          ? current($item['entity']['field_collection_item']) : '';
        $image_type = isset($field_collection_item['field_downloads_items_img_style']['#items'][0]['value'])
          ? $field_collection_item['field_downloads_items_img_style']['#items'][0]['value'] : '';
        if ($image_type == 'downloads__mobile_wallpaper') {
          $vars['mobile_class_items'][] = $key;
        }
      }
      break;
    case 'field_news_gallery':
      if (isset($element['#items']) && (count($element['#items']) == 1)) {
        $uri = isset($element['#items'][0]['uri']) ? $element['#items'][0]['uri'] : '';
        $alt = isset($element['#items'][0]['alt']) ? $element['#items'][0]['alt'] : '';
        $title = isset($element['#items'][0]['title']) ? $element['#items'][0]['title'] : '';
        if ($uri) {
          $image = array(
            'path' => $uri,
            'alt' => $alt,
            'title' => $title,
          );
          $vars['first_image'] = theme('image', $image);
        }
      }
      else if (($element['#view_mode'] == 'full') && !empty($element['#items'])) {
        $vars['download_urls'] = array();

        foreach ($element['#items'] as $delta => $item) {
          $fid = isset($item['fid']) ? $item['fid'] : '';

          if ($fid) {
            $download_url = 'native-download/' . $fid . '/image';
            $vars['download_urls'][$delta] = l(t('Download'), $download_url);
          }
        }
      }
      break;
  }
}

/**
 * Implements hook_form_alter().
 */
function native_form_alter(&$form, $form_state, $form_id) {
  $form['#attributes']['class'][] = 'form';
  switch ($form_id) {
    case 'views_exposed_form':
      if ($form['#id'] == 'views-exposed-form-news-block') {
        $form['#attributes']['class'][] = 'form-sort';
        if (isset($form['sort_bef_combine']['#options']['field_news_date_value ASC'])) {
          $form['sort_bef_combine']['#options']['field_news_date_value ASC'] = t('Oldest');
        }
        if (isset($form['sort_bef_combine']['#options']['field_news_date_value DESC'])) {
          $form['sort_bef_combine']['#options']['field_news_date_value DESC'] = t('Newest');
        }
      }
      break;
    case 'webform_client_form_' . NATIVE_WEBFORM_NEWSLETTER_NID:
      $type = !empty($form_state['build_info']['args'][4]) ? $form_state['build_info']['args'][4] : '';

      if ($type == 'smokentoken') {
        $form['#attributes']['class'][] = 'form-bear';
        $form['submitted']['home_store']['#access'] = FALSE;
        $form['submitted']['type']['#attributes']['class'][] = 'pull-center';
        $form['actions']['submit']['#value'] = t('submit');

        $form['submitted']['email']['#attributes']['placeholder'] = t('Email Address');
        $form['submitted']['phone']['#attributes']['placeholder'] = t('Phone Number (optional)');
        $form['#validate'][] = '_native_smokentoken_newsletter_form_validate';
      }
      else {
        $form['#attributes']['class'][] = 'form-newsletter';
      }
      break;
    case 'webform_client_form_' . NATIVE_WEBFORM_CONTACT_NID:
      $form['#attributes']['class'][] = 'form-contact';
      break;
    case 'webform_client_form_' . NATIVE_WEBFORM_RATE_US_BAD_NID:
      $form['#attributes']['class'][] = 'form-oh-no';
      break;
  }
}

/**
 * Implements hook_preprocess_views_view().
 */
function native_preprocess_views_view(&$vars) {
  if ($vars['view']->name == 'taxonomy_term' && $vars['view']->current_display == 'page') {
    $breadcrumb = drupal_get_breadcrumb();
    if (!empty($breadcrumb)) {
      unset($breadcrumb['0']);
      $breadcrumb[] = '<span class="separator">›</span><div class="form form-filter">' . views_embed_view('cannabis', 'block_1') . '</div>';
      $vars['breadcrumb'] = theme('item_list', array('items' => $breadcrumb));
      $vars['breadcrumb'] = '<div class="breadcrumbs">' . $vars['breadcrumb'] . '</div>';
    }
  }
}

/**
 * Implements hook_preprocess_views_view_unformatted().
 */
function native_preprocess_views_view_unformatted(&$vars) {
  if ($vars['view']->name == 'orders') {
    $result = $vars['view']->result;
    if (!empty($result)) {
      if ($vars['view']->current_display == 'page' || $vars['view']->current_display == 'block_3') {
        $strain['none'] = t('Select a Location');
      }
      foreach ($vars['view']->result as $key => $value) {
        $path = base_path() . drupal_get_path_alias('node/' . $value->nid);
        $strain[$path] = $value->node_title;
      }
      $vars['select'] = theme('select', array('element' => array('#options' => $strain)));
      $vars['theme_hook_suggestions'][] = 'views_view_unformatted__cannabis__' . $vars['view']->current_display;
    }
  }
  if ($vars['view']->name == 'news') {
    if ($vars['view']->current_display === 'block' || $vars['view']->current_display === 'block_1'
      || $vars['view']->current_display === 'block_2') {
      foreach ($vars['classes'] as $k => $v) {
        $vars['classes_array'][$k] .= ' item';
      }
    }
  }
}

function native_weed_menu_tab($menu_nid, $current_nid, $title, $classes) {

  if ($menu_nid == $current_nid) {
    return '<span class="active ' . implode(' ', $classes) . '">' . $title . ' </span>';
  }
  else if(drupal_valid_path('node/' . $menu_nid)) {//check if user hass access
    return l($title, 'node/' . $menu_nid, array('attributes' => array('class' => $classes)));
  } else {
    return '';
  }
}

function native_get_social_menu(&$vars, $title = '') {
  if (isset($vars)) {
    $social = array('facebook', 'twitter', 'instagram', 'youtube', 'leafly');
    $social_items = array(
      'items' => array(),
      'title' => '',
      'type' => 'ul',
      'attributes' => array(),
    );
    foreach ($social as $key => $value) {
      $social_link = variable_get($value, '');
      if (!empty($social_link)) {
        $social_items['items'][] = array(
          'data' => l('', $social_link, array('attributes' => array('target' => '_blank'))),
          'class' => array('social-' . ($key + 1)),
        );
      }
    }
    if (!empty($social_items['items'])) {
      $vars['social'] = !empty($title) ? '<h2>' . $title . '</h2>' : '';
      $vars['social'] .= theme('item_list', $social_items);
    }
  }
}

/**
 * Implements template_preprocess_entity().
 */
function native_preprocess_entity(&$variables, $hook) {
  $function = 'native_preprocess_' . $variables['entity_type'];
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}

/**
 * Field Collection-specific implementation of template_preprocess_entity().
 */
function native_preprocess_field_collection_item(&$variables) {
  $bundle = isset($variables['elements']['#bundle']) ? $variables['elements']['#bundle'] : '';

  switch ($bundle) {
    case 'field_downloads_items':
      $image_style = isset($variables['content']['field_downloads_items_img_style']['#items'][0]['value']) ?
        $variables['content']['field_downloads_items_img_style']['#items'][0]['value'] : '';
      $variables['classes_array'][] = 'content-items';

      $rows = array();
      $files = isset($variables['field_downloads_items_files']) ? $variables['field_downloads_items_files'] : array();
      foreach ($files as $files_value) {
        if ($field_collection = field_collection_field_get_entity($files_value)) {
          $title = isset($field_collection->field_downloads_items_files_img[LANGUAGE_NONE][0]['alt']) ?
            $field_collection->field_downloads_items_files_img[LANGUAGE_NONE][0]['alt'] : '';

          $image_fid = isset($field_collection->field_downloads_items_files_img[LANGUAGE_NONE][0]['fid']) ?
            'site-download/' . $field_collection->field_downloads_items_files_img[LANGUAGE_NONE][0]['fid'] : '';

          $field_collection_item = $field_collection->view('full');
          $field_collection_item = current($field_collection_item['field_collection_item']);

          $image = isset($field_collection_item['field_downloads_items_files_img'][0]) ?
            $field_collection_item['field_downloads_items_files_img'][0] : '';
          $file = isset($field_collection_item['field_downloads_items_files_file'][0]) ?
            $field_collection_item['field_downloads_items_files_file'][0] : '';
          if ($image) {
            $image['#image_style'] = $image_style;
          }
          $rows[] = theme('native_downloads_items', array(
            "image" => $image,
            "image_url" => l(t('Download'), $image_fid),
            "file" => $file,
            "title" => $title,
            "item_class" => ($image_style == 'downloads__mobile_wallpaper') ? 'small' : '',
          ));
        }
      }
      $variables['file_item_list'] = $rows;
      break;
    case 'field_rate_us_items':
      $path = '<front>';
      if (!empty($variables['content']['field_rate_us_items_link'])) {
        $path = $variables['content']['field_rate_us_items_link']['#items'][0]['url'];
        $variables['content']['field_rate_us_items_link']['#access'] = FALSE;

        $parameters = drupal_get_query_parameters();
        $home_store = !empty($parameters['home_store']) ? $parameters['home_store'] : '';
        $id = !empty($variables['id']) ? $variables['id'] : 0;
        if ($home_store && ($id == 2)) {
          $path .= '?home_store=' . $parameters['home_store'];
        }
        elseif ($home_store && ($id == 1)) {
          $items = !empty($variables['content']['field_rate_us_items_link']['#items']) ?
            $variables['content']['field_rate_us_items_link']['#items'] : array();
          foreach ($items as $item) {
            if ($item['title'] == $home_store) {
              $path = $item['url'];
            }
          }
        }
      }
      if (!empty($variables['content']['field_rate_us_items_img'])) {
        $variables['content']['field_rate_us_items_img'][0]['#path']['path'] = $path;
      }
      break;
  }
}

/**
 * Get Category.
 */
function _native_get_category($node) {
  try {
    $node_wrapper = entity_metadata_wrapper('node', $node);
    $properties = $node_wrapper->getPropertyInfo();

    if (array_key_exists('field_cannabis_category', $properties)) {
      $category = $node_wrapper->field_cannabis_category->value();
      return $category;
    }
  }
  catch (EntityMetadataWrapperException $exc) {
    watchdog('native_theme', 'See ' . __FUNCTION__ . '() <pre>' . $exc->getTraceAsString() . '</pre>', NULL, WATCHDOG_ERROR);
  }

}

/**
 * Implements template_preprocess_site_map
 */
function native_preprocess_site_map(&$vars) {
  $vars['page_title'] = drupal_get_title();
}

/**
 * Themes a select drop-down as a collection of radio buttons.
 *
 * @see http://api.drupal.org/api/function/theme_select/7
 *
 * @param array $vars
 *   An array of arrays, the 'element' item holds the properties of the element.
 *
 * @return string
 *   HTML representing the form element.
 */
function native_select_as_radios($vars) {
  $element = &$vars['element'];

  if (!empty($element['#bef_nested'])) {
    return theme('select_as_tree', $vars);
  }

  $output = '';
  foreach (element_children($element) as $key) {
    $element[$key]['#default_value'] = NULL;
    $element[$key]['#children'] = theme('radio', array('element' => $element[$key]));

    $short_name = _native_cannabis_get_taxonomy_field_value($key, array('field_classification_short_name'));
    if (isset($short_name['field_classification_short_name'])) {
      $output .= '<div class="item-with-desc">' . theme('form_element', array('element' => $element[$key])) .
        '<div class="desc"><span class="item">' . $short_name['field_classification_short_name'] . '</span></div></div>';
    }
    else {
      $output .= theme('form_element', array('element' => $element[$key]));
    }
  }

  return $output;
}

/**
 * Get taxonomy field value.
 *
 * @param $tid
 * @param $fields
 * @return array|void
 */
function _native_cannabis_get_taxonomy_field_value($tid, $fields) {

  if (!is_numeric($tid)) {
    return;
  }

  $vars = array();
    try {
      $wrapper = entity_metadata_wrapper('taxonomy_term', $tid);
      $properties = $wrapper->getPropertyInfo();

      foreach($fields as $field) {
        if (array_key_exists($field, $properties)) {
          $vars[$field] = $wrapper->$field->value();
        }
      }
    }
    catch (EntityMetadataWrapperException $exc) {
      watchdog(
        'template',
        'See ' . __FUNCTION__ . '() <pre>' . $exc->getTraceAsString() . '</pre>',
        NULL, WATCHDOG_ERROR
      );
    }

  return $vars;
}

/**
 * Get Cannabis page number.
 *
 * @param $tid
 * @param $nid
 * @return int
 */
function _native_get_view_position($tid, $nid) {
  $view = views_get_view('taxonomy_term');
  $view->set_display('page');
  $view->set_arguments(array($tid));
  $view->init_handlers();

  $pager = $view->display_handler->get_option('pager');
  $items_per_page = isset($pager['options']['items_per_page']) ? $pager['options']['items_per_page'] : 0;

  $view->pre_execute();
  $view->build();
  $query = $view->build_info['count_query'];
  $nids = $query->execute()->fetchAllAssoc('nid');
  $index = array_search($nid, array_keys($nids));

  $page_nr = ($index === null) ? 0 : intval($index / $items_per_page);
  return $page_nr;
}

/**
 * Helper function getting styled url for image fields.
 */
function native_get_field_image_style_url(&$field_item) {
  $url = '';
  if (!empty($field_item['#item']['uri'])) {
    $url = !empty($field_item['#image_style']) ? image_style_url($field_item['#image_style'], $field_item['#item']['uri']) : file_create_url($field_item['#item']['uri']);
  }
  return $url;
}

/**
 * Validate smokentoken newsletter form.
 */
function _native_smokentoken_newsletter_form_validate($form, &$form_state) {
  $error_messages = drupal_get_messages();
}