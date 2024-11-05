<?php 
error_reporting(0);
require 'connection.inc.php';
$db = db_conn();
if (!isset($_SESSION['email_id'])) {
    echo "<script>
    location.assign('login.php');
    </script>";
    } else{
      $email = $_SESSION['email_id'];
    }

    if(isset($_GET['uid'])){
        $uid = $_GET['uid'];
        $_SESSION['uid'] = $uid;
        $rem_query = "DELETE FROM customer_payments WHERE id = :id";
        $stmt = $db->prepare($rem_query);
        $stmt->bindValue(':id',$uid);
        $stmt->execute();
    }
?>  
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>

  <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> VIEW ORDERS</h3> </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                
                <!-- /# row -->
                 <div class="card">
                            <div class="card-body">
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>TransId</th>
                                                <th>BusinessShortCode</th>
                                                <th>MpesaRefNo</th>
                                                <th>MpesaAccountNo</th>
                                                <th>Amount</th>
                                                <th>Email</th>
                                                <th>Date Ordered</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                            $sql = "SELECT * FROM customer_payments";
                                            $fetchdatastmt = $db->prepare($sql);
                                            $fetchdatastmt->execute();
                                           while($row=$fetchdatastmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['shortcode']; ?></td>
                                                <td><?php echo $row['MpesaRefNo']; ?></td>
                                                <td><?php echo $row['phone']; ?></td>
                                                <td><?php echo $row['amount']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['date']; ?></td>
                                                 <td>
                                                    <a title="Delete booking"  onclick="return confirm('you sure to remove this Order?');" href="view_bookings.php?uid=<?php echo ($row['id']);?>" class="mr-25" > <i style="color: red;" class="fa fa-trash"></i> </a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                <!-- End PAge Content -->
           

<?php include('footer.php');?>
