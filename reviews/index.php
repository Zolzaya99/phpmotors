<?php
// This is Reviews Controller

session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model 
require_once '../model/vehicles-model.php';
// Get the custom code model
require_once '../library/functions.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the reivews model
require_once '../model/reviews-model.php';

//get the array if classifications
$classifications = getClassifications();

// this is for building dynamic navigation 
$navList = navigationBar($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'insertReview':
        // this is for filtering and storing the data
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));


        // this is for checking for missing data
        if(empty($reviewText) || empty($invId) || empty($clientId)){
            $_SESSION['message'] = "<p id=class='parastyling'>Please provide information on all the empty fields.</p>";
            header('location: /phpmotors/vehicles/?action=vehicleDetail&invId=' . $invId);
            exit;
        } 

        $reviewResult = insertReview($reviewText, $invId, $clientId);
        
        // this is for to check and report the result
            if($reviewResult === 1){
                $_SESSION['message'] = "Thank you for submitting your review!";
                header('location: /phpmotors/accounts/index.php');
                exit;
            } else  {
                $_SESSION['message'] = "<p class='parastyling'>Sorry, unfortunately the review was not submitted. Please try again.</p>";
                header('location: /phpmotors/accounts/index.php');
                exit;
            }
            break;

    case 'confirmUpdate':
        $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT));

        $review = getReviewById($reviewId);

        include '../view/review-update.php';
        break;

    case 'updateReview':
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        $review = getReviewById($reviewId);

        if (empty($reviewId) || empty($reviewText) || empty($invId) || empty($clientId)) { 
            $_SESSION['message'] = "<p class='parastyling'>Please provide information in all the fields.</p>";
            include '../view/review-update.php';
            exit;
        }
    
        $updateResult = updateReview( $reviewText, $reviewId, $invId, $clientId);
    
        if ($updateResult === 1) {
            $_SESSION['message'] = "<p class='parastyling1'>The review was updated successfully.</p>";
            // this is for redirect to admin.php
            header('location: /phpmotors/accounts/index.php');
            exit;
        } else {
            $_SESSION['message'] = "<p class='parastyling'>Sorry, there was an error. Your review wasn't updated.</p>";
            header('location: /phpmotors/accounts/index.php');
            exit;
        } 
        break;


    case 'confirmDelete':
        // Get user input.
        $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
    
        // Get the review information
        $review = getReviewById($reviewId);
    
        // Pass the review data to the view
        include '../view/review-delete.php';
        break;

    case 'deleteReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $deleteResult = deleteReview($reviewId);

        if ($deleteResult == 1) {
            $_SESSION['message'] = "<p class='parastyling1'>The review was successfully deleted.</p>";
            header('location: /phpmotors/accounts/index.php');
            exit;
        } else{
            $_SESSION['message'] = "<p class='parastyling'>Sorry, your review wasn't deleted. Please try again.</p>";
            include '../view/review-delete.php';
            exit;
        }
        break;
    default:
        if ($_SESSION['loggedin']){
            foreach ($reviewInfo as $review) {
                echo buildReviewInfo($review['reviewDate'], $review['reviewId'], $review['invMake'], $review['invModel']);
            }
            include '../view/admin.php';
            exit;
        }
        header('Location: /index.php/');
        exit;
        break;
}
?>
