var dateInput = document.getElementById("date");
  dateInput.min = "<?php echo date('Y-m-d'); ?>";

function openForm(appointmentId, appointmentName, appointmentPurpose, appointmentDate, appointmentTime) {
  document.getElementById("myForm").style.display = "block";

  // Set the value of the hidden input field in the edit form
  document.getElementById("appointment_id").value = appointmentId;
  document.getElementById("appointmentName").innerHTML = appointmentName;
  document.getElementById("name").value = appointmentName; // Set the value of the name input field
  document.getElementById("purpose").value = appointmentPurpose; // Set the value of the name input field
  document.getElementById("date").value = appointmentDate; // Set the value of the name input field
  
  var timeSelect = document.getElementById("time");
  var timeOption = timeSelect.options[timeSelect.options.length - 1]; // Get the last option element
  if (appointmentTime === '08:00:00') {
    timeSelect.options[0].selected = true;
  } else if (appointmentTime === '10:00:00') {
    timeSelect.options[1].selected = true;
  } else if (appointmentTime === '13:00:00') {
    timeSelect.options[2].selected = true;
  } else if (appointmentTime === '15:00:00') {
    timeSelect.options[3].selected = true;
  }
   

  // Send an AJAX request to pass the appointmentName variable to PHP
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'your_php_script.php?jsVariable=' + encodeURIComponent(appointmentName), true);
  xhr.onload = function() {
    if (xhr.status === 200) {
      console.log('Received from PHP:', xhr.responseText);
    } else {
      console.log('Error: ' + xhr.statusText);
    }
  };
  xhr.send();
}


function closeForm() {
  // Close form
  document.getElementById("myForm").style.display = "none";
}

document.querySelector('form.form-container').addEventListener('submit', function(event) {
  event.preventDefault();

  // Get the updated values from the form fields
  var appointmentId = document.getElementById("appointment_id").value;
  var name = document.getElementById("name").value;
  var purpose = document.getElementById("purpose").value;
  var date = document.getElementById("date").value;
  var time = document.getElementById("time").value;

  // Send an AJAX request to update the appointment
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'processes/process.appointment.php?action=update', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Redirect to the appointment profile page
      window.location.href = 'index.php?page=settings&subpage=appointments&action=profile&id=' + appointmentId;
    } else {
      console.log('Error: ' + xhr.statusText);
    }
  };
  xhr.send('appointment_id=' + appointmentId + '&name=' + name + '&purpose=' + purpose + '&date=' + date + '&time=' + time);
});

function deleteAppointment(appointmentId) {
  if (confirm("Are you sure you want to delete this appointment?")) {
    // Send an AJAX request to delete the appointment
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'processes/process.appointment.php?action=delete', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
        // Redirect to the appointments page
        window.location.href = 'index.php?page=settings&subpage=appointments';
      } else {
        console.log('Error: ' + xhr.statusText);
      }
    };
    xhr.send('appointment_id=' + appointmentId);
  }
}

var deleteButtons = document.querySelectorAll('.delete-button');
for (var i = 0; i < deleteButtons.length; i++) {
  deleteButtons[i].addEventListener('click', function(event) {
    event.preventDefault();
    var appointmentId = this.id.split('-')[2];
    if (confirm("Are you sure you want to delete this appointment?")) {
      // Send an AJAX request to delete the appointment
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'processes/process.appointment.php?action=delete', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          // Redirect to the appointments page
          window.location.href = 'index.php?page=settings&subpage=appointments';
        } else {
          console.log('Error: ' + xhr.statusText);
        }
      };
      xhr.send('appointment_id=' + appointmentId);
    }
  });
}