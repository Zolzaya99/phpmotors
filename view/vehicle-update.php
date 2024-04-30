<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?><?php 
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
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
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
                echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
            elseif(isset($invMake) && isset($invModel)) { 
                echo "Modify$invMake $invModel"; }?></h1>

                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="POST" action="/phpmotors/vehicles/index.php">
                    <fieldset class="register">
                        <label for="invMake" class="top">Make</label>
                        <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
                        <label for="invModel" class="top">Model</label>
                        <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
                        <label for="invDescription" class="top">Description</label>
                        <textarea id="invDescription" name="invDescription" required>
                        <?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                        <label for="invImage" class="top">Image</label>
                        <input type="text" id="invImage" name="invImage" required <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>>
                        <label for="invThumbnail" class="top">Thumbnail</label>
                        <input type="text" id="invThumbnail" name="invThumbnail" required <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>>
                        <label for="invPrice" class="top">Price</label>
                        <input type="number" id="invPrice" name="invPrice" step="0.01" required <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>>
                        <label for="invStock" class="top">Stock</label>
                        <input type="number" id="invStock" name="invStock" required <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>>
                        <label for="invColor" class="top">Color</label>
                        <input type="text" id="invColor" name="invColor" required <?php if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>>
                        <label for="classificationId">Choose Classification</label>
                        <!-- <select name="classificationId" id="classificationId"> -->
                        <?php echo $classificationList;?>
                        <!-- </select> -->
                        <input type="submit" name="submit" id="updateVehicle" value="Update Vehicle">
                        <input type="hidden" name="action" value="update-vehicle">
                        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                        elseif(isset($invId)){ echo $invId; } ?>">
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


