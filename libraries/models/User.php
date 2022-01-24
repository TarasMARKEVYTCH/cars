<?php
namespace Models;
require_once('config/config.php');
require_once('libraries/models/Model.php');
class User extends Model
{
    protected $table = 'users';
    public function getOneUser($name, $mail)
    {
        $verifUser = $this->pdo->prepare('SELECT * from users where user_name = ? and user_mail = ?');
        $verifUser->execute(array($name, $mail));
        $user = $verifUser->fetch();
        return $user;
    }
    public function insertUser($name, $mail, $hash)
    {
        $insertUser = $this->pdo->prepare('INSERT INTO users (user_name, user_mail, user_password) VALUES (?, ?, ?)');
        $insertUser->execute(array($name, $mail, $hash));
    }
    public function userVerif($name)
    {
        // check userName in DB
        $verifExist = $this->pdo->prepare('SELECT * from users where user_name = ?');
        $verifExist->execute(array($name));
        return $verifExist;
    }
}
