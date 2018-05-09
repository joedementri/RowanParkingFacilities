
<link rel="sheet" href="admin.css">
<script src="deleteRow.js"></script>
<style>
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php

include('lotIDtoLotName.php');

$headers= array('Accept: application/json','Content-Type: application/json');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?table=reservation');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$response = curl_exec($ch);

$jsonDecoded = json_decode($response);




	ini_set("mssql.textlimit" , "2147483647");
	ini_set("mssql.textsize" , "2147483647");
	ini_set("odbc.defaultlrl", "100k");

	
	echo "<table border='1' id='myTable'>	
	<tr>
	
	<th><b><center>Lot</center></b></th>
	<th><b><center>User ID</center></b></th>
	
	<th><b><center>Date</center></b></th>
	<th><b><center>Start Time</center></b></th>
	<th><b><center>End Time</center></b></th>
	<th><b><center>Check In</center></b></th>
	<th><b><center>Check Out</center></b></th>
	<th><b><center>Status</center></b></th>
	<th><b><center>Timestamp</center></b></th>
	</tr>";

	for ($x = 0; $x < count($jsonDecoded); $x++)
	{
		$currentRow = get_object_vars($jsonDecoded[$x]);

		$reservationStatusText = "";
		if ($currentRow['ReservationStatus'] == 2) {
			$reservationStatusText = "Expired";
		} elseif ($currentRow['ReservationStatus'] == 1) {
			$reservationStatusText = "Active";
		} else {
			$reservationStatusText = "Cancelled";
		}
		
		$lotName = lotIDtoLotName($currentRow['LotID']);

		$chUID = curl_init();
		$userID = $currentRow['UserID'];
		curl_setopt($chUID, CURLOPT_URL, "http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?table=user&id='$userID'");
		curl_setopt($chUID, CURLOPT_RETURNTRANSFER, $headers);
		curl_setopt($chUID, CURLOPT_CUSTOMREQUEST, "GET");
		$responseUID = curl_exec($chUID);
		$jsonDecodedUID = json_decode($responseUID);
		@$currentUser = get_object_vars($jsonDecodedUID[0]);
		
		if ($currentUser['Email'] === NULL) {
			$UserName = "N/A";
		} else {
			$UserName = $currentUser['Email'];

		}
		
		echo "<tr>";
		
		echo "<td><center>" . $lotName . "</center></td>";
		echo "<td style='cursor:pointer;'><center>" . $UserName . "</center></td>";

		echo "<td><center>" . $currentRow['Date'] . "</center></td>";
		echo "<td><center>" . $currentRow['StartTime'] . "</center></td>";
		echo "<td><center>" . $currentRow['EndTime'] . "</center></td>";
		echo "<td><center>" . $currentRow['CheckInTime'] . "</center></td>";
		echo "<td><center>" . $currentRow['CheckOutTime'] . "</center></td>";
		echo "<td><center>" . $reservationStatusText . "</center></td>";
		echo "<td><center>" . $currentRow['ReservationTimestamp'] . "</center></td>";
		echo "</tr>";
	}

	echo "</table>";	

?>

<script>
var table = document.getElementById("myTable");
    if (table != null) {
        for (var i = 1; i < table.rows.length; i++) {
            j=1;
            table.rows[i].cells[j].onclick = function () {
                tableText(this);
            };
        }
    }

    function tableText(tableCell) {
        alert(tableCell.innerHTML);
    }
</script>

