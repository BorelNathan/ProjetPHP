<?php
  session_start();
  require 'utils.inc.php';
  $login  = $_POST['loginUser'];
  $newUserID = $_POST['newRoleID'];
  $newlogin = $_POST['newloginUser'];
  $filter = filterUsers(4);


  if($filter == 1){

    start_page('adminprocess');



      $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
      mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

      $query = "SELECT * FROM users WHERE login =  '" . $login  . "'";


      if(!($dbResult = mysqli_query($dbLink, $query)))
         {
           echo 'Erreur de requête<br/>';
           echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
           echo 'Requête : ' . $query . '<br/>';
          exit();
        }
      elseif ($dbRow = mysqli_fetch_row($dbResult))
        {
          $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
          mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
          $query2 = "UPDATE users SET id_role = '" . $newUserID . "' where login = '" . $login . "'";
          mysqli_query($dbLink, $query2);
          $_SESSION['UserChangeRoleID'] = 'Action enregistrer';
          header('Location: gestionUsers.php');
        }
      else
        {
          $_SESSION['UserChangeRoleID'] = 'User non existant dans la base';
          header('Location: gestionUsers.php');
        }














    end_page();

  }
?>
