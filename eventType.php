<?php
  include_once("inc/functions.php");
  $query = 'SELECT * FROM event_types ORDER BY event_type_name';
  $event_types = get_table($query);
  // Define title & parents path
  if (isset($_GET['eventType'])) { // EventType page
    if($_GET['eventType'] == 'addEventType') {
      $title = 'Add Event Type';
      $parent = 'eventType.php';
    } else if($_GET['eventType'] == 'Customize') {
      $title = 'Customize Event Type';
      $parent = 'eventType.php';
    } else {
      $title = 'Event Type';
      $parent = 'index.php';
    }
  } 
  include_once("inc/header.php");
?>
	<!--main contents-->
	<div class="container">
    <h1>Event Type First Page</h1>
    <p><a class="resetButton" href="reset.php">Reset DB</a></p>
    <!--add lookup page here button click triger page move to search.php-->

    <!--current invoice list here call display dashboard part-->
    <?php
    if (!empty($errorMessage)) {
      display_db_error($errorMessage);
    } else {
    ?>
    <table>
      <thead>
        <tr>
          <th>Event Type ID</th>
          <th>Event Name</th>
          <th>Description</th>
          <th class="center"><a class="addButton" href="addEventType.php">+ Event Type</a></th>
        </tr>
      </thead>
      <tbody>
      <?php
        foreach ($event_types as $type) {
          echo '<tr>';
          echo '<td>' . $type['event_type_id'] . '</td>';
          echo '<td>' . $type['event_type_name'] . '</td>';
          echo '<td>' . $type['event_type_description'] . '</td>';
          // echo '<td>' . '<a href="invoiceEdit.php?invoice_id=' . $invoices['invoice_id'] . '">Edit</a> | <a href="invoiceDelete.php?invoice_id=' . $invoices['invoice_id'] . '">Delete</a></td>';
          echo '<td class="center">' . '<a class="button" href="event.php?event_type_id=' . $type['event_type_id'] . '">Customize</a></td>';          
          echo '</tr>';
        }
      ?>
      </tbody>
    </table>
    <?php
    }
    ?>
  </div>
<!--include footer-->
<?php 
  include_once("inc/footer.php"); 
  include("dbclose.php"); 
?>