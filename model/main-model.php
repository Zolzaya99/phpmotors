<?php

function getClassifications() {
    //Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // Sql statement to be used with the database. 
    $sql = 'SELECT classificationName, classificationId FROM carclassification ORDER BY classificationName ASC'; 
    // Creates the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // Runs the prepared statement. 
    $stmt->execute();
    //Gets the data from the database and stores it as an arrray in the $classifications variable
    $classifications = $stmt->fetchAll();
    //Closes the interaction with the database
    $stmt->closeCursor();
    // Sends the array of data back to where the function was called. 
    return $classifications;
}