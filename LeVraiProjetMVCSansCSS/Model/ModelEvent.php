<?php

Class EventManager{

  private function dbConnect(){
    $db = new PDO('mysql:host=mysql-e-eventio.alwaysdata.net;dbname=e-eventio_sql;charset=utf8','e-eventio_login','php123456$');

    return $db;
  }

  public function selectEventByUser($user_id){
    $db = $this->dbConnect();
    $event = $db->query("SELECT * FROM event WHERE id_user =  '" . $user_id . "'");

    return $event;
  }

  public function insertEvent($Campagne,$user_id,$title,$description){
    $db = $this->dbConnect();
    $event = $db->query("INSERT INTO event(id_campagne, id_user, titre, description) VALUES('$Campagne' " . "," . " '$user_id' " . "," . " '$title' " . "," . " '$description')");

    return $event;
  }

  public function updateTitle($EventTitle){
    $db = $this->dbConnect();
    $event = $db->query("UPDATE event SET titre = '" . $EventTitle . "' WHERE id_event =  '" . $_SESSION['Event'][0]  . "'");

    return $event;
  }

  public function updateDescription($EventDescription){
    $db = $this->dbConnect();
    $event = $db->query("UPDATE event SET description = '" . $EventDescription . "' WHERE id_event =  '" . $_SESSION['Event'][0]  . "'");

    return $event;
  }

  public function updateTitleDescription($EventTitle,$EventDescription){
    $db = $this->dbConnect();
    $event = $db->query( "UPDATE event SET titre = '" . $EventTitle . "', description ='" . $EventDescription . "' WHERE id_event =  '" . $_SESSION['Event'][0]  . "'");

    return $event;
  }

  public function updateJuryVote($EventUp){
    $db = $this->dbConnect();
    $event = $db->query("UPDATE event SET jury_vote ='1' WHERE id_event='" . $EventUp . "'");

    return $event;
  }
}
?>
