<?php
  require 'utils.inc.php';
  start_page('Reset son mot de passe');
  session_start();
  $error = $_SESSION['ErrorPasswordReset'];

?>

<form action="PasswordResetProcessing.php" method="POST" name="traitementrequete">
  Changer son mot de passe </br>
  Entrer son Email pour valider : <input type="text" name="CurrentMailForgot"></br>
  <input type="submit" name="ChangePassword" value="Changer de mot de passe"/>
</form> <br/>









<?php
  end_page();
?>
