<?php 
include("connection.php");

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
    $state=$_REQUEST['state_id'];
    $city="select * from city where state_id='$state'";
    $city1=mysqli_query($conn,$city);
    ?>
    <option>Select City</option>
    <?php
    while($city2=mysqli_fetch_array($city1))
    {
        ?>
        <option value="<?php echo $city2['city_id']; ?>"><?php echo $city2['city_name']; ?></option>
        <?php
    }

}

if($_REQUEST['city_id'])
{
    $city_id=$_REQUEST['city_id'];
    $area="select * from area where city_id='$city_id'";
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

?>