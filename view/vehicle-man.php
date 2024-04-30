<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}
if (isset($_SESSION['message'])) {
$message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management Page | PHP Motors</title>
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
                <div class="vehicle-man">
                    <h1>Vehicle Management</h1>
                    <div class="vehicle-man">
                        <p><a href="../vehicles/index.php?action=add-classification-page" title="Add new classification">Add Car Classification</a></p>
                        <p><a href="../vehicles/index.php?action=add-vehicle-page" title="Add new vehicle">Add Vehicle</a></p>
                        <?php
                        if (isset($message)) { 
                        echo $message; 
                        } 
                        if (isset($classificationList)) { 
                        echo '<h2>Vehicles By Classification</h2>'; 
                        echo '<p>Choose a classification to see those vehicles</p>'; 
                        echo $classificationList; 
                        }
                        ?>
                        <noscript>
                        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                        </noscript>
                        <table id="inventoryDisplay"></table>
                        <hr>
                    </div>
                </div>
            </main>
            <hr>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
    </div>
    <script src="../js/inventory.js"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>

