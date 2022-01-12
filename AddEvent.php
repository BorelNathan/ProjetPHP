<?php
    require 'utils.inc.php';
    start_page('test-pass');
    session_start();
    $title = $_POST['EventTitle'];
    $description = $_POST['EventDescription'];
    $user_id = $_SESSION['CurrentUserID'];
    $user_id_role = $_SESSION['CurrentUserIDRole'];

    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query = "SELECT * FROM event WHERE id_user =  '" . $user_id . "'";
    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo $_SESSION;
        echo 'Erreur de requête<br/>';
        echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
        echo 'Requête : ' . $query . '<br/>';
        exit();
    }
    elseif ($dbRow = mysqli_fetch_row($dbResult))
    {
        echo 'oui';
        echo $query;
        echo $user_id_role;
        echo $user_id;
    }
    else
    {
        $_SESSION['error'] = 'Mauvais identifiant ou mot de passe';
        echo 'non';
        //header('Location: login.php');
    }
?>