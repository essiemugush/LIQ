<?php
error_reporting(0);
    require '../inc/connection.inc.php';
    $db = db_conn();
    if (isset($_POST['recover'])) 
    {
        $email = $_POST['email'];
        $emailCheckQuery = "SELECT * FROM users WHERE email = :email";
        $stmt = $db->prepare($emailCheckQuery);
        $stmt->bindValue(':email',$email);
        $stmt->execute();
        $emailCheckResult = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($emailCheckResult) 
        {
            echo "<script>
            location.assign('newPassword.php');
            </script>";
        }
        else
        {
            ?>
                <script>
                    alert("Invalid Email Address");
                </script>
            <?php
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <title>VERIFY</title>
      <?php
        include_once('../inc/AuthHeadLinks.inc.php');
      ?>  
</head>
<body style="background-color: #cccccc;">
    <!-- =======Register Section ======= -->
    <section id="contact" class="contacts">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <!-- <h2 style="text-align: center;">RECOVER  </h2> -->

        <div class="row gx-lg-0 gy-4" style="display: flex; justify-content:center; align-items: center;">

          <div class="col-lg-4">
            <form action="" method="post" role="form" id="signup" class="php-email-form form_signup">
            <h4 style="text-align: center;color: slateblue;">VERIFY EMAIL </h4>
              <p class="text-center">Verify Your Email Address to Reset your password!</p>

              <div class="form-group mt-3 text-field  mb-4">
                <input type="email" class="form-control" name="email"  id="email" placeholder="*Your email" autocomplete="on" required>
              </div>

              <div class="form-group mb-4">
              <input type="submit" value="VERIFY" name="recover" id="submit" class="btn btn-primary">
              </div>

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