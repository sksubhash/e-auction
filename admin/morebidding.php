<?php
  include("connection.php");
  include("header.php");   
  
  $id=$_REQUEST['id'];
  $admin="select * from manage_bidding as mb, manage_post as mp, reg as reg where mp.post_id=mb.post_id and reg.reg_id=mb.bidder_id and mb.bidding_id='$id'";
  $admin1=mysqli_query($conn,$admin) or die(mysqli_error($conn));
 $name=mysqli_fetch_array($admin1);
  
    $post_id=$name['post_id'];
    $seller_name="select * from manage_post as mp,reg as reg where reg.reg_id=mp.seller_id and mp.post_id=$post_id";
    $seller_name2=mysqli_query($conn,$seller_name);
    $seller_name3=mysqli_fetch_array($seller_name2);
  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Manage Bidding</title>
        <meta name="description" content="description">
        <meta name="author" content="DevOOPS">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
        <link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
        <link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
        <link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
        <link href="plugins/select2/select2.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
                <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
<!--Start Header-->
<?php ?>
        <!--End Header-->


<!--Start Container-->
<?php include("sider.php");?>
        <!--Start Content-->
        <div id="content" class="col-xs-12 col-sm-10">
            <div class="row">
                <div id="breadcrumb" class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="home.php">Dashboard</a></li>
                        <li><a href="#">Manage Bidding</a></li>
                    </ol>
                </div>
            </div>
            
            
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                 
                    <span><a href="manage_bidding.php">Back </a></span>
                    
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content no-padding">
                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
                    <thead>
                        <tr><td></td></tr>
                    </thead>
                    <tbody>
                    <!-- Start: list_row -->
                    <form>
                        <tr>
                        <td>ID</td>
                        <td><?php echo $name['bidding_id'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Status</td>
                        <td style="color:  #000000;font-size: 18px"><?php echo $name['bidding_status'];?></td>
                        </tr>
                        
                        
                        <tr>
                        <td>Post Title</td>
                        <td><?php echo $name['post_title'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Post Image</td>
                        <td><img style="height: 50px;width: 100px;" src="../<?php echo $name['post_image'];?>"></img></td>
                        </tr>
                        
                        <tr>
                        <td>Seller Name</td>
                        <td><?php echo $seller_name3['reg_name'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Post Price</td>
                        <td><?php echo $name['product_price'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Bidder Name</td>
                        <td><?php echo $name['reg_name'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Bidding Amount</td>
                        <td><?php echo $name['bidding_amount'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Date</td>
                        <td><?php echo $name['bidding_entry_date'];?></td>
                        </tr>
                        

                        
                    <!-- End: list_row -->
                    </tbody>
                    <tfoot>
                        
                        

                        
                        </form>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
            
        </div>
        <!--End Content--> 
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="plugins/jquery/jquery-2.1.0.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/justified-gallery/jquery.justifiedgallery.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="plugins/tinymce/jquery.tinymce.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="js/devoops.js"></script>
</body>
</html>

