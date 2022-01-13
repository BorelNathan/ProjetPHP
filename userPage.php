<?php
  session_start();
  require 'utils.inc.php';
  start_page('Mon profil');
  $UtilisateurCourantNom = $_SESSION['CurrentUserName'];
  $UtilisateurCourantIDRole = $_SESSION['CurrentUserIDRole'];
  $InfoBack = $_SESSION['userPage'];
  echo $UtilisateurCourantNom . '</br>';

  if($UtilisateurCourantIDRole == 4){
   echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
        Changé son login : <input type="text" name="NewLoginUserPage"></br>











        Entrer son MDP pour valider : <input type="password" name="NewPasswordUserPage"></br>
        <input type="submit" name="action" value="Valider"/><br/>
        ' . '</br>';
        echo $InfoBack . '</br>';


   echo 'gg t admin </br>';
   echo '<a href=gestionUsers.php>Page de gestion</a> </br>';
   $redirectionConnexion = 'logout.php';
   echo '<a href=' . $redirectionConnexion . '>Se deconnecter</a> </br>';
 }
 elseif($UtilisateurCourantIDRole == 3){
   echo 'gg t juge </br>';
   $redirectionConnexion = 'logout.php';
   echo '<a href=' . $redirectionConnexion . '>Se deconnecter</a> </br>';
 }
 elseif($UtilisateurCourantIDRole == 2){
   echo 'gg t organisateur </br>';
   $redirectionConnexion = 'logout.php';
   echo '<a href=' . $redirectionConnexion . '>Se deconnecter</a> </br>';
 }
 elseif($UtilisateurCourantIDRole == 1){
   echo 'gg t donateur </br>';
   $redirectionConnexion = 'logout.php';
   echo '<a href=' . $redirectionConnexion . '>Se deconnecter</a> </br>';
 }
 else{
   echo 't\'es pas connecté :\'( </br>';
   echo '<a href=' . $redirectionInscription . '>S\'inscrire</a> </br> ';
   echo '<a href=' . $redirectionConnexion . '>Se connecter</a> </br>';
 }


























  end_page();

?>
