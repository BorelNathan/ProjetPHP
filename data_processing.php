<?php
  require 'utils.inc.php';
  start_page('data_processing');
  $objet = 'Vos identifiants et mot de passe temporaire';
  $redirection = 'index.php';
  $action = $_POST['action'];
  $michel = $_POST['mail'];
  session_start();
?>


<?php
  if($action == "S'inscrire"){
    if(strpos($michel,'@') != false ){
    $login = loginGenerator($michel);
    $password = randomPasswordGenerator(35);
    $message =
          '
          <html>
          <head>

          </head>
          <body>
            <h1>Merci pour votre inscription</h1>
            <p>Voici votre login : ' . $login . '</p>
            <p>Mot de passe temporaire : ' . $password . '</p>
            <p>Changé de mot de passe : https://e-eventio.alwaysdata.net/ChangePassword.php</p>



          </body>
          </html>
          ';

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';


        mail($michel, $objet, $message, implode("\r\n", $headers));
        echo '<a> Inscription enregistrer et email envoyé </a> </br>';
        echo '<a href="' . $redirection . '"> Revenir a la page principale </a>';

      $query = "INSERT INTO users (email, login, passwd) VALUES ('$michel' " . ',' . " '$login' " . ',' . " '$password')" ;
      $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
      mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

      if(!($dbResult = mysqli_query($dbLink, $query)))
         {
           echo 'Erreur de requête<br/>';
           echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
           echo 'Requête : ' . $query . '<br/>';
          exit();
        }



      }
      else {
        echo '<a> Email non valide </a> </br>';
        echo '<a href="' . $redirection . '"> Revenir a la page principale </a>';
      }
    }
  else
   {
     header('Location: index.php');
   }




  end_page();
?>
