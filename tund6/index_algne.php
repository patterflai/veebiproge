<?php
	echo "minu esimene PHP!"; //php on backend keel, sest see toimib serveris
	$firstName = "Patrick";
	$lastName = "Paidla";
	$randm = "Pats";
	$dayToday = date("d");
	$yearToday = date("Y");
	$monthToday = date("m");
	$hourNow = date("G");
	$minNow = date("G.i");
	$partOfDay = "";
	$weekdayNow = date("N");
	$daynames = ["esmaspäev","teisipäev","kolmapäev","neljapäev","reede","laupäev","pühapäev"];
	$monthnames=["jaanuar","veebruar","märts","aprill","mai","juuni","juuli","august","september","oktoober","november","detsember"];
	//echo $daynames[1];
	//var_dump($daynames);
	if ($hourNow < 8){
		$partOfDay = "varane hommik, tagasi magama";
			
		}
	if ($hourNow >= 8 and $hourNow <16){
		$partOfDay = "kooliaeg";
			
		}
	if ($hourNow >=16){
		$partOfDay = "vabaaeg";
			
		}
	/*if ($minNow =15.20 or $minNow = 3.20){
		$partOfDay = "kell on 3.20";
			
		}*/
	$picNum = mt_rand(1,43);
	$picNum2 = rand(1,43);
	//echo $picNum;
	$picURL = "http://www.cs.tlu.ee/~rinde/media/fotod/TLU_600x400/tlu_";
	$picEXT = ".jpg";
	$picfile= $picURL.$picNum.$picEXT;
	$picfile2= $picURL.$picNum2.$picEXT;
	//echo picfile;
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		<?php
			echo $firstName. " ". $lastName. ", ";
			echo $randm;
		 
		?>
	</title>
</head>

<body style="background-color:#94152A;">
	<h1>
	 <?php
		
		echo $firstName. " ". $lastName;
		
		
		
	 ?>, IF18</h1><br/>	
	<p><b>rohkem siin polegi, aint <a href="https://www.tlu.ee/" target="_blank">TLÜ</a>, lol</b></p>
	<p>
	Tundides tehtu: <a href="photo.php" target="_blank">meemileht,<a href="photo2.php" target="_blank"> PäevaKekk, </a><a href="page.php" target="_blank"> leht</a>
	</p>
		<?php
			//echo "<p>Tänane kuupäev on: " .$dateToday.".</p> \n";
			//echo "<p>Täna on ".$weekdayNow.", " .$dateToday.".</p> \n";
			echo "<p>Täna on ".$daynames[$weekdayNow-1].", " .$dayToday.". " .$monthnames[$monthToday-1]." " .$yearToday.".</p> \n";
			echo "<p>Lehe avamise hetkel oli kell: ".date("H:i:s").". Käes on ". $partOfDay. ".</p>\n";
			echo "<p>Ja kellaaeg sealjuures: ".$hourNow. ".</p> \n";
			//foreach($daynames as $weekdayNow){
			//	echo "$weekdayNow <br>";
			
			//echo "<p>Täna on: ". $weekdayNow. "</p> \n";
			
		?>
		<img src=<?php echo $picfile; ?> alt="Pilt. TLÜ Terra uks">
		<img src=<?php echo $picfile2; ?> alt="Pilt. TLÜ Terra uks">
	<!--<img src="/~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_3.jpg" alt="Pilt. TLÜ Terra uks">
	<img src="../../../~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_2.jpg" alt="Pilt. TLÜ Terra uks">
	<<img src="http://greeny.cs.tlu.ee/~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_3.jpg" alt="Pilt. TLÜ Terra uks"> -->

	 <p>mul on ka sõber, kes teeb ka oma <abbr title="comic sansi mees"><a href="/~laurton/" style="color:black" target="_blank">veebi</a></abbr> teine on lambim, aga tal on ka oma<abbr title="niisama mees"><a href="/~andrnar/"  style="color:black" target="_blank"> leht</a></p></abbr>
	
	
	
	<br></br>
</body>

</html>