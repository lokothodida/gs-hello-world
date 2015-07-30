<?php

include 'functions.php';

$settings = new \ExampleSettings\Data(GSDATAOTHERPATH);
$settings->init();

if (!empty($_POST)) {
  include 'savedata.php';
}

try {
  $data = $settings->get();
  include 'viewsettings.php';
} catch (Exception $error) {
  echo $error->getMessage();
  echo 'error';
}
