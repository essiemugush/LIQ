<?php
error_reporting(0);
require '../inc/connection.inc.php';
$db = db_conn();
if (isset($_POST['login'])) {
  try {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //HINT-remove the condion "if" and set cookie by just clicking ligin btn instead of remeber me chkbox
    if (isset($_POST['remember_me'])) {
      setcookie("email", $email, time() + 30 * 24 * 60 * 60);
      setcookie("password", $password, time() + 30 * 24 * 60 * 60);
    }
    // $password_hash = password_hash($password1, PASSWORD_BCRYPT);
    $password_hash = md5($password);
    // Retrieve data
    $Query = "SELECT * FROM users WHERE email = :email AND password = :password";
    $stmt = $db->prepare($Query);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password_hash);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $_SESSION['email'] = $email;
      $fetchInfo = $result;
      $name = $fetchInfo['name'];
      $_SESSION['email'] = $fetchInfo['email'];
      $_SESSION['password'] = $fetchInfo['password'];

      echo "<script>
                location.assign('/LIQ/APP/products.php');
                </script>";
    } else {
?>
      <script>
        alert("wrong password or email!!!");
      </script>
<?php
    }
  } catch (PDOException $e) {
    $err = "Error: " . $e->getMessage();
    echo '<script>alert("' . $err . '")</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sign In</title>
  <!-- <link rel="stylesheet" href="../theme/assets/css/signin.css" rel="stylesheet"> -->
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
              <h4 style="text-align: center;color: slateblue;">Login </h4>
              <p class="text-center">Login To start your session</p>

              <div class="form-group mt-3 text-field">
                <input type="email" class="form-control" name="email" value="<?php if (isset($_COOKIE['email'])) {echo $_COOKIE['email'];
                  } ?>" id="email" placeholder="*Your email" autocomplete="on" required>
              </div>
              <div class="form-group mt-3 text-field">
                <input type="password" class="form-control" name="password" value="<?php if (isset($_COOKIE['password'])) {echo $_COOKIE['password'];
                  } ?>" id="password" placeholder="*Password" autocomplete="on" required>
                <i class="fas fa-eye-slash showhide" id="hide" onclick="myshowhidefunc()"></i>
                <i class="fas fa-eye showhide" id="show" onclick="myshowhidefunc()"></i>
              </div>

              <div class="col-md-6 mb-3 mt-3 text-field text-left">
                <a href="recover_password.php">Forgot password?</a>
              </div>

              <input type="submit" value="SIGNIN" name="login" id="submit" class="btn btn-primary btn-block">

              <div class="col-md-6 mb-3 mt-3 text-field text-left">
                <div class="sign-up">Not a Member ? <a href="signup.php">Register</a></div>
              </div>

            </form>
          </div><!-- End Contact Form -->

        </div>
      </div>

      <?php
      // check for cookies
      if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        $email = $_COOKIE['email'];
        $password = $_COOKIE['password'];
        echo "<script>
        document.getElemetById('email').value = '$email'
        document.getElemetById('password').value = '$password'
        </script>";
      }
      ?>
  </section><!-- End Contact Section -->

  <?php
  include_once('../inc/AuthFootLinks.inc.php');
  ?>
</body>

</html>