<?php

/**
 * Implements hook_views_plugin().
 */
function styled_google_views_views_plugins() {
  return array(
    'style' => array(
      'styled_google_map' => array(
        'title' => t('Styled Google Map'),
        'help' => t('Displays content on a Styled Google Map'),
        'handler' => 'styled_google_map_style_plugin',
        'uses options' => TRUE,
        'uses fields' => TRUE,
        'type' => 'normal',
        'uses grouping' => FALSE,
        'use pager' => FALSE,
        'use more' => FALSE,
        'uses hook menu' => FALSE,
        'theme' => 'styled_google_view',
      ),
    ),
  );
}
