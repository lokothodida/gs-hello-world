<?php

// Closure to protect variables related to these common functions
return function($imports = array()) {

// Import the i18n helper method
$i18n = $imports['i18n'];

// File we will save the data to
$file = $imports['datapath']. '/mysettings.json';

// Default data for the file
$default = array(
  'setting1' => 'value1',
);

// Methods
$settings = array();

// Get current settings
$settings['get'] = function() use ($file) {
  $contents = file_get_contents($file);
  return (array) json_decode($contents);
};

// Save settings
$settings['save'] = function($data) use ($file) {
  $contents = json_encode($data);
  return file_put_contents($file, $contents);
};

// Initialize
$settings['init'] = function() use ($file, $settings, $default) {
  if (!file_exists($file)) {
    $settings['save']($default);
  }
};

// Display a form
$settings['displayform'] = function($data) use ($i18n) {
  include 'form.php';
};

// Display error message
$settings['displaystatus'] = function($status, $msg) use ($i18n) {
  $class = $status ? 'updated' : 'error';
  $css = json_encode($class);
  $msg = json_encode($msg);
  include 'status.php';
};

// Expose the methods
return $settings;

};
