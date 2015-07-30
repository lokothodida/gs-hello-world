<?php

namespace ExampleSettings;

class Data {
  private $file;

  public function __construct($directory) {
    $this->file = $directory . 'example_settings.json';
  }

  public function get() {
    $data = @file_get_contents($this->file);
    $data && $data = @json_decode($data);
    if ($data) {
      return $data;
    } else {
      throw new Exception('NOTFOUND');
    }
  }

  public function save($data) {
    $contents = json_encode($data);
    $contents && $result = @file_put_contents($this->file, $contents);
    if (!$result) {
      throw new Exception('ERRORSAVE');
    }
  }

  public function init() {
    if (!file_exists($this->file)) {
      $this->save(array(
        'setting1' => 'value1',
      ));
    }
  }
}
