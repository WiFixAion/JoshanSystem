<?php
$_SESSION['login_time'] = time();


include_once 'classes/class.user.php';
include_once 'classes/class.appointment.php';
include 'config/config.php';

$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

$user = new User();
$appointment = new Appointment();
if(!$user->get_session()){
	header("location: logout.php");
}
$user_id = $user->get_user_id($_SESSION['user_email']);

function is_session_timeout() {
    $timeout = 60 * 1; // Set timeout to 15 minutes
    $current_time = time();
    $login_time = $_SESSION['login_time'];
    $time_difference = $current_time - $login_time;

    if ($time_difference > $timeout) {
        return true;
    } else {
        return false;
    }
}
if (is_session_timeout()) {
    session_destroy();
} else if (!isset($_SESSION["username"])) {  // not logged in, redirect
    header("location: logout.php");
}
var_dump(is_session_timeout());
?>
<!DOCTYPE html>
<html>
<head>
    <title>Joshan System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css?<?php echo time();?>">
    <script src="jscript/script.js"></script>
</head>
<body>

    <div id="header">
      <h2>Welcome *User* Access Level: *Access Level*</h2>
    </div>
<div id="wrapper">
  <div id="menu">
      <a href="index.php">Home</a> | 
      <a href="index.php?page=appointment">Appointment</a> | 
      <a href="#">Link 4</a> |
      <a href="index.php?page=settings">Settings</a> | <a href="logout.php" class="move-right">Log Out</a>
  </div>
  <div id="content">
    <?php

      switch($page){
                case 'settings':
                    require_once 'settings-module/index.php';
                break; 
                case 'appointment':
                    
                    var_dump($_GET);
                    require_once 'appointment-module/index.php';
                break; 
                case 'module_xxx':
                    require_once 'module-folder';
                break; 
                default:
                    require_once 'main.php';
                break; 
            }
    ?>
  </div>
</div>

</body>
</html>