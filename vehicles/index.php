<?php

// My Vehicles Controller

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model 
require_once '../model/vehicles-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the custom code model
require_once '../library/functions.php';
// Get the reivews model
require_once '../model/reviews-model.php';


session_start();

//get the array if classifications
$classifications = getClassifications();

// this is for building dynamic navigation 
$navList = navigationBar($classifications);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }


switch ($action) {
    
    case 'add-classification-page':
        include '../view/add-classification.php';
        exit;
        break;
        
    case 'add-vehicle-page':
        include '../view/add-vehicle.php';
        exit;
        break;
        
    case 'add-classification':
        // this is for filtering and storing data
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

        // this is for checking for missing data
        if (empty($classificationName)){
            $message = '<p class="parastyling">Please provide information for all empty form fields.</p>';
            include '../view/add-classification.php';
            exit;
        }
        // this is for sending the data to the model
        $addClassificationOutcome = addClassification($classificationName);

        if ($addClassificationOutcome === 1) {
            header('Location:../vehicles/index.php');
            exit;
        } else {
            $message = '<p class="parastyling">Sorry, classification $classificationName you added failed. Please try again.</p>';
            include '../view/add-classification.php';
            exit;
        }
        break;

    case 'add-vehicle':
        // this is for filtering and storing data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));

        // var_dump($invPrice);

        // this is for checking for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail)
        || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = '<p class="parastyling">Please provide information for all empty form fields. </p>';
            include '../view/add-vehicle.php';
            exit;
        }

        // this is for sending the data to the model
        $addVehicleOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        // check and report the result. 
        if ($addVehicleOutcome === 1){
            $message = '<p class="parastyling1"> Congratulations, you successfully added' . ' ' . $invMake . ' ' . $invModel . '</p>';
            include '../view/add-vehicle.php';
        } else {
            $message = '<p class="parastyling">Sorry, but the new vehicle was not added to the list. Please try again.</p>';
            include '../view/add-vehicle.php';
            exit;
        }
        break;

        /* * ********************************** 
        * Get vehicles by classificationId 
        * Used for starting Update & Delete process 
        * ********************************** */ 
    case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;
    case 'update-vehicle':
        // this is for filtering and storing data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));

        // var_dump($invPrice);

        // this is for checking for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail)
        || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = '<p class="parastyling">Please provide all the information for new item!</p>';
            include '../view/vehicle-update.php';
            exit;
        }

        // this is for sending the data to the model
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

        // check and report the result. 
        if ($updateResult) {
            $message = "<p class='parastyling1'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='parastyling'>Sorry the $invMake $invModel was not updated. Please try again.</p>";
             include '../view/vehicle-update.php';
             exit;
            }
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
    break;

    case 'vehicle-delete':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='parastyling1'>Congratulations the $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='parastyling1'>Error: $invMake $invModel was not
        deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;

    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);
        if(!count($vehicles)){
            $message = "<p class='parastyling'>Sorry, no $classificationName vehicles could be found.</p>";
            } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
            }
            include '../view/classification.php';
    break;
    // displayVehicle
    
    case 'vehicleDetail':
        // Filter the input
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $clientInfo = $_SESSION['clientData'];
        // Get the vehicles informations
        $info = getVehicleInfo($invId);

        // Get the vehicle reviews.
        $reviewInfo = getReviewsByInventory($invId);

        // Build the html for the review list.
        $reviewDisplay= '<div class = "reviews">';
        foreach($reviewInfo as $review){
            $reviewDisplay .= buildReview($review['clientFirstname'], $review['clientLastname'], $review['reviewDate'], $review['reviewText']);
        }
        $reviewDisplay .= "</div>";

        // If empty, return an error message back to the user.
        if (empty($info)){
            $message = "<p class='notice'>There was an error in getting the vehicle's information</p>";
        } else {
            // If not, build the html for the vehicle information
            $vehicleDisplay = buildVehiclesDetail($info);
        }
        include '../view/vehicle-detail.php';
        break;
        default:
            $classificationList = buildClassificationList($classifications);
            include "../view/vehicle-management.php";
            break;
    }
?>