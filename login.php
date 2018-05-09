<?php

include ('includes.php');

include ('header.php');

include ('mysql_connect.php');

include ('calls.php');

if(isset($_SESSION['login'])){
	header('Location: /facilities/admin_page.php');
}

if(isset($_POST['email'])&&isset($_POST['password'])){
	//echo "Form submitted - ";
	$stmt = $mysqli->prepare("SELECT UserID,Name,Token FROM user WHERE email = ?");
	$stmt->bind_param("s", $_POST['email']);
	//echo "Statement parameters binded - ";
	//echo "<script type='text/javascript'>alert('');</script>";
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows === 1){
		//echo "Found a matching profile - ";
		$stmt->bind_result($UserID,$Name,$Token);
		$stmt->fetch();
		
		if(password_verify($_POST['password'],$Token) or $Token == $_POST['password']) {

			$_SESSION['login'] = $UserID;
			$_SESSION['user'] = $Name;
			$_SESSION['msg'] = "You have successfully registered";
			echo "Successful Login";
			header('Location: /facilities/admin_page.php');
		}
		else{
			$_SESSION['msg'] = "Invalid Login";
			//echo "Invalid Login";
		}
		$stmt->close();
	}
	else{
		$_SESSION['msg'] = "Invalid Login";
	}
}

if(isset($_POST['admin'])&&isset($_POST['password'])){
	
	$stmt = $mysqli->prepare("SELECT password,id,name FROM users WHERE email = ?");
	$stmt->bind_param("s", $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows === 1){
		$stmt->bind_result($password,$id,$name);
		$stmt->fetch();
		if(password_verify($_POST['password'],$password)) {

			$_SESSION['login'] = $id;
			$_SESSION['user'] = $name;
			$_SESSION['msg'] = "You have successfully registered";
			header('Location: /facilities/admin_page.php');
		}
		else{
			$_SESSION['msg'] = "Invalid Login";
		}
		$stmt->close();
	}
	else{
		$_SESSION['msg'] = "Invalid Login";
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
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="login.php">
                        

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required autofocus>   
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="forgot-password.php">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ('footer.php');?>