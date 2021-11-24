<?php
require './config/config.php';
// get all car from one categorie
function categorieCars()
{
    $con = new Database;
    $con = $con->connexion();
    $carCat = $con->prepare('SELECT * from cars where categorie_car = ?');
    $carCat->execute(array($_GET['categorie']));
    $carCat = $carCat->fetchAll();
    return $carCat;
}
