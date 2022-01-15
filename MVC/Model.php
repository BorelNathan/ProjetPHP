<?php
class Model
{
    public function getEvents() {

        $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sÃ©lection de la base : ' . mysqli_error($dbLink));

        $query = 'SELECT * FROM event';

        $dbResult = mysqli_query($dbLink,$query);

        $i = 0;
        while ($dbRow = mysqli_fetch_row($dbResult)){
            $event[$i] = $dbRow;
            $i++;
        }


    return $event;
   }

}


?>
