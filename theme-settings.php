<?php
/**
 * @file
 * Contains the theme settings file hook implementations and customizations.
 */

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function wrlc_primary_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL) {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }
}

/**
 * Implements hook_settings().
 */
function wrlc_primary_settings($saved_settings) {
  $defaults = zen_theme_get_default_settings('dscpublic');
}
