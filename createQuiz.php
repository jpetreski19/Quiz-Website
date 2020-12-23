<?php

// Start

session_start();
	
	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);

	// Get a random id for the quiz
	$Quiz_ID = (int)random_num(4);

	// Check if duplicate exists
	while (true) {
		$test_duplicate = "select * from Quiz where ID = '$Quiz_ID'";
		$duplicate_result = mysqli_query($conn, $test_duplicate);

		if (mysqli_num_rows($duplicate_result) == 0) {
			break;
		}

		$Quiz_ID = (int)random_num(4);
	}
	$_SESSION['quiz_id'] = $Quiz_ID;

// End
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create quiz</title>

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
		}

		#back {
			margin-top: 10px;
			margin-left: 20px;
		}

		body {
			background-color: #F5F5F5;
		}

		#link {
			float: right;
		}

	</style>

	<a id="back" class="btn btn-secondary" href="index.php" > Return to main menu </a><br><br>

	<div id="box">
		<h1>Create Quiz</h1>

		<form action="writeQuestions.php" method="post">
			<p> Please enter the title of the quiz here: </p>
			<input id="text" type="text" name="title"><br><br>
			<p> Please enter maximum number of questions the quiz will have in the first field. <br> It may have fewer questions than the number you will input. </p>
			<p> Enter the number of answer choices each question will have in the second field. <br> There may be less number of answer choices than the number you input. </p>
			<br>
				Enter number of questions: <input id="text" class="form-control" type="text" name="num_questions"><br><br>
				Enter number of answer choices: <input id="text" class="form-control" type="text" name="num_ans_choices"><br><br>
			<input class="btn btn-primary" type="submit" name="create" value="Create Quiz"><br><br>
		</form>
	</div>
</body>
</html>