<?php
	echo "minu esimene PHP!"; //php on backend keel, sest see toimib serveris
	$firstName = "Patrick";
	$lastName = "Paidla";
	//loeme piltide kataloogi sisu
	$dirToRead = "../../pics/";
	$allFiles = scandir($dirToRead);
	$picFiles = array_slice($allFiles,2 );
	//var_dump($picFiles);
	
	  $pageTitle = "Kasutajaprofiil";
  //echo $profilePic;
  require("header.php");
?>

	<h1>
	 <?php echo $firstName. " ". $lastName; ?>, IF18</h1><br/>	
	<p><b>rohkem siin polegi, aint <a href="https://www.tlu.ee/" target="_blank">TLÜ</a>, lol</b></p>
	<li><a href="main.php">Tagasi</a> pealehele!</li>
	<?php
	//<img src="" alt="pilt">
	for($i =0; $i< count($picFiles); $i++){
		echo '<img src="'.$dirToRead.$picFiles[$i].'"alt="pilt"><br>'."\n";
	}
	?>
</body>

</html>