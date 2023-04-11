<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: admin.php");
  exit;
}
else{
include "dbconnect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $userid=$_POST['snoEdit'];
    $orgprice=$_POST['orgpriceedit'];
    $disprice=$_POST['dispriceedit'];
    $itemname=$_POST['itemnameedit'];
    if($_FILES['fileedit']){
     $postimagename=time() . '_'.$_FILES['fileedit']['name'];
     $target='image/posts/' . $postimagename;
     move_uploaded_file($_FILES['fileedit']['tmp_name'], $target);
    $sql="UPDATE `items` SET `Name` = '$itemname', `org_price` = '$orgprice', `dis_price` = '$disprice', `image` = '$postimagename' WHERE `items`.`s_no` = $userid;";
    }
    else{
        $sql="UPDATE `items` SET `Name` = '$itemname', `org_price` = '$orgprice', `dis_price` = '$disprice' WHERE `items`.`s_no` = $userid;";
    }
    echo $sql;
    $result1=mysqli_query($conn,$sql);
    if($result1)
    {
      header ('location: adminpannel.php?edititem="true"');
      exit;
    }
}

}
?>