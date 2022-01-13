<?php
    session_start();
    require 'utils.inc.php';
    $UtilisateurCourantNom = $_SESSION['CurrentUserName'];
    $UtilisateurCourantIDRole = $_SESSION['CurrentUserIDRole'];

    echo $UtilisateurCourantNom;
    if ($UtilisateurCourantIDRole == 2) { ?>
        <form action="AddEvent.php" method="POST" name="ajoutevent">
            Titre de l'événement : <input type="text" name="EventTitle"/><br/>
            Description de l'événement : <textarea type="text" name="EventDescription"></textarea><br/>
            <?php echo $_SESSION['error'] ; ?>
            <input type="submit" name="action" value="Créer un événement"/> <br>
            <a href="">Consulter ma page d'événement</a><br/>
            <a href="index.php"> Revenir à la page principale </a><br/>
        </form>
        <?php
    }
    else {?>
        <h3> Tu n'as pas le droit de créer d'événements </h3>
        <a href="index.php"> Revenir à la page principale </a>
        <?php
    }
?>