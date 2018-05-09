<html>
<link rel="stylesheet" href="admin.css">
<script src="tableSort.js"></script>
<style>
th {
    cursor: pointer;
}
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<body>
<table border='1' id='myTable'>
	<tr>
	
	<th onclick=""><b><center>Lot Name</center></b></th>
	<th onclick=""><b><center>Max Capacity</center></b></th>
	<th onclick=""><b><center>Disabled Spots</center></b></th>
	<th onclick=""><b><center>Reservable Spots</center></b></th>
	<th onclick=""><b><center>Lot Status</center></b></th>
	<th onclick=""><b><center>Is It Reservable?</center></b></th>
	</tr>
</body>
</html>
<?php
$headers= array('Accept: application/json','Content-Type: application/json');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?table=parkinglot');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$response = curl_exec($ch);

$jsonDecoded = json_decode($response);


	echo "";

	for ($x = 0; $x < count($jsonDecoded); $x++)
	{
		$currentRow = get_object_vars($jsonDecoded[$x]);
		echo "<tr>";
		
		$lotStatusNum = $currentRow['LotStatus'];
		$lotStatusText = "";
		if ($lotStatusNum == 0) {
			$lotStatusText = "<b>Closed</b>";
		} else {
			$lotStatusText = "Open";	
		}

		$reservableNum = $currentRow['isReservable'];
		$reservableText = "";
		if ($reservableNum == 0) {
			$reservableText = "<b>No</b>";
		} else {
			$reservableText = "Yes";	
		}

		
		echo "<td><center>" . $currentRow['LotName'] . "</center></td>";
		echo "<td><center>" . $currentRow['MaxCapacity'] . "</center></td>";
		echo "<td><center>" . $currentRow['DisabledSpots'] . "</center></td>";
		echo "<td><center>" . $currentRow['ReservationSpots'] . "</center></td>";
		echo "<td><center>" . $lotStatusText . "</center></td>";
		echo "<td><center>" . $reservableText . "</center></td>";
		echo "</tr>";
	}

	echo "</table>";	

?>