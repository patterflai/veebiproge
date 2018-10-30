<?php
	$catname=null;
	$catcolor = null;
	$catlength= null;
	

	//kutsume jällegist funtksioonide faili
	require("functions.php");
	$cats=showcats();
	$notice = null;
	$catlist = showcats();
	if (isset($_POST["submitMessage"])){
		if($_POST["nimi"]!=empty($_POST["nimi"]) and $_POST["v2rv"]!=empty($_POST["v2rv"]) and $_POST["saba"]!=empty($_POST["saba"])){
			$catname = test_input($_POST["nimi"]);
			$catcolor=test_input($_POST["v2rv"]);
			$catlength=test_input($_POST["saba"]);
			$notice = addcat($catname,$catcolor,$catlength);
			
		}else{
			$notice = "Kirjuta ka midagi";
		}
		
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>kasside lisamine</title>
</head>

<body background="c0c0c0c0">  <!--"lighty.jpg"-->  <!--style="transform:rotate(90deg);" -->
	<h1>
	 <font color="6a129f" >Kassiteema</h1></font><br/>	
	<font color="6a129f" ><p><b>rohkem siin polegi, aint <a href="https://www.tlu.ee/" target="_blank"><font color="6a129f" >TLÜ</font></a>, lol</b></p></font>
	
	<hr>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label><font color="#6a129f">Kasside lisamine<font> </label>
	<br>
	<p>Kassi nimi</p>
	<input type="text" name="nimi">
	<p>Kassi värv</p>
	<input type="text" name="v2rv">
	<p>Kassi saba pikkus</p>
	<input type="number" name="saba">
	<br>
	
	<input type="submit" name="submitMessage" value="Saaada andmed serverisse">
	</form>
	
	<br>
	
	<hr>
	<p><?php foreach($cats as $cat): ?>
                <?= $cat['id_kass'] ?> <?= $cat['nimi'] ?> <?= $cat['v2rv'] ?> <?= $cat['saba'] ?><br>
            <?php endforeach; ?></p>
	

</body>

</html>