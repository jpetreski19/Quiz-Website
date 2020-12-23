<?php

// Start

session_start();
	
	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);

	$num_questions = $_POST['num_questions'];
	$num_choices = $_POST['num_ans_choices'];

	$t_q = (int)$num_questions;
	$t_c = (int)$num_choices;

	if ((string)($t_q) != $num_questions || (string)($t_c) != $num_choices) {
		header("Location: handleNonInt.php");
		die;
	}
	$name = $_POST['title'];
	$quiz_id = $_SESSION['quiz_id'];
	$staff_id = $user_data['ID'];


	$_SESSION['num_questions'] = $num_questions;
	$_SESSION['num_choices'] = $num_choices;
	$_SESSION['quiz_name'] = $name;
	$_SESSION['staff_id'] = $staff_id;
	// $_SESSION['quiz_id'] = $quiz_id;

	// echo $staff_id . "<br>";
	// echo $id . "<br>";
	// echo $num_questions . "<br>" . $num_choices;

// End
?>

<!DOCTYPE html>
<html>
<head>
	<title>Write questions</title>

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
			width: 700px;
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

	<!-- <a href="index.php">Back to main menu</a> -->
	<a id="back" class="btn btn-secondary" href="index.php" > Return to main menu </a><br><br>


	<div id="box">
		<h1>Write questions for quiz: <?php echo $name; ?></h1>
		<hr />

		<form action="processCreation.php" method="post">
		<?php
		// Start

		for ($i = 1; $i <= $num_questions; $i++) {
			?>
				Write question <?php echo $i; ?>: <input class="form-control" id="text" type="text" name="statement[<?php echo $i; ?>]">
				<br>
				Write incorrect answer choices:<br>
				<?php
				for ($j = 1; $j < $num_choices; $j++) {
					echo $j . ". ";
					?>
					<input class="form-control" id="text" type="text" name="incorrect_choice[<?php echo $i; ?>][<?php echo $j; ?>]">
					<?php
				}
				?>
				<br>
				Write the correct answer here:
				<input class="form-control" id="text" type="text" name="correct_choice[<?php echo $i; ?>]"><br>
				
				<hr />
			<?php
		}
		// End
		?>
		<input type="checkbox" name="available" value="Yes"> Make quiz available?
		<input id="link" class="btn btn-primary" type="submit" name="submit" value="Create Quiz"><br><br>
		</form>
	</div>
</body>
</html>