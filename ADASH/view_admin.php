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
        $rem_query = "DELETE FROM admin WHERE id = :id";
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
                    <h3 class="text-primary"> MANAGE USERS</h3> </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                
                <!-- /# row -->
                 <div class="card">
                            <div class="card-body">
                                <a href="add_admin.php"><button class="btn btn-primary">ADD USERS</button></a>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>username</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                            $sql = "SELECT * FROM admin";
                                            $fetchdatastmt = $db->prepare($sql);
                                            $fetchdatastmt->execute();
                                           while($row=$fetchdatastmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <tr>
                                                <td><?php echo $row['username']; ?></td>
                                                <td><?php echo $row['email_id']; ?></td>
                                                <td><?php echo $row['phone']; ?></td>
                                                 <td>
                                                 <a title="change password" href="changepassword.php" class="mr-25" > <i style="color: orangered; margin-right: 32px" class="fa fa-pencil"></i> </a>
                                                 <a title="Delete User"  onclick="return confirm('you sure to remove this admin?');" href="view_admin.php?uid=<?php echo ($row['id']);?>" class="mr-25" > <i style="color: red;" class="fa fa-trash"></i> </a>
                                                <!-- <button type="button" class="btn btn-xs btn-primary" ><a href=""><i class="fa fa-pencil"></i></a></button>
                                                <button type="button" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button> -->
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
