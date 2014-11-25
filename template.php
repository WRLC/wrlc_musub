<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function wrlc_primary_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  wrlc_primary_preprocess_html($variables, $hook);
  wrlc_primary_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function wrlc_primary_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function wrlc_primary_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function wrlc_primary_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // wrlc_primary_preprocess_node_page() or wrlc_primary_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function wrlc_primary_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function wrlc_primary_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function wrlc_primary_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */

function wrlc_primary_preprocess_page(&$vars) {
  $site = $_SERVER['HTTP_HOST'];
  //dpm($site, "site");
  //$site = "http://gaislandora.wrlc.org";//
// http://muislandora.wrlc.org // Default
// http://auislandora.wrlc.org
// http://cuislandora.wrlc.org
// http://dcislandora.wrlc.org
// http://gaislandora.wrlc.org
  drupal_add_css(path_to_theme() . '/css/muislandora.css', 'theme', 'all');
  switch ($site) {
    case 'auislandora.wrlc.org':
      $vars['logo'] = url(path_to_theme() . "/images/multisite_logos/Digital-Research-Portal-header.png");
      $vars['site_name'] = "";
      drupal_add_css(path_to_theme() . '/css/auislandora.css', 'theme', 'all');
      break;
    case 'dcislandora.wrlc.org':
      $vars['logo'] = url(path_to_theme() . "/images/multisite_logos/dcislandora_logo.png");
      $vars['site_name'] = "";
      drupal_add_css(path_to_theme() . '/css/dcislandora.css', 'theme', 'all');
      break;
    case 'cuislandora.wrlc.org':
      $vars['logo'] = url(path_to_theme() . "/images/multisite_logos/cuislandora-logo.png");
      $vars['site_name'] = "Digital Collections";
      $vars['site_slogan'] = "University Libraries";
      //$vars['site_name'] = "Digital Collections";
      drupal_add_css(path_to_theme() . '/css/cuislandora.css', 'theme', 'all');
      break;
    case 'muislandora.wrlc.org':
      //Add your CSS for site 3 here with drupal_add_css
      //drupal_add_css(path_to_theme() . '/css/muislandora.css', 'theme', 'all');
      break;
    case 'gaislandora.wrlc.org':
      //Add your CSS for site 3 here with drupal_add_css
      $vars['logo'] = url(path_to_theme() . "/images/multisite_logos/gaislandora_logo.png");
      $vars['site_name'] = "The University Library Archives";
      $vars['site_slogan'] = "";
      drupal_add_css(path_to_theme() . '/css/gaislandora.css', 'theme', 'all');
      break;
  }
  //dpm($vars, "vars");
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function wrlc_primary_breadcrumb($breadcrumb) {
	//dpm($breadcrumb, "bread crumb templaet");
  if (!empty($breadcrumb)) {
    return '<div class="breadcrumb">'. implode(' › ', $breadcrumb['breadcrumb']) .'</div>';
  }
}

/**
 * Override or insert variables into the islandora templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function wrlc_primary_menu_local_tasks_alter(&$data, $router_item, $root_path) {
  if (strpos($root_path, 'islandora/object/%') === 0) {
    if (isset($data['tabs'][0]['output'])) {
      foreach ($data['tabs'][0]['output'] as $key => &$tab) {
        if ($tab['#link']['path'] == 'islandora/object/%/print_object') {
          if ($root_path == 'islandora/object/%') {
            $tab['#prefix'] = '<li class="tabs-primary__tab">';
            $tab['#text'] = t('Print');
            $tab['#options']['attributes']['class'] = array("tabs-primary__tab-link");
          }
        }
      }
    }
  }
}
