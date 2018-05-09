<html>
<link rel="sheet" href="admin.css">
<script src="deleteRow.js"></script>
<style>
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<th><b><center>Delete Row</center></b></th>-->
</html>

<?php
$headers= array('Accept: application/json','Content-Type: application/json');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?table=complaints');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$response = curl_exec($ch);

$jsonDecoded = json_decode($response);

	ini_set("mssql.textlimit" , "2147483647");
	ini_set("mssql.textsize" , "2147483647");
	ini_set("odbc.defaultlrl", "100k");

	echo "<table border='1' id='myTable'>
	<tr>
	
	<th style='width:25%;'><b><center>From</center></b></th>
	<th><b><center>Report</center></b></th>
	<th style='width:15%;'><b><center>Timestamp</center></b></th>
	
	</tr>";


for ($x = 0; $x < count($jsonDecoded); $x++)
{
	$currentRow = get_object_vars($jsonDecoded[$x]);
	echo "<tr>";
	
	$userIDText = "";
	$userID = $currentRow['UserID'];
	if ($userID == 0) {
		$userIDText = "Contact Us Form";
	} else {
		$ch2 = curl_init();
		curl_setopt($ch2, CURLOPT_URL, "http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?table=user&id='$userID'");
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, $headers);
		curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "GET");
		$response2 = curl_exec($ch2);
		
		
		$array = json_decode($response2);
		$cr = get_object_vars($array[0]);

		$userIDText = $cr['Email'];
	}
	
	echo "<td><center>" . $userIDText . "</center></td>";
	echo "<td><center>" . $currentRow['Report'] . "</center></td>";
	echo "<td><center>" . $currentRow['TimestampComplaint'] . "</center></td>";
	/*echo "<td><center>
			<img src='http://icocentre.com/Icons/g-delete.png?size=16' 
				onclick='deleteRow(event,this.ID,counter)' alt='X' id='<?php echo $counter; ?>' style='width:20px;height:20px;'>
		</center></td>";*/
	echo "</tr>";
}

echo "</table>";	

?>
