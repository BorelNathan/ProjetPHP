<?php $title='Mon espace perso'?>

<?php

if ($filter == 1){
    ?>
    Choisissez une des campagnes terminée : <br/>
    <form action="/" method = post name="endedcampagnes">
        <?php
            for ($i = 0; $i < sizeof($EndedCamp); $i++){
                echo '<input type="radio" id="' . $EndedCamp[$i][0] . '" name="campagneChoice" value="' . $EndedCamp[$i][0] . '" >
                      <label for="' . $EndedCamp[$i][0] . '">' . $EndedCamp[$i][7] . ' : ' . $EndedCamp[$i][1] . ' au ' . $EndedCamp[$i][2] .  '</label><br/>';
            }
        ?>
    </br>
    <input type="submit" name="action" value="Choix Jury Campagne"/> <br/>
    </form>
    <form id="Retour" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
    </form>
    <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour a la page principaler</a></li>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
