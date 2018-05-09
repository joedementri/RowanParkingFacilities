<?php

//include('mysql_connect.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);


if(isset($_POST['type']) && isset($_POST['message'])) {

	$selectedType = $_POST['type'];
	$text = $_POST['message'];
	$TypeIDNum = 0;

	//$stmt = $mysqli->prepare("INSERT INTO notification(UserID, Message, NotificationTypeID) VALUES (0,?,?)");
	
	switch($selectedType) {
		case "General":
			$TypeIDNum = 1;
			break;
		case "Cancellation":
			$TypeIDNum = 2;
			break;
		case "Emergency":
			$TypeIDNum = 3;
			break;
		case "Warning":
			$TypeIDNum = 4;
			break;
	}
	
	//$stmt->bind_param('si', $_POST['message'], $TypeIDNum);

	/*if ($stmt->execute()) {
		$stmt->store_result();
		$stmt->close();
		
		$_SESSION['msg'] = "Notification Sent";
	} else {
		$_SESSION['msg'] = "ERROR: Not Sent";
	}
	*/

	//NEW CODE WITH API CALL
	//Set Post Fields:
	$post = [
	"id" => "0",
	"message" => $_POST['message'],
	"type" => $TypeIDNum
	];

	$post2 = json_encode($post);
	$headers = array('Accept: application/json', 'Content-Type: application/json');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?table=notification');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, $headers);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post2);
	$response = curl_exec($ch);

	$_SESSION['msg'] = $response;

	$confirmation = "NOTIFICATION ADDED:"."\\n"."Type:    ".$selectedType."\\n"."Message:    ".$text;

	echo "<script type='text/javascript'>alert('$confirmation');</script>";

}

if(isset($_SESSION['msg'])){
?>
<center>
	<span class="help-block">
		<strong style="color:red;"><?php echo $_SESSION['msg']; ?></strong>
	</span>
</center>
<?php 
unset($_SESSION['msg']);
}

?>

<br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Send Notification</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="">
                        

                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label">Notification Type</label>
                            <div class="col-md-6">
				<select id="type" name="type" class="form-control" required autofocus>
					<option value="" disabled="disabled" selected="selected">Select Type:</option>
					<option value="General">General</option>
					<option value="Cancellation">Cancellation</option>
					<option value="Emergency">Emergency</option>
					<option value="Warning">Warning</option>
				</select>   
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-md-4 control-label">Message</label>
                            <div class="col-md-6">
                                <input id="message" type="text" class="form-control" name="message" required>
                            </div>
                        </div>

                        <div class="form-group" align="left">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="send" class="btn btn-primary">
                                    Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>