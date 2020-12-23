<?php
// Start

session_start();
	
	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);
	$id = $_GET['quizID'];

	$query = "select Name from Quiz where ID = '$id'";
	$result = mysqli_query($conn, $query);


	

	if (!$result) {
		echo "Something went wrong executing the query: " . mysqli_error($conn);
	}


	if (mysqli_num_rows($result) == 0) {
		echo "Quiz does not exist";
		header("Location: modifyQuiz.php");
		die;
	}


	$name = mysqli_fetch_assoc($result);
	$delete_query = "delete from Quiz where ID = '$id'";
	$result2 = mysqli_query($conn, $delete_query);

	if (!$result2) {
		echo "Could not delete quiz: " . mysqli_error($conn);
		die;
	}

// End
?>


<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Delete quiz</title>
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
		<h1>Quiz " <?php echo $name['Name'] ?> " deleted successfully!</h1>
	</div>
</body>
</html>