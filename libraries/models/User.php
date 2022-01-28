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
    public function getOne($id){
        $req = $this->pdo->prepare('SELECT * from users WHERE id = ?');
        $req->execute(array($id));
        return $req;
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
    public function emailControl($mail){
        $mailExist = $this->pdo->prepare('SELECT id, user_name FROM users WHERE user_mail = ?');
        $mailExist->execute(array($mail));
        return $mailExist;
    }
    public function getReinitMail($email){
        $mailExist = $this->pdo->prepare('SELECT id FROM recuperation WHERE mail = ?');
        $mailExist->execute(array($email));
        return $mailExist;
    }
    public function updateReinitCode($code, $mail){
        $upadeCode = $this->pdo->prepare('UPDATE recuperation SET code = ? WHERE mail = ?');
        $upadeCode->execute(array($code, $mail));
    }
    public function insertReinitCode($code, $mail){
        $upadeCode = $this->pdo->prepare('INSERT INTO recuperation (code, mail) values (?, ?)');
        $upadeCode->execute(array($code, $mail));
    }
    public function getReinitId($mail, $code){
        $req = $this->pdo->prepare('SELECT id FROM recuperation WHERE mail = ? AND code = ?');
        $req->execute(array($mail, $code));
        return $req;
    }
    public function updateReinitId($mail){
        $req = $this->pdo->prepare('UPDATE recuperation SET confirm = 1 WHERE mail = ?');
        $req->execute(array($mail));
    }
    public function getConfirme($mail){
        $req = $this->pdo->prepare('SELECT confirm FROM recuperation WHERE mail = ?');
        $req->execute(array($mail));
        return $req;
    }
    public function deleteReinitId($mail){
        $req = $this->pdo->prepare('DELETE FROM recuperation WHERE mail = ?');
        $req->execute(array($mail));
    }
    public function upadateUserPassword($pass, $mail){
        $req = $this->pdo->prepare('UPDATE users SET user_password = ? WHERE user_mail = ?');
        $req->execute(array($pass, $mail));
    }
    public function updateUserMail($mail, $id){
        $req = $this->pdo->prepare('UPDATE users SET user_mail = ? WHERE id = ?');
        $req->execute(array($mail, $id));
    }
    public function updateImg($name, $extensionUpload)
    {
        $updatePhoto = $this->pdo->prepare("UPDATE users SET img = ? where id = ?");
        $updatePhoto->execute(array($name . '.' . $extensionUpload, $_SESSION['id']));
    }
    public function getStatistic($userId){
        $req = $this->pdo->prepare('SELECT * FROM `cars` c LEFT JOIN `users` u ON c.reserved_id = u.id WHERE c.reserved_id = ?;');
        $req->execute(array($userId));
        return $req;
    }
}
