<?php
$showerror="false";
echo ' hdif';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'dbconnect.php';
    $email=$_POST['loginemail'];
    $pass=$_POST['loginpass'];

    $sql="Select * from `useradmin` where username='$email'";
    $result = mysqli_query($conn,$sql);
    $numrows= mysqli_num_rows($result);
    
    if($numrows==1){
        $row = mysqli_fetch_assoc($result);
        $sno = $row['id'];
        $password = $row['password'];
        $per = $row['permission'];
        if(password_verify($pass,$password)){
             session_start();
             $_SESSION['loggedin']= true;
             $_SESSION['permission']=$per;
             $_SESSION['userid']=$sno;
            //  echo $sno;
            header("Location: adminpannel.php");
            exit;
        }
          
    }
    header("Location: admin.php");
}
?>