<!DOCTYPE html>
<html lang="en" xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">
<head>
    <title>highscore</title>
</head>
<body>
	<?php
		//Voeg onderstaande tabel toe aan een database.
		/* CREATE TABLE scores (
			id int(10) NOT NULL AUTO_INCREMENT,
			naam varchar(30) NOT NULL,
			score int(11) NOT NULL,
			datum varchar(30) NOT NULL,
			PRIMARY KEY (id)
			); */

		include "connect.php";

		// Datum en tijd genereren
		$datum = date('d-m-Y H:i:s');

		//echo "<h4>$datum</h4>";
		echo "<strong>ID, naam, score, datum en tijdstip</strong></br>";

		// INSERT query maken en uitvoeren.
		$stmt = $pdo->prepare("INSERT INTO scores (naam, score, datum) 
		VALUES (:naam, :score, :datum)");
		$stmt->bindParam(':naam', $naam);
		$stmt->bindParam(':score', $score);
		$stmt->bindParam(':datum', $datum);

		if (isset($_POST['naam'])){	
			$naam = $_POST['naam'];
			$score = $_POST['score'];
   
		   // Kijken of er gegooid is.
		   if($score == ''){
				echo "<script>alert('Er is is geen tijd!');</script>";
		   }
		   else {
				$stmt->execute();
		   }
		}
		/// Scores ophalen met select
		$sqlSelect = "SELECT * from scores ORDER BY score ASC";
		$data = $pdo->query($sqlSelect);

		foreach ($data as $row) {
			echo $row['id']." ";
			echo $row['naam']." ";
			echo $row['score']." ";
			echo $row['datum']." ";
			echo "</br>";
		} 
	?>

	<p id="uitvoer">Uitvoer</p>

	<p>
		<button onclick="startTimer()">Start</button>
	</p>
	<p>
	
		<button onclick="stopTimer()">Stop</button>
	</p>
	<form method="post">
		<input type="hidden" name="score" id="score">   
		<input type="submit" value="Je score opslaan !">
		<input type="text" name="naam" id="naam" value="Hans">
	</form>

</body>
</html>

