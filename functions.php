<?php
function acf_get_field_group_key_by_title( $title='' ) {

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

function acf_get_group_fields( $title='' ) {
  $group_key = acf_get_field_group_key_by_title( $title );
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

function acf_get_group_data( $title='', $id='' ) {

  if( !$title || !$id ) {
    return;
  }

  $fields = acf_get_group_fields( $title );

  if( !$fields ) {
    return;
  }

  $field_data = array();

  foreach($fields as $field) {

    $field_data[$field] = get_field($field, $id);

  }

  return $field_data;

}