<?php
include("connection.php");
 include("header.php");
$dash_id=$_SESSION['ID'];
$dash_data="select * from reg where reg_id='$dash_id'";
$dash_data1=mysqli_query($conn,$dash_data);
$dash_data2=mysqli_fetch_array($dash_data1);

$no_row="select * from reg where reg_user_type='Admin'";
$no_row1=mysqli_query($conn,$no_row);
$no_row2=mysqli_num_rows($no_row1);

$no1_row="select * from reg where reg_user_type='User'";
$no1_row1=mysqli_query($conn,$no1_row);
$no1_row2=mysqli_num_rows($no1_row1);

$no2_row="select * from manage_post";
$no2_row1=mysqli_query($conn,$no2_row);
$no2_row2=mysqli_num_rows($no2_row1);

$no3_row="select * from sold_product";
$no3_row1=mysqli_query($conn,$no3_row);
$no3_row2=mysqli_num_rows($no3_row1);

$no4_row="select * from manage_bidding where bidding_status='Pending'";
$no4_row1=mysqli_query($conn,$no4_row);
$no4_row2=mysqli_num_rows($no4_row1);

$no5_row="select * from manage_post where status='Pending'";
$no5_row1=mysqli_query($conn,$no4_row);
$no5_row2=mysqli_num_rows($no5_row1);

if($dash_data2['reg_username']==''){
    header("location:profile.php");
}
 ?>
 
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Home</title>
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
<?php

?>
		<!--End Header-->
    

<!--Start Container-->
<?php include("sider.php");?>
		<!--Start Content-->
        <div id="content" class="col-xs-12 col-sm-10">
            <div class="row">
    <div id="breadcrumb" class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="#">Home</a></li>
        </ol>
    </div>
</div>

<div class="row">
	<br><br>
	<?php if($dash_data2['reg_user_type']=='SuperAdmin')
	{
		?>	
    <div class="col-xs-12 col-sm-4">
        <div class="box box-pricing" >
            
            <div class="box-content no-padding" >
                <div class="row-fluid bg-default" >

                    <div class="col-sm-6" >
                         <Center><h2><b>Users </b></h2></center><br>
						
						 </div>
                    <div class="clearfix"></div>
                </div>
				<div class="row-fluid centered" >
                   <div class="col-sm-12"><br>
				    <h1><?php echo $no1_row2;?>
				   </h1>
				   </div>
                    </div>
                
            </div>
        </div>  
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="box box-pricing" >
            
            <div class="box-content no-padding" >
                <div class="row-fluid bg-default" >

                    <div class="col-sm-6" >
                         <Center><h2><b>Post</b></h2></center><br>
						
						 </div>
                    <div class="clearfix"></div>
                </div>
				<div class="row-fluid centered" >
                   <div class="col-sm-12"><br>
				    <h1><?php echo $no2_row2;?>
				   </h1>
				   </div>
                    </div>
                
            </div>
        </div>  
    </div>
	
    <div class="col-xs-12 col-sm-4">
        <div class="box box-pricing">
            
            <div class="box-content no-padding">
                <div class="row-fluid bg-default" >

                    <div class="col-sm-6">
                         <Center><h2><b>Sold Post</b></h2></center><br>
						
						 </div>
                    <div class="clearfix"></div>
                </div>
				<div class="row-fluid centered" >
                   <div class="col-sm-12"><br>
				    <h1><?php echo $no3_row2;?>
				   </h1>
				   </div>
                    </div>
                
            </div>
        </div>  
    </div>
	
	<div class="col-xs-12 col-sm-4"><br></br>
        <div class="box box-pricing">
            
            <div class="box-content no-padding">
                <div class="row-fluid bg-default" >

                    <div class="col-sm-6">
                         <Center><h2><b>Total Bid</b></h2></center><br>
						
						 </div>
                    <div class="clearfix"></div>
                </div>
				<div class="row-fluid centered" >
                   <div class="col-sm-12"><br>
				    <h1><?php echo $no4_row2;?>
				   </h1>
				   </div>
                    </div>
                
            </div>
        </div>  
    </div>
	
	<div class="col-xs-12 col-sm-4"><br></br>
        <div class="box box-pricing">
            
            <div class="box-content no-padding">
                <div class="row-fluid bg-default" >

                    <div class="col-sm-6" style="width:100%;">
                         <h2><b>Pending post</b></h2><br>
						
						 </div>
                    <div class="clearfix"></div>
                </div>
				<div class="row-fluid centered" >
                   <div class="col-sm-12"><br>
				    <h1><?php echo $no5_row2;?>
				   </h1>
				   </div>
                    </div>
                
            </div>
        </div>  
    </div>
	
	<div class="col-xs-12 col-sm-4"><br><br>
        <div class="box box-pricing">
            
            <div class="box-content no-padding" >
                <div class="row-fluid bg-default" >

                    <div class="col-sm-6">
                         <Center><h2><b>Admin</b></h2></center><br>
						
						 </div>
                    <div class="clearfix"></div>
                </div>
				<div class="row-fluid centered" >
                   <div class="col-sm-12"><br>
				    <h1><?php echo $no_row2;?>
				   </h1>
				   </div>
                    </div>
                
            </div>
        </div>  
    </div>
    <?php } ?>
	
    <?php if($dash_data2['reg_user_type']=='Admin')
	{
		?>	
   
    <div class="col-xs-12 col-sm-4">
        <div class="box box-pricing" >
            
            <div class="box-content no-padding" >
                <div class="row-fluid bg-default" >

                    <div class="col-sm-6" >
                         <Center><h2><b>Users </b></h2></center><br>
						
						 </div>
                    <div class="clearfix"></div>
                </div>
				<div class="row-fluid centered" >
                   <div class="col-sm-12"><br>
				    <h1><?php echo $no1_row2;?>
				   </h1>
				   </div>
                    </div>
                
            </div>
        </div>  
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="box box-pricing" >
            
            <div class="box-content no-padding" >
                <div class="row-fluid bg-default" >

                    <div class="col-sm-6" >
                         <Center><h2><b>Post</b></h2></center><br>
						
						 </div>
                    <div class="clearfix"></div>
                </div>
				<div class="row-fluid centered" >
                   <div class="col-sm-12"><br>
				    <h1><?php echo $no2_row2;?>
				   </h1>
				   </div>
                    </div>
                
            </div>
        </div>  
    </div>
	
    <div class="col-xs-12 col-sm-4">
        <div class="box box-pricing">
            
            <div class="box-content no-padding">
                <div class="row-fluid bg-default" >

                    <div class="col-sm-6">
                         <Center><h2><b>Sold Post</b></h2></center><br>
						
						 </div>
                    <div class="clearfix"></div>
                </div>
				<div class="row-fluid centered" >
                   <div class="col-sm-12"><br>
				    <h1><?php echo $no3_row2;?>
				   </h1>
				   </div>
                    </div>
                
            </div>
        </div>  
    </div>
	
	<div class="col-xs-12 col-sm-4"><br></br>
        <div class="box box-pricing">
            
            <div class="box-content no-padding">
                <div class="row-fluid bg-default" >

                    <div class="col-sm-6">
                         <Center><h2><b>Total Bid</b></h2></center><br>
						
						 </div>
                    <div class="clearfix"></div>
                </div>
				<div class="row-fluid centered" >
                   <div class="col-sm-12"><br>
				    <h1><?php echo $no4_row2;?>
				   </h1>
				   </div>
                    </div>
                
            </div>
        </div>  
    </div>
	
	<div class="col-xs-12 col-sm-4"><br></br>
        <div class="box box-pricing">
            
            <div class="box-content no-padding">
                <div class="row-fluid bg-default" >

                    <div class="col-sm-6" style="width:100%;">
                         <h2><b>Pending post</b></h2><br>
						
						 </div>
                    <div class="clearfix"></div>
                </div>
				<div class="row-fluid centered" >
                   <div class="col-sm-12"><br>
				    <h1><?php echo $no5_row2;?>
				   </h1>
				   </div>
                    </div>
                
            </div>
        </div>  
    </div>
	
    <?php } ?>
    
    
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
