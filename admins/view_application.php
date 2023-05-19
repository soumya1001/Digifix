<?php
// session_start();
// if(!isset($_SESSION['email'])){
//   header('location:http://localhost/digifix/login.php');
// }


    $con = mysqli_connect('localhost','root','');
    if(!$con){
      die(mysqli_error($con));
    }

    $complaint=$_GET['viewapplication'];

    $sql="select * from `digifix`.`complaint` where complaint_no='$complaint'";
    $result=mysqli_query($con,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $complaint_no=$row['complaint_no'];
            $username=$row['user_name'];
            $useremail=$row['user_email'];
            $userphone=$row['user_phone_no'];
            $name=$row['device_name'];
            $sl=$row['sl_no'];
            $details=$row['details'];
            $problem=$row['problem'];
            $address=$row['address'];
        //  $password=$row['password'];
     }
    
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        $complaintno=$_POST['complaint_no'];
        $username=$_POST['user_name'];
        $useremail=$_POST['user_email'];
        $userphone=$_POST['user_phone'];
        $name=$_POST['device_name'];
        $sl=$_POST['sl_no'];
        $details=$_POST['details'];
        $problem=$_POST['problem'];
        $address=$_POST['address'];
        $vendor=$_POST['vendor'];

        $sql= "INSERT INTO `digifix`.`complaint_approve` (`complaint_no`, `username`, `useremail`, `userphone`, `name`, `sl`, `details`, `problem`, `address`, `vendor`) VALUES ('$complaintno', '$username', '$useremail', '$userphone', '$name', ' $sl', '$details', '$problem', '$address', '$vendor');";
        
        $result=mysqli_query($con,$sql);
        if($result){
           $sql2= "DELETE FROM `digifix`.`complaint` WHERE `complaint`.`complaint_no` = $complaint_no;";
           $result2=mysqli_query($con,$sql2);
           if($result2){
            header('location:admin.php');
           echo "delete successful";
          }else{
            die(mysqli_error($con));
          }
        }else{
          die(mysqli_error($con));
        }
      }



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Assign Vendor</title>
</head>
<body>
  
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Please assign a Vendor
                            <a href="admin.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

             <form action="" method="POST">
            <div class="user-details">

            <div class="input-box">
                <span class="details">Complaint No</span>
                <input readonly value="<?php echo $complaint_no; ?>" type="text" name="complaint_no" placeholder="Enter your Device Name" required>
              </div>

            <div class="input-box">
                <span class="details">User Name</span>
                <input readonly value="<?php echo $username; ?>" type="text" name="user_name" placeholder="Enter your Device Name" required>
              </div>

              <div class="input-box">
                <span class="details">user email</span>
                <input readonly value="<?php echo $useremail; ?>" type="text" name="user_email" placeholder="Enter your Device Name" required >
              </div>

            <div class="input-box">
                <span class="details">user Phone no</span>
                <input readonly value="<?php echo $userphone; ?>" type="text" name="user_phone" placeholder="Enter your Device Name" required>
              </div>
            
              <div class="input-box">
                <span class="details">Device Name</span>
                <input readonly value="<?php echo $name; ?>" type="text" name="device_name" placeholder="Enter your Device Name" required>
              </div>
             
              <div class="input-box">
                <span class="details">Serial No</span>
                <input readonly value="<?php echo $sl; ?>" type="text" name="sl_no" placeholder="Enter your Serial No" >
              </div>

              <div class="input-box" >
                    <span class="details">Device problem</span>
                    <textarea readonly cols="80" name="problem" rows="5" placeholder="write your Device Problem" value="problem" required><?php echo $problem; ?></textarea>  
              </div>

              <div class="input-box" >
                <span class="details">Problem Detais</span>
                <textarea readonly cols="50" name="spec" rows="5" placeholder="write your device Specifications" value="problem" required><?php echo $details; ?></textarea>  
              </div>

              <div class="input-box" >
                    <span class="details">Department</span>
                    <textarea readonly cols="80" name="address" rows="5" placeholder="write your Address" value="problem" required><?php echo $address; ?></textarea>  
              </div>
            
            </div>

            <div class="input-box">
            <span class="details">Select Vendor</span>
            <?php
                      $con = mysqli_connect('localhost','root','');
                      if(!$con)
                    {
                        die(mysqli_error($con));
                      }
                      $sql = "Select `name`,`vendor_id` from `digifix`.`vendor`;";
                      $result=mysqli_query($con,$sql);
                    if($result){
                      
                      echo '<select name="vendor" required>';
                      echo '<option value="" selected>-- Select option--</option>';
                      
                      while($row=mysqli_fetch_assoc($result)){
                        
                        echo "<option value='" . $row["vendor_id"] . "'>" . $row["name"] . "  " . $row["vendor_id"] . "</option>";
                  
                      }
                      echo '</select>';
                      
                       
                    }
                    else{
                        die(mysqli_error($con));
                    }
                    ?>
            </div>

            <div class="button">
              <input value="Assign Vendor" type="submit"> 
            </div>

          </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        
.container{
height: 100%;
width: 100%;
background-color: #fff;
padding: 25px 30px;
padding-top: 5px; 
display:flex;
align-items: center;
justify-content: center;
flex-direction: column;

}
.container .title{
font-size: 25px;
position: relative;

}
.container .title::before{
content: "";
position: absolute;
left: 0;
bottom: 0;
height: 3px;
width: 30px;
border-radius: 5px;
background: linear-gradient(135deg, #71b7e6, #9b59b6);
}

.content form .user-details{
display: flexbox;
justify-content: space-between;
padding: 15px 0 12px 0;

}
form .user-details .input-box{
padding-bottom: 4px;
padding-top: 8px;
/* height: 100%; */
}

form .input-box span.details{
display: block;
padding-bottom: 5px;
}
.user-details{
display: flexbox;

}
.details{
font-size: 20px;
}
.input-box input{
height: 50px;
width: 100%;
display: flex;
outline: none;
font-size: 16px;
border-radius: 5px;
padding-left: 15px;
border: 1px solid #ccc;
border-bottom-width: 2px;
transition: all 0.3s ease;
}
.input-box textarea{
width: 100%;
display: flex;
outline: none;
font-size: 16px;
border-radius: 5px;
padding-left: 15px;
border: 1px solid #ccc;
border-bottom-width: 2px;
transition: all 0.3s ease;
}
form .button{
 height: 66px;
align-items: center;
padding-top: 20px;
padding-left: 100px;
padding-right: 100px;
}
form .button input{
 height: 100%;
 width: 100%;
 border-radius: 5px;
 border: none;
 color: #fff;
 font-size: 18px;
 font-weight: 500;
 letter-spacing: 1px;
 cursor: pointer;
 transition: all 0.3s ease;
 background: linear-gradient(135deg, #56b0ec, #8028a2);
}
form .button input:hover{

background: linear-gradient(-135deg, #71b7e6, #9b59b6);
}

@media(max-width: 584px){
.container{
max-width: 100%;
}
form .user-details .input-box{
padding-bottom: 15px;
  width: 100%;
}
form .category{
  width: 100%;
}
.content form .user-details{
  max-height: 300px;
  overflow-y: scroll;
}
.user-details::-webkit-scrollbar{
  width: 5px;
}
}
@media(max-width: 459px){
.container .content .category{
  flex-direction: column;
}
}  
    </style>
</body>
</html>