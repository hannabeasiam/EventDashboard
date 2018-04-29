<?php
    require("inc/functions.php");
    $query = 'SELECT * FROM events WHERE event_type_id='.$event_types['event_type_id'];
    $events = get_table($query);

  if (!empty($errorMessage)) {
    display_db_error($errorMessage);
  } else {
?>
	<!--main contents-->
	<div class="col">
    <table>
      <caption>Events</caption>
      <thead>
        <tr>
          <th>event_id</th>
          <th>event_date</th>
          <th>event_location</th>
          <th><a href="addEventItem.php?event_type_id=<?php echo $type['event_type_id']; ?>" >Add Event</a></th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($events as $event) {
          echo '<tr>';
          echo '<td>' . $event['event_id'] . '</td>';
          echo '<td>' . $event['event_date'] . '</td>';
          echo '<td>' . $event['event_location'] . '</td>';
          echo '<td>' . '<a href="eventItem.php?event_id=' . $event['event_id'] . '">Edit</a> | <a href="eventItem.php?event_id=' . $event['event_id'] . '">Delete</a></td>';
          echo '</tr>';
        }
      ?>
      </tbody>
    </table>
    <?php
    }
    ?>
  </div>
