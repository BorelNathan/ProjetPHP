<?php
session_start();
require 'utils.inc.php';
$EventTitle = $_POST['eventName'];
$EventDescription = $_POST['eventDescription'];
$Case = '';

$EventTitle = addslashes($EventTitle);
$EventDescription = addslashes($EventDescription);



if ($EventTitle != ''){
    $Case = $Case . 'T';
}
if ($EventDescription != ''){
    $Case = $Case . 'D';
}

switch ($Case){
    case "T":
        $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
        $query = "UPDATE event SET titre = '" . $EventTitle . "' WHERE id_event =  '" . $_SESSION['Event'][0]  . "'";

        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur de requête<br/>';
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        $_SESSION['EventChange'] = 'Vous avez changé le titre de l\'évenemnt';
        header('Location: gestionEvent.php');
        break;
    case 'D':
        $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
        $query = "UPDATE event SET description = '" . $EventDescription . "' WHERE id_event =  '" . $_SESSION['Event'][0]  . "'";

        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur de requête<br/>';
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        $_SESSION['EventChange'] = 'Vous avez changé la description de l\'évenemnt';
        header('Location: gestionEvent.php');
        break;
    case 'TD':
        $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
        $query = "UPDATE event SET titre = '" . $EventTitle . "', description ='" . $EventDescription . "' WHERE id_event =  '" . $_SESSION['Event'][0]  . "'";

        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur de requête<br/>';
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        $_SESSION['EventChange'] = 'Vous avez changé le titre et la description de l\'évenemnt';
        header('Location: gestionEvent.php');
        break;
    case '':
        $_SESSION['EventChange'] = 'Vous n\'avez rien modifié';
        header('Location: gestionEvent.php');
        break;

}
