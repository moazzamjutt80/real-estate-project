<?php 
include("config.php");
$error = "";
$msg = "";

if (isset($_POST['reg'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $pass = trim($_POST['pass']);
    $utype = $_POST['utype'];

    $uimage = $_FILES['uimage']['name'];
    $temp_name1 = $_FILES['uimage']['tmp_name'];
    $pass = sha1($pass);

    // Check if email already exists
    $query = "SELECT * FROM user WHERE uemail='$email'";
    $res = mysqli_query($con, $query);
    $num = mysqli_num_rows($res);

    if ($num == 1) {
        $error = "<p class='alert alert-warning'>Email ID already exists</p>";
    } else {
        if (!empty($name) && !empty($email) && !empty($phone) && !empty($pass) && !empty($uimage)) {
            $upload_dir = "admin/user/";
            $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
            $image_ext = pathinfo($uimage, PATHINFO_EXTENSION);

            // Validate file extension
            if (in_array(strtolower($image_ext), $allowed_ext)) {
                $uimage = time() . '_' . $uimage; // Rename to avoid overwriting
                if (move_uploaded_file($temp_name1, $upload_dir . $uimage)) {
                    $sql = "INSERT INTO user (uname, uemail, uphone, upass, utype, uimage) VALUES ('$name', '$email', '$phone', '$pass', '$utype', '$uimage')";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        $msg = "<p class='alert alert-success'>Registered successfully!</p>";
                    } else {
                        $error = "<p class='alert alert-warning'>Registration unsuccessful. Please try again.</p>";
                    }
                } else {
                    $error = "<p class='alert alert-warning'>Failed to upload image.</p>";
                }
            } else {
                $error = "<p class='alert alert-warning'>Invalid image file type.</p>";
            }
        } else {
            $error = "<p class='alert alert-warning'>Please fill in all fields.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register - Real Estate PHP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="page-wrapper">
    <div class="row"> 
        <!-- Header -->
        <?php include("include/header.php");?>

        <!-- Registration Form -->
        <div class="page-wrappers login-body full-row bg-gray">
            <div class="login-wrapper">
                <div class="container">
                    <div class="loginbox">
                        <div class="login-right">
                            <div class="login-right-wrap">
                                <h1>Register</h1>
                                <p class="account-subtitle">Access our dashboard</p>
                                <?php echo $error; ?><?php echo $msg; ?>

                                <!-- Registration Form -->
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                    <input 
  type="text" 
  name="name" 
  class="form-control" 
  placeholder="Your Name*" 
  required 
  pattern="[a-zA-Z ]+" 
  title="Please enter your name (English alphabets only)" 
  oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '')"
>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Your Email*" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="number"  name="phone" id="telme"  class="form-control" placeholder="Your Phone*" maxlength="10" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="pass" class="form-control" placeholder="Your Password*" maxlength="8" required>
                                    </div>

                                    <!-- User Type Radio Buttons -->
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="utype" value="user" checked>User
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="utype" value="agent">Agent
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="utype" value="builder">Builder
                                        </label>
                                    </div>

                                    <!-- User Image Upload -->
                                    <div class="form-group">
                                        <label class="col-form-label"><b>User Image</b></label>
                                        <input class="form-control" name="uimage" type="file" required>
                                    </div>

                                    <button class="btn btn-success" name="reg" type="submit">Register</button>
                                </form>

                                <div class="text-center dont-have">Already have an account? <a href="login.php">Login</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include("include/footer.php");?>

        <a href="#" class="bg-secondary text-white" id="scroll"><i class="fas fa-angle-up"></i></a>
    </div>
</div>

<!-- JavaScript Links -->
<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/custom.js"></script>
</body>
</html>
