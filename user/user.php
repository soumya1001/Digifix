<?php
session_start();
if(!isset($_SESSION['email'])){
  header('location:http://localhost/digifix/login.php');
}
$con = mysqli_connect('localhost','root','');
  if(!$con){
    die(mysqli_error($con));
  }
  $semail=$_SESSION['email'];
  $ssql = "Select * from `digifix`.`user` where `email`='$semail';";
  $sresult=mysqli_query($con,$ssql);
if($sresult){
    $row=mysqli_fetch_assoc($sresult);
        $sid=$row['id'];
        $sname=$row['name'];
        $sphone=$row['phone'];
}
if($_SERVER['REQUEST_METHOD']=='POST'){
  
  // $complaint_no=$_POST['complaint_no'];
  $devcieName = $_POST['devicename'];
  $serialNo = $_POST['serialno'];
  $details = $_POST['details'];
  $problem = $_POST['problem'];
  $address = $_POST['address'];
          
  $data = "INSERT INTO `digifix`.`complaint` (`user_name`,`user_email`,`user_phone_no`,`complaint_no`,`device_name`,`sl_no`, `details`, `problem`, `address`) VALUES ('$sname','$semail','$sphone',NULL,'$devcieName','$serialNo' , '$details', '$problem', '$address');";

  $result=mysqli_query($con, $data);
  if($result){
    header('location:status.php');
  }else{
    die(mysqli_error($con));
  }
  //header('location:registaion_sucessfull.html');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiFix_User</title>
    <link rel="stylesheet" href="./style.css"> <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  </head>
<body>
<div class="header">
        <!-- head -->
        <div class="head" id="head">
            <div class="headleft">
            
                <div class="logo">
                    <img src="../images/digifix logo.png" alt="">
                </div>
            </div>
            <div class="headright">
                <div class="adminlogo"><img src="../images/logo men.png" alt=""></div>
                <div class="adminname">Hello, <?php echo $sname?></div>
                <div class="logout"><a href="../logout.php"><i class="bi bi-box-arrow-right"></i></a></i></div>
            </div>
        </div>
        <!-- nav -->
        <div class="nav">
            <a href="./user.php">Home</a>
            <a href="./status.php">Status</a>
            <!-- <a href="#user">Device</a> -->
            <a href="#vendor">Help & Services</a>            
        </div>
<?php
          echo "User ID: " . $sid . "<br>";
          echo "Username: " . $sname . "<br>";  
          // echo "phone NO: " . $sphone . "<br>"; 
               
      ?>
<div style="margin-left:70px">

</div>
  
   <div class="sidenav">
     
   </div>
   
    </div>
    
    <div>  
    </div>
    <!-- reg-page -->
     <div class="container">
        <div class="title">Register your Problem</div>
      
          <form action="user.php" method="POST">

            <div class="user-details">
            
              <div class="input-box">
                <span class="details">Device Name</span>
                <input type="text" name="devicename" placeholder="Enter your Device Name" required>
              </div>
             
              <div class="input-box">
                <span class="details">Serial No</span>
                <input type="text" name="serialno" placeholder="Enter your Serial No" >
              </div>

              <div class="input-box" >
                    <span class="details">Device problem</span>
                    <textarea cols="80" name="problem" rows="2" placeholder="write your Device Problem" required></textarea>  
              </div>
              
              <div class="input-box" >
                <span class="details">Problem Detais</span>
                <textarea cols="50" name="details" rows="5" placeholder="write your problem in details"  ></textarea>  
              </div>
              

              <div class="input-box" >
                    <span class="details">Department</span>
                    <input name="address"  placeholder="Mention Your Department Name" value="" required></input>  
              </div>
            
            </div>

            <div class="button">
              <input type="submit">
            </div>

          </form>

        </div>

    </div>
    <footer>
        <div class="footer">
            <p>copyright © 2023 . DigiFix . All rights reserved</p>
        </div>
    </footer>
</body>
</html>