<?php
session_start();
require './config/config.php';
require 'inputControl.php';
header("Access-Control-Allow-Methods: PUT");
$con = new Database;
$pdo = $con->connexion();
if (isset($_GET['id'])) {
// fetch info of updated car in DB
    $id = (int)$_GET['id'];
    $updateCar = $pdo->prepare('SELECT * from cars where id = ?');
    $updateCar->execute(array($_GET['id']));
    $updateCar = $updateCar->fetch();
}
if (isset($_POST['voitureUpdate'])) {
    if (isset($_POST['voitureName'], $_POST['voitureModel'], $_POST['voitureMoteur'], $_POST['voitureYear'], $_POST['voitureDesc'], $_POST['voitureDisp']) && !empty($_POST['voitureName']) && !empty($_POST['voitureModel']) && !empty($_POST['voitureMoteur']) && !empty($_POST['voitureYear']) && !empty($_POST['voitureDesc']) && !empty($_POST['voitureDisp'])) {
        // inputs control 
        $id = $_SESSION['id'];
        $voitureName = test_input($_POST['voitureName']);
        $nameLength = mb_strlen($voitureName);
        $voitureModel = test_input($_POST["voitureModel"]);
        $voitureModelLength = mb_strlen($voitureModel);
        $voitureMoteur = test_input($_POST["voitureMoteur"]);
        $voitureMoteurLength = mb_strlen($voitureMoteur);
        $voitureYear = test_input($_POST["voitureYear"]);
        $voitureDesc = test_input($_POST["voitureDesc"]);
        $voitureDisp = test_input($_POST['voitureDisp']);
        // length control
        if ($nameLength < 30 && $voitureModelLength < 30 && $voitureMoteurLength < 30) {
            // update info into DB
            $updateInfo = $pdo->prepare('UPDATE cars SET name = ?, model = ?, engine = ?, year = ?, description = ?, access = ?, reserved_id = ? where id = ?');
            $updateInfo->execute(array($voitureName, $voitureModel, $voitureMoteur, $voitureYear, $voitureDesc, $voitureDisp, $id, $_GET['id']));
            $msg = 'L\'information modifiée';
        }
    } else {
        $err = 'Remplissez tous les champs';
    }
}
// separated image update
if (isset($_FILES['voitureImg']) && !empty($_FILES['voitureImg']['name'])) {
    $maxSize = 2097152;
    // autorized extensions
    $extensionValid = array('jpg', 'jpeg', 'png');
    // image size checking
    if ($_FILES['voitureImg']['size'] <= $maxSize) {
        // get extension of uploaded image
        $extensionUpload = strtolower(substr(strrchr($_FILES['voitureImg']['name'], '.'), 1));
        // check if upload extension autorised
        if (in_array($extensionUpload, $extensionValid)) {
            // create rout for upload image
            $path = "./media/pictures/" . $voitureName . "." . $extensionUpload;
            // move uploaded image into server
            $result = move_uploaded_file($_FILES['voitureImg']['tmp_name'], $path);
            if ($result) {
                // insert image info into DB
                $updatePhoto = $pdo->prepare('UPDATE cars SET img = ? where id = ?');
                $updatePhoto->execute(array($voitureName . '.' . $extensionUpload, $_GET['id']));
                $err = 'Information modifiée';
            }
        } else {
            $err = 'La taille ne peut pas depasser 2Mo';
        }
    }
}
