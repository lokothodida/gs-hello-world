<?php

i18n_merge($id) || i18n_merge($id, 'en_US');

$i18n = function ($hash) use ($id) {
  return i18n_r($id . '/' . $hash);
};

$actions = array();

$actions['admin'] = function() use ($i18n) {
  include 'backend/index.php';
};

call_user_func_array('register_plugin', array(
  'pluginid'    => $id,
  'title'       => $i18n('PLUGIN_TITLE'),
  'version'     => '1.0',
  'author'      => 'You',
  'website'     => 'http://yoursite.com',
  'description' => $i18n('PLUGIN_DESCRIPTION'),
  'admintab'    => 'settings',
  'adminpanel'  => $actions['admin']
));

add_action('settings-sidebar', 'createSideMenu', array(
  'pluginid' => $id,
  'label'    => $i18n('PLUGIN_SIDEBAR')
));
