<?php
// Start

session_start();
	
	include("connection.php");
	include("functions.php");
	$id = $_SESSION["quiz_id"];
	$user_data = check_login($conn);
	$student_id = (int)$user_data['ID'];

	// To get all questions from that quiz:
	$query = "select Number, Statement from Question where QuizId = '$id'";
	$result = mysqli_query($conn, $query);

	if (isset($_POST['submit'])) {
		if (!empty($_POST['choices'])) {

			$count = count($_POST['choices']);
			$num_questions = mysqli_num_rows($result);
			$selected = $_POST['choices'];
			$num_correct = 0;

			// echo $num_questions;
			// echo "<br>";

			// echo $count;
			while ($row = mysqli_fetch_array($result)) {
				$k = $row['Number'];
				// echo $selected[$k];
				// echo "<br>";
				if (isset($selected[$k])) {
					// echo $k . " Answer choice for question <br>";

					$query3 = "select AnswerChoice from Answer where QuizID = '$id' and QuestionNumber = '$k' and isCorrect = '1'";
					$result3 = mysqli_query($conn, $query3);

					if (mysqli_num_rows($result3) != 0) {
						$answer = mysqli_fetch_array($result3);

						if ($answer['AnswerChoice'] == $selected[$k]) {

							// Selected answer is same as the correct one
							$num_correct++;
						}

						// echo $answer['AnswerChoice'];
						// echo "<br>";
						// echo $selected[$k];
						// echo "<br>";
					}
				}
			}

			// Calculate score
			$score = (double)$num_correct / $num_questions;
			$date = (string)date("d/m/Y");


			// Record an attempt
			$query4 = "insert into Attempt (StudentID, Date, QuizID, Score) values ('$student_id', '$date', '$id', '$score')";
			$result4 = mysqli_query($conn, $query4);

			if (!$result4) {
				echo "Error: " . mysqli_error($conn);
			}
		}
	}

// End
?>

<!DOCTYPE html>
<html>
<head>
	<title>Process score</title>
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

		
		
	</style>

	<a id="back" class="btn btn-secondary" href="index.php" > Return to main menu </a><br><br>

	<div id="box">
		<h4>Score: <?php echo ($score * 100);?>%</h4>
		<hr />
		<h5>Correct: <?php echo $num_correct; ?> out of <?php echo $num_questions; ?> questions.</h5>
	</div>
</body>
</html>