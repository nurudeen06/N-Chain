<?php 
include '../config/db.php';
include '../config/config.php';
include '../config/functions.php';

$err = $msgg = $msg = "";

    if (isset($_GET['e'])) {
        $umail = $_GET['e'];
        $uumail = explode("@", $umail);
        $sndmail = "@".$uumail[1];
        $subr1_mail = substr($uumail[0], 0, 3);
        $subr2_mail = substr($umail[0], -3, 2);

        $query = mysqli_query($link, "SELECT * FROM users WHERE email = '$umail' ");
        if (mysqli_num_rows($query) > 0) {
          $data = mysqli_fetch_assoc($query);
          $pin = $data['2fa_code'];
          $username = $data['username'];
          $fname = $data['firstname']." ".$data['lastname'];
          // $pin_use = $data['pin_use'];
        }else{
          header('location: login.php');
        }
      }else{
        header('location: login.php');
      }

      if (isset($_GET['resend'])) {
        $pin = '1234567890';
        $pin = str_shuffle($pin);
        $pin = strlen($pin) != 4 ? substr($pin, 0, 4) : $pin;
        mysqli_query($link, "UPDATE users SET 2fa_code = '$pin' WHERE email = '$umail' ");
        $msgg = "A new two factor authentication code has been sent to you mail";
      }

      if (isset($_POST['submit'])) {
        $c1 = trim($_POST['c1']);
        $c2 = trim($_POST['c2']);
        $c3 = trim($_POST['c3']);
        $c4 = trim($_POST['c4']);
        if (!empty($c1) && !empty($c2) && !empty($c3) && !empty($c4)) {
          $ccode = $c1.$c2.$c3.$c4;
          if ($pin != $ccode) {
            $err = "Invalid two factor code";
          }else{
            session_start();
            $_SESSION['username'] = $data['username'];
            $_SESSION['id'] = $data['id'];

          $msg = "Logged in successfully";
            echo "<meta http-equiv='refresh' Content='3; url=../dashboard/' />";
              mysqli_close($link);
          }
        }
      }
    
    
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from fx-millenniuminvestments.com/auth/verify/email by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jun 2022 12:37:13 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content/>
    <meta name="author" content/>
    <title>Account Confirmation | FX Millennium Investments</title>
    <link href="../dashboard/css/styles.css" rel="stylesheet"/>
    <link rel="icon" type="image/x-icon" href="../dashboard/img/favicon.png"/>
    <script data-search-pseudo-elements defer src="../dashboard/js/all.min.js"></script>
    <script src="../dashboard/js/feather.min.js"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div>
        <div id="google_translate_element"></div>

        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement(
                    {pageLanguage: 'en'},
                    'google_translate_element'
                );
            }
        </script>

        <script type="text/javascript" src="../../../translate.google.com/translate_a/elementa0d8.js?cb=googleTranslateElementInit">
        </script>

        <style type="text/css">
            input::-webkit-outer-spin-button,
                input::-webkit-inner-spin-button {
                  -webkit-appearance: none;
                  margin: 0;
                }

                /* Firefox */
                input[type=number] {
                  -moz-appearance: textfield;
                }
                .visually-hidden{
                    display: none;
                }
        </style>
    </div>





<div id="layoutAuthentication_content">
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header justify-content-center">
                            <h3 class="font-weight-light my-4">Two Factor Authentication</h3>
                        </div>
                        <div class="card-body">
                        <?php 
                            if (isset($_GET['success'])) {
                                echo customAlert("success", "Registration was successful, You can Login now");
                            }

                            if ($err != "") {
                                echo customAlert("danger", $err);
                            }
                            if ($msg != "") {
                                echo customAlert("success", $msg)."<br>";
                                echo '<img src="loader.gif" height="40">';
                            }

                            if ($msgg != "") {
                                echo customAlert("success", $msgg);
                            }

                        ?>

                            <div class="small mb-3 text-muted">
                                Enter the 4 digit codes that was sent to this email - <b><?php echo $subr1_mail."******".$sndmail ?></b>.
                            </div>
                            <form action="twofa.php?e=<?php echo $umail ?>" method="post">
                                    <div class="row">
                                            <div class="col-3">
                                                <div class="mb-3">
                                                    <label for="digit1-input" class="visually-hidden">Dight 1</label>
                                                    <input type="number" name="c1" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(this, 2)" maxLength="1" id="digit1-input">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-3">
                                                <div class="mb-3">
                                                    <label for="digit2-input" class="visually-hidden">Dight 2</label>
                                                    <input type="number" name="c2" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(this, 3)" maxLength="1" id="digit2-input">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-3">
                                                <div class="mb-3">
                                                    <label for="digit3-input" class="visually-hidden">Dight 3</label>
                                                    <input type="number" name="c3" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(this, 4)" maxLength="1" id="digit3-input">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-3">
                                                <div class="mb-3">
                                                    <label for="digit4-input" class="visually-hidden">Dight 4</label>
                                                    <input type="number" name="c4" class="form-control form-control-lg bg-light border-light text-center" onkeyup="moveToNext(this, 4)" maxLength="1" id="digit4-input">
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="twofa.php?e=<?php echo $umail ?>&resend">Resend Code</a>
                                    <button type="submit" name="submit" class="btn btn-primary">Proceed</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<div id="layoutAuthentication_footer">
    <footer class="footer mt-auto footer-dark">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 small">Copyright &#xA9; FX Millennium Investments 2022</div>
                <div class="col-md-6 text-md-right small">
                    <a href="../../index.html">Home</a>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>

<script type="text/javascript">
    function moveToNext(e,t){0<e.value.length&&document.getElementById("digit"+t+"-input").focus()}
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5fd2738edf060f156a8bdbd7/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

<script src="../dashboard/js/jquery-3.5.1.min.js"></script>
<script src="../dashboard/js/bootstrap.bundle.min.js"></script>
<script src="../dashboard/js/scripts.js"></script>

</body>


<!-- Mirrored from fx-millenniuminvestments.com/auth/verify/email by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jun 2022 12:37:13 GMT -->
</html>

