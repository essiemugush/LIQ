<?php
error_reporting(0);
require 'connection.inc.php';
$db = db_conn();
if (!isset($_SESSION['email_id'])) {
    echo "<script>
    location.assign('login.php');
    </script>";
} else {
    $email = $_SESSION['email_id'];
}
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    $_SESSION['uid'] = $uid;
}

if (isset($_POST['submit'])) {
    $pname = $_POST['pname'];
    $ptype = $_POST['type'];
    $pqty =  $_POST['qty'];
    $price = $_POST['price'];
    $pdesc = $_POST['pdesc'];


    $updatequery = "UPDATE product SET name = '$pname', type = '$ptype', qty = '$pqty', price = '$price', description = '$pdesc' WHERE id = '$uid'";
    $stmt = $db->prepare($updatequery);
    if ($stmt->execute()) {
        echo "<script>
      alert('Product Updated Successfully!');
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
            <h3 class="text-primary">UPDATE LIQOURS </h3>
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

                            <?php
                            $sql = "SELECT * FROM product where id = '$uid'";
                            $stmt = $db->prepare($sql);
                            $stmt->execute();
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                <form class="form-horizontal" action="" method="POST" name="userform">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <label class="control-label">Product name</label>
                                                <input class="form-control" value="<?php echo $row['name']; ?>" placeholder="Product name" type="text" name="pname" required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <label class="control-label">Product Type</label>
                                                <input class="form-control" value="<?php echo $row['type']; ?>" placeholder="Product Type" type="text" name="type" required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <label class="control-label">Product Qty</label>
                                                <input class="form-control" value="<?php echo $row['qty']; ?>" placeholder="Product Quantity" type="text" name="qty" required="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <label class="control-label">Product Price</label>
                                                <input class="form-control" value="<?php echo $row['price']; ?>" placeholder="Product Price" type="text" name="price" required="true">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <label class="control-label">Description</label>
                                                <input placeholder="Product Description" value="<?php echo $row['description']; ?>" type="text" name="pdesc" required="true" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">UPDATE</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- /# row -->

        <!-- End PAge Content -->


        <?php include('footer.php'); ?>