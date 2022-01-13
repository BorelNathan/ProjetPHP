<?php
    require 'utils.inc.php';
    start_page('Créer une campagne');
    session_start();
    $title = $_POST['EventTitle'];
    $date_deb = date_create_from_format('Y-m-d', $_POST['CampDateDeb']);
    $date_deb = $date_deb->format('Y-m-d');
    $date_fin = date_create_from_format('Y-m-d', $_POST['CampDateFin']);
    $date_fin = $date_fin->format('Y-m-d');

    $points = $_POST['CampPoints'];
    //$date = date();
    $can_create = true;
    $user_id = $_SESSION['CurrentUserID'];
    $user_id_role = $_SESSION['CurrentUserIDRole'];

    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query_checkid = "SELECT * FROM campagne";

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
        if ($dbRow[1] <= $date_deb && $dbRow[2] >= $date_deb) {
            $_SESSION['MsgCampagne'] = 'Il y a déjà une campagne en cours !';
            header('Location: CreateCampagne.php');
            $can_create = false;
            exit();
        }
        elseif ($dbRow[1] <= $date_fin && $dbRow[2] >= $date_fin){
            $_SESSION['MsgCampagne'] = 'Il y a déjà une campagne en cours !';
            header('Location: CreateCampagne.php');
            $can_create = false;
            exit();
        }
        elseif ($dbRow[1] >= $date_deb && $dbRow[1] <= $date_fin){
            $_SESSION['MsgCampagne'] = 'Il y a déjà une campagne en cours !';
            header('Location: CreateCampagne.php');
            $can_create = false;
            exit();
        }
        elseif ($dbRow[2] >= $date_deb && $dbRow[2] <= $date_fin){
            $_SESSION['MsgCampagne'] = 'Il y a déjà une campagne en cours !';
            header('Location: CreateCampagne.php');
            $can_create = false;
            exit();
        }
        elseif ($dbRow[1] == $date_deb && $dbRow[2] == $date_fin){
            $_SESSION['MsgCampagne'] = 'Il y a déjà une campagne en cours !';
            header('Location: CreateCampagne.php');
            $can_create = false;
            exit();
        }
        else {
            $can_create = true;
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
            $_SESSION['MsgCampagne'] = 'Ta campagne à été créée !';
            header('Location: CreateCampagne.php');
        }
    }
?>