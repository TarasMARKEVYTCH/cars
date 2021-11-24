<?php
require './config/config.php';
// get one car from DB
function oneCar()
{
    $pdo = new Database;
    $pdo = $pdo->connexion();
    $carArt = $pdo->prepare('SELECT * from cars c LEFT JOIN cars_categories cc ON cc.categorie_id = c.categorie_car LEFT JOIN users u on c.reserved_id = u.id WHERE c.id = ?');
    $carArt->execute(array($_GET['id']));
    $car = $carArt->fetch();
    return $car;
}
