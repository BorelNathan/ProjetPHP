<?php
    require 'utils.inc.php';
    start_page('test-pass');
    session_start();
    $title = $_POST['EventTitle'];
    $description = $_POST['EventDescription'];
    $point_min = $_POST['EventMinPoint'];
    $user_id = $_SESSION['CurrentUserID'];
    $user_id_role = $_SESSION['CurrentUserIDRole'];
    date_default_timezone_set('UTC');
    $today = date('Y-m-d');


    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_checkid = "SELECT * FROM event WHERE id_user =  '" . $user_id . "'";
    $query_currentcamp = "SELECT * FROM campagne WHERE date_deb <= '" . $today . "' AND date_fin >= '" . $today . "'";

    if(!($dbResult = mysqli_query($dbLink, $query_checkid)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query_checkid . '<br/>';
        exit();
    }
    elseif ($dbRow = mysqli_fetch_row($dbResult))
    {
        $_SESSION['MsgEvent'] = 'Tu a déjà créé un événement !';
        header('Location: CreateEvent.php');
        exit();
    }
    echo 'test';
    if (!($dbCamp = mysqli_query($dbLink, $query_currentcamp)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query_currentcamp . '<br/>';
        exit();
    }
    elseif ($dbCampagne = mysqli_fetch_row($dbCamp)){
        $query_insertevent = "INSERT INTO event (id_campagne, id_user) VALUES ('$dbCampagne[0]' " . ',' . " '$user_id')";
        if (!($dbAdd = mysqli_query($dbLink, $query_insertevent)))
        {
            echo $_SESSION;
            echo 'Erreur de requête<br/>';
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            echo 'Requête : ' . $query_currentcamp . '<br/>';
            exit();
        }
        $_SESSION['MsgEvent'] = 'Ton événement a été créé !';
        header('Location: CreateEvent.php');
        exit();
    }
    else {
        $_SESSION['MsgEvent'] = 'Il n\'y a pas de campagne actuellement et tu ne peux pas créer d\'événement !';
        header('Location: CreateEvent.php');
        exit();
    }

echo 'test';
?>