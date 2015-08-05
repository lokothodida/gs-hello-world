<?php
// Here we define some useful methods for getting, saving and displaying the
// settings information
// Rather than creating a class (whose name would have to be changed if you
// wanted to build on this example), we will take a very Javascript approach
// and create a list/array of methods that are returned from a closure
// The closure allows us to define variables common to the methods and protect
// the scope of those new variables
// We will also have an $imports array as a parameter to the closure, so that
// variables can easily be imported into it:
return function($imports = array()) {

// Import the i18n helper method (we will use this for displaying messages)
$i18n = $imports['i18n'];

// Set the filename for the file we will save the data to
// Note that we are using the json file format, because PHP has native methods
// for handling jsons very efficiently
$file = $imports['datapath']. '/mysettings.json';

// Set some default data for the file
$default = array(
  'setting1' => 'value1',
);

// Now we define our array of methods:
$settings = array();

// This method gets the current settings data
$settings['get'] = function() use ($file, $i18n) {
  // Get the contents from the file (suppressing the error here)
  $contents = @file_get_contents($file);

  if ($contents !== false) {
    // If we were successful, return the data as an array
    return (array) json_decode($contents);
  } else {
    // Otherwise throw an exception
    // We do this because if a script is about to execute that depends on the
    // data from this file, and that data doesn't exist, there are many, many
    // problems that could arise. It is therefore best to stop the execution
    // of the script as early as possible:
    throw new Exception($i18n('SETTINGS_GET_ERR'));
  }
};

// Save settings, given an array of data
$settings['save'] = function($data = array()) use ($default, $file) {
  // Just in case the array doesn't have all of the data that we want, add
  // in the default properties
  $data = array_merge($default, $data);

  // Now encode the array for the json file format
  $contents = json_encode($data);

  // Now put the contents into the file
  // The error is suppressed, and all that is returned is a success boolean
  // This is because (for our example) a saving error is not as catastrophic as
  // a 'getting' error
  return (bool) @file_put_contents($file, $contents);
};

// Initialization
// This simply creates the file if it doesn't already exist
$settings['init'] = function() use ($file, $settings, $default) {
  if (!file_exists($file)) {
    return $settings['save']($default);
  } else {
    return true;
  }
};

// Displaying a form given some settings $data
$settings['displayform'] = function($data) use ($i18n) {
  include 'form.php';
};

// Displaying error message when we know the $status (true = success)
$settings['displaystatus'] = function($status, $msg) use ($i18n) {
  // Set the css class
  $class = $status ? 'updated' : 'error';

  // Escape the css class and message using json_encode
  $css = json_encode($class);
  $msg = json_encode($msg);

  // status.php will dictate how the error is shown
  include 'status.php';
};

// Finally, return the methods
return $settings;

};
