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
    
    <title>title</title>
  </head>
  <body>
  <!-- content -->
  <?php
  if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
    echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
    <strong>Success!</strong> Your have signup successfully.you can now login. 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){
    $signerror=$_GET['error'];
    echo "<div class='alert alert-danger alert-dismissible fade show my-0' role='alert'>
    <strong>Failed!</strong>" . $signerror."
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  if(isset($_GET['deactivate']) && $_GET['deactivate']=="true"){
    $signerror=$_GET['error'];
    echo "<div class='alert alert-danger alert-dismissible fade show my-0' role='alert'>
    <strong>success!</strong> Deactivated successfully!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  
  ?>
  <!-- Modal -->
<div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="_signuphandel.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="signupemail">Username</label>
                        <!-- <input type="email" class="form-control" id="signupemail" name="signupemail" aria-describedby="emailHelp"> -->
                        <input type="username" class="form-control" id="username" name="signupemail" aria-describedby="emailHelp">
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone -->
                            <!-- else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword">
                    </div>
                    <div class="form-group">
                        <label for="referal">Referal code</label>
                        <input type="text" class="form-control" id="referal" name="referal">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-success">signup</button>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- login form -->
<div class="container my-3 mx-3">
  <form action="_handellogin.php" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label for="loginemail">Username</label>
            <!-- <input type="email" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp"> -->
            <input type="username" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp">
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone -->
                <!-- else.</small> -->
        </div>
        <div class="form-group">
            <label for="loginpass">Password</label>
            <input type="password" class="form-control" id="loginpass" name="loginpass">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-outline-primary">login</button>

    </div>
</form>
</div>
<button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#signupmodal">Signup</button>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="js/jquery.js" ></script>
  <!-- java script -->
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
 
</body>
</html>