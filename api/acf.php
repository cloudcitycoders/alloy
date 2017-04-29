<?php
/**
 * acf.php
 *
 * @package Alloy
 * @subpackage ACF
 * @since 0.1.0
 */

/**
 * A collection of tools to aid in working with ACF
 *
 * The Alloy_ACF class provides methods for working with ACF groups and fields in Alloy.
 *
 * @since 0.1.0
 */
class Alloy_ACF {

  /**
   * Retrieve the value for each field in a group of fields.
   * @param  array  $args An array of args. Title and ID are required. ID can be integer or a string like "option".
   * @return array        An array of field values.
   */
  public function group_data( $args=array() ) {

    // Abort if required fields aren't present.
    if( !$args['title'] || !$args['id'] ) {
      return;
    }

    // Make sure ACF is active.
    if( !function_exists('acf_get_field_groups') ) {
      return;
    }

    $group_key = $this->get_group_key_by_title( $args['title'] );
    $fields = $this->get_group_fields( $group_key );

    if( !$fields ) {
      return;
    }

    $field_data = array();

    foreach($fields as $field) {

      $field_data[$field] = get_field($field, $args['id']);

    }

    return $field_data;

  }

  /**
   * Retrieve the key for an ACF group.
   * @param  string $title The title of the group you want to retrieve the key for.
   * @return string        The key for the ACF group.
   */
  public function get_group_key_by_title( $title='' ) {

    $groups = alloy_acf_groups;

    if( !$groups ) {
      return;
    }

    foreach( $groups as $group ) {

      if( $group['title'] == $title ) {
        return $group['key'];
      }

    }

  }

  /**
   * Get the fields associated with a group by group key.
   * @param  string $group_key The key for the ACF group you want to get the fields from
   * @return array             A list of fields that belong to the group.
   */
  public function get_group_fields( $group_key='' ) {

    $fields = acf_get_fields( $group_key );

    if( !$fields ) {
      return;
    }

    $field_data = array();

    foreach($fields as $field) {
      $field_data[] = $field['name'];
    }

    return $field_data;

  }

}