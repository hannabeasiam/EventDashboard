<?php
//connect db, passing queary as parameter must initialize query before call this function
function get_table($query) {
  include("dbconnect.php");
  try {
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
  } catch (PDOException $e) {
    $errorMessage = $e->getMessage();
    exit;
  }
  return $result;
}

// instead of fetch all, returns an array for the next row in the result set
function get_row($query) {
  include("dbconnect.php");
  try {
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
  } catch (PDOException $e) {
    $errorMessage = $e->getMessage();
    exit;
  }
  return $result;
}

/**
 * Update & Delete table both can use this paty, 
 * $query : declare before call this function
 * $parent : parent path  , default index page
 */

function change_table($query, $parent) {
  include("dbconnect.php");
  if (empty($errorMessage)) { 
    try {
      $statement = $db->prepare($query);
      $statement->execute();
      $statement->closeCursor();
      // redirect to parent page defalt to index
      if (empty($parent)) {
        header('Location: index.php');
      }
      header("$parent");
    } catch (PDOException $e) {
      $errorMessage = $e->getMessage();
    }
  }
}
function display_db_error($errorMessage) {
  include("dbconnect.php"); /********** should I add this here? **********/
  echo '<aside>';
  echo '<ul>';
  echo "<li>$errorMessage</li>";
  echo '</aside>';
}

function db_close() {
  include("dbconnect.php"); /********** should I add this here? **********/
  $db = NULL;
}
?>