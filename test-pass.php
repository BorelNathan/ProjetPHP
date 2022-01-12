<?php
  require 'utils.inc.php';
  start_page('test-pass');
  $login = $_POST['login'];
  $password = $_POST['motdepasse'];
  session_start();
?>

<?php
  $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
  mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
  $query = "SELECT * FROM users WHERE login =  '" . $login . "' AND passwd =  '" . $password . "'";
  if(!($dbResult = mysqli_query($dbLink, $query)))
     {
       echo 'Erreur de requête<br/>';
       echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
       echo 'Requête : ' . $query . '<br/>';
      exit();
    }
  elseif ($dbRow = mysqli_fetch_row($dbResult))
    {
      $CurrentUserName = $dbRow[2];
      $CurrentUserIDRole = $dbRow[5];
      $_SESSION['CurrentUserName'] = $CurrentUserName;
      $_SESSION['CurrentUserIDRole'] = $CurrentUserIDRole;
      header('Location: index.php');
    }
  else
    {
      $_SESSION['error'] = 'Mauvais identifiant ou mot de passe';
      header('Location: login.php');
    }
?>





<?php
  end_page()
?>
