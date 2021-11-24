<?php
// connect BD

require __DIR__ . '/../config/config.php';

$con = new Database;
$pdo = $con->connexion();



// fetch number of pages
$count=$pdo->prepare('select count(id) as cpt from cars');
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

// // pagination
@$page = $_GET['page'];
if(empty($page)) $page =1;
$nbrPerPage = 12;
$nbrPage = ceil($tcount[0]['cpt']/$nbrPerPage);
$start = ($page-1) * $nbrPerPage;

// // fetch all cars
$cars = $pdo->query("SELECT * from cars limit $start, $nbrPerPage");
$cars = $cars->fetchAll();
if (count($cars)==0) {
    header('location: ./allCars.php');
}