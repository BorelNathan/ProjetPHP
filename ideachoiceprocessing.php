<?php
session_start();
require 'utils.inc.php';
$filter = filterUsers(2);
if ($filter == 1) {
    $_SESSION['IdeaChoice'] = $_POST['ideaSelector'];
    header('Location: gestionIdea.php');
}
?>