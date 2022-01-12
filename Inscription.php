<?php
  require 'utils.inc.php';
  start_page('S\'inscrire');
  ficheCSS('style.css');
  $redirectionlogin = 'login.php';
  $redirectionMDP = 'ChangePassword.php';
?>


        <div id="container"><div class="formname">

        Inscrivez-vous

          </div>
        <form action="data_processing.php" method="POST" name="formulaire">
          <input type="text" placeholder="Mail" name="mail" required>
          <input class="button" type="submit" name="action" value="S'inscrire" />

        </form>
        <?php echo '<a href=' . $redirectionlogin . '>Se connecter?</a>  </br>'; ?>
        <?php echo '<a href=' . $redirectionMDP . '>Mot de passe oublié?</a> '; ?>

        </div>







<?php
  end_page();
?>
