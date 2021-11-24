<?php
require './controllers/inputControl.php';
require __DIR__ . '/../models/userVerif.php';

// login 

if (isset($_POST['connect'])) {
    if (isset($_POST['nickname'], $_POST['password']) && !empty($_POST['nickname']) && !empty($_POST['password'])) {

        $userName = test_input($_POST['nickname']);
        $userPass = test_input($_POST['password']);
        
        // call login method
        $userExist = userVerif($userName, $userPass);
        if ($userExist) {
        } else {
            $err = 'Email ou mot de passe incorrect';
        }
    } else {
        $err = 'Veuillez remplir tous les champs!!!';
    }
}
