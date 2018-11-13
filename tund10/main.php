<?php
  require("functions.php");
  //kui pole sisselogitud, siis logimise lehele
  if(!isset($_SESSION["userId"])){
	 header("Location: index_1.php");
	 exit();
  }
 //logime välja
 if(isset($_GET["logout"])){
	 session_destroy();
	 header("Location: index_1.php");
	 exit();
 }
 
 $pageTitle="pealeht";
 require("header.php");
 
?>


	<p>See leht on valminud <a href="http://www.tlu.ee" target="_blank">TLÜ</a> õppetöö raames ja ei oma mingisugust, mõtestatud või muul moel väärtuslikku sisu.</p>

	<hr>
	<p>Oled sisse loginud nimega: <?php echo $_SESSION["firstName"]." ".$_SESSION["lastName"] ."."; ?> </p>
	<ul>
	<li>Koduleht</li>
	<li><a href="photo.php">Meemid</a></li>
	<li><a href="addmsg.php">Sõnumite lisamine</a></li>
	<li><a href="validatemsg.php">Valideeri anonüümseid sõnumeid</a></li>
	<li><a href="users.php">liikmed</a></li>
	<li><a href="validatedmessages.php">Näita valideeritud sõnumeid</a></li>
	<li><a href="userprofile.php">kasutaja kirjelduse lisamine</a></li>
	<li><a href="photoupload.php">Fotyode üleslaadimine</a></li>
	<li><a href="?logout=1">Väljalogimine</a></li>
	</ul>
	
  </body>
</html>