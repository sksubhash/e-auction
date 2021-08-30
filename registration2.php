<?php
session_start();
    include("connection.php");
    
    if(isset($_REQUEST['submit'])){
        $name=$_SESSION['A'];
        $user_name=$_SESSION['B'];
        $email=$_SESSION['C'];
        $con_password=$_SESSION['D'];
        $squestion=$_REQUEST['squestion'];
        $sanswer=$_REQUEST['sanswer'];
        date_default_timezone_set('Asia/Calcutta');
        $date=date('Y-m-d h:i:s');
        $insert="INSERT INTO reg(reg_name,reg_username,reg_email,reg_password,reg_squestion,reg_sanswer,reg_entry_date,reg_image)values('$name','$user_name','$email','$con_password','$squestion','$sanswer','$date','admin/images/icon/user.png')";
         $insert1=mysqli_query($conn,$insert)or die(mysqli_error($conn));
         if($insert1)
         {    
            unset($_SESSION['A']);
            unset($_SESSION['B']);
            unset($_SESSION['C']);
            unset($_SESSION['D']);
            header("location:login.php");
         }
         else
         {
            echo "DATA NOT VALID";
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

    <title>Register Page</title>
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

        <h3>Register Page</h3>

        <h5>Enter Following Information</h5>

        <!--Error division start -->
        <div id="error"></div>
        <!--Error division end  -->


        <!-- START OF FORGET FORM -->
        <form id="login-form" class="form" method="post">

            <div class="form-group">

                <select class="form-control" name="squestion" id="squestion">
                    <option value="">Select Sequrity Question</option>
                    <option value="Your First School Name">Your First School Name</option>
                    <option value="Your Childhood Name">Your Childhood Name</option>
                    <option value="Your Favourite Actor Name">Your Favourite Actor Name</option>
                    <option value="Your First Jurney Place">Your First Jurney Place</option>
                </select>
                
            </div>
            
            
            <div class="form-group">
                
                <input class="form-control" id="sanswer" name="sanswer" placeholder="Sequrity Answer" type="text">
            </div>
            


            <div class="form-group">

                <input type="submit" id="forget-btn" class="btn btn-primary btn-lg btn-block" value="Submit" name="submit"> &nbsp;

            </div>
        </form>

        <!-- END OF LOGIN FORM -->


    </div> <!-- /#FORGET -->

    <a href="registration.php" id="signup-btn" class="btn btn-lg btn-block">
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
            
            rules:{
                squestion:{
                    required:true,
                },
                sanswer:{
                    required:true,
                },
            },
            messages:
            {
                squestion:{
                    required:"ENTER SEQUIRTY QUESTION",
                    
                },
                sanswer:{
                    required:"ENTER SEQUIRTY ANSWER",
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
  </style><!-- END OF JS FILES    -->

</body></html>