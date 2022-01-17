<?php $title='Page d\'accueil '?>
<?php   $redirectionConnexion = 'logout.php';
  $redirectionIndex = 'index.php';?>
<?php ob_start(); ?>

<?php if($UtilisateurCourantIDRole == 4){ ?>

<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
         Changé son login en : <input type="text" name="NewLoginUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="Change" value="Changer de mot de passe"/>
</form> <br/>';

<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
         Changé son mail en : <input type="text" name="NewMailUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="Change" value="Changer de mail"/>
</form> <br/>';

<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
         Changé son MDP en : <input type="text" name="NewPasswordUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="Change" value="Changer de mot de passe"/>
</form> <br/>
<?php echo $InfoBack; ?> </br>
<p>gg t admin </p></br>
<a href=gestionUsers.php>Page de gestion</a> </br>
<a href=' <?php echo $redirectionConnexion;?> '>Se deconnecter</a> </br>
<a href=' <?php echo $redirectionIndex; ?> '>Retour a la page principale</a> </br>

<?php  }
  elseif($UtilisateurCourantIDRole == 3){ ?>

<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
          Changé son login en : <input type="text" name="NewLoginUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="Change" value="Changer de mot de passe"/>
</form> <br/>

<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
          Changé son mail en : <input type="text" name="NewMailUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="Change" value="Changer de mail"/>
</form> <br/>

<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
          Changé son MDP en : <input type="text" name="NewPasswordUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="Change" value="Changer de mot de passe"/>
</form> <br/>
<?php echo $InfoBack; ?></br>
<p>gg t juge </p></br>
<a href=' <?php echo $redirectionConnexion;?> '>Se deconnecter</a> </br>
<a href=' <?php echo $redirectionIndex; ?> '>Retour a la page principale</a> </br>

<?php }
  elseif($UtilisateurCourantIDRole == 2){ ?>

<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
         Changé son login en : <input type="text" name="NewLoginUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="Change" value="Changer de mot de passe"/>
</form> <br/>

<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
         Changé son mail en : <input type="text" name="NewMailUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="Change" value="Changer de mail"/>
</form> <br/>

<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
         Changé son MDP en : <input type="text" name="NewPasswordUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="Change" value="Changer de mot de passe"/>
</form> <br/>
<?php echo $InfoBack; ?></br>
<p>gg t organisateur </p></br>';
<a href=gestionEvent.php>Page de gestion de tes événements</a> </br>
<a href=' <?php echo $redirectionConnexion;?> '>Se deconnecter</a> </br>
<a href=' <?php echo $redirectionIndex; ?> '>Retour a la page principale</a> </br>

<?php  }
  elseif($UtilisateurCourantIDRole == 1){?>

<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
         Changé son login en : <input type="text" name="NewLoginUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="Change" value="Changer de login"/>
</form> <br/>

<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
         Changé son mail en : <input type="text" name="NewMailUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="Change" value="Changer de mail"/>
</form> <br/>

<form action="processingUserPage.php" method="POST" name="traitementrequetesuser">
         Changé son MDP en : <input type="text" name="NewPasswordUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="Change" value="Changer de mot de passe"/>
</form> <br/>
<?php $InfoBack; ?></br>
    <p>Nombre de points restant : ' . $NombreDePoint . ' </p></br>
    <a href=' <?php echo $redirectionConnexion;?> '>Se deconnecter</a> </br>
    <a href=' <?php echo $redirectionIndex; ?> '>Retour a la page principale</a> </br>

<?php  }
  else{
    header('index.php');
  }?>

<?php $content = ob_get_clean(); ?>

<?php require('/home/owo/www/View/template.php')?>
