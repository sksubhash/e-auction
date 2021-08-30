<?php
error_reporting(0);
session_start();
if($_SESSION['ID']!=""){
    header("location:index.php");
}
if($_SESSION['forgot_username']==""){
    header("location:forgot_password.php");
}
    include("connection.php");
    if(isset($_REQUEST['submit'])){
        $password=$_REQUEST['password'];
        $username=$_SESSION['forgot_username'];
        $up="update reg set reg_password='$password' where reg_email='$username' or reg_username='$username'";
        $up2=mysqli_query($conn,$up);
        if($up2){
            unset($_SESSION['forgot_username']);
            header("location:login.php");
        }
       
    }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"><!--<![endif]--><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>Forgot Password </title>
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

        <h3>FORGET PASSWORD</h3>

        <h5>Enter your New Password</h5>

        <!--Error division start -->
        <div id="error"></div>
        <!--Error division end  -->


        <!-- START OF FORGET FORM -->
        <form id="login-form" class="form" method="post">

            <div class="form-group">

                <input class="form-control" id="password" name="password" placeholder="Password" type="password" requried>
            </div>
            
            <div class="form-group">

                <input class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" type="password">

            </div>



            <div class="form-group">

                <input type="submit" id="forget-btn" class="btn btn-primary btn-lg btn-block" value="Done" name="submit"> &nbsp;

            </div>
        </form>

        <!-- END OF LOGIN FORM -->


    </div> <!-- /#FORGET -->

    <a href="login.php" id="signup-btn" class="btn btn-lg btn-block">
        &lt;&lt; Back
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

</body></html>