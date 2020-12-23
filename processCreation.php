<?php

// Start

session_start();
	
	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);

	$num_questions = $_SESSION['num_questions'];
	$num_choices = $_SESSION['num_choices'];
	$name = $_SESSION['quiz_name'];
	$quiz_id = (int)$_SESSION['quiz_id'];
	$staff_id = (int)$_SESSION['staff_id'];
	$available = "";

	if (isset($_POST['available'])) {
		$available = $_POST['available'];	// Has the value yes if clicked, empty otherwise
	}
	$is_available = 1;

	if (empty($available)) {
		$is_available = 0;
	}

	// echo $num_choices . "<br>";
	// echo $available . "<br>";


	// Check if the quiz has already been created
	$query = "select * from Quiz where ID = '$quiz_id'";
	$res = mysqli_query($conn, $query);

	if (mysqli_num_rows($res) != 0) {
		echo "Quiz already created. Try creating again with different ID.";
		header("Location: index.php");
		die;
	}


	// Create new quiz entry
	$create_quiz = "insert into Quiz (ID, Name, AuthorID, Available) values ('$quiz_id', '$name', '$staff_id', '$is_available')";
	$result = mysqli_query($conn, $create_quiz);


	if (!$result) {
		echo "Something went wrong creating the quiz " . mysqli_error($conn);
	}

	$ignored = 0;
	$question_count = 1;
	if (isset($_POST['submit'])) {
		for ($i = 1; $i <= $num_questions; $i++) {

			if (!empty($_POST['statement'][$i]) && !empty($_POST['correct_choice'][$i])) {
				$statement = $_POST['statement'][$i];


				// Add entry for the question in database
				$create_question = "insert into Question (QuizID, Number, Statement) values ('$quiz_id', '$question_count', '$statement')";
				$result2 = mysqli_query($conn, $create_question);

				if (!$result2) {
					echo "Could not create Question entry: " . mysqli_error($conn);
				}

				

				// echo $statement . "<br>";

				for ($j = 1; $j < $num_choices; $j++) {
					if (!empty($_POST['incorrect_choice'][$i][$j])) {

						// echo "Answer choice" . "<br>";
						$c = $_POST['incorrect_choice'][$i][$j];


						$create_answer_choice = "insert into Answer (QuizID, QuestionNumber, AnswerChoice, isCorrect) values ('$quiz_id', '$question_count', '$c', '0')";
						$result3 = mysqli_query($conn, $create_answer_choice);

						if (!$result3) {
							echo "something went wrong creating the answer choice: " . mysqli_error($conn);
						}
						// echo $c . "<br>";
					}
					
				}
			
				$correct = $_POST['correct_choice'][$i];

				// Create entry for the correct answer
				$create_correct = "insert into Answer (QuizID, QuestionNumber, AnswerChoice, isCorrect) values ('$quiz_id', '$question_count', '$correct', '1')";
				$result4 = mysqli_query($conn, $create_correct);


				// echo "correct answer is: " . $correct . "<br>";
				// echo "<br><br>";

				$question_count++;
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
	<title>Quiz Created</title>
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

		h1 {
			text-align: center;

		}

	</style>

	<a id="back" class="btn btn-secondary" href="index.php" > Return to main menu </a><br><br>

	<div id="box">
		<h1>Quiz "<?php echo $name; ?>" created!</h1>
		<br>

		<?php
		if ($ignored !== 0) {
			?>
			<h5>Ignored <?php echo $ignored; ?> questions because you didn't input statement or corrrect answer.</h5>
			<?php
		}
		?>
		<!-- <a href="index.php">Back to main menu</a> -->
	</div>
</body>
</html>