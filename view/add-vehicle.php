<?php 
    $classificationList = '<select name="classificationId" id="classificationId">';
    $classifList .= "<option>Choose a Car Classification</option>";
    foreach ($classifications as $classification) {
            $classificationList .= "<option value='{$classification['classificationId']}'";
            if (isset($classificationId) && $classification['classificationId'] === $classificationId) {
                $classificationList .= ' selected ';
            }
            $classificationList .= ">{$classification['classificationName']}</option>";
        }
        $classificationList .= '</select><br><br>';
?><?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle | PHP Motors</title>
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
                <h1>Add Vehicle</h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="POST" action="/phpmotors/vehicles/index.php">
                    <fieldset class="register">
                        <label for="invMake" class="top">Make</label>
                        <input type="text" id="invMake" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";}  ?>required>
                        <label for="invModel" class="top">Model</label>
                        <input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";}  ?>required>
                        <label for="invDescription" class="top">Description</label>
                        <textarea id="invDescription" name="invDescription" required><?php if(isset($invDescription)){echo "$invDescription";}  ?></textarea>
                        <label for="invImage" class="top">Image</label>
                        <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png" required>
                        <label for="invThumbnail" class="top">Thumbnail</label>
                        <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/no-image.png" required>
                        <label for="invPrice" class="top">Price</label>
                        <input type="number" id="invPrice" name="invPrice" step="0.01" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required>
                        <label for="invStock" class="top">Stock</label>
                        <input type="number" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> required>
                        <label for="invColor" class="top">Color</label>
                        <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} ?> required>
                        <label for="classificationId">Choose Classification</label>
                        <!-- <select name="classificationId" id="classificationId"> -->
                        <?php echo $classificationList;?>
                        <!-- </select> -->
                        <input type="submit" name="submit" id="add-vehicle" value="Add Vehicle">
                        <input type="hidden" name="action" value="add-vehicle">
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
