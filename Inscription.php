<?php
  require 'utils.inc.php';
  start_page('S\'inscrire');
  $redirectionlogin = 'login.php';

?>


        <div id="container"><div class="formname">

        Inscrivez-vous

          </div>
        <form action="data_processing.php" method="POST" name="formulaire">
          <input type="text" placeholder="Mail" name="mail" required>
          <input class="button" type="submit" name="action" value="S'inscrire" />

        </form>
        <?php echo '<a href=' . $redirectionlogin . '>Se connecter?</a>  </br>'; ?>

        </div>







<?php
  end_page();
?>
