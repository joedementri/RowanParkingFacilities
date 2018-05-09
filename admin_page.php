<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include ('includes.php');
include ('header.php');



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

<link rel="stylesheet" href="admin.css">


 <center> <h3>Welcome <?php echo (isset($_SESSION['user']) ?  $_SESSION['user'] : " User" ); ?> </h3> </center>
 <br>
<center>
<div class="tab">
  <button class="tablinks"  onclick="openCity(event, 'Data')" id="defaultOpen">Data</button>
  <button class="tablinks"  onclick="openCity(event, 'Reports')">User Reports</button>
  <button class="tablinks"  onclick="openCity(event, 'Notifications')">Notifications</button>
  <button class="tablinks"  onclick="openCity(event, 'Manage')">Manage Lots</button>
</div>

<div id="Data" class="tabcontent">
    <?php {include('displayingData.php');} ?>
</div>

<div id="Reports" class="tabcontent">
    <?php {include('complaints.php');} ?>
</div>

<div id="Notifications" class="tabcontent">
    <?php {include('send_notification.php');} ?>
</div>

<div id="Manage" class="tabcontent">
    <?php {include('manage_lots.php');} ?>
</div>


<br><br>

</center>


<br>

<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>


<?php include ('footer.php');?>
