
<?php $title='Changer de mdp'?>
<?php ob_start(); ?>
<?php echo $errornewpassword; ?>
<header>
    	<img id="logo" src="../../resources/images/logo.svg" alt="logo de E-Event.IO" />
</header>
<main id="loginMain">
  <div>
    <form action="/" method="POST" name="formulairechagementMDP">
      <label for="loginchangepassword"> Login actuel: </label>
      <input class="roundCornerLink" type="text" name="loginchangepassword"/>
      <label for="currentpassword">Mot de passe actuel: </label>
      <input class="roundCornerLink" type="password" name="currentpassword"/>
      <label for="nouveaumotdepasse1">Nouveau mot de passe: </label>
      <input class="roundCornerLink" type="password" name="nouveaumotdepasse1"/>
      <label for="nouveaumotdepasse2">Confirmer le mot de passe: </label>
      <input class="roundCornerLink" type="password" name="nouveaumotdepasse2"/><br/>
      <input class="roundCornerLink" type="submit" name="action" value="ChangePassword"/> <br/>
    </form>
    <form id="Retour" action="/" method="post">
      <input type="hidden" name="action" value="Accueil"/>
    </form>
    <a class="roundCornerLink" href='#' onclick='document.getElementById("Retour").submit()'>Revenir a la page principale</a>
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
