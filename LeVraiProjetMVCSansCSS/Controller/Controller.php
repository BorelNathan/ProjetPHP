<?php
require_once('Model/ModelUser.php');
require_once('Model/ModelEvent.php');
require_once('Model/ModelCampagne.php');
require_once('Model/ModelIdee.php');

function addUser($email,$login,$password){
  $userManager = new UserManager();
  $verif = $userManager->insertUser($email,$login,$password);

  if ($verif === false){
    throw new Exception('Erreur : Impossible d\'ajouter cette utilisateur');
  }
  else{
    $objet = 'Vos identifiants et mot de passe temporaire';
    $message =
          '
          <html>
          <head>
          </head>
          <body>
            <h1>Merci pour votre inscription</h1>
            <p>Voici votre login : ' . $login . '</p>
            <p>Mot de passe temporaire : ' . $password . '</p>
            <p><a href="https://e-eventio.alwaysdata.net/ChangePassword.php">Changer de mot de passe</a> </p>
          </body>
          </html>
          ';
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    mail($email,$objet,$message, implode("\r\n", $headers));
  }
}

function ChangePassword($login,$password1,$password2,$currentpassword){
    if($password1 == $password2){
      $userManager = new UserManager();
      if($user = $userManager->selectUserByLoginPassword($login,$currentpassword)->fetch()){
        $verif = $userManager->updatePassword($login,$password1,$currentpassword);
        if ($verif === false){
          $_SESSION['errornewpassword'] = 'Erreur : impossible de changé le mot de passe';
        }
        else {
          $_SESSION['errornewpassword'] = 'Mot de passe changé';
        }
      }
      else{
        $_SESSION['errornewpassword'] = 'Erreur : Mauvais identifiant ou mot de passe';
      }
    }
    else{
      $_SESSION['errornewpassword'] = 'Erreur : Les mots de passe ne correspondent pas';
    }
}

function Connexion($login,$password){
  $userManager = new UserManager();
  $user = $userManager->selectUserByLoginPassword($login,$password);
  $dbRow = $user->fetch();
  if($dbRow[2] == $login && $dbRow[3] == $password){
    $CurrentUserName = $dbRow[2];
    $CurrentUserIDRole = $dbRow[5];
    $CurrentUserID = $dbRow[0];
    $_SESSION['CurrentUserName'] = $CurrentUserName;
    $_SESSION['CurrentUserIDRole'] = $CurrentUserIDRole;
    $_SESSION['CurrentUserID'] = $CurrentUserID;
    $action = null;
  }
  else{
  $_SESSION['error'] = 'Mauvais identifiant ou mot de passe';
  }
}

function ChangeLogin($newlogin,$password,$login){
  $userManager = new UserManager();
  $user = $userManager->selectUserByLoginPassword($login,$password);
  $dbRow = $user->fetch();
  if($dbRow[2] == $login && $dbRow[3] == $password){
    $CurrentUserID = $dbRow[0];
    $_SESSION['UserIDPage'] = $CurrentUserID;
    $verif = $userManager->updateLogin($newlogin,$CurrentUserID);
    if($verif === false){
      throw new Exception('Erreur : Problème lors du changement de login');
    }
    else{
      $_SESSION['userPage'] = 'Login modifié en : ' . $newlogin;
      $_SESSION['CurrentUserName'] = $newlogin;
    }
  }
  else{
    $_SESSION['userPage'] = 'Mauvais identifiant ou mot de passe';
  }
}

function ChangeEmail($login,$password,$email){
  $userManager = new UserManager();
  $user = $userManager->selectUserByLoginPassword($login,$password);
  $dbRow = $user->fetch();
  if($dbRow[2] == $login && $dbRow[3] == $password){
    $CurrentUserID = $dbRow['id_user'];
    $_SESSION['UserIDPage'] = $CurrentUserID;
    $verif = $userManager->updateEmail($email,$CurrentUserID);
    if($verif === false){
      throw new Exception('Erreur : Problème lors du changement de email');
    }
    else{
      $_SESSION['userPage'] = 'Mail modifié en : ' . $email;
    }
  }
  else
  {
    $_SESSION['userPage'] = 'Mauvais identifiant ou mot de passe';
  }
}

function ChangePassword2($login,$password,$newPassword){
  $userManager = new UserManager();
  $user = $userManager->selectUserByLoginPassword($login,$password);
  $dbRow = $user->fetch();
  if($dbRow[2] == $login && $dbRow[3] == $password){
    $CurrentUserID = $dbRow[0];
    $_SESSION['UserIDPage'] = $CurrentUserID;
    $verif = $userManager->updatePassword2($newPassword,$CurrentUserID);
    if($verif === false){
      throw new Exception('Erreur : Problème lors du changement de password');
    }
    else{
      $_SESSION['userPage'] = 'MDP modifié en : ' . $newPassword;
    }
  }
  else
  {
      $_SESSION['userPage'] = 'Mauvais identifiant ou mot de passe';
  }

}

function ChangeLogin2($login,$newlogin){
    $userManager = new UserManager();
    $user = $userManager->selectUserByLogin($login);
    $dbRow = $user->fetch();
    if($dbRow[2] == $login){
      $CurrentUserID = $dbRow[0];
      $verif = $userManager->updateLogin($newlogin,$CurrentUserID);
      if($verif === false){
        throw new Exception('Erreur : Problème lors du changement de login');
      }
      else{
        $_SESSION['UserChange'] .= ' Changement de login effectué.';
      }
    }
    else{
    $_SESSION['UserChange'] = 'User non existant dans la base';
    }
}

function ChangePassword3($login,$newPassword){
  $userManager = new UserManager();
  $user = $userManager->selectUserByLogin($login);
  $dbRow = $user->fetch();
  if($dbRow[2] == $login){
    $CurrentUserID = $dbRow[0];
    $verif = $userManager->updatePassword2($newPassword,$CurrentUserID);
    if($verif === false){
      throw new Exception('Erreur : Problème lors du changement de password');
    }
    else{
      $_SESSION['UserChange'] .= ' Changement de mot de passe effectué.';
    }
  }
  else
  {
    $_SESSION['UserChange'] = 'User non existant dans la base';
  }

}

function ChangeEmail2($login,$email){
  $userManager = new UserManager();
  $user = $userManager->selectUserByLogin($login);
  $dbRow = $user->fetch();
  if($dbRow[2] == $login){
    $CurrentUserID = $dbRow[0];
    $verif = $userManager->updateEmail($email,$CurrentUserID);
    if($verif === false){
      throw new Exception('Erreur : Problème lors du changement de email');
    }
    else{
      $_SESSION['UserChange'] .= ' Changement d\'Email effectué.';
    }
  }
  else
  {
    $_SESSION['UserChange'] = 'User non existant dans la base';
  }
}

function ChangeIdRole($login,$id){
  $userManager = new UserManager();
  $user = $userManager->selectUserByLogin($login);
  $dbRow = $user->fetch();
  if($dbRow[2] == $login){
    $verif = $userManager->updateIdRole($login,$id);
    if($verif === false){
      throw new Exception('Erreur : Problème lors du changement de Role');
    }
    else{
      $_SESSION['UserChange'] .= ' Changement de Role effectué.';
    }
  }
  else
  {
    $_SESSION['UserChange'] = 'User non existant dans la base';
  }
}

function GetEvent($user_id) {
    $EventManager = new EventManager();
    $event = $EventManager->selectEventByUser($user_id);
    $dbRow = $event->fetch();
    if($dbRow[3] == $user_id){
        $CurrentEvent = $dbRow;
        $_SESSION['Event'] = $CurrentEvent;
    }
}

function IsThereAnEvent($user_id) {
  $EventManager = new EventManager();
  $event = $EventManager->selectEventByUser($user_id);
  $dbRow = $event->fetch();
  if($dbRow[3] == $user_id){
        $CurrentEvent = $dbRow[0];
        $_SESSION['EvenementUser'] = $CurrentEvent;
        return true;
    }
    else {
        return false;
    }
}


function CreerEvent($user_id,$title,$description){
  $Title = addslashes($title);
  $Description = addslashes($description);
  $CamapainManager = new CamapainManager();
  $currentCampain = $CamapainManager->IsThereACampain();
  if ($currentCampain  != false){
    $Campagne = $_SESSION['CampagneActuelle'];
    $EventManager = new EventManager();
    $verif = $EventManager->insertEvent($Campagne,$user_id,$Title,$Description);
    if($verif === false){
      $_SESSION['MsgEvent'] = 'Erreur : Il y a un problème !';
    }
    else{
      $_SESSION['MsgEvent'] = 'Ton événement a été créé !';
    }
  }
  else {
      $_SESSION['MsgEvent'] = 'Il n\'y a pas de campagne actuellement et tu ne peux pas créer d\'événement !';
  }
}

function ModifierEvent($EventTitle,$EventDescription){
  $EventTitle = addslashes($EventTitle);
  $EventDescription = addslashes($EventDescription);
  $Case = '';
  if ($EventTitle != ''){
    $Case = $Case . 'T';
  }
  if ($EventDescription != ''){
    $Case = $Case . 'D';
  }
  $EventManager = new EventManager();
  switch ($Case){
      case "T":
          $verif = $EventManager->updateTitle($EventTitle);
          if($verif === false){
            $_SESSION['EventChange'] = 'Erreur : Il y a un problème !';
          }
          else{
            $_SESSION['EventChange'] = 'Vous avez changé le titre de l\'évenemnt';
          }
          break;
      case 'D':
          $verif = $EventManager->updateDescription($EventDescription);
          if($verif === false){
            $_SESSION['EventChange'] = 'Erreur : Il y a un problème !';
          }
          else{
            $_SESSION['EventChange'] = 'Vous avez changé la description de l\'évenemnt';
          }
          break;
      case 'TD':
          $verif = $EventManager->updateTitleDescription($EventTitle,$EventDescription);
          if($verif === false){
            $_SESSION['EventChange'] = 'Erreur : Il y a un problème !';
          }
          else{
            $_SESSION['EventChange'] = 'Vous avez changé le titre et la description de l\'évenemnt';
          }
          break;
      case '':
          $_SESSION['EventChange'] = 'Vous n\'avez rien modifié';
          break;

  }
}

function CreerIdee($point_min,$description){
  $CamapainManager = new CamapainManager();
  $currentCampain = $CamapainManager->IsThereACampain();
  if ($currentCampain  != false){
          $Campagne = $_SESSION['CampagneActuelle'];
          $currentEvent = IsThereAnEvent($_SESSION['CurrentUserID']);
          if ($currentEvent != false){
              $CurrentEvent = $_SESSION['EvenementUser'];
              $IdeaManager = new IdeaManager();
              $verif = $IdeaManager->insertIdea($Campagne,$point_min,$description,$CurrentEvent);
              if($verif === false){
                $_SESSION['MsgIdée'] = 'Erreur : Il y a un problème !';
              }
              else{
              $_SESSION['MsgIdée'] = 'Ton idée a été ajoutée !';
              }
          }
          else {
              $_SESSION['MsgIdée'] = 'Tu n\'as pas encore créé d\'événements ! Tu ne peux pas ajouter d\'idées bonus.';
          }
    }
    else {
        $_SESSION['MsgIdée'] = 'Il n\'y a pas de campagne actuellement !';
    }

}

function ModifierIdee($IdeaId,$IdeaDescription,$NbPoints){
  $_SESSION['IdeaChange'] = '';
  $IdeaManager = new IdeaManager();
      if ($IdeaDescription != '') {
        $verif = $IdeaManager->updateDescriptionIdea($IdeaId,$IdeaDescription);
        if($verif === false){
          $_SESSION['IdeaChange'] = 'Erreur : Il y a un problème !';
        }
        else{
          $_SESSION['IdeeChosen'][4] = $IdeaDescription;
          $Change = true;
        }
      }
      if ($NbPoints != '') {
        $verif = $IdeaManager->updatePointRequisIdea($IdeaId,$NbPoints);
        if($verif === false){
          $_SESSION['IdeaChange'] = 'Erreur : Il y a un problème !';
        }
        else{
          $_SESSION['IdeeChosen'][1] = $NbPoints;
          $Change = true;
        }
      }

      if ($Change != false) {
          $_SESSION['IdeaChange'] = $_SESSION['IdeaChange'] . 'Votre idée a été modifiée !';
      } else {
          $_SESSION['IdeaChange'] = $_SESSION['IdeaChange'] . 'Aucune donnée n\'a été modifiée';
      }


}

function GetIdee($user_id,$IdeaChoice) {
    $EventManager = new EventManager();
    $event = $EventManager->selectEventByUser($user_id);
    $dbRow = $event->fetch();
    if($dbRow[3] == $user_id){
        $CurrentEvent = $dbRow;
        $_SESSION['Event'] = $CurrentEvent;
        $IdeaManager = new IdeaManager();
        $idea = $IdeaManager->selectIdeaByEventIdeaChoice($CurrentEvent[0],$IdeaChoice);
        $dbRow2 = $idea->fetch();
        if($dbRow2[0] == $IdeaChoice){
          $_SESSION['IdeeChosen'] = $dbRow2;
        }

    }
}

function CreateCamp($date_deb,$date_fin){
        $date_deb = date_create_from_format('Y-m-d', $date_deb);
        $date_deb = $date_deb->format('Y-m-d');
        $date_fin = date_create_from_format('Y-m-d', $date_fin);
        $date_fin = $date_fin->format('Y-m-d');
        if ($date_deb > $date_fin){
            $_SESSION['MsgCampagne'] = 'Tu as mal choisi les dates de ta campagne !';
        }
        else{
          $points_attribués = $_POST['CampPointsDonnés'];
          $points_requis = $_POST['CampPointsRequis'];
          $description = $_POST['CampDescription'];
          $can_create = true;
          $user_id = $_SESSION['CurrentUserID'];
          $user_id_role = $_SESSION['CurrentUserIDRole'];
          $TitreCamp = $_POST['CampTitle'];

          $CampagneManager = new CamapainManager();
          $verif = $CampagneManager->CheckCampagne($date_deb, $date_fin);
          if ( $verif === false){
              $_SESSION['MsgCampagne'] = 'Il y a déjà une campagne en cours !';
          }
          else {
              $verif = $CampagneManager->insertCampagne($date_deb, $date_fin, $points_attribués, $points_requis, $description,$TitreCamp);
              if($verif === false){
                $_SESSION['MsgCampagne'] = 'Il y a un problème !';
              }
          }
        }
}

function ModifierCamp(){


  $CampTitle = $_POST['campName'];
  $CampDescription = $_POST['campDescription'];
  $CampMinPoints = $_POST['minPointsCamp'];
  $CampDateDeb = $_POST['dateDebCamp'];
  $CampDateFin = $_POST['dateFinCamp'];
  $CampId = $_SESSION['IdCampagneChoisie'];
  $Change = false;

  $CampTitle = addslashes($CampTitle);
  $CampDescription = addslashes($CampDescription);
  $_SESSION['CampagneChange'] = '';

  $CampagneManager = new CamapainManager();

  if ($CampTitle != ''){
      $verif = $CampagneManager->updateTitreCampagne($CampTitle,$CampId);
      if ($verif === false){

      }
      else{
      $Change = true;
      }
  }
  if ($CampDescription != ''){
      $CampagneManager->updateDescriptionCampagne($CampDescription,$CampId);
      $Change = true;
  }
  if ($CampMinPoints != '') {
      $CampagneManager->updatePointMinCampagne($CampMinPoints,$CampId);
      $Change = true;
  }

  if ($CampDateDeb != false && $CampDateFin != false) {
      if ($CampagneManager->CheckCampagneWithId($CampDateDeb, $CampDateFin, $CampId) == true){
          $CampDateDeb = date_create_from_format('Y-m-d', $_POST['dateDebCamp']);
          $CampDateDeb = $CampDateDeb->format('Y-m-d');
          $CampDateFin = date_create_from_format('Y-m-d', $_POST['dateFinCamp']);
          $CampDateFin = $CampDateFin->format('Y-m-d');
          $CampagneManager->updateDateDebDateFin($CampDateDeb,$CampDateFin,$CampId);
          $Change = true;
      }
      $_SESSION['CampagneChange'] = $_SESSION['CampagneChange'] . 'Il y a déjà une campagne en cours ! <br/>';
  }
  elseif ($CampDateDeb != false) {
      if ($CampagneManager->CheckCampagneWithId($CampDateDeb, $_SESSION['CampagneChoisie'][2], $CampId) != false){
          $CampDateDeb = date_create_from_format('Y-m-d', $_POST['dateDebCamp']);
          $CampDateDeb = $CampDateDeb->format('Y-m-d');
          $CampagneManager->updateDateDeb($CampDateDeb,$CampId);
          $Change = true;
      }
      else{
          $_SESSION['CampagneChange'] = $_SESSION['CampagneChange'] . 'Il y a déjà une campagne en cours ! <br/>';
      }
  }
  elseif ($CampDateFin != false) {
      if ($CampagneManager->CheckCampagneWithId($_SESSION['CampagneChoisie'][1], $CampDateFin, $CampId) != false){
          $CampDateFin = date_create_from_format('Y-m-d', $_POST['dateFinCamp']);
          $CampDateFin = $CampDateFin->format('Y-m-d');
          $CampagneManager->updateDateFin($CampDateFin,$CampId);
          $Change = true;
      }else{
          $_SESSION['CampagneChange'] = $_SESSION['CampagneChange'] . 'Il y a déjà une campagne en cours ! <br/>';
      }
  }
  if ($Change == true){
      $_SESSION['CampagneChange'] = $_SESSION['CampagneChange'] . 'Votre campagne a été modifiée ! ';
      GetCampagneFromId($_SESSION['IdCampagneChoisie']);
  }
  else {
      $_SESSION['CampagneChange'] = $_SESSION['CampagneChange'] . 'Aucune donnée n\'a été modifiée';
  }
}

function VoteJury(){


    $Events = $_SESSION['EventsFromCampagne'];
    $EventUp = $_POST['eventChoice'];
    $EventChosen = GetEventFromId($EventUp);
    $EventManager = new EventManager();
    $verif = $EventManager->updateJuryVote($EventUp);
    if($verif === false){
        $_SESSION['UpVoteJuryChange'] = 'Vous venez de voter !';
    }


}

?>
