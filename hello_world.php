<?php

// Protect the scope of all of this plugin's code by wrapping up in an
// annonymous function (using create_function to be compatible with PHP 5.2)
call_user_func(create_function('$id', '
  include($id . "/register.php");
'), basename(__FILE__, ".php"));
