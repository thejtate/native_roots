<?php

/**
 * Style plugin to render the styled google map view.
 *
 * @ingroup views_style_plugins
 */
class styled_google_map_style_plugin extends views_plugin_style {

  /**
   * Modifies the default options inherited by this plugin.
   *
   * @return array
   *   The list of options provided by this plugin.
   */
  public function option_definition() {
    $options = parent::option_definition();
    $options['styled_google_map_view_cluster_pin'] = array('default' => '');
    $options['styled_google_map_view_active_pin'] = array('default' => '');
    $options['styled_google_map_view_height'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_WIDTH);
    $options['styled_google_map_view_width'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_HEIGHT);
    $options['styled_google_map_view_style'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_STYLE);
    $options['styled_google_map_view_zoom_default'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_ZOOM);
    $options['styled_google_map_view_zoom_max'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_MAX_ZOOM);
    $options['styled_google_map_view_zoom_min'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_MIN_ZOOM);
    $options['styled_google_map_view_maptype'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_MAP_TYPE);
    $options['styled_google_map_view_maptypecontrol'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_MAP_TYPE_CONTROL);
    $options['styled_google_map_view_scalecontrol'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_SCALE_CONTROL);
    $options['styled_google_map_view_rotatecontrol'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_ROTATE_CONTROL);
    $options['styled_google_map_view_draggable'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_DRAGGABLE);
    $options['styled_google_map_view_mobile_draggable'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_MOBILE_DRAGGABLE);
    $options['styled_google_map_view_zoomcontrol'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_ZOOM_CONTROL);
    $options['styled_google_map_view_streetviewcontrol'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_STREET_VIEW_CONTROL);
    $options['styled_google_map_view_scrollwheel'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_SCROLLWHEEL);
    $options['styled_google_map_view_shadow_style'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_SHADOW_STYLE);
    $options['styled_google_map_view_padding'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_PADDING);
    $options['styled_google_map_view_border_radius'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_BORDER_RADIUS);
    $options['styled_google_map_view_border_width'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_BORDER_WIDTH);
    $options['styled_google_map_view_border_color'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_BORDER_COLOR);
    $options['styled_google_map_view_background_color'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_BACKGROUND_COLOR);
    $options['styled_google_map_view_min_width'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_MIN_WIDTH);
    $options['styled_google_map_view_max_width'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_MAX_WIDTH);
    $options['styled_google_map_view_min_height'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_MIN_HEIGHT);
    $options['styled_google_map_view_max_height'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_MAX_HEIGHT);
    $options['styled_google_map_view_auto_close'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_AUTO_CLOSE);
    $options['styled_google_map_view_arrow_size'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_ARROW_SIZE);
    $options['styled_google_map_view_arrow_position'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_ARROW_POSITION);
    $options['styled_google_map_view_arrow_style'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_ARROW_STYLE);
    $options['styled_google_map_view_disable_auto_pan'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_DISABLE_AUTO_PAN);
    $options['styled_google_map_view_hide_close_button'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_HIDE_CLOSE_BUTTON);
    $options['styled_google_map_view_disable_animation'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_DISABLE_ANIMATION);
    $options['styled_google_map_view_background_class'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_BACKGROUND_CLASS);
    $options['styled_google_map_view_content_container_class'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_CONTENT_CONTAINER_CLASS);
    $options['styled_google_map_view_arrow_class'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_ARROW_CLASS);
    $options['styled_google_map_view_arrow_outer_class'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_ARROW_OUTER_CLASS);
    $options['styled_google_map_view_arrow_inner_class'] = array('default' => STYLED_GOOGLE_MAP_DEFAULT_ARROW_INNER_CLASS);
    return $options;
  }

  /**
  * Renders the data provided to this plugin.
  *
  * @return string
  *   The rendered html.
  */
  public function render() {
    return parent::render();
  }

  /**
   * Modifies the options form inherited by this plugin.
   *
   * @param array $form
   *   The form being generated.
   * @param array $form_state
   *   The state that the form has been posted in.
   */
  public function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);
    $handlers = $this->display->handler->get_handlers('field');

    foreach ($handlers as $handle) {
      // Get all location sources.
      if (!empty($handle->field_info['type']) && $handle->field_info['type'] == 'geofield') { //
        $data_source_options[$handle->options['id']] = (!empty($handle->options['label'])) ? $handle->options['label'] : $handle->options['id'];
      }
      $pin_source_options = array();
      // Get all pin sources.
      if (!empty($handle->field_info['type']) && $handle->field_info['type'] == 'image') { //
        $pin_source_options[$handle->options['id']] = (!empty($handle->options['label'])) ? $handle->options['label'] : $handle->options['id'];
      }
      // Get all popup sources
      $source_options[$handle->options['id']] = (!empty($handle->options['label'])) ? $handle->options['label'] : $handle->options['id'];
    }
    $source_options = array_diff($source_options, $pin_source_options, $data_source_options);

    $form['data_source'] = array(
      '#type' => 'select',
      '#title' => t('Which field contains geodata?'),
      '#description' => t('Needs to be a geofield.'),
      '#options' => $data_source_options,
      '#default_value' => $this->options['data_source'] ? $this->options['data_source'] : NULL,
    );
    $form['pin_source'] = array(
      '#type' => 'select',
      '#title' => t('Which field contains the pin image?'),
      '#description' => t('Needs to be an image field.'),
      '#options' => $pin_source_options,
      '#default_value' => $this->options['pin_source'] ? $this->options['pin_source'] : NULL,
    );
    $form['popup_source'] = array(
      '#type' => 'select',
      '#title' => t('Which field contains the popup text?'),
      '#description' => t('Can be a field or rendered entity field.'),
      '#options' => $source_options,
      '#default_value' => $this->options['popup_source'] ? $this->options['popup_source'] : NULL,
    );
    $form['category_source'] = array(
      '#type' => 'select',
      '#title' => t('Which field contains the category?'),
      '#description' => t('This will be used to have a class wrapper around the bubble to allow different styling per category.'),
      '#options' => $source_options,
      '#default_value' => $this->options['category_source'] ? $this->options['category_source'] : NULL,
    );
    $form['styled_google_map_view_height'] = array(
      '#type' => 'textfield',
      '#title' => t('Height'),
      '#size' => '30',
      '#description' => t('This field determines the height of the styled Google map'),
      '#default_value' => $this->options['styled_google_map_view_height'],
    );
    $form['styled_google_map_view_width'] = array(
      '#type' => 'textfield',
      '#title' => t('Width'),
      '#size' => '30',
      '#description' => t('This field determines how width the styled Google map'),
      '#default_value' => $this->options['styled_google_map_view_width'],
    );
    $form['styled_google_map_view_style'] = array(
      '#type' => 'textarea',
      '#title' => t('Style'),
      '#description' => t('The style of the map'),
      '#default_value' => $this->options['styled_google_map_view_style'],
    );
    $form['styled_google_map_view_cluster_pin'] = array(
      '#type' => 'textfield',
      '#title' => t('Cluster pin image'),
      '#description' => t('Leave empty for '),
      '#default_value' => $this->options['styled_google_map_view_cluster_pin'],
    );
    $form['styled_google_map_view_active_pin'] = array(
      '#type' => 'textfield',
      '#title' => t('Active pin image'),
      '#default_value' => $this->options['styled_google_map_view_active_pin'],
    );
    $form['styled_google_map_view_maptype'] = array(
      '#type' => 'select',
      '#options' => array(
        'ROADMAP' => t('ROADMAP'),
        'SATELLITE' => t('SATELLITE'),
        'HYBRID' => t('HYBRID'),
        'TERRAIN' => t('TERRAIN'),
      ),
      '#title' => t('Map type'),
      '#default_value' => $this->options['styled_google_map_view_maptype'],
      '#required' => TRUE,
    );
    $form['styled_google_map_view_zoom_default'] = array(
      '#type' => 'select',
      '#options' => range(1, 23),
      '#title' => t('Default zoom level'),
      '#default_value' => $this->options['styled_google_map_view_zoom_default'],
      '#description' => t('Should be between the Min and Max zoom level.
        This will generally not working as fitbounds will try to fit all pins on the map.'),
      '#required' => TRUE,
    );
    $form['styled_google_map_view_zoom_max'] = array(
      '#type' => 'select',
      '#options' => range(1, 23),
      '#title' => t('Max zoom level'),
      '#default_value' => $this->options['styled_google_map_view_zoom_max'],
      '#description' => t('Should be greater then the Min zoom level.'),
      '#required' => TRUE,
    );
    $form['styled_google_map_view_zoom_min'] = array(
      '#type' => 'select',
      '#options' => range(1, 23),
      '#title' => t('Min zoom level'),
      '#default_value' => $this->options['styled_google_map_view_zoom_min'],
      '#description' => t('Should be smaller then the Max zoom level.'),
      '#required' => TRUE,
    );
    $form['styled_google_map_view_maptypecontrol'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable Map Type control'),
      '#default_value' => $this->options['styled_google_map_view_maptypecontrol'],
    );
    $form['styled_google_map_view_scalecontrol'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable scale control'),
      '#default_value' => $this->options['styled_google_map_view_scalecontrol'],
    );
    $form['styled_google_map_view_rotatecontrol'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable rotate control'),
      '#default_value' => $this->options['styled_google_map_view_rotatecontrol'],
    );
    $form['styled_google_map_view_draggable'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable dragging'),
      '#default_value' => $this->options['styled_google_map_view_draggable'],
    );
    $form['styled_google_map_view_mobile_draggable'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable mobile dragging'),
      '#description' => t('Sometimes when the map covers big part of touch device screen draggable feature can cause inability to scroll the page'),
      '#default_value' => $this->options['styled_google_map_view_mobile_draggable'],
    );
    $form['styled_google_map_view_streetviewcontrol'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable street view control'),
      '#default_value' => $this->options['styled_google_map_view_streetviewcontrol'],
    );
    $form['styled_google_map_view_zoomcontrol'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable zoom control'),
      '#default_value' => $this->options['styled_google_map_view_zoomcontrol'],
    );
    $form['styled_google_map_view_scrollwheel'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable scrollwheel'),
      '#default_value' => $this->options['styled_google_map_view_scrollwheel'],
    );
    $form['popup'] = array(
      '#type' => 'fieldset',
      '#title' => t('Popup Styling'),
      '#description' => t('All settings for the popup exposed by the library. If you want more flexibility in your the styling of the popup. You can use the CSS defined classes'),
      '#collapsed' => TRUE,
      '#collapsible' => TRUE,
    );
    $form['popup']['styled_google_map_view_shadow_style'] = array(
      '#type' => 'select',
      '#title' => t('Shadow style'),
      '#options' => array(0, 1, 2),
      '#description' => t('1: shadow behind, 2: shadow below, 0: no shadow'),
      '#default_value' => $this->options['styled_google_map_view_shadow_style'],
    );
    $form['popup']['styled_google_map_view_padding'] = array(
      '#type' => 'textfield',
      '#title' => t('Padding'),
      '#field_suffix' => 'px',
      '#default_value' => $this->options['styled_google_map_view_padding'],
    );
    $form['popup']['styled_google_map_view_border_radius'] = array(
      '#type' => 'textfield',
      '#title' => t('Border radius'),
      '#field_suffix' => 'px',
      '#default_value' => $this->options['styled_google_map_view_border_radius'],
    );
    $form['popup']['styled_google_map_view_border_width'] = array(
      '#type' => 'textfield',
      '#title' => t('Border width'),
      '#field_suffix' => 'px',
      '#default_value' => $this->options['styled_google_map_view_border_width'],
    );
    $form['popup']['styled_google_map_view_border_color'] = array(
      '#type' => 'textfield',
      '#title' => t('Border color'),
      '#field_suffix' => '#hex',
      '#default_value' => $this->options['styled_google_map_view_border_color'],
    );
    $form['popup']['styled_google_map_view_background_color'] = array(
      '#type' => 'textfield',
      '#title' => t('Background color'),
      '#field_suffix' => '#hex',
      '#default_value' => $this->options['styled_google_map_view_background_color'],
    );
    $form['popup']['styled_google_map_view_min_width'] = array(
      '#type' => 'textfield',
      '#title' => t('Min width'),
      '#field_suffix' => 'px (or auto)',
      '#default_value' => $this->options['styled_google_map_view_min_width'],
    );
    $form['popup']['styled_google_map_view_max_width'] = array(
      '#type' => 'textfield',
      '#title' => t('Max width'),
      '#field_suffix' => 'px (or auto)',
      '#default_value' => $this->options['styled_google_map_view_max_width'],
    );
    $form['popup']['styled_google_map_view_min_height'] = array(
      '#type' => 'textfield',
      '#title' => t('Min height'),
      '#field_suffix' => 'px (or auto)',
      '#default_value' => $this->options['styled_google_map_view_min_height'],
    );
    $form['popup']['styled_google_map_view_max_height'] = array(
      '#type' => 'textfield',
      '#title' => t('Max height'),
      '#field_suffix' => 'px (or auto)',
      '#default_value' => $this->options['styled_google_map_view_max_height'],
    );
    $form['popup']['styled_google_map_view_arrow_style'] = array(
      '#type' => 'select',
      '#title' => t('Arrow style'),
      '#options' => array(0, 1, 2),
      '#description' => t('1: left side visible, 2: right side visible, 0: both sides visible'),
      '#default_value' => $this->options['styled_google_map_view_arrow_style'],
    );
    $form['popup']['styled_google_map_view_arrow_size'] = array(
      '#type' => 'textfield',
      '#title' => t('Arrow size'),
      '#field_suffix' => 'px',
      '#default_value' => $this->options['styled_google_map_view_arrow_size'],
    );
    $form['popup']['styled_google_map_view_arrow_position'] = array(
      '#type' => 'textfield',
      '#title' => t('Arrow position'),
      '#field_suffix' => 'px',
      '#default_value' => $this->options['styled_google_map_view_arrow_position'],
    );
    $form['popup']['styled_google_map_view_disable_auto_pan'] = array(
      '#type' => 'select',
      '#title' => t('Auto pan'),
      '#options' => array(true => t('Yes'), false => t('No')),
      '#description' => t('Automatically center the pin on click'),
      '#default_value' => $this->options['styled_google_map_view_disable_auto_pan'],
    );
    $form['popup']['styled_google_map_view_hide_close_button'] = array(
      '#type' => 'select',
      '#title' => t('Hide close button'),
      '#options' => array(true => t('Yes'), false => t('No')),
      '#description' => t('Hide the popup close button'),
      '#default_value' => $this->options['styled_google_map_view_hide_close_button'],
    );
    $form['popup']['styled_google_map_view_disable_animation'] = array(
      '#type' => 'select',
      '#title' => t('Disable animation'),
      '#options' => array(true => t('Yes'), false => t('No')),
      '#description' => t('Disables the popup animation'),
      '#default_value' => $this->options['styled_google_map_view_disable_animation'],
    );
    $form['popup_classes'] = array(
      '#type' => 'fieldset',
      '#title' => t('Popup classes'),
      '#collapsed' => TRUE,
      '#collapsible' => TRUE,
      '#description' => t('CSS classes for easy popup styling'),
    );
    $form['popup_classes']['styled_google_map_view_content_container_class'] = array(
      '#type' => 'textfield',
      '#title' => t('Wrapper class'),
      '#default_value' => $this->options['styled_google_map_view_content_container_class'],
    );
    $form['popup_classes']['styled_google_map_view_background_class'] = array(
      '#type' => 'textfield',
      '#title' => t('Background class'),
      '#default_value' => $this->options['styled_google_map_view_background_class'],
    );
    $form['popup_classes']['styled_google_map_view_arrow_class'] = array(
      '#type' => 'textfield',
      '#title' => t('Arrow class'),
      '#default_value' => $this->options['styled_google_map_view_arrow_class'],
    );
    $form['popup_classes']['styled_google_map_view_arrow_outer_class'] = array(
      '#type' => 'textfield',
      '#title' => t('Arrow outer class'),
      '#default_value' => $this->options['styled_google_map_view_arrow_outer_class'],
    );
    $form['popup_classes']['styled_google_map_view_arrow_inner_class'] = array(
      '#type' => 'textfield',
      '#title' => t('Arrow inner class'),
      '#default_value' => $this->options['styled_google_map_view_arrow_inner_class'],
    );
  }
}
