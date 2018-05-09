<?php

include ('includes.php');

include ('header.php');

include ('mysql_connect.php');

//error_reporting(E_ALL);

//ini_set('display_errors', TRUE);

include('calls.php');


if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['password_confirmation'])){

  if($_POST['password']==$_POST['password_confirmation']){
	$user= "test";
	
      	$stmt = $mysqli->prepare("INSERT INTO user(PermitID, UserTypeID, Name, Email, Username, Token, isDisabled, Status) VALUES (3,3,?,?,?,?,0,1)");

      	$options = [
          'cost' => 11,
          'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
      	];
      	$password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
	$username = $_POST['email'];

	if (strpos($username,"@rowan.edu") !== false) {
		//echo "<script type='text/javascript'>alert('HERE');</script>";
		$stmt->bind_param('ssss',$_POST['name'], $_POST['email'], $username, $password);
	  
	$name = $_POST['name'];
	$email = $_POST['email'];
	
	//NEW CODE WITH API CALL
	$post = [
	"permit" => "3",
	"type" => "3",
	"name" => $name,
	"email" => $email,
	"username" => $username,
	"password" => $password,
	"isDisabled" => "0",
	"status" => "1"
	];
	
	
	//$post2 = json_encode($post);
	//echo "<script> type='text/javascript'> alert ('var_dump($post2)'); </script>";
	//$result = httpSend("POST", "http://ec2-34-229-81-168.compute-1.amazonaws.com/deva/api.php?table=userWithpermit", $post2);	

	if ($stmt->execute()) {
		$stmt->store_result();
		$stmt->close();
		
		$_SESSION['login']=$_POST['email'];
		$_SESSION['user']=$_POST['name'];
		$_SESSION['registered']=1;
	} else {
		$_SESSION['msg'] = "Email already exists";
	}	
	echo "<script type='text/javascript'> window.location='admin_page.php'; </script>";
	} else {
		$_SESSION['msg'] = "Invalid Email. Email must be from a Rowan Facility Member";
	}

      	

  }else {
    $_SESSION['msg'] = "Passwords entered do not match";
  }
  
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
} ?>                              

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="register.php">


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
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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
