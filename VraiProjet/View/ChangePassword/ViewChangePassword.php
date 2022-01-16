<?php $title='Inscription'?>
<?php ob_start(); ?>
<?php echo $errornewpassword; ?>
<form action="https://owo.alwaysdata.net/" method="POST" name="formulairechagementMDP">
  Login actuel : <input type="text" name="loginchangepassword"/><br/>
  Mot de passe actuel : <input type="password" name="currentpassword"/><br/>
  Nouveau mot de passe : <input type="password" name="nouveaumotdepasse1"/><br/>
  Confirmer le mot de passe : <input type="password" name="nouveaumotdepasse2"/><br/>
  <input type="submit" name="action" value="ChangePassword"/> <br/>
  <a href="index.php"> Revenir a la page principale </a>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('/home/owo/www/View/template.php')?>
