<?php
session_start();
require 'utils.inc.php';
$filter = filterUsers(2);
$IdeaChoice = $_SESSION['IdeaChoice'];
$Event = $_SESSION['Event'];


if
($filter == 1) {
    start_page('Gestionnaire des idées bonus');
    echo '<h1>PAGE RESERVE AUX ORGANISATEURS</h1>';
    ?>

    </div>

    <?php
    if ($check = IsThereAnEvent() != false) {
        GetEvent();
        GetIdeeFromId($IdeaChoice);
        ?>
        Nom de l'événement : <?php echo $Event[4] . '</br>'; ?>
        Description de l'événement : <?php echo $Event[5] . '</br>'; ?>
        Points de l'événement : <?php echo $Event[1] . '</br>'; ?><br/>
        Description de l'idée bonus sélectionnée : <?php echo $_SESSION['IdeeChosen'][4] . '<br/>' ?>
        Points nécessaires pour l'idée bonus sélectionnée : <?php echo $_SESSION['IdeeChosen'][1] . '<br/>' ?><br/>
        Choisissez ce que vous voulez modifier : <br/>
        <?php
        if ($_SESSION['IdeeChosen'][5] != 0) {
            echo 'Vous ne pouvez plus modifier cette idée car elle a été débloquée';
                } else {
            echo '<form action="ideaprocessing.php" method="POST" name="traitementrequetesorganisateur">
            Modifier la description de cette idée : <textarea type="text" name="ideaDescription"></textarea><br/>
            Modifier les points nécessaires: <input type="number" name="ideaPoints"/><br/>' .
                $_SESSION['IdeaChange'] . '</br>' . '
            <input type="submit" name="action" value="Valider"/> <br/>
        </form>';
        }
        ?>
        <a href="gestionIdeaChoice.php">Retour à la page précédente</a><br/>
        <a href="index.php">Retour à la page principale</a>

        </div>
        <?php
    }


}
?>