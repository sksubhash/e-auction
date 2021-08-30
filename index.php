<?php 
ob_Start();
include("connection.php");
include("header.php");

$login_user_id=$_SESSION['ID'];
$categorys="select * from category ";
$categorys1=mysqli_query($conn,$categorys);

$category_data="select * from category limit 5 ";
$category_data1=mysqli_query($conn,$category_data);


$gold_post="select * from manage_post as mp,category as c,subcategory as sc,reg as reg where mp.cat_id=c.cat_id and mp.subcat_id=sc.subcat_id and mp.seller_id=reg.reg_id and post_type='Gold' and post_status='Accept' order by mp.post_id desc limit 6";
$gold_post1=mysqli_query($conn,$gold_post);

if(isset($_REQUEST['search']))
{
	$searchr=$_REQUEST['searchr'];
	header("location:search_result.php?search=".$_REQUEST['searchr']);	
}

if(isset($_REQUEST['addtofav'])){
    $post_id=$_REQUEST['addtofav'];
    $wisher_id=$login_user_id;
    date_default_timezone_set('Asia/Calcutta');
    $date=date('Y-m-d h:i:s');
    
    $addtofav_data="select * from wishlist where post_id='$post_id' and wisher_id='$wisher_id'";
    $addtofav_data2=mysqli_query($conn,$addtofav_data);
    $addtofav_data3=mysqli_num_rows($addtofav_data2);
    
    if($wisher_id==""){
        ?>
        <script>
            alert("Please Login First..!!");
            window.location="login.php";
        </script>
        <?php
    }
        else if($addtofav_data3>0){
        ?>
        <script>
            alert("This post is already Added to your Favourite");
            window.location="index.php";
            
        </script>
        <?php
        
    } else{
    
    $wisher="insert into wishlist(post_id,wisher_id,wish_entry_date) values('$post_id','$wisher_id','$date')";
    $wisher1=mysqli_query($conn,$wisher) or die(mysqli_error($conn));
    header("location:user_profile.php?my_fav");
}}

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  
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

</head>

<body class="body-wrapper">



<div class="page">
</div>
<div id="loading"></div>
<!--===============================
=            Hero Area            =
================================-->

<section class="hero-area bg-1 text-center overly">
	<!-- Container Start -->
	<div class="container" >
		<div class="row" >
			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
					<h1>Welcome To The Auction </h1>
					<p>Join the millions who buy and sell from each other <br> everyday in local communities around the world</p>
					<div class="short-popular-category-list text-center">
						<h2>Popular Category</h2>
						<ul class="list-inline" >
                        <?php while($category_data2=mysqli_fetch_array($category_data1)){?>
							<li class="list-inline-item" >
								<a style="font-size: 15px;" href="post_category.php?cat_id=<?php echo $category_data2['cat_id'];?>"><?php echo $category_data2['cat_name'];?></a></li>
                          <?php }?>      
						</ul>
					</div>
					
				</div>
				<!-- Advance Search --> 
				<div class="advance-search">
					<form action="#" method="get">
						<div class="row">
							<!-- Store Search -->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<div class="block d-flex" style="width:70%;">
									<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="search" placeholder="Search for Item" name="searchr">
								</div>
							<input type="submit" class="btn btn-main" name="search" value="SEARCH">
						</div>
					</form>
					
				</div>
				
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<!--===================================
=            Client Slider            =
====================================-->


<!--===========================================
=            Popular deals section            =
============================================-->

<section class="popular-deals section bg-gray">
	<div class="container">
		<div class="row" >
			<div class="col-md-12">
				<div class="section-title">
					<h2>Trending Ads</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, magnam.</p>
				</div>
			</div>
		</div>
		<div class="row" >
			<!-- offer 01 -->
			
	<?php 
		while($gold_post2=mysqli_fetch_array($gold_post1))
		{
	?>		
			<div class="col-sm-12 col-lg-4">
				<!-- product card -->
<div class="product-item bg-light" style=" min-height: 430px;">
	<div class="card" style=" min-height: 430px;">
		<div class="thumb-content">
        
			 <div class="price">
			 <?php echo $gold_post2['product_price'];?>&nbsp;&#8377;</div>
            
		<?php 
		if($gold_post2['reg_account_status']=='Deactive')
		{
	?>
		
	<img style="height: 200px;width: 100%;border-radius:10px;opacity:0.3;"  class="card-img-top img-fluid" src="<?php echo $gold_post2['post_logo'];?>" alt="Card image cap">

	<?php 
		}
		else
		{
			?>
			<a href="single_post.php?post_id=<?php echo $gold_post2['post_id']; ?>">
		
	<img style="height: 200px;width: 100%;border-radius:10px;" class="card-img-top img-fluid" src="<?php echo $gold_post2['post_logo'];?>" alt="Card image cap">
				</a>
			<?php
		}
	?>
	
		</div>
		<div class="card-body" style="height:100px;" >
		<?php 
		if($gold_post2['reg_account_status']=='Deactive')
		{?><del style="color:red"><?php }?>
		    <h4 class="card-title">
			
			<?php 
		if($gold_post2['reg_account_status']=='Deactive')
	
	{
		?>
		<?php echo $gold_post2['post_title'];?>
		<?php 
	}
	else
	{
		?>
		<a href="single_post.php?post_id=<?php echo $gold_post2['post_id']; ?>"><?php echo $gold_post2['post_title'];?></a>
		<?php
	}
?>		
			</h4>
		    <ul class="list-inline product-meta">
		    	<li class="list-inline-item">
		    		<i class="fa fa-folder-open-o"></i><?php echo $gold_post2['cat_name'];?>
		    	</li>
				<li class="list-inline-item">
		    		<i class="fa fa-folder-open-o"></i><?php echo $gold_post2['subcat_name'];?>
		    	</li><br>
				<li class="list-inline-item">
		    		<i class="fa fa-calendar"></i><?php  $date=date_create($gold_post2['post_entry_date']);
					echo date_format($date,"F d, Y")
					?>
		    	</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br><li class="list-inline-item">
				<?php if($gold_post2['reg_account_status']=='Active'){?>
                    <i class="fa fa-bookmark-o"></i>
					
					<a style="color: blue; font-size: 13px;"  href="index.php?addtofav=<?php echo $gold_post2['post_id']; ?>"> Add To Favourite</a>
                </li><?php }?>
		    </ul>
		    <p class="card-text" style="margin-top:20px;height:60px;"><?php echo substr($gold_post2['post_details'],0,90);?>... <a style="color: blue;" href="single_post.php?post_id=<?php echo $gold_post2['post_id']; ?>">See More</a> </p>
		    
			<?php if($gold_post2['reg_account_status']=='Deactive'){?></del><?php }?>
		</div>
	</div>
</div>



			</div>
		<?php } ?>
			
		</div>
	</div>
	<tr>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td><a href="post_category?g" style="color:blue;">See More</a></td>
</tr>
</section>



<!--==========================================
=            All Category Section            =
===========================================-->

<section class=" section">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Section title -->
				<div class="section-title">
					<h2>All Categories</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, provident!</p>
				</div>
				
				<div class="row">
					<?php
						while($categorys2=mysqli_fetch_array($categorys1))
						{
					?>
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block"  style="min-height: 315px;">
							<div class="header">
							<a href="post_category.php?cat_id=<?php echo $categorys2['cat_id'];?>"><img src="admin/<?php echo $categorys2['cat_image'];?>" height="50" width="50" style="border-radius:50%;" >
							<h4><?php echo $categorys2['cat_name'];?></h4></a>
							</div>
							<?php
							$cat_id=$categorys2['cat_id'];
							$subcat_data="select * from subcategory where  cat_id='$cat_id' limit 4";
							$subcat_data1=mysqli_query($conn,$subcat_data);
							?>
							<ul class="category-list">
							<?php
							while($subcat_data2=mysqli_fetch_array($subcat_data1))
							{		
								
								$subcatid=$subcat_data2['subcat_id'];
                                $no="select * from manage_post where subcat_id='$subcatid' and post_status='Accept'";
                                $no1=mysqli_query($conn,$no);
                                $no2=mysqli_num_rows($no1);
								
							?>
								<li><a href="post_category.php?subcat_id=<?php echo $subcat_data2['subcat_id'];?>&&cat_id=<?php echo $categorys2['cat_id'];?>"><?php echo $subcat_data2['subcat_name'];?> <span><?php echo $no2;?></span></a></li>
							<?php } ?> 	
							</ul>
							
						</div>
					</div> <!-- /Category List -->
						<?php } ?> 	
					
					
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>




<!--============================
=            Footer            =
=============================-->
<?php include("footer2.php");?>

<!-- Footer Bottom -->

<?php include("footer1.php");?>

  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="plugins/tether/js/tether.min.js"></script>
  <script src="plugins/raty/jquery.raty-fa.js"></script>
  <script src="plugins/bootstrap/dist/js/popper.min.js"></script>
  <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="plugins/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>
  <script src="plugins/slick-carousel/slick/slick.min.js"></script>
  <script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
  <script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="plugins/smoothscroll/SmoothScroll.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
  <script src="js/scripts.js"></script>

</body>

</html>



