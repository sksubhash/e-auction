<?php
include("connection.php");
error_reporting(0);
if($_REQUEST['cat_id'])
{
	$cat_id=$_REQUEST['cat_id'];
	$s_scate="select * from subcategory where cat_id='$cat_id'";
	$s_scate1=mysqli_query($conn,$s_scate);
?>
<option value="">Select Subcategory</option>
 
<?php
			while($s_scate2=mysqli_fetch_array($s_scate1))
			{								
			?>
			<option value="<?php echo $s_scate2['subcat_id'];?>"><?php echo $s_scate2['subcat_name'];?></option>
			<?php
			}
}
if($_REQUEST['state_id'])
{
	$state_id=$_REQUEST['state_id'];
	$city="select * from city where state_id='$state_id' and city_status='Active'";
	$city1=mysqli_query($conn,$city);
?>
<option value="">Select City</option>
<?php
	while($city2=mysqli_fetch_array($city1))
	{
	?>
    <option value="<?php echo $city2['city_id'];?>"><?php echo $city2['city_name'];?></option>
	<?php
	}
}
if($_REQUEST['city_id'])
{
	$city_id=$_REQUEST['city_id'];
	$area="select * from area where city_id='$city_id' and area_status='Active'";
	$area1=mysqli_query($conn,$area);
?>
<option value="">Select Area</option>
<?php
	while($area2=mysqli_fetch_array($area1))
	{
	?>
    <option value="<?php echo $area2['area_id'];?>"><?php echo $area2['area_name'];?></option>
	<?php
	}
}
if($_REQUEST['area_id'])
{
	$area_id=$_REQUEST['area_id'];
	$pincode="select * from area where area_id='$area_id'";
	$pincode1=mysqli_query($conn,$pincode);
	$pincode2=mysqli_fetch_array($pincode1);
?>
<option >
	<?php echo $pincode2['area_pincode']; ?>
</option>
<?php
}
if($_REQUEST['email_name'])
{
	$email_name=$_REQUEST['email_name'];
	$email_name1="select * from reg";
	$email_name2=mysqli_query($conn,$email_name1);
	$email_name3=mysqli_fetch_array($email_name2);
	if($email_name3['reg_email']==$email_name)
	{
	?>
	<span id="email_id" style="color:red;">EMAIL ALREADY EXISTS</span>
	<?php
	}
}

if($_REQUEST['post_type_name'])
{
	$post_type_name=$_REQUEST['post_type_name'];
	if($post_type_name=='TotalFree')
	{
        
        $post_fee=0;
	?>
       <label for="comunity-name">Post Charge</label>
	<input type="text" value="0" name="p_charge" readonly  class="form-control"><br>
	 <input type="submit" class="btn btn-transparent" name="submit" value="UPLOAD POST">

    <?php 
	}
	else if($post_type_name=='Silver')
	{
        
        $post_fee=5;
	?>
	<label for="comunity-name">Post Charge</label>
	<input type="text" value="5" name="p_charge" readonly  class="form-control"><br>
	 <input class="btn btn-transparent" type="submit" name="submit" value="Pay Now">

    <?php 
	}
	else if($post_type_name=='Gold')
	{
        
        $post_fee=10;
	?>
    
	<label for="comunity-name">Post Charge</label>
	<input type="text" value="10" name="p_charge" readonly  class="form-control"><br>
	 <input type="submit" class="btn btn-transparent" name="submit" value="Pay Now">

    <?php 
	}
}
?>



 