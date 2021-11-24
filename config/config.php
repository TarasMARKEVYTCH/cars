<?php
class Database{
    private $host = 'localhost';
    private $db_name = 'garage';
    private $username = 'root';
    private $password = 'root';
    public $connexion;

    public function connexion(){
     try {
        $this->connexion = null;
        $this->connexion = new PDO('mysql:host='.$this->host . ';dbname='.$this->db_name, $this->username, $this->password);
        $this->connexion->exec('set names utf8');
     } catch (PDOException $e) {
         echo 'Erreur de connexion :'.$e->getMessage();
     }
     return $this->connexion;
    }
}
