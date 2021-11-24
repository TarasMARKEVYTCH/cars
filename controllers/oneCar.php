<?php
require './models/oneCarModel.php';
if (isset($_GET['id'])) {
    //call one car select method
    $car = oneCar();
}
