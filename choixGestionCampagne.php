<?php

session_start();
require 'utils.inc.php';
$_SESSION['CampagneChange'] = '';
$filter = filterUsers(4);
if($filter == 1) {
    start_page('Gestionnaire des utilisateurs');
echo '<h1>PAGE RESERVE AUX ORGANISATEURS</h1>';
} ?>
Campagne à modifier : <br/><br/>
<form action="gestionCampagne.php" method="POST" name="choixcampagne">
    <select name="campagneChoice"/><br/>
        <option value="">Pas de modification</option>
        <?php
            GetAllCampagnes();
            for ($i = 0; $i < sizeof($_SESSION['AllCampagnes']); ++$i){
                echo '<option value="' . $_SESSION['AllCampagnes'][$i][0] . '">' . $_SESSION['AllCampagnes'][$i][7] . '</option>' ;
            }
        ?>
    </select> </br>
    <input type="submit" name="action" value="Valider"/> <br/>
</form>
