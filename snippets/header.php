<a id="logo" href="/phpmotors/index.php"><img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo Image"></a>
<!-- if(isset($cookieFirstname)){
 echo "<span>Welcome $cookieFirstname</span>";
} -->
 <?php     
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_SESSION['clientData'])){
        echo "<div class='myaccount'><a id='logout' href='/phpmotors/accounts/'> " . $_SESSION['clientData']['clientFirstname'] . "</a> | <a href='/phpmotors/accounts/?action=Logout'>Logout</a></div>";
    }
    else{
        echo "<a id='myaccount' href='/phpmotors/accounts/?action=login-page'>My Account</a>";
    }
?>
