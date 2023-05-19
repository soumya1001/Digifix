<?php
session_start();
if(!isset($_SESSION['email'])){
  header('location:http://localhost/digifix/login.php');
}
$email=$_SESSION['email'];
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiFix_Complaint_Status</title>
    <!-- <link rel="stylesheet" href="./style1.css"> -->
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
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
                <div class="adminname">Hello,<?php echo $sname?></div>
                <div class="logout"><a href="../logout.php"><i class="bi bi-box-arrow-right"></i></a></i></div>
            </div>
        </div>
        <!-- nav -->
        <div class="nav">
            <a href="./user.php">Request Problems</a>
            <a href="./status.php">Status</a>
            <a href="#vendor">Help & Services</a>   
        </div>
    </div>

<!-------------pending...............-->
<div class="applications" id="applications">
        <div class="headtag1">
            <h1>Complaint Requests</h1>
        </div>
        <div class="application_table">
            <table id="application_table_body" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Complaint No.</th>
                        <th>Device Name</th>
                        <th>Sl No.</th>
                        <th>Problem</th>
                        <!-- <th>Action</th> -->

                    </tr>
                   
                </thead>
                <tbody>
                    <?php
                      $con = mysqli_connect('localhost','root','');
                      if(!$con)
                    {
                        die(mysqli_error($con));
                      }
                      $sql = "Select * from `digifix`.`complaint` where `user_email`='$semail';";
                      
                    //   $sql = "Select * from `digifix`.`complaint_approve` where `useremail`='$useremail' AND `status`<>'Complaint Registred';";
                      $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $complaintno=$row['complaint_no'];
                            $device_name=$row['device_name'];
                            $sl=$row['sl_no'];
                            // $problem=$row['problem'];
                            $problem=$row['problem'];
                        echo '<tr>
                        <td>'. $complaintno.'</td>
                        <td>'.$device_name.'</td> 
                        <td>'. $sl.'</td> 
                        <td>'.$problem.'</td> 
                        </tr>';
                        }
                    }
                    else{
                        die(mysqli_error($con));
                    }
                    ?>
                                            <!-- <td>
                        <a href="./view_resolved_application.php?viewapplication='.$complaintno.'"><img class=action_icon src="../images/action_logo/view icon.png" alt=""></a>
                        </td> -->
                </tbody>
            </table>
        </div>
    </div>    

    <!-- accepted -->

    <div class="applications" id="applications">
        <div class="headtag">
            <h1>Registered Complaints</h1>
        </div>
        <div class="application_table">
            <table id="application_table_body" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Complaint No.</th>
                        <th>Device Name</th>
                        <th>Sl No.</th>
                        <!-- <th>Problrm</th> -->
                        <th>Vendor</th>
                        <th>Status</th>
                    </tr>
                   
                </thead>
                <tbody>
                    <?php
                      $con = mysqli_connect('localhost','root','');
                      if(!$con)
                    {
                        die(mysqli_error($con));
                      }
                      $sql = "Select * from `digifix`.`complaint_approve` where `useremail`='$email' ;";
                      
                    //   $sql = "Select * from `digifix`.`complaint_approve` where `useremail`='$useremail' AND `status`<>'Complaint Registred';";
                      $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $complaintno=$row['complaint_no'];
                            $name=$row['name'];
                            $sl=$row['sl'];
                            // $problem=$row['problem'];
                            $vendor=$row['vendor'];
                            $status=$row['status'];
                        echo '<tr>
                        <td>'. $complaintno.'</td>
                        <td>'.$name.'</td> 
                        <td>'. $sl.'</td> 
                        <td>'.$vendor.'</td> 
                        <td >'.$status.'</td>
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
    
    <!---- Pending CONFIRMATION---->

    <div class="applications" id="applications">
        <div class="headtag">
            <h1>Pending Confirmtion</h1>
        </div>
        <div class="application_table">
        <table id="application_table_body" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Complaint No.</th>
                        <th>Device Name</th>
                        <th>Sl No.</th>
                        <!-- <th>Problrm</th> -->
                        <th>Vendor</th>
                        <th>Vendor Status</th>
                        <th>Your Confirmation</th>
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
                      $sql = "Select * from `digifix`.`complaint_approve` where `useremail`='$email' and `user_confirmation`='pending';";
                      
                    //   $sql = "Select * from `digifix`.`complaint_approve` where `useremail`='$useremail' AND `status`<>'Complaint Registred';";
                      $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $complaintno=$row['complaint_no'];
                            $name=$row['name'];
                            $sl=$row['sl'];
                            // $problem=$row['problem'];
                            $vendor=$row['vendor'];
                            $status=$row['status'];
                            $user_confirmation=$row['user_confirmation'];
                        echo '<tr>
                        <td>'. $complaintno.'</td>
                        <td>'.$name.'</td> 
                        <td>'. $sl.'</td> 
                        <td>'.$vendor.'</td> 
                        <td >'.$status.'</td>
                        <td>'.$user_confirmation.'</td>
                        <td>
                        <a href="./user_confirmation.php?viewapplication='.$complaintno.'"><img class=action_icon src="../images/action_logo/view icon.png" alt=""></a>
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

</body>
</html>