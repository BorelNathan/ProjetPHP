<?php

    session_start();
    require 'utils.inc.php';
    $filter = filterUsers(2);
    if($filter == 1) {
        start_page('Gestionnaire des utilisateurs');
        echo '<h1>PAGE RESERVE AUX ORGANISATEURS</h1>';

?>

    </div>

        <?php
            if ($check = IsThereAnEvent() != false){
                GetEvent();
        ?>
        Nom de l'événement : <?php echo $_SESSION['Event'][4] . '</br>';?>
        Description de l'événement : <?php echo $_SESSION['Event'][5] . '</br>';?>
        Points de l'événement : <?php echo $_SESSION['Event'][1] . '</br>';?>
        <form action="organisateurprocessing.php" method="POST" name="traitementrequetesorganisateur">
            Modifier le titre de cet événement : <input type="text" name="eventName" /><br/>
            Modifier la description de cet événement : <textarea type="text" name="eventDescription"></textarea><br/>
            <?php echo $_SESSION['EventChange'] . '</br>'; ?>
            <input type="submit" name="action" value="Valider"/> <br/>
        </form>
        <a href="gestionIdeaChoice.php">Page de gestion des idées bonus</a>
        <a href="index.php">Retour à la page principale</a>

    </div>


<?php
end_page();
}
    }
?>