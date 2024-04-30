<?php
    if(!isset($_SESSION['loggedin']) && !$_SESSION['loggedin']){
        header('Location:/phpmotors/index.php');
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account | PHP Motors</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Bubbler+One&display=swap" rel="stylesheet">
    <link rel="stylesheet"  type="text/css" href="/phpmotors/css/style.css" media="screen">
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
            <h1>Manage Account</h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="post" action="/phpmotors/accounts/index.php">
                    <fieldset class="register">
                        <legend>Update Account</legend>
                        <label class="top">First name:
                        <input type="text" id="firstname" name="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required></label>
                        <label class="top">Last name:
                        <input type="text" id="lastname" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required></label>
                        <label class="top">Email:
                        <input type="email" id="email" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required></label>
                        <input type="submit" name="submit" class="regbtn" value="Update account">
                        <input type="hidden" name="action" value="updateAccount">
                        <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
                        elseif(isset($clientId)){ echo $clientId; } ?>">
                    </fieldset>
                </form>
                <form method="post" action="/phpmotors/accounts/index.php">
                    <fieldset class="register">
                        <legend>Update Password</legend>
                        <label class="top">Password
                        <br><span>Password must be at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character.</span>
                        <br><span>*note your original password will be changed.</span>
                        <input type="password" id="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required></label>
                        <input type="submit" name="submit" class="regbtn" value="Update password">
                        <input type="hidden" name="action" value="updatePassword">
                        <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
                        elseif(isset($clientId)){ echo $clientId; } ?>">
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
