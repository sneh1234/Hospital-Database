<style type="text/css">
p4{
        font-size: 60px;
        margin-left: 4%;
        font-family: "Times New Roman", Times, serif;
        color: #FFFFFF;
        margin-bottom: 10px;
        font-style: italic;
      }
      p5{
        font-size: 60px;
        font-family: "Times New Roman", Times, serif;
        color: #FF9900;
        font-style: italic;
      }
      p8{
        font-size: 15px;
        font-family: "Times New Roman", Times, serif;
        margin-left: 29%;
        text-decoration: underline;
        color: #A8A8A8;
        position: absolute;
        margin-top: -71px;
        font-style: italic;
      }
      p9{
        font-size: 16px;
        font-family: "Times New Roman", Times, serif;
        margin-left: 29%;
        color: #FFFFFF;
        position: absolute;
        margin-top: -54px;
        max-width: 100px;
        font-style: italic;
      }

      p6{
        font-size: 15px;
        font-family: "Times New Roman", Times, serif;
        margin-left: 29%;
        text-decoration: underline;
        color: #A8A8A8;
        position: absolute;
        margin-top: -7px;
        font-style: italic;
      }
      p7{
        font-size: 16px;
        font-family: "Times New Roman", Times, serif;
        margin-left: 29%;
        color: #FFFFFF;
        position: absolute;
        margin-top: 9px;
        max-width: 100px;
        font-style: italic;
      }

</style>
  <?php 
require 'User.php';
  $dbname = "Medical";
  $id=$_GET['id'];
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
  
  $sql = "SELECT * FROM Patient where P_SSN=$id";
  $result = $conn->query($sql);
  
  $row = $result->fetch_assoc();
  $result->free();
  $result=$conn->query("SELECT * FROM Visit where P_SSN=$id order by Visit_date, time desc");
  
  ?>
  


  <p10>Profile</p10><a href="Prescription.php?pid=<?php echo $row['P_SSN']?>"style='margin-left:16%;color:#F0F8FF;position:fixed;'>Prescription</a>
  <a href="Bill.php?pid=<?php echo $row['P_SSN']?>"style='margin-left:28%;color:#F0F8FF;position:fixed;'>Bill</a>
  <br>

      <p11><?php echo $row['P_Name']?></p11><br>

      <p11>Age:<?php echo $row['AGE']?></p11><br>
      <p11>Address: <?php echo $row['Address'] ?></p11><br>
      <p11>Phone No. - <?php echo $row['Phone']?></p11>
      <hr>
      <p10>Visit History</p10><br>
      <?php 
      while($ro=$result->fetch_assoc()) {?>
      <p11 style="margin-left:81%;">Visit id:  <?php echo $ro['Visit_id']?>  </p11><br> 
      <p11 style="margin-left:81%;">  <?php echo $ro['time']?>  </p11><br>
      <p11 style="margin-left:80%;"> <?php echo $ro['Visit_date']?>   </p11><br>
      
      <p11 style="text-decoration:underline;  ">Complaint:</p11><br>
      <p11><?php echo $ro['complaint']?></p11>
      <?php } ?>
