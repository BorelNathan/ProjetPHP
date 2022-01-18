<?php

class IdeaManager
{

  private function dbConnect(){
    $db = new PDO('mysql:host=mysql-e-eventio.alwaysdata.net;dbname=e-eventio_sql;charset=utf8','e-eventio_login','php123456$');

    return $db;
  }

  public function insertIdea($Campagne,$point_min,$description,$CurrentEvent){
    $db = $this->dbConnect();
    $idea = $db->query("INSERT INTO idee_bonus (id_campagne, point_requis, description, id_event) VALUES ('$Campagne' " . ',' . " '$point_min'" . ',' . " '$description'" . ',' . " '$CurrentEvent')");

    return $idea;
  }

  public function updateDescriptionIdea($IdeaId,$IdeaDescription){
    $db = $this->dbConnect();
    $idea = $db->query("UPDATE idee_bonus SET description = '". $IdeaDescription ."' WHERE id_idee = " . $IdeaId);

    return $idea;
  }

  public function updatePointRequisIdea($IdeaId,$NbPoints){
    $db = $this->dbConnect();
    $idea = $db->query("UPDATE idee_bonus SET point_requis = " . $NbPoints . " WHERE id_idee = " . $IdeaId);

    return $idea;
  }

  public function selectIdeaByEventIdeaChoice($CurrentEvent,$IdeaChoice){
    $db = $this->dbConnect();
    $idea = $db->query("SELECT * FROM idee_bonus WHERE id_event = " . $CurrentEvent . " AND id_idee = " . $IdeaChoice);

    return $idea;
  }
}

?>
