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
?>



<?php include('head.php'); ?>
<?php include('header.php'); ?>

<!-- Container fluid  -->
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <a id="prs" href="#" onclick="print()"><button class="btn btn-primary mt-5">PRINT REPORT</button></a>
            <div class="table-responsive m-t-40">
                <table id="" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Product Type</th>
                            <th>Product Qty</th>
                            <th>Product price</th>
                            <th>Product Description</th>
                            <th>Stock Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM product";
                        $fetchdatastmt = $db->prepare($sql);
                        $fetchdatastmt->execute();
                        while ($row = $fetchdatastmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $row['image']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['type']; ?></td>
                                <td><?php echo $row['qty']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td>Stock Ok</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php');?>