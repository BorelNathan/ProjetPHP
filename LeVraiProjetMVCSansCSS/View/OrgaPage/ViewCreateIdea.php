<?php $title='Mon espace perso'?>
<?php ob_start(); ?>
<?php if($filter == 1) {?>

    <form action="/" method="POST" name="ajoutercampagne">
        Description de l'idée : <textarea type="text" name="IdéeDescription"></textarea><br/>
        Points requis pour débloquer l'idée : <input type="number" name="IdéePointsRequis" required="required"><br/>
        <?php echo $_SESSION['MsgIdée'] ; ?>
        <input type="submit" name="action" value="Créer une idée bonus"/> <br>
    </form>
    <a href="">Consulter ma page de campagne</a><br/>
    <form id="RetourIdee" action="/" method="post">
        <input type="hidden" name="action" value="ChoixIdee"/>
    </form>
    <li><a href='#' onclick='document.getElementById("RetourIdee").submit()'>Retour choix idee</a></li>
    <form id="Retour" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
    </form>
    <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a></li>
    <?php
    var_dump($_SESSION['EvenementUser']);
    var_dump($_SESSION['CampagneActuelle']);
    var_dump($_POST['IdéeDescription']);
    var_dump($_POST['IdéePointsRequis']);
}
else {?>
    <h3> Tu n'as pas le droit de créer d'idée </h3>
    <form id="Retour" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
    </form>
    <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a></li>
    <?php
}

?>

<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
