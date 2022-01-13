<?php
  session_start();
  require 'utils.inc.php';
  $UtilisateurCourantNom = $_SESSION['CurrentUserName'];
  $UtilisateurCourantIDRole = $_SESSION['CurrentUserIDRole'];
  start_page('Page Principale');
  $checkIDrole = recheckRoleID($UtilisateurCourantNom);
  $redirectionInscription = 'Inscription.php';
  $redirectionConnexion = 'login.php';


  if($checkIDrole != $UtilisateurCourantIDRole){
    $UtilisateurCourantIDRole = $checkIDrole;
    $_SESSION['CurrentUserIDRole'] = $checkIDrole;
  }


  echo '
  <header>
    <img id="logo" src="logo.svg" alt="logo de E-Event.IO" />';

    if($UtilisateurCourantIDRole == 0){
      echo '
        <section class="connection" id="notConnected">
  				<p>Vous n\'êtes pas connecté</p>
  				<ul>
  					<li><a href="login.php">Se connecter</a></li>
  					<li><a href= "Inscription.php" />S\'inscrire</a></li>
  				</ul>
        </section>
        </header>';
    }
    else{
      echo '
        <section class="connection" id="connected">
        <p> Connecté en tant que ' . $UtilisateurCourantNom . '</p>
  				<ul>
  					<li><a href="userPage.php">Mon espace</a></li>
  					<li><a href="logout.php" id="logoutli"><img id="logout" src="logout.svg" alt="se d�connecter" /></a></li>
  				</ul>
      </header>';
    }


  #echo 'Niveau de droit du compte : ' . $UtilisateurCourantIDRole . '</br>';



  end_page();
?>
