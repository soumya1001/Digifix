<?php
session_start();
if(!isset($_SESSION['email'])){
  header('location:http://localhost/digifix/login.php');
}
$con = mysqli_connect('localhost','root','');
  if(!$con)
{
    die(mysqli_error($con));
 }
$semail=$_SESSION['email'];
$ssql = "Select `vendor_id`,`name` from `digifix`.`vendor` where `email`='$semail';";
$sresult=mysqli_query($con,$ssql);
if($sresult){
  $row=mysqli_fetch_assoc($sresult);
      $vendor_id=$row['vendor_id'];
      $vendor_name=$row['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiFix_Vendor</title>
    <link rel="stylesheet" href="./vendor.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
   </head>
<body>
    <div class="header">
        <!-- head -->
        <div class="head" id="head">
            <div class="headleft">
                <div class="logo">
                    <img src="../images/logo2.png" alt="">
                </div>
            </div>
            <div class="headright">
                <div class="adminlogo"><img src="../images/logo men.png" alt=""></div>
                <div class="adminname">Hi, <?php echo $vendor_name; ?></div>
                <div class="logout" title="Logout"><a href="../logout.php"><i class="bi bi-box-arrow-right"></i></a></i></div>
            </div>
        </div>
        <!-- nav -->
        <div class="nav">
            <a href="#home">Home</a>
            <a href="#applications">Requests</a>
            <!-- <a href="#vendor">Update Status</a>   -->
            <a href="#user">Generate Bill</a> 
        </div>
    </div>
    <!-- ........................................applications........................................ -->
    <div class="applications" id="applications">
        <div class="headtag">
            <h1>Applications</h1>
        </div>
        <div class="application_table">
            <table id="application_table_body" class="table" style="width:100% ">
                <thead>
                    <tr>
                      <th>Compalint Reg No</th>
                      <th>User Name</th>
                      <th>user Email</th>
                      <th>user phone</th>
                        <th>Device Name</th>
                        <th>Device Serial No</th>
                        <th>Status</th>
                        
                        <!-- <th>Problem</th> -->
                        <!-- <th>Address</th> -->
                        <!-- <th>Vendor ID</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      $con = mysqli_connect('localhost','root','');
                      if(!$con)
                    {
                        die(mysqli_error($con));
                      }
                      $sql = "Select * from `digifix`.`complaint_approve` where `vendor`='$vendor_id' AND `status`<>'Issue Resolved';";
                    // $sql = "Select * from `digifix`.`complaint_approve` where `vendor`='$vendor_id';";
                      $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $complaintno=$row['complaint_no'];
                            $username=$row['username'];
                            $useremail=$row['useremail'];
                            $userphone=$row['userphone'];
                            $name=$row['name'];
                            $sl=$row['sl'];
                            $status=$row['status'];
                            // $problem=$row['problem'];
                            // $address=$row['address'];
                            // $vendor=$row['vendor'];
                        echo '<tr>
                        <td>'. $complaintno.'</td>
                        <td>'.$username.'</td> 
                        <td>'. $useremail.'</td> 
                        <td>'.$userphone.'</td>
                        <td>'.$name.'</td> 
                        <td >'.$sl.'</td>
                        <td >'.$status.'</td>
                       
                        <td>
                        <a href="./vendor-view_application.php?viewapplication='.$complaintno.'"><img class=action_icon src="../images/action_logo/view icon.png" alt=""></a>
                    
                       
                        </tr>';
                        }
                    }
                    else{
                        die(mysqli_error($con));
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--........................................... resolved..............................................  -->
    <div class="applications" id="applications">
        <div class="headtag">
            <h1>Pending User's Confirmation</A></h1>
        </div>
        <div class="application_table">
            <table id="application_table_body" class="table" style="width:100%">
                <thead>
                    <tr>
                    <th>Compalint Reg No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Device Name</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                   
                </thead>
                <tbody>
                    <?php
                      $con = mysqli_connect('localhost','root','');
                      if(!$con)
                    {
                        die(mysqli_error($con));
                      }
                      $sql = "Select * from `digifix`.`complaint_approve` where `vendor`='$vendor_id' AND `status`='Issue Resolved' and `user_confirmation`<>'Issue Resolved';";
                      $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $complaintno=$row['complaint_no'];
                            $username=$row['username'];
                            $useremail=$row['useremail'];
                            $userphone=$row['userphone'];
                            $problem=$row['name'];
                            $sl=$row['address'];
                        echo '<tr>
                        <td>'. $complaintno.'</td>
                        <td>'.$username.'</td> 
                        <td>'. $useremail.'</td> 
                        <td>'.$userphone.'</td>
                        <td>'.$problem.'</td> 
                        <td >'.$sl.'</td>
                    
                        <td>
                        <a href="./view_resolved_application.php?viewapplication='.$complaintno.'"><img class=action_icon src="../images/action_logo/view icon.png" alt=""></a>
                            </td>
                       
                        </tr>';
                        }
                    }
                    else{
                        die(mysqli_error($con));
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
        <!-- pending... -->
    <div class="applications" id="applications">
        <div class="headtag">
            <h1>Resolved Applications</h1>
        </div>
        <div class="application_table">
            <table id="application_table_body" class="table" style="width:100%">
                <thead>
                    <tr>
                    <th>Compalint Reg No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Device Name</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                   
                </thead>
                <tbody>
                    <?php
                      $con = mysqli_connect('localhost','root','');
                      if(!$con)
                    {
                        die(mysqli_error($con));
                      }
                      $sql = "Select * from `digifix`.`complaint_approve` where `vendor`='$vendor_id' AND `status`='Issue Resolved' and `user_confirmation`='Issue Resolved';";
                      $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $complaintno=$row['complaint_no'];
                            $username=$row['username'];
                            $useremail=$row['useremail'];
                            $userphone=$row['userphone'];
                            $problem=$row['name'];
                            $sl=$row['address'];
                        echo '<tr>
                        <td>'. $complaintno.'</td>
                        <td>'.$username.'</td> 
                        <td>'. $useremail.'</td> 
                        <td>'.$userphone.'</td>
                        <td>'.$problem.'</td> 
                        <td >'.$sl.'</td>
                
                        <td>
                        <a href="./view_resolved_application.php?viewapplication='.$complaintno.'"><img class=action_icon src="../images/action_logo/view icon.png" alt=""></a>
                    
                       </td>
                        </tr>';
                        }
                    }
                    else{
                        die(mysqli_error($con));
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer>
        <div class="footer">
            <p>copyright © 2023 . DigiFix . All rights reserved</p>
        </div>
    </footer>
</body>
</html>