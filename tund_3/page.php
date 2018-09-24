<?php
	//echo "minu esimene PHP!"; //php on backend keel, sest see toimib serveris
	$firstName = "Kodanik";
	$lastName = "Tundmatu";
	$birthMonth = "";
	$monthToday =date("n");
	$monthnames=["jaanuar","veebruar","märts","aprill","mai","juuni","juuli","august","september","oktoober","november","detsember"];
	//kontrollime, kas kasutajja pon  idagi krijtuanud
	//var_dump($_POST);
	//echo $monthToday;
	if (isset($_POST["firstName"])){
		$firstName = $_POST["firstName"];
	}
	if (isset($_POST["lastName"])){
		$lastName = $_POST["lastName"];
		
		}	
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

<body background="#cecece">  <!--"lighty.jpg"-->  <!--style="transform:rotate(90deg);" -->
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
	<input type="number" min="1914" max="2000" value="1998" name="birthYear">
	<select name="birthMonth"> 

		<option value="1" <?php if ($monthToday== '1'){echo 'selected';}?>>jaanuar</option>
  		<option value="2"<?php if ($monthToday== '2'){echo 'selected';}?>>veebruar</option>
 		<option value="3"<?php if ($monthToday== '3'){echo 'selected';}?>>märts</option>
 		<option value="4"<?php if ($monthToday== '4'){echo 'selected';}?>>aprill</option>
 		<option value="5"<?php if ($monthToday== '5'){echo 'selected';}?>>mai</option>
 		<option value="6"<?php if ($monthToday== '6'){echo 'selected';}?>>juuni</option>
 		<option value="7"<?php if ($monthToday== '7'){echo 'selected';}?>>juuli</option>
 		<option value="8"<?php if ($monthToday== '8'){echo 'selected';}?>>august</option>
 		<option value="9" <?php if ($monthToday== '9'){echo 'selected';}?>>september</option>
 		<option value="10"<?php if ($monthToday== '10'){echo 'selected';}?>>oktoober</option>
  		<option value="11"<?php if ($monthToday== '11'){echo 'selected';}?>>november</option>
  		<option value="12"<?php if ($monthToday== '12'){echo 'selected';}?>>detsember</option> 
		<?php
			echo $months;
		?>		
	</select>
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