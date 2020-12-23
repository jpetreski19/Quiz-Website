<?php
// Start

session_start();


	include("connection.php");
	include("functions.php");
	
	$user_data = check_login($conn);
	$id = $_SESSION['quiz_id'];
	$q_num = $_SESSION['question_number'];
	$new_statement = $_POST['new_statement'];


	$query = "update Question set Statement = '$new_statement' where QuizID = '$id' and Number = '$q_num'";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		echo "Something went wrong: " . mysqli_error($conn);
		die;
	}

// End
?>

<!DOCTYPE html>
<html>
<head>
	<title>Process update question</title>
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
			width: 700px;
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

		h3 {
			text-align: center;
		}
		
	</style>
	<a id="back" class="btn btn-secondary" href="modifyQuiz.php">Back to modify quiz</a>

	<div id="box">
		<h3>Question updated! </h3>
	</div>
</body>
</html>