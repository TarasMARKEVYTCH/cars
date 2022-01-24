<?php

namespace Controllers;

use Exception;

// require_once('libraries/autolload.php');
require_once('libraries/utils.php');
require_once('libraries/models/User.php');
// require_once('Exception');
class User
{
    protected $modelName = \Models\User::class;
    // login 
    public function login()
    {
        if (isset($_POST['connect'])) {
            if (isset($_POST['nickname'], $_POST['password']) && !empty($_POST['nickname']) && !empty($_POST['password'])) {
                $userName = test_input($_POST['nickname']);
                $userPass = test_input($_POST['password']);
                // call login method
                $userModel = new \Models\User();
                $userExist = $userModel->userVerif($userName);
                $userExist = $userExist->fetch();
                if ($userExist) {
                    $user = $userExist;
                    if (password_verify($userPass, $user['user_password'])) {
                        // create Session
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['name'] = $user['user_name'];
                        //create cookies
                        setcookie('name', $userName, time() + 365 * 24 * 3600, null, null, false, true);
                        redirect('index.php');
                    } else {
                        throw new Exception('Email ou mot de passe incorrect');
                        
                        // return $err;
                    }
                } else {
                    throw new Exception('Email ou mot de passe incorrect');
                }
            } else {
                throw new Exception('Veuillez remplir tous les champs!!!');
            }
        }
    }

    public function signUp()
    {
        if (isset($_POST['signup'])) {
            if (isset($_POST['name'], $_POST['mail1'], $_POST['mail2'], $_POST['pass1'], $_POST['pass2']) && !empty($_POST['name']) && !empty($_POST['mail1']) && !empty($_POST['mail2']) && !empty($_POST['pass1']) && !empty($_POST['pass2'])) {
                // secure all inputs with function
                $name = test_input($_POST['name']);
                $mail1 = test_input($_POST['mail1']);
                $mail2 = test_input($_POST['mail2']);
                $pass1 = test_input($_POST['pass1']);
                $pass2 = test_input($_POST['pass2']);
                $nameLength = mb_strlen($name);
                // check length
                if ($nameLength <= 30) {
                    if ($mail1 === $mail2) {
                        // check if user exist in DB
                        $userModel = new \Models\User();

                        $verifUser = $userModel->getOneUser($name, $mail1);
                        // $verifUser = $verifUser->rowCount();
                        if (!$verifUser) {
                            // password verifing
                            if ($pass1 === $pass2) {
                                // crypt password
                                $hash = password_hash($pass1, PASSWORD_DEFAULT);
                                if (password_verify($pass1, $hash)) {
                                    // insert user into DB
                                    $userModel->insertUser($name, $mail1, $hash);
                                    throw new Exception('Compte a été crée');
                                    redirect('login.php');
                                }
                            } else {
                                throw new Exception('Mots de passe ne correspondent pas');
                            }
                        } else {
                            throw new Exception('Le nom d\'utilisateur ou adresse email existe déjà');
                        }
                    } else {
                        throw new Exception('Adresses mails ne correspondent pas');
                    }
                } else {
                    throw new Exception('Nom n\'est peut pas depasser 30 caracteres');
                }
            } else {
                throw new Exception('Tous les chaps doivent être remplis');
            }
        }
    }
    public function deconnect()
    {
        if (isset($_POST['deconnect'])) {
            // unset cookies
            setcookie('name', "", time() - 3600);
            setcookie('password', "", time() - 3600);
            //destroy session info
            session_destroy();
            redirect('index.php');
        }
    }
}
