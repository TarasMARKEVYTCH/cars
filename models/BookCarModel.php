<?php
session_start();
// booked one car
function bookCar()
{
    $bdd = new Database;
    $pdo = $bdd->connexion();
    $id = (int)$_POST['bookCar'];
    $newValue = 0;
    $session = $_SESSION['id'];
    $updateCar = $pdo->prepare('UPDATE cars SET access = ?, reserved_id = ?, book_count = book_count+1 where id = ?');
    $updateCar->execute(array($newValue, $session, $id));
    
    
    header('Location: allCars.php');
}
