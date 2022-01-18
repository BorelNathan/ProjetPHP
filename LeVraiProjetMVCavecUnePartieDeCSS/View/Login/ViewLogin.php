
<?php $title='Login'?>
<?php ob_start(); ?>
<header>
      <img id="logo" src="../../resources/images/logo.svg" alt="logo de E-Event.IO" />
</header>
<main id="loginMain">
  <div>
    <h1> Se connecter </h1>
    <form action="index.php" method="POST" name="formulairedelogin">
      <label for="login">Identifiant</label>
      <input class="roundCornerLink" type="text" name="login"/><br/>
      <label for="motdepasse">Mot de passe</label>
      <input class="roundCornerLink" type="password" name="motdepasse"/><br/>
  <?php echo $_SESSION['error'] ; ?>
      <input class="roundCornerLink" type="submit" name="action" value="Se connecter"/><br/>
    </form>
    <form id="MDP" action="/" method="post">
      <input type="hidden" name="action" value="MDP"/>
    </form>
    <a class="roundCornerLink" href='#' onclick='document.getElementById("MDP").submit()'>Changer de mot de passe</a>
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
