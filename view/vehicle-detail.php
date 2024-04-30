<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$info[invMake] $info[inModel]"; ?> | PHP Motors</title>
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
                <h1 id="nameCarDetail"><?php echo "$vehicle[invMake] $vehicle[inModel]"; ?></h1>
                <?php 
                    if (isset($vehicleDisplay)) {
                        echo $vehicleDisplay; 
                    } 
                ?>
                <h2 class="reviewForm">Customer Review</h2>
                <?php 
                    if (!$_SESSION['loggedin']) {
                        echo '<p>You must <a id="reviewPara" href="../accounts/index.php?action=login-page">login</a> to create a review.</p>';
                    } else {
                        // Display the review submission form
                        echo '<form action="/phpmotors/reviews/index.php" method="post">';
                        echo '<fieldset>';
                        echo '<label for="screenName">Screen Name</label>';
                        echo '<br>';
                        echo '<input name="screenName" id="screenName" type="text" value="' . substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname'] . '" readonly>';
                        echo '<br>';
                        echo '<br>';
                        echo '<label for="rev">Review:</label>';
                        echo '<textarea name="reviewText" id="rev" rows="5" required></textarea>';
                        echo '<input type="submit" name="submit" id="reviewbtn" class="button" value="Submit Review"> <br>';
                        echo '<input type="hidden" name="action" value="insertReview">';
                        echo '<input type="hidden" name="clientId" value="' . $_SESSION['clientData']['clientId'] . '">';
                        echo '<input type="hidden" name="invId" value="' . $invId . '">';
                        echo '</fieldset>';
                        echo '</form>';
                    }
                ?>
                <?php
                if (isset($reviewDisplay)) {
                    echo $reviewDisplay;
                }
                ?>
            </main>
            <hr>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
    </div>
</body>
</html>
