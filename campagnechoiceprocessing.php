<?php
session_start();
require 'utils.inc.php';
$filter = filterUsers(4);
if ($filter == 1) {
    $_SESSION['IdCampagneChoisie'] = $_POST['campagneChoice'];
    header('Location: gestionCampagne.php');
}
?>