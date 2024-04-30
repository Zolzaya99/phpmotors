<?php

function addClassification($classificationName) {
    //Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();

    // Sql statement to be used with the database. 
    $sql = 'INSERT INTO carclassification (classificationName)
    VALUES (:classificationName);';
    // Creates the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // next 4 lines replace the placeholders in the SQL
    // statement with the actual values in the variable
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);

    // Runs the prepared statement. 
    $stmt->execute();

    // ask how many roes changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // close the database
    $stmt->closeCursor();

    // return the indication of success 
    return $rowsChanged;
}

// Add a new Vehicle function
function addVehicle ($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId) {
    //Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();

    // Sql statement to be used with the database. 
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId) 
    VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId);';
    // Creates the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // next 4 lines replace the placeholders in the SQL
    // statement with the actual values in the variable
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    // Runs the prepared statement. 
    $stmt->execute();

    // ask how many roes changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // close the database
    $stmt->closeCursor();

    // return the indication of success 
    return $rowsChanged;
}

// Get vehicles by classificationId 

// Declares the function and the required parameter which is a classificationId
function getInventoryByClassification($classificationId){ 

    // Calls the database connection
    $db = phpmotorsConnect(); 

    // The Sql statement to query all inventory from the inventory table with a classificationId 
    // that matches the value passed in through the parameter.
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 

    // creates the PDO statement 
    $stmt = $db->prepare($sql);
    
    // Replaces the named placeholder with the actual value as an integer.
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 

    // Runs the prepared statement with the actual value.
    $stmt->execute(); 

    // Requests a multi-dimensional array of the vehicles as an associative array, stores the array in a variable.
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    $stmt->closeCursor(); 
    return $inventory; 
   }

   
   function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    // asterick means 'everything' in SQL. 
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    // bindValue method needs to be treated as an INT. 
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }

   // Update a vehicle function
   function updateVehicle ($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId) {
    //Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();

    // Sql statement to be used with the database. 
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
	invDescription = :invDescription, invImage = :invImage, 
	invThumbnail = :invThumbnail, invPrice = :invPrice, 
	invStock = :invStock, invColor = :invColor, 
	classificationId = :classificationId WHERE invId = :invId';
    // Creates the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // next 4 lines replace the placeholders in the SQL
    // statement with the actual values in the variable
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Runs the prepared statement. 
    $stmt->execute();

    // ask how many roes changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // close the database
    $stmt->closeCursor();

    // return the indication of success 
    return $rowsChanged;
}

// Delete a vehicle 
// Update a vehicle function
function deleteVehicle ($invId) {
    //Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
    }

// THe function will get a list of vehicles based on the classification.
function getVehiclesByClassification($classificationName){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
    }

function getVehicleInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT invMake, invModel, invDescription, invPrice, invStock, invColor, invImage FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

function getVehicles(){
    $db = phpmotorsConnect();
    $sql = 'SELECT invId, invMake, invModel FROM inventory';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}
?>