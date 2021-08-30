<!DOCTYPE html>
<?php 
error_reporting(0);
session_start();
if($_SESSION['ID']!=""){
    header("location:index.php");
}
include("connection.php");

if(isset($_REQUEST['login']))
{
	$user_name=$_REQUEST['username'];
	$password=$_REQUEST['password'];
	$select="select * from reg where reg_email='$user_name' and reg_password='$password'";
	$select1=mysqli_query($conn,$select);
	$select2=mysqli_fetch_array($select1);
	if($select2['reg_email']==$user_name and $select2['reg_password']==$password)
	{
		if($select2['reg_user_type']=='User' and $select2['reg_account_status']=='Active')
		{
				$_SESSION['ID']=$select2['reg_id'];
				header("location:index.php");
		}
		else if($select2['reg_user_type']=='Admin')
		{	
				$_SESSION['ID']=$select2['reg_id'];
                $_SESSION['TYPE']="Admin";
				header("location:admin/home.php");
		}
		else if($select2['reg_user_type']=='SuperAdmin')
		{	
				$_SESSION['ID']=$select2['reg_id'];
                $_SESSION['TYPE']="SuperAdmin";
				header("location:admin/home.php");
		}
        else{
            ?>
            <script>
                alert("YOU ARE DELETED YOUR ACCOUNT");
            </script>
    <?php
            
        }
	}
	else
	{
	?>
	<script>
		alert("ENTER VALID EMAIL AND PASSWORD");
	</script>
	<?php
	}
}

?>
<html class="no-js"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>Login </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!---CSS FILES -->

    <link rel="stylesheet" href="css1/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="css1/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css1/Login.css" type="text/css">


    <!---END OF CSS FILES -->

</head>

<body>


<div id="login-container">


    <div id="login">

        <h3>Welcome to Login</h3>

        <h5>Please sign in to get access.</h5>

        <!--Error division start -->
        <div id="error"></div>
        <!--Error division end  -->


        <!-- START OF LOGIN FORM -->
        <form id="login-form"  class="form" method="post">

            <div class="form-group">
                <label for="login-username">Username</label>

                <!-- id="username" is used for the client side validation ,So it is important-->
                <input required="" class="form-control" id="username" name="username" placeholder="Username" type="text">
            </div>

            <div class="form-group">
                <label for="login-password">Password</label>

                <!-- id="password" is used for the client side validation ,So it is important-->
                <input required="" class="form-control" id="password" name="password" placeholder="Password" type="password">
            </div>

            <div class="form-group">

                <input type="submit" id="login-btn" class="btn btn-primary btn-block" value="Login" name="login">
                    

            </div>
        </form>

        <!-- END OF LOGIN FORM -->
        <a href="forgot_password.php" class="btn btn-default">Forgot Password?</a>

    </div> <!-- /#login -->

    <a href="registration.php" id="signup-btn" class="btn btn-lg btn-block">
        Create an Account
    </a>

</div> <!-- /#login-container -->

<!-- JS FILES    -->
<script src="js1/jquery-1.js"></script>
<script src="js1/bootstrap.js"></script>
<script type="text/javascript" src="js/jq.js"></script>
<script type="text/javascript" src="js/jqv.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		
		$("#login-form").validate({
			
			rules:{
				username:{
					required:true,
				},
				password:{
					required:true,
				},
			},
			messages:
			{
				username:{
					required:"ENTER EMAIL ID",
					
				},
				password:{
					required:"ENTER PASSWORD",
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
  </style>
<!-- END OF JS FILES    -->
</body></html>


