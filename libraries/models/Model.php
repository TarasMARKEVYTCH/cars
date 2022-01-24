<?php
namespace Models;
abstract class Model
{
    protected $table;
    protected $pdo;
    
    public function __construct()
    {
        $this->pdo = \Database::getPdo();
    }

    public function delete($id)
    {
        $deleteItem = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $deleteItem->execute(array($id));
    }
   
   
}
