<?php
require('Controller.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listEvent') {
            listEvents();
        }
        elseif ($_GET['action'] == 'Event') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                event();
            }
            else {
                throw new Exception('Aucun identifiant d\'événement envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    else {
        listEvents();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

