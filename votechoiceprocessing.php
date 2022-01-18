<?php
session_start();
require 'utils.inc.php';
$filter = filterUsers(3);
if ($filter == 1) {
    $_SESSION['EndedCampChoice'] = $_POST['campagneChoice'];
    header('Location: juryVote.php');
}