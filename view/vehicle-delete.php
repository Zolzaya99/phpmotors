<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    }
?><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Delete $invMake $invModel"; }?> | PHP Motors</title>
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
            <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
                echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
            elseif(isset($invMake) && isset($invModel)) { 
                echo "Delete $invMake $invModel"; }?></h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <p class="parastyling">Confirm Vehicle Deletion. The delete is permanent.</p>
                <form method="post" action="/phpmotors/vehicles/">
                    <fieldset>
                        <label for="invMake">Vehicle Make</label>
                        <input type="text" readonly name="invMake" id="invMake" <?php
                    if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>

                        <label for="invModel">Vehicle Model</label>
                        <input type="text" readonly name="invModel" id="invModel" <?php
                    if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>

                        <label for="invDescription">Vehicle Description</label>
                        <textarea name="invDescription" readonly id="invDescription"><?php
                    if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
                    ?></textarea>

                    <input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

                        <input type="hidden" name="action" value="vehicle-delete">
                        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
                    echo $invInfo['invId'];} ?>">
                    </fieldset>
                    </form>
            </main>
            <hr>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
    </div>
    </div>
</body>
</html>


