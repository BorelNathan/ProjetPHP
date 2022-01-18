<?php $title='Mon espace perso'?>
<?php ob_start(); ?>
<?php
if ($filter == 1) {        ?>
<h1>PAGE RESERVE AUX ORGANISATEURS</h1>


        </div>


            Nom de l'événement : <?php echo $Event[4] . '</br>'; ?>
            Description de l'événement : <?php echo $Event[5] . '</br>'; ?>
            Points de l'événement : <?php echo $Event[1] . '</br>'; ?>

                Choisissez une idée bonus à modifier : <br/>
            <form action="/" method="POST" name="traitementrequetesideeorganisateur">
                <?php
                if($AllIdeas != null){
                    for ($i = 0; $i < sizeof($AllIdeas); $i++){
                        echo '<input type="radio" id="' . $AllIdeas[$i][0] . '" name="ideaSelector" value="' . $AllIdeas[$i][0] . '" >
                              <label for="' . $AllIdeas[$i][0] . '">' . $AllIdeas[$i][1] . ' points requis pour : ' . $AllIdeas[$i][4] . '</label><br/>';
                    }

                ?>
                <input type="submit" name="action" value="ChoixIdee"/> <br/>
            <?php  }?>
            </form>
            <form id="Create" action="/" method="post">
                <input type="hidden" name="action" value="CreateIdea"/>
            </form>
            <li><a href='#' onclick='document.getElementById("Create").submit()'>Créer Une Idée Bonus</a></li>
            <form id="RetourEvent" action="/" method="post">
                <input type="hidden" name="action" value="PageGestionEvent"/>
            </form>
            <li><a href='#' onclick='document.getElementById("RetourEvent").submit()'>Retour</a></li>
            <form id="Retour" action="/" method="post">
                <input type="hidden" name="action" value="Accueil"/>
            </form>
            <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour à la page principale</a></li>

            </div>
            <?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
