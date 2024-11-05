<?php

// error_reporting(0);
require 'connection.inc.php';
$db = db_conn();
if (!isset($_SESSION['email_id'])) {
    echo "<script>
    location.assign('login.php');
    </script>";
} else {
    $email = $_SESSION['email_id'];
}

$stock_status = "STOCK OK";

if (isset($_POST['submit'])) {

    $pname = $_POST['pname'];
    $ptype = $_POST['type'];
    $pqty = $_POST['qty'];
    $price = $_POST['price'];
    $pdesc = $_POST['pdesc'];
    $pimage = $_FILES['pimage']['name'];
    $pimage_tmp_name = $_FILES['pimage']['tmp_name'];
    $pimage_folder = 'service_images/' . $pimage;


    $query = "INSERT into product (name,type,qty,price,description,image,stock_status)
    values (:name,:type,:qty,:price,:description,:image,:stock_status)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':name', $pname);
    $stmt->bindParam(':type', $ptype);
    $stmt->bindParam(':qty', $pqty);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $pdesc);
    $stmt->bindParam(':image', $pimage);
    $stmt->bindParam(':stock_status', $stock_status);
    if ($stmt->execute()) {
        move_uploaded_file($pimage_tmp_name, $pimage_folder);
        echo "<script>
      alert('Product Added Successfully!');
      location.assign('view_products.php');
      </script>";
    } else {
?>
        <script>
            alert("Failed! please try again!");
        </script>
<?php
    }
}



?>

<?php include('head.php'); ?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">ADD LIQOURS </h3>
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->

        <!-- /# row -->
        <div class="row">
            <div class="col-lg-6" style="    margin-left: 10%;">
                <div class="card">
                    <div class="card-title">

                    </div>
                    <div class="card-body">
                        <div class="input-states">
                            <form class="form-horizontal" action="" method="POST" name="userform" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <label class="control-label">Product name</label>
                                            <input class="form-control" placeholder="Product name" type="text" name="pname" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <label class="control-label">Product type</label>
                                            <input class="form-control" placeholder="Product Type" type="text" name="type" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <label class="control-label">Product qty</label>
                                            <input class="form-control" placeholder="Product Qty" type="text" name="qty" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <label class="control-label">Product Price</label>
                                            <input class="form-control" placeholder="Product Price" type="text" name="price" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <label class="control-label">product Description</label>
                                            <textarea placeholder="Product Description" type="text" name="pdesc" required="true" class="form-control" rows="10" cols="30"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <label class="control-label">Product Image</label>
                                            <input type="file" name="pimage" required="true" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="submit" class="btn btn-info btn-flat m-b-30 m-t-30">CREATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- /# row -->

        <!-- End PAge Content -->
        <?php include('footer.php'); ?>