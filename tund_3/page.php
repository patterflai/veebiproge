<?php
	//echo "minu esimene PHP!"; //php on backend keel, sest see toimib serveris
	$firstName = "Kodanik";
	$lastName = "Tundmatu";
	//kontrollime, kas kasutajja pon  idagi krijtuanud
	//var_dump($_POST);
	if (isset($_POST["firstName"])){
		$firstName = $_POST["firstName"];
	}
	if (isset($_POST["lastName"])){
		$lastName = $_POST["lastName"];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		<?php
			echo $firstName. " ". $lastName. ", ";
		?>
	</title>
</head>

<body background="lighty.jpg"> <!--style="transform:rotate(90deg);" -->
<font color="#6a129f">
	<h1>
	 <font color="6a129f" ><?php echo $firstName. " ". $lastName; ?>, IF18</h1></font><br/>	
	<font color="6a129f" ><p><b>rohkem siin polegi, aint <a href="https://www.tlu.ee/" target="_blank"><font color="6a129f" >TLÜ</font></a>, lol</b></p></font>
	
	<hr>
	
	<form method="POST"> 
	<label><font color="#6a129f">Eesnimi:</font> </label>
	<input type="text" name="firstName">
	<label><font color="#6a129f">Perekonnanimi:</font></label>
	<input type="text" name="lastName">
	<label><font color="#6a129f">Sünniaasta: </font></label>
	<input type="number" min="1914" max="2000" value="1999" name="birthYear">
	<br>
	<input type="submit" name="submitUserData" value="Saada andmed">
	</form>
	<hr>
	<?php
		if (isset($_POST["firstName"])){
			echo "<p><font color='#6a129f'>Olete elanud järgnevatel aastatel: </font></p> \n";
			echo "<ol> \n";
			for ($i = $_POST["birthYear"]; $i <=date("Y");$i++){
				echo "<li>".$i."</li> \n";
			}
			
			echo "</ol> \n";
			
		}
	
	
	?>
	<!--<img src="lighty.jpg" style="transform:rotate(270deg);"> -->
	
	</font>
</body>

</html>