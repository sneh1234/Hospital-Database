<!DOCTYPE html>
 <head>
<link rel="stylesheet" type="text/css" href="Doctor.css">
<style>
</style>
</head>

<?php session_start();
require 'User.php';
if(!isset($_SESSION['UserData']['Username'])){
	//echo $_SESSION['UserData']['Username'];

 header("Location: Main.php");
  exit;
}
?>

	
<body>
	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$('#some-button').on('click', function () {
    $('#displayDoc1,#infop,#form').fadeIn(500);
});
});
</script>
<script type="text/javascript">
function Show(id) {

					var xmlhttp=new XMLHttpRequest();
					var link="test.php?id=";
						link=link.concat(id);
						
				
				xmlhttp.open("GET",link,true);
  				xmlhttp.send();
  				xmlhttp.onreadystatechange=function(){
  					if (xmlhttp.status==200 && xmlhttp.readyState==4){
  						console.log(xmlhttp.responseText);
  						//alert(xmlhttp.responseText);
  						document.getElementById("infop1").innerHTML=xmlhttp.responseText;
  						document.getElementById("infop1").style.display="";
  					}
  				};
        }
</script>




<?php


	// Create connection
	$conn = new mysqli($servername, $username, $password, 'Medical');

	$doctorname=$_SESSION['UserData']['Username'];
	$sql="SELECT id from Login where username='$doctorname'";
	$doctoruser=$doctorname;
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();

	$doctorid=$row['id'];
	$s=$doctorid;
	//echo $doctorid;
	if($doctorid[0]=='P')
		header('location: Main.php');
	if($doctorid[0]=='A')
		header('location: Admin.php');

	 $doctorid = substr($doctorid, 1);
	 $doctorid=intval($doctorid);

	 $sql="SELECT * from Doctor where D_SSN=$doctorid";
	 $result=$conn->query($sql);
	 $row=$result->fetch_assoc();
	 //	var_dump($row);
	 $doctorname=$row['D_Name'];
	 $doctorage=$row['AGE'];
	 $doctoradd=$row['Address'];
	 $doctoroffice=$row['Office'];
	 $doctorphone=$row['Phone'];

  	$nameErrd = $addressErrd = $officeErrd = $phoneErrd =$userErr="";
	$named = $addressd = $officed = $phoned = $aged ="";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
	 
	 	 if (empty($_POST["D_Name"])) {
	     $nameErrd = "Name is required";
	   } else if(!ctype_alpha($_POST["D_Name"])) {
	      $nameErrd="Invalid Name";
	   } else {
	     $doctorname = $_POST["D_Name"];
	   }
	  
	   if (empty($_POST["Address"])) {
	     $addressErrd = "Address is required";
	   } else {
	     $doctoradd = $_POST["Address"];
	   }
	    
	   if (empty($_POST["Office"])) {
	     $officeErrd = "Office is required";
	   } else {
	     $doctoroffice = $_POST["Office"];
	   }


	   if (empty($_POST["Phone"])) {
	     $phoneErrd = "Phone no is required";
	   } else {
	     $doctorphone = $_POST["Phone"];
	   }
	  if (empty($_POST["Age"])) {
	     $ageErrd = "Age is required";
	   } else {
	     $doctorage = $_POST["Age"];
	     if(!ctype_digit($doctorage)){
	     	$ageErrd="Age must be integer";
	     }
	 }
	 if(empty($_POST["Id"])){
	 	$userErr="User Name is required";
	 }
	 else{
	 	$doctoruser=$_POST['Id'];
	 }
	 if($nameErrd=="" && $addressErrd == "" && $officeErrd== "" && $phoneErrd == "" && $userErr==""){
	$sql = "Update Doctor SET D_Name='$doctorname',AGE=$doctorage,Address='$doctoradd',Phone='$doctorphone'
	,Office='$doctoroffice' where D_SSN=$doctorid";
	$conn = mysql_connect($servername, $username, $password);
  $dbname="Medical";
  mysql_select_db($dbname);

	if(mysql_query($sql)==TRUE){
		$sql="Update Login SET username='$doctoruser' where id='$s'";
		$_SESSION['UserData']['Username']=$doctoruser;
		//var_dump($sql);
		mysql_query($sql);

	
	//header( 'Location: Main.php' );
	} else{
	echo "Error it doesnt work if all are not integer";
	}

	}
 }
 

	?>
	<div id='displayDoc1'></div>
	<div id="displayDoc">
		<button type='button' id='some-button' style='margin-left:90%;margin-top:11%;position:absolute;'>Update info</button>
	<a id='li'style='color:white;margin-left:92%;position:absolute;margin-top:1%; color:#FFF; text-decoration:none; ' href='Logout.php'>Logout</a>	
	<br><br><br><br><br>

	<p4>Welcome &nbsp</p4>
	<p5>Dr.</p5>
	<p5><?php echo $doctorname ?></p5>
	
	<p6>Residential Address:</p6> 
	<p7><?php echo $doctoradd?></p7>
	<p8>Office Address:</p8>
	<p9><?php echo $doctoroffice?></p9>
	
	</div>
<div id= 'infop1' style='display:none;overflow:scroll'>
		Name:&nbsp&nbsp&nbsp&nbspRamesh
		<br><br>
		Address:&nbsp&nbspShrinath colony Khargone
		<br><br>
		Age:&nbsp&nbsp18
		<br><br>
		Phone:&nbsp&nbsp9703544116
		<br><br>
		visit date:&nbsp&nbsp02/11/1995
		<br><br>
		visit time:&nbsp&nbsp11:45 AM
		<br><br>
		Complaint:&nbsp&nbspAids
		<br><br>
			</div>
	<div>
	<a  style="color:#000; text-decoration:none; "  href='Medicine.php?id=<?php echo $doctorid ?>'><h1>Add visit</h1></a>
	

			</div>

			 <header>
			
				<div class="nav2">
					<ul>
<?php
$conn = new mysqli($servername, $username, $password, 'Medical');				
	 $table='Visit';
	 $field=array();
	$count=0;
	$sql = "SELECT DISTINCT P_SSN FROM $table where D_SSN=$doctorid order by Visit_date, time desc";
 // 	$conn = new mysqli($servername, $username, $password, 'Medical');
	$table='Patient';
	$result = $conn->query($sql);  
	while($row=$result->fetch_assoc()){
		$P_SSN=$row['P_SSN'];

		$sql="SELECT P_Name from $table where P_SSN=$P_SSN";
		$name=$conn->query($sql);
		$name=$name->fetch_assoc();
		$name=$name['P_Name'];
		echo '<li><a href="#" onclick="Show('.$P_SSN.')">'.$name.':'.$row['P_SSN'].'</a><li>';
	}

	mysql_close($conn);
	?>

							
					</ul>
				</div>
 
<div id='infop' style='display:none;'>
	<form method="POST" id='doctorform' action="Doctor.php" class="basic-grey" style="margin-top:50%;">
	   <h2>Update Info</h2>
	   <hr>
	   Name:&nbsp&nbsp&nbsp&nbsp <input type="text" name="D_Name" value=<?php echo $doctorname?>>
	   <span class="error">* <?php echo $nameErrd;?></span>
	   <br><br>
	   &nbspUsername:&nbsp&nbsp <input type="text" name="Id"  value=<?php echo $doctoruser ?>>
	   <span class="error"><?php echo $userErr;?></span>
	   <br><br>
	  
	   Address: <input type="text" name="Address" value=<?php echo $doctoradd?>>
	   <span class="error"><?php echo $addressErrd;?></span>
	   <br><br>
	   Office:&nbsp&nbsp&nbsp
	   <input type="text" name="Office" value=<?php echo $doctoroffice?>>
	   <span class="error">* <?php echo $officeErrd;?></span>
	   <br><br>
	   Phone:&nbsp&nbsp&nbsp
	   <input type="text" name="Phone" value=<?php echo $doctorphone ?>>
	   <span class="error">* <?php echo $phoneErrd;?></span>
	   <br><br> 
	  
	   <input type="submit" name="submitdoctor" value="Submit">
	</form>
	
</div>
	
	

	
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</html>
