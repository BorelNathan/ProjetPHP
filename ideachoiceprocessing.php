<?php
session_start();
require 'utils.inc.php';
$_SESSION['IdeaChoice'] = $_POST['ideaSelector'];
header('Location: gestionIdea.php');
?>