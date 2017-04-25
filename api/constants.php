<?php
/**
 * constants.php
 *
 * @package Alloy
 * @subpackage Constants
 * @since 0.1.0
 */

/**
 * Get commonly used WordPress and theme variables
 *
 * Constants allows you to cache and readily access variables that you might use
 * a lot during development of your theme.
 *
 * @since 0.1.0
 */
class Constants {

  public function get( $constant ) {

    $constants = $this->get_constants();

    if( isset($constants[$constant]) ) {
      return $constants[$constant];
    }

    return;

  }

  public function get_constants() {

    return array(
      'site_title' => alloy_site_title,
      'blog_url' => alloy_site_url,
      'theme_url' => alloy_theme_url,
      'theme_dir' => alloy_theme_dir,
      'assets_url' => alloy_assets_url,
      'css_url' => alloy_assets_url . '/css',
      'js_url' => alloy_assets_url . '/js',
      'media_url' => alloy_assets_url . '/media'
    );

  }

}