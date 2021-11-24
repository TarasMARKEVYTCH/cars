<?php
if (isset($_POST['deconnect'])) {
    // unset cookies
    setcookie('name', "", time() - 3600);
    setcookie('password', "", time() - 3600);
    //destroy session info
    session_destroy();
    header('Location: index.php');
}
