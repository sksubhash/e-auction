<?php 
ob_Start();
include("connection.php");

include("header.php");



if(isset($_REQUEST['submit']))
{
	$name=$_REQUEST['name'];
	$mobile=$_REQUEST['mobile'];
	$email=$_REQUEST['email'];
	$message=$_REQUEST['message'];
	$subject=$_REQUEST['subject'];
	$date=date('Y-m-d h:i:s');
	
	$con_data="INSERT INTO manage_contact(con_name,con_email,con_subject,con_message,con_entry_date)values('$name','$email','$message','$subject','$date')";	
	$con_data2=mysqli_query($conn,$con_data)or die(mysqli_error($conn));
    if($con_data2){
        ?>
        <script>
            alert("Your message was successfully sent!");
            window.location="index.php";
        </script>
        <?php
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
  <title>Profile</title>
  
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

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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

</head>

<body class="body-wrapper">



<!--==================================
=            User Profile            =
===================================-->
<div class="page">
</div>
<div id="loading"></div>


<section class="user-profile section">
	<div class="container">
		<div class="row">
			
			
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0" style="margin-left:200px;">
			
			
			
				<!-- Edit Personal Info -->
				<div class="widget personal-info">
					<h1 class="widget-header user">Contact Us</h1>
					<form  method="post" id="frm1" >
						<!-- First Name -->
						<div class="form-group">
						   <b> <label for="first-name">Name</label></b>
						    <input type="text" class="form-control"  id="name" name="name">
						</div>
						<!-- Mobile-Number -->
                        <div class="form-group">
                            <b><label for="mobile-number">Mobile Number</label></b>
                            <input type="text" class="form-control"  id="mobile" name="mobile">
                        </div>
                        
                        <!-- Email Address -->
                        <div class="form-group">
                           <b> <label for="address">Email</label></b>
                            <input type="email" class="form-control"  id="email" name="email">
                        </div>
						
						<div class="form-group">
                           <b> <label for="address">Subject</label></b>
                            <input type="text" class="form-control"  id="subject" name="subject">
                        </div><br>
                        <!-- Message-->
                        <div class="form-group">
                           <b> <label for="dob">Message</label></b>
							<textarea class="form-control" name="message" style="height:150px;">
							
							</textarea>			
							</div>
						<!-- Submit button -->
						
						<input type="submit" name="submit" id="submit1" value="Send Message" class="btn btn-transparent">
						
					</form>
				</div>
		</div>
	</div>
	</div>

				<div class="profile-thumb" style="height:250px; margin-left:350px;">
						<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d59517.47339118711!2d72.8252415545903!3d21.19843118394622!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1swebmasters!5e0!3m2!1sen!2sin!4v1524134710068" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
					
					<br>
					<br>
					<br>
					<br>
					<br>
</section>

<!--============================
=            Footer            =
=============================-->
<?php include("footer1.php");?>
<!-- Footer Bottom -->
<?php include("footer2.php");?>
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
  <script type="text/javascript" src="js/jqv.js"></script>
  <Script type="text/javascript">
    $(document).ready(function(){
        $("#frm1").validate({
            rules:{
                name:{
                        required:true,
                },
                
                mobile:{
                        required:true,
                        number:true,
                },
                
                email:{
                    required:true,
                    email:true,
                },
                subject:{
                    required:true,
                },
                message:{
                    required:true,
                }
            },
            messages:{
                name:{
                        required:"ENTER YOUR NAME",
                },
                
                mobile:{
                    required:"ENTER MOBILE NO",
                    number:"ENTER ONLY NUMBER",
                },
                
                email:{
                    required:"ENTER EMAIL ADDRESS",
                    email:"ENTER PROPER EMAIL",
                },
                subject:{
                    required:"ENTER SUBJECT",
                },
                message:{
                    required:"ENTER MESSAGE",
                }
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
  </style>
  
</body>

</html>