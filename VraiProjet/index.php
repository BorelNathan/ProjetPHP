<?php
require('Utils/utils.inc.php');
require('Controller/Controller.php');
session_start();
$UtilisateurCourantNom = $_SESSION['CurrentUserName'];
$UtilisateurCourantIDRole = $_SESSION['CurrentUserIDRole'];
$checkIDrole = recheckRoleID($UtilisateurCourantNom);
$action = $_POST['action'];
$email = $_POST['mail'];
$loginnewpassword = $_POST['loginchangepassword'];
$newpassword1 = $_POST['nouveaumotdepasse1'];
$newpassword2 = $_POST['nouveaumotdepasse2'];
$currentpassword = $_POST['currentpassword'];
$errornewpassword = $_SESSION['errornewpassword'];
$login = $_POST['login'];
$password = $_POST['motdepasse'];
$InfoBack = $_SESSION['userPage'];
try{
  if(isset($action)){
    if($action == "S'inscrire"){
      if(!empty($email)){
        if(strpos($email,'@') != false){
          $login = loginGenerator($email);
          $password = randomPasswordGenerator(35);
          addUser($email,$login,$password);
          require('View/Inscription/ViewSuccess.php');
        }
        else{
          require('View/Inscription/ViewFail.php');
        }
      }
      else{
        throw new Exception('Erreur : Email non renseigné');
      }
    }
    if($action == "ChangePassword"){
      if(!empty($loginnewpassword) && !empty($newpassword1) && !empty($newpassword2) && !empty($currentpassword)){
        ChangePassword($loginnewpassword,$newpassword1,$newpassword2,$currentpassword);
      }
      require('View/ChangePassword/ViewChangePassword.php');
    }
    if($action == "Se connecter"){
      if(!empty($login) && !empty($password)){
        Connexion($login, $password);
      }
      else{
        $_SESSION['error'] = 'Erreur : Il y a des champs non renseigné';
      }
      require('View/Login/ViewLogin.php');
    }
    if($action == 'Changer de login'){
      ChangeLogin();
    }
    if($action == 'Changer de mail'){
      $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
      mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
      $query = "SELECT * FROM users WHERE login =  '" . $CurrentLoginUserPage . "' AND passwd =  '" . $CurrentPasswordUserPage . "'";
      if(!($dbResult = mysqli_query($dbLink, $query)))
         {
           echo 'Erreur de requête<br/>';
           echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
           echo 'Requête : ' . $query . '<br/>';
          exit();
        }
      elseif($dbRow = mysqli_fetch_row($dbResult))
        {
          $CurrentUserID = $dbRow[0];
          $_SESSION['UserIDPage'] = $CurrentUserID;
          $query2 = "UPDATE users SET email = '" . $NewMailUserPage . "' where id_user = '" . $CurrentUserID . "'";
          mysqli_query($dbLink, $query2);
          $_SESSION['userPage'] = 'Mail modifié en : ' . $NewMailUserPage;
          header('Location: userPage.php');
        }
      else
        {
          $_SESSION['userPage'] = 'Mauvais identifiant ou mot de passe';
          header('Location: userPage.php');
        }
    }
    if($action == 'Changer de mot de passe'){
      $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
      mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
      $query = "SELECT * FROM users WHERE login =  '" . $CurrentLoginUserPage . "' AND passwd =  '" . $CurrentPasswordUserPage . "'";
      if(!($dbResult = mysqli_query($dbLink, $query)))
         {
           echo 'Erreur de requête<br/>';
           echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
           echo 'Requête : ' . $query . '<br/>';
          exit();
        }
      elseif($dbRow = mysqli_fetch_row($dbResult))
        {
          $CurrentUserID = $dbRow[0];
          $_SESSION['UserIDPage'] = $CurrentUserID;
          $query2 = "UPDATE users SET passwd = '" . $NewPasswordUserPage . "' where id_user = '" . $CurrentUserID . "'";
          mysqli_query($dbLink, $query2);
          $_SESSION['userPage'] = 'MDP modifié en : ' . $NewPasswordUserPage;
          header('Location: userPage.php');
        }
      else
        {
          $_SESSION['userPage'] = 'Mauvais identifiant ou mot de passe';
          header('Location: userPage.php');
        }
    }
  }
  else{
    if($checkIDrole != $UtilisateurCourantIDRole){
      $UtilisateurCourantIDRole = $checkIDrole;
      $_SESSION['CurrentUserIDRole'] = $checkIDrole;
    }
    require('View/Accueil/ViewAccueil.php');
  }

}
catch(Exception $e){
  echo $e.getMessage();
}
 ?>
