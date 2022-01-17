<?php
    require 'utils.inc.php';
    start_page('test-pass');
    session_start();
    $description = $_POST['IdéeDescription'];
    $description = addslashes($description);
    $point_min = $_POST['IdéePointsRequis'];
    $user_id = $_SESSION['CurrentUserID'];
    $user_id_role = $_SESSION['CurrentUserIDRole'];
    date_default_timezone_set('UTC');
    $today = date('Y-m-d');


    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

    if($currentCampain = IsThereACampain() != false){
        $Campagne = $_SESSION['CampagneActuelle'];
        if ($currentEvent = IsThereAnEvent() != false){
            $CurrentEvent = $_SESSION['EvenementUser'];
            $query_insertidea = "INSERT INTO idee_bonus (id_campagne, point_requis, description, id_event) VALUES ('$Campagne' " . ',' . " '$point_min'" . ',' . " '$description'" . ',' . " '$CurrentEvent')";
            if (!($dbAdd = mysqli_query($dbLink, $query_insertidea)))
            {
                echo $_SESSION;
                echo 'Erreur de requête<br/>';
                echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
                echo 'Requête : ' . $query_insertidea . '<br/>';
                exit();
            }
            $_SESSION['MsgIdée'] = 'Ton idée a été ajoutée !';
            header('Location: CreateIdea.php');
            exit();
        }
        else {
            $_SESSION['MsgIdée'] = 'Tu n\'as pas encore créé d\'événements ! Tu ne peux pas ajouter d\'idées bonus.';
            header('Location: CreateIdea.php');
            exit();
        }
    }
    else {
        $_SESSION['MsgIdée'] = 'Il n\'y a pas de campagne actuellement !';
        header('Location: CreateIdea.php');
        exit();
    }
?>