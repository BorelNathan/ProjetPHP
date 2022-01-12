<?php
    session_start();
    require 'utils.inc.php';
    $UtilisateurCourantNom = $_SESSION['CurrentUserName'];
    $UtilisateurCourantIDRole = $_SESSION['CurrentUserIDRole'];

    echo $UtilisateurCourantNom;
    if ($UtilisateurCourantIDRole == 2) { ?>
        <form action="AddEvent.php" method="POST" name="formulairedelogin">
            Titre de l'événement : <input type="text" name="EventTitle"/><br/>
            Description de l'événement : <textarea type="text" name="EventDescription"></textarea>
            <input type="submit" name="action" value="Créer un événement"/> <br>
        </form>
        <?php
    }
    else {?>
        <h3> Tu n'as pas le droit de créer d'événements </h3>
        <a href="index.php"> Revenir à la page principale </a>
        <?php
    }



?>