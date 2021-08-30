<?php
  include_once("connection.php");
  include_once("header.php");
  include_once("sider.php");
  
  if(isset($_REQUEST['accept'])){
      $id=$_REQUEST['id'];
      $up="update manage_post set post_status='Accept' where post_id='$id'";
      mysqli_query($conn,$up);
      $accept_up="update manage_post set post_accept_by='$aaa111' where post_id='$id'";
      mysqli_query($conn,$accept_up);
      header("location:morepost.php?id=$id");
  }

   if(isset($_REQUEST['decline'])){
      $id=$_REQUEST['id'];
      $up="update manage_post set post_status='Decline' where post_id='$id'";
      mysqli_query($conn,$up);
      $accept_up="update manage_post set post_accept_by='$aaa111' where post_id='$id'";
      mysqli_query($conn,$accept_up);
      header("location:morepost.php?id=$id");
  }

  
  $id=$_REQUEST['id'];
  $post1="select * from manage_post as mp,reg as reg,category as cat,subcategory as subcat where mp.seller_id=reg.reg_id AND mp.cat_id=cat.cat_id AND mp.subcat_id=subcat.subcat_id AND post_id='$id'";
  
  
  $post2=mysqli_query($conn,$post1);
  $post=mysqli_fetch_array($post2);
  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Post</title>
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
<?php ?>
        <!--Start Content-->
        <div id="content" class="col-xs-12 col-sm-10">
            <div class="row">
                <div id="breadcrumb" class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="home.php">Dashboard</a></li>
                        <li><a href="#">Manage Post</a></li>
                    </ol>
                </div>
            </div>
            
            
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                 
                    <span><a href="manage_post.php">Back </a></span>
                    
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
                    <form method="post">
                        <?php 
                            $admin_id=$post['post_accept_by'];
                            $accept_data="select * from reg where reg_id='$admin_id'";
                            $accept_data2=mysqli_query($conn,$accept_data);
                            $accept_data3=mysqli_fetch_array($accept_data2);
                             
                             if($_SESSION['TYPE']=="SuperAdmin"){
                        ?>
                        <tr>
                        <td>Accept By</td>
                        <td><?php echo $accept_data3['reg_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Email :  </b><?php echo $accept_data3['reg_email'];?></td>
                        </tr>
                        <?php }?>
                    
                    
                        <tr>
                        <td>ID</td>
                        <td><?php echo $post['post_id'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Status</td>
                        <td>
                        <?php echo $post['post_status']; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <?php if($post['post_status']=="Pending"){?>
                        <b>Action:-</b>
                        <a class="btn btn-success" href="morepost.php?id=<?php echo $post['post_id'];?>&&accept">Accept</a> &nbsp;&nbsp;
                        <a class="btn btn-danger" href="morepost.php?id=<?php echo $post['post_id'];?>&&decline">Decline</a>
                    
                        </td></tr>
                        <?php } ?>
                        
                        <tr>
                        <td>Title</td>
                        <td><?php echo $post['post_title'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Seller Name</td>
                        <td><?php echo $post['reg_name'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Category</td>
                        <td><?php echo $post['cat_name'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Subcategory</td>
                        <td><?php echo $post['subcat_name'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Image</td>
                        <td><img style="height: 50px; width: 100px" src="../<?php echo $post['post_image'];?>"></td>
                        </tr>
                        
                        <tr>
                        <td>Price</td>
                        <td><?php echo $post['product_price'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Post Type</td>
                        <td><?php echo $post['post_type'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Details</td>
                        <td><?php echo $post['post_details'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Logo</td>
                        <td><img style="height: 50px; width: 100px" src="../<?php echo $post['post_logo'];?>"></td>
                        </tr>
                        
                        <tr>
                        <td>Post Date</td>
                        <td><?php $date=date_create($post['post_entry_date']);
                         echo date_format($date,"F d ,Y");?></td>
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

