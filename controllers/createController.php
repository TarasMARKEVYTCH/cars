<?php
require './config/config.php';
require 'inputControl.php';
require 'Cars.php';
$con = new Database;
$pdo = $con->connexion();
if (isset($_POST["voitureSubmit"])) {
    if (isset($_POST["voitureName"], $_POST["voitureModel"], $_POST["voitureMoteur"], $_POST["voitureYear"], $_POST["voitureDesc"], $_POST["voitureCategorie"], $_POST["gearBox"], $_POST["doors"], $_POST["seats"], $_POST["luggage"], $_FILES['voitureImg']) && !empty($_POST["voitureName"]) && !empty($_POST["voitureModel"]) && !empty($_POST["voitureMoteur"]) && !empty($_POST["voitureYear"]) && !empty($_POST["voitureDesc"]) && !empty($_POST["voitureCategorie"]) && !empty($_POST["gearBox"]) && !empty($_POST["doors"]) && !empty($_POST["luggage"]) && !empty($_POST["seats"]) && !empty($_POST["voitureCategorie"]) && !empty($_FILES['voitureImg']['name'])) {
        // secure variables with function
        $voitureName = test_input($_POST['voitureName']);
        $nameLength = mb_strlen($voitureName);
        $voitureModel = test_input($_POST["voitureModel"]);
        $voitureModelLength = mb_strlen($voitureModel);
        $voitureMoteur = test_input($_POST["voitureMoteur"]);
        $voitureMoteurLength = mb_strlen($voitureMoteur);
        $voitureYear = test_input($_POST["voitureYear"]);
        $voitureDesc = test_input($_POST["voitureDesc"]);
        $voitureCat = test_input($_POST['voitureCategorie']);
        $gearBox = test_input($_POST['gearBox']);
        $seats = test_input($_POST['seats']);
        $doors = test_input($_POST['doors']);
        $luggage = test_input($_POST['luggage']);

        $car = new Cars($voitureName, $voitureModel, $voitureMoteur, $voitureYear, $voitureDesc, $voitureCat, $gearBox, $seats, $doors, $luggage);
        // max autorized size image
        //     $maxSize = 2097152;
        //     // transform categorie word into number
        //     switch ($voitureCat) {
        //         case 'berline':
        //             $voitureCat = 1;
        //             break;
        //         case 'suv':
        //             $voitureCat = 5;
        //             break;
        //         case 'citadine':
        //             $voitureCat = 2;
        //             break;
        //         case 'coupe':
        //             $voitureCat = 3;
        //             break;
        //         case '4x4':
        //             $voitureCat = 4;
        //             break;
        //         case 'electrique':
        //             $voitureCat = 6;
        //             break;

        //         default:
        //             $voitureCat = 0;
        //             break;
        //     }
        //     // upload image controlling
        //     // autorised extension array
        //     $extensionValid = array('jpg', 'jpeg', 'png');
        //     // check image name length
        //     if ($nameLength < 30 && $voitureModelLength < 30 && $voitureMoteurLength < 30) {
        //         // check image size
        //         if ($_FILES['voitureImg']['size'] <= $maxSize) {
        //             // get extension of upload image
        //             $extensionUpload = strtolower(substr(strrchr($_FILES['voitureImg']['name'], '.'), 1));
        //             // check autorised image extension
        //             if (in_array($extensionUpload, $extensionValid)) {
        //                 // create upload image rout
        //                 $path = "./media/pictures/" . $voitureName . $voitureModel . "." . $extensionUpload;
        //                 // move upload image into server
        //                 $result = move_uploaded_file($_FILES['voitureImg']['tmp_name'], $path);
        //                 if ($result) {

        //                     //insert all inf into DB
        //                     $insertCars = $pdo->prepare('INSERT INTO cars (name, model, engine, year, categorie_car, img, gearbox, doors, seats, luggage, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        //                     $insertCars->execute(array($voitureName, $voitureModel, $voitureMoteur, $voitureYear, $voitureCat, $voitureName . $voitureModel . '.' . $extensionUpload, $gearBox, $doors, $seats, $luggage, $voitureDesc));
        //                     $err = 'Voiture ajouté';
        //                     header('Location: ./allCars.php');
        //                 }
        //             }
        //         } else {
        //             $err = 'La taille de photo ne peut pas depasser 2Mo';
        //         }
        //     } else {
        //         $err = 'Le nom, modele et type de moteur ne peuvent pas depasser 30 caracteres';
        //     }
        // } else {
        //     $err = 'Tous les champs doivent etre remplis!';
    }
}
