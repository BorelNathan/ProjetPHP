<?php $title='Mon espace perso'?>
<?php ob_start(); ?>
<?php
if($filter == 1) {?>
<h1>PAGE RESERVE AUX ADMINISTATEUR</h1>

Campagne à modifier : <br/><br/>
<form action="/" method="POST" name="choixcampagne">
        <?php
        for ($i = 0; $i < sizeof($_SESSION['AllCampagnes']); $i++){?>
            <input type="radio" id=" <?php $_SESSION['AllCampagnes'][$i][0];?>" name="campagneChoice" value="<?php echo $_SESSION['AllCampagnes'][$i][0] ;?>" >
            <label for=" <?php echo $_SESSION['AllCampagnes'][$i][0];?> "><?php echo $_SESSION['AllCampagnes'][$i][7];?> :  <?php echo $_SESSION['AllCampagnes'][$i][1];?> au <?php echo $_SESSION['AllCampagnes'][$i][2]; ?> </label><br/>
        <?php } ?>
    </br>
    <input type="submit" name="action" value="choixcampagne"/> <br/>
</form>

<form id="CreateCamp" action="/" method="post">
    <input type="hidden" name="action" value="CreateCampPage"/>
</form>
<li><a href='#' onclick='document.getElementById("CreateCamp").submit()'>Créer un campagne</a></li>
<form id="Retour" action="/" method="post">
    <input type="hidden" name="action" value="Accueil"/>
</form>
<li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a></li>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
