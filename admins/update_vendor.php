<?php
session_start();
if(!isset($_SESSION['email'])){
  header('location:http://localhost/digifix/login.php');
}


    $con = mysqli_connect('localhost','root','');
    if(!$con){
      die(mysqli_error($con));
    }

    $email=$_GET['updateemail'];

    $sql="select * from `digifix`.`vendor` where email='$email'";
    $result=mysqli_query($con,$sql);
    if($result){
     while($row=mysqli_fetch_assoc($result)){
         $name=$row['name'];
         $email=$row['email'];
         $phone=$row['phone'];
        //  $password=$row['password'];
     }
    
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        // $password = $_POST['password'];
        
        $sql2 = "UPDATE `digifix`.`vendor` SET `name` = '$name', `phone` = '$phone', `email` = '$email'  WHERE `vendor`.`email` = '$email';";
    
        $result2=mysqli_query($con,$sql2);
        if($result2){
            header('location:admin.php');
           echo "update successful";
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

    <title>update vendor</title>
</head>
<body>
  
    <div class="container mt-5">

        

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>update vendor
                            <a href="admin.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">

                            <div class="mb-3">
                                <label> Name</label>
                                <input value="<?php echo $name; ?>" type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input value="<?php echo $email; ?>" type="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <input value="<?php echo $phone; ?>" type="text" name="phone" class="form-control">
                            </div>
                            <!-- <div class="mb-3">
                                <label>password</label>
                                <input value="<?php echo $password; ?>" type="password" name="password" class="form-control">
                            </div> -->
                            <div class="mb-3">
                                <button type="submit" name="save" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
