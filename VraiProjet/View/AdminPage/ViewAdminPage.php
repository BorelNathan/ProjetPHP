<?php $title='Mon espace perso'?>
<?php ob_start(); ?>
<?php if($filter == 1){?>
<h1>PAGE RESERVE AUX ADMINS</h1>

</div>

<form action="admindataprocessing.php" method="POST" name="traitementrequetesadmin">
  Login de l'utilisateur : <input type="text" name="loginUser" required="required"/><br/>
  role_id a appliquer  : <select name="newRoleID"/><br/>
    <option value="">Pas de modification</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select> </br>
  Nouveau login pour l'utilisateur <input type="text" name="newLoginUser"/><br/>
  Nouveau mot de passe pour l'utilisateur <input type="text" name="newPasswordUser"/><br/>
  Nouveau mail pour l'utilisateur <input type="text" name="newMailUser"/><br/>
  <?php echo $_SESSION['UserChange'] . '</br>'; ?>
  <input type="submit" name="action" value="ChangementUtilisateur"/> <br/>
</form>
<form id="Retour" action="/" method="post">
    <input type="hidden" name="action" value=""/>
</form>
<li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a></li>

</div>

<?php } ?>
<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
