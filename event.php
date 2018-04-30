<?php
  include("inc/dbconnect.php");
  include("inc/functions.php");
  $title = 'Event';
  $parent = "Location: eventType.php";
  // I can set title and parent with post here

  include_once("inc/header.php");
  $parent = "Location: eventType.php";
  if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    $request = trim(filter_input(INPUT_GET, 'event_type_id'));
    $query = "SELECT * FROM event_types WHERE event_type_id=$request";
    // echo($query);
    
    $event_types = get_row("$query");  // fetch data

    
  }
  echo'<pre>';
  print_r($event_types);
  echo'</pre>';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $et_id = $_POST['et_id'];
    $et_name = $_POST['et_name'];
    $et_description = $_POST['et_description'];
    
    if (empty($et_name)) {
      $validate = false;
      $nameError = 'Event Type Name is Required Field';
    }
    if (empty($et_description)) {
      $validate = false;
      $descriptionError = 'Event Type Description is Required Field';
    }
    /*********************************************
     * validate user input
     *********************************************/
    $et_id_q = $db->quote($et_id);
    $et_name_q = $db->quote($et_name);
    $et_description_q = $db->quote($et_description);
    // if user input is not empty, we can update
    // based on request action
    if (isset($_POST['edit'])) {
      
      // quote parameters
      $query = "UPDATE event_types
                SET event_type_name = $et_name_q, event_type_description = $et_description_q 
                WHERE event_type_id = $et_id_q";
      $update_count = $db->exec($query);
      header("Location: eventType.php");
      //change_table($query, $parent);
      exit;
    }
    /***********for Delete, user input change does not effect ? better way? 
     *  Not only delete update for event_types, also events table as well
     * *********************************************/
    if (isset($_POST['delete'])) {
      $parent = "Location: eventType.php";
      $query = "DELETE FROM event_types
                WHERE event_type_id=$et_id_q";
  
      change_table($query, $parent);
      //exit;
    }
    if (isset($_POST['nevermind'])) {
      header("Location: eventType.php");
    }
  } // close post

  if (!empty($errorMessage)) {
    display_db_error($errorMessage);
  } else {
?>
<div class="container col">
  <h1>Each Event Type page with List of Events</h1>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="event" method="post">
  <!--This line Should Be deleted later--> <p>Event Type ID : <?php echo $event_types['event_type_id']; ?></p>
    <input type="hidden" name="et_id" id="et_id" value="<?php echo $event_types['event_type_id']; ?>" />
    <lable>Event Type Name</label>
    <input type="text" name="et_name" id="et_name" value="<?php echo $event_types['event_type_name']; ?>"/>
    <span class="error"><?php if (isset($nameError)) echo $nameError; ?></span>
    <br/>
    <lable>Event Type Description</label>
    <input type="text" name="et_description" id="et_description" value="<?php echo $event_types['event_type_description']; ?>"/>
    <span class="error"><?php if (isset($descriptionError)) echo $descriptionError; ?></span>
    <br/>
    <input type="submit" name="edit" value="Save Change">
    <input type="submit" name="delete" value="Delete">
    <input type="submit" name="nevermind" value="Never Mind">
  </form>
</div>
	<!--main contents-->
	<div class="container col">
    <table>
      <caption>Events</caption>
      <thead>
        <tr>
          <th>Event Type</th>
          <th>Event ID</th>
          <th>Date</th>
          <th>Location</th>
          <th class="center"><a class="addButton" href="addEventItem.php?event_type_id=<?php echo $event_types['event_type_id']; ?>">+ Event</a></th>
          <!--event type id from either events, or event type -->
        </tr>
      </thead>
      <tbody>
      <?php
  

      $query = 'SELECT * FROM events WHERE event_type_id='.$event_types['event_type_id'];
      $events = get_table($query);
       //echo'<pre>';
       //print_r($events);
       //echo'</pre>';
      foreach ($events as $event) {
        echo '<tr>';
        echo '<td>' . $event['event_type_id'] . '</td>';
        echo '<td>' . $event['event_id'] . '</td>';
        echo '<td>' . $event['event_date'] . '</td>';
        echo '<td class="center">' . $event['event_location'] . '</td>';
        echo '<td class="center">' . '<a class="button" href="eventItem.php?event_type_id='.$event['event_type_id'].'&event_id='. $event['event_id'] .'">Customize</a></td>';
        echo '</tr>';
      }
    }
      ?>
      </tbody>
    </table>
  </div>
<?php 

  
  include_once("inc/footer.php"); 
  // include("dbclose.php"); 
?>