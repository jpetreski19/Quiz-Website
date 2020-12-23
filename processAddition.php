<?php
// Start

session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);

	$quiz_id = $_SESSION['quiz_id'];
	$num_questions = $_SESSION['num_questions'];
	$num_choices = $_SESSION['num_choices'];


	// echo $quiz_id . "<br>" . $num_questions . "<br>" . $num_choices;

	// Find the next question number:
	$query = "select Number from Question where QuizID = '$quiz_id'";
	$result = mysqli_query($conn, $query);


	$next_q_num = 0;
	while ($row = mysqli_fetch_array($result)) {
		if ($next_q_num < $row['Number']) {
			$next_q_num = $row['Number'];
		}
	}

	$next_q_num++;
	$ignored = 0;

	// echo $next_q_num;

	if (isset($_POST['submit'])) {
		for ($i = 1; $i <= $num_questions; $i++) {

			if (!empty($_POST['statement'][$i]) && !empty($_POST['correct_choice'][$i])) {
				$statement = $_POST['statement'][$i];


				// Add entry for the question in database
				$create_question = "insert into Question (QuizID, Number, Statement) values ('$quiz_id', '$next_q_num', '$statement')";
				$result2 = mysqli_query($conn, $create_question);

				if (!$result2) {
					echo "Could not create Question entry: " . mysqli_error($conn);
				}


				for ($j = 1; $j < $num_choices; $j++) {
					if (!empty($_POST['incorrect_choice'][$i][$j])) {

						$c = $_POST['incorrect_choice'][$i][$j];


						$create_answer_choice = "insert into Answer (QuizID, QuestionNumber, AnswerChoice, isCorrect) values ('$quiz_id', '$next_q_num', '$c', '0')";
						$result3 = mysqli_query($conn, $create_answer_choice);

						if (!$result3) {
							echo "something went wrong creating the answer choice: " . mysqli_error($conn);
						}
					}
					
				}
			
				$correct = $_POST['correct_choice'][$i];

				// Create entry for the correct answer
				$create_correct = "insert into Answer (QuizID, QuestionNumber, AnswerChoice, isCorrect) values ('$quiz_id', '$next_q_num', '$correct', '1')";
				$result4 = mysqli_query($conn, $create_correct);
				$next_q_num++;
			} else {
				$ignored++;
			}
		}
	}
	
// End
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Process Addition</title>
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

	<a id="back" class="btn btn-secondary" href="index.php" > Return to main menu </a><br><br>

	<div id="box">
		<h3>Questions added.</h3>
		<br>

		<?php
		if ($ignored !== 0) {
			?>
			<h5>Ignored <?php echo $ignored; ?> questions because you didn't input statement or corrrect answer.</h5>
			<?php
		}
		?>
	</div>
</body>
</html>