<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    $bid = intval($_GET['barberid']);
    $fdate = $_POST['fromdate'];
    $tdate = $_POST['todate'];
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumineux || Barber Detailed Invoice Report</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<style>
/* Smart Print Logic: Purely for window.print() */
@media print {
    /* Hide everything unnecessary */
    .sidebar, .cbp-spmenu, .header-section, .footer, .no-print, .btn, .title1 {
        display: none !important;
    }
    /* Expand content to full page width */
    #page-wrapper {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        left: 0 !important;
    }
    /* Show the hidden branding header */
    .print-header {
        display: flex !important;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #4F52BA;
        padding-bottom: 15px;
    }
}
/* Hide branding on the dashboard screen */
.print-header { display: none; }
</style>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Barber Invoice Details</h3>
                    
                    <div class="form-grids row widget-shadow" style="padding: 20px; margin-bottom: 20px;">
                        <form method="post" class="form-inline">
                            <div class="form-group">
                                <label>From Date: </label>
                                <input type="date" name="fromdate" class="form-control" value="<?php echo $fdate; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>To Date: </label>
                                <input type="date" name="todate" class="form-control" value="<?php echo $tdate; ?>" required>
                            </div>
                            <button type="submit" name="search" class="btn btn-primary">Filter Results</button>
                        </form>
                    </div>

                    <div class="table-responsive bs-example widget-shadow">
                        <?php
                        // Fetch Barber Name for the header
                        $ad = mysqli_query($con, "SELECT AdminName FROM tbladmin WHERE ID='$bid'");
                        $arow = mysqli_fetch_array($ad);
                        ?>
                        <h4>Invoices for: <?php echo $arow['AdminName']; ?></h4>
                        
                        <table class="table table-bordered"> 
                            <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>Invoice ID</th> 
                                    <th>Customer Name</th> 
                                    <th>Service</th> 
                                    <th>Service Date</th>
                                    <th>Amount</th> 
                                </tr> 
                            </thead> 
                            <tbody>
<?php
$query_str = "SELECT tblinvoice.BillingId, tblinvoice.PostingDate, tblcustomers.Name, tblservices.ServiceName, tblservices.Cost 
              FROM tblinvoice 
              JOIN tblcustomers ON tblcustomers.ID = tblinvoice.Userid 
              JOIN tblservices ON tblservices.ID = tblinvoice.ServiceId 
              WHERE tblinvoice.BarberId = '$bid'";

// Apply Date Filter if form is submitted
if(isset($_POST['search'])) {
    $query_str .= " AND DATE(tblinvoice.PostingDate) BETWEEN '$fdate' AND '$tdate'";
}

$ret = mysqli_query($con, $query_str);
$cnt = 1;
$gtotal = 0;
while ($row = mysqli_fetch_array($ret)) {
?>
                                <tr> 
                                    <th scope="row"><?php echo $cnt;?></th> 
                                    <td><?php echo $row['BillingId'];?></td> 
                                    <td><?php echo $row['Name'];?></td> 
                                    <td><?php echo $row['ServiceName'];?></td> 
                                    <td><?php echo $row['PostingDate'];?></td>
                                    <td><?php echo $subtotal = $row['Cost'];?></td> 
                                </tr>   
<?php 
    $cnt++;
    $gtotal += $subtotal;
} ?>
                                <tr>
                                    <th colspan="5" style="text-align:right">Total Earnings for Period:</th>
                                    <th><?php echo $gtotal; ?></th>
                                </tr>
                            </tbody> 
                        </table> 
                        <div style="margin-top:20px;">
                        <button class="btn btn-primary no-print" onclick="window.print()">Print </button>
                    </div>
           
        </div>
        <?php include_once('includes/footer.php');?>
    </div>
    <script src="js/bootstrap.js"></script>
	
</body>
</html>
<?php } ?>