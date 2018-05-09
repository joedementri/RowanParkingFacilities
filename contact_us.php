<?php

include ('includes.php');

include ('header.php');

//include ('mysql_connect.php');

error_reporting(E_ALL);

ini_set('display_errors', TRUE);

//echo var_dump($_POST);

if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['message'])){

	$textfield = $_POST['message'];
	$formattedMsg = "Name: " . $_POST['name'];
	$formattedMsg .= "\nEmail: " . $_POST['email'];
	$formattedMsg .= "\nMessage: " . $_POST['message'];

	//NEW CODE WITH API CALL
	//Set Post Fields:
	$post = [
	"id" => "0",
	"report" => $formattedMsg
	];
		
	$post2 = json_encode($post);
	$headers = array('Accept: application/json', 'Content-Type: application/json');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?table=complaints');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, $headers);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post2);
	$response = curl_exec($ch);

	$_SESSION['msg'] = $response;

	
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

<style>
#message {
	width: 100%;
	min-height: 50px;
	height: 100px;
	resize: vertical;
	border-radius: 4px;
	border-color: silver;
}

</style>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Contact Us</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="contact_us.php">

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-md-4 control-label">Message</label>
                            <div class="col-md-6">
				<textarea id="message" class="form-control" name="message" value="" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ('footer.php');?>