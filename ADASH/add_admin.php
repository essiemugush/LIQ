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
// error_reporting(0);
//initialize the variables
$user_name ="";
$phone_number = "";
// $email = "";
$password1 = "";
$password2 = "";
$password_hash="";

//sign up / register the user if no error   //if true,then save to the database
if(isset($_POST['register']))
{
    try 
    {
        $user_name = $_POST['name'];
        $phone_number = $_POST['pnumber'];
        $emaill = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];


        //check db for existing user with same user name and email
        $user_check_query = "SELECT * from admin where  email_id = :email_id limit 1";
        $stmt = $db->prepare($user_check_query);
        $stmt->bindValue(':email_id',$emaill);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user['email_id'] === $emaill)
        {
                //matched email error definition
                ?>
                <script>
                    alert("email already exists, please try another one!");
                </script>
                <?php
        }
        else 
        {
            if(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$password1))
            {
                // if password not matched so
                if ($password1 === $password2)
                {
                    if(preg_match('/^[0-9]*$/',$phone_number) && strlen($phone_number) == 10)
                    {
                        if(preg_match('/^[a-z A-Z]*$/',$user_name))
                        {
                            // $password_hash = password_hash($password1, PASSWORD_BCRYPT);
                            $password_hash = md5($password1);
                            $query = "INSERT into admin (username,email_id,phone,password)
                            values (:username,:email_id,:phone,:password)";
                            $stmt = $db->prepare($query);
                            $stmt->bindParam(':username', $user_name);
                            $stmt->bindParam(':email_id', $emaill);
                            $stmt->bindParam(':phone', $phone_number);
                            $stmt->bindParam(':password', $password_hash);
                            if($stmt->execute())
                            {
                                $_SESSION['email_id'] = $email; 
                                $_SESSION['username'] = $name;
                                header('location: view_admin.php');
                            }
                            else
                            {
                                ?>
                                    <script>
                                        alert("Failed!, please try again");
                                    </script>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                                <script>
                                    alert("Only Letters and White space are Allowed!");
                                </script>
                            <?php
                        }

                    }
                    else 
                    {
                        ?>
                            <script>
                                alert("invalid phone number!");
                            </script>
                        <?php
                    }

                } 
                else 
                {
                    ?>
                        <script>
                            alert("Password do not match");
                        </script>
                    <?php
                }
            } 
            else 
            {
                ?>
                    <script>
                        alert("Must be 8 characters with atleast 1 uppercase,1 lowercase, 1 digit & 1 symbol");
                    </script>
                <?php
            }
    
        }
    } 
    catch (PDOException $e) {
        $err = "Error: ".$e->getMessage();
        echo '<script>alert("'.$err.'")</script>';
    }
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
                    <h3 class="text-primary">ADD</h3> </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                
                <!-- /# row -->
                <div class="row">
                    <div class="col-lg-8" style="    margin-left: 10%;">
                        <div class="card">
                            <div class="card-title">
                               
                            </div>
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" action="" method="POST" name="userform" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                  <input class="form-control" placeholder="Username" type="text" name="name" required="true">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <input placeholder="phone" type="text" name="pnumber" required="true" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                           <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <input placeholder="Email" type="email" name="email" required="true" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <input placeholder="Password" type="password" name="password1" required="true" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <input placeholder="Retype" type="password" name="password2" required="true"  class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" name="register" class="btn btn-primary btn-flat m-b-30 m-t-30">ADD ADMIN</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
               
                <!-- /# row -->

                <!-- End PAge Content -->
    

<?php include('footer.php');?>