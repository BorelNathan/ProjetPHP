<?php $title='Mon espace perso'?>

<?php ob_start(); ?>

<?php if ($UtilisateurCourantIDRole == 4) { ?>
        <form action="/" method="POST" name="ajoutercampagne">
            Titre de la campagne : <input type="text" name="CampTitle" required="required"/><br/>
            Description de la campagne : <textarea type="text" name="CampDescription"></textarea><br/>
            Date de début de la campagne : <input type="date" name="CampDateDeb" required="required"/> <br/>
            Date de fin de la campagne : <input type="date" name="CampDateFin" required="required"/><br/>
            Points attribués : <input type="number" name="CampPointsDonnés" required="required"><br/>
            Points requis pour qu'un événement soit validé : <input type="number" name="CampPointsRequis" required="required"><br/>
            <?php echo $_SESSION['MsgCampagne'] ; ?>
            <input type="submit" name="action" value="Créer une campagne"/> <br><br/>
            Attention, les dates suivantes sont déjà prises par les campagnes suivantes : <br/>
            <?php GetAllCampagnes();
            for ($i = 0; $i < sizeof($_SESSION['AllCampagnes']); ++$i){
                echo $_SESSION['AllCampagnes'][$i][7] . ' : ' . $_SESSION['AllCampagnes'][$i][1] . ' au ' . $_SESSION['AllCampagnes'][$i][2] . '<br/>';
            }
            ?><br/>
        </form>
        <form id="Retour" action="/" method="post">
            <input type="hidden" name="action" value="Accueil"/>
        </form>
        <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a></li>
        <?php
    }
    else {?>
        <h3> Tu n'as pas le droit de créer de campagne </h3>
        <form id="Retour" action="/" method="post">
            <input type="hidden" name="action" value="Accueil"/>
        </form>
        <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a></li>
        <?php
    }

?>


<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
