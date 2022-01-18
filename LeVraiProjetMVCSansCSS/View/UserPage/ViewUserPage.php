<?php $title='Mon espace perso'?>
<?php   $redirectionConnexion = 'Utils/logout.php';
  $redirectionIndex = 'index.php';?>
<?php ob_start(); ?>

<?php if($UtilisateurCourantIDRole == 4){ ?>

<form action="/index.php" method="POST" name="traitementrequetesuser">
         Changé son login en : <input type="text" name="NewLoginUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="action" value="Changer de mot de passe"/>
</form> <br/>

<form action="/index.php" method="POST" name="traitementrequetesuser">
         Changé son mail en : <input type="text" name="NewMailUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="action" value="Changer de mail"/>
</form> <br/>

<form action="/index.php" method="POST" name="traitementrequetesuser">
         Changé son MDP en : <input type="text" name="NewPasswordUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="action" value="Changer de mot de passe"/>
</form> <br/>
<?php echo $InfoBack; ?> </br>
<p>gg t admin </p></br>
<form id="GestUser" action="/" method="post">
    <input type="hidden" name="action" value="PageGestionUser"/>
</form>
<li><a href='#' onclick='document.getElementById("GestUser").submit()'>Page de gestion des utilisateurs</a></li>
<form id="Campagne" action="/" method="post">
    <input type="hidden" name="action" value="PageCampagne"/>
</form>
<li><a href='#' onclick='document.getElementById("Campagne").submit()'>Page de gestion des Campagnes</a></li>
<form id="logout" action="/" method="post">
    <input type="hidden" name="action" value="Deconnexion"/>
</form>
<li><a href='#' onclick='document.getElementById("logout").submit()'>Se deconnecter</a></li>
<form id="Retour" action="/" method="post">
    <input type="hidden" name="action" value="Accueil"/>
</form>
<li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour a la page principaler</a></li>

<?php  }
  elseif($UtilisateurCourantIDRole == 3){ ?>

<form action="/index.php" method="POST" name="traitementrequetesuser">
          Changé son login en : <input type="text" name="NewLoginUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="action" value="Changer de mot de passe"/>
</form> <br/>

<form action="/index.php" method="POST" name="traitementrequetesuser">
          Changé son mail en : <input type="text" name="NewMailUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="action" value="Changer de mail"/>
</form> <br/>

<form action="/index.php" method="POST" name="traitementrequetesuser">
          Changé son MDP en : <input type="text" name="NewPasswordUserPage"></br>
          Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
          <input type="submit" name="action" value="Changer de mot de passe"/>
</form> <br/>
<?php echo $InfoBack; ?></br>
<p>gg t juge </p></br>
<form id="GestVote" action="/" method="post">
    <input type="hidden" name="action" value="GestionVote"/>
</form>
<li><a href='#' onclick='document.getElementById("GestVote").submit()'>Page Gestion Vote</a></li>
<form id="logout" action="/" method="post">
    <input type="hidden" name="action" value="Deconnexion"/>
</form>
<li><a href='#' onclick='document.getElementById("logout").submit()'>Se deconnecter</a></li>
<form id="Retour" action="/" method="post">
    <input type="hidden" name="action" value="Accueil"/>
</form>
<li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour a la page principaler</a></li>

<?php }
  elseif($UtilisateurCourantIDRole == 2){ ?>

<form action="/index.php" method="POST" name="traitementrequetesuser">
         Changé son login en : <input type="text" name="NewLoginUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="action" value="Changer de mot de passe"/>
</form> <br/>

<form action="/index.php" method="POST" name="traitementrequetesuser">
         Changé son mail en : <input type="text" name="NewMailUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="action" value="Changer de mail"/>
</form> <br/>

<form action="/index.php" method="POST" name="traitementrequetesuser">
         Changé son MDP en : <input type="text" name="NewPasswordUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="action" value="Changer de mot de passe"/>
</form> <br/>
<?php echo $InfoBack; ?></br>
<p>gg t organisateur </p></br>';
<form id="GestEvent" action="/" method="post">
    <input type="hidden" name="action" value="PageGestionEvent"/>
</form>
<li><a href='#' onclick='document.getElementById("GestEvent").submit()'>Page de gestion</a></li>
<form id="logout" action="/" method="post">
    <input type="hidden" name="action" value="Deconnexion"/>
</form>
<li><a href='#' onclick='document.getElementById("logout").submit()'>Se deconnecter</a></li>
<form id="Retour" action="/" method="post">
    <input type="hidden" name="action" value="Accueil"/>
</form>
<li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour a la page principaler</a></li>

<?php  }
  elseif($UtilisateurCourantIDRole == 1){?>

<form action="/index.php" method="POST" name="traitementrequetesuser">
         Changé son login en : <input type="text" name="NewLoginUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="action" value="Changer de login"/>
</form> <br/>

<form action="/index.php" method="POST" name="traitementrequetesuser">
         Changé son mail en : <input type="text" name="NewMailUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="action" value="Changer de mail"/>
</form> <br/>

<form action="/index.php" method="POST" name="traitementrequetesuser">
         Changé son MDP en : <input type="text" name="NewPasswordUserPage"></br>
         Entrer son MDP pour valider : <input type="password" name="CurrentPasswordUserPage"></br>
         <input type="submit" name="action" value="Changer de mot de passe"/>
</form> <br/>
<?php echo $InfoBack; ?></br>
    <p>Nombre de points restant : <?php echo $NombreDePoint; ?></p></br>
    <form id="logout" action="/" method="post">
        <input type="hidden" name="action" value="Deconnexion"/>
    </form>
    <li><a href='#' onclick='document.getElementById("logout").submit()'>Se deconnecter</a></li>
    <form id="Retour" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
    </form>
    <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour a la page principaler</a></li>

<?php  } ?>

<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
