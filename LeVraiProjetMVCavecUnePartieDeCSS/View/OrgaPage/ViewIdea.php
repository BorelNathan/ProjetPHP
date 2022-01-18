<?php $title='Mon espace perso'?>
<?php ob_start(); ?>
<?php
if ($filter == 1) {        ?>
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
    <h1>PAGE RESERVE AUX ORGANISATEURS</h1>
            <p>
              Nom de l'événement : <?php echo $Event[4]; ?>
            </p>
            <p>
              Description de l'événement : <?php echo $Event[5]; ?>
            </p>
            <p>
              Points de l'événement : <?php echo $Event[1]; ?>
            </p>
            <label for="traitementrequetesideeorganisateur">
              Choisissez une idée bonus à modifier:
            </label>
            <form action="/" method="POST" name="traitementrequetesideeorganisateur">
                <?php
                if($Allideas != null){
                    for ($i = 0; $i < sizeof($AllIdeas); $i++){
                        echo '<input type="radio" id="' . $AllIdeas[$i][0] . '" name="ideaSelector" value="' . $AllIdeas[$i][0] . '" >
                              <label for="' . $AllIdeas[$i][0] . '">' . $AllIdeas[$i][1] . ' points requis</label><br/>';
                    }

                ?>
                <input class="roundCornerLink"type="submit" name="action" value="ChoixIdee"/> <br/>
            <?php  }?>
            </form>
            <form id="Create" action="/" method="post">
                <input type="hidden" name="action" value="CreateIdea"/>
            </form>
            <a class="roundCornerLink" href='#' onclick='document.getElementById("Create").submit()'>Créer Une Idée Bonus</a>
            <form id="RetourEvent" action="/" method="post">
                <input type="hidden" name="action" value="PageGestionEvent"/>
            </form>
            <a class="roundCornerLink" href='#' onclick='document.getElementById("RetourEvent").submit()'>Retour</a>
            <form id="Retour" action="/" method="post">
                <input type="hidden" name="action" value="Accueil"/>
            </form>
            <a class="roundCornerLink" href='#' onclick='document.getElementById("Retour").submit()'>Retour à la page principale</a>
            </div>
          </section>
        </main>
            <?php
}
?>
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
