<?php
  $con = mysqli_connect('localhost','root','');
  if(!$con){
    die(mysqli_error($con));
  }
  $id=$_GET['id'];
  $sql = "DELETE FROM `digifix`.`vendor` WHERE `vendor`.`vendor_id` = '$id';";
  if (mysqli_query($con, $sql)) {
      echo "Record deleted successfully";
      header('location:admin.php');
  } else {
      echo "Error deleting record: " . mysqli_error($con);
  }
  mysqli_close($con);

?>