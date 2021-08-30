<?php
ob_start();
session_start();
include_once("connection.php");
if($_SESSION['ID']==""){
    header("location:../index.php");
}
    $aaa111=$_SESSION['ID']; 
    $sss111="select * from reg where reg_id='$aaa111'";
    $sss222=mysqli_query($conn,$sss111);
    $row121212=mysqli_fetch_array($sss222);

	$unseen_data="select * from manage_post where post_notification_status='Unseen'";
    $unseen_data1=mysqli_query($conn,$unseen_data);
    $unseen_data2=mysqli_num_rows($unseen_data1);

	
?>


<div id="screensaver">
	<canvas id="canvas"></canvas>
	<i class="fa fa-lock" id="screen_unlock"></i>
</div>
<div id="modalbox">
	<div class="devoops-modal">
		<div class="devoops-modal-header">
			<div class="modal-header-name">
				<span>Basic Table</span>
			</div>
			<div class="box-icons">
				<a class="close-link">
					<i class="fa fa-times"></i>
				</a>
			</div>
		</div>
		<div class="devoops-modal-inner">
		</div>
		<div class="devoops-modal-bottom">
		</div>
	</div>
</div>
<header class="navbar">
	<div class="container-fluid expanded-panel">
		<div class="row">
			<div id="logo" class="col-xs-12 col-sm-2">
				<a href="home.php">E Auction</a>
			</div>
			<div id="top-panel" class="col-xs-12 col-sm-10">
				<div class="row">
					<div class="col-xs-8 col-sm-4">
						<a href="#" class="show-sidebar">
						  <i class="fa fa-bars"></i>
						</a>
						<div id="search">
                            <img src="images/logo/eauction.png" height="100%" alt="">
                        </div>
					</div>
					<div class="col-xs-4 col-sm-8 top-panel-right">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <span style="font-size:25"><b>Welcome <?php  echo $_SESSION['TYPE']; ?></b></span>
                    
						<ul class="nav navbar-nav pull-right panel-menu">

							<li class="dropdown">
								<a href="#" class="dropdown-toggle account" data-toggle="dropdown">
									<div class="avatar">
										<img src="<?php echo $row121212['reg_image'];?>" class="img-rounded" alt="avatar" />
									</div>
									<i class="fa fa-angle-down pull-right"></i>
									<div class="user-mini pull-right">
									    <span class="welcome">Hiii...</span>
                                        
										<span><?php echo $row121212['reg_name'];?></span>
									</div>                     
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="profile.php">
											<i class="fa fa-user"></i>
											<span class="hidden-sm text">Profile</span>
										</a>
									</li>
									
									<li>
										<a href="manage_post.php">
											<i class="fa fa-envelope"></i>
											<span class="hidden-sm text"><span style="font-size:15px"><b>New Post </b></span> &nbsp;<span style="color:yellow; font-size:15px;width:500px;"><?php if($unseen_data2>0){?>(<?php echo $unseen_data2;?>)<?php }?></span>
										</a>
									</li>
									<li>
										<a href="logout.php">
											<i class="fa fa-power-off"></i>
											<span class="hidden-sm text">Logout</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!--End Header-->
