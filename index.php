<?php
// My main PHPmotors controller

// Create or access a Session
session_start();
//require_once does: attempt to bring the requested code into scope, fails the application throwas exception and quits, 
// and if it succeeds PHP will ignore ant future requests for the same code. 

// Get the database connection file
require_once 'library/connections.php';
// Get the Accounts model for use as needed
require_once 'model/main-model.php';
// Get the accounts model
require_once 'model/accounts-model.php';
// Get the Validation/other Model
require_once 'library/functions.php';


//get the array of classifications
$classifications = getClassifications();

// Now build a nav bar using the $classifications array. 
$navList = navigationBar($classifications);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 // Check if the firstname cookie exists, get its value.
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 }
 
 switch ($action){
    case 'template':
      include 'view/template.php';
      break;

    default:
      include 'view/home.php';
      break;
    }

?>



   
 