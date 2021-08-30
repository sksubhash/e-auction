<?php
include("connection.php");
session_start();
error_reporting(0);
$user_data_header=$_SESSION['ID'];
$user_data_header1="select * from reg where reg_id='$user_data_header'";
$user_data_header2=mysqli_query($conn,$user_data_header1);
$user_data_header3=mysqli_fetch_array($user_data_header2);

$mypost="select * from manage_post where seller_id='$user_data_header' and post_status='Accept'" ;
$mypost1=mysqli_query($conn,$mypost)or die(mysqli_error($conn));
$mypost2=mysqli_num_rows($mypost1);

$mybid="select * from manage_bidding where bidder_id='$user_data_header' and bidding_status='Pending' or bidding_status='Accept'";
$mybid1=mysqli_query($conn,$mybid);
$mybid2=mysqli_num_rows($mybid1);

$pendpost="select * from manage_post where seller_id='$user_data_header' and post_status='Pending'" ;
$pendpost1=mysqli_query($conn,$pendpost)or die(mysqli_error($conn));
$pendpost2=mysqli_num_rows($pendpost1);

$soldpost="select * from  manage_post as mp,  sold_product as sp where sp.post_id=mp.post_id  and mp.seller_id='$user_data_header'";
    
$soldpost1=mysqli_query($conn,$soldpost);
$soldpost2=mysqli_num_rows($soldpost1);
?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg  navigation">
					<a class="navbar-brand" href="index.html">
						<img src="images/logo.png" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							<li class="nav-item active">
								<a class="nav-link" href="index.php">Home</a>
							</li>
							
							<li class="nav-item dropdown dropdown-slide">
								<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Pages <span><i class="fa fa-angle-down"></i></span>
								</a>
								<!-- Dropdown list -->
								<div class="dropdown-menu dropdown-menu-right">
									
									<a class="dropdown-item" href="user_profile.php">User Profile</a>
									<a class="dropdown-item" href="submit-coupon.html">Submit Coupon</a>
									<a class="dropdown-item" href="blog.html">Blog</a>
									<a class="dropdown-item" href="single-blog.html">Single Post</a>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-slide">
								<a class="nav-link dropdown-toggle" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Listing <span><i class="fa fa-angle-down"></i></span>
								</a>
								<!-- Dropdown list -->
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Another action</a>
									<a class="dropdown-item" href="#">Something else here</a>
								</div>
							</li>
							
							<li class="nav-item active">
								<a class="nav-link" href="contactus.php">Contact Us</a>
							</li>
						</ul>
						<ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item">
							    <?php if($_SESSION['ID']==""){?>
								<a class="nav-link login-button" href="login.php">Login</a>
                                <?php }?>
								
								
							</li>
							<li class="nav-item">
								<a class="nav-link add-button" href="post_upload.php"><i class="fa fa-plus-circle"></i> Add Listing</a>
							</li>
                            
                             <?php if($_SESSION['ID']!=""){?>
                             &nbsp;&nbsp;&nbsp;
                            <li class="nav-item dropdown dropdown-slide">
                                 <a href="#"><img style="margin-top: -6px" class="rounded-circle" height="57px" width="57px" src="<?php echo $user_data_header3['reg_image'];?>"></img></a>

                            <?php }?>

                                <!-- Dropdown list -->
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="user_profile.php"><i class="fa fa-user"> My Profile</i></a>
									<a class="dropdown-item" href="user_profile.php?my_add=<?php echo $user_data_header;?>"><i class="fa fa-user"> My Post (<span><?php echo $mypost2;?></span>)</i></a>
                                    <a class="dropdown-item" href="user_profile.php?my_bid=<?php echo $user_data_header;?>"><i class="fa fa-user"> My Bid(<span><?php echo $mybid2;?></span>)</i></a>
                                     <a class="dropdown-item" href="user_profile.php?pending_app=<?php echo $user_data_header;?>"><i class="fa fa-bolt"> Pending Post(<span><?php echo $pendpost2;?></span>)</i></a>
									<a class="dropdown-item" href="user_profile.php?"><i class="fa fa-user"> Sold Product(<span><?php echo $soldpost2;?></span>)</i></a>
									<a class="dropdown-item" href="logout.php"><i class="fa fa-cog"> Logout</i></a>
                                </div>
                                
                            </li>  
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>