<?php
// Start

session_start();
	
	include("connection.php");
	include("functions.php");
	$id = $_GET["quizID"];
	// echo $id;
	$user_data = check_login($conn);
	$student_id = (int)$user_data['ID'];

	$_SESSION['quiz_id'] = $id;

	// Get the name of the quiz given its ID
	$get_name_query = "select Name from Quiz where ID = '$id'";
	$res = mysqli_query($conn, $get_name_query);

	$array = mysqli_fetch_array($res);
	$name = $array['Name'];

// End
?>


<!DOCTYPE html>
<html>
<head>
	<title>Start quiz</title>
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
		<h1><?php echo $name; ?></h1>

		<?php
		// Start

		// To get all questions from that quiz:
		$query = "select Number, Statement from Question where QuizId = '$id'";
		$result = mysqli_query($conn, $query);

		if (!$result) {
		    echo "Could not successfully run query ($query) from DB: " . mysql_error();
		    exit;
		}
		if (mysqli_num_rows($result) == 0) {
			echo "No questions written for this quiz.";
			exit;
		}


		// Check if the student already had an attempt. If so, do not allow
		$check_query = "select * from Attempt where StudentID = '$student_id' and QuizID = '$id'";
		$check_result = mysqli_query($conn, $check_query);

		if (mysqli_num_rows($check_result) > 0) {
			echo "You already had an attempt for this quiz";
			die;
		}

		?>
		<form action="processScore.php" method="post">
			<?php
			$q_num = 1;
			while ($row = mysqli_fetch_assoc($result)) {
				$num = $row['Number'];				// Question number
				$statement = $row['Statement'];		// Question statement
				?>

				<div class="card">
					<h4 class="card-header"> <?php echo $q_num . ". " . $statement ?> </h4>

					<?php
					// To get all answer choices for a question number:
					$query2 = "select AnswerChoice from Answer where QuizID = '$id' and QuestionNumber = '$num'";
					$result2 = mysqli_query($conn, $query2);

					while ($row2 = mysqli_fetch_assoc($result2)) {
						$choice = $row2['AnswerChoice'];

						?>
						<div class="card-body">
							<input class="radoptions" type="radio" name="choices[<?php echo $num; ?>]" value="<?php echo $choice; ?>">
							<?php echo $choice; ?>
						</div>
						<?php
					}
				?>
				</div>
				<?php
				$q_num++;
			}
			// End
			?>
			<br>
			<input id="button1" type="submit" name="submit" value="Submit answers" class="btn btn-success m=auto d-block">
		</form>
	</div>
</body>
</html>