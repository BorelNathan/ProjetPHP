<?php $title='Inscription'?>
<?php ob_start(); ?>
<header>
    	<img id="logo" src="../../resources/images/logo.svg" alt="logo de E-Event.IO" />
</header>
<main id="loginMain">
  <div id="container">
    <h1>Inscrivez-vous</h1>
    <form action="/" method="POST" name="formulaire">
      <input class="roundCornerLink" type="text" placeholder="Mail" name="mail" required>
      <input class="roundCornerLink" type="submit" name="action" value="S'inscrire" />
    </form>
    <form id="login" action="/" method="post">
      <input type="hidden" name="action" value="login"/>
    </form>
    <label for="login">Vous possédez déja un compte?</label>
    <a class="roundCornerLink" name="login" href='#' onclick='document.getElementById("login").submit()'>Connectez vous</a>
  </div>
</main>
<footer>
  <ul>
    <li><a class="roundCornerLink" href="howitworks.php">Fonctionnement du site</a></li>
    <li><div class="split"></div></li>
    <li><a class="roundCornerLink" href="CGU.php">CGU</a></li>
    <li><div class="split"></div></li>
    <li><a class="roundCornerLink" href="legaldisclaimer.php">Mentions légales</a></li>
  </ul>
</footer>
<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
