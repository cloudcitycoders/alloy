<?php
function array_to_object( $array=array() ) {

  $object = json_decode(json_encode($array), FALSE);
  return $object;

}