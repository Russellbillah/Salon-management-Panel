<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumineux | View Invoice</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/custom.css" rel="stylesheet">
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
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        <div id="page-wrapper">
            <div class="main-page">
                
                <div class="print-header">
                    <img src="images/lumineux.png" style="width:80px; height:80px; margin-right:15px;" alt="Logo">
                    <h1 style="color:#4F52BA; font-family:sans-serif; margin:0;">LUMINEUX</h1>
                </div>

                <div class="tables" id="exampl">
                    <h3 class="title1">Invoice Details</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <?php
                        $invid=intval($_GET['invoiceid']);
                        $ret=mysqli_query($con,"select DISTINCT tblcustomers.Name,tblcustomers.Email,tblcustomers.MobileNumber,tblcustomers.Gender,tblinvoice.BillingId,tblinvoice.PostingDate from  tblcustomers   
                        join tblinvoice on tblcustomers.ID=tblinvoice.Userid where tblinvoice.BillingId='$invid'");
                        while ($row=mysqli_fetch_array($ret)) {
                        ?>
                        <h4>Invoice #<?php echo $row['BillingId'];?></h4>
                        <table class="table table-bordered"> 
                            <tr>
                                <th>Customer Name</th>
                                <td><?php echo $row['Name'];?></td>
                                <th>Contact no.</th>
                                <td><?php echo $row['MobileNumber'];?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $row['Email'];?></td>
                                <th>Invoice Date</th>
                                <td><?php echo $row['PostingDate'];?></td>
                            </tr>
                        </table>
                        <?php } ?>

                        <table class="table table-bordered" style="margin-top:20px;"> 
                            <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>Service Name</th> 
                                    <th>Cost</th> 
                                </tr> 
                            </thead> 
                            <tbody>
<?php
$ret=mysqli_query($con,"select tblservices.ServiceName,tblservices.Cost  
	from  tblinvoice 
	join tblservices on tblservices.ID=tblinvoice.ServiceId 
	where tblinvoice.BillingId='$invid'");
$cnt=1;
$gtotal=0;
while ($row=mysqli_fetch_array($ret)) {
?>
                                <tr> 
                                    <th><?php echo $cnt;?></th> 
                                    <td><?php echo $row['ServiceName'];?></td> 
                                    <td><?php echo $subtotal=$row['Cost'];?></td> 
                                </tr>   
<?php 
$cnt++;
$gtotal+=$subtotal;
} ?>
                                <tr>
                                    <th colspan="2" style="text-align:right">Grand Total</th>
                                    <th><?php echo $gtotal;?></th>
                                </tr>
                            </tbody> 
                        </table> 
                    </div>
                    
                    <div style="margin-top:20px;">
                        <button class="btn btn-primary no-print" onclick="window.print()">Print Invoice</button>
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