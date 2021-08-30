<!DOCTYPE html>
<?php 
error_reporting(0);
session_start();
if($_SESSION['ID']!=""){
    header("location:index.php");
}
include("connection.php");

if(isset($_REQUEST['submit']))
{
	$name=$_REQUEST['name'];
	$user_name=$_REQUEST['username'];
	$email=$_REQUEST['email'];
	$con_password=$_REQUEST['cpassword'];
    
    $_SESSION['A']=$name;
    $_SESSION['B']=$user_name;
    $_SESSION['C']=$email;
    $_SESSION['D']=$con_password;
	
    header("location:registration2.php");
}

?>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"><!--<![endif]--><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>Register Page </title>
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

        <h3>Welcome to Register Page</h3>

        <h5>Fill up the following details to register.</h5>
        <div id="error">

        </div>

        <!-- --------REGISTER FORM START ----- -->
        <form id="login-form" action="" class="form" method="post">

            <div class="form-group">
                <label for="login-name">Name</label>
                <input class="form-control" id="name" name="name" placeholder="Name" type="text">
            </div>
            
            

            <div class="form-group">
                <label for="login-username">Username</label>
                <input class="form-control" id="username" name="username" placeholder="Username" type="text">
            </div>
            
            <div class="form-group">
                <label for="login-email">Email</label>
                <input class="form-control" id="email" name="email" placeholder="Email" type="text" onkeyup="getemail(this.value)">
            <span id="email_id"></span> 
			</div>
			
			<div class="form-group">
                <label for="login-password">Password</label>
                <input class="form-control" id="password" name="password" placeholder="Password" type="password">
            </div>

            <div class="form-group">
                <label for="login-cpassword">Confirm Password</label>
                <input class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" type="password">
            </div>

            

            <div class="form-group">

                <input type="submit" id="register-btn"  class="btn btn-primary btn-block" name="submit" value="Next">

            </div>
        </form>
        <!-- --------REGISTER FORM END ----- -->


    </div> <!-- /#login -->

    <a href="login.php" id="signup-btn" class="btn btn-lg btn-block">
        &lt; Back To sign in
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
			
			rules:
			{
				name:{
					required:true,
				},
                username:{
                    required:true,
                    minlength:5,
                    
                },
				email:
				{
					required:true,
					email:true,
                   
				},
				password:{
					required:true,
                    minlength:6,
                    maxlength:12,
				},
				cpassword:{
					required:true,
                    minlength:6,
                    maxlength:12,
					equalTo:"#password",
				},
			},
			
			messages:
			{
				name:{
					required:"ENTER YOUR NAME",
				},
				username:{
					required:"ENTER USER NAME",
                    minlength:"USER NAME MUST HAVE AT LEAST 5 CHARCTARS",
                    
				},
				email:
				{
					required:"ENTER EMAIL ID",
					email:"ENTER VALID EMAIL",
                    
				},
				password:{
					required:"ENTER PASSWORD",
                    minlength:"PASSWORD MUST HAVE AT LEAST 6 CHARCTARS",
                    maxlength:"PASSWORD NOT HAVE MORE THEN 12 CHARCTARS",
				},
				cpassword:{
					required:"ENTER PASSWORD AGAIN",
                    minlength:"PASSWORD MUST HAVE AT LEAST 6 CHARCTARS",
                    maxlength:"PASSWORD NOT HAVE MORE THEN 12 CHARCTARS",
					equalTo:"PASSWORD DOES NOT MATCH",
				},
			}
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
<!-- END OF JS FILES    -->

<script type="text/javascript">
	
		function getemail(obj)
		{
		//	alert(obj);
			var a;
			if(window.XMLHttpRequest)
			{
				a=new XMLHttpRequest();
			}
			a.onreadystatechange=function()
			{
				if(a.readyState==4)
				{
					document.getElementById("email_id").innerHTML=a.responseText;
				}
			}
			a.open("GET","backend.php?email_name="+obj,true);
			a.send();
		}
</script>
</body>
</html>