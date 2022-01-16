<?php
class UserManager
{

  private function dbConnect(){
    $db = new PDO('mysql:host=mysql-e-eventio.alwaysdata.net;dbname=e-eventio_sql;charset=utf8','e-eventio_login','php123456$');

    return $db;
  }

  public function insertUser($email,$login,$password){
    $db = $this->dbConnect();
    $verif = $db->query( "INSERT INTO users (email, login, passwd) VALUES ('$email' " . ',' . " '$login' " . ',' . " '$password')");

    return $verif;
  }

  public function selectUserByLoginPassword($login,$password){
    $db = $this->dbConnect();
    $user = $db->query("SELECT * FROM users WHERE login = '". $login . "' AND passwd = '". $password. "'");

    return $user;
  }

  public function updatePassword($login,$password,$currentpassword){
    $db = $this->dbConnect();
    $verif = $db->query( "UPDATE users SET passwd = '". $password ."' WHERE login= '" . $login . "' AND passwd = '" . $currentpassword . "'");

    return $verif;
  }

  public function selectPointBylogin($login){
    $db = $this->dbConnect();
    $point = $db->query("SELECT point FROM users WHERE login = '". $login ."'");

    return $point;
  }
}


?>
