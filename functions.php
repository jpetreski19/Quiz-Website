<?php
// Start

function check_login($conn) {

	if (isset($_SESSION['ID'])) {
		$id = $_SESSION['ID'];

		$query = "select * from User where ID = '$id' limit 1";
		$result = mysqli_query($conn, $query);

		if ($result && mysqli_num_rows($result) > 0) {
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	// Redirect to login

	header("Location: login.php");
	die;
}


function random_num($num_digits) {

	$text = "";

	// Make sure there are enough digits
	if ($num_digits < 2) {
		$num_digits = 2;
	}


	$length = rand(2, $num_digits);
	$text .= rand(1, 9);

	for ($i = 0; $i < $length - 1; $i++) {
		$text .= rand(0, 9);
	}

	return $text;
}

// End