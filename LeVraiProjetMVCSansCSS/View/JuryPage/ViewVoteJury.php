<?php $title='Mon espace perso'?>

<?php ob_start(); ?>
<?php
if ($filter == 1){

    GetEventsFromCampagneId($_SESSION['EndedCampChoice']);
    $Events = $_SESSION['EventsFromCampagne'];
    GetCampagneFromId($_SESSION['EndedCampChoice']);
    $Camp = $_SESSION['CampagneChoisie'];
    if($Events != false){
      echo 'Présentation des événements ayant atteint le nombre de points requis : <br/>';
      for ($i = 0; $i < sizeof($Events); $i++){
          if ($Camp[4] <= $Events[$i][1]){
              echo 'Titre : ' . $Events[$i][4] . '<br/> Description : ' . $Events[$i][5] . '<br/>';
                  if ($Events[$i][6] == 1){
                      echo 'Déjà mis en avant par un jury <br/><br/>';
                  }
                  else{
                      echo '<br/>';
              }

          }
      }

    echo 'Présentation des événements n\'ayant pas atteint le nombre de points requis : <br/>';
    for ($i = 0; $i < sizeof($Events); $i++) {
        if ($Camp[4] > $Events[$i][1]) {
            echo 'Titre : ' . $Events[$i][4] . '<br/> Description : ' . $Events[$i][5] . '<br/>';
            if ($Events[$i][6] == 1) {
                echo 'Déjà mis en avant par un jury <br/><br/>';
            } else {
                echo '<br/>';
            }
        }
    }
    ?>


    <form action="/" method = post name="eventupvote">
        <?php
        $Message = 'Tout les événements ont déjà été mis en avant ! <br/>';
        for ($i = 0; $i < sizeof($Events); $i++){
            if ($Events[$i][6] != 1){
                $Message = 'Maintenant vous pouvez voter pour mettre en avant un événement : <br/>';
                break;
            }
        }
        echo $Message;
            for ($i = 0; $i < sizeof($Events); $i++){
                if ($Events[$i][6] != 1){
                    echo '<input type="radio" id="' . $Events[$i][0] . '" name="eventChoice" value="' . $Events[$i][0] . '" >
                      <label for="' . $Events[$i][0] . '">Titre : ' . $Events[$i][4] . '</label><br/>';
                }
            }
        ?>
    </br>
    <input type="submit" name="action" value="Vote du Jury"/> <br/>
    </form>
    <form id="Retour" action="/" method="post">
        <input type="hidden" name="action" value="Accueil"/>
    </form>
    <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour a la page principaler</a></li>

    <?php }
    else{
      echo 'Mon pauvre ...';?>
      <form id="Retour" action="/" method="post">
          <input type="hidden" name="action" value="Accueil"/>
      </form>
      <li><a href='#' onclick='document.getElementById("Retour").submit()'>Retour a la page principaler</a></li>

    <?php } ?>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
