<?php
// session_start();
// if(!isset($_SESSION['email'])){
//   header('location:http://localhost/digifix/login.php');
// }


    $con = mysqli_connect('localhost','root','');
    if(!$con){
      die(mysqli_error($con));
    }

    $complaint_no=$_GET['forwardvendor'];

    $sql="select * from `digifix`.`complaint` where 'complaint_no' ='$complaint_no'";
    $result=mysqli_query($con,$sql);
    if($result){
     while($row=mysqli_fetch_assoc($result)){
        $sid=$row['id'];
        $sname=$row['name'];
        $sphone=$row['phone'];
        $complaint_no=$row['complaint_no'];
        $devcieName = $row['devicename'];
        $serialNo = $row['serialno'];
        $Specifications = $row['specifications'];
        $problem = $row['problem'];
        $address = $row['address'];
     }
    
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $sid=$_POST['id'];
        $sname=$_POST['name'];
        $sphone=$_POST['phone'];
        $complaint_no=$_POST['complaint_no'];
        $devcieName = $_POST['devicename'];
        $serialNo = $_POST['serialno'];
        $Specifications = $_POST['specifications'];
        $problem = $_POST['problem'];
        $address = $_POST['address'];

       $sql3= 'INSERT INTO archived SELECT * FROM registrations WHERE id = $id;'

        $result2=mysqli_query($con,$sql3);
        if($result2){
            header('location:admin.php');
           echo "update successful";
        }else{
          die(mysqli_error($con));
        }
      }



?>