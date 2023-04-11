<?php
$showerror="false";
$showalert=false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'dbconnect.php';
    $user_email=$_POST['signupemail'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
    $ref=$_POST['referal'];
    
    //check weather this email exist
    $existSql="Select * from `useradmin` where username = '$user_email';";
    $result=mysqli_query($conn,$existSql);
    $numrows=mysqli_fetch_assoc($result);
    if($numrows>0){
        $showerror="Email already in use";
    }
    else{
        $Sqlref="Select * from `useradmin` where username = 'tamanna';";
        $result=mysqli_query($conn,$Sqlref);
        $numrows=mysqli_fetch_assoc($result);
        $referal=$numrows['referal'];
        if($pass == $cpass && $ref == $referal){
            $hash= password_hash($pass,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `useradmin` (`username`, `password`, `referal`, `datetime`, `permission`) VALUES ('$user_email', '$hash', '$ref', CURRENT_TIMESTAMP(), 'admin');";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showalert=true;
                header("location: admin.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showerror="Password do not match or referalcode error";
        }
    }
    header("location: admin.php?signupsuccess=false&error=$showerror");
}
?>