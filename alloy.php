<?php

// Set the version of Alloy.
define('alloy_version', '0.1 Alpha');

// Add the version of Alloy to the WP Admin.
add_filter('update_footer', 'alloy_version_footer', 999);
function alloy_version_footer($content) {
  return '<a href="https://github.com/cloudcitycoders/alloy">Alloy</a> Version ' . alloy_version . ' | WordPress ' . $content;
}