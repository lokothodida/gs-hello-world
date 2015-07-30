<?php

// Set up languages
i18n_merge($id) || i18n_merge($id, 'en_US');

// Methods
// Create an i18n wrapper method
$i18n = function ($hash) use ($id) {
  return i18n_r($id . '/' .$hash);
};

// Register the plugin
register_plugin(
  $id,
  $i18n('PLUGIN_TITLE'),
  '1.0',
  'You',
  'http://yoursite.com',
  $i18n('PLUGIN_DESC'),
  'theme',
  // Admin Panel
  function() use ($i18n) {
    // Header
    echo '<h3>' . $i18n('PLUGIN_TITLE') . '</h3>';

    // Content
    echo $i18n('HELLO_WORLD_ADMIN');
  }
);

add_action('theme-footer', function() use ($i18n) {
  echo $i18n('HELLO_WORLD_MSG');
}); 
 

add_action('theme-sidebar','createSideMenu', array($id, $i18n('PLUGIN_SIDEBAR')));
