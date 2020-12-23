<?php
// Start

session_start();
	
	include("connection.php");
	include("functions.php");
	$id = $_GET["quizID"];

	
	
// End
?>


<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>View Quiz</title>
	<link rel = "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script>
		$(document).ready(function() {
			$("#button1").click(function() {
				$(".radoptions").show();
				$(".radoptions").attr("disabled", true);
				$("#button1").attr("disabled", true);
			});
		});
		// function displayAns() {
		// 	document.getElementById("labmsg").innerHTML="";
		// 	var results = document.getElementsByTagName('input');

		// 	for (i = 0; i < results.length; i++) {
		// 		if (results[i].type == "radio") {

		// 			if (results[i].checked) {
		// 				document.getElementById("labmsg").innerHTML += "Q" + results[i].name+")" + "Your selected answer is: " + results[i].value + "<br>";
		// 			}
		// 		}
		// 	}
		// }
	</script>



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

	</style>


	<a id="back" class="btn btn-secondary" href="index.php" > Return to main menu </a><br><br>

	<div id="box">
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




		echo "<table>";
		$q_num = 1;
		while ($row = mysqli_fetch_assoc($result)) {
			$num = $row['Number'];				// Question number
			$statement = $row['Statement'];		// Question statement
			
			echo "<tr>";
			echo "<td>".$q_num.". ".$statement."</td>";	// Print the question
			echo "</tr>";
			
			// To get all answer choices for a question number:
			$query2 = "select AnswerChoice from Answer where QuizID = '$id' and QuestionNumber = '$num'";
			$result2 = mysqli_query($conn, $query2);

			echo "<tr>";
			echo "<td>";
			while ($row2 = mysqli_fetch_assoc($result2)) {
				$choice = $row2['AnswerChoice'];

				echo "- " . $choice;	// Print answer choices
				echo "<br>";
			}
			echo "</td>";
			echo "</tr>";


			// Get the correct answer
			$query3 = "select AnswerChoice from Answer where QuizID = '$id' and QuestionNumber = '$num' and isCorrect = '1'";
			$result3 = mysqli_query($conn, $query3);
			$answer = mysqli_fetch_assoc($result3);

			if (mysqli_num_rows($result) == 0) {
				$q_num++;
				continue;
			}

			echo "<tr>";
			echo "<td><span id='span1' class='radoptions' style='color:green; display:none;'><hr/><b>Correct answer is: ".$answer['AnswerChoice']."<hr/></b></span></td>";
			echo "<td><br><br></td>";
			echo "</tr>";

			$q_num++;
		}
		?>
		
		<input class="btn btn-success" id="button1" type="submit" name="submit" value="View Correct Answers"><br><br>
		<?php
		mysqli_close($conn);
		// End
		?>
	</div>
	<br>
	<label id="labmsg"></label>
</body>
</html>