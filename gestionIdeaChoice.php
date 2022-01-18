<?php

session_start();
require 'utils.inc.php';
$Event = $_SESSION['Event'];

$filter = filterUsers(2);
if ($filter == 1) {
    start_page('Gestionnaire des idées bonus');
    echo '<h1>PAGE RESERVE AUX ORGANISATEURS</h1>';
        ?>

        </div>

        <?php
        if ($check = IsThereAnEvent() != false) {
            GetEvent();
            GetBonusIdeas($_SESSION['Event'][0]);
            $AllIdeas = $_SESSION['AllIdeas'];
            ?>
            Nom de l'événement : <?php echo $Event[4] . '</br>'; ?>
            Description de l'événement : <?php echo $Event[5] . '</br>'; ?>
            Points de l'événement : <?php echo $Event[1] . '</br>'; ?>

                Choisissez une idée bonus à modifier : <br/>
            <form action="ideachoiceprocessing.php" method="POST" name="traitementrequetesideeorganisateur">
                <?php
                    for ($i = 0; $i < sizeof($AllIdeas); $i++){
                        echo '<input type="radio" id="' . $AllIdeas[$i][0] . '" name="ideaSelector" value="' . $AllIdeas[$i][0] . '" > 
                              <label for="' . $AllIdeas[$i][0] . '">' . $AllIdeas[$i][1] . ' points requis</label><br/>';
                    }
                ?>
                <input type="submit" name="action" value="Valider"/> <br/>
            </form>
            <a href="gestionEvent.php">Retour</a><br/>
            <a href="index.php">Retour à la page principale</a>

            </div>
            <?php
        }

}
?>
