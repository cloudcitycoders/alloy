<?php
/**
 * Main Alloy file
 *
 * This file exposes the Alloy API to the entire WordPress theme.
 *
 * @package Alloy
 * @since 0.1.0
 */

// Bootstrap.
include 'api/bootstrap.php';
include 'api/post-type.php';


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
   * Expose the Post_Type class to the Alloy class.
   * @param string $action The action this method will be performing.
   * @param array  $args   Developer defined arguments.
   */
  public function Post_Type( $action='new', $args=array() ) {
    $post_type = new Post_Type;
    $post_type->$action($args);
  }

}