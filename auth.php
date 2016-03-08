<?
if((isset($_POST["user"])) AND (isset($_POST["pass"]))){

	include("config.php");
	$pdo=new PDO('mysql:host=localhost;dbname='.$mysqlDatabase, $mysqlUser, $mysqlPass);
	$exists=false;
	$rightPass=false;
	$pass=md5($_POST["pass"]);
	
	foreach($pdo->query("SELECT * FROM `user` WHERE `username`='".$_POST["user"]."'") as $row){
		$exists=true;
		if($pass==$row["password"]){
			$rightPass=true;
		}
	}
	$randomNumber=rand(0, 10274927);
	$hash=md5(md5($_POST["user"]).$randomNumber);
	
	$alredSess=false;
	foreach($pdo->query("SELECT * FROM `sessions` WHERE `username`='".$_POST["user"]."'") as $row){
		$alredSess=true;
	}
	
	if($alredSess){
		$expires=time()+60*60*2;
		$statement = $pdo->prepare("UPDATE `sessions` SET `id`='".$hash."',`expires`='".$expires."' WHERE `username`='admin'");
		$statement->execute(); 
	}else{
		$statement = $pdo->prepare("INSERT INTO sessions (`id`, `username`, `expires`) VALUES (?, ?, ?)");
		$statement->execute(array($hash, $_POST["user"], time()+60*60*2)); 
	}
	if($exists){
		if($rightPass){
			echo '{"status":"Successfully logged in!", "session-id":"'.$hash.'"}';
		}else{
			echo '{"err":"Authentification failed"}';
		}
	}else{
		echo '{"err":"User doesn\'t exists"}';
	}
		
}else{
	echo '{"err":"Invalid parameters"}';
}
?>