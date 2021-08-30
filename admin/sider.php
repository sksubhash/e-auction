<?php 
include_once("connection.php");
$unseen_data="select * from manage_post where post_notification_status='Unseen'";
$unseen_data1=mysqli_query($conn,$unseen_data);
$unseen_data2=mysqli_num_rows($unseen_data1);

?>

<div id="main" class="container-fluid">
	<div class="row">
		<div id="sidebar-left" class="col-xs-2 col-sm-2">
			<ul class="nav main-menu">
				<li>
                    <a href="home.php" class="dropdown-toggle">
						<i class="fa fa-dashboard"></i>
						<span class="hidden-xs">Dashboard</span>
					</a>
				</li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fa fa-list-ul"></i>
                        <span class="hidden-xs">Manage Category    </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a  href="category.php">Category</a></li>
                        <li><a  href="subcategory.php">Sub Category</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fa fa-map-marker"></i>
                        <span class="hidden-xs">Manage Location</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a  href="state.php">State</a></li>
                        <li><a  href="city.php">City</a></li>
                        <li><a  href="area.php">Area</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="manage_user.php" class="dropdown-toggle">
                        <i class="fa fa-user"></i>
                        <span class="hidden-xs">Manage User    </span>
                    </a>
                    
                </li>
			
				
				<li class="dropdown">
                    <a href="manage_post.php" class="dropdown-toggle">
                        <i class="fa fa-map-marker"></i>
                        <span class="hidden-xs">Manage Post </span>
						<?php 
						if($unseen_data2>0)
						{
						?>
						
						&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:yellow; font-size:15px"><b> New</b></span> &nbsp;<span style="color:yellow; font-size:15px;width:500px;">(<?php echo $unseen_data2;?>)
						
						<?php } ?>
                    </a>
                    
                </li> 
                
                <li class="dropdown">
                    <a href="manage_bidding.php" class="dropdown-toggle">
                        <i class="fa fa-money"></i>
                        <span class="hidden-xs">Manage Bidding   </span>
                    </a>
                    
                </li>
                
                 <li class="dropdown">
                    <a href="manage_sold_product.php" class="dropdown-toggle">
                        <i class="fa fa-map-marker"></i>
                        <span class="hidden-xs">Manage Sold Product    </span>
                    </a>
                    
                </li>
                
                
                <li class="dropdown">
                    <a href="manage_review.php" class="dropdown-toggle">
                        <i class="fa fa-star-half-o"></i>
                        <span class="hidden-xs">Manage Review    </span>
                    </a>
                    
                </li>
                
                <li class="dropdown">
                    <a href="manage_contact.php" class="dropdown-toggle">
                        <i class="fa  fa-mobile"></i>
                        <span class="hidden-xs">Manage Contact    </span>
                    </a>
                    
                </li>
				
				 <li class="dropdown">
                    <a href="manage_wishlist.php" class="dropdown-toggle">
                        <i class="fa fa-star-half-o"></i>
                        <span class="hidden-xs">Manage Wish List    </span>
                    </a>
                    
                </li>
                
                 <?php 
                if($_SESSION['TYPE']=="SuperAdmin"){
                ?>
                
                 <li class="dropdown">
                    <a href="add_admin.php" class="dropdown-toggle">
                        <i class="fa fa-user-md"></i>
                        <span class="hidden-xs">Add Admin    </span>
                    </a>
                    
                </li>
                
                <?php }?>
              
                
                
				<?php 
                if($_SESSION['TYPE']=="SuperAdmin"){
                ?>
                <li class="dropdown">
                    <a href="manage_admin.php" class="dropdown-toggle">
                        <i class="fa fa-user-md"></i>
                        <span class="hidden-xs">Manage Admin    </span>
                    </a>
                    
                </li>
                <?php }?>
                
                 
			
			</ul>
		</div>