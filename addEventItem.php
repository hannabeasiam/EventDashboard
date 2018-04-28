<?php
  include("inc/dbconnect.php");
  include_once("inc/functions.php");
 
  $firstTime = $_SERVER["REQUEST_METHOD"] != 'POST'; // use this later
  // Once form posted, add data into database
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $event_type_id = $_POST['event_type_id'];

    $validate = true;
    /*********************************************
     * validate user input
     * 
     *********************************************/

    if (empty($event_date)) {
      $validate = false;
      $dateError = 'Event Date is Required Field';
      // set detail date input type validation here
    }
    if (empty($event_location)) {
      $validate = false;
      $locationError = 'Event Location is Required Field';
    }

    if ($validate != false) {
      // insert posetd value
      $query = "INSERT INTO events (event_date, event_location)
      VALUES ('$event_date', '$event_location')";
      $insert_count = $db->exec($query);
      if ($insert_count < 1) {
        $errorMessage = 'Error Occured In Event Add.';
      } else {
        $path = 'Location: event.php?event_type_id='.$event_type_id;
        header("$path");
      }
    }
    
  } // close post
  
  $title = 'Add Event';
  include_once("inc/header.php");
?>
<div class="container">
  <h2>Event Form</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addEventItem" method="post">
    <input type="hidden" name="event_id" id="event_id"  value="<?php echo $_GET['event_id']; ?>"  />
    <input type="hidden" name="event_type_id" id="event_type_id" value="<?php echo $_GET['event_type_id']; ?>" />
    <lable>Event Date</label>
    <input type="date" name="event_date" id="event_date" />
    <span class="error"><?php if (isset($dateError)) echo $dateError; ?></span>
    <br/>
    <lable>Event Location</label>
    <input type="text" name="event_location" id="event_location" />
    <span class="error"><?php if (isset($locationError)) echo $locationError; ?></span>
    <br/>
    <input type="submit" id="addEvent" name="addEvent" value="Add Event">
  </form>
</div>
<?php 
  include_once("inc/footer.php"); 
  include("dbclose.php"); 
?>
