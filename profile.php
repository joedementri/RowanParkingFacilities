<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include ('includes.php');

include ('header.php');

/*include ('facilitiesOptions.php');*/

include ('mysql_connect.php');

if(!isset($_SESSION['login'])){
	header('Location: /');
}


//Display message
if(isset($_SESSION['msg']))
{
	?>
	<center>
		<span class="help-block">
			<strong style="color:red;"><?php echo $_SESSION['msg']; ?></strong>
		</span>
	</center>
<?php 
unset($_SESSION['msg']);
} ?>  

 <center> <h3>Welcome <?php echo (isset($_SESSION['user']) ?  $_SESSION['user'] : " User" ); ?> </h3> </center>
 <center> <h4>To begin, please click on <b> Reserve A Spot </b> to reserve a parking spot to your account </h4> </center>
 <br>
 <br>
<center>

<button type="button"> Reserve A Spot </button>

<br><br>

</center>



<br>






<?php include ('footer.php');?>
