<?php
require_once('libraries/controllers/User.php');
require_once('libraries/controllers/Car.php');
abstract class Application
{
    public static function login()
    {
        $controllerName = "User";
        $task = "login";
        if (!empty($_GET['controller'])) {
            $controllerName = ucfirst($_GET['controller']);
        }
        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }
        $controllerName = "\Controllers\\" . $controllerName;
        $controller = new $controllerName();
        $controller->$task();
    }
    public static function update()
    {
        $controllerName = "Car";
        $task = "updateCar";
        if (!empty($_GET['controller'])) {
            $controllerName = ucfirst($_GET['controller']);
        }
        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }
        $controllerName = "\Controllers\\" . $controllerName;
        $controller = new $controllerName();
        $controller->$task();
    }
    public static function bookCar()
    {
        $controllerName = "Car";
        $task = "bookCar";
        if (!empty($_GET['controller'])) {
            $controllerName = ucfirst($_GET['controller']);
        }
        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }
        $controllerName = "\Controllers\\" . $controllerName;
        $controller = new $controllerName();
        $controller->$task();
    }
    public static function delete()
    {
        $controllerName = "Car";
        $task = "delete";
        if (!empty($_GET['controller'])) {
            $controllerName = ucfirst($_GET['controller']);
        }
        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }
        $controllerName = "\Controllers\\" . $controllerName;
        $controller = new $controllerName();
        $controller->$task();
    }
    public static function insert()
    {
        $controllerName = "Car";
        $task = "insertCar";
        if (!empty($_GET['controller'])) {
            $controllerName = ucfirst($_GET['controller']);
        }
        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }
        $controllerName = "\Controllers\\" . $controllerName;
        $controller = new $controllerName();
        $controller->$task();
    }
    public static function signUp()
    {
        $controllerName = "User";
        $task = "signUp";
        if (!empty($_GET['controller'])) {
            $controllerName = ucfirst($_GET['controller']);
        }
        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }
        $controllerName = "\Controllers\\" . $controllerName;
        $controller = new $controllerName();
        $controller->$task();
    }
    public static function deconnect()
    {
        $controllerName = "User";
        $task = "deconnect";
        if (!empty($_GET['controller'])) {
            $controllerName = ucfirst($_GET['controller']);
        }
        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }
        $controllerName = "\Controllers\\" . $controllerName;
        $controller = new $controllerName();
        $controller->$task();
    }
}
