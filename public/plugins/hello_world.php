<?php

// This file @includes the /register.php script in your plugin's folder
// but protects the scope of the code in that file by wrapping the execution
// in an anonymous, immediately invoked function(*).
// It also uses the name of this file as the @id for the rest of the plugin
// and imports that variable into the scope of the /register.php script.
call_user_func(create_function('$id', '
  include($id . "/register.php");
'), basename(__FILE__, ".php"));

// (*) @create_function is being used instead of a Closure because GetSimple
//     supports PHP 5.2+, and Closures were only introduced in 5.3. Ideally
//     the code would look like this (PHP 5.3+):
//     call_user_func(function($id) {
//       include $id . '/register.php';
//     }, basename(__FILE__, '.php'));
