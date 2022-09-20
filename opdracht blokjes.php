<?php
/*
 CREATE TABLE `scores` (
  `id` int(10) NOT NULL,
  `naam` varchar(30) NOT NULL,
  `score` varchar(10) NOT NULL,
  `datum` varchar(30) NOT NULL
);
*/
// database connectie importeren
include "connectpdo.php";

// Datum en tijd genereren
echo "<h3>Voorbeeld oefening 26 met score in de database opslaan</h3>";
$datum = date('d-m-Y H:i:s');
$score = 0;
//echo "<h4>$datum</h4>";
echo "<strong>ID, naam, score, datum en tijdstip</strong></br>";

// INSERT query maken en uitvoeren.
    $stmt = $conn->prepare("INSERT INTO scores (naam, score, datum) 
    VALUES (:naam, :score, :datum)");
    $stmt->bindParam(':naam', $naam);
    $stmt->bindParam(':score', $score);
    $stmt->bindParam(':datum', $datum);

    // Als er een waarde is INSERT rij
    if (isset($_POST['naam']))
 {
   $naam = $_POST['naam'];
   $score = $_POST['score'];
   
   // Kijken of er gegooid is.
   if($score == '')
   {
      echo "<script>alert('Je moet eerst gooien!');</script>";
   }
       
   // controleer of de score geldig is  (kleiner dan 7 boven de 0)
   if($score <7 && $score > 0)
{
    $stmt->execute();
}
else
{
    echo "<h4>Je speelt vals: CHEATER!!!</h4></br>";
}
}
/// Scores ophalen met select
$sqlSelect = "SELECT * from scores";
$data = $conn->query($sqlSelect);
    
foreach ($data as $row) {
    echo $row['id']." ";
    echo $row['naam']." ";
    echo $row['score']." ";
    echo $row['datum']." ";
    echo "</br>";
} 
echo "<a href='spelwissen.php'>Scores uit de database wissen.</a>";

/* Voorbeeld wissen scores. (spelwissen.php)

   // database connectie
    include "connectpdo.php";

    // sql voor het verwijderen.
    $sql = "DELETE FROM scores";

    // Uitvoeren query
    $conn->exec($sql);
   
    // Terugsturen naar de hoofdpagina
    header('Location: spelvoorbeeld.php');

*/

?>
<html>
    <head>
        <title>Voorbeeld score opslaan in de database</title>
        <style>
        h4
        {
        color: red;
        }
</style>
    </head>
    <body>
        <h1>Gooi een getal</h1>        
        <p><button onclick="gooi()">Gooi !</button></p>
        <p id="uitvoer">Je gooide nog niets...</p>
        
<form method="post">
Geef je naam: <input type="text" name="naam" id="naam" value="Hans">
        <!-- hidden fields zijn niet zichtbaar maar de waarden worden wel in de database gezet. !-->
        <input type="hidden" name="score" id="score">        
        <input type="submit" value="Je score opslaan !">
    </form>
        <script>
        // Javascript code van opdracht 26.
            function gooi()
            {
                // Bepaal een willekeurig getal tussen de 1 en de 6 
                var worp = Math.floor(Math.random() * 6 + 1);
                
                switch(worp) {
                    case 1:
                    /* weergave van het getal op het scherm */
                        document.getElementById("uitvoer").innerHTML =
                        "<img src='dobbel-een.png' alt='één'>";
                    /* Het geheim...zet de gegooide waarde in het hiddenfield score. */
                        document.getElementById("score").value = 1;
                        break;
                    case 2:
                        document.getElementById("uitvoer").innerHTML =
                        "<img src='dobbel-twee.png' alt='twee'>";
                        document.getElementById("score").value = 2;
                        break;
                    case 3:
                        document.getElementById("uitvoer").innerHTML =
                        "<img src='dobbel-drie.png' alt='drie'>";
                        document.getElementById("score").value = 3;
                        break;
                    case 4:
                        document.getElementById("uitvoer").innerHTML =
                        "<img src='dobbel-vier.png' alt='vier'>";
                        document.getElementById("score").value = 4;
                        break;
                    case 5:
                        document.getElementById("uitvoer").innerHTML =
                        "<img src='dobbel-vijf.png' alt='vijf'>";
                            document.getElementById("score").value = 5;
                        break;
                    case 6:
                        document.getElementById("uitvoer").innerHTML =
                        "<img src='dobbel-zes.png' alt='zes'>";
                            document.getElementById("score").value = 6;
                        break;
                    default:
                        // niet nodig,worp is altijd 1 t/m 6
                        }
            }
        </script>
    </body>
</html>

<form method="post">
    <input type="submit" name="submit" value="Klik voor de broncode">
</form>
<?php
// Functie PHP broncode weergeven.
if(isset($_POST['submit'])){
    show_source(__FILE__);
} 