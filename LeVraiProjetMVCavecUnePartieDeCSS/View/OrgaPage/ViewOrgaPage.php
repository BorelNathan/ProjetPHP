
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
<?php
if (IsThereAnEvent($user_id) != false){
    GetEvent($user_id);
?>
  <section>
    <h1>PAGE RESERVEE AUX ORGANISATEURS</h1>
    <p>
      Nom de l'événement : <?php echo $_SESSION['Event'][4];?>
    </p>
    <p>
      Description de l'événement : <?php echo $_SESSION['Event'][5];?>
    </p>
    <p>
      Points de l'événement : <?php echo $_SESSION['Event'][1];?>
    </p>
    <form action="/" method="POST" name="traitementrequetesorganisateur">
      <label for="eventName">Modifier le titre de cet événement: <label>
      <input class="roundCornerLink" type="text" name="eventName" />
      <label for="eventDescription">Modifier la description de cet événement: </label>
      <textarea class="roundCornerLink" type="text" name="eventDescription"></textarea><br/>
<?php echo $_SESSION['EventChange'] . '</br>'; ?>
            <input class="roundCornerLink" type="submit" name="action" value="Modifier un Event"/> <br/>
        </form>
        <form id="Event" action="/" method="post">
            <input class="roundCornerLink" type="hidden" name="action" value="MonEvent"/>
        </form>
        <a class="roundCornerLink" href='#' onclick='document.getElementById("Event").submit()'>Consulter ma page d'événement</a>
        <form id="GestionIdee" action="/" method="post">
            <input type="hidden" name="action" value="GestIdee"/>
        </form>
        <a class="roundCornerLink" href='#' onclick='document.getElementById("GestionIdee").submit()'>Page de gestion des idées bonus</a>
        <form id="Retour" action="/" method="post">
            <input type="hidden" name="action" value="Accueil"/>
        </form>
        <a class="roundCornerLink"href='#' onclick='document.getElementById("Retour").submit()'>Retour</a>
    </section>


<?php
  }
else {
?>
<main id="adminMain">
  <section>
    <form action="/" method="POST" name="ajoutevent">
      <label for="EventTitle">Titre de l'événement: </label>
      <input class="roundCornerLink" type="text" name="EventTitle" required="required"/>
        <label for="EventDescription">Description de l'événement: </label>
        <textarea class="roundCornerLink" type="text" name="EventDescription" required="required"></textarea>
<?php echo $_SESSION['MsgEvent'] ; ?>
        <input class="roundCornerLink" type="submit" name="action" value="Créer un événement"/> <br>
      </form>
      <form id="Retour" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
      </form>
      <a class="roundCornerLink" href='#' onclick='document.getElementById("Retour").submit()'>Retour</a>
  </section>

<?php }
}
else {?>
<main id="adminMain">
  <section>
    <h1> Tu n'as pas le droit de créer d'événements </h1>
    <form id="Retour" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
    </form>
    <a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a>
  </section>

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
