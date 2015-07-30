<?php

// Now in the scope of our closure, we can define the plugin.
// There are a few procedures that we will need to run through first.

// == LANGUAGE FUNCTIONALITY ==
// The languages are defined by scripts in the /lang/ directory of your plugin
// Each language has a file (e.g. en_US.php), and in this file is an
// associative array called $i18n. Each key => value mapping in this array
// represents an internationalizable hash that will be shown if the
// installation's language is set to that file. So if the installation is in
// English, the en_US.php file of your plugin will be merged with the core
// i18n array, and the hashes will be available via i18n('hello_world/HASHNAME')
// To facillitate this merge, the below code will merge the current language
// if that langauge file exists, and en_US if there is no current language file
// for the plugin (remembering that we have the plugin $id imported from the
// immediately invoked function:
i18n_merge($id) || i18n_merge($id, 'en_US');

// To avoid having to call i18n('hello_world/HASHNAME') every time, we will
// create a local i18n wrapper method that allows us to call $i18n('HASHNAME')
// instead
$i18n = function ($hash) use ($id) {
  // This uses the 'return' version of the i18n method
  return i18n_r($id . '/' .$hash);
};

// == PLUGIN FUNCTIONALITY ==
// This example plugin will do 2 things:
// 1. Echo "Hello World" in the footer of the current front-end theme
// 2. Have an admin-panel page in 'Themes' that says as much
// To achieve this, we will register 'hooks' with the GetSimple installation
// that will be invoked at the desired times.
// 'Hooks' are callbacks: functions that are executed are particular points in
// time during the time that GetSimple is running on the server
// For variable cleanliness, let us keep the actions on an array:
$actions = array();

// Lets define the callback that will be called in the theme's footer:
$actions['theme-footer'] = function() use ($i18n) {
  // We have imported the $i18n method defined earlier into the scope of this
  // function so that we can use it to output the message in a language-dependent
  // fashion
  echo $i18n('HELLO_WORLD_MSG');
};

// Now let us define the administration panel callback:
$actions['admin'] = function() use ($i18n) {
  // Header
  echo '<h3>' . $i18n('PLUGIN_TITLE') . '</h3>';

  // Content
  echo '<p>' . $i18n('HELLO_WORLD_ADMIN') . '</p>';
};

// == PLUGIN REGISTRATION ==
// With our methods defined, we can register the plugin and set the hooks.
// Without this stage, our plugin wouldn't run at all!

// register_plugin sets the general information about your plugin, and the admin
// panel function that will run when the admin panel is accessed
// This example will use call_user_func_array just to make the arguments clearer:
call_user_func_array('register_plugin', array(
  'id'          => $id,
  'title'       => $i18n('PLUGIN_TITLE'),
  'version'     => '1.0',
  'author'      => 'You',
  'website'     => 'http://yoursite.com',
  'description' => $i18n('PLUGIN_DESCRIPTION'),
  'tab'         => 'theme',
  'admin'       => $actions['admin']
));

// This allows the admin panel to be active, but there isn't yet a sidebar link
// to provide us access to it. So register an action that sets the sidebar link.
// The parameters passed to the hook/action are the id of the plugin and the
// sidebar label:
add_action('theme-sidebar', 'createSideMenu', array($id, $i18n('PLUGIN_SIDEBAR')));

// Finally, register the theme-footer hook:
add_action('theme-footer', $actions['theme-footer']);
