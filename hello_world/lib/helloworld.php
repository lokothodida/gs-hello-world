<?php

// Hello World Plugin Class
// Plugin function methods can be added here
class HelloWorld extends GSPlugin {
  // Showing the message (in the theme footer)
  public function show() {
    echo '<p>' . $this->i18n('HELLO_WORLD_MSG') . '</p>';
  }

  // Administration panel
  public function admin() {
    echo '<p>' . $this->i18n('HELLO_WORLD_MSG') . '</p>';
  }
}
