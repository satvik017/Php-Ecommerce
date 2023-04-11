<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: admin.php");
  exit;
}
include('dbconnect.php');
 $post=false;
 $delete=false;
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $userid=$_SESSION['userid'];
   $orgprice=$_POST['orgprice'];
   $disprice=$_POST['disprice'];
   $itemname=$_POST['itemname'];
    $postimagename=time() . '_'.$_FILES['file']['name'];
    $target='image/posts/' . $postimagename;
    move_uploaded_file($_FILES['file']['tmp_name'], $target);
    $sql="INSERT INTO `items` (`Name`, `org_price`, `dis_price`, `image`, `userid`, `date`) VALUES ('$itemname', '$orgprice', '$disprice', '$postimagename', '$userid', CURRENT_TIMESTAMP);";
    $result=mysqli_query($conn,$sql);
    if($result){
        $post=true;
    }
}
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `items` WHERE `s_no` = $sno";
  $result = mysqli_query($conn, $sql);
}
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
    
    <title>Admain Pannel Dashboard</title>
  </head>
  <body>
  <!-- content -->
  <?php
  if(isset($post) && $post=="true"){
    echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
    <strong>Success!</strong> Your have post the item successfully.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  if(isset($_GET['edititem']) && $_GET['edititem']=="true"){
    echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
    <strong>Success!</strong> Your have edit the item successfully.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }

  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  
  ?>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="edititem.php" method="post"  enctype=multipart/form-data>
            <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <img id='img' name='img' src='' height=50>
                <div class="form-group">
                    <label for="fileedit">item image</label>
                    <!-- <input type="email" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp"> -->
                    <input type="file" class="form-control" id="fileedit" name="fileedit">
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone -->
                        <!-- else.</small> -->
                </div>
                <div class="form-group">
                    <label for="orgpriceedit">original price</label>
                    <input type="number" class="form-control" id="orgpriceedit" name="orgpriceedit">
                </div>
                <div class="form-group">
                    <label for="dispriceedit">discounted price</label>
                    <input type="number" class="form-control" id="dispriceedit" name="dispriceedit">
                </div>
                <div class="form-group">
                    <label for="itemnameedit">item name</label>
                    <input type="text" class="form-control" id="itemnameedit" name="itemnameedit">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">edit item</button>
        
            </div>
        </form>
      </div>
    </div>
  </div>



  <div class="container my-3">
    <div class="jumbotron">
    <a href="setting.php" class="btn btn-primary">Profile Setting</a>
    <a href="logout.php" class="btn btn-dark">Logout</a>
        <h1 class="display-4">Add new item</h1>
        <p class="lead">Form for add new item on website</p>
        <hr class="my-4">
        <form action="adminpannel.php" method="post"  enctype=multipart/form-data>

            <div class="modal-body">
            
                <div class="form-group">
                <img id='avtar' src='' height=100>
                    <label for="file">item image</label>
                    <!-- <input type="email" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp"> -->
                    <input type="file" class="form-control" id="file" name="file">
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone -->
                        <!-- else.</small> -->
                </div>
                <div class="form-group">
                    <label for="orgprice">original price</label>
                    <input type="number" class="form-control" id="orgprice" name="orgprice">
                </div>
                <div class="form-group">
                    <label for="disprice">discounted price</label>
                    <input type="number" class="form-control" id="disprice" name="disprice">
                </div>
                <div class="form-group">
                    <label for="itemname">item name</label>
                    <input type="text" class="form-control" id="itemname" name="itemname">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">post item</button>
        
            </div>
        </form>
    </div>
    </div>
    <div class="container my-4 text-center">
<h3>Uploaded Items</h3>

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Name</th>
      <th scope="col">Org_price</th>
      <th scope="col">Dis_price</th>
      <th scope="col">Image</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    if($_SESSION['permission'] == 'owner' ){
      $sql = "SELECT * FROM `items`";}
    else{
      $sql = "SELECT * FROM `items` where userid = ".$_SESSION['userid'].";";
    }
      $result = mysqli_query($conn, $sql);
      $sno = 0;
      while($row = mysqli_fetch_assoc($result)){
        $sno = $sno + 1;
        echo "<tr>
        <th scope='row'>". $sno . "</th>
        <td>". $row['Name'] . "</td>
        <td>". $row['org_price'] . "</td>
        <td>". $row['dis_price'] . "</td>
        <td><img id='photo' src='image/posts/". $row['image'] . "' height=50>".$row['image']."</td>
        <td> <button class='edit btn btn-sm btn-primary' id=".$row['s_no'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['s_no'].">Delete</button>  </td>
      </tr>";
    } 
    $delete=false;
      ?>
  </tbody>
</table>
</div>
  



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
        name = tr.getElementsByTagName("td")[0].innerText;
        orgprice = tr.getElementsByTagName("td")[1].innerText;
        disprice = tr.getElementsByTagName("td")[2].innerText;
        image = tr.getElementsByTagName("td")[3].innerText;
        imag = 'image/posts/'+image;
        console.log(name, orgprice, image);
        itemnameedit.value = name;
        orgpriceedit.value = orgprice;
        img.setAttribute("src", imag);
        
        // fileedit.value = image;
        dispriceedit.value = disprice;
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
          window.location = `/satvik/tamanna/adminpannel.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
    
  </script>
  <script>
    const profileInput = document.querySelector("#fileedit");
      const profileImg = document.querySelector("#img");

      const idInput = document.querySelector("#file");
      const idImg = document.querySelector("#avtar");

      const imgPreview = (input, img) => {
        if (input.files && input.files[0]) {
          let reader = new FileReader(input);
          reader.onload = function (e) {
            img.setAttribute("src", e.target.result);
          };
          reader.readAsDataURL(input.files[0]);
        }
      };

      profileInput.addEventListener("change", () => {
        imgPreview(profileInput, profileImg);
      });
      idInput.addEventListener("change", () => {
        imgPreview(idInput, idImg);
      });
  </script>
</body>
</html>