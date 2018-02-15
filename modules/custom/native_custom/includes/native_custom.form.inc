<?php
/**
 * @file
 * Custom page with site settings
 */

function native_custom_site_setings_form() {
  $form = array();

  $form['social'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social'),
    '#weight' => 1,
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  $form['social']['facebook'] = array(
    '#type' => 'textfield',
    '#title' => t('Facebook'),
    '#default_value' => variable_get('facebook', ''),
    '#size' => 80,
    '#maxlength' => 128,
  );
  $form['social']['twitter'] = array(
    '#type' => 'textfield',
    '#title' => t('Twitter'),
    '#default_value' => variable_get('twitter', ''),
    '#size' => 80,
    '#maxlength' => 128,
  );
  $form['social']['youtube'] = array(
    '#type' => 'textfield',
    '#title' => t('Youtube'),
    '#default_value' => variable_get('youtube', ''),
    '#size' => 80,
    '#maxlength' => 128,
  );
  $form['social']['instagram'] = array(
    '#type' => 'textfield',
    '#title' => t('Instagram'),
    '#default_value' => variable_get('instagram', ''),
    '#size' => 80,
    '#maxlength' => 128,
  );
  $form['social']['leafly'] = array(
    '#type' => 'textfield',
    '#title' => t('Leafly'),
    '#default_value' => variable_get('leafly', ''),
    '#size' => 80,
    '#maxlength' => 128,
  );
  $form['settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Other settings'),
    '#weight' => 1,
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  $form['settings']['locations'] = array(
    '#type' => 'textfield',
    '#title' => t('Locations link'),
    '#description' => t('For mobile site location button.'),
    '#default_value' => variable_get('locations', ''),
    '#size' => 80,
    '#maxlength' => 128,
  );
  $form['settings']['phone'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone'),
    '#default_value' => variable_get('phone', ''),
    '#size' => 80,
    '#maxlength' => 128,
  );


  return system_settings_form($form);
}