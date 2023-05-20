<?php
    $login =0;
    $user=0;
    session_start();
    if(isset($_SESSION['email'], $_SESSION['select'])){
        if($_SESSION['select']=='user'){
            header('location:http://localhost/digifix/user/user.php');
        }else if($_SESSION['select']=='admin'){
            header('location:http://localhost/digifix/admins/admin.php');
        }else if($_SESSION['select']=='vendor'){
            header('location:http://localhost/digifix/admins/admin.php');
        }
    }else{
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $con = mysqli_connect('localhost','root','');
            if(!$con){
                die(mysqli_error($con));
            }

            $email = $_POST['email'];
            $password = $_POST['password'];
            if(!empty($_POST['select'])) {  
                $selected = $_POST['select'];  
            }
            $sql = "Select * from `digifix`.`$selected` where email='$email' and password='$password';";
            $result =mysqli_query($con,$sql);
            if($result){
                $num=mysqli_num_rows($result);
                if($num>0){
                    echo "Sign in successful!";
                    $login =1;
                    session_start();
                    $_SESSION['email']=$email;
                    $_SESSION['select']=$selected;
                    if($selected=='user'){
                        
                        header('location:http://localhost/digifix/user/user.php');
                    }else if($selected=='vendor'){
                        header('location:http://localhost/digifix/vendor/vendor.php');
                    }else if($selected=='admin'){
                        header('location:http://localhost/digifix/admins/admin.php');
                    }
                }else{
                    $user=1;
                }
            }else{
                die(mysqli_error($con));
            }
        }
      }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- <link rel="stylesheet" href="./style.css" /> -->
    <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="left">
        <div class="logodiv">
          <img class="logo" src="./logo1.png" alt="" />
        </div>
        <div class="left-body">
          <h1 class="left-head">DigiFix</h1>
          <p class="left-desc">
            DigiFix helps you to connect and share with the service providers in
            your Organization.
          </p>
        </div>
      </div>
      <div class="right-body">
      <?php
        if($user){
              echo'<div class="alert">
                <h1>Invalid Data !</h1>
              </div>';
        }
      ?>
        <form action=""  method="POST" class="form">
            <label for="chk">Log in</label>
            <input type="email" name="email" placeholder="Email" required="">
            <input type="password" name="password" placeholder="Password" required="">
            <select name="select" required>  
              <option value = "" selected>-- Select option--</option>  
              <option value = "user" > User </option>  
              <option value = "vendor" > Vendor </option>  
              <option value = "admin" > Admin </option> 
          </select> 
            <button type="submit">Sign In</button>
            <!-- <div class="link forget-pass text-left"><a href="./forgot_password.php">Forgot password?</a></div>  -->
            <div class="alrady">
              <i class="">Don't have an account <a href="./index.php">sign-Up</a></i>
             </div>
          </form>
      </div>
    </div>
  </body>
</html>
<?php
if($login) {
echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success </strong> You are successfully loged in.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true" >&times;</span>
</button>
</div>';
}
?>
</body>
</html>