<?php

// Load the language files
i18n_merge($id) || i18n_merge($id, 'en_US');

// Create i18n wrapper
$i18n = function ($hash) use ($id) {
  return i18n_r($id . '/' . $hash);
};

// Since this plugin isn't doing anything on the front end, we'll just
// define the admin panel anonymously

// Register the plugin
call_user_func_array('register_plugin', array(
  'pluginid'    => $id,
  'title'       => $i18n('PLUGIN_TITLE'),
  'version'     => '1.0',
  'author'      => 'You',
  'website'     => 'http://yoursite.com',
  'description' => $i18n('PLUGIN_DESCRIPTION'),
  'admintab'    => 'settings',
  'adminpanel'  => function() use ($id, $i18n) {
    // All admin panel logic will be contained in the backend/index.php file
    include 'backend/index.php';
  }
));

// Add the sidebar
add_action('settings-sidebar', 'createSideMenu', array(
  'pluginid' => $id,
  'label'    => $i18n('PLUGIN_SIDEBAR')
));
