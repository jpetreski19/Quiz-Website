<?php
// Start

session_start();


	include("connection.php");
	include("functions.php");
	
	$user_data = check_login($conn);
	$id = $_GET['quizID'];
	$q_num = $_GET['questionNum'];

	// echo $id;
	// echo "<br>";
	// echo $q_num;


	$query = "delete from Question where QuizID = '$id' and Number = '$q_num'";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		echo "Could not delete question: " . mysqli_error($conn);
		die;
	}




// End
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Process delete</title>
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
			width: 500px;
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
		h2 {
			text-align: center;
		}
	</style>

	<a id="back" class="btn btn-secondary" href="modifyQuiz.php">Back to modify quiz</a>
	<div id="box">
		<h2>Delete successful!</h2>
	</div>
</body>
</html>