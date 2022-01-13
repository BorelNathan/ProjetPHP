<?php
  session_start();
  require 'utils.inc.php';
  start_page('processinguserpage');
  $CurrentLoginUserPage = $_SESSION['CurrentUserName'];
  $CurrentPasswordUserPage = $_POST['CurrentPasswordUserPage'];
  $NewMailUserPage = $_POST['NewMailUserPage'];
  $NewLoginUserPage = $_POST['NewLoginUserPage'];
  $NewPasswordUserPage = $_POST['NewPasswordUserPage'];
  $action = $_POST['Change'];



  if($action == 'Changer de login'){
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
        $query2 = "UPDATE users SET login = '" . $NewLoginUserPage . "' where id_user = '" . $CurrentUserID . "'";
        mysqli_query($dbLink, $query2);
        $_SESSION['userPage'] = 'Login modifié en : ' . $NewLoginUserPage;
        $_SESSION['CurrentUserName'] = $NewLoginUserPage;
        header('Location: userPage.php');
      }
    else
      {
        $_SESSION['userPage'] = 'Mauvais identifiant ou mot de passe';
        header('Location: userPage.php');
      }
    }
  elseif($action == 'Changer de mail'){
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
  elseif($action == 'Changer de mot de passe'){
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


  end_page();
?>
