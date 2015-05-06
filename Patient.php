<html>

<head>
	 <link rel="stylesheet" type="text/css" href="./patient.css">
	 <link rel="stylesheet" type="text/css" href="./Doctor.css">
<style type="text/css">
	@import url(http://fonts.googleapis.com/css?family=Open+Sans);

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Open Sans', sans-serif;
}

/* Navigation */

nav {
  width: 100%;
  height: 60px;   
  position: fixed; 
  top: 0;
  background: #1ABC9C;
}

nav ul {
  padding: 20px;
  margin: 0 auto;
  list-style: none;
  margin-left: -50%;
  text-align: center;
}
nav ul li {
  display: inline-block;
  margin: 0 10px;
}
nav ul li a {
  padding: 10px 0;
  color: #fff;
  font-size: 1rem;
  text-decoration: none;
  font-weight: bold;
  transition: all 0.2s ease;
}
nav ul li a:hover {
  color: #34495E;
}
a.active {
  border-bottom: 2px solid #ecf0f1;
}

/* Headings */

h1 {
  font-size: 5rem;
  color: #34495E;
}

/* Sections */

section {
  width: 100%;
  padding: 50px;
  background: #fff;
  border-bottom: 1px solid #ccc;
  height: 550px;
  text-align: left;
  
}
section:nth-child(even) {
  background: #ecf0f1;
}
section:nth-child(odd) {
  background: #bdc3c7;
}
.sections section:first-child {
  margin-top: 60px;
}
section.active {}

footer {
  height: 500px;
  background: #34495e;
}
.error{color:red;}

      p4{
        font-size: 50px;
        margin-left: 4%;
        font-family: 'Open Sans', sans-serif;
        color: #FFFFFF;
        margin-bottom: 10px;
        
      }
      p5{
        font-size: 50px;
          font-family: 'Open Sans', sans-serif;
        color: #996633;
        
      }
      p6{
        font-size: 30px;
          font-family: 'Open Sans', sans-serif;
        color: #996633;
        
      }
      .basic-grey {
    margin-left:30%;
    margin-right:auto;
    max-width:550px;
    background: #F7F7F7;
    padding: 25px 15px 25px 10px;
    font: 12px Georgia, "Times New Roman", Times, serif;
    color: #888;
    text-shadow: 1px 1px 1px #FFF;
    border:1px solid #E4E4E4;
    width: 500px;
    /*margin-top: 13px;*/
    top:19.5%;
    opacity: 1;
    position: absolute;

}
.basic-grey h1 {
    font-size: 25px;
    padding: 0px 0px 10px 40px;
    display: block;
    border-bottom:1px solid #E4E4E4;
    margin: -10px -15px 30px -10px;;
    color: #888;
}
.basic-grey h1>span {
    display: block;
    font-size: 11px;
}
.basic-grey label {
    display: block;
    margin: 0px;
}
.basic-grey label>span {
    float: left;
    width: 20%;
    text-align: right;
    padding-right: 10px;
    margin-top: 10px;
    color: #888;
}
.basic-grey input[type="text"], .basic-grey input[type="email"], .basic-grey textarea, .basic-grey select {
    border: 1px solid #DADADA;
    color: #888;
    height: 30px;
    margin-bottom: 16px;
    margin-right: 6px;
    margin-top: 2px;
    outline: 0 none;
    padding: 3px 3px 3px 5px;
    width: 70%;
    font-size: 12px;
    line-height:15px;
    box-shadow: inset 0px 1px 4px #ECECEC;
    -moz-box-shadow: inset 0px 1px 4px #ECECEC;
    -webkit-box-shadow: inset 0px 1px 4px #ECECEC;
}
.basic-grey textarea{
    padding: 5px 3px 3px 5px;
}
.basic-grey select {
    background: #FFF url('down-arrow.png') no-repeat right;
    background: #FFF url('down-arrow.png') no-repeat right);
    appearance:none;
    -webkit-appearance:none;
    -moz-appearance: none;
    text-indent: 0.01px;
    text-overflow: '';
    width: 70%;
    height: 35px;
    line-height: 25px;
}
.basic-grey textarea{
    height:100px;
}
.basic-grey .button {
    background: #E27575;
    border: none;
    padding: 10px 25px 10px 25px;
    color: #FFF;
    box-shadow: 1px 1px 5px #B6B6B6;
    border-radius: 3px;
    text-shadow: 1px 1px 1px #9E3F3F;
    cursor: pointer;
}
.basic-grey .button:hover {
    background: #CF7A7A
}


</style>
</head>

<?php session_start();
require 'User.php';
if(!isset($_SESSION['UserData']['Username'])){
	//echo $_SESSION['UserData']['Username'];
for($i=0;$i<5;$i++)
 header("Location: ./Main.php");
  exit;
}
?>

<body>
<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
function showpatient()
{
	//alert('patient');
	document.getElementById('doctorform').style.display='';
	//alert(document.getElementById('infop'));
	//alert(document.getElementById('infop').style.display);
}
function Show(id) {

					var xmlhttp=new XMLHttpRequest();
					var link="patientInfo.php?id=";
						link=link.concat(id);
						
			
				xmlhttp.open("GET",link,true);
  				xmlhttp.send();
  				xmlhttp.onreadystatechange=function(){
  					if (xmlhttp.status==200 && xmlhttp.readyState==4){
  						console.log(xmlhttp.responseText);
  						//alert(xmlhttp.responseText);
  						document.getElementById("patientInfo").innerHTML=xmlhttp.responseText;

  					}
  				};
        }
</script>



<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
   // your code here
    var sections = $('section')
  , nav = $('nav')
  , nav_height = nav.outerHeight();

$(window).on('scroll', function () {
  var cur_pos = $(this).scrollTop();
  
  sections.each(function() {
    var top = $(this).offset().top - nav_height,
        bottom = top + $(this).outerHeight();
    
    if (cur_pos >= top && cur_pos <= bottom) {
      nav.find('a').removeClass('active');
      sections.removeClass('active');
      
      $(this).addClass('active');
      nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
    }
  });
});

nav.find('span').on('click', function () {
  var $el = $(this)
    , id = $el.attr('href');
  
  $('html, body').animate({
    scrollTop: $(id).offset().top - nav_height
  }, 500);
  
  return false;
});
}, false);	

</script>


<?php

	// Create connection
	$conn = new mysqli($servername, $username, $password, 'Medical');
	$pname=$_SESSION['UserData']['Username'];
	$puser=$pname;
	$sql="SELECT id from Login where username='$pname'";
	
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();

	$pid=$row['id'];
	$pid=intval($pid[1]);
	
	 $sql="SELECT * from Patient where P_SSN=$pid";
	 $result=$conn->query($sql);
	 $row=$result->fetch_assoc();
	 //	var_dump($row);
	 $pname=$row['P_Name'];
	 $page=$row['AGE'];
	 $padd=$row['Address'];
	 $pphone=$row['Phone'];


	  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname=$_POST['D_Name'];
    $puser=$_POST['Id'];
    $padd=$_POST['Address'];
    $pphone=$_POST['Phone'];
    $page=$_POST['Age'];
    $sql = "Update Patient SET P_Name='$pname',AGE=$page,Address='$padd',Phone='$pphone'
   where P_SSN=$pid";
  $conn = mysql_connect($servername, $username, $password);
  $dbname="Medical";
  mysql_select_db($dbname);
  $s='p'+$pid;
  if(mysql_query($sql)==TRUE){
    $sql="Update Login SET username='$puser' where id='$s'";
    $_SESSION['UserData']['Username']=$puser;
    //var_dump($sql);
    mysql_query($sql);

  
  //header( 'Location: Main.php' );
  } else{
  echo "Error it doesnt work if all are not integer";
  }

  }
?>



<nav>
  <ul>
    <li><span><a href="#1">PROFILE</a></span></li>
    <li><span><a href="#2">HISTORY</a></span></li>
    
    <li><span><a href="#3">BILL</a></span></li>
    <li ><a  href="Logout.php" > <p style='margin-left:700%;'>LOGOUT</p></a></li>
    <li ><a   onclick="showpatient();" > <p id='ppp'style='margin-left:600%;'>UpdateInfo</p></a></li>
  </ul>
</nav>
<!--<div id='infop' style='display:none;'> -->
	<form method="POST" id='doctorform' action= <?php echo $_SERVER['PHP_SELF']; ?>  style='display:none; position:fixed;'class="basic-grey">
	   <h2>Update Info</h2>
	   <hr>
	   Name:&nbsp&nbsp&nbsp&nbsp <input type="text" name="D_Name" value=<?php echo $pname?>>
	   <span class="error">* <?php echo $nameErrd;?></span>
	   <br><br>
	   &nbspUsername:&nbsp&nbsp <input type="text" name="Id"  value=<?php echo $puser ?>>
	   <span class="error"><?php echo $userErr;?></span>
	   <br><br>
	  
	   Address: <input type="text" name="Address" value=<?php echo $padd?>>
	   <span class="error"><?php echo $addressErrd;?></span>
	   <br><br>
	   
	   Phone:&nbsp&nbsp&nbsp
	   <input type="text" name="Phone" value=<?php echo $pphone ?>>
	   <span class="error">* <?php echo $phoneErrd;?></span>
	   <br><br> 
		Age:
		<input type="text" name="Age" value=<?php echo $pphone ?>>
	   <span class="error">* <?php echo $phoneErrd;?></span>

	   <input type="submit" name="submitdoctor" value="Submit">
	</form>
	
<!--</div>-->

<div class="sections">
  <section id="1">

  <h1>PROFILE</h1>

  <p5>Name:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p5><p4><?php echo $pname;?><br>
  <p5>Username:&nbsp&nbsp&nbsp</p5><?php echo $puser; ?><br>
  <p5>Phone No:</p5><p4><?php echo $pphone ?></p4><br>
  <p5>Address:&nbsp&nbsp&nbsp</p5><p4><?php echo $padd; ?></p4><br>
  
		


  </section>
  <section id="2" style="overflow:scroll;">
  <h1>HISTORY</h1>
<?php
	$table='Visit';
	 
	 $sql="SELECT * FROM $table where P_SSN=$pid";
	 $result = $conn->query($sql);
	 if ($result->num_rows > 0) {
	 	while($row = $result->fetch_assoc()) {
?>
  <p6 style="margin-left:80%; font-size:20px;" ><?php	echo $row['time'];?></p6><br>
  <p6 style="margin-left:80%; font-size:20px;"><?php	echo $row['Visit_date'];?></p6><br>
  <p6 style="font-size:20px;";> Complaint:<?php	echo $row['complaint'];?></p6>
  <p6><?php	echo $row['D_SSN'];?></p6> <br>
  <hr style="background-color:#A8A;">
  <?php
}
		} else{ ?>
		    <p5><?php	echo "Get youself a treatment";?></p5>
		    <?php
		}

?>
 </section>

  <section id="3" style="overflow:scroll;">
  <h1>BILL</h1>

<?php 
	$table='Visit';
	$btable='Bill';
	 $total=0;
	 $sql="SELECT * FROM $table where P_SSN=$pid";
	 $result = $conn->query($sql);
	 if ($result->num_rows > 0) {
	 	while($row = $result->fetch_assoc()){
	 		$bsql="SELECT * FROM $btable where Visit_id=$row[Visit_id]";
	 		if($bsql['Bill_Date']!="")
	 		{
	 		$bresult=$conn->query($bsql);
	 		$brow=$bresult->fetch_assoc();
?>
			<p6 style="font-size:20px;" >Date:<?php	echo $brow['Bill_Date'];?></p6><br>
			<p6 style="font-size:20px;" >Payment Status:<?php	if ($brow['Status']==1) echo "Paid";
			else echo "Not Paid"?></p6><br>
			<p6 style="font-size:20px;" >Doctor's Fees:<?php	echo $brow['Doctor_fees'];?></p6><br>
			<p6 style="font-size:20px;" >Medicine Cost:<?php	echo $brow['Amount'];?></p6><br>
			<p6 style="font-size:20px;" >Treament Cost:<?php	echo $brow['Amount']+$brow['Doctor_fees'];?></p6><br>
			<p6 style="font-size:20px;" >Due Date:<?php	echo $brow['Due_Date'];?></p6><br>
			<?php $total=$total+($brow['Amount']+$brow['Doctor_fees'])*(1-$brow['status']);?>

			<hr style="background-color:#A8A;">


<?php	 	}}?>  <br><br><br><?php

}

mysql_close($conn);?>
<p6 style="font-size:30px;" >Total Bill :<?php	echo $total;?></p6>
</section>

<!--<section id="5"><h1>DOCTOR</h1></section>-->
  
</div>
<footer></footer>

</body>
</html>
