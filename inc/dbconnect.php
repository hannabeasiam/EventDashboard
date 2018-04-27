<?php
$servername = 'localhost';
$dbname = 'golf';
$username = 'root';
$password = ''; // change this password to your own 
$dsn = "mysql:host=$servername;dbname=$dbname";

try { 
  $db = new PDO($dsn, $username, $password);
  $errorMessage = ''; // to check db connection works fine 
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // use exception to handle exeptional case (db not connectable)
  $errorMessage = $e->getMessage();
  exit;
}



