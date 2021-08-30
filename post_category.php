<?php
ob_start();
include("connection.php");	
include("header.php");
$login_user_id=$_SESSION['ID'];
$cat_da="select * from category";
$cat_data11=mysqli_query($conn,$cat_da);
$per_page=6;


if(isset($_REQUEST['search']))
{
	echo $searchr=$_REQUEST['searchr'];
	header("location:post_category.php?searchr=".$_REQUEST['searchr']);	
}

if(isset($_REQUEST['searchr']))
{
	$searchr=$_REQUEST['searchr'];
	$search1="select * from manage_post as mp,category as c,subcategory as sc where mp.cat_id=c.cat_id and mp.subcat_id=sc.subcat_id  and mp.post_status='Accept' and (c.cat_name like '$searchr%' or sc.subcat_name like'$searchr%' or mp.post_title like'$searchr%')";
	$post_data1=mysqli_query($conn,$search1);
}

if(isset($_REQUEST['cat_id']) and !isset($_REQUEST['subcat_id']))
{
    $cat_id=$_REQUEST['cat_id'];

    $cat_data="select * from category where cat_id='$cat_id'";
    $cat_data1=mysqli_query($conn,$cat_data);
    $cat_data2=mysqli_fetch_array($cat_data1);
    

    $subcat_data="select * from subcategory where cat_id='$cat_id'";
    $subcat_data1=mysqli_query($conn,$subcat_data);
    
	$post_dataa="select * from manage_post  where cat_id='$cat_id' and post_status='Accept'";
    $post_dataa1=mysqli_query($conn,$post_dataa);
	
    $m_post2 =mysqli_num_rows($post_dataa1);
    
	$total_page=ceil($m_post2/$per_page);
	if($_REQUEST['page'] and $_REQUEST['cat_id'])
	{
		
		 $page=$_REQUEST['page'];
		$cat_id_data=$_REQUEST['cat_id'];
		 $start=($page-1)*$per_page;
        $post_data="select * from manage_post as mp,reg as reg  where reg.reg_id=mp.seller_id and cat_id='$cat_id' and post_status='Accept' limit $start,$per_page";
    $post_data1=mysqli_query($conn,$post_data);    	
    }
	else
	{
	 $page=$_REQUEST['page'];
		$cat_id_data=$_REQUEST['cat_id'];
		 $start=0;
        $post_data="select * from manage_post as mp,reg as reg  where reg.reg_id=mp.seller_id and cat_id='$cat_id' and post_status='Accept' limit $start,$per_page";
    $post_data1=mysqli_query($conn,$post_data);    	
    
		
	}
}
if(isset($_REQUEST['cat_id']) and isset($_REQUEST['subcat_id']))
{
    $cat_id=$_REQUEST['cat_id'];
    $subcat_id=$_REQUEST['subcat_id'];

    $cat_data="select * from category where cat_id='$cat_id'";
    $cat_data1=mysqli_query($conn,$cat_data);
    $cat_data2=mysqli_fetch_array($cat_data1);
	

    $subcat_data="select * from subcategory where cat_id='$cat_id'";
    $subcat_data1=mysqli_query($conn,$subcat_data);
    $subcat_data="select * from subcategory where subcat_id='$subcat_id'";
    $subcat_data11=mysqli_query($conn,$subcat_data);
    $subcat_data22=mysqli_fetch_array($subcat_data11);

	
	
	$post_dataa="select * from manage_post where subcat_id='$subcat_id' and post_status='Accept'";
    $post_dataa1=mysqli_query($conn,$post_dataa);
	
	$m_post2 =mysqli_num_rows($post_dataa1);
    
	$total_page=ceil($m_post2/$per_page);
	if($_REQUEST['page'] and $_REQUEST['cat_id'] )
	{
		
		 $page=$_REQUEST['page'];
		$cat_id_data=$_REQUEST['cat_id'];
		 $start=($page-1)*$per_page;
        $post_data="select * from manage_post as mp,reg as reg  where reg.reg_id=mp.seller_id and subcat_id='$subcat_id' and post_status='Accept' limit $start,$per_page";
    $post_data1=mysqli_query($conn,$post_data);    	
    }
	else if($_REQUEST['cat_id'])
	{
		$page=$_REQUEST['page'];
		$cat_id_data=$_REQUEST['cat_id'];
		 $start=0;
        $post_data="select * from manage_post as mp,reg as reg  where reg.reg_id=mp.seller_id and subcat_id='$subcat_id' and post_status='Accept' limit $start,$per_page";
		$post_data1=mysqli_query($conn,$post_data);
	}
}

if(isset($_REQUEST['g']))
{
	//echo $gold_post_data="select * from manage_post as mp,category as c,subcategory as sc where mp.cat_id=c.cat_id and mp.subcat_id=sc.subcat_id and mp.post_type='Gold' and mp.post_status='Accept' order by post_id desc";
	//$post_data1=mysqli_query($conn,$gold_post_data);
    
    $m_post="select * from manage_post where post_status='Accept' and post_type='Gold'";
    $m_post1=mysqli_query($conn,$m_post);
	
	
	$m_post2=mysqli_num_rows($m_post1); 
	$total_page=ceil($m_post2/$per_page);

	if(isset($_REQUEST['page']) and isset($_REQUEST['g']))
	{
		
		$page=$_REQUEST['page'];
		$start=($page-1)*$per_page;
		$gold_post_data="select * from manage_post as mp,reg as reg,category as c,subcategory as sc where mp.cat_id=c.cat_id and mp.subcat_id=sc.subcat_id and mp.seller_id=reg.reg_id and mp.post_type='Gold' and mp.post_status='Accept' order by post_id desc limit $start,$per_page";
		$post_data1=mysqli_query($conn,$gold_post_data);
    }else{
		
		$page=$_REQUEST['page'];
		$start=0;
		$gold_post_data="select * from manage_post as mp,reg as reg,category as c,subcategory as sc where mp.cat_id=c.cat_id and mp.subcat_id=sc.subcat_id and mp.seller_id=reg.reg_id and mp.post_type='Gold' and mp.post_status='Accept' order by post_id desc limit $start,$per_page";
		$post_data1=mysqli_query($conn,$gold_post_data);
		
		
	}
	
     
}

if(isset($_REQUEST['addtofav'])){
        $post_id=$_REQUEST['addtofav'];
        $wisher_id=$login_user_id;
        date_default_timezone_set('Asia/Calcutta');
        $date=date('Y-m-d h:i:s');
        
        
        $addtofav_data="select * from wishlist where post_id='$post_id' and wisher_id='$wisher_id'";
        $addtofav_data2=mysqli_query($conn,$addtofav_data);
        $addtofav_data3=mysqli_num_rows($addtofav_data2);
    if($_SESSION['ID']==""){
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
            window.location="user_profile.php?my_fav";
            
        </script>
        <?php
        
    } else{

    
    $wisher="insert into wishlist(post_id,wisher_id,wish_entry_date) values('$post_id','$wisher_id','$date')";
    $wisher1=mysqli_query($conn,$wisher) or die(mysqli_error($conn));
    header("location:user_profile.php?my_fav");
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


<section class="page-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search">
					<form method="post">
						<div class="form-row">
							
					<input type="text"  class="form-control" name="searchr" id="inputtext4" placeholder="What are you looking for" style="width:50%;float:left;margin-left:150px;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" class="btn btn-primary" name="search" value="SEARCH">
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="search-result bg-gray">
					<?php if(isset($_REQUEST['searchr']))
					{	
					?>
					<h2>Results For <span style="color:#5672f9;">"<?php echo $searchr;?>"</span></h2>
					<?php 
					} 
					else
					{
					?>
					<h2>Results For "<span style="color:#5672f9;"><?php if(isset($_REQUEST['g'])){ echo "Gold Post";  }else{ ?><?php echo $cat_data2['cat_name']; if(isset($_REQUEST['subcat_id'])){?> / <?php echo $subcat_data22['subcat_name'] ;}}?> </span> "</h2>	
					<?php 
					}
					?>
				</div>
			</div>
		</div>
		<div class="row" >
			<div class="col-md-3">
				<div class="category-sidebar">
				
				<?php 
				if(!isset($_REQUEST['searchr']))
				{
					if(!isset($_REQUEST['g'])) {?>
				
					<div class="widget category-list" >
	<h4 class="widget-header">All Category <br>Of <?php echo $cat_data2['cat_name'];?> </h4>
	<ul class="category-list">
		
		<?php
		while($subcat_data2=mysqli_fetch_array($subcat_data1))
		{
			$subcat_id=$subcat_data2['subcat_id'];
			$subcat_id1="select * from manage_post where subcat_id='$subcat_id' and post_status='Accept'";
			$subcat_id2=mysqli_query($conn,$subcat_id1);
			$subcat_id3=mysqli_num_rows($subcat_id2);
		?>	
		<li><a href="post_category.php?subcat_id=<?php echo $subcat_data2['subcat_id'];?>&&cat_id=<?php echo $_REQUEST['cat_id'];?>"><?php echo $subcat_data2['subcat_name'];?><span><?php echo $subcat_id3;?></span></a></li>
		<?php }?>
	</ul>
</div>
				<?php } }?>
				

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
			<div class="col-md-9">
			<?php if(!isset($_REQUEST['searchr']))
			{	
			?>
				<div class="category-search-filter">
					<div class="row" >
					
						<div class="col-md-6">
							<strong>Short</strong>
							<?php 
							
								
							if(isset($_REQUEST['g']))
							{	
						?>	
							<select  onchange="getGold(this.value,<?php echo $_REQUEST['g'];?>)"  class="form-control">
								<option disabled="" value="">Select Price11</option>
								<option value="asc">Lowest Price</option>
								<option value="desc">Highest Price</option>
							</select>
							<?php 
							}
							else
							{
								
						?>	
							<select  onchange="getprice(this.value,<?php echo $_REQUEST['cat_id'];?>,<?php echo $_REQUEST['subcat_id'];?>)">
								<option disabled="" value="">Select Price1</option>
								<option value="asc">Lowest Price</option>
								<option value="desc">Highest Price</option>
							</select>
								
								<?php
							}
							?>
						</div>
						
					</div>
				</div>
				
			<?php } ?>					
				
				
				<div class="product-grid-list" id="priceset">
					<div class="row mt-30" >
						<?php
						if(mysqli_num_rows($post_data1)>0)
						{
						while($post_data2=mysqli_fetch_array($post_data1))
						{  
                            $select_cat_name=$post_data2['cat_id'];
                            $select_cat_name1="select * from category where cat_id='$select_cat_name'";
                            $select_cat_name2=mysqli_query($conn,$select_cat_name1);
                            $select_cat_name3=mysqli_fetch_array($select_cat_name2);
                            
                            $subcatid=$post_data2['subcat_id'];
                            $subcatid1="select * from subcategory where subcat_id='$subcatid'";
                            $subcatid2=mysqli_query($conn,$subcatid1);
                            $subcatid3=mysqli_fetch_array($subcatid2);
						?>	
						<div class="col-sm-12 col-lg-4 col-md-6" >
							<!-- product card -->
<div class="product-item bg-light" style=" min-height: 490px;">
	<div class="card" style=" min-height: 490px;">
		<div class="thumb-content">
			 <div class="price"><?php echo $post_data2['product_price'];?>&nbsp;&#8377;</div> 
			
            <?php 
        if($post_data2['reg_account_status']=='Deactive')
        {
    ?>
            <img style="height: 200px;width: 100%;border-radius:10px;opacity:0.3;" class="card-img-top img-fluid" src="<?php echo $post_data2['post_logo'];?>" style="height:200px;width:250px" alt="Card image cap">
         <?php  
                }
           else{            
            
            ?>
            <a href="single_post.php?post_id=<?php echo $post_data2['post_id'];?>">
				<img style="height: 200px;width: 100%;border-radius:10px;" class="card-img-top img-fluid" src="<?php echo $post_data2['post_logo'];?>" style="height:200px;width:250px" alt="Card image cap">
			</a>
            
            <?php }?>
		</div>
		<div class="card-body">
		    <h4 class="card-title">
            <?php
            if($post_data2['reg_account_status']=='Deactive')
        {
            echo $post_data2['post_title'];
        }else {?>
            <a href="single_post.php?post_id=<?php echo $post_data2['post_id']; ?>"><?php echo $post_data2['post_title'];?></a><?php }?></h4>
         
            <?php   
             if($post_data2['reg_account_status']=='Deactive'){      
            ?>
            <del style="color:red">
            <?php }?>
            
		    <ul class="list-inline product-meta">
		    	<li class="list-inline-item">
		    		<i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;<?php echo $select_cat_name3['cat_name'];?>
		    	</li>
                <li class="list-inline-item">
                    <i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;<?php echo $subcatid3['subcat_name'];?>
                </li>
		    	<li class="list-inline-item">
		    		<i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php $date=date_create($post_data2['post_entry_date']);
                    echo date_format($date,"F d, Y");?>
		    	</li>
                
                <?php   
             if($post_data2['reg_account_status']=='Deactive'){ } else{     
            ?>
                
                
                <li class="list-inline-item">
                    <i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;&nbsp;<a style="color: blue; font-size: 13px;" href="post_category.php?addtofav=<?php echo $post_data2['post_id']; ?>"> Add To Favourite</a>
                </li>
                
                <?php }?>
                
		    </ul>
		    <p class="card-text" style=""><?php echo substr($post_data2['post_details'],0,90);?>... <a style="color: blue;" href="single_post.php?post_id=<?php echo $post_data2['post_id']; ?>">See More</a></p>
		    
            <?php   
             if($post_data2['reg_account_status']=='Deactive'){      
            ?>
            </del>
            <?php }?>
            
            
		</div>
	</div>
</div>



						</div>
						<?php } }
						
						else
						{
							?>
                            
                                <span style="color: red;margin-left: 200px;font-size: 120px;">Sorry..!!!</span>
                                
                                <span style="color: blue;padding-top: 200px; font-size: 25px; margin-left: -300px;">No Data Found</span>
                            
                            <?php
						}?>
					</div>
					
					<?php if(!isset($_REQUEST['searchr']))
					{
					?>
					
					<div class="pagination justify-content-center">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item">
								<a class="page-link" href="#" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									 
									<span class="sr-only">Previous</span>
									
									
								</a>
							</li>
							
							<?php 
							if(isset($_REQUEST['cat_id']) and  !isset($_REQUEST['subcat_id']))
							{
							for($i=1;$i<=$total_page;$i++)
							{
							?>
                            <li class="page-item"><a class="page-link" href="post_category?page=<?php echo $i;?>&&cat_id=<?php echo $cat_id;?>"><?php echo $i;?></a></li>
				            <?php 
							} 
							}
							else if(isset($_REQUEST['subcat_id']))
							{
							for($i=1;$i<=$total_page;$i++)
							{
								
							?>
                            <li class="page-item">
							<a class="page-link" href="post_category.php?page=<?php echo $i;?> && subcat_id=<?php echo $_REQUEST['subcat_id'];?>&&cat_id=<?php echo $_REQUEST['cat_id'];?>"><?php echo $i;?></a></li>
				            <?php 
							}
							}
							else if(isset($_REQUEST['g']))
							{
							for($i=1;$i<=$total_page;$i++)
							{
								
							?>
                            <li class="page-item">
							<a class="page-link" href="post_category.php?page=<?php echo $i;?> && g"><?php echo $i;?></a></li>
				            <?php 
							}
							}
							?>
							<li class="page-item">
								<a class="page-link" href="#" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
									<span class="sr-only">Next</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
					<?php } ?>
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

function getGold(obj,ob)
{
	//alert(ob);
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
	
	a.open("GET","backend1.php?lowhigh="+obj+"&&g="+ob,true);
	a.send();
}



</script>	
</body>

</html>
