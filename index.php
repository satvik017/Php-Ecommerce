<?php require 'header.php'; 
include 'dbconnect.php';
?>
        <!-- Header-->
        <header class="bg-light py-5">
            <div class="container px-4 px-lg-5 my-5 header mx-5">
                <div class="text-center text-dark">
                    <h1 class="display-4 fw-bolder">Eat Fresh Buy Organic</h1>
                    <p class="lead fw-normal text-dark-50 mb-0">With this shop hompeage template</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                   <?php
                   $sql='Select * from `items` order by `s_no` desc;';
                   $result=mysqli_query($conn, $sql);
                   if($result){
                   while($row=mysqli_fetch_assoc($result)){
                    echo '
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="image/posts/'.$row['image'].'" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">'.$row['Name'].'</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">Rs '.$row['org_price'].' /-</span>
                                    <br>Rs '.$row['dis_price'].' /-
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="contact.php">Order Now</a></div>
                            </div>
                        </div>
                    </div>
                    ';
                   }
                }
                    ?>
                   
                </div>
            </div>
        </section>
       <?php require 'footer.php'?>