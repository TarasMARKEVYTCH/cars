<?php
class Cars{
    private $connexion;
    private $table = 'cars';

// variables
    public $voitureName;
    public $voitureModel;
    public $voitureMoteur;
    public $voitureYear;
    public $voitureDesc;
    public $voitureCat;
    public $gearBox;
    public $seats;
    public $doors;
    public $luggage;

    //methods

    /**
     * constructeur pour connecxion a la BD
     * 
     * @param $db
     */
    public function __construct($name, $model, $motor, $year, $desc, $categorie, $gearBox, $places, $doors, $luggage ){
        $this->voitureName = $name;
        $this->voitureModel = $model;
        $this->voitureMoteur = $motor;
        $this->voitureYear = $year;
        $this->voitureDesc = $desc;
        $this->voitureCat = $categorie;
        $this->gearBox = $gearBox;
        $this->seats= $places;
        $this->doors = $doors;
        $this->luggage = $luggage;
    }
// get allCars

    public function getAllCars(){
        $sql = 'SELECT * from' . $this->table . 'ORDER BY name';
        $query = $this->connexion->prepare($sql);
        $query->execute();
    }

    public function createCar(){
        $sql= 'INSERT INTO' . $this->table . 'SET name=:name, model=:model, engine=:engine, year=:year, categorireCar =:cat, description=:desc, gearbox=:gearbox, doors=:doors, seats=:seats, luggage=:luggage, img=:img';
        $query = $this->connexion->prepare($sql);
    }

    
    

    /**
     * Get the value of voitureName
     */ 
    public function getVoitureName()
    {
        return $this->voitureName;
    }

    /**
     * Set the value of voitureName
     *
     * @return  self
     */ 
    public function setVoitureName($voitureName)
    {
        $this->voitureName = $voitureName;

        return $this;
    }
}