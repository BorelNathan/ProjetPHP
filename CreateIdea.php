<?php
session_start();
require 'utils.inc.php';
$UtilisateurCourantNom = $_SESSION['CurrentUserName'];
$UtilisateurCourantIDRole = $_SESSION['CurrentUserIDRole'];
$checkIDrole = recheckRoleID($UtilisateurCourantNom);

if($checkIDrole != $UtilisateurCourantIDRole){
    $UtilisateurCourantIDRole = $checkIDrole;
    $_SESSION['CurrentUserIDRole'] = $checkIDrole;
}

echo $UtilisateurCourantNom;
if ($UtilisateurCourantIDRole == 2 && $UtilisateurCourantIDRole == 4) { ?>
        if (
    <form action="AddCampagne.php" method="POST" name="ajoutercampagne">
        Description de l'idée : <textarea type="text" name="IdéeDescription"></textarea><br/>
        Points requis pour débloquer l'idée : <input type="number" name="IdéePointsRequis" required="required"><br/>
        <?php echo $_SESSION['MsgIdée'] ; ?>
        <input type="submit" name="action" value="Créer une idée bonus"/> <br>
        <a href="">Consulter ma page de campagne</a><br/>
        <a href="index.php"> Revenir à la page principale </a><br/>
    </form>
    <?php
}
else {?>
    <h3> Tu n'as pas le droit de créer d'idée </h3>
    <a href="index.php"> Revenir à la page principale </a>
    <?php
}

?>

