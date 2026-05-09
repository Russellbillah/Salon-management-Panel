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
<title>Lumineux | Invoice List</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/custom.css" rel="stylesheet">
<style>
    /* Organization Branding for Print */
    @media print {
        .print-header {
            display: flex !important;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #4F52BA;
            padding-bottom: 10px;
        }
        .print-logo {
            width: 80px;
            height: 80px;
            margin-right: 15px;
        }
        .org-name {
            font-size: 24pt;
            font-weight: bold;
            color: #4F52BA;
        }
    }
    .print-header { display: none; } /* Hidden on screen, shown on print */
</style>
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
         <?php include_once('includes/sidebar.php');?>
         <?php include_once('includes/header.php');?>
        <div id="page-wrapper">
            <div class="main-page">
                <div class="print-header">
                    <img src="images/lumineux.png" class="print-logo" alt="Logo">
                    <div class="org-name">Lumineux</div>
                </div>

                <div class="tables">
                    <h3 class="title1">Invoice List</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Manage Invoices:</h4>
                        <table class="table table-bordered"> 
                            <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>Invoice Id</th> 
                                    <th>Customer Name</th> 
                                    <th>Barber Name</th>
                                    <th>Invoice Date</th> 
                                    <th>Action</th>
                                </tr> 
                            </thead> 
                            <tbody>
<?php
$ret=mysqli_query($con,"select distinct tblcustomers.Name, tblinvoice.BillingId, tblinvoice.PostingDate, tbladmin.AdminName 
    from tblcustomers   
    join tblinvoice on tblcustomers.ID=tblinvoice.Userid 
    left join tbladmin on tblinvoice.BarberId=tbladmin.ID 
    order by tblinvoice.ID desc");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>
                                 <tr> 
                                    <th scope="row"><?php echo $cnt;?></th> 
                                    <td><?php echo $row['BillingId'];?></td>
                                    <td><?php echo $row['Name'];?></td>
                                    <td><?php echo ($row['AdminName']!="") ? $row['AdminName'] : "N/A"; ?></td>
                                    <td><?php echo $row['PostingDate'];?></td> 
                                    <td><a href="view-invoice.php?invoiceid=<?php echo $row['BillingId'];?>" class="btn btn-info btn-sm">View & Print PDF</a></td> 
                                  </tr>   
<?php 
$cnt=$cnt+1;
}?>
                            </tbody> 
                        </table> 
                        <div class="no-print" style="padding: 20px 0;">
                            <button class="btn btn-primary" onclick="window.print()">Print List as PDF</button>
                        </div>
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