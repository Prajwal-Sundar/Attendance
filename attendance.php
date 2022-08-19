<?php
require_once('db.php');
include("auth_session.php");
include("functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <title>Attendance</title>
        <link rel="stylesheet" href="style.css" />
	</head>
	
	<body>
		<div class="form">
			<table class="table">
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Attendance</th>
					<th>Reverse Status</th>
				</tr>
			<?php
				$date = explode("-", $_POST['date']);
				$time = explode(":", $_POST['time']);
			
				$name = "a" . $date[0] . $date[1] . $date[2] . $time[0] . $time[1];
				
				$conn = new mysqli("localhost", "root", "", "loginsystem");
				if ($conn->connect_error)
					die("Connection Failed : " . $conn->connect_error);
				
				$sql = "SHOW COLUMNS FROM `users`";
				$res = $conn->query($sql);
				$flag = false;
				
				while ($row = $res->fetch_assoc())
					if ($row['Field'] == $name)
						$flag = true;
				
				if (!$flag) create($name);
				
				$arr = $conn->query("SELECT * FROM `students`");
				while ($row = $arr->fetch_assoc())
				{
					if ($row[$name]) $att = "Present";
					else $att = "Absent";
					
					echo '<tr>';
						echo '<td>' . $row["id"] . '</td>';
						echo '<td>' . $row["Name"] . '</td>';
						echo '<td id="' . $row["id"] . '">' . $att . '</td>';
						echo '<td class="pointer" onclick="reverse(' . $row["id"] . ')">Change</td>';
					echo '</tr>';
				}
			?>
			</table>
		</div>
		
		<script>
			function reverse(id)
			{
				var n = document.getElementById(id).innerHTML;
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						if (n == "Absent") att = "Present";
						else att = "Absent";
						document.getElementById(id).innerHTML = att;
					}
				};
				xhttp.open("POST", "functions.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("perform=reverse&id=" + id + "&att=" + n + "&name=<?php echo $name; ?>");
			}
		</script>
	</body>
</html>