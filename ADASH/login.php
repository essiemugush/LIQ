
<?php include('head.php');?>

<?php
error_reporting(0);
require 'connection.inc.php';
$db = db_conn();
if(isset($_POST['login']))
{
    try {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $password_hash = md5($password);
        // Retrieve data
        $Query = "SELECT * FROM admin WHERE email_id = :email_id AND password = :password";
        $stmt = $db->prepare($Query);
        $stmt->bindValue(':email_id',$email);
        $stmt->bindValue(':password',$password_hash);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result)
        {
            $_SESSION['email_id'] = $email;
            $_SESSION['username'] = $username;
            $fetchInfo = $result;
            $username = $fetchInfo['username'];
            $_SESSION['email_id'] = $fetchInfo['email_id'];
            $_SESSION['password'] = $fetchInfo['password'];

            echo "<script>
            location.assign('index.php');
            </script>";
        } 
        else
        {
            ?>
                <script>
                    alert("wrong password or email!!!");
                </script>
            <?php
        }
        
    } catch (PDOException $e) {
        $err = "Error: ".$e->getMessage();
        echo '<script>alert("'.$err.'")</script>';
    }
}  
?>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <div class="unix-login">
            <div class="container-fluid" style="background-color: #cccccc;">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="login-content card">
                            <div class="login-form">
                                <form method="POST" action="">
                                    <center>DRINK-UP LIQOUR STORE | LOGIN</center>
                                    <div class="form-group mt-2">
                                        <label for="form-label mt-2">email address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email" required="">
                                    </div>
                                    <div class="form-group">
                                    <label for="form-label mt-2">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                                    </div>
                                    <!-- <div class="checkbox">
                                           <label class="pull-right">
                                                <a href="forgot_password.php">Forgot Password?</a>
                                           </label>   
                                    </div> -->
                                    <button type="submit" name="login" class="btn btn-primary btn-flat m-b-30 m-t-30">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>

</body>

</html>