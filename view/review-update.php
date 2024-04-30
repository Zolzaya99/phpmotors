<?php
    if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']){
        header('Location: /phpmotors/index.php');
}
$clientId = $_SESSION['clientData']['clientId'];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reivew | PHP Motors</title>
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
            <h1>Edit Review</h1>
            <p>
                Please update your review below
            </p>
            <?php
            if (isset($_SESSION['message']))
                {
                    echo $_SESSION['message'];
                } 
            ?>
            <form action="/phpmotors/reviews/index.php" method="POST" <?php if (!$_SESSION['loggedin']){echo "hidden";} ?>>
            <fieldset>
                <label for="screenName">Screen Name</label>
                <br>
                <input name="screenName" id="screenName" type="text" value="<?php echo substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname']; ?>" readonly>
                <br>
                <br>
                <label>Reviewed on</label>
                <br>
                <input name="date" id="date" type="text" <?php echo 'value="'.$review['reviewDate'].'"'; ?> readonly>
                <br>
                <br>
                <label>Review</label>
                <br>
                <textarea id="reviewText" name="reviewText" rows="4" cols="50" required><?php echo $review['reviewText'];  ?></textarea>
                <br>
                <input type="submit" name="submit" id="regbtn" value="Update Review">
                <input type="hidden" name="invId" <?php echo "value='$review[invId]'"?>>
                <input type="hidden" name="clientId" <?php echo "value='$review[clientId]'"?>>
                <input type="hidden" name="action" value="updateReview">
                <input type="hidden" name="reviewId" <?php echo "value='$review[reviewId]'"?>>
            </fieldset>
            </form> 
            </main>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
            </footer>
        </div>  
    </div>
    </body>
</html>