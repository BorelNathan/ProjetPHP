<?php
  require 'utils.inc.php';
  start_page('Login');
  ficheCSS('style.css');
  session_start();
  $redirectionMDP = 'ChangePassword.php';
?>

<div id=container><div class="formname">

  <h2> Se connecter </h2>


</div>

<form action="test-pass.php" method="POST" name="formulairedelogin">
  Identifiant : <input type="text" name="login"/><br/>
  Mot de passe  : <input type="password" name="motdepasse"/><br/>
  <?php echo $_SESSION['error'] ; ?>
  <input type="submit" name="action" value="Se connecter"/> <br/>
  <?php echo '<a href=' . $redirectionMDP . '>Mot de passe oublié?</a> '; ?>
</form>


</div>

<?php
  end_page();
?>
