<?php

// this functioin is for to validate email
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// this functioin is for to validate password
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function navigationBar($classifications) {
    // this is for building dynamic navigation
    $navList = '<ul>'; // creates an unordered list as a string and assigns it to the $navList variable.
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors Home Page'>Home</a></li>"; //.= it adds to a variable.
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>'; // This line closes the unordered list.
    return $navList;
}


// Build the classication select list

// Declares the function and specifies the parameter - an array of classifications
function buildClassificationList($classifications){
    // begins the select statement
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    // creates a default option with no value
    $classificationList .= "<option>Choose a Classification</option>"; 
    //a foreach loop to create a new option for each element within the array
    foreach ($classifications as $classification) { 
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    // ends the select statement
    $classificationList .= '</select>'; 
    // returns the finished select element that has been stored in the variable
    return $classificationList; 
    }

// This function will build a display of vehicles within an unordered list.
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= "<li><a href='/phpmotors/vehicles/index.php?action=vehicleDetail&invId=".urlencode($vehicle['invId'])."'>";
        $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<p>$" . number_format($vehicle['invPrice'], 0, '.', ',') . "</p>";
        $dv .= "</a></li>";
    }
    $dv .= '</ul>';
    return $dv;
    }

function buildVehiclesDetail($info){
    $dv = "<div class='car-detail'>";
    $dv .= "<figure>";
    $dv .= "<img class='vehicleDetailImg' src='$info[invImage]' alt='$info[invMake]-$info[inModel]'>";
    $dv .= '<figcaption><span>Price: $'.number_format($info['invPrice']).'</span></figcaption>';
    $dv .= "</figure>";
    $dv .= "<section class='displayVehicleDetail'>";
    $dv .= "<h2 id='displayVehicleh2'>$info[invMake] $info[inModel] Details</h2>";
    $dv .= "<p class='displayVehiclePara'>$info[invDescription]</p>";
    $dv .= "<p>Color: ".$info['invColor']."</p>";
    $dv .= "<p class='displayVehiclePara'># in Stock: ".$info['invStock']."</p>";
    $dv .= "</section>";
    $dv .= '</div>';
    return $dv;
}

function buildReview($clientFirstName, $clientLastName, $date, $reviewText){
    $textReview = "<p class='reviewPara'>";
    
    // Put in the clients name.
    $textReview .= substr($clientFirstName, 0, 1).$clientLastName;

    // Concatenate the date without adding a line break.
    $timestamp = strtotime($date);
    $textReview .= ", wrote on ".date('m/d/Y', $timestamp);

    // Add a line break before the review text.
    $textReview .= "<br><br>".$reviewText;

    $textReview .= "</p>";
    return $textReview;
}

function buildReviewInfo($reviewDate, $reviewId) {
    $textReview .= '<li>';
    $timestamp = strtotime($reviewDate);
    $textReview .= 'Reviewed on: ' . date('m/d/Y H:i:s', $timestamp);
    $textReview .= ' <a class="reviewEdit" href="/phpmotors/reviews/index.php?action=confirmUpdate&reviewId=' . $reviewId . '">Edit</a>';
    $textReview .= ' | ';
    $textReview .= '<a class="reviewEdit" href="/phpmotors/reviews/index.php?action=confirmDelete&reviewId=' . $reviewId . '">Delete</a>';
    $textReview .= '</li>';
    return $textReview;
}
?>


