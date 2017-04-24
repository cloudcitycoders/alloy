<?php
/**
 * post-type.php
 *
 * @package Alloy
 * @subpackage Post_Type
 * @since 0.1.0
 */

/**
 * Manage post types in WordPress
 *
 * Post_Type allows developers to quickly and easily add new post types to the site
 * they are building.
 *
 * @since 0.1.0
 */
class Post_Type {

  /**
   * Register a new post type.
   * @param  array  $args An array of args to pass to register_post_type.
   * @return null
   */
  public function new( $args=array() ) {

    // Abort if the required arguments aren't defined.
    if( !$args['label'] ) {
      return;
    }

    // Get the args.
    $args = $this->new_post_type_args( $args );

    // Register the post type.
    register_post_type($args['slug'], $args);
  }

  /**
   * Sets up the args for register_post_type.
   * @param  array  $args An array of args being passed in.
   * @return array       The array that will be used for register_post_type.
   */
  public function new_post_type_args( $args=array() ) {

    // Set the slug based on the label if no slug is defined.
    if( !$args['slug'] ) {
      $args['slug'] = sanitize_title( $args['label'] );
    }

    // Most post types are public so set it to public by default unless set otherwise.
    if( !$args['public'] ) {
      $args['public'] = true;
    }

    return $args;

  }


}