<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */

/**
 * Implements hook preprocess_page().
 *
 * Hook implementation is used to provide style
 * overrides on a multi-site basis. Targed
 * multisites include:
 *
 * muislandora.wrlc.org
 * auislandora.wrlc.org
 * cuislandora.wrlc.org
 * dcislandora.wrlc.org
 * gaislandora.wrlc.org
 *
 * @param array $vars
 *   An array of available page level variables.
 */
function wrlc_primary_preprocess_page(&$vars) {
  $site = $_SERVER['HTTP_HOST'];
  drupal_add_css(path_to_theme() . '/css/muislandora.css', 'theme', 'all');

  // Switch on site host to provide applicable CSS.
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
      drupal_add_css(path_to_theme() . '/css/cuislandora.css', 'theme', 'all');
      break;

    case 'gaislandora.wrlc.org':
      $vars['logo'] = url(path_to_theme() . "/images/multisite_logos/gaislandora_logo.png");
      $vars['site_name'] = "The University Library Archives";
      $vars['site_slogan'] = "";
      drupal_add_css(path_to_theme() . '/css/gaislandora.css', 'theme', 'all');
      break;

  }
}

/**
 * Implement hook pattern for links__system_main_menu().
 *
 * This function will apply active class when
 * appropriate in the main menu.
 *
 * @param array $variables
 *   The 'system_main_menu' menu links.
 *
 * @return string
 *   html content as string.
 */
function wrlc_primary_links__system_main_menu($variables) {
  $html = "<div>\n";
  $html .= " <ul class='links inline clearfix'>\n";
  $current = drupal_get_path_alias();

  foreach ($variables['links'] as $link) {
    $lpath = drupal_get_path_alias($link['href']);
    // Used to ensure browse is selected
    // when viewing islandora items.
    $pos = strpos($current, $lpath);
    if ($lpath == $current || $pos === 0) {
      $link['attributes']['class'][] = 'active';
    }
    $menu_link = l($link['title'], $link['href'], $link);
    $html .= "<li>" . $menu_link . "</li>";
  }

  $html .= "  </ul>\n";
  $html .= "</div>\n";

  return $html;
}

/**
 * Implements hook_preprocess_menu_link().
 *
 * Set menu items as 'active', with the class active.
 *
 * @param array $vars
 *   An indexed array of menu elements.
 */
//function wrlc_primary_menu_link(array $variables) {
//   dpm($variables, "hello there");
//   dsm($variables, "hello there");


//   $link['html'] = TRUE;
//   $output .= l('<span class="whatever">' . $link['title'] . '</span>', $link['href'], $link);


//   $element = &$vars['element'];
//   // Settings the 'Browse' menu item here, so as not to reset the
//   // menu tree path. This could cause woe's with any module level
//   // hook_preprocess_(html) functions.
//   if ($element['#href'] == "islandora" && strpos(current_path(), "islandora/object") !== FALSE) {
//     $element['#localized_options']['attributes']['class'][] = "active";
//   }
//}

// function wrlc_primary_links__main_menu(&$variables) {
//   dpm($variables, "vars::");
// }
/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function wrlc_primary_breadcrumb($breadcrumb) {
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
