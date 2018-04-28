<?php
$servername = 'localhost';
// $dbname = 'golf';
$username = 'root';
$password = ''; // change this password to your own  dbname=$dbname 
$dsn = "mysql:host=$servername;";

try { 
  $db = new PDO($dsn, $username, $password);
  $errorMessage = ''; // to check db connection works fine 
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  // call sql file here
  $buildDB = file_get_contents("db.sql");
  $db->exec($buildDB);
} catch (PDOException $e) {
  // use exception to handle exeptional case (db not connectable)
  $errorMessage = $e->getMessage();
  exit;
}



