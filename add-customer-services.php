<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
} else {
    if(isset($_POST['submit'])) {
        $uid = intval($_GET['addid']);
        $invoiceid = mt_rand(100000000, 999999999);
        $sid = $_POST['sids']; // Array of service IDs
        $barber_assignments = $_POST['barberid']; // Array of Barber IDs mapped to Service IDs

        for($i=0; $i<count($sid); $i++) {
            $svid = $sid[$i];
            // Retrieve the specific barber selected for THIS specific service ID
            $assigned_barber = $barber_assignments[$svid];
            
            $ret = mysqli_query($con, "INSERT INTO tblinvoice(Userid, ServiceId, BillingId, BarberId) VALUES('$uid', '$svid', '$invoiceid', '$assigned_barber')");
        }

        if($ret) {
            echo '<script>alert("Invoice created successfully. Invoice number is "+"'.$invoiceid.'")</script>';
            echo "<script>window.location.href ='invoices.php'</script>";
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumineux || Assign Services</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-1.11.1.min.js"></script>
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Assign Services & Barbers</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <form method="post">
                        <table class="table table-bordered"> 
                            <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>Service Name</th> 
                                    <th>Service Cost</th> 
                                    <th>Assign Barber</th>
                                    <th>Select</th> 
                                </tr> 
                            </thead> 
                            <tbody>
<?php
$ret = mysqli_query($con, "select * from tblservices");
$cnt = 1;
while ($row = mysqli_fetch_array($ret)) {
    $service_id = $row['ID'];
?>
                                <tr> 
                                    <th scope="row"><?php echo $cnt;?></th> 
                                    <td><?php echo $row['ServiceName'];?></td> 
                                    <td><?php echo $row['Cost'];?></td> 
                                    <td>
                                        <select name="barberid[<?php echo $service_id; ?>]" class="form-control">
                                            <option value="">Select Barber</option>
                                            <?php 
                                            $barbers = mysqli_query($con, "SELECT * FROM tbladmin WHERE Role IN ('barber', 'staff')");
                                            while($b = mysqli_fetch_array($barbers)) {
                                                echo "<option value='".$b['ID']."'>".$b['AdminName']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><input type="checkbox" name="sids[]" value="<?php echo $service_id;?>"></td> 
                                </tr>   
<?php $cnt++; } ?>
                                <tr>
                                    <td colspan="5" align="center">
                                        <button type="submit" name="submit" class="btn btn-primary">Create Invoice</button>		
                                    </td>
                                </tr>
                            </tbody> 
                        </table> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('includes/footer.php');?>
    </div>
    <script src="js/bootstrap.js"></script>
</body>
</html>
<?php } ?>