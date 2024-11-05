<?php
// error_reporting(0);
require '../inc/connection.inc.php';
$db = db_conn();

// error_reporting(0);
//initialize the variables
$name = "";
$phone_number = "";
$email = "";
$password1 = "";
$password2 = "";
$agree = "";
$password_hash = "";

if (isset($_POST['register'])) {
    try {
        $name = $_POST['name'];
        $phone_number = $_POST['pnumber'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];


        //check db for existing user with same user name and email
        $user_check_query = "SELECT * from users where  email = :email limit 1";
        $stmt = $db->prepare($user_check_query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            //matched email error definition
            if ($user['email'] === $email) {
                ?>
                <script>
                    alert("email already Taken!");
                </script>
                <?php
            }
        } else {
            if (preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $password1)) {
                // if password not matched so
                if ($password1 === $password2) {
                    if (preg_match('/^[0-9]*$/', $phone_number) && strlen($phone_number) == 10) {
                        if (preg_match('/^[a-z A-Z]*$/', $name)) {
                            // $password_hash = password_hash($password1, PASSWORD_BCRYPT);
                            $password_hash = md5($password1);
                            $query = "INSERT into users (name,phone,email,password)
                            values (:name,:phone,:email,:password)";
                            $stmt = $db->prepare($query);
                            $stmt->bindParam(':name', $name);
                            $stmt->bindParam(':phone', $phone_number);
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':password', $password_hash);
                            if ($stmt->execute()) {
                                $_SESSION['email'] = $email;
                                echo "<script>
                                    location.assign('login.php');
                                </script>";
                            } else {
                                ?>
                                    <script>
                                        alert("Failed to register");
                                    </script>
                                <?php
                            }
                        } else {
                            ?>
                                <script>
                                    alert("Only Letters and White space are allowed!");
                                </script>
                            <?php
                        }
                    } else {
                        ?>
                            <script>
                                alert("invalid phone!");
                            </script>
                        <?php
                    }
                } else {
                    ?>
                    <script>
                        alert("Passwords do not match");
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    alert("Must be 8 characters with atleast 1 uppercase,1 lowercase, 1 digit & 1 symbol");
                </script>
<?php
            }
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
    <title>REGISTER</title>
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
                    <div class="col-lg-5">
                        <form action="" method="post" role="form" id="signup" class="php-email-form form_signup">
                            <h4 style="text-align: center;color: slateblue;">JOIN US </h4>
                            <p class="text-center">it is as easy as drinking your brew <span>&#128525;</span></p>

                            <div class="form-group">
                                <label class="mb-2" for="">Name</label>
                                <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" id="fname" placeholder="*Your Name" autocomplete="on" required>
                            </div>

                            <div class="form-group mt-3">
                            <label class="mb-2" for="">Phone</label>
                                <input type="text" class="form-control" name="pnumber" value="<?php echo $phone_number; ?>" id="pnumber" placeholder="*Your Phone" autocomplete="on" required>
                            </div>

                            <div class="form-group mt-3">
                                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" id="eamil" placeholder="*Your email" autocomplete="on" required>
                            </div>

                            <div class="form-group mt-3">
                            <label class="mb-2" for="">Password</label>
                                <input type="password" class="form-control" name="password1" value="<?php echo $password1; ?>" id="password" placeholder="Password" autocomplete="on" required>
                                <i class="fas fa-eye-slash showhide" id="hide" onclick="myshowhidefunc()"></i>
                                <i class="fas fa-eye showhide" id="show" onclick="myshowhidefunc()"></i>
                            </div>

                            <div class="form-group mt-3">
                            <label class="mb-2" for="">Confirm Password</label>
                                <input type="password" class="form-control" name="password2" value="<?php echo $password2; ?>" id="password2" placeholder="Confirm" autocomplete="on" required>
                                <i class="fas fa-eye-slash showhide" id="hidee" onclick="myshowhideconfpassfunc()"></i>
                                <i class="fas fa-eye showhide" id="showw" onclick="myshowhideconfpassfunc()"></i>
                            </div>

                            <input type="submit" name="register" value="REGISTER" class="btn btn-block btn-primary m-auto">
                            <div class="col-md-6 mb-4 text-left text-field">
                                <div class="sign-up mb-4 mt-3 text-center">Already have an account ? <a href="login.php">Login</a></div>
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