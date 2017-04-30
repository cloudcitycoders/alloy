<?php
/**
 * fieldset.php
 *
 * @package Alloy
 * @subpackage Fieldset
 * @since 0.1.0
 */

/**
 * Work with ACF fields
 *
 * Create ACF fields and groups.
 *
 * @since 0.1.0
 */
class Fieldset {

  /**
   * Register a field group.
   * @param  array  $args An array of args to pass to the field group.
   */
  public function register( $args=array() ) {

    // Abort if ACF isn't active or required fields aren't present.
    if( !function_exists('acf_add_local_field_group') || !$args['group_args'] || !$args['fields'] || !$args['group_args']['title'] ) {
      return;
    }

    // Register the field group.
    $this->register_field_group( $args, $args['fields'] );

  }

  /**
   * Utilizes ACF to register the field group.
   * @param  array  $args   An array of args for the field group.
   * @param  array  $fields An array of fields to register within the group.
   */
  public function register_field_group( $args=array(), $fields=array() ) {

    $group_args = $this->set_group_args( $args['group_args'] );

    // Set the fields.
    $group_args['fields'] = array( $fields );

    // Register the field group.
    acf_add_local_field_group( $group_args );

  }

  /**
   * Defines some defaults for the group being registered.
   * @param array $group_args The group args.
   * @return array The modified array of arguments.
   */
  public function set_group_args( $group_args=array() ) {

    // Create a group key.
    $group_args['key'] = 'alloy_field_group_' . str_replace('-', '_', sanitize_title($args['group_args']['title']));

    return $group_args;

  }

  /**
   * Register an ACF field.
   * @param  string $type  The type of field being registered.
   * @param  string $label The field's label.
   * @param  string $name  The name of the field used for querying the data in the future.
   * @param  array  $args  ACF args being passed to the field.
   * @return array        An array of args that ACF will use to register the field.
   */
  public function register_field( $type='', $label='', $name='', $args=array() ) {

    if( !$args['key'] ) {
      $args['key'] = 'field_alloy_' . $name;
    }

    $args['label'] = $label;
    $args['name'] = $name;
    $args['type'] = $type;

    return $args;

  }

  /**
   * Register a flexible content layout.
   * @param  string $label The label of the layout.
   * @param  string $name  The field name of the layout.
   * @param  array  $args  An array of ACF args for this layout.
   * @return array        An array to pass to ACF to register this layout.
   */
  public function register_layout( $label='', $name='', $args=array() ) {

    if( !$args['key'] ) {
      $args['key'] = 'layout_alloy_' . $name;
    }

    $args['label'] = $label;
    $args['name'] = $name;

    return $args;

  }

}

