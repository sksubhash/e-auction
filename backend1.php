<?php 
error_reporting(0);
include("connection.php");
$a=$_REQUEST['subcat'];

	
if(isset($_REQUEST['lowhigh']) and isset($_REQUEST['cat']) and $a=='undefined')
{
	$cat_id=$_REQUEST['cat'];
	$ord=$_REQUEST['lowhigh'];
	
	$post_dataa="select * from manage_post as mp,category as c,subcategory as sc where mp.cat_id=c.cat_id and mp.subcat_id=sc.subcat_id and mp.cat_id='$cat_id' and mp.post_status='Accept' order by mp.product_price $ord";
    $post_dataa1=mysqli_query($conn,$post_dataa) or die(mysqli_error($conn));
	
}
else if($_REQUEST['lowhigh'] and $_REQUEST['cat'] and $_REQUEST['subcat'])
{
	
	$cat_id=$_REQUEST['cat'];
	 $subcat_id=$_REQUEST['subcat'];
	$ord=$_REQUEST['lowhigh'];
	
	$post_dataa="select * from manage_post as mp, category as c, subcategory as sc where mp.cat_id=c.cat_id and mp.subcat_id=sc.subcat_id and mp.subcat_id='$subcat_id' and mp.post_status='Accept' order by mp.product_price $ord ";
    $post_dataa1=mysqli_query($conn,$post_dataa)or die(mysqli_error($conn));
	
}
else if($_REQUEST['lowhigh'] and $_REQUEST['g'])
{
	$ord=$_REQUEST['lowhigh'];
	
	$post_dataa="select * from manage_post as mp, category as c, subcategory as sc where mp.cat_id=c.cat_id and mp.subcat_id=sc.subcat_id and  mp.post_type='Gold' and mp.post_status='Accept' order by mp.product_price $ord ";
    $post_dataa1=mysqli_query($conn,$post_dataa)or die(mysqli_error($conn));
	
}
else
{
	$cat_id=$_REQUEST['cat'];
	echo $post_dataa="select * from manage_post as mp,category as c,subcategory as sc where mp.cat_id=c.cat_id and mp.subcat_id=sc.subcat_id and mp.cat_id='$cat_id' and mp.post_status='Accept' ";
    $post_dataa1=mysqli_query($conn,$post_dataa) or die(mysqli_error($conn));
}
?>
<div class="product-grid-list" id="priceset">
						<div class="row mt-30" >
					<?php 	
						while($post_data2=mysqli_fetch_array($post_dataa1))
						{
                            $subcatid=$post_data2['subcat_id'];
                            $subcatid1="select * from subcategory where subcat_id='$subcatid'";
                            $subcatid2=mysqli_query($conn,$subcatid1);
                            $subcatid3=mysqli_fetch_array($subcatid2);
						?>	
						
						<div class="col-sm-12 col-lg-4 col-md-6" >
							<!-- product card -->
<div class="product-item bg-light" style=" min-height: 430px;">
	<div class="card" style=" min-height: 430px;">
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
		    		<i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;<?php echo $post_data2['cat_name'];?>
		    	</li>
                <li class="list-inline-item">
                    <i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;<?php echo $post_data2['subcat_name'];?>
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
		    
		</div>
	</div>
</div>
</div>
<?php } ?>

</div>
</div>
				
				
				


