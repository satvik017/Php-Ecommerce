<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: admin.php");
  exit;
}
  include 'dbconnect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $ref=$_POST['referal'];
    $sql='UPDATE `useradmin` set `referal`="'.$ref.'" where `permission`="owner";';
    echo $sql;
    $result=mysqli_query($conn,$sql);
    if($result){
        header('Location: setting.php?editref=`true`');
    }
    else{
        header('Location: setting.php');
    }
}


?>