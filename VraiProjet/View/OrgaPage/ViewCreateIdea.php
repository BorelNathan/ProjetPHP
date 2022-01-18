<?php $title='Mon espace perso'?>
<?php ob_start(); ?>
<?php if($filter == 1) {?>
  <header>
    	<img id="logo" src="../../resources/images/logo.svg" alt="logo de E-Event.IO" />
  <?php if($UtilisateurCourantIDRole == 0){ ?>
      <section class="connection" id="notConnected">
    		<p>Vous n'êtes pas connecté</p>
  		<form id="login" action="/" method="post">
              <input type="hidden" name="action" value="login"/>
          </form>
  		<form id="SignIn" action="/" method="post">
                  <input type="hidden" name="action" value="SignIn"/>
          </form>
  		<ul>
              <li><a class="roundCornerLink" href='#' onclick='document.getElementById("login").submit()'>Se connecter</a></li>
              <li><a class="roundCornerLink" href='#' onclick='document.getElementById("SignIn").submit()'>S'inscrire</a></li>
    		</ul>
      </section>
      <?php }
      else{ ?>
      <section class="connection" id="connected">
          <p> Connecté en tant que : <?php echo $UtilisateurCourantNom; ?></p>
  		<form id="MySpace" action="/" method="post">
                  <input type="hidden" name="action" value="UserPage"/>
  		</form>
          <form id="Deco" action="/" method="post">
              <input type="hidden" name="action" value="Deconnexion"/>
          </form>
  		<ul>
  			<li><a class="roundCornerLink" href='#' onclick='document.getElementById("MySpace").submit()'>Mon espace</a></li>
              <li><a href='#' onclick='document.getElementById("Deco").submit()' id="logoutli"><img id="logout" src="../../resources/images/logout.svg" alt="se d�connecter" /></a></li>
    		</ul>
  	</section>
  <?php } ?>
  </header>
<main id="adminMain">
  <section>
    <form action="/" method="POST" name="ajoutercampagne">
        <label for="IdéeDescription">Description de l'idée: </label>
        <textarea class="roundCornerLink" type="text" name="IdéeDescription"></textarea>
        <label for="IdéePointsRequis">Points requis pour débloquer l'idée: </label>
        <input class="roundCornerLink" type="number" name="IdéePointsRequis" required="required">
<?php echo $_SESSION['MsgIdée'] ; ?>
        <input class="roundCornerLink" type="submit" name="action" value="Créer une idée bonus"/>
    </form>
    <a class="roundCornerLink" href="">Consulter ma page de campagne</a>
    <form id="RetourIdee" action="/" method="post">
        <input type="hidden" name="action" value="ChoixIdee"/>
    </form>
    <a class="roundCornerLink" href='#' onclick='document.getElementById("RetourIdee").submit()'>Retour choix idee</a>
    <form id="Retour" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
    </form>
    <a class="roundCornerLink" href='#' onclick='document.getElementById("Retour").submit()'>Retour</a>
  </section>
    <?php
}
else {?>
    <h3> Tu n'as pas le droit de créer d'idée </h3>
    <form id="Retour" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
    </form>
    <a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a>
    <?php
}

?>
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
