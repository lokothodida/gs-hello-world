<?php

// Now inside of the scope of the anonymous function, we can register the
// the plugin, and we are completely safe with declaring new variables (so
// our actions here will not interfere with other plugins).

// The /lib/ directory has a wrapper class called GSPlugin, which can safely
// be @included and gives us a nice collection of methods for more easily
// registering our plugin's details and actions.
include 'lib/gsplugin.php';

// Instantiate the GSPlugin class and register the static plugin information.
// The $id variable is given to by the parameter passed in the anonymous
// function, so it doesn't need to hard-code statically
// This means that you can easily rename your plugin without breaking it
// simply by renaming the hello_world.php file and hello_world/ folder
// accordingly
$plugin = new GSPlugin(array(
  'id'       => $id,
  'version'  => '1.0',
  'author'   => 'You',
  'website'  => 'http://yourwebsite.com',
  'tab'      => 'theme',
  'lang'     => 'en_US',
));

// Because the 'tab' field is 'theme' in the above registration, the admin
// panel of this plugin will appear in the 'Theme' section
// However, we won't be able to access it unless there is a link to it in
// the sidebar! So let's add a sidebar:
$plugin->sidebar($plugin->i18n('PLUGIN_SIDEBAR'));

// The above code registers a hook to create the sidebar using the plugin's
// ID, and with a label that is language-sensitive (the hash for the label is
// defined in the /lang/ directory)

// Now for the admin panel itself
// This call will execute the index.php script (in the /backend/ directory
// of your plugin) when an admin accesses your plugin's admin panel.
// In that script, we define what should happen and what should be shown on
// the admin panel.
$plugin->admin('backend/index.php');

// Now let us add a hook to display something on the front end.
// The below hook will be executed in the theme's footer when the front end
// user loads the page.
// It will run the show.php script (in this plugin's /frontend/ directory)
$plugin->hook('theme-footer', 'frontend/show.php');

// Finally, initialize the plugin:
$plugin->init();
