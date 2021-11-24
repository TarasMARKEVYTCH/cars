<?php
// get car with search bar
if (isset($_POST['search'])) {
    # code...
    $pdo = new Database;
    $pdo = $pdo->connexion();
    $search = test_input($_POST['search_field']);
    $result = $pdo->query('SELECT * from cars where name LIKE "%' . $search . '%" or model LIKE "%' . $search . '%"');
    $result = $result->fetchAll();
}    
