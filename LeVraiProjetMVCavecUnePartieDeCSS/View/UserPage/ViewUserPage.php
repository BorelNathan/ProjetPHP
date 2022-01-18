<?php $title='Mon espace perso'?>
<?php   $redirectionConnexion = 'Utils/logout.php';
  $redirectionIndex = 'index.php';?>
<?php
    $role = "";
    switch ($UtilisateurCourantIDRole) {
        case 4:
            $role = "Administrateur";
            break;
        case 3:
            $role = "Jury";
            break;
        case 2:
            $role = "Organisateur";
            break;
        case 1:
            $role = "Donateur";
            break;
    }

    $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
          mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
    $query = "SELECT * FROM users WHERE login =  '" . $UtilisateurCourantNom  . "'";
    $dbResult = mysqli_query($dbLink, $query);
    $dbRow = mysqli_fetch_row($dbResult);
    $email = $dbRow['1'];
?>
<?php ob_start(); ?>
<header>
  	<img id="logo" src="../../resources/images/logo.svg" alt="logo de E-Event.IO" />
    <section class="connection" id="connected">
        <form id="Deco" action="/" method="post">
            <input type="hidden" name="action" value="Deconnexion"/>
        </form>
		<ul>
            <li><a href='#' onclick='document.getElementById("Deco").submit()' id="logoutli"><img id="logout" src="../../resources/images/logout.svg" alt="se déconnecter" /></a></li>
  		</ul>
	</section>
</header>
<main id="userInfosMain">
    <section>
        <div class="infosUser">
            <p>
                Informations personnelles
            </p>
            <p>
            Votre nom d'utilisateur : <?php echo $UtilisateurCourantNom; ?> <br />
            Votre adresse mail : <?php echo $email; ?><br/>
            Votre rôle : <?php echo $role; ?>
            <?php
                if ($UtilisateurCourantIDRole == 1) {
                    echo '<br />Nombre de points à distribuer restants: '.$NombreDePoint;
                }
            ?>
            </p>
        </div>
        <div id="userModifiers">
        <div class="infosUser">
            <p>
                Changer de login
            </p>
            <form action="/index.php" method="POST" name="traitementrequetesuser">
                <label for="NewLoginUserPage">Nouveau nom d'utilisateur: </label>
                <input class="roundCornerLink" type="text" name="NewLoginUserPage">
                <label for="CurrentPasswordUserPage">Mot de passe: </label>
                <input class="roundCornerLink" type="password" name="CurrentPasswordUserPage">
                <input class="roundCornerLink" type="submit" name="action" value="Changer de nom d'utilisateur"/>
            </form>
        </div>
        <div class="infosUser">
            <p>
                Changer d'adresse mail
            </p>
            <form action="/index.php" method="POST" name="traitementrequetesuser">
                <label for="NewMailUserPage">Nouvelle adresse mail: </label>
                <input class="roundCornerLink" type="text" name="NewMailUserPage">
                <label for="CurrentPasswordUserPage">Mot de passe: </label>
                <input class="roundCornerLink" type="password" name="CurrentPasswordUserPage">
                <input class="roundCornerLink" type="submit" name="action" value="Changer d'adresse mail"/>
            </form>
        </div>
        <div class="infosUser">
            <p>
                Changer de mot de passe
            </p>
            <form action="/index.php" method="POST" name="traitementrequetesuser">
                <label for="NewPasswordUserPage">Nouveau mot de passe: </label>
                <input class="roundCornerLink" type="text" name="NewPasswordUserPage">
                <label for="CurrentPasswordUser">Mot de passe actuel: </label>
                <input class="roundCornerLink" type="password" name="CurrentPasswordUserPage">
                <input class="roundCornerLink" type="submit" name="action" value="Changer de mot de passe"/>
            </form>
        </div>
        </div>


<?php echo $InfoBack; ?> </br>
<?php
    if ($UtilisateurCourantIDRole == 4) {?>
        <form id="GestUser" action="/" method="post">
            <input type="hidden" name="action" value="PageGestionUser"/>
        </form>
        <a class="roundCornerLink" href='#' onclick='document.getElementById("GestUser").submit()'>Page de gestion</a>
        <form id="Campagne" action="/" method="post">
            <input type="hidden" name="action" value="PageCampagne"/>
        </form>
        <a class="roundCornerLink" href='#' onclick='document.getElementById("Campagne").submit()'>Page de gestion des Campagnes</a>
    <?php }
    elseif ($UtilisateurCourantIDRole == 2) { ?>
      <form id="GestEvent" action="/" method="post">
          <input type="hidden" name="action" value="PageGestionEvent"/>
      </form>
      <a class="roundCornerLink" href='#' onclick='document.getElementById("GestEvent").submit()'>Page de gestion</a>
    <?php }
    elseif ($UtilisateurCourantIDRole == 3) {?>
      <form id="GestVote" action="/" method="post">
          <input type="hidden" name="action" value="GestionVote"/>
      </form>
      <a class="roundCornerLink" href='#' onclick='document.getElementById("GestVote").submit()'>Page Gestion Vote</a><
    <?php }?>
<form id="Retour" action="/" method="post">
    <input type="hidden" name="action" value="Accueil"/>
</form>
<a class="roundCornerLink" href='#' onclick='document.getElementById("Retour").submit()'>Retour a la page principale</a>
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
