<?php
/**
 * taxonomy.php
 *
 * @package Alloy
 * @subpackage Taxonomy
 * @since 0.1.0
 */

/**
 * Manage taxonomies in WordPress
 *
 * Taxonomy allows developers to quickly and easily add new taxonomies to the site
 * they are building.
 *
 * @since 0.1.0
 */
class Taxonomy {

  /**
   * Register a new taxonomy.
   * @param  array  $args An array of args to pass to register_taxonomy.
   * @return null
   */
  public function new( $args=array() ) {

    // Abort if the required arguments aren't defined.
    if( !$args['post_type'] || !$args['label'] ) {
      return;
    }

    // Get the args.
    $args = $this->new_taxonomy_args( $args );

    // Register the taxonomy.
    register_taxonomy( $args['slug'], $args['post_type'], $args );

  }

  /**
   * Sets up the args for register_taxonomy.
   * @param  array  $args An array of args being passed in.
   * @return array       The array that will be used for register_taxonomy.
   */
  public function new_taxonomy_args( $args=array() ) {

    // Set the slug based on the label if no slug is defined.
    if( !$args['slug'] ) {
      $args['slug'] = sanitize_title( $args['label'] );
    }

    // Change the default behavior of hierarchical if it's not set.
    if( !isset($args['hierarchical']) ) {
      $args['hierarchical'] = true;
    }

    return $args;

  }

}