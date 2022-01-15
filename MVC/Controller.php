<?php

// Chargement des classes
require('Model.php');

function listEvents()
{
    $Model = new Model(); // Création d'un objet
    $events = $Model->getEvents(); // Appel d'une fonction de cet objet

    require('NoUserView.php');
}


?>