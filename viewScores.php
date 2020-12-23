<?php
// Start

session_start();
	
	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);

// End
?>

<!DOCTYPE html>
<html>
<head>
	<title>My website</title>
	<link rel = "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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

		#link {
			float: right;
		}

		body {
			background-color: #F5F5F5;
		}
		
	</style>

	<a id="back" class="btn btn-secondary" href="index.php">Back</a><br><br>
	<div id="box">
		<h1>Your scores:</h1>
		<br>
		<?php
		// Start

		$t = (string)$user_data['ID'];
		// echo $t;
		$query = "select Attempt.Score, Attempt.QuizID, Quiz.Name from Attempt, Quiz where Attempt.StudentID = $t and Quiz.ID = Attempt.QuizID";
		$result = mysqli_query($conn, $query);

		if (!$result) {
		    echo "Could not successfully run query ($query) from DB: " . mysql_error();
		    exit;
		}

		while ($row = mysqli_fetch_assoc($result)) {
			echo "<hr />";
			echo "Quiz ID: " . $row['QuizID'];
			echo "<br>";
			echo "Quiz Name: " . $row['Name'];
			?>
			<br>
			<?php
			echo "Score: " . ($row['Score']*100) . "%";
			?>
			<a id="link" class="btn btn-primary" href="useQuiz.php?quizID=<?=$row['QuizID']?>" > View Quiz </a>
			<br>
			<br><br>

			<?php
		}


		// End
		?>
	</div>
</body>
</html>