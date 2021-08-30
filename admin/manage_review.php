<?php
include("connection.php");
include("header.php");

if($row121212['reg_username']==''){
    header("location:profile.php");
}
$review_data="select * from manage_review as mr, manage_post as mp,reg as reg where mr.post_id=mp.post_id and mr.bidder_id=reg.reg_id";
$review_data1=mysqli_query($conn,$review_data);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Manage Review</title>
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
        <link rel="stylesheet" type="text/css" href="CSS/dataTables.css">
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
                        <li><a href="#">Manage Review</a></li>
                    </ol>
                </div>
            </div>
            
            
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                 
                    <span>Review List</span>
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
                        <tr>
                            <th>ID</th>
                            <th>Post Title</th>
                            <th>Post Image</th>
                            <th>Reviewer Name</th>
                            <th>Seller Name</th>
                            <th>Message</th>
                            <th>Date</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Start: list_row -->
                    <form>
                    
                        
                    <!-- End: list_row -->
                    
                    <?php
                    while($review_data2=mysqli_fetch_array($review_data1)){
                        
                            $seller_id=$review_data2['seller_id'];
                            $seller_data="select * from reg where reg_id='$seller_id'";
                            $seller_data1=mysqli_query($conn,$seller_data);
                            $seller_data2=mysqli_fetch_array($seller_data1);
                            
                        
                    ?>
                        <tr>
                            <td><?php    echo $review_data2['review_id'];?></td>
                            <td><?php echo $review_data2['post_title'];?></td>
                            <td><img style="height: 50px; width: 50px" src="../<?php echo $review_data2['post_image'];?>"></img></td>
                            <td><?php echo $review_data2['reg_name'];?></td>
                            <td><?php echo $seller_data2['reg_name'];?></td>
                            <td><?php echo $review_data2['review_details'];?></td>
                            <td><?php  $date=date_create($review_data2['review_entry_date']);
                                 echo date_format($date,"F d ,Y");?></td>
                            
                          </tr> 
                        <?php }?>
                               
                        </form>
					 </tbody>
                    <tfoot>

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
   <script type="text/javascript" charset="utf8" src="js/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>
  <script>
  $(function(){
    $("#datatable-1").dataTable();
  })
  </script>
</body>
</html>

