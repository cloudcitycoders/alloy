<?php
/**
 * acf.php
 *
 * @package Alloy
 * @subpackage ACF
 * @since 0.1.0
 */

class Alloy_ACF {

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

  public function get_group_key_by_title( $title='' ) {

    $groups = acf_get_field_groups();

    if( !$groups ) {
      return;
    }

    foreach( $groups as $group ) {

      if( $group['title'] == $title ) {
        return $group['key'];
      }

    }

  }

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