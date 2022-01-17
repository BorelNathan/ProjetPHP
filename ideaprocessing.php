<?php
session_start();
require 'utils.inc.php';
$_SESSION['IdeaHasChanged'] = true;
$IdeaDescription = $_POST['ideaDescription'];
$IdeaDescription = addslashes($IdeaDescription);
$NbPoints = $_POST['ideaPoints'];
$IdeaId = $_SESSION['IdeaChoice'][0];
$Change = false;

$_SESSION['IdeaChange'] = '';

$dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

if ($IdeaDescription != ''){
    $query = "UPDATE idee_bonus SET description = '" . $IdeaDescription . "' WHERE id_idee =  '" . $IdeaId  . "'";
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    $Change = true;
}
if ($NbPoints != ''){
    $query = "UPDATE idee_bonus SET point_requis = '" . $NbPoints . "' WHERE id_idee =  '" . $IdeaId  . "'";
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    $Change = true;
}

if ($Change != false){
    $_SESSION['IdeaChange'] = $_SESSION['IdeaChange'] . 'Votre idée a été modifiée !';
    header('Location: gestionIdea.php');
}
else {
    $_SESSION['IdeaChange'] = $_SESSION['IdeaChange'] . 'Aucune donnée n\'a été modifiée';
    header('Location: gestionIdea.php');
}
header('Location: gestionIdea.php');
?>