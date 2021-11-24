<?php
session_start();
require __DIR__ . '/../config/config.php';
// user check function
function userVerif($name, $pass)
{
    $pdo = new Database;
    $con = $pdo->connexion();
    // check userName in DB
    $verifExist = $con->prepare('SELECT * from users where user_name = ?');
    $verifExist->execute(array($name));
    $nameExist = $verifExist->rowCount();
    if ($nameExist == 1) {
        $user = $verifExist->fetch();
        if (password_verify($pass, $user['user_password'])) {
            // crypt password
            $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['user_name'];
            //create cookies
            setcookie('name', $name, time() + 365 * 24 * 3600, null, null, false, true);
            setcookie('password', $pass, time() + 365 * 24 * 3600, null, null, false, true);
            //create session user info
            header('Location: index.php');
        }
    }
}
