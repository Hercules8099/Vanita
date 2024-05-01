<?php
	
	$conn = mysqli_connect("localhost","root","","vegi");

	if (!$conn) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}

?>
