<?php
// Start

$host = "localhost";

// Mysql threw error for the root user, so I created another one 'root1'@'localhost'
// and granted all privileges to it
$user = "root1";
$password = "root1";
$db_name = "quizDBCW";


if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}


if (!$conn = mysqli_connect($host, $user, $password, $db_name)) {
	echo mysqli_error($conn);
	die("failed to connect to db");
}

// End
?>