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

    $presets = array(
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

    $acf_id = 'user_' . $wp_user_obj->ID;

    return $this->get_return_data( $args['return'], $wp_user_obj, $presets, $acf_id );

  }

  public function get_return_data( $query_return=array(), $wp_obj=array(), $presets=array(), $acf_id='' ) {

    // If $wp_obj is an array convert it to an object.
    if( is_object( $wp_obj ) ) {
      $wp_obj = array_to_object( $wp_obj );
    }

    $return_data = array();

    foreach( $query_return as $return ) {

      // Check to see if it's WP data.
      if( in_array($return, $presets) ) {
        $return_data[$return] = $wp_obj->$return;
        continue;
      }

      // Check to see if it's a field group.
      $group_fields = Alloy::ACF('group_data', array(
        'title' => $return,
        'id' => $acf_id
      ));

      if( $group_fields ) {
        $group_slug = sanitize_title( $return );
        $return_data[$group_slug] = $group_fields;
        continue;
      }

      // Check to see if it's a one off field.
      $field = get_field( $return, $acf_id );

      $return_data[$return] = $field;

    }

    return $return_data;
  }

}