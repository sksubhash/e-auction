<?php 
ob_Start();
include("header.php");
include("connection.php");
if($_SESSION['ID']=="")
{
	header("location:login.php");
}
$id=$_SESSION['ID'];

$s="select * from reg where reg_id='$id'";
$s1=mysqli_query($conn,$s) or die(mysqli_error($conn));
$s2=mysqli_fetch_array($s1);

$bidder_id=$_SESSION['BIDDER_DATA_ID'];
$b="select * from reg as reg,state as s,city as c,area as a where reg.reg_state=s.state_id and reg.reg_city=c.city_id and reg.reg_area and a.area_id and reg_id='$bidder_id'";
$b1=mysqli_query($conn,$b) or die(mysqli_error($conn));
$b2=mysqli_fetch_array($b1);

$total_post="select * from manage_post where seller_id='$bidder_id'";
$total_post2=mysqli_query($conn,$total_post);
$total_post3=mysqli_num_rows($total_post2);

 $bidding_id= $_SESSION['BIDDING_DATA_ID'];
 $bidding_status="select * from manage_bidding where bidding_id='$bidding_id' and bidding_status='Accept'";
 $bidding_status2=mysqli_query($conn,$bidding_status);
 $bidding_status4=mysqli_num_rows($bidding_status2);





if(isset($_REQUEST['my_add']))
{
	$my_add=$_REQUEST['my_add'];
	$my_add1="select * from manage_post as mp,category as c where mp.cat_id=c.cat_id and seller_id='$id' and post_status='Accept'";
	$my_add2=mysqli_query($conn,$my_add1);
	
}

if(isset($_REQUEST['my_add_session']))
{
    $post_id=$_REQUEST['my_add_session'];
    $_SESSION['ADD_POST_ID']=$post_id;
    header("location:myadd_bid.php");
    
}
 

if(isset($_REQUEST['my_bid']))
{
	$my_bid1="select post_id from manage_bidding where bidder_id='$id' group by post_id";
	$my_bid2=mysqli_query($conn,$my_bid1)or die(mysqli_error($conn));
}

if(isset($_REQUEST['my_bid_more']))
{   $bid_post_id=$_SESSION['BID_POST_ID'];
    $bid_bid_data="select * from manage_bidding as mb, reg as reg where reg.reg_id=mb.bidder_id and post_id='$bid_post_id' and bidder_id='$id'";
    $bid_bid_data2=mysqli_query($conn,$bid_bid_data);
    
    $bid_post="select * from manage_post where post_id='$bid_post_id'";
    $bid_post2=mysqli_query($conn,$bid_post);
    $bid_post3=mysqli_fetch_array($bid_post2);
}


if(isset($_REQUEST['my_bid_session']))
{   
    $post_id=$_REQUEST['my_bid_session'];
    $_SESSION['BID_POST_ID']=$post_id;
    header("location:user_profile.php?my_bid_more");
}


if(isset($_REQUEST['sold_product']))
{
	$sold_product1="select * from  manage_post as mp,  sold_product as sp, reg as reg, manage_bidding as mb where sp.post_id=mp.post_id and reg.reg_id=sp.bidder_id and mb.bidder_id=sp.bidder_id and mp.seller_id='$id' and mb.bidding_status='Accept'";
	$sold_product2=mysqli_query($conn,$sold_product1) or die(mysqli_error($conn));
}
if(isset($_REQUEST['pending_app']))
{
	$pending_app1="select * from manage_post where seller_id='$id' and post_status='Pending'";
	$pending_app2=mysqli_query($conn,$pending_app1);
	
	
}
if(isset($_REQUEST['my_fav']))
{
    $fav_app1="select * from wishlist as wish, manage_post as mp where mp.post_id=wish.post_id and wisher_id='$id'";
    $fav_app2=mysqli_query($conn,$fav_app1);
        
    
}

if(isset($_REQUEST['notification']))
{
    $update_bid001="update manage_bidding set bidding_notification='Seen' where bidder_id='$id'";
    mysqli_query($conn,$update_bid001);
    header("location:user_profile.php?notification111");
        
}

if(isset($_REQUEST['notification111']))
{
    $notification_data="select * from manage_bidding as mb,manage_post as mp where mb.bidder_id='$id' and mb.bidding_notification!='NULL' and mb.post_id=mp.post_id";
    $notification_data2=mysqli_query($conn,$notification_data);
        
}

if(isset($_REQUEST['delete']) and isset($_REQUEST['my_add']))
{
	$delete_data=$_REQUEST['delete'];
	echo $delete_data1="delete from manage_post where post_id='$delete_data'";
	$delete_data2=mysqli_query($conn,$delete_data1)or die(mysqli_error($conn));
    if($delete_data2){
	header("location:user_profile.php?my_add");
    }
}
if(isset($_REQUEST['delete']) and isset($_REQUEST['pending_app']))
{
    $delete_data=$_REQUEST['delete'];
    $delete_data1="delete from manage_post where post_id='$delete_data'";
    $delete_data2=mysqli_query($conn,$delete_data1)or die(mysqli_error($conn));

    header("location:user_profile.php?pending_app");
    
}
if(isset($_REQUEST['delete']) and isset($_REQUEST['fav_app']))
{
    $delete_data=$_REQUEST['delete'];
    $delete_data1="delete from wishlist where wish_id='$delete_data'";
    $delete_data2=mysqli_query($conn,$delete_data1)or die(mysqli_error($conn));
    if($delete_data2){
    header("location:user_profile.php?my_fav");
    }
}

if(isset($_REQUEST['e']))
{
	$edit_data=$_REQUEST['e'];
	$edit_data1="select * from manage_post as mp,reg as reg where mp.seller_id=reg.reg_id and post_id='$edit_data'";
	$edit_data2=mysqli_query($conn,$edit_data1);
	$edit_data3=mysqli_fetch_array($edit_data2);
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bidder Information</title>
  
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
							<img src="<?php echo $s2['reg_image'];?>" alt="" class="rounded-circle">
						</div>
						<!-- User Name -->
						<h5 class="text-center"><?php echo $s2['reg_name'];?></h5>

						<p>Joined <?php $date=date_create($s2['reg_entry_date']); 
                                    echo date_format($date," F d,  Y");?></p>
					</div>
					<!-- Dashboard Links -->
					<div class="widget user-dashboard-menu">
						<ul>
							<li>
								<a href="user_profile.php?my_add"><i class="fa fa-user"></i> My Active Post <span><?php echo $mypost2;?></span></a></li>
                                
                            <li>
                                <a href="user_profile.php?pending_app"><i class="fa fa-bolt"></i> Pending Post<span><?php echo $pendpost2;?></span></a>
                            </li>
                                
                            <li><a href="user_profile.php?sold_product"><i class="fa fa-user"></i> Sold Post<span><?php echo $soldpost2;?></span></a></li>

							<li>
								<a href="user_profile.php?my_bid"><i class="fa fa-user"></i> My Bid<span><?php echo $mybid2;?></span></a></li>

							<li>
								<a href="user_profile.php?my_fav"><i class="fa fa-bookmark-o"></i> Favourite Post <span><?php echo $favapp2;?></span></a>
							</li>
							
							<li>
								<a href="logout.php"><i class="fa fa-cog"></i> Logout</a>
							</li>
							<li>
								<a href="delete_account.php"><i class="fa fa-power-off"></i>Delete Account</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
			<?php 
			if(isset($_REQUEST['my_add']))
			{
			?>
			<div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">My Ads</h3>
					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
                                <th>SR.No.</th>
								<th>Image</th>
								<th>Product Title</th>
								<th class="text-center">Category</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							if(mysqli_num_rows($my_add2)>0)
							{   $i=1;
							while($my_add3=mysqli_fetch_array($my_add2))
							{
							    $post_id=$my_add3['post_id'];
                              $my_add_bid="select * from manage_bidding where post_id='$post_id'";
                                $my_add_bid2=mysqli_query($conn,$my_add_bid);
                                $my_add_bid3=mysqli_num_rows($my_add_bid2);
							?>
							<tr>
							    <td class="product-thumb">
                                    <?php echo $i;$i++;?>
                                </td>
								<td class="product-thumb">
									<a href="user_profile.php?my_add_session=<?php echo $my_add3['post_id'];?>"><img  width="80px" height="80px" src="<?php echo $my_add3['post_logo'];?>" alt="image description"></td></a>
								
                                <td class="product-details">
									<h3 class="title"><a href="user_profile.php?my_add_session=<?php echo $my_add3['post_id'];?>"><?php echo $my_add3['post_title'];?></a></h3>
									<span><strong>Posted on: </strong><time><?php  $date=date_create($my_add3['post_entry_date']);
									echo date_format($date,"F d ,Y");
									?>
									</time> </span>
                                    
                                    <span><strong>Total Bid: </strong><time><?php  echo $my_add_bid3;
                                    ?>
                                    </time> </span>
									
									
								</td>
								<td class="product-category"><span class="categories"><?php echo $my_add3['cat_name']?></span></td>
								<td class="action" data-title="Action">
									<div class="">
										<ul class="list-inline justify-content-center">
											
											
											<li class="list-inline-item">
												<a  href="user_profile.php?delete=<?php echo $my_add3['post_id'];?>&&my_add">
													<img src="admin\images\icon\delete.png" style="hieght:30px;width:30px;">
												</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
							<?php } }
							else
							{
							?>
							<tr><td colspan="5"><h2><center>No Post Available</center></h2></td></tr>
							<?php 
							}
							?>
							
							
						</tbody>
					</table>
					
				</div>
			<?php	
			}
			else if(isset($_REQUEST['my_bid']))
			{
			?>
			<div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">My Bid</h3>
					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
                                <th>SR.No.</th>
								<th>Post Image</th>
                                <th></th> 
                                <th>Post Title</th>
                                <th></th>
								<th>Post Description</th>
                                <th>Post Amount</th>
                                <th>Total Bid</th>
								<th>View More</th>
								
								
							</tr>
						</thead>
						<tbody>
						<?php
							if(mysqli_num_rows($my_bid2)>0)
							{     $i=1;
							while($my_bid3=mysqli_fetch_array($my_bid2))
							{
                                 $bid=$my_bid3['post_id'];
                                 
                                 $my_bid_post="select * from manage_post where post_id=$bid";
                                 $my_bid_post2=mysqli_query($conn,$my_bid_post);
                                     
                                 while($my_bid_post3=mysqli_fetch_array($my_bid_post2))
                                 {
                                     $bid_no=mysqli_query($conn,"select * from manage_bidding where post_id='$bid' and bidder_id='$id'");
                                     
                                     

                                ?>
							<tr>
								<td class="product-thumb">
                                    <?php echo $i;$i++;?>
                                </td>
								<td class="product-thumb"><a style="color: blue;" href="user_profile.php?my_bid_session=<?php echo $my_bid_post3['post_id'];?>">
									<img width="80px" height="auto" src="<?php echo $my_bid_post3['post_image']?>" alt="image not avilable">
                                    </a>
                                </td>
                                  <td></td>
                                 <td class="product-thumb"><?php echo $my_bid_post3['post_title'];?></td>                                      <td></td>
                                 <td class="product-thumb"><?php echo substr($my_bid_post3['post_details'],0,30);?><br><a style="color: blue;" href="single_post.php?post_id=<?php echo $my_bid_post3['post_id'];?>">See More</a></td>                                
                                 <td class="product-thumb"><?php echo $my_bid_post3['product_price'];?></td>                                
                                 <td class="product-thumb"><a style="font-size: 18px" href="user_profile.php?my_bid_session=<?php echo $my_bid_post3['post_id'];?>"><?php echo mysqli_num_rows($bid_no);?></a></td>                                
                                 <td class="product-thumb"><a style="color: blue;" href="user_profile.php?my_bid_session=<?php echo $my_bid_post3['post_id'];?>">View More</a></td>								
								
							</tr>
							<?php }}
                                
                            
                            }
							else
							{
							?>
							<tr><td colspan="7"><h2><center>No Bid For Any Post</center> </h2></td></tr>
							<?php 	
							}
							?>
						</tbody>
					</table>
					
				</div>
			<?php 
			}
            else if(isset($_REQUEST['my_bid_more']))
            {
            ?>
			
			
            <form method="post">
					<span class="widget-header"><b>My Bid </b></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    
                    <span><b>Post Title </b>: <?php echo $bid_post3['post_title']; ?></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <spna><b>Post Price </b>: <?php echo $bid_post3['product_price'];?></spna>
                    
                    
                    
					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
                                <th class="text-center">SR.No.</th>
                                <th class="text-center">Bidding Amount</th>
								<th class="text-center">Bidder Message</th>
								<th class="text-center">Bidding Date</th>
								<th class="text-center">Status</th>
							</tr>
						</thead>
						<tbody>
						<?php

							$i=1;
							while($bid_bid_data3=mysqli_fetch_array($bid_bid_data2))
							{
							?>
							<tr>
                                <td><?php echo $i; $i++?></td>
								<td class="product-details">
									<?php echo $bid_bid_data3['bidding_amount'];?>
								</td>

                                <td class="product-details">
                                    <?php echo $bid_bid_data3['bidding_message'];?>
                                </td>
                                
								<td class="product-category"><span class="categories"><?php  
                                $date=date_create($bid_bid_data3['bidding_entry_date']);
								echo date_format($date,"F d, Y ")?></span></td>

                                <td class="product-details">
                                    <?php echo $bid_bid_data3['bidding_status'];?>
                
                                </td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					</form>
           

		   <?php 
            }
            
			else if(isset($_REQUEST['sold_product']))
			{
			?>
			<div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">Sold Product</h3>
					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
                                <th>SR.No.</th>
								<th>Image</th>
								<th>Title</th>
								<th>Date</th>
								<th>Buyer Name</th>
								<th class="text-center">Amount</th>
								
								
							</tr>
						</thead>
						<tbody>
						<?php 
						if(mysqli_num_rows($sold_product2)>0)
						{    $i=1;
							while($sold_product3=mysqli_fetch_array($sold_product2))
							{
								
							?>
							<tr>
							    <td>
                                    <?php echo $i;$i++;?>
                                </td>
								<td class="product-thumb">
									<img width="80px" height="auto" src="<?php echo $sold_product3['post_logo'];?>" alt="image description"></td>
								<td class="product-details">
									<h3 class="title"><?php echo $sold_product3['post_title'];?></h3></td>
									<td>
									<?php  $date=date_create($sold_product3['sold_entry_date']);
									echo date_format($date,"F d, Y");
									?>
									
									
									</td>
                                    
                                    <td class="product-category"><span class="categories"><?php echo $sold_product3['reg_name'];?></span></td>
                                    
								<td class="product-category"><span class="categories"><?php echo $sold_product3['bidding_amount'];?></span></td>
								
							</tr>
						<?php } }
						else
						{
						?>
						<tr>
							<td colspan="6"><h2><center>No Sold Post</center></h2></td>
						</tr>
						<?php 
						}
						?>
						</tbody>
					</table>
					
				</div>
			<?php 
			}
			else if(isset($_REQUEST['pending_app']))
			{
			?>
			<div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">Pending Ads</h3>
					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
                                <th>SR.No.</th>
								<th>Image</th>
								<th>Title</th>
								<th>Amount</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							if(mysqli_num_rows($pending_app2)>0)
							{    $i=1;
							while($pending_app3=mysqli_fetch_array($pending_app2))
							{
								
							?>
							<tr>
					            <td>
                                    <?php echo $i;$i++;?>
                                </td>
								<td class="product-thumb">
									<img width="80px" height="auto" src="<?php echo $pending_app3['post_logo'];?>" style="hieght:100px;width:100px; border-radius:10px;" alt="image description"></td>
								<td class="product-details">
									<h3 class="title"><?php echo $pending_app3['post_title'];?></h3></td>
									
								<td class="product-category"><span class="categories"><?php echo $pending_app3['product_price'];?></span></td>
								<td>
									<?php  $date=date_create($pending_app3['post_entry_date']);
									echo date_format($date,"F d, Y");
									?>
								</td>
								<td>
									<ul class="list-inline justify-content-center">
                                    <li class="list-inline-item">
                                                <a href="post_upload.php?e=<?php echo $pending_app3['post_id'];?>">
                                                    <img src="admin\images\icon\edit.png" style="hieght:30px;width:30px;">
                                                </a>        
                                    </li>
									<li class="list-inline-item">
												<a class="delete" href="user_profile.php?delete=<?php echo $pending_app3['post_id'];?>&&pending_app">
													<img src="admin\images\icon\delete.png" style="hieght:30px;width:30px;">
												</a>
											</li>
									
									</ul>
								</td>
							</tr>
							<?php }} 
							else
							{
							?>
							<tr><td colspan="6"><h2><center>No Pending Post</center></h2></td></tr>
							<?php
							}
							?>
						</tbody>
					</table>
					
				</div>
			
            <?php 
            }
            else if(isset($_REQUEST['my_fav']))
            {
            ?>
            <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Favourite Post</h3>
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th>SR.No.</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            if(mysqli_num_rows($fav_app2)>0)
                            {    $i=1;
                            while($fav_app3=mysqli_fetch_array($fav_app2))
                            {
                                
                            ?>
                            <tr>
                                <td>
                                    <?php echo $i;$i++;?>
                                </td>
                                <td class="product-thumb">
                                    <img width="80px" height="auto" src="<?php echo $fav_app3['post_logo'];?>" style="hieght:100px;width:100px; border-radius:10px;" alt="image description"></td>
                                <td class="product-details">
                                    <h3 class="title"><?php echo $fav_app3['post_title'];?></h3></td>
                                    
                                <td class="product-category"><span class="categories"><?php echo $fav_app3['product_price'];?></span></td>
                                <td>
                                    <?php  $date=date_create($fav_app3['wish_entry_date']);
                                    echo date_format($date,"F d, Y");
                                    ?>
                                </td>
                                <td>
                                    <ul class="list-inline justify-content-center">
                                    
                                        <li class="list-inline-item">
                                                <a class="delete" href="user_profile.php?delete=<?php echo $fav_app3['wish_id'];?>&&fav_app">
                                                    <img src="admin\images\icon\delete.png" style="hieght:30px;width:30px;">
                                                </a>
                                            </li>
                                    
                                    </ul>
                                </td>
                            </tr>
                            <?php }} 
                            else
                            {
                            ?>
                            <tr><td colspan="6"><h2><center>No Favourite Post</center></h2></td></tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    
                </div>
            <?php 
            }
			else if(isset($_REQUEST['notification111']))
			{
			?>
			<div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">Notification Panel</h3>
					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>

  

							</tr>
						</thead>
						<tbody>
						<?php 
							    $i=1;
							while($notification_data3=mysqli_fetch_array($notification_data2))
							{
								
							?>
							<tr>  <td>
                                   <span>
                                        Your Bid on post
                                       <a href="single_post.php?post_id=<?php echo $notification_data3['post_id'];?>"> <span style="font-size: 20px"><b> <?php echo $notification_data3['post_title']; ?></b></span></a> is <span style="font-size: 20px;"><b> <?php echo $notification_data3['bidding_status']; ?></b></span> , Bid Id is <a href="user_profile.php?my_bid_session=<?php echo $notification_data3['post_id']; ?>"><span style="font-size: 20px"><b>  <?php echo $notification_data3['bidding_id']; ?></b></span></a>
                                   </span> 
                                </td>
								
							</tr>
							<?php } 
							
							?>
						</tbody>
					</table>
					
				</div>
			
            <?php 
            }
            else
            {
            ?>
            
				<!-- Edit Personal Info -->
				<div class="widget personal-info">
					<h3 class="widget-header user">Bidder Information</h3>
						<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
								<th>Name</th>
								<th>State</th>
								<th>City</th>
								<th>Area</th>
                                <th>Address</th>
                                <th>Total Post</th>
                                <?php if($bidding_status4>0){?>
                                
                                <th>Mobile No</th>
								<th>Email</th>
                                <?php }?>

							</tr>
						</thead>
						<tbody>
						
							<tr> 
                                <td><?php echo $b2['reg_name'];?></td>
                                <td><?php echo $b2['state_name'];?></td>
                                <td><?php echo $b2['city_name'];?></td>
                                <td><?php echo $b2['area_name'];?></td>
                                <td><?php echo $b2['reg_address'];?></td>
                                <td><?php echo $total_post3; ?></td>
                                
                                <?php if($bidding_status4>0){?>
                                
                                <td><?php echo $b2['reg_mobile']; ?></td>
								<td><?php echo $b2['reg_email']; ?></td>
                                <?php }?>
								
							</tr>
						
						</tbody>
					</table>
					
					
				</div>
				<!-- Change Password -->
				
				<!-- Change Email Address -->
				
			</div>
			<?php } ?>
		</div>
	</div>
</section>

<!--============================
=            Footer            =
=============================-->
<?php include("footer1.php");?>
<!-- Footer Bottom -->
<?php include("footer2.php");?>
  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
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
  <script type="text/javascript" src="js/jqv.js"></script>
  <Script type="text/javascript">
	$(document).ready(function(){
		$("#frm1").validate({
			rules:{
				name:{
						required:true,
				},
				file:{
					required:true,
				},
				mobile:{
					required:true,
					number:true,
				},
				state:{
					required:true,
				},
				city:{
					required:true,
				},
				area:{
					required:true,
				},
				area_code:{
					required:true,
				},
				address:{
					required:true,
				},
				dob:{
					required:true,
				}
			},
			messages:{
				name:{
						required:"ENTER YOUR NAME",
				},
				file:{
					required:"CHOOSE PHOTO",
				},
				mobile:{
					required:"ENTER MOBILE NO",
					number:"ENTER ONLY NUMBERS",
				},
				state:{
					required:"SELECT STATE",
				},
				city:{
					required:"SELECT CITY",
				},
				area:{
					required:"SELECT AREA",
				},
				area_code:{
					required:"CHECK ARAE CODE",
				},
				address:{
					required:"ENTER ADDRESS",
				},
				dob:{
					required:"SELECT DATE OF BIRTH",
				}
			},
		});
	});
  </script>
  <Script type="text/javascript">
	$(document).ready(function(){
		$("#frm2").validate({
			rules:{
				current_password:{
					required:true,
                    equalTo:"#password_hidden",
				},
				new_password:{
					required:true,
                    minlength:6,
                    maxlength:12,
				},
				confirm_password:{
					required:true,
                    minlength:6,
                    maxlength:12,
					equalTo:"#new_password",
				},
			},
			messages:{
				current_password:{
					required:"ENTER CURRENT PASSWORD",
                    equalTo:"CURRENT PASSWORD IS WRONG",
				},
				new_password:{
					required:"ENTER NEW PASSWORD",
                    minlength:"PASSWORD MUST HAVE AT LEAST 6 CHARCTARS",
                    maxlength:"PASSWORD NOT HAVE MORE THEN 12 CHARCTARS",
				},
				confirm_password:{
					required:"ENTER CONFIRM PASSWORD",
                    minlength:"PASSWORD MUST HAVE AT LEAST 6 CHARCTARS",
                    maxlength:"PASSWORD NOT HAVE MORE THEN 12 CHARCTARS",
					equalTo:"ENTER SAME AS NEW PASSWORD",
				},
			},
		});
	});
  </script>
  <Script type="text/javascript">
	$(document).ready(function(){
		$("#frm3").validate({
			rules:{
				current_email:{
					required:true,
                    email:true,
                    equalTo:"#email_hidden",
				},
				new_email:{
					required:true,
                    email:true,
				},
                current_password:{
                    required:true,
                    equalTo:"#password_hidden",
                },
                
			},
			messages:{
				current_email:{
					required:"ENTER CURRENT EMAIL",
                    email:"ENTER VALID EMAIL",
                    equalTo:"CURRENT EMAIL IS WRONG",
				},
				new_email:{
					required:"ENTER NEW EMAIL",
                    email:"ENTER VALID EMAIL",
				},
                current_password:{
                    required:"ENTER CURRENT PASSWORD",
                    equalTo:"CURRENT PASSWORD IS WRONG",
                },
			},
		});
	});
  </script>
  <style>
	label.error{
		
		color:red;
	}
	input.error{
		color:red;
	}
	input.valid{
		color:green;
  </style>
  <script type="text/javascript">
	function getcity(obj1)
	{
		//alert(obj1);
		if(window.XMLHttpRequest)
		{
			a=new XMLHttpRequest();
		}
		a.onreadystatechange=function()
		{
			if(a.readyState==4)
			{
				document.getElementById("city").innerHTML=a.responseText;
			}
		}
		a.open("GET","backend.php?state_id="+obj1,true);
		a.send();
	}
	function getarea(obj2)
	{
		//alert(obj1);
		if(window.XMLHttpRequest)
		{
			a=new XMLHttpRequest();
		}
		a.onreadystatechange=function()
		{
			if(a.readyState==4)
			{
				document.getElementById("area").innerHTML=a.responseText;
			}
		}
		a.open("GET","backend.php?city_id="+obj2,true);
		a.send();
	}
	
</script>
<script>
	function getpin(obb)
	{
	//	alert(obb);
		//var x;
		if(window.XMLHttpRequest)
		{
			x=new XMLHttpRequest();
		}
		x.onreadystatechange=function()
		{
			if(x.readyState==4)
			{
				document.getElementById('pinc').innerHTML=x.responseText;
			}
		}
		x.open("GET","backend.php?area_id="+obb,true);
		x.send();
		
	}
</script>
</body>

</html>