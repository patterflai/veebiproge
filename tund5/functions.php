<?php
	//laen andmebaasi info
	require("../../../config.php");
	//echo $GLOBALS["serverUsername"];
	$database = "if18_patrick_pa_1";
	 //anonüümse sõnumi salvestamin
	 
	 function signup($firstName,$lastName,$birthDate,$gender,$email, $password){
		 $notice = "";
		 $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		 $stmt = $mysqli->prepare("INSERT INTO vpusers(firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
		echo $mysqli->error;
		//valmistame parooli salvestamiseks- krpteerime, teeme räsi
		 $options = [
		 "cost"=> 12,
		 "salt" => substr(sha1(rand()), 0,22),];
		 $pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
		$stmt->bind_param("sssiss", $firstName,$lastName,$birthDate,$gender,$email,$pwdhash);
		if($stmt->execute()){
			$notice= "Uue kasutaja lisamine õnnestus!";
		}else{
			$notice="Kasutaja lisamisel tekkis tõrge ;( ".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		return $notice;
		
	 }
	 function saveamsg($msg){
		$notice = "";
		//serveri ühendus (server, kasutaja, parool, andmebaas)
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//valmistan ette sql käsu
		$stmt = $mysqli->prepare("INSERT INTO vpamsg(message) VALUES(?)");
		echo $mysqli->error;
		//asendame SQL käsus ? päris infoga (andmetüüp, andmed ise)
		//s- string, i - integer, d- decimal(murdarv)
		$stmt->bind_param("s", $msg);
		if($stmt->execute()){
			$notice = 'Sõnum: "'.$msg.'" on salvestatud';
		
		}else {
			$notice = "Sõnumi salvestamisel tekkis tõrge: ".$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
		return $notice;
		
	 }
	 function listallmessages(){
		 $msgHTML = "";
		 $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"],$GLOBALS["database"]);
		 $stmt = $mysqli->prepare("SELECT message FROM vpamsg");
		 echo $mysqli -> error;
		 $stmt->bind_result($msg);
		 $stmt->execute();
		 while($stmt->fetch()){
			 $msgHTML .= "<p>".$msg."</p> \n";

		 }
		 $stmt->close();
		$mysqli->close();
		return $msgHTML;
		 
	 }
	function addcat($catname, $catcolor,$catlength){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO kass(nimi, v2rv, saba) VALUES(?,?,?)");
		echo $mysqli->error;
		$stmt->bind_param("ssi", $catname,$catcolor,$catlength);
		$stmt->execute();
		$stmt->close();
	}
		
	 function showcats(){
		 $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"],$GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT * FROM kass");
		$id = "";
		$name = "";
		$color = "";
		$tail_length = "";
		$stmt-> bind_result($id, $name,$color,$tail_length);
		$stmt -> execute();
		while($stmt->fetch()) {
        $cats[] = [
            'id_kass' => $id,
            'nimi' => $name,
            'v2rv' => $color,
            'saba' => $tail_length];
		}
		$stmt->close();
		return $cats;
	
	}

		 
	//tekstsisestuse kontroll
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>