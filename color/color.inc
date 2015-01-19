<?php
/**
 * @file
 * Default colour settings file.
 */

// Put the logo path into JavaScript for the live preview.
drupal_add_js(array('color' => array('logo' => theme_get_setting('logo', 'wrlc_primary'))), 'setting');

$info = array(
  // Available colors and color labels used in theme.
  'fields' => array(
    'html' => t('HTML Background'),
    'bg' => t('Main background'),
    'text' => t('Text color'),
    'link' => t('Link color'),
    'linkalt' => t('Link alt color (hover, active, etc)'),
  ),
  // Pre-defined color schemes.
  'schemes' => array(
    'default' => array(
      'title' => t('Default'),
      'colors' => array(
        'html' => '#eeeeee',
        'bg' => '#ffffff',
        'linkalt' => '#009fda',
        'text' => '#1a1a1a',
        'link' => '#717072',
      ),
    ),
    'auislandora' => array(
      'title' => t('American University'),
      'colors' => array(
        'html' => '#ffffff',
        'bg' => '#ffffff',
        'linkalt' => '#009fda',
        'text' => '#1a1a1a',
        'link' => '#717072',
      ),
    ),
    'cuislandora' => array(
      'title' => t('Catholic University'),
      'colors' => array(
        'html' => '#ffffff',
        'bg' => '#ffffff',
        'linkalt' => '#009fda',
        'text' => '#1a1a1a',
        'link' => '#717072',
      ),
    ),
    'dcislandora' => array(
      'title' => t('District of Columbia University'),
      'colors' => array(
        'html' => '#ffffff',
        'bg' => '#ffffff',
        'linkalt' => '#009fda',
        'text' => '#1a1a1a',
        'link' => '#717072',
      ),
    ),
    'muislandora' => array(
      'title' => t('Marymount University'),
      'colors' => array(
        'html' => '#ffffff',
        'bg' => '#ffffff',
        'linkalt' => '#009fda',
        'text' => '#1a1a1a',
        'link' => '#717072',
      ),
    ),
    'gaislandora' => array(
      'title' => t('Gallaudet University'),
      'colors' => array(
        'html' => '#ffffff',
        'bg' => '#ffffff',
        'linkalt' => '#009fda',
        'text' => '#1a1a1a',
        'link' => '#717072',
      ),
    ),
  ),

  // CSS files (excluding @import) to rewrite with new color scheme.
  'css' => array(
    'css/colors.css',
  ),

  // Files to copy.
  'copy' => array(
    'logo.png',
  ),

  // Gradient definitions.
  'gradients' => array(),

  // Color areas to fill (x, y, width, height).
  'fill' => array(),

  // Coordinates of all the theme slices (x, y, width, height)
  // with their filename as used in the stylesheet.
  'slices' => array(),

  // Reference color used for blending. Matches the base.png's colors.
  'blend_target' => '#ffffff',

  // Preview files.
  'preview_css' => 'color/preview.css',
  'preview_js' => 'color/preview.js',
  'preview_html' => 'color/preview.html',

  // Base file for image generation.
  'base_image' => 'color/base.png',
);
