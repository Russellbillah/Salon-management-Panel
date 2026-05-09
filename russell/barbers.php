<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');

// Verify session
if (!isset($_SESSION['bpmsaid']) || strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
    exit;
} else {
    // 1. FEATURE: CREATE BARBER
    if (isset($_POST['addbarber'])) {
        $name = $_POST['barbername'];
        $mobilenum = $_POST['mobilenum'];
        $email = $_POST['email'];
        $uname = $_POST['username'];
        $password = md5($_POST['password']);
        $role = "barber";

        $query = mysqli_query($con, "INSERT INTO tbladmin(AdminName, UserName, MobileNumber, Email, Password, Role) VALUES('$name','$uname','$mobilenum','$email','$password','$role')");
        if ($query) {
            echo "<script>alert('New Barber added to Lumineux.');</script>";
            echo "<script>window.location.href = 'barbers.php'</script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Lumineux || Barber Management</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <link href="css/custom.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        
        <div id="page-wrapper">
            <div class="main-page">
                
                <div class="forms">
                    <h3 class="title1">Add New Barber</h3>
                    <div class="form-grids row widget-shadow">
                        <div class="form-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-4"><input type="text" name="barbername" class="form-control" placeholder="Full Name" required></div>
                                    <div class="col-md-4"><input type="text" name="username" class="form-control" placeholder="Username" required></div>
                                    <div class="col-md-4"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-md-4"><input type="text" name="mobilenum" class="form-control" placeholder="Mobile" required maxlength="10"></div>
                                    <div class="col-md-4"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
                                    <div class="col-md-4"><button type="submit" name="addbarber" class="btn btn-primary">Save Barber</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tables" style="margin-top: 30px;">
                    <h3 class="title1">Barber List & Assignment</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <table class="table table-bordered"> 
                            <thead> 
                                <tr> <th>#</th> <th>Name</th> <th>Mobile</th> <th>Email</th> <th>Status</th> <th>Action</th> </tr> 
                            </thead> 
                            <tbody>
                                <?php
// Execute the query
$ret = mysqli_query($con, "SELECT * FROM tbladmin WHERE Role='barber'");

// Check if the query actually worked
if (!$ret) {
    // This will tell you exactly why the database is complaining
    echo "Error in Query: " . mysqli_error($con);
} else {
    $cnt = 1;
    // Only loop if we have a valid result
    while ($row = mysqli_fetch_array($ret)) {
    ?>
    <tr> 
        <th scope="row"><?php echo $cnt;?></th> 
        <td><?php echo $row['AdminName'];?></td> 
        <td><?php echo $row['MobileNumber'];?></td>
        <td><?php echo $row['Email'];?></td> 
        <td><span class="label label-success">Active</span></td>
        <td>
            <a href="customer-list.php?bid=<?php echo $row['ID'];?>" class="btn btn-info btn-sm">Tag to Customer</a>
        </td> 
    </tr>   
    <?php 
    $cnt++; 
    } 
} ?>
                            </tbody> 
                        </table> 
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php');?>
    </div>
    <script src="js/bootstrap.js"> </script>
</body>
</html>
<?php } ?>