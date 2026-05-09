<?php
session_start();
error_reporting(E_ALL); 
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $services = $_POST['services'];
        $adate = $_POST['adate'];
        $atime = $_POST['atime'];
        $phone = $_POST['phone'];
        $barberid = $_POST['barberid']; // Capturing the barber selection
        $aptnumber = mt_rand(100000000, 999999999);

        // Sanitize inputs
        $name = mysqli_real_escape_string($con, $name);
        $phone = mysqli_real_escape_string($con, $phone);

        // THE FIXED QUERY: Matches 8 columns to 8 values
        $query = mysqli_query($con, "INSERT INTO tblappointment (AptNumber, Name, Email, PhoneNumber, AptDate, AptTime, Services, BarberId) 
        VALUES ('$aptnumber', '$name', '$email', '$phone', '$adate', '$atime', '$services', '$barberid')");

        if ($query) {
            echo "<script>alert('Appointment created successfully. Number: $aptnumber');</script>";
            echo "<script>window.location.href = 'all-appointment.php';</script>";
        } else {
            // This will reveal the exact SQL error if it fails
            echo "Debugging Error: " . mysqli_error($con);
            exit();
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumineux || New Appointment</title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<script>new WOW().init();</script>
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
					<h3 class="title1">Add Appointment</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
						<div class="form-title">
							<h4>Appointment Details:</h4>
						</div>
						<div class="form-body">
							<form method="post">
							 <div class="form-group"> <label>Customer Name</label> <input type="text" name="name" class="form-control" placeholder="Full Name" required="true"> </div>
							 <div class="form-group"> <label>Email Address</label> <input type="email" name="email" class="form-control" placeholder="Email Address" required="true"> </div>
							 <div class="form-group"> <label>Phone Number</label> <input type="text" name="phone" class="form-control" placeholder="Phone Number" required="true" maxlength="10" pattern="[0-9]+"> </div>
							 <div class="form-group"> <label>Appointment Date</label> <input type="date" name="adate" class="form-control" required="true"> </div>
							 <div class="form-group"> <label>Appointment Time</label> <input type="time" name="atime" class="form-control" required="true"> </div>
							 
							 <div class="form-group"> 
							 	<label>Assign Barber</label> 
							 	<select name="barberid" class="form-control" required="true">
							 		<option value="">Select Barber</option>
							 		<?php 
							 		$ret=mysqli_query($con,"SELECT * from tbladmin where Role='barber'");
							 		while($row=mysqli_fetch_array($ret)) {
							 			echo "<option value='".$row['ID']."'>".$row['AdminName']."</option>";
							 		}
							 		?>
							 	</select>
							 </div>

							 <div class="form-group"> <label>Services</label> <textarea name="services" class="form-control" placeholder="Services Required" required="true"></textarea> </div>
							  <button type="submit" name="submit" class="btn btn-default">Submit</button> </form> 
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