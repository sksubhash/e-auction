<?php 
include("connection.php");
include("header.php");
 date_default_timezone_set('Asia/Calcutta');
 $date=date('Y-m-d h:i:s');
 
$post_id=$_REQUEST['post_id'];

$post_data="select * from manage_post where post_id='$post_id'";
$post_data1=mysqli_query($conn,$post_data);
$post_data2=mysqli_fetch_array($post_data1);


$subcat_id=$post_data2['subcat_id']; 
$cat_id=$post_data2['cat_id'];

$cat_data="select * from category where cat_id='$cat_id'";
$cat_data1=mysqli_query($conn,$cat_data);
$cat_data2=mysqli_fetch_array($cat_data1);


$subcat_data="select * from subcategory where cat_id='$cat_id'";
$subcat_data1=mysqli_query($conn,$subcat_data);

$cat="select * from category";
$cat1=mysqli_query($conn,$cat);

$reg_id=$post_data2['seller_id'];
$seller_data="select * from reg where reg_id='$reg_id'";
$seller_data1=mysqli_query($conn,$seller_data);
$seller_data2=mysqli_fetch_array($seller_data1);

$post_price=$post_data2['product_price'];
$less_amount=($post_price*10)/100;
$min_amount=$post_price-$less_amount;

$bidder_id=$_SESSION['ID'];

if(isset($_REQUEST['bid_now'])){
    $bidder_id=$_SESSION['ID'];
    if($bidder_id=="")
    {    ?>
        <script>
            alert("Please Login First..!!");
            window.location="login.php";
        </script>
        <?php
        
    }else{
	
	$bid_amount=$_REQUEST['bid_amount'];
    $bid_message=$_REQUEST['bid_message'];
        if($bid_amount<$min_amount){

            ?>
            <script>
                alert("The bid amount cant be less than <?php echo $min_amount;?> ₹");
            </script>
            
            
         <?php   
        }else{
    $add_bid="insert into manage_bidding(post_id,bidder_id,bidding_amount,bidding_message,bidding_entry_date) values('$post_id','$bidder_id','$bid_amount','$bid_message','$date')";
    $add_bid1=mysqli_query($conn,$add_bid);
    header("location:single_post.php?post_id=$post_id");
    
    }}
}
if(isset($_REQUEST['leave_comment'])){
     $bidder_id=$_SESSION['ID'];
     $post_title=$post_data2['post_title'];
      if($bidder_id==NULL)
      {
      header("location:login.php");
      }else{
          $comment_message=$_REQUEST['comment_message'];
          $comment_data="insert into manage_review(seller_id,bidder_id,post_id,review_product,review_details,review_entry_date) values('$reg_id','$bidder_id','$post_id','$post_title','$comment_message','$date')" ;
          $comment_data1=mysqli_query($conn,$comment_data);
    header("location:single_post.php?post_id=$post_id");
      }
}

if(isset($_REQUEST['addtofav'])){
        $post_id=$_REQUEST['addtofav'];
        $wisher_id=$bidder_id;
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
            window.location="single_post.php?post_id=<?php echo $post_id;?>";
            
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
  <title>Singal Post</title>
  
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


<!--=================================
=            Single Blog            =
==================================-->


<section class="blog single-blog section">
	<div class="container">
		<div class="row">   
			<div class="col-md-10 offset-md-1 col-lg-9 offset-lg-0">
				<article class="single-post">      
					<h3><?php echo $post_data2['post_title'];?></h3>
					<ul class="list-inline">  
						<li class="list-inline-item">by <a href=""><?php echo $seller_data2['reg_name'];?></a></li>
						<li class="list-inline-item"><?php $date=date_create($post_data2['post_entry_date']); 
                                    echo date_format($date," F d , Y");?></li>
					</ul>
					<center><img src="<?php echo $post_data2['post_logo']?>" alt="article-01" style="height: 400px; width: 400px;"></center>
                    <ul class="list-inline">  
                    <li class="list-inline-item">
                    <i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;<?php echo $cat_data2['cat_name'];?>
                </li>
                
                <?php 
                            $subcatid=$post_data2['subcat_id'];
                            $subcatid1="select * from subcategory where subcat_id='$subcatid'";
                            $subcatid2=mysqli_query($conn,$subcatid1);
                            $subcatid3=mysqli_fetch_array($subcatid2);
                ?>
                <li class="list-inline-item">
                    <i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;<?php echo $subcatid3['subcat_name'];?>
                </li><br>
                    
                    
                    <li class="list-inline-item">
                        <i class="fa fa-bookmark-o"></i>
                    
                         <a style="color: blue; font-size: 13px;"  href="single_post.php?addtofav=<?php echo $post_data2['post_id']; ?>"> Add To Favourite</a>
                      </li>
                </ul>
					<p>
                    <?php echo $post_data2['post_details'];?>
                    
                    </p>
                       
                    <p style="font-size: 30px" class="fa fa-money">&nbsp;&nbsp;<?php echo $post_data2['product_price'];?>&nbsp;&#8377;
                </li></p>
                
					<ul class="social-circle-icons list-inline">
				  		<li class="list-inline-item text-center"><a class="fa fa-facebook" href=""></a></li>
				  		<li class="list-inline-item text-center"><a class="fa fa-twitter" href=""></a></li>
				  		<li class="list-inline-item text-center"><a class="fa fa-google-plus" href=""></a></li>
				  		<li class="list-inline-item text-center"><a class="fa fa-pinterest-p" href=""></a></li>
				  		<li class="list-inline-item text-center"><a class="fa fa-linkedin" href=""></a></li>
				  	</ul>
                    
				</article>
                
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Recently Bid</h3>
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th>S.R </th>
                                <th>Bidder Name</th>
                                <th class="text-center">bid amount</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
                    $bid="select * from manage_bidding as mb, reg as reg where reg.reg_id=mb.bidder_id and  post_id='$post_id'";
                    $bid1=mysqli_query($conn,$bid);
                    if(mysqli_num_rows($bid1)>0)
					{
					while($bid2=mysqli_fetch_array($bid1))
					{
					?>
                            <tr>
                                
                                <td>&nbsp;&nbsp;<?php echo $bid2['bidding_id'];?></td>
                                <td>
                                    <h4 class="title">&nbsp;&nbsp;<?php echo $bid2['reg_name'];?> </td>
                                <td class="product-category"><?php echo $bid2['bidding_amount'];?></td>
                                <td class="action" data-title="Action">
                                    <?php echo $bid2['bidding_status']?>
                                </td>
                            </tr>
					<?php }}
					else
					{
						?>
						<tr><td colspan="4"><center> No Bid for the Post<center></td></tr>
						<?php 
					}?>
                        </tbody>
                    </table>
                    
				</div>
                <?php 
				if($bidder_id!==$reg_id )
				{
				?>
				<div class="block comment">
					<h4>Bid Now</h4>
					<form action="" method="post" id="bid_frm" name="bid_frm">
						<!-- Amount -->
						<div class="form-group mb-30">
						    <label for="message">Amount</label>
						    <input type="text" class="form-control" id="bid_amount" name="bid_amount" rows="8">
						</div>
						
						<!-- Message -->
						<div class="form-group mb-30">
						    <label for="bid_message">Message</label>
                            <textarea class="form-control" id="bid_message" rows="8" name="bid_message" style="height:90px;"></textarea>
						</div>
						<input type="submit" class="btn btn-transparent" value="BID NOW" name="bid_now">
					</form>
				</div>
				
				<div class="block comment">
					<h4>Message For Seller</h4>
					<form action="" method="post" name="comment_frm" id="comment_frm">
						<!-- Message -->
						<div class="form-group mb-30">
						    <label for="message">Message</label>
						    <textarea class="form-control" id="comment_message" name="comment_message" rows="8" style="height:90px;"></textarea>
						</div>
						
						<input type="submit" class="btn btn-transparent" name="leave_comment" value="Send Message">
					</form>
				</div>
				<?php } ?>
			</div>
			<div class="col-md-10 offset-md-1 col-lg-3 offset-lg-0">
				<div class="sidebar">
					<!-- Search Widget -->
					
					<!-- Category Widget -->
					<div class="widget category-list">
						<!-- Widget Header -->
						<h5 class="widget-header">All Category Of <?php echo $cat_data2['cat_name'];?></h5>
						<ul class="category-list">
							<?php
                            while($subcat_data2=mysqli_fetch_array($subcat_data1))
                             { 
								$subcat_id=$subcat_data2['subcat_id'];
								$subcat_id1="select * from manage_post where subcat_id='$subcat_id' and post_status='Accept'";
								$subcat_id2=mysqli_query($conn,$subcat_id1);
								$subcat_id3=mysqli_num_rows($subcat_id2);
						 ?>
                             <li><a href="post_category.php?subcat_id=<?php echo $subcat_data2['subcat_id'];?>&&cat_id=<?php echo $cat_data2['cat_id'];?>"><?php echo $subcat_data2['subcat_name'];?><span><?php echo $subcat_id3?></span></a></li>
                             <?php }?>
						</ul>
					</div>
					<div class="widget category-list">
					<h5 class="widget-header">All Category</h5>
					<ul class="category-list">
						<?php
						while($cat2=mysqli_fetch_array($cat1))
						{ 
						$cat_id=$cat2['cat_id'];
						$cat_id1="select * from manage_post where cat_id='$cat_id' and post_status='Accept'";
						$cat_id2=mysqli_query($conn,$cat_id1);
						$cat_id3=mysqli_num_rows($cat_id2);
					?>
							<li><a href="post_category.php?cat_id=<?php echo $cat2['cat_id'];?>"><?php echo $cat2['cat_name'];?><span><?php echo $cat_id3;?></span></a></li>
						<?php }?>
					</ul>
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
  <script type="text/javascript" src="js/jq.js"></script>
<script type="text/javascript" src="js/jqv.js"></script>
<script type="text/javascript">
     $(document).ready(function(){
        $("#bid_frm").validate({
            
            rules:
            {
                bid_amount:{
                    required:true,
                    number:true,


                },   
            },
            
            messages:
            {
                bid_amount:{
                    required:"AMOUNT IS REQURIED",
                    number:"AMOUNT HAVE ONLY IN NUMBER",
                },  
            }
        });
        
        $("#comment_frm").validate({
            
            rules:
            {
                comment_message:{
                    required:true,
                },   
            },
            
            messages:
            {
                comment_message:{
                    required:"MESSAGE IS REQURIED",
                },  
            }
        });

        
    });
    
</script>
<style>
    label.error{
        color:red;
    }
    input.valid{
        color:green;
    }
</style>


</body>

</html>

