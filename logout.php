<?php
  require 'utils.inc.php';
  start_page('logout');
  session_start();
  unset($_SESSION);
  session_destroy();
  session_write_close();
  header('Location: index.php');
  die;
  end_page();
?>
