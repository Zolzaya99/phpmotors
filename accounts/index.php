<?php
// My Accounts controller

//require_once does: attempt to bring the requested code into scope, fails the application throwas exception and quits, 
// and if it succeeds PHP will ignore ant future requests for the same code. 
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the main model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the validation/other Model
require_once '../library/functions.php';
// Get the reivews model
require_once '../model/reviews-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';

//get the array if classifications
$classifications = getClassifications();

// Now build a nav bar using the $classifications array. 
$navList = navigationBar($classifications);

// "||"  means OR 

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action) {
    case 'login-page':
         include '../view/login.php';
     break;
    case 'register-page':
        include '../view/register.php';
    break;


    case 'register':
        // this is for filtering and storing data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));    // FILTER_SANITIZE_FULL_SPECIAL_CHARS replaces any illegal character. 
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // recreate the $clientEmail variable and assign to it what is returned from calling the checkEmail($clientEmail) function. 
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // existing email
        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if($existingEmail){
        $message = '<p class="parastyling">That email address already exists. Do you want to login instead?</p>';
        include '../view/login.php';
        exit;
        }

        // this is for checking for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = '<p class="parastyling" >Please provide information for all empty form fields. </p>';
            include '../view/register.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);


        // this is for sending the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // check and report the result. 
        if ($regOutcome === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
    break;

    case 'login':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // recreate the $clientEmail variable and assign to it what is returned from calling the checkEmail($clientEmail) function. 
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Run basic checks, return if errors
        if (empty($clientEmail) || empty($checkPassword)) {
            $message = '<p class="parastyling">Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit;
        }
        
        $clientData = getClient($clientEmail);
       
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
     
        if(!$hashCheck) {
            $message = '<p class="parastyling">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        $_SESSION['loggedin'] = TRUE;
       
        array_pop($clientData);
      
        $_SESSION['clientData'] = $clientData;
        
        // list of reviews 
        $reviewInfo = getReviewsByClient($_SESSION['clientData']['clientId']);
        $reviewDisplay = '<ul>';
        foreach($reviewInfo as $review){
            $reviewDisplay .= buildReviewInfo($review['reviewDate'], $review['reviewId']);
        }
        $reviewDisplay .= '</ul>';
        // Send them to the admin view
        include '../view/admin.php';
        exit;
        break;
    case 'Logout':
        session_unset();
        session_destroy();
        header('Location: /phpmotors/index.php');
        break;
    
    case 'client-update':
        $clientInfo = $_SESSION['clientData'];
        include '../view/client-update.php';
        break;
    case 'updateAccount':
        // Filtering and storing the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));    // FILTER_SANITIZE_FULL_SPECIAL_CHARS replaces any illegal character. 
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        // recreate the $clientEmail variable and assign to it what is returned from calling the checkEmail($clientEmail) function. 
        $clientEmail = checkEmail($clientEmail);
       
        // this is for checking for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $message = '<p class="parastyling">Please provide information for all empty form fields to update your account.</p>';
            $clientInfo = $_SESSION['clientData'];
            include '../view/client-update.php';
            exit;
        }

        // this is for sending the data to the model
        $updateResult = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);

        // check and report the result. 
        if ($updateResult === 1){
            $clientData = updateClientbyId($clientId);
            array_pop($clientData);
            $_SESSION['clientData'] = $clientData;
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['message'] = "Congratulations $clientFistname, your information has been updated successfully.";
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p class='parastyling'>Sorry $clientFirstname, but your account cannot be updated. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;

    case 'updatePassword';
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        
        $checkPassword = checkPassword($clientPassword);

        if(empty($clientPassword) || empty($clientId)){
            $message = "<p class='parastyling'>Sorry $clientFirstname, make sure you have met the requirements to update your password.</p>";
            include '../view/client-update.php';
            exit;
        }
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // this is for sending the data to the model
        $updateResult = updatePassword($hashedPassword, $clientId);

        if($updateResult === 1){
            $_SESSION['message'] = "<p class='parastyling1'>Your password has been updated successfully.</p>";
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p class='parastyling'>Sorry $clientFirstname, but your account cannot be updated. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;

    default:
    // The list of reviews for the client.
        $reviewInfo = getReviewsByClient($_SESSION['clientData']['clientId']);
        $reviewDisplay = '<ul class="reviewAdmin">';
        foreach($reviewInfo as $review){
            $reviewDisplay .= buildReviewInfo($review['reviewDate'], $review['reviewId']);
        }
        $reviewDisplay .= '</ul>';
        
        include '../view/admin.php';
        break;
}
?>