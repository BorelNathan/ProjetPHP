<?php
  require 'utils.inc.php';
  start_page('ProcessingPasswordChange');
  session_start();
  $objet = 'Voici votre nouveau mot de passe';
  $CurrentEmail = $_POST['CurrentMailForgot'];
  $action = $_POST['ChangePassword'];
  $redirection = 'index.php';


  if($action == "Changer de mot de passe"){
    if(strpos($CurrentEmail,'@') != false ){
    $password = randomPasswordGenerator(35);
    $message =
          '
          <html>
          <head>
          </head>
          <body>
            <h1>Demande de reset de mot de passe</h1>
            <p>Voici votre nouveau mot de passe : ' . $password . '</p>
          </body>
          </html>
          ';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';


        mail($CurrentEmail, $objet, $message, implode("\r\n", $headers));
      $query = "SELECT * FROM users WHERE email =  '" . $CurrentEmail . "'";
      $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
      mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

      if(!($dbResult = mysqli_query($dbLink, $query)))
         {
           echo 'Erreur de requête<br/>';
           echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
           echo 'Requête : ' . $query . '<br/>';
          exit();
        }
      elseif($dbRow = mysqli_fetch_row($dbResult)){
        $CurrentMailBD = $dbRow[1];
        echo $CurrentEmail;
        echo $CurrentMailBD;

        if($CurrentMailBD != $CurrentEmail){
          $_SESSION['ErrorPasswordReset'] = 'Email inexistant ou mal écris </br>';
          header('Location: PasswordReset.php');
        }
        else {
          $query2 = "UPDATE users SET passwd = '" . $password . "' where email = '" . $CurrentEmail . "'";
          mysqli_query($dbLink, $query2);
          header('Location: PasswordReset.php');
        }
      }
      else {
        echo '<a> Email non valide </a> </br>';
        echo '<a href="' . $redirection . '"> Revenir a la page principale </a>';
      }
    }
  else
   {
     $_SESSION['ErrorPasswordReset'] = 'Email inexistant ou mal écris </br>';
     header('Location: PasswordReset.php');
   }
}
end_page();

?>
