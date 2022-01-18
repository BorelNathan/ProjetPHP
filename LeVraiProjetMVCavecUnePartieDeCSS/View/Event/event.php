<?php
  require(__DIR__.'/../template.php');
  require_once(__DIR__.'/../../Utils/utils.inc.php');
  session_start();

  $login = $_SESSION['CurrentUserName'];
  $titre = $_SESSION['CurrentEventSee'];
  $pointsToGive = $_POST['pointsToGive'];

  $PointsRestant = GetUserPoints($login);

  if($PointsRestant >= $pointsToGive){

  Donation($pointsToGive, $titre);
  UpdateUserPoints($pointsToGive, $login);
  $PointsRestant = GetUserPoints($login);

  $_SESSION['RetourEvent'] = 'Succes, il vous reste ' . $PointsRestant . ' points';

  header('Location: ViewEvent.php?Event=' . $titre );


  }

  else{
  $_SESSION['RetourEvent'] = 'Vous n\'avez pas asser de point, vous n\'avez que ' . $PointsRestant . ' points';
  header('Location: ViewEvent.php?Event=' . $titre );


  }


?>
