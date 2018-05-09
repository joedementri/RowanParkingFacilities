<br>
<div id="lot-options">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">To begin, please select a lot to manage.</div>
				 <div class="panel-body">
				  <form class="form-horizontal" method="POST" action="">
						<div class ="form-group">
							<label for="name" class="col-md-4 control-label">Lot to Modify:</label>
							<!--<div class="lot-select" align="center">-->
							<div class="col-md-6">
								<select id ="lot" name="lot" class="form-control" reqruired autofocus>
									<option value="" disabled="disabled" selected="selected">Select Lot:</option>
									<option value="1">Lot A</option>
									<option value="2">Lot B</option>
									<option value="3">Lot C</option>
									<option value="4">Lot D</option>
									<option value="5">Lot E</option>
									<option value="8">Lot A-1</option>
									<option value="9">Lot B-1</option>
									<option value="10">Lot C-1</option>
									<option value="11">Lot D-1</option>
									<option value="12">Lot E-1</option>

								</select>
							</div>
						</div>
						
						<div class ="form-group">
							<label for="name" class="col-md-4 control-label">Lot Status:</label>
							<!--<div class="reservable-select">-->
							<div class="col-md-6">
								<select id ="reservable" name="reservable" class="form-control" reqruired>
									<option value="" disabled="disabled" selected="selected">Select The Option:</option>
									<option value="No">Closed</option>
									<option value="Yes">Open</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-md-4 control-label">Number of Reservable Spots</label>
								<div  class="col-md-6">
									<input id="number" type="number" class="form-control" name="number" value="" required>
								</div>
						</div>
						
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" onClick="window.location.reload();">
                                    Update
                                </button>
                            </div>
						</div>
				  </form>
				</div>
            </div>
        </div>
    </div>
</div>

<div>
<?php include('lot_status.php'); ?>
</div>
<?php

//include ('mysql_connect.php');

include('calls.php');

if(isset($_POST['lot']) && isset($_POST['reservable']) && isset($_POST['number']))
{
	
	$selectedLot = $_POST['lot'];	
	$selectedReservable = $_POST ['reservable'];
	$number = $_POST ['number'];
	$YesOrNo = -1;
	$LotIDNumber = 0;
	$actualName="";
	
	
	switch($selectedLot)
	{
		case 1:
			$LotIDNumber = 1;
			break;
		case 2:
			$LotIDNumber = 2;
			break;
		case 3:
			$LotIDNumber = 3;
			break;
		case 4:
			$LotIDNumber = 4;
			break;
		case 5:
			$LotIDNumber = 5;
			break;
		case 8:
			$LotIDNumber = 8;
			break;
		case 9:
			$LotIDNumber = 9;
			break;
		case 10:
			$LotIDNumber = 10;
			break;
		case 11:
			$LotIDNumber = 11;
			break;
		case 12:
			$LotIDNumber = 12;
			break;

	}
	
	switch($selectedLot)
	{
		case 1:
			$actualName="Lot A";
			break;
		case 2:
			$actualName="Lot B";
			break;
		case 3:
			$actualName="Lot C";
			break;
		case 4:
			$actualName="Lot D";
			break;
		case 5:
			$actualName="Lot E";
			break;
		case 8:
			$actualName="Lot A-1";
			break;
		case 9:
			$actualName="Lot B-1";
			break;
		case 10:
			$actualName="Lot C-1";
			break;
		case 11:
			$actualName="Lot D-1";
			break;
		case 12:
			$actualName="Lot E-1";
			break;

	}
		
	if (strcmp("No", $selectedReservable) == 0) {
		$YesOrNo = 0;
	} else {
		$YesOrNo = 1;
	}
	
	$headers= array('Accept: application/json','Content-Type: application/json');	


	//OPEN OR CLOSE LOT
	$ch = curl_init();
	if ($YesOrNo === 0) {
		curl_setopt($ch, CURLOPT_URL, "http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?function=closeLot&id='$LotIDNumber'");
		
		$string = " is now closed";
		$postNotification = [ 
			"id"=>"0",
			"message"=>$actualName. $string,
			"type"=>"2"
		];
		
		$message = urlencode($actualName)."%20is%20closed.%20Please%20reschedule.";
		$subject = "Lot%20Closure";
		$lotIDasString = (string)$LotIDNumber;
		$emailURL = "http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/email-notification/sendemail.php?body=".$message."&subject=".$subject."&lotID=".$lotIDasString;
		$emailResult = httpSend("POST","http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/email-notification/sendemail.php?body=".$message."&subject=".$subject."&lotID='$LotIDNumber'", []);


		
		$postNotification2 = json_encode($postNotification);
		//Adds notification to table
		$chT = curl_init();
		curl_setopt($chT, CURLOPT_URL, "http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?table=notification");
		curl_setopt($chT, CURLOPT_RETURNTRANSFER, $headers);
		curl_setopt($chT, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($chT, CURLOPT_POSTFIELDS, $postNotification2);
		$response = curl_exec($chT);
		
	} else {
		curl_setopt($ch, CURLOPT_URL, "http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?function=openLot&id='$LotIDNumber'");
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, $headers);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_exec($ch);
		
	//IF PROVIDED NUM = 0, THEN SET ISRESERVABLE TO 0, otherwise, set 
	$ch = curl_init();
	if ($number == 0) {
		curl_setopt($ch, CURLOPT_URL, "http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?function=unreserveLot&id='$LotIDNumber'");
	} else {
		curl_setopt($ch, CURLOPT_URL, "http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?function=reserveLot&id='$LotIDNumber'");
		
		/*
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		
		$result = $mysqli->query("SELECT email FROM user");
		
		while($row = mysqli_fetch_array($result)
		{
			$addresses[]=$row['email'];
		}
		
		$to= implode(",", $addresses);
		$subject = 'Rowan Parking Lot';
		$msg = '<html><body>';
		$msg .='<h3> Dear User' ;
		$msg .= ' ,</h3>';
		$msg .='<p>It seems like </p>';
		$msg .= $selectedLot;
		$msg .='<p> is now open for parking and available for servation.</p>';
		$msg .='<p> </p>';
		$msg .='<p>Thank you</p>';
		$msg .='<p>Rowan Parking Lot Team</p>';
		$msg .= '</body></html>';

	// use wordwrap() if lines are longer than 70 characters
	$msg = wordwrap($msg,70);

	mail($to, $subject, $msg, $headers);
		*/
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, $headers);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_exec($ch);

	//UPDATE NUMBER RESERVABLE SPOTS
	$result = httpSend("PUT", "http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?id=".$LotIDNumber."&isReservable=".$YesOrNo."&ReservationSpots=".$number, []);
	
	

}
?>

					



