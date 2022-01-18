<?php
session_start();
require 'utils.inc.php';
$filter = filterUsers(3);

if ($filter == 1){
    GetEndedCampagnes();
    $EndedCamp = $_SESSION['EndedCampagnes'];
    ?>
    Choisissez une des campagnes terminée : <br/>
    <form action="votechoiceprocessing.php" method = post name="endedcampagnes">
        <?php
            for ($i = 0; $i < sizeof($EndedCamp); $i++){
                echo '<input type="radio" id="' . $EndedCamp[$i][0] . '" name="campagneChoice" value="' . $EndedCamp[$i][0] . '" > 
                      <label for="' . $EndedCamp[$i][0] . '">' . $EndedCamp[$i][7] . ' : ' . $EndedCamp[$i][1] . ' au ' . $EndedCamp[$i][2] .  '</label><br/>';
            }
        ?>
    </br>
    <input type="submit" name="action" value="Valider"/> <br/>
    </form>
<?php
}
?>