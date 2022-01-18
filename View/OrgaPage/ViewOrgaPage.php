<?php $title='Mon espace perso'?>
<?php ob_start(); ?>
<?php if($filter == 1) {?>


<h1>PAGE RESERVE AUX ORGANISATEURS</h1>



    </div>

<?php
if (IsThereAnEvent($user_id) != false){

    GetEvent($user_id);
?>
        Nom de l'événement : <?php echo $_SESSION['Event'][4] . '</br>';?>
        Description de l'événement : <?php echo $_SESSION['Event'][5] . '</br>';?>
        Points de l'événement : <?php echo $_SESSION['Event'][1] . '</br>';?>
        <form action="/" method="POST" name="traitementrequetesorganisateur">
            Modifier le titre de cet événement : <input type="text" name="eventName" /><br/>
            Modifier la description de cet événement : <textarea type="text" name="eventDescription"></textarea><br/>
            <?php echo $_SESSION['EventChange'] . '</br>'; ?>
            <input type="submit" name="action" value="Modifier un Event"/> <br/>
        </form>
        <form id="Event" action="/" method="post">
            <input type="hidden" name="action" value="MonEvent"/>
        </form>
        <li><a href='#' onclick='document.getElementById("Event").submit()'>Consulter ma page d'événement</a></li>
        <form id="GestionIdee" action="/" method="post">
            <input type="hidden" name="action" value="GestIdee"/>
        </form>
        <li><a href='#' onclick='document.getElementById("GestionIdee").submit()'>Page de gestion des idées bonus</a></li>
        <form id="Retour" action="/" method="post">
            <input type="hidden" name="action" value="Accueil"/>
        </form>
        <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a></li>

    </div>


<?php
  }
else {
?>
      <form action="/" method="POST" name="ajoutevent">
          Titre de l'événement : <input type="text" name="EventTitle" required="required"/><br/>
          Description de l'événement : <textarea type="text" name="EventDescription" required="required"></textarea><br/>
          <?php echo $_SESSION['MsgEvent'] ; ?>
          <input type="submit" name="action" value="Créer un événement"/> <br>
      </form>

      <form id="Retour" action="/" method="post">
          <input type="hidden" name="action" value="Accueil"/>
      </form>
      <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a></li>


<?php }
}
else {?>
    <h3> Tu n'as pas le droit de créer d'événements </h3>
    <form id="Retour" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
    </form>
    <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour</a></li>

<?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
