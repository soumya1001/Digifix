<?php
session_start();
if(!isset($_SESSION['email'])){
  header('location:http://localhost/digifix/login.php');
}


    $con = mysqli_connect('localhost','root','');
    if(!$con){
      die(mysqli_error($con));
    }

    $complaint=$_GET['viewapplication'];

    $sql="select * from `digifix`.`complaint_approve` where complaint_no='$complaint';";
    $result=mysqli_query($con,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $complaint_no=$row['complaint_no'];
            $name=$row['name'];
            $problem=$row['problem'];
            $vendor=$row['vendor'];
            $status=$row['status'];
            $details=$row['details'];
     }
    
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        $complaintno=$_POST['complaint_no'];
        $userconfirmation=$_POST['user_confirmation'];

        $sql2= "UPDATE `digifix`.`complaint_approve` SET `user_confirmation` =  '$userconfirmation' WHERE `complaint_approve`.`complaint_no` = '$complaintno';";
       
        $result=mysqli_query($con,$sql2);
        if($result){
            header('location:status.php');
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

    <title>user applcation view</title>
</head>
<body>
  
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Confirmation
                            <a href="status.php" class="btn btn-danger float-end">BACK</a>
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
                <span class="details">Device Name</span>
                <input readonly value="<?php echo $name; ?>" type="text" name="user_name" placeholder="Enter your Device Name" required>
              </div>

              <div class="input-box">
                <span class="details">Problem</span>
                <input readonly value="<?php echo $problem; ?>" type="text" name="user_email" placeholder="Enter your Device Name" required >
              </div>


              <div class="input-box" >
                <span class="details">Problem Detais</span>
                <textarea readonly cols="80" name="details" rows="5" placeholder="write your device Specifications"required><?php echo $details; ?></textarea>  
              </div>


              <div class="input-box">
                <span class="details">Vendor</span>
                <input readonly value="<?php echo $vendor; ?>" type="text" name="vendor" placeholder="Enter your Device Name" required >
              </div>

              <div class="input-box">
                <span class="details">Vendor Status</span>
                <input readonly value="<?php echo $status; ?>" type="text" name="user_email" placeholder="Enter your Device Name" required >
              </div>

              <div class="input-box">
                <span class="details">Confirm Your Status : </span>
                <select name="user_confirmation" id="user_confirmation" required>  
                    <option value = "" selected>-- Select option--</option>  
                    <option value = "Issue Resolved"> Issue Resolved </option>  
                    <option value = "Not Resolved"> Not Resolved </option>  
                </select> 
                </div>
            
            </div>
      


            <div class="button">
              <input value="Yes, Issue Resolve" type="submit"> 
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