<?php
  //kutsume välja funktsioonide faili
  require("functions.php");
  $notice = "";
  $firstName = "";
  $lastName = "";
  $birthMonth = null;
  $birthDay = null;
  $birthYear = null;
  $birhtDate = null;
  $gender = null;
  $email = "";
  $password ="";
  
  $monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni","juuli", "august", "september", "oktoober", "november", "detsember"];
  
  
  $firstNameError = "";
  $lastNameError = "";
  $birthMonthError = "";
  $birthDayError = "";
  $birthYearError = "";
  $birhtDateError = "";
  $genderError = "";
  $emailError = "";
  $passwordError = "";
  
  
  //kontrollime, kas kasutaja on midagi kirjutanud
 if(isset($_POST["submitUserData"])){
  //var_dump($_POST);
  if (isset($_POST["firstName"]) and !empty($_POST["firstName"])){
	  //$firstName = $_POST["firstName"];
	  $firstName = test_input($_POST["firstName"]);
  }else{
	 $firstNameError = "Palun sisesta oma eesnimi!";
  
  }
  if (isset($_POST["lastName"]) and !empty($_POST["lastName"])){
	  //$firstName = $_POST["firstName"];
	  $lastName = test_input($_POST["lastName"]);
  }else{
	 $lastNameError = "Palun sisesta oma perenimi!";
  
  }

 if(isset($_POST["gender"])and !empty($_POST["gender"])) {
	 $gender = intval($_POST["gender"]);
 }else{
	 $genderError = "Palun täpsusta enda sugu";
 }
  if(isset($_POST["email"])and !empty($_POST["email"])) {
	 $email = $_POST["email"];
 }else{
	 $emailError = "Palun täpsusta enda email";
 }
   if(isset($_POST["password"])and !empty($_POST["password"])) {
	 $password	= $_POST["password"];
 }else{
	 $passwordError = "Palun vaata, et parool oleks vähemalt 8 märki";
 }
 if(isset($_POST["birthDay"]) and isset($_POST["birthMonth"]) and isset($_POST["birthYear"])){
	  //kas oodatav kuupäv on üldse võimalik
	  if(checkdate(intval($_POST["birthMonth"]), intval($_POST["birthDay"]), intval($_POST["birthYear"]))){
	  //kui on võimalik, teeme kuupeävaks 
	  $birthDate=date_create($_POST["birthMonth"]."/".$_POST["birthDay"]."/". $_POST["birthYear"]);
	  $birthDate = date_format($birthDate, "Y-m-d");
	  
	  }else{
	  $birthDateError ="Mingi kammajaa, vaata kuupäevad üle";
 }
	 
 }
 //kui kõik korras, siis salvetan kasutaja
 if(empty($firstNameError)and empty($lastNameError)and empty($birthMonthError)and empty($birthDayError)and empty($birthYearError)and empty($birhtDateError)and empty($genderError)and empty($emailError)and empty($passwordError)){
	$notice = signup($firstName,$lastName,$birthDate,$gender,$email, $password);
 }

 }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">                                                    
	<title>Uue konto loomine</title>
</head>
<body>
	<h1>Konto loomine</h1>
	<p>See leht on loodud <a href="http://www.tlu.ee" target="_blank">TLÜ</a> õppetöö raames, ei pruugi parim väljanäha ning kindlasti ei sisalda tõsiseltvõetavat sisu!</p>
	
	<hr>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Eesnimi:</label><br>
	  <input type="text" name="firstName" value="<?php echo $firstName; ?>"><span><?php echo $firstNameError; ?></span><br>
	  <label>Perekonnanimi:</label><br>
	  <input type="text" name="lastName" value="<?php echo $lastName; ?>"><span><?php echo $lastNameError; ?></span><br>
	  <label>Sünnipäev: </label><?php echo $birthDayError; ?></span>
	  <?php
	    echo '<select name="birthDay">' ."\n";
		for ($i = 1; $i < 32; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthDay){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <label>Sünnikuu: </label><span><?php echo $birthMonthError; ?></span>
	  <?php
	    echo '<select name="birthMonth">' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthMonth){
				echo " selected ";
			}
		echo ">" .$monthNamesET[$i - 1] ."</option> \n";
		}
		echo "</select> \n";

	  ?>
	  <label>Sünniaasta: </label><?php echo $birthYearError; ?></span>
	  <!--<input name="birthYear" type="number" min="1914" max="2003" value="1998">-->
	  <?php
	    echo '<select name="birthYear">' ."\n";
		for ($i = date("Y")-15; $i >= date("Y") - 100; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthYear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>

	  <br>
	  <input type="radio" name="gender" value="2" <?php if($gender==2){echo "checked";} ?>><label>Naine</label><span><?php echo $genderError; ?></span><br>
	  <input type="radio" name="gender" value="1"<?php if($gender==1){echo "checked";} ?>><label>Mees</label><span><?php echo $genderError; ?></span><br> 
		<br>
		<label> E-postiaadress(kasutajatunnus) </label><span><?php echo $emailError; ?></span><br>
		<input name="email" type ="email" value="<?php echo $email; ?>">
		<br>
		<label> Salasõna (min 8 märki): </label><span><?php echo $passwordError; ?></span><br>
		<input name="password" type="password">
		<br>
	  <input type="submit" name="submitUserData" value="Loo kasutaja">
    </form>
	<hr>
	<p><?php echo $notice; ?></p>
</body>
</html>