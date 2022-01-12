<?php
  session_start();
  require 'utils.inc.php';
  $login  = $_POST['loginUser'];
  $newUserIDrole = $_POST['newRoleID'];
  $newlogin = $_POST['newLoginUser'];
  $newpassword = $_POST['newPasswordUser'];
  $newmail = $_POST['newMailUser'];
  $filter = filterUsers(4);

  if($newlogin != ''){
    $changementlogin = 'newloginUser';
  }
  else{
    $changementlogin = '';
  }

  if($newpassword != ''){
    $changementpassword = 'newpasswordUser';
  }
  else{
    $changementpassword = '';
  }
  if($newmail != ''){
    $changementmail = 'newmailUser';
  }
  else{
    $changementmail = '';
  }


  if($filter == 1){

    start_page('adminprocess');
      $i = $newUserIDrole . $changementlogin . $changementpassword . $changementmail;
      echo $i;
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
              $query2 = "UPDATE users SET id_role = '" . $newUserIDrole . "' where login = '" . $login . "'";
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
              $query2 = "UPDATE users SET id_role = '" . $newUserIDrole . "' where login = '" . $login . "'";
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

        case "newpasswordUser":

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
              $query2 = "UPDATE users SET passwd = '" . $newpassword . "' where login = '" . $login . "'";
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

        case "newloginUsernewpasswordUser":

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
              $query2 = "UPDATE users SET id_role = '" . $newUserIDrole . "' where login = '" . $login . "'";
              $query3 = "UPDATE users SET passwd = '" . $newpassword . "' where login = '" . $login . "'";
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

          case "1newloginUsernewpasswordUser":
          case "2newloginUsernewpasswordUser":
          case "3newloginUsernewpasswordUser":
          case "4newloginUsernewpasswordUser":

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
                $query2 = "UPDATE users SET id_role = '" . $newUserIDrole . "' where login = '" . $login . "'";
                $query3 = "UPDATE users SET login = '" . $newlogin . "' where login = '" . $login . "'";
                $query4 = "UPDATE users SET passwd = '" . $newpassword . "' where login = '" . $login . "'";
                mysqli_query($dbLink, $query2);
                mysqli_query($dbLink, $query4);
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

        case "1newpasswordUser":
        case "2newpasswordUser":
        case "3newpasswordUser":
        case "4newpasswordUser":

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
                $query2 = "UPDATE users SET id_role = '" . $newUserIDrole . "' , passwd = '" . $newpassword . "' where login = '" . $login . "'";
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

        case "newmailUser":

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
              $query2 = "UPDATE users SET email = '" . $newmail . "' where login = '" . $login . "'";
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

        case "1newmailUser":
        case "2newmailUser":
        case "3newmailUser":
        case "4newmailUser":

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
              $query2 = "UPDATE users SET id_role = '" . $newUserIDrole . "' , email = '" . $newmail . "' where login = '" . $login . "'";
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

        case "1newloginUsernewmailUser":
        case "2newloginUsernewmailUser":
        case "3newloginUsernewmailUser":
        case "4newloginUsernewmailUser":

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
              $query2 = "UPDATE users SET id_role = '" . $newUserIDrole . "' , email = '" . $newmail . "' , login = '" . $newlogin . "' where login = '" . $login . "'";
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

        case "newloginUsernewmailUser":

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
              $query2 = "UPDATE users SET email = '" . $newmail . "' , login = '" . $newlogin . "' where login = '" . $login . "'";
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


        default:
          echo '<video src="https://cdn.discordapp.com/attachments/902901555198582797/930813375057920020/mp4-2.mp4" autoplay="true"> type="video/mp4">';

          }

    end_page();

  }
?>
