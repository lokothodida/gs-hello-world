<?php

// Include the plugin wrapper class
include 'lib/gsplugin.php';

// Instantiate the GSPlugin class and register static plugin information
$plugin = new GSPlugin(array(
  'id'          => $id,
  'version'     => '1.0',
  'author'      => 'You',
  'website'     => 'http://yourwebsite.com',
  'tab'         => 'theme',
  'lang'        => 'en_US',
));

// Add theme footer hook (shows "Hello World!" message in footer)
$plugin->hook('footer', 'frontend/show.php');

// Add a sidebar
$plugin->hook('sidebar','createSideMenu', array($plugin->id(), $plugin->i18n('PLUGIN_SIDEBAR')));

// Point admin panel content to admin/index.php script
$plugin->admin('backend/index.php');

// Initialize
$plugin->init();
