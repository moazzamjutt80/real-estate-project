<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");

$amount = $mon = $int = $interest = $pay = $month = '';

if(isset($_REQUEST['calc'])) 
    if(isset($_REQUEST['calc']))
{
	$amount=$_REQUEST['amount'];
    $mon = $_REQUEST['month'];
    $int = $_REQUEST['interest'];
    
    $interest = $amount * $int / 100;
    $pay = $amount + $interest;
    $month = $pay / $mon;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>EMI Calculator</title>
<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/layerslider.css">
<link rel="stylesheet" type="text/css" href="css/color.css" id="color-change">
<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script>
function validateForm() {
    let amount = document.forms["emiForm"]["amount"].value;
    let month = document.forms["emiForm"]["month"].value;
    let interest = document.forms["emiForm"]["interest"].value;

    if (amount === "" || isNaN(amount) || amount <= 0) {
        alert("Please enter a valid amount greater than 0.");
        return false;
    }
    if (month === "" || isNaN(month) || month <= 0 || !Number.isInteger(parseFloat(month))) {
        alert("Please enter a valid number of months greater than 0.");
        return false;
    }
    if (interest === "" || isNaN(interest) || interest <= 0) {
        alert("Please enter a valid interest rate greater than 0.");
        return false;
    }
    return true;
}
</script>
</head>
<body>
<div id="page-wrapper">
    <div class="row"> 
        <?php include("include/header.php");?>

        <div class="full-row bg-gray">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <h2 class="text-secondary double-down-line text-center">EMI Calculator</h2>
                    </div>
                </div>
                <center>
                    <form name="emiForm" action="" method="post" onsubmit="return validateForm()">
                        <table class="items-list col-lg-6 table-hover">
                            <thead>
                                <tr class="bg-secondary">
                                    <th class="text-white font-weight-bolder">Input</th>
                                    <th class="text-white font-weight-bolder">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><label for="amount">Loan Amount ($):</label></td>
                                    <td><input type="text" name="amount" id="amount" value="<?php echo htmlspecialchars($amount); ?>" required></td>
                                </tr>
                                <tr>
                                    <td><label for="month">Duration (Months):</label></td>
                                    <td><input type="text" name="month" id="month" value="<?php echo htmlspecialchars($mon); ?>" required></td>
                                </tr>
                                <tr>
                                    <td><label for="interest">Interest Rate (%):</label></td>
                                    <td><input type="text" name="interest" id="interest" value="<?php echo htmlspecialchars($int); ?>" required></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center"><button type="submit" id="submee" onclick="checkAllPositiveValues()" name="calc" class="btn btn-primary">Calculate</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>

                    <?php if(isset($_REQUEST['calc'])): ?>
                    <table class="items-list col-lg-6 table-hover mt-4 align-center">
                        <thead>
                            <tr class="bg-secondary">
                                <th class="text-white font-weight-bolder">Term</th>
                                <th class="text-white font-weight-bolder">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center font-18">
                                <td><b>Amount</b></td>
                                <td><b><?php echo '$'.htmlspecialchars($amount); ?></b></td>
                            </tr>
                            <tr class="text-center">
                                <td><b>Total Duration</b></td>
                                <td><b><?php echo htmlspecialchars($mon).' Months'; ?></b></td>
                            </tr>
                            <tr class="text-center">
                                <td><b>Interest Rate</b></td>
                                <td><b><?php echo htmlspecialchars($int).'%'; ?></b></td>
                            </tr>
                            <tr class="text-center">
                                <td><b>Total Interest</b></td>
                                <td><b><?php echo '$'.htmlspecialchars($interest); ?></b></td>
                            </tr>
                            <tr class="text-center">
                                <td><b>Total Amount</b></td>
                                <td><b><?php echo '$'.htmlspecialchars($pay); ?></b></td>
                            </tr>
                            <tr class="text-center">
                                <td><b>Pay Per Month (EMI)</b></td>
                                <td><b><?php echo '$'.htmlspecialchars($month); ?></b></td>
                            </tr>
                        </tbody>
                    </table> 
                    <?php endif; ?>
                </center>
            </div>
        </div>
        <?php include("include/footer.php");?>
        <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a> 
    </div>
</div>

<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/custom.js"></script>
</body>
</html>
