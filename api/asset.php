<?php
/**
 * asset.php
 *
 * @package Alloy
 * @subpackage Asset
 * @since 0.1.0
 */

/**
 * Manage external assets in WordPress
 *
 * Asset allows developers to quickly add new CSS and JavaScript documents to their pages.
 *
 * @since 0.1.0
 */
class Asset {

  /**
   * Enqueue an asset.
   * @param  array  $args An array of args to pass to wp_enqueue_style or wp_enqueue_script.
   * @return null
   */
  public function new( $args=array() ) {

    // Abort if required information is not set.
    if( !$args['type'] || !$args['handle'] ) {
      return;
    }

    $args['type'] = strtolower($args['type']);

    if( $args['type'] == 'css' ) {
      $this->new_css( $args );
    }

    if( $args['type'] == 'js' ) {
      $this->new_js( $args );
    }

  }

  /**
   * Enqueue a stylesheet.
   * @param  array  $args An array of args to pass to wp_enqueue_style.
   * @return null
   */
  public function new_css( $args=array() ) {

    // Set up the args.
    $args = $this->new_css_args( $args );

    wp_enqueue_style( $args['handle'], $args['src'], $args['deps'], $args['ver'], $args['media'] );

  }

  /**
   * Sets up the args for wp_enqueue_style.
   * @param  array  $args An array of args being passed in.
   * @return array       The array that will be used for wp_enqueue_style.
   */
  public function new_css_args( $args=array() ) {

    // Set the src if it hasn't been defined.
    if( !$args['src'] ) {
      $args['src'] = Alloy::Constant('css_url') . '/' . $args['handle'];
    }

    // If the ver isn't specified set it to the WP default.
    if( !$args['ver'] ) {
      $args['ver'] = false;
    }

    return $args;

  }

  /**
   * Enqueue a script.
   * @param  array  $args An array of args to pass to wp_enqueue_script.
   * @return null
   */
  public function new_js( $args=array() ) {

    // Set up the args.
    $args = $this->new_js_args( $args );

    wp_enqueue_script( $args['handle'], $args['src'], $args['deps'], $args['ver'], $args['in_footer'] );

    // If the "data" arg is set fire up wp_localize_script.
    if( $args['data'] ) {

      wp_localize_script( $args['handle'], $args['data']['handle'], $args['data']['data'] );

    }

  }

  /**
   * Sets up the args for wp_enqueue_script.
   * @param  array  $args An array of args being passed in.
   * @return array       The array that will be used for wp_enqueue_script.
   */
  public function new_js_args( $args=array() ) {

    // Set the src if it hasn't been defined.
    if( !$args['src'] ) {
      $args['src'] = Alloy::Constant('js_url') . '/' . $args['handle'];
    }

    // If the ver isn't specified set it to the WP default.
    if( !$args['ver'] ) {
      $args['ver'] = false;
    }

    // Make $in_footer set to true by default if it's not already set.
    if( !$args['in_footer'] ) {
      $args['in_footer'] = true;
    }

    return $args;
  }

}