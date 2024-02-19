<div id="subcontent">
    <table id="data-list">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Purpose</th>
        <th>date</th>
        <th>time</th>
        <th>Modify</th>
      </tr>
<?php

$count = 1;
if($appointment->list_appointments() != false){
foreach($appointment->list_appointments() as $value){
   extract($value);
  
?>
      <tr>
        <td><?php echo $count;?></td>
        <td><?php echo $appointment_name;?></td>
        <td><?php echo $appointment_purpose;?></td>
        <td><?php echo $appointment_date;?></td>
        <td><?php echo date('g:i A', strtotime($appointment_time)); ?></td>
        <td><button class="open-button" onclick="openForm('<?php echo $appointment_id; ?>','<?php echo $appointment_name;?>','<?php echo $appointment_purpose;?>','<?php echo $appointment_date;?>','<?php echo $appointment_time;?>')">Edit</button> | <a href="processes/process.appointment.php?action=delete&appointment_id=<?php echo $appointment_id; ?>" id="delete-button-<?php echo $appointment_id; ?>" class="delete-button">Delete</a></td>
      </tr>
      <tr>
<?php
 $count++;
}
}else{
  echo "No Record Found.";
}
?>
    </table>
</div>


<!-- The form -->
<div class="form-popup" id="myForm">
  <form method="POST" action="processes/process.appointment.php?action=update" class="form-container">
    <h1>Editing Appointment</h1>
    <input type="hidden" id ="appointmentName">
    <input type="hidden" id="appointment_id" name="appointment_id" >
    <div id="form-block-half">
      <label for="name">Name</label>
      <input type="text" id="name" class="input" name="name" value=""  placeholder="Your name..">

      <label for="purpose">Purpose</label>
      <input type="text" id="purpose" class="input" name="purpose" placeholder="State your purpose..">

      <label for="date">Date</label>
      <input type="date" id="date" class="input" name="date" min="<?php echo date('Y-m-d'); ?>" required>

      <label for="time">Time</label>
      <select id="time" name="time">
        <option value="8:00">8:00 am</option>
        <option value="10:00">10:00 am</option>
        <option value="13:00">1:00 pm</option>
        <option value="15:00">3:00 pm</option>
      </select>
    </div>
    <div id="button-block">
      <input type="submit" value="Save" class="btn">
      <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </div>
  </form>
</div>