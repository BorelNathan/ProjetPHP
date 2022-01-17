<?php
require_once('Model/ModelUser.php');

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
    header('Location: https://owo.alwaysdata.net/');
  }
  else{
  var_dump($user);
  $_SESSION['error'] ; 'Mauvais identifiant ou mot de passe';
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
}
?>
