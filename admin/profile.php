<?php
include_once("connection.php"); 
include("header.php");
error_reporting(0);
session_start();

$sid=$row121212['reg_state'];
$cid=$row121212['reg_city'];

$state_data="select * from state";
$state_data1=mysqli_query($conn,$state_data);

$city="select * from city where state_id='$sid'";
$city1=mysqli_query($conn,$city);

$area="select * from area where city_id='$cid'";
$area1=mysqli_query($conn,$area);



$id=$_SESSION['ID'];

if(isset($_REQUEST['submit'])){
    $username=$_REQUEST['uname'];
    $name=$_REQUEST['name'];
    $mobile=$_REQUEST['mobile'];
    $state=$_REQUEST['state'];
    $city=$_REQUEST['city'];
    $area=$_REQUEST['area'];
    $address=$_REQUEST['address'];
    $dob=$_REQUEST['dob'];
    $profile=$_FILES['file']['name'];
    $tmp_name=$_FILES['file']['tmp_name'];
    $path="images/admin/".$profile;
    $squestion=$_REQUEST['squestion'];
    $sanswer=$_REQUEST['sanswer'];
    
   $up="UPDATE reg SET reg_username='$username', reg_name='$name', reg_mobile='$mobile',reg_state='$state',reg_city='$city',reg_area='$area',reg_address='$address',reg_dob='$dob',reg_image='$path', reg_squestion='$squestion', reg_sanswer='$sanswer' WHERE reg_id='$id'";
    $up1=mysqli_query($conn,$up) or die(mysqli_error($conn));
    if($up1){
         move_uploaded_file($tmp_name,$path);
         header("location:home.php");
    }
    
}


?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Profile</title>
        <meta name="description" content="description">
        <meta name="author" content="DevOOPS">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
        <link href="plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
        <link href="plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
        <link href="plugins/xcharts/xcharts.min.css" rel="stylesheet">
        <link href="plugins/select2/select2.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
                <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
<!--Start Header-->

        <!--End Header-->
<?php ?>

<!--Start Container-->
<?php include("sider.php");?>
        <!--Start Content-->
                <div id="content" class="col-xs-12 col-sm-10">
            <div class="row">
        <div id="breadcrumb" class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="home.php">Dashboard</a></li>
            <li><a href="#">Profile</a></li>
        </ol>
        </div>
            </div>
    
    <div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    
                    <span>Profile </span>
                </div>   
            <div class="no-move"></div>
            </div>
            <form name="profile_frm" id="profile" method="post" enctype="multipart/form-data">
            <div class="box-content">
               <div class="text-center">
                        <h3 class="page-header">Update Your Profile</h3>
                    </div>
                    <div class="profile-thumb">
                            <center><img src="<?php echo $row121212['reg_image'];?>" style="height: 100px;width: 100px; border-radius:200px; border-bottom-style:solid;"></center>
                    </div>
                     <div class="form-group">
                        <label class="control-label">User Name</label><i style="color: red;"> *</i>
                        <input type="text" id="name" style="height: 40px;" value="<?php echo $row121212['reg_username'];?>" class="form-control" name="uname" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" id="name" value="<?php echo $row121212['reg_name'];?>" style="height: 40px;" class="form-control" name="name" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mobile</label>
                        <input type="text" id="mobile" value="<?php echo $row121212['reg_mobile'];?>" style="height: 40px;" class="form-control" name="mobile" />
                    </div>
                    <!-- State -->
                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control" id="state" style="height: 40px;" name="state" id="state" onchange="getcity(this.value)">
                        <option value="">Select State</option>
                        <?php while($state_data2=mysqli_fetch_array($state_data1)){?>
                        <option <?php if($row121212['reg_state']==$state_data2['state_id']){?> selected=""<?php } ?> value="<?php echo $state_data2['state_id'];?>"><?php echo $state_data2['state_name'];?></option>
                        <?php }?>
                        </select>
                    </div>
                    <!-- City -->
                    <div class="form-group">
                    <label for="city">City</label>
                             <select class="form-control" id="city" style="height: 40px;" name="city" id="city" onchange="getarea(this.value)">
                                <option value="">Select City</option>
                                    <?php 
                        while($city2=mysqli_fetch_array($city1))
                        {
                            
                            ?>
                            <option <?php if($row121212['reg_city']==$city2['city_id']){?> selected=""<?php }?> value="<?php echo $city2['city_id']; ?>"><?php echo $city2['city_name']; ?></option>
                            <?php
                        }
                        ?>
                                
                              </select>
                        </div>
                        <!-- Area -->
                        <div class="form-group">
                            <label for="area">Area</label>
                             <select class="form-control" id="area" style="height: 40px;" name="area" id="area" onchange="getpin(this.value)">
                                <option value="">Select Area</option>
                                    
                                    <?php
                            while($area2=mysqli_fetch_array($area1)){
                        ?>
                                <option <?php if($row121212['reg_area']==$area2['area_id']){?> selected=""<?php }?> value="<?php echo $area2['area_id']; ?>"><?php echo $area2['area_name']; ?></option>
                        <?php }?>
                                    
                               </select>
                        </div>
                        <!-- Zip Code -->
                        <div class="form-group">
                            <label for="zip-code">Zip Code</label>
                            <select id="pinc" style="height: 40px;" class="form-control" disabled readonly  name="pincode">
                            
							</select>
                        </div>
                    <div class="form-group">
                        <label class="control-label">Address</label>
                        <textarea class="form-control" name="address" id="address">
                            <?php echo $row121212['reg_address'];?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Date Of Birth</label>
                        <input type="date" id="dob" value="<?php echo $row121212['reg_dob']?>" style="height: 40px;" class="form-control" name="dob"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Image</label>
                        <input type="file" id="file" style="height: 40px;" class="form-control" name="file"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Security Question</label><i style="color: red;"> *</i>
                        <select id="file" style="height: 40px;" class="form-control" name="squestion">
                            <option value="">Select Sequrity Question</option>
                            <option <?php if($row121212['reg_squestion']=="Your First School Name"){?> selected=""<?php }?> value="Your First School Name">Your First School Name?</option>
                            
                            <option <?php if($row121212['reg_squestion']=="Your Childhood Name"){?> selected=""<?php }?> value="Your Childhood Name">Your Childhood Name?</option>
                            
                            <option <?php if($row121212['reg_squestion']=="Your Favourite Actor Name"){?> selected=""<?php }?> value="Your Favourite Actor Name">Your Favourite Actor Name?</option>
                            
                            <option <?php if($row121212['reg_squestion']=="Your Childhood Name"){?> selected=""<?php }?> value="Your First Jurney Place">Your First Jurney Place</option>
           
                            <option <?php if($row121212['reg_squestion']=="What Is The Name Of Your Favorite Childhood Friend?"){?> selected=""<?php }?> value="What Is The Name Of Your Favorite Childhood Friend?">What Is The Name Of Your Favorite Childhood Friend?</option>
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Security Answer</label><i style="color: red;"> *</i>
                    <input type="text" value="<?php echo $row121212['reg_sanswer'];?>"  style="height: 40px;" class="form-control" name="sanswer"/ id="sanswer">
                    </div>
                    
                    <div class="text-center">
                        <input type="submit" style="height: 40px;" class="btn btn-primary" value="Save Change" name="submit">
                    </div>
             
            </div>
            </form>
        </div>
    </div>
</div>
                
                
            </div>
        </div>
    </div>
</div>        
</div>
        <!--End Content--> 
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="plugins/jquery/jquery-2.1.0.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jqv.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		
		$("#profile").validate({
			
			rules:{
				uname:{
					required:true,
                    minlength:5,
				},
                squestion:{
                    required:true,  
                },
                sanswer:{
                    required:true,
                },
				
			},
			messages:{
				uname:{
					required:"USER NAME MUST BE REQUIRED",
                    minlength:"USER NAME MUST HAVE AT LEAST 5 CHARCTARS",
				},
                squestion:{
                    required:"SECURITY QUESTION IS REQUIRED",  
                },
              sanswer:{
                    required:"SECURITY ANSWER IS REQUIRED",
                },
  
				
			},	
		});
	});

</script>	
	<style>
	label.error{
		
		color:red;
	}
	input.error{
		color:red;
	}
	input.valid{
		color:green;
	}
  </style>

<script src="plugins/justified-gallery/jquery.justifiedgallery.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="plugins/tinymce/jquery.tinymce.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="js/devoops.js"></script>


<script type="text/javascript">
   
	function getcity(obj1)
    {
        //alert(obj1);
        if(window.XMLHttpRequest)
        {
            a=new XMLHttpRequest();
        }
        a.onreadystatechange=function()
        {
            if(a.readyState==4)
            {
                document.getElementById("city").innerHTML=a.responseText;
            }
        }
        a.open("GET","backend.php?state_id="+obj1,true);
        a.send();
    }
    function getarea(obj2)
    {
        //alert(obj1);
        if(window.XMLHttpRequest)
        {
            a=new XMLHttpRequest();
        }
        a.onreadystatechange=function()
        {
            if(a.readyState==4)
            {
                document.getElementById("area").innerHTML=a.responseText;
            }
        }
        a.open("GET","backend.php?city_id="+obj2,true);
        a.send();
    }
    
</script>
<script>
    function getpin(obb)
    {
       // alert(obb);
        //var x;
        if(window.XMLHttpRequest)
        {
            x=new XMLHttpRequest();
        }
        x.onreadystatechange=function()
        {
            if(x.readyState==4)
            {
                document.getElementById('pinc').innerHTML=x.responseText;
            }
        }
        x.open("GET","backend.php?area_id="+obb,true);
        x.send();
        
    }
</script>


</body>
</html>
