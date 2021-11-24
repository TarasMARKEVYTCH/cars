<?php
require './models/categorieCars.php';
if (isset($_GET['categorie'])) {
    // call method for fetch car of one categorie
    $carCat = categorieCars();
}
