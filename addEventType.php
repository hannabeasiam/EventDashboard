<?php
  include("inc/dbconnect.php");
  include_once("inc/functions.php");
  // Once form posted, add data into database
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $et_name = $_POST['et_name'];
    $et_description = $_POST['et_description'];
    $validate = true;
    /*********************************************
     * validate user input
     *********************************************/
    if (empty($et_name)) {
      $validate = false;
      $nameError = 'Event Type Name is Required Field';
    }
    if (empty($et_description)) {
      $validate = false;
      $descriptionError = 'Event Type Description is Required Field';
    }
    if ( $validate == true) {
      // use prepare, prevent XSS or SQL injection attact, had error text with quote
      // insert posetd value
      $query = 'INSERT INTO event_types (event_type_name, event_type_description)
      VALUES (:et_name, :et_description)';
      $statement = $db->prepare($query);
      $statement->bindValue(':et_name',$et_name);
      $statement->bindValue(':et_description',$et_description);
      $success = $statement->execute();
      $statement->closeCursor();
      // get the last event type DI that was automatically generated
      $et_id = $db->lastInsertID();
      if ($success == false) {
        $errorMessage = 'Error Occured In Event Types Add.';
        display_db_error($errorMessage);
      } else {
      // Redirect to parents page
        header('Location: eventType.php');
      }
    }
    
  } // close post
  
  $title = 'Add Event Type';
  include_once("inc/header.php");
?>
<div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="add_et" method="post">
    <lable>Event Type Name</label>
    <input type="text" name="et_name" id="et_name" />
    <span class="error"><?php if (isset($nameError)) echo $nameError; ?></span>
    <br/>
    <lable>Event Type Description</label>
    <input type="text" name="et_description" id="et_description" />
    <span class="error"><?php if (isset($descriptionError)) echo $descriptionError; ?></span>
    <br/>
    <input type="submit" value="Add Event Type">
  </form>
</div>
<?php 
  include_once("inc/footer.php"); 
  db_close();
?>