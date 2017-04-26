<?php
/**
 * fetch.php
 *
 * @package Alloy
 * @subpackage Fetch
 * @since 0.1.0
 */

/**
 * Get data
 *
 * Fetch returns data for a specified type in the format requested.
 *
 * @since 0.1.0
 */
class Fetch {

  public function get( $args=array() ) {

    // Abort if required parameter isn't specified.
    if( !$args['query'] && !$args['return'] ) {
      return;
    }

    $query_type = $args['query']['query_type'];

    $data = $this->$query_type( $args );
    return $data;

  }

  public function user( $args=array() ) {

    // Abort if required field isn't present.
    if( !$args['query']['ID'] ) {
      return;
    }

    // Get the user object.
    $wp_user_obj = get_userdata($args['query']['ID']);

    // Abort if user doesn't exist.
    if( !is_object($wp_user_obj) ) {
      return;
    }

    $user_presets = array(
      'ID',
      'user_nicename',
      'user_email',
      'user_url',
      'user_registered',
      'display_name',
      'first_name',
      'last_name',
      'nickname',
      'description'
    );

    $return_data = array();

    foreach($args['return'] as $return) {

      // Check to see if it's WP data.
      if( in_array($return, $user_presets) ) {
        $return_data[$return] = $wp_user_obj->$return;
        continue;
      }

      // Check to see if it's a field group.
      $group_fields = acf_get_group_data( $return, 'user_' . $wp_user_obj->ID );

      if( $group_fields ) {
        $group_slug = sanitize_title( $return );
        $return_data[$group_slug] = $group_fields;
        continue;
      }

      // Check to see if it's a one off field.
      $field = get_field( $return, 'user_' . $wp_user_obj->ID );

      $return_data[$return] = $field;

    }

    return $return_data;

  }

}