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
        $sname=$row['name'];
}
    $sql1 = "SELECT COUNT(*) as count FROM `digifix`.`user`";
        $result1=mysqli_query($con,$sql1);
        if($result1){
            $row=mysqli_fetch_assoc($result1);
            $usercount = $row['count'];
        }
    $sql2 = "SELECT COUNT(*) as count FROM `digifix`.`vendor`";
        $result2=mysqli_query($con,$sql2);
        if($result2){
            $row=mysqli_fetch_assoc($result2);
                $vendorcount=$row['count'];
        }
    $sql3 = "SELECT COUNT(*) as count FROM `digifix`.`admin`";
        $result3=mysqli_query($con,$sql3);
        if($result3){
            $row=mysqli_fetch_assoc($result3);
                $admincount=$row['count'];
        }
    $sql4 = "SELECT COUNT(*) as count FROM `digifix`.`complaint`";
        $result4=mysqli_query($con,$sql4);
        if($result4){
            $row=mysqli_fetch_assoc($result4);
                $applicationcount=$row['count'];
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiFix_Admin</title>
    <link rel="stylesheet" href="./style.css">
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
                <div class="adminname">Hi, <?php echo $sname?></div>
                <div class="logout" title="Logout"><a href="../logout.php"><i class="bi bi-box-arrow-right"></i></a></i></div>
            </div>
        </div>
        <!-- nav -->
        <div class="nav">
            <a href="#home">Home</a>
            <a href="#applications">Requests</a>
            <a href="#user">Users</a>
            <a href="#vendor">Vendors</a>
        </div>
    </div>
    <!-- home -->
    <div class="home" id="home">
        <div class="hometop">
            <div class="box">
                
                <h1><?php echo $admincount; ?></h1>
                <h2>Admins</h2>
            </div>
            <div class="box">
                <h1><?php echo $usercount; ?></h1>
                <h2>Users</h2>
            </div>
            <div class="box">
                <h1><?php echo $applicationcount; ?></h1>
                <h2>Applications</h2>
            </div>
            <div class="box">
                <h1><?php echo $vendorcount; ?></h1>
                <h2>Vendors</h2>
            </div>
        </div>

    <!-- ...............................applications .....................................-->

    <div class="applications" id="applications">
        <div class="headtag">
            <h1>Complaint Requests</h1>
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
                        <th>Problem</th>
                        <!-- <th>Specification</th> -->
                        <!-- <th>Problem</th> -->
                        <!-- <th>Address</th> -->
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
                      $sql = "Select * from `digifix`.`complaint`;";
                      $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $complaint_no=$row['complaint_no'];
                            $username=$row['user_name'];
                            $useremail=$row['user_email'];
                            $userphone=$row['user_phone_no'];
                            $name=$row['device_name'];
                            $problem=$row['problem'];
                            // $spec=$row['spec'];
                            // $problem=$row['problem'];
                            // $address=$row['address'];
                        echo '<tr>
                        <td>'.$complaint_no.'</td>
                        <td>'.$username.'</td> 
                        <td>'.$useremail.'</td> 
                        <td>'.$userphone.'</td>
                        <td>'.$name.'</td> 
                        <td >'.$problem.'</td>
                        <td>
                        <a href="./view_application.php?viewapplication='.$complaint_no.'"><img class=action_icon src="../images/action_logo/view icon.png" alt=""></a>
                    
                        <a href="./remove_application.php?removeaplication='.$complaint_no.'"><img class=action_icon src="../images/action_logo/cross icon.png" alt=""></a></td>
                        </tr>';
                        }
                    }
                    else{
                        die(mysqli_error($con));
                    }
                    ?>
            </table>
        </div>
    </div>

    <!-- ...............................applications approve .....................................-->

    <div class="applications" id="applications">
        <div class="headtag">
            <h1>Registered Complaints</h1>
        </div>
        <div class="application_table">
            <table id="application_table_body" class="table" style="width:100% ">
                <thead>
                    <tr>
                      <th>Compalint Reg No</th>
                      <th>User Name</th>
                      <th>user Email</th>
                      <th>user phone</th>
                        <th>Device Problem</th>
                        <th>Vendor ID</th>
                        <th>Status</th>
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
                      $sql = "Select * from `digifix`.`complaint_approve`;";
                      $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $complaintno=$row['complaint_no'];
                            $username=$row['username'];
                            $useremail=$row['useremail'];
                            $userphone=$row['userphone'];
                            $problem=$row['problem'];
                            // $spec=$row['spec'];
                            // $problem=$row['problem'];
                            $vendor=$row['vendor'];
                            $status=$row['status'];
                        echo '<tr>
                        <td>'. $complaintno.'</td>
                        <td>'.$username.'</td> 
                        <td>'. $useremail.'</td> 
                        <td>'.$userphone.'</td>
                        <td>'.$problem.'</td> 
                        <td >'.$vendor.'</td>
                        <td >'.$status.'</td>
                        <td>
                       
                        </tr>';
                        }
                    }
                    else{
                        die(mysqli_error($con));
                    }
                    ?>
            </table>
        </div>
    </div>
    <!--........... users.............................................. -->
    <div class="user" id="user">
        <div class="userbody">
            <div class="userhead">
                <h1>Users</h1>
            </div>
            <div class="user_table">
                <table class="table">
                    <tr>
                        <!-- <th>SL.No</th> -->
                        <!-- <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Remove user</th> -->
                        <!-- <td>Sl.No.</td> -->
                        <th>User ID</th>
                        <th>Full Name</th>
                        <th>Mob No</th>
                         <th>email</th>
                         <th>Delete</th>

                    </tr>
                    <?php
                      $con = mysqli_connect('localhost','root','');
                      if(!$con){
                        die(mysqli_error($con));
                      }
                      $sql = "Select * from `digifix`.`user`;";
                      $result=mysqli_query($con,$sql);

                    if($result){ 
                        while($row=mysqli_fetch_assoc($result)){
                            ?>
                            <tbody>
                                <tr>
                                     <td> <?php echo $row['id']; ?> </td>
                                    <td> <?php echo $row['name']; ?> </td>
                                    <td> <?php echo $row['phone']; ?> </td>
                                    <td> <?php echo $row['email']; ?> </td>

                                    <td><a href="delete_user.php?id=<?php echo $row["id"]; ?>"><img class=action_icon src="../images/action_logo/cross icon.png" alt=""></a></td>
                                  </from>


                                </tr>

                            </tbody>
                         <?php
                        }
                    }
                    else{
                        die(mysqli_error($con));
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <!-- .............................Admins .......................................-->
    <div class="admin" id="admin">
        <div class="adminbody">
            <div class="adminhead">
                <h1>Admins</h1>
                <div class="addadmin">
                    <a href="./add_admin.php"><h1><i class="bi bi-person-fill-add"></i></h1></a>
                </div>
            </div>
            <div class="admin_table">
                <table class="table">
                <tr>
                        <!-- <th>SL.No</th> -->
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Action.</th>
                        <!-- <th>Password</th> -->

                </tr>
                <?php
                      $con = mysqli_connect('localhost','root','');
                      if(!$con){
                        die(mysqli_error($con));
                      }
                      $sql = "Select * from `digifix`.`admin`;";
                      $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $name=$row['name'];
                            $phone=$row['phone'];
                            $email=$row['email'];
                            // $password=$row['password'];

                        echo '<tr>
                        <td>'.$name.'</td>
                        <td>'.$email.'</td>
                        <td>'.$phone.'</td>
                        <td>
                        <a href="./update_admin.php?updateemail='.$email.'"><img class=action_icon src="./image/clipart446916.png" alt=""></a>
                        <a href="./remove_admin.php?removeadmin='.$email.'"><img class=action_icon src="../images/action_logo/cross icon.png" alt=""></a>
                        </td> 
                        </tr>';

                        }

                    }
                    else{
                        die(mysqli_error($con));
                    }
                    ?>
            </table>
            </div>
        </div>
    </div>
    <!--........................ Vendor.......................................... -->
    <div class="vendor" id="vendor">
        <div class="vendorbody">
            <div class="vendorhead">
                <h1>Vendor</h1>
                <div class="addvendor">
                    <div class="addvendor">
                        <a href="./add_vendor.php"><h1><i class="bi bi-person-fill-add"></i></h1></a>
                    </div>
                </div>
            </div>
            <div class="div_vendor_table">
                <table class="table">
                        <tr>
                            <th>vendor ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <!-- <th>Reg.Date</th> -->
                            <th>Action</th>
                        </tr>
                        <?php
                      $con = mysqli_connect('localhost','root','');
                      if(!$con){
                        die(mysqli_error($con));
                      }
                      $sql = "Select * from `digifix`.`vendor`;";
                      $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $id=$row['vendor_id'];
                            $name=$row['name'];
                            $email=$row['email'];
                            $phone=$row['phone'];
                            $vendor_id=$row['vendor_id'];

                        echo '<tr?>
                        <td>'.$id.'</td>
                        <td>'.$name.'</td>
                        <td>'.$email.'</td>
                        <td>'.$phone.'</td>
                        <td>
                        <a href="./update_vendor.php?updateemail='.$email.'"><img class=action_icon src="./image/clipart446916.png" alt=""></a>
                        <a href="./delete_vendor.php?id='.$vendor_id.'"><img class=action_icon src="../images/action_logo/cross icon.png" alt=""></a>
                        </td> 
                        </tr>';

                        }

                    }
                    else{
                        die(mysqli_error($con));
                    }
                    ?> 
                </table>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer">
            <p>copyright © 2023 . DigiFix . All rights reserved</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>