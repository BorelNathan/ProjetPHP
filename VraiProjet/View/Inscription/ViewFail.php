<?php $title='Inscription échoue'?>
<?php ob_start(); ?>
<a> Email non valide </a> </br>
<a href="' . $redirection . '"> Revenir a la page principale </a>
<?php $content = ob_get_clean(); ?>

<?php require('/home/owo/www/View/template.php')?>
