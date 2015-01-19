<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */

// Constants that represent each of the multi-sites this theme supports. It's assumed that the $base_url will contain
// one, and only one of these constants as a way to let the theme know which multi-site is being referred to.
define('WRLC_PRIMARY_SITE_AU', 'auislandora');
define('WRLC_PRIMARY_SITE_CU', 'cuislandora');
define('WRLC_PRIMARY_SITE_DC', 'dcislandora');
define('WRLC_PRIMARY_SITE_MU', 'muislandora');
define('WRLC_PRIMARY_SITE_GA', 'gaislandora');

/**
 * Override or insert variables into the page template for HTML output.
 */
function wrlc_primary_process_html(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

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
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($vars);
  }
  $multi_site = wrlc_primary_get_multi_site();
  $vars['logo'] = wrlc_primary_get_logo_path($multi_site);
  $vars['site_name'] = wrlc_primary_get_site_name($multi_site);
  $vars['site_slogan'] = wrlc_primary_get_site_slogan($multi_site);
  wrlc_primary_multi_site_add_css($multi_site);
}

/**
 * Gets a string describing which multi-site the $base_url is referring to.
 *
 * @return string
 *   A string describing which multi-site the $base_url is referring to, if $base_url does not contain one of the
 *   supported site names, then FALSE is returned.
 */
function wrlc_primary_get_multi_site() {
  global $base_url;
  $multi_sites = array(
    WRLC_PRIMARY_SITE_AU,
    WRLC_PRIMARY_SITE_CU,
    WRLC_PRIMARY_SITE_DC,
    WRLC_PRIMARY_SITE_MU,
    WRLC_PRIMARY_SITE_GA,
  );
  foreach ($multi_sites as $site) {
    if (strpos($base_url, $site) !== FALSE) {
      return $site;
    }
  }
  // To prevent potential problems in supporting a theme without a name the default is assumed to always be Marymount
  // University, aka MU.
  return WRLC_PRIMARY_SITE_MU;
}

/**
 * Gets the default logo path to use for the given multi_site
 *
 * @param string $multi_site
 *   The WRLC_PRIMARY_SITE constant value representing the multi-site.
 *
 * @return string
 *   The path to the default logo.
 */
function wrlc_primary_get_default_logo_path($multi_site) {
  // MU is the default, hence it has the normal default logo path.
  $default_logos = array(
    WRLC_PRIMARY_SITE_AU => '/images/multisite_logos/Digital-Research-Portal-header.png',
    WRLC_PRIMARY_SITE_CU => '/images/multisite_logos/cuislandora-logo.png',
    WRLC_PRIMARY_SITE_DC => '/images/multisite_logos/dcislandora_logo.png',
    WRLC_PRIMARY_SITE_MU => '/logo.png',
    WRLC_PRIMARY_SITE_GA => '/images/multisite_logos/gaislandora_logo.png',
  );
  $default_logo = $default_logos[$multi_site];
  return url(path_to_theme() . $default_logo);
}

/**
 * Gets the path to the logo if one is to be displayed.
 *
 * @param $multi_site
 *   The WRLC_PRIMARY_SITE constant value representing the multi-site.
 *
 * @return null|string
 *   The path to the logo if the logo is to be shown, NULL otherwise.
 */
function wrlc_primary_get_logo_path($multi_site) {
  // The user has toggled the display of the logo to off.
  if (!theme_get_setting('logo')) {
    return NULL;
  }
  // Either the theme settings are set to use the default logo or one that the user has provided.
  return theme_get_setting('default_logo', 'wrlc_primary') ?
    // We have a different default logo depending on the multi-site given in the $base_url.
    wrlc_primary_get_default_logo_path($multi_site) :
    file_create_url(theme_get_setting('logo_path'));
}

/**
 * Gets the default site name for the given multi-site.
 *
 * @param $multi_site
 *   The WRLC_PRIMARY_SITE constant value representing the multi-site.
 *
 * @return string
 *   The default site name for the given multi-site.
 */
function wrlc_primary_get_default_site_name($multi_site) {
  $default_site_names = array(
    WRLC_PRIMARY_SITE_AU => '',
    WRLC_PRIMARY_SITE_CU => 'Digital Collections',
    WRLC_PRIMARY_SITE_DC => '',
    WRLC_PRIMARY_SITE_MU => 'The University Library Archives',
    WRLC_PRIMARY_SITE_GA => 'The University Library Archives',
  );
  return $default_site_names[$multi_site];
}

/**
 * Gets the site name if one is to be displayed.
 *
 * @param $multi_site
 *   The WRLC_PRIMARY_SITE constant value representing the multi-site.
 *
 * @return null|string
 *   The site name if one is to be displayed, otherwise NULL.
 */
function wrlc_primary_get_site_name($multi_site) {
  if (!theme_get_setting('toggle_name', 'wrlc_primary')) {
    return NULL;
  }
  return variable_get('site_name', wrlc_primary_get_default_site_name($multi_site));
}

/**
 * Gets the default site slogan for the given multi-site.
 *
 * @param $multi_site
 *   The WRLC_PRIMARY_SITE constant value representing the multi-site.
 *
 * @return string
 *   The default site slogan for the given multi-site.
 */
function wrlc_primary_get_default_site_slogan($multi_site) {
  $default_site_slogans = array(
    WRLC_PRIMARY_SITE_AU => '',
    WRLC_PRIMARY_SITE_CU => 'University Libraries',
    WRLC_PRIMARY_SITE_DC => '',
    WRLC_PRIMARY_SITE_MU => '',
    WRLC_PRIMARY_SITE_GA => '',
  );
  return $default_site_slogans[$multi_site];
}

/**
 * Gets the site name if one is to be displayed.
 *
 * @param $multi_site
 *   The WRLC_PRIMARY_SITE constant value representing the multi-site.
 *
 * @return null|string
 *   The site name if one is to be displayed, otherwise NULL.
 */
function wrlc_primary_get_site_slogan($multi_site) {
  if (!theme_get_setting('toggle_slogan', 'wrlc_primary')) {
    return NULL;
  }
  return variable_get('site_slogan', wrlc_primary_get_default_site_slogan($multi_site));
}

/**
 * Adds any required css for displaying the given multi-site.
 *
 * @param $multi_site
 *   The WRLC_PRIMARY_SITE constant value representing the multi-site.
 */
function wrlc_primary_multi_site_add_css($multi_site) {
  $multi_site_css_files = array(
    WRLC_PRIMARY_SITE_AU => 'auislandora.css',
    WRLC_PRIMARY_SITE_CU => 'cuislandora.css',
    WRLC_PRIMARY_SITE_DC => 'dcislandora.css',
    WRLC_PRIMARY_SITE_MU => 'muheader.css',
    WRLC_PRIMARY_SITE_GA => 'gaislandora.css',
  );
  // muislandora is the default site, and so the bulk of the css for all sites is defined within it, that's why we
  // include it for all sites, and it's the css that is custom to it is defined in a differently named file.
  drupal_add_css(path_to_theme() . '/css/muislandora.css', 'theme', 'all');
  // Load the customizations for the given multi-site.
  drupal_add_css(path_to_theme() . '/css/' . $multi_site_css_files[$multi_site], 'theme', 'all');
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
  $parsed_url = explode('/', $current);
  foreach ($variables['links'] as $link) {
    // Handle the 'about' and 'Home' menu links.
    if (strtolower($link['title']) == 'about' && $current == "content/about") {
      $link['attributes']['class'][] = 'active';
    }
    if (strtolower($link['title']) == 'home' && $current == "frontpage") {
      $link['attributes']['class'][] = 'active';
    }
    // Set the 'Browse' and 'Search/Search Results' page active menu item.
    if (count($parsed_url) >= 2) {
      if (($parsed_url[0] == "content" || $parsed_url[0] == "islandora") && $parsed_url[1] == "search") {
        if (strtolower($link['title']) == 'search') {
          $link['attributes']['class'][] = 'active';
        }
      }
      if ($parsed_url[0] == "islandora" && $parsed_url[1] == "object") {
        if (strtolower($link['title']) == 'browse') {
          $link['attributes']['class'][] = 'active';
        }
      }
    }
    $menu_link = l($link['title'], $link['href'], $link);
    $html .= "<li>" . $menu_link . "</li>";
  }

  $html .= "  </ul>\n";
  $html .= "</div>\n";

  return $html;
}

/**
 * Implements hook_form_alter().
 */
function wrlc_primary_form_alter(&$variables) {
  // Add a title to the simple search text area of 'Search'.
  if ($variables['#id'] == 'islandora-solr-simple-search-form') {
    $variables['simple']['islandora_simple_search_query']['#attributes']['title']
      = array('title' => t("Search"));
  }
}

/**
 * Implements hook_preprocess().
 */
function wrlc_primary_preprocess_islandora_basic_collection_wrapper(&$variables) {
  // Add the title to 'Grid view' and 'List view', for use as tool tips.
  foreach ($variables['view_links'] as $key => $value) {
    $variables['view_links'][$key]['attributes']['title'] = array('title' => t("@title", array('@title' => $value['title'])));
  }
}

/**
 * Implements hook_menu_local_tasks_alter().
 */
function wrlc_primary_menu_local_tasks_alter(&$data, $router_item, $root_path) {
  // The purpose of this hook implementation is to
  // Override or insert custom variables into the
  // islandora templates.
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
