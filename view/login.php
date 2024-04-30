<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Account | PHP Motors</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Bubbler+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen">
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
                <h1>PHP Motors Login</h1>
                <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    }
                ?>
                <form method="post" action="/phpmotors/accounts/">
                    <fieldset class="register">
                        <label class="top" for="clientEmail">Email:</label>
                        <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
                        <label class="top" for="password">Password
                            <span>Password must be at least 8 characters and has at least 1 uppercase character, 1 number, and 1 special character.</span>
                        </label>
                        <input type="password" id="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                        <input type="submit" name="login" id="loginbtn" value="Login">
                        <input type="hidden" name="action" value="login">
                    </fieldset>
                    <p>Don't have an account?<a href="/phpmotors/accounts/index.php?action=register-page"> Sign up here</a></p>
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
