<?php $title='Inscription'?>
<?php ob_start(); ?>
<?php
  $redirectionlogin = 'login.php';
?>


        <div id="container"><div class="formname">

        Inscrivez-vous

          </div>
        <form action="https://owo.alwaysdata.net/" method="POST" name="formulaire">
          <input type="text" placeholder="Mail" name="mail" required>
          <input class="button" type="submit" name="action" value="S'inscrire" />

        </form>
        <?php echo '<a href=' . $redirectionlogin . '>Se connecter?</a>  </br>'; ?>

        </div>
<?php $content = ob_get_clean(); ?>

<?php require('/home/owo/www/View/template.php')?>
