<?php
	if (isset($_POST['perform'])) $_POST['perform']();
	
	function create($name)
	{
		echo $name;
		$conn = new mysqli("localhost", "root", "", "loginsystem");
		$sql = "ALTER TABLE `students` ADD $name INTEGER(1);";
		$sql .= "UPDATE students SET $name = 0";
		
		$conn->multi_query($sql);
		$conn->close();
	}
	
	function reverse()
	{
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		$att = filter_input(INPUT_POST, 'att', FILTER_SANITIZE_STRING);
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		
		if ($att == "Absent") $att = 1;
		else $att = 0;
		
		$conn = new mysqli("localhost", "root", "", "loginsystem");
		$sql = "UPDATE students SET `$name` = $att WHERE `id` = $id";
		$conn->query($sql);
		$conn->close();
	}

?>