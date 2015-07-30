<?php

// Prevent this class from being included if another plugin
// has already loaded it
if (class_exists('GSPlugin')) return;

// This is a wrapper class for creating GetSimple plugins.
// It is designed to allow you to easily drop it into your project
// to give a wrapper for the GetSimple plugin registration methods
// You should not modify this script directly. It is part of the
// proposed GetSimple Plugin SDK, and thus should be imported as-is.
// If however you wish to add new functions, you can simpl extend
// the class with your own, and instantiate that class instead of
// GSPlugin.
// Documentation for this class is available at @TODO
class GSPlugin {
  // == CONSTANTS ==
  const SDK_VERSION = 0.1;

  // == PROPERTIES ==
  protected $hooks = array();
  protected $hookScripts = array();
  protected $filters = array();
  protected $info = array();
  protected $actions = array('admin' => array());
  protected $_adminPanel;

  // == PUBLIC METHODS ==
  public function __construct($info) {
    $this->info = $info;
    $this->info['path'] = GSPLUGINPATH . '/' . $this->id() . '/'; 
    $this->i18nMerge();
  }

  // Plugin ID
  public function id() { return $this->info['id']; }

  // Plugin Version
  public function version() { return $this->info['version']; }

  // Plugin Author
  public function author() { return $this->info['author']; }

  // Author Website
  public function website() { return $this->info['website']; }

  // Plugin Tab
  // Return the plugin tab or register a new tab
  public function tab() {
    $args = func_get_args();

    if (count($args) == 0) {
      return $this->info['tab'];
    } else {
      $tab = array();

      if (!is_array($args[0])) {
        $tab['name'] = $args[0];
      } else {
        $tab = $args[0];
      }

      if (isset($args[1])) {
        $tab['plugin'] = $args[0];
      }

      if (isset($args[2])) {
        $tab['label'] = $args[2];
      }

      $tab = array_merge(array(
        'plugin' => $this->id(),
        'flag' => null,
      ), $tab);

      $this->hook('nav-tab', 'createNavTab', array(
        $tab['name'],
        $tab['plugin'],
        $tab['label'],
        $tab['flag'])
      );
    }
  }

  // Add a sidebar
  // Overloaded function
  // If an associative array is given, those keys are used to create the menu
  // Otherwise we parse the argument list to get a correctly formatted array
  public function sidebar() {
    $args = func_get_args();
    $sidebar = $args[0];

    if (!is_array($sidebar)) {
      $sidebar = array('label' => $sidebar);
    }

    if (isset($args[1]) && is_string($args[1])) {
      $sidebar['action'] = $args[1];
    }

    $sidebar = array_merge(array(
      'tab' => $this->tab(),
      'action' => null,
      'flag' => true,
      'id' => $this->id(),
    ), $sidebar);

    $this->hook($sidebar['tab'] . '-sidebar', 'createSideMenu', array(
      $sidebar['id'],
      $sidebar['label'],
      $sidebar['action'],
      $sidebar['flag'])
    );
  }

  // Register a hook
  // If the $fn is a PHP script, run the script
  public function hook($name, $fn, $args = array()) {
    if (strpos($name, '-') === false) {
      $name = $this->tab() . '-' . $name;
    }

    if ($this->isPHPScript($fn)) {
      $scriptId = count($this->hookScripts);
      $this->hookScripts[] = $fn;
      $fn = array($this, 'hookScript_' . $scriptId);
    }

    $this->hooks[] = array($name, $fn, $args);
  }

  // Register a filter
  public function filter($name, $fn) {
    $this->filter[] = array($name, $fn);
  }

  // Initialize the plugin
  public function init() {
    $this->register();
    $this->processHooks();
    $this->processFilters();
  }

  // i18n hashes, namespaced by the plugin id
  public function i18n($hash) {
    return i18n_r($this->id() . '/' . $hash);
  }

  // Plugin path
  public function path() {
    return $this->info['path'];
  }

  // Registers admin panel actions
  // If $args[0] is a PHP script, run that script
  // If $args[0] is a function, run the function
  // If $args[0] is a URL route and $args[1] a PHP script/function, run the
  // script/function
  public function admin() {
    // Check the arguments
    $args = func_get_args();

    if (count($args) == 1) {
      if ($this->isPHPScript($args[0])) {
        $this->_adminPanel = array('script' => $args[0]);
      } else {
        $this->_adminPanel = $args[0];
      }
    } elseif (count($args) == 2) {
      // @TODO
    }
    // Implemented by extended classes
  }

  // == MAGIC METHODS ==
  // Implements the hook PHP scripts
  public function __call($name, $args) {
    $explode = explode('_', $name);
    if ($explode[0] == 'hookScript') {
      $this->runScript($this->hookScripts[$explode[1]]);
    }
  }

  // == PROTECTED METHODS ==
  protected function i18nMerge() {
    i18n_merge($this->id()) || i18n_merge($this->id(), 'en_US');
  }

  protected function register() {
    call_user_func_array('register_plugin', array(
      'id'          => $this->id(),
      'title'       => $this->i18n('PLUGIN_TITLE'),
      'version'     => $this->version(),
      'author'      => $this->author(),
      'website'     => $this->website(),
      'description' => $this->i18n('PLUGIN_DESCRIPTION'),
      'tab'         => $this->tab(),
      'admin'       => array($this, '_admin'),
    ));
  }

  protected function processHooks() {
    foreach ($this->hooks as $hook) {
      list ($name, $fn, $args) = $hook;
      add_action($name, $fn, $args);
    }
  }

  protected function processFilters() {
    foreach ($this->filters as $filter) {
      list ($name, $fn) = $filter;
      add_filter($name, $fn);
    }
  }

  protected function isPHPScript($script) {
    if (is_string($script)) {
      $explode = explode('.', $script);
      $ext = end($explode);
      $ext = strtolower($ext);
      return $ext == 'php';
    } else {
      return false;
    }
  }

  // Runs admin scripts
  public function _admin() {
    if (isset($this->_adminPanel['script'])) {
      $this->runScript($this->_adminPanel['script']);
    }
  }

  private function runScript($script, $import = array()) {
    if (!isset($import['plugin'])) {
      $import['plugin'] = $this;
    }
    extract($import);
    include($this->path() . $script);
  }
}
