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

    $title = addslashes($title);
    $description = addslashes($description);

    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    if($currentIdea = IsThereAnEvent() != false) {
        $_SESSION['MsgEvent'] = 'Tu as déjà créé un événement !';
        header('Location: CreateEvent.php');
        exit();
    }
    else {
        if ($currentCampain = IsThereACampain() != false){
            $Campagne = $_SESSION['CampagneActuelle'];
            $query_insertevent = "INSERT INTO event (id_campagne, id_user, titre, description) VALUES ('$Campagne' " . ',' . " '$user_id'" . ',' . " '$title'" . ',' . " '$description')";
            if (!($dbAdd = mysqli_query($dbLink, $query_insertevent)))
            {
                echo $_SESSION;
                echo 'Erreur de requête<br/>';
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                echo 'Requête : ' . $query_insertevent . '<br/>';
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
    }


?>