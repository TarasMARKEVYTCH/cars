<?php

namespace Controllers;

use Exception;

// require_once('libraries/autolload.php');
require_once('libraries/utils.php');
require_once('libraries/models/User.php');

class User
{
    protected $modelName = \Models\User::class;
    public $message;

    public function getMsg(){
        return $this->message;
    }
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
                        $_SESSION['mail'] = $user['user_mail'];
                        //create cookies
                        setcookie('name', $userName, time() + 365 * 24 * 3600, null, null, false, true);
                        redirect('user.php');
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
    public function getOneUser(){
        if(isset($_SESSION['id'])){
            $userModel = new \Models\User();
            $user = $userModel->getOne($_SESSION['id']);
            $user = $user->fetch();
            return $user;
        }
    }
    public function reInitPassword()
    {
        if (isset($_POST['reinitPass'])) {
            if (!empty($_POST['email'])) {
                $reinitMail = test_input($_POST['email']);
                if (filter_var($reinitMail, FILTER_VALIDATE_EMAIL)) {
                    $userModel = new \Models\User();
                    $verifMail = $userModel->emailControl($reinitMail);
                    if (!$verifMail) {
                        throw new Exception('L\'adresse mail n\'existe pas. Verifiez votre saizie');
                    } else {
                        $mailCount = $verifMail->rowCount();
                        if ($mailCount == 1) {
                            $name = $verifMail->fetch();
                            $name = $name['user_name'];
                            $_SESSION['reinit_mail'] = $reinitMail;
                            $reinitCode = "";
                            for ($i = 0; $i < 9; $i++) {
                                $reinitCode .= mt_rand(0, 9);
                            }
                            $reinitMailControl = $userModel->getReinitMail($reinitMail);
                            $reinitMailExist = $reinitMailControl->rowCount();
                            if ($reinitMailExist == 1) {
                                $reinitMailUpdate = $userModel->updateReinitCode($reinitCode, $reinitMail);
                            } else {
                                $reinitCodeInsert = $userModel->insertReinitCode($reinitCode, $reinitMail);
                            }
                            $header = "MIME-Version: 1.0\r\n";
                            $header .= 'From:"mark09.com"<support@pmark09.com>' . "\n";
                            $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
                            $header .= 'Content-Transfer-Encoding: 8bit';
                            $message =
                                ' <html>
                                <body>
                                    <div align="center">
                                        <br>
                                        <div > Bonjour ' . $name . ' </div> <br>
                                        Voici votre code de recuperation : <b>' . $reinitCode . '</b>. <br>
                                        <br >
                                    </div>
                                </body>
                            </html>
                            ';
                            mail("markevych09@gmail.com", "Recuperation de  mot de passe", $message, $header);
                            header('Location: confirmCode.php');
                        } else {
                            throw new Exception('Utilisateur n\'existe pas!');
                        }
                    }
                } else {
                    throw new Exception('Adresse mail invalide');
                }
            } else {
                throw new Exception('Veuillez remplir les champs');
            }
        }
    }
    public function confirmCode()
    {
        if (isset($_POST['validCode'])) {
            if (!empty($_POST['controlCode'])) {
                $modelUser = new \Models\User();
                $controlCode = test_input($_POST['controlCode']);
                $reqControlCode = $modelUser->getReinitId($_SESSION['reinit_mail'], $controlCode);
                $reqControlExist = $reqControlCode->rowCount();
                if ($reqControlExist == 1) {
                    $insertConfirme = $modelUser->updateReinitId($_SESSION['reinit_mail']);
                    header('Location: newPassword.php');
                } else {
                    throw new Exception('Code invalide');
                }
            } else {
                throw new Exception('Entrez votre code de confirmation');
            }
        }
    }
    public function updatePassword()
    {
        if (isset($_POST['validPass'])) {
            if (isset($_POST['new_pass1'], $_POST['new_pass2']) && !empty($_POST['new_pass1']) && !empty($_POST['new_pass2'])) {
                $userModel = new \Models\User();
                $verifConfirme = $userModel->getConfirme($_SESSION['reinit_mail']);
                $verifConfirme = $verifConfirme->fetch();
                $verifConfirme = $verifConfirme['confirm'];
                if ($verifConfirme == 1) {
                    $newPass1 = $_POST['new_pass1'];
                    $newPass2 = $_POST['new_pass2'];
                    $newHash = password_hash($newPass1, PASSWORD_DEFAULT);
                    if ($newPass1 == $newPass2 && password_verify($newPass1, $newHash)) {
                        $insertNewPass = $userModel->upadateUserPassword($newHash, $_SESSION['reinit_mail']);
                        $delConfirme = $userModel->deleteReinitId($_SESSION['reinit_mail']);
                        header('Location: login.php');
                    } else {
                        throw new Exception('Vos mots de passe ne correspondent pas');
                    }
                } else {
                    throw new Exception('Veuillez confirmer recuperation de mot de passe');
                }
            } else {
                throw new Exception('Tous les chapms doivent être remplis');
            }
        }
    }
    public function getStatistics()
    {
        if (isset($_SESSION['id'])) {
            $user = new \Models\User();
            $user = $user->getStatistic($_SESSION['id']);
            $user = $user->fetchAll();
            return $user;
        }
    }
    public function updateUser()
    {
        if (isset($_POST['updateUser'])) {
            $userModel = new \Models\User();
            if (isset($_POST['mail'], $_POST['mail2']) && !empty($_POST['mail']) && !empty($_POST['mail2']) 
            || isset($_POST['pass'], $_POST['pass2']) && !empty($_POST['pass']) && !empty($_POST['pass2'])) {
                $userId = $_SESSION['id'];
                if ($_POST['pass'] && $_POST['pass2']) {
                    $newPass = test_input($_POST['pass']);
                    $newPass2 = test_input($_POST['pass2']);
                    if ($newPass === $newPass2) {
                        $hash = password_hash($newPass, PASSWORD_DEFAULT);
                        if (password_verify($newPass, $hash)) {
                            $userModel->upadateUserPassword($hash, $_SESSION['mail']);
                            $this->message = "Modifié";
                            $this->getMsg();
                        }
                    } else {
                        throw new Exception('Les mots de pass ne corespondent pas');
                    }
                }
                if ($_POST['mail'] && $_POST['mail2']) {
                    $newMail = test_input($_POST['mail']);
                    $newMail2 = test_input($_POST['mail2']);
                    if ($newMail === $newMail2 && filter_var($newMail, FILTER_VALIDATE_EMAIL)) {
                        $controlUserMail = $userModel->emailControl($newMail);
                        $controlUserMail = $controlUserMail->rowCount();
                        if ($controlUserMail !== 0) {
                            throw new Exception('L\'adresse mail déjà utilisée!');
                        } else {
                            $userModel->updateUserMail($newMail, $userId);
                            $this->message = "Modifié";
                            $this->getMsg();
                        } 
                        
                    } else {
                        throw new Exception('L\'adresses mail n\'est correspondent pas!');
                    }
                }
            }
            if (isset($_FILES['userImg']) && !empty($_FILES['userImg']['name'])) {
                var_dump($_FILES);
                $userName = test_input($_SESSION['name']);
                $maxSize = 2097152;
                $extensionValid = array('jpg', 'jpeg', 'png');
                if ($_FILES['userImg']['size'] <= $maxSize) {
                    $extensionUpload = strtolower(substr(strrchr($_FILES['userImg']['name'], '.'), 1));
                    if (in_array($extensionUpload, $extensionValid)) {
                        $path = "./assets/media/users/" . $userName . "." . $extensionUpload;
                        $result = move_uploaded_file($_FILES['userImg']['tmp_name'], $path);
                        if ($result) {
                            $userModel->updateImg($userName, $extensionUpload);
                            $this->message = "Modifié";
                            $this->getMsg();
                            // redirect('user.php');
                        }
                    }
                    else {
                        throw new Exception('Le format d\'image n\'est pas autorisé');
                    }
                } else {
                    throw new Exception('La taille d\'image ne peut pas depasser 2 Mo');
                }
            }
        }
    }
}
