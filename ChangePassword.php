<?php
  require 'utils.inc.php';
  start_page('Changer de mot de passe ou login');
  session_start();
?>

<?php echo $_SESSION['errornewpassword']; ?>
<form action="newdata_processing.php" method="POST" name="formulairechagementMDP">
  Login actuel : <input type="text" name="loginchangepassword"/><br/>
  Nouveau mot de passe : <input type="password" name="nouveaumotdepasse"/><br/>
  Confirmer le mot de passe : <input type="password" name="nouveaumotdepasse"/><br/>
  <input type="submit" name="action" value="Valider"/> <br/>
  <a href="index.php"> Revenir a la page principale </a>
</form>





<?php
  end_page();
?>
