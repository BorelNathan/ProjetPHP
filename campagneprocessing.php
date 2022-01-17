<?php
session_start();
require 'utils.inc.php';
$CampTitle = $_POST['campName'];
$CampDescription = $_POST['campDescription'];
$CampMinPoints = $_POST['minPointsCamp'];
$CampDateDeb = $_POST['dateDebCamp'];
$CampDateFin = $_POST['dateFinCamp'];
$Change = false;

$CampTitle = addslashes($CampTitle);
$CampDescription = addslashes($CampDescription);
#unset($_SESSION['CampagneChange']);
$_SESSION['CampagneChange'] = '';

$dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));


if ($CampTitle != ''){
    $query = "UPDATE campagne SET titre = '" . $CampTitle . "' WHERE id_campagne =  '" . $_SESSION['CampagneChoisie'][0]  . "'";
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    $Change = true;
}
if ($CampDescription != ''){
    $query = "UPDATE campagne SET description = '" . $CampDescription . "' WHERE id_campagne =  '" . $_SESSION['CampagneChoisie'][0]  . "'";
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    $Change = true;
}
if ($CampMinPoints != '') {
    $query = "UPDATE campagne SET point_min = '" . $CampMinPoints . "' WHERE id_campagne =  '" . $_SESSION['CampagneChoisie'][0]  . "'";
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    $Change = true;
}

if ($CampDateDeb != false && $CampDateFin != false) {
    if (CheckCampagne($CampDateDeb, $CampDateFin)){
        $CampDateDeb = date_create_from_format('Y-m-d', $_POST['dateDebCamp']);
        $CampDateDeb = $CampDateDeb->format('Y-m-d');
        $CampDateFin = date_create_from_format('Y-m-d', $_POST['dateFinCamp']);
        $CampDateFin = $CampDateFin->format('Y-m-d');
        $query = "UPDATE campagne SET date_deb = '" . $CampDateDeb . "', date_fin = '". $CampDateFin . "' WHERE id_campagne =  '" . $_SESSION['CampagneChoisie'][0]  . "'";
        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur de requête<br/>';
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        $Change = true;
    }
    $_SESSION['CampagneChange'] = $_SESSION['CampagneChange'] . 'Il y a déjà une campagne en cours ! <br/>';
}
elseif ($CampDateDeb != false) {
    if (CheckCampagne($CampDateDeb, $_SESSION['CampagneChoisie'][2]) != false){
        $CampDateDeb = date_create_from_format('Y-m-d', $_POST['dateDebCamp']);
        $CampDateDeb = $CampDateDeb->format('Y-m-d');
        $query = "UPDATE campagne SET date_deb = '" . $CampDateDeb . "' WHERE id_campagne =  '" . $_SESSION['CampagneChoisie'][0]  . "'";
        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur de requête<br/>';
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        $Change = true;
    }
    $_SESSION['CampagneChange'] = $_SESSION['CampagneChange'] . 'Il y a déjà une campagne en cours ! <br/>';
}
elseif ($CampDateFin != false) {
    if (CheckCampagne($_SESSION['CampagneChoisie'][1], $CampDateFin) != false){
        $CampDateFin = date_create_from_format('Y-m-d', $_POST['dateFinCamp']);
        $CampDateFin = $CampDateFin->format('Y-m-d');
        $query = "UPDATE campagne SET date_fin = '" . $CampDateFin . "' WHERE id_campagne =  '" . $_SESSION['CampagneChoisie'][0]  . "'";
        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur de requête<br/>';
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        $Change = true;
    }
    $_SESSION['CampagneChange'] = $_SESSION['CampagneChange'] . 'Il y a déjà une campagne en cours ! <br/>';
}
if ($Change == true){
    $_SESSION['CampagneChange'] = $_SESSION['CampagneChange'] . 'Votre campagne a été modifiée ! ';
    GetCampagneFromId($_SESSION['IdCampagneChoisie']);
}
else {
    $_SESSION['CampagneChange'] = $_SESSION['CampagneChange'] . 'Aucune donnée n\'a été modifiée';
}
header('Location: gestionCampagne.php');
?>