<?php
	echo "minu esimene PHP!"; //php on backend keel, sest see toimib serveris
	$firstName = "Patrick";
	$lastName = "Paidla";
	$randm = "Pats";
	$dateToday = date("d.m.Y");
	$hourNow = date("G");
	$minNow = date("G.i");
	$partOfDay = "";
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

<body style="background-color:#d9d9d9;">
	<h1>
	 <?php
		
		echo $firstName. " ". $lastName;
		
		
		
	 ?>, IF18</h1><br/>	
	<p><b>rohkem siin polegi, aint <a href="https://www.tlu.ee/" target="_blank">TLÜ</a>, lol</b></p>
		<?php
			echo "<p>Tänane kuupäev on: " .$dateToday.".</p> \n";
			echo "<p>Lehe avamise hetkel oli kell: ".date("H:i:s").". Käes on ". $partOfDay. ".</p>\n";
			echo "<p>Ja kellaaeg sealjuures: ".$hourNow. ".</p> \n";
		?>
	<img src="/~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_3.jpg" alt="Pilt. TLÜ Terra uks">
	<img src="../../~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_2.jpg" alt="Pilt. TLÜ Terra uks">
	<!--<img src="http://greeny.cs.tlu.ee/~rinde/veebiprogrammeerimine2018s/tlu_terra_600x400_3.jpg" alt="Pilt. TLÜ Terra uks"> -->

	 <p>mul on ka sõber, kes teeb ka oma <abbr title="comic sansi mees"><a href="../../~laurton/" style="color:black" target="_blank">veebi</a></abbr> teine on lambim, aga tal on ka oma<abbr title="niisama mees"><a href="/~andrnar/"  style="color:black" target="_blank"> leht</a></p></abbr>
	
	
	
	

</body>

</html>