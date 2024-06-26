<?php

/* Accounts Model */

// Site Registration handling

function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    // create a connection object using phpmotors connection function
    $db = phpmotorsConnect();
    // here is the SQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
        VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // next 4 lines replace the placeholders in the SQL
    // statement with the actual values in the variable
    // and tells the database the type of data it is
    $stmt->bindvalue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindvalue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindvalue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindvalue(':clientPassword', $clientPassword, PDO::PARAM_STR);

    // insert the data
    $stmt->execute();

    // ask how many roes changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // close the database
    $stmt->closeCursor();

    // return the indication of success 
    return $rowsChanged;
}

/// Check for an existing email address
function checkExistingEmail($clientEmail) {
    $db =  phpmotorsConnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();

    if(empty($matchEmail)){
        return 0;
        // echo 'Nothing found';
        // exit;
        } else {
        return 1;
        // echo 'Match found';
        // exit;
        }
    }

    
// Get client data based on an email address
function getClient($clientEmail){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
   }

// Get client data based on client ID
function updateClientbyId($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
    }


//Update account info
function updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId){
    $db = phpmotorsConnect();
    $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
    } 
    
    //Update password
function updatePassword($clientPassword, $clientId){
    $db = phpmotorsConnect();
    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
    }   
    ?>


