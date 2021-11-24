<?php
require __DIR__ . '/../config/config.php';
// get all categories in DB
function allCategories()
{
    $pdo = new Database;
    $pdo = $pdo->connexion();
    $categories = $pdo->query('SELECT * FROM cars_categories');
    $categories = $categories->fetchAll();
    return $categories;
}
