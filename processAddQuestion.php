<?php
// Start

session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);

	$quiz_id = $_SESSION['quiz_id'];
	$num_questions = $_POST['num_questions'];
	$num_choices = $_POST['num_ans_choices'];

	$t_q = (int)$num_questions;
	$t_c = (int)$num_choices;

	if ((string)($t_q) != $num_questions || (string)($t_c) != $num_choices) {
		header("Location: handleNonInt.php");
		die;
	}

	$_SESSION['num_questions'] = $num_questions;
	$_SESSION['num_choices'] = $num_choices;


	// echo $id;

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
		<h1>Add the questions here please: </h1>
		<hr />
		<br>

		<form action="processAddition.php" method="post">
		<?php
		// Start

		for ($i = 1; $i <= $num_questions; $i++) {
			?>
				Write question number <?php echo $i; ?>: <input class="form-control" id="text" type="text" name="statement[<?php echo $i; ?>]">
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
				<input class="form-control" id="text" type="text" name="correct_choice[<?php echo $i; ?>]">
				
				<hr />
				<br>
			<?php
		}
		?>
		<input class="btn btn-primary" type="submit" name="submit" value="Add Questions"><br><br>
		</form>
		<?php

		// End
		?>
	</div>
</body>
</html>