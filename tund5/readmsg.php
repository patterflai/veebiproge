<?php
	//kutsume jällegist funtksioonide faili
	require("functions.php");
	$notice = listallmessages();


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Anonüümsete sõnumite lugemine</title>
</head>

<body background="c0c0c0c0">  <!--"lighty.jpg"-->  <!--style="transform:rotate(90deg);" -->
	<h1>
	 <font color="6a129f" >Sõnumid</h1></font><br/>	
	<font color="6a129f" ><p><b>rohkem siin polegi, aint <a href="https://www.tlu.ee/" target="_blank"><font color="6a129f" >TLÜ</font></a>, lol</b></p></font>
	<hr>
	<?php
		echo $notice;
	?>

	

</body>

</html>