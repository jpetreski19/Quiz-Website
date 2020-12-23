<?php
// Start

session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);
	$id = $_GET['quizID'];

	// echo $id;
	$query = "select Available from Quiz where ID = '$id'";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		echo "Something went wrong: " . mysqli_error($conn);
		die;
	}

	$available = mysqli_fetch_array($result);
	$is_available = "unavailable";
	if ($available['Available'] == 1) {
		$is_available = "available";
	}

	$_SESSION['quiz_id'] = $id;
	$_SESSION['available'] = $available['Available'];




// End
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update quiz</title>
	<link rel = "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<style type="text/css">
		#text {
			/*height: 25px;*/
			width: 250px;
			border-radius: 5px;
			padding: 4px;
			border: solid thin #aaa;
		}

		#box {
			margin: auto;
			width: 800px;
			margin-top: 30px;
			padding: 20px;

			border-radius: 25px;
			border: 2px solid darkgrey;

			align-self: center;
			align-content: center;
		}

		#back {
			margin-top: 10px;
			margin-left: 20px;
		}

		body {
			background-color: #F5F5F5;
		}

		#link {
			float: left;
			margin-right: 20px;
		}
		#link2 {
			float: right;
			margin-left: 9px;
		}

		

	</style>

	<a id="back" class="btn btn-secondary" href="modifyQuiz.php">Back to modify quiz</a>
	
	<div id="box">
		<h3>Currently the quiz is <?php echo $is_available; ?>.</h3>
		<hr />
		<h5> Do you want to change this setting?</h5>


		<form action="processChangeAvailability.php" method="post">
			<input type="radio" name="choice" value="yes"> Yes
			<br>
			<input type="radio" name="choice" value="no"> No
			<br><br>
			<input class="btn btn-primary" type="submit" name="submit">
		</form>
	</div>
</body>
</html>