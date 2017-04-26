<?php
/**
 * user.php
 *
 * @package Alloy
 * @subpackage User
 * @since 0.1.0
 */

/**
 * Manage a user in WordPress
 *
 * The User class allows you to get specific data about a user.
 *
 * @since 0.1.0
 */
class User {

  public function get( $args=array() ) {

    $args = $this->get_user_args( $args );

    return Alloy::Fetch('get', $args);

  }

  public function get_user_args( $args=array() ) {

    $args['query']['query_type'] = 'user';

    return $args;

  }

}