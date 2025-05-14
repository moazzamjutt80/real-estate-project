<?php 
include("config.php");
$error = "";
$msg = "";

if(isset($_REQUEST['insert'])) {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $pass = $_REQUEST['pass'];
    $dob = $_REQUEST['dob'];
    $phone = $_REQUEST['phone'];

    // Validation
    if(empty($name) || empty($email) || empty($pass) || empty($dob) || empty($phone)) {
        $error = "* Please fill all the fields!";
    } elseif(!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error = "* Name should only contain letters and spaces.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "* Invalid email format.";
    } elseif(strlen($pass) < 6) {
        $error = "* Password should be at least 6 characters long.";
    } elseif(!preg_match("/^[0-9]{10}$/", $phone)) {
        $error = "* Phone number should be 10 digits.";
    } else {
        // Insert data
        $sql = "INSERT INTO admin (auser, aemail, apass, adob, aphone) VALUES ('$name', '$email', '$pass', '$dob', '$phone')";
        $result = mysqli_query($con, $sql);

        if($result) {
            $msg = 'Admin registered successfully';
        } else {
            $error = '* Failed to register. Try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Ventura - Register</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Main Wrapper -->
    <div class="page-wrappers login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Register</h1>
                            <p class="account-subtitle">Access to our dashboard</p>
                            <p style="color:red;"><?php echo $error; ?></p>
                            <p style="color:green;"><?php echo $msg; ?></p>
                            <!-- Form -->
                            <form method="post">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Name" name="name">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="email" placeholder="Email" name="email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Password" name="pass">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="date" placeholder="Date of Birth" name="dob">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Phone" name="phone" maxlength="10">
                                </div>
                                <div class="form-group mb-0">
                                    <input class="btn btn-primary btn-block" type="submit" name="insert" value="Register">
                                </div>
                            </form>
                            <!-- /Form -->
                            
                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>
                            
                            <!-- Social Login -->
                            <div class="social-login">
                                <span>Register with</span>
                                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="google"><i class="fa fa-google"></i></a>
                                <a href="#" class="facebook"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="google"><i class="fa fa-instagram"></i></a>
                            </div>
                            <!-- /Social Login -->
                            
                            <div class="text-center dont-have">Already have an account? <a href="index.php">Login</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    
    <!-- Bootstrap Core JS -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
</body>
</html>
