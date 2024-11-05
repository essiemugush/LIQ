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
        $rem_query = "DELETE FROM product WHERE id = :id";
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
                    <h3 class="text-primary"> MANAGE LIQOURS</h3> </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                
                <!-- /# row -->
                 <div class="card">
                            <div class="card-body">
                                <a href="add_products.php"><button class="btn btn-primary">ADD LIQOURS</button></a>
                                <!-- <a href="#" onclick = "print()"><button class="btn btn-primary" >Print Report</button></a> -->
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Product Type</th>
                                                <th>Product Qty</th>
                                                <th>Product price</th>
                                                <th>Product Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                            $sql = "SELECT * FROM product";
                                            $fetchdatastmt = $db->prepare($sql);
                                            $fetchdatastmt->execute();
                                           while($row=$fetchdatastmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['image']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['qty']; ?></td>
                                                <td><?php echo $row['price']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                 <td>
                                                <button type="button" class="btn btn-xs btn-primary" ><a title="Update product" href="update_item.php?uid=<?php echo ($row['id']);?>" class="mr-25"> <i style="color: white;" class="fa fa-pencil"></i> </a></button>
                                                <button type="button" class="btn btn-xs btn-danger" ><a title="delete product" href="view_products.php?uid=<?php echo ($row['id']);?>" class="mr-25" onclick="return confirm('you sure to remove this service?');"> <i style="color: white;" class="fa fa-trash"></i> </a></button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
               
                <!-- /# row -->

                <!-- End PAge Content -->
           

<?php include('footer.php');?>
