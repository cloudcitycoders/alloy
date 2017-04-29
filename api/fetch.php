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

  /**
   * Get data based on the query provided and return the fields provided.
   * @param  array  $args An array containing the query and return.
   * @return array        An array of the returned data.
   */
  public function get( $args=array() ) {

    // Abort if required parameter isn't specified.
    if( !$args['query'] && !$args['return'] ) {
      return;
    }

    $query_type = $args['query']['query_type'];

    $data = $this->$query_type( $args );
    return $data;

  }

  /**
   * Get requested user data.
   * @param  array  $args The query and return parameters.
   * @return array        An array of data.
   */
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

  /**
   * Get WP fields, custom field groups, and custom fields.
   * @param  array  $query_return The fields to be returned.
   * @param  array  $wp_obj       The WP object of what is being queried.
   * @param  array  $presets      The fields available inside the WP object.
   * @param  string|int $acf_id   The ACF ID field. Can be an ID (int), option or user_ (string)
   * @return array                Returns the data.
   */
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