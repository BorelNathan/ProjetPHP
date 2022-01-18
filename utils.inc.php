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
?>

<?php function GetEvent() {
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
        elseif ($dbEvent = mysqli_fetch_row($dbCamp)){
            $CurrentEvent = $dbEvent;
            $_SESSION['Event'] = $CurrentEvent;
        }
        else {

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

    $can_create = CheckCampagne($date_deb, $date_fin, -1);

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

<?php function CheckCampagne($date_deb, $date_fin, $id){
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
        while ($dbRow = mysqli_fetch_row($dbResult)) {
            if ($dbRow[0] != $id){
                if (($dbRow[2] < $date_deb && $dbRow[2] < $date_fin)||($dbRow[1] > $date_deb && $dbRow[1] > $date_fin)) {

                }
                else{
                    return false;
                }
            }
        }
    }
    return true;
}
?>

<?php function GetBonusIdeas($EventId) {
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

?>

<?php function GetIdeeFromId($IdeeId) {
    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_idee = "SELECT * FROM idee_bonus WHERE id_idee = '" . $IdeeId . "'";
    if (!($dbEvent = mysqli_query($dbLink, $query_idee)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query_idee . '<br/>';

        exit();
    }
    elseif ($dbIdee = mysqli_fetch_row($dbEvent)){
        $ChosenIdee = $dbIdee;
        $_SESSION['IdeeChosen'] = $ChosenIdee;
    }
    else {

    }

}

?>

<?php function GetEndedCampagnes(){
    $today = date('Y-m-d');
    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query = "SELECT * FROM campagne WHERE date_fin < '" . $today . "'";
    if (!($dbCamp = mysqli_query($dbLink, $query)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query . '<br/>';

        exit();
    }
    else {
        $i = 0;
        while ($dbEnd = mysqli_fetch_row($dbCamp)) {
            $CurrentEvent[$i] = $dbEnd;
            $i++;
        }

        $_SESSION['EndedCampagnes'] = $CurrentEvent;
    }
}
?>

<?php function GetEventsFromCampagneId($id){
    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query = "SELECT * FROM event WHERE id_campagne = '" . $id . "'";
    if (!($dbCamp = mysqli_query($dbLink, $query)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query . '<br/>';

        exit();
    }
    else{
        $i = 0;
        while ($dbEnd = mysqli_fetch_row($dbCamp)) {
            $EndedCamp[$i] = $dbEnd;
            $i++;
        }
        $_SESSION['EventsFromCampagne'] = $EndedCamp;
    }
}
?>
