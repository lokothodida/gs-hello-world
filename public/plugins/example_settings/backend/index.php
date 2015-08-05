<?php

// In a separate file (settings_functions.php) we have defined some useful
// functions for manipulating and displaying the settings.
// This file returns a closure, that when invoked returns an array of functions.
// Because of this, we can include the file and assign it a variable:
$import = include 'settings_functions.php';

// Then invoke the variable and get the array of functions
// In the invokation, we will pass in some parameters from the current scope
// so that the imported methods can use them
$methods = $import(array(
  'i18n'     => $i18n,
  'datapath' => GSDATAOTHERPATH,
));

// For the sake of ease, we can bring the methods into the current symbol table
// So that $init === $methods['init']
extract($methods);

// Now we will try to:
//   1. Initialize the settings file
//   2. Save any changes if a save-based query was made
//   3. Display the settings form
// If an error occurs at any stage in these processes, we want to stop the
// script from executing and display a sensible error message to the user that
// doesn't break the GetSimple admin UI.
// To do this, we will wrap everything in a try block:
try {
  // Call $init to initialize the settings file
  // This simply creates the file if it doesn't already exist
  $init();

  // Now check to see if a $_POST query has been sent
  // If so, try to save the data with our $save() function
  // If successful, display a success message
  // Otherwise display an error message
  if (!empty($_POST)) {
    $status = $save($_POST);
    $msg = $status ? 'SUCC' : 'ERR';
    $displaystatus($status, $i18n('SETTINGS_SAVE_' . $msg));
  }

  // Finally we can display the form
  // Get the settings data and display it with $displayform()
  $displayform($get());
} catch (Exception $error) {
  // If a catastrophic error has been raised, the execution of the above script
  // will be stopped and the code in this catch block will run
  // So all we will do is display an error message telling the user what went
  // wrong:
  $displaystatus(false, $error->getMessage());
}
