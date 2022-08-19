<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
date_default_timezone_set("Asia/Kolkata");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <p>Hello <?php echo $_SESSION['username']; ?>.</p>
        <p>To mark or retrieve attendace, fill the date and time as follows.</p>
		
		<form action="attendance.php" method="post">
		     <input type="date" name="date" value="<?php echo date("Y-m-d"); ?>" />
			 
			 <input type="time" name="time" value="<?php echo date("H:i"); ?>" />
			 
			 <br /><br />
			 
			 <input type="submit" value="Next >" name="submit" class="login-button"/>
		</form>
		
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
