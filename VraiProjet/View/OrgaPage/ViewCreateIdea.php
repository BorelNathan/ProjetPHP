<?php $title='Mon espace perso'?>
<?php ob_start(); ?>
<?php if($filter == 1) {?>
<main id="adminMain">
  <section>
    <form action="/" method="POST" name="ajoutercampagne">
        <label for="IdéeDescription">Description de l'idée: </label>
        <textarea type="text" name="IdéeDescription"></textarea>
        <label for="IdéePointsRequis">Points requis pour débloquer l'idée: </label>
        <input type="number" name="IdéePointsRequis" required="required">
<?php echo $_SESSION['MsgIdée'] ; ?>
        <input type="submit" name="action" value="Créer une idée bonus"/>
    </form>
    <a href="">Consulter ma page de campagne</a>
    <form id="RetourIdee" action="/" method="post">
        <input type="hidden" name="action" value="ChoixIdee"/>
    </form>
    <a href='#' onclick='document.getElementById("RetourIdee").submit()'>Retour choix idee</a>
    <form id="Retour" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
    </form>
    <a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a>
  </section>
    <?php
}
else {?>
    <h3> Tu n'as pas le droit de créer d'idée </h3>
    <form id="Retour" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
    </form>
    <a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a>
    <?php
}

?>

<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
