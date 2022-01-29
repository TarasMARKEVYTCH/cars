<?php
require_once('config/config.php');
function redirect(string $url)
{
    header("Refresh: 1;url= $url");
    exit();
}
function paginate()
{
    $pdo = new Database();
    $pdo = $pdo->getPdo();
    $count = $pdo->query("select count(car_id) as cpt from cars");
    $count->setFetchMode(PDO::FETCH_ASSOC);
    // $count->execute();
    $tcount = $count->fetchAll();
    return $tcount;
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
