<?php
  include("connection.php");
  include("header.php");
  
  if(isset($_REQUEST['status'])){
      $id=$_REQUEST['status'];
      $s="select reg_status from reg where reg_id='$id'";
      $s1=mysqli_query($conn,$s);
      $s2=mysqli_fetch_array($s1);
      if($s2[0]=="Active"){
           $up = "update reg set reg_status='Deactive' where reg_id='$id'";  
      }else{
           $up = "update reg set reg_status='Active' where reg_id='$id'";  
      }
        $up=mysqli_query($conn,$up); 
        header("location:moreuser.php?id=$id");
  } 
  $id=$_SESSION['ID_USER'];
  $user="select * from reg as reg,state as s,city as c,area as a where reg.reg_state=s.state_id and reg.reg_city=c.city_id and reg.reg_area=a.area_id and reg.reg_user_type='User' and reg_id='$id'";
  
  $user1=mysqli_query($conn,$user)or die(mysqli_error($conn));
  $name=mysqli_fetch_array($user1);
  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>User</title>
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
                        <li><a href="#">Manage User</a></li>
                    </ol>
                </div>
            </div>
            
            
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                 
                    <span><a href="manage_user.php">Back </a></span>
                    
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
                        <td><?php echo $name['reg_id'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Status</td>
                        <td><a href="moreuser.php?status=<?php echo $_REQUEST['id'];?>"> <?php echo $name['reg_status'];?> </a></td>
                        </tr>
                        
                        
                        <tr>
                        <td>Name</td>
                        <td><?php echo $name['reg_name'];?></td>
                        </tr>
                        
                        <tr>
                        <td>User Name</td>
                        <td><?php echo $name['reg_username'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Email</td>
                        <td><?php echo $name['reg_email'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Password</td>
                        <td><?php echo $name['reg_password'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Mobile</td>
                        <td><?php echo $name['reg_mobile'];?></td>
                        </tr>
                        
                        <tr>
                        <td>State</td>
                        <td><?php echo $name['state_name'];?></td>
                        </tr>
                        
                        <tr>
                        <td>city</td>
                        <td><?php echo $name['city_name'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Area</td>
                        <td><?php echo $name['area_name'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Address</td>
                        <td><?php echo $name['reg_address'];?></td>
                        </tr>
                        <tr>
                        <td>DOB</td>
                        <td><?php echo $name['reg_dob'];?></td>
                        </tr>
                        
                        <tr>
                        <td>User Type</td>
                        <td><?php echo $name['reg_user_type'];?></td>
                        </tr>
                        
                        <tr>
                        <td>Entry Date</td>
                        <td><?php echo $name['reg_entry_date'];?></td>
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

