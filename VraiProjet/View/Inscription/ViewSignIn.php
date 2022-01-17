<?php $title='Inscription'?>
<?php ob_start(); ?>


        <div id="container"><div class="formname">

        Inscrivez-vous

          </div>
        <form action="https://owo.alwaysdata.net/" method="POST" name="formulaire">
          <input type="text" placeholder="Mail" name="mail" required>
          <input class="button" type="submit" name="action" value="S'inscrire" />

        </form>
        <form id="login" action="/" method="post">
            <input type="hidden" name="action" value="login"/>
        </form>
        <li><a href='#' onclick='document.getElementById("login").submit()'>Se connecter?</a></li>

        </div>
<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
