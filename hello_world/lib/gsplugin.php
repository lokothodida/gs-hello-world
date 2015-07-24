<?php

// 
if (class_exists('GSPlugin')) return;

// Wrapper class for GetSimple plugins
class GSPlugin {
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

  public function id() { return $this->info['id']; }

  public function version() { return $this->info['version']; }

  public function author() { return $this->info['author']; }

  public function website() { return $this->info['website']; }

  public function tab() { return $this->info['tab']; }

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

  public function filter($name, $fn) {
    $this->filter[] = array($name, $fn);
  }

  public function init() {
    $this->register();
    $this->processHooks();
    $this->processFilters();
  }

  public function i18n($hash) {
    return i18n_r($this->id() . '/' . $hash);
  }

  public function path() {
    return $this->info['path'];
  }

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
      
    }
    // Implemented by extended classes
  }

  // == MAGIC METHODS ==
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
      runScript($this->_adminPanel['script']);
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
