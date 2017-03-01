<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
ini_set('display_errors', 'On');
?>
<head>
    <title>Kek</title>
</head>
<body>
Working on it...
<?php
try{
    $host = "us-cdbr-azure-southcentral-e.cloudapp.net";
    $db = "guts";
	$user = $_COOKIE["user"];
	$pwd = $_COOKIE["pass"];
	$conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
}  catch(Exception $e){
	echo "Wrong username/password man";
        die(var_dump($e));
    }
	$probs = explode(",",$_POST['prob']);
	$school = $_POST['school'];
	$scores = explode(",",$_POST['score']);
	for($i=0;$i<4;$i++){
	 $q = "UPDATE points SET P".$probs[$i]."='".$scores[$i]."' WHERE School = '".$school."';";
	 try{
	$conn->query($q);
	}catch(Exception $e){
	die(var_dump($e));
	}
	}
	try{
	$conn->query($q);
	}catch(Exception $e){
	die(var_dump($e));
	}
	?>
</body>
</html>
