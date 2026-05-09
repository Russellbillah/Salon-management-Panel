<?php
session_start();
error_reporting(E_ALL); // Useful for debugging
include('includes/dbconnection.php');

// Check login status
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    // Logic to handle new subscriber submission
    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        
        // Check if email already exists to prevent duplicates
        $checkEmail = mysqli_query($con, "SELECT Email FROM tblsubscriber WHERE Email='$email'");
        if (mysqli_num_rows($checkEmail) > 0) {
            echo "<script>alert('This email is already subscribed.');</script>";
        } else {
            // Insert new subscriber (DateofSub usually defaults to current timestamp in SQL)
            $query = mysqli_query($con, "INSERT INTO tblsubscriber (Email) VALUES ('$email')");
            if ($query) {
                echo "<script>alert('Subscriber added successfully.');</script>";
                echo "<script>window.location.href = 'subscriber.php';</script>"; // Redirect to the list view
            } else {
                echo "<script>alert('Something went wrong. Please try again.');</script>";
            }
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Lumineux || Add Subscriber</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <script src="js/jquery-1.11.1.min.js"></script>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script> new WOW().init(); </script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="title1">Add New Subscriber</h3>
                    <div class="form-grids row widget-shadow"> 
                        <div class="form-title">
                            <h4>Subscriber Details:</h4>
                        </div>
                        <div class="form-body">
                            <form method="post">
                                <div class="form-group"> 
                                    <label for="email">Email Address</label> 
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Subscriber Email" required="true"> 
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Add Subscriber</button> 
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include_once('includes/footer.php');?>
    </div>
    <script src="js/classie.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/bootstrap.js"> </script>
</body>
</html>
<?php } ?>