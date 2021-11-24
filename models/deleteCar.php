<?php
require '../config/config.php';
// delete one car
function deleteCar()
{
    $con = new Database;
    $bdd = $con->connexion();
    $id = (int)$_GET['id'];
    $deleteCars = $bdd->prepare('DELETE FROM cars WHERE id = ?');
    $deleteCars->execute(array($id));
    header("location: ../index.php");
}
