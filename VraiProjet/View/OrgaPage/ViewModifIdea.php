<?php if($filter == 1) {    ?>
<h1>PAGE RESERVE AUX ORGANISATEURS</h1>
</div>
<?php if ($check = IsThereAnEvent() != false) {
        GetEvent();
        GetIdeeFromId($IdeaChoice);?>
        Nom de l'événement : <?php echo $Event[4] . '</br>'; ?>
        Description de l'événement : <?php echo $Event[5] . '</br>'; ?>
        Points de l'événement : <?php echo $Event[1] . '</br>'; ?><br/>
        Description de l'idée bonus sélectionnée : <?php echo $_SESSION['IdeeChosen'][4] . '<br/>' ?>
        Points nécessaires pour l'idée bonus sélectionnée : <?php echo $_SESSION['IdeeChosen'][1] . '<br/>' ?><br/>
        Choisissez ce que vous voulez modifier : <br/>
        <?php if ($_SESSION['IdeeChosen'][5] != 0) {?>
            Vous ne pouvez plus modifier cette idée car elle a été débloquée
        <?php } else { ?>
            <form action="ideaprocessing.php" method="POST" name="traitementrequetesorganisateur">
                Modifier la description de cette idée : <textarea type="text" name="ideaDescription"></textarea><br/>
                Modifier les points nécessaires: <input type="number" name="ideaPoints"/><br/>' .
                <?php echo $_SESSION['IdeaChange'];?> </br>
                <input type="submit" name="action" value="ModifIdee"/> <br/>
            </form>
        <?php }?>
        <form id="RetourIdee" action="/" method="post">
            <input type="hidden" name="action" value="ChoixIdee"/>
        </form>
        <li><a href='#' onclick='document.getElementById("RetourIdee").submit()'>>Retour à la page précédente</a></li>
        <form id="Retour" action="/" method="post">
            <input type="hidden" name="action" value="Accueil"/>
        </form>
        <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour à la page principale</a></li>

        </div>
        <?php
    }


}
?>
