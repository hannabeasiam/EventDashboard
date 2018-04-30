<?php
  include("inc/dbconnect.php");
  include("inc/functions.php");
  
  include_once("inc/header.php");
  
   // $events = get_row("$query"); 
  if ($_SERVER["REQUEST_METHOD"] == "GET") { 
    $request = trim(filter_input(INPUT_GET, 'event_id'));
    $query = 'SELECT * FROM events WHERE event_id='.$request;
    $events = get_row("$query");  // fetch data

    $query = 'SELECT * FROM event_types WHERE event_type_id='.$events['event_type_id'];
    $event_type = get_row("$query");  // fetch data


  }
  // once form submited
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $event_type_id = $_POST['event_type_id'];
    // quote
    $event_id_q = $db->quote($event_id);
    $event_date_q = $db->quote($event_date);
    $event_location_q = $db->quote($event_location);
    $event_type_id_q = $db->quote($event_type_id);
    // validate user input
    if (empty($event_date)) {
      $validate = false;
      $dateError = 'Event Date is Required Field';
      // set detail date input type validation here
    }
    if (empty($event_location)) {
      $validate = false;
      $locationError = 'Event Location is Required Field';
    }
    /*********************************************
     * validate user input
     *********************************************/
    $parent = "Location: event.php?event_type_id=$event_type_id";
    echo($parent);
    // if user input is not empty, we can update
    // based on request action
    if (isset($_POST['edit'])) {
      $query = "UPDATE events
                SET event_date = $event_date_q, event_location = $event_location_q 
                WHERE event_id = $event_id_q";
      change_table($query, $parent);
      exit;
    }
    /***********for Delete, user input change does not effect ? better way? *********************************************/
    if (isset($_POST['delete'])) {
      $query = "DELETE FROM events
                WHERE event_id = '$event_id'";
  
      change_table($query, $parent);
      exit;
    }
    if (isset($_POST['nevermind'])) {
      header($parent);
    }
  } // close post
  if (!empty($errorMessage)) {
    display_db_error($errorMessage);
  } else {
?>
	<!--main contents-->
	<div class="container">
    
    <table>
      <caption>Events</caption>
      <thead>
        <tr>
          <th>Event ID</th>
          <th>Date</th>
          <th>Description</th>
          <th>Event Type name</th>
        </tr>
      </thead>
      <tbody>
      <?php
       
          echo '<tr>';
          echo '<td>' . $events['event_id'] . '</td>';
          echo '<td class="center" >' . $events['event_date'] . '</td>';
          echo '<td class="center" >' . $event_type['event_type_description'] . '</td>';
          echo '<td class="center" >' . $event_type['event_type_name'] . '</td>';
          echo '</tr>';
        
      ?>
      </tbody>
    </table>
    
      <div>
        <h2>Event EDIT</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="EventItem" method="post">
          <input type="hidden" name="event_id" id="event_id"  value="<?php echo $events['event_id']; ?> "  />
          <input type="hidden" name="event_type_id" id="event_type_id" value="<?php echo $events['event_type_id']; ?>" />
          <lable>Event Date</label>
          <input type="date" name="event_date" id="event_date" value="<?php echo $events['event_date']; ?>" />
          <span class="error"><?php if (isset($dateError)) echo $dateError; ?></span>
          <br/>
          <lable>Event Location</label>
          <input type="text" name="event_location" id="event_location" value="<?php echo $events['event_location']; ?>"  />
          <span class="error"><?php if (isset($locationError)) echo $locationError; ?></span>
          <br/>
          <input type="submit" name="edit" value="Save Change">
          <input type="submit" name="delete" value="Delete">
          <input type="submit" name="nevermind" value="Never Mind">
        </form>
      </div>
    </div>
    <?php
    }
    include_once("inc/footer.php");
    ?>
  </div>
