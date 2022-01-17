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

$oldLogin  = $_POST['loginUser'];
$newUserIDrole = $_POST['newRoleID'];
$newlogin = $_POST['newLoginUser'];
$newpassword = $_POST['newPasswordUser'];
$newmail = $_POST['newMailUser'];

$NewMailUserPage = $_POST['NewMailUserPage'];
$NewLoginUserPage = $_POST['NewLoginUserPage'];
$NewPasswordUserPage = $_POST['NewPasswordUserPage'];
$CurrentLoginUserPage = $_SESSION['CurrentUserName'];
$CurrentPasswordUserPage = $_POST['CurrentPasswordUserPage'];

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
      if(!empty($NewLoginUserPage) && !empty($CurrentPasswordUserPage)){
        ChangeLogin($NewLoginUserPage,$CurrentPasswordUserPage,$CurrentLoginUserPage);
      }
      else{
        $_SESSION['userPage'] = 'Erreur : Il y a des champs non renseigné';
      }
      $InfoBack = $_SESSION['userPage'];
      require('View/UserPage/ViewUserPage.php');
    }
    if($action == 'Changer de mail'){
      if(!empty($NewMailUserPage) && !empty($CurrentPasswordUserPage)){
        ChangeEmail($CurrentLoginUserPage,$CurrentPasswordUserPage,$NewMailUserPage);
      }
      else{
        $_SESSION['userPage'] = 'Erreur : Il y a des champs non renseigné';
      }
      $InfoBack = $_SESSION['userPage'];
      require('View/UserPage/ViewUserPage.php');
    }
    if($action == 'Changer de mot de passe'){
      if(!empty($NewPasswordUserPage) && !empty($CurrentPasswordUserPage)){
        ChangePassword2($CurrentLoginUserPage,$CurrentPasswordUserPage,$NewPasswordUserPage);
      }
      else{
        $_SESSION['userPage'] = 'Erreur : Il y a des champs non renseigné';
      }
      $InfoBack = $_SESSION['userPage'];
      require('View/UserPage/ViewUserPage.php');
    }
#    if($action == "ChangementUtilisateur"){
#      if(!empty($oldLogin) && !empty($newUserIDrole) && !empt
#    }
    if($action == "UserPage"){
      require('View/UserPage/ViewUserPage.php');
    }
    if($action == "MDP"){
      require('View/ChangePassword/ViewChangePassword.php');
    }
    if($action == "login"){
      require('View/Login/ViewLogin.php');
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
