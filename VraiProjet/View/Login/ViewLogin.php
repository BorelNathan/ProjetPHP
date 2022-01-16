<?php $title='Login'?>
<?php ob_start(); ?>
<?php $redirectionMDP = '../ChangePassword.php'; ?>
<div id=container><div class="formname">

  <h2> Se connecter </h2>


</div>

<form action="https://owo.alwaysdata.net/" method="POST" name="formulairedelogin">
  Identifiant : <input type="text" name="login"/><br/>
  Mot de passe  : <input type="password" name="motdepasse"/><br/>
  <?php echo $_SESSION['error'] ; ?>
  <input type="submit" name="action" value="Se connecter"/><br/>
  <?php echo '<a href=' . $redirectionMDP . '>Changé de mot de passe</a> '; ?>
</form>


</div>
<?php $content = ob_get_clean(); ?>

<?php require('/home/owo/www/View/template.php')?>
