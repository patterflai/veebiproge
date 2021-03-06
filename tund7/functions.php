<?php
	//laen andmebaasi info
	require("../../../config.php");
	//echo $GLOBALS["serverUsername"];
	$database = "if18_patrick_pa_1";
	 //anonüümse sõnumi salvestamin
	 //võtan kasutusele sessiooni
	 session_start();
	 
	 function description($message, $bgcolor, $textcolor){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt1 = $mysqli->prepare("SELECT description, bgcolor,txtcolor FROM vpuserprofiles WHERE userid=?");
		echo $mysqli->error;
		$stmt1->bind_param("i",$_SESSION["userId"]);
		$stmt1 ->bind_result($message,$bgcolor,$textcolor);
		$stmt1->execute();
		if($stmt1->fetch()){
			$stmt1->close();
			echo "uuendamine";
			$stmt = $mysqli->prepare("UPDATE vpuserprofiles SET description=?, bgcolor=?, txtcolor=? WHERE userid=?");
			echo $mysqli->error;
			$stmt->bind_param("sssi",$message,$bgcolor,$textcolor,$_SESSION["userId"]);
			if($stmt->execute()){
				$notice = 'Kirjeldus: "'.$message.'" on uuendatud';
			}
		}else{
			$stmt1->close();
			echo"salvestan";
			$stmt = $mysqli->prepare("INSERT INTO vpuserprofiles(userid, description, bgcolor, txtcolor) VALUES(?,?,?,?)");
			echo $mysqli->error;
			$stmt->bind_param("isss",$_SESSION["userId"],$message,$bgcolor,$textcolor);
			if($stmt->execute()){
				$notice = 'Kirjeldus: "'.$message.'" on salvestatud';
			}
			} 
			
			$stmt->close();
			$mysqli->close();
			return $notice;
			
		
	 }
	 //kõigi valideeritud sõnumite lugemini kasutajate kaupa
	 function readallvalidatedmessagesbyuser(){
		 $msgHTML = "";
		 $totalHTML="";
		 $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		 $stmt = $mysqli->prepare("select id, firstname, lastname from vpusers");
		 echo $mysqli->error;
		 $stmt ->bind_result($idFromDb,$firstnameFromDb, $lastnameFromDb);
		 $stmt2 = $mysqli->prepare("select message, accepted from vpamsg where acceptedby=?");
		 echo $mysqli->error;
		 $stmt2->bind_param("i", $idFromDb);
		 $stmt2->bind_result($msgFromDb, $acceptedFromDb);
		 $stmt->execute();
		//et hoida andmebaasist andeid kauem mälus, et saaks edasi kasutada
		$stmt->store_result();
		while($stmt->fetch()){

			$msgHTML = "<h3>".$firstnameFromDb." ".$lastnameFromDb."</h3> \n";
			$count=0;
			$stmt2->execute();
			while($stmt2->fetch()){
				$msgHTML .="<p><b>";
				if($acceptedFromDb == 1){
					$msgHTML.= "Lubatud: ";
				}else{
					$msgHTML.= "Keelatud: ";
				}
				$msgHTML .="</b>". $msgFromDb."</p> \n";
				$count++;
				
			}	
			if($count>0){
				$totalHTML.= $msgHTML;
				
			}
		}	
		
		$stmt->close();
		$stmt2->close();
		$mysqli->close();

		return $totalHTML;
			
		
	}
	 function listusers(){
		$notice="";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT firstname, lastname, email FROM vpusers WHERE id !=?");
		$stmt->bind_param("i",$_SESSION["userId"]);
		$stmt->bind_result($firstname,$lastname, $email);
		if($stmt->execute()){
		$notice .= "<ol> \n";
	  while($stmt->fetch()){
		 $notice .= "<li>" .$firstname ." " .$lastname .", kasutajatunnus: " .$email ."</li> \n";
	  }
	  $notice .= "</ol> \n";
	} else {
		$notice = "<p>Kasutajate nimekirja lugemisel tekkis tehniline viga! " .$stmt->error;
	}
	
	$stmt->close();
	$mysqli->close();
	return $notice;
  }
  
	 function validatemsg($editId,$validation){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt= $mysqli->prepare("update vpamsg set accepted=?, acceptedby=?, accepttime=now() where id=?");
		$stmt->bind_param("iii", $_POST["validation"],$_SESSION["userId"],  $editId);
		if($stmt -> execute()){
			echo "toimib";
			header("Location: validatemsg.php");
			exit();
		} else {
			echo "Tekkis viga: " .$stmt->error;
	}
	$stmt->close();
	$mysqli->close();
  }
	function allvalidmessages(){
		$html="";
		$accepted=1;
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt=$mysqli->prepare("select message from vpamsg where accepted=? order by accepted desc");
		echo $mysqli->error;
		$stmt ->bind_param("i", $accepted);
		$stmt ->bind_result($msg);
		$stmt -> execute();
		while($stmt -> fetch()){
			$html .="<p>".$msg."</p> \n";
	
	}
	$stmt ->close();
	$mysqli->close();
	if(empty($html)){
		$html = "<p>Kontrollitud sõnumeid pole.</p>";
	}
	return $html;
	}
	 
	 //laenh sõnumi valideerimiseks
	function readmsgforvalidation($editId){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT message FROM vpamsg WHERE id = ?");
	$stmt->bind_param("i", $editId);
	$stmt->bind_result($msg);
	$stmt->execute();
	if($stmt->fetch()){
		$notice = $msg;
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
  }
	function readallunvalidatedmessages(){
	$notice = "<ul> \n";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT id, message FROM vpamsg WHERE accepted IS NULL ORDER BY id DESC");
	echo $mysqli->error;
	$stmt->bind_result($id, $msg);
	$stmt->execute();
	
	while($stmt->fetch()){
		$notice .= "<li>" .$msg .'<br><a href="validatemessage.php?id=' .$id .'">Valideeri</a>' ."</li> \n";
	}
	$notice .= "</ul> \n";
	$stmt->close();
	$mysqli->close();
	return $notice;
  }
	 function signin($email, $password){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, firstname, lastname, password FROM vpusers WHERE email=?");
		$mysqli->error;
		$stmt->bind_param("s",$email);
		$stmt->bind_result($idFromDb, $firstnameFromDb, $lastnameFromDb, $passwordFromDb);
		if($stmt->execute()){
			//kui õnnestus andmebaasi lugemine
			if($stmt->fetch()){
				//kasutaja leiti, kontrollime aprooli
				if(password_verify($password, $passwordFromDb)){
					//pwd õige
					$notice="Sisselogimine õnnestus!";	
					$_SESSION["userId"] = $idFromDb;
					$_SESSION["firstName"] = $firstnameFromDb;
					$_SESSION["lastName"] = $lastnameFromDb;
					$stmt->close();
					$mysqli->close();
					header("Location: main.php");
					exit();
				}else{
					$notice = "VAle parool!";
				}
			}else{
				$notice="Sellist kasutajat (".$email.") ei leitud!";
			}
		} else {
		$notice = "tekkis tehiniline viga".$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
		return $notice; 
	 }
	 
	function signup($name, $surname, $email, $gender, $birthDate, $password){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//kontrollime, ega kasutajat juba olemas pole
		$stmt = $mysqli->prepare("SELECT id FROM vpusers WHERE email=?");
		echo $mysqli->error;
		$stmt->bind_param("s",$email);
		$stmt->execute();
		if($stmt->fetch()){
		//leiti selline, seega ei saa uut salvestada
		$notice = "Sellise kasutajatunnusega (" .$email .") kasutaja on juba olemas! Uut kasutajat ei salvestatud!";
		} else {
		$stmt->close();
		$stmt = $mysqli->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
    	echo $mysqli->error;
			$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
			$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
			$stmt->bind_param("sssiss", $name, $surname, $birthDate, $gender, $email, $pwdhash);
			if($stmt->execute()){
				$notice = "ok";
	    } else {
			$notice = "error" .$stmt->error;	
	    }
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