<?php

// Start

session_start();
	
	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);


// End
?>

<!DOCTYPE html>
<head>
	<title>Take quiz</title>

	<link rel = "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
	<style type="text/css">
		#box {
			margin: auto;
			width: 600px;
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
		<h1>Select a quiz to take</h1>

		<?php
		// Start


		// List all available quizes

		$query = "select * from Quiz";
		$result = mysqli_query($conn, $query);


		if (!$result) {
		    echo "Could not successfully run query ($query) from DB: " . mysql_error();
		    exit;
		}

		// echo mysqli_num_rows($result);

		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['Available'] == 1) {
				// echo $row['ID'] . " " . $row['Name'];
				?>
				<br>
				<hr />

				<?php
				echo "Quiz ID: " . $row['ID'];
				echo "<br>";
				echo "Quiz Title: " . $row['Name'];
				echo "<br>";
				?>
				<form method="POST" action="useQuiz.php">
					<a id="link" class="btn btn-primary" href="startQuiz.php?quizID=<?=$row['ID']?>" > Start </a>
					<br>
				</form>
				<?php
			}
			
		}
		// End
		?>
	<br>
	</div>
</body>