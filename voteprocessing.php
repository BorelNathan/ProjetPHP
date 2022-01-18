<?php
session_start();
require 'utils.inc.php';
$filter = filterUsers(3);
if ($filter == 1) {
    $Events = $_SESSION['EventsFromCampagne'];
    $EventUp = $_POST['eventChoice'];
    $EventChosen = GetEventFromId($EventUp);

    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query = "UPDATE event SET jury_vote ='1' WHERE id_event='" . $EventUp . "'";

    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    else{
        $_SESSION['UpVoteJuryChange'] = 'Vous venez de voter !';
        header('Location: juryVote.php');
    }

}