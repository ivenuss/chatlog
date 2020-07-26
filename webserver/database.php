<?php
	// DB hostname
	$servername = "localhost";

	// DB username
	$username = "";

	// DB password
	$password = "";

	// DB name
	$dbname = "";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn)
	{
		die("Connection failed: " . mysqli_connect_error());
	}

	mysqli_set_charset($conn, "utf8");
?>
