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
    <title>Delete Reivew | PHP Motors</title>
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
            <h1>Confirm Delete</h1>
            <p class="parastyling">
                Deletion cannot be undone. Do you stll want to delete this this review?
            </p>
            <?php
            if (isset($message)) {
                echo $message;
            } ?>
             <form action="/phpmotors/reviews/index.php" method="POST" <?php if (!$_SESSION['loggedin']){echo "hidden";} ?>>
              <fieldset>
              <label for="screenName">Screen Name</label>
                <br>
                <input name="screenName" id="screenName" type="text" value="<?php echo substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname']; ?>" readonly>
                <br>
                <label>Reviewed Date</label>
                <br>
                <input name="reviewDate" id="reviewDate" type="text" <?php echo 'value="'.$review['reviewDate'].'"'; ?> readonly>
                <br>
                <label>Review</label>
                <br>
                <textarea id="review" name="reviewText" rows="4" cols="50" readonly><?php echo $review['reviewText'];  ?></textarea>
                <br>
                <br>
                <input type="submit" name="submit" id="regbtn" value="Delete Review">
                <input type="hidden" name="invId" value="<?php echo $invId; ?>">
                <input type="hidden" name="clientId" value="<?php echo $clientId; ?>">
                <input type="hidden" name="action" value="deleteReview">
                <input type="hidden" name="reviewId" value="<?php if(isset($review['reviewId'])){echo $review['reviewId'];} elseif(isset($reviewId)){echo $reviewId;}?>">
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