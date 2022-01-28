<?php
namespace Controllers;

use Exception;

// require_once('libraries/autolload.php');
require_once('libraries/utils.php');
require_once('libraries/models/Car.php');
require_once('libraries/models/Model.php');
require_once('libraries/controllers/Controller.php');

class Car extends Controller
{
    protected $modelName = \Models\Car::class;

    // fetch number of pages
    public function getAllCars()
    {
        $carModel = new \Models\Car();
        $tcount = paginate();
        // // pagination
        @$page = $_GET['page'];
        $nbrPerPage = 12;
        $nbrPage = ceil($tcount[0]['cpt'] / $nbrPerPage);
        if (empty($page) || $page > $nbrPage) $page = 1;
        $start = ($page - 1) * $nbrPerPage;
        $cars = $carModel->getAll($start, $nbrPerPage, $nbrPage);
        // // fetch all cars
        return array($cars, $nbrPage, $page);
    }
    public function bookCar()
    {
        if (isset($_POST['bookCar'])) {
            // call method for book car
            $updateCar = new \Models\Car();
            $id = $_POST['bookCar'];
            $car = $updateCar->bookCar($id);
            $msg = strtoupper($_SESSION['name']) . ' ' . 'votre ' . $car['name'] . ' a était bien réservée!!!';
            redirect('allCars.php');
            return $msg;
        }
    }
    public function carByCategorie()
    {
        if (isset($_GET['categorie'])) {
            // call method for fetch car of one categorie
            $carModel = new \Models\Car();
            $carCat = $carModel->categorieCars();
            return $carCat;
        }
    }
    public function getAllCategories()
    {
        if (isset($_SESSION)) {
            $carModel = new \Models\Car();
            $categories = $carModel->allCategories();
            return $categories;
        }
    }

    public function insertCar()
    {
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

                // $car = new Cars($voitureName, $voitureModel, $voitureMoteur, $voitureYear, $voitureDesc, $voitureCat, $gearBox, $seats, $doors, $luggage);
                // max autorized size image
                $maxSize = 2097152;
                // transform categorie word into number
                switch ($voitureCat) {
                    case 'berline':
                        $voitureCat = 1;
                        break;
                    case 'suv':
                        $voitureCat = 5;
                        break;
                    case 'citadine':
                        $voitureCat = 2;
                        break;
                    case 'coupe':
                        $voitureCat = 3;
                        break;
                    case '4x4':
                        $voitureCat = 4;
                        break;
                    case 'electrique':
                        $voitureCat = 6;
                        break;

                    default:
                        $voitureCat = 0;
                        break;
                }
                // upload image controlling
                // autorised extension array
                $extensionValid = array('jpg', 'jpeg', 'png');
                // check image name length
                if ($nameLength < 30 && $voitureModelLength < 30 && $voitureMoteurLength < 30) {
                    // check image size
                    if ($_FILES['voitureImg']['size'] <= $maxSize) {
                        // get extension of upload image
                        $extensionUpload = strtolower(substr(strrchr($_FILES['voitureImg']['name'], '.'), 1));
                        // check autorised image extension
                        if (in_array($extensionUpload, $extensionValid)) {
                            // create upload image rout
                            $path = "./assets/media/pictures/" . $voitureName . $voitureModel . "." . $extensionUpload;
                            // move upload image into server
                            $result = move_uploaded_file($_FILES['voitureImg']['tmp_name'], $path);
                            if ($result) {

                                //insert all inf into DB
                                $carModel = new \Models\Car();
                                $carInsert = $carModel->insertCar($voitureName, $voitureModel, $voitureMoteur, $voitureYear, $voitureCat, $extensionUpload, $gearBox, $doors, $seats, $luggage, $voitureDesc);
                                $err = 'Voiture ajouté';
                                // header('Location: ./allCars.php');
                            }
                        }
                    } else {
                        $err = 'La taille de photo ne peut pas depasser 2Mo';
                    }
                } else {
                    $err = 'Le nom, modele et type de moteur ne peuvent pas depasser 30 caracteres';
                }
            } else {
                $err = 'Tous les champs doivent etre remplis!';
            }
        }
    }
    public function getOneCar()
    {
        if (isset($_GET['id'])) {
            //call one car select method
            $carModel = new \Models\Car();
            $car = $carModel->oneCar();
            
            return $car;
        }
    }

    public function topCars()
    {
        $cars = new \Models\Car();
        $topCars = $cars->topCars();
        return $topCars;
    }

    public function updateCar()
    {
        $carControl = new \Models\Car();
        if (isset($_POST['voitureUpdate'])) {
            if (isset($_POST['voitureName'], $_POST['voitureModel'], 
            $_POST['voitureMoteur'], $_POST['voitureYear'], $_POST['gearBox'],
            $_POST['doors'], $_POST['seats'], $_POST['luggage'],
            $_POST['voitureDesc'], $_POST['voitureDisp']) && !empty($_POST['voitureName']) 
            && !empty($_POST['voitureModel']) && !empty($_POST['voitureMoteur']) 
            && !empty($_POST['voitureYear']) && !empty($_POST['gearBox'])
            && !empty($_POST['doors']) && !empty($_POST['seats'])
            && !empty($_POST['luggage']) && !empty($_POST['voitureDesc']) && !empty($_POST['voitureDisp'])) {
                // inputs controll
                $idCar = (int) $_POST['voitureUpdate'];
                $voitureName = test_input($_POST['voitureName']);
                $nameLength = mb_strlen($voitureName);
                $voitureModel = test_input($_POST["voitureModel"]);
                $voitureModelLength = mb_strlen($voitureModel);
                $voitureMoteur = test_input($_POST["voitureMoteur"]);
                $voitureMoteurLength = mb_strlen($voitureMoteur);
                $voitureYear = test_input($_POST["voitureYear"]);
                $gearBox = test_input($_POST['gearBox']);
                $doors = test_input($_POST['doors']);
                $seats = test_input($_POST['seats']);
                $luggage = test_input($_POST['luggage']);
                $voitureDesc = test_input($_POST["voitureDesc"]);
                $voitureDisp = test_input($_POST['voitureDisp']);
                // length control
                if ($nameLength < 30 && $voitureModelLength < 30 && $voitureMoteurLength < 30) {
                    // update info into DB
                    $carControl = $carControl->updateCar($voitureName, $voitureModel, $voitureMoteur, $voitureYear, $gearBox, $doors, $seats, $luggage, $voitureDesc, $voitureDisp, $idCar);
                    // $this->getMessage('L\'information modifiée');
                    // header('refresh:1');
                    // throw new Exception('L\'information modifiée');
                } else {
                    throw new Exception('Les champs nom, modele et moteur ne peuvent pas dépasser 30 caractéres');
                }
            } else {
                throw new Exception('Remplissez tous les champs');
            }
        }
        // separated image update
        if (isset($_FILES['voitureImg']) && !empty($_FILES['voitureImg']['name'])) {
            $voitureName = test_input($_POST['voitureName']);
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
                    $path = "./assets/media/pictures/" . $voitureName . "." . $extensionUpload;
                    // move uploaded image into server
                    $result = move_uploaded_file($_FILES['voitureImg']['tmp_name'], $path);
                    if ($result) {
                        // insert image info into DB
                        $this->model->updateImg($voitureName, $extensionUpload);
                        $msg = 'Information modifiée';
                    }
                } else {
                   throw new Exception('La taille d\'image ne peut pas depasser 2Mo');
                }
            }
        }
    }

    public function search()
    {
        if (isset($_POST['search'])) {
            $search = test_input($_POST['search_field']);
            $carModel = new \Models\Car();
            $result = $carModel->searchCar($search);
            return $result;
        }
    }

    public function delete()
    {
        $carModel = new \Models\Car();
        if (isset($_POST['deleteCar'])) {
            $id = $_POST['deleteCar'];
            $carDelete = $carModel->delete($id);
            $msg = 'Voiture supprimée !';
            redirect('index.php');
        }
    }
}
