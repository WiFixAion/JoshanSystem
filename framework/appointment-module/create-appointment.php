<h3>Provide the Required Information</h3>
<div id="form-block">
    <form method="POST" action="processes/process.appointment.php?action=new">
        <div id="form-block-half">
            <label for="name">Name</label>
            <input type="text" id="name" class="input" name="name" placeholder="Your name..">

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
        <input type="submit" value="Save">
        </div>
  </form>
</div>