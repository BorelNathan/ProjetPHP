
<?php $title='Mon espace perso'?>
<?php ob_start(); ?>
<?php if($filter == 1){?>
<header>
    	<img id="logo" src="../../resources/images/logo.svg" alt="logo de E-Event.IO" />
</header>
<main id="adminMain">
  <section>
    <h1>PAGE RESERVEE AUX ADMINS</h1>
      <form action="/" method="POST" name="traitementrequetesadmin">
        <label for="loginUser">Login de l'utilisateur: </label>
        <input class="roundCornerLink" type="text" name="loginUser" required="required"/>
        <label for="newRoleID">role_id a appliquer: </label>
        <select name="newRoleID"/><br/>
          <option value="">Pas de modification</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select> </br>
        <label for="newLoginUser">Nouveau login pour l'utilisateur: </label>
        <input class="roundCornerLink"class="roundCornerLink"class="roundCornerLink"type="text" name="newLoginUser"/>
        <label for="newPasswordUser">Nouveau mot de passe pour l'utilisateur: </label>
        <input class="roundCornerLink"class="roundCornerLink"type="text" name="newPasswordUser"/>
        <label for="newMailUser">Nouveau mail pour l'utilisateur: </label>
        <input class="roundCornerLink"type="text" name="newMailUser"/>
  <?php echo $_SESSION['UserChange'] ; ?>
        <input type="submit" name="action" value="ChangementUtilisateur"/> <br/>
      </form>
      <form id="home" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
      </form>
      <a class="roundCornerLink"href='#' onclick='document.getElementById("home").submit()'>Retour à la page principale</a>
      <form id="myspace" action="/" method="post">
        <input type="hidden" name="action" value="UserPage"/>
      </form>
      <a class="roundCornerLink"href='#' onclick='document.getElementById("myspace").submit()'>Retour à mon espace</a>
  </section>
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
<?php } ?>
<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
