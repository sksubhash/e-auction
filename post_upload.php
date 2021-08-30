<?php 
ob_start();
include("connection.php");
include("header.php");

if($_SESSION['ID']==""){
    header("location:login.php");
}

$seller_id=$_SESSION['ID'];
$seller="select * from reg where reg_id='$seller_id'";
$seller1=mysqli_query($conn,$seller);
$seller2=mysqli_fetch_array($seller1);

$seller_mobile=$seller2['reg_mobile'];
if($seller_mobile==""){
     ?>
        <script>
            alert("Please First Fill Your Profile");
            window.location="user_profile.php";
        </script>
        <?php
}

$s_cate="select * from category";
$s_cate1=mysqli_query($conn,$s_cate);



if(isset($_REQUEST['submit']))
{
    $seller_id=$_SESSION['ID'];
    $cat_id=$_REQUEST['cat'];
    $scat_id=$_REQUEST['subcat'];
    $p_title=$_REQUEST['p_title'];
    $p_detail=$_REQUEST['p_detail'];
    $p_image=$_FILES['file']['name'];
    $p_image1=$_FILES['file']['tmp_name'];
    $path="admin/images/post/".$p_image;
    
    
    $p_price=$_REQUEST['p_price'];
    $pl_image=$_FILES['file1']['name'];
    $pl_image1=$_FILES['file1']['tmp_name'];
    $path1="admin/images/post_logo/".$pl_image;
    $post_type=$_REQUEST['p_type'];
    date_default_timezone_set('Asia/Calcutta');
    $date=date('Y-m-d h:i:s');
	$post_charge=$_REQUEST['p_charge'];
    
    $p_insert="INSERT INTO manage_post(seller_id,cat_id,subcat_id,post_title,post_details,post_image,product_price,post_logo,post_type,post_entry_date,post_charge)
     values('$seller_id','$cat_id','$scat_id','$p_title','$p_detail','$path','$p_price','$path1','$post_type','$date','$post_charge')";
   $p_insert1=mysqli_query($conn,$p_insert) or die(mysqli_error($conn));
    if($p_insert1)
    {
        move_uploaded_file($p_image1,$path);
        move_uploaded_file($pl_image1,$path1);
        
        if($post_type=="TotalFree"){
        header("location:user_profile.php?pending_app");
        }else{
        header("location:https://www.sandbox.paypal.com/signin?country.x=US&locale.x=en_US");
    }   }
}
if(isset($_REQUEST['e'])){
    $post_id=$_REQUEST['e'];
    $user_id=$seller_id;
    
    $e_post_data="select * from manage_post where post_id='$post_id'";
    $e_post_data1=mysqli_query($conn,$e_post_data);
    $e_post_data2=mysqli_fetch_array($e_post_data1);

    
    $cat_id=$e_post_data2['cat_id'];
    $s_scate="select * from subcategory where cat_id='$cat_id'";
    $s_scate1=mysqli_query($conn,$s_scate);
    
}
if(isset($_REQUEST['update_submit'])){
    
    $cat_id=$_REQUEST['cat'];
    $scat_id=$_REQUEST['subcat'];
    $p_title=$_REQUEST['p_title'];
    $p_detail=$_REQUEST['p_detail'];
    $p_image=$_FILES['file']['name'];
    $p_image1=$_FILES['file']['tmp_name'];  
    $path="admin/images/post/".$p_image;
    
    
    $p_price=$_REQUEST['p_price'];
    $pl_image=$_FILES['file1']['name'];
    $pl_image1=$_FILES['file1']['tmp_name'];
    $path1="admin/images/post_logo/".$pl_image;
    
    $up="UPDATE manage_post SET seller_id='$user_id', cat_id='$cat_id', subcat_id='$scat_id', post_title='$p_title', post_details='$p_detail', post_image='$path', product_price='$p_price', post_logo='$path1' WHERE  post_id='$post_id'";
    $up1=mysqli_query($conn,$up)or die(mysqli_error($conn));
    if($up1){
        move_uploaded_file($p_image1,$path);
        move_uploaded_file($pl_image1,$path1);
        header("location:user_profile.php?pending_app");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Post Upload</title>
  
  <!-- PLUGINS CSS STYLE -->
  <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Owl Carousel -->
  <link href="plugins/slick-carousel/slick/slick.css" rel="stylesheet">
  <link href="plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
  <!-- Fancy Box -->
  <link href="plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
  <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
  <link href="plugins/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet">
  <!-- CUSTOM CSS -->
  <link href="css/style.css" rel="stylesheet">

  <!-- FAVICON -->
  <link href="img/favicon.png" rel="shortcut icon">
  
  
  <script type="">
function onReady(callback) {
  var intervalId = window.setInterval(function() {
    if (document.getElementsByTagName('body')[0] !== undefined) {
      window.clearInterval(intervalId);
      callback.call(this);
    }
  }, 1000);
}

function setVisible(selector, visible) {
  document.querySelector(selector).style.display = visible ? 'block' : 'none';
}

onReady(function() {
  setVisible('.page', true);
  setVisible('#loading', false);
});
</script>
<style type="">


#loading {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 100;
  width: 100vw;
  height: 100vh;
  background-color: rgba(192, 192, 192, 0.5);
  background-image: url("https://i.stack.imgur.com/MnyxU.gif");
  background-repeat: no-repeat;
  background-position: center;
}
</style>


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
 <script type="text/javascript">
    
        function getsubcat(obj)
        {
            //alert(obj);
            var a;
            if(window.XMLHttpRequest)
            {
                a=new XMLHttpRequest();
            }
            a.onreadystatechange=function()
            {
                if(a.readyState==4)
                {
                    document.getElementById("subcat").innerHTML=a.responseText;
                }
            }
            a.open("GET","backend.php?cat_id="+obj,true);
            a.send();
        }
        
</script>
  <script type="text/javascript">
    
        function getpostcharge(obj1)
        {
            //alert(obj1);
            var b;
            if(window.XMLHttpRequest)
            {
                b=new XMLHttpRequest();
            }
            b.onreadystatechange=function()
            {
                if(b.readyState==4)
                {
                    document.getElementById("post_charge").innerHTML=b.responseText;
                }
            }
            b.open("GET","backend.php?post_type_name="+obj1,true);
            b.send();
        }
        
</script>

</head>

<body class="body-wrapper">

<div class="page">
</div>
<div id="loading"></div>

<!--==================================
=            User Profile            =
===================================-->

<section class="user-profile section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
				<div class="sidebar">
					<!-- User Widget -->
					<div class="widget user-dashboard-profile">
						<!-- User Image -->
						<div class="profile-thumb">
							<img src="<?php echo $seller2['reg_image'];?>" alt="" class="rounded-circle">
						</div>
						<!-- User Name -->
						<h5 class="text-center"><?php echo $seller2['reg_username'];?></h5>
						<p><?php $date=date_create($seller2['reg_entry_date']);
						echo date_format($date,"F d , Y")?></p>
					</div>
				</div>
			</div>
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Edit Personal Info -->
				<div class="widget personal-info">
					<h3 class="widget-header user">Upload Post </h3>
					<form action="" method="post" enctype="multipart/form-data" id="frm">
                        <!-- Post Title -->
                        <div class="form-group">
                            <label for="comunity-name">Post Title</label>
                            <input type="text" class="form-control" id="comunity-name" name="p_title" <?php if(isset($_REQUEST['e'])){?> value="<?php echo $e_post_data2['post_title'];?>"<?php }?>>
                        </div>
						<!-- Category Name -->
						<div class="form-group">
						    <label for="last-name">Select Category</label>
						    <select name="cat" class="form-control" onchange="getsubcat(this.value)" >
								<option value="">Select Category</option>
							<?php
							while($s_cate2=mysqli_fetch_array($s_cate1))
							{								
							?>
							<option <?php if($e_post_data2['cat_id']==$s_cate2['cat_id']){?> selected=""<?php }?> value="<?php echo $s_cate2['cat_id'];?>"><?php echo $s_cate2['cat_name'];?></option>
							<?php
							}
							?>
							</select><br>
							
							<label for="last-name">Select SubCategory Name</label>
						    <select name="subcat" class="form-control" id="subcat" >
								<option value="">Select Category</option>
								<?php
							while($s_scate2=mysqli_fetch_array($s_scate1))
							{								
							?>
							<option <?php if($e_post_data2['subcat_id']==$s_scate2['subcat_id']){?> selected=""<?php }?> value="<?php echo $s_scate2['subcat_id'];?>"><?php echo $s_scate2['subcat_name'];?></option>
							<?php
							}
							?>
							</select>
						</div>
						<!-- Post Logo -->
						<div class="form-group choose-file">
							<label for="comunity-name">Post Logo</label>
							<i class="fa fa-user text-center"></i>
						    <input type="file" class="form-control-file d-inline" id="input-file" name="file1">
                           <?php if(isset($_REQUEST['e'])){?> <img height="90px" width="180px" src="<?php echo $e_post_data2['post_logo'];?>"><?php }?>
						 </div>
						<!-- Post price -->
						<div class="form-group">
						    <label for="comunity-name">Product Price</label>
						    <input type="text" value="<?php echo $e_post_data2['product_price'];?>" class="form-control" id="" id="comunity-name1" name="p_price" >
						</div>
						<!-- Post Detail -->
						<div class="form-group">
						    <label for="comunity-name">Post Discription</label>
						    <textarea style="height: 70px;" name="p_detail" class="form-control">
                            <?php echo $e_post_data2['post_details'];?>
                            </textarea>
						</div>
						<!-- File chooser -->
						<div class="form-group choose-file">
							<label for="comunity-name">Post Image</label>
							<i class="fa fa-user text-center"></i>
						    <input type="file" class="form-control-file d-inline" id="input-file1" name="file" multiple="">
                            <?php if(isset($_REQUEST['e'])){?> <img height="90px" width="180px" src="<?php echo $e_post_data2['post_image'];?>"><?php }?>
						 </div>
						<!-- Category Name -->
						<div class="form-group">
						    <label for="last-name">Select Post Type</label>
						    <select <?php if(isset($_REQUEST['e'])){?> disabled=""<?php }?> name="p_type" class="form-control" onchange="getpostcharge(this.value)">
								<option value="" >Select Post Type</option>
								<option <?php if($e_post_data2['post_type']=='TotalFree'){?> selected=""<?php }?> value="TotalFree">Free</option>
								<option <?php if($e_post_data2['post_type']=='Silver'){?> selected=""<?php }?> value="Silver">Silver</option>
								<option <?php if($e_post_data2['post_type']=='Gold'){?> selected=""<?php }?> value="Gold">Gold</option>
							</select>
						</div>	
						<div id="post_charge">
                        <?php // echo $_REQUEST['p_charge']; ?>
						<input type="hidden" name="cmd" value="_cart">
   <input type="hidden" name="upload" value="1">
   <input type="hidden" name="business" value="ashishbusiness@shop.com">
   
   <input type="hidden" name="item_name_1" value="Shirt">
   <input type="hidden" name="amount_1" value="1">
   <input type="hidden" name="quantity_1" value="1">

                        
						<!-- Submit button -->
                        <?php if(isset($_REQUEST['e'])){?>
                        <input type="submit" class="btn btn-transparent" name="update_submit" value="UPDATE POST">
                        <?php }else{?>
                        <input type="submit" class="btn btn-transparent" name="submit" value="UPLOAD POST">
                        <?php }?>
                        </div><br>
                        
					</form>
				</div>
				
			</div>
		</div>
	</div>
</section>

<!--============================
=            Footer            =
=============================-->

<?php include("footer2.php");?>

<!-- Footer Bottom -->

<?php include("footer1.php");?>	

  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="js/jqv.js"></script>
  <script type="text/javascript">
  
    $(document).ready(function(){
        $("#frm").validate({
            
            rules:{
                cat:{
                    required:true,
                },
                subcat:{
                    required:true,
                },
                file1:{
                    required:true,            
                },
                p_title:{
                    required:true,
                    minlength:5,
                    maxlength:50,
                },
                p_price:
                {
                    required:true,
                    number:true,
                },
                p_detail:
                {
                    required:true,
                },
                file:{
                    required:true,            
                },
                p_type:{
                    required:true,
                },
            },
            messages:{
                cat:{
                    required:"SELECT CATEGORY",
                },
                subcat:{
                    required:"SELECT SUBCATEGORY",
                },
                file1:{
                    required:"CHOOSE LOGO",            
                },
                p_title:{
                    required:"ENTER POST TITLE",
                    minlength:"ENTER MINIMUME 5 CHARACTER",
                    maxlength:"ENTER MAXMIMUME 50 CHARACTER",
                },
                p_price:
                {
                    required:"ENTER POST PRICE",
                    number:"ENTER ONLY NUMBER",
                },
                p_detail:
                {
                    required:"ENTER POST DISCRIPTION",
                },
                file:{
                    required:"CHOOSE PHOTO",            
                },
                p_type:{
                    required:"SELECT POST TYPE",
                },
            },
        });
        
    });
    
  </script>
  
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="plugins/tether/js/tether.min.js"></script>
  <script src="plugins/raty/jquery.raty-fa.js"></script>
  <script src="plugins/bootstrap/dist/js/popper.min.js"></script>
  <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="plugins/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>
  <script src="plugins/slick-carousel/slick/slick.min.js"></script>
  <script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="plugins/smoothscroll/SmoothScroll.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
  <script src="js/scripts.js"></script>
  <style>
	label.error{
		
		color:red;
	}
	input.error{
		color:red;
	}
	input.valid{
		color:green;
	}
  </style>
 
</body>

</html>