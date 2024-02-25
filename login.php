<?php
include_once 'config/config.php';
include_once 'classes/class.user.php';

$user = new User();
if($user->get_session()){
	header("location: index.php");
}
if(isset($_REQUEST['submit'])){
	extract($_REQUEST);
	$login = $user->check_login($useremail,$password);
	if($login){
		header("location: index.php");
	}else{
		?>
        <div id='error_notif'>Wrong email or password.</div>
        <?php
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Application Name</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css?<?php echo time();?>">
</head>
<body style="background-image: url(https://t3.ftcdn.net/jpg/05/79/48/50/360_F_579485091_aVxVKR8e2s886hee1j146OBeiJugJifG.jpg);">
<div class="container">
    <div class="brand-block">
        <h2>HUMBLEZ</h2>
    </div>
    <div class="login-block">
        <h3>Please login</h3>
        <form method="POST" action="" name="login">
            <div class="form-group">
                <input type="email" class="input" required name="useremail" placeholder="Valid E-mail"/>
            </div>
            <div class="form-group">
                <input type="password" class="input" required name="password" placeholder="Password"/>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Submit" class="btn"/>
            </div>
        </form>
        <div id='error_notif' class="error-message">Wrong email or password.</div>
    </div>
</div>
</body>
</html>