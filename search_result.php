<?php
include("header.php");
include("connection.php");
$login_user_id=$_SESSION['ID'];
$cat_da="select * from category";
$cat_data11=mysqli_query($conn,$cat_da);


if(isset($_REQUEST['addtofav'])){
    if($login_user_id=""){
        header("location:login.php");
    }
    $post_id=$_REQUEST['addtofav'];
    $wisher_id=$login_user_id;
    date_default_timezone_set('Asia/Calcutta');
    $date=date('Y-m-d h:i:s');
    
    $wisher="insert into wishlist(post_id,wisher_id,wish_entry_date) values('$post_id','$wisher_id','$date')";
    $wisher1=mysqli_query($conn,$wisher) or die(mysqli_error($conn));
    header("location:post_category.php?post_id=$post_id");
}

$search=$_REQUEST['search'];
$search1="select * from manage_post as mp,category as c,subcategory as sc where mp.cat_id=c.cat_id and mp.subcat_id=sc.subcat_id  and mp.post_status='Accept' and (c.cat_name like '$search%' or sc.subcat_name like'$search%' or mp.post_title like'$search%')";
$post_data1=mysqli_query($conn,$search1);
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Post Category</title>
  
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

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="body-wrapper">

<section class="section-sm" style="margin-top:-60px;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="search-result bg-gray">
					<h2>Results Of "<span style="color:#5672f9;"> <?php echo $search;?></span> "</h2>
				</div>
			</div>
		</div>
		<div class="row" >
			<div class="col-md-3">
				<div class="category-sidebar">

                    <div class="widget category-list">
    <h4 class="widget-header">All Category</h4>
    <ul class="category-list">
        <?php
        while($cat_data22=mysqli_fetch_array($cat_data11))
        {
			$cat_id_id=$cat_data22['cat_id'];
			$cat_id1="select * from manage_post where cat_id='$cat_id_id' and post_status='Accept'";
			$cat_id2=mysqli_query($conn,$cat_id1);
			$cat_id3=mysqli_num_rows($cat_id2);
        ?>
        <li><a href="post_category.php?cat_id=<?php echo $cat_data22['cat_id'];?>"><?php echo $cat_data22['cat_name'];?><span><?php echo $cat_id3;?></span></a></li>
        <?php }?>
    </ul>
</div>




				</div>
			</div>
			<div class="col-md-9" >
				
			
				<div class="product-grid-list" >
					<div class="row mt-30" >
					<?php 
                    if(mysqli_num_rows($post_data1)>0)
                    {
					while($post_data2=mysqli_fetch_array($post_data1))
					{
					?>	
						<div class="col-sm-12 col-lg-4 col-md-6" >
							<!-- product card -->
<div class="product-item bg-light" style=" min-height: 500px;" >
	<div class="card" style=" min-height: 500px;" >
		<div class="thumb-content">
			 <div class="price"><?php echo $post_data2['product_price'];?>&nbsp;&#8377;</div> 
			<a href="single_post.php?post_id=<?php echo $post_data2['post_id'];?>">
				<img class="card-img-top img-fluid" src="<?php echo $post_data2['post_logo'];?>" style="height:200px;width:250px" alt="Card image cap">
			</a>
		</div>
		<div class="card-body">
		    <h4 class="card-title"><a href="single_post.php?post_id=<?php echo $post_data2['post_id']; ?>"><?php echo $post_data2['post_title'];?></a></h4>
		    <ul class="list-inline product-meta">
		    	<li class="list-inline-item">
		    		<i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;<?php echo $cat_data2['cat_name'];?>
		    	</li>
                <li class="list-inline-item">
                    <i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;<?php echo $subcatid3['subcat_name'];?>
                </li>
		    	<li class="list-inline-item">
		    		<i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php $date=date_create($post_data2['post_entry_date']);
                    echo date_format($date,"F d, Y");?>
		    	</li>
                <li class="list-inline-item">
                    <i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;&nbsp;<a style="color: blue; font-size: 13px;" href="post_category.php?addtofav=<?php echo $post_data2['post_id']; ?>"> Add To Favourite</a>
                </li>
		    </ul>
		    <p class="card-text" style=" "><?php echo substr($post_data2['post_details'],0,90);?>... <a style="color: blue;" href="single_post.php?post_id=<?php echo $post_data2['post_id']; ?>">See More</a></p>
		    <div class="product-ratings">
		    	<ul class="list-inline">
		    		<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
		    		<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
		    		<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
		    		<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
		    		<li class="list-inline-item"><i class="fa fa-star"></i></li>
		    	</ul>
		    </div>
		</div>
	</div>
</div>



						</div>
						<?php }}
                        
                        else
                        {
                            ?>
                            
                                <span style="color: red;margin-left: 200px;font-size: 120px;">Sorry..!!!</span>
                                
                                <span style="color: blue;padding-top: 200px; font-size: 25px; margin-left: -300px;">No Data Found</span>
                            
                            <?php
                        }?>
						
					</div>
					
					
					
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
   <script type="text/javascript">

function getprice(obj,ob,ob1)
{
	//alert(ob1);
	var a;
	if(window.XMLHttpRequest)
	{
		a=new XMLHttpRequest();
	}
	a.onreadystatechange=function()
	{
		if(a.readyState==4)
		{
			document.getElementById("priceset").innerHTML=a.responseText;
		}
	}
	
	a.open("GET","backend1.php?lowhigh="+obj+"&&cat="+ob+"&&subcat="+ob1,true);
	a.send();
}

</script>	
</body>

</html>
