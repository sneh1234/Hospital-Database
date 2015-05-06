<html>

<head>
     <link rel="stylesheet" type="text/css" href="./prescription.css">
</head>
<?php session_start();
if(!isset($_SESSION['UserData']['Username'])){
	//echo $_SESSION['UserData']['Username'];

 //header("Location: Main.php");
  exit;
}
?>
<style>
.error{color:red;}
</style>
<style>


</style>
<script type="text/javascript">
var count=1;
function Add()
{	
	count+=1;
		//alert('function');
	 var element = document.createElement("input");
     
        //Assign different attributes to the element.
        element.setAttribute("type", 'text');
        element.setAttribute("name", count);
        element.style.width='30%';
        element.style.marginLeft='9%';
        var f= document.getElementById('append');

        f.appendChild(element);
        var element = document.createElement("input");
     
        //Assign different attributes to the element.
        element.setAttribute("type", 'text');
        element.setAttribute("name", count+'q');
        element.style.width='30%';
        element.style.marginLeft='9%';
        var f= document.getElementById('append');
        document.getElementById('hidden').value=count;
        //alert(document.getElementById('hidden').value);
        f.appendChild(element);
    }

	</script>
<body>
<?php
	require 'User.php';
	$error="Medicines";
	// Create connection
	$conn = mysql_connect($servername, $username, $password);
	$dbname="Medical";
	mysql_select_db($dbname);
	$nameErr = $addressErr = $officeErr = $phoneErr = $ageError;
	$name = $address = $office = $phone = $age ="";
	 $conn = new mysqli($servername, $username, $password, $dbname);
	 $pid=$_GET['pid'];
	 $sql="SELECT * FROM Visit where P_SSN=$pid order by Visit_date, time desc";
	 $result=$conn->query($sql);
	 $row=$result->fetch_assoc();
	 $visitid=$row['Visit_id'];
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 

	  $Prescription=$_POST['Prescription'];
	  $nof=$_POST['hidden'];
	  $nof=intval($nof);
	  
	  $error="";
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  	

	  for($i=1;$i<$nof+1;$i++)
	  {
	  	//var_dump($i);
	  	$medicine=$_POST[$i];
	  	$Quantity=$_POST[$i.'q'];

	  	if(!$medicine)
	  		continue;
	  	$sql = "SELECT * FROM Medicine where M_Name='$medicine'";
  $result = $conn->query($sql);
  	
  $row = $result->fetch_assoc();
  		$iiid=$row['M_id'];

  		if($iiid=="")
  		$error=$medicine.' is not present';
  		else if($row['Quantity']<$Quantity)
  			$error='Stock for '.$medicine.'is empty';

  	}

  	if($error=='')
{
	for($i=1;$i<$nof+1;$i++)
	  {
	  	//var_dump($i);*/
	  	$medicine=$_POST[$i];
	  	$Quantity=$_POST[$i.'q'];
	  	if(!$medicine)
	  		continue;

	  	$conn = new mysqli($servername, $username, $password, $dbname);
	  	$sql = "SELECT * FROM Medicine where M_Name='$medicine'";
  $result = $conn->query($sql);

  $row = $result->fetch_assoc();
  		$iiid=$row['M_id'];

	  	$sql= "INSERT INTO Prescription (Visit_id, M_id, Quantity,Pres)
   VALUES ($visitid, $iiid, $Quantity,'$Prescription')";


   if(mysql_query($sql)==TRUE)
   	;
   else
   	$error='Medicine Not found';
	
	$sql="UPDATE Medicine SET Quantity=Quantity-$Quantity WHERE M_id=$iiid";
	if(mysql_query($sql)==TRUE)
		;
	else
	;

	   }




	}
}

	if($error=="")
	header('location: Doctor.php');

	mysql_close($conn);
	?>

	
	<form method="POST" action="Prescription.php?pid=<?php echo $pid?>" class="basic-grey">
	   <h2 style="">Add Prescription</h2>
	   <hr>
	   
	   Prescription:&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="Prescription" value=<?php echo $age ?>>
	   <span class="error">* <?php echo $ageErr;?></span>
	   <br><br>

	   Medicine: <input type="text" style='width:30%;'name="1" value=<?php echo $address?>>
	   <span class="error"><?php echo $addressErr;?></span>
	   
	   
	   Quantity:&nbsp&nbsp&nbsp
	   <input type="text" style='width:30%;'name="1q" value=<?php echo $phone ?>><img src='add_green_button.png' style="width:40px;" onclick="Add()">
	   <span class="error"><?php echo $error;?></span>
	   <span id='append'></span>
	   <br><br> 
	  <input type="text" name='hidden' style='display:none;'value='1' id='hidden'> 
	   <input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>
