<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Input Scores</title>
</head>
<body>
<?php
$tuser = $_POST["user"];
$tpass = $_POST["pass"];
$p = 1;
if($tuser == null){
	$user = $_COOKIE["user"];
	$pwd = $_COOKIE["pass"];
	$p=0;
}else{
	$user = $tuser;
	$pwd = $tpass;
}
try{
    $host = "us-cdbr-azure-southcentral-e.cloudapp.net";
    $db = "guts";
	$conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
}  catch(Exception $e){
	echo "Wrong username/password man";
        die();
    }
	setCookie("user", $user,time()+ 86400, "/");
	setCookie("pass", $pwd, time() + 86400, "/");
	?>
	
	Team: 
	<select id="sch" name="school">
	<?php
	$query = "SELECT School FROM points";
	$res = $conn->query($query);
	$schools = $res->fetchAll();
	foreach($schools as $school){
		echo "<option> ".$school['School']." </option>";
	}
	?>
	</select><br>
	<br>Problem:
	<select id="prob" name = "prob">
	<?php
	
	for($i=0;$i<9;$i++){
		echo "<option>". (4*$i+1).','.(4*$i+2).','.(4*$i+3).','.(4*$i+4)." </option>";
	}
	?>
	</select><br>
	
	<br> Score:
	<input type="text" id="score" name="score"><br>
	<br>
	Score:
	<input type="text" id="score2" name="score2"><br>
	
	<br>
	Score:
	<input type="text" id="score3" name="score3"><br>
	
	<br>
	Score:
	<input type="text" id="score4" name="score4"><br>
	
	<button id="btn1" onClick= "inScore()">Submit</button>
	<SCRIPT src="js/jquery-1.11.0.js"></SCRIPT>
<script>
	function inScore(){
	
	var school = sch.value;
	var probs = prob.value;
	var scores = score.value+','+score2.value+','+score3.value+','+score4.value;
		$.ajax({
			url: '/GutsPost.php',
			type: 'post',
			data: 'school='+school+'&prob='+probs+'&score='+scores,
			success: function(output)
			{
				alert('Success, scores have been updated');
			}, error: function(output)
			{
				alert('well darn, it failed ');
			}
		});
	}
</script>
</body>

</html>
