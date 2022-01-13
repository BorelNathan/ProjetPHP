<?php
    require 'utils.inc.php';
    start_page('test-pass');
    session_start();
    $title = $_POST['EventTitle'];
    //$objdate = date_create_from_format('Y-m-d', $_POST['CampDa']);
    $date_deb = $_POST['CampDateDeb'];
    $date_fin = $_POST['CampDateFin'];
    $points = $_POST['CampPoints'];
    //$date = date();
    $can_create = true;
    $user_id = $_SESSION['CurrentUserID'];
    $user_id_role = $_SESSION['CurrentUserIDRole'];

    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_checkid = "SELECT * FROM campagne";
    date_default_timezone_set('UTC');
    $query_insertcamp = "INSERT INTO campagne (date_deb, date_fin, point_attribué) VALUES ('$date_deb' " . ',' . " '$date_fin' " . ',' . " '$points')";
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
        if ($dbRow[1] < $date_deb && $dbRow[2] > $date_fin) {
            $_SESSION['error'] = 'Il y a déjà un événement en cours !';
            header('Location: CreateCampagne.php');
            $can_create = false;
        }
    }

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
            $_SESSION['error'] = 'Ton événement à été créé !';
            header('Location: CreateCampagne.php');
        }
    }
?>