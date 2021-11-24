<?php
// get last available  9 cars from DB
function topCars(){
    $pdo = new Database;
    $pdo = $pdo->connexion();
    $topCars = $pdo->query('SELECT * from cars where access = 1 order by year DESC limit 9');
    return $topCars;
}