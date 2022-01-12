<?php
  session_start();
  require 'utils.inc.php';
  $filter = filterUsers(4);
  if($filter == 1){
    start_page('Gestionnaire des utilisateurs');
    echo '<h1>PAGE RESERVE AUX ADMINS</h1>';
    ?>

  </div>

  <form action="admindataprocessing.php" method="POST" name="traitementrequetesadmin">
    Login de l'utilisateur : <input type="text" name="loginUser" required="required"/><br/>
    role_id a appliquer  : <select name="newRoleID"/><br/>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select> </br>
    Nouveau login pour l'utilisateur <input type="text" name="newloginUser"/><br/>  
    <?php echo $_SESSION['UserChangeRoleID'] . '</br>'; ?>
    <input type="submit" name="action" value="Valider"/> <br/>
  </form>
  <a href="index.php">Retour</a>

  </div>


<?php
    end_page();
  }
?>
