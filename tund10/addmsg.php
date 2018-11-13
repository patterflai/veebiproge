<?php
	//kutsume jällegist funtksioonide faili
	require("functions.php");
	$notice = null;
	if (isset($_POST["submitMessage"])){
		if($_POST["message"]!="siia sisesta oma sõnum ..." and !empty($_POST["message"])){ // !-ei tohi olla empty
			$message = test_input($_POST["message"]);
			$notice = saveamsg($message);
			
		}else{
			$notice = "Kirjuta ka midagi";
			}
		
	}
  $pageTitle = "Sõnumi lisamine";
  //echo $profilePic;
  require("header.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Anonüümse sõnumi lisamine</title>
</head>

<body background="c0c0c0c0">  <!--"lighty.jpg"-->  <!--style="transform:rotate(90deg);" -->
	<h1>
	 <font color="6a129f" >Sõnumi lisamine</h1></font><br/>	
	<font color="6a129f" ><p><b>rohkem siin polegi, aint <a href="https://www.tlu.ee/" target="_blank"><font color="6a129f" >TLÜ</font></a>, lol</b></p></font>
	
	<hr>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label><font color="#6a129f">Sõnum(max 256 märki):</font> </label>
	<br>
	<textarea rows="4" cols="64" name="message">siia sisesta oma sõnum ...</textarea>
	<br>
	
	<input type="submit" name="submitMessage" value="Salvesta sõnum">
	</form>
	<hr>
	<p><?php echo $notice; ?> </p>
	

</body>

</html>