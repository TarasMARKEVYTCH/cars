<?php

namespace Controllers;

abstract class Controller
{
    protected $model;
    protected $modelName;
    public $message;
    public function __construct()
    {
        $this->model = new $this->modelName();
    }
    public function setMessage($message){
        $this->message = $message;
    }
    public function getMessage(){
        return $this->message;
    }
   
}
