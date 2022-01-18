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

  public function updateLogin($login,$id){
    $db = $this->dbConnect();
    $verif = $db->query("UPDATE users SET login = '" . $login . "' WHERE id_user = '" . $id . "'");

    return $verif;
  }

  public function updateEmail($email,$id){
    $db = $this->dbConnect();
    $verif = $db->query( "UPDATE users SET email = '" . $email . "' WHERE id_user = '" . $id . "'");

    return $verif;
  }

  public function updatePassword2($password,$id){
    $db = $this->dbConnect();
    $verif = $db->query("UPDATE users SET passwd = '" . $password . "' where id_user = '" . $id . "'");

    return $verif;
  }

  public function updateIdRole($login,$id){
    $db = $this->dbConnect();
    $verif = $db->query("UPDATE users SET id_role = '" . $id . "' where login = '" . $login . "'");

    return $verif;
  }

  public function selectUserByLogin($login){
    $db = $this->dbConnect();
    $user = $db->query("SELECT * FROM users WHERE login = '". $login . "'");

    return $user;
  }
}


?>
