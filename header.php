<?php
include("connection.php");
session_start();
error_reporting(0);
    $page_name=$_SERVER['PHP_SELF'];
    $page_name2=$_SERVER['QUERY_STRING'];   
    $page_name3=$page_name."?".$page_name2;

$user_data_header=$_SESSION['ID'];
$user_data_header1="select * from reg where reg_id='$user_data_header'";
$user_data_header2=mysqli_query($conn,$user_data_header1);
$user_data_header3=mysqli_fetch_array($user_data_header2);

$category_data_header1="select * from category";
$category_data_header2=mysqli_query($conn,$category_data_header1);

$mypost="select * from manage_post where seller_id='$user_data_header' and post_status='Accept'" ;
$mypost1=mysqli_query($conn,$mypost)or die(mysqli_error($conn));
$mypost2=mysqli_num_rows($mypost1);

$mybid="select * from manage_bidding where bidder_id='$user_data_header'";
$mybid1=mysqli_query($conn,$mybid);
$mybid2=mysqli_num_rows($mybid1);

$pendpost="select * from manage_post where seller_id='$user_data_header' and post_status='Pending'" ;
$pendpost1=mysqli_query($conn,$pendpost)or die(mysqli_error($conn));
$pendpost2=mysqli_num_rows($pendpost1);

$soldpost="select * from  manage_post as mp,  sold_product as sp where sp.post_id=mp.post_id  and mp.seller_id='$user_data_header'";
    
$soldpost1=mysqli_query($conn,$soldpost);
$soldpost2=mysqli_num_rows($soldpost1);

$favapp="select * from wishlist where wisher_id='$user_data_header'";
$favapp1=mysqli_query($conn,$favapp);
$favapp2=mysqli_num_rows($favapp1);

$notification_seen="select * from manage_bidding where bidder_id='$user_data_header' and bidding_notification='Unseen'";
$notification_seen2=mysqli_query($conn,$notification_seen);
$notification_seen3=mysqli_num_rows($notification_seen2);
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    



  <!-- SmartMenus core CSS (required) -->
<link href="try/sm-core-css.css" rel="stylesheet" type="text/css" />

<!-- "sm-clean" menu theme (optional, you can use your own CSS, too) -->
<link href="try/sm-clean.css" rel="stylesheet" type="text/css" />


    

  </head>

  <body>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg  navigation">
					<a class="navbar-brand" href="index.php" style="height: 51px;">
						<img src="admin/images/logo/eauction.png" height="100%" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul id="main-menu" class="sm sm-clean" 	>
							<li><a <?php if($page_name=="/eauction_system/index.php"){?> class="current"<?php }?> href="index.php">Home</a></li>
							
							
							<li><a style="cursor: pointer;">Category</a>
								<ul>
									<?php while($category_data_header3=mysqli_fetch_array($category_data_header2)){?>
									<li><a href="post_category.php?cat_id=<?php echo $category_data_header3['cat_id'];?>"><?php echo $category_data_header3['cat_name'];?></a>
                                        <ul>
                                        <?php 
                                        $categ_id=$category_data_header3['cat_id'];
                                        $subcategory_data_header1="select * from subcategory where cat_id=$categ_id ";
                                        $subcategory_data_header2=mysqli_query($conn,$subcategory_data_header1);
                                        while($subcategory_data_header3=mysqli_fetch_array($subcategory_data_header2)){
                                        
                                        ?>
                                            <li><a href="post_category.php?subcat_id=<?php echo $subcategory_data_header3['subcat_id'];?>&&cat_id=<?php echo $subcategory_data_header3['cat_id'];?>"><?php echo $subcategory_data_header3['subcat_name'];?></a></li>
                                            
                                            <?php }?>
                                            
                                        </ul>
                                                                        
                                    
                                    </li>
                                    <?php }?>
									
								</ul>
							</li>
							<li><a <?php if($page_name=="/eauction_system/contactus.php"){?> class="current"<?php }?> href="contactus.php">Contact Us</a></li>
							
						</ul>
                        <div id="google_translate_element"></div>
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

                            
                                <!-- Dropdown list -->
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item <?php  if($page_name3=="/eauction_system/user_profile.php?"){?> active <?php }?>" href="user_profile.php"><i class="fa fa-user"> My Profile</i></a>
									<a class="dropdown-item <?php if($page_name3=="/eauction_system/user_profile.php?my_add"){?> active <?php }?>" href="user_profile.php?my_add"><i class="fa fa-user"> My Active Post (<span><?php echo $mypost2;?></span>)</i></a>
                                    
                                    <a class="dropdown-item <?php if($page_name3=="/eauction_system/user_profile.php?pending_app"){?> active <?php }?>" href="user_profile.php?pending_app"><i class="fa fa-bolt"> Pending Post (<span><?php echo $pendpost2;?></span>)</i></a>
                                    
									<a class="dropdown-item <?php if($page_name3=="/eauction_system/user_profile.php?sold_product"){?> active <?php }?>" href="user_profile.php?sold_product"><i class="fa fa-user"> Sold Product (<span><?php echo $soldpost2;?></span>)</i></a>
                                    
                                    <a class="dropdown-item <?php if($page_name3=="/eauction_system/user_profile.php?my_bid"){?> active <?php }?>" href="user_profile.php?my_bid"><i class="fa fa-user"> My Bid (<span><?php echo $mybid2;?></span>)</i></a>
                                    
                                    <a class="dropdown-item <?php if($page_name3=="/eauction_system/user_profile.php?my_fav"){?> active <?php }?>" href="user_profile.php?my_fav"><i class="fa fa-bookmark-o"> Favourite Post (<span><?php echo $favapp2;?></span>)</i> </a>
                                    
                                    
                                    <a class="dropdown-item <?php if($page_name3=="/eauction_system/user_profile.php?notification"){?> active <?php }?>" href="user_profile.php?notification"><i class="fa fa-bell"> Notification</i> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php if($notification_seen3>0){?>
                                    <span style="color:red; font-size:15px"><b> New</b></span> &nbsp;<span style="color:red; font-size:15px;width:500px;">(<?php echo $notification_seen3; ?>)
                                    <?php }?>
                                    </a>
                                    
									<a class="dropdown-item" href="logout.php"><i class="fa fa-cog"> Logout</i></a>
                                </div>
                                
                            </li>&nbsp;<span>Hiii...<br><b><?php echo $user_data_header3['reg_name'];?></b></span>  
							<?php }?>
						</ul>
					</div>
				</nav>
			</div>
		</div>        
	</div>
</section>
 <script type="text/javascript" src="try/jquery.js"></script>

    <!-- SmartMenus jQuery plugin -->
    <script type="text/javascript" src="try/jquery.smartmenus.js"></script>

    <!-- SmartMenus jQuery init -->
    <script type="text/javascript">
    	$(function() {
    		$('#main-menu').smartmenus({
    			subMenusSubOffsetX: 1,
    			subMenusSubOffsetY: -8
    		});
    	});
    </script>
        <script type="text/javascript" src="lan.js"></script>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'bn,de,en,fr,gu,hi,ja,ml,mr,ne,pa,ru,ta,te,zh-CN', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
}
</script>

  </body>
</html>
