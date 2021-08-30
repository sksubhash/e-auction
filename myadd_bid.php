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
$state="select * from state";
$state1=mysqli_query($conn,$state);

$area="select * from area";
$area1=mysqli_query($conn,$area);


	
	
	

if(isset($_REQUEST['bidding_id']) and isset($_REQUEST['post_id']))
{
    $bidding_id=$_REQUEST['bidding_id'];
	$post_id=$_REQUEST['post_id'];
    $update_bid="update manage_bidding set bidding_status='Accept' where bidding_id='$bidding_id'";
    $update_bid01="update manage_bidding set bidding_status='Decline' where bidding_id!='$bidding_id' and post_id='$post_id'";
    $update_bid001="update manage_bidding set bidding_notification='Unseen' where post_id='$post_id'";
    $update_bid1=mysqli_query($conn,$update_bid);
    $update_bid02=mysqli_query($conn,$update_bid01);  
    $update_bid002=mysqli_query($conn,$update_bid001);  

    
    $sold_bidding_data="select * from manage_bidding where bidding_id='$bidding_id'";
    $sold_bidding_data1=mysqli_query($conn,$sold_bidding_data);
    $sold_bidding_data2=mysqli_fetch_array($sold_bidding_data1);
    $bidder_id=$sold_bidding_data2['bidder_id'];
    $post_id=$sold_bidding_data2['post_id'];
    date_default_timezone_set('Asia/Calcutta');
    $date=date('Y-m-d h:i:s');
    
    $sold_product_insert="insert into sold_product(bidding_id,bidder_id,post_id,sold_entry_date) values('$bidding_id','$bidder_id','$post_id','$date')";
    mysqli_query($conn,$sold_product_insert) or die(mysqli_error($conn));
    
    header("location:myadd_bid.php");

    
}else{
    
    $post_id=$_SESSION['ADD_POST_ID'];
    $post_detail="select * from manage_post where post_id='$post_id'";
    $post_detail1=mysqli_query($conn,$post_detail);
    $post_detail2=mysqli_fetch_array($post_detail1);
    
    $post_data="select * from manage_bidding as mb,manage_post as mp,reg as reg where  mb.post_id=mp.post_id and mb.bidder_id=reg.reg_id and reg.reg_account_status='Active' and mb.post_id='$post_id'";
    $post_data1=mysqli_query($conn,$post_data) or die(mysqli_error($conn));
    
}
if(isset($_REQUEST['bidder_data_session'])){
    $_SESSION['BIDDER_DATA_ID']=$_REQUEST['bidder_data_session'];
    $_SESSION['BIDDING_DATA_ID']=$_REQUEST['bidding_data_session'];
    
    header("location:bidder_data.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile</title>
  
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
                                    echo date_format($date," F d , Y");?></p>
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
			<div class="product-item bg-light">
	<div class="card">
		<div class="thumb-content">
			<!-- <div class="price">$200</div> -->
			<br><center><a href="">
				<img src="<?php echo $post_detail2['post_logo'];?>" style="hieght:300px;width:300px; border-radius:50px;">
			</a></center>
		</div>
		<div class="card-body">
		
		<br><center><h4 class="card-title"><a href=""><?php echo $post_detail2['post_title'];?></a></h4><center><br>
		
			Post Price:<h4 class="card-title"><a href=""><?php echo $post_detail2['product_price'];?></a></h4>
		    <ul class="list-inline product-meta">
		    	<li class="list-inline-item">
		    		<a href=""><i class="fa fa-folder-open-o"></i>Electronics</a>
		    	</li>
		    	<li class="list-inline-item">
					<a href=""><i class="fa fa-calendar"></i><?php  $date=date_create($post_detail2['post_entry_date']);echo date_format($date,"F d ,Y");?></a>
		    	</li>
		    </ul>
		    <p class="card-text"><?php echo $post_datail2['post_details'];?></p>
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
	<br><br>
                    <form method="post">
					<h3 class="widget-header">Post Bids</h3>
					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
                                <th class="text-center">Action</th>
								<th class="text-center">Bidder Name</th>
								<th class="text-center">Bidding Amount</th>
								<th class="text-center">Bidding Date</th>
								<th class="text-center">Status</th>
							</tr>
						</thead>
						<tbody>
						<?php

							
							while($post_data2=mysqli_fetch_array($post_data1))
							{
							?>
							<tr>
                                <td class="action" data-title="Action">
                                    <?php 
                                    if($post_data2['bidding_status']=='Pending')
                                    {
                                    ?>
                                        <a href="myadd_bid.php?post_id=<?php echo $post_id;?>&&bidding_id=<?php echo $post_data2['bidding_id'];?>" class="btn btn-transparent">Accept</a>
                                        <?php 
                                    }
                                    else if($post_data2['bidding_status']=='Accept')
                                    {
                                        ?>
                                      <input type="button" class="btn btn-success" value="Accepted" disabled="">
                                        
                                        <?php
                                    }
                                    else if($post_data2['bidding_status']=='Decline')
                                    {
                                        ?>
                                      <input type="button" class="btn btn-danger" value="Declined" disabled="">  
                                        <?php
                                    }
                                        ?>
                                </td>
								
								<td class="product-thumb">
									<a href="myadd_bid.php?bidder_data_session=<?php echo $post_data2['reg_id']; ?>&&bidding_data_session=<?php echo $post_data2['bidding_id'];?>"><?php echo $post_data2['reg_name'];?></a>
									</td> 
								<td class="product-details">
									<?php echo $post_data2['bidding_amount'];?>
				
								</td>
								<td class="product-category"><span class="categories"><?php  
                                $date=date_create($post_data2['bidding_entry_date']);
								echo date_format($date,"F d,Y ")?></span></td>
                                <td class="product-details">
                                    <?php echo $post_data2['bidding_status'];?>
                
                                </td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					</form>
			</div>
			
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
  <script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
  <script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="plugins/smoothscroll/SmoothScroll.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
  <script src="js/scripts.js"></script>
  <script type="text/javascript" src="js/jqv.js"></script>

</body>

</html>
