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
?>
<?php include('head.php'); ?>
<?php include('header.php'); ?>
<?php //include('sidebar.php');
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <a href="#" id="pro" onclick="print()"><button class="btn btn-primary">PRINT REPORT</button></a>
            <div class="table-responsive m-t-40">
                <table id="" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>TransId</th>
                            <th>BusinessShortCode</th>
                            <th>MpesaRefNo</th>
                            <th>MpesaAccountNo</th>
                            <th>Amount</th>
                            <th>Email</th>
                            <th>Date Ordered</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM customer_payments";
                        $fetchdatastmt = $db->prepare($sql);
                        $fetchdatastmt->execute();
                        while ($row = $fetchdatastmt->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['shortcode']; ?></td>
                                <td><?php echo $row['MpesaRefNo']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php'); ?>