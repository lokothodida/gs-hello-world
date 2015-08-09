<?php

// This file @includes the /index.php script in your plugin's folder
// but protects the scope of the code in that file by wrapping the execution
// in an anonymous, immediately invoked function.
// It also uses the name of this file as the @id for the rest of the plugin
// and imports that variable into the scope of the /index.php script.
call_user_func(function($id) {
  include $id . '/index.php';
}, basename(__FILE__, '.php'));
