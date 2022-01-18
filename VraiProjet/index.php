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

date_default_timezone_set('UTC');
$today = date('Y-m-d');

$title = $_POST['EventTitle'];
$description = $_POST['EventDescription'];
$point_min = $_POST['EventMinPoint'];
$user_id = $_SESSION['CurrentUserID'];
$user_id_role = $_SESSION['CurrentUserIDRole'];

$EventTitle = $_POST['eventName'];
$EventDescription = $_POST['eventDescription'];
$Campagne = $_SESSION['CampagneActuelle'];

$descriptionIdee = $_POST['IdéeDescription'];
$descriptionIdee = addslashes($descriptionIdee);
$point_min = $_POST['IdéePointsRequis'];

$IdeaChoice = $_SESSION['IdeaChoice'];
$Event = $_SESSION['Event'];

$IdeaDescription = $_POST['ideaDescription'];
$IdeaDescription = addslashes($IdeaDescription);
$NbPoints = $_POST['ideaPoints'];
$IdeaId = $_SESSION['IdeaChoice'][0];


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
    if($action == "ChangementUtilisateur"){
      $_SESSION['UserChange'] = '';
      if(($newUserIDrole != "") || !empty($newmail) || !empty($newlogin) || !empty($newpassword)){
        if(!empty($newUserIDrole)){
          ChangeIdRole($oldLogin,$newUserIDrole);
        }
        if(!empty($newmail)){
          ChangeEmail2($oldLogin,$newmail);
        }
        if(!empty($newpassword)){
          ChangePassword3($oldLogin,$newpassword);
        }
        if(!empty($newlogin)){
          ChangeLogin2($oldLogin,$newlogin);
        }
      }
      else{
        $_SESSION['UserChange'] = 'Erreur : Il y a des champs non renseigné';
      }
      $filter = filterUsers(4);
      require("View/AdminPage/ViewAdminPage.php");
    }
    if($action == "Créer un événement"){
      $filter = filterUsers(2);
      if(!empty($title) && !empty($description)){
        CreerEvent($user_id,$title,$description);
      }
      else{
        $_SESSION['MsgEvent'] = 'Il y a des champs non renseigné';
      }
      require('View/OrgaPage/ViewOrgaPage.php');
    }
    if($action == "Modifier un Event"){
      $filter = filterUsers(2);
      ModifierEvent($EventTitle,$EventDescription);
      require('View/OrgaPage/ViewOrgaPage.php');
    }
    if($action == "Créer une idée bonus"){
      $filter = filterUsers(2);
      CreerIdee($point_min,$descriptionIdee);
      require('View/OrgaPage/ViewCreateIdea.php');
    }
    if($action == "ModifIdee"){
      $Change = false;
      $filter = filterUsers(2);
      ModifierIdee($IdeaId,$IdeaDescription,$NbPoints);
      require('View/OrgaPage/ViewModifIdea.php');
    }
    if($action == "ChoixIdee"){
      $_SESSION['IdeaChoice'] = $_POST['ideaSelector'];
      require('View/OrgaPage/ViewModifIdea.php');
    }
    if($action == "UserPage"){
      require('View/UserPage/ViewUserPage.php');
    }
    if($action == "MDP"){
      require('View/ChangePassword/ViewChangePassword.php');
    }
    if($action == "login"){
      require('View/Login/ViewLogin.php');
    }
    if($action == "Deconnexion"){
      require("Utils/logout.php");
    }
    if($action == "SignIn"){
      require("View/Inscription/ViewSignIn.php");
    }
    if($action == "Accueil"){
      if($checkIDrole != $UtilisateurCourantIDRole){
        $UtilisateurCourantIDRole = $checkIDrole;
        $_SESSION['CurrentUserIDRole'] = $checkIDrole;
      }
      require('View/Accueil/ViewAccueil.php');
    }
    if($action == "PageGestionUser"){
      $filter = filterUsers(4);
      require("View/AdminPage/ViewAdminPage.php");
    }
    if($action == "PageGestionEvent"){
      $filter = filterUsers(2);
      require('View/OrgaPage/ViewOrgaPage.php');
    }
    if($action == "GestIdee"){
      $filter = filterUsers(2);

      if (IsThereAnEvent($id_user) != false) {
          GetEvent($user_id);
          GetBonusIdeas($_SESSION['Event'][0]);
          $AllIdeas = $_SESSION['AllIdeas'];
      }
      require('View/OrgaPage/ViewIdea.php');
    }
    if($action == "CreateIdea"){
      $filter = filterUsers(2);
      require('View/OrgaPage/ViewCreateIdea.php');
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
