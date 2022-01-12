<?php
  require 'utils.inc.php';
  start_page('newdata_processing');
  $loginnewpassword = $_POST['loginchangepassword'];
  $newpassword1 = $_POST['nouveaumotdepasse1'];
  $newpassword2 = $_POST['nouveaumotdepasse2'];
  session_start();

  if($newpassword1 == $newpassword2){

    $newpassword = $newpassword1;

    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    $query = "SELECT * FROM users WHERE login =  '" . $loginnewpassword  . "'";

    if(!($dbResult = mysqli_query($dbLink, $query)))
       {
         echo 'Erreur de requête<br/>';
         echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
         echo 'Requête : ' . $query . '<br/>';
        exit();
      }
    elseif ($dbRow = mysqli_fetch_assoc($dbResult))
      {
        mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
        $query2 = "UPDATE users SET passwd = '" . $newpassword . "' where login = '" . $loginnewpassword . "'";
        mysqli_query($dbLink, $query2);
        $_SESSION['errornewpassword'] = 'Mot de passe changé';
        header('Location: ChangePassword.php');


      }
    else
      {
        $_SESSION['errornewpassword'] = 'Mauvais login';
        header('Location: ChangePassword.php');
      }
  }
  else{

    $_SESSION['errornewpassword'] = 'Les mots de passe ne correspondent pas';
    header('Location: ChangePassword.php');

  }













  end_page();

?>
