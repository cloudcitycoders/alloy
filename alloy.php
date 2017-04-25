<?php
/**
 * Main Alloy file
 *
 * This file exposes the Alloy API to the entire WordPress theme.
 *
 * @package Alloy
 * @since 0.1.0
 */

// Get configs.
include 'config/constants.config.php';

// Load the API.
include 'api/bootstrap.php';
include 'api/constants.php';
include 'api/post-type.php';
include 'api/taxonomy.php';
include 'api/asset.php';


/**
 * The Alloy class.
 *
 * This class provides an interfact to the API. It's methods are available statically
 * to any theme file as long as functions.php is including alloy.php.
 *
 * @since 0.1.0
 */
class Alloy {

  /**
   * Expose the Constants class to Alloy.
   * @param string $constant The key to access the constant being requested.
   */
  public function Constant( $constant ) {
    $constants = new Constants;
    return $constants->get($constant);
  }

  /**
   * Expose the Post_Type class to the Alloy class.
   * @param string $action The action this method will be performing.
   * @param array  $args   Developer defined arguments.
   */
  public function Post_Type( $action='new', $args=array() ) {
    $post_type = new Post_Type;
    $post_type->$action($args);
  }

  /**
   * Expose the Taxonomy class to the Alloy class.
   * @param string $action The action this method will be performing.
   * @param array  $args   Developer defined arguments.
   */
  public function Taxonomy( $action='new', $args=array() ) {
    $taxonomy = new Taxonomy;
    $taxonomy->$action($args);
  }

  /**
   * Expose the Asset class to the Alloy class.
   * @param string $action The action this method will be performing.
   * @param array  $args   Developer defined arguments.
   */
  public function Asset( $action='new', $args=array() ) {
    $asset = new Asset;
    $asset->$action($args);
  }

}