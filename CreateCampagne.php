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
    if ($UtilisateurCourantIDRole == 4) { ?>
        <form action="AddCampagne.php" method="POST" name="ajoutercampagne">
            Titre de la campagne : <input type="text" name="EventTitle"/><br/>
            Date de début de la campagne : <input type="date" name="CampDateDeb"/> <br/>
            Date de fin de la campagne : <input type="date" name="CampDateFin"/><br/>
            Points attribués : <input type="number" name="CampPoints">
            <?php echo $_SESSION['MsgCampagne'] ; ?>
            <input type="submit" name="action" value="Créer une campagne"/> <br>
            <a href="">Consulter ma page de campagne</a><br/>
            <a href="index.php"> Revenir à la page principale </a><br/>
        </form>
        <?php
    }
    else {?>
        <h3> Tu n'as pas le droit de créer de campagne </h3>
        <a href="index.php"> Revenir à la page principale </a>
        <?php
    }

?>
