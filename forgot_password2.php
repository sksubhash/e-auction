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
    $s="select * from reg";
    $s1=mysqli_query($conn,$s);
    $s2=mysqli_fetch_array($s1);
        
        
    
    $username=$_SESSION['forgot_username'];
    $select="select * from reg where reg_email='$username' or reg_username='$username'";
    $select1=mysqli_query($conn,$select) or die(mysqli_error($conn));
    $select2=mysqli_fetch_array($select1);
    
    
    
    if(isset($_REQUEST['submit'])){
        $question=$_REQUEST['squestion'];
        $answer=$_REQUEST['sanswer'];
        if($question==$select2['reg_squestion']){
            if($answer==$select2['reg_sanswer']){
                 header("location:forgot_password3.php");
            }else{
                 echo "<script>alert('YOUR ANSWER DOES NOT MATCH')</script>";
            }
        }else{
             echo "<script>alert('YOUR QUESTION DOES NOT MATCH')</script>";
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

        <h5>Enter your Information</h5>

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
  </style>


</body></html>
