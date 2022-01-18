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

    public function insertCampagne($date_deb, $date_fin, $points_attribués, $points_requis, $description,$TitreCamp){
          $can_create = true;

          $db = $this->dbConnect();
          $AllCampain = $db->query("INSERT INTO campagne (date_deb, date_fin, point_attribué, point_min, description, titre) VALUES
                              ('" . $date_deb . "' , '" .  $date_fin . "' , " .  $points_attribués . "," . $points_requis . ",'" . $description . "','" . $TitreCamp . "')");
    }

    public function CheckCampagne($date_deb, $date_fin){
          $db = $this->dbConnect();
          $AllCampagne = $db->query("SELECT * FROM campagne");
              while ($dbRow = $AllCampagne->fetch())
              {
                  if ($dbRow[1] <= $date_deb && $dbRow[2] >= $date_deb) {
                      return false;
                      exit();
                  }
                  elseif ($dbRow[1] <= $date_fin && $dbRow[2] >= $date_fin){
                      return false;
                      exit();
                  }
                  elseif ($dbRow[1] >= $date_deb && $dbRow[1] <= $date_fin){
                      return false;
                      exit();
                  }
                  elseif ($dbRow[2] >= $date_deb && $dbRow[2] <= $date_fin){
                      return false;
                      exit();
                  }
                  elseif ($dbRow[1] == $date_deb && $dbRow[2] == $date_fin){
                      return false;
                      exit();
                  }
              }
          return true;
      }

      public function CheckCampagneWithId($date_deb, $date_fin,$CampId){
            $db = $this->dbConnect();
            $AllCampagne = $db->query("SELECT * FROM campagne");
                while ($dbRow = $AllCampagne->fetch())
                {
                  if($dbRow[0] != $CampId){
                    if ($dbRow[1] <= $date_deb && $dbRow[2] >= $date_deb) {
                        return false;
                        exit();
                    }
                    elseif ($dbRow[1] <= $date_fin && $dbRow[2] >= $date_fin){
                        return false;
                        exit();
                    }
                    elseif ($dbRow[1] >= $date_deb && $dbRow[1] <= $date_fin){
                        return false;
                        exit();
                    }
                    elseif ($dbRow[2] >= $date_deb && $dbRow[2] <= $date_fin){
                        return false;
                        exit();
                    }
                    elseif ($dbRow[1] == $date_deb && $dbRow[2] == $date_fin){
                        return false;
                        exit();
                    }
                  }
                }
            return true;
        }

      public function updateTitreCampagne($CampTitle,$CampId){
        $db = $this->dbConnect();
        $verif = $db->query("UPDATE campagne SET titre = '" . $CampTitle . "' WHERE id_campagne =  " . $CampId);

        return $verif;
      }

      public function updateDescriptionCampagne($CampDescription,$CampId){
        $db = $this->dbConnect();
        $verif = $db->query("UPDATE campagne SET description = '" . $CampDescription . "' WHERE id_campagne =  " . $CampId);

        return $verif;
      }

      public function updatePointMinCampagne($CampMinPoints,$CampId){
        $db = $this->dbConnect();
        $verif = $db->query("UPDATE campagne SET point_min = '" . $CampMinPoints . "' WHERE id_campagne =  " . $CampId);

        return $verif;
      }

      public function updateDateDebDateFin($CampDateDeb,$CampDateFin,$CampId){
        $db = $this->dbConnect();
        $verif = $db->query("UPDATE campagne SET date_deb = '" . $CampDateDeb . "', date_fin = '". $CampDateFin . "' WHERE id_campagne =  " . $CampId);

        return $verif;
      }

      public function updateDateDeb($CampDateDeb,$CampId){
        $db = $this->dbConnect();
        $verif = $db->query("UPDATE campagne SET date_deb = '" . $CampDateDeb . "' WHERE id_campagne =  " . $CampId);

        return $verif;
      }

      public function updateDateFin($CampDateFin,$CampId){
        $db = $this->dbConnect();
        $verif = $db->query("UPDATE campagne SET date_fin = '" . $CampDateFin . "' WHERE id_campagne =  " . $CampId);

        return $verif;
      }
}
?>
