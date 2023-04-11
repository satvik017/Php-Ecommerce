<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: admin.php");
  exit;
}
else{
include "dbconnect.php";
    $sql='Delete from `useradmin` Where id='.$_SESSION["userid"].';';
    $result = mysqli_query($conn,$sql);
    echo $sql;
    $sql1='Delete from `items` where userid='.$_SESSION["userid"].';';
    $result1=mysqli_query($conn,$sql1);
    if($result)
    {
      session_unset();
      session_destroy();
      header ('location: admin.php?deactivate="true"');
      exit;
    }

}
?>