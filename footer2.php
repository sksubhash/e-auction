<?php 
include("connection.php");
$category_name="select * from category limit 5";
$category_name1=mysqli_query($conn,$category_name)or die(mysqli_error($conn));
?>

<footer class="footer section section-sm">
  <!-- Container Start -->
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-7 offset-md-1 offset-lg-0">
        <!-- About -->
        <div class="block about">
          <!-- footer logo -->
          <img src="admin/images/logo/eauction.png" style="height: 51px;"alt="">
          <!-- description -->
          <p class="alt-color">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
      </div>
      <!-- Link list -->
      <div class="col-lg-2 offset-lg-1 col-md-3">
        <div class="block">
          <h4>Site Pages</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="contactus.php">Contect Us</a></li>
            <li><a href="#">Deals & Coupons</a></li>
            <li><a href="#">Terms of Services</a></li>
            
          </ul>
        </div>
      </div>
      <!-- Link list -->
      <div class="col-lg-2 col-md-3 offset-md-1 offset-lg-0">
        <div class="block">
          <h4>Category</h4>
          <ul>
			<?php 
			while($category_name2=mysqli_fetch_array($category_name1))
			{
			?>
            <li><a href="post_category.php?cat_id=<?php echo $category_name2['cat_id'];?>"><?php echo $category_name2['cat_name'];?></a></li>
            <?php }?>
          </ul>
        </div>
      </div>
      <!-- Promotion -->
      <div class="col-lg-4 col-md-7">
        <!-- App promotion -->
        <div class="block-2 app-promotion">
          <a href="">
            <!-- Icon -->
            <img src="images/footer/phone-icon.png" alt="mobile-icon">
          </a>
          <p>Get the Dealsy Mobile App and Save more</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Container End -->
</footer>