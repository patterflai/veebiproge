<?php
	echo "minu esimene PHP!"; //php on backend keel, sest see toimib serveris
	$firstName = "Patrick";
	$lastName = "Paidla";
	//loeme piltide kataloogi sisu
	$dirToRead = "../../pics/";
	$allFiles = scandir($dirToRead);
	$picFiles = array_slice($allFiles,2 );
	//var_dump($picFiles);
	
	
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

<body style="background-color:#94152A;">
	<h1>
	 <?php echo $firstName. " ". $lastName; ?>, IF18</h1><br/>	
	<p><b>rohkem siin polegi, aint <a href="https://www.tlu.ee/" target="_blank">TLÜ</a>, lol</b></p>
	
	<?php
	//<img src="" alt="pilt">
	for($i =0; $i< count($picFiles); $i++){
		echo '<img src="'.$dirToRead.$picFiles[$i].'"alt="pilt"><br>'."\n";
	}
	?>
</body>

</html>