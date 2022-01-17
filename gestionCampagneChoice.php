<?php

session_start();
require 'utils.inc.php';
$_SESSION['CampagneChange'] = '';
$filter = filterUsers(4);
if($filter == 1) {
    start_page('Gestionnaire des utilisateurs');
echo '<h1>PAGE RESERVE AUX ORGANISATEURS</h1>';
}
GetAllCampagnes();
?>
Campagne à modifier : <br/><br/>
<form action="campagnechoiceprocessing.php" method="POST" name="choixcampagne">
        <?php
        for ($i = 0; $i < sizeof($_SESSION['AllCampagnes']); $i++){
            echo '<input type="radio" id="' . $_SESSION['AllCampagnes'][$i][0] . '" name="campagneChoice" value="' . $_SESSION['AllCampagnes'][$i][0] . '" > 
                  <label for="' . $_SESSION['AllCampagnes'][$i][0] . '">' . $_SESSION['AllCampagnes'][$i][7] . ' : ' . $_SESSION['AllCampagnes'][$i][1] . ' au ' . $_SESSION['AllCampagnes'][$i][2] .  '</label><br/>';
        }
        ?>
    </br>
    <input type="submit" name="action" value="Valider"/> <br/>
</form>
