<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Classification| PHP Motors</title>
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
                <h1>Add Car Classification</h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="POST" action="/phpmotors/vehicles/index.php">
                    <fieldset class="register">
                        <legend class="top">Enter Classification below</legend>
                        <label for="classificationName">
                            <span>Classification Name (maximum of 30 characters)</span>
                            <input type="text" name="classificationName" id="classificationName" maxlength="30" <?php if(isset($classificationName)){echo "value='$classificationName'";}  ?> required></label>
                        <input type="submit" name="submit" id="add-classification" value="Add Classification">
                        <input type="hidden" name="action" value="add-classification">
                    </fieldset>
                </form>
            </main>
            <hr>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
    </div>
</body>
</html>
