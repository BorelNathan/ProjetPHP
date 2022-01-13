<?php
  session_start();
  require 'utils.inc.php';
  start_page('Mon profil');
  $UtilisateurCourantNom = $_SESSION['CurrentUserName'];
  $UtilisateurCourantIDRole = $_SESSION['CurrentUserIDRole'];
  $InfoBack = $_SESSION['userPage'];
  $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
  mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
  $query = "SELECT point FROM users WHERE login = '" . $UtilisateurCourantNom . "'";
  $dbResult = mysqli_query($dbLink, $query);
  $dbRow = mysqli_fetch_row($dbResult);
  $NombreDePoint = $dbRow['0'];
  #echo 'Login actuel : ' . $UtilisateurCourantNom . '</br>';

  if($UtilisateurCourantIDRole == 4){
   echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
        Changé son login en : <input type="text" name="NewLoginUserPage"></br>
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
   echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
        Changé son login en : <input type="text" name="NewLoginUserPage"></br>
        Entrer son MDP pour valider : <input type="password" name="NewPasswordUserPage"></br>
        <input type="submit" name="action" value="Valider"/><br/>
        ' . '</br>';
        echo $InfoBack . '</br>';
   echo 'Nombre de points restant : ' . $NombreDePoint . ' </br>';
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
