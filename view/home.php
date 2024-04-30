<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | PHP Motors</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
</head>
<body>
    <div class="container">
        <div class="content2">
            <div class="hero">
            <header>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>   
            </header>
            </div>
            <nav>
                <?php echo $navList; ?>
            </nav>
        <main>
            <h1>Welcome to PHP Motors</h1>
            <div class="main-top-box">
                <section class="main-top-text">
                    <h2>DMC Delorean</h2>
                    <p>3 cup holders</p>
                    <p>Fuzzy dice!</p>
                    <p>Superman doors</p>
                </section>
                <section class="main-top-img">
                    <div id="delorean-img">
                        <img src="images/delorean.jpg" alt="">
                    </div>
                    <button id="own-button">Own Today</button>   
                </section>
            </div>
            <div class="main-bottom-box">
                <div class="main-reviews">
                    <h1>DMC Delorean Reviews</h1>
                    <p>"Coolest ride on the road." (4/5)</p>
                    <p>"I'm feeling Marty McFly!" (5/5)</p>
                    <p>"The most futuristic ride of our day. " (4/5)</p>
                    <p>"80's livin and I love it!" (5/5)</p>
                    <p>"So fast it's almost like traveling in time." (4/5)</p>
                </div> 
                <div class="main-upgrades">
                    <h1>Delorean Upgrades</h1>
                    <div class="upgrades-text-img">
                        <figure>
                            <div>
                                <img src="images/upgrades/flux-cap.png" alt="Flux Cap Image">
                            </div>
                            <figcaption><a href="#">Flux Capacitor</a></figcaption>
                        </figure>
                        <figure>
                            <div>
                                <img src="images/upgrades/flame.jpg" alt="Flame Decals">
                            </div>
                            <figcaption><a href="#">Flame Decals</a></figcaption>
                        </figure>
                        <figure>
                            <div>
                                <img src="images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
                            </div>
                            <figcaption><a href="#">Bumper Stickers</a></figcaption>
                        </figure>
                        <figure>
                            <div>
                                <img src="images/upgrades/hub-cap.jpg" alt="Hub Caps Image">
                            </div>
                            <figcaption><a href="#">Flux Capacitor</a></figcaption>
                        </figure>
                    </div>
                </div>
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