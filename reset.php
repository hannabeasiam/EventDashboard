<?php
  include_once("inc/functions.php");
  $drop = 'DROP DATABASE IF EXISTS golf;';
  $parent = 'Location: eventType.php';
  change_table($drop, $parent);
  exit;
?>