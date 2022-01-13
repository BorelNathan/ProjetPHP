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
          <p>Vous n\'etes pas connecte</p>
          <a href="login.php">Se connecter</a>
          <a href= "Inscription.php" />S\'inscrire</a>
        </section>
        </header>';
}
    else{
      echo 'Connecter en tant que ' . $UtilisateurCourantNom;
      echo '
        <section class="connection" id="connected">
          <a href="userPage.php">Mon espace</a>
          <a href="logout.php"><img id="logout" src="logout.svg" alt="Se déconnecter" /></a>
        </section>
      </header>';
}


  #echo 'Niveau de droit du compte : ' . $UtilisateurCourantIDRole . '</br>';



  end_page();
?>
