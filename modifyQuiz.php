<?php
// Start

session_start();
	
	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);

// End
?>



<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Modify quiz</title>

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
			width: 900px;
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
			margin-right: 5px;
			margin-left: 5px;
		}

	</style>

	<!-- <a href="index.php">Back to main menu</a> -->
	<a id="back" class="btn btn-secondary" href="index.php" > Return to main menu </a><br><br>

	<div id="box">
		<h1>All quizes:</h1>
		<!-- <hr /> -->
		<?php

		// Start

		$t = (string)$user_data['ID'];
		// echo $t;
		$query = "select * from Quiz";
		$result = mysqli_query($conn, $query);

		if (!$result) {
		    echo "Could not successfully run query ($query) from DB: " . mysql_error();
		    exit;
		}

		while ($row = mysqli_fetch_assoc($result)) {
			echo "<hr />";
			echo "<br>";
			echo "Quiz: " . $row['Name'];


			?>
			<a id="link" class="btn btn-primary" href="useQuiz.php?quizID=<?=$row['ID']?>" > View Quiz </a>
			<?php
			if ($row['AuthorID'] == $user_data['ID']) {
				// A staff can delete and update only quizes created by him/her
				?>
				<a id="link" class="btn btn-danger" href="deleteQuiz.php?quizID=<?=$row['ID']?>" > Delete Quiz </a>
				<a id="link" class="btn btn-warning" href="updateQuiz.php?quizID=<?=$row['ID']?>" > Update Quiz </a>
				
				<?php
			}
			echo "<br><br>";
			
		}


		// End
		?>
	</div>
</body>
</html>