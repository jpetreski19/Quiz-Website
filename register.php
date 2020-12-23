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
	<title>Register</title>

	<link rel = "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<style type="text/css">
		#text {
			/*height: 25px;*/
			border-radius: 10px;
			padding: 10px;
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
		#check {
			position: relative;
			left: 20px;
		}
	</style>

	<div id="box">
		<form method="post">
			<div style="font-size: 30px; margin: 10px; color: black;">Reigster</div>
			<br>
			<input id="text" class="form-control"  type="text" name="Forename" placeholder="Forename"><br><br>
			<input id="text" class="form-control"  type="text" name="Surname" placeholder="Surname"><br><br>

			<input id="text" class="form-control"  type="password" name="Password" placeholder="Password"><br>
			<input class="form-check-input" id="check" type="checkbox" name="Role" value="staff">
			<label class="form-check-label" id="check" for="check">Staff</label><br><br>
			<input type="submit" class="btn btn-primary"  name="Register">

			<a href="login.php" id="link-pos">Login</a><br><br>
		</form>

		<?php
		// Start
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$forename = $_POST['Forename'];
			$surname = $_POST['Surname'];
			$password = (string)$_POST['Password'];
			$role = "";

			if (isset($_POST['Role'])) {
				$role = (string)$_POST['Role'];
			}


			if (!empty($forename) && !empty($surname) && !empty($password)) {

				$ID = (int)random_num(4);
				while (true) {
					$test_duplicate = "select * from User where ID = '$ID'";
					$duplicate_result = mysqli_query($conn, $test_duplicate);

					if (mysqli_num_rows($duplicate_result) == 0) {
						break;
					}

					$ID = (int)random_num(4);
				}
				
				$isStaff = 0;
				if ($role == "staff") {
					$isStaff = 1;
				}


				$query = "insert into User (ID, Forename, Surname, Password, isStaff) values ('$ID', '$forename', '$surname', '$password', '$isStaff')";

				if (!mysqli_query($conn, $query)) {
					echo ("Something went wrong. " . mysqli_error($conn));
					die;
				}

				$_SESSION['ID'] = $ID;

				header("Location: index.php");
				die;

			} else {
				echo "Please enter valid information.";
			}
		}
		// End
		?>
	</div>
</body>
</html>
