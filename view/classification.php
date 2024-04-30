<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
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
                <h1 id="classHeading"><?php echo $classificationName; ?> vehicles</h1>
                <?php if(isset($message)){
                    echo $message; }
                ?>
                <?php if(isset($vehicleDisplay)){
                    echo $vehicleDisplay;
                } ?>
            </main>
            <hr>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
    </div>
</body>
</html>
