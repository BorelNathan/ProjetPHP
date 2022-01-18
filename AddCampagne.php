<?php
    require 'utils.inc.php';
    start_page('Créer une campagne');
    session_start();
    $title = $_POST['CampTitle'];
    $date_deb = date_create_from_format('Y-m-d', $_POST['CampDateDeb']);
    $date_deb = $date_deb->format('Y-m-d');
    $date_fin = date_create_from_format('Y-m-d', $_POST['CampDateFin']);
    $date_fin = $date_fin->format('Y-m-d');

    if ($date_deb > $date_fin){
        $_SESSION['MsgCampagne'] = 'Tu as mal choisi les dates de ta campagne !';
        header('Location: CreateCampagne.php');
        exit();
    }

    $points_attribués = $_POST['CampPointsDonnés'];
    $points_requis = $_POST['CampPointsRequis'];
    $description = $_POST['CampDescription'];
    $can_create = true;
    $user_id = $_SESSION['CurrentUserID'];
    $user_id_role = $_SESSION['CurrentUserIDRole'];

    if (CheckCampagne($date_deb, $date_fin, -1) == false){
        $_SESSION['MsgCampagne'] = 'Il y a déjà une campagne en cours !';
        header('Location: CreateCampagne.php');
    }
    else {
        AddCampagne($date_deb, $date_fin, $points_attribués, $points_requis, $description, $title);
    }
?>