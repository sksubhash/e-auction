<?php
session_start();
    include("connection.php");
    if(isset($_REQUEST['submit'])){
        $username=$_REQUEST['username'];
        $select="select * from reg where reg_email='$username' or reg_username='$username'";
        $select1=mysqli_query($conn,$select);
        $select2=mysqli_num_rows($select1);
        if($select2==1){

            $_SESSION['forgot_username']=$username;
            header("location:forgot_password2.php");
        }else{
            echo "<script>alert('USER DOES NOT EXSIST')</script>";
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

        <h5>Enter your Email</h5>

        <!--Error division start -->
        <div id="error"></div>
        <!--Error division end  -->


        <!-- START OF FORGET FORM -->
        <form id="login-form" class="form" method="post">

            <div class="form-group">
                <label for="login-username">Username</label>

                <!-- id="username" is used for the client side validation ,So is important-->
                <input required="" class="form-control" id="username" name="username" placeholder="Email" type="text">
            </div>


            <div class="form-group">

                <input type="submit" id="forget-btn" class="btn btn-primary btn-lg btn-block" value="Next" name="submit"> &nbsp;

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
<!-- END OF JS FILES    -->
<script type="text/javascript" src="js/jq.js"></script>
<script type="text/javascript" src="js/jqv.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        
        $("#login-form").validate({
            
            rules:{
                username:{
                    required:true,
                },
            },
            messages:
            {
                username:{
                    required:"ENTER EMAIL ID",
                    
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



</body></html>