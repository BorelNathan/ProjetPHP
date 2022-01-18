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
$IdeaId = $_SESSION['IdeeChosen'][0];

$date_deb = $_POST['CampDateDeb'];
$date_fin = $_POST['CampDateFin'];

$MyCampagne = $_SESSION['CampagneChoisie'];


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
      $_SESSION['error'] = "";
      if(!empty($login) && !empty($password)){
        Connexion($login, $password);
      }
      else{
        $_SESSION['error'] = 'Erreur : Il y a des champs non renseigné';
        require('View/Login/ViewLogin.php');
      }
      if($_SESSION['error'] == ""){
        require('View/Accueil/ViewAccueil.php');
      }
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
      $filter = filterUsers(2);
      $_SESSION['IdeaChoice'] = $_POST['ideaSelector'];
      if (IsThereAnEvent($user_id) != false) {
          GetEvent($user_id);
          GetIdee($user_id,$IdeaChoice);
      }
      require('View/OrgaPage/ViewModifIdea.php');
    }
    if($action == "choixcampagne"){
      $_SESSION['CampagneChange'] = '';
      $filter = filterUsers(4);
      GetAllCampagnes();
      GetCampagneFromId($_SESSION['IdCampagneChoisie']);
      $_SESSION['IdCampagneChoisie'] = $_POST['campagneChoice'];
      require('View/AdminPage/ViewModifCampagne.php');
    }
    if($action == "Créer une campagne"){
      CreateCamp($date_deb,$date_fin);
      require('View/AdminPage/ViewCreateCamp.php');
    }
    if($action == "Modifier une Campagne"){
      ModifierCamp();
      $filter = filterUsers(4);
      require('View/AdminPage/ViewModifCampagne.php');
    }
    if($action == "Vote du Jury"){
      $filter = filterUsers(3);
      VoteJury();
      require('View/JuryPage/ViewVoteJury.php');
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
    if($action == "PageCampagne"){
      $filter = filterUsers(4);
      GetAllCampagnes();
      require('View/AdminPage/ViewCampagne.php');
    }
    if($action == "CreateCampPage"){
      require('View/AdminPage/ViewCreateCamp.php');
    }
    if($action == "GestionVote"){
      $filter = filterUsers(3);
      GetEndedCampagnes();
      $EndedCamp = $_SESSION['EndedCampagnes'];
      require('View/JuryPage/ViewChoixCampagne.php');
    }
    if($action == "Choix Jury Campagne"){
    $filter = filterUsers(3);
    $_SESSION['EndedCampChoice'] = $_POST['campagneChoice'];
    require('View/JuryPage/ViewVoteJury.php');
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
