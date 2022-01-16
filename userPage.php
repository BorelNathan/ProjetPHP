<?php
  session_start();
  require 'utils.inc.php';
  start_page('Mon profil');
  $redirectionConnexion = 'logout.php';
  $redirectionIndex = 'index.php';
  $UtilisateurCourantNom = $_SESSION['CurrentUserName'];
  $UtilisateurCourantIDRole = $_SESSION['CurrentUserIDRole'];
  $InfoBack = $_SESSION['userPage'];
  $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
  mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
  $query = "SELECT point FROM users WHERE login = '" . $UtilisateurCourantNom . "'";
  $dbResult = mysqli_query($dbLink, $query);
  $dbRow = mysqli_fetch_row($dbResult);
  $NombreDePoint = $dbRow['0'];
  echo 'Login actuel : ' . $UtilisateurCourantNom . '</br>';



  if($UtilisateurCourantIDRole == 4){
    echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
          Changé son login en : <input type="text" name="NewLoginUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="Change" value="Changer de mot de passe"/> </form> <br/>';

    echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
          Changé son mail en : <input type="text" name="NewMailUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="Change" value="Changer de mail"/> </form> <br/>';

    echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
          Changé son MDP en : <input type="text" name="NewPasswordUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="Change" value="Changer de mot de passe"/> </form> <br/>';
          echo $InfoBack . '</br>';
   #echo 'gg t admin </br>';
   echo '<a href=gestionUsers.php>Page de gestion</a> </br>';
   echo '<a href=' . $redirectionConnexion . '>Se deconnecter</a> </br>';
   echo '<a href=' . $redirectionIndex . '>Retour a la page principale</a> </br>';
   }
   elseif($UtilisateurCourantIDRole == 3){
     echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
           Changé son login en : <input type="text" name="NewLoginUserPage"></br>
           Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
           <input type="submit" name="Change" value="Changer de mot de passe"/> </form> <br/>';

     echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
           Changé son mail en : <input type="text" name="NewMailUserPage"></br>
           Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
           <input type="submit" name="Change" value="Changer de mail"/> </form> <br/>';

     echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
           Changé son MDP en : <input type="text" name="NewPasswordUserPage"></br>
           Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
           <input type="submit" name="Change" value="Changer de mot de passe"/> </form> <br/>';
           echo $InfoBack . '</br>';
     #echo 'gg t juge </br>';
     echo '<a href=' . $redirectionConnexion . '>Se deconnecter</a> </br>';
     echo '<a href=' . $redirectionIndex . '>Retour a la page principale</a> </br>';
   }
   elseif($UtilisateurCourantIDRole == 2){
    echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
          Changé son login en : <input type="text" name="NewLoginUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="Change" value="Changer de mot de passe"/> </form> <br/>';

    echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
          Changé son mail en : <input type="text" name="NewMailUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="Change" value="Changer de mail"/> </form> <br/>';

    echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
          Changé son MDP en : <input type="text" name="NewPasswordUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="Change" value="Changer de mot de passe"/> </form> <br/>';
          echo $InfoBack . '</br>';
     #echo 'gg t organisateur </br>';
     echo '<a href=gestionEvent.php>Page de gestion de tes événements</a> </br>';
     echo '<a href=' . $redirectionConnexion . '>Se deconnecter</a> </br>';
     echo '<a href=' . $redirectionIndex . '>Retour a la page principale</a> </br>';
   }
   elseif($UtilisateurCourantIDRole == 1){
    echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
          Changé son login en : <input type="text" name="NewLoginUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="Change" value="Changer de login"/> </form> <br/>';

    echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
          Changé son mail en : <input type="text" name="NewMailUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="Change" value="Changer de mail"/> </form> <br/>';

    echo '<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
          Changé son MDP en : <input type="text" name="NewPasswordUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="Change" value="Changer de mot de passe"/> </form> <br/>';
         echo $InfoBack . '</br>';
     echo 'Nombre de points restant : ' . $NombreDePoint . ' </br>';
     echo '<a href=' . $redirectionConnexion . '>Se deconnecter</a> </br>';
     echo '<a href=' . $redirectionIndex . '>Retour a la page principale</a> </br>';
   }
   else{
     header('index.php');
   }


























  end_page();

?>
