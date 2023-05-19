<?php
  $con = mysqli_connect('localhost','root','');
  if(!$con){
    die(mysqli_error($con));
  }
  $email=$_GET['removeadmin'];
  $sql = "DELETE FROM `digifix`.`admin` WHERE `admin`.`email` = '$email';";
  if (mysqli_query($con, $sql)) {
      echo "Record deleted successfully";
      header('location:admin.php');
  } else {
      echo "Error deleting record: " . mysqli_error($con);
  }
  mysqli_close($con);

?>