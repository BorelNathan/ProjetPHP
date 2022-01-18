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



<?php function GetCampagne() {
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
    elseif ($dbEvent = mysqli_fetch_row($dbCamp)){
        $CurrentCampain[0] = $dbEvent;
        $_SESSION['CampagneActuelle'] = $CurrentCampain;
    }
    else {

    }

}

?>

<?php function GetAllCampagnes() {
    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_currentcamp = "SELECT * FROM campagne ";
    if (!($dbCamp = mysqli_query($dbLink, $query_currentcamp)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query_currentcamp . '<br/>';

        exit();
    }
    else {
        $i = 0;
        while ($dbEvent = mysqli_fetch_row($dbCamp)) {
            $CurrentCampain[$i] = $dbEvent;
            $i++;
        }

        $_SESSION['AllCampagnes'] = $CurrentCampain;
    }

}

?>

<?php function GetCampagneFromId($CampId) {
    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_camp = "SELECT * FROM campagne WHERE id_campagne = '" . $CampId . "'";
    if (!($dbCamp = mysqli_query($dbLink, $query_camp)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query_camp . '<br/>';

        exit();
    }
    elseif ($dbEvent = mysqli_fetch_row($dbCamp)){
        $ChosenCampain = $dbEvent;
        $_SESSION['CampagneChoisie'] = $ChosenCampain;
    }
    else {

    }

}

?>

<?php function AddCampagne($date_deb, $date_fin, $points_attribués, $points_requis, $description, $title){
    $can_create = true;

    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_checkid = "SELECT * FROM campagne";

    $query_insertcamp = "INSERT INTO campagne (date_deb, date_fin, point_attribué, point_min, description, titre) VALUES
                        ('" . $date_deb . "' , '" .  $date_fin . "' , " .  $points_attribués . "," . $points_requis . ",'" . $description . "','" . $title . "')";

    $can_create = CheckCampagne($date_deb, $date_fin);

    if ($can_create) {
        if(!($dbResult = mysqli_query($dbLink, $query_insertcamp)))
        {
            echo $_SESSION;
            echo 'Erreur de requête<br/>';
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            echo 'Requête : ' . $query_checkid . '<br/>';
            exit();
        }
        else {
            $_SESSION['MsgCampagne'] = 'Ta campagne a été créée !';
            header('Location: CreateCampagne.php');
        }
    }
}
?>

<?php function CheckCampagne($date_deb, $date_fin){
    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_checkid = "SELECT * FROM campagne";

    if(!($dbResult = mysqli_query($dbLink, $query_checkid)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query_checkid . '<br/>';
        exit();
    }
    else
    {
        while ($dbRow = mysqli_fetch_row($dbResult))
        {
            if ($dbRow[1] <= $date_deb && $dbRow[2] >= $date_deb) {
                return false;
                exit();
            }
            elseif ($dbRow[1] <= $date_fin && $dbRow[2] >= $date_fin){
                return false;
                exit();
            }
            elseif ($dbRow[1] >= $date_deb && $dbRow[1] <= $date_fin){
                return false;
                exit();
            }
            elseif ($dbRow[2] >= $date_deb && $dbRow[2] <= $date_fin){
                return false;
                exit();
            }
            elseif ($dbRow[1] == $date_deb && $dbRow[2] == $date_fin){
                return false;
                exit();
            }
        }
    }
    return true;
}
?>

<?php function getBonusIdeas($EventId) {
    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_idea = "SELECT * FROM idee_bonus WHERE id_event = '" . $EventId . "'";
    if (!($dbCamp = mysqli_query($dbLink, $query_idea)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query_idea . '<br/>';

        exit();
    }
    else {
        $i = 0;
        while ($dbIdea = mysqli_fetch_row($dbCamp)) {
            $CurrentEvent[$i] = $dbIdea;
            $i++;
        }

        $_SESSION['AllIdeas'] = $CurrentEvent;
    }
}
?>

<?php function GetEventFromId($EventId) {
    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_event = "SELECT * FROM event WHERE id_event = '" . $EventId . "'";
    if (!($dbEvent = mysqli_query($dbLink, $query_event)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query_event . '<br/>';

        exit();
    }
    elseif ($dbEvent = mysqli_fetch_row($dbEvent)){
        $ChosenCampain = $dbEvent;
        return $ChosenCampain;
    }
    else {

    }

}

function CreateEvent($CurrentEvent, $count){


  for($i = 0; $i <= floor($count/4); $i++){


    echo     '<div class="eventContainer">';

        for($j = 0; $j != 4; $j++){
          if($i*4+$j < $count){
            $titre = $CurrentEvent[$i*4+$j]['4'];
            echo  '<section> <a href="../View/Event/ViewEvent.php?Event=' . $titre . '">
                        <span>' , $CurrentEvent[$i*4+$j]['4'] , '</span>
                        <img src="../../resources/images/thumbnail/' , $i*4+$j , '.jpg" alt="image" />
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

function GetEventCount(){
  $query = "SELECT COUNT(*) FROM event";
  $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
  mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
  $dbResult = mysqli_query($dbLink, $query);
  $dbRow = mysqli_fetch_row($dbResult);
  #echo $dbRow['0'] . '</br>';
  $count = $dbRow['0'];
  return $count;
}

function GetEventNames(){
  $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
  mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
  $query2 = "SELECT * FROM event WHERE id_campagne = 27";
  $dbResult2 = mysqli_query($dbLink, $query2);

  $i = 0;
  while($dbRow2 = mysqli_fetch_row($dbResult2)){
    #echo $dbRow2['4'] . '</br>';
    $CurrentEvent[$i] = $dbRow2;
    $i++;

  }
  return $CurrentEvent;
}

?>
