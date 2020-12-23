<?php

// Start
session_start();

	include("connection.php");
	include("functions.php");

// End

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<link rel = "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<style type="text/css">
		#text {
			/*height: 25px;*/
			border-radius: 5px;
			padding: 4px;
			border: solid thin #aaa;
		}

		#button {
			padding: 10px;
			width: 100px;
			color: white;
			background-color: lightblue;
			border: none;
		}

		#box {
			background-color: lightgrey;
			margin: auto;
			width: 500px;
			margin-top: 80px;
			padding: 20px;

			border-radius: 25px;
			border: 2px solid darkgrey;
		}
		body {
			background-color: #F5F5F5;
		}
		#link-pos {
			float: right;
		}
	</style>

	<div id="box">
		<form method="post">
			<div style="font-size: 30px; margin: 10px; color: black;">Login</div>
			<br>
			<input id="text" class="form-control" type="text" name="ID" placeholder="ID number"><br><br>
			<input id="text" class="form-control" type="password" name="Password" placeholder="Password"><br><br>
			<input class="btn btn-primary" type="submit" name="Login">

			<a id="link-pos" href="register.php">Register</a><br><br>
		</form>

		<?php
		// Start
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$id = $_POST['ID'];
			$password = (string)$_POST['Password'];


			if (!empty($id) && !empty($password)) {

				// Read from database
				$query = "select * from User where ID = '$id' limit 1";
				$result = mysqli_query($conn, $query);

				if ($result && mysqli_num_rows($result) > 0) {

					$user_data = mysqli_fetch_assoc($result);

					if ($user_data['Password'] === $password) {

						$_SESSION['ID'] = $user_data['ID'];
						header("Location: index.php");
						die;
					}
				}
				echo "Wrong ID or password.";
			} else {
				echo "Please enter valid information.";
			}
		}
		// End
		?>
	</div>
</body>
</html>
