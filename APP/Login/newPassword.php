<?php
error_reporting(0);
    require '../inc/connection.inc.php';
    $db = db_conn();

    $password ="";
    $confirmPassword="";

    if(isset($_SESSION['email']))
    {
        $email = $_SESSION['email'];
    }

    if(isset($_POST['newpass']))
    {
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$password))
        {
            ?>
                <script>
                    alert("Must use 8 more characters with a mixture of letters, digits & symbols");
                </script>
            <?php
        } 
        else 
        {
            if ($password != $confirmPassword)
            {
                ?>
                    <script>
                        alert("Password do not match");
                    </script>
                <?php
            } 
            else
            {
                $password_hash = md5($password);
                $email = $_SESSION['email'];
                $updatePassword = "UPDATE users SET password = '$password_hash' WHERE email = '$email'";
                $stmt = $db->prepare($updatePassword);
                session_unset();
                session_destroy();
                if($stmt->execute())
                {
                    ?>
                    <script>
                        alert("<?php echo "Password Reset Successfully, You can proceed to Login"?>");
                        window.location.replace('login.php');
                    </script>
                <?php
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <title>RESET</title>
      <?php
        include_once('../inc/AuthHeadLinks.inc.php');
      ?>  
</head>
<body style="background-color: #cccccc;">
    <!-- =======Register Section ======= -->
    <section id="contact" class="contacts">
      <div class="container" data-aos="fade-up">

        <div class="section-header">

        <div class="row gx-lg-0 gy-4" style="display: flex; justify-content:center; align-items: center;">

          <div class="col-lg-4">
            <form action="" method="post" role="form" id="signup" class="php-email-form form_signup">
            <h5 style="text-align: center;color: slateblue;">RESET ACCOUNT PASSWORD </h5>
              <p class="text-center">Reset your account password to continue with your session!</p>
              <div class="form-group mt-3">
                <input type="password" class="form-control" name="password"  id="password" placeholder="new Password" autocomplete="on" required>
                <i class="fas fa-eye-slash showhide" id="hide" onclick="myshowhidefunc()"></i>
                <i class="fas fa-eye showhide" id="show" onclick="myshowhidefunc()"></i>
              </div>
              <div class="form-group mt-3 mb-3">
                <input type="password" class="form-control" name="confirmPassword"  id="password2" placeholder="confirm password" autocomplete="on" required>
                <i class="fas fa-eye-slash showhide" id="hidee" onclick="myshowhideconfpassfunc()"></i>
                <i class="fas fa-eye showhide" id="showw" onclick="myshowhideconfpassfunc()"></i>
              </div>
              <input type="submit" value="RESET" name="newpass" id="submit" class="btn btn-primary">

            </form>
          </div><!-- End Contact Form -->

        </div>
      </div>
    </section><!-- End Contact Section -->

    <?php
        include_once('../inc/AuthFootLinks.inc.php');
    ?>  
</body>
</html>