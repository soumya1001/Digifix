<?php
  $con = mysqli_connect('localhost','root','');
  if(!$con){
    die(mysqli_error($con));
  }
  $complaint_no=$_GET['removeaplication'];
  $sql = "DELETE FROM `digifix`.`complaint` WHERE `complaint`.`complaint_no` = '$complaint_no';";
  if (mysqli_query($con, $sql)) {
      echo "Record deleted successfully";
      header('location:admin.php');
  } else {
      echo "Error deleting record: " . mysqli_error($con);
  }
  mysqli_close($con);
?>