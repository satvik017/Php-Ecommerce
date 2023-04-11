<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: admin.php");
  exit;
}
  include 'dbconnect.php';
  $per = false;
  $delete=false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $editper=$_POST['peredit'];
    $sno=$_POST['snoEdit'];
    $sql='UPDATE `useradmin` SET `permission`="'.$editper.'" where `id`='.$sno.';';
    //echo $sql;
    $result=mysqli_query($conn,$sql);
    if($result)
    {
      $per = true;
    }
  }
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `useradmin` WHERE `id` = $sno";
  $result = mysqli_query($conn, $sql);
}
include 'dbconnect.php'; 
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap-grid.css">
   <link rel="stylesheet" href="css/bootstrap-reboot.css">
   <link rel="stylesheet" href="css/bootstrap-grid.min.css">
   <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    
    <title>Setting</title>
  </head>
  <style>
  #refform{
    display: none;
  }
  </style>
<body>
<?php
 if($per){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> permission updated successfully!
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";
}
 if(isset($_GET['editref'])){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong>Referal code changed successfully!
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";
}
 if(isset($_GET['editdet'])){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong>Password changed successfully!
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";
}
 if($delete){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> deleted account successfully!
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";
}
$per=false;
?>
 <!-- Modal -->
 <div class="modal fade" id="editdetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="editdetail.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">Old Password</label>
                        <input type="password" class="form-control" id="oldpass" name="oldpass">
                    </div>
                
                    <div class="form-group">
                        <label for="cpassword">New Password</label>
                        <input type="password" class="form-control" id="npass" name="npass">
                    </div>
                    
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-success">edit details</button>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this-</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="setting.php" method="post"  enctype=multipart/form-data>
            <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
                <div class="form-group">
                    <label for="dispriceedit">Change Permision</label>
                    <select name="peredit" id="peredit">
                    <option value="admin">Admin</option>
                    <option value="owner">Owner</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Edit Details</button>
        
            </div>
        </form>
      </div>
    </div>
  </div>





    <div class="container">
    <a href="adminpannel.php" class="btn btn-outline-success ml-2">Back</a>
    <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#editdetail">Edit Details</button>
    <?php
    if($_SESSION['userid']>1){
    echo'<button class="btn btn-outline-success ml-2" onclick="deact()" >Deactivate Account</button>
  ';  
  }
   ?>
    </div>
    <div class="container">
    <?php
      $sql='Select * from `useradmin` where id='.$_SESSION['userid'].';';
      $result=mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      echo'<h3>Username: '.$row['username'].'</h3>
      <h3>Permission: '.$row['permission'].'</h3>
      ';
  
    if($row['permission']=='owner'){ 
      echo' <button class="btn btn-outline-success ml-2" onclick="togglehide()">change referal code</button>';
      echo '<form action="chreferal.php" method="POST" id="refform">
      <div class="form-group">
                        <label for="referal">New Referal code</label>
                        <input type="text" class="form-control" id="referal" name="referal" value="'.$row["referal"].'">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                    </form>';
    echo'<div class="container my-4 text-center">
<h3>User admins</h3>

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Userame</th>
      <th scope="col">Referal</th>
      <th scope="col">Permission</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  '; 
      $sql = "SELECT * FROM `useradmin` where permission ='admin';";
      $result = mysqli_query($conn, $sql);
      $sno = 0;
      while($row = mysqli_fetch_assoc($result)){
        $sno = $sno + 1;
        echo "<tr>
        <th scope='row'>". $sno . "</th>
        <td>". $row['username'] . "</td>
        <td>". $row['referal'] . "</td>
        <td>". $row['permission'] . "</td>
        <td> <button class='edit btn btn-sm btn-primary' id=".$row['id'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['id'].">Delete</button>  </td>
      </tr>";
    } 
   
    
 echo' </tbody>
</table>
</div>
';}
$delete=false;
?>

  
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <!-- java script -->
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    
    var img = document.getElementById('img');
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        disprice = tr.getElementsByTagName("td")[2].innerText;
        console.log(disprice);
        peredit.value = disprice;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/satvik/tamanna/setting.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })

    function togglehide(){
      let ref=document.getElementById("refform");
      if(ref.style.display=='none'){
        ref.style.display='block';
      }   
      else{
        ref.style.display='none';
      }
    }
    
    function deact(){
        alert('are you sure you want to deactivate');
      window.location = `/satvik/tamanna/deactivate.php`;
    }
    
  </script>
</body>
</html>