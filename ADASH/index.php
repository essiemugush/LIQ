 <?php //echo  $_SESSION["email"];
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

 <?php include('sidebar.php'); ?>

 <!-- Page wrapper  -->
 <div class="page-wrapper">
     <!-- Bread crumb -->
     <div class="row page-titles">
         <div class="col-md-5 align-self-center">
             <h3 class="text-info">DASHBOARD</h3>
         </div>
     </div>
     <!-- End Bread crumb -->
     <!-- Container fluid  -->
     <div class="container-fluid">
         <!-- Start Page Content -->

         <div class="row">
             <div class="col-xl-3 col-lg-6">
                 <div class="card">
                     <div class="card-body card-type-3">
                         <div class="row">
                             <?php
                                $sql = "SELECT COUNT(id) as tp from product";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>
                             <div class="col">
                                 <h6 class="text-muted mb-3">Products</h6>
                                 <span class="font-weight-bold mb-0"><?php echo $result['tp']; ?></span>
                             </div>
                             <div class="col-auto">
                                 <i class="ti-shoppig-cart text-success"></i>
                             </div>
                         </div>
                         <p class="mt-3 mb-0 text-muted text-sm">
                             <span class="text-info mr-2"><i class="fa fa-arrow-up"></i> 6.9%</span>
                             <span class="text-nowrap">Since last month</span>
                         </p>
                     </div>
                 </div>
             </div>

             <div class="col-xl-3 col-lg-6">
                 <div class="card">
                     <div class="card-body card-type-3">
                         <div class="row">
                             <div class="col">
                                 <?php
                                    $query = "SELECT COUNT(id) as mn from users";
                                    $stmt = $db->prepare($query);
                                    $stmt->execute();
                                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                 <h6 class="text-muted mb-3">Customers</h6>
                                 <span class="font-weight-bold mb-0"><?php echo $row['mn']; ?></span>
                             </div>
                             <div class="col-auto">
                                 <i class="ti-user text-info"></i>
                             </div>
                         </div>
                         <p class="mt-3 mb-0 text-muted text-sm">
                             <span class="text-info mr-2"><i class="fa fa-arrow-up"></i> 8.8%</span>
                             <span class="text-nowrap">Since last month</span>
                         </p>
                     </div>
                 </div>
             </div>
             <div class="col-xl-3 col-lg-6">
                 <div class="card">
                     <div class="card-body card-type-3">
                         <div class="row">
                             <div class="col">
                                 <?php
                                    $queryy = "SELECT SUM(amount) as cp from customer_payments";
                                    $stmt = $db->prepare($queryy);
                                    $stmt->execute();
                                    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                 <h6 class="text-muted mb-3">Total Earnings</h6>
                                 <span class="font-weight-bold mt-0"><?php echo "KES. " . number_format($rows['cp'],2); ?></span>
                             </div>
                             <div class="col-auto">
                                 <i class="ti-dollar text-info"></i>
                             </div>
                         </div>
                         <p class="mt-3 mb-0 text-muted text-sm">
                             <span class="text-info mr-2"><i class="fa fa-arrow-up"></i> 15%</span>
                             <span class="text-nowrap">Since last month</span>
                         </p>
                     </div>
                 </div>
             </div>

         </div>
     </div>
 </div>
 <!-- End PAge Content -->
 </div>
 <!-- End Container fluid  -->
 <?php include('footer.php'); ?>