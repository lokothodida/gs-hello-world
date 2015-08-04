<?php

// Load the settings functions and import the variables into the closure
$import = require 'settings_functions.php';

// Import variables into the closure
$methods = $import(array(
  'i18n'     => $i18n,
  'datapath' => GSDATAOTHERPATH,
));

// Pull the methods from the array into the scope of this included file
extract($methods);

// Initialize the settings
$init();

// Save any changes
if (!empty($_POST)) {
  try {
    $save($_POST);
    $displaystatus(true, $i18n('SETTINGS_SAVE_SUCC'));
  } catch (Exception $error) {
    $displaystatus(false, $i18n('SETTINGS_SAVE_ERR'));
  }
}

// Display the form
try {
  $displayform($get());
} catch (Exception $error) {
  $displaystatus(false, $i18n('SETTINGS_SHOW_ERR'));
}
