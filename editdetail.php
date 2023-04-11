<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: admin.php");
  exit;
}
  include 'dbconnect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $old=$_POST['oldpass'];
    $new=$_POST['npass'];
    $sql="Select * from `useradmin` where id='".$_SESSION['userid']."';";
    $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $password=$row['password'];
        if(password_verify($old,$password)){
            $newpass= password_hash($new,PASSWORD_DEFAULT);
            $sql='UPDATE `useradmin` set `password`="'.$newpass.'" where id="'.$_SESSION["userid"].'";';
            echo $sql;
            $result=mysqli_query($conn,$sql);
            if($result){
                header('Location: setting.php?editdet=`true`');
             }
            }
            else{
                //  header('Location: setting.php?editdet=`false`');
                 }
}


?>