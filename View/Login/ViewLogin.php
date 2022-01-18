<?php $title='Login'?>
<?php ob_start(); ?>
<div id=container><div class="formname">

  <h2> Se connecter </h2>


</div>

<form action="/" method="POST" name="formulairedelogin">
  Identifiant : <input type="text" name="login"/><br/>
  Mot de passe  : <input type="password" name="motdepasse"/><br/>
  <?php echo $_SESSION['error'] ; ?>
  <input type="submit" name="action" value="Se connecter"/><br/>
</form>
<form id="MDP" action="/" method="post">
    <input type="hidden" name="action" value="MDP"/>
</form>
<a href='#' onclick='document.getElementById("MDP").submit()'>Changé de mot de passe</a>

</div>
<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
