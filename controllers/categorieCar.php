<?php
require './controllers/inputControl.php';
require './models/allCategories.php';
require './models/searchModel.php';
if (isset($_SESSION)) {
    $categories = allCategories();
}

// request for search bar

if (isset($_POST['search_field']) && !empty($_POST['search_field'])) {
    
    $results = $result;
}
