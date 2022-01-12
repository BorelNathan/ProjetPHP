<?php
  require 'utils.inc.php';
  start_page('Login');
  ficheCSS('style.css');
  session_start();
?>

<div id=container><div class="formname">

  <h2> Se connecter </h2>


</div>

<form action="test-pass.php" method="POST" name="formulairedelogin">
  Identifiant : <input type="text" name="login"/><br/>
  Mot de passe  : <input type="password" name="motdepasse"/><br/>
  <?php echo $_SESSION['error'] ; ?>
  <input type="submit" name="action" value="Se connecter"/> <br/>
</form>


</div>

<?php
  end_page();
?>
