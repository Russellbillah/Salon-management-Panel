<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumineux || Barber-wise Sales Report</title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
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
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
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
				<div class="tables">
					<h3 class="title1">Barber-wise Sales Summary</h3>
					<div class="table-responsive bs-example widget-shadow">
						<h4>Revenue Performance by Barber:</h4>
						<table class="table table-bordered"> 
							<thead> 
								<tr> 
									<th>#</th> 
									<th>Barber Name</th> 
									<th>Services Handled</th> 
									<th>Total Revenue</th> 
									<th>Action</th> 
								</tr> 
							</thead> 
							<tbody>
<?php
// Joining tblinvoice with tblservices for Cost and tbladmin for the Barber's Name
$ret = mysqli_query($con, "SELECT 
    tbladmin.AdminName, 
    tbladmin.ID as bid,
    SUM(tblservices.Cost) as TotalRevenue, 
    COUNT(tblinvoice.ID) as TotalServices 
    FROM tblinvoice 
    JOIN tblservices ON tblservices.ID = tblinvoice.ServiceId 
    JOIN tbladmin ON tbladmin.ID = tblinvoice.BarberId 
    GROUP BY tblinvoice.BarberId");

$cnt = 1;
while ($row = mysqli_fetch_array($ret)) {
?>
						 <tr> 
						 	<th scope="row"><?php echo $cnt;?></th> 
						 	<td><?php echo $row['AdminName'];?></td> 
						 	<td><?php echo $row['TotalServices'];?></td>
						 	<td><?php echo $row['TotalRevenue'];?></td> 
						 	<td>
                                <a href="view-barber-details.php?barberid=<?php echo $row['bid'];?>" class="btn btn-primary btn-sm">View Details / Filter</a>
                            </td> 
						 </tr>   
<?php 
$cnt=$cnt+1;
}?>
							</tbody> 
						</table> 
                        <div style="margin-top: 10px;">
                            <button class="btn btn-primary" onclick="window.print()">Print Report</button>
                        </div>
					</div>
				</div>
			</div>
		</div>
		 <?php include_once('includes/footer.php');?>
	</div>
	<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<script src="js/bootstrap.js"> </script>
	</body>
</html>
<?php } ?>