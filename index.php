<?php
include_once 'classes/class.user.php';
include_once 'classes/class.appointment.php';
include 'config/config.php';

$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

$user = new User();
$appointment = new Appointment();
if(!$user->get_session()){
	header("location: login.php");
}
$user_id = $user->get_user_id($_SESSION['user_email']);
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


<header class="index-header">
    <div class="container">
        <h2>Welcome *User* Access Level: *Access Level*</h2>
    </div>
</header>

<nav class="index-navbar">
    <div class="container">
        <a href="index.php" class="<?php echo ($page === '' || $page === 'home') ? 'active' : ''; ?>">Home</a> | 
        <a href="index.php?page=appointment" class="<?php echo ($page === 'appointment') ? 'active' : ''; ?>">Appointment</a> | 
        <a href="#" class="<?php echo ($page === 'link4') ? 'active' : ''; ?>">Link 4</a> |
        <a href="index.php?page=settings" class="<?php echo ($page === 'settings') ? 'active' : ''; ?>">Settings</a> |
        <a href="logout.php" class="move-right">Log Out</a>
    </div>
</nav>

<div class="index-content">
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