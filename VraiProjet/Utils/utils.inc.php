<?php
  function start_page($title)
  {
    $emoji1 = 'https://cdn.discordapp.com/attachments/779046355674202182/930098089744793600/1f975.png';
    $emoji2 = 'https://cdn.discordapp.com/attachments/779046355674202182/930256647966822483/confounded-face_1f616.png';
    $emoji3 = 'https://cdn.discordapp.com/attachments/779046355674202182/930256648407220284/loudly-crying-face_1f62d.png';
    $emoji4 = 'https://cdn.discordapp.com/attachments/779046355674202182/930256648205901934/face-with-tears-of-joy_1f602.png';
    $choix = rand(0, 3);
    if($choix == 0){
      $favicon = $emoji1;
    }
    elseif($choix == 1){
      $favicon = $emoji2;
    }
    elseif($choix == 2){
      $favicon = $emoji3;
    }
    else{
      $favicon = $emoji4;
    }
?>

  <!DOCTYPE html>
  <html lang="fr">
    <head>
        <link rel="icon" type="image/png" <?php echo 'href="' . $favicon . '"' ; ?> />
        <link rel="stylesheet" href="style.css" />
        <meta charset="utf-8"/>
        <title><?php echo $title; ?></title>
    </head>
    <body>
<?php
}

?>

<?php function end_page(){ ?>
    </body>
  </html>
<?php } ?>

<?php function loginGenerator($string){
  for($i = 0; strlen($string) != $i; $i++){
    if($string[$i] == '@'){
      #echo "@ a l'indice " . $i+1 . '</br>';
      $login = substr($string, 0, $i);
      }
  }
  return $login;
}
?>

<?php function randomPasswordGenerator($length){
  $possiblecaracters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$~-+=!?@#%&';
  $string = '';
  $maximum = strlen($possiblecaracters) - 1;

  for($i = 0; $i < $length; $i++){
    $string .= $possiblecaracters[random_int(0, $maximum)];

  }
  return $string;

}
?>

<?php function filterUsers($AccesLevel){
  session_start();
  $CurrentAccesLevel = $_SESSION['CurrentUserIDRole'];
  if($CurrentAccesLevel == $AccesLevel){
    return 1;
  }
  else{
    echo 'acces denied';
    return 0;
  }

}
?>

<?php function recheckRoleID($login){

    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query = "SELECT * FROM users WHERE login =  '" . $login . "'";
    if(!($dbResult = mysqli_query($dbLink, $query)))
      {
         echo 'Erreur de requête<br/>';
         echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
         echo 'Requête : ' . $query . '<br/>';
        exit();
      }
    elseif ($dbRow = mysqli_fetch_row($dbResult))
      {
        $CurrentUserIDRole = $dbRow[5];
        return $CurrentUserIDRole;
      }

}

?>

<?php function IsThereACampain() {
    $today = date('Y-m-d');
    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_currentcamp = "SELECT * FROM campagne WHERE date_deb <= '" . $today . "' AND date_fin >= '" . $today . "'";
    if (!($dbCamp = mysqli_query($dbLink, $query_currentcamp)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query_currentcamp . '<br/>';

        exit();
    }
    elseif ($dbCampagne = mysqli_fetch_row($dbCamp)){
        $CurrentCampain = $dbCampagne[0];
        $_SESSION['CampagneActuelle'] = $CurrentCampain;
        return true;
    }
    else {
        return false;
    }
}
?>

<?php function IsThereAnEvent() {
    $user_id = $_SESSION['CurrentUserID'];
    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_checkid = "SELECT * FROM event WHERE id_user =  '" . $user_id . "'";
    if (!($dbCamp = mysqli_query($dbLink, $query_checkid)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query_checkid . '<br/>';

        exit();
    }
    elseif ($dbIdee = mysqli_fetch_row($dbCamp)){
        $CurrentEvent = $dbIdee[0];
        $_SESSION['EvenementUser'] = $CurrentEvent;
        return true;
    }
    else {
        return false;
    }
}

function CreateEvent($CurrentEvent, $count){


  for($i = 0; $i <= floor($count/4); $i++){


    echo 	'<div class="eventContainer">';

        for($j = 0; $j != 4; $j++){
          if($i*4+$j < $count){
            echo  '<section>
                        <a href="event.php?index=1">
                        <span>' . $CurrentEvent[$i*4+$j]['4'] . '</span>
                        <img src="../../resources/images/thumbnail/' . $i*4+$j . '.jpg" alt="image" />
                        </a>
                   </section>';

          }
          else{
            break;
          }
        }

    echo '</div>';


  }
}

function GetCampagneName(){
  $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
  mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
  $query = "SELECT * FROM campagne WHERE id_campagne =  27";
  $dbResult = mysqli_query($dbLink, $query);
  $dbRow = mysqli_fetch_row($dbResult);
  $titre = $dbRow['7'];
  return $titre;


}


?>
