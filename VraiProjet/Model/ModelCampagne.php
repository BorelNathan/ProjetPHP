<?php

class CamapainManager
{

  private function dbConnect(){
    $db = new PDO('mysql:host=mysql-e-eventio.alwaysdata.net;dbname=e-eventio_sql;charset=utf8','e-eventio_login','php123456$');

    return $db;
  }


  public function IsThereACampain() {
      $today = date('Y-m-d');
      $db = $this->dbConnect();
      $Campain = $db->query("SELECT * FROM campagne WHERE date_deb <= '" . $today . "' AND date_fin >= '" . $today . "'");
      $dbCampagne = $Campain->fetch();
      if ($dbCampagne != false){
          $CurrentCampain = $dbCampagne[0];
          $_SESSION['CampagneActuelle'] = $CurrentCampain;
          return true;
      }
      else {
          return false;
      }
}





}
?>
