<?php $title='Inscription reussite'?>
<?php ob_start(); ?>
<a> Inscription enregistrer et email envoyé </a> </br>
<form id="Retour" action="/" method="post">
    <input type="hidden" name="action" value="Accueil"/>
</form>
<li><a href='#' onclick='document.getElementById("Retour").submit()'>Revenir a la page principale</a></li>
<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
