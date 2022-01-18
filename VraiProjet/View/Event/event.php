<?php
  require(__DIR__.'/../template.php');
  require_once(__DIR__.'/../../Utils/utils.inc.php');
  session_start();


  $pointsToGive = $_POST['pointsToGive'];

  Donation($pointsToGive);
  $_SESSION['RetourEvent'] = 'Succes';

?>
