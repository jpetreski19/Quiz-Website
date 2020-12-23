<?php
// Start

session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($conn);
	$id = $_SESSION['quiz_id'];
	$available = $_SESSION['available'];


?>
<!DOCTYPE html>
<html>
<head>
	<title>Process Change Availability</title>
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

	<a id="back" class="btn btn-secondary" href="modifyQuiz.php">Back to modify quiz</a>
	<br>

	<div id="box">
		<?php
		// Start

			if (isset($_POST["submit"])) {
				if (!empty($_POST['choice']) && $_POST["choice"] == 'yes') {
					// echo "Now should be changed";

					
					if ($available == 1) {
						$queryYes = "update Quiz set Available = '0' where ID = '$id'";
						$resultYes = mysqli_query($conn, $queryYes);

						if (!$resultYes) {
							echo "Something went wrong: " . mysqli_error($conn);
							die;
						}

						echo "<h3>Quiz set to unavailable </h1>";
					} else {

						$queryYes = "update Quiz set Available = '1' where ID = '$id'";
						$resultYes = mysqli_query($conn, $queryYes);

						if (!$resultYes) {
							echo "Something went wrong: " . mysqli_error($conn);
							die;
						}

						echo "<h3>Quiz set to available </h1>";
					}
					
				} else {
					echo "<h3>Nothing has changed</h3>";
				}
			}


		// End
		?>
	</div>
</body>
</html>
