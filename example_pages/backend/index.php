<?php

// The admin url will be 
// Choose the page based on the action parameter of the $_GET query
// i.e. in the admin url, which is load.php?id=example_pages&action=PARAMETER
$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($action) {
  default:
    include 'viewpages.php';
    break;
  case 'create':
    include 'create.php';
    break;
  case 'edit':
    include 'edit.php';
    break;
  case 'delete':
    include 'delete.php';
    break;
}