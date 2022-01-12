<?php
  session_start();
  require 'utils.inc.php';
  $login  = $_POST['loginUser'];
  $newUserID = $_POST['newRoleID'];
  $newlogin = $_POST['newloginUser'];
  $filter = filterUsers(4);

  if($newlogin != ''){
    $changementlogin = 'newloginUser';
  }
  else{
    $changementlogin = '';
  }



  if($filter == 1){

    start_page('adminprocess');
      $i = $newUserID . $changementlogin;
      echo $i ;
      switch($i){

        case "1":
        case "2":
        case "3":
        case "4":

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
              $_SESSION['UserChange'] = 'Action enregistrer';
              header('Location: gestionUsers.php');
            }
          else
            {
              $_SESSION['UserChange'] = 'User non existant dans la base';
              header('Location: gestionUsers.php');
            }
          break;

        case "newloginUser":
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
              $query2 = "UPDATE users SET login = '" . $newlogin . "' where login = '" . $login . "'";
              mysqli_query($dbLink, $query2);
              $_SESSION['UserChange'] = 'Action enregistrer';
              header('Location: gestionUsers.php');
            }
          else
            {
              $_SESSION['UserChange'] = 'User non existant dans la base';
              header('Location: gestionUsers.php');
            }


          break;

        case "1newloginUser":
        case "2newloginUser":
        case "3newloginUser":
        case "4newloginUser":

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
              $query3 = "UPDATE users SET login = '" . $newlogin . "' where login = '" . $login . "'";
              mysqli_query($dbLink, $query2);
              mysqli_query($dbLink, $query3);
              $_SESSION['UserChange'] = 'Action enregistrer';
              header('Location: gestionUsers.php');
            }
          else
            {
              $_SESSION['UserChange'] = 'User non existant dans la base';
              header('Location: gestionUsers.php');
            }

        break;

        default:
          echo 'chiasse';

          }

    end_page();

  }
?>
