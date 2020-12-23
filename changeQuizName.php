<?php
// Start

session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);
	$id = $_GET['quizID'];

	$_SESSION['quiz_id'] = $id;

// End
?>


<!DOCTYPE html>
<html>
<head>
	<title>Change Quiz Name</title>
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
			width: 500px;
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

	<!-- <a href="modifyQuiz.php">Back to modify quiz</a> -->
	<a id="back" class="btn btn-secondary" href="modifyQuiz.php">Back to modify quiz</a>

	<div id="box">
		<h3>Please enter the new name of the quiz: </h3>

		<form action="processChangeQuizName.php" method="post">
			<input id="text" class="form-control" type="text" name="new_quiz_name"><br><br>
			<input class="btn btn-primary" type="submit" name="submit" value="Change Name">

		</form>
	</div>
</body>
</html>