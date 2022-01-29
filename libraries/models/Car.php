<?php

namespace Models;
// require_once('libraries/autolload.php');
require_once('config/config.php');
require_once('libraries/utils.php');
require_once('libraries/models/Model.php');

class Car extends Model
{
    protected $table = 'cars';


    public function getAll($start, $nbrPerPage)
    {
        $cars = $this->pdo->query("SELECT * from $this->table order by car_id DESC limit $start, $nbrPerPage");
        $cars = $cars->fetchAll();
        if (count($cars) == 0) {
            redirect('allCars.php');
        }
        return $cars;
    }
    // get one car from DB
    public function oneCar()
    {
        $carArt = $this->pdo->prepare('SELECT * from `cars` c LEFT JOIN cars_categories cc ON cc.categorie_id = c.categorie_car LEFT JOIN users u on c.reserved_id = u.id WHERE c.car_id = ?');
        $carArt->execute(array($_GET['id']));
        $car = $carArt->fetch();
        return $car;
    }
    // booked one car
    public function bookCar($id)
    {
        $newValue = 0;
        $session = $_SESSION['id'];
        $updateCar = $this->pdo->prepare('UPDATE `cars` SET `access` = ?, `reserved_id` = ?, `book_count` = book_count+1 where car_id = ?');
        $updateCar->execute(array($newValue, $session, $id));
    }
    public function insertCar($name, $model, $engine, $year, $categorie, $extensionUpload, $gearBox, $doors, $seats, $luggage, $description)
    {
        $insertCars = $this->pdo->prepare('INSERT INTO `cars` (name, model, engine, year, categorie_car, car_img, gearbox, doors, seats, luggage, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $insertCars->execute(array($name, $model, $engine, $year, $categorie, $name . $model . '.' . $extensionUpload, $gearBox, $doors, $seats, $luggage, $description));
    }
    // get last available  9 cars from DB
    public function topCars()
    {
        $topCars = $this->pdo->query('SELECT * from cars where access = 1 order by year DESC limit 9');
        return $topCars;
    }
    public function updateCar($name, $model, $engine, $year, $gearBox, $doors, $seats, $luggage, $description, $disp, $idCar)
    {
        $updateInfo = $this->pdo->prepare("UPDATE {$this->table} SET name = ?, model = ?, engine = ?, year = ?, reserved_id = null, gearbox = ?, doors = ?, seats = ?, luggage = ?, description = ?, access = ? where car_id = ?");
        $updateInfo->execute(array($name, $model, $engine, $year, $gearBox, $doors, $seats, $luggage, $description, $disp, $idCar));
    }
    public function updateImg($name, $extensionUpload)
    {
        $updatePhoto = $this->pdo->prepare("UPDATE {$this->table} SET car_img = ? where car_id = ?");
        $updatePhoto->execute(array($name . '.' . $extensionUpload, $_GET['id']));
    }
    // get all car from one categorie
    public function categorieCars()
    {
        $carCat = $this->pdo->prepare("SELECT * from {$this->table} where categorie_car = ?");
        $carCat->execute(array($_GET['categorie']));
        $carCat = $carCat->fetchAll();
        return $carCat;
    }
    // get all categories in DB
    public function allCategories()
    {
        $categories = $this->pdo->query('SELECT * FROM cars_categories');
        $categories = $categories->fetchAll();
        return $categories;
    }
    public function searchCar($search)
    {
        $result = $this->pdo->query('SELECT * from cars where name LIKE "%' . $search . '%" or model LIKE "%' . $search . '%"');
        $result = $result->fetchAll();
        return $result;
    }
    public function getStatistic(){
        $req = $this->pdo->query('SELECT * FROM `cars` c LEFT JOIN `users` u ON c.reserved_id = u.id');
        return $req;
    }
}
