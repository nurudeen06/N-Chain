<?php 
    session_start();
    include '../config/db.php';
    include '../config/config.php';
    include '../config/functions.php';

    $msg = "";
    $err = "";

$username_err = $password_err= ""; 
$username = $password= "";
    
    if (isset($_POST['submit'])) {
        
         if (empty($_POST["username"])) {
            $username_err = "username is required";
          } else {
            $username = test_input($_POST["username"]);
          }
          
          if (empty($_POST["password"])) {
            $password_err = "Password is required";
          } else {
            $password = test_input($_POST["password"]);
          }

        if($username == "" || $password == ""){
            $err = "Email or Password fields cannot be empty!";
        }else{
            $sql = mysqli_query($link, "SELECT * FROM users WHERE username = '$username' AND password= '$password'");
            if(mysqli_num_rows($sql) > 0){
                $data = mysqli_fetch_assoc($sql);
                $email = $data['email'];
                $fname = $data['fname'];
                $username = $data['username'];

                    $_SESSION['username'] = $data['username'];
                    $_SESSION['id'] = $data['id'];

                    $msg = "Logged in successfully, You will be redirected soon";
                    echo pageRedirect("4","../users/"); 
                

            }else{
                $err = "Invalid Username and Password";
            }
        }
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
}

 ?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<!-- Mirrored from themesbrand.com/velzon/html/default/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Jul 2022 13:20:09 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Sign In | <?php echo $sitename ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../public/assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="../public/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="../public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../public/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="../public/assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</head>
<body>
    <?php 
  if ($msg != "") {
?>
 <script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "Success",
            text: "<?php echo $msg ?>",
            icon: "success",
            button: "Ok",
            timer: 7000
        });    
    });

</script>
<?php } ?>

<?php 
  if ($err != "") {
?>
 <script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "Error",
            text: "<?php echo $err ?>",
            icon: "error",
            button: "Ok",
            timer: 5000
        });
    });
</script>
<?php } ?>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="../index.html" class="d-inline-block auth-logo">
                                    <img height="60" src="../public/assets/images/logo-light.png" alt="" height="20">
                                </a>
                            </div>
                            <p  class="mt-3 fs-15 fw-medium"><a style="color: white" href="../index.html">Home</a></p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to Velzon.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="login.php" novalidate method="post">

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="forgot-psd.php" class="text-muted">Forgot password?</a>
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" name="password" class="form-control pe-5" placeholder="Enter password" id="password-input">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" name="submit" type="submit">Sign In</button>
                                        </div>

                                        
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Don't have an account ? <a href="signup.php" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> <?php echo $sitename ?>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="../public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../public/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../public/assets/libs/node-waves/waves.min.js"></script>
    <script src="../public/assets/libs/feather-icons/feather.min.js"></script>
    <script src="../public/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="../public/assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="../public/assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="../public/assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="../public/assets/js/pages/password-addon.init.js"></script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/default/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Jul 2022 13:20:09 GMT -->
</html>