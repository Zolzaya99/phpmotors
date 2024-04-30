<?php
    if(!isset($_SESSION['loggedin']) && !$_SESSION['loggedin']){
        header('Location:/phpmotors/index.php');
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | PHP Motors</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Bubbler+One&display=swap" rel="stylesheet">
    <link rel="stylesheet"  type="text/css" href="../css/style.css" media="screen">
</head>
<body>
    <div class="container">
        <div class="content1">
            <div class="hero">
                <header>
                    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>   
                </header>
            </div>
            <nav>
                <?php echo $navList; ?>
            </nav>
            <main>
                <div class="admin-main-wrapper">
                    <h1 class="admin-header"><?php echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname']; ?></h1>
                        <?php
                            if (isset($_SESSION['message'])) {
                                echo '<div class="successUpdate">' . $_SESSION['message'] . '</div>';
                            }
                        ?>
                    <p>You are logged in.</p>
                    <ul class="admin-main-ul">
                        <li><?php echo "First Name: ".$_SESSION['clientData']['clientFirstname']; ?></li>
                        <li><?php echo "Last Name: ".$_SESSION['clientData']['clientLastname'] ?></li>
                        <li><?php echo "Email: ".$_SESSION['clientData']['clientEmail']; ?></li>
                    </ul>
                    <h2>Account Management</h2>
                    <p>Use this link to update account information</p>
                    <a class='link' href = "/phpmotors/accounts/index.php/?action=client-update">Update Account Information</a>
                    <?php 
                        if (isset($_SESSION['clientData']) && $_SESSION['clientData']['clientLevel'] > 1) {
                            echo "<h2>Inventory Management</h2>";
                            echo "<p>Use this link to manage the inventory</p>";
                            echo "<a class='link' href='/phpmotors/vehicles/'>Vehicle Management</a><br>";
                        }
                        ?>
                    <h2>Manage your Reviews</h2>
                    <?php echo $reviewDisplay; ?>
                
                </div>
            </main>
            <hr>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
    </div>
</body>
</html>
