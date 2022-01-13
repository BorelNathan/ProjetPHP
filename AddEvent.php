<?php
    require 'utils.inc.php';
    start_page('test-pass');
    session_start();
    $title = $_POST['EventTitle'];
    $description = $_POST['EventDescription'];
    $point_min = $_POST['EventMinPoint'];
    $user_id = $_SESSION['CurrentUserID'];
    $user_id_role = $_SESSION['CurrentUserIDRole'];

    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_checkid = "SELECT * FROM event WHERE id_user =  '" . $user_id . "'";
    //$query_insertevent = "INSERT INTO event (email, login, passwd) VALUES ('$michel' " . ',' . " '$login' " . ',' . " '$password')"
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
        $_SESSION['error'] = 'Tu a déjà créé un événement !';
        header('Location: CreateEvent.php');
    }
    else
    {
        $_SESSION['error'] = 'Ton événement à été créé !';
        header('Location: CreateEvent.php');
    }
?>