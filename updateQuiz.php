<?php
// Start

session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);
	$id = $_GET['quizID'];

	// echo $id;
	
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
			width: 500px;
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

		h1 {
			text-align: center;

		}

	</style>

	<a id="back" class="btn btn-secondary" href="modifyQuiz.php">Back to modify quiz</a>

	<div id="box">
		<h1>Please select option: </h1>
		<hr />
		<br>
		<a id="link" class="btn btn-danger" href="deleteQuestion.php?quizID=<?=$id?>" > Delete Question </a>
		<a class="btn btn-warning" href="updateQuestion.php?quizID=<?=$id?>" > Update Question </a>
		<a id="link2" class="btn btn-success" href="addQuestion.php?quizID=<?=$id?>" > Add Question </a>
		<br><br>
		<hr />

		<br>
		<a id="link" class="btn btn-primary" href="changeAvailability.php?quizID=<?=$id?>" > Change availability </a>
		<a id="link2" class="btn btn-secondary" href="changeQuizName.php?quizID=<?=$id?>" > Change Quiz Name </a>
		<br>
		<br>
	</div>
</body>
</html>