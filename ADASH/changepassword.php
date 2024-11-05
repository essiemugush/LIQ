<?php 
error_reporting(0);
include('connection.inc.php');
$db = db_conn();
if (!isset($_SESSION['email_id'])) {
    echo "<script>
    location.assign('login.php');
    </script>";
    } else{
      $email = $_SESSION['email_id'];
    }
// Change password code
if(isset($_POST['submit']))
{
    $password ="";
    $confirmPassword ="";
    $currentpassword ="";
    $password = $_POST['newpassword'];
    $currentpassword=$_POST['currentpassword'];
    $confirmPassword = $_POST['confirmpassword'];

    $currentpassword_hash = md5($currentpassword);

    $user_check_query = "SELECT * from admin where email_id = :email_id or password =:password limit 1";
    $stmt = $db->prepare($user_check_query);
    $stmt->bindValue(':email_id',$email);
    $stmt->bindValue(':password',$currentpassword_hash);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user['password'] != $currentpassword_hash)
    {
        echo "<script>
        alert('your current password is wrong');
        location.assign('changepassword.php');
        </script>";
    }
    else
    {

        if(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$password))
        {
            if ($password === $confirmPassword)
            {
                $newpassword_hash = md5($password);
                $email = $_SESSION['email_id'];
                $updatePassword = "UPDATE admin SET password = '$newpassword_hash' WHERE email_id = '$email'";
                $stmt = $db->prepare($updatePassword);
                if($stmt->execute())
                {
                    echo "<script>
                    alert('Password changed successfully');
                    location.assign('view_admin.php');
                    </script>";
                }
                else{
    
                    echo "<script>
                    alert('Failed');
                    location.assign('changepassword.php');
                    </script>";
                }
            } 
            else{
                ?>
                <script>
                    alert("Password do not match");
                </script>
            <?php

            }
        } else{
                ?>
                <script>
                    alert("Must use 8 more characters with a mixture of letters, digits & symbols");
                </script>
            <?php
        }
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
                    <h3 class="text-primary">RESET PASSWORD</h3> </div>
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
                                    <form class="form-horizontal" method="POST">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Old Password</label>
                                                <div class="col-sm-9">
                                                    <input type="text" placeholder="old-Password" name="currentpassword" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <input type="text" placeholder="New-Password" name="newpassword" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Confirm Password</label>
                                                <div class="col-sm-9">
                                                    <input type="text" placeholder="Confirm-Password" name="confirmpassword" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>




                                        <button type="submit" name="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">UPDATE PASSWORD</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
               
                <!-- /# row -->

                <!-- End PAge Content -->
           

<?php include('footer.php');?>

<link rel="stylesheet" href="popup_style.css">
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>