<?php
// Start

session_start();
	
	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);

// End
?>


<!DOCTYPE html>
<html>
<head>
	<title>My website</title>

	<link rel = "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<style type="text/css">
		#links {
			/*background-color: lightgrey;*/
			margin: auto;
			width: 400px;
			margin-top: 15px;
			padding: 20px;

			/*border-radius: 25px;*/
			/*border: 2px solid darkgrey;*/
		}

		#link2 {
			float: right;
		}

		#my_div {
			margin: auto;
			width: 500px;
			margin-top: 30px;
			padding: 20px;
		}

		#logout {
			/*margin: auto;*/
			/*width: 500px;*/
			margin-top: 10px;
			/*padding: 20px;*/
			margin-left: 20px;
		}
		body {
			background-color: #F5F5F5;
		}
		#box {
			margin: auto;
			width: 600px;
			margin-top: 30px;
			padding: 20px;

			border-radius: 25px;
			border: 2px solid darkgrey;
		}
	</style>
	<a id="logout" class="btn btn-secondary" href="logout.php">Logout</a><br><br>
	<br>
	
	<div id="box">
		<div id="my_div">
			<h1>Welcome</h1>
			 <?php
			 echo $user_data['Forename'] . " " . $user_data['Surname'];
			 echo "<br>";
			 echo "ID number: " . $user_data['ID'];
			 ?>
		</div>
		<br><br>

		<?php
		if ($user_data['isStaff'] == 1) {
			// echo "<h4>You are logged in as staff</h4>";
			?>
			<div id="links">
				<a class="btn btn-primary" href="createQuiz.php">Create a quiz</a>
				<a id="link2" class="btn btn-warning" href="modifyQuiz.php">Modify quiz</a>
			</div>
			<?php
		} else {
			// echo "<h4>You are logged in as student</h4>";
			?>
			<div id="links">
				<a class="btn btn-primary" href="takeQuiz.php">Take a quiz</a>
				<a id="link2" class="btn btn-warning" href="viewScores.php">View scores</a>
			</div>
			<?php
		}
		?>
	</div>
</body>
</html>