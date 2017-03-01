<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Guts</title>
</head>
<meta http-equiv="refresh" content="5">
<body>
<table>
<?php
try{
    $host = "us-cdbr-azure-southcentral-e.cloudapp.net";
    $user = "b19ec25c962f50";
    $pwd = "96bb191a";
    $db = "guts";
 $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}  catch(Exception $e){
        die(var_dump($e));
    }
	 $sql_select = "SELECT * FROM points";
    $stmt = $conn->query($sql_select);
    $schools = $stmt->fetchAll();
	$j = 0;
	if(count($schools) > 0) {
	
        echo "<h2>Current Standings:</h2>";
   
        foreach($schools as $school) {
		if($j%5==0){
			echo "<tr>";
		}
			$sum = 0;
			for($i=1;$i<=36;$i++){
				$sum = $sum +$school['P'.$i];
			}
			echo "<td>";
           echo $school['School']." ".$sum." points"."</br>";
		   echo "<progress value=\"".$sum."\" max=\"340\"></progress>";
		   echo "</br> </br> </br> </br>";
		   echo "</td>";
		   if($i%5==4){
			echo "</tr>";
		   }
		   $j++;
        }
       
    } else {
        echo "<h3>No one is currently registered.</h3>";
    }
?>
</tr>
</table>


</body>
</html>
