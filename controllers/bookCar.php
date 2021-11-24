<?php
// connect BD
require './models/BookCarModel.php';
if (isset($_POST['bookCar'])) {
    // call method for book car
    bookCar();
    $msg = strtoupper($_SESSION['name']) . ' ' . 'votre ' . $car['name'] . ' a était bien réservée!!!';
}
